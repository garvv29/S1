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
	}*/
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
/*if($b!="")
	{
		if($b=="txtslsubbg1")
		{
		$d="subbin1(this.value)";
		}
		if($b=="txtslsubbg2")
		{
		$d="subbin2(this.value)";
		}
		if($b=="txtslsubbg3")
		{
		$d="subbin3(this.value)";
		}
		if($b=="txtslsubbd1")
		{
		$d="subbin4(this.value)";
		}
		if($b=="txtslsubbd2")
		{
		$d="subbin5(this.value)";
		}
		
	}*/
	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $b;
$sql_month=mysql_query("select sid, sname from tbl_subbin where binid='".$a."' order by sname")or die("Error:".mysql_error());
//$row_month=mysql_fetch_array($sql_month);
?>
&nbsp;<select class="tbltext" name="<?php echo $b;?>" style="width:80px;" <?php if($b=="txtslsubbg1"){ ?>onchange="subbin1(this.value);"<?php }if($b=="txtslsubbg2"){ ?>onchange="subbin2(this.value);"<?php }if($b=="txtslsubbg3"){?>onchange="subbin3(this.value);"<?php }if($b=="txtslsubbd1"){?>onchange="subbin4(this.value);"<?php }if($b=="txtslsubbd2"){?>onchange="subbin5(this.value);"<?php } ?>  >
<option value="" selected>-Sub-Bin-</option>
	<?php while($noticia_subbing1 = mysql_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;&nbsp;