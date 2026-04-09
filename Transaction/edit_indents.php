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
	$id = $_GET['a'];	 
	}

$sql_tbl_sub=mysql_query("select * from tbl_ieindent_sub where eid='".$id."'") or die(mysql_error());
$row_tbl_sub=mysql_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysql_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['id_in'];
$subtid=$row_tbl_sub['eid'];

$sql_tbl=mysql_query("select * from tbl_ieindent_sub where eid='".$id."'") or die(mysql_error());
$srno=1; $itmdchk="";
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl=mysql_fetch_array($sql_tbl))
{
if($itmdchk!="")
{
$itmdchk=$itmdchk.$row_tbl['items_id'].",";
}
else
{
$itmdchk=$row_tbl['items_id'].",";
}

}
}
else
{
$itmdchk="";
}


?>	
<script type="text/javascript" >	<!-- comment table--><title>Stores- Transaction-Edit Indents</title>
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
	  </script>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
	<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
	<?php 
$qry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="192"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;"   onchange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($qry)) { ?>
		<option <?php if($noticia_class['classification_id']==$row_tbl_sub['classification_id']){ echo "Selected"; } ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where classification_id='".$row_tbl_sub['classification_id']."'  and actstatus='Active' order by stores_item") or die(mysql_error());
?> 
		<tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="350" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" >--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option <?php if($noticia_item['items_id']==$row_tbl_sub['items_id']){ echo "Selected"; } ?> value="<?php echo $noticia_item['items_id'];?>" />   
		 <?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;&nbsp;</td>
		
<td width="72" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="126" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row_tbl_sub['uom'];?>" />&nbsp;</td>
		 <tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex=""   maxlength="7"   value="<?php echo $row_tbl_sub['qty'];?>" onkeypress="return isNumberKey(event)" />&nbsp;</td>
         </tr>
		 
</table><input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:hand;" onclick="peditform();" />&nbsp;&nbsp;</td>
</tr>
</table>
