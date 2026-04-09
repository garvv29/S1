<?php
session_start();
	require_once("include/config.php");
	require_once("include/connection.php");
?>
<html>
<head>
<title>Stores:Login</title>
<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css">
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0" style="background-color:#FFFFFF">
<table border="0" cellspacing="0" cellpadding="0" width="400" align="center" height="300">
<tr><td valign="bottom" align="center"><img src="images/logotrac.gif"></td></tr></table><br/>

<?php
	$txtuser=$_POST['txtuser'];
	$txtpassword=$_POST['txtpassword'];
	//$year=$_POST['year'];
	
if ($txtuser != "" && $txtpassword != "")
{
	$sql="select * from tbl_user where loginid='".$txtuser."' and password = '".$txtpassword."'";
	$row=mysql_query($sql) or die(mysql_error());
	$totalrow= mysql_num_rows($row);
	$ObjRS= mysql_fetch_array($row);
	$username=$ObjRS['loginid'];
	$emp_id = $ObjRS['uid']; 
	$role=$ObjRS['role'];
	$logid=$ObjRS['scode'];
	$loginid=0;
	$status='Active';
	
	if($role == "admin")
	{	
		$loginid=0;
	}
	else if($role == "operator")
	{
		 $qry_opr=mysql_query("select * from tbl_opr where login='$username' and pass='$txtpassword'"); 
		 $row_opr = mysql_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 $status=$row_opr['status'];
	}
  else if($role == "eindent")
	{
		 $qry_opr=mysql_query("select * from tbl_roles where login='$username' and pass='$txtpassword'"); 
		 $row_opr = mysql_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 $status=$row_opr['status'];
	}
	else if($role == "viewer")
	{
		 $qry_opr=mysql_query("select * from tbl_viewer where login='$username' and pass='$txtpassword'"); 
		 $row_opr = mysql_fetch_array($qry_opr);
		 $loginid=$row_opr['vid'];
		 $status=$row_opr['status'];
	}
	else
	{
	$loginid=0;
	$status='Suspend';
	}
	
	$quer3=mysql_query("select * from tblyears where years_flg != 0 and years_status='a'"); 
	$noticia3 = mysql_fetch_array($quer3);
	$year=$noticia3['year_name'];
	$ayear1=$noticia3['year1'];
	$ayear2=$noticia3['year2'];
	$yearid_id=$noticia3['ycode'];
	
if($totalrow > 0)
{
	if (!isset($_SESSION["sessionadmin"]))
	{
	
	/*session_register("sessionrole");
	 session_register("sessionadmin");*/
	 $_SESSION['sessionadmin']=$username;
	 $_SESSION['emp_id']=$emp_id;
	 $_SESSION['role']=$role;
	 $_SESSION['ayear1']=$ayear1;
	 $_SESSION['ayear2']=$ayear2;
	 $_SESSION['username']=$username;
	 $_SESSION['loginid']=$loginid;
	 $_SESSION['yearid_id']=$yearid_id;
	 $_SESSION['logid']=$logid;
	}
	if ($_SESSION['sessionadmin'])
	{	
		if($role == "admin")
		{
			echo "<script language='JavaScript' type='text/JavaScript'>";
			echo "window.location='index1.php'"; 
			echo "</script>";
		}
		/*else
		{
			echo "<script language='JavaScript' type='text/JavaScript'>";
			echo "window.location='login.php'"; 
			echo "</script>";
		}*/
		
		else if($role == "operator")
		{
			if($status=="Active")
			{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='indexopr.php'"; 
				echo "</script>";
			}
			else
			{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='login.php'"; 
				echo "</script>";
			}
		}
		 else if($role == "eindent")
		{
			if($status=="Active")
			{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='indexindet.php'"; 
				echo "</script>";
			}
			else
			{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='login.php'"; 
				echo "</script>";
			}
		}
		else if($role == "viewer")
		{
			if($status=="Active")
			{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='indexview.php'"; 
				echo "</script>";
			}
			else
			{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='login.php'"; 
				echo "</script>";
			}
		}
		else
		{
			echo "<script language='JavaScript' type='text/JavaScript'>";
			echo "window.location='login.php'"; 
			echo "</script>";
		}
		
	}
}
else 
{
?>		

<table border="0" cellspacing="0" cellpadding="0" width="408" align="center" height="75">

	
		<tr ><td width="408" height="44"  align="middle" class="tblheading" >Invalid Login ID & Password. Please contact Administrator or Try relogin again.

		<a href=login.php class="tblheading">Try Again</a></td>
		</tr>
<?php
}
}	
else 
{
?>
<tr><td height="25"  align="middle" class="tblheading"><b>Invalid Username or Password <br/> <a href=login.php class="tblheading">Try Again</a></b></td></tr>
<?php
}
?>
</table> 
</body>
</html>
