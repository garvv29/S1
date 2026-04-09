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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="OP1";
	//$lgnid="OP1";
	
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	}
		$filename="Transaction-Vendor-".$itmid ['itmid'].".doc";    
	header("Content-type:application/vnd.ms-word"); 
	header("Content-Disposition: attachment; filename=$filename"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Transaction -Vendor</title>
<style type="text/css">/* CSS Document */

body{ 
	margin-top:0px; 
	margin-left:0px; 
	margin-right:0px; 
	margin-bottom:0px;  
	
/*	background-color:#506030 
	background-color:#FEFEFE*/
	}
	
#wrapperleftmenu{ 
	float:left;
	background-image:url(images/leftmenu_bg.jpg); background-repeat:repeat-y; 
	position:absolute; 
	width:184px;
	border:1px solid red;
	height:450px;}
	
#leftmenu_top{ 
	float:left; 
	position:absolute; 
	width:184px; 
	height:auto;
	text-decoration:none; }
	
#leftmenu{ 	
		text-decoration:none;
		float:left;
		position:relative;
		margin-left:0px;
		width:184px;}
		
.menufont{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:15px;
		font-weight:bold;
		padding-left:15px;
		color:#000000;}
		
.submenufont{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;		
		color:#000000;}
/*		
.submenufont a{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:normal;
		text-decoration:none;
		margin-left:35px;
		line-height:18px;
		color:#000000;}
		
.submenufont a:hover{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;
		text-decoration:none;
		margin-left:35px;
		line-height:18px;
		color:#000000;}
		
*/
.tblheading{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;
		color:#303030;}
		
.tbltext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:13px;
		font-weight:normal;
		color:#000000;}

.smalltblheading{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:11px;
		font-weight:bold;
		color:#303030;}
		
.smalltbltext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:11px;
		font-weight:normal;
		color:#000000;}
		
		
.tbldtext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:normal;
		color:#000000;}

		
#master{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
		
.test{width:176px;float:left; position:absolute; text-decoration:mone;
border-bottom: 1px solid #FFFFFF;
}

.butn
{
}
#transaction{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}

#search{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
	
#utility{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
		
#reports{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
								
#wrapperpendtask{
	float:left;
	margin-top:20px;
	border:1px solid #FF0000;
	position:relative;
	width:184px; 
	height:50px;}
.pendtask{
	float:left;
	background-image:url(images/sub_bg.jpg); background-repeat:no-repeat;
	height:17px;
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color: #303918;
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
	}
	
.Mainheading
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 16px;
	color: #404d21;
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.subheading
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color:#704f00;
	/*color: #303918;*/
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.tblbutn
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color:#FFFFFF;
	/*color: #303918;*/
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.Light{
	background-color:#FFFFFF
	/*background-color:#f6ffe0;
	background-color: #ebf4d4;*/
}
.backcolor{
	background-color:#F1F1F1;
	/*background-color: #ebf4d4;*/
}
.Dark{ 
	background-color:#F5F5F5
	/*background-color: #dce9a5;
	background-color:#b4d554;E2E2E2*/
}
.tbltitle{ 
	background-color:#4ea1e1
	/*background-color: #dce9a5;
	background-color:#b4d554;*/
}
.tblsubtitle{ 
	background-color:#D2E9FF
	/*background-color: #dce9a5;
	background-color:#b4d554;*/
}	



body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>

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
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Vendor' and arrival_id='".$tid."'") or die(mysql_error());
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
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td align="right" width="37%" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>"></td>
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+3"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">Address-Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?> - <?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">Address-Plant:&nbsp;<?php echo $row_param['plant'];?>, <?php echo $row_param['pcity'];?> - <?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?></td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Goods Receipt Note (GRN)</font></td>
</tr>
</table><br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="Dark" height="20">
<td width="187" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="263"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="121" align="right" valign="middle" class="tblheading">&nbsp;GRN No. &nbsp;</td>
<td width="219" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "AV".$row_tbl['arr_code']."/".$yearid_id."/".$row_tbl['ncode'];?></td>
</tr>
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>

<tr class="Light" height="20">
<td align="right"  valign="top" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $row3['business_name'];?><br /><?php echo $row3['address'];?>, <?php echo $row3['city'];?>, <?php echo $row3['pin'];?>, <?php echo $row3['state'];?>,<br />Ph: <?php echo $row3['mob'];?>, <?php echo $row3['std'];?>-<?php echo $row3['phone'];?> </div></td>
</tr>
<?php /*
	$quer4=mysql_query("SELECT address, address FROM tbl_parameters  where id='".$row_tbl['id']."'"); 
	$row4=mysql_fetch_array($quer4);
?>
<?php
	$quer5=mysql_query("SELECT plant, plant FROM tbl_parameters  where id='".$row_tbl['id']."'"); 
	$row5=mysql_fetch_array($quer5);*/
?>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">PO Reference No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['porefno'];?></td>

<td align="right"  valign="middle" class="tblheading">D.C. No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['dcno'];?></td>
</tr>

 <tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Dark" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="121" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="219" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="263" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<?php echo $row_tbl['trans_paymode'];?></td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="263" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="121" valign="middle" class="tblheading">&nbsp;Docket no.&nbsp;</td>
<td align="left" width="219" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Light" height="20">
<td align="right" width="187" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="24%" align="left" rowspan="2" valign="left" class="tblheading">&nbsp;&nbsp;We acknowledge the receipt of the following goods:</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php
//echo $arrival_id;
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
<br />

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

<td width="104" align="right"  valign="middle" class="tblheading">Seed Licese No.:&nbsp;</td>
<td width="211" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>

<br />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px">You are requested to collect below standard material, if any, within a week from the date of this intimation, failing which, we are not responsible for any loss or damage caused to your material. Further, deduction will be made in the bill for the above mentioned damage and shortage items.</div></td>
</tr>
</table><br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
<!--<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" width="22" border="0" onClick="window.close()"  target="_blank" class="butn"/>&nbsp;&nbsp;</td>
</tr>
</table>
--></form>
</td></tr>
</table>

</body>
</html>
