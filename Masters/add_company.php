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
	
	
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		//$name=trim($_POST['txtname']);
		
		
		$cname=trim($_POST['txtcname']);
		$address=trim($_POST['txtadd']);
		$ccity=trim($_POST['ccity']);
		$cpin=trim($_POST['cpin']);
		$cstate=trim($_POST['cstate']);
		$cphno=trim($_POST['cphno']);
		$cphno1=trim($_POST['cphno1']);
		$plant=trim($_POST['txtplant']);
		$plantcode=trim($_POST['txtplantcode']);
		$pcity=trim($_POST['pcity']);
		$ppin=trim($_POST['ppin']);
		$pstate=trim($_POST['pstate']);
		$pphno=trim($_POST['pphno']);
		$pphno1=trim($_POST['pphno1']);
		$pstd=trim($_POST['pstd']);
        $cstd=trim($_POST['cstd']);
		$licenceno=trim($_POST['txtlcn']);
		$tin=trim($_POST['txttin']);
		$cst=trim($_POST['txtcstno']);
		$plantcode=isset($_POST['txtplantcode']) ? trim($_POST['txtplantcode']) : '';
			$parentimage1=trim($_FILES['brouse']['name']);
		 if($parentimage1<>"")
		{
		$imagepath1="../help/".$parentimage1;
		copy($_FILES['brouse']['tmp_name'],$imagepath1);
		}
		 $sql_in="insert into tbl_parameters(company_name, logo, address, ccity, cphone, cphone1, cstate, cstd, cpin, plant, plantcode, pcity, pphone, pphone1, pstate, pstd, ppin, licence_no, tin, cst_no) values('$cname', '$imagepath1', '$address', '$ccity', '$cphone', '$cphone1', '$cstate', '$cstd', '$cpin', '$plant', '$plantcode', '$pcity', '$pphone', '$pphone1', '$pstate', '$pstd', '$ppin', '$licenceno', '$tin', '$cst')";
			//exit;							
		if(mysql_query($sql_in)or die(mysql_error()))
		{		
			echo "<script>window.location='companyhome.php'</script>";	
		}
		}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Company Master - Add Parameters</title>
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

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" ><table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function f1(val)
{
	if(document.frmaddDept.txtcname.value=="")
	{
	alert("Define Company Name ");
	 document.frmaddDept.brouse.value="";
	 document.frmaddDept.txtcname.focus();
	 return false;
	}
	}
	function f2(val)
{
	if(document.frmaddDept.brouse.value=="")
	{
	alert("Attach company logo. ");
	 document.frmaddDept.txtadd.value="";
	 document.frmaddDept.brouse.focus();
	 return false;
	}
	}
	function f3(val)
{
	if(document.frmaddDept.txtadd.value=="")
	{
		alert("Define Address. ");
	 document.frmaddDept.ccity.value="";
	 document.frmaddDept.txtadd.focus();
	 return false;
	}
	else
	{
	document.frmaddDept.ccity.value=ucwords_w(val.toLowerCase());
	}
	
	}
	function f4(val)
{
	if(document.frmaddDept.ccity.value=="")
	{
	alert("Enter City/town/village");
	 document.frmaddDept.cpin.value="";
	 document.frmaddDept.ccity.focus();
	 return false;
	}
	}
	function f5(val)
{
	if(document.frmaddDept.cpin.value=="")
	{
	alert("Enter pin");
	 document.frmaddDept.cstate.value="";
	 document.frmaddDept.cpin.focus();
	 return false;
	}
	}
	function f6(val)
{
	if(document.frmaddDept.cstate.value=="")
	{
	alert("Select State");
	 document.frmaddDept.cphno.value="";
	 document.frmaddDept.cstate.focus();
	 return false;
	}
	}
	function f7(val)
{
	if(document.frmaddDept.cphno.value=="")
	{
		alert("Please enter STD Code");
	 document.frmaddDept.txtplant.value="";
	 document.frmaddDept.cphno.focus();
	 return false;
	}
	}
	function f8(val)
{
	if(document.frmaddDept.txtplant.value=="")
	{
	alert("Define  Plant Address. ");
	 document.frmaddDept.pcity.value="";
	 document.frmaddDept.txtplant.focus();
	 return false;
	}
	else
	{
	document.frmaddDept.pcity.value=ucwords_w(val.toLowerCase());
	}
	
	}
	function f9(val)
{
	if(document.frmaddDept.pcity.value=="")
	{
	alert("Please City");
	 document.frmaddDept.ppin.value="";
	 document.frmaddDept.pcity.focus();
	 return false;
	}
	}
	function f10(val)
{
	if(document.frmaddDept.ppin.value=="")
	{
	alert("Please Enter  Pin");
	 document.frmaddDept.pstate.value="";
	 document.frmaddDept.ppin.focus();
	 return false;
	}
	}
	function f11(val)
{
	if(document.frmaddDept.pstate.value=="")
	{
	alert("Please Select State");
	 document.frmaddDept.pphno.value="";
	 document.frmaddDept.pstate.focus();
	 return false;
	}
	}
	function f12(val)
{
	if(document.frmaddDept.pphno.value=="")
	{
	alert("Define Phone  No.");
	 document.frmaddDept.txtcln.value="";
	 document.frmaddDept.pphno.focus();
	 return false;
	}
	}
	function f13(val)
{
	if(document.frmaddDept.txtcln.value=="")
	{
	alert("Define Seed Licence No.");
	 document.frmaddDept.txttin.value="";
	 document.frmaddDept.txtcln.focus();
	 return false;
	}
	}
	function f14(val)
{
	if(document.frmaddDept.txttin.value=="")
	{
	alert("Define TIN");
	 document.frmaddDept.txtcstno.value="";
	 document.frmaddDept.txttin.focus();
	 return false;
	}
	}
