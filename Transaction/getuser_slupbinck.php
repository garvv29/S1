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
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
	{
	$g = $_GET['g'];	 
	}
if(isset($_GET['h']))
	{
	$h = $_GET['h'];	 
	}	
	//$d="";
$flag=0; 	
	if($c!="")
	{
		if($c=="txtslsubbg1")
		{
		if($f==1 || $f=="1"){$flag=1;} else { $flag=0; }
		$d="txtslupsg1";
		$id="txtslqtyg1";
		$uid="ups1";
		$qid="qty1";
		$u="upsf1(this.value)";
		$q="qtyf1(this.value)";
		}
		if($c=="txtslsubbg2")
		{
		if($f==2 || $f=="2"){$flag=2;} else { $flag=0; }
		$d="txtslupsg2";
		$id="txtslqtyg2";
		$uid="ups2";
		$qid="qty2";
		$u="upsf2(this.value)";
		$q="qtyf2(this.value)";
		}
		if($c=="txtslsubbg3")
		{
		if($f==3 || $f=="3"){$flag=3;} else { $flag=0; }
		$d="txtslupsg3";
		$id="txtslqtyg3";
		$uid="ups3";
		$qid="qty3";
		$u="upsf3(this.value)";
		$q="qtyf3(this.value)";
		}
		if($c=="txtslsubbd1")
		{
		if($f==4 || $f=="4"){$flag=4;} else { $flag=0; }
		$d="txtslupsd1";
		$id="txtslqtyd1";
		$uid="ups4";
		$qid="qty4";
		$u="upsf4(this.value)";
		$q="qtyf4(this.value)";
		}
		if($c=="txtslsubbd2")
		{
		if($f==5 || $f=="5"){$flag=5;} else { $flag=0; }
		$d="txtslupsd2";
		$id="txtslqtyd2";
		$uid="ups5";
		$qid="qty5";
		$u="upsf5(this.value)";
		$q="qtyf5(this.value)";
		}
		
	}


	//if($a==1)
	//{
	//$a=13;
	//}
//echo $flag; 
//echo $d;
$chkflg=0;
if($c=="txtslsubbg1" || $c=="txtslsubbg2" || $c=="txtslsubbg3")
{
$sql_tbl_stlg=mysql_query("select distinct stlg_subbinid from tbl_stldg_good where stlg_tritemid='".$b."'") or die (mysql_error());
$row_tbl_stlg=mysql_num_rows($sql_tbl_stlg);
if($row_tbl_stlg <=3)
{	$mmm=0;
	while($row_stldg=mysql_fetch_array($sql_tbl_stlg))
	{ $mmm++;
	if($row_stldg['stlg_subbinid'] == $b)
	{$chkflg++; $mmm--;}
	}
	if($mmm==0)$chkflg=1;
}
else
{$chkflg=0;}
$sql_month=mysql_query("select * from tbl_stldg_good where stlg_subbinid='".$a."' and stlg_tritemid!='".$b."'")or die("Error:".mysql_error());
$row_month=mysql_num_rows($sql_month); 
$row_ccc=mysql_fetch_array($sql_month);
$itmid=$row_ccc['stlg_tritemid'];
}
else
{
$sql_tbl_stlg=mysql_query("select distinct stld_subbinid from tbl_stldg_damage where stld_tritemid='".$b."'") or die (mysql_error());
$row_tbl_stlg=mysql_num_rows($sql_tbl_stlg);
if($row_tbl_stlg <=2)
{	$mmm=0;
	while($row_stldg=mysql_fetch_array($sql_tbl_stlg))
	{ $mmm++;
	if($row_stldg['stld_subbinid'] == $b)
	{$chkflg++; $mmm--;}
	}
	if($mmm==0)$chkflg=1;
}
else
{$chkflg=0;}
$sql_month=mysql_query("select * from tbl_stldg_damage where stld_subbinid='".$a."' and stld_tritemid!='".$b."'")or die("Error:".mysql_error());
$row_month=mysql_num_rows($sql_month); 
$row_ccc=mysql_fetch_array($sql_month);
$itmid=$row_ccc['stld_tritemid'];
}
//echo $chkflg;

/*$sql_month=mysql_query("select * from tblarr_sloc where subbin='".$a."' and item_id!='".$b."'")or die("Error:".mysql_error());
$row_month=mysql_num_rows($sql_month); 
$row_ccc=mysql_fetch_array($sql_month);*/

$sql_iiii=mysql_query("select * from tbl_stores where items_id='".$itmid."'")or die("Error:".mysql_error());
$row_iiii=mysql_num_rows($sql_iiii); 
$row_iiii=mysql_fetch_array($sql_iiii);
if($chkflg == 0)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">The selected item can be stored only in max 3/2 bins</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" />
</tr></table>
<?php
}
else if($row_month > 0)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">Allready ocupied with <font color="#FF0000"><?php echo $row_iiii['stores_item'];?></font></td>
</tr></table>
<?php
}
else
{
if($flag==0)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><?php
}
else
{
?><table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  readonly="true" style="background-color:#CCCCCC" value="<?php echo $g;?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  readonly="true" style="background-color:#CCCCCC" value="<?php echo $h;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><?php }}?>