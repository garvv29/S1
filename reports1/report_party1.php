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
	
	if(isset($_REQUEST['business_name']))
	{
	$business_name = $_REQUEST['business_name'];
	}
	
	
if($business_name=="StockTransfer")
		{
		$rt="Stock Transfer";
		}
if($business_name=="InternalReturn")
		{
		$rt="Internal Return";
		}
if($business_name=="Vendor")
		{
		$rt="Vendor";
		}
if($business_name=="Dealer")
		{
		$rt="Dealer";
		}
if($business_name=="CF")
		{
		$rt="C&F";
		}
	

?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<title>Stores- Report- Party Report</title>
<table width="500" align="center" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

<?php
	 $srno=1;
$business_name=$rt;
  $sql = mysql_query("SELECT * FROM tbl_partymaser where classification='$business_name' order by business_name"); 
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_partymaser where classification='$business_name'"),0); 
	//}
	$total=mysql_num_rows($sql);
    if($total >0) { 
			?>		
			
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="500" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Partry List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="61" align="center" class="tblheading" valign="middle">#</td>
    <td width="281" align="left" class="tblheading"valign="middle">&nbsp;Party Name </td>
    <td width="141" align="center" class="tblheading" valign="middle">Categories<br /></td>
    </tr>
  <?php
    $srno=1;
	while($row=mysql_fetch_array($sql))
	{
	/*$resettargetquery=mysql_query("select * from tbl_partymaser where classification=".$row['p_id']);
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	*/
	if ($srno%2 != 0)
	{
	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['business_name'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    </tr>
  <?php
	}
	else
	{ 
	
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['business_name'];?> </td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    </tr>
  <?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
</br>
<table width="500" align="center" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>