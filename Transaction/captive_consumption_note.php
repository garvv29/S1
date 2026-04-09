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
		{	/*$id=mysql_insert_id();
			 $sql_in1="update tblemp set	 emp_role='National Head'
											 where emp_id='$empid'";
			 mysql_query($sql_in1)or die(mysql_error());
			 $sql_in2="update tblzone set	 nationalhead_id='$id'
											 where dept_id='$dept'";
			 mysql_query($sql_in2)or die(mysql_error());
			 $sql_in3="update tbluser set	 role='National Head'
			 								 where empid='$empid'";
			 mysql_query($sql_in3)or die(mysql_error());		*/						 
			echo "<script>window.location='vendor_home.php'</script>";	
		}
		//}
	//}


	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction-CCN</title>
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
/*function onloadfocus()
	{
	document.frmaddDepartment.txtdrno.focus();
	}*/
	

function clks(val)
{
alert(val);
document.frmaddDepartment.txt14.value=val;
}

function mySubmit()
{ 
	
	if(document.frmaddDepartment.txtdrno.value=="")
	{
	alert("Please enter Discard Instruction Ref. No.");
	document.frmaddDepartment.txtdrno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdrno.value.charCodeAt() == 32)
	{
	alert("Discard Instruction Ref. No cannot start with space.");
	document.frmaddDepartment.txtdrno.focus();
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

</SCRIPT>
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
	}
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
             <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				 <li><a href="../reports/slocreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li> 
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
              <ul style="vertical-align:text-top"> <li> <a  href="operprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>
                <li> &nbsp;<a href="../logout.php">Logout </a> </li>
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
          <td width="100%" valign="top" align="center"  class="midbgline">

		  	  <!-- actual page start--->		  
		   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Captive Consumption Note - CCN</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
	  <?php 
/*$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Stocktransfer' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
*/?>
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit()"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	    <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
	  <table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td align="right" width="50%" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>"  >&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+1"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">&nbsp;<?php echo $row_param['address'];?></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">&nbsp;TIN:&nbsp;<?php echo $row_param['tin'];?></td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Captive Consumption  Note</td>
</tr>

 <tr class="Dark" height="20">
<td width="190" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="292"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="86" align="right" valign="middle" class="tblheading">&nbsp;STRN No &nbsp;</td>
<td width="272" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;
<?php echo "AS".$row_tbl['arr_code']."/".$lgnid;?></td>
</tr>
<?php
/*
	$quer3=mysql_query("SELECT business_name, address FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);*/
?>

<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<?php echo $row3['business_name'];?></td>
</tr>


<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">STN No&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['stnno'];?></td>
</tr>

 <tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Light" height="20">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="99" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<?php echo $row_tbl['trans_paymode'];?></td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="99" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
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

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
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
<td width="193" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="763" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtaddress" cols="50" rows="5" tabindex="" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note:</font></td>
</tr>
</table>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Dark" >
<td width="143" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="129"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="80" align="right" valign="middle" class="smalltblheading">&nbsp;Check By &nbsp;</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="131" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="185" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
		   </table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="select_captivecon.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit();" border="0" style="display:inline;cursor:hand;" tabindex=""></td>
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
<!-- actual page end--->	
		  
		  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="images/istratlogo.gif"  align="left"/><img src="images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
