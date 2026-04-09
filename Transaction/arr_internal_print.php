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

	/*$yearid_id="09-10";
	$logid="opr1";
	$lgnid="OP1";*/
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>stores - Transction-Add  Material Return Internal - Damage</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

</script>



<body>

		  
<!-- actual page start--->	
  
 
<?php 
 echo $tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arrival_type='Internalreturn' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit()"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="pid" value="<?php echo $pid?>" type="hidden"> 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td align="right" width="50%" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>"  >&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+1"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">&nbsp;<?php echo $row_param['address'];?></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">&nbsp;TIN:&nbsp;<?php echo $row_param['tin'];?></td>
</tr>
</table><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add  Material Return Internal - Damage</td>
</tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
      <td width="210" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
      <td width="298" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "AI".$row_tbl['arrival_code']."/".$lgnid."/".$yearid_id;?></td>
     
	  <td width="141" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
      <td width="191" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="25">
      <td width="210" height="24"  align="right"  valign="middle" class="tblheading"> Return from Stage&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stageret'];?></td>

<?php
$quer1=mysql_query("SELECT id ,login FROM tbl_roles where stage='".$row_tbl['stageret']."' and id='".$row_tbl['retid']."'")or die(mysql_error()); 
$row1=mysql_fetch_array($quer1);
$tot_1=mysql_num_rows($quer1);
?>

      <td width="141" height="24"  align="right"  valign="middle" class="tblheading">Return By ID&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext" id="retby" >&nbsp;<?php echo $row_tbl['retid'];?></td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Return By ID or Specify&nbsp;</td>
<?php
if($tot_1 ==0)
{
?>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['retid'];?></td>
<?php
}
else
{
?>
<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<?php
}
	$quer3=mysql_query("SELECT business_name, address FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>

      <td width="141" height="24"  align="right"  valign="middle" class="tblheading"><?php echo $row3['business_name'];?></td>
      
</tr>
<?php 
$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());
$row_tbl_sub=mysql_fetch_array($sql_tbl_sub);

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
?>
<tr class="Dark" height="25">
           <td width="210"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $row_class['classification'];?></td>
</tr>
<tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row_item['stores_item'];?></td>
		
<td width="141" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="191" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<?php echo $row_item['uom'];?></td>
</tr>


<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl_sub['ups_damage'];?></td>
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl_sub['qty_damage'];?></td>
</tr>

<tr class="Dark" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl_sub['noofbin_damage'];?></td>
</tr>
</table>
<?php
$sql_sub_sloc1=mysql_query("select * from tblarr_sloc where arr_id='".$row_tbl_sub['arrsub_id']."' and arr_tr_id='".$arrival_id."' and qty_good=0 and ups_good=0") or die(mysql_error());
$tot_sub_sloc1=mysql_num_rows($sql_sub_sloc1);
$flash1=0;
while($row_sub_sloc1=mysql_fetch_array($sql_sub_sloc1))
{
if($flash1==0)
{

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$whd1_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
$noticia_whd1 = mysql_fetch_array($whd1_query);
?>
<tr class="Light" height="30" >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whd1['perticulars'];?></td>
<?php
$bind1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
$noticia_bind1 = mysql_fetch_array($bind1_query);
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<?php echo $noticia_bind1['binname'];?></td>

<?php
$subbind1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
$noticia_subbind1 = mysql_fetch_array($subbind1_query)
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<?php echo $noticia_subbind1['sname'];?></td>
<td width="300"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc1['ups_damage'];?></td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc1['qty_damage'];?></td>
</tr></table></div></td>
</tr>
</table>

<?php
}
else if($flash1==1)
{

$whd2_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
$noticia_whd2 = mysql_fetch_array($whd2_query);
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whd2['perticulars'];?></td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
$noticia_bind2 = mysql_fetch_array($bind2_query);
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing2">&nbsp;<?php echo $noticia_bind2['binname'];?></td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
$noticia_subbind2 = mysql_fetch_array($subbind2_query);
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing2">&nbsp;<?php echo $noticia_subbind2['sname'];?></td>
<td width="300"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="48" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc1['ups_damage'];?></td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc1['qty_damage'];?></td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
}
$flash++;
}
?>

<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">TIN&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_param['tin'];?></td>
</tr>
<tr class="Light" height="20">
<td width="132" align="right"  valign="middle" class="tblheading">CST&nbsp;</td>
<td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst'];?></td>
</tr>
<tr class="Light" height="20">
<td width="132" align="right"  valign="middle" class="tblheading">Seed Licese No.&nbsp;</td>
<td width="618" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>
<br />

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table><br />
<br />

<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="117" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="174"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="61" align="right" valign="middle" class="smalltblheading">&nbsp;Check By &nbsp;</td>
<td width="224" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="89" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="185" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table><br />

<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" width="22" border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>

</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
	  <!-- actual page end--->			  
		
</body>
</html>
