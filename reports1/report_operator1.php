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
	
		if(isset($_REQUEST['id']))
	{
	$id = $_REQUEST['id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	
{
}

?>

<?php
	
		$srno=1;
	
	
	
	$sql_sel="select * from tbl_opr order by name ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_opr"),0); 

	if($total >0) { 
	
?>
<title>Master Report - Report Operator</title>

<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Report Operator  List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="606" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="130" align="center" class="tblheading" valign="middle">Code</td>
<td width="187" align="left" class="tblheading" valign="middle">&nbsp;Name</td>
<td width="130" align="center" class="tblheading" valign="middle"> Login ID </td>
<td width="149" align="center" class="tblheading" valign="middle">Status</td>
</tr>
<?php
$srno=1;
	while($row=mysql_fetch_array($res))
	{
	
	 $resettargetquery=mysql_query("select * from tbl_opr where id='".$row['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	/*$sql_p=mysql_query("select * from tblzone where dept_id=".$row['dept_id'])or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	$sql_v=mysql_query("select * from tblregion where dept_id=".$row['dept_id'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	*/
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo "OP".$row['code'];?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="center"><?php echo "OP".$row['code'];?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
</br>
<table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>