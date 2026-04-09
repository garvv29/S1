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
		
	
	 $pid = $_GET['pid'];	
	 $sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
	

		if(isset($_POST['frm_action'])=='submit')
		{ 
		}
	
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />



<title>Report -Captive Consumption</title>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where p_id=$pid"); 
 while($noticia = mysql_fetch_array($quer3)) { 
		 $p_name = $noticia['business_name'];
		 } 
		 ?>
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<?php 
//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tblempclaims  where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month between $monthf and $montht group by dept_id"),0); 
 $sql = "select * from tbl_stldg_good where stlg_trpartyid = '$pid' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' and stlg_trtype = 'CC' and stlg_trsubtype='CC' order by stlg_trdate DESC";
	 $rs = mysql_query($sql) or die(mysql_error());	  	 
	 	 
	  ?>
	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Party:<?php echo $p_name;?>&nbsp;&nbsp;Period: From: <?php echo $_GET['sdate']?>&nbsp;To <?php echo $_GET['edate'];?></td>
  </tr>
  </table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
			<td align="center" valign="middle" class="tblheading">Date</td>
			<td align="center" valign="middle" class="tblheading">Classification</td>
			<td align="center" valign="middle" class="tblheading">Item</td>
			<td align="center" valign="middle" class="tblheading">UOM</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">Quantity</td>
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
			
			/*$sql1 = "select * from tbl_stldg_good where stlg_trpartyid = '$pid'  and stlg_trtype = 'CC' and stlg_trsubtype='CC' and stlg_tritemid = '$itemid'  and stlg_balqty>0 order by stlg_trdate DESC";
	 $rs1 = mysql_query($sql1) or die(mysql_error());*/
	$stlg_trdate = $row['stlg_trdate'];
	
	
	$ty = $row['stlg_trtype'];
$tysub = $row['stlg_trsubtype'];
if(($ty == "CC") && ($tysub =="CC"))
{
$issups = $row['stlg_trups'];
$issqty = $row['stlg_trqty'];
}
elseif(($ty == "CC") && ($tysub =="CC"))  
{
$issups = $row['stlg_trups'];
$issqty = $row['stlg_trqty'];
}	
	
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
	
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
</tr>
<?php
}
$srno=$srno+1; 
}
?>
</table>			

	
</form> 
</br>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
