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
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
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
		{*/
			echo "<script>window.location='companyhome.php'</script>";	
		}
		//}
	//}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores - Parameter Master -Parameter Home</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>



<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">
      <?php include '../include/navbar_loader.php'; ?>

<table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">
		  
		  
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Parameters Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<!--<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_company.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>-->

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  >
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php
	
	if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
	$sql_sel="select * from tbl_parameters order by company_name  LIMIT $from, $max_results";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_parameters"),0); 

	if($total >0) { 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" />
      Parameters List </td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="535" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="164" align="left" class="tblheading" valign="middle">&nbsp;Particulars</td>
<td width="258" align="center" class="tblheading" valign="middle">Details</td>
<td width="105" align="center" class="tblheading" valign="middle">Edit</td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
	/* $resettargetquery=mysql_query("select * from tbl_parameters where id='".$row['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	$sql_p=mysql_query("select * from tbl_stores where items_id=".$row['items_id'])or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	$sql_v=mysql_query("select * from tblvariety where cropid=".$row['cropid'])or die(mysql_error());
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
<td valign="middle" class="tbltext" align="left">&nbsp;Company Name</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['company_name'];?></td>
<td rowspan="12" align="center" valign="middle" class="tbltext"><a href="edit_company.php?id=<?php echo $row['id'];?>"><img src="../images/edit.png" border="0" /></a></td>
</tr>

<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company Logo</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['logo'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Office&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['address'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Office&nbsp;Phone No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cphone'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Office&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['ccity'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['plant'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Phone No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pphone'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pcity'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Seed License no</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['licence_no'];?></td>
</tr>
<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;TIN</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['tin'];?></td>
</tr>

<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;CST </td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cst_no'];?></td>
</tr>

<tr class="Light" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant Code</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['plantcode'];?></td>
</tr>
<?php
}
	else
	{ 
	?>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company Name</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['company_name'];?></td>
<td rowspan="12" align="center" valign="middle" class="tbltext"><a href="edit_company.php?id=<?php echo $row['id'];?>"><img src="../images/edit.png" border="0" /></a></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company Logo</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['logo'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['address'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company&nbsp;Phone No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cphone'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Company&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['ccity'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Address</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['plant'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;Phone No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pphno'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant&nbsp;City</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['pcity'];?></td>
</tr>
<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Seed License No.</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['licence_no'];?></td>
</tr><tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;TIN</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['tin'];?></td>
</tr>

<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;CST </td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['cst_no'];?></td>
</tr>

<tr class="Dark" height="25">
<td valign="middle" class="tbltext" align="left">&nbsp;Plant Code</td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['plantcode'];?></td>
</tr>	
<?php	}
	 $srno=$srno+1;
	}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='750' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
		echo "</td></tr></table>"; */
}

?>
</td><td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
		  
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
