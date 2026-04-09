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
	$rid = $_GET['a'];	 
	}

$sql_issuesub=mysql_query("select * from tbl_captivesub where eid='".$rid."'") or die(mysql_error());
$row_issuesub=mysql_fetch_array($sql_issuesub);

$trid=$row_issuesub['id_in'];
$itmdchk="";
$sql_eindent_sub=mysql_query("select * from tbl_captivesub where id_in='".$trid."'") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['items_id'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['items_id'].",";
	}
}

/*$class_sql=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_issuesub['classification_id']."'") or die(mysql_error());
$row_class = mysql_fetch_array($class_sql);

$item_sql=mysql_query("select items_id, stores_item, uom from tbl_stores where items_id='".$row_issuesub['item_id']."'") or die(mysql_error());
$row_item = mysql_fetch_array($item_sql);*/


?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>		
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option <?php if($row_issuesub['classification_id']==$noticia_class['classification_id']){ echo "Selected"; }  ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select><font color="#FF0000">*</font>
	</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where classification_id='".$row_issuesub['classification_id']."' and actstatus='Active'") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option <?php if($row_issuesub['items_id']==$noticia_item['items_id']) { echo "Selected"; } ?> value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="68" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="169"  align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuesub['uom'];?>"  />&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />	
   <tr class="Light" height="25">
            <td align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="0" maxlength="5" onchange="piupschk();" onkeypress="return isNumberKey(event)" value="<?php echo $row_issuesub['ups'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="169"  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex="0" maxlength="7" onchange="piqtychk(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $row_issuesub['qty'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

</table><input name="txtrettype" value="good" type="hidden"><input name="txtrettyp" value="good" type="hidden"> 
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<?php
/*$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_tbl_sub['classification_id']."' and stlg_tritemid='".$row_tbl_sub['items_id']."'") or die(mysql_error());
*/



?>
 <tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
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
 <?php $rtotalups=0; $rtotalqty=0;
 if($row_issuesub['type'] == "good")
 {
 $sql_tbl_sub=mysql_query("select * from tbl_captive_sloc where isue_id='".$rid."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tbl_sub);


$srno=1;
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tbl_sub['issue_rowid']."'") or die(mysql_error()); 
$row_issuetbl=mysql_fetch_array($sql_issuetbl);

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
$rtotalups=$rtotalups+$row_issuetbl['stlg_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stlg_balqty'];
if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>"  name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>"  name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 }

$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_issuesub['classification_id']."' and stlg_tritemid='".$row_issuesub['items_id']."'") or die(mysql_error());

while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."'  and stlg_tritemid='".$row_issue['items_id']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'  and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
$sql_tbl_sub=mysql_query("select * from tbl_captive_sloc where issue_rowid='".$row_issuetbl['stlg_id']."' and isue_id='".$rid."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tbl_sub);

 if($tot_tblissue==0)
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
$rtotalups=$rtotalups+$row_issuetbl['stlg_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stlg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balups'];?>"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balups'];?>"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 }
 } 
 }
 else
 {
 
 
$sql_tbl_sub=mysql_query("select * from tbl_captive_sloc where isue_id='".$rid."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tbl_sub);


$srno=1;
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_tbl_sub['issue_rowid']."'") or die(mysql_error()); 
$row_issuetbl=mysql_fetch_array($sql_issuetbl);

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
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
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>"  name="slocissue" value="<?php echo $row_issuetbl['stld_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC"  /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>"  name="slocissue" value="<?php echo $row_issuetbl['stld_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC"  /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stld_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 }

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$row_issuesub['classification_id']."' and stld_tritemid='".$row_issuesub['item_id']."'") or die(mysql_error());

while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$row_issue['item_id']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."'  and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
$sql_tbl_sub=mysql_query("select * from tbl_captive_sloc where isue_rowid='".$row_issuetbl['stld_id']."' and issue_id='".$rid."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tbl_sub);

 if($tot_tblissue==0)
 {

  $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
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
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balups'];?>"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
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
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balups'];?>" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stld_balqty'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 }
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
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pupdateform();"   /></td>
</tr>
</table>
</div>