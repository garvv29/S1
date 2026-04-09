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
	/* $role='eindent';
	$status='active';*/
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

	
	$filename="Report-Master-Viewer".$id ['id'].".doc";    
	header("Content-type:application/vnd.ms-word"); 
	header("Content-Disposition: attachment; filename=$filename"); 
	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Report -Word Viewer</title>
<style type="text/css" >
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
	
			$srno=1;
	
	
		
	$sql_sel="select * from tbl_viewer order by name ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_viewer"),0); 

	if($total >0) { 
	
?>
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