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
	
if(isset($_REQUEST['whid']))
	{
	$whid = $_REQUEST['whid'];
	}
	
		if(isset($_POST['frm_action'])=='submit')
	{
		//$id=trim($_POST['txtsid']);
		$perticulars=trim($_POST['txtperticulars']);
		$query=mysql_query("SELECT * FROM tbl_warehouse where perticulars='$perticulars'and whid!='$whid'")or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {
		 ?>
		 <script>
		  alert("This Warehouse Number is Already Present.");
		  </script>
		 <?php }
		 else 
		{
 	   $sql_in="UPDATE  tbl_warehouse SET perticulars='$perticulars' where whid ='$whid'";
										
					//exit;							
		if(mysql_query($sql_in)or die(mysql_error()))
			{ 
				
				echo "<script>window.location='selectbin.php'</script>";	
			}
		
		}	}
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Warehouse Master -Edit warehouse</title>
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
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  
function onloadfocus()
	{
	document.frmaddDept.txtperticulars.focus();
	}
	
function mySubmit()
{ 
		
		if(document.frmaddDept.txtperticulars.value=="")
	{
	alert("Enter Warehouse number ");
	document.frmaddDept.txtperticulars.focus();
	return false;
	}
	if(document.frmaddDept.txtperticulars.value.charCodeAt() == 32)
	{
	alert("Warehouse number cannot start with space.");
	document.frmaddDept.txtperticulars.focus();
	return false;
	}
	return true;
}
</SCRIPT>
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
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
<!-- actual page start--->	
	  
		       <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Warehouse Master - Edit Warehouse </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	 $sql1=mysql_query("select * from tbl_warehouse where whid='$whid'")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="whid" type="hidden" value="<?php echo $whid; ?>">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td>
<table align="center" border="1" width="554" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Edit Warehouse </td>
</tr>
 <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<!--<tr class="Light" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">Ware House Id </td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtsid" type="text" size="30" class="tbltext" tabindex="0" maxlength="25" />
              &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>-->
		 <tr class="Dark" height="25">
<td width="246" align="right"  valign="middle" class="tblheading">Warehouse Number&nbsp;</td>
<td width="302" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtperticulars" type="text" size="5" class="tbltext" tabindex="0" maxlength="5"  value="<?php echo $noticia['perticulars']; ?>"  onBlur="javascript:this.value=this.value.toUpperCase();" />&nbsp;<font color="#FF0000">*</font>&nbsp;eg.AA,A1,11,1A</td>
</tr>

</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="selectbin.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
</td><td width="30"></td>
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
