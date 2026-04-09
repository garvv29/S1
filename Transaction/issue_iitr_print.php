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

	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction-Inter Item Transaction Print</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

</head>
<body topmargin="0" >
<?php
	$sql1=mysql_query("select * from tbl_iitr where iitr_id=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$trid=$pid; $erid=0;
	
	
	$classid=$row['classification_id'];
	$itemid=$row['items_id_from'];
	$rettyp=$row['typ'];
	
	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	 ?>   
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	 <input name="frm_action" value="submit" type="hidden"> 
	  
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Inter Item Transfer</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
 <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="260"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "IT".$row['tcode']."/".$yearid_id;?></td>

<td width="90" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="225" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($quer3);
?>
		 <tr class="Dark" height="25">
           <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?>&nbsp;</td>
         </tr>
<?php 
$itemqry=mysql_query("select * from tbl_stores where items_id='".$row['items_id_from']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
?> 
		<tr class="Light" height="25">
           <td width="265" height="24"  align="right"  valign="middle" class="tblheading">Items &nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="item" class="tbltext">&nbsp;<?php echo $noticia_item['stores_item'];?>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
            <td width="265" height="24"  align="right"  valign="middle" class="tblheading">UOM&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="uom" class="tbltext">&nbsp;<?php echo $noticia_item['uom'];?></td>
         </tr>
		 <tr class="Light" height="25">
            <td width="265" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="uom" class="tbltext">&nbsp;<?php echo ucwords($row['typ']);?></td>
         </tr>
</table><br />


<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Stock in Hand</td>
  <td colspan="4" align="center" valign="middle" class="tblheading">Transfered to</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="19" align="center" valign="middle" class="tblheading">#</td>
<td width="111" align="center" valign="middle" class="tblheading">Classification</td>
<td width="178" align="center" valign="middle" class="tblheading">Item</td>
<td width="74" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="28" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="174" align="center" valign="middle" class="tblheading">Item</td>
<td width="78" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="28" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="28" align="center" valign="middle" class="tblheading">UPS</td>
<td width="40" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$classid."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid1=$row_class['classification'];

$sql_item=mysql_query("select * from tbl_stores where items_id='".$itemid."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid1=$row_item['stores_item'];


$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $classid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh1=""; $binn1=""; $subbinn1=""; $sups1="";$sqty1=""; $slocs1=""; $gd1=""; $balu=0; $balq=0; $subrid="";$itemid2="";$slups1="";$slqty1="";
$sql_sloc=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$row_issuetbl['stlg_id']."'") or die(mysql_error());
$zzz=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{ 

$slups1=0; $slqty1=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['iitrsub_id']; else $subrid=$row_sloc['iitrsub_id'];

$sql_item2=mysql_query("select * from tbl_stores where items_id='".$row_sloc['items_id']."'") or die(mysql_error());
$row_item2=mysql_fetch_array($sql_item2);
$itemid2=$row_item2['stores_item'];

//echo $row_sloc['whid']; echo $row_sloc['binid']; echo $row_sloc['subbinid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

if($slocs1!="")
$slocs1=$slocs1.$wareh1.$binn1.$subbinn1."<br/>";
else
$slocs1=$wareh1.$binn1.$subbinn1."<br/>";

$slups1=$slups1+$row_sloc['ups_to'];
if($sups1!="")
$sups1=$sups1.$slups1."<br/>";
else
$sups1=$slups1."<br/>";
$slqty1=$slqty1+$row_sloc['qty_to'];
if($sqty1!="")
$sqty1=$sqty1.$slqty1."<br/>";
else
$sqty1=$slqty1."<br/>";

$balu=$balu+$slups1;
$balq=$balq+$slqty1;
}
$balu=$row_issuetbl['stlg_balups']-$balu; 
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0){ if($balq <=0 ){$balu=0;} else{ $balu=1;}}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $itemid2;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $classid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh1=""; $binn1=""; $subbinn1=""; $sups1="";$sqty1=0; $slocs1=""; $gd1=""; $balu=0; $balq=0; $subrid="";$itemid2="";$slups1="";$slqty1="";
$sql_sloc=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$row_issuetbl['stlg_id']."'") or die(mysql_error());
$zzz=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{
$slups1=0; $slqty1=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['iitrsub_id']; else $subrid=$row_sloc['iitrsub_id'];

$sql_item2=mysql_query("select * from tbl_stores where items_id='".$row_sloc['items_id']."'") or die(mysql_error());
$row_item2=mysql_fetch_array($sql_item2);
$itemid2=$row_item2['stores_item'];


$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

if($slocs1!="")
$slocs1=$slocs1.$wareh1.$binn1.$subbinn1."<br/>";
else
$slocs1=$wareh1.$binn1.$subbinn1."<br/>";

$slups1=$slups1+$row_sloc['ups_to'];
if($sups1!="")
$sups1=$sups1.$slups1."<br/>";
else
$sups1=$slups1."<br/>";
$slqty1=$slqty1+$row_sloc['qty_to'];
if($sqty1!="")
$sqty1=$sqty1.$slqty1."<br/>";
else
$sqty1=$slqty1."<br/>";

$balu=$balu+$slups1;
$balq=$balq+$slqty1;
}
$balu=$row_issuetbl['stlg_balups']-$balu; 
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0){ if($balq <=0 ){$balu=0;} else{ $balu=1;}}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $itemid2;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
</tr>
 <?php
 }$srno++;
 }
 } 
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orowid" value="" />
</table>
<input type="hidden" name="trid" value="<?php echo $trid;?>" /><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark">
<td width="92" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="752" align="left"  valign="middle" class="tbltext"><?php echo $row['remarks'];?></td>
</tr>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
