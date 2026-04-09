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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	//$id="42";
	//$name="Ram";
	
	
	if(isset($_GET['code']))
	{
	$tid = $_GET['code'];	 
	}
	if(isset($_GET['idate']))
	{
	$date = $_GET['idate'];	 
	}
	if(isset($_GET['ino']))
	{
	 $ino = $_GET['ino'];	 
	}
	if(isset($_GET['iraised']))
	{
	$id = $_GET['iraised'];	 
	}
	
	 if(isset($_GET['maintrid']))
	{
	$i1 = $_GET['maintrid'];	 
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
	
	if(isset($_GET['txtqty']))
	{
	 $qty = $_GET['txtqty'];	 
	}
	if(isset($_GET['subtrid']))
	{
	 $subtid = $_GET['subtrid'];	 
	}
	if(isset($_GET['txtremarks']))
	{
	 $txtremarks = $_GET['txtremarks'];	 
	}
	$txtremarks=str_replace("&","and",$txtremarks);
	
	$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;		
	
	
if($i1 == 0)
{
 $sql_in1="insert into tbl_ieindent(code1, tdate, id, yearcode, remarks)values('$tid', '$tdate', '$loginid', '$yearid_id', '$txtremarks')";
if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=mysql_insert_id();

$sql_in2="insert into tbl_ieindent_sub(id_in , classification_id , items_id , uom , ups , qty)values('$mainid','$classification','$items','$uom','0','$qty')";
//exit;
mysql_query($sql_in2) or die(mysql_error());
}
}
else
{
 $mainid=$i1;
if($subtid==0)
{
$sql_in="insert into tbl_ieindent_sub(id_in , classification_id , items_id , uom ,  ups , qty)values('$mainid','$classification','$items','$uom','0','$qty')";
mysql_query($sql_in) or die(mysql_error());
}
else
{
$sql_in12="update tbl_ieindent_sub set classification_id='$classification', items_id ='$items', uom='$uom',  ups='0', qty=qty where eid='$subtid'";
mysql_query($sql_in12) or die(mysql_error());
}
}
?>

<?php 
$i1=$mainid;
$tid=$i1;
//exit;
?>
<?php
$sql_tbl_sub=mysql_query("select * from tbl_ieindent_sub where id_in='".$tid."'") or die(mysql_error());
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse"> <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification </td>
<td width="114" align="center" class="tblheading" valign="middle">Item </td>
<td width="147" align="center" class="tblheading" valign="middle">Uom </td>
<td width="147" align="center" class="tblheading" valign="middle">Quantity</td>
<td width="147" align="center" class="tblheading" valign="middle">Edit</td>
<td width="171" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
$srno=1; $itmdchk="";
$total_tbl=mysql_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_tbl_sub['items_id'].",";
	}
	else
	{
	$itmdchk=$row_tbl_sub['items_id'].",";
	}
	
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['items_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);

$sql_item1=mysql_query("select * from tbl_ieindent_sub where eid='".$row_tbl_sub['eid']."'") or die(mysql_error());
$row_item1=mysql_fetch_array($sql_item1);
if($srno%2!=0)
{

?>			


<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0"  onclick="editrecid1(<?php echo $row_tbl_sub['eid'];?>);" style="cursor:pointer" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_item1['eid'];?>,<?php echo $row_item1['id_in'];?>,'');" /></td>
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
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0"  onclick="editrecid1(<?php echo $row_tbl_sub['eid'];?>);" style="cursor:pointer" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_item1['eid'];?>,<?php echo $row_item1['id_in'];?>,'');" /></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
<br/>
<div id="ind1" style="display:block">
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
		<option  value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?> 
		<tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="350" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="72" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="126" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="" />&nbsp;</td>
		 <tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex=""   maxlength="7"  onkeypress="return isNumberKey(event)" />&nbsp;</td>
</tr>
		 
</table><input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>