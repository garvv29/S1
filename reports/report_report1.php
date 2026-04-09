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
	
	/*if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}*/
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
											*/
		/*if(mysql_query($sql_in)or die(mysql_error()))
		{
			echo "<script>window.location='home_report.php'</script>";*/	
		}
		//}
//}

?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<title>Store- Report-Report Assignment List</title><table width="775" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="775" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_report.php?id=<?php echo $id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<?php
		$srno=1;
		$sql_sel="select * from tbl_report order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_report"),0); 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Report Assignment List  (<?php echo $total_results;?>)</td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="754" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td width="40" height="22" align="center" valign="middle" class="tblheading">#</td>
	  <td width="274" align="left" class="tblheading" valign="middle">&nbsp;Report Title</td>
  
    <td width="60" align="center" class="tblheading" valign="middle">Admin</td>
	
    <td width="60" align="center" class="tblheading" valign="middle">Operator </td>
  
    <td width="60" align="center" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=1") or die(mysql_error());
$row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>" valign="middle" style="cursor:pointer">SRV1</td>
	
    <td width="60" align="center" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=2") or die(mysql_error());
$row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>" valign="middle" style="cursor:pointer">SRV2 </td>

	<td width="60" align="center" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=3") or die(mysql_error());
$row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>" valign="middle" style="cursor:pointer">SRV3</td>
	
    <td width="60" align="center" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=4") or die(mysql_error());
$row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>" valign="middle" style="cursor:pointer">SRV4 </td>

	<td width="60" align="center" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=5") or die(mysql_error());
$row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>" valign="middle" style="cursor:pointer">SRV5 </td>
  </tr>
  <?php

	while($row=mysql_fetch_array($res))
	{
	/*$sql_v=mysql_query("select * from tbl_report where id='".$row['id']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);*/
	
	if ($srno%2 != 0)
	{
	
?>

<tr class="Light">
 <td align="center" class="tbltext"><?php echo $srno;?></td>
<td align="Left" class="tblheading"><div align="justify" class="tblheading" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['report'];?></div></td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "admin") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "operator") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV1") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
				<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV2") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV3") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV4") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV5") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<?php
	}
	else
	{ 
	 
?>
</tr>
<tr class="Dark">
<td align="center" class="tbltext"><?php echo $srno;?></td>
<td align="Left" class="tblheading"><div align="justify" class="tblheading" style="padding:0px 5px 0px 5px; color:#00000"><?php echo $row['report'];?></div></td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "admin") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "operator") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
				<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV1") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV2") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV3") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV4") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
<td align="center" class="tblheading">&nbsp;<?php $p1_array=explode(",",   $row['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV5") { $i++;}
				}
				}
				if($i!=0) { ?><font color="#007100">Yes</font><?php } else { ?><font color="#FF0000">No</font><?php }?>&nbsp;</td>
</tr>

<?php }
	$srno=$srno+1;
	}
	//}
?>
</table></br>
<table width="785" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="785" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_report.php?id=<?php echo $id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>

