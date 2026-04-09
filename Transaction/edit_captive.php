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
	
	//$id="22";
	//$name="Ram";
	
	if(isset($_GET['a']))
	{
	$id = $_GET['a'];	 
	}
	/*if(isset($_GET['idate']))
	{
	$date = $_GET['idate'];	 
	}
	if(isset($_GET['txtid1']))
	{
	$ino = $_GET['txtid1'];	 
	}
	if(isset($_GET['iraised']))
	{
	$id = $_GET['iraised'];	 
	}
	
	 if(isset($_GET['maintrid']))
	{
	echo $i1 = $_GET['maintrid'];	 
	}
			
	if(isset($_GET['txtclass']))
	{
	$classification = $_GET['txtclass'];	 
	}
	if(isset($_GET['txtitem']))
	{
	$items = $_GET['txtitem'];	 
	}
	if(isset($_GET['txtuom']))
	{
	$uom = $_GET['txtuom'];	 
	}
	if(isset($_GET['txtups']))
	{
	$ups = $_GET['txtups'];	 
	}
	if(isset($_GET['txtqty']))
	{
	 $qty = $_GET['txtqty'];	 
	}
		
	
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
if($i1 == 0)
{
 $sql_in1="insert into tbl_ieindent(code1 , tdate , code , id)values('$tid','$tdate','$ino','$id')";
if(mysql_query($sql_in1) or die(mysql_error()))
{
echo $mainid=mysql_insert_id();
//exit;
$sql_in="insert into tbl_ieindent_sub(id_in , classification_id , items_id , uom , ups , qty)values('$mainid','$classification','$items','$uom','$ups','$qty')";
}
 //
//exit;
mysql_query($sql_in) or die(mysql_error());
}
else
{
$sql_main="update tbl_ieindent set code='$tid', tdate='$tdate', code='$ino', id='$id'";
if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=$i1;

//$mainid=mysql_insert_id();
$sql_in="insert into tbl_ieindent_sub(id_in , classification_id , items_id , uom  ,  ups , qty)values('$mainid','$classification','$items','$uom','$ups','$qty')";
}
}
?>

<?php $i1=$mainid;
 echo $tid=$i1;
//exit;
?>
<?php
/*$sql_tbl=mysql_query("select * from tbl_ieindent_sub where  id_in='".$tid."'") or die(mysql_error());

$row_tbl=mysql_fetch_array($sql_tbl);			
$id_in=$row_tbl['id_in'];
*/
/*$sql_tbl_sub=mysql_query("select * from tbl_ieindent_sub where id_in='".$tid."'") or die(mysql_error());
$subtid=0;*/
?>
<?php
/*$srno=1;
$total_tbl=mysql_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);

$sql_item=mysql_query("select * from tbl_ieindent_sub where id_in='".$row_tbl_sub['id_in']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{
*/
?>	

<?php
/*$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Vendor' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];*/

$sql_tbl_sub=mysql_query("select * from tbl_captivesub where eid='".$id."'") or die(mysql_error());
$row_tbl_sub=mysql_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysql_num_rows($sql_tbl_sub);
echo $tid=$row_tbl_sub['id_in'];
echo $subtid=$rid;
?>		<!-- comment table--><title>Stores-TRansaction-edit Captive Consumption</title>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
	<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
	<?php 
$qry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
          <td align="right" valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onChange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($qry)) { ?>
		<option <?php if($noticia_class['classification_id']==$row_tbl_sub['classification_id']){ echo "Selected"; } ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select><font color="#FF0000">*</font>	</td></tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores classification_id='".$row_tbl_sub['classification_id']."' and actstatus='Active'") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" style="width:170px;" onChange="classchk(this.value);" >
<option value="" >--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option <?php if($noticia_item['items_id']==$row_tbl_sub['items_id']){ echo "Selected"; } ?> value="<?php echo $noticia_item['items_id'];?>" />   
		 <?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;</td>
         </tr>
		  
		 <tr class="Light" height="25">
           <td width="318" height="24"  align="right"  valign="middle" class="tblheading">UOM&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row_tbl_sub['uom'];?>" /></td>
         </tr>
		 

		 <tr class="Dark" height="25">
           <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex=""   maxlength="7"   value="<?php echo $row_tbl_sub['type'];?>" /></td>
         </tr>
		
		 <tr class="Dark" height="25">
          <td width="318" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;</td>
          <td align="left"  valign="middle" colspan="3">&nbsp;</td>
         </tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:hand;" onClick="pfrom1();" />&nbsp;&nbsp;</td>
</tr>
</table>