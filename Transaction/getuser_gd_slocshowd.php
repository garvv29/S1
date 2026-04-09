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
  <td colspan="6" align="center" valign="middle" class="tblheading">Transfer from Good </td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="162" align="center" valign="middle" class="tblheading">WH</td>
<td width="152" align="center" valign="middle" class="tblheading">Bin</td>
<td width="182" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="182" align="center" valign="middle" class="tblheading">UPS</td>
<td width="160" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
/*$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$b."'") or die(mysql_error());

$srno=1; //$cnt=0;

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$b."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 
*/$otups=0; $otqty=0;
$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$orid."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 //$cnt++;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$otups=$totups+$row_issuetbl['stlg_balups'];
$otqty=$totqty+$row_issuetbl['stlg_balqty'];
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
</tr>
<?php
}
//}
?><input type="hidden" name="otups" value="<?php echo $otups;?>" /><input type="hidden" name="otqty" value="<?php echo $otqty;?>" />
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" valign="middle" class="tblheading">Transfer to Damage </td>
  </tr>
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Damage</td>
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
$srno=1; 
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$c."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysql_query("select * from tbl_stores where items_id='".$b."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid=$row_item['stores_item'];


$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$c."' and stld_tritemid='".$b."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);
$srno=1;
$totups=0; $totqty=0; $cnt=0; $whid="";$binid="";$subbinid=""; $whid1="";$binid1="";$subbinid1="";
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
 $sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$b."'") or die(mysql_error());
//$row_subtb=0;
$row_issue1=mysql_fetch_array($sql_issue1); 
if($trid > 0)
{
$sql_subtb=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' and subbinid='".$row_issue['stld_subbinid']."' and  binid='".$row_issue['stld_binid']."' and  whid='".$row_issue['stld_whid']."'") or die(mysql_error());
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
$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
 $cnt++;
 
 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
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
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhd<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbind<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbd<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_id'];?>" />
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">

<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhd<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbind<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbd<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_id'];?>" />
</tr>
 <?php 
 }$srno++;
 } 
 } 
 }
// echo $cnt;
 if($trid > 0 && $cnt < 2)
 { 
 $ct=0;$up=0;$qt=0;
 $sql_gddist=mysql_query("select distinct whid, binid, subbinid from tbl_gtod_sub where gid='".$trid."'") or die(mysql_error());
while($t_gddist=mysql_fetch_array($sql_gddist))
 {
 $sql_gdsum=mysql_query("select sum(ups), sum(qty) from tbl_gtod_sub where gid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
$t_gdsum=mysql_fetch_array($sql_gdsum);
/*$up=$t_gdsum[0];
$qt=$t_gdsum[1];*/

$sql_iss=mysql_query("select max(gdsubid) from tbl_gtod_sub where gid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
$t=mysql_fetch_array($sql_iss);
//$srno=1;
$sql_issue=mysql_query("select * from tbl_gtod_sub where gdsubid='".$t[0]."'") or die(mysql_error());
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
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhd<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbind<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbd<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsd<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhd<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbind<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbd<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsd<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
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
  <select class="tbltext" name="txtslwhd1" style="width:70px;" onchange="wh4(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysql_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bind1">&nbsp;
  <select class="tbltext" name="txtslbind1" style="width:60px;" onchange="bin4(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbind1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbind1">&nbsp;
  <select class="tbltext" name="txtslsubbd1" style="width:60px;" onchange="subbin4(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsd1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd1" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid1" value="0" />
</tr>
<?php
$whd2_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhd2" style="width:70px;" onchange="wh5(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysql_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bind2">&nbsp;
  <select class="tbltext" name="txtslbind2" style="width:60px;" onchange="bin5(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbind2">&nbsp;
  <select class="tbltext" name="txtslsubbd2" style="width:60px;" onchange="subbin5(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid2" value="0" />
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
  <select class="tbltext" name="txtslwhd2" style="width:70px;" onchange="wh5(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysql_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="86" align="center"  valign="middle" class="tbltext" id="bind2">&nbsp;
  <select class="tbltext" name="txtslbind2" style="width:60px;" onchange="bin5(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="100" align="center"  valign="middle" class="tbltext" id="sbind2">&nbsp;
  <select class="tbltext" name="txtslsubbd2" style="width:60px;" onchange="subbin5(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exupsd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid2" value="0" />
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