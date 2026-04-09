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
	if(isset($_GET['txt']))
	{
	$type = $_GET['txt'];	 
	}
		
	
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
if($i1 == 0)
{
 $sql_in1="insert into tbl_captive(code , tdate , party_id , contactno , mode , tname , lrno , vno ,cname , docketno ,pmode ,address ,pname) values ('$code','$tdate','$pname', '$contact','$txt', '$tname', '$lorryno', '$vno','$cname', '$dc','$pmode','$address','$party')";
if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=mysql_insert_id();


 $sql_in="insert into tbl_captivesub(id_in , classification_id , items_id , uom ,type ,remarks)values('$mainid','$classification','$items','$uom','$type','$remarks')";


//exit;
mysql_query($sql_in) or die(mysql_error());
}
}
else
{
 $sql_main="update tbl_captive set code='$code' , tdate='$tdate' ,party_id='$pname' , contactno='$contact',mode='$txt',tname='$tname',lrno='$lorryno',vno='$lorryno',cname='$cname,
 docketno='$dc',pmode='$pmode',address='$address',pname='$party' where tid='$i1'";
if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=$i1;

//$mainid=mysql_insert_id();
$sql_in="update  tbl_captivesub set id_in ='$mainid', classification_id='$classification' , items_id='$items' , uom='$uom' ,type='$type' ,remarks=$remarks where id_in='$i1'";
}
}
//}
?>

<?php $i1=$mainid;
  $tid=$i1;
//exit;
?>
<?php
/*$sql_tbl=mysql_query("select * from tbl_ieindent_sub where  id_in='".$tid."'") or die(mysql_error());

$row_tbl=mysql_fetch_array($sql_tbl);			
$id_in=$row_tbl['id_in'];
*/
$sql_tbl_sub=mysql_query("select * from tbl_captivesub where id_in='".$tid."'") or die(mysql_error());
$subtid=0;
?>
<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['items_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);

$sql_item=mysql_query("select * from tbl_captivesub where id_in='".$row_tbl_sub['id_in']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{

?>			
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse"> <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification </td>
<td width="114" align="center" class="tblheading" valign="middle">Item </td>
<td width="147" align="center" class="tblheading" valign="middle">Uom </td>
<td width="114" align="center" class="tblheading" valign="middle">UPS</td>
<td width="147" align="center" class="tblheading" valign="middle">Quantity</td>
<td width="147" align="center" class="tblheading" valign="middle">Edit</td>
<td width="171" align="center" class="tblheading" valign="middle">Delete</td>
</tr>

<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['ups'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0"  onclick="editcap1(<?php echo $row_tbl_sub['id_in'];?>);" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand" /></td>
</tr>
<?php
	}
	else
	{ 
	
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['ups'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0"  onclick="editrecid1(<?php echo $row_tbl_sub['id_in'];?>);" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand" /></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
<div id="ind1" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
	<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
	<?php 
$qry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
		 <tr class="Dark" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;"   onchange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($qry)) { ?>
		<option <?php if($noticia_class['classification_id']==$row_tbl_sub['classification_id']){ echo "Selected"; } ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores order by stores_item") or die(mysql_error());
?> 
		<tr class="Light" height="25">
           <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Items &nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="item">&nbsp;<select class="tbltext" name="txtitem" style="width:230px;" onchange="classchk(this.value);" >
<option value="" >--Select Item--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
            <td align="left"  valign="middle" colspan="3" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row_tt['uom'];?>" /></td>
         </tr>
		 <tr class="Light" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Type &nbsp;</td>
            <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes"  />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No"  />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp; </td>
         </tr>
		

</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>