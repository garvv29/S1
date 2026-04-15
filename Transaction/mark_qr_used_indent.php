<?php
session_start();

// Detailed logging
error_log("=== mark_qr_used_indent.php called ===");
error_log("Request method: " . $_SERVER['REQUEST_METHOD']);
error_log("Session admin check: " . (isset($_SESSION['sessionadmin']) ? 'YES' : 'NO'));

if(!isset($_SESSION['sessionadmin']))
{
	error_log("ERROR: Session admin not set!");
	header('Content-Type: application/json');
	echo json_encode(array('success' => false, 'message' => 'Unauthorized - No session'));
	exit;
}

require_once("../include/config.php");
require_once("../include/connection.php");

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');

$response = array('success' => false, 'message' => 'Invalid request');

error_log("POST data received: " . json_encode($_POST));

// Handle both formats: jQuery.param({qr_ids: [...]}) and qr_ids[]= parameters
$qr_ids = array();
if(isset($_POST['qr_ids']))
{
	if(is_array($_POST['qr_ids']))
	{
		$qr_ids = $_POST['qr_ids']; // jQuery.param format OR array format
	}
	else
	{
		$qr_ids = array($_POST['qr_ids']); // Single value
	}
}

error_log("QR IDs array type: " . gettype($qr_ids) . ", count: " . count($qr_ids));
error_log("QR IDs content: " . json_encode($qr_ids));

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($qr_ids))
{
	// Process the QR IDs
	
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'System';
	$marked_count = 0;
	$error_details = array();
	
	foreach($qr_ids as $qr_id)
	{
		$qr_id = trim($qr_id);
		if(empty($qr_id) || !is_numeric($qr_id))
		{
			$error_details[] = "Invalid QR ID: $qr_id";
			continue;
		}
		
		// Update tbl_qr_codes to mark as used and record scan datetime
		$sql_update = "UPDATE tbl_qr_codes 
						SET used=1, linked_status='used', scandate=NOW() 
						WHERE qr_id='$qr_id'";
		
		// Log query for debugging
		error_log("QR Update Query: $sql_update");
		
		$result = mysql_query($sql_update);
		
		if(!$result)
		{
			$error_details[] = "Database error for QR ID $qr_id: " . mysql_error();
			continue;
		}
		
		$affected = mysql_affected_rows();
		if($affected > 0)
		{
			$marked_count++;
			error_log("QR $qr_id marked successfully. Affected rows: $affected");
		}
		else
		{
			$error_details[] = "No rows affected for QR ID: $qr_id (may not exist)";
			error_log("Warning: No rows affected for QR ID $qr_id");
		}
	}
	
	if($marked_count > 0)
	{
		$response['success'] = true;
		$response['marked_count'] = $marked_count;
		$response['message'] = "Successfully marked $marked_count QR code(s) as used";
		
		// VERIFY: Double-check that the update actually happened in database
		if(count($qr_ids) > 0)
		{
			$qr_ids_list = implode(',', array_map('intval', $qr_ids));
			$verify_sql = "SELECT COUNT(*) as total, SUM(CASE WHEN used=1 THEN 1 ELSE 0 END) as marked FROM tbl_qr_codes WHERE qr_id IN ($qr_ids_list)";
			$verify_result = mysql_query($verify_sql);
			if($verify_result)
			{
				$verify_row = mysql_fetch_array($verify_result);
				error_log("✓ VERIFICATION: Total QRs=" . $verify_row['total'] . ", Marked as used=1: " . $verify_row['marked']);
				$response['verification'] = array('total_qrs' => $verify_row['total'], 'marked_as_used' => $verify_row['marked']);
			}
		}
		
		if(!empty($error_details))
		{
			$response['warnings'] = $error_details;
		}
	}
	else
	{
		$response['message'] = 'Failed to mark any QR codes as used';
		$response['details'] = $error_details;
		error_log("ERROR: Unable to mark any QR codes. Details: " . json_encode($error_details));
	}
}
else
{
	$response['message'] = 'POST request with qr_ids array required';
	error_log("ERROR: POST request or qr_ids not found");
}

// Log final response
error_log("Final response: " . json_encode($response));
error_log("=== mark_qr_used_indent.php ending ===");

echo json_encode($response);
?>
