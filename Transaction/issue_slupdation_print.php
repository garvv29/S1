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
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
/*$a="IE";
	$sql_code="SELECT MAX(issue_code) FROM tblissue where yearcode='$year_id' and issue_type='pindent' ORDER BY issue_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code."/".$yearid_id;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction-Captive Consumption Note</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
</head>
<body topmargin="0" >
<?php
	$sql1=mysql_query("select * from tbl_sloc where slid='".$pid."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$tdate=$row['issuedate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$c=$row['classification_id'];
$f=$row['items_id'];
$a=$row['itmtype'];
	 ?>   
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	 <input name="frm_action" value="submit" type="hidden"> 
	  
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation</td>
</tr>
 
<tr class="Dark" height="25">
           <td width="180" height="24"  align="right"  valign="middle" class="tblheading">Transction ID&nbsp;</td>
           <td width="359" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "TSU".$row['code']."/".$yearid_id."/".$lgnid;?></td>
		   
		   <td width="98" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
	      </tr>
 <?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$c."'") or die(mysql_error());
$noticia_class=mysql_fetch_array($quer3);
?>
		 <tr class="Dark" height="25">
           <td width="180"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?></td>
         </tr>
<?php 
$itemqry1=mysql_query("select * from tbl_stores where items_id='".$f."'") or die(mysql_error());
$row_itm=mysql_fetch_array($itemqry1);
?> 
		<tr class="Light" height="25">
           <td width="180" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle"  id="item" class="tbltext">&nbsp;<?php echo $row_itm['stores_item'];?></td>
                <td width="98" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
           <td align="left"  valign="middle"  id="uom" class="tbltext">&nbsp;<?php echo $row_itm['uom'];?></td>
         </tr>
		  <tr class="Dark" height="25">
		  <td width="180" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php if($row['itmtype'] == "good")  { echo "Good";} else{ echo "Damage";}?></td>
	      </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Original Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">UPS</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php

if($a=="good")
{
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$f."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 }
 else
 {
 

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$c."' and stld_tritemid='".$f."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Changed Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">UPS</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sr=1;

$sql_sloc_sub=mysql_query("select * from tbl_sloc_sub where slocid='".$pid."' order by slocsubid") or die (mysql_error());

while($row_sloc_sub=mysql_fetch_array($sql_sloc_sub))
{

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc_sub['subbinid']."' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


if($sr%2!=0)
{
?>
<tr class="Light" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['ups'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['ups'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
$sr++;
}
?>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
