<?php
session_start();
if(!isset($_SESSION['sessionadmin']))
{
	header('Content-Type: application/json');
	echo json_encode(['success' => false, 'message' => 'Session expired']);
	exit;
}

require_once("../include/config.php");
require_once("../include/connection.php");

$username = $_SESSION['username'];

// Validate POST data
if($_SERVER['REQUEST_METHOD'] != 'POST') {
	header('Content-Type: application/json');
	echo json_encode(['success' => false, 'message' => 'Invalid request method']);
	exit;
}

// Get parameters
$arrival_id = isset($_POST['arrival_id']) ? intval($_POST['arrival_id']) : 0;
$arrsub_id = isset($_POST['arrsub_id']) ? intval($_POST['arrsub_id']) : 0;
$classification_id = isset($_POST['classification_id']) ? intval($_POST['classification_id']) : 0;
$item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
$total_weight = isset($_POST['total_weight']) ? floatval($_POST['total_weight']) : 0;

// Validate required parameters
if($classification_id == 0 || $item_id == 0) {
	header('Content-Type: application/json');
	echo json_encode(['success' => false, 'message' => 'Missing required parameters: classification or item']);
	exit;
}

// NOTE: arrival_id and arrsub_id will remain 0 until item is posted
// After item posting, getuser_vupdateform.php will update them

// Collect all QR codes and weights
$qr_count = 0;
$success_count = 0;
$error_messages = array();

$counter = 1;
while(isset($_POST['qr_text_' . $counter])) {
	$qr_text = trim($_POST['qr_text_' . $counter]);
	$weight = isset($_POST['qr_weight_' . $counter]) ? floatval($_POST['qr_weight_' . $counter]) : 0;
	
	if($qr_text && $weight > 0) {
		$qr_count++;
		
		// Escape user input to prevent SQL injection
		$qr_text_escaped = mysql_real_escape_string($qr_text);
		$username_escaped = mysql_real_escape_string($username);
		
		// Build INSERT query
		$sql_insert = "INSERT INTO tbl_qr_codes (
			arrival_id,
			classification_id,
			item_id,
			arrsub_id,
			qr_code_text,
			weight,
			arrivalweight,
			linked_status,
			finalsubmit,
			created_by
		) VALUES (
			'$arrival_id',
			'$classification_id',
			'$item_id',
			'$arrsub_id',
			'$qr_text_escaped',
			'$weight',
			'$weight',
			'draft',
			0,
			'$username_escaped'
		)";
		
		$result = mysql_query($sql_insert);
		if($result) {
			$success_count++;
		} else {
			$db_error = mysql_error();
			error_log("QR Save Error - Query: $sql_insert | DB Error: $db_error");
			$error_messages[] = "Error inserting QR: $qr_text - " . $db_error;
		}
	}
	
	$counter++;
}

// Prepare response
header('Content-Type: application/json');

// Debug logging
error_log("QR Save Report - Total: $qr_count | Success: $success_count | Errors: " . count($error_messages));

if($qr_count == 0) {
	// No valid QR codes found in POST
	echo json_encode([
		'success' => false,
		'message' => 'No valid QR codes found. Please fill all weights.',
		'count' => 0,
		'total' => 0
	]);
} elseif($success_count == $qr_count && $qr_count > 0) {
	echo json_encode([
		'success' => true,
		'message' => 'All ' . $success_count . ' QR codes saved successfully',
		'count' => $success_count,
		'total_weight' => $total_weight
	]);
} else {
	echo json_encode([
		'success' => false,
		'message' => 'Error saving QR codes. Saved: ' . $success_count . '/' . $qr_count,
		'count' => $success_count,
		'total' => $qr_count,
		'errors' => $error_messages
	]);
}

exit;
?>
