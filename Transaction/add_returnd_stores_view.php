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
	//$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{

	/*
		$sql_arr=mysql_query("select * from tblarrival where arrival_id='".$pid."'") or die(mysql_error());
	while($row_arr=mysql_fetch_array($sql_arr))
	{
	$partyid=$row_arr['party_id'];
	$trdate=$row_arr['arrival_date'];
	
	$sql_arrsub=mysql_query("select * from tblarrival_sub where arrival_id='".$pid."'") or die(mysql_error());
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
		$classid=$row_arrsub['classification_id'];
		$itemid=$row_arrsub['item_id'];
		
		$sql_arrsub_sub=mysql_query("select * from tblarr_sloc where arr_tr_id='".$pid."' and arr_id='".$row_arrsub['arrsub_id']."'") or die(mysql_error());
		while($row_arrsub_sub=mysql_fetch_array($sql_arrsub_sub))
		{
			$whid=$row_arrsub_sub['whid'];
			$binid=$row_arrsub_sub['binid'];
			$subbinid=$row_arrsub_sub['subbin'];
			$ups=$row_arrsub_sub['ups_good'];
			$qty=$row_arrsub_sub['qty_good'];
			$ups1=$row_arrsub_sub['ups_damage'];
			$qty1=$row_arrsub_sub['qty_damage'];
			
			if($row_arrsub_sub['qty_damage']==0 && $row_arrsub_sub['ups_damage']==0 )
			{
			
				$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$binid."' and stlg_whid='".$whid."'") or die(mysql_error());
				$row_issue1=mysql_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 
				$row_issuetbl=mysql_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['stlg_balups'];
				$opqty=$row_issuetbl['stlg_balqty'];
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
				
				$sql_sub_sub="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trpartyid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('$yearid_id','Arrival', 'Internalreturn', '$pid', '$partyid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
			}
			else
			{
			
				$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$subbinid."' and stld_binid='".$binid."' and stld_whid='".$whid."'") or die(mysql_error());
				$row_issue1=mysql_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."'") or die(mysql_error()); 
				$row_issuetbl=mysql_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['stld_balups'];
				$opqty=$row_issuetbl['stld_balqty'];
				$balups=$opups+$ups1;
				$balqty=$opqty+$qty1;
				
				$sql_sub_sub="insert into tbl_stldg_damage (yearcode,stld_trtype, stld_trsubtype, stld_trid, stld_trpartyid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('$yearid_id','Arrival', 'Internalreturn', '$pid', '$partyid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups1', '$qty1', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
			}	
		}
	}
}

		echo "<script>window.location='select_material_Returnd.php?p_id=$pid'</script>";*/	
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores- Transaction -Add Return Stores</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
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



function bindamage(dval)
{
	if(document.frmaddDepartment.txtqty.value!="")
	{
		if(dval==1 || dval=="1")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="none";
			document.getElementById('ups4').value=document.frmaddDepartment.txtups.value;
			document.getElementById('qty4').value=document.frmaddDepartment.txtqty.value;
			document.getElementById('ups4').readOnly=true;
			document.getElementById('ups4').style.backgroundColor="#CCCCCC";
			document.getElementById('qty4').readOnly=true;
			document.getElementById('qty4').style.backgroundColor="#CCCCCC";
		}
		else if(dval==2 || dval=="2")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="block";
			document.getElementById('ups4').value="";
			document.getElementById('qty4').value="";
			document.getElementById('ups4').readOnly=false;
			document.getElementById('ups4').style.backgroundColor="#FFFFFF";
			document.getElementById('qty4').readOnly=false;
			document.getElementById('qty4').style.backgroundColor="#FFFFFF";
			document.getElementById('ups5').value="";
			document.getElementById('qty5').value="";
			document.getElementById('ups5').readOnly=true;
			document.getElementById('ups5').style.backgroundColor="#CCCCCC";
			document.getElementById('qty5').readOnly=true;
			document.getElementById('qty5').style.backgroundColor="#CCCCCC";
		}
		else
		{
			document.getElementById('dsloc1').style.display="none";
			document.getElementById('dsloc2').style.display="none";
			document.getElementById('ups4').readOnly=false;
			document.getElementById('ups4').style.backgroundColor="#FFFFFF";
			document.getElementById('qty4').readOnly=false;
			document.getElementById('qty4').style.backgroundColor="#FFFFFF";
			document.getElementById('ups5').value="";
			document.getElementById('qty5').value="";
			document.getElementById('ups5').readOnly=false;
			document.getElementById('ups5').style.backgroundColor="#FFFFFF";
			document.getElementById('qty5').readOnly=false;
			document.getElementById('qty5').style.backgroundColor="#FFFFFF";
		}
	}
	else
	{
	alert("Please enter Quantity first");
	document.frmaddDepartment.txtqty.focus();
	}
}



