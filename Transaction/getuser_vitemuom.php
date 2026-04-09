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
	}
	require_once("../include/config.php");
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
$flag1=0; 
//echo $a;
$sql_tt=mysql_query("select uom from tbl_stores where items_id='$a'")or die("Error:".mysql_error());
$row_tt=mysql_fetch_array($sql_tt);
//$c=$row_tt['classification_id'];

$sql_issue=mysql_query("select * from tbl_stldg_good where stlg_tritemid='".$a."'") or die(mysql_error());
$tot=mysql_num_rows($sql_issue);
$sql_issue1=mysql_query("select * from tbl_stldg_damage where stld_tritemid='".$a."'") or die(mysql_error());
$tot1=mysql_num_rows($sql_issue1);

if($tot > 0 )
$flag=1;

if($tot1 > 0)
$flag1=1;

//echo $flag;
?>&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tt['uom'];?>"  />&nbsp;</td><input type="hidden" name="itmdupchkg" value="<?php echo $flag;?>" /><input type="hidden" name="itmdupchkd" value="<?php echo $flag1;?>" />