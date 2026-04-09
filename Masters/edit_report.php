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
	//echo $role = $_REQUEST['faq_role'];
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		//$name=trim($_POST['txtname']);
		
		//$questions=trim($_POST['questions']);
		   $roles=trim($_POST['flagcode']);
		  $roles1=trim($_POST['flagcode1']);
		  
		/*$parentimage1=trim($_FILES['upload']['name']);
		 if($parentimage1<>"")
		{
		$imagepath1="../help/".$parentimage1;
		copy($_FILES['upload']['tmp_name'],$imagepath1);
		}*/
		/*$sql_in="insert into tblfaq(faq_questions,faq_answer, faq_role) values(
											  '$questions',
										  '$answers',
											  '$role')";
								
		if(mysql_query($sql_in)or die(mysql_error()))/
		/*if($pare
		{		*ntimage1<>"")
		{
		$imagepath1="help/".$parentimage1;
		copy($_FILES['image1']['tmp_name'],$imagepath1);
		$str="update tblhelp set help_file='$imagepath1' where faq_id='$fid'";
		$result=mysql_query($str) or die("Error:".mysql_error());
		}*/
		//exit;	
	 $sql_in="UPDATE tbl_report SET good='$roles' , damage='$roles1' where id ='$id'";
	if(mysql_query($sql_in)or die(mysql_error()))
		{
			echo "<script>window.location='home_report.php'</script>";	
		}
	  //}	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Report Master -Edit Report</title>
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
function mySubmit()
{ 
document.frmaddDepartment.flagcode.value =="";		
document.frmaddDepartment.flagcode1.value =="";		
	
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
for (var i = 0; i < document.frmaddDepartment.fet1.length; i++) 
{          
		 
		  if(document.frmaddDepartment.fet1[i].checked == true)
			{
				if(document.frmaddDepartment.flagcode1.value =="")
				{
				document.frmaddDepartment.flagcode1.value=document.frmaddDepartment.fet1[i].value;
				}
				else
				{
				document.frmaddDepartment.flagcode1.value = document.frmaddDepartment.flagcode1.value +','+document.frmaddDepartment.fet1[i].value;
				}
			}
}
if(document.frmaddDepartment.flagcode.value == "" && document.frmaddDepartment.flagcode1.value == "")
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
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading"> &nbsp;Reports Master - Edit </td>
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

<table align="center" border="1" width="350" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 
    <?php
 $sql_qry=mysql_query(" select * from tbl_report where id='$id'")or die("Error".mysql_error());
  $row_qry=mysql_fetch_array($sql_qry);
 $total=mysql_num_rows($sql_qry);
    $row_qry['good'];
	$row_qry['damage'];
?>
    <tr class="tblsubtitle" height="25">
      <td colspan="4" align="center" class="tblheading" valign="middle">Edit Report Assignment</td>
    </tr>
    <tr class="Dark"  height="25">
      <td width="98" align="right" valign="middle" class="tblheading"> Report &nbsp;</td>
      <td width="246" colspan="2" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row_qry['report'];?>    
    </tr>
   <tr class="Light"  height="25">
    <td width="98" align="right"  valign="left" class="tblheading">&nbsp;Admin&nbsp;</td>
    <td width="246" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet" checked="checked" disabled="disabled" style="background-color:#CCCCCC" value="admin" /></td>
				</tr>
			<tr class="Light"  height="25">	
			<td width="98" align="right"  valign="left" class="tblheading">&nbsp;Operator&nbsp;</td>
    <td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" readonly="true" name="fet" <?php $p1_array=explode(",",$row_qry['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "operator") { $i++;}
				}
				}
				if($i !=0) { echo "checked";}?> value="operator"/></td>
				</tr>
								<tr class="Light"  height="25">
  <td width="98" height="28" align="right"  valign="left" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=1") or die(mysql_error()); $row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>" style="cursor:pointer" >SRV1&nbsp;</td>
    <td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet"  readonly="true"<?php $p1_array=explode(",",$row_qry['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV1") { $i++;}
				}
				}
				if($i !=0) { echo "checked";}?> value="SRV1" /></td>
				</tr>
								<tr class="Light"  height="25">
  <td width="98" align="right"  valign="left" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=2") or die(mysql_error()); $row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>"  style="cursor:pointer">SRV2&nbsp;</td>
    <td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet"  readonly="true"<?php $p1_array=explode(",",$row_qry['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV2") { $i++;}
				}
				}
				if($i !=0) { echo "checked";}?> value="SRV2" /></td>
				</tr>
				<tr class="Light"  height="25">
  <td width="98" align="right"  valign="left" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=3") or die(mysql_error()); $row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>"  style="cursor:pointer">SRV3&nbsp;</td>
    <td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet"  readonly="true"<?php $p1_array=explode(",",$row_qry['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV3") { $i++;}
				}
				}
				if($i !=0) { echo "checked";}?> value="SRV3" /></td>
				</tr>
				<tr class="Light"  height="25">
  <td width="98" align="right"  valign="left" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=4") or die(mysql_error()); $row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>"  style="cursor:pointer">SRV4&nbsp;</td>
    <td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet"  readonly="true"<?php $p1_array=explode(",",$row_qry['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV4") { $i++;}
				}
				}
				if($i !=0) { echo "checked";}?> value="SRV4" /></td>
				</tr>
				<tr class="Light"  height="25">
  <td width="98" align="right"  valign="left" class="tblheading" title="<?php $sql_rep=mysql_query("select * from tbl_viewer where vcode=5") or die(mysql_error()); $row_rep=mysql_fetch_array($sql_rep); echo $row_rep['name'];  ?>" style="cursor:pointer">SRV5&nbsp;</td>
    <td colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" name="fet"  readonly="true"<?php $p1_array=explode(",",$row_qry['good']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "SRV5") { $i++;}
				}
				}
				if($i !=0) { echo "checked";}?> value="SRV5" /></td>
				
							</tr>
</table>
<table align="center" width="551" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"><input type="hidden" name="flagcode" value=""/> <input type="hidden" name="flagcode1" value=""/></td>
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
