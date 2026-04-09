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
	else
	{ 
	$b="";
	}
	
	//$d="";
	
	if($b!="")
	{
		if($b=="bing1")
		{
		$d="sbing1";
		$id="txtslbing1";
		}
		if($b=="bing2")
		{
		$d="sbing2";
		$id="txtslbing2";
		}
		if($b=="bing3")
		{
		$d="sbing3";
		$id="txtslbing3";
		}
		if($b=="bind1")
		{
		$d="sbind1";
		$id="txtslbind1";
		}
		if($b=="bind2")
		{
		$d="sbind2";
		$id="txtslbind2";
		}
		if($b=="bind3")
		{
		$d="sbind3";
		$id="txtslbind3";
		}
	}


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_month=mysql_query("select binid, binname from tbl_bin where whid='".$a."' order by binname")or die("Error:".mysql_error());
//$row_month=mysql_fetch_array($sql_month);

?>
&nbsp;<select class="tbltext" name="<?php echo $id;?>" style="width:80px;" <?php if($b=="bing1"){?>onchange="bin1(this.value);"<?php }if($b=="bing2"){?>onchange="bin2(this.value);"<?php }if($b=="bing3"){?>onchange="bin3(this.value);"<?php }if($b=="bind1"){?>onchange="bin4(this.value);"<?php }if($b=="bind2"){?>onchange="bin5(this.value);"<?php } ?>   >
<option value="" selected>-----Bin------</option>
	<?php while($noticia_bing1 = mysql_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;