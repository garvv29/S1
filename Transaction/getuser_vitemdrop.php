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
$flag=0; 
//echo $a;
$sql_month=mysql_query("select items_id, stores_item from tbl_stores where classification_id='".$a."' and actstatus='Active' order by stores_item")or die(mysql_error());
//$row_month=mysql_fetch_array($sql_month);
?><td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">SLOC Lookup</a></td>
<td align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td  align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />
&nbsp;	</td>
