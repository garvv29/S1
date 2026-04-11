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

if(isset($_GET['qrcode']) && isset($_GET['classification_id']) && isset($_GET['item_id']))
{
	$qrcode = trim($_GET['qrcode']);
	$classification_id = trim($_GET['classification_id']);
	$item_id = trim($_GET['item_id']);
	
	// Validate inputs
	if(empty($qrcode) || empty($classification_id) || empty($item_id) || 
	   !is_numeric($classification_id) || !is_numeric($item_id))
	{
		$response['message'] = 'Invalid parameters';
		echo json_encode($response);
		exit;
	}
	
	// Sanitize QR code input (alphanumeric, dash, underscore only)
	if(!preg_match('/^[a-zA-Z0-9_-]+$/', $qrcode))
	{
		$response['message'] = 'Invalid QR code format';
		echo json_encode($response);
		exit;
	}
	
	// Query QR code from database - Get ALL columns
	$sql = "SELECT qr_id, arrival_id, classification_id, item_id, arrsub_id, qr_code_text, 
	               weight, arrivalweight, generated_date, linked_status, created_by, finalsubmit, used 
			FROM tbl_qr_codes 
			WHERE qr_code_text='$qrcode' 
			LIMIT 1";
	
	$result = mysql_query($sql) or die(json_encode(array('success' => false, 'message' => mysql_error())));
	
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		
		// Validate classification_id matches
		if($row['classification_id'] != $classification_id)
		{
			$response['message'] = 'QR code does not match selected classification';
			echo json_encode($response);
			exit;
		}
		
		// Validate item_id matches
		if($row['item_id'] != $item_id)
		{
			$response['message'] = 'QR code does not match selected item';
			echo json_encode($response);
			exit;
		}
		
		// Validate finalsubmit = 1
		if($row['finalsubmit'] != 1)
		{
			$response['message'] = 'QR code is not finalized. Only finalized QR codes can be used.';
			echo json_encode($response);
			exit;
		}
		
		// Validate used != 1 (not used yet)
		if($row['used'] == 1)
		{
			$response['message'] = 'QR code has already been used';
			echo json_encode($response);
			exit;
		}
		
		// All validations passed - Return ALL columns
		$response['success'] = true;
		$response['qr_id'] = $row['qr_id'];
		$response['arrival_id'] = $row['arrival_id'];
		$response['classification_id'] = $row['classification_id'];
		$response['item_id'] = $row['item_id'];
		$response['arrsub_id'] = $row['arrsub_id'];
		$response['qr_code_text'] = $row['qr_code_text'];
		$response['weight'] = $row['weight'];
		$response['arrivalweight'] = $row['arrivalweight'];
		$response['generated_date'] = $row['generated_date'];
		$response['linked_status'] = $row['linked_status'];
		$response['created_by'] = $row['created_by'];
		$response['finalsubmit'] = $row['finalsubmit'];
		$response['used'] = $row['used'];
		$response['status'] = 'valid';
		$response['message'] = 'QR code validated successfully';
	}
	else
	{
		$response['message'] = 'QR code not found in database';
	}
}
else
{
	$response['message'] = 'Missing required parameters';
}

echo json_encode($response);
?>
