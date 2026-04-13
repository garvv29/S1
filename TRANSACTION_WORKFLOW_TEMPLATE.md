# TRANSACTION WORKFLOW TEMPLATE
## (Based on E-Indent Implementation)

---

## 1. WORKFLOW PHASES

### **Phase 1: CREATION (Eindent Person)**
**Page:** `/Transaction/add_indents.php`

#### Step 1.1: Header Info
```
- Transaction ID Auto-generated: TIR{code}/{yearcode}/{loginid}
- Date: Auto-filled (today)
- Raised By: Auto-filled from tbl_roles where id=loginid
```

#### Step 1.2: Item Line Entry
```
SELECT:
  a) Classification (tbl_classification)
  b) Item (tbl_stores)
     - Filters by classification_id
  c) UoM (tbl_stores.uom)
  d) Quantity (user input)

DATABASE - INSERT:
  ✅ tbl_ieindent (main record)
     - code1, tdate, id (creator), yearcode, remarks
     - flg=0 (PENDING)
  
  ✅ tbl_ieindent_sub (each line)
     - id_in, classification_id, items_id, uom, ups=0, qty
```

#### Step 1.3: Actions
```
- "Add Item": AJAX to getuser_indentupdate.php
  → Updates maintrid hidden field with transaction ID
  
- "Preview": Shows all items with edit/delete options
  
- "Final Submit": 
  → UPDATE: tbl_ieindent SET tflg=1
  → Redirect to indexindet.php
  → Redirect to indexindet.php shows page (deleted code disabled)
```

---

### **Phase 2: PENDING VIEW (Operator)**
**Page:** `/Transaction/add_issue_indents1.php`

```
QUERY:
  SELECT * FROM tbl_ieindent 
  WHERE flg=0 AND yearcode='{yearcode}'
  
DISPLAY:
  - Transaction ID
  - Date
  - Items count
  - Raised By
  - Actions: Issue, View, Delete
```

---

### **Phase 3: ISSUE PROCESSING (Operator)**
**Page:** `/Transaction/add_issue_indents.php?tid={XXXXX}`

#### Step 3.1: Load Indent Details
```
QUERY: SELECT * FROM tbl_ieindent WHERE tid={tid}
DISPLAY:
  - Transaction ID
  - Indent Number
  - Date
  - Raised By (from tbl_roles where id = indent creator)
  - All line items
```

#### Step 3.2: Edit Each Line Item
**AJAX Trigger:** Click "Edit" button on each line

**Page Called:** `getuser_issue_eindent_etd.php?a={eid}`

```
FOR EACH ITEM LINE:
  1. Show Classification (readonly)
  2. Show Item (readonly)
  3. Show UoM (readonly)
  4. Show Indent Qty (readonly)
  
  5. Show Available Stock:
     QUERY: SELECT * FROM tbl_stldg_good 
             WHERE stlg_tritemid='{item_id}'
             AND stlg_balqty > 0
     
     DISPLAY TABLE:
     - SLOC (Warehouse/Bin/SubBin)
     - Available UPS
     - Available QTY
     - Issue UPS (user input)
     - Issue QTY (user input)
     - Balance UPS (calculated)
     - Balance QTY (calculated)
```

#### Step 3.3: UPS Logic (If UPS > 1)
```
IF available UPS > 1:
  - User sees multiple SLOC rows for same item
  - Can issue from different SLOCs
  - Each row: (issueups_{rownum}, issueqty_{rownum})
  
EXAMPLE:
  Item: "Shirt" (UPS=5 means 5 shirts per pack)
  
  Available Stock:
  - SLOC1: 10 UPS × 5 = 50 shirts
  - SLOC2: 5 UPS × 5 = 25 shirts
  
  Operator can issue:
  - From SLOC1: 2 UPS (10 shirts)
  - From SLOC2: 1 UPS (5 shirts)
  Total: 3 UPS = 15 shirts issued
```

#### Step 3.4: QR Scanning (For Roll Classification)
```
IF Classification = 'Roll':
  - Show QR scanning UI
  - Scan QR codes for each item
  - Auto-populate total weight in issueqty field
  - Lock issueqty field (readonly)
  
QR FLOW:
  1. Detect classification type via AJAX
  2. If 'Roll': Setup QR scanning UI
  3. Listen for issueups field changes
  4. Open QR scanner window
  5. User scans QRs
  6. Calculate total weight
  7. Update issueqty field
  8. Lock field
```

#### Step 3.5: Post/Save Item
**Button:** "Post" (pform() JavaScript function)

