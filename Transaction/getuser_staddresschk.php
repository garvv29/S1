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
	$year1=$_SESSION['ayear1'];
	$year2=$_SESSION['ayear2'];
	$username= $_SESSION['username'];
	$yearid_id=$_SESSION['yearid_id'];
	$role=$_SESSION['role'];
    $loginid=$_SESSION['loginid'];
    $logid=$_SESSION['logid'];
	$lgnid=$_SESSION['logid'];
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
/*if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}*/


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_month=mysql_query("select * from tbl_partymaser where p_id='$a'")or die("Error:".mysql_error());
$row_month=mysql_fetch_array($sql_month);
 
?><td align="left"  valign="middle" class="tbltext" colspan="6">&nbsp;<?php echo $row_month['address'];?>, <?php echo $row_month['city'];?>, <?php echo $row_month['state'];?></td>
