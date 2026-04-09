<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
	if(isset($_REQUEST['items_id']))
	{
	$id = $_REQUEST['items_id'];
	}
	
	if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
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
}

?>

<?php
	
		
	
	$sql_sel="select * from tbl_classification order by classification ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_classification"),0); 

	if($total >0) { 
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />


<table width="527" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="271" style="border-collapse:collapse">  <tr height="25" >
   <td width="271" colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" />
    Classification List (<?php echo $total_results;?>)</td>
  </tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="271" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr  class="tblsubtitle" height="25">
<td width="33" align="center" class="tblheading" valign="middle">#</td>
<td width="125" align="left" class="tblheading" valign="middle">&nbsp;Classification Name</td>
<td width="105" align="center" class="tblheading" valign="middle">Number of Items<br />
  (in nos.)</td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
	 $resettargetquery=mysql_query("select * from tbl_stores where classification_id='".$row['classification_id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	/*$sql_p=mysql_query("select * from tbl_stores where items_id=".$row['items_id'])or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	$sql_v=mysql_query("select * from tblvariety where cropid=".$row['cropid'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	*/
	if ($srno%2!= 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_of_records_target_set;?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_of_records_target_set;?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
	//}
?>

</table>
<br/>
<table width="537" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="528" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>