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
		
	$sql_arr=mysql_query("select * from tbl_excess where tid='".$pid."'") or die(mysql_error());
	while($row_arr=mysql_fetch_array($sql_arr))
	{
	$trdate=$row_arr['tdate'];
	$classid=$row_arr['classification_id'];
	$itemid=$row_arr['items_id'];
	$typ=$row_arr['typ'];
	
	$sql_arrsub=mysql_query("select * from tbl_excess_sub where esid='".$pid."'") or die(mysql_error());
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
			$whid=$row_arrsub['whid'];
			$binid=$row_arrsub['binid'];
			$subbinid=$row_arrsub['subbinid'];
			$upse=$row_arrsub['upsex'];
			$qtye=$row_arrsub['qtyex'];
			$upss=$row_arrsub['upssh'];
			$qtys=$row_arrsub['qtysh'];
			
			if($typ == "good")
			{
			$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$binid."' and stlg_whid='".$whid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
			$row_issue1=mysql_fetch_array($sql_issue1); 
					
			$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
			$row_issuetbl=mysql_fetch_array($sql_issuetbl);
			$opups=$row_issuetbl['stlg_balups'];
			$opqty=$row_issuetbl['stlg_balqty'];
			if($upse == 0 && $qtye == 0)
			{
				$balups=$opups-$upss;
				$balqty=$opqty-$qtys;
				$ups=$upss;
				$qty=$qtys;
				
				$sql_sub_sub="insert into tbl_stldg_good (stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('ES', 'SH', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
			}
			else
			{
				$balups=$opups+$upse;
				$balqty=$opqty+$qtye;
				$ups=$upse;
				$qty=$qtye;
				
			$sql_sub_sub="insert into tbl_stldg_good (stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('ES', 'ES', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
			}
				mysql_query($sql_sub_sub) or die(mysql_error());
			}
			else
			{
			$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$subbinid."' and stld_binid='".$binid."' and stld_whid='".$whid."' and stld_tritemid='".$itemid."'") or die(mysql_error());
			$row_issue1=mysql_fetch_array($sql_issue1); 
					
			$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
			$row_issuetbl=mysql_fetch_array($sql_issuetbl);
			$opups=$row_issuetbl['stld_balups'];
			$opqty=$row_issuetbl['stld_balqty'];
			if($upse == 0 && $qtye == 0)
			{
				$balups=$opups-$upss;
				$balqty=$opqty-$qtys;
				$ups=$upss;
				$qty=$qtys;
				
				$sql_sub_sub="insert into tbl_stldg_damage (stld_trtype, stld_trsubtype, stld_trid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('ES', 'SH', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
			}
			else
			{
				$balups=$opups+$upse;
				$balqty=$opqty+$qtye;
				$ups=$upse;
				$qty=$qtye;
				
			$sql_sub_sub="insert into tbl_stldg_damage (stld_trtype, stld_trsubtype, stld_trid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('ES', 'ES', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
			}
				mysql_query($sql_sub_sub) or die(mysql_error());
			}
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
	
	$s_chk=mysql_query("SELECT * FROM tbl_excess where yearcode='$yearid_id'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(escode) FROM tbl_excess where yearcode='$yearid_id' ORDER BY escode DESC";
	else
	$sql_code="SELECT MAX(escode) FROM tbl_excess ORDER BY escode DESC";
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
		
		$s_chk=mysql_query("SELECT * FROM tbl_excess where yearcode='$yearid_id'") or die (mysql_error());
		$r_chk=mysql_num_rows($s_chk);
		if($r_chk > 0)
		$sql_code1="SELECT MAX(ncode) FROM tbl_excess where yearcode='$yearid_id' ORDER BY ncode DESC";
		else
		$sql_code1="SELECT MAX(ncode) FROM tbl_excess ORDER BY ncode DESC";
		$res_code1=mysql_query($sql_code1)or die(mysql_error());
		
		if(mysql_num_rows($res_code1) > 0)
		{
				$row_code1=mysql_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode=$t_code1+1;
				//$ncode=sprintf("%004d",$ncode);
		}
		else
		{
				$ncode=1;
		}
		
	$sql_main="update tbl_excess set esflg=1, escode=$code, ncode='$ncode'  where tid = '$pid'";

	$a123456=mysql_query($sql_main) or die(mysql_error());

	
	
			echo "<script>window.location='select_es_op.php?p_id=$pid'</script>";
}


