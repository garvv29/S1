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
		/*$id=trim($_POST['txtsid']);
		$perticulars=trim($_POST['txtperticulars']);
			
		
	$query=mysql_query("SELECT * FROM tbl_warehouse where perticulars='$perticulars'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Perticulars is Already Present.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tblclassification(classification) values(
											  $class'
												)";
											
		if(mysql_query($sql_in)or die(mysql_error()))
		{*/
			echo "<script>window.location='reorder.php'</script>";	
		}
		//}
	//}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction -Print ci</title>
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="940" height="25" class="Mainheading" >&nbsp;Transaction - Pending Cycle Inventory </td>
	    </tr></table></td>
	 
	  	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Print of CI List (<?php //=$total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="900" bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="35">
             <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Classification </td>
			 <td width="27%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			 <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			 <td colspan="3" height="23" align="center" valign="middle" class="tblheading">Stock as per records </td>
			 <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock as per actuals</td>
			 <td colspan="3" height="23" align="center" valign="middle" class="tblheading">Difference is Stock</td>
			 <td width="12%" rowspan="2" align="center" valign="middle" class="tblheading">Remarks</td>
</tr>
<tr class="tblsubtitle">
			 
			<td width="10%" align="center" valign="middle" class="tblheading">SLOC1 </td>
			<td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
            <td width="5%"  colspan="1" rowspan="" align="center" valign="middle" class="tblheading">Qty</td>
            <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
			<td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
			<td width="7%" align="center" valign="middle" class="tblheading">Date of CI</td>
</tr>
<?php
$srno=1;

$sql_ci=mysql_query("select * from tbl_ci where ci_id='".$pid."'") or die(mysql_error());

while($row_ci=mysql_fetch_array($sql_ci))
{
	$p_array="";
if($row_ci['classification_id'] == "ALL")
{ 
	$sql_cls=mysql_query("select classification_id from tbl_classification") or die(mysql_error());
	while($row_cls=mysql_fetch_array($sql_cls))
	{
	if($p_array!="")
	$p_array=$p_array.",".$row_cls[0];
	else
	$p_array=$row_cls[0];
	}
}
else
{
	$p_array=$row_ci['classification_id'];
}

$p1_array=explode(",",$p_array);

	foreach($p1_array as $val1)
	{
	 	if($val1<>"")
	 	{	
		$sql_class=mysql_query("select * from tbl_classification where classification_id='".$val1."'") or die(mysql_error());
		$row_class=mysql_fetch_array($sql_class);
		
		
		
		$sql_item=mysql_query("select * from tbl_stores where classification_id='".$val1."'") or die(mysql_error());
		while($row_item=mysql_fetch_array($sql_item))
		{
		
		$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=""; $slqty=""; $chk=0;
		$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$val1."' and stlg_tritemid='".$row_item['items_id']."'") or die(mysql_error());
		
while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

$tot_issuetbl=mysql_num_rows($sql_issuetbl);
/*if($tot_issuetbl > 0)
 $chk++*/;
 
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issue['stlg_binid']."' ") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issue['stlg_subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($slups!="")
$slups=$slups.$row_issuetbl['stlg_balups']."<br/>";
else
$slups=$row_issuetbl['stlg_balups']."<br/>";
if($slqty!="")
$slqty=$slqty.$row_issuetbl['stlg_balqty']."<br/>";
else
$slqty=$row_issuetbl['stlg_balqty']."<br/>";
}
}

/*if($chk > 0)
{*/
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
            <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_class['classification'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['stores_item'];?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['uom'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
            <td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_class['classification'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['stores_item'];?></td>
			<td align="center" valign="middle" class="smalltbltext"><?php echo $row_item['uom'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
			<td align="center" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
<?php	
}
$srno=$srno+1;
}
}
}
}
//}
?>
</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_ci1.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;</td>
</tr>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='750' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; 
//}*/

?>
</td>
<td width="30"></td>
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
