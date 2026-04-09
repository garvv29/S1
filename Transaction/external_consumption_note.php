<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");
	/*
	if(isset($_REQUEST['t_id']))
	{
	$tid = $_REQUEST['t_id'];
	}*/
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$id=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		$code=$_POST['txtvname'];
		$porn=trim($_POST['txtporn']);
		$dcno=trim($_POST['txtdcno']);
		$txt=trim($_POST['txt1']);
		$tname=trim($_POST['txttname']);
		$lorryno=trim($_POST['txtlrn']);
		$vno=trim($_POST['txtvn']);
		$pmode=trim($_POST['tx1']);
		$cname=trim($_POST['txtcname']);
		$dc=trim($_POST['txtdc']);
		
		$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
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
		{
			 $sql_in="insert into tbl_transction(id, date, vname, porn, dcno, modeoftransit, tname, lrno, vehicleno, pmode, cname,  docketno) values ('$id', '$date', '$code', '$porn', '$dcno', '$txt', '$tname', '$lorryno', '$vno', '$pmode','$cname', '$dc')";*/
										
			//if(mysql_query($sql_in)or die(mysql_error()))
			//{ 
				//$id=mysql_insert_id();
				echo "<script>window.location='add_arrival From vendor.php'</script>";	
			}
		
		//}
	//}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transction Master - Add Employee</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
<script src="selectuser_empidchk.js"></script>
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
		}
		else
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
	}
}
</script>
<!--<script language="javascript" type="text/javascript">


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
	document.frmaddDepartment.txtid.focus();
	}
	
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function mySubmit()
{ 
	if(document.frmaddDepartment.txtid.value=="")
	{
	alert("Please enter ID ");
	document.frmaddDepartment.txtid.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtid.value.charCodeAt() == 32)
	{
	alert("ID cannot start with space.");
	document.frmaddDepartment.txtid.focus();
	return false;
	}
	if(document.frmaddDepartment.date.value=="")
{
alert("Please Select Date first");
return false;
}
	
	
	if(document.frmaddDepartment.txtvname.value=="")
	{
	alert("Please enter Vendor Name ");
	document.frmaddDepartment.txtvname.focus();
	return false;
	}
	if(document.frmaddDepartment.txtvfname.value!="")
{
var txtVal = document.frmaddDepartment.txtvname.value;
for(var i = 0;i<document.frmaddDepartment.txtvname.value.length; i++)
{
if(txtVal.charAt(i) < 'A' || txtVal.charAt(i) > 'Z' && txtVal.charAt(i) <'a' || txtVal.charAt(i)>'z' )
{
alert("Invalid Name Enter only Alphabets.");
document.frmaddDepartment.txtvname.focus();
return false;
}
}
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
	
		if(document.frmaddDepartment.txtdcno.value.charCodeAt() == 32)
	{
	alert("D.C. NO. cannot start with space.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdcno.value=="")
	{
	alert("Please enter D.C. NO.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txt1.value=="")
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
	}
	
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
	return true;	 
}

</script>-->
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" onLoad="return onloadfocus()">
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
	      <td width="813" height="25" class="Mainheading">&nbsp; External Captive Consumption Note - ECCN</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit()"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="deptid" value="<?php echo $dept_id;?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark">
<td width="171" align="right" valign="middle" class="smalltblheading">Logo &nbsp;</td>
<td width="254"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="76" align="right" valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
<td width="239" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>

</tr>

<tr class="Dark">
<td align="right"  valign="middle" class="smalltblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;</td>

<td align="right"  valign="middle" class="smalltblheading">Tin&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3">&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">GRN</td>
</tr>

 <tr class="Dark" height="30">
<td width="171" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="254"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid" type="text" size="5" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" /></td>

<td width="76" align="right" valign="middle" class="tblheading">&nbsp;STRN No &nbsp;</td>
<td width="239" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="6" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC" />&nbsp; </td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txtdcno" type="text" size="15" class="tbltext" tabindex=""  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
</tr>


<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">P. O. Reference Number&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtporn" type="text" size="15" class="tbltext" tabindex=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">D.C. No&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdcno" type="text" size="15" class="tbltext" tabindex=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Transport&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />&nbsp;Courier&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txttname" type="text" size="35" class="tbltext" tabindex="" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext">&nbsp;<input name="txtlrn" type="text" size="20" class="tbltext" tabindex="" /><font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="76" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtvn" type="text" size="15" class="tbltext" tabindex="" maxlength="13"  />  </td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes"  />&nbsp;TBB&nbsp;&nbsp;&nbsp;<input name="txt2" type="radio" class="tbltext" value="No"  />&nbsp;To Pay<input name="txt2" type="radio" class="tbltext" value="No"  />
   &nbsp;Paid</td>
</tr>
</table>
<table id="courier" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Light" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="25" class="tbltext" tabindex=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="76" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="25"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>

<br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="20">
              <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="22%" rowspan="2" align="center" valign="middle" class="tblheading">Items</td>
                <td colspan="4"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
              </tr>
			<tr class="tblsubtitle">
                    <td width="9%" align="center" valign="middle" class="tblheading">DC</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Good</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Damage</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Excess/<br />
                      Shortage</td>
					<td width="9%" align="center" valign="middle" class="tblheading">WH</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Bin</td>
                    <td width="9%" align="center" valign="middle" class="tblheading">Sub Bin</td>
              </tr>
          </table>
<br />

<table align="center" border="1" width="785" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
<tr class="Light" height="30">
<td width="166" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="613" align="left"  valign="middle" class="tbltext">&nbsp;
  <textarea name="txtaddress" cols="50" rows="5" tabindex="" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note:</font></td>
</tr>
</table>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Dark" >
<td width="143" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="129"  align="left" valign="middle" class="smalltbltext">____________________</td>

<td width="80" align="right" valign="middle" class="smalltblheading">&nbsp;Check By &nbsp;</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">_____________________</td>
<td width="131" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="185" colspan="3" align="left" valign="middle" class="smalltbltext">_______________________</td>
</tr>
		   </table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_arrival_vendor.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit();" border="0" style="display:inline;cursor:hand;" tabindex=""></td>
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
  
  <?php //require_once("../include/footer.php");?>
  </td>
  </tr>
</table>

</body>
</html>