/*$sql_code="SELECT MAX(code) FROM tbl_excess ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="ES".$code."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="ES".$code."/".$lgnid;
		}	*/
		

	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transaction - Excess Shortage-Preview</title>
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

<script src="exsh.js"></script>
<script type="text/javascript">
	

function mySubmit()
{
if(document.frmaddDept.date.value=="00-00-0000" || document.frmaddDept.date.value=="")
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
              <ul style="vertical-align:text-top"><li> <a href="adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>  <li> &nbsp;<a href="../logout.php">Logout </a> </li>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Excess/Shortage </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
   <?php
   $sql1=mysql_query("select * from tbl_excess where tid='".$pid."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$c=$row['classification_id'];
$f=$row['items_id'];
$tid=0; $subtid=0;
?>
	  
	  <td align="center" colspan="4" >
	  
		<form  id="mainform"name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	 	<input name="frm_action" value="submit" type="hidden"> <br />
	  	<input type="hidden" name="code" value="<?php echo $row['code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
 		<input name="rettyp" value="" type="hidden"> 
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
  
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Excess/Shortage </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="25">
 <td width="157" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="347"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "ES".$row['code']."/".$yearid_id?></td>

 <td width="85" height="24"  align="right"  valign="middle" class="tblheading">Ex/Sh&nbsp;Date&nbsp;</td>
<td width="151" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($quer3);
$trid=0;$rid=0;
?>
		 <tr class="Light" height="25">
           <td width="157"  align="right"  valign="middle" class="tblheading">&nbsp;Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $noticia_class['classification'];?></td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
?> 
		<tr class="Dark" height="25">
           <td width="157" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle" class="tbltext" id="item">&nbsp;<?php echo $noticia_item['stores_item'];?></td>
         
		 <?php 
$itemqry1=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$row_itm=mysql_fetch_array($itemqry1);
?> 
		
            <td width="85" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
           <td align="left"  valign="middle" class="tbltext" id="uom">&nbsp;<?php echo $row_itm['uom'];?></td>
         </tr>
		 
<tr class="Light" height="25">
 <td width="157" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
 <td align="left"  valign="middle" colspan="5">&nbsp;<?php echo $row['typ'];?></td>
         </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" valign="middle" class="tblheading">Pre Excess/Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Excess</td>
  <td align="center" colspan="2" valign="middle" class="tblheading">Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Post Ex/Sh Balance</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="66" align="center" valign="middle" class="tblheading">#</td>
<td width="112" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="50" align="center" valign="middle" class="tblheading">UPS</td>
<td width="88" align="center" valign="middle" class="tblheading">Qty</td>
<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
<td width="73" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="63" align="center" valign="middle" class="tblheading">Qty</td>
<td width="76" align="center" valign="middle" class="tblheading">UPS</td>
<td width="65" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php

$sql_issue=mysql_query("select * from tbl_excess_sub where esid='".$pid."'") or die(mysql_error());

$srno=1;

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$wareh=""; $binn=""; $subbinn=""; $sups=0;$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issue['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issue['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issue['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

if($row_issue['upsex'] == 0 && $row_issue['qtyex']==0)
{
$sups=$row_issue['balups'] + $row_issue['upssh'];
$sqty=$row_issue['balqty'] + $row_issue['qtysh'];
}
else 
{
$sups=$row_issue['balups'] - $row_issue['upsex'];
$sqty=$row_issue['balqty'] - $row_issue['qtyex'];
}
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upsex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtyex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upssh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtysh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upsex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtyex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upssh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtysh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balqty'];?></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 ?>
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="69" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="675" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_exsh.php?p_id=<?php echo $pid;?>" tabindex="20"><img src="../images/edit.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<!--<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;--><input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
