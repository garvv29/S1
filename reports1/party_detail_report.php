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
	
if(isset($_REQUEST['business_name']))
	{
	$business_name = $_REQUEST['business_name'];
	}	
	
if($business_name=="StockTransfer")
		{
		$rt="Stock Transfer";
		}
if($business_name=="InternalReturn")
		{
		$rt="Internal Return";
		}
if($business_name=="Vendor")
		{
		$rt="Vendor";
		}
if($business_name=="Dealer")
		{
		$rt="Dealer";
		}
if($business_name=="CF")
		{
		$rt="C&F";
		}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Report-Party detail Report</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body topmargin="0" >
<table width="620" border="0" bordercolor="#ffffff" align="center" cellpadding="0" cellspacing="0" >
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
<?php
	 $srno=1;
$business_name=$rt;
    // $sql_sel="select * from tbl_partymaser where classification='$pid' order by business_name ";
	//$res=mysql_query($sql_sel) or die (mysql_error());

	$sql = mysql_query("SELECT * FROM tbl_partymaser where classification='$business_name' order by business_name"); 
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_partymaser where classification='$business_name'"),0); 
	//}
	$total=mysql_num_rows($sql);
    if($total >0) { 
			?>
<tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Party List <?php echo $resetresult['party_name'];?> (<?php echo $total;?>)</td>
  </tr>
  <tr valign="top">
  <td align="center" valign="top" colspan="4">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0" bordercolor="#b9d647" style="border-collapse:collapse">
<?php
if($total > 0)
{
while($row=mysql_fetch_array($sql))
{
/*$bname=$row['business_name'];
	
	$sql_p=mysql_query("select * from tbl_partymaser where classification='$business_name'")or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);*/
	
	?>
<tr class="Light">
<td class="tblheading" colspan="2" align="left">&nbsp;<?php echo $row['classification'];?> - <?php echo $row['business_name'];?>,</td>
</tr>
<tr class="Light">
<td class="tblheading" colspan="2" align="left">&nbsp;<?php echo $row['contact'];?>,</td>
</tr>

<tr class="Light">
<td class="tblheading" colspan="2" align="left">&nbsp;<?php echo $row['address'];?>,</td>
</tr>
<tr class="Light">
<td class="tblheading" colspan="2" align="left">&nbsp;<?php echo $row['city'];?>-<?php echo $row['pin'];?>,<?php echo $row['state'];?>,</td>
</tr>
<tr class="Light">
<td class="tblheading" colspan="2" align="left">&nbsp;<?php if ($row['phno']!=0){?>Ph.-<?php echo $row['std'];?>-<?php }?>M-<?php echo $row['mob'];?></td>
</tr>

<tr class="Light">
<td class="tblheading" colspan="2" align="left">&nbsp;TIN: <?php echo $row['tin'];?>&nbsp;&nbsp;&nbsp;&nbsp;CST: <?php echo $row['cst'];?>&nbsp;&nbsp;&nbsp;&nbsp;PAN: <?php echo $row['pan'];?></td>
</tr>

<tr><td><hr /></td></tr>
<?php
}
}
}
?>
</table>
  </form>
</td></tr>
<tr >
<td align="right"><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<hr/>
</body>
</html>
