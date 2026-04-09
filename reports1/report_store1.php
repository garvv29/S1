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
	
	if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}
	if(isset($_REQUEST['items_id']))
	{
	$id = $_REQUEST['items_id'];
	}
	
		
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<title>Stores- Report-Stores Report</title><table width="656" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="656" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php

		$srno=1;
	
	$sql_sel="select a.stores_item, a.items_id,a.uom,a.srl,a.actstatus , b.classification from tbl_stores a,tbl_classification b where a.classification_id = b.classification_id order by b.classification,a.stores_item ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_stores"),0); 

	if($total >0) { 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="474" style="border-collapse:collapse">
  <tr height="25" >
    <td width="545" colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" />
    Report Stores List (<?php echo $total_results;?>)</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="515" bordercolor="#4ea1e1" style="border-collapse:collapse">
    <tr class="tblsubtitle" height="25">
<td width="36" height="22" align="center" valign="middle" class="tblheading">#</td>
<td width="139" align="left" class="tblheading" valign="middle">&nbsp;Stores Items</td>
<td width="146" align="center" class="tblheading" valign="middle">Classification<br /></td>
<td width="71" align="center" class="tblheading" valign="middle">&nbsp;UoM</td>
<td width="111" align="center" class="tblheading" valign="middle">&nbsp;Set Re-Order Level<br /></td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
	/*$resettargetquery=mysql_query("select * from tbl_classification where classification_id='".$row['classification_id']."' order by classification ASC");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);*/
	
	/*$sql_p=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."'")or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
$num_of_records_target_set1=mysql_num_rows($sql_p);*/
	
	$sql_v=mysql_query("select * from tbl_stldg_good where stlg_tritemid='".$row['items_id']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_of_records_target_set2 =mysql_num_rows($sql_v);
	
	$sql_v=mysql_query("select * from tbl_stldg_damage where stld_tritemid='".$row['items_id']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_of_records_target_set3 =mysql_num_rows($sql_v);
	/*$sql_v=mysql_query("select * from tblvariety where cropid=".$row['cropid'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	*/
$stores_item=$row['stores_item'];
if($row['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";

	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $stores_item;?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['classification'];?>&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['srl'];?> </td>
<!--<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>-->
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $stores_item;?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['classification'];?>&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['srl'];?></td>
<!--<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>-->
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>
</br>
<table width="667" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="667" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>