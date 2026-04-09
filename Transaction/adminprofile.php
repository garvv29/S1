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
//$role="admin";

if(isset($_POST['frm_action'])=='submit')
	{
		//$name=trim($_POST['txtname']);
		$login=trim($_POST['txtId']);
		$pass=trim($_POST['txtpass']);
		$email=trim($_POST['txtemail']);
		$question=trim($_POST['txtquestion']);
		$ans=trim($_POST['txtans']);
/*
		$sql_in="update tblverifier set 	vname='$name',
											vlogin='$login',
											vpassword='$pass',
											vemail='$email',
											vsecurityq='$question',
											vsecuritya='$ans'
											where vid=$vid";
											*/
		//if(mysql_query($sql_in)or die(mysql_error()))
		 
		  $sql_in1="Update tbl_user set	loginid='$login',
										password='$pass',
										email='$email'
										where role='admin'";	
				               mysql_query($sql_in1)or die(mysql_error());		
			
		}
	//exit;	//}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transction-Admin Profile</title>
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
/*function onloadfocus()
	{
	document.frmaddDepartment.txtempfname.focus();
	}*/
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
function onloadfocus()
	{
	document.frmaddDepartment.txtname.focus();
	}
function mySubmit()
{ 
	/*if(document.frmaddDepartment.txtname.value=="")
	{
	alert("Please enter Admin  Name");
	document.frmaddDepartment.txtname.focus();
	return false;
	}
	if(document.frmaddDepartment.txtname.value.charCodeAt() == 32)
	{
	alert("Admin  Name cannot start with space.");
	document.frmaddDepartment.txtname.focus();
	return false;
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
	alert("Please Retype Password");
	document.frmaddDepartment.txtrepass.focus();
	return false;
	}
	if(document.frmaddDepartment.txtrepass.value != document.frmaddDepartment.txtpass.value)
	{
	alert("Retype Password not matched with Password. Please Enter again");
	document.frmaddDepartment.txtrepass.focus();
	return false;
	}
	if(document.frmaddDepartment.txtemail.value =="")
	{
	alert("Please Enter VNR Email ID");
	document.frmaddDepartment.txtemail.focus();
	return(false);
	}
	if(document.frmaddDepartment.txtemail.value !=""){
		if (echeck(document.frmaddDepartment.txtemail.value)==false){
		document.frmaddDepartment.txtemail.value="";
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
	if(document.frmaddDepartment.txtquestion.value=="")
	{
	alert("Please enter Security Question");
	document.frmaddDepartment.txtquestion.focus();
	return false;
	}
	if(document.frmaddDepartment.txtquestion.value.charCodeAt() == 32)
	{
	alert("Security Question cannot start with space.");
	document.frmaddDepartment.txtquestion.focus();
	return false;
	}
	if(document.frmaddDepartment.txtans.value=="")
	{
	alert("Please enter Security Answer");
	document.frmaddDepartment.txtans.focus();
	return false;
	}frmaddDepartment
	if(document.frmaddDepartment.txtans.value.charCodeAt() == 32)
	{
	alert("Security Answer cannot start with space.");
	document.frmaddDepartment.txtans.focus();
	return false;
	}
	return true;	 
}
</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
            <ul  id="nav">
			 <?php
			  if($role == "admin")
			  {
			  ?>
             <li><a href="#"> Masters </a>
              <ul>
                <li><a href="../Masters/home_classification.php" >&nbsp;Classification&nbsp;Master</a></li>
                <li><a href="../Masters/stores_home.php" >&nbsp;Item&nbsp;Master</a></li>
                <li><a href="../Masters/party_Masterhome.php" >&nbsp;Party&nbsp;Master</a></li>
                <li><a href="../Masters/selectbin.php" >&nbsp;SLOC&nbsp;Master</a></li>
                <li><a href="../Masters/role_home.php" >&nbsp;e-indent&nbsp;Master</a></li>
                <li><a href="../Masters/operator_home.php" >&nbsp;Operator&nbsp;Master</a></li>
				<li><a href="../Masters/viewers_home.php" >&nbsp;Viewers&nbsp;Master</a></li>
				<li><a href="../Masters/home_report.php" >&nbsp;Reports&nbsp;Master</a></li>
                <li><a href="../Masters/companyhome.php" >&nbsp;Parameters&nbsp;Master</a></li>
                <li><a href="../Masters/current_year.php" >&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
              </ul>
            </li>
            <li><a href="#">Transactions </a>
             <ul>
                <li><a href="add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
              </ul>
            </li>
			<?php
			}
			else
			{
			?>
			<li><a href="#">Transactions </a>
              <ul>
                <li><a href="arrival_home.php" >&nbsp;Arrival</a></li>
                <li><a href="issue_home.php" >&nbsp;Issue</a></li>
                <li><a href="c_c_home.php" >&nbsp;Captive&nbsp;Consumption</a></li>
				<li><a href="add_discard.php" >&nbsp;Material&nbsp;Discard</a></li>
				<li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
                <li><a href="add_arrival.php" >&nbsp;SLOC&nbsp;Updation</a></li>
				<li><a href="reorder.php" >&nbsp;Order&nbsp;Placement&nbsp;at&nbsp;Reorder</a></li>
             </ul>
            </li>
			<?php
			}
			?>
            <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				 <?php
			  if($role == "admin")
			  {
			  ?>
				<li><a href="../reports/masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
				<?php
				}
				?>
              </ul>
            </li><li>
            <a href="#">Utility </a>
             <ul>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_bincard.php','WelCome','top=10,left=50,width=950,height=800,scrollbars=yes')" >&nbsp;Sub-Bin&nbsp;Card</a></li>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li> <?php if($role == "admin")
			  {
			  ?>
			  <li><a href=" Javascript:void(0)" onClick="window.open('../utility/backup.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Backup</a></li>
			  <?php }?>
           </ul>   </li>
            </ul>
            </div>
            </div>
            <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top"> <li><a href="adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>    <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Admin Profile </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
   
  <?php
	$sql = mysql_query("select * from tbl_user where role='$role'") or die(mysql_error()); 
	$total=mysql_num_rows($sql);
	    $row=mysql_fetch_array($sql);
	?>
	
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><br />

<table align="center" border="0" width="650" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC" style="border-collapse:collapse" > <tr><td>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle">Admin Master</td>
</tr>
<tr class="Light" height="25">
<td colspan="2" align="right" class="tblheading" valign="middle"><font color="#FF0000" >* </font>All fields are mandatory&nbsp;</td>
</tr>
<tr class="Dark"  height="25">
<td width="283"  align="right" valign="middle" class="tblheading">&nbsp; Name&nbsp;</td>
<td width="411" align="left" valign="middle" class="tbltext">&nbsp;Administrator&nbsp;<font color="#FF0000" >* </font></td>
</tr>	
<tr class="Light"  height="25">
<td  align="right" valign="middle" class="tblheading">&nbsp;Login Id&nbsp;</td>
<td width="411" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtId" type="text" class="tbltext" tabindex="0" value="<?php echo $row['loginid'];?>" size="25" maxlength="14"/>&nbsp;<font color="#FF0000" >* </font></td>
</tr>		
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpass" type="password" class="tbltext" tabindex="" value="<?php echo $row['password'];?>" size="25" maxlength="15"/>&nbsp;<font color="#FF0000" >* </font></td>
</tr>
<tr class="Light" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;Retype Password&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtrepass" type="password" class="tbltext" tabindex="" value="<?php echo $row['password'];?>" size="25" maxlength="15"/>&nbsp;<font color="#FF0000" >* </font></td>
</tr>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading">&nbsp;&nbsp;&nbsp;E-mail&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="" name="txtemail" type="text" size="35" class="tbltext" value="<?php echo $row['email'];?>" maxlength="35"/>&nbsp;<font color="#FF0000" >* </font></td>
</tr>		
<!--/*<tr class="Light" height="25">
<td width="46%"  align="right" valign="middle" class="tblheading">&nbsp;Security Question&nbsp;</td>
<td width="54%"  align="left" valign="middle">&nbsp;<select  tabindex="" class="tbltext"  name="txtquestion" style="width:280px;">
    <option <?php if($row['question'] == "What is the name of your first school?"){ echo "Selected";}?> value="What is the name of your first school?">What is the name of your first school?</option>
    <option <?php if($row['question'] == "What is your nick name?"){ echo "Selected";}?> value="What is your nick name?">What is your nick name?</option>
    <option <?php if($row['question'] == "Who is your favourite movie star?"){ echo "Selected";}?> value="Who is your favourite movie star?">Who is your favourite movie star?</option>
    <option <?php if($row['question'] == "What is your mother's maiden name?"){ echo "Selected";}?> value="What is your mother's maiden name?">What is your mother's maiden name?</option>
    <option <?php if($row['question'] == "Which is your favourite vegetable?"){ echo "Selected";}?> value="Which is your favourite vegetable?">Which is your favourite vegetable?</option>
  </select>  &nbsp;</td>
</tr>
<tr class="Dark" height="25" >
<td align="right" valign="middle" class="tblheading">&nbsp;Type Security Answer&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input tabindex="" name="txtans" type="text" size="25" class="tbltext" value="<?php echo $row['answer'];?>"/>&nbsp;Non-Case Sensitive&nbsp;</td>
</tr>*/-->
</table></td></tr>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="varifiermaster_home.php"></a>&nbsp;&nbsp;
  <input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	<!--<table cellpadding="5" cellspacing="5" align="center">
<tr><td class="smalltext1"><br /><br /><br /><br /><br /><br />Sorry ,Currently No Record is Present.<br /><br /><br /><br /></td></tr>
</table>  -->
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
