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

if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
$c="Empty";
if($b!="")
	{
		if($b=="txtslsubbg1")
		{
		$d="Good";
		$id="sb1";
		}
		if($b=="txtslsubbg2")
		{
		$d="Good";
		$id="sb2";
		}
		if($b=="txtslsubbg3")
		{
		$d="Good";
		$id="sb3";
		}
		if($b=="txtslsubbd1")
		{
		$d="Damage";
		$id="sb4";
		}
		if($b=="txtslsubbd2")
		{
		$d="Damage";
		$id="sb5";
		}
		
	}
	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $b;
$sql_month=mysql_query("select sid, sname from tbl_subbin where binid='".$a."' order by sname")or die("Error:".mysql_error());
//$row_month=mysql_fetch_array($sql_month);
?>
&nbsp;<select class="tbltext" id="<?php echo $id;?>" name="<?php echo $b;?>" style="width:60px;" <?php if($b=="txtslsubbg1"){ ?>onchange="subbin1(this.value);"<?php }if($b=="txtslsubbg2"){ ?>onchange="subbin2(this.value);"<?php }if($b=="txtslsubbg3"){?>onchange="subbin3(this.value);"<?php }if($b=="txtslsubbd1"){?>onchange="subbin4(this.value);"<?php }if($b=="txtslsubbd2"){?>onchange="subbin5(this.value);"<?php } ?>  >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing1 = mysql_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;