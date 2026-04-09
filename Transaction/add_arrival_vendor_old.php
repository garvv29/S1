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
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$code=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		$classification=trim($_POST['txtcla']);
		$porn=trim($_POST['txtporn']);
		$dcno=trim($_POST['txtdcno']);
		$txt=trim($_POST['txt1']);
		//$txt12=trim($_POST['txt12']);
		$tname=trim($_POST['txttname']);
		$lorryno=trim($_POST['txtlrn']);
		$vno=trim($_POST['txtvn']);
		$pmode=trim($_POST['txt12']);
		$cname=trim($_POST['txtcname']);
		$dc=trim($_POST['txtdc']);
			
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
			
		
		/*$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
		$num=mysql_num_rows($sql22);
		
		$sql2=mysql_query("select * from tblemp where emp_mobile='".$mobile."'") or die(mysql_error());
		$num2=mysql_num_rows($sql2);
		
		$sql_mail=mysql_query("select * from tblemp where emp_email='".$email."'") or die(mysql_error());
		$num_mail=mysql_num_rows($sql_mail);
		
		if($altemail !="")
		{
		$sql_altmail=mysql_query("select * from tblemp where emp_altemail='".$altemail."'") or die(mysql_error());
		$num_altmail=mysql_num_rows($sql_altmail);
		}
		else
		{
		$num_altmail=0;
		}
		
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee ID.\nEmployee with this Employee ID already Present.");
			  </script>
			 <?php
		}
		else if($num2 > 0)
		{	?>
			 <script>
			  alert("Duplicate Mobile Number.\nEmployee with this Mobile Number already Present.");
			  </script>
			 <?php
		}
		else if($num_mail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee VNR Email-ID.\nEmployee with this Employee VNR Email-ID already Present.");
			  </script>
			 <?php
		}
		else if($num_altmail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee Alternate Email-ID.\nEmployee with this Employee Alternate Email-ID already Present.");
			  </script>
			 <?php
		}
		else
		{*/
			 $sql_in="insert into tbl_transction(code, date, p_id ,dcno,porn, modeoftransit, tname, lrno, vehicleno,cname, docketno,pmode) values ($code,'$tdate','$classification', '$dcno','$porn','$txt', '$tname', '$lorryno', '$vno','$cname', '$dc','$pmode')";
						//exit;				
			if(mysql_query($sql_in)or die(mysql_error()))
			{ 
				//$id=mysql_insert_id();
				echo "<script>window.location='add_arrival From vendor.php'</script>";	
			}
		
		//}
	}

