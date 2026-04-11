# ANALYSIS: QR Workflow for add_return_stores.php

## 📋 **FORM OVERVIEW**

**File:** `add_return_stores.php` (Internal Return - Stores)
- This is the second form where we need to implement QR workflow
- Similar to `add_arrival_vendor.php` but for internal material returns

---

## 🏗️ **CURRENT STRUCTURE**

### **JavaScript File**
- Uses: `intretchk.js` (NOT `vaddresschk.js`)
- This file handles all AJAX calls and form interactions

### **Form Fields** (Similar to arrival_vendor)
- `txtclass` → Classification dropdown
- `txtitem` → Item dropdown
- `txtupsg` → UPS Good (number input)
- `txtqtyg` → Quantity Good (number input)
- `maintrid` → Hidden field for main record ID (0 initially)

### **AJAX Template File**
- When user clicks "Post" button → calls `getuser_imroupdateform.php`
- This file handles:
  - Creating new item rows in the table
  - Item posting to database
  - Returning newly created IDs
  - Auto-linking QRs (this is where we'll add UPDATE query)

### **Preview & Final Submit**
- After posting items → shows `add_return_stores_preview.php`
- This file requires `p_id` parameter (currently NOT being passed!)

---

## 🔄 **WHAT NEEDS TO BE DONE**

### **STEP 1: Fix p_id Parameter Issue** ✅ (SAME AS VENDOR)
**File:** `add_return_stores.php`
- Add hidden input field `name="p_id"` to the main form
- Currently might be missing (like vendor form had)

**Purpose:** When form posts to preview, p_id needs to be passed

---

### **STEP 2: Add QR Workflow to intretchk.js**
**File:** `intretchk.js`

**Add:**
1. `openGenerateQR()` function
   - Get classification_id, item_id, ups_good values
   - Open generate_qr_code.php popup
   - Monitor popup closure
   - Call fetchQRTotalWeight() when closed

2. `fetchQRTotalWeight()` function
   - AJAX to get_qr_total_weight.php
   - Populate txtqtyg field with sum
   - Make read-only if Roll type

3. `getClassificationType()` function
   - Fetch classification type via AJAX
   - Show/hide "Generate QR" link based on Roll type
   - Set global variable `currentClassificationType`

4. `checkGenerateQRVisibility()` function
   - Show QR link only if:
     - Classification type = "roll" or "roll plain"
     - UPS Good value > 0

---

### **STEP 3: Update Classification Type Check**
**File:** `add_return_stores.php`

**Location:** Where txtclass dropdown is shown (around line 1700+)
**Add:**
```html
<select name="txtclass" onchange="getClassificationType(this.value);" ...>
```

**Add Generate QR Link** (next to txtupsg field):
```html
<input name="txtupsg" ... onchange="upschk(this.value); getClassificationType(...)"/>
<a id="generateQR" style="display:none" onclick="openGenerateQR()">Generate QR</a>
```

---

### **STEP 4: Create QR Backend Files** (Same as before)
**Files to CREATE:**
1. `generate_qr_code.php` - Already exists (REUSE for all forms)
2. `save_qr_codes.php` - Already exists (REUSE)
3. `get_qr_total_weight.php` - Already exists (REUSE)

**These files are FORM-INDEPENDENT** - they work for any form!

---

### **STEP 5: Add UPDATE Query for Auto-Linking**
**File:** `getuser_imroupdateform.php`

**Location:** After new `tblarrival_sub` record is created
**Add:**
```php
// Get new IDs from INSERT
$mainid = $newly_created_arrival_id;
$subid = mysql_insert_id();  // New arrsub_id

// Link all draft QRs for this classification+item
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

**Also:**
- Add hidden response fields to return new IDs to main form:
```html
<input type="hidden" name="response_arrival_id" value="<?php echo $mainid; ?>">
<input type="hidden" name="response_arrsub_id" value="<?php echo $subid; ?>">
```

---

### **STEP 6: Update p_id Passing Issue**
**File:** `add_return_stores_preview.php`

**At top of file:**
```php
if(isset($_REQUEST['p_id'])) {
    $pid = $_REQUEST['p_id'];
}
// ... rest of code
```

**In the form that posts to select_arrivalop:**
```html
<input type="hidden" name="p_id" value="<?php echo $pid; ?>">
```

---

## 🔑 **CRITICAL DIFFERENCES FROM add_arrival_vendor.php**

### **Same:** 
- Form fields structure (txtclass, txtitem, txtupsg, txtqtyg)
- QR generation workflow (0,0 → save → popup closes → fetch weight)
- Database tables used (tbl_qr_codes, tblarrival, tblarrival_sub)
- Weight handling (individual weight, not total)

### **Different:**
- JavaScript file used: `intretchk.js` (NOT `vaddresschk.js`)
- AJAX template file: `getuser_imroupdateform.php` (NOT `getuser_vupdateform.php`)
- Preview file: `add_return_stores_preview.php`
- Transaction type: 'Internal Return' (NOT 'Vendor')

---

## 📁 **FILES TO MODIFY**

### **Must Modify:**
1. ✏️ `Transaction/add_return_stores.php`
   - Add p_id hidden field
   - Add classification type check on dropdown
   - Add Generate QR link with onclick handler

2. ✏️ `Transaction/intretchk.js`
   - Add all 4 QR workflow functions
   - Add classification type fetching logic
   - Add popup closure detection

3. ✏️ `Transaction/getuser_imroupdateform.php`
   - Add UPDATE query for QR auto-linking
   - Add hidden response fields with new IDs

4. ✏️ `Transaction/add_return_stores_preview.php`
   - Add p_id hidden field in form

### **Can REUSE (Already Created):**
5. ✅ `Transaction/generate_qr_code.php` - REUSE
6. ✅ `Transaction/save_qr_codes.php` - REUSE
7. ✅ `Transaction/get_qr_total_weight.php` - REUSE

---

## 🔄 **IMPLEMENTATION ORDER**

1. **First:** Add p_id field to forms (both files)
2. **Second:** Update intretchk.js with QR functions
3. **Third:** Update add_return_stores.php form fields
4. **Fourth:** Update getuser_imroupdateform.php with UPDATE query
5. **Test:** End-to-end workflow

---

## 💡 **WHY THIS APPROACH**

- Leverages existing `generate_qr_code.php`, `save_qr_codes.php`, `get_qr_total_weight.php`
- Only need to add QR workflow functions to intretchk.js
- Same database structure and UPDATE logic
- Minimal code duplication
- Easy to apply to 3rd form later

---

**END OF ANALYSIS**
