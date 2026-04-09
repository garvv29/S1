<?php
	
/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	else
	{
	$yearid_id=$_SESSION['year_id'];
	$role=$_SESSION['role'];
   $loginid=$_SESSION[['loginid'];
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$logid="opr1";
	
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
			
		echo "Submited";	
		exit;
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
	$sql_code="SELECT MAX(arrival_code) FROM tblarrival ORDER BY arrival_code DESC";
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

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function pform()
{
//document.getElementById("mainform")
var a=formPost(document.getElementById('mainform'));
//document.getElementById('urltext').value=a;
showUser(a,'postingtable','mform','');
/*alert(a);
var b=a.split("&");
alert(b[1]);*/
}
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

function bingood(gval)
{	
	if(document.frmaddDepartment.txtqtyg.value!="")
	{
		if(gval==1 || gval=="1")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
		}
		else if(gval==2 || gval=="2")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="none";
		}
		else if(gval==3 || gval=="3")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="block";
		}
		else
		{
			document.getElementById('gsloc1').style.display="none";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
		}
	}
	else
	{
	alert("Please enter UPS Good first");
	document.frmaddDepartment.txtqtyg.focus();
	}
}


function bindamage(dval)
{
	if(document.frmaddDepartment.tblslocnog.value!="")
	{
		if(dval==1 || dval=="1")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="none";
		}
		else if(dval==2 || dval=="2")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="block";
		}
		else if(dval==3 || dval=="3")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="block";
		}
		else
		{
			document.getElementById('dsloc1').style.display="none";
			document.getElementById('dsloc2').style.display="none";
		}
	}
	else
	{
	alert("Please select number of Bins Good first");
	document.frmaddDepartment.tblslocnog.focus();
	}
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }


function clk1(val)
{
document.frmaddDepartment.txt14.value=val;
}

function upschk(upsval)
{
if(document.frmaddDepartment.txtupsdc.value!="")
{
if(document.frmaddDepartment.txtupsd.value=="")
document.frmaddDepartment.txtexshups.value=parseInt(document.frmaddDepartment.txtupsdc.value)-parseInt(upsval);
else
document.frmaddDepartment.txtexshups.value=parseInt(document.frmaddDepartment.txtupsdc.value)-parseInt(upsval)-parseInt(document.frmaddDepartment.txtupsd.value);
}
else
{
alert("Please enter UPS as per DC first");
document.frmaddDepartment.txtupsg.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtupsdc.focus();
}
}

function upschk1(upsval1)
{
if(document.frmaddDepartment.txtupsg.value!=""){
document.frmaddDepartment.txtexshups.value=parseInt(document.frmaddDepartment.txtupsdc.value)-parseInt(upsval)-parseInt(document.frmaddDepartment.txtupsg.value);}
else
{
alert("Please enter UPS Good first");
document.frmaddDepartment.txtupsd.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtupsg.focus();
}
}


function qtychk(qtyval)
{
if(document.frmaddDepartment.txtqtydc.value!="")
{
if(document.frmaddDepartment.txtqtyd.value=="")
document.frmaddDepartment.txtexshqty.value=parseInt(document.frmaddDepartment.txtqtydc.value)-parseInt(upsval);
else
document.frmaddDepartment.txtexshqty.value=parseInt(document.frmaddDepartment.txtqtydc.value)-parseInt(upsval)-parseInt(document.frmaddDepartment.txtqtyd.value);
}
else
{
alert("Please enter Quantity as per DC first");
document.frmaddDepartment.txtqtyg.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtqtydc.focus();
}
}


function qtychk1(qtyval1)
{
if(document.frmaddDepartment.txtqtyg.value!=""){
document.frmaddDepartment.txtexshqty.value=parseInt(document.frmaddDepartment.txtqtydc.value)-parseInt(upsval)-parseInt(document.frmaddDepartment.txtqtyg.value);}
else
{
alert("Please enter UPS Good first");
document.frmaddDepartment.txtqtyd.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtqtyg.focus();
}
}

