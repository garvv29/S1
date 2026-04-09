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
	
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	/*if(isset($_REQUEST['dept']))
	{
	$dept = $_REQUEST['dept'];
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

</head>
<body topmargin="0" >
<?php  
$sql_item=mysql_query("select * from tbl_stores where items_id='".$itmid."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$classid=$row_item['classification_id'];

$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$classid."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

?>
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
  
   
  <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <table  border="1" cellspacing="0" cellpadding="0" width="400" align="center" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
  <td colspan="5" align="center" class="subheading" valign="middle" style="border:thin; border-color:#4ea1e1">&nbsp;SLOC</td>
</tr>
<tr class="tblsubtitle" height="25">
  <td colspan="5" align="center" class="smalltblheading" valign="middle" style="border:thin; border-color:#4ea1e1">&nbsp;<?php echo $noticia_class['classification'];?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $row_item['stores_item'];?></td>
</tr>

<tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading">#</td>
<td width="161"  align="left" valign="middle" class="tblheading">&nbsp;Bin</td>
<td width="44"  align="center" valign="middle" class="tblheading">G/D</td>
<td width="56"  align="center" valign="middle" class="tblheading">UPS</td>
<td width="66"  align="center" valign="middle" class="tblheading">QTY</td>
</tr>
 <?php
$srno=1;  $tot1=0; $tot2=0; 
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itmid."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);

$totups=0; $totqty=0; $cnt=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
  
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itmid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 {
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$slups=0; $slqty=0;$gd="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
//$r=mysql_num_rows($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_issuetbl['stlg_balups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_issuetbl['stlg_balqty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";
$tot1=$tot1+$slups;
$tot2=$tot2+$slqty;

	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
<td width="31" valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $slocs;?></td>
<td align="center" valign="middle" class="tbltext">G</td>
<td align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
</tr>
<?php
	}
	else
	{
?>
<tr class="Dark" height="25">
<td width="31" valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $slocs;?></td>
<td align="center" valign="middle" class="tbltext">G</td>
<td align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
?>
<tr class="Dark" height="25">
<td width="31" valign="middle" class="tbltext" align="center"></td>
<td colspan="2" align="left" valign="middle" class="tblheading">&nbsp;Total Good</td>
<td align="center" valign="middle" class="tblheading"><?php echo $tot1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $tot2;?></td>
</tr>
<?php	 $tot1=0; $tot2=0; 
	$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid='".$itmid."'") or die(mysql_error());
$t=mysql_num_rows($sql_issue);
$srno=1;
$totups=0; $totqty=0; $cnt=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
 $sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itmid."'") or die(mysql_error());

$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
//echo $t=mysql_num_rows($sql_issuetbl);
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 {
	$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$slups=0; $slqty=0;$gd="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
//$r=mysql_num_rows($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_issuetbl['stld_balups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_issuetbl['stld_balqty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";
$tot1=$tot1+$slups;
$tot2=$tot2+$slqty;

	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
<td width="31" valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $slocs;?></td>
<td align="center" valign="middle" class="tbltext">D</td>
<td align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
</tr>
<?php
	}
	else
	{
?>
<tr class="Dark" height="25">
<td width="31" valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td align="left" valign="middle" class="tbltext">&nbsp;<?php echo $slocs;?></td>
<td align="center" valign="middle" class="tbltext">D</td>
<td align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
</tr>
<?php 
 }
 $srno++;
 } 
 } 
 ?>


<tr class="Dark" height="25">
<td width="31" valign="middle" class="tbltext" align="center"></td>
<td colspan="2" align="left" valign="middle" class="tblheading">&nbsp;Total Damage</td>
<td align="center" valign="middle" class="tblheading"><?php echo $tot1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $tot2;?></td>
</tr>

<input type="hidden" name="foccode" value="" /><input type="hidden" name="empname" value="" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" colspan="3"><img src="../images/close_1.gif" border="0" onClick="window.close()" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
