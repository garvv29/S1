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
	//$logid="opr1";
	//$lgnid="OP1";
	$tp="MD";
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	
/*	$sql_code="SELECT MAX(dd_code) FROM tbl_discard where yearcode='$yearid_id'  ORDER BY dd_code DESC";
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
		
		$sql_code1="SELECT MAX(ncode) FROM tbl_discard where yearcode='$yearid_id' ORDER BY ncode DESC";
		$res_code1=mysql_query($sql_code1)or die(mysql_error());
		
		if(mysql_num_rows($res_code1) > 0)
			{
				$row_code1=mysql_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode=$t_code1+1;
				$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode=sprintf("%004d",0001);
		}


	$sql_main="update tbl_discard set ddflg=1, dd_code=$code, ncode='$ncode'  where tid = '$pid'";

	$a123456=mysql_query($sql_main) or die(mysql_error());


	$sql_code="SELECT MAX(gpcode) FROM tbl_gate  where yearcode='$yearid_id' ORDER BY gpcode DESC";
	$rescode=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($rescode) > 0) 
			{
				$row_code=mysql_fetch_row($rescode);
				$t_code=$row_code['0'];
				$gpcode=$t_code+1;
			}	
		else
		{
			$gpcode=1;
			
		}
$cod="MD".$code;
$sql_gp="insert into tbl_gate (gpcode,trid) values('$gpcode','$cod')";
mysql_query($sql_gp) or die (mysql_error());

*/
	/*$sql_main1="update tbl_ieindent set flg=1  where tid = '$tid'";

	$a123=mysql_query($sql_main1) or die(mysql_error());
	*/

	if(isset($_POST['frm_action'])=='submit')
	{ 
	//exit;
			/*$printopt=$_POST['fet1'];
		
			if($printopt == "1" )
			{
				echo "<script>window.location='issue_dd_note.php?p_id=$pid'</script>";	
			}
			else if($printopt =="2")
			{
				echo "<script>window.location='bincard_dd_print.php?p_id=$pid&tp=MReturnV'</script>";	
			}
			else if($printopt=="3")
			{
			echo "<script>window.location='gatepass_dd.php'</script>";
			}	
			else
			{
				echo "Please Select Output Type.";	
			}*/
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transaction: Material Discard - Output Selection </title>
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

<script language="JavaScript">
function mySubmit()
{ 
	if(document.frmaddDepartment.fet1.value == "")
{
alert("Please select Output Type");
return false;
}
	return true;	 
}
function test1(fet11)
{
if (fet11!="")
{
document.frmaddDepartment.fet1.value=fet11;
}
}
function openslocpopprint()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('material_discard_note.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}
	

function openslocpopprint1()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('gatepass_dd.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}



function openprintbin(bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('bin_sloc_details_print.php?bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); bin_sloc_details_print
}

function openprintsubbin(subid, bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm=document.frmaddDepartment.txtitem.value;
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
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
          <td width="100%" valign="top"  align="center"  class="midbgline">

<!-- actual page start--->	
  
<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction: Material Discard - Output Selection </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
	  <td align="center" colspan="4" >
 <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
       <input name="frm_action" value="submit" type="hidden"> 
              <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
         <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
		 <table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Light" height="25">

    <td align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();">Material Discard Note (MDN)</a></td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Light" height="25">

    <td  align="center"  valign="middle" class="tblheading">&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint1();">Gate Pass</a></td>
</tr>
</table>
<?php

/*$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='$tp' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];
*/
?>

<?php
	

$sql_tbl=mysql_query("select * from tbl_stldg_damage where stld_trtype='Discard' and stld_trsubtype='MD' and stld_trid='".$pid."'") or die(mysql_error());
/*$row_tbl=mysql_fetch_array($sql_tbl);			
$issue_id=$row_tbl['issue_id'];
*/

?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin Status Sheet</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

//$sql_tbl_sub=mysql_query("select * from tblissue_sub where issue_id='".$issue_id."'") or die(mysql_error());

?>
  <tr class="tblsubtitle" height="25">
    <td width="39" align="center" class="tblheading" valign="middle">#</td>
	  <td width="194" align="center" class="tblheading" valign="middle">Classification</td>
    <td width="299" align="center" class="tblheading" valign="middle">Item</td>
    <td width="49" align="center" class="tblheading" valign="middle">UPS</td>
    <td width="58" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="97" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>

<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl))
{ 
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stld_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stld_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="39" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="194" align="center" valign="middle" class="tbltext"><?php echo $row_class['classification'];?></td>
    <td width="299" align="center" valign="middle" class="tbltext"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['stld_balups'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[stld_binid],$row_tbl_sub[stld_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stld_subbinid],$row_tbl_sub[stld_binid],$row_tbl_sub[stld_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td width="194" align="center" valign="middle" class="tbltext"><?php echo $row_class['classification'];?></td>
    <td width="299" align="center" valign="middle" class="tbltext"><?php echo $row_item['stores_item'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['stld_balups'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_tbl_sub[stld_binid],$row_tbl_sub[stld_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stld_subbinid],$row_tbl_sub[stld_binid],$row_tbl_sub[stld_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	<td width="97" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php	
}
$srno=$srno+1;
}
}
//}
//}
?>
</table>
       <!--<table align="center" border="1" width="314" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Select</td>
</tr>
<tr class="Light" height="25">

<td width="85"  align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="1" onClick="test1(this.value);" /></td>
    <td width="223" align="left"  valign="middle" class="tblheading">&nbsp;Material Discard Note Print</td>
</tr>
<tr class="Dark" height="25">
<td  align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="2" onClick="test1(this.value);" /></td>
 <td width="223" align="left"  valign="middle" class="tblheading">&nbsp;Bin Card Printing</td >
 </tr>
  <tr class="Light" height="25">
<td  align="right"  valign="left" class="tbltext">&nbsp;
  <input type="radio" name="fet" value="3" onClick="test1(this.value);" /></td>
 <td width="223" align="left"  valign="middle" class="tblheading">&nbsp;Gate Pass</td >
</table>-->
</p>
      <table align="center" width="314" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_discard.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;&nbsp;
  <input type="hidden" name="fet1" value="" /></td>	
</tr>
</table>
</form></td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
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
