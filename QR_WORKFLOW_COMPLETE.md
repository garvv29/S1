# QR Code Generation & Auto-Linking Workflow
**Complete Implementation Guide**

---

## 📋 **OVERVIEW**

A complete system to:
1. Generate QR codes for inventory items
2. Save QR codes with draft state (0, 0)
3. Auto-link QRs to arrival records when items are posted
4. Auto-populate quantity field from total QR weight

---

## 🏗️ **ARCHITECTURE**

### **Database Tables**
```
tbl_qr_codes
├── arrival_id          (0 initially, updated after item post)
├── arrsub_id           (0 initially, updated after item post)
├── classification_id   (from dropdown)
├── item_id             (from dropdown)
├── qr_code_text        (generated QR string)
├── weight              (individual QR weight)
├── arrivalweight       (same as weight - individual weight)
├── linked_status       ('draft' or 'linked')
├── finalsubmit         (0 = draft, 1 = final)
├── created_by          (logged-in user)
└── generated_date      (auto timestamp)

tblarrival
├── arrival_id
├── yearcode
├── arrival_date
└── ... other fields

tblarrival_sub
├── arrsub_id           (created when item is posted)
├── arrival_id          (parent)
├── classification_id
├── item_id
└── ... other fields
```

---

## 🔄 **COMPLETE WORKFLOW FLOW**

### **STEP 1: Classification Type Check**
**File:** `add_arrival_vendor.php` + `vaddresschk.js`

```javascript
// When classification dropdown changes
$(document).on('change', 'select[name="txtclass"]', function() {
    var classificationId = $(this).val();
    
    // AJAX to fetch classification type
    $.ajax({
        url: 'getuser_classificationtype.php',
        type: 'GET',
        data: { a: classificationId },
        success: function(response) {
            currentClassificationType = response.trim();
            checkGenerateQRVisibility();
        }
    });
});
```

**Condition:** Show "Generate QR" link only if:
- Classification type = "roll" OR "roll plain"
- UPS Good field > 0

---

### **STEP 2: Open Generate QR Popup**
**File:** `vaddresschk.js` → `openGenerateQR()` function

```javascript
function openGenerateQR() {
    var classificationId = $('select[name="txtclass"]').val();
    var itemId = $('select[name="txtitem"]').val();
    var upsGood = $('input[name="txtupsg"]').val();
    
    // Parameters to pass
    var arrivalId = $('input[name="maintrid"]').val() || 0;
    var arrsubId = $('input[name="subtrid"]').val() || 0;
    
    // Open popup window
    var url = 'generate_qr_code.php?arrival_id=' + arrivalId + 
              '&arrsub_id=' + arrsubId + 
              '&classification_id=' + classificationId + 
              '&item_id=' + itemId + 
              '&ups_good=' + upsGood;
    
    var qrWindow = window.open(url, 'generateQR', 'width=1200,height=800,scrollbars=yes,resizable=yes');
    
    // Monitor popup closure
    if(qrWindow) {
        var checkClosed = setInterval(function() {
            if(qrWindow.closed) {
                clearInterval(checkClosed);
                // Fetch QR weights when popup closes
                fetchQRTotalWeight(classificationId, itemId);
            }
        }, 500);
    }
}
```

---

### **STEP 3: QR Generation & Entry**
**File:** `generate_qr_code.php`

**Functionality:**
1. Receives parameters from GET
2. Displays QR generation form
3. User enters weights for each QR
4. Generates QR codes via `api.qrserver.com`
5. Shows preview with weights
6. User submits → calls `save_qr_codes.php`

**Key Logic:**
```php
// No auto-fetch of latest values
$arrival_id = isset($_GET['arrival_id']) ? intval($_GET['arrival_id']) : 0;
$arrsub_id = isset($_GET['arrsub_id']) ? intval($_GET['arrsub_id']) : 0;

// NOTE: These remain 0 at this point (draft state)
// They will be updated when item is posted
```

---

### **STEP 4: Save QR Codes to Database**
**File:** `save_qr_codes.php`

**POST Data Received:**
```
qr_text_1, qr_weight_1
qr_text_2, qr_weight_2
qr_text_3, qr_weight_3
... (up to N QRs)
classification_id
item_id
```

**INSERT Query:**
```sql
INSERT INTO tbl_qr_codes (
    arrival_id,           -- 0 (draft)
    arrsub_id,            -- 0 (draft)
    classification_id,    -- from form
    item_id,              -- from form
    qr_code_text,         -- generated text
    weight,               -- individual weight
    arrivalweight,        -- SAME as weight (not total!)
    linked_status,        -- 'draft'
    finalsubmit,          -- 0
    created_by            -- logged user
) VALUES (...)
```

**Response:** JSON
```json
{
    "success": true,
    "message": "All 3 QR codes saved successfully",
    "count": 3,
    "total_weight": 75.5
}
```

---

