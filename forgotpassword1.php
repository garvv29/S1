<?php 
//require_once("include/config.php");
//require_once("include/connection.php");
//$radio_button_usertype=trim($_REQUEST['radio_button_usertype']);
//if ($radio_button_usertype =='admin'){ $label='admin'; }
//else { $label='';  }
if(isset($_POST['posted']))
{
	if( isset($_POST['username']))
	{
	
		

		//$radio_button_usertype=trim($_REQUEST['radio_button_usertype']);
		$loginid=strtolower(trim($_POST['username']));
		$year=$_POST['year'];
		
		require_once("include/config.php");
		require_once("include/connection.php");
		
		//if( 'admin' == $radio_button_usertype ) 
			$sql=mysql_query("select * from tbl_user where loginid='".$loginid."'");
		//else 	
		//   $sql=mysql_query("select * from tbluser where loginid='".$loginid."' and role!='admin'");
		   
			$row=mysql_fetch_array($sql);
			$numofrows=mysql_num_rows($sql);
			if( $numofrows >0 )
			{
				echo "<script language=JavaScript type='text/JavaScript'>";
				echo "window.location='forgotpassword3.php?loginid=$loginid&year=$year'";
				echo "</script>";
			}
     }
}
?>
<html>
<head>
<title>Stores  Forgot Password</title>
<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="includes/validation.js"></script>
<script language="javascript">
function onloadfocus() 
{
document.form1.username.focus();
}

function mySubmit()
{
	if (document.form1.username.value != "")
		{
		
			var str=document.form1.username.value;
			if(str.length < 4 )
			{
				//alert("Invalid login ID");
				document.form1.username.value();
				return(false);
			}

				for(var k=0;k<str.length;k++)
				{
					
					if(document.form1.username.value.charCodeAt(k) == 32)
					{
					 alert("White Space Is Not Allow");
 					 document.form1.username.value="";
					 document.form1.username.focus();
						return(false);
					}		
				}	
				for(var k=0;k<str.length;k++)
				{
				
					for(var i=64 ;i<91;i++)
					{
						if(document.form1.username.value.charCodeAt(k) == i)
						{
						 alert("Capiletter is not Allow");
						 document.form1.username.value="";
						 document.form1.username.focus();
							return(false);
						}
					}		
				}

		}

	if(document.form1.username.value=="")
	{
	alert("Please Enter Login id");
	document.form1.username.focus();
	return(false);
	}
}
/*function myReset()
{
	document.form1.username.focus();
}*/
</script>

</head>
<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0" onLoad="return onloadfocus();" style="background-color:#FFFFFF">
<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
<tr><td align="center" colspan="2" valign="middle"><img src="images/logotrac.gif"></td></tr>
<tr>
<td width="85%" valign="top">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center">
<form method="post" name="form1" onSubmit="return mySubmit()"> 
<table width="400" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td valign="middle" colspan="3" align="center" class="tblheading">Forgot Password  </td>
</tr>
<tr class="Light" height="25">
<td colspan="4" align="right" class="tbltext"><font color="#FF0000" >* </font>indicates required field</td>
</tr>
<tr class="Dark" height="25">
<td width="50%" align="right" valign="middle" class="tblheading">&nbsp;<font color="#FF0000">*</font>&nbsp;Login id&nbsp;</td>
<td width="50%" align="left" valign="middle">&nbsp;<input name="username" type="text" class="tbltext" size="25" maxlength="25" onKeyPress=" capsDetect(arguments[0]);"> 
</td>
</tr>
<?php
	$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");
	
 	$quer3=mysql_query("select * from tbl_years where years_flg > 0 and years_status='a'"); 
?>
<tr class="Light" height="25">
<td align="right" class="tblheading" valign="middle">Select Year</td><td align="left" class="tblheading" valign="middle">&nbsp;<select name="year" class="tbltext">
<?php while($noticia3 = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia3['years'];?>" />      
		<?php $y=split("_",$noticia3['years']);
		$y1=$y[0];
		$y2=$y[1];
		echo $y3=$y1."-".$y2;
		?>
		<?php } ?>
</select>&nbsp;April to March
</td>
</tr>
</table>
<table width="" border="0" align="center" cellpadding="5" cellspacing="5">
<tr><td><img src="images/back.gif" border="0" onClick="javascript:location.href('login.php')" style="display:inline;cursor:hand;"></td><td valign="middle"><input type="hidden" name="posted" value="posted">
<input type="image" src="images/submit_1.gif" border=0 alt="Submit Value" style="display:inline;cursor:hand;"></td><!--<td><a tabindex="4" href="javascript:document.form1.reset()" onClick="myReset()"><img src="images/reset.gif"  border=0 style="display:inline;cursor:hand;"></a></td>-->
</tr>
</table>
</form>
</table>
</td> </tr>

</table>
</body>
</html>

