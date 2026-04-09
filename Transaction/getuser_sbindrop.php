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
	$a = $_GET['a'];	 
	}


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_month=mysql_query("select sid, sname from tbl_subbin where binid='".$a."' order by sname")or die("Error:".mysql_error());
//$row_month=mysql_fetch_array($sql_month);
?>
&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing1 = mysql_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;