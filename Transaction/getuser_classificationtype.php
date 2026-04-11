<?php
session_start();
if(!isset($_SESSION['sessionadmin']))
{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
}
else
{
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_GET['a']))
	{
		$classification_id = intval($_GET['a']);
		
		// Query to fetch classification_type
		$sql = mysql_query("SELECT classification_type FROM tbl_classification WHERE classification_id='$classification_id'") or die("Error:".mysql_error());
		$row = mysql_fetch_array($sql);
		
		// Return ONLY the classification_type value, trimmed and clean
		if($row && !empty($row['classification_type']))
		{
			echo trim($row['classification_type']);
		}
		else
		{
			echo "";
		}
	}
	else
	{
		echo "";
	}
}
?>
