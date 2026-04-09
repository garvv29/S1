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
	
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];	 
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{	 
		$sql_arr=mysql_query("select * from tbl_sloc where slid='".$pid."'") or die(mysql_error());
		$row_arr=mysql_fetch_array($sql_arr);
		$classid=$row_arr['classification_id'];
		$itemid=$row_arr['items_id'];
		$trdate=$row_arr['issuedate'];
		$itmtype=$row_arr['itmtype'];
		$balanceups=0;$balanceqty=0;
		$cntd=0; $cntg=0;
if($itmtype=="good")
{
		$sql_issue=mysql_query("select distinct stlg_subbinid, stlg_binid, stlg_whid  from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
		while ($row_issue=mysql_fetch_array($sql_issue))
		{
		
		$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."' ") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 
		//echo $row_issue1[0];echo "<BR>";
		//echo $t=mysql_num_rows($sql_issue1); echo "<BR>";
	$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'and stlg_balqty>0") or die(mysql_error()); 
	while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
	{
				$whid=$row_issuetbl['stlg_whid'];
				$binid=$row_issuetbl['stlg_binid'];
				$subbinid=$row_issuetbl['stlg_subbinid'];
				$opups=$row_issuetbl['stlg_balups'];
				$opqty=$row_issuetbl['stlg_balqty'];
				$balups=0;
				$balqty=0;
				
				$sql_sub_sub="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('$yearid_id','SLOC', 'SUO', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$opups', '$opqty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
		
			}	
						
$sql_issueg=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid!='".$itemid."' and stlg_subbinid='".$subbinid."'") or die(mysql_error());
//$cntg=0;
while($row_issueg=mysql_fetch_array($sql_issueg))
 { 
	$sql_issueg1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$row_issueg['stlg_binid']."' and stlg_whid='".$row_issueg['stlg_whid']."' and stlg_tritemid!='".$itemid."'") or die(mysql_error());
	$row_issueg1=mysql_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issueg1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
	$totnog=mysql_num_rows($sql_issuetblg);
	if($totnog == 0)
	{
	$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid'";
	mysql_query($sql_itmg) or die(mysql_error());
	 // $cntg++;
	} 
}				
}

		$sql_sloc_sub=mysql_query("select * from tbl_sloc_sub where slocid='".$pid."'") or die(mysql_error());
		while($row_sloc_sub=mysql_fetch_array($sql_sloc_sub))
		{
				$whid=$row_sloc_sub['whid'];
				$binid=$row_sloc_sub['binid'];
				$subbinid=$row_sloc_sub['subbinid'];
				$ups=$row_sloc_sub['ups'];
				$qty=$row_sloc_sub['qty'];
				
				$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$binid."' and stlg_whid='".$whid."' and stlg_tritemid!='".$itemid."' ") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 

	$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'and stlg_balqty>0") or die(mysql_error()); 
	$row_issuetbl=mysql_fetch_array($sql_issuetbl);
	
				$opups=$row_issuetbl['stlg_balups'];
				$opqty=$row_issuetbl['stlg_balqty'];
				$opups=$balups+$opups;
				$opqty=$balqty+$opqty;
				$balups=$ups;
				$balqty=$qty;
				
				$sql_sub_sub="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('$yearid_id','SLOC', 'SUC', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
				
				$sql_itmg="update tbl_subbin set status='Good' where sid='$subbinid'";
				mysql_query($sql_itmg) or die(mysql_error());
		
		}
		
		
		$sql_itm=mysql_query("select * from tbl_stores where items_id='".$itemid."' and srl_status='Yes'") or die (mysql_error());
		$t_itm=mysql_num_rows($sql_itm);
		if($t_itm > 0)
		{
			$row_itm=mysql_fetch_array($sql_itm);
			$tqty=0;
			$sql_is=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid!='".$itemid."'") or die(mysql_error());
$cntg=0;
			while($row_is=mysql_fetch_array($sql_is))
 			{ 
			
			$sql_is1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_is['stlg_subbinid']."' and stlg_binid='".$row_is['stlg_binid']."' and stlg_whid='".$row_is['stlg_whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());		
			$row_is1=mysql_fetch_array($sql_is1); 
			
			$sql_issue1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_is1[0]."' and stlg_balqty > 0") or die(mysql_error());
			$tot_issue1=mysql_num_rows($sql_issue1);
			if($tot_issue1 > 0)
			{
				$row_issue1=mysql_fetch_array($sql_issue1); 
				$tqty=$tqty+$row_issue1['stlg_balqty'];
			}
			}	
			$actrol=$row_itm['srl'];
			$srlstatus=$row_itm['srl_status'];
			if(($tqty <= $actrol) && $srlstatus!="OR")
			{
			$sql_sub_sub="update tbl_stldg_good set orstatus='R' where stlg_tritemid='".$itemid."' and stlg_balqty > 0";
			mysql_query($sql_sub_sub) or die(mysql_error());
			}
		}
		
		
		
}
else
{
		$sql_issue=mysql_query("select distinct stld_subbinid, stld_binid, stld_whid  from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid='".$itemid."'") or die(mysql_error());
		while ($row_issue=mysql_fetch_array($sql_issue))
		{
		
		$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itemid."' ") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 
		//echo $row_issue1[0];echo "<BR>";
//echo $t=mysql_num_rows($sql_issue1); echo "<BR>";
	$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."'and stld_balqty > 0") or die(mysql_error()); 
	while ($row_issuetbl=mysql_fetch_array($sql_issuetbl))
	{
				$whid=$row_issuetbl['stld_whid'];
				$binid=$row_issuetbl['stld_binid'];
				$subbinid=$row_issuetbl['stld_subbinid'];
				$opups=$row_issuetbl['stld_balups'];
				$opqty=$row_issuetbl['stld_balqty'];
				$balups=0;
				$balqty=0;
				
				$sql_sub_sub="insert into tbl_stldg_damage (yearcode,stld_trtype, stld_trsubtype, stld_trid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('$yearid_id','SLOC', 'SUO', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$opups', '$opqty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
	}	
		
