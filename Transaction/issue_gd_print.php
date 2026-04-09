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
<title>Stores- Transaction-Issue Good Damage Print</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

</head>
<body topmargin="0" >
<?php
	$sql1=mysql_query("select * from tbl_gtod where gid=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$trid=$pid; $erid=0;
	
	
	$classid=$row['classification_id'];
	$itemid=$row['items_id'];
	
	$tdate=$row['date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	$rettyp="good";
	 ?>   
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	 <input name="frm_action" value="submit" type="hidden"> 
	  
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Good To Damage</td>
</tr>

 <tr class="Dark" height="30">
 <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="260"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TGD".$row['code']."/".$yearid_id."/".$lgnid;?></td>

<td width="90" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="225" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<tr class="Light" height="30">
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row3['business_name'];?></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<?php echo $row3['address'];?>, <?php echo $row3['city'];?>, <?php echo $row3['state'];?></td>
</tr>
<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($quer3);
?>
		 <tr class="Light" height="25">
           <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?>&nbsp;</td>
         </tr>
<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
?> 
		<tr class="Dark" height="25">
           <td width="265" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle" id="item" class="tbltext">&nbsp;<?php echo $noticia_item['stores_item'];?>&nbsp;</td>
    
            <td width="265" height="24"  align="right"  valign="middle" class="tblheading">UOM&nbsp;</td>
           <td align="left"  valign="middle" id="uom" class="tbltext">&nbsp;<?php echo $row['uom'];?></td>
         </tr>
</table>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
    <td colspan="4" align="center" valign="middle" class="tblheading">Good Pre Transfer </td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Damage Transfer</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Good Post Transfer</td>
    <td colspan="2"  align="center" valign="middle" class="tblheading">Damage Post Transfer</td>
    </tr>
  <tr class="tblsubtitle" height="25">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
    <td width="95" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="60" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="65" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="86" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="68" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="71" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="75" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="70" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php

if($rettyp=="good")
{
$sql_issue=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' group by rowid") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
/*$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['subbinid']."' and stlg_binid='".$row_issue['binid']."' and stlg_whid='".$row_issue['whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); */

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue['rowid']."' and stlg_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 $sloc1="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];
$sloc1=$wareh1.$binn1.$subbinn1;
$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];

 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php //echo $row_issue1[0];
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;$slups=0; $slqty=0;
$sql_sloc=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' and rowid='".$row_issue['rowid']."'") or die(mysql_error());
//echo $t=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{ if($subrid!="")$subrid=$subrid.",".$row_sloc['gdsubid']; else $subrid=$row_sloc['gdsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];

$orwoid=$row_sloc['rowid'];
}

$balu=$row_issuetbl['stlg_balups']-$balu; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;$slups=0; $slqty=0;
$sql_sloc=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' and rowid='".$row_issue['rowid']."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{ if($subrid!="")$subrid=$subrid.",".$row_sloc['gdsubid']; else $subrid=$row_sloc['gdsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br />";
else
$slocs=$wareh.$binn.$subbinn."<br />";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br />";
else
$sups=$slups."<br />";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br />";
else
$sqty=$slqty."<br />";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stlg_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
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
$totups=0; $totqty=0; $sloc1="";
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_opqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

$sloc1=$wareh1.binn1.$subbinn1;

$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_gtod_sub where gid='".$trid."'and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['gdsubid']; else $subrid=$row_sloc['gdsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";

else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];

$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stlg_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_gtod_sub where gid='".$trid."'and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['gdsubid']; else $subrid=$row_sloc['gdsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stlg_balups']-$balu; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
</tr>
 <?php
 }$srno++;
 } 
 } 
 }
 ?>
</table>
<input type="hidden" name="trid" value="<?php echo $trid;?>" /><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark">
<td width="62" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="782" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
