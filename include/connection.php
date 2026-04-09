<?php 
  include("config.php");
  include("mysqli_compatibility.php");
    // Connect to Host //
	set_time_limit(0);
	error_reporting(E_ERROR | E_PARSE);
    
    // Create MySQLi connection
    global $db_link;
    $db_link = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // Check connection
    if ($db_link->connect_error) {
        die('Not connected : ' . $db_link->connect_error);
    }
    
    // Set charset to UTF-8 for better compatibility
    $db_link->set_charset("utf8mb4");
    
    // For backward compatibility with old code using $link variable
    $link = $db_link;
?>