### **STEP 5: Fetch & Auto-Populate Quantity**
**File:** `vaddresschk.js` → `fetchQRTotalWeight()` function

When QR popup closes:

```javascript
function fetchQRTotalWeight(classificationId, itemId) {
    $.ajax({
        url: 'get_qr_total_weight.php',
        type: 'GET',
        data: { 
            classification_id: classificationId,
            item_id: itemId
        },
        success: function(response) {
            var data = JSON.parse(response);
            if(data.success && data.total_weight) {
                // SUM of all QR weights for this classification+item
                $('input[name="txtqtyg"]').val(data.total_weight);
                
                // If Roll type → make read-only
                if(currentClassificationType.includes('roll')) {
                    $('input[name="txtqtyg"]')
                        .attr('readonly', true)
                        .css('background-color', '#CCCCCC');
                }
            }
        }
    });
}
```

**Backend File:** `get_qr_total_weight.php`

```php
// Query to fetch sum of weights
$sql = "SELECT SUM(weight) as total_weight FROM tbl_qr_codes 
        WHERE classification_id = '$classification_id' 
          AND item_id = '$item_id' 
          AND arrsub_id = 0              // Only draft QRs
          AND linked_status = 'draft'    // Only drafts
        GROUP BY classification_id, item_id";

// Returns JSON with total_weight
```

---

### **STEP 6: Form Item Row Injection**
**File:** `getuser_vupdateform.php` (AJAX called when "Post" button clicked)

**Template HTML Injected:**
```html
<table>
    <tr>
        <td>Classification: <input name="txtclass" /></td>
        <td>Item: <input name="txtitem" /></td>
    </tr>
    <tr>
        <td>UPS Good: <input name="txtupsg" /></td>
        <td>Quantity Good: <input name="txtqtyg" /></td>
        <td><a id="generateQR" onclick="openGenerateQR()">Generate QR</a></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:right">
            <img src="submit.gif" onclick="pform()">
        </td>
    </tr>
</table>
```

**Hidden Fields Added:**
```html
<input type="hidden" name="response_arrival_id" value="0">
<input type="hidden" name="response_arrsub_id" value="0">
<input type="hidden" name="maintrid" value="0">
<input type="hidden" name="subtrid" value="0">
```

---

### **STEP 7: Extract Response IDs**
**File:** `vaddresschk.js` → `stateChanged()` function

When AJAX response comes back after item save:

```javascript
function stateChanged() {
    if (xmlHttp.readyState == 4) {
        if (xmlHttp.status == 200) {
            var response = xmlHttp.responseText;
            
            // Extract hidden response fields
            var arrivalIdElem = document.getElementById('response_arrival_id');
            var arrsubIdElem = document.getElementById('response_arrsub_id');
            
            if(arrivalIdElem && arrsubIdElem) {
                var arr_id = arrivalIdElem.value || 0;
                var arsub_id = arrsubIdElem.value || 0;
                
                // Update main form's hidden arrival fields
                if(document.frmaddDepartment) {
                    document.frmaddDepartment.maintrid.value = arr_id;
                    document.frmaddDepartment.subtrid.value = arsub_id;
                }
            }
        }
    }
}
```

---

### **STEP 8: Create tblarrival_sub Record**
**File:** `getuser_vupdateform.php` (PHP backend)

When user posts item:

```php
// Create new tblarrival_sub record with real IDs
$sql_insert_sub = "INSERT INTO tblarrival_sub (
    arrival_id,
    classification_id,
    item_id,
    ups_per_dc,
    qty_per_dc,
    ups_good,
    qty_good,
    ups_damage,
    qty_damage
) VALUES ('$mainid', '$classid', '$itemid', ...)";

mysql_query($sql_insert_sub) or die(mysql_error());

// Get the new arrsub_id that was just created
$subid = mysql_insert_id();

// Store in response hidden fields for AJAX callback
echo '<input type="hidden" name="response_arrival_id" value="' . $mainid . '">';
echo '<input type="hidden" name="response_arrsub_id" value="' . $subid . '">';
```

---

### **STEP 9: Auto-Link Draft QRs**
**File:** `getuser_vupdateform.php` (PHP backend) - AFTER tblarrival_sub INSERT

```php
// After new tblarrival_sub is created with $subid
// Update all draft QRs for this classification+item

$classification_id = '$n';  // from AJAX request
$item_id = '$o';            // from AJAX request

$sql_update_qr = "UPDATE tbl_qr_codes 
                 SET arrival_id = '$mainid',
                     arrsub_id = '$subid',
                     linked_status = 'linked'
                 WHERE linked_status = 'draft'
                   AND arrsub_id = 0
                   AND classification_id = '$classification_id'
                   AND item_id = '$item_id'";

mysql_query($sql_update_qr) or die(mysql_error());
```

**WHERE Clause (CRITICAL):**
- `linked_status = 'draft'` → Only update draft QRs
- `arrsub_id = 0` → Only QRs that haven't been linked yet
- `classification_id = '$n'` → Only for THIS classification
- `item_id = '$o'` → Only for THIS item

