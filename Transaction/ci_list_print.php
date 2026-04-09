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

	$logid="opr1";
	$lgnid="OP1";
	/*if(isset($_REQUEST['slid']))
	{
	$slid = $_REQUEST['slid'];
	}*/
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transaction-Cycle Inventory</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
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

  
<table width="900" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
 <table align="center" border="0" cellspacing="0" cellpadding="0" width="900" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Cycle Inventory List</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="900" bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="35">
             <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Classification </td>
			 <td width="27%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			 <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Total</td>
			 <td colspan="3" height="23" align="center" valign="middle" class="tblheading">Existing</td>
			 <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Actuals</td>
			 <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Difference </td>
			 <td width="12%" rowspan="2" align="center" valign="middle" class="tblheading">Remarks</td>
</tr>
<tr class="tblsubtitle">
			 <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
			<td width="10%" align="center" valign="middle" class="tblheading">SLOC </td>
			<td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
            <td width="5%"  colspan="1" rowspan="" align="center" valign="middle" class="tblheading">Qty</td>
            <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
			<td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
		
</tr>
<?php
$srno=1;

$sql_ci=mysql_query("select * from tbl_ci where ci_id='".$pid."' and ci_upflg=0") or die(mysql_error());

while($row_ci=mysql_fetch_array($sql_ci))
{
	$p_array="";
if($row_ci['classification_id'] == "ALL")
{ 
	$sql_cls=mysql_query("select * from tbl_classification order by classification asc") or die(mysql_error());
	while($row_cls=mysql_fetch_array($sql_cls))
	{
	if($p_array!="")
	$p_array=$p_array.",".$row_cls['classification_id'];
	else
	$p_array=$row_cls['classification_id'];
	}
}
else
{
	$p_array=$row_ci['classification_id'];
}

	$p1_array=explode(",",$p_array);

	foreach($p1_array as $val1)
	{
	 	if($val1<>"")
	 	{	
		$sql_class=mysql_query("select * from tbl_classification where classification_id='".$val1."'") or die(mysql_error());
		$row_class=mysql_fetch_array($sql_class);
		
		
		
		$sql_item=mysql_query("select * from tbl_stores where classification_id='".$val1."' order by stores_item") or die(mysql_error());
		while($row_item=mysql_fetch_array($sql_item))
		{
		
		$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=""; $slqty=""; $chk=0;  $totups=0; $totqty=0;
		$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$val1."' and stlg_tritemid='".$row_item['items_id']."'") or die(mysql_error());
		
while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$row_item['items_id']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

$tot_issuetbl=mysql_num_rows($sql_issuetbl);
if($tot_issuetbl > 0)
 $chk++;

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issue['stlg_binid']."' ") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issue['stlg_subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$blups=0; $blqty=0;
if($row_issuetbl['stlg_balups'] <=0)
$blups=0;
else
$blups=$row_issuetbl['stlg_balups'];

$totups=$totups+$blups;

if($row_issuetbl['stlg_balqty'] <=0)
$blqty=0;
else
$blqty=$row_issuetbl['stlg_balqty'];

$totqty=$totqty+$blqty;

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($slups!="")
$slups=$slups.$blups."<br/>";
else
$slups=$blups."<br/>";
if($slqty!="")
$slqty=$slqty.$blqty."<br/>";
else
$slqty=$blqty."<br/>";
}
}

if($chk > 0)
{
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
            <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_class['classification'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['stores_item'];?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['uom'];?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totups;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
		
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
            <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_class['classification'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['stores_item'];?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['uom'];?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totups;?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			
</tr>
<?php	
}
$srno=$srno+1;
}
}
}
}
}
?>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="900">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
