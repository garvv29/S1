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
   //$logid="OP1";
	//$lgnid="OP1";
		
	
	//$res_rt=mysql_query("select * from tbl_opr");
	//$row_rt=mysql_num_rows($res_rt);
	 
	 $role='operator';
	//$status='active';
	
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		$name=trim($_POST['txtname']);
		$login=trim($_POST['txtId']);
		$pass=trim($_POST['txtpass']);
		$email=trim($_POST['txtemail']);
		$status=trim($_POST['txt1']);
		$code=trim($_POST['code']);
	     $scode=trim($_POST['scode']);
		
		$query1=mysql_query("SELECT * FROM tbl_opr where name='$name'") or die("Error: " . mysql_error());
		$numofrecords1=mysql_num_rows($query1);
		
		$query2=mysql_query("SELECT * FROM tbl_opr where login='$login'") or die("Error: " . mysql_error());
		$numofrecords2=mysql_num_rows($query2);
		
		$query3=mysql_query("SELECT * FROM tbl_opr where email='$email'") or die("Error: " . mysql_error());
		$numofrecords3=mysql_num_rows($query3);
		
		$query5=mysql_query("SELECT * FROM tbl_user where loginid='$login'") or die("Error: " . mysql_error());
		$numofrecords5=mysql_num_rows($query5);
		
		$query6=mysql_query("SELECT * FROM tbl_user where email='$email'") or die("Error: " . mysql_error());
		$numofrecords6=mysql_num_rows($query6);
		 //exit;
   		// $numofrecords=mysql_num_rows($query);
		 //exit;
	 	 if($numofrecords1 >0 || $numofrecords2>0 || $numofrecords3>0 || $numofrecords5>0 || $numofrecords6>0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
		 $sql_in="insert into tbl_opr(name, login, pass, email, status,code) values(
											  '$name',
											  '$login',
											  '$pass',
											  '$email',
											  '$status',
											  '$code'
												)";
										//exit;	
		if(mysql_query($sql_in)or die(mysql_error()))
		{ $id=mysql_insert_id();
		$sql_in1="Insert into tbl_user(uid,loginid, password , email,scode ,role,status)values(
			 						'$id',
									'$login',
		 							'$pass',
									'$email',
									'$scode',
									'operator',
									 '$status'
										)";		
					mysql_query($sql_in1)or die(mysql_error());
			echo "<script>window.location='operator_home.php'</script>";	
		}
		}
	
	//}
	}
	
	$sql_code="SELECT MAX(`code`) FROM tbl_opr ORDER BY `code` DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="OP".$code;
		}
		else
		{
			$code=1;
			$code1="OP".$code;
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores -  Master - Add Viewers</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<link href="../include/valodation.js"  />

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
	if(document.frmaddDepartment.txtname.value=="")
	{
	 alert("Please enter Operator Name");
	 document.frmaddDepartment.txtid.value="";
	 document.frmaddDepartment.txtname.focus();
	 return false;
	}
	else
	{
	document.frmaddDept.txtid.value=ucwords_w(val.toLowerCase());
	}
	}

function onloadfocus()
	{
	document.frmaddDepartment.txtname.focus();
	}
	function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
