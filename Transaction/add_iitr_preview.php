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
	//$yearid_id="09-10";
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
	if(isset($_GET['rettyp']))
	{
	$rettyp = $_GET['rettyp'];	 
	}
	
$itemqry111=mysql_query("select * from tbl_stores where items_id='".$itemid."'") or die(mysql_error());
$noticia111 = mysql_fetch_array($itemqry111);
$uom=$noticia111['uom'];
$sql_main="update tbl_iitr set  yearcode='$yearid_id', classification_id='$classid' , items_id_from='$itemid' , uom_from='$uom', remarks='$txtremarks', typ='$rettyp' where iitr_id='".$pid."'";

$a123456=mysql_query($sql_main) or die(mysql_error());

if(isset($_POST['frm_action'])=='submit')
	{
		
		
		$pid=trim($_POST['trid']);
		//$tid=trim($_POST['tid']);
		
		
	$sql_arr=mysql_query("select * from tbl_iitr where iitr_id='".$pid."'") or die(mysql_error());
	while($row_arr=mysql_fetch_array($sql_arr))
	{
		$trdate=$row_arr['tdate'];
	
	$sql_sub=mysql_query("SELECT sum(ups_to),sum(qty_to),rowid FROM `tbl_iitr_sub` where iitr_id='".$pid."' group by rowid") or die(mysql_error());
	while($row_sub=mysql_fetch_array($sql_sub))
	{
		$oups=$row_sub['0']; 
		$oqty=$row_sub['1']; 
		$rowid=$row_sub['2'];
	
		$sql_iss1=mysql_query("select * from tbl_stldg_good where stlg_id='".$rowid."'") or die(mysql_error());
		$row_iss1=mysql_fetch_array($sql_iss1); 
		
		$whid1=$row_iss1['stlg_whid'];
		$binid1=$row_iss1['stlg_binid'];
		$subbinid1=$row_iss1['stlg_subbinid'];
		$classid1=$row_iss1['stlg_trclassid'];
		$itemid1=$row_iss1['stlg_tritemid'];
		
		$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid1."' and stlg_binid='".$binid1."' and stlg_whid='".$whid1."' and stlg_tritemid='".$itemid1."'") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 
					
		$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 
		$row_issuetbl=mysql_fetch_array($sql_issuetbl);
		$opups1=$row_issuetbl['stlg_balups'];
		$opqty1=$row_issuetbl['stlg_balqty'];
		$balups1=$opups1-$oups;
		$balqty1=$opqty1-$oqty;
				
				$sql_sub_sub1="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('$yearid_id','IT', 'ITI', '$pid', '$trdate', '$classid1', '$itemid1', '$whid1', '$binid1', '$subbinid1', '$opups1', '$opqty1', '$oups', '$oqty', '$balups1', '$balqty1')";
				mysql_query($sql_sub_sub1) or die(mysql_error());
				
	
	
	
	$sql_itm=mysql_query("select * from tbl_stores where items_id='".$itemid1."' and srl_status='Yes'") or die (mysql_error());
		$t_itm=mysql_num_rows($sql_itm);
		if($t_itm > 0)
		{
			$row_itm=mysql_fetch_array($sql_itm);
			$tqty=0;
			$sql_is=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid!='".$itemid1."'") or die(mysql_error());
$cntg=0;
			while($row_is=mysql_fetch_array($sql_is))
 			{ 
			
			$sql_is1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_is['stlg_subbinid']."' and stlg_binid='".$row_is['stlg_binid']."' and stlg_whid='".$row_is['stlg_whid']."' and stlg_tritemid='".$itemid1."'") or die(mysql_error());		
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
			$sql_sub_sub="update tbl_stldg_good set orstatus='R' where stlg_tritemid='".$itemid1."' and stlg_balqty > 0";
			mysql_query($sql_sub_sub) or die(mysql_error());
			}
		}
	
	
				
	$sql_arrsub=mysql_query("select * from tbl_iitr_sub where iitr_id='".$pid."' and rowid='".$rowid."'") or die(mysql_error());
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
		$classid=$row_arrsub['classification_id'];
		$itemid=$row_arrsub['items_id'];
		$whid=$row_arrsub['whid'];
		$binid=$row_arrsub['binid'];
		$subbinid=$row_arrsub['subbinid'];
		$ups=$row_arrsub['ups_to'];
		$qty=$row_arrsub['qty_to']; 
	
	
	
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
				
		$sql_sub_sub="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('$yearid_id','IT', 'ITA', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
			
			
			
			
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
	}
}

			echo "<script>window.location='select_iitr_op.php?p_id=$pid'</script>";	
		
	}

