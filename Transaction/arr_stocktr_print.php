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
/*$yearid_id="09-10";
	$logid="OP1";
	$lgnid="OP1";
*/	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Transaction -STRN</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
<style type="text/css" media="print">
body { font-family:Arial;
/*size:11in 8.5in landscape;
margin:0.25in;*/
}
img.butn { display:none; visibility:hidden; }
@page {
size:landscape;
}

</style>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$tid=$itmid;
$sql_tbl=mysql_query("select * from tblarrival where arrival_type='Stocktransfer' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr class="Light">
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>, <?php echo $row_param['pcity'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Stock Transfer Receipt Note (STRN)</font></td>
</tr>
</table><br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td width="187" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="263"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="127" align="right" valign="middle" class="tblheading">&nbsp;STRN No &nbsp;</td>
<td width="213" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "AS".$row_tbl['arr_code']."/".$yearid_id."/".$row_tbl['ncode'];?></td>
</tr>
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>

<tr class="Light" height="20">
<td align="right"  valign="top" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row3['business_name'];?><br />&nbsp;<?php echo $row3['address'];?>, <?php echo $row3['city'];?> - <?php echo $row3['pin'];?>, <?php echo $row3['state'];?>,<br />
&nbsp;Ph: <?php echo $row3['mob'];?>, <?php echo $row3['std'];?>-<?php echo $row3['phone'];?> </td>
</tr>

<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">STN No&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['stnno'];?></td>
</tr>

 <tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Light" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="127" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="213" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Dark" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="263" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Light" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="263" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="127" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="213" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="6" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>

<br />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="24%" align="left" rowspan="2" valign="middle" class="tblheading">&nbsp;We acknowledge the receipt of the following goods:</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());

?>
			<tr class="tblsubtitle" height="20">
              <td width="3%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="18%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="23%" rowspan="3" align="center" valign="middle" class="tblheading">Items</td>
                <td colspan="8"  align="center" valign="middle" class="tblheading">Quantity</td>
          </tr>
			<tr class="tblsubtitle">
                    <td colspan="2" align="center" valign="middle" class="tblheading">DC</td>
                    <td colspan="2" align="center" valign="middle" class="tblheading">Good</td>
                    <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
                    <td colspan="2" align="center" valign="middle" class="tblheading">Excess/<br />
Shortage</td>
		  </tr>
			<tr class="tblsubtitle">
			  <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
		      <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
		      <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
		      <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
		      <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
		      <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
		      <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
		      <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
		  </tr>
<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{ 
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{

?>	

<tr class="Light" height="20">
             <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="23%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="18%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="23%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_qty'];?></td>
 </tr> 
<?php
}
$srno++;
}
}
?> 			  
        </table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="20">
<td width="127" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td colspan="11" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks'];?></td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="40" align="right"  valign="middle" class="tblheading">&nbsp;TIN:&nbsp;</td>
<td width="164" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="196" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="104" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="211" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>

<br />

<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="112" align="right" valign="middle" class="smalltblheading" rowspan="3">Prepared By&nbsp;</td>
<td width="161"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="68" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="199" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="86" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="174" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><a href="arr_stocktr_print_word.php?itmid=<?php echo $itmid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   /></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table></form>
</td></tr>
</table>

</body>
</html>