function wh4(wh4val)
{
		if(document.frmaddDepartment.tblslocnod.value!="")
		{
			showUser(wh4val,'bind1','wh','bind1','','','','');
		}
		else
		{
			alert("Please select SLOC number of Bins Damage");
		}
}

function wh5(wh5val)
{
if(document.frmaddDepartment.txtslwhd1.value!="")
	{
		if(document.frmaddDepartment.txtslqtyd1.value!="")
		{
		showUser(wh5val,'bind2','wh','bind2','','','','');
		}
		else
		{
		alert("Please enter Quantity in first SLOC Row in Damage section");
		}
	}
	else
	{
		alert("Please select Warehouse in first Row in Damage section");
	}
}




function bin4(bin4val)
{
	if(document.frmaddDepartment.txtslwhd1.value!="")
	{
		showUser(bin4val,'sbind1','bin','txtslsubbd1','','','','');
	}
	else
	{
		alert("Please select Warehouse in first Row in Damage section");
	}
}

function bin5(bin5val)
{
	if(document.frmaddDepartment.txtslwhd2.value!="")
	{
		showUser(bin5val,'sbind2','bin','txtslsubbd2','','','','');
	}
	else
	{
		alert("Please select Warehouse in second Row in Damage section");
	}
}

function ups4(ups4val)
{
	if(document.frmaddDepartment.txtslsubbd1.value=="")
	{
		alert("Please select Sub Bin in first Row in Damage section");
		document.frmaddDepartment.txtslupsd1.value="";
		document.frmaddDepartment.txtslsubbd1.focus();
	}
	if(document.frmaddDepartment.txtslupsd1.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslsubbd1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslsubbd1.value="";
			document.frmaddDepartment.txtslsubbd1.focus();
		}
		if(document.frmaddDepartment.txtslsubbd1.value==0 || document.frmaddDepartment.txtslsubbd1.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslsubbd1.value="";
			document.frmaddDepartment.txtslsubbd1.focus();
		}
		if(document.frmaddDepartment.tblslocnod.value==2 || document.frmaddDepartment.tblslocnod.value=="2")
		{
			document.getElementById('ups5').value=parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(ups4val);
		}
		
	}
}

function ups5(ups5val)
{
	if(document.frmaddDepartment.txtslsubbd2.value=="")
	{
		alert("Please select Sub Bin in second Row in Damage section");
		document.frmaddDepartment.txtslupsd2.value="";
		document.frmaddDepartment.txtslsubbd2.focus();
	}
}

function qty4(qty4val)
{
	if(document.frmaddDepartment.txtslupsd1.value=="")
	{
		alert("Please enter UPS in first Row in Damage section");
		document.frmaddDepartment.txtslqtyd1.value="";
		document.frmaddDepartment.txtslupsd1.focus();
	}
	if(document.frmaddDepartment.txtslqtyd1.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslqtyd1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslqtyd1.value="";
			document.frmaddDepartment.txtslqtyd1.focus();
		}
		if(document.frmaddDepartment.txtslqtyd1.value==0 || document.frmaddDepartment.txtslqtyd1.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyd1.value="";
			document.frmaddDepartment.txtslqtyd1.focus();
		}
		if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{
			document.getElementById('qty5').value=parseFloat(document.frmaddDepartment.txtqtyd.value)-parseFloat(qty4val);
		}
	}
}

function qty5(qty5val)
{
	if(document.frmaddDepartment.txtslupsd2.value=="")
	{
		alert("Please enter UPS in second Row in Damage section");
		document.frmaddDepartment.txtslqtyd2.value="";
		document.frmaddDepartment.txtslupsd2.focus();
	}
}

function modetchk(classval)
{
//if(document.frmaddDepartment.txt11.value!="")
showUser(classval,'vitem','item','','','','','');
//else
//alert("Please select Mode of Transit first");
}

function classchk(itval)
{
if(document.frmaddDepartment.txtclass.value!="")
{
showUser(itval,'uom','itemuom','','','','','');
}
else
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDepartment.txtclass.focus();
}
}

function openslocpop()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}


function retchk(retval)
{
showUser(retval,'retby','retnby','','','','','');
}


function rtnbychk(rtnbyval)
{
	if(rtnbyval!="")
	{
		if(document.frmaddDepartment.txtstage.value!="")
		{
			document.getElementById("rbd").value="";
			document.getElementById("rbd").readOnly=true;
			document.getElementById("rbd").style.backgroundColor="#CCCCCC";
		}
		else
		{
			alert("Please select Return from Stage first");
			document.frmaddDepartment.txtstage.focus();
			return false;
		}
	}
	else
	{
		document.getElementById("rbd").value="";
		document.getElementById("rbd").readOnly=false;
		document.getElementById("rbd").style.backgroundColor="#FFFFFF";
	}
}

