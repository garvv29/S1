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
		$cla=trim($_POST['txtcla']);
		$bname=trim($_POST['txtbname']);
		$contact=trim($_POST['txtcpname']);
		$address=trim($_POST['txtaddress']);
		$phno=trim($_POST['txtphno']);
		$city=trim($_POST['txtcity']);
		$pin=trim($_POST['txtpin']);
		$country=trim($_POST['country']);
		$state=trim($_POST['state']);
		$statefill=trim($_POST['statefill']);
		$std=trim($_POST['std']);
		$mobile=trim($_POST['mobile']);
		$phno=trim($_POST['txtphno']);
		$pan=trim($_POST['txtpan']);
		$cst=trim($_POST['txtcst']);
		$tin=trim($_POST['txttin']);
		$product=trim($_POST['txtproduct']);
		if($country=="India")$state=$statefill;
		
	  	$sql22=mysql_query("select * from tbl_partymaser where business_name='".$bname."'") or die(mysql_error());
		$num=mysql_num_rows($sql22);
		
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Party Name .\n  ID already Present.");
			  </script>
			 <?php
		}
		else
		{
			$sql_in="insert into tbl_partymaser(classification,business_name,contact, address, city, state, country, pin, mob, std,  phone, tin, cst, pan, product)values('$cla',  '$bname', '$contact', '$address', '$city', '$state', '$country', '$pin', '$mobile', '$std', '$phno', '$tin', '$cst', '$pan', '$product')";
				//exit;						
			if(mysql_query($sql_in)or die(mysql_error()))
			{ 
				echo "<script>window.location='party_Masterhome.php'</script>";	
			}
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Master -Add  Party</title>
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
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }function onloadfocus()
{
	document.frmaddDepartment.txtcla.focus();
}
function clk(opt)
{
	if(opt!="")
	{
		if(opt=="Vendor")
		{
			document.getElementById('pro').style.display="block";
		}
		else
		{
			document.getElementById('pro').style.display="none";
		}	
	}
	else
	{
		alert("Please entet Product");
	}
}
function onloadfocus()
{
	document.frmaddDepartment.txtcla.focus();
}
	
function f1(val)
{
	if(document.frmaddDepartment.txtcla.value=="")
	{
		alert("Select Category of Party");
		document.frmaddDepartment.txtbname.value="";
		document.frmaddDepartment.txtcla.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtbname.value=ucwords_w(val);
	}
}

