# QR Code Scanning for Issue Indents - Testing Checklist

## Complete Workflow Testing

### Test Setup
- **Browser**: Chrome, Firefox, or Edge with Developer Console (F12)
- **Database**: storesd MySQL with classification_id=99 (Roll Brinjal, type="Roll")
- **URL**: http://your-server/stores-main/Transaction/add_issue_indents.php?tid=1

---

## Phase 1: Yellow Button Appearance ✓ CRITICAL

**Requirement**: When user enters UPS value > 0 in any issueups column for Roll classification, yellow "→ Scan QR" link should appear immediately.

### Steps:
1. Open Browser Console (F12)
2. Navigate to add_issue_indents.php?tid=1
3. Click **EDIT** button on a **"Roll Brinjal"** row (classification_id=99)
4. Watch Console - should see:
   ```
   QR Debug: classId = 99 , itemId = 445
   QR Debug: Classification type received: Roll
   QR Debug: Classification is Roll! Setting up UI...
   QR Debug: Event delegation setup complete
   ```
5. Enter a number (e.g., **3**) in the **UPS** column
6. **Expected**: Yellow box appears immediately with "→ Scan QR" link

**Troubleshooting**:
- If no yellow box: Check Console for errors
- If button doesn't appear on keyup: Check that field name matches pattern `issueups_*`
- Use Console command: `document.querySelectorAll('input[name^="issueups_"]')` to verify fields exist

---

## Phase 2: QR Scanning Popup ✓ HIGH PRIORITY

**Requirement**: Click "→ Scan QR" link should open popup with QR scanning interface.

### Steps:
1. (From Phase 1) After yellow button appears, click **"→ Scan QR"** link
2. **Expected**: New popup window opens showing:
   - Classification: "Roll Brinjal"
   - Item: (from row)
   - Total UPS: 3 (matching entered value)
   - Table with 3 empty rows for scanning QR codes
   - "Scan New QR", "Submit", "Cancel" buttons

**Troubleshooting**:
- No popup opens: Check browser popup blocker
- Popup URL wrong: Verify openQRScanInterface() is using correct parameters
- Check Console log: `QR Debug: Opening QR scan with classification_id: 99`

---

## Phase 3: QR Code Validation ✓ CORE FEATURE

**Requirement**: Each scanned QR code should be validated in real-time.

### Test Data (Use these QR codes):
- Only 8 finalized QR codes available in database
- QR codes for testing: D26271100052, D26271100053, D26271100054
- Expected: classification_id=96, item_id=79, weights: 2.00, 3.00, 1.00 kg

### Steps:
1. In QR popup, Enter **D26271100052** in first row
2. **Expected**: 
   - ✓ Row shows: QID, Weight (2.00), Classification, Item
   - ✓ Next row auto-focused for next scan
3. Enter **D26271100053** in second row
   - **Expected**: Weight 3.00 populated
4. Enter **D26271100054** in third row
   - **Expected**: Weight 1.00 populated

**Validation Rules**:
- ✓ QR code exists in database
- ✓ Classification matches selected (ID 96)
- ✓ Item matches selected (ID 79)
- ✓ QR is finalized (finalsubmit=1)
- ✓ QR not already used in another issue

**Troubleshooting**:
- "Not found" error: Check QR code spelling
- "Classification mismatch": QR belongs to different classification
- "Item mismatch": QR belongs to different item
- "Already used": QR was linked to another issue

---

## Phase 4: Weight Calculation ✓ CRITICAL

**Requirement**: Total weight of all scanned QRs should be calculated correctly.

### Steps:
1. After scanning all 3 QRs from Phase 3:
   - D26271100052: 2.00 kg
   - D26271100053: 3.00 kg
   - D26271100054: 1.00 kg
2. **Expected**: Total = **6.00 kg**
3. In popup, verify "Total Weight: 6.00" is displayed

**Troubleshooting**:
- Wrong total: Verify each QR's weight in scan_qrcode_indent.php
- Missing weights: Check that responseJson includes "weight" field
- Math error: Check calculateTotalWeight() function in popup

---

## Phase 5: Quantity Field Population ✓ CRITICAL

**Requirement**: After clicking "Submit" in popup, quantity field should auto-populate with total weight and lock.

