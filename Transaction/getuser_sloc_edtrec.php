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
	$trid = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$subrid = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$stldgid = $_GET['c'];	 
	}	

		
$sql_in1=mysql_query("select * from tbl_sloc where slid=$trid") or die(mysql_error());
$row_in1=mysql_fetch_array($sql_in1);

$classid=$row_in1['classification_id'];
$itemid=$row_in1['items_id'];
$c=$row_in1['classification_id'];
$b=$row_in1['items_id'];
$typ=$row_in1['itmtype'];
$sql_subtbl=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."' and rowid='".$stldgid."'") or die(mysql_error());
$tot_subtbl=mysql_num_rows($sql_subtbl);

?>
<input type="hidden" name="orwoid" value="<?php echo $stldgid;?>" />
<?php
if($typ=="good")
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Transfer from</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="162" align="center" valign="middle" class="tblheading">WH</td>
<td width="152" align="center" valign="middle" class="tblheading">Bin</td>
<td width="182" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="182" align="center" valign="middle" class="tblheading">UPS</td>
<td width="160" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$whi=0;$bni=0;$sbni=0;
/*$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$b."'") or die(mysql_error());

$srno=1; //$cnt=0;

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$b."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 
*/$otups=0; $otqty=0;
$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$stldgid."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
$whi=$row_issuetbl['stlg_whid'];$bni=$row_issuetbl['stlg_binid'];$sbni=$row_issuetbl['stlg_subbinid'];   //$cnt++; 
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
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="osubid" value="<?php echo $row_issuetbl['stlg_subbinid'];?>" /></td>
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
  <td colspan="10" align="center" valign="middle" class="tblheading">Transfer to </td>
  </tr>
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
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


$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$b."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);
$srno=1;
$totups=0; $totqty=0; $cnt=0; $whid="";$binid="";$subbinid="";
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
 $sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$b."'") or die(mysql_error());

$row_issue1=mysql_fetch_array($sql_issue1); 
//echo $row_issue['stld_whid']."/".$row_issue['stld_binid']."/".$row_issue['stld_subbinid']."<br>";

if($trid > 0)
{
$sql_subtb=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."' and subbinid='".$row_issue['stlg_subbinid']."' and  binid='".$row_issue['stlg_binid']."' and  whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_subtb=mysql_num_rows($sql_subtb);
}
else
{
//$sql_subtb=mysql_query("select * from tbl_sloc_sub where gid='".$trid."' and rowid!='".$row_issue1[0]."'") or die(mysql_error());
$row_subtb=0;
}
//echo $row_subtb;
//echo $row_subtb=mysql_num_rows($sql_subtb);
//echo $t=mysql_num_rows($sql_issue1);
//echo $row_issue1[0];
if($row_subtb == 0)
{

//echo $row_issue1[0]."<br>";echo $t=mysql_num_rows($sql_issue1)."<br>";

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
// echo $row_issuetbl['stld_whid']."/".$row_issuetbl['stld_binid']."/".$row_issuetbl['stld_subbinid']."<br>";
 
 /*$sql_subtb=mysql_query("select * from tbl_sloc_sub where gid='".$trid."' and rowid='".$stldgid."'") or die(mysql_error());
 $tot_subt=mysql_num_rows($sql_subtb);
 $row_subt=mysql_fetch_array($sql_subtb);
 if($tot_subt == 0)
{*/
 $cnt++;
 $whid=$row_issuetbl['stlg_whid'];$binid=$row_issuetbl['stlg_binid'];$subbinid=$row_issuetbl['stlg_subbinid'];
 
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['stlg_balups'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['stlg_balqty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['stlg_balups'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['stlg_balqty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
</tr>
 <?php 
 }$srno++;
 } 
 } 
 }
?>
<?php //echo $cnt;
if($trid > 0 && $cnt <= 2)
 { 

 $p1_array=explode(",",$subrid);	
$numrec=count($p1_array);
 $ct=0;$up=0;$qt=0; $ups=0; $qty=0; $ups1=0; $qty1=0;
 $sql_gddist=mysql_query("select distinct whid, binid, subbinid from tbl_sloc_sub where slocid='".$trid."'") or die(mysql_error());
while($t_gddist=mysql_fetch_array($sql_gddist))
 {
 $sql_gdsum=mysql_query("select sum(ups), sum(qty) from tbl_sloc_sub where slocid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
$t_gdsum=mysql_fetch_array($sql_gdsum);
/*$up=$t_gdsum[0];
$qt=$t_gdsum[1];*/
//echo $p1_array[$ct];
/*$sql_iss=mysql_query("select max(slocsubid) from tbl_sloc_sub where gid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
 $t=mysql_fetch_array($sql_iss);*/
//$srno=1;
//echo $t[0];
$sql_issue=mysql_query("select * from tbl_sloc_sub where slocsubid='".$p1_array[$ct]."'") or die(mysql_error());
$totups=0; $totqty=0; 
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
  $up=$row_issue['opups'];
  $qt=$row_issue['opqty'];
  $ups=$row_issue['ups'];
  $qty=$row_issue['qty'];

$cnt++;
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value="<?php echo $ups;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $ups;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qty;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno;?>(this.value);" value="<?php echo $ups;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $ups;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qty;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php 
 }
 $srno++;
 } $ct++;
 }
 }
 ?>

