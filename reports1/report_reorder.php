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
	if(isset($_GET['classification_id']))
	{
	$classification_id = $_GET['classification_id'];
	}
	if(isset($_GET['items_id']))
	{
	$id = $_GET['items_id'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		$code=trim($_POST['txtcode']);
		$date=trim($_POST['date']);
		$level=$_POST['txtvname'];
		
		$tdate=$date2;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		/*$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
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
		{
			 $sql_in="insert into tbl_transction( date, order ,date2,order) values ('$date','$code','$date2','$order')";
										
			//if(mysql_query($sql_in)or die(mysql_error()))
			//{ 
				//$id=mysql_insert_id();
				
			}
		
		}
	//}


?>

<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<title>-Report- Reorder Level Report</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Reorder Level Report As on Date : <?php echo date("d-m-Y", time());?></td>
  </tr>
   </table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="28" align="center" class="tblheading" valign="middle">#</td>
    <td width="168" align="center" class="tblheading" valign="middle">Classification</td>
    <td width="262" align="center" class="tblheading" valign="middle">Item</td>
    <td width="57" align="center" class="tblheading" valign="middle">UoM</td>
    <td width="67" align="center" class="tblheading" valign="middle">Reorder Level </td>
    <td width="44" align="center" class="tblheading" valign="middle">UPS</td>
	  <td width="58" align="center" class="tblheading" valign="middle">Quantity</td>
      <td width="78" align="center" class="tblheading" valign="middle">Remarks</td>
  </tr>
<?php
$srno=1; $ordate="";$orstatus="";
$sql_cls=mysql_query("select * from tbl_classification") or die(mysql_error());
while($row_cls=mysql_fetch_array($sql_cls))
{

$sql_itm=mysql_query("select * from tbl_stores where classification_id='".$row_cls['classification_id']."' and srl_status='Yes'") or die (mysql_error());
while($row_itm=mysql_fetch_array($sql_itm))
{
$totups=0; $totqty=0;  $cnt=0;
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_cls['classification_id']."' and stlg_tritemid='".$row_itm['items_id']."'") or die(mysql_error());

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$row_itm['items_id']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
	$totups=$totups+$row_issuetbl['stlg_balups'];
	$totqty=$totqty+$row_issuetbl['stlg_balqty'];
	$ordate=$row_issuetbl['ordate'];
	$cnt++;
	$orstatus=$row_issuetbl['orstatus'];
 }
 }
 
 if($totqty > 0 && $totups==0)$totups=1;
 if($totqty == 0 && $totups > 0)$totups=0;
 
 if($ordate=="" || $ordate=="0000-00-00")
 {
 	$tdate=date("d-m-Y");
 }
 else
 {
 	$tdate=$ordate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
 }
?>  
<?php	
if($totqty <=0)
$totqty=0;

if($totups<=0 && $totqty>0)
$totups=1;
if($totups>0 && $totqty==0)
$totups=0;

$stores_item=$row_itm['stores_item'];
if($row_itm['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";

if($totqty <= $row_itm['srl'])
 {
 if ($srno%2 != 0)
	{	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $stores_item;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['uom'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['srl'];?></td>
	<td valign="middle" class="tbltext" align="center"><?php echo $totups;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $totqty;?></td>
   <td width="78" align="center" valign="middle" class="tblheading"><?php if($orstatus=="OR") { echo "OR - ".$ordate;}else{ echo "R";}?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $stores_item;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['uom'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['srl'];?></td>
	<td valign="middle" class="tbltext" align="center"><?php echo $totups;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $totqty;?></td>
    <td width="78" align="center" valign="middle" class="tblheading"><?php if($orstatus=="OR") { echo "OR - ".$ordate;}else{ echo "R";}?></td>
  </tr>
  <?php	}
	 $srno=$srno+1;
	}
}
}
//}
?>
</table>
</br>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
