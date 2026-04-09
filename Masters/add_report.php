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
	 echo $id = $_REQUEST['id'];
	}
	echo $role=good;
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		//$name=trim($_POST['txtname']);
		
		 $questions=trim($_POST['questions']);
     	 $roles=trim($_POST['flagcode']);
		//exit;
	  $sql_in="insert into tbl_report(report , good) values('$questions' , '$roles')";
					//exit;					
		if(mysql_query($sql_in)or die(mysql_error()))
		{		
			echo "<script>window.location='home_report.php'</script>";	
		}
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores -Master -Add Report</title>
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
<script language="javascript" type="text/javascript">
function f1(val)
{
	if(document.frmaddDepartment.questions.value=="")
	{
	alert("Define Company Name ");
	 document.frmaddDepartment.fet.value="";
	 document.frmaddDepartment.questions.focus();
	 return false;
	}
}
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function mySubmit()
{ 
	if(document.frmaddDepartment.questions.value=="")
	{
	alert("Please enter Report");
	document.frmaddDepartment.questions.focus();
	return false;
	}
	if(document.frmaddDepartment.questions.value.charCodeAt() == 32)
	{
	alert("Report cannot start with space.");
	document.frmaddDepartment.questions.focus();
	return false;
	}
	
	
	
for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
{          
		 
		  if(document.frmaddDepartment.fet[i].checked == true)
			{
				if(document.frmaddDepartment.flagcode.value =="")
				{
				document.frmaddDepartment.flagcode.value=document.frmaddDepartment.fet[i].value;
				}
				else
				{
				document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.fet[i].value;
				}
			}
}

if(document.frmaddDepartment.flagcode.value == "")
{
alert("Please select role");
return false;
}

	return true;	 
}
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
          <td width="100%" valign="top"  align="center"  class="midbgline">

		  
<!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading"> &nbsp;Report - Master</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
   
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >  
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><br />

<table align="center" border="0" width="443" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
  <tr><td width="461">
<table width="432" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle"> Add Report</td>
</tr>
<tr class="Dark"  height="25">
<td width="76" align="right" valign="middle" class="tblheading"> Report &nbsp;</td>
<td width="361" align="left" valign="middle" class="tbltext">&nbsp;<input type="text" name="questions" size="35" maxlength="35" value=<?php echo $row_qry['report'];?>/>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle">Roles</td>
</tr>
</table></td></tr>
</table>
<table width="432" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">

  <tr class="Light"  height="25">
  <td width="234" align="right"  valign="left" class="tblheading">&nbsp;Admin&nbsp;</td>
    <td width="100" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet" value="admin"   onChange="f1(this.value);"/></td></tr>
	 <tr class="Light"  height="25">
    <td width="234" align="right"  valign="middle" class="tblheading">Operator&nbsp;</td>
    <td width="192" colspan="3" align="left"  valign="middle" class="tbltext"  >&nbsp;<input type="checkbox" name="fet" value="operator" /></td></tr>
    <td width="234" height="24" align="right"  valign="middle" class="tblheading">SRV1&nbsp;</td>
    <td width="192" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet" value="viewer"  /></td></tr>
	 <tr class="Light"  height="25">
  <td width="234" align="right"  valign="left" class="tblheading">&nbsp;SRV2&nbsp;</td>
    <td width="100" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet" value="viewer"   onChange="f1(this.value);"/></td></tr>
	 <tr class="Light"  height="25">
    <td width="234" align="right"  valign="middle" class="tblheading">SRV3&nbsp;</td>
    <td width="192" colspan="3" align="left"  valign="middle" class="tbltext"  >&nbsp;<input type="checkbox" name="fet" value="viewer" /></td></tr>
      <td width="234" height="24" align="right"  valign="middle" class="tblheading">SRV4&nbsp;</td>
        <td width="192" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet" value="viewer"  /></td></tr>
		<td width="234" height="24" align="right"  valign="middle" class="tblheading">SRV5&nbsp;</td>
        <td width="192" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet" value="viewer"  /></td>
		</tr>
	</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_report.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a></a>&nbsp;&nbsp;<a href="javascript:document.frmaddDepartment.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"><input type="hidden" name="flagcode" value=""/></td>
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
