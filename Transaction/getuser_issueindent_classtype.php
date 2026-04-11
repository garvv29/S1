<?php
session_start();
if(!isset($_SESSION['sessionadmin']))
{
	echo "Unauthorized";
	exit;
}

require_once("../include/config.php");
require_once("../include/connection.php");

if(isset($_GET['classification_id']))
{
	$classification_id = trim($_GET['classification_id']);
	
	// Validate input
	if(empty($classification_id) || !is_numeric($classification_id))
	{
		echo "Invalid classification";
		exit;
	}
	
	$sql = "SELECT classification_type FROM tbl_classification WHERE classification_id='$classification_id' LIMIT 1";
	$result = mysql_query($sql) or die(mysql_error());
	
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		$classification_type = isset($row['classification_type']) ? trim($row['classification_type']) : '';
		echo $classification_type;
	}
	else
	{
		echo "Not found";
	}
}
else
{
	echo "Missing parameter";
}
?>
