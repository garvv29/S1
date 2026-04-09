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
	$g = $_GET['g'];	 
	}

?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
  <tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$c."' and stld_tritemid='".$f."'") or die(mysql_error());

$srno=1; $rtotalups=0; $rtotalqty=0; $cnt=0;

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$cnt++;
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
$rtotalups=$rtotalups+$row_issuetbl['stld_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stld_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC"  /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')"   onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  onkeypress="return isNumberKey(event)"/></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balups'];?>"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background-color:#CCCCCC"  /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stld_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC"  /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balups'];?>"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background-color:#CCCCCC"  /></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?></td>
<td align="center" valign="middle" class="tblheading" colspan="4">&nbsp;</td>
 </tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="8">Item not in Stock</td>
 </tr>
 <?php
 }
 ?>
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pform();"   /></td>
</tr>
</table>