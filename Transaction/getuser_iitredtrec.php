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

		
$sql_in1=mysql_query("select * from tbl_iitr where iitr_id=$trid") or die(mysql_error());
$row_in1=mysql_fetch_array($sql_in1);

$classid=$row_in1['classification_id'];
$itemid=$row_in1['items_id_from'];
$a=$row_in1['typ'];

$sql_subtbl=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$stldgid."'") or die(mysql_error());
$tot_subtbl=mysql_num_rows($sql_subtbl);
//$row_subtbl=mysql_fetch_array($sql_subtbl);

$sql_subtbl1=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$stldgid."'") or die(mysql_error());
//echo $tot_subtbl=mysql_num_rows($sql_subtbl1);
$row_subtbl1=mysql_fetch_array($sql_subtbl1);
$itemid1=$row_subtbl1['items_id'];
?>
<input type="hidden" name="orowid" value="<?php echo $stldgid;?>" />
<div  id="sloc1" style="display:<?php if($tot_subtbl > 0) { echo "Block"; } else { echo "none"; } ?>">
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="7" align="center" class="tblheading">Transfer to&nbsp;</td>
  </tr>
<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where classification_id='".$classid."' and items_id!='".$itemid."' and actstatus='Active'") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td width="215" align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td width="397" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem1" style="width:230px;" onchange="classchk1(this.value);" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option <?php if($row_subtbl1['items_id']== $noticia_item['items_id']) { echo "Selected"; } ?> value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="54" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="224" colspan="3" align="left" valign="middle" class="tbltext" id="uom1">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_subtbl1['uom'];?>"  />&nbsp;</td>
</tr>
</table>
<div id="subsubdiv" style="display:block">
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="34" align="center" valign="middle" class="tblheading">#</td>
<td width="95" align="center" valign="middle" class="tblheading">WH</td>
<td width="93" align="center" valign="middle" class="tblheading">Bin</td>
<td width="100" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="93" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">UPS</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php

$srno=1;$cnt=0;
while($row_subtbl=mysql_fetch_array($sql_subtbl))
{

$cnt++;
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_subtbl['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_subtbl['binid']."' and whid='".$row_subtbl['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_subtbl['subbinid']."' and binid='".$row_subtbl['binid']."' and whid='".$row_subtbl['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_subtbl['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_subtbl['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_subtbl['subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balups']+$row_subtbl['ups_to'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balqty']+$row_subtbl['qty_to'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno?>(this.value);" value="<?php echo $row_subtbl['ups_to'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_subtbl['qty_to'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
 </tr>
  <?php
 }
 else
 {
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_subtbl['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_subtbl['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_subtbl['subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balups']+$row_subtbl['ups_to'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balqty']+$row_subtbl['qty_to'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno?>(this.value);" value="<?php echo $row_subtbl['ups_to'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_subtbl['qty_to'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balups'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_subtbl['balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_id'];?>" />
 </tr>
 <?php 
 }$srno++;
 } 
 //} 
 ?>
<?php
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid1."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$classid."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysql_query("select * from tbl_stores where items_id='".$itemid1."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid=$row_item['stores_item'];

//$srno=1;
$totups=0; $totqty=0; 
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
  
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid1."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

//echo $t=mysql_num_rows($sql_issue1);
if($trid > 0)
{
$sql_subtb=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and subbinid='".$row_issue['stlg_subbinid']."' and  binid='".$row_issue['stlg_binid']."' and  whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
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
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['stlg_subbinid'];?>" /></td>
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balups'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<?php
//echo $cnt;
if($cnt==0)
{
?>
<?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>
<tr class="Light" height="30" >
<td width="38" align="center"  valign="middle" class="tblheading"><?php echo $srno;?></td>
<td width="92" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:60px;" onchange="wh1(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg1 = mysql_fetch_array($whg1_query)) { ?>
		<option value="<?php echo $noticia_whg1['whid'];?>" />   
		<?php echo $noticia_whg1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="90" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="109" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg1" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg1" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> 
</tr>
<?php
$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >
<td width="38" align="center"  valign="middle" class="tblheading"><?php echo $srno+1;?></td>
<td width="92" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:60px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg2 = mysql_fetch_array($whg2_query)) { ?>
		<option value="<?php echo $noticia_whg2['whid'];?>" />   
		<?php echo $noticia_whg2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="90" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="109" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="48" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> 
</tr>

<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >
<td width="38" align="center"  valign="middle" class="tblheading"><?php echo $srno+2;?></td>
<td width="92" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:60px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="90" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="109" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> 
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
<td width="38" align="center"  valign="middle" class="tblheading"><?php echo $srno+1;?></td>
<td width="92" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:60px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg2 = mysql_fetch_array($whg2_query)) { ?>
		<option value="<?php echo $noticia_whg2['whid'];?>" />   
		<?php echo $noticia_whg2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="90" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="109" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="48" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg2" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg2" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> 
</tr>

<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

<tr class="Light" height="30"  >
<td width="38" align="center"  valign="middle" class="tblheading"><?php echo $srno+2;?></td>
<td width="92" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:60px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="90" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="109" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>	
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> 
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
<td width="38" align="center"  valign="middle" class="tblheading"><?php echo $srno+2;?></td>
<td width="92" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:60px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>

<td width="90" align="center"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	

<td width="109" align="center"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td colspan="2"  valign="middle">
<div id="slcrow3">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exusp3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqty3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="4" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balupsg3" class="tbltext" value=""  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg3" class="tbltext" value="" readonly="true" style="background:#CCCCCC" size="3" /></td> 
</tr>
<?php
}
?>
</table></div>
<table align="center" width="914" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:hand;" onclick="pformupdate();" />&nbsp;&nbsp;</td>
</tr>
</table></div>