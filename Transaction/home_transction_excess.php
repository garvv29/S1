<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");*/
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
		/*$stores=trim($_POST['stores']);
		$sitem=trim($_POST['txtsid']);
		$empid=trim($_POST['empi']);
			$uom=trim($_POST['uom']);
			$sro=trim($_POST['txtsroid']);
		if($empid == 0)
		{
		?>
		 <script>
		  alert("Can not add HoD.\nReason: HoD already Present for this Department.");
		  </script>
		 <?php
		}
		else
		{
		$zonehead=trim($_POST['txtzonehead']);
		 $sql_in="insert into tblnationalhead(Identification, emp_id, dept_id) values(
											  '$zoneidentification',
											  $empid,
											  $dept
												)";
										
		if(mysql_query($sql_in)or die(mysql_error()))
		{	$id=mysql_insert_id();
			 $sql_in1="update tblemp set	 emp_role='National Head'
											 where emp_id='$empid'";
			 mysql_query($sql_in1)or die(mysql_error());
			 $sql_in2="update tblzone set	 nationalhead_id='$id'
											 where dept_id='$dept'";
			 mysql_query($sql_in2)or die(mysql_error());
			 $sql_in3="update tbluser set	 role='National Head'
			 								 where empid='$empid'";
			 mysql_query($sql_in3)or die(mysql_error());						*/			 
			echo "<script>window.location='nationalheadmaster_home.php'</script>";	
		}
		//}
	//}


	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="selectuser_hod.js"></script>
<!--<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  

function myReset()
{

}
  
function onloadfocus()
	{
	document.frmaddDept.txtzoneid.focus();
	}
function loc1()
{
window.location='add_nationalhead.php?lo='+document.frmaddDept.department.value;
}