</table>
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Transfer from</td>
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
$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$stldgid."' and stld_balqty > 0") or die(mysql_error()); 

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
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="osubid" value="<?php echo $row_issuetbl['stld_subbinid'];?>" /></td>
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
  <td colspan="10" align="center" valign="middle" class="tblheading">Transfer to</td>
  </tr>
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Damage</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
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
$totups=0; $totqty=0; $cnt=0; $whid="";$binid="";$subbinid="";
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
 $sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$b."'") or die(mysql_error());

$row_issue1=mysql_fetch_array($sql_issue1); 
//echo $row_issue['stld_whid']."/".$row_issue['stld_binid']."/".$row_issue['stld_subbinid']."<br>";

if($trid > 0)
{
$sql_subtb=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."' and subbinid='".$row_issue['stld_subbinid']."' and  binid='".$row_issue['stld_binid']."' and  whid='".$row_issue['stld_whid']."'") or die(mysql_error());
$row_subtb=mysql_num_rows($sql_subtb);
}
else
{
//$sql_subtb=mysql_query("select * from tbl_sloc_sub where gid='".$trid."' and rowid!='".$row_issue1[0]."'") or die(mysql_error());
$row_subtb=0;
}
//echo $row_subtb;
//echo $row_subtb=mysql_num_rows($sql_subtb);
//echo $t=mysql_num_rows($sql_issue1);
//echo $row_issue1[0];
if($row_subtb == 0)
{

//echo $row_issue1[0]."<br>";echo $t=mysql_num_rows($sql_issue1)."<br>";

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
// echo $row_issuetbl['stld_whid']."/".$row_issuetbl['stld_binid']."/".$row_issuetbl['stld_subbinid']."<br>";
 
 /*$sql_subtb=mysql_query("select * from tbl_sloc_sub where gid='".$trid."' and rowid='".$stldgid."'") or die(mysql_error());
 $tot_subt=mysql_num_rows($sql_subtb);
 $row_subt=mysql_fetch_array($sql_subtb);
 if($tot_subt == 0)
{*/
 $cnt++;
 $whid=$row_issuetbl['stld_whid'];$binid=$row_issuetbl['stld_binid'];$subbinid=$row_issuetbl['stld_subbinid'];
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value="<?php echo $row_issuetbl['stld_balups'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value="<?php echo $row_issuetbl['stld_balqty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value="<?php echo $row_issuetbl['stld_balups'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value="<?php echo $row_issuetbl['stld_balqty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_id'];?>" />
</tr>
 <?php 
 }$srno++;
 } 
 } 
 }
?>
<?php //echo $cnt;
if($trid > 0 && $cnt <= 2)
 { 

 $p1_array=explode(",",$subrid);	
$numrec=count($p1_array);
 $ct=0;$up=0;$qt=0; $ups=0; $qty=0; $ups1=0; $qty1=0;
 $sql_gddist=mysql_query("select distinct whid, binid, subbinid from tbl_sloc_sub where slocid='".$trid."'") or die(mysql_error());
while($t_gddist=mysql_fetch_array($sql_gddist))
 {
 $sql_gdsum=mysql_query("select sum(ups), sum(qty) from tbl_sloc_sub where slocid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
$t_gdsum=mysql_fetch_array($sql_gdsum);
/*$up=$t_gdsum[0];
$qt=$t_gdsum[1];*/
//echo $p1_array[$ct];
/*$sql_iss=mysql_query("select max(slocsubid) from tbl_sloc_sub where gid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysql_error());
 $t=mysql_fetch_array($sql_iss);*/
//$srno=1;
//echo $t[0];
$sql_issue=mysql_query("select * from tbl_sloc_sub where slocsubid='".$p1_array[$ct]."'") or die(mysql_error());
$totups=0; $totqty=0; 
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
  $up=$row_issue['opups'];
  $qt=$row_issue['opqty'];
  $ups=$row_issue['ups'];
  $qty=$row_issue['qty'];

$cnt++;
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value="<?php echo $ups;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="<?php echo $ups;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $qty;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
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
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value="<?php echo $ups;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="<?php echo $ups;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $qty;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php 
 }
 $srno++;
 } $ct++;
 }
 }
 ?>
</table>
<?php
}
//echo $cnt;
?>
<input type="hidden" name="cntchk" value="<?php echo $cnt;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;" onclick="pformupdate();" />&nbsp;&nbsp;</td>
</tr>
</table>