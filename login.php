<?php 
	session_start();
	session_destroy();
?>
<script language="javascript" src="include/validation.js"></script>
<script language="JavaScript">
	function onloadfocus()
	{
	document.frmlogin.txtuser.focus();
	}
	
	function myReset() { document.frmlogin.txtuser.focus(); }
	function mySubmit()
	{
		if (document.frmlogin.txtuser.value == "")
		{
		alert("Please Enter Login id");
		document.frmlogin.txtuser.focus();
		return false;
		}
		
		if (document.frmlogin.txtuser.value != "")
		{
			var str=document.frmlogin.txtuser.value;
			
				for(var k=0;k<str.length;k++)
				{
					
					if(document.frmlogin.txtuser.value.charCodeAt(k) == 32)
					{
					 alert("Space Is Not Allow");
 					 document.frmlogin.txtuser.value="";
					 document.frmlogin.txtuser.focus();
						return(false);
					}		
				}	
				for(var k=0;k<str.length;k++)
				{
				
					for(var i=64 ;i<91;i++)
					{
						if(document.frmlogin.txtuser.value.charCodeAt(k) == i)
						{
						 alert("Capital letters are not Allow");
						 document.frmlogin.txtuser.value="";
						 document.frmlogin.txtuser.focus();
							return(false);
						}
					}		
				}


		}
	
		if (document.frmlogin.txtpassword.value == "")
		{
		alert("Please Enter Password");
		document.frmlogin.txtpassword.focus();
		return false;
		}
		
		if (document.frmlogin.txtpassword.value != "")
		{
			var str=document.frmlogin.txtpassword.value;
			
				for(var k=0;k<str.length;k++)
				{
					
					if(document.frmlogin.txtpassword.value.charCodeAt(k) == 32)
					{
					 alert("Space Is Not Allow");
					 document.frmlogin.txtpassword.value="";
					 document.frmlogin.txtpassword.focus();
						return(false);
					}		
				}	
				

		}
		return true;
	}
</script>
<html>
<head>
<title>Stores-Login</title>
<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css">
</head>
<body bottommargin="0" rightmargin="0" leftmargin="0"  onLoad="return onloadfocus()" style="background-color:#FFFFFF">
<form action="validatelogin.php" method="post" name="frmlogin" onSubmit="javascript:return mySubmit();"><br><br><br><br>
<table cellpadding="0" cellspacing="0" align="center" border="0" >
<tr><td colspan="2"><div align="center"><img src="images/logotrac.gif" alt="Logo" border="0"></div></td></tr>
</table>
</br>
<table width="350" border="1" align="center" cellpadding="5" cellspacing="1" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark"><td colspan="2" align="center" valign="middle" class="tblheading" height="40">Enter Login id and Password</td></tr>
<tr class="Light" height="25">
<TD align="right" width="39%" class="tblheading">Login id </TD>
<TD width="61%" align="left" class="tbltext"><INPUT  maxLength="15" name="txtuser" size="15" class="tbltext" tabindex="1" onKeyPress="capsDetect(arguments[0]);"></TD> 
</tr> 
<tr class="Dark" height="25">
<TD align="right" width="39%" class="tblheading">Password </TD>
<TD width="61%" align="left" class="tbltext"><INPUT  maxLength="15" name="txtpassword" size="15" type="password" class="tbltext" tabindex="2" onKeyPress="capsDetect(arguments[0]);"></td>
</tr>

<tr height="25" class="Dark">
<TD class="tbltext" align="center"  colspan="2"><a href="forgotpassword.php" tabindex="5" class="link">Forgot Your Password?</a></TD>
</tr>
</table>
<table align="center" cellpadding="0" cellspacing="5" border="0">
<tr  height="25">
<TD align="center" height="50"><input tabindex="3" type="image" name="submit" src="images/login.gif" alt="Login Value" border=0 style="display:inline;cursor:hand;">
</TD>
<TD align="center" height="50">
<a tabindex="4" href="javascript:document.frmlogin.reset()" onClick="myReset()"><img src="images/reset.gif" alt="Reset Value"  border=0 style="display:inline;cursor:hand;"></a>
</TD>
</tr>
</table>

<table align="center" cellpadding="0" cellspacing="5" border="0">
<tr  height="25">
<TD align="center"><?php if((date("Y-m-d")>="2023-01-01") && (date("Y-m-d")<="2023-01-10")){?><img src="images/vnr-happy-new-year.jpg" border="0" width="23%" ><?php }else {?>&nbsp;<?php }?>
</TD>
</tr>
</table>
</form>
</body>
</html>