function clk(val)
{
//alert(val);
document.frmaddDepartment.txt11.value=val;
}
function mySubmit()
{  var n=document.frmaddDepartment.txtemail.value.charAt(0);
	
	
	
	if(document.frmaddDepartment.txtname.value=="")
	{
	alert("Please enter Operator Name");
	document.frmaddDepartment.txtname.focus();
	return false;
	}
	if(document.frmaddDepartment.txtname.value.charCodeAt() == 32)
	{
	alert(" Operator Name cannot start with space.");
	document.frmaddDepartment.txtname.focus();
	return false;
	}
	/*if(document.frmaddDepartment.txtname.value!="")
{
var txtVal = document.frmaddDepartment.txtname.value;
for(var i = 0;i<document.frmaddDepartment.txtname.value.length; i++)
{
if(txtVal.charAt(i) < 'A' || txtVal.charAt(i) > 'Z' && txtVal.charAt(i) <'a' || txtVal.charAt(i)>'z' )
{
alert("Invalid Name Enter only Alphabets.");
document.frmaddDepartment.txtname.focus();
return false;
}
}
}*/
	
	if(document.frmaddDepartment.txtId.value=="")
	{
	alert("Please enter Login ID ");
	document.frmaddDepartment.txtId.focus();
	return false;
	}
	if(document.frmaddDepartment.txtId.value.charCodeAt() == 32)
	{
	alert("Login ID cannot start with space.");
	document.frmaddDepartment.txtId.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtId.value!="")
	{
	if(document.frmaddDepartment.txtId.value.length < 6)
	{
	alert("Login ID cannot be less than 6 characters.");
	document.frmaddDepartment.txtId.focus();
	return false;
	}
	}
	
	if(document.frmaddDepartment.txtpass.value=="")
	{
	alert("Please enter Password ");
	document.frmaddDepartment.txtpass.focus();
	return false;
	}
	if(document.frmaddDepartment.txtpass.value.charCodeAt() == 32)
	{
	alert("Password cannot start with space.");
	document.frmaddDepartment.txtpass.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtpass.value!="")
	{
	if(document.frmaddDepartment.txtpass.value.length < 6)
	{
	alert("Password cannot be less than 6 charecters.");
	document.frmaddDepartment.txtpass.focus();
	return false;
	}
	}
	
	

	if(document.frmaddDepartment.txtrepass.value=="")
	{
	alert("Confirm Password");
	document.frmaddDepartment.txtrepass.focus();
	return false;
	}
	if(document.frmaddDepartment.txtrepass.value != document.frmaddDepartment.txtpass.value)
	{
	alert("Retype Password not matched with Password. Please Enter again");
	document.frmaddDepartment.txtrepass.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txt11.value=="")
{
alert("Define Status");
return false;
}

if(document.frmaddDepartment.txtemail.value =="")
	{
	alert("Please Enter VNR Email ID");
	document.frmaddDepartment.txtemail.focus();
	return(false);
	}
	
	if(document.frmaddDepartment.txtemail.value!="")
	{
		
		if (n=="@")
		{
		alert("Please Enter Email ID");
		document.frmaddDepartment.txtemail.focus();
		return false;
		}		
		if (echeck(document.frmaddDepartment.txtemail.value)==false){
		//document.frmaddDepartment.txtemail.value="";
		document.frmaddDepartment.txtemail.focus();
		return false;
		}
		if(!chkemail(document.frmaddDepartment.txtemail.value))
		{
		alert("Please Enter only VNRseeds Email ID");
		document.frmaddDepartment.txtemail.focus();
		return(false);
		}
	}
		return false;	 
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
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="cdinward_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;"></a>Operator Master - Add </td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	   <input name="frm_action" value="submit" type="hidden">
		 <input name="txt11" value="" type="hidden">
		 <input type="hidden" name="code" value="<?php echo $code;?>" />
		  <input type="hidden" name="scode" value="<?php echo $code1;?>" />
		 <br/>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse" height="400">
<tr>
<td valign="top">
<?php //if($row_rt < 3) { ?>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle"><span class="subheading" style="color:#303918; ">Add Operator </span></td>
</tr>

<tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>All fields are Mandatory&nbsp;</td>
  </tr>

 <tr class="Dark" height="30">
<td width="319" align="right" valign="middle" class="tblheading">&nbsp;Operator Code &nbsp;</td>
<td width="375"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="12" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $code1;?>"/></td></tr>
<tr class="Dark"  height="25">
<td  align="right" valign="middle" class="tblheading">&nbsp;Operator  Name&nbsp;</td>
<td width="375" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtname" type="text" class="tbltext" tabindex="0" value="" size="15" maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light"  height="25">
<td  align="right" valign="middle" class="tblheading">&nbsp;Login Id&nbsp;</td>
<td width="375" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtId" type="text" class="tbltext" tabindex="0" value="" size="10" maxlength="10" />&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 10</td> </tr>

<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpass" type="password" class="tbltext" tabindex="1" value="" size="10" maxlength="10"/>&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 10</td> </tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">Confirm  Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtrepass" type="password" class="tbltext" tabindex="2" value="" size="10" maxlength="10"/>&nbsp;<font color="#FF0000">*</font>&nbsp;Min 6 Max 10</td> </tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;&nbsp;&nbsp;Status&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Active" onClick="clk(this.value);"  checked="checked"/>&nbsp;Active&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="Suspend" onClick="clk(this.value);" />&nbsp;Suspend&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">VNR&nbsp;&nbsp;e-mail&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="3" name="txtemail" type="text" size="35" class="tbltext" value="@vnrseeds.com" maxlength="35"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="operator_home.php"></a><a href="javascript:document.frmaddDepartment.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
<?php// } else { ?>
<!--/*<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" v >
<tr >
<td valign="top" align="center" class="tblheading">Maximum of 3 Operator Roles can be created. You have reached to maximum limit.
</td>
</tr>
<tr >
<td valign="top" align="center"><a href="operator_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;</td>
</tr>
</table>
*/--><?php //} ?>
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