function Openfoc()
{
if(document.frmaddDept.department.value!="")
{
var ofocf=document.frmaddDept.empi.value;
var dept=document.frmaddDept.department.value;
winHandle=window.open('National_head_select.php?ofocf='+ofocf+'&dept='+dept,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Department first.");
document.frmaddDept.department.focus();
}
}


function mySubmit()
{ 
	if(document.frmaddDept.department.value=="")
	{
	alert("Please Select Department");
	document.frmaddDept.department.focus();
	return false;
	}
	if(document.frmaddDept.txtzoneid.value=="")
	{
	alert("Please enter HOD Title ");
	document.frmaddDept.txtzoneid.focus();
	return false;
	}
	if(document.frmaddDept.txtzoneid.value.charCodeAt() == 32)
	{
	alert("HOD Title cannot start with space.");
	document.frmaddDept.txtzoneid.focus();
	return false;
	}
	if(document.frmaddDept.txtzonehead.value=="")
	{
	alert("Please Select HOD ");
	document.frmaddDept.txtzonehead.focus();
	return false;
	}
return true;
}
</SCRIPT>-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Expro-HOD Master - Add HOD</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<script language="JavaScript">

  <!--
function mmLoadMenus() {
  if (window.mm_menu_0804145533_0) return;
  window.mm_menu_0804145533_0 = new Menu("root",167,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804145533_0.addMenuItem("Classification&nbsp;Master","location='../Masters/home_classification.php'");
  mm_menu_0804145533_0.addMenuItem("Stores&nbsp;Master","location='../Masters/stores_home.php'");
  mm_menu_0804145533_0.addMenuItem("Party&nbsp;Master","location='../Masters/party_Masterhome.php'");
  mm_menu_0804145533_0.addMenuItem("SLOC&nbsp;","location='../Masters/selectbin.php'");
  mm_menu_0804145533_0.addMenuItem("Parameters&nbsp;Master","location='../Masters/companyhome.php'");
  mm_menu_0804145533_0.addMenuItem("Current&nbsp;Year&nbsp;Master","location='../Masters/current_year.php'");
  mm_menu_0804145533_0.addMenuItem("Roles&nbsp;","location='../Masters/role_home.php'");
  //mm_menu_0804145533_0.fontWeight="bold";
   mm_menu_0804145533_0.hideOnMouseOut=true;
   mm_menu_0804145533_0.bgColor='#000000';
   mm_menu_0804145533_0.menuBorder=1;
   mm_menu_0804145533_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804145533_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0804150040_0 = new Menu("root",164,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
   mm_menu_0804150040_0.addMenuItem("Arrival","location='Select_transction.php'");
   mm_menu_0804150040_0.addMenuItem("Excess","location='home_transction_excess.php'");
   mm_menu_0804150040_0.addMenuItem("Issue","location='home_transction_issue.php'");
  mm_menu_0804150040_0.addMenuItem("Issue&nbsp;Physical&nbsp;Indents","location='home_issue_physical_indent.php'");
   mm_menu_0804150040_0.addMenuItem("Issue&nbsp;Captive&nbsp;Consumption","location='home_captiveconsum1.php'");
   mm_menu_0804150040_0.addMenuItem("Issue&nbsp;Indents","location='home_indents.php'");
   mm_menu_0804150040_0.addMenuItem("Issue&nbsp;Pending&nbsp;Indents","location='home_pending _indents.php'");
   mm_menu_0804150040_0.addMenuItem("Issue&nbsp;Material&nbsp;Discard","location='home_material_discard.php'");
   mm_menu_0804150040_0.addMenuItem("Material&nbsp;Return&nbsp;Party","location='home_material_return.php'");
   mm_menu_0804150040_0.addMenuItem("Issue&nbsp;Order&nbsp;Placement","location='reorder.php'");
   mm_menu_0804150040_0.addMenuItem("Receive&nbsp;Material&nbsp;Return","location='home_return_stores.php'");
   mm_menu_0804150040_0.addMenuItem("Sloc&nbsp;Update","location='home_sloc.php'");
   mm_menu_0804150040_0.addMenuItem("G&nbsp;TO&nbsp;D","location='home_gtod.php'");
   mm_menu_0804150040_0.addMenuItem("D&nbsp;TO&nbsp;G","location='home_dtog.php'");
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


mm_menu_0804152609_0.writeMenus();
} // mmLoadMenus()
//--></script>

<script language="JavaScript" src="../include/mm_menu.js"></script>
<script language="JavaScript">
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

</script>
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" onLoad="return onloadfocus()" >
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
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#b9d647" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="stores_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;">&nbsp; Transction Arrival </a>- shortage/Excess</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><table  border="1" cellspacing="0" cellpadding="0" width="855" bordercolor="#b9d647" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td colspan="3" height="23" align="center" valign="middle" class="tblheading">Sanctioned</td>
                  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Actual</td>
				  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Difference</td>
                  </tr>
			<tr class="tblsubtitle">
                  
					 <td  colspan="2" align="center" valign="middle" class="tblheading" rowspan="">UPS</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Quantity</td>
					
                   <td width="14%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="14%" align="center" valign="middle" class="tblheading">Quantity</td>
				      <td width="14%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="14%" align="center" valign="middle" class="tblheading">Quantity</td>
              </tr>
			<tr class="<?php echo $trcls;?>" height="25">
              <td align="center" class="smalltbltext" valign="middle"><a href="faclaimdetails_view.php?month=<?php echo $month;?>&empid=<?php echo $row['emp_id'];?>&dept=<?php if(isset($_REQUEST['dept'])){ echo $dept;} else { echo "0";} ?>&vid=<?php echo $row['claim_id'];?>"></a></td>
              <td align="center" width="7%" class="smalltbltext" valign="middle" rowspan="2">&nbsp;</td>
              <td align="center" width="7%" class="smalltbltext" valign="middle">&nbsp;</td>
              <td align="center" width="7%" class="smalltbltext" valign="middle">&nbsp;</td>
              <td align="center" width="14%" class="smalltbltext" valign="middle">&nbsp;</td>
            <td valign="middle" class="tbltext" align="center">&nbsp;</td>
               <td align="center" width="14%" class="smalltbltext" valign="middle">&nbsp;</td>
            <td valign="middle" class="tbltext" align="center">&nbsp;</td>
              </tr>
            <?php $srno=$srno+1;							 ?>
          </table>
        <?php
															/*$total_pages = ceil($total_results / $max_results); 
															$no=(($page * $max_results)+1) - $max_results;
															$tono=$srno-1;
															echo "<table width='974' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
															
															// Build Previous Link 
															if($page > 1)
															{ 
																$prev = ($page - 1); 
																if(isset($_REQUEST['dept']))
																{
																echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&month=$month&dept=$dept\" STYLE='text-decoration: none'><< Previous </a> "; 
																}
																else
																{
																echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev&month=$month\" STYLE='text-decoration: none'><< Previous </a> ";
																}
															} 
															
															for($i = 1; $i <= $total_pages; $i++)
															{ 
																if(($page) == $i)
																{ 
																echo "$i "; 
																} else
																{ 
																if(isset($_REQUEST['dept']))
																{
																echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&month=$month&dept=$dept\" STYLE='text-decoration: none'>$i</a> "; 
																}
																else
																{
																echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i&month=$month\" STYLE='text-decoration: none'>$i</a> "; 
																}
																} 
															} 
															
															// Build Next Link 
															if($page < $total_pages)
															{ 
																$next = ($page + 1); 
																if(isset($_REQUEST['dept']))
																{
																echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&month=$month&dept=$dept\" STYLE='text-decoration: none'>Next>></a>"; 
																}
																else
																{
																echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next&month=$month\" STYLE='text-decoration: none'>Next>></a>";
																}
															} 
																echo "</td></tr></table>"; */
														//}?>
														
	<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_arrival From vendor.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;</td>
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
