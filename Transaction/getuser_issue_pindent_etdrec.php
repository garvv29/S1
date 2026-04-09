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

$sql_issuesub=mysql_query("select * from tblissue_sub where issuesub_id='".$rid."'") or die(mysql_error());
$row_issuesub=mysql_fetch_array($sql_issuesub);
$trid=$row_issuesub['issue_id'];
$itmdchk="";
$sql_eindent_sub=mysql_query("select * from tblissue_sub where issue_id='".$trid."'") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['item_id'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['item_id'].",";
	}
}	



?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 		
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="6" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
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
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option <?php if($row_issuesub['item_id']==$noticia_item['items_id']) { echo "Selected"; } ?> value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="68" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuesub['uom'];?>"  />&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />

		 <tr class="Light" height="25">
           <td align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="0" maxlength="5" onchange="piupschk();" onkeypress="return isNumberKey(event)" value="<?php echo $row_issuesub['ups_indent'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        <td width="68" align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex="0" maxlength="7" onchange="piqtychk(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $row_issuesub['qty_indent'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<?php
/*$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_tbl_sub['classification_id']."' and stlg_tritemid='".$row_tbl_sub['items_id']."'") or die(mysql_error());
*/
$sql_tbl_sub=mysql_query("select * from tblissue_sloc where issue_id='".$rid."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tbl_sub);


?>
<tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="52" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="136" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="95" align="center" valign="middle" class="tblheading">UPS</td>
<td width="96" align="center" valign="middle" class="tblheading">Qty</td>
<td width="92" align="center" valign="middle" class="tblheading">UPS</td>
<td width="94" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="83" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
 <?php
$srno=1; $rtotalups=0; $rtotalqty=0;
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
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>"  checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>"  checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 }

$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_issuesub['classification_id']."' and stlg_tritemid='".$row_issuesub['item_id']."'") or die(mysql_error());

while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]." and stlg_balqty >0'") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
$sql_tbl_sub=mysql_query("select * from tblissue_sloc where issue_rowid='".$row_issuetbl['stlg_id']."' and issue_id='".$rid."'") or die(mysql_error());
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
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balups'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balqty'];?>"  readonly="true" style="background-color:#CCCCCC" /></td>
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
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balups'];?>"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balqty'];?>"   readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
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
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:hand;"  onclick="pupdateform();"   /></td>
</tr>
</table>
</div>