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
	//$logid="admin";
	//$lgnid="admin";
	
		
	if(isset($_REQUEST['p_id']))
	{
	 $pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	/*$sql_arr=mysql_query("select * from tblarrival where arrival_id='".$pid."'") or die(mysql_error());
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
		{   // $whid=$row_arrsub_sub['type'];
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
				
				$sql_sub_sub="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trpartyid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('$yearid_id','Arrival', 'op', '$pid', '$partyid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
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
				
				$sql_sub_sub="insert into tbl_stldg_damage (stld_trtype, stld_trsubtype, stld_trid, stld_trpartyid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('Arrival', 'op', '$pid', '$partyid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups1', '$qty1', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
			}	
		}
	}
}
		//}
			*/
		}
		//}
	//}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transaction-Preview Stock Admin</title>
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

</script>
<script type="text/javascript">
function stock()
{
//if(document.frmaddDepartment.txtitem.value!="")
//{
//var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('open_print.php','WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
//}
}
/*else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}*/
}

</script>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  >
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
            <ul  id="nav">
			 <?php
			  if($role == "admin")
			  {
			  ?>
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
			<?php
			}
			else
			{
			?>
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
			<?php
			}
			?>
            <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
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
              <ul style="vertical-align:text-top"> <li><a href="adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li> <li> &nbsp;<a href="../logout.php">Logout </a> </li>
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
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Opening Stock Admin Preview </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<?php 
$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='op' and arrival_id='".$pid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add  Opening stock Admin </td>
</tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
      <td width="225" height="24"  align="right"  valign="middle" class="tblheading">Transction ID&nbsp;</td>
      <td width="619" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "OP".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid?></td>
     
	  <td width="141" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
      <td width="191" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo date("d-m-Y");?></td>
</tr>
<?php 
//}
$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());
$row_tbl_sub=mysql_fetch_array($sql_tbl_sub);

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);


//$classqry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
<tr class="Light" height="25">
			<td width="225"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td width="619"  align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_class['classification'];?></td>
</tr>

<tr class="Dark" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td align="left" valign="left" class="tbltext" >&nbsp;<?php echo $row_item['stores_item'];?></td>
		
<td width="141" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="191" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<?php echo $row_item['uom'];?></td>
</tr>

<tr class="Dark" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl_sub['type'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl_sub['ups_good'];?></td>
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl_sub['qty_good'];?></td>
</tr>

<tr class="Dark" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl_sub['noofbin_good'];?></td>
</tr>
</table>
<br/>
<?php
$sql_sub_sloc=mysql_query("select * from tblarr_sloc where arr_id='".$row_tbl_sub['arrsub_id']."' and arr_tr_id='".$arrival_id."' and qty_damage=0 and ups_damage=0") or die(mysql_error());
$tot_sub_sloc=mysql_num_rows($sql_sub_sloc);
$flash=0;
while($row_sub_sloc=mysql_fetch_array($sql_sub_sloc))
{
if($flash==0)
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."'") or die(mysql_error());
$noticia_whg1 = mysql_fetch_array($whg1_query);
?>
<tr class="Light" height="30" >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin where binid='".$row_sub_sloc['binid']."'") or die(mysql_error());
$noticia_bing1 = mysql_fetch_array($bing1_query);
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No.&nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<?php echo $noticia_bing1['binname'];?></td>

<?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."'") or die(mysql_error());
$noticia_subbing1 = mysql_fetch_array($subbing1_query)
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No.&nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<?php echo $noticia_subbing1['sname'];?></td>
<td width="300"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" ><tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['ups_good'];?></td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['qty_good'];?></td>
</tr></table></div></td>
</tr>
</table>

<?php
}
else if($flash==1)
{

$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."'") or die(mysql_error());
$noticia_whg2 = mysql_fetch_array($whg2_query);
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg2['perticulars'];?></td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin where binid='".$row_sub_sloc['binid']."'") or die(mysql_error());
$noticia_bing2 = mysql_fetch_array($bing2_query);
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No.&nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing2">&nbsp;<?php echo $noticia_bing2['binname'];?></td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."'") or die(mysql_error());
$noticia_subbing2 = mysql_fetch_array($subbing2_query);
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No.&nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing2">&nbsp;<?php echo $noticia_subbing2['sname'];?></td>
<td width="300"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="48" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['ups_good'];?></td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['qty_good'];?></td>
</tr></table></div></td>
</tr>
</table>
<?php
}
else if($flash==2)
{

$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."'") or die(mysql_error());
$noticia_whg3 = mysql_fetch_array($whg3_query);
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg3['perticulars'];?></td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin where binid='".$row_sub_sloc['binid']."'") or die(mysql_error());
$noticia_bing3 = mysql_fetch_array($bing3_query);
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No.&nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bing3">&nbsp;<?php echo $noticia_bing3['binname'];?></td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."'") or die(mysql_error());
$noticia_subbing3 = mysql_fetch_array($subbing3_query);
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No.&nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbing3">&nbsp;<?php echo $noticia_subbing3['sname'];?></td>
		
<td width="305"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['ups_good'];?></td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['qty_good'];?></td>
</tr></table></div></td>
</tr>
</table>
<?php
}
$flash++;
}
?>

<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	 <table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_openstock.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;</td>
</tr>
</table> 
	  </td>
	  </tr>
	  </table><!-- actual page end--->			  
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

