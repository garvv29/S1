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
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
	
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
	else
	{ 
	$c="";
	}
	
	//$d="";
	
	if($c!="")
	{
		if($c=="txtslsubbg1")
		{
		$d="txtslupsg1";
		$id="txtslqtyg1";
		}
		if($c=="txtslsubbg2")
		{
		$d="txtslupsg2";
		$id="txtslqtyg2";
		}
		if($c=="txtslsubbg3")
		{
		$d="txtslupsg3";
		$id="txtslqtyg3";
		}
		if($c=="txtslsubbd1")
		{
		$d="txtslupsd1";
		$id="txtslqtyd1";
		}
		if($c=="txtslsubbd2")
		{
		$d="txtslupsd2";
		$id="txtslqtyd2";
		}
		
	}


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_month=mysql_query("select * from tblarr_sloc where subbin='".$a."' and item_id!='".$b."'")or die("Error:".mysql_error());
$row_month=mysql_num_rows($sql_month); 
$row_ccc=mysql_fetch_array($sql_month);

$sql_iiii=mysql_query("select * from tbl_stores where items_id='".$row_ccc['item_id']."'")or die("Error:".mysql_error());
$row_iiii=mysql_num_rows($sql_iiii); 
$row_iiii=mysql_fetch_array($sql_iiii);
if($row_month > 0)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">Allready ocupied with <font color="#FF0000"><?php echo $row_iiii['stores_item'];?></font></td>
</tr></table>
<?php
}
else
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $d;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="ups1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $id;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qty1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><?php
}
?>