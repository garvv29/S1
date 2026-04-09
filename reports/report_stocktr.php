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
	if(isset($_POST['frm_action'])=='submit')
	{
	
	}

	$pid = $_GET['pid'];	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];

		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
		$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
	 	 
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where p_id=$pid"); 
 while($noticia = mysql_fetch_array($quer3)) { 
		 $p_name = $noticia['business_name'];
		 } 
	 ?>
	 	 <link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<title>-Report- Reorder Level Report</title>
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>

<table width="750" align="center" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right"><a href="excel-stocktransfer.php?pid=<?php echo $_GET['pid'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Stock Transfer Report</td>
  </tr>
  </table>
<?php 

 	 $sql = "select * from tbl_stldg_good where stlg_trpartyid = $pid and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' order by stlg_trdate ASC";
	 $rs = mysql_query($sql) or die(mysql_error());	  
	  
	  
	  ?>
	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Plant:<?php echo $p_name;?>&nbsp;&nbsp;Date From: <?php echo $_REQUEST['sdate'];?> To <?php echo $_REQUEST['edate'];?>&nbsp;<?php ?>
 </tr>
  </table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="35">
			<td align="center" valign="middle" class="tblheading" rowspan="2">Date</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Classification</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Item</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">UoM</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Transfer</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Receive</td>
</tr>
<tr class="tblsubtitle" height="35">
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
</tr>
<?php
$srno=1;
while($row = mysql_fetch_array($rs))
	{
	$clsid = $row['stlg_trclassid'];
	$itemid = $row['stlg_tritemid'];
	
	
			 $ss = "select classification from tbl_classification where classification_id = $clsid";
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['classification'];
			 
			 
			 
			 $s = "select * from tbl_stores where items_id = $itemid";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			
			$sql1 = "select * from tbl_stldg_good where stlg_tritemid = $itemid order by stlg_trdate ASC";
	 $rs1 = mysql_query($sql1) or die(mysql_error());
	 
	$stlg_trdate = $row['stlg_trdate'];
	
	
	$ty = $row['stlg_trtype'];
$tysub = $row['stlg_trsubtype'];
if(($ty == "Arrival") && ($tysub =="Stocktransfer"))
{
$recups = $row['stlg_trups'];
$recqty = $row['stlg_trqty'];
$issups = ""; 
$issqty = "";
}
elseif(($ty == "Issue") && ($tysub =="stocktr"))  
{
$issups = $row['stlg_trups'];
$issqty = $row['stlg_trqty'];
$recups = ""; 
$recqty = "";
}	
	
	$tdate=$row['stlg_trdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;		
	
	if($row['stlg_trqty'] > 0)
	{
	if ($srno%2 != 0)
	{
?>		
			
			



<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $cls?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty?></td>
</tr>
<?php
}
else
{
?>

<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $cls?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty?></td>
</tr>
<?php
}
$srno=$srno+1; 
}
}
?>
</table>
</br>
<table width="750" align="center" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right"><a href="excel-stocktransfer.php?pid=<?php echo $_GET['pid'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
