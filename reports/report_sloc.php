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
			if(isset($_GET['txtslbing1']))
	{
	 $bid = $_GET['txtslbing1'];
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$sid = $_GET['txtslsubbg1'];
	}
	if(isset($_GET['txtslwhg1']))
	{
	 $whid = $_GET['txtslwhg1'];
	} 
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<title>Report- Stock onhand Report</title><table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table><table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td><tr><td><table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden">
	<?php
		
	
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$whid."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$bid."' and whid='".$whid."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
if($bid=='ALL')
{ 
	$binn="ALL";
}
else
{
	$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$bid."' and whid='".$whid."'") or die(mysqli_error($link));
	$row_binn=mysqli_fetch_array($sql_binn);
	$binn=$row_binn['binname'];
}
if($sid=='ALL')
{ 
$subbinn="ALL";
}
else
{
$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$sid."' ") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
}		
	/*$sql_sel="select * from tbl_subbin where sid='".$sid."' order by sname ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results = mysqli_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_subbin where sid='".$sid."'"),0); 
	
	$sql_p=mysqli_query($link,"select * from tbl_subbin where sid='".$sid."'");
  	$row_p=mysqli_fetch_array($sql_p);
	$num_p=mysqli_num_rows($sql_p);
	
	if($total >0) { */
	
	?>
	 <table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Search</td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $binn;?>/<?php echo $subbinn;?></td>
</tr>

  </table>
      <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
			 <tr class="tblsubtitle" height="20">
              <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="8%" align="center" rowspan="2" valign="middle" class="tblheading">Bin</td>
			  <td width="8%" align="center" rowspan="2" valign="middle" class="tblheading">Subbin</td>
			  <td width="26%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="30%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
                <td colspan="4" align="center" valign="middle" class="tblheading">SLOC</td>
              </tr>
			<tr class="tblsubtitle">
                    <td width="7%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="8%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="11%" align="center" valign="middle" class="tblheading">Qty</td>
          </tr>
<?php
$srno=1;

$sql_tb="select * from tbl_stldg_good where stlg_whid='".$whid."' ";
if($bid!='ALL')
{ 
	$sql_tb.=" and stlg_binid='".$bid."' ";  
}
if($sid!='ALL')
{ 
	$sql_tb.=" and stlg_subbinid='".$sid."' ";  
}

$sql_tb.=" group by stlg_subbinid, stlg_tritemid order by stlg_subbinid";  


$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link));  
while($row_tbl=mysqli_fetch_array($sql_qry))
{

$sql_tbl1=mysqli_query($link,"select max(stlg_id) from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$row_tbl['stlg_binid']."' and stlg_subbinid='".$row_tbl['stlg_subbinid']."' and stlg_tritemid='".$row_tbl['stlg_tritemid']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $t1=mysqli_num_rows($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_stldg_good where stlg_id='".$row_tbl1[0]."' and stlg_balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$row_tbl_sub['stlg_trclassid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$row_tbl_sub['stlg_tritemid']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);

$stores_item=$row_item['stores_item'];
if($row_item['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$whid."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$whid."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stlg_balups'];
$slqty=$slqty+$row_tbl_sub['stlg_balqty'];july


?>			 
			  <td align="center" valign="middle" class="tblheading">G</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
              <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			  <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stlg_balups'];
$slqty=$slqty+$row_tbl_sub['stlg_balqty'];

?>			 
			  <td align="center" valign="middle" class="tblheading">G</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr> 
<?php
}
$srno++;
}
}
}

$sqltbl="select * from tbl_stldg_damage where stld_whid='".$whid."' "; 

if($bid!='ALL')
{ 
$sqltbl.=" and stld_binid='".$bid."' "; 
}
if($sid!='ALL')
{ 
$sqltbl.=" and stld_subbinid='".$sid."' ";  
}
$sqltbl.=" group by stld_subbinid, stld_tritemid order by stld_subbinid"; 
$sql_tbl=mysqli_query($link,$sqltbl) or die(mysqli_error($link)); 

while($row_tbl=mysqli_fetch_array($sql_tbl))
{

$sql_tbl1=mysqli_query($link,"select max(stld_id) from tbl_stldg_damage where stld_whid='".$whid."' and stld_binid='".$row_tbl['stld_binid']."' and stld_subbinid='".$row_tbl['stld_subbinid']."' and stld_tritemid='".$row_tbl['stld_tritemid']."'") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
//echo $t1=mysqli_num_rows($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_stldg_damage where stld_id='".$row_tbl1[0]."' and stld_balqty > 0")or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$sql_class=mysqli_query($link,"select * from tbl_classification where classification_id='".$row_tbl_sub['stld_trclassid']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$row_tbl_sub['stld_tritemid']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);

$stores_item=$row_item['stores_item'];
if($row_item['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";

 $sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stld_binid']."' and whid='".$whid."'") or die(mysqli_error($link));
 $row_subbinn=mysqli_fetch_array($sql_subbinn);

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['stld_binid']."' and whid='".$whid."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];
if($srno%2!=0)
{
?>  
 <tr class="Light" height="20">
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stld_balups'];
$slqty=$slqty+$row_tbl_sub['stld_balqty'];

?>			 
			  <td align="center" valign="middle" class="tblheading">D</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
              <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			  <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stld_balups'];
$slqty=$slqty+$row_tbl_sub['stld_balqty'];

?>			 
			  <td align="center" valign="middle" class="tblheading">D</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr> 
<?php
}
$srno++;
}
//}

}}
?>  			  
          </table>
</form>

		  
  </td>
  <td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table><br/>
<table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
