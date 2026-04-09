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
/*if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}*/


	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $a;
$sql_month=mysql_query("SELECT id ,login FROM tbl_roles where stage='$a'")or die("Error:".mysql_error());
//$row_month=mysql_fetch_array($sql_month);

?>&nbsp;<select class="tbltext" name="txtrd" style="width:100px;" onchange="rtnbychk(this.value);"  >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysql_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['login'];?>" />   
		<?php echo $noticia['login'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="tblheading">OR Specify</font>&nbsp;&nbsp;<input name="txtrbd" id="rbd" type="text" size="10" class="tbltext" tabindex="" maxlength="7" />&nbsp;<font color="#FF0000">*</font>&nbsp;