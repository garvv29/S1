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
	
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
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
		
	if(isset($_GET['binid']))
	{
	 $bid = $_GET['binid'];
	}
	if(isset($_GET['sid']))
	{
	$sid = $_GET['sid'];
	}
	if(isset($_GET['whid']))
	{
	 $whid = $_GET['whid'];
	}
	

		/*$classification=trim($_POST['txtcla']);
		//$cropshort=strtoupper(trim($_POST['txtcropshort']));
		
	$query=mysql_query("SELECT * FROM tbl_classification where classification='$classification'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Classification is Already Present.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tblclassification(classification) values(
											  '$class'
												)";
											
		if(mysql_query($sql_in)or die(mysql_error()))
		{
			echo "<script>window.location='home_classification.php'</script>";	
		}
		}*/
//}

?>

<?php
		
	
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$whid."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);

if($sid=='ALL')
{ 
$subbinn="ALL";
}
else
{
$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$sid."' and binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
}		
	/*$sql_sel="select * from tbl_subbin where sid='".$sid."' order by sname ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_subbin where sid='".$sid."'"),0); 
	
	$sql_p=mysql_query("select * from tbl_subbin where sid='".$sid."'");
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	
	if($total >0) { */
	
	?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<title>Utility-SLOC Search</title>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td  align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp; <a  href="utility_wh.php"><img src="../images/close_icon2.jpg" border="0" class="butn" height="30" alt="Close" style="display:inline;cursor:hand;" /></a></td>
</tr>
</table>
<table width="800" height="175" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden">
	 <?php 
/*$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$wid."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$bid."' and whid='".$wid."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);*/

?>
	 <table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Search</td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $subbinn;?></td>
</tr>

  </table>
      <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
			 <tr class="tblsubtitle" height="20">
              <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="8%" align="center" rowspan="2" valign="middle" class="tblheading">Sub Bin</td>
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

if($sid=='ALL')
{ 
$sql_tb="select * from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid";  
}
else
{
$sql_tb="select * from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' and stlg_subbinid='".$sid."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid";  
}
$sql_qry=mysql_query($sql_tb) or die(mysql_error());  
while($row_tbl=mysql_fetch_array($sql_qry))
{

$sql_tbl1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' and stlg_subbinid='".$row_tbl['stlg_subbinid']."' and stlg_tritemid='".$row_tbl['stlg_tritemid']."'") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
//echo $t1=mysql_num_rows($sql_tbl1);

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


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);

if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
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
else
{
?>
<tr class="Dark" height="20">
              <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
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

if($sid=='ALL')
{ 
$sql_tbl=mysql_query("select * from tbl_stldg_damage where stld_whid='".$whid."' and stld_binid='".$bid."' group by stld_subbinid, stld_tritemid order by stld_subbinid") or die(mysql_error());  
}
else
{
$sql_tbl=mysql_query("select * from tbl_stldg_damage where stld_whid='".$whid."' and stld_binid='".$bid."' and stld_subbinid='".$sid."' group by stld_subbinid, stld_tritemid order by stld_subbinid") or die(mysql_error());  
}

while($row_tbl=mysql_fetch_array($sql_tbl))
{

$sql_tbl1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_whid='".$whid."' and stld_binid='".$bid."' and stld_subbinid='".$row_tbl['stld_subbinid']."' and stld_tritemid='".$row_tbl['stld_tritemid']."'") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
//echo $t1=mysql_num_rows($sql_tbl1);

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

 $sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
 $row_subbinn=mysql_fetch_array($sql_subbinn);

if($srno%2!=0)
{
?>  
 <tr class="Light" height="20">
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
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
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
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
}
}
?>  			  
        </table>
</form>

		  
  </td>
  <td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<br/>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td  align="right"><a  href="utility_wh.php"><img src="../images/back.gif" border="0" class="butn"  alt="Close" style="display:inline;cursor:hand;" ></a>&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp; <img src="../images/close_icon2.jpg" border="0" class="butn" height="30" alt="Close" style="display:inline;cursor:hand;" onClick="window.close()"  /></td>
</tr>
</table>