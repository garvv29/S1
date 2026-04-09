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
	if(isset($_GET['trid']))
	{
	$trid = $_GET['trid'];	 
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
			$typ="Good";
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
			$typ="Good";
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
			$typ="Good";
		}
		if($c=="txtslsubbd1")
		{
			if($f==1 || $f=="1"){$flag=1;} else { $flag=0; }
			$d="txtslupsd1";
			$id="txtslqtyd1";
			$uid="ups4";
			$qid="qty4";
			$u="upsf4(this.value)";
			$q="qtyf4(this.value)";
			$typ="Damage";
		}
		if($c=="txtslsubbd2")
		{
			if($f==2 || $f=="2"){$flag=2;} else { $flag=0; }
			$d="txtslupsd2";
			$id="txtslqtyd2";
			$uid="ups5";
			$qid="qty5";
			$u="upsf5(this.value)";
			$q="qtyf5(this.value)";
			$typ="Damage";
		}
		
	}


$chkflg=0;
$trflg=0; $tflg=0; $row_month=0; $tpflg=0; $tpmflg=0; $itmid="";

$sql_ii=mysql_query("select * from tbl_stores where items_id='".$b."'")or die("Error:".mysql_error());
$row_ii=mysql_num_rows($sql_ii); 
$row_ii=mysql_fetch_array($sql_ii);
$class=$row_ii['classification_id'];

$sql_sbin=mysql_query("select * from tbl_subbin where sid='".$a."'")or die("Error:".mysql_error());
$row_sbn=mysql_num_rows($sql_sbin); 
$row_sbin=mysql_fetch_array($sql_sbin);
$tp=$row_sbin['status']; 

$sql_tr=mysql_query("select * from tblarr_sloc where arr_tr_id='".$trid."' and classification_id!='".$class."' and subbin='".$a."'") or die(mysql_error());
$tot_tr=mysql_num_rows($sql_tr);
if($tot_tr > 0)
{
	$trflg=1;
}
else
{
	$trflg=0;
	$sql_t=mysql_query("select * from tblarr_sloc where arr_tr_id='".$trid."' and classification_id='".$class."' and subbin='".$a."'") or die(mysql_error());
	while($row_tr=mysql_fetch_array($sql_t))
	{	
		if($c=="txtslsubbg1" || $c=="txtslsubbg2" || $c=="txtslsubbg3")
		{
			if($row_tr['qty_damage']!=0)
			{
			$tflg=1;
			}
			else
			{
			$tflg=0;
			}
		}
		else
		{
			if($row_tr['qty_good']!=0)
			{
			$tflg=1;
			}
			else
			{
			$tflg=0;
			}
		}
	}
}


if($typ=="Damage" && $tp=="Good")
{
	$tpmflg=1;
}
else if($typ=="Good" && $tp=="Damage")
{
	$tpmflg=1;
}
else
{ 
$tpmflg=0;
}

if($tpmflg==0)
{
	if(($tp=="Damage") && ($typ=="Empty" || $typ=="Damage"))
	{
		$s_good=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_subbinid='".$a."' and stlg_trclassid!='".$class."'") or die(mysql_error());
		//$r_good=mysql_fetch_array($s_good);
		$cnt=0;
		while($row_issueg=mysql_fetch_array($s_good))
 	{ 
	$sql_issueg1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issueg['stlg_subbinid']."' and stlg_binid='".$row_issueg['stlg_binid']."' and stlg_whid='".$row_issueg['stlg_whid']."'") or die(mysql_error());
	$row_issueg1=mysql_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issueg1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
	$totno=mysql_num_rows($sql_issuetblg);
	
		//$t_good=mysql_num_rows($s_good);
		
		if($totno > 0)
		{	
			$cnt++;
			//$tpflg=1;
		}
	}
		if($cnt > 0)
		{	
			$tpflg=1;
		}

		else
		{	
/*			$sql_tbl_stlg=mysql_query("select distinct stld_subbinid from tbl_stldg_damage where stld_tritemid='".$b."'") or die (mysql_error());
			$row_tbl_stlg=mysql_num_rows($sql_tbl_stlg);
			if($row_tbl_stlg <=2)
			{	$mmm=0;
				while($row_stldg=mysql_fetch_array($sql_tbl_stlg))
				{ 
					if($row_stldg['stld_subbinid'] == $a)
					{
						$chkflg++; //$mmm--;
					}
					$mmm++;
				}
				if($mmm>0)$chkflg=1; else $chkflg=0;
		     }
			
*/			

$s_good=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid, stld_tritemid from tbl_stldg_damage where stld_subbinid='".$a."' and stld_trclassid!='".$class."' group by stld_subbinid, stld_tritemid order by stld_subbinid") or die(mysql_error());
		//$r_good=mysql_fetch_array($s_good);
		$cnt=0;
		while($row_issueg=mysql_fetch_array($s_good))
 { 
	$sql_issueg1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issueg['stld_subbinid']."' and stld_binid='".$row_issueg['stld_binid']."' and stld_whid='".$row_issueg['stld_whid']."' and stld_tritemid='".$row_issueg['stld_tritemid']."'") or die(mysql_error());
	$row_issueg1=mysql_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issueg1[0]."' and stld_balqty > 0") or die(mysql_error()); 
	$row_month=mysql_num_rows($sql_issuetblg);
	if($row_month > 0)
	{
	$row_ccc=mysql_fetch_array($sql_issuetblg);
	$itmid=$row_ccc['stld_tritemid']; 
	break;
	}
}
/*$sql_month=mysql_query("select * from tbl_stldg_damage where stld_subbinid='".$a."' and stld_trclassid!='".$class."'")or die("Error:".mysql_error());
			$row_month=mysql_num_rows($sql_month); 
			$row_ccc=mysql_fetch_array($sql_month);
			$itmid=$row_ccc['stld_tritemid']; */
		}
	}