### Steps:
1. In QR popup, click **"Submit"** button (after all 3 QRs scanned)
2. **Expected**:
   - Popup closes automatically
   - Back to main form
   - **issueqty field shows: 6.00**
   - **issueqty field is locked (readonly)**
   - **issueqty field has yellow background (#ffffcc)**
3. Also see alert: "QR codes scanned successfully! Total Weight: 6.00"

**Troubleshooting**:
- Popup doesn't close: Check submit button logic
- Quantity field not filled: Verify setQRTotalWeight() is being called
- Field not locked: Check readOnly property assignment
- Field not highlighted: Check style.backgroundColor assignment

---

## Phase 6: Verify No Errors ✓ MUST-HAVE

**Requirement**: Console should show no JavaScript errors.

### Steps:
1. Open Console (F12)
2. Go through Phases 1-5
3. **Expected**: No red error messages
4. Allowed messages: "QR Debug: ..." (blue console logs)

**Common Issues**:
- "issueups is not defined": Field naming mismatch - check pattern
- "setQRTotalWeight is not a function": Function not defined in main page
- "MutationObserver error": Browser doesn't support (unlikely on modern browsers)

---

## Phase 7: Multiple Rows Testing ✓ ADVANCED

**Requirement**: System should handle multiple UPS fields in same edit session.

### Steps:
1. Edit same Roll Brinjal row again
2. Enter different UPS values in multiple rows:
   - Row 1: UPS = 2
   - Row 2: UPS = 4  
   - Row 3: UPS = 1
3. Each row should get its own yellow "→ Scan QR" button
4. Clicking any button should open popup with that row's UPS count
5. After scanning weight from popup, it should populate that specific row's quantity field

**Troubleshooting**:
- Only first button appears: Event delegation not working properly
- Wrong popup UPS count: openQRScanInterface() using wrong row number
- Wrong quantity field filled: setQRTotalWeight() updating wrong field

---

## Phase 8: Non-Roll Classifications ✓ SAFETY CHECK

**Requirement**: Yellow button should NOT appear for non-Roll classifications.

### Steps:
1. Edit a row with classification_type ≠ "Roll" (e.g., Pouch, Sticker)
2. Enter UPS value > 0
3. **Expected**: NO yellow button appears
4. Console should show: "QR Debug: Classification is NOT Roll, hiding QR UI"

**Note**: This ensures feature only active for Roll classification as designed.

---

## Database Verification

### Required Data Exists:
```sql
-- Check Roll classification
SELECT classification_id, classification, classification_type 
FROM tbl_classification WHERE classification_type='Roll';
-- Expected: Should show classification_id=99 (Roll Brinjal)

-- Check finalized QR codes  
SELECT qr_code_text, classification_id, item_id, weight 
FROM tbl_qr_codes WHERE finalsubmit=1;
-- Expected: Should show at least 6 QR codes

-- Check Issue Indent data
SELECT * FROM tblissue WHERE issue_type='eindent' LIMIT 2;
-- Expected: Should have rows with classification_id, item_id
```

---

## Files Modified/Created

1. **add_issue_indents.php** - Modified main page
   - MutationObserver for form detection
   - Event delegation for issueups_* fields
   - QR GUI setup and weight callback

2. **scan_qrcode_indent.php** - NEW
   - QR scanning popup interface
   - Dynamic row generation based on UPS count
   - Real-time QR validation via AJAX

3. **fetch_qr_details_indent.php** - NEW
   - QR validation backend
   - 5-point validation check
   - Returns weight and metadata

4. **getuser_issueindent_classtype.php** - NEW
   - Fetches classification_type from database
   - Used to determine if feature should activate

---

## Performance Notes

- All JavaScript vanilla (no jQuery dependency)
- Event delegation keeps memory footprint low
- XMLHttpRequest fires only when needed (classification check + QR validation)
- MutationObserver disabled after first form load

---

## Next Steps If Issues Found

1. **Yellow button not appearing**: Check Console for "ERROR - No issueups_* fields found" → Fix field naming
2. **Popup not opening**: Check popup blocker → Verify openQRScanInterface() parameters
3. **QR validation failing**: Check fetch_qr_details_indent.php - verify 5-point validation
4. **Weight not populating**: Check setQRTotalWeight() - verify field naming and readonly assignment
5. **Multiple issues**: Enable ALL console logs, follow step-by-step, capture exact error messages

---

## Success Criteria

✅ Yellow button appears 1-2 seconds after entering UPS > 0  
✅ Click button opens QR scanning popup  
✅ Scanned QRs validate and show weight  
✅ Total weight calculates correctly  
✅ Popup closes after submit  
✅ Quantity field auto-populated with total weight  
✅ Quantity field is locked/readonly  
✅ Multiple rows each get their own button  
✅ Non-Roll classifications don't show button  
✅ Console shows no errors (only debug logs)

---

**Created**: $(date)  
**Status**: Ready for Testing  
**Tested By**: [Your Name]  
**Date Tested**: ___________  
**Result**: ☐ PASS ☐ FAIL ☐ PARTIAL
