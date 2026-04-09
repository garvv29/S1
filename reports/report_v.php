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
   // $role=$_SESSION['role'];
    //$role="cdinward";

if(isset($_REQUEST['id']))
	{
	$id = $_REQUEST['id'];
	}
	 //$role='eindent';
	//$status='active';
	if(isset($_POST['frm_action'])=='submit')
	{
		$name=trim($_POST['txtname']);
		$login=trim($_POST['txtId']);
		$pass=trim($_POST['txtpass']);
		$email=trim($_POST['txtemail']);
		$status=trim($_POST['txt1']);
		
		
		$query1=mysql_query("SELECT * FROM tbl_opr where name='$name' and id!='$id'") or die("Error: " . mysql_error());
		$numofrecords1=mysql_num_rows($query1);
		
		$query2=mysql_query("SELECT * FROM tbl_opr where login='$login' and id!='$id'") or die("Error: " . mysql_error());
		$numofrecords2=mysql_num_rows($query2);
		
		$query3=mysql_query("SELECT * FROM tbl_opr where email='$email' and id!='$id'") or die("Error: " . mysql_error());
		$numofrecords3=mysql_num_rows($query3);
		 //exit;
   		// $numofrecords=mysql_num_rows($query);
		 //exit;
	 	 if($numofrecords1 >0 || $numofrecords2>0 || $numofrecords3>0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
	 $sql_in="update tbl_opr set 	name='$name',
											login='$login',
											pass='$pass',
											email='$email',
											status='$status'
											where id='$id'";
											//exit;
		if(mysql_query($sql_in)or die(mysql_error()))
		{	
				 $sql_in1="Update tbl_user set	loginid='$login',
											password='$pass'
											where id='0'";	
										
						mysql_query($sql_in1)or die(mysql_error());	
			
								echo "<script>window.location='operator_home.php?id=$id'</script>";	
			}
}}
		
	//}
?>
		 <link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
		 
<title>Stores-Report- Viewer Report</title><table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_viewer.php?id=<?php echo $id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
	
			$srno=1;
	
	
		
	$sql_sel="select * from tbl_viewer order by name ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_viewer"),0); 

	if($total >0) { 
	
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; "> Report Viewers List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="477" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
 <td width="43" height="22" align="center" valign="middle" class="tblheading">#</td>
<td width="114" align="left" class="tblheading" valign="middle">&nbsp;Name</td>
<td width="94" align="center" class="tblheading" valign="middle"> Login ID </td>
<td width="107" align="center" class="tblheading" valign="middle">Status</td>
<td width="107" align="center" class="tblheading" valign="middle">Code</td>
 </tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
	
	 $resettargetquery=mysql_query("select * from tbl_viewer where vid='".$row['vid']."'");
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
 <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo "SRV".$row['vcode'];?></td>
 </tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
 <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo "SRV".$row['vcode'];?></td>
 </tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='500' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; 
//}*/

?>
</br>
<table width="651" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_viewer.php?id=<?php echo $id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>