function onloadfocus()
	{
	document.frmaddDept.txtcname.focus();
	}
   function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }	

	function mySubmit()
{ 
	if(document.frmaddDept.txtcname.value=="")
	{
	alert("Define Company Name ");
	document.frmaddDept.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDept.txtcname.value.charCodeAt() == 32)
	{
	alert("Company Name cannot start with space.");
	document.frmaddDept.txtcname.focus();
	return false;
	}
	
	
	
	if(document.frmaddDept.brouse.value=="")
	{
	alert("Attach company logo. ");
	document.frmaddDept.brouse.focus();
	return false;
	}
			
	if(document.frmaddDept.txtadd.value=="")
	{
	alert("Define Address. ");
	document.frmaddDept.txtadd.focus();
	return false;
	}
	if(document.frmaddDept.txtadd.value.charCodeAt() == 32)
	{
	alert("Address  cannot start with space.");
	document.frmaddDept.txtadd.focus();
	return false;
	}
	
	if(document.frmaddDept.ccity.value=="")
	{
		alert("Enter City/town/village");
		document.frmaddDept.ccity.focus();
		return false;
	}
	
	if(document.frmaddDept.ccity.value.charCodeAt() == 32)
	{
		alert("City cannot start with space.");
		document.frmaddDept.ccity.focus();
		return false;
	}
	
	if(document.frmaddDept.cpin.value=="")
	{
		alert("Please enter Pin Code");
		document.frmaddDept.cpin.focus();
		return false;
	}
	if(document.frmaddDept.cpin.value.charCodeAt() == 32)
	{
		alert("pin cannot start with space.");
		document.frmaddDept.cpin.focus();
		return false;
	}
	if(document.frmaddDept.cpin.value.length < 6 )
		{
			alert("Pin Code can not less than six digits");
			document.frmaddDept.cpin.focus();
			return(false);
		}
	
		
   if(document.frmaddDept.cstate.value=="")
	{
		alert("Select State");
		document.frmaddDept.cstate.focus();
		return false;
	}
	
	 if(document.frmaddDept.cstate.value=="")
	{
		alert("Select State");
		document.frmaddDept.cstate.focus();
		return false;
	}
	
	if(document.frmaddDept.cstd.value=="")
	{
	alert("Please enter STD Code");
	document.frmaddDept.cstd.focus();
	return false;
	}
	
	/*if(document.frmaddDept.cstd.value!="")
	{
		if(!isNumeric(document.frmaddDept.cstd.value))
		{
			alert("STD Code Allows Only Numeric value");
			document.frmaddDept.cstd.focus();
			return(false);
		}
	}*/
	if(document.frmaddDept.cphno.value=="")
	{
	alert("Please enter Phone Number");
	document.frmaddDept.cphno.focus();
	return false;
	}
		
	if(document.frmaddDept.cphno.value!="")
	{
		if(isNaN(document.frmaddDept.cphno.value))
		{
			alert("Phone Number Allows Only Numeric value");
			document.frmaddDept.cphno.focus();
			return(false);
		}
	}
	if(document.frmaddDept.txtplant.value=="")
	{
	alert("Define  Plant Address. ");
	document.frmaddDept.txtplant.focus();
	return false;
	}
	if(document.frmaddDept.txtplant.value.charCodeAt() == 32)
	{
	alert(" Plant Address  cannot start with space.");
	document.frmaddDept.txtplant.focus();
	return false;
	}
	
	if(document.frmaddDept.pcity.value=="")
	{
		alert("Enter City/town/village");
		document.frmaddDept.pcity.focus();
		return false;
	}
	
	if(document.frmaddDept.pcity.value.charCodeAt() == 32)
	{
		alert("City cannot start with space.");
		document.frmaddDept.pcity.focus();
		return false;
	}
	if(document.frmaddDept.ppin.value=="")
	{
		alert("Please enter Pin Code");
		document.frmaddDept.ppin.focus();
		return false;
	}
	if(document.frmaddDept.ppin.value.charCodeAt() == 32)
	{
		alert("pin cannot start with space.");
		document.frmaddDept.ppin.focus();
		return false;
	}
	if(document.frmaddDept.ppin.value.length < 6 )
		{
			alert("Pin Code can not less than six digits");
			document.frmaddDept.ppin.focus();
			return(false);
		}
		
	   if(document.frmaddDept.pstate.value=="")
	{
		alert("Select State");
		document.frmaddDept.pstate.focus();
		return false;
	}
	
	
	if(document.frmaddDept.cstd.value=="")
	{
	alert("Please enter STD Code");
	document.frmaddDept.cstd.focus();
	return false;
	}
	
	/*if(document.frmaddDept.cstd.value!="")
	{
		if(!isNumeric(document.frmaddDept.cstd.value))
		{
			alert("STD Code Allows Only Numeric value");
			document.frmaddDept.cstd.focus();
			return(false);
		}
	}*/
	
	if(document.frmaddDept.pphno.value=="")
	{
	alert("Please enter Phone Number");
	document.frmaddDept.pphno.focus();
	return false;
	}
		
	/*if(document.frmaddDept.pphno.value!="")
	{
		if(isNaN(document.frmaddDept.pphno.value))
		{
			alert("Phone Number Allows Only Numeric value");
			document.frmaddDept.pphno.focus();
			return(false);
		}
	}*/
	if(document.frmaddDept.txtlcn.value=="")
	{
	alert("Define seed license number. ");
	document.frmaddDept.txtlcn.focus();
	return false;
	}
	if(document.frmaddDept.txtlcn.value.charCodeAt() == 32)
	{
	alert("Seed Licence No cannot start with space.");
	document.frmaddDept.txtlcn.focus();
	return false;
	}
	
	if(document.frmaddDept.txttin.value=="")
	{
	alert("Define TIN number. ");
	document.frmaddDept.txttin.focus();
	return false;
	}
	if(document.frmaddDept.txttin.value.charCodeAt() == 32)
	{
	alert("Tin cannot start with space.");
	document.frmaddDept.txttin.focus();
	return false;
	}
	
	if(document.frmaddDept.txtcstno.value=="")
	{
	alert("Define Cst.");
	document.frmaddDept.txtcstno.focus();
	return false;
	}
	if(document.frmaddDept.txtcstno.value.charCodeAt() == 32)
	{
	alert("Cst cannot start with space.");
	document.frmaddDept.txtcstno.value.focus();
	return false;
	}
			
return true;
}
</SCRIPT>

  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Company Master - Add Parameters </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Parameters</td>
