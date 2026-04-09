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
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
    <td colspan="4" align="center" valign="middle" class="tblheading">Damage Pre Transfer </td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Good Transfer</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Damage Post Transfer</td>
    <td colspan="2"  align="center" valign="middle" class="tblheading">Good Post Transfer</td>
    <td width="52" rowspan="2"  align="center" valign="middle" class="tblheading">Edit</td>
  </tr>
  <tr class="tblsubtitle" height="25">
    <td width="32" align="center" valign="middle" class="tblheading">#</td>
    <td width="99" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="63" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="68" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="89" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="64" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="71" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="74" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="79" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="64" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="69" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$c."' and stld_tritemid='".$f."'") or die(mysql_error());
//echo $t=mysql_num_rows($sql_issue);
$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 $sloc="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh.$binn.$subbinn;

$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><img src="../images/addnew.jpg" border="0" style="cursor:hand" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><img src="../images/addnew.jpg" border="0" style="cursor:hand" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /></td>
 </tr>
 <?php

 }$srno++;
 } 
 } 
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" />