$sql_issued=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid!='".$itemid."' and stld_subbinid='".$subbinid."'") or die(mysql_error());
$totups=0; $totqtyd=0; // $cntd=0;
while($row_issued=mysql_fetch_array($sql_issued))
 { 
	$sql_issued1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$subbinid."' and stld_binid='".$row_issued['stld_binid']."' and stld_whid='".$row_issued['stld_whid']."'  and stld_tritemid!='".$itemid."'") or die(mysql_error());
	$row_issued1=mysql_fetch_array($sql_issued1); 
	
	$sql_issuetbld=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issued1[0]."' and stld_balqty > 0") or die(mysql_error()); 
	$totnod=mysql_num_rows($sql_issuetbld);
	if($totnod == 0)
	{
	$sql_itmd="update tbl_subbin set status='Empty' where sid='$subbinid'";
	mysql_query($sql_itmd) or die(mysql_error());
	  //$cntd++;
	} 
}	
}		
		$sql_sloc_sub=mysql_query("select * from tbl_sloc_sub where slocid='".$pid."'") or die(mysql_error());
		while($row_sloc_sub=mysql_fetch_array($sql_sloc_sub))
		{
				$whid=$row_sloc_sub['whid'];
				$binid=$row_sloc_sub['binid'];
				$subbinid=$row_sloc_sub['subbinid'];
				$ups=$row_sloc_sub['ups'];
				$qty=$row_sloc_sub['qty'];
				
		$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$subbinid."' and stld_binid='".$binid."' and stld_whid='".$whid."' and stld_subbinid='".$subbinid."' ") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 

	$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."'and stld_balqty > 0") or die(mysql_error()); 
	$row_issuetbl=mysql_fetch_array($sql_issuetbl);
	
				$opups=$row_issuetbl['stld_balups'];
				$opqty=$row_issuetbl['stld_balqty'];
				$opups=$balups+$opups;
				$opqty=$balqty+$opqty;
				$balups=$ups;
				$balqty=$qty;
				
				$sql_sub_sub="insert into tbl_stldg_damage (yearcode,stld_trtype, stld_trsubtype, stld_trid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('$yearid_id','SLOC', 'SUC', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
				
				$sql_itmg="update tbl_subbin set status='Damage' where sid='$subbinid'";
				mysql_query($sql_itmg) or die(mysql_error());
		
		}	
			
}
		
		
	$s_chk=mysql_query("SELECT * FROM tbl_sloc where yearcode='$yearid_id'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(scode) FROM tbl_sloc where yearcode='$yearid_id' ORDER BY scode DESC";
	else
	$sql_code="SELECT MAX(scode) FROM tbl_sloc  ORDER BY scode DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
		
				
	$sql_main="update tbl_sloc set supflg=1, scode=$code  where slid='".$pid."'";

	$a123456=mysql_query($sql_main) or die(mysql_error());
	
 	
			echo "<script>window.location='select_sloc_op.php?p_id=$pid'</script>";	
}
		

	
/*	$a="c";
	$sql_code="SELECT MAX(code) FROM tbl_sloc where  yearcode='$yearid_id' ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores -Transaction -Sloc Update </title>
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

<script src="slocup.js"></script>
<script language="javascript" type="text/javascript">


function openslocpopprint()
{

var pid=document.frmaddDept.pid.value;
winHandle=window.open('issue_slupdation_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
else if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	return true;	 
	}
	else
	{
	return false;
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
            <div class="toplinks" style="vertical-align:text-top"><ul style="vertical-align:text-top"> <li> <a href="operprofile.php">Profile </a> | </li>
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
          <td width="100%" valign="top" align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#b9d647"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation - Preview </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysql_query("select * from tbl_sloc where slid='".$pid."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$tdate=$row['issuedate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$c=$row['classification_id'];
$f=$row['items_id'];
$a=$row['itmtype'];
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="pid" value="<?php echo $pid;?>" type="hidden">
	  <input name="txtdate" value="<?php echo $tdate;?>" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation</td>
</tr>
 
<tr class="Dark" height="25">
           <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Transction ID&nbsp;</td>
           <td width="350" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "TSU".$row['code']."/".$yearid_id."/".$lgnid;?></td>
		   
		   <td width="129" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
		   </tr>
 <?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$c."'") or die(mysql_error());
$noticia_class=mysql_fetch_array($quer3);
?>
		 <tr class="Dark" height="25">
           <td width="158"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?></td>
         </tr>
<?php 
$itemqry1=mysql_query("select * from tbl_stores where items_id='".$f."'") or die(mysql_error());
$row_itm=mysql_fetch_array($itemqry1);
?> 
		<tr class="Light" height="25">
           <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle"  id="item" class="tbltext">&nbsp;<?php echo $row_itm['stores_item'];?></td>
                <td width="129" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
           <td align="left"  valign="middle"  id="uom" class="tbltext">&nbsp;<?php echo $row_itm['uom'];?></td>
         </tr>
		  <tr class="Dark" height="25">
		  <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php if($row['itmtype'] == "good")  { echo "Good";} else{ echo "Damage";}?></td>
	      </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Original Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">UPS</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php

if($a=="good")
{
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$c."' and stlg_tritemid='".$f."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 }
 else
 {
 

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$c."' and stld_tritemid='".$f."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$f."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Changed Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">UPS</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sr=1;
$totups=0; $totqty=0;
$sql_sloc_sub=mysql_query("select * from tbl_sloc_sub where slocid='".$pid."' order by slocsubid") or die (mysql_error());

while($row_sloc_sub=mysql_fetch_array($sql_sloc_sub))
{

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc_sub['subbinid']."' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_sloc_sub['ups'];
$totqty=$totqty+$row_sloc_sub['qty'];

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['ups'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['ups'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
$sr++;
}
?>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><a href="edit_sloc_updation.php?pid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
