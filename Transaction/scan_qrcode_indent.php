<?php
session_start();
if(!isset($_SESSION['sessionadmin']))
{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "alert('Session expired. Please login again.'); window.location='../login.php'; ";
	echo '</script>';
	exit;
}

require_once("../include/config.php");
require_once("../include/connection.php");

$classification_id = isset($_GET['classification_id']) ? trim($_GET['classification_id']) : '';
$item_id = isset($_GET['item_id']) ? trim($_GET['item_id']) : '';
$ups = isset($_GET['ups']) ? trim($_GET['ups']) : 0;

// Validate parameters
if(empty($classification_id) || empty($item_id) || !is_numeric($classification_id) || !is_numeric($item_id) || !is_numeric($ups) || $ups <= 0)
{
	echo '<script>alert("Invalid parameters"); window.close();</script>';
	exit;
}

// Fetch classification details
$sql_class = "SELECT classification, classification_type FROM tbl_classification WHERE classification_id='$classification_id' LIMIT 1";
$result_class = mysql_query($sql_class) or die("Error: " . mysql_error());

if(mysql_num_rows($result_class) == 0)
{
	echo '<script>alert("Classification not found"); window.close();</script>';
	exit;
}

$row_class = mysql_fetch_array($result_class);
$classification_name = $row_class['classification'];
$classification_type = $row_class['classification_type'];

// Fetch item details
$sql_item = "SELECT stores_item, uom FROM tbl_stores WHERE items_id='$item_id' LIMIT 1";
$result_item = mysql_query($sql_item) or die("Error: " . mysql_error());

if(mysql_num_rows($result_item) == 0)
{
	echo '<script>alert("Item not found"); window.close();</script>';
	exit;
}

$row_item = mysql_fetch_array($result_item);
$item_name = $row_item['stores_item'];
$uom = $row_item['uom'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Scan QR Codes - Issue Indent</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css">
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	background-color: #f5f5f5;
	padding: 15px;
}