**Result:**
- All draft QRs now have real `arrival_id` and `arrsub_id`
- Status changes from 'draft' to 'linked'
- Ready for printing/processing

---

## 📁 **FILES INVOLVED**

### **Frontend - Main Form**
1. **add_arrival_vendor.php** - Main entry point with form
2. **vaddresschk.js** - JavaScript for QR workflow

### **QR Generation**
3. **generate_qr_code.php** - QR entry form & generation UI
4. **save_qr_codes.php** - Saves QRs to database
5. **get_qr_total_weight.php** - Fetches sum of QR weights

### **Item Post & QR Linking**
6. **getuser_vupdateform.php** - AJAX form template + UPDATE query
7. **add_arrival_vendor_preview.php** - Final submission form

### **Helper Functions**
8. **getuser_classificationtype.php** - Fetches classification type

---

## 🔑 **KEY CONCEPTS**

### **Draft State (0, 0)**
```
QR Code Created → arrival_id=0, arrsub_id=0, linked_status='draft'
                → Saved to database but NOT linked to transaction yet
```

### **Linking Process**
```
User Posts Item → tblarrival_sub created with real IDs
              → UPDATE query finds all draft QRs
              → Links them using new arrival_id + arrsub_id
              → Status changes to 'linked'
              → Ready for final submission
```

### **Weight Handling**
```
Individual QR Weight → saved in 'weight' column
                    → saved in 'arrivalweight' column (SAME VALUE)
                    
NOT Total Weight    → total weight used only for intermediate display
                    → not saved to database
```

### **Classification Type Check**
```
Roll Type         → Generate QR link shown only if UPS > 0
                 → Quantity Good field is read-only (comes from QR sum)
                 
Other Types      → Generate QR link NOT shown
                 → Quantity Good field is editable
```

---

## 🔄 **COMPLETE FLOW SEQUENCE**

```
1. User selects Classification (Roll)
   ↓
2. Classification type fetched via AJAX
   ↓
3. User enters UPS Good value
   ↓
4. "Generate QR" link appears (for Roll type only)
   ↓
5. User clicks → Popup opens → generate_qr_code.php
   ↓
6. User enters weights for each QR
   ↓
7. User submits → save_qr_codes.php
   ↓
8. QRs saved to database WITH (0, 0, 'draft')
   ↓
9. Popup closes → JavaScript detects closure
   ↓
10. AJAX calls get_qr_total_weight.php
    ↓
11. SUM of all QR weights returned (e.g., 75.5 kg)
    ↓
12. Quantity Good field auto-populated with 75.5
    ↓
13. Field set to read-only for Roll type
    ↓
14. User clicks "Post" button
    ↓
15. getuser_vupdateform.php called via AJAX
    ↓
16. New tblarrival_sub record created
    ↓
17. Real arrival_id and arrsub_id obtained
    ↓
18. UPDATE query runs:
    - Finds all draft QRs (arrsub_id=0)
    - Updates with real IDs
    - Changes status to 'linked'
    ↓
19. Response sent back with new IDs
    ↓
20. vaddresschk.js stateChanged() extracts IDs
    ↓
21. Main form's maintrid and subtrid fields updated
    ↓
22. Next item can be added (repeat from step 1)
```

---

## 💾 **SQL SUMMARY**

### **Save QR Code**
```sql
INSERT INTO tbl_qr_codes (
    arrival_id, arrsub_id, classification_id, item_id,
    qr_code_text, weight, arrivalweight,
    linked_status, finalsubmit, created_by
) VALUES (0, 0, 100, 5, 'QRCODE123', 25.5, 25.5, 'draft', 0, 'user1');
```

### **Fetch Total Weight**
```sql
SELECT SUM(weight) as total_weight 
FROM tbl_qr_codes 
WHERE classification_id = 100 
  AND item_id = 5 
  AND arrsub_id = 0 
  AND linked_status = 'draft'
GROUP BY classification_id, item_id;
```

### **Link Draft QRs**
```sql
UPDATE tbl_qr_codes 
SET arrival_id = 999, arrsub_id = 111, linked_status = 'linked'
WHERE linked_status = 'draft'
  AND arrsub_id = 0
  AND classification_id = 100
  AND item_id = 5;
```

---

## ⚙️ **TO IMPLEMENT IN OTHER FORMS**

1. Copy JavaScript logic from `vaddresschk.js` to new form JS
2. Create form-specific versions of:
   - `generate_qr_code.php`
   - `save_qr_codes.php`
   - `get_qr_total_weight.php`
3. Update table names if different
4. Update field names (txtclass, txtitem, txtupsg, txtqtyg, etc.)
5. Add same UPDATE query logic in item post handler
6. Add classification type check before showing QR link
7. Add read-only logic for Roll types

---

**END OF COMPLETE WORKFLOW DOCUMENTATION**