function classchk()
{
if(document.frmaddDepartment.txtclass.value=="")
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDepartment.txtclass.focus();
}
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
	
	return false;	 
}

</script>
</head>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" >
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
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
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
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcla" style="width:150px;" onchange="showUser(this.value,'vaddress','vendor','');">
<option value="" selected="selected">--Select Vendor--</option>
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
<td align="left"  valign="middle" >&nbsp;<input name="txtporn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>

 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Transport&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />&nbsp;Courier&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
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
<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="76" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php
$tid=0;
?>
            <tr class="tblsubtitle" height="20">
              <td width="2%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="20%" rowspan="3" align="center" valign="middle" class="tblheading">Items</td>
                <td colspan="8"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="3" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
             
              <td width="3%" rowspan="3" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="5%" rowspan="3" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			<tr class="tblsubtitle">
			  <td colspan="2" align="center" valign="middle" class="tblheading">DC</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Good</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Excess/<br />
Shortage</td>
			  </tr>
			<tr class="tblsubtitle">
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
					<td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
					<td width="9%" align="center" valign="middle" class="tblheading">Bin</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
 <tr class="Light" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="17%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="20%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="6%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="6%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="9%" align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="3%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="5%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 </tr>

<tr class="Dark" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="17%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="20%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="6%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td width="6%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="9%" align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="4%" align="center" valign="middle" class="tblheading">&nbsp;</td>
			 <td width="3%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="5%" align="center" valign="middle" class="tblheading">&nbsp;</td>
 </tr>   			  
          </table>
		  <br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" class="tblheading">Add Arrival From Vendor </td>
</tr>
<tr height="15"><td colspan="10" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td  align="right"  valign="middle" class="tblheading" colspan="3">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="7" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onchange="showUser(this.value,'vitem','item','');">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select><font color="#FF0000">*</font>
	</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?>            
         <tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading" colspan="3">Stores Items&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="7" id="vitem">&nbsp;<select class="tbltext" name="txtitem" style="width:170px;" onchange="classchk();" >
<option value="" selected>--Select Item--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="#">Details</a></td></tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading" colspan="3">UPS As per D.C&nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" colspan="3">Quantitiy As per D.C&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex=""   maxlength="7" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" colspan="3">UPS Good&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsg" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onchange="upschk(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading" colspan="3">Actual Quantity Receive Good&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtqtyg" type="text" size="10" class="tbltext" tabindex=""  / maxlength="7" onchange="qtychk(this.value);">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading" colspan="3">UPS Damage&nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onchange="upschk1(this.value);"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading" colspan="3">Quantity Damage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onchange="qtychk1(this.value);"  />&nbsp;</td>
</tr>

 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" colspan="3">Excess/Shortage UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtexshups" type="text" size="10" class="tbltext" tabindex="" maxlength="5" readonly="true" style="background-color:#CCCCCC"  /></td>
