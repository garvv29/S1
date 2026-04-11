<?php
session_start();
require_once("../include/config.php");
require_once("../include/connection.php");

header('Content-Type: application/json');

if(!isset($_SESSION['sessionadmin'])) {
	echo json_encode(['success' => false, 'message' => 'Unauthorized']);
	exit;
}

$response = ['success' => false, 'total_weight' => 0, 'message' => ''];

if(isset($_GET['classification_id']) && isset($_GET['item_id'])) {
	$classification_id = intval($_GET['classification_id']);
	$item_id = intval($_GET['item_id']);
	$yearid = $_SESSION['yearid_id'];
	
	// Fetch total weight of all QR codes for this classification and item
	// QRs are in draft state and haven't been linked yet (arrsub_id = 0)
	$sql = "SELECT SUM(weight) as total_weight FROM tbl_qr_codes 
	        WHERE classification_id = '$classification_id' 
	          AND item_id = '$item_id' 
	          AND arrsub_id = 0 
	          AND linked_status = 'draft'
	        GROUP BY classification_id, item_id";
	
	$result = mysql_query($sql);
	
	if($result && mysql_num_rows($result) > 0) {
		$row = mysql_fetch_array($result);
		$total_weight = floatval($row['total_weight']);
		
		if($total_weight > 0) {
			$response['success'] = true;
			$response['total_weight'] = round($total_weight, 2);
			$response['message'] = 'Total weight fetched successfully';
		} else {
			$response['success'] = false;
			$response['message'] = 'No QR codes found or total weight is 0';
		}
	} else {
		$response['success'] = false;
		$response['message'] = 'No QR codes found for this classification and item';
	}
} else {
	$response['message'] = 'Missing required parameters';
}

echo json_encode($response);
?>