function f2(val)
{
	if(document.frmaddDepartment.txtbname.value=="")
	{
		alert("Define Party name ");
		document.frmaddDepartment.txtcpname.value==""
		document.frmaddDepartment.txtbname.focus();
		return false;
	}
}
function f3(val)
{
	if(document.frmaddDepartment.txtcpname.value=="")
	{
		alert("Define Contact Person");
		document.frmaddDepartment.txtaddress.value==""
		document.frmaddDepartment.txtcpname.focus();
		return false;
	}
}
function f4(val)
{
	if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Enter Address");
		document.frmaddDepartment.txtcity.value==""
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	else
	{
		document.frmaddDepartment.txtcity.value=ucwords_w(val.toLowerCase());
	}
}
function f5(val)
{
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Enter City");
		document.frmaddDepartment.state.value==""
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
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
	if(document.frmaddDepartment.txtcla.value=="")
	{
		alert("Select Category of Party");
		// document.frmaddDepartment.txtcla.value.focus();
		return false;
	}
	if(document.frmaddDepartment.txtbname.value=="")
	{
		alert("Define Party name ");
		document.frmaddDepartment.txtbname.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcpname.value=="")
	{
		alert("Define Contact Person");
		document.frmaddDepartment.txtcpname.focus();
		return false;
	}
	if(document.frmaddDepartment.txtaddress.value=="")
	{
		alert("Enter Address");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	if(document.frmaddDepartment.txtaddress.value.charCodeAt() == 32)
	{
		alert("Address cannot start with space.");
		document.frmaddDepartment.txtaddress.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcity.value=="")
	{
		alert("Enter City/town/village");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcity.value.charCodeAt() == 32)
	{
		alert("City cannot start with space.");
		document.frmaddDepartment.txtcity.focus();
		return false;
	}
	if(document.frmaddDepartment.txtpin.value!="")
	{
		if(document.frmaddDepartment.txtpin.value.length < 6 )
		{
			alert("Pin Code can not less than six digits");
			document.frmaddDepartment.txtpin.focus();
			return(false);
		}
	}
	/*if(document.frmaddDepartment.txtpin.value=="")
	{
		alert("Please enter Pin Code");
		document.frmaddDepartment.txtpin.focus();
		return false;
	}
	if(document.frmaddDepartment.txtpin.value.charCodeAt() == 32)
	{
		alert("pin cannot start with space.");
		document.frmaddDepartment.txtpin.focus();
		return false;
	}
	if(document.frmaddDepartment.txtpin.value.length < 6 )
		{
			alert("Pin Code can not less than six digits");
			document.frmaddDepartment.txtpin.focus();
			return(false);
		}
	if(document.frmaddDepartment.txtpin.value.charCodeAt() == 32)
	{
		alert("Pin Code cannot start with space.");
		document.frmaddDepartment.txtpin.focus();
		return false;
	}*/
	
	if(document.frmaddDepartment.country.value=="India")
	{	
		if(document.frmaddDepartment.state.value=="")
		{
			alert("Select State");
			document.frmaddDepartment.state.focus();
			return false;
		}
	}
	else
	{
		if(document.frmaddDepartment.statefill.value=="")
		{
			alert("Enter State");
			document.frmaddDepartment.statefill.focus();
			return false;
		}
	}
	/*if(document.frmaddDepartment.txtphno.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtphno.value))
		{
			alert("Phone Number Allows Only Numeric value");
			//document.frmaddDepartment.txtphno.focus();
			return false ;
		}
	}
	
	if(document.frmaddDepartment.mobile.value=="")
	{
	alert("Please enter Mobile Number");
	document.frmaddDepartment.mobile.focus();
	return false;
	}

		if(document.frmaddDepartment.mobile.value.length <10)
		{
			alert("Mobile Number can not less than 10 digits");
			document.frmaddDepartment.mobile.focus();
			return(false);
		}
	
			
	if(document.frmaddDepartment.txttin.value=="")
	{
		alert("Please enter Tin");
		document.frmaddDepartment.txttin.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txttin.value.charCodeAt() == 32)
	{
		alert("Tin cannot start with space.");
		document.frmaddDepartment.txttin.focus();
		return false;
	}
	
			
	if(document.frmaddDepartment.txtcst.value=="")
	{
		alert("Please enter Cst");
		document.frmaddDepartment.txtcst.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtcst.value.charCodeAt() == 32)
	{
		alert("CST cannot start with space.");
		document.frmaddDepartment.txtcst.focus();
		return false;
	}
	
		
	if(document.frmaddDepartment.txtpan.value=="")
	{
		alert("Please enter Pan");
		document.frmaddDepartment.txtpan.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtpan.value.charCodeAt() == 32)
	{
		alert("Pan cannot start with space.");
		document.frmaddDepartment.txtpan.focus();
		return false;
	}*/
	
	if(document.frmaddDepartment.txtcla.value!="")
	{
		if(document.frmaddDepartment.txtcla.value=="Vendor")
		{
			if(document.frmaddDepartment.txtproduct.value=="")
			{
				alert("Enter Products");
				document.frmaddDepartment.txtproduct.focus();
				return false;
			}
		}
	}
	return true;	
}
function chkstate(countryval)
{
	if(countryval=="India")
	{
		document.getElementById('stsel').style.display="block";
		document.frmaddDepartment.state.selectedIndex=0;
		document.frmaddDepartment.statefill.value="";
		document.getElementById('stfill').style.display="none";	
	}
	else
	{
		document.getElementById('stsel').style.display="none";
		document.frmaddDepartment.state.selectedIndex=0;
		document.frmaddDepartment.statefill.value="";
		document.getElementById('stfill').style.display="block";	
	}
}
</script>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" >
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
		  
<!-- actual page start--->	
	   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="employeemaster_home.php?dept_id=<?php echo $dept_id;?>" style="text-decoration:underline; cursor:hand; color:#404d21;">Party Master</a> - Add Party Master </td>
	    </tr></table></td>
	   	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="3" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit()"  > 
	 <input name="frm_action" value="submit" type="hidden">
	     <input name="txt14" value="" type="hidden"> 
	 <br /> 
	<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7">
<table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="30">
    <td colspan="7" align="center" class="tblheading">Add a New Party Form </td>
  </tr>
  <tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
    <tr class="Light" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">Select&nbsp;Category&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select name="txtcla" class="tbltext"  style="width:180px;" tabindex="" value="text"  onChange="clk(this.value);"  >
           <option value="">--Select Category--</option>
          <option value="Vendor">Vendor</option>
		   <option value="C&F">C&amp;F</option>
		   <option value="Dealers">Dealer</option>
          <option value="Stock Transfer">Stock Transfer</option>
		   <option value="Internal Return">Internal Return</option>
        </select>&nbsp;<font color="#FF0000">*</font></td>
  </tr>
  <tr class="Dark" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtbname" type="text" size="40" class="tbltext" tabindex=""  maxlength="40" onChange="f1(this.value);" onBlur"javascript:this.value=ucwords_w(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          </tr>
		    <tr class="Light" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Contact Person&nbsp;</td>
    <td align="left" valign="middle" class="tbltext" colspan="4">&nbsp;<input name="txtcpname" type="text" size="40" class="tbltext" tabindex=""  maxlength="40" onChange="f2(this.value);" onBlur="javascript:this.value=ucwords_w(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
        
  <tr class="Dark" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
    <td colspan="4" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtaddress" cols="20" rows="5" tabindex="" onChange="f3(this.value);" class="tbltext" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
      
  <tr class="Light" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;City/Town/Village&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="txtcity" type="text" size="25" class="tbltext" tabindex="" maxlength="25"  onchange="f4(this.value);"/>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
       
  <tr class="Dark" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Pin Code&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="txtpin" type="text" size="5" class="tbltext" tabindex="" maxlength="6" onKeyPress="return isNumberKey(event)"  />
      &nbsp;</td>
  </tr>
  <tr class="Light" height="25">
<?php
$quer3=mysql_query("SELECT DISTINCT country FROM tbl_country order by country Asc"); 
?>
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Country&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<select name="country" class="tbltext"  style="width:170px;" tabindex="" onChange="chkstate(this.value)" >
         <?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option <?php if($noticia['country']=="India") echo "Selected";;?> value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>    
  <tr class="Light" height="25">
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4"><div id="stsel" style="display:block">&nbsp;<select name="state" class="tbltext"  style="width:170px;" tabindex="" onChange="f5(this.value);" >
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
        </select></div><div id="stfill" style="display:none">&nbsp;<input type="text" name="statefill" size="25" maxlength="25" value="" class="tbltext" onChange="f5(this.value);" /></div>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>

<?php echo $country; ?>

  <tr class="Dark" height="30"  >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Phone Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="std" type="text" size="5" class="tbltext" tabindex="7" maxlength="5" onKeyPress="return isNumberKey(event)" />&nbsp;&nbsp;<input name="txtphno" type="text" size="20" class="tbltext" tabindex="" maxlength="20"  /></td>
  </tr>
       
  <tr class="Light" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Mobile Number&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="4">&nbsp;<input name="mobile" type="text" size="15" class="tbltext" tabindex="" maxlength="13" onKeyPress="return isNumberKey(event)"  />
      &nbsp;</td>
  </tr>
       
  <tr class="Dark" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">TIN&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4" >&nbsp;<input name="txttin" type="text" size="18" class="tbltext" tabindex="" maxlength="18" />
      &nbsp;</td>
	  </tr>
       
	   <tr class="Light" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">CST&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4">&nbsp;<input name="txtcst" type="text" size="18" class="tbltext" tabindex="" maxlength="18"  />&nbsp;</td>
	   </tr>
        
		 <tr class="Dark" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;PAN&nbsp;</td>
    <td width="419" colspan="4" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtpan" type="text" size="18" class="tbltext" tabindex="" maxlength="13"  />&nbsp;</td>
  </tr>
  </table>
  <div id="pro" style="display:none">
  <table align="center" border="1" width="700" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
    <tr class="Light" height="30" >
    <td width="275"  align="right" valign="middle" class="tblheading">&nbsp;Products&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext"colspan="4">&nbsp;<textarea name="txtproduct" cols="20" rows="5" tabindex=""  class="tbltext"></textarea>&nbsp;<font color="#FF0000">*</font></td>
       </tr>
</table>
</div>
</td></tr>
<tr>
<td><table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="party_Masterhome.php?classification_id=<?php echo $classification_id;?>" tabindex="20"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" OnClick="return mySubmit();" border="0" style="display:inline;cursor:hand;" tabindex=""></td>
</tr>
</table></td><td width="30"></td>
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