elseif(($tp=="Good") && ($typ=="Empty" || $typ=="Good"))
	{ 
		
		$s_good=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_subbinid='".$a."' and stld_trclassid!='".$class."'") or die(mysql_error());
		//$r_good=mysql_fetch_array($s_good);
		$cnt=0;
while($row_issueg=mysql_fetch_array($s_good))
{ 
	$sql_issueg1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issueg['stld_subbinid']."' and stld_binid='".$row_issueg['stld_binid']."' and stld_whid='".$row_issueg['stld_whid']."'") or die(mysql_error());
	$row_issueg1=mysql_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issueg1[0]."' and stld_balqty > 0") or die(mysql_error()); 
	$totno=mysql_num_rows($sql_issuetblg);
	
		//$t_good=mysql_num_rows($s_good);
		
		if($totno > 0)
		{	
			$cnt++;
			//$tpflg=1;
		}
}	
		if($cnt > 0)
		{	
			$tpflg=1;
		}
		/*$s_damage=mysql_query("select distinct stld_subbinid from tbl_stldg_damage where stld_subbinid='".$a."' and stld_trclassid!='".$class."'") or die(mysql_error());
		$r_damage=mysql_fetch_array($s_damage);
		$t_damage=mysql_num_rows($s_damage);
		if($t_damage > 0)
		{
			$tpflg=1;
		}*/
		else
		{
			/*$sql_tbl_stlg=mysql_query("select distinct stlg_subbinid from tbl_stldg_good where stlg_tritemid='".$b."'") or die (mysql_error());
			$row_tbl_stlg=mysql_num_rows($sql_tbl_stlg);
			if($row_tbl_stlg<=3)
			{	$mmm=0; 
				while($row_stldg=mysql_fetch_array($sql_tbl_stlg))
				{ 
					if($row_stldg['stlg_subbinid'] == $a)
					{
						$chkflg++; //$mmm--; echo $chkflg;
					}$mmm++;
				}
				if($mmm>0)$chkflg=1;//echo $mmm;
			}*/
			//echo $class;
			$s_good=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid, stlg_tritemid from tbl_stldg_good where stlg_subbinid='".$a."' and stlg_trclassid!='".$class."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid") or die(mysql_error());
		$r_good=mysql_num_rows($s_good);
		$cnt=0;
		while($row_issueg=mysql_fetch_array($s_good))
 { 
	$sql_issueg1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issueg['stlg_subbinid']."' and stlg_binid='".$row_issueg['stlg_binid']."' and stlg_whid='".$row_issueg['stlg_whid']."' and stlg_tritemid='".$row_issueg['stlg_tritemid']."'") or die(mysql_error());
	$row_issueg1=mysql_fetch_array($sql_issueg1);
	$t=mysql_num_rows($sql_issueg1);
	
	$sql_issuetblg=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issueg1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
	 $row_month=mysql_num_rows($sql_issuetblg);
	if($row_month > 0)
	{
	$row_ccc=mysql_fetch_array($sql_issuetblg);
	$itmid=$row_ccc['stlg_tritemid']; 
	break;
	}
}
/*			$sql_month=mysql_query("select * from tbl_stldg_good where stlg_subbinid='".$a."' and stlg_trclassid!='".$class."'")or die(mysql_error());
			$row_month=mysql_num_rows($sql_month); 
			$row_ccc=mysql_fetch_array($sql_month);
			$itmid=$row_ccc['stlg_tritemid'];*/
		}
	}
	else
	{
	$chkflg=0;
	}
}
		

//echo $chkflg;
//echo $tpflg;
//exit;

//echo $tpflg;
$sql_iiii=mysql_query("select * from tbl_stores where items_id='".$itmid."'")or die("Error:".mysql_error());
$row_iiii=mysql_num_rows($sql_iiii); 
$row_iiii=mysql_fetch_array($sql_iiii);
?>
<?php
if($trflg==1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">Please check, Bin is occupied by different Classification</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
}
elseif($tflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Item type (Good/Damage) is not matching. Please check it</td>
<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
}
elseif($tpmflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Item type (Good/Damage) is not matching. Please check it</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
}
elseif($tpflg == 1)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center"  valign="middle" class="tblheading" colspan="4">In the selected Bin, Item type (Good/Damage) is not matching. Please check it</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
/*}
elseif($chkflg == 0)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" colspan="4">The selected item can be stored only in max 3/2 bins</td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
*/
}
else if($row_month > 0)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="center" valign="middle" class="tblheading" >Already occupied with <font color="#FF0000"><?php echo $row_iiii['stores_item'];?></font></td><input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>" value="<?php echo $g;?>"  /><input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="hidden" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" value="<?php echo $h;?>" />
</tr></table>
<?php
}
else
{
if($flag==0)
{
?>
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)" onchange="<?php echo $u;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="<?php echo $q;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><?php
}
else
{
?><table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" ><tr>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $d;?>" id="<?php echo $uid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)"  value="<?php echo $g;?>"  onchange="<?php echo $u;?>"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="<?php echo $id;?>" id="<?php echo $qid;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  readonly="true" style="background-color:#CCCCCC" value="<?php echo $h;?>"  onchange="<?php echo $q;?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table><?php }}?>