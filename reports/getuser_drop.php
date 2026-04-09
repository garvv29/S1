<?php
/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	else
	{
	$yearid_id=$_SESSION['year_id'];
	$role=$_SESSION['role'];
   $loginid=$_SESSION[['loginid'];
	}*/require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
/*if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}*/


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_month=mysql_query("select items_id, stores_item from tbl_stores where classification_id='$a'")or die("Error:".mysql_error());
//$row_month=mysql_fetch_array($sql_month);

?>&nbsp;<select class="tbltext" name="txtitem" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;</td>
		
<!--/*<td width="174" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="133" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>*/-->