function partychk()
{
	if(document.frmaddDepartment.txtrd.value=="" && document.getElementById("rbd").value=="")
	{
		alert("Please select Return by ID or Specify the ID");
		document.frmaddDepartment.txtrd.focus();
		return false;
	}
}

function mySubmit()
{
	/*if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please select Return from Stage");
		document.frmaddDepartment.txtstage.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtrd.value=="" && document.frmaddDepartment.txtrbd.value=="")
	{
		alert("Please select Return by ID or Specify the Name");
		//document.frmaddDepartment.txtstage.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please select Party Name");
		document.frmaddDepartment.txtparty.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Please select Classification");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Stores Item");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtqty.value=="")
	{
		alert("Please enter Quantity");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	
	if(document.frmaddDepartment.tblslocnod.value=="")
	{
		alert("Please select number of Bins");
		document.frmaddDepartment.tblslocnod.focus();
		return false;
	}
	
	if(document.frmaddDepartment.tblslocnod.value!="")
	{
		if(document.frmaddDepartment.tblslocnod.value==1 || document.frmaddDepartment.tblslocnod.value=="1")
		{
			if(document.frmaddDepartment.txtslsubbd1.value=="")
			{
				alert("Please select Subbin");
				document.frmaddDepartment.txtslsubbd1.focus();
				return false;
			}
		}
		if(document.frmaddDepartment.tblslocnod.value==2 || document.frmaddDepartment.tblslocnod.value=="2")
		{
			if(document.frmaddDepartment.txtslsubbd2.value=="")
			{
				alert("Please select Subbin in 2nd SLOC");
				//document.frmaddDepartment.txtslqtyg1.focus();
				return false;
			}
		}
		
	}*/
	
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
            <div class="toplinks" style="vertical-align:text-top"><ul style="vertical-align:text-top"> <li> <a href="operprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>    <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction Arrival - Internal Return-Own (Good & Damage)<img src="../images/blue_curvetop.gif" /></td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arrival_type='Internalreturn' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$lrole=$row_tbl['arr_role'];

?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
	 <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Internal Material Return - Own (Good & Damage)</td>
</tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
  <?php
$party=mysql_query("SELECT p_id, business_name FROM tbl_partymaser where p_id='".$row_tbl['party_id']."'")or die(mysql_error()); 
$row_party=mysql_fetch_array($party);
?>
<tr class="Dark" height="25">
      <td width="192" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
      <td width="316" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "TAI".$row_tbl['arrival_code']."/".$yearid_id."/".$lrole;?></td>
    
	  <td width="141" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
      <td width="191" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="25">
      <td width="192" height="24"  align="right"  valign="middle" class="tblheading"> Party Name&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_party['business_name'];?></td>
		<td width="141" height="24"  align="right"  valign="middle" class="tblheading"> Return from Stage&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stageret'];?></td>
<?php
$quer1=mysql_query("SELECT id ,login FROM tbl_roles where stage='".$row_tbl['stageret']."' and id='".$row_tbl['retid']."'")or die(mysql_error()); 
$row1=mysql_fetch_array($quer1);
$tot_1=mysql_num_rows($quer1);
?></tr>
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<?php echo $row3['address']?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?></td>
</tr>

<tr class="Dark" height="30">
      <td width="192" height="24"  align="right"  valign="middle" class="tblheading">Return By ID&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext" id="retby" colspan="3" >&nbsp;<?php echo $row_tbl['retid'];?>&nbsp;&nbsp;&nbsp;&nbsp;<font class="tblheading">OR Specify</font>&nbsp;
<?php
if($tot_1 ==0)
{
?>
&nbsp;<?php echo $row_tbl['retid'];?></td>
<?php
}
else
{
?>
</tr>
<?php 
}
?>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());
$subtid=0;
?>
			 <tr class="tblsubtitle" height="20">
              <td width="1%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">UoM</td>
                <td colspan="4"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="4" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
              </tr>
			<tr class="tblsubtitle">
			  <td colspan="2" align="center" valign="middle" class="tblheading">Good</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
			  </tr>
			<tr class="tblsubtitle">
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
					<td width="2%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="6%" align="center" valign="middle" class="tblheading">Bin</td>
                    <td width="3%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$srno=1; $itmdchk="";
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{
if($itmdchk!="")
{
$itmdchk=$itmdchk.$row_tbl_sub['item_id'].",";
}
else
{
$itmdchk=$row_tbl_sub['item_id'].",";
}

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="20%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>			 <td align="center" valign="middle" class="tblheading"><?php echo $gd;?></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="20%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>			 <td align="center" valign="middle" class="tblheading"><?php echo $gd;?></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			 </tr> 
<?php
}
$srno++;
}
}
?> </table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="8%" align="center" valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="92%" align="left" valign="middle" class="tblheading" colspan="18">&nbsp;<?php echo $row_tbl['remarks'];?>&nbsp;</td>
</tr>			  
          </table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_return_stores2.php?p_id=<?php echo $pid;?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;</td>
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
