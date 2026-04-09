<?php
	/*/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");
	*/
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$perticulars=trim($_POST['txtperticulars']);
		$id=trim($_POST['txtwh']);
		$whid=trim($_POST['txtwh']);
			{
		//$id=trim($_POST['txtsid']);
		
		$query=mysql_query("SELECT * FROM tbl_bin where binname='$perticulars'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {
		 ?>
		 <script>
		  alert("This bin is Already Present.");
		  </script>
		 <?php }
		 else 
		{
	 	
		
 	   $sql_in="insert into tbl_bin(binname,whid)values('$perticulars','$whid')";
					//exit;							
		if(mysql_query($sql_in)or die(mysql_error()))
		{*/
			echo "<script>window.location='add_captive1.php'</script>";	
		}
		
	
//}
//}
//}

	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="selectuser_hod.js"></script>
<!--<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  
function onloadfocus()
	{
	document.frmaddDept.txtwh.focus();
	}
	
function mySubmit()
{ 
		
		if(document.frmaddDept.txtwh.value=="")
	{
	alert("Please select warehouse ");
	document.frmaddDept.txtwh.focus();
	return false;
	}
	if(document.frmaddDept.txtwh.value.charCodeAt() == 32)
	{
	alert("stores  Items cannot start with space.");
	document.frmaddDept.txtwh.focus();
	return false;
	}
	
	if(document.frmaddDept.txtperticulars.value=="")
	{
	alert("Please Enter Perticulars ");
	document.frmaddDept.txtperticulars.focus();
	return false;
	}
	if(document.frmaddDept.txtperticulars.value.charCodeAt() == 32)
	{
	alert("Perticulars cannot start with space.");
	document.frmaddDept.txtperticulars.focus();
	return false;
	}
	
	
	function clk(val)
{
alert(val);
document.frmaddDept.txt1.value=val;
}

if(document.frmaddDept.txt1.value=="")
{
alert("Please Select Re-order Level");
return false;
}
	
	
	if(document.frmaddDept.txtsroid.value=="")
	{
	alert("Please enter Re-order level AT ");
	document.frmaddDept.txtsroid.focus();
	return false;
	}
	if(document.frmaddDept.txtsroid.value.charCodeAt() == 32)
	{
	alert(" RE-order level  cannot start with space.");
	document.frmaddDeptt.txtsroid.focus();
	return false;
	}
return true;
}
</SCRIPT>-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Stores Master - Add Stores</title>
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
<script language="JavaScript">
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
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
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  >
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - External Captive Consumption </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);*/
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Captive Consumption </td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="128" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID &nbsp;</td>
           <td width="191" align="left"  valign="middle">&nbsp;<input name="txtperticulars" type="text" size="5" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  /></td>
		   
		   <td width="109" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="408" colspan="3" align="left"  valign="middle">&nbsp;<input name="txtperticulars" type="text" size="6" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  /></td>
		   </tr>
		
		 <tr class="Light" height="25">
           <td width="128" height="24"  align="right"  valign="middle" class="tblheading"> Party Name &nbsp;</td>
           <td align="left"  valign="middle" colspan="5">&nbsp;<input name="txtperticulars" type="text" size="20" class="tbltext" tabindex="0" maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		   <tr class="Dark" height="25">
			 <td width="128"  align="right" valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
    <td colspan="5" align="left"  valign="top" class="tbltext">&nbsp;<textarea name="txtaddress" cols="50" rows="4" tabindex="" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
<tr class="Dark" height="25">
           <td width="128" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Contact Number&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txtperticulars" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" /></td>
  </table>
<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
		 <tr class="Dark" height="30">
<td align="right" width="128" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="25" class="tbltext" tabindex="" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Lorry Receipt No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtlrn" type="text" size="20" class="tbltext" tabindex="" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">&nbsp;Vehicle No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtvn" type="text" size="15" class="tbltext" tabindex="" maxlength="13"  />
  </td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes"  />&nbsp;TBB&nbsp;&nbsp;&nbsp;<input name="txt2" type="radio" class="tbltext" value="No"  />&nbsp;To Pay<input name="txt2" type="radio" class="tbltext" value="No"  />  &nbsp;Paid</td>
</tr>
<?php
/*$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
$noticia = mysql_fetch_array($quer2);
*/?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
</table>
<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
		<tr class="Dark" height="30">
<td align="right" width="128" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="25" class="tbltext" tabindex=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="20" class="tbltext" tabindex="" maxlength="20"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="c_c_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;"></td>
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

