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
$trid=0;
?>
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Stock in Hand</td>
  <td colspan="4" align="center" valign="middle" class="tblheading">Transfered to</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  <td width="20" colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="14" align="center" valign="middle" class="tblheading">#</td>
<td width="95" align="center" valign="middle" class="tblheading">Classification</td>
<td width="211" align="center" valign="middle" class="tblheading">Item</td>
<td width="69" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="210" align="center" valign="middle" class="tblheading">Item</td>
<td width="69" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$c."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysql_query("select * from tbl_stores where items_id='".$f."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid=$row_item['stores_item'];

$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$f."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
  
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
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
<td align="center" valign="middle" class="tblheading"><?php echo $classid;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><input type="radio" name="sloc_select" value="<?php echo $row_issue1[0]?>" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $classid;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><input type="radio" name="sloc_select" value="<?php echo $row_issue1[0]?>" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /></td>
 </tr>
 <?php 
 }$srno++;
 } 
 } 
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orowid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" />
<br />
<div id="subdiv">
<div id="sloc1" style="display:none">
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="7" align="center" class="tblheading">Transfer to&nbsp;</td>
  </tr>
<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where classification_id='".$c."' and items_id!='".$f."'") or die(mysql_error());
?>            
<tr class="Light" height="30" id="vitem">
<td width="215" align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td width="397" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem1" style="width:230px;" onchange="classchk1(this.value);" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;</td>
		
<td width="54" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="224" colspan="3" align="left" valign="middle" class="tbltext" id="uom1">&nbsp;
  <input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>
<div id="subsubdiv" style="display:block">
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td width="38" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
  <td colspan="5" align="center" valign="middle" class="tblheading">SLOC</td>
  <td width="310" colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Transfer Quantity</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="92" align="center" valign="middle" class="tblheading">WH</td>
<td width="90" align="center" valign="middle" class="tblheading">Bin</td>
<td width="109" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="90" align="center" valign="middle" class="tblheading">UPS</td>
<td width="105" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div></div>
