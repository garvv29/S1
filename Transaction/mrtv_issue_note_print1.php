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

	//$logid="opr1";
	//$lgnid="OP1";
	
	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction-VMRN</title>
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
  
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
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
<?php
	$sql1=mysql_query("select * from tblissue where issue_id='".$pid."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=$pid; $erid=0;
	//echo $t=mysql_num_rows($sql1);
	
	$tdate=$row['issue_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$sdate=$row['strdate'];
	$syear=substr($sdate,0,4);
	$smonth=substr($sdate,5,2);
	$sday=substr($sdate,8,2);
	$sdate=$sday."-".$smonth."-".$syear;
	
	$code1="IM".$row['iss_code'];
	 ?> 
	 	 <table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Vendor Material Return Note (VMRN)</font></td>
</tr>
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Material Return&nbsp;Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;VMRN No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "IM".$row['iss_code']."/".$yearid_id."/".$row['ncode'];?></td>
</tr>

<tr class="Light" height="20">
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
	if($row3['tin']!=""){ $ptc1="TIN: ".$row3['tin']." ";}else{$ptc1="";}
	if($row3['cst']!=""){ $ptc2="CST: ".$row3['cst']." ";}else{$ptc2="";}
	if($row3['pan']!=""){ $ptc3="PAN: ".$row3['pan']." ";}else{$ptc3="";}
	$ptc=$ptc1.$ptc2.$ptc3;
?>

<td align="right"  valign="Top" class="tblheading">Party &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px">
<?php echo $row3['business_name'];?><br /><?php echo $row3['address'];?>, <?php echo $row3['city'];?> - <?php echo $row3['pin'];?>, <?php echo $row3['state'];?>, <?php echo $row3['country'];?><br />Ph: <?php echo $row3['std'];?>-<?php echo $row3['phone'];?>, <?php echo $row3['mob'];?><br /><?php echo $ptc;?></div></td>
</tr>
<tr class="Light" height="20">
<td width="174"  align="right"  valign="middle" class="tblheading">Party DC Ref. Number&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3">&nbsp;<?php echo $row['dcrefno'];?></td>
</tr>

<!--<td width="174"  align="right"  valign="middle" class="tblheading">STR Ref.No.&nbsp;&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3">&nbsp;<?php echo $row['strefno'];?></td>-->


<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['tmode'];?></td>
</tr>
<?php
if($row['tmode'] == "Transport")
{
?>
<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_name'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_paymode'];?></td>
</tr>
<?php
}
else if($row['tmode'] == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['courier_name'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <td width="36" align="center" class="tblheading" valign="middle">#</td>
    <td width="269" align="center" class="tblheading" valign="middle">Classification</td>
    <td width="244" align="center" class="tblheading" valign="middle">Item</td>
    <td width="55" align="center" class="tblheading" valign="middle">UoM</td>
    <td width="58" align="center" class="tblheading" valign="middle">UPS</td>
	  <td width="74" align="center" class="tblheading" valign="middle">Quantity</td>
	   <?php
$sr=1;
$sql_eindent_sub=mysql_query("select * from tblissue_sub where issue_id=$trid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row_eindent_sub['item_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

$sql_issuemain=mysql_query("select rettype from tblissue where issue_id='$trid'") or die(mysql_error());
$row_issuemain=mysql_fetch_array($sql_issuemain);
if($sr%2!=0)
{
?>
<tr class="Dark" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="55" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="58" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['ups_indent']?></td>
              <td align="center" width="74" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty_indent']?></td>
          </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['issuesub_id'];?>" />
<?php
}
else
{
?>			  
<tr class="Light" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="55" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="58" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['ups_indent']?></td>
              <td align="center" width="74" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty_indent']?></td>
          </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['issuesub_id'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
		  <br />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="40" align="right"  valign="middle" class="tblheading">&nbsp;TIN:&nbsp;</td>
<td width="164" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="175" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="125" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="211" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
<br />
<br />
<br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="84" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="152"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="84" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="171" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="87" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="172" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table><br />
<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3"><a href="mrtv_issue_note_print1_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"  /></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
