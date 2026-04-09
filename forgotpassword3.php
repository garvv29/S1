<?php 
//$year=$_REQUEST['year'];
if(!isset($_SESSION['year']))
{$year=$_REQUEST['year'];
$_SESSION['year']=$year;
require_once("include/config.php");
require_once("include/connection.php");
}
    $loginid=trim($_REQUEST['loginid']);
	$result=mysql_query("select * from tbl_user where loginid='".$loginid."'") or die(mysql_error()); 
	$row=mysql_fetch_array($result);
/*	if( $loginid != "admin"){
		echo "<script language=JavaScript type='text/JavaScript'>";
		echo "window.location='forgotpassword4.php?username=$loginid'";
		echo "</script>";
		}
*/
if(isset($_POST['posted']))
{

    $answer=strtolower(trim($_POST['answer']));
	$txtques = strtolower(trim($_POST['txtques']));
	
	
	$sql="select * from tbl_user where loginid='".$loginid."' and answer='".$answer."' and question='".$txtques."' ";
	$res=mysql_query($sql) or die(mysql_error()); 
	$numofrows=mysql_num_rows($res);
		if( $numofrows > 0){
		echo "<script language=JavaScript type='text/JavaScript'>";
		echo "window.location='forgotpassword4.php?username=$loginid&answer=$answer&txtques=$txtques&year=$year'";
		echo "</script>";
		}
		else
		{
		/*echo "<script language=JavaScript type='text/JavaScript'>";
		echo "window.location='contact.php'";
		echo "</script>";*/
		}
    }
?>
<html>
<head>
<title>Stores -  Forgot Password</title>
<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css">
<script language="javascript">
function onloadfocus() 
{
document.form1.answer.focus();
}

function mySubmit()
{
	if(document.form1.answer.value.charCodeAt() == 32)
	{
	alert("Login id  Should not start with space ...");
	document.form1.answer.focus();
	return(false);
	}
	if(document.form1.answer.value =="")
	{
	alert(" Please Enter Answer");
	document.form1.answer.focus();
	return(false);
	}
	return true;
}
/*function myReset()
{
	document.form1.answer.focus();
}*/
</script>
</head>
<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0" onLoad="return onloadfocus();" style="background-color:#FFFFFF">
_<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
<tr><td colspan="2" valign="middle" align="center"><img src="images/logotrac.gif"></td></tr>
<tr>
<td width="85%" valign="top">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" >
<tr><td align="center">
<form method="post" name="form1" onSubmit="return mySubmit()"> 
<table width="600" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25"><td valign="middle" colspan="3" align="center" class="subheading">Forgot Password  Form</td>
</tr>
<tr class="Light" height="25" >
<td colspan="4" align="right" valign="middle" class="tblheading"><font color="#FF0000">* </font>indicates required field&nbsp;</td>
</tr>
<tr class="Dark" height="25" >
<td width="46%" align="right" valign="middle" class="tblheading">&nbsp;Login id&nbsp;</td>
<td width="54%" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row["loginid"];?></td>
</tr>
<tr class="Light" height="25" >
<td width="46%"  align="right" valign="middle" class="tblheading">&nbsp;Security Question&nbsp;</td>
<td width="54%"  align="left" valign="middle">&nbsp;<select  tabindex="7" class="tbltext"  name="txtques" style="width:280px;">
		<option value="***">--Select Question</option>
		<option value="What is the name of your first school?">What is the name of your first school?</option>
		<option value="What is your nick name?">What is your nick name?</option>		
		<option value="Who is your favourite movie star?">Who is your favourite movie star?</option>				
		<option value="What is your mother's maiden name?">What is your mother's maiden name?</option>						
		<option value="Which is your favourite vegetable?">Which is your favourite vegetable?</option>								
	    </select>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td width="46%"  align="right" class="tblheading" valign="middle">&nbsp;<font color="#FF0000">*</font>&nbsp;Type Answer&nbsp;</td>
<td width="54%"  align="left" valign="middle" class="tbltext">&nbsp;<input name="answer" type="text" size="50" class="tbltext" maxlength="50"> 
&nbsp;Non-Case Sensitive&nbsp;</td>
</tr>
</table>
<table width="" border="0" align="center" cellpadding="5" cellspacing="5">
<tr><td><img src="images/back.gif" border="0" onClick="javascript:location.href('forgotpassword.php')" style="display:inline;cursor:hand;"></td><td height="25" ><input type="hidden" name="loginid" value="<?php echo $loginid;?>"><input type="hidden" name="posted" value="posted"><input type="image" src="images/submit_1.gif" border=0 alt="Submit Value" style="display:inline;cursor:hand;"></td><!--<td><a tabindex="4" href="javascript:document.form1.reset()" onClick="myReset()"><img src="images/reset.gif"  border=0 style="display:inline;cursor:hand;"></a></td>-->
</tr>
</table>
</form>
</table>
</td> </tr>
</table>
</body>
</html>

