<?php
session_start();
if(!isset($_SESSION['sessionadmin']))
{
	echo "Not logged in";
	exit;
}

require_once("../include/config.php");
require_once("../include/connection.php");

echo "<h2>Classification Table Debug Info</h2>";
echo "<pre>";

$sql = mysql_query("SELECT classification_id, classification, classification_type FROM tbl_classification ORDER BY classification");

if($sql === false) {
	echo "Error: " . mysql_error();
} else {
	echo "Classification Records:\n";
	echo str_repeat("=", 80) . "\n";
	while($row = mysql_fetch_array($sql)) {
		echo "ID: {$row['classification_id']} | Classification: '{$row['classification']}' | Type: '{$row['classification_type']}'\n";
		echo "  Type length: " . strlen($row['classification_type']) . "\n";
		echo "  Type bytes: " . implode(',', array_map('ord', str_split($row['classification_type']))) . "\n";
	}
}

echo "</pre>";
echo "<hr>";
echo "<h3>Test getuser_classificationtype.php</h3>";
echo "<p>Try this with your browser: ";
echo "<a href='getuser_classificationtype.php?a=84' target='_blank'>getuser_classificationtype.php?a=84</a>";
echo "</p>";
?>