//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(code) FROM tbl_transction ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="AV".$code;
		}
		else
		{
			$code=1;
			$code1="AV".$code;
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transction Master - Add Employee</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script src="vaddresschk.js"></script>
<script language="JavaScript">
   <!--
function mmLoadMenus() {if (window.mm_menu_0804145533_0) return;
  window.mm_menu_0804145533_0 = new Menu("root",167,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804145533_0.addMenuItem("Classification&nbsp;Master","location='../Masters/home_classification.php'");
  mm_menu_0804145533_0.addMenuItem("Stores&nbsp;Item&nbsp;Master","location='../Masters/stores_home.php'");
  mm_menu_0804145533_0.addMenuItem("Party&nbsp;Master","location='../Masters/party_Masterhome.php'");
  mm_menu_0804145533_0.addMenuItem("SLOC&nbsp;Master","location='../Masters/selectbin.php'");
  mm_menu_0804145533_0.addMenuItem("Parameters&nbsp;Master","location='../Masters/companyhome.php'");
  mm_menu_0804145533_0.addMenuItem("Year&nbsp;Management&nbsp;Master","location='../Masters/current_year.php'");
  mm_menu_0804145533_0.addMenuItem("e-Indent&nbsp;Master","location='../Masters/role_home.php'");
   mm_menu_0804145533_0.addMenuItem("Operator&nbsp;Master","location='../Masters/operator_home.php'");
     //mm_menu_0804145533_0.fontWeight="bold";
   mm_menu_0804145533_0.hideOnMouseOut=true;
   mm_menu_0804145533_0.bgColor='#000000';
   mm_menu_0804145533_0.menuBorder=1;
   mm_menu_0804145533_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804145533_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0804150040_0 = new Menu("root",164,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
   mm_menu_0804150040_0.addMenuItem("Arrival","location='arrival_home.php'");
   mm_menu_0804150040_0.addMenuItem("Issue","location='issue_home.php'");
   mm_menu_0804150040_0.addMenuItem("Captive&nbsp;Consumption","location='c_c_home.php'");
   mm_menu_0804150040_0.addMenuItem("Order&nbsp;Updation","location='reorder.php'");
   mm_menu_0804150040_0.addMenuItem("Sloc&nbsp;Updation","location='add_arrival.php'");
   mm_menu_0804150040_0.addMenuItem("G&nbsp;TO&nbsp;D","location='add_g.php'");
   mm_menu_0804150040_0.addMenuItem("D&nbsp;TO&nbsp;G","location='add_d.php'");
   mm_menu_0804150040_0.addMenuItem("Discard","location='add_discard.php'");
   mm_menu_0804150040_0.addMenuItem("Excess/Shortage","location='add_shortage.php'");
   mm_menu_0804150040_0.addMenuItem("Cycle&nbsp;Inventory","location='home_ci1.php'");
   mm_menu_0804150040_0.hideOnMouseOut=true;
   mm_menu_0804150040_0.bgColor='#000000';
   mm_menu_0804150040_0.menuBorder=1;
   mm_menu_0804150040_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804150040_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0804152609_0 = new Menu("root",231,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804152609_0.addMenuItem("Stock&nbsp;on&nbsp;Hand","location='../reports/stockonhandreport.php'");
  mm_menu_0804152609_0.addMenuItem("Party&nbsp;wise&nbsp;Stock&nbsp;Report","location='../reports/partywiseperiodreport.php'");
  mm_menu_0804152609_0.addMenuItem("Item&nbsp;Ledger","location='../reports/storesitamledger.php'");
  mm_menu_0804152609_0.addMenuItem("Discard&nbsp;Between&nbsp;Dates","location='../reports/discardreport.php'");
  mm_menu_0804152609_0.addMenuItem("Stock&nbsp;Transfer&nbsp;Report","location='../reports/stocktransferreport.php'");
  mm_menu_0804152609_0.addMenuItem("Captive&nbsp;Consumption&nbsp;Report","location='../reports/captiveconsumptionreport.php'");
  mm_menu_0804152609_0.addMenuItem("Reorder&nbsp;Level&nbsp;Report","location='../reports/reorderlevelreport.php'");
  // mm_menu_0804152609_0.fontWeight="bold";
   mm_menu_0804152609_0.hideOnMouseOut=true;
   mm_menu_0804152609_0.bgColor='#000000';
   mm_menu_0804152609_0.menuBorder=1;
   mm_menu_0804152609_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804152609_0.menuBorderBgColor='#FF6600';
   
window.mm_menu_0226134618_0 = new Menu("root",124,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
 mm_menu_0226134618_0.addMenuItem("Sloc&nbsp;Search","location='../utility/selectvendor.php'");
      mm_menu_0226134618_0.fontWeight="bold";
   mm_menu_0226134618_0.hideOnMouseOut=true;
   mm_menu_0226134618_0.bgColor='#000000';
   mm_menu_0226134618_0.menuBorder=1;
   mm_menu_0226134618_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226134618_0.menuBorderBgColor='#FF6600';
   mm_menu_0804152609_0.writeMenus();
} // mmLoadMenus()
//-->
</script>

<script language="JavaScript" src="../include/mm_menu.js"></script>
<script type="text/javascript" language="javascript" src="../include/validation.js"></script>
<script language="javascript" type="text/javascript">
function clk(opt)
{
	if(opt!="")
	{
		if(opt=="Yes")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
		}
		else
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			document.frmaddDepartment.txt11.value=opt;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
		document.frmaddDepartment.txt11.value="";
	}
}
</script>
<script language="javascript" type="text/javascript">
var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.date,dt,document.frmaddDepartment.date, "dd-mmm-yyyy", xind, yind);
	}  


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
function onloadfocus()
	{
	document.frmaddDepartment.txtdcno.focus();
	}
	

function clk1(val)
{
//alert(val);
document.frmaddDepartment.txt14.value=val;
}

function mySubmit()
{ 
	
if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Select Vendor");
	document.frmaddDepartment.txtcla.focus();
	return false;
	}
	
			
	if(document.frmaddDepartment.txtdcno.value=="")
	{
	alert("Please enter D.C. NO.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdcno.value.charCodeAt() == 32)
	{
	alert("D.C. NO. cannot start with space.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtporn.value=="")
	{
	alert("Please enter Reference No.");
	document.frmaddDepartment.txtporn.focus();
	return false;
	}
	if(document.frmaddDepartment.txtporn.value.charCodeAt() == 32)
	{
	alert("Reference No cannot start with space.");
	document.frmaddDepartment.txtporn.focus();
	return false;
	}
	/*if(document.frmaddDepartment.txtporn.value=="")
	{
	alert("Please Select Mode Of Transit");
	document.frmaddDepartment.txt1.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txt1.value.charCodeAt() == 32)
	{
	alert("Mode Of Transit cannot start with space.");
	document.frmaddDepartment.txt1.focus();
	return false;
	}*/
	if(document.frmaddDepartment.txt11.value!="")
	{
	if(document.frmaddDepartment.txt11.value=="Yes")
	{
	if(document.frmaddDepartment.txttname.value=="")
	{
	alert("Please enter Transport Name");
	document.frmaddDepartment.txttname.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
	{
	alert("Transport Name cannot start with space.");
	document.frmaddDepartment.txttname.focus();
	return false;
	}
				
	if(document.frmaddDepartment.txtlrn.value=="")
	{
	alert("Please enter Lorry Receipt No");
	document.frmaddDepartment.txtlrn.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
	{
	alert("Lorry Receipt No cannot start with space.");
	document.frmaddDepartment.txtlrn.focus();
	return false;
	}
	if(document.frmaddDepartment.txtvn.value=="")
	{
	alert("Please enter Vehicle No");
	document.frmaddDepartment.txtvn.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
	{
	alert("Vehicle No cannot start with space.");
	document.frmaddDepartment.txtvn.focus();
	return false;
	}
	if(document.frmaddDepartment.txt14.value=="")
	{
	alert("Please select Payment Mode");
	return false;
	}
	}
	else
	{
	if(document.frmaddDepartment.txtcname.value=="")
	{
	alert("Please enter Courier Name");
	document.frmaddDepartment.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
	{
	alert("Courier Name cannot start with space.");
	document.frmaddDepartment.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdc.value=="")
	{
	alert("Please enter Docket No.");
	document.frmaddDepartment.txtdc.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
	{
	alert("Docket No. cannot start with space.");
	document.frmaddDepartment.txtdc.focus();
	return false;
	}
	}
	}
	else
	{
	alert("Please select Mode of Transit");
	return false;
	}
	
	return true;	 
}

</script>
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1004">
	
	<?php require_once("../include/header_admin.php");?>
	</td>
  </tr>
  <tr>
  <td>
  <table width="1004" height="15" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" height="15"><img src="../images/topleftcorner.gif" width="15" /></td>
  <td width="974" height="15" background="../images/topbg.gif" style="background-repeat:repeat"></td>
  <td width="15" height="15"><img src="../images/toprightcorner1.gif" width="15" style="padding-bottom:0px" /></td>
  </tr>
  </table>
  <table width="1004" height="390" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" background="../images/columnbg.gif" style="background-repeat:repeat; padding-top:0px"></td>
  <td width="974" valign="top">
 
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Arrival from Vendor </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Arrival From Vendor </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="171" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="254"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="8" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $code1?>"/></td>

<td width="76" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="239" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where classification='Vendor'"); 
?>

<td align="right"  valign="middle" class="tblheading">Vendor&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcla" style="width:150px;" onchange="showUser(this.value);">
<option value="" selected>--Select Vendor--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">D.C. No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

           </tr>

 <?php
$quer4=mysql_query("SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Vendor&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="193"  align="right"  valign="middle" class="tblheading">P. O. Reference Number&nbsp;</td>
<td align="left"  valign="middle" colspan="6">&nbsp;<input name="txtporn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>

 <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Transport&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />&nbsp;Courier&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Light" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
<td align="right" width="76" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />  </td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt13" type="radio" class="tbltext" value="Yes"   onClick="clk1(this.value);" />&nbsp;TBB&nbsp;&nbsp;&nbsp;<input name="txt13" type="radio" class="tbltext" value="No"  onClick="clk1(this.value);"  />&nbsp;To Pay<input name="txt13" type="radio" class="tbltext" value="No"  onClick="clk1(this.value);" />
   &nbsp;Paid</td>
</tr>
</table>
<table id="courier" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="76" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="arrival_home.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();"></td>
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
</td>
  <td width="15" background="../images/columnbgright1.gif" style="background-repeat:repeat; padding-top:0px"></td>
  </tr>
  </table>
  <table width="1004" height="15" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" height="15"><img src="../images/bottomleft.gif" width="15" /></td>
  <td width="974" height="15" background="../images/bottombg.gif" style="background-repeat:repeat"></td>
  <td width="15" height="15"><img src="../images/bottomright.gif" width="15" style="padding-bottom:0px" /></td>
  </tr>
  </table>
  
  <?php require_once("../include/footer.php");?>
  </td>
  </tr>
</table>

</body>
</html>
