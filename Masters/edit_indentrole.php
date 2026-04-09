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
	//exit;
	 $role='eindent';
	//$status='active';
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		
		$name=trim($_POST['txtname']);
		$stage=trim($_POST['txtstage']);
		$login=trim($_POST['txtlogin']);
		$pass=trim($_POST['txtpass']);
		$code=trim($_POST['code']);
		$email=trim($_POST['txtemail']);
		$scode=trim($_POST['scode']);
		$status=trim($_POST['txt1']);
			
       
		  $query=mysql_query("SELECT * FROM tbl_roles where name='$name' and id!='$id'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
		
		$query1=mysql_query("SELECT * FROM tbl_roles where Login='$login' and id!='$id'") or die("Error: " . mysql_error());
   		$numofrecords1=mysql_num_rows($query1);
          
		  
		$query2=mysql_query("SELECT * FROM tbl_roles where email='$email' and id!='$id'") or die("Error: " . mysql_error());
   		$numofrecords2=mysql_num_rows($query2);

		$query5=mysql_query("SELECT * FROM tbl_user where loginid='$login' and uid!='$id'") or die("Error: " . mysql_error());
		$numofrecords5=mysql_num_rows($query5);
		
		$query6=mysql_query("SELECT * FROM tbl_user where email='$email' and uid!='$id'") or die("Error: " . mysql_error());
		$numofrecords6=mysql_num_rows($query6);

	 	 if($numofrecords >0 || $numofrecords1>0 || $numofrecords2>0 || $numofrecords5>0 || $numofrecords6>0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {	
		$sql_in="UPDATE tbl_roles SET name='$name',
								stage='$stage', 
								login='$login',
								pass='$pass',
								email='$email',
								status='$status'
								where id ='$id'";
																
		if(mysql_query($sql_in)or die(mysql_error()))
		
		{		 $sql_in1="Update tbl_user set	loginid='$login',
											password='$pass',
											email='$email',
											role='$role',
											status='$status'
											where uid='$id' and role='eindent' and scode='$scode'";		
							if(mysql_query($sql_in1)or die(mysql_error()))						 
			echo "<script>window.location='role_home.php'</script>";	
		}
		}
	}

//$a="c";
	$sql_code="SELECT MAX(`code`) FROM tbl_roles where id='$id'  ORDER BY `code` DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="EI".$code;
		}
		else
		{
			$code=1;
			$code1="EI".$code;
		}
		
	/*$sql_spcode="SELECT MAX(code) FROM tbl_roles ORDER BY name DESC";
	$res_spcode=mysql_query($sql_spcode)or die(mysql_error());
		
		if(mysql_num_rows($res_spcode) > 0)
			{
				$row_spcode=mysql_fetch_row($res_spcode);
				$t_spcode=$row_spcode['0'];
				$spcode=$t_spcode;
				
		}
		else
		{
			$code="";
			
		}*/

	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores - e-Indent Master -Edit Indent</title>
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
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function f1(val)
{
	if(document.frmaddDept.txtname.value=="")
	{
	alert("Mention name ");
	 document.frmaddDept.txtstage.value="";
	 document.frmaddDept.txtname.focus();
	 return false;
	}
	else
	{
	document.frmaddDept.txtstage.value=ucwords_w(val.toLowerCase());
	}
		} 
		function f2(val)
{
	if(document.frmaddDept.txtstage.value=="")
	{
	alert("Select Stage");
	 document.frmaddDept.txtlogin.value="";
	 document.frmaddDept.txtstage.focus();
	 return false;
	}
	}
	function f3(val)
{
	if(document.frmaddDept.txtlogin.value=="")
	{
	alert("Please enter Login ");
	 document.frmaddDept.txtpass.value="";
	 document.frmaddDept.txtlogin.focus();
	 return false;
	}
	}
	function f4(val)
{
	if(document.frmaddDept.txtpass.value=="")
	{
	alert("Please enter password ");
	 document.frmaddDept.confirmpass.value="";
	 document.frmaddDept.txtpass.focus();
	 return false;
	}
	}
	
function onloadfocus()
	{
	document.frmaddDept.txtname.focus();
	}
 
function onloadfocus()
	{
	document.frmaddDept.txtname.focus();
	}
 
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }


function mySubmit()
{  var n=document.frmaddDept.txtemail.value.charAt(0);
 
	if(document.frmaddDept.txtname.value=="")
	{
	alert("Mention name ");
	document.frmaddDept.txtname.focus();
	return false;
	}
	
	if(document.frmaddDept.txtname.value.charCodeAt() == 32)
	{
	alert(" Name cannot start with space.");
	document.frmaddDept.txtname.focus();
	return false;
	}
	
		
	if(document.frmaddDept.txtstage.value=="")
	{
	alert("Select Stage");
	document.frmaddDept.txtstage.focus();
	return false;
	}
	if(document.frmaddDept.txtstage.value.charCodeAt() == 32)
	{
	alert("stage  cannot start with space.");
	document.frmaddDept.txtstage.focus();
	return false;
	}
	
	if(document.frmaddDept.txtlogin.value=="")
	{
	alert("Please enter Login ");
	document.frmaddDept.txtlogin.focus();
	return false;
	}
	if(document.frmaddDept.txtlogin.value.charCodeAt() == 32)
	{
	alert("Login cannot start with space.");
	document.frmaddDept.txtlogin.focus();
	return false;
	}
	if(document.frmaddDept.txtlogin.value!="")
	{
	if(document.frmaddDept.txtlogin.value.length < 6)
		{
			alert("Login can not less than 6 digits");
			document.frmaddDept.txtlogin.focus();
			return(false);
		}
	}
	
	if(document.frmaddDept.txtpass.value=="")
	{
	alert("Please enter password ");
	document.frmaddDept.txtpass.focus();
	return false;
	}
	if(document.frmaddDept.txtpass.value!="")
	{
	if(document.frmaddDept.txtpass.value.length < 6)
		{
			alert("Password can not less than 6 digits");
			document.frmaddDept.txtpass.focus();
			return(false);
		}
		}
	if(document.frmaddDept.txtpass.value.charCodeAt() == 32)
	{
	alert("password cannot start with space.");
	document.frmaddDept.txtpass.value.focus();
	return false;
	}
	
if(document.frmaddDept.confirmpass.value!=document.frmaddDept.txtpass.value)
	{
	alert("Do not match with the password, Re-enter");
	document.frmaddDept.confirmpass.focus();
	return false;
	}
	
	if(document.frmaddDept.confirmpass.value.charCodeAt() == 32)
	{
	alert(" Confirm password cannot start with space.");
	document.frmaddDept.confirmpass.value.focus();
	return false;
	}
	
	if(document.frmaddDept.txtemail.value=="")
	{
	alert("Please Enter VNR Email ID");
	document.frmaddDept.txtemail.focus();
	return(false);
	}
	
	if(document.frmaddDept.txtemail.value!="")
	{
		
		if (n=="@")
		{
		alert("Please Enter Email ID");
		document.frmaddDept.txtemail.focus();
		return false;
		}		
	if (echeck(document.frmaddDept.txtemail.value)==false){
		//document.frmaddDepartment.txtemail.value="";
		document.frmaddDept.txtemail.focus();
		return false;
		}
		if(!chkemail(document.frmaddDept.txtemail.value))
		{
		alert("Please Enter only VNRseeds Email ID");
		document.frmaddDept.txtemail.focus();
		return(false);
		}
}

return true;
}
</SCRIPT>


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
	      <td width="813" height="25" class="Mainheading">&nbsp;e-Indent Roles - Edit </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
	  <?php 
    $sql=mysql_query("select * from tbl_roles where id='$id'")or die(mysql_error()); 
	$total=mysql_num_rows($sql);
	
	$row=mysql_fetch_array($sql);
	
?>
   	  <td align="center" colspan="4" >
	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="id" type="hidden" value="<?php echo $id; ?>">
	  <input type="hidden" name="code" value="<?php echo $code;?>" />
      <input type="hidden" name="scode" value="<?php echo "EI".$row['code'];?>">
	 		  <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Edit e-Indent Role </td>
</tr>
<?php
 $sql1=mysql_query("select * from tbl_roles where id='$id'")or die(mysql_error());
  	$row=mysql_fetch_array($sql1);
	
?>
<tr class="Light" height="25">
<td width="318"  align="right"  valign="middle" class="tblheading">&nbsp;Name</td>
<td align="left"  valign="middle" colspan="3"  class="tbltext">&nbsp;<input name="txtname" type="text" size="25" class="tbltext" tabindex="0" maxlength="25"   value="<?php echo $row['name'];?>" onBlur="javascript:this.value=ucwords_w(this.value.toLowerCase());" />&nbsp;<font color="#FF0000">*</font>
              </td></tr>
 <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Stage&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select name="txtstage" class="tbltext"  style="width:170px;" tabindex="" value="text" onChange="f1(this.value);">
         <option value="<?php echo $row['stage'];?>" selected><?php echo $row['stage'];?></option>
         <option value="RSW">RSW</option>
		 <option value="Processing">Processing</option>
		 <option value="CSW">CSW</option>
         <option value="Packing">Packing</option>
		 <option value="PSW">PSW</option>
		 <option value="Dispatch">Dispatch</option>
		 <option value="Sales Return">Sales Return</option>
         <option value="Quality">Quality</option>
		 </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="318"  align="right"  valign="middle" class="tblheading">e-Indent Login  Code</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtcode" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo "EI".$row['code'];?>" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;Max. 25 logins roles allowed</td> </tr>
<tr class="Light" height="25">
<td width="318"  align="right"  valign="middle" class="tblheading">e-Indent Login</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlogin" type="text" size="10" class="tbltext" tabindex="0" maxlength="10"   value="<?php echo $row['login'];?>" onChange="f2(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Min 6 Max 10</td> </tr>
              
        
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">Password&nbsp;&nbsp;</td>

<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtpass" type="password" size="10" class="tbltext" tabindex="0" maxlength="25"   value="<?php echo $row['pass'];?>" onChange="f3(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Min 6 Max 10
              </td></tr>
			  <tr class="Light" height="25">
<td width="318"  align="right"  valign="middle" class="tblheading"> Confirm &nbsp;Password</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="confirmpass" type="password" size="10" class="tbltext" tabindex="0" maxlength="10"  value="<?php echo $row['pass'];?>"  onChange="f4(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Min 6 Max 10 </td>
        </tr>
		<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Status&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Active" <?php if($row['status'] == "Active") echo "checked"; ?> onClick="clk(this.value);"  />Active&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="Suspend"<?php if($row['status'] =="Suspend") echo "checked"; ?> onClick="clk(this.value);" />Suspend&nbsp;</td>
</tr>
		<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">VNR&nbsp;e-mail&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="3" name="txtemail" type="text" size="35" class="tbltext" value="<?php echo $row['email'];?>" maxlength="35"/>&nbsp;</td>
</tr>
</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="role_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
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