.qr-container {
	max-width: 1000px;
	margin: 0 auto;
	background: white;
	padding: 20px;
	border-radius: 3px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

h2 {
	color: #003333;
	font-size: 18px;
	margin-bottom: 15px;
	padding-bottom: 10px;
	border-bottom: 2px solid #4ea1e1;
}

/* Info Section - Same style as Vendor/Generate QR */
.info-section {
	background: #f0f7ff;
	border: 1px solid #4ea1e1;
	padding: 15px;
	margin: 15px 0;
	border-radius: 3px;
}

.info-section h3 {
	color: #003333;
	margin-bottom: 10px;
	font-size: 13px;
}

.info-row {
	display: flex;
	gap: 20px;
	margin: 8px 0;
	font-size: 12px;
}

.info-label {
	font-weight: bold;
	width: 150px;
	color: #003333;
	min-width: 150px;
}

.info-value {
	color: #333;
	flex: 1;
}

.value-badge {
	display: inline-block;
	background: white;
	color: #4ea1e1;
	padding: 5px 12px;
	border: 2px solid #4ea1e1;
	border-radius: 3px;
	font-weight: bold;
	font-size: 12px;
}

/* Instructions Box */
.instructions-box {
	background: #e7f3ff;
	border: 1px solid #b3d9ff;
	border-radius: 3px;
	padding: 15px;
	margin: 15px 0;
	font-size: 12px;
	color: #333;
}

.instructions-box strong {
	color: #003333;
	display: block;
	margin-bottom: 8px;
}

/* Table Section */
.qr-table-section {
	margin: 20px 0;
	background: white;
	border: 1px solid #4ea1e1;
	border-radius: 3px;
	overflow: hidden;
}

.qr-table-header {
	background: #4ea1e1;
	color: white;
	padding: 12px 15px;
	font-weight: bold;
	font-size: 13px;
}

.qr-table {
	width: 100%;
	border-collapse: collapse;
	background: white;
}

.qr-table thead {
	background: #4ea1e1;
	color: white;
}

/* Extended Table Columns */
.qr-table th {
	padding: 8px 5px;
	text-align: center;
	font-weight: bold;
	border: 1px solid #4ea1e1;
	font-size: 11px;
}

.qr-table td {
	padding: 8px 5px;
	border: 1px solid #ddd;
	text-align: center;
	font-size: 11px;
}

.qr-table tbody tr:nth-child(even) {
	background: #f9f9f9;
}

.qr-table tbody tr:hover {
	background: #f0f7ff;
}

.qr-row-number {
	font-weight: bold;
	color: #4ea1e1;
	font-size: 13px;
}

.qr-code-input {
	text-align: left;
}

.qr-code-input input {
	width: 100%;
	padding: 7px;
	border: 1px solid #ccc;
	border-radius: 2px;
	font-family: 'Courier New', monospace;
	font-size: 12px;
}

.qr-code-input input:focus {
	outline: none;
	border: 2px solid #4ea1e1;
	background-color: #fffacd;
	box-shadow: 0 0 5px rgba(78, 161, 225, 0.3);
}

.qr-status {
	font-size: 11px;
	padding: 3px 5px;
	border-radius: 2px;
}

.qr-status.waiting {
	color: #999;
	font-style: italic;
}

.qr-status.valid {
	color: #155724;
	background: #d4edda;
	font-weight: bold;
	padding: 5px 8px;
	border-radius: 3px;
}

.qr-status.error {
	color: #721c24;
	background: #f8d7da;
	font-weight: bold;
	padding: 5px 8px;
	border-radius: 3px;
}

.qr-weight-input {
	width: 100%;
	padding: 7px;
	border: 1px solid #ccc;
	border-radius: 2px;
	background: #f5f5f5;
	text-align: center;
	font-weight: bold;
	color: #4ea1e1;
}

/* Message Boxes */
.success-message {
	background: #d4edda;
	color: #155724;
	border: 1px solid #c3e6cb;
	padding: 15px;
	margin: 15px 0;
	border-radius: 3px;
	display: none;
}

.success-message.show {
	display: block;
}

.error-message {
	background: #f8d7da;
	color: #721c24;
	border: 1px solid #f5c6cb;
	padding: 15px;
	margin: 15px 0;
	border-radius: 3px;
	display: none;
}

.error-message.show {
	display: block;
}

/* Button Styles - Matching Vendor Design */
.button-group {
	text-align: center;
	margin: 20px 0;
	padding: 15px;
	background: #f9f9f9;
	border-top: 1px solid #eee;
	border-radius: 0 0 3px 3px;
}

.btn {
	padding: 10px 25px;
	margin: 5px;
	cursor: pointer;
	border: none;
	border-radius: 3px;
	font-size: 13px;
	font-weight: bold;
	transition: background-color 0.2s ease;
}

.btn-primary {
	background: #4ea1e1;
	color: white;
}

.btn-primary:hover {
	background: #2c6a9e;
}

.btn-cancel {
	background: #6c757d;
	color: white;
}

.btn-cancel:hover {
	background: #5a6268;
}
</style>
<script type="text/javascript" src="../include/jquery.js"></script>
</head>
<body>

<div class="qr-container">
	<h2>QR Code Scanning - Issue Indent</h2>
	
	<!-- Item Details Section - Vendor Style -->
	<div class="info-section">
		<h3>Item Details</h3>
		<div class="info-row">
			<div class="info-label">Classification:</div>
			<div class="info-value"><?php echo htmlspecialchars($classification_name); ?></div>
		</div>
		<div class="info-row">
			<div class="info-label">Item:</div>
			<div class="info-value"><?php echo htmlspecialchars($item_name); ?></div>
		</div>
		<div class="info-row">
			<div class="info-label">Unit of Measurement:</div>
			<div class="info-value"><?php echo htmlspecialchars($uom); ?></div>
		</div>
	</div>

	<!-- Success/Error Messages -->
	<div id="success-message" class="success-message">✓ QR codes submitted successfully!</div>
	<div id="error-message" class="error-message"></div>

	<!-- QR Scanning Table -->
	<div class="qr-table-section">
		<div class="qr-table-header">QR Code Scanning - Scan codes</div>
        
		
		<form id="qr-scan-form" name="qr-scan-form">
			<input type="hidden" name="classification_id" value="<?php echo htmlspecialchars($classification_id); ?>" />
			<input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item_id); ?>" />
			<input type="hidden" name="ups" value="<?php echo htmlspecialchars($ups); ?>" />
			
			<table class="qr-table" style="font-size: 11px;">
				<thead>
					<tr>
						<th width="5%">SR</th>
						<th width="25%">QR Code Text</th>
						<th width="35%">Item Name</th>
						<th width="12%">Weight (kg)</th>
						<th width="23%">Generated Date</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for($i = 1; $i <= $ups; $i++)
					{
						?>
						<tr id="qr-row-<?php echo $i; ?>" class="qr-row">
							<td>
								<strong class="qr-row-number"><?php echo $i; ?></strong>
								<input type="hidden" name="sr_no[]" value="<?php echo $i; ?>" />
							</td>
							<td class="qr-code-input">
								<input type="text" 
									   name="qr_code[]" 
									   id="qr_input_<?php echo $i; ?>" 
									   class="qr-input-field" 
									   data-row="<?php echo $i; ?>" 
									   onkeyup="handleQRKeyup(<?php echo $i; ?>, this.value)" 
									   placeholder="Scan QR code..." 
									   autocomplete="off" 
									   style="font-size: 10px; padding: 5px; width: 100%; font-family: monospace; font-weight: bold;" />
							</td>
							<td id="name_<?php echo $i; ?>" style="font-size: 10px; padding: 5px;">
								<span style="color: #999;">-</span>
							</td>
							<td id="weight_<?php echo $i; ?>" style="font-size: 10px; padding: 5px; text-align: center; font-weight: bold; color: #4ea1e1;">
								<span>-</span>
							</td>
							<td id="generated_date_<?php echo $i; ?>" style="font-size: 9px; padding: 5px;">
								<span style="color: #999;">-</span>
							</td>
							
							<!-- Hidden fields for storing QR ID -->
							<input type="hidden" id="qr_id_hidden_<?php echo $i; ?>" name="qr_id[]" value="" />
							<input type="hidden" id="weight_hidden_<?php echo $i; ?>" name="weight_hidden[]" value="" />
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</form>
	</div>

	<!-- Action Buttons -->
	<div class="button-group">
		<button class="btn btn-primary" onclick="submitQRData()">✓ Submit QR Codes</button>
		<button class="btn btn-cancel" onclick="window.close()">✕ Cancel</button>
	</div>
</div>

<script type="text/javascript">
var classificationId = '<?php echo htmlspecialchars($classification_id); ?>';
var itemId = '<?php echo htmlspecialchars($item_id); ?>';
var upsCount = <?php echo intval($ups); ?>;
var qrCodesEntered = {};

// Inline keyup handler (fallback for jQuery compatibility)
function handleQRKeyup(rowNum, qrValue) {
	qrValue = (qrValue || '').trim();
	if(qrValue.length >= 12) {
		validateQRCode(rowNum, qrValue);
	}
}

// Setup focus on first input
window.onload = function() {
	var firstInput = document.getElementById('qr_input_1');
	if(firstInput) {
		firstInput.focus();
	}
};

function validateQRCode(rowNum, qrValue) {
	// Only proceed if QR code is at least 12 characters
	if(qrValue.length < 12) {
		// Clear this row's data if user is still typing
		jQuery('#name_' + rowNum).html('<span style="color: #999;">-</span>');
		jQuery('#weight_' + rowNum).html('<span style="color: #999;">-</span>');
		jQuery('#generated_date_' + rowNum).html('<span style="color: #999;">-</span>');
		jQuery('#qr_id_hidden_' + rowNum).val('');
		jQuery('#weight_hidden_' + rowNum).val('');
		return;
	}
	
	// Check for duplicates using vanilla JavaScript
	var isDuplicate = false;
	var allInputs = document.querySelectorAll('.qr-input-field');
	for(var i = 0; i < allInputs.length; i++) {
		var inputValue = allInputs[i].value.trim();
		var inputRowNum = parseInt(allInputs[i].getAttribute('data-row'));
		
		// If not the current row AND value matches current QR
		if(inputRowNum != rowNum && inputValue === qrValue && inputValue !== '') {
			isDuplicate = true;
			break;
		}
	}
	
	if(isDuplicate) {
		jQuery('#name_' + rowNum).html('❌ Duplicate QR!');
		jQuery('#weight_' + rowNum).html('-');
		jQuery('#generated_date_' + rowNum).html('-');
		jQuery('#error-message').html('❌ Duplicate QR code! This QR was already scanned.').addClass('show');
		return;
	}
	
	// Fetch QR details from server
	jQuery.ajax({
		url: 'fetch_qr_details_indent.php',
		type: 'GET',
		data: {
			qrcode: qrValue,
			classification_id: classificationId,
			item_id: itemId
		},
		dataType: 'json',
		timeout: 5000,
		success: function(response) {
			if(response.success) {
				// Get classification and item names from page data
				var classificationName = '<?php echo htmlspecialchars($classification_name); ?>';
				var itemName = '<?php echo htmlspecialchars($item_name); ?>';
				var combinedName = classificationName + ' - ' + itemName;
				
				// Display data immediately
				jQuery('#name_' + rowNum).html('<strong style="color: #003333;">' + combinedName + '</strong>');
				jQuery('#weight_' + rowNum).html('<span style="color: #4ea1e1; font-weight: bold;">' + (response.weight || '-') + '</span>');
				jQuery('#generated_date_' + rowNum).html('<span style="color: #333;">' + (response.generated_date || '-') + '</span>');
				
				// Store hidden values for submission
				jQuery('#qr_id_hidden_' + rowNum).val(response.qr_id || '');
				jQuery('#weight_hidden_' + rowNum).val(response.weight || '');
				
				// Store QR code details
				qrCodesEntered[rowNum] = {
					qr: qrValue,
					weight: response.weight,
					qr_id: response.qr_id,
					arrival_id: response.arrival_id,
					classification_id: response.classification_id,
					item_id: response.item_id,
					arrsub_id: response.arrsub_id,
					arrivalweight: response.arrivalweight,
					generated_date: response.generated_date,
					linked_status: response.linked_status,
					created_by: response.created_by,
					finalsubmit: response.finalsubmit,
					used: response.used
				};
				
				jQuery('#error-message').removeClass('show');
				
				// Move focus to next input
				if(rowNum < upsCount) {
					setTimeout(function() {
						jQuery('#qr_input_' + (parseInt(rowNum) + 1)).focus();
					}, 300);
				}
			} else {
				jQuery('#name_' + rowNum).html('❌ ' + response.message);
				jQuery('#weight_' + rowNum).html('-');
				jQuery('#generated_date_' + rowNum).html('-');
				jQuery('#error-message').html('❌ Row ' + rowNum + ': ' + response.message).addClass('show');
			}
		},
		error: function(xhr, status, error) {
			jQuery('#name_' + rowNum).html('❌ Error');
			jQuery('#weight_' + rowNum).html('-');
			jQuery('#generated_date_' + rowNum).html('-');
			jQuery('#error-message').html('❌ Row ' + rowNum + ': Server error - ' + error).addClass('show');
			console.log('AJAX Error:', xhr.responseText);
		}
	});
}

function showError(message, rowNum) {
	jQuery('#qr_input_' + rowNum).css('border', '2px solid #721c24').css('background-color', '#f8d7da');
	jQuery('#error-message').html('❌ ' + message).addClass('show');
	jQuery('#qr_input_' + rowNum).focus().select();
}

function showSuccess(message, rowNum) {
	jQuery('#qr_input_' + rowNum).css('border', '2px solid #155724').css('background-color', '#fffacd');
	jQuery('#error-message').removeClass('show');
}

function validateTable() {
	var allFilled = true;
	var qrArray = [];
	var allInputs = document.querySelectorAll('.qr-input-field');
	
	for(var i = 0; i < allInputs.length; i++) {
		var qrValue = allInputs[i].value.trim();
		var rowNum = parseInt(allInputs[i].getAttribute('data-row'));
		
		if(qrValue === '' || qrValue.length === 0) {
			allFilled = false;
			jQuery('#qr_input_' + rowNum).css('border', '2px solid #721c24').css('background-color', '#f8d7da');
			break;
		}
		
		// Check for duplicates
		if(qrArray.indexOf(qrValue) !== -1) {
			allFilled = false;
			jQuery('#qr_input_' + rowNum).css('border', '2px solid #721c24').css('background-color', '#f8d7da');
			break;
		}
		qrArray.push(qrValue);
		
		// Check if weight was populated
		var weight = jQuery('#weight_hidden_' + rowNum).val();
		if(weight === '' || weight === '-') {
			allFilled = false;
			jQuery('#qr_input_' + rowNum).css('border', '2px solid #721c24').css('background-color', '#f8d7da');
			break;
		}
	}
	
	if(!allFilled) {
		jQuery('#error-message').html('❌ <strong>Validation Error:</strong> All QR codes must be scanned and show valid data.').addClass('show');
		return false;
	}
	
	return true;
}

function calculateTotalWeight() {
	var totalWeight = 0;
	for(var i = 1; i <= upsCount; i++) {
		var weight = jQuery('#weight_hidden_' + i).val();
		var numWeight = parseFloat(weight) || 0;
		totalWeight += numWeight;
	}
	return totalWeight;
}

// Synchronous XMLHttpRequest function to mark QR codes as used
function markQRCodesAsUsed(qrIdsArray) {
	if(!qrIdsArray || qrIdsArray.length === 0) {
		console.log('No QR IDs to mark');
		return;
	}
	
	try {
		var xhr = new XMLHttpRequest();
		
		// Build POST data
		var postData = 'qr_ids[]=' + qrIdsArray.join('&qr_ids[]=');
		console.log('Sending POST data:', postData);
		
		// Open synchronously
		xhr.open('POST', './mark_qr_used_indent.php', false);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		// Send the request
		xhr.send(postData);
		
		// Check response
		console.log('Response Status:', xhr.status);
		console.log('Response Text:', xhr.responseText);
		
		if(xhr.status === 200) {
			try {
				var response = JSON.parse(xhr.responseText);
				if(response.success === true) {
					console.log('✓✓✓ SUCCESS! Marked', response.marked_count, 'QR codes as used=1');
					jQuery('#success-message').html('✓✓✓ QR codes marked as USED=1 in database!');
					return true;
				} else {
					console.log('✗ Server returned success=false:', response.message);
					console.log('Details:', response);
				}
			} catch(e) {
				console.log('✗ Could not parse JSON response:', e);
				console.log('Raw response was:', xhr.responseText);
			}
		} else {
			console.log('✗ HTTP Error:', xhr.status, xhr.statusText);
		}
	} catch(e) {
		console.log('✗ XMLHttpRequest error:', e);
	}
	
	return false;
}

function submitQRData() {
	console.log('╔════════════════════════════════════════════════════╗');
	console.log('║  SUBMIT QR DATA FUNCTION CALLED                    ║');
	console.log('╚════════════════════════════════════════════════════╝');
	
	// Validate all QRs are filled
	if(!validateTable()) {
		console.log('❌ Validation failed');
		return;
	}
	
	// Calculate total weight
	var totalWeight = calculateTotalWeight();
	
	if(totalWeight === 0) {
		jQuery('#error-message').html('❌ Total weight is 0. Please check QR codes.').addClass('show');
		return;
	}
	
	// Collect QR IDs to mark as used
	var qrIdsToMark = [];
	for(var rowNum = 1; rowNum <= upsCount; rowNum++) {
		var qrId = jQuery('#qr_id_hidden_' + rowNum).val();
		if(qrId && qrId !== '') {
			qrIdsToMark.push(qrId);
		}
	}
	
	console.log('✓ QR IDs collected:', qrIdsToMark);
	
	// Mark QR codes as used in database - SYNCHRONOUSLY (async: false)
	if(qrIdsToMark.length > 0) {
		var markedSuccessfully = false;
		console.log('📤 Sending AJAX to mark_qr_used_indent.php with', qrIdsToMark.length, 'QR IDs');
		
		jQuery.ajax({
			url: './mark_qr_used_indent.php',  // Current directory path
			type: 'POST',
			dataType: 'json',
			data: jQuery.param({qr_ids: qrIdsToMark}),  // Better serialization
			async: false, // CRITICAL: Wait for completion
			cache: false,
			timeout: 10000,
			success: function(response) {
				console.log('✓ AJAX Success Response:', response);
				if(response && response.success === true) {
					console.log('✓✓✓ SUCCESS! QR codes marked as used=1! Count:', response.marked_count);
					markedSuccessfully = true;
				} else {
					console.log('✗ Failed response. Response details:', response);
				}
			},
			error: function(xhr, status, error) {
				console.log('✗ AJAX Error!');
				console.log('✗ Status:', status);
				console.log('✗ Error:', error);
				console.log('✗ HTTP Status Code:', xhr.status);
				console.log('✗ Response Text:', xhr.responseText);
				// Parse response if it's JSON error
				try {
					var jsonResponse = jQuery.parseJSON(xhr.responseText);
					console.log('✗ Parsed Error JSON:', jsonResponse);
				} catch(e) {
					console.log('✗ Could not parse error response');
				}
			}
		});
		
		if(markedSuccessfully) {
			console.log('✓✓✓ CONFIRMED: QR codes successfully marked as used=1 in database!');
			jQuery('#success-message').html('✓✓✓ QR codes marked as USED in database!');
		} else {
			console.log('⚠ Warning: Could not confirm QR marking in database');
		}
	}
	
	// Show success message
	jQuery('#error-message').removeClass('show');
	jQuery('#success-message').addClass('show');
	
	// Return data to parent window
	setTimeout(function() {
		var qrIdList = [];
		
		// Collect all QR IDs that were scanned
		for(var rowNum = 1; rowNum <= upsCount; rowNum++) {
			var qrId = jQuery('#qr_id_hidden_' + rowNum).val();
			if(qrId && qrId !== '') {
				qrIdList.push(qrId);
			}
		}
		
		// Try to call the appropriate callback based on which page is calling
		if(window.opener && typeof window.opener.setQRTotalWeightEdit === 'function') {
			// Called from SLOC edit page - pass QR IDs along with weight
			window.opener.setQRTotalWeightEdit(totalWeight, qrIdList);
			window.close();
		} else if(window.opener && typeof window.opener.setQRTotalWeight === 'function') {
			// Called from main physical indent form - pass QR IDs along with weight
			window.opener.setQRTotalWeight(totalWeight, qrIdList);
			window.close();
		} else {
			// Fallback to sessionStorage
			try {
				sessionStorage.setItem('qr_total_weight_indent', totalWeight);
				sessionStorage.setItem('qr_total_weight_timestamp', Date.now());
				sessionStorage.setItem('qr_ids_indent', qrIdList.join(','));
				window.close();
			} catch(e) {
				alert('Error: Could not return data to parent window. Please try again.');
				console.log('SessionStorage error:', e);
			}
		}
	}, 800);
}

// Close on ESC key
document.onkeydown = function(e) {
	if(e.keyCode === 27) { // ESC
		if(confirm('Are you sure you want to close without submitting?')) {
			window.close();
		}
	}
};
</script>

</body>
</html>
<?php
?>