```
VALIDATION:
  ✓ Classification selected
  ✓ Item selected
  ✓ Quantity entered
  ✓ Not starting with space

AJAX CALL:
  → getuser_issue_eindentedtupdate.php
  
  METHOD: GET with all form data as query string
  
RESPONSE:
  □ tblissue INSERT (main record)
     - issue_type='eindent'
     - issue_code, issue_date
     - issue_role=logid (operator)
  
  ✅ tblissue_sub INSERT
     - classification_id, item_id, ups_indent, qty_indent
  
  ✅ tblissue_sloc INSERT (for each SLOC)
     - issue_tr_id, issue_id
     - whid, binid, subbin
     - qty_issue, ups_issue
     - qty_balance, ups_balance
  
  📤 RESPONSE: HTML table with TRANSACTION_ID embedded
     Format: <div style="display:none;">TRANSACTION_ID:{id}:END_TRANSACTION_ID</div>
  
  🔄 JAVASCRIPT: Extract ID & update hidden form field
     document.getElementsByName('trid')[0].value = transactionId
```

#### Step 3.6: Validation Checks
```
BEFORE PREVIEW:
  ✓ txtdate not empty
  ✓ At least 1 item posted (trid != 0)
  ✓ For each posted item:
    - balqty not empty
    - issueqty <= availableqty
    - If balqty=0 and balups>0: set balups=1
    - If balqty=0 and balups=0: set balups=0
```

#### Step 3.7: Preview & Final Submit
**Page:** `/Transaction/add_issue_eindents_preview.php?p_id={tid}`

```
DISPLAY:
  - All transaction details
  - All line items with values
  
FINAL SUBMIT BUTTON:
  → POST back to itself
  → Validates again
  → Updates tbl_ieindent SET flg=1
  → Redirects to next page
  
DATABASE FINAL UPDATE:
  ✅ UPDATE tbl_ieindent SET remarks, flg=1
  ✅ tbl_stldg_good: Insert new ledger entries with:
     - stlg_balups = opening_ups - issued_ups
     - stlg_balqty = opening_qty - issued_qty
     - Update subbin status if qty = 0
```

---

## 2. DATABASE TABLES INVOLVED

```
CREATION PHASE:
├── tbl_ieindent (main indent master)
├── tbl_ieindent_sub (indent details)
├── tbl_classification (item type)
└── tbl_stores (items master)

ISSUE PHASE:
├── tblissue (issue transaction)
├── tblissue_sub (issue items)
├── tblissue_sloc (issue SLOC detail)
├── tbl_stldg_good (stock ledger after issue)
├── tbl_warehouse (warehouse master)
├── tbl_bin (bin master)
├── tbl_subbin (sub-bin master)
└── tbl_roles (user info)
```

---

## 3. KEY FILES & AJAX CHAIN

```
User Pages:
  add_indents.php
    ↓ (Click Post)
  getuser_indentupdate.php [AJAX]
    → INSERT tbl_ieindent + tbl_ieindent_sub
    → Response: TRANSACTION_ID
    ↓ (JavaScript extracts ID)
  add_indents_preview.php
    → Displays all items
    ↓ (Final Submit)
  indexindet.php

Operator Pages:
  add_issue_indents1.php
    → List pending indents
    ↓ (Click Issue)
  add_issue_indents.php?tid=XX
    ↓ (Click Edit on line)
  getuser_issue_eindent_etd.php [AJAX]
    → Show SLOC options
    ↓ (User enters qty)
    ↓ (Click Post)
  getuser_issue_eindentedtupdate.php [AJAX]
    → INSERT tblissue + tblissue_sub + tblissue_sloc
    → Response: Updated table + TRANSACTION_ID
    ↓ (Click Preview)
  add_issue_eindents_preview.php?p_id=XX
    → Show all issues
    ↓ (Final Submit)
  Update tbl_stldg_good (stock ledger)
```

---

## 4. CRITICAL BUG PATTERNS TO AVOID

### ❌ Bug #1: isset() Comparison
```php
WRONG:  if(isset($_POST['field'])=='value')
FIXED:  if(isset($_POST['field']) && $_POST['field']=='value')
```

### ❌ Bug #2: Missing Hidden Fields in Form
```php
WRONG:  Form doesn't include ID for POST
FIXED:  Add <input type="hidden" name="p_id" value="<?php echo $pid?>" />
```

### ❌ Bug #3: Undefined Variables
```php
WRONG:  $remarks = $_GET['remarks'];  // May be undefined
        UPDATE ... WHERE ... remarks='$remarks'
        
FIXED:  $remarks = '';
        if(isset($_GET['remarks'])) { $remarks = $_GET['remarks']; }
        if($remarks != '') { /* UPDATE */ }
```

### ❌ Bug #4: Wrong User ID in Queries
```php
WRONG:  SELECT * FROM tbl_roles WHERE id='{$loginid}' (current operator)
FIXED:  SELECT * FROM tbl_roles WHERE id='{$creator_id}' (indent creator)
```

### ❌ Bug #5: Unintentional Data Deletion
```php
WRONG:  DELETE from table WHERE status=0
        Runs on EVERY page load

FIXED:  Only DELETE on specific user action
        Use conditional: if(isset($_POST['delete_confirm']))
```

