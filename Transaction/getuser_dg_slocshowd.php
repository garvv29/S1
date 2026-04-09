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

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$orid = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
	$rid = $_GET['h'];	 
	}

$trid=$f;
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Transfer from Damage</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="162" align="center" valign="middle" class="tblheading">WH</td>
<td width="152" align="center" valign="middle" class="tblheading">Bin</td>
<td width="182" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="182" align="center" valign="middle" class="tblheading">UPS</td>
<td width="160" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$otups=0; $otqty=0;
$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$orid."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 //$cnt++;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$otups=$totups+$row_issuetbl['stld_balups'];
$otqty=$totqty+$row_issuetbl['stld_balqty'];
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
</tr>
<?php
}
//}
?><input type="hidden" name="otups" value="<?php echo $otups;?>" /><input type="hidden" name="otqty" value="<?php echo $otqty;?>" />
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" valign="middle" class="tblheading">Transfer to Good </td>
  </tr>
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="86" align="center" valign="middle" class="tblheading">Bin</td>
<td width="100" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">UPS</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1;  //echo $trid;
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$c."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysql_query("select * from tbl_stores where items_id='".$b."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid=$row_item['stores_item'];


$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$b."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);
$srno=1;
$totups=0; $totqty=0; $cnt=0; $whid="";$binid="";$subbinid=""; $whid1="";$binid1="";$subbinid1="";
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
 $sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$b."'") or die(mysql_error());
//$row_subtb=0;
$row_issue1=mysql_fetch_array($sql_issue1); 

if($trid > 0)
{
$sql_subtb=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and subbinid='".$row_issue['stlg_subbinid']."' and  binid='".$row_issue['stlg_binid']."' and  whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_subtb=mysql_num_rows($sql_subtb);
}
else
{
//$sql_subtb=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' and rowid!='".$row_issue1[0]."'") or die(mysql_error());
$row_subtb=0;
}
//echo $row_subtb;
//echo $row_subtb=mysql_num_rows($sql_subtb);
//echo $t=mysql_num_rows($sql_issue1);
//echo $row_issue1[0];
if($row_subtb == 0)
{
/*$sql_subtb=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
$row_subtb=mysql_num_rows($sql_subtb);
//echo $t=mysql_num_rows($sql_issue1);
//echo $row_issue1[0];
if($row_subtb > 0)
{*/
$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
 $cnt++;
 
 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
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
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">

<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
</tr>
 <?php 
 }$srno++;
 } 
 } 
 }
// echo $cnt;
 if($trid > 0 && $cnt < 3)
 { 
 $ct=0;$up=0;$qt=0;
 $sql_gddist=mysql_query("select distinct whid, binid, subbinid from tbl_dtog_sub where did='".$trid."'") or die(mysql_error());
while($t_gddist=mysql_fetch_array($sql_gddist))
 {
 $sql_gdsum=mysql_query("select sum(ups), sum(qty) from tbl_dtog_sub where did='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
$t_gdsum=mysql_fetch_array($sql_gdsum);
/*$up=$t_gdsum[0];
$qt=$t_gdsum[1];*/

$sql_iss=mysql_query("select max(dgsubid) from tbl_dtog_sub where did='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
$t=mysql_fetch_array($sql_iss);
//$srno=1;
$sql_issue=mysql_query("select * from tbl_dtog_sub where dgsubid='".$t[0]."'") or die(mysql_error());
$totups=0; $totqty=0; 
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 $up=$row_issue['balups'];
 $qt=$row_issue['balqty'];
 /*if($ct==0)
 {
 $sql_gdsum=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
$t_gdsum=mysql_fetch_array($sql_gdsum);
echo $up=$t_gdsum[0];
echo $qt=$t_gdsum[1];
}
 if($ct==1)
 {
 $sql_gdsum=mysql_query("select sum(ups), sum(qty) from tbl_gtod_sub where gid='".$trid."' and whid='".$whid1."' and binid='".$binid1."' and subbinid='".$subbinid1."'") or die(mysql_error());
$t_gdsum=mysql_fetch_array($sql_gdsum);
echo $up=$t_gdsum[0];
echo $qt=$t_gdsum[1];
}*/

/* $sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['subbinid']."' and stld_binid='".$row_issue['binid']."' and stld_whid='".$row_issue['whid']."' and stld_tritemid='".$row_issue['items_id']."'") or die(mysql_error());

$row_issue1=mysql_fetch_array($sql_issue1); 
//echo $t=mysql_num_rows($sql_issue1);
//echo $row_issue1[0];
$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); */
//echo $t=mysql_num_rows($sql_issuetbl);
 /*while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { */$cnt++;$ct++;
 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issue['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_issue['ups'];
$totqty=$totqty+$row_issue['qty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php 
 }$srno++;
 } 
 }
 }
 ?>
<?php
if($cnt==0)
{
?>
<?php
$whd1_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>
<tr class="Light" height="30" >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysql_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
  <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbind1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
  <select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg1" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig1" value="0" />
</tr>
<?php
$whd2_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysql_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
  <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
  <select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<?php
$whd3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd3 = mysql_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;
  <select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;
  <select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>
<?php
}
else if($cnt==1)
{
?>
<?php
$whd2_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysql_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
  <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
  <select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig2" value="0" />
</tr>

<?php
$whd3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd3 = mysql_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;
  <select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;
  <select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>
<?php
}
else if($cnt==2)
{
?>
<?php
$whd3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd3 = mysql_fetch_array($whd3_query)) { ?>
		<option value="<?php echo $noticia_whd3['whid'];?>" />   
		<?php echo $noticia_whd3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;
  <select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;
  <select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowig3" value="0" />
</tr>
<?php
}
?>
</table>
<input type="hidden" name="tblslocnod" value="0" /> 
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>