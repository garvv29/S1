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
	}require_once("../include/config.php");
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
	$rid = $_GET['g'];	 
	}

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
 <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="84" align="center" valign="middle" class="tblheading">Bin</td>
<td width="103" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">UPS</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$c."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysql_query("select * from tbl_stores where items_id='".$f."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid=$row_item['stores_item'];

$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$f."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);
$srno=1;
$totups=0; $totqty=0; $cnt=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
  
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { $cnt++;
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
<td align="center" valign="middle" class="tbltext"><input type="text" name="exusp<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="exqty<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>

<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups<?php echo $srno?>" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty<?php echo $srno?>" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
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
<td align="center" valign="middle" class="tbltext"><input type="text" name="exusp<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="exqty<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups<?php echo $srno?>" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty<?php echo $srno?>" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
 </tr>
 <?php 
 }$srno++;
 } 
 } 
 ?>
<?php
if($cnt==0)
{
?>
<?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>
<tr class="Light" height="30" >
<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg1 = mysql_fetch_array($whg1_query)) { ?>
		<option value="<?php echo $noticia_whg1['whid'];?>" />   
		<?php echo $noticia_whg1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="84" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
  <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="103" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
  <select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid1" value="0" />
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups1" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>

</tr>
<?php
$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg2 = mysql_fetch_array($whg2_query)) { ?>
		<option value="<?php echo $noticia_whg2['whid'];?>" />   
		<?php echo $noticia_whg2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="84" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
  <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="103" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
  <select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups2" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid2" value="0" />
</tr>

<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="84" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;
  <select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="103" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;
  <select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups3" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid3" value="0" />
</tr>
<?php
}
else if($cnt==1)
{
?>
<?php
$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>
<tr class="Light" height="30"  >
<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg2 = mysql_fetch_array($whg2_query)) { ?>
		<option value="<?php echo $noticia_whg2['whid'];?>" />   
		<?php echo $noticia_whg2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="84" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
  <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="103" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
  <select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups2" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid2" value="0" />
</tr>

<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >
<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="84" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;
  <select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="103" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;
  <select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>	
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups3" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid3" value="0" />
</tr>
<?php
}
else if($cnt==2)
{
?>
<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >

<td width="98" align="center"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="txtslwhg3" style="width:70px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="84" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;
  <select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="103" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;
  <select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div></td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balups3" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td><input type="hidden" name="orowid3" value="0" />
</tr>
<?php
}
?>
</table>
<input type="hidden" name="tblslocnog" value="0" /><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Damage</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
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

$sql_item=mysql_query("select * from tbl_stores where items_id='".$f."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid=$row_item['stores_item'];

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$c."' and stld_tritemid='".$f."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);
$srno=1;
$totups=0; $totqty=0; $cnt=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
 $sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$f."'") or die(mysql_error());

$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { $cnt++;
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
<td align="center" valign="middle" class="tblheading"><input type="text" name="exuspd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_id'];?>" />
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
<td align="center" valign="middle" class="tblheading"><input type="text" name="exuspd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balups'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd<?php echo $srno?>" id="ups<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd<?php echo $srno?>" id="qty<?php echo $srno+3;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno+3;?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd<?php echo $srno?>" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd<?php echo $srno?>" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stld_id'];?>" />
</tr>
 <?php 
 }$srno++;
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
<td align="center" valign="middle" class="tblheading"><input type="text" name="exuspd1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf4(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd1" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
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
<td align="center" valign="middle" class="tblheading"><input type="text" name="exuspd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd2" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
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
<td align="center" valign="middle" class="tblheading"><input type="text" name="exuspd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="47" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="upsf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsd2" class="tbltext" value="" onkeypress="return isNumberKey(event)" size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyd2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid2" value="0" />
</tr>
<?php
}
?>
</table><input type="hidden" name="tblslocnod" value="0" />