<td align="right"  valign="middle" class="tblheading" colspan="3">Excess/Shortage Quantity&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="220" align="right"  valign="middle" class="tblheading">SLOC No of BINS Good &nbsp;</td>
<td width="624" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="tblslocnog" style="width:80px;" onchange="bingood(this.value);" >
<option value="">--Bin--</option>
<option value="1" >1</option>
<option value="2" >2</option>
<option value="3" >3</option>   
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div  id="gsloc1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<tr class="Light" height="30" >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtwhslg1" style="width:60px;" onchange="showUser(this.value,'bing1','wh','bing1');"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg1 = mysql_fetch_array($whg1_query)) { ?>
		<option value="<?php echo $noticia_whg1['whid'];?>" />   
		<?php echo $noticia_whg1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="61" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtbinslg1" style="width:60px;" >
<option value="" selected>--Bin--</option>
	<?php while($noticia_bing1 = mysql_fetch_array($bing1_query)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="80" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;"  >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing1 = mysql_fetch_array($subbing1_query)) { ?>
		<option value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="52" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="41" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
</table>
</div>
<?php
$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div id="gsloc2" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:60px;" onchange="showUser(this.value,'bing2','wh','bing2');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg2 = mysql_fetch_array($whg2_query)) { ?>
		<option value="<?php echo $noticia_whg2['whid'];?>" />   
		<?php echo $noticia_whg2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="61" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="showUser(this.value,'sbing2','bin','');"  >
<option value="" selected>--Bin--</option>
	<?php while($noticia_bing2 = mysql_fetch_array($bing2_query)) { ?>
		<option value="<?php echo $noticia_bing2['binid'];?>" />   
		<?php echo $noticia_bing2['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="80" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing2 = mysql_fetch_array($subbing2_query)) { ?>
		<option value="<?php echo $noticia_subbing2['sid'];?>" />   
		<?php echo $noticia_subbing2['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="52" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="41" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
</table>
</div>
<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div  id="gsloc3" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:60px;" onchange="showUser(this.value,'bing3','wh','bing3');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="61" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="showUser(this.value,'sbing3','bin','');"  >
<option value="" selected>--Bin--</option>
	<?php while($noticia_bing3 = mysql_fetch_array($bing3_query)) { ?>
		<option value="<?php echo $noticia_bing3['binid'];?>" />   
		<?php echo $noticia_bing3['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="80" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbing3 = mysql_fetch_array($subbing3_query)) { ?>
		<option value="<?php echo $noticia_subbing3['sid'];?>" />   
		<?php echo $noticia_subbing3['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		

<td width="52" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="41" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
</table>
</div>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
 <tr class="Dark" height="30">
<td width="220" align="right"  valign="middle" class="tblheading">SLOC No of BINS Damage&nbsp;</td>
<td width="624" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="tblslocnod" style="width:80px;" onchange="bindamage(this.value);" >
<option value="">--Bin--</option>
<option value="1" >1</option>
<option value="2" >2</option>
</select>&nbsp;</td>
</tr>
</table>
<?php
$whd1_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div  id="dsloc1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd1" style="width:60px;" onchange="showUser(this.value,'bind1','wh','bind1');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysql_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="61" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="bind1">&nbsp;<select class="tbltext" name="txtslbind1" style="width:60px;" onchange="showUser(this.value,'sbind1','bin','');"  >
<option value="" selected>--Bin--</option>
	<?php while($noticia_bind1 = mysql_fetch_array($bind1_query)) { ?>
		<option value="<?php echo $noticia_bind1['binid'];?>" />   
		<?php echo $noticia_bind1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="80" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="sbind1">&nbsp;<select class="tbltext" name="txtslsubbd1" style="width:60px;" >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbind1 = mysql_fetch_array($subbind1_query)) { ?>
		<option value="<?php echo $noticia_subbind1['sid'];?>" />   
		<?php echo $noticia_subbind1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="52" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd1" type="text" size="4" class="tbltext" tabindex="" maxlength="7"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="41" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
</table>
</div>
<?php
$whd2_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div id="dsloc2" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30" >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd2" style="width:60px;" onchange="showUser(this.value,'bind2','wh','bind2');" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysql_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="61" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="bind2">&nbsp;<select class="tbltext" name="txtslbind2" style="width:60px;" onchange="showUser(this.value,'sbind2','bin','');"  >
<option value="" selected>--Bin--</option>
	<?php while($noticia_bind2 = mysql_fetch_array($bind2_query)) { ?>
		<option value="<?php echo $noticia_bind2['binid'];?>" />   
		<?php echo $noticia_bind2['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="80" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" id="sbind2">&nbsp;<select class="tbltext" name="txtslsubbd2" style="width:60px;" >
<option value="" selected>--Sub Bin--</option>
	<?php while($noticia_subbind2 = mysql_fetch_array($subbind2_query)) { ?>
		<option value="<?php echo $noticia_subbind2['sid'];?>" />   
		<?php echo $noticia_subbind2['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="52" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" type="text" size="4" class="tbltext" tabindex="" maxlength="7"   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="41" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
</table>
</div>
<input type="hidden" name="maintrid" value="0" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="220" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="624" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtremarks" cols="50" rows="5" tabindex="" ></textarea>&nbsp;</td>
</tr>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