</tr>
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
 <?php
$quer2=mysql_query("SELECT * FROM tbl_parameters "); 
?>
<tr class="Light" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Company Name&nbsp;</td>
<td width="438" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="40" class="tbltext" tabindex="0" maxlength="40" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
 
<tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Company Logo&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="brouse" class="tbltext" type="file" size="30"   onChange="f1(this.value);"/>&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
<tr class="Light" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<textarea name="txtadd" cols="20" rows="5" tabindex="" onChange="f2(this.value);"  class="tbltext"></textarea></td></tr>
<tr class="Dark" height="30" >
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;City/Town/Village&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="ccity" type="text" size="25" class="tbltext" tabindex="" maxlength="25"  onChange="f3(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
       
  <tr class="Light" height="30" >
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;Pin Code&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="cpin" type="text" size="5" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)"  onChange="f4(this.value);"/>
      &nbsp;<font color="#FF0000">*</font></td>
  </tr>
        
  <tr class="Dark" height="25">
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<select name="cstate" class="tbltext"  style="width:170px;" tabindex="" onChange="f5(this.value);">
          <option value="">--Select State--</option>
          <option value="Andhra Pradesh">Andhra Pradesh</option>
          <option value="Andaman &amp; Nicobar">Andaman &amp; Nicobar</option>
          <option value="Arunchal Pradesh">Arunchal Pradesh</option>
          <option value="Assam">Assam</option>
          <option value="Bihar">Bihar</option>
          <option value="Chandigarh">Chandigarh</option>
          <option value="Chattisgarh">Chattisgar</option>
          <option value="Dadra &amp; Nagar Haveli">Dadra &amp; Nagar Haveli</option>
          <option value="Daman&amp;Due">Daman&amp;Due</option>
          <option value="Delhi">Delhi</option>
          <option value="Goa">Goa</option>
          <option value="Gujarat">Gujarat</option>
          <option value="Haryana">Haryana</option>
          <option value="Himachal Pradesh">Himachal Pradesh</option>
          <option value="Jammu&amp;Kashmir">Jammu&amp;Kashmir</option>
          <option value="Jharkhand">Jharkhand</option>
          <option value="Karnataka">Karnataka</option>
          <option value="Kerala">Kerala</option>
          <option value="Lakshdweep">Lakshdweep</option>
          <option value="Madhya Pradesh">Madhya Pradesh</option>
          <option value="Maharashtra">Maharashtra</option>
          <option value="Manipur">Manipur</option>
          <option value="Meghalaya">Meghalaya</option>
          <option value="Mizoram">Mizoram</option>
          <option value="Nagaland">Nagaland</option>
          <option value="Orissa">Orissa</option>
          <option value="Punjab">Punjab</option>
          <option value="Pondicherry">Pondicherry</option>
          <option value="Rajasthan">Rajasthan</option>
          <option value="Sikkim">Sikkim</option>
          <option value="Tamilnadu">Tamilnadu</option>
		  <option value="Telangana">Telangana</option>
          <option value="Tripura">Tripura</option>
          <option value="Uttar Pradesh">Uttar Pradesh</option>
          <option value="Uttaranchal">Uttaranchal</option>
          <option value="West Bengal">West Bengal</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Light" height="30"  >
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;Phone Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="cstd" type="text" size="4" class="tbltext" tabindex="7" maxlength="5" onkeypress="return isNumberKey(event)" />&nbsp;&nbsp;<input name="cphno" type="text" size="10" class="tbltext" tabindex="" maxlength="10"  onChange="f6(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<font class="tblheading" style="text-align:center; vertical-align:middle">Alternate</font>&nbsp;&nbsp;<input name="cphno1" type="text" size="10" class="tbltext" tabindex="" maxlength="10" /></td>
  </tr>
<tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Plant Address&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<textarea name="txtplant" cols="20" rows="5" tabindex="" onChange="f7(this.value);"  class="tbltext"></textarea> &nbsp;<font color="#FF0000">*</font></td></tr>
<tr class="Light" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Plant Code&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtplantcode" type="text" size="20" class="tbltext" tabindex="0" maxlength="20"/>&nbsp;</td></tr>
<tr class="Light" height="30" >
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;City/Town/Village&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="pcity" type="text" size="25" class="tbltext" tabindex="" maxlength="25"  onChange="f8(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
       
  <tr class="Dark" height="30" >
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;Pin Code&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="ppin" type="text" size="5" class="tbltext" tabindex="" maxlength="6" onkeypress="return isNumberKey(event)"  onChange="f9(this.value);"/>
      &nbsp;<font color="#FF0000">*</font></td>
  </tr>
        
  <tr class="Light" height="25">
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<select name="pstate" class="tbltext"  style="width:170px;" tabindex="" onChange="f10(this.value);">
          <option value="">--Select State--</option>
          <option value="Andhra Pradesh">Andhra Pradesh</option>
          <option value="Andaman &amp; Nicobar">Andaman &amp; Nicobar</option>
          <option value="Arunchal Pradesh">Arunchal Pradesh</option>
          <option value="Assam">Assam</option>
          <option value="Bihar">Bihar</option>
          <option value="Chandigarh">Chandigarh</option>
          <option value="Chattisgarh">Chattisgarh</option>
          <option value="Dadra &amp; Nagar Haveli">Dadra &amp; Nagar Haveli</option>
          <option value="Daman&amp;Due">Daman&amp;Due</option>
          <option value="Delhi">Delhi</option>
          <option value="Goa">Goa</option>
          <option value="Gujarat">Gujarat</option>
          <option value="Haryana">Haryana</option>
          <option value="Himachal Pradesh">Himachal Pradesh</option>
          <option value="Jammu&amp;Kashmir">Jammu&amp;Kashmir</option>
          <option value="Jharkhand">Jharkhand</option>
          <option value="Karnataka">Karnataka</option>
          <option value="Kerala">Kerala</option>
          <option value="Lakshdweep">Lakshdweep</option>
          <option value="Madhya Pradesh">Madhya Pradesh</option>
          <option value="Maharashtra">Maharashtra</option>
          <option value="Manipur">Manipur</option>
          <option value="Meghalaya">Meghalaya</option>
          <option value="Mizoram">Mizoram</option>
          <option value="Nagaland">Nagaland</option>
          <option value="Orissa">Orissa</option>
          <option value="Punjab">Punjab</option>
          <option value="Pondicherry">Pondicherry</option>
          <option value="Rajasthan">Rajasthan</option>
          <option value="Sikkim">Sikkim</option>
          <option value="Tamilnadu">Tamilnadu</option>
		  <option value="Telangana">Telangana</option>
          <option value="Tripura">Tripura</option>
          <option value="Uttar Pradesh">Uttar Pradesh</option>
          <option value="Uttaranchal">Uttaranchal</option>
          <option value="West Bengal">West Bengal</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Dark" height="30"  >
    <td width="304"  align="right" valign="middle" class="tblheading">&nbsp;Phone Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="pstd" type="text" size="4" class="tbltext" tabindex="7" maxlength="5" onkeypress="return isNumberKey(event)"   onChange="f11(this.value);"/>&nbsp;&nbsp;<input name="pphno" type="text" size="15" class="tbltext" tabindex="" maxlength="10"   onChange="f11(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<font class="tblheading" style="text-align:center; vertical-align:middle">Alternate</font>&nbsp;&nbsp;<input name="pphno1" type="text" size="10" class="tbltext" tabindex="" maxlength="10" /></td>
  </tr>
 <tr class="Light" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Seed License No&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlcn" type="text" size="40" class="tbltext" tabindex="0" maxlength="40"  onChange="f12(this.value);"/>&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
<tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">TIN&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txttin" type="text" size="20" class="tbltext" tabindex="0" maxlength="20"  onChange="f13(this.value);"/>&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
 
 <tr class="Light" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">CST No.&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtcstno" type="text" size="20" class="tbltext" tabindex="0" maxlength="20"  onChange="f14(this.value);"/>&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
 </table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="companyhome.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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