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
if(isset($_GET['txtuom']))
	{
	$txtuom = $_GET['txtuom'];	 
	}
if(isset($_GET['txtclass']))
	{
	$classid = $_GET['txtclass'];	 
	}
if(isset($_GET['txtitem']))
	{
	$itemid = $_GET['txtitem'];	
	}
if(isset($_GET['txtremarks']))
	{
	$txtremarks = $_GET['txtremarks'];	 
	}
	
$rettyp="damage";

$sql_main="update tbl_dtog set  yearcode='$yearid_id', classification_id='$classid' , items_id='$itemid' , uom='$txtuom', remarks='$txtremarks' where did='".$pid."'";

$a123456=mysql_query($sql_main) or die(mysql_error());

if(isset($_POST['frm_action'])=='submit')
	{
		
		$pid=trim($_POST['trid']);
		
	$sql_arr=mysql_query("select * from tbl_dtog where did='".$pid."'") or die(mysql_error());
	while($row_arr=mysql_fetch_array($sql_arr))
	{
		$trdate=$row_arr['date'];
	
	$sql_sub=mysql_query("SELECT sum(ups),sum(qty),rowid FROM `tbl_dtog_sub` where did='".$pid."' group by rowid") or die(mysql_error());
	while($row_sub=mysql_fetch_array($sql_sub))
	{
		$oups=$row_sub['0']; 
		$oqty=$row_sub['1']; 
		$rowid=$row_sub['2'];
	
		$sql_iss1=mysql_query("select * from tbl_stldg_damage where stld_id='".$rowid."'") or die(mysql_error());
		$row_iss1=mysql_fetch_array($sql_iss1); 
		
		$whid1=$row_iss1['stld_whid'];
		$binid1=$row_iss1['stld_binid'];
		$subbinid1=$row_iss1['stld_subbinid'];
		$classid1=$row_iss1['stld_trclassid'];
		$itemid1=$row_iss1['stld_tritemid'];
		
		$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$subbinid1."' and stld_binid='".$binid1."' and stld_whid='".$whid1."' and stld_tritemid='".$itemid1."'") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 
					
		$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."'") or die(mysql_error()); 
		$row_issuetbl=mysql_fetch_array($sql_issuetbl);
		$opups1=$row_issuetbl['stld_balups'];
		$opqty1=$row_issuetbl['stld_balqty'];
		$balups1=$opups1;
		$balqty1=$opqty1-$oqty;
				
				$sql_sub_sub1="insert into tbl_stldg_damage (stld_trtype, stld_trsubtype, stld_trid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('DG', 'DG', '$pid', '$trdate', '$classid1', '$itemid1', '$whid1', '$binid1', '$subbinid1', '$opups1', '$opqty1', '$oups', '$oqty', '$balups1', '$balqty1')";
				mysql_query($sql_sub_sub1) or die(mysql_error());
if($balqty1 == 0)
{
				
$sql_issueg=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid1."' and stld_tritemid!='".$itemid1."'") or die(mysql_error());
$cntg=0;
while($row_issueg=mysql_fetch_array($sql_issueg))
 { 
	$sql_issueg1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issueg['stld_subbinid']."' and stld_binid='".$row_issueg['stld_binid']."' and stld_whid='".$row_issueg['stld_whid']."' and stld_tritemid!='".$itemid1."'") or die(mysql_error());
	$row_issueg1=mysql_fetch_array($sql_issueg1); 
	
	$sql_issuetblg=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issueg1[0]."' and stld_balqty > 0") or die(mysql_error()); 
	$totno=mysql_num_rows($sql_issuetblg);
	if($totnog > 0)
	{
	  $cntg++;
	} 
}				
				if($cntg == 0)
				{
				$sql_itmg="update tbl_subbin set status='Empty' where sid='$subbinid1'";
				mysql_query($sql_itmg) or die(mysql_error());
				}
			}
				
	$sql_arrsub=mysql_query("select * from tbl_dtog_sub where did='".$pid."' and rowid='".$rowid."'") or die(mysql_error());
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
		$classid=$row_arrsub['classification_id'];
		$itemid=$row_arrsub['items_id'];
		$whid=$row_arrsub['whid'];
		$binid=$row_arrsub['binid'];
		$subbinid=$row_arrsub['subbinid'];
		$ups=$row_arrsub['ups'];
		$qty=$row_arrsub['qty']; 
		$opups=0;
		$opqty=0;
	
	
		$sql_issue2=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$binid."' and stlg_whid='".$whid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
		$row_issue2=mysql_fetch_array($sql_issue2); 
					
		$sql_issuetbl2=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue2[0]."'") or die(mysql_error()); 
		$row_issuetbl2=mysql_fetch_array($sql_issuetbl2);
		$opups=$row_issuetbl2['stlg_balups'];
		$opqty=$row_issuetbl2['stlg_balqty'];
		if($opups > 0)
		$balups=$opups+$ups;
		else
		$balups=$ups;
		if($opqty > 0)
		$balqty=$opqty+$qty;
		else
		$balqty=$qty;
				
		$sql_sub_sub="insert into tbl_stldg_good (stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('DG', 'DG', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
			
			$sql_itm="update tbl_subbin set status='Good' where sid='$subbinid'";
			mysql_query($sql_itm) or die(mysql_error());	
				
		}
	}
}

	$sql_arrsub=mysql_query("select * from tbl_dtog where did='".$pid."'") or die(mysql_error());
	$row_arrsub=mysql_fetch_array($sql_arrsub);
		$classid=$row_arrsub['classification_id'];
		$itemid=$row_arrsub['items_id'];
		
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


	$s_chk=mysql_query("SELECT * FROM tbl_dtog where yearcode='$yearid_id'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(dcode) FROM tbl_dtog where yearcode='$yearid_id' ORDER BY dcode DESC";
	else
	$sql_code="SELECT MAX(dcode) FROM tbl_dtog ORDER BY dcode DESC";
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
		
		$s_chk=mysql_query("SELECT * FROM tbl_dtog where yearcode='$yearid_id'") or die (mysql_error());
		$r_chk=mysql_num_rows($s_chk);
		if($r_chk > 0)
		$sql_code1="SELECT MAX(ncode) FROM tbl_dtog where yearcode='$yearid_id' ORDER BY ncode DESC";
		else
		$sql_code1="SELECT MAX(ncode) FROM tbl_dtog ORDER BY ncode DESC";
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
		
	$sql_main="update tbl_dtog set dgflg=1, dcode=$code, ncode=$ncode  where did = '$pid'";

	$a123456=mysql_query($sql_main) or die(mysql_error());



			echo "<script>window.location='select_dg_op.php?p_id=$pid'</script>";	
		
	}

