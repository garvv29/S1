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
	$rid = $_GET['g'];	 
	}

?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" valign="middle" class="tblheading">Pre Excess/Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Excess</td>
  <td align="center" colspan="2" valign="middle" class="tblheading">Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Post Ex/Sh Balance</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="66" align="center" valign="middle" class="tblheading">Select</td>
<td width="112" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="50" align="center" valign="middle" class="tblheading">UPS</td>
<td width="88" align="center" valign="middle" class="tblheading">Qty</td>
<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
<td width="73" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="63" align="center" valign="middle" class="tblheading">Qty</td>
<td width="76" align="center" valign="middle" class="tblheading">UPS</td>
<td width="65" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php

if($a=="good")
{
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$f."'") or die(mysql_error());

$srno=1;

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 

  $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issue['stlg_binid']."' and whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issue['stlg_subbinid']."' and binid='".$row_issue['stlg_binid']."' and whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups1_<?php echo $srno;?>" name="issueups1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk1(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty1_<?php echo $srno;?>" name="issueqty1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk1(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups1_<?php echo $srno;?>" name="issueups1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk1(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty1_<?php echo $srno;?>" name="issueqty1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk1(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
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

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 

  $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issue['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issue['stld_binid']."' and whid='".$row_issue['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issue['stld_subbinid']."' and binid='".$row_issue['stld_binid']."' and whid='".$row_issue['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stld_id'];?>" onclick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)"/></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups1_<?php echo $srno;?>" name="issueups1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk1(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty1_<?php echo $srno;?>" name="issueqty1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk1(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)"/></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stld_id'];?>" onclick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)"/></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups1_<?php echo $srno;?>" name="issueups1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="upschk1(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty1_<?php echo $srno;?>" name="issueqty1_<?php echo $srno;?>" class="tbltext" size="5" value="" onchange="qtychk1(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)"/></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 } 
 ?>
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
