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
	
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$class=trim($_POST['txtclassification']);
		//$cropshort=strtoupper(trim($_POST['txtcropshort']));
		
	$query=mysql_query("SELECT * FROM tblclassification where classification='$class'") or die("Error: " . mysql_error());
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
			echo "<script>window.location='role_home.php'</script>";	
		}
		//}
	//}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores - e-Indent Master -eIndent Home</title>
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
	      <td width="810" height="25">&nbsp;e-Indent - Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_indentrole.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php
	$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 10; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysql_query("select * from tbl_roles order by code desc LIMIT $start, $limit") or die(mysql_error());
 $tot_arr_home=mysql_num_rows($sql_arr_home);

//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query = "select * from tbl_roles order by code desc";
$total_pages = mysql_num_rows(mysql_query($query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:730px\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">« previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">« previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> next »</a> ";
		else
			$pagination.= " <span class=\"disabled\"> next »</span> ";
		$pagination.= "</div>\n";		
	}
	 $srno=($page-1)*$limit+1;
	/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
	$sql_sel="select * from tbl_roles order by code LIMIT $from, $max_results";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);*/
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_roles"),0); 

	if($total_results >0) { 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="794" style="border-collapse:collapse">
  <tr height="25" >
    <td  colspan="8" align="Right" class="subheading" style="color:#303918; ">e-Indent Roles List (<?php echo $total_results;?>) &nbsp;<br/>
    <td width="121"  colspan="8" align="Right"  class="smalltbltext" style="color:#303918; "><font color="#FF0000" >* </font>Max. 25 roles allowed</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="794" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="103" align="center" class="tblheading" valign="middle">Code</td>
<td width="203" align="left" class="tblheading" valign="middle">&nbsp;Name</td>
<td width="164" align="center" class="tblheading" valign="middle">e-Indent Login </td>
<td width="103" align="center" class="tblheading" valign="middle">Stage</td>
<td width="103" align="center" class="tblheading" valign="middle">Status</td>
<td width="74" align="center" class="tblheading" valign="middle">Edit</td>
<td width="78" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($sql_arr_home))
	{
	
	 $resettargetquery=mysql_query("select * from tbl_roles where id='".$row['id']."'");
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
<td valign="middle" class="tbltext" align="center"><?php echo "EIR".$row['code'];?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['stage'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_indentrole.php?id=<?php echo $row['id'];?>"><img src="../images/edit.png" border="0" /></a></td>

<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=role&code=<?php echo $row['id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="center"><?php echo "EIR".$row['code'];?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['login'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['stage'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['status'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_indentrole.php?id=<?php echo $row['id'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=role&code=<?php echo $row['id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
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
	echo "<table width='794' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
		echo "</td></tr></table>";*/ 
//}

?>
<?php echo $pagination?>
</td>
<td width="30"></td>
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