/*$a="DG";
	$sql_code="SELECT MAX(code) FROM tbl_dtog  where yearcode='$yearid_id' ORDER BY code DESC";
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
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transaction - Damage To Good- Preview</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="gdconv.js"></script>
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
<script type="text/javascript">

function openslocpopprint()
{

var pid=document.frmaddDepartment.trid.value;
winHandle=window.open('issue_dg_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function mySubmit()
{ 	
if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
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
  <?php
	$sql1=mysql_query("select * from tbl_dtog where did=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$trid=$pid; $erid=0;
	
	
	$classid=$row['classification_id'];
	$itemid=$row['items_id'];
	
	$tdate=$row['date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	?>  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Damage To Good</td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
  	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="code" value="<?php echo $code;?>" />
	  <input type="hidden" name="rettyp" value="good" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
	  <input type="hidden" name="txtdate" value="<?php echo $tdate;?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Damage To Good</td>
</tr>
<tr class="Dark" height="30">
 <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="260"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDG".$row['code']."/".$yearid_id."/".$lgnid;?></td>

<td width="90" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="225" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($quer3);
?>
		 <tr class="Light" height="25">
           <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?>&nbsp;</td>
         </tr>
<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
?> 
		<tr class="Dark" height="25">
           <td width="265" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle" id="item" class="tbltext">&nbsp;<?php echo $noticia_item['stores_item'];?>&nbsp;</td>
    
            <td width="265" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
           <td align="left"  valign="middle" id="uom" class="tbltext">&nbsp;<?php echo $row['uom'];?></td>
         </tr>
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
    <td colspan="4" align="center" valign="middle" class="tblheading">Damage Pre Transfer </td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Good Transfer</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Damage Post Transfer</td>
    <td colspan="2"  align="center" valign="middle" class="tblheading">Good Post Transfer</td>
    </tr>
  <tr class="tblsubtitle" height="25">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
    <td width="95" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="60" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="65" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="86" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="68" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="71" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="75" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="71" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
  $sloc1="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

$sloc1=$wareh1.$binn1.$subbinn1;


$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
$t=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['dgsubid']; else $subrid=$row_sloc['dgsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."<br/>";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."<br/>";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname']."<br/>";
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stld_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stld_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
$t=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['dgsubid']; else $subrid=$row_sloc['dgsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."<br/>";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."<br/>";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname']."<br/>";
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stld_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stld_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
</tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
</table>
<input type="hidden" name="trid" value="<?php echo $trid;?>" /><br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark">
<td width="92" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="752" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_dtog.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table></td><td width="30"></td>
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
