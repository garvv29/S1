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

	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['slid']))
	{
	$slid = $_REQUEST['slid'];
	}
	if(isset($_REQUEST['wid']))
	{
	$wid = $_REQUEST['wid'];
	}
	if(isset($_REQUEST['bid']))
	{
	$bid = $_REQUEST['bid'];
	}
	if(isset($_REQUEST['tp']))
	{
	$tp = $_REQUEST['tp'];
	}
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transaction-Sloc details</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
</head>
<body topmargin="0" >
<?php  
//$sql_main=mysql_query("select * from tblarr_sloc where subbin='".$slid."' and whid='".$wid."' and binid='".$bid."' group by item_id")or die(mysql_error());
$sql_main=mysql_query("select stlg_subbinid, stlg_tritemid from tbl_stldg_good where stlg_whid='".$wid."' and stlg_binid='".$bid."' and stlg_subbinid='".$slid."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid") or die(mysql_error());  
$t=mysql_num_rows($sql_main);
?>
  
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <?php 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$wid."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$bid."' and whid='".$wid."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$slid."' and binid='".$bid."' and whid='".$wid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
?>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;Sub-Bin Card</td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $row_subbinn['sname'];?></td>
</tr>

</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
			 
			<tr class="tblsubtitle">
			  <td width="5%" align="center" valign="middle" class="tblheading">#</td>
			  <td width="25%" align="center" valign="middle" class="tblheading">Classification</td>
			  <td width="40%" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="8%" align="center" valign="middle" class="tblheading">UoM</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="8%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
          </tr>
<?php
$srno=1;
while($row_tbl=mysql_fetch_array($sql_main))
{

$sql_tbl1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_whid='".$wid."' and stlg_binid='".$bid."' and stlg_subbinid='".$slid."'  and stlg_tritemid='".$row_tbl['stlg_tritemid']."' ") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
$t1=mysql_num_rows($sql_tbl1);

$sql1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tbl1[0]."' and stlg_balqty > 0")or die(mysql_error());

$total_tbl=mysql_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql1))
{
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stlg_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stlg_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$bid."' and whid='".$wid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);


if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="25%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="40%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stlg_balups'];
$slqty=$slqty+$row_tbl_sub['stlg_balqty'];
?>			 
			 <td align="center" valign="middle" class="tblheading">G</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="25%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="40%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stlg_balups'];
$slqty=$slqty+$row_tbl_sub['stlg_balqty'];
?>			 
			 <td align="center" valign="middle" class="tblheading">G</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr> 
<?php
}
$srno++;
}
}
}
?> 
<?php
$sql2=mysql_query("select stld_subbinid, stld_tritemid from tbl_stldg_damage where stld_whid='".$wid."' and stld_binid='".$bid."' and stld_subbinid='".$slid."' group by stld_subbinid, stld_tritemid order by stld_subbinid") or die(mysql_error());  
//$sql2=mysql_query("select * from tblarr_sloc where subbin='".$slid."' and whid='".$wid."' and binid='".$bid."' group by item_id")or die(mysql_error());
while($row_tbl=mysql_fetch_array($sql2))
{

$sql_tbl1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_whid='".$wid."' and stld_binid='".$bid."' and stld_subbinid='".$slid."'  and stld_tritemid='".$row_tbl['stld_tritemid']."'") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
$t1=mysql_num_rows($sql_tbl1);

$sql1=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_tbl1[0]."' and stld_balqty > 0")or die(mysql_error());

$total_tbl=mysql_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql1))
{
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stld_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stld_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$bid."' and whid='".$wid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);

if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="25%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="40%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stld_balups'];
$slqty=$slqty+$row_tbl_sub['stld_balqty'];
?>			 
			 <td align="center" valign="middle" class="tblheading">D</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="25%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="40%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stld_balups'];
$slqty=$slqty+$row_tbl_sub['stld_balqty'];
?>			 
			 <td align="center" valign="middle" class="tblheading">D</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr> 
<?php
}
$srno++;
}
}
}
?>  			  
          </table>
<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"  />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
