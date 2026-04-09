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
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
	
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
	else
	{ 
	$c="";
	}
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$g = $_GET['g'];	 
	}
if(isset($_GET['h']))
	{
	$h = $_GET['h'];	 
	}	
	//$d="";
$flag=0; 	
	if($c!="")
	{
		if($c=="txtslsubbg1")
		{
		$d="exusp1";
		$id="exqty1";
		}
		if($c=="txtslsubbg2")
		{
		$d="exusp2";
		$id="exqty2";
		}
		if($c=="txtslsubbg3")
		{
		$d="exusp3";
		$id="exqty3";
		}
				
	}


$sql_month=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$a."' and stlg_tritemid='".$b."'")or die("Error:".mysql_error());
$row_ccc=mysql_fetch_array($sql_month);
$sql_sb=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_ccc['stlg_id']."'")or die("Error:".mysql_error());
$row_sb=mysql_fetch_array($sql_sb);
$t=mysql_num_rows($sql_sb);
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="<?php echo $d?>" class="tbltext" value="<?php echo $row_sb['stlg_balups'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="<?php echo $id?>" class="tbltext" value="<?php echo $row_sb['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>