/*$a="IT";
	$sql_code="SELECT MAX(code) FROM tbl_gtod   where yearcode='$yearid_id' ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code."/".$yearid_id;
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
<title>Stores -Transaction Inter Item Transaction- Preview</title>
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
winHandle=window.open('issue_iitr_print.php?&pid='+pid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
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
	$sql1=mysql_query("select * from tbl_iitr where iitr_id=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$trid=$pid; $erid=0;
	
	
	$classid=$row['classification_id'];
	$itemid=$row['items_id_from'];
	$rettyp=$row['typ'];
	
	$tdate=$row['tdate'];
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction -  Inter Item Transfer</td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
  	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="code" value="<?php echo $code;?>" />
	  <input type="hidden" name="rettyp" value="<?php echo $rettyp;?>" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
	   <input type="hidden" name="txtdate" value="<?php echo $tdate;?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="900" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Inter Item Transfer</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
 <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="260"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TIT".$row['tcode']."/".$yearid_id."/".$lgnid;;?></td>

<td width="90" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="225" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($quer3);
?>
		 <tr class="Dark" height="25">
           <td width="265"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?>&nbsp;</td>
         </tr>
<?php 
$itemqry=mysql_query("select * from tbl_stores where items_id='".$row['items_id_from']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
?> 
		<tr class="Light" height="25">
           <td width="265" height="24"  align="right"  valign="middle" class="tblheading">Items &nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="item" class="tbltext">&nbsp;<?php echo $noticia_item['stores_item'];?>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
            <td width="265" height="24"  align="right"  valign="middle" class="tblheading">UOM&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="uom" class="tbltext">&nbsp;<?php echo $noticia_item['uom'];?></td>
         </tr>
		 <tr class="Light" height="25">
            <td width="265" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="uom" class="tbltext">&nbsp;<?php echo ucwords($row['typ']);?></td>
         </tr>
</table><br />


<table align="center" border="1" width="900" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Stock in Hand</td>
  <td colspan="4" align="center" valign="middle" class="tblheading">Transfered to</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="20" align="center" valign="middle" class="tblheading">#</td>
<td width="100" align="center" valign="middle" class="tblheading">Classification</td>
<td width="199" align="center" valign="middle" class="tblheading">Item</td>
<td width="79" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="29" align="center" valign="middle" class="tblheading">UPS</td>
<td width="35" align="center" valign="middle" class="tblheading">Qty</td>
<td width="190" align="center" valign="middle" class="tblheading">Item</td>
<td width="83" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="29" align="center" valign="middle" class="tblheading">UPS</td>
<td width="35" align="center" valign="middle" class="tblheading">Qty</td>
<td width="29" align="center" valign="middle" class="tblheading">UPS</td>
<td width="46" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$classid."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid1=$row_class['classification'];

$sql_item=mysql_query("select * from tbl_stores where items_id='".$itemid."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid1=$row_item['stores_item'];


$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $classid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh1=""; $binn1=""; $subbinn1=""; $sups1="";$sqty1=""; $slocs1=""; $gd1=""; $balu=0; $balq=0; $subrid="";$itemid2="";$slups1="";$slqty1="";
$sql_sloc=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$row_issuetbl['stlg_id']."'") or die(mysql_error());
$zzz=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{ 

$slups1=0; $slqty1=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['iitrsub_id']; else $subrid=$row_sloc['iitrsub_id'];

$sql_item2=mysql_query("select * from tbl_stores where items_id='".$row_sloc['items_id']."'") or die(mysql_error());
$row_item2=mysql_fetch_array($sql_item2);
$itemid2=$row_item2['stores_item'];

//echo $row_sloc['whid']; echo $row_sloc['binid']; echo $row_sloc['subbinid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

if($slocs1!="")
$slocs1=$slocs1.$wareh1.$binn1.$subbinn1."<br/>";
else
$slocs1=$wareh1.$binn1.$subbinn1."<br/>";

$slups1=$slups1+$row_sloc['ups_to'];
if($sups1!="")
$sups1=$sups1.$slups1."<br/>";
else
$sups1=$slups1."<br/>";
$slqty1=$slqty1+$row_sloc['qty_to'];
if($sqty1!="")
$sqty1=$sqty1.$slqty1."<br/>";
else
$sqty1=$slqty1."<br/>";

$balu=$balu+$slups1;
$balq=$balq+$slqty1;
}
$balu=$row_issuetbl['stlg_balups']-$balu; 
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0){ if($balq <=0 ){$balu=0;} else{ $balu=1;}}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $itemid2;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $classid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh1=""; $binn1=""; $subbinn1=""; $sups1="";$sqty1=0; $slocs1=""; $gd1=""; $balu=0; $balq=0; $subrid="";$itemid2="";$slups1="";$slqty1="";
$sql_sloc=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$row_issuetbl['stlg_id']."'") or die(mysql_error());
$zzz=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{
$slups1=0; $slqty1=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['iitrsub_id']; else $subrid=$row_sloc['iitrsub_id'];

$sql_item2=mysql_query("select * from tbl_stores where items_id='".$row_sloc['items_id']."'") or die(mysql_error());
$row_item2=mysql_fetch_array($sql_item2);
$itemid2=$row_item2['stores_item'];


$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

if($slocs1!="")
$slocs1=$slocs1.$wareh1.$binn1.$subbinn1."<br/>";
else
$slocs1=$wareh1.$binn1.$subbinn1."<br/>";

$slups1=$slups1+$row_sloc['ups_to'];
if($sups1!="")
$sups1=$sups1.$slups1."<br/>";
else
$sups1=$slups1."<br/>";
$slqty1=$slqty1+$row_sloc['qty_to'];
if($sqty1!="")
$sqty1=$sqty1.$slqty1."<br/>";
else
$sqty1=$slqty1."<br/>";

$balu=$balu+$slups1;
$balq=$balq+$slqty1;
}
$balu=$row_issuetbl['stlg_balups']-$balu; 
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0){ if($balq <=0 ){$balu=0;} else{ $balu=1;}}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $itemid2;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
</tr>
 <?php
 }$srno++;
 }
 } 
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orowid" value="" />
</table>
<input type="hidden" name="trid" value="<?php echo $trid;?>" /><br />

<table align="center" border="1" width="900" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark">
<td width="92" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="752" align="left"  valign="middle" class="tbltext"><?php echo $row['remarks'];?></td>
</tr>
</table>
<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_iitr.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
