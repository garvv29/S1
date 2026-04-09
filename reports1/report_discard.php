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
		
		
		/*$tdate=$date2;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
		$num=mysql_num_rows($sql22);
		
		$sql2=mysql_query("select * from tblemp where emp_mobile='".$mobile."'") or die(mysql_error());
		$num2=mysql_num_rows($sql2);
		
		$sql_mail=mysql_query("select * from tblemp where emp_email='".$email."'") or die(mysql_error());
		$num_mail=mysql_num_rows($sql_mail);
		
		if($altemail !="")
		{
		$sql_altmail=mysql_query("select * from tblemp where emp_altemail='".$altemail."'") or die(mysql_error());
		$num_altmail=mysql_num_rows($sql_altmail);
		}
		else
		{
		$num_altmail=0;
		}
		
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee ID.\nEmployee with this Employee ID already Present.");
			  </script>
			 <?php
		}
		else if($num2 > 0)
		{	?>
			 <script>
			  alert("Duplicate Mobile Number.\nEmployee with this Mobile Number already Present.");
			  </script>
			 <?php
		}
		else if($num_mail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee VNR Email-ID.\nEmployee with this Employee VNR Email-ID already Present.");
			  </script>
			 <?php
		}
		else if($num_altmail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee Alternate Email-ID.\nEmployee with this Employee Alternate Email-ID already Present.");
			  </script>
			 <?php
		}
		else*/
		
		
		}
	//}


?>

<?php 
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$cid = $_REQUEST['txtclss'];
	$itemid = $_REQUEST['txtitem'];
	
	
	
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
	 	 
	 if($_GET['txtclss'] != 'ALL')
	 {
	$ss = "select classification from tbl_classification where classification_id='".$_GET['txtclss']."'";
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['classification'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }
 	
	 $sql = "select * from tbl_stldg_damage where stld_trdate <= '$edate' and stld_trdate >= '$sdate' and stld_trtype ='Discard' and stld_trsubtype ='MD' ";

	if(!is_numeric($cid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stld_trclassid =".$cid;
	 }
	 
	 if(!is_numeric($itemid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stld_tritemid =".$itemid;
	 }
	 	 
	 $sql.=" order by stld_trdate DESC";
	 $rs = mysql_query($sql) or die(mysql_error());	  
	 //echo $t=mysql_num_rows($rs);	 
	 // echo $cls; 
	 ?>
	 	 	 	 <link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<title>-Report- Reorder Level Report</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Discard Report</td>
  </tr>
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  </tr>
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?></td>
  </tr>
  </table><table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
			<td width="81" align="center" valign="middle" class="tblheading" >Date</td>
			<td width="184" align="center" valign="middle" class="tblheading" >Particulars</td>
			<td width="173" align="center" valign="middle" class="tblheading" >Classification</td>
			<td width="166" align="center" valign="middle" class="tblheading" >Item</td>
			<td width="62" align="center" valign="middle" class="tblheading" >UPS</td>
			<td width="70" align="center" valign="middle" class="tblheading" >QTY</td>
			<!--<td align="center" valign="middle" class="tblheading" colspan="2">Issue</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Balance</td>-->
</tr>
<!--<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
</tr>-->
<?php 
$srno=1;
while($row=mysql_fetch_array($rs))
	{
	$id=$row['stld_trid'];
	$itemid=$row['stld_tritemid'];
	$cls=$row['stld_trclassid'];
	$stlg_trdate=$row['stld_trdate'];
	$stlg_trups=$row['stld_trups'];
	$stlg_trqty=$row['stld_trqty'];
	$stld_trpartyid=$row['stld_trpartyid'];
	
	
			$s = "select * from tbl_stores where items_id='".$itemid."'";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			$ss1 = "select classification from tbl_classification where classification_id=".$cls;
	 		$rr1 = mysql_query($ss1) or die(mysql_error());	 
			$ros1 = mysql_fetch_array($rr1);
			$classification=$ros1['classification'];
			
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
		
		
		$quer3=mysql_query("SELECT * FROM tbl_discard where tid='".$id."'"); 
 		$noticia = mysql_fetch_array($quer3);
 		$p_name=$noticia['party_name'];
 		


if ($srno%2 != 0)
	{	

?>

<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $p_name;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $classification;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trqty;?></td>
			<!--<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>-->
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $p_name;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $classification;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trqty;?></td>
			<!--<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>-->
</tr>
  <?php	}
	 $srno=$srno+1;
	}
//}
//}
//}
?>
</table>
</br>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
