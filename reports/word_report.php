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
$filename="Report-Master-Report-Assignment".$id ['id'].".doc";    
	header("Content-type:application/vnd.ms-word"); 
	header("Content-Disposition: attachment; filename=$filename"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores- Report- Assignment Report</title>
<style type="text/css" >
/* CSS Document */

body{ 
	margin-top:0px; 
	margin-left:0px; 
	margin-right:0px; 
	margin-bottom:0px;  
	
/*	background-color:#506030 
	background-color:#FEFEFE*/
	}
	
#wrapperleftmenu{ 
	float:left;
	background-image:url(images/leftmenu_bg.jpg); background-repeat:repeat-y; 
	position:absolute; 
	width:184px;
	border:1px solid red;
	height:450px;}
	
#leftmenu_top{ 
	float:left; 
	position:absolute; 
	width:184px; 
	height:auto;
	text-decoration:none; }
	
#leftmenu{ 	
		text-decoration:none;
		float:left;
		position:relative;
		margin-left:0px;
		width:184px;}
		
.menufont{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:15px;
		font-weight:bold;
		padding-left:15px;
		color:#000000;}
		
.submenufont{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;		
		color:#000000;}
/*		
.submenufont a{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:normal;
		text-decoration:none;
		margin-left:35px;
		line-height:18px;
		color:#000000;}
		
.submenufont a:hover{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;
		text-decoration:none;
		margin-left:35px;
		line-height:18px;
		color:#000000;}
		
*/
.tblheading{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;
		color:#303030;}
		
.tbltext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:13px;
		font-weight:normal;
		color:#000000;}

.smalltblheading{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:11px;
		font-weight:bold;
		color:#303030;}
		
.smalltbltext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:11px;
		font-weight:normal;
		color:#000000;}
		
		
.tbldtext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:normal;
		color:#000000;}

		
#master{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
		
.test{width:176px;float:left; position:absolute; text-decoration:mone;
border-bottom: 1px solid #FFFFFF;
}

.butn
{
}
#transaction{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}

#search{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
	
#utility{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
		
#reports{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
								
#wrapperpendtask{
	float:left;
	margin-top:20px;
	border:1px solid #FF0000;
	position:relative;
	width:184px; 
	height:50px;}
.pendtask{
	float:left;
	background-image:url(images/sub_bg.jpg); background-repeat:no-repeat;
	height:17px;
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color: #303918;
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
	}
	
.Mainheading
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 16px;
	color: #404d21;
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.subheading
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color:#704f00;
	/*color: #303918;*/
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.tblbutn
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color:#FFFFFF;
	/*color: #303918;*/
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.Light{
	background-color:#FFFFFF
	/*background-color:#f6ffe0;
	background-color: #ebf4d4;*/
}
.backcolor{
	background-color:#F1F1F1;
	/*background-color: #ebf4d4;*/
}
.Dark{ 
	background-color:#F5F5F5
	/*background-color: #dce9a5;
	background-color:#b4d554;E2E2E2*/
}
.tbltitle{ 
	background-color:#4ea1e1
	/*background-color: #dce9a5;
	background-color:#b4d554;*/
}
.tblsubtitle{ 
	background-color:#D2E9FF
	/*background-color: #dce9a5;
	background-color:#b4d554;*/
}	


</style>
<?php
	
	
		$sql_sel="select * from tbl_report order by report ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_report"),0); 

	if($total >0) { 
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
	}
?>
</table>