### ❌ Bug #6: Missing AJAX Response ID Extraction
```php
WRONG:  AJAX response doesn't return ID
        Hidden form field stays 0
        
FIXED:  Embed ID in response: TRANSACTION_ID:{id}:END_TRANSACTION_ID
        JavaScript extracts: document.getElementById('field').value = id
```

---

## 5. VALIDATION RULES

### Creation Phase:
```
✓ Date required
✓ Classification required
✓ Item required
✓ Quantity > 0
✓ Quantity not starting with space
```

### Issue Phase:
```
✓ Date required
✓ At least 1 item must be posted
✓ Issue Quantity ≤ Available Quantity
✓ Balance quantities calculated correctly
✓ For each SLOC: balance validation
```

### Preview Phase:
```
✓ All items filled
✓ All values validated
✓ Remarks (optional) sanitized
```

---

## 6. IMPLEMENTATION CHECKLIST FOR NEW TRANSACTION

When creating new transaction, follow this:

- [ ] Create main table (tbl_{transaction})
- [ ] Create detail table (tbl_{transaction}_sub)
- [ ] Create line-by-line edit page: {transaction}_etd.php
- [ ] Create update handler: getuser_{transaction}update.php
- [ ] Create preview page: {transaction}_preview.php
- [ ] Implement AJAX ID extraction in JavaScript
- [ ] Add TRANSACTION_ID output in AJAX response
- [ ] Pass hidden ID field through forms
- [ ] Validate all isset() comparisons
- [ ] Test full workflow without operator involvement
- [ ] Test with operator role
- [ ] Test UPS > 1 scenarios
- [ ] Test QR scanning (if applicable)
- [ ] Test data persistence in database
- [ ] Check for unintended deletions
- [ ] Verify "Created By" shows correct person

---

## 7. COMMON PATTERNS

### Pattern 1: Form Submission with Hidden ID
```html
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type="hidden" name="frm_action" value="submit">
  <input type="hidden" name="p_id" value="<?php echo $p_id ?>">
  <!-- form fields -->
  <input type="submit" value="Submit">
</form>
```

### Pattern 2: AJAX with ID Response
```javascript
function stateChanged() {
  if(xmlHttp.readyState==4 && xmlHttp.status==200) {
    document.getElementById('div').innerHTML = xmlHttp.responseText;
    
    // Extract ID
    if(xmlHttp.responseText.indexOf('TRANSACTION_ID:') > -1) {
      var id = extractId(xmlHttp.responseText);
      document.getElementsByName('field_id')[0].value = id;
    }
  }
}
```

### Pattern 3: SQL Query Patterns
```sql
-- Get available stock
SELECT * FROM tbl_stldg_good 
WHERE stlg_tritemid='{item_id}' 
AND stlg_balqty > 0

-- Get transaction creator
SELECT name FROM tbl_roles WHERE id='{creator_id}'

-- Mark as completed
UPDATE tbl_transaction SET flg=1 WHERE tid='{id}'

-- Check for pending
SELECT * FROM tbl_transaction WHERE flg=0 AND yearcode='{year}'
```

---

## 8. UPS CALCULATION EXAMPLE

```
If UPS > 1:
  1 UPS = multiple pieces

SCENARIO: Shirts in packs of 5
  Available: 10 UPS = 50 shirts
  
  User wants: 15 shirts
  Input: 3 UPS (3 × 5 = 15 shirts)
  
  Balance: 10 - 3 = 7 UPS = 35 shirts
```

---

## 9. QR SCANNING FLOW (Optional)

```
1. Detect Classification Type
   AJAX: GET getuser_classtype.php?id={classid}
   Response: "Roll" or "Piece"

2. If Classification = "Roll":
   - Show QR Scanning UI
   - Setup MutationObserver for form changes
   - Listen to issueups field

3. On issueups Field Focus:
   - Open QR scanner window
   - User scans multiple QR codes
   - AJAX processing for each QR

4. Calculate Total Weight
   - Sum all scanned weights
   - Update issueqty field with total
   - Lock field (readonly)

5. Continue with normal flow
```

---

## 10. SECURITY NOTES

```
⚠️ CRITICAL: Currently using deprecated mysql_* functions
   → Need to migrate to mysqli_* or PDO with prepared statements
   
⚠️ SQL Injection risk in all queries with user input
   → Implement: mysqli_real_escape_string() or parameterized queries
   
⚠️ No input validation on user inputs
   → Add: trim(), type casting, range checks
   
⚠️ Remarks field allows special chars "&"
   → Currently replacing with "and"
   → Should use proper escaping
```

---

## USAGE

Use this template to create new transactions:
1. Read the workflow phases
2. Map your transaction to similar phases
3. Follow the database patterns
4. Avoid the bug patterns listed
5. Use the implementation checklist
6. Test thoroughly at each phase

