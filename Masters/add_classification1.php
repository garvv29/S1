 <?php 
/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/

//require("include/config.php");
	//require("include/connection.php");
	
	$com=mysql_connect('localhost','root','');
	if(!$con)
	{
	die('could not connect: ' .mysql_error());
	}
	else
	{
	mysql_select_db("stores",$con);
	}
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
	$a=trim($_POST['txtcla']);
	//}
	$sql_in="insert into tbl_classification (classification) values ('$a')";
	$sdf=mysql_query($sql_in) or die(mysql_error());
	}
	
	/*$con = mysql_connect('localhost', 'root', '');
if (!$con)
  {
  
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("stores", $con);

 	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		$classification=trim($_POST['txtcla']);
		   $sql_in="insert into tbl_classification(classification) values(
											  '$classification')";*/
		/*$parentimage1=trim($_FILES['brouse']['name']);
		 if($parentimage1<>"")
		{
		$imagepath1="../help/".$parentimage1;
		copy($_FILES['brouse']['tmp_name'],$imagepath1);
		}												
									
	if(mysql_query($sql_in) or die(mysql_error()))
			{
				//exit;
			}*/
	//}
  ?>
  
  <form name="frmaddDepartment" method="post"   action="<?php echo $_SERVER['PHP_SELF']?>">

	 <input name="frm_action" value="submit" type="hidden"> 

  <table align="center" border="1" width="499" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1"style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading">Add a NEW Classification Form</td>
</tr>
<tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Light" height="25">
<td width="150" align="right" height="30" valign="middle" class="tblheading">Classification&nbsp;</td>
<td width="343" align="left"  valign="middle">&nbsp;<input name="txtcla" type="text" size="40" class="tbltext" tabindex="0" maxlength="40" onBlur="javascript:this.value=ucwords_w(this.value.toLowerCase());"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

</tr>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="stores_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>