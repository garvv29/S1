<?php
session_start();
if(!isset($_SESSION['sessionadmin']))
{
	header('Content-Type: application/json');
	echo json_encode(array('success' => false, 'message' => 'Unauthorized'));
	exit;
}

require_once("../include/config.php");
require_once("../include/connection.php");

header('Content-Type: application/json');

$response = array('success' => false, 'message' => 'Invalid request');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qr_ids']))
{
	$qr_ids = $_POST['qr_ids']; // Array of QR IDs to mark as used
	
	if(empty($qr_ids) || !is_array($qr_ids))
	{
		$response['message'] = 'No QR IDs provided';
		echo json_encode($response);
		exit;
	}
	
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
		
		// Update tbl_qr_codes to mark as used
		$sql_update = "UPDATE tbl_qr_codes 
						SET used=1, linked_status='used' 
						WHERE qr_id='$qr_id'";
		
		$result = mysql_query($sql_update);
		
		if($result && mysql_affected_rows() > 0)
		{
			$marked_count++;
		}
		else
		{
			$error_details[] = "Failed to mark QR ID: $qr_id";
		}
	}
	
	if($marked_count > 0)
	{
		$response['success'] = true;
		$response['marked_count'] = $marked_count;
		$response['message'] = "Successfully marked $marked_count QR code(s) as used";
		
		if(!empty($error_details))
		{
			$response['warnings'] = $error_details;
		}
	}
	else
	{
		$response['message'] = 'Failed to mark any QR codes as used';
		$response['details'] = $error_details;
	}
}
else
{
	$response['message'] = 'POST request with qr_ids array required';
}

echo json_encode($response);
?>
