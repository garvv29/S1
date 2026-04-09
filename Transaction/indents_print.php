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
//}


		?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction- Indent Preview</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/


</script>
<body>

	<?php  
$sql_item=mysql_query("select * from tbl_stores where items_id='".$itmid."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
?>	  
		  
		  <!-- actual page start--->		  
		
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();" > 
	 <input name="frm_action" value="submit" type="hidden">
	
	 <input type="hidden" name="code" value="<?php echo $code?>" />
	 <input type="hidden" name="txtid1" value="<?php echo $code1?>" />
	  <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
	 <br />
	 
<?php
$tid=$itmid;
//$tid=$pid;
//$tid=0; $subtid=0;
?>

<?php
$sql_tbl=mysql_query("select * from tbl_ieindent where  tid='".$tid."'") or die(mysql_error());

$row_tbl=mysql_fetch_array($sql_tbl);			


$sql_tbl_sub=mysql_query("select * from tbl_ieindent_sub where id_in='".$tid."'") or die(mysql_error());
$subtid=0;
$tdate=$row_tbl['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="750"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Raise E Indent </td>
</tr>
  <tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>

	
	 <tr class="Dark" height="30">
<td width="266" align="right" valign="middle" class="tblheading">&nbsp;Transction Id&nbsp;</td>
<td width="104"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "IR".$row_tbl['code1']."/".$yearid_id."/".$logid;?></td>

<td width="180" align="right" valign="middle" class="tblheading">Indent Date&nbsp;</td>
<td width="190" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></tr>

<tr class="Light" height="30">
<td width="266" align="right" valign="middle" class="tblheading">Indent Number  </td>
<td width="104"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "T".$row_tbl['code1'];?></td>
<?php 
$result=mysql_query("SELECT * FROM tbl_roles where id='".$loginid."'")or die(mysql_error()); 
$row = mysql_fetch_array($result);
?>
<td width="180" align="right" valign="middle" class="tblheading">Raised by&nbsp;</td>
<td width="190" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['name'];?></tr>
</table>
<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse"> <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification </td>
<td width="114" align="center" class="tblheading" valign="middle">Item </td>
<td width="147" align="center" class="tblheading" valign="middle">UoM </td>
<td width="147" align="center" class="tblheading" valign="middle">Quantity</td>
</tr>
<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['items_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);

$sql_item1=mysql_query("select * from tbl_ieindent_sub where eid='".$row_tbl_sub['eid']."'") or die(mysql_error());
$row_item1=mysql_fetch_array($sql_item1);
if($srno%2!=0)
{

?>			


<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
</tr>
<?php
	}
	else
	{ 
	
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>


 <br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="60" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="784" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks']?></td>
</tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
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
