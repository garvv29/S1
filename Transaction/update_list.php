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
		
		$ciupdate=date("Y-m-d");
		
		$sql_ci="update tbl_ci set ci_upflg=1, ci_udate='$ciupdate' where ci_id='".$pid."'";
		if(mysql_query($sql_ci) or die(mysql_error()))
		{
			echo "<script>window.location='home_ci1.php'</script>";	
		}
	}



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Tranasaction-Update ci</title>
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
<script type="text/javascript">

function update(cuid)
{ //alert('HI'); 
winHandle=window.open('tr_ci_addremark.php?cuid='+cuid,'WelCome','top=170,left=180,width=700,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function opendetails(cuid)
{
winHandle=window.open('tr_ci_detailsremark.php?cuid='+cuid,'WelCome','top=170,left=180,width=480,height=180,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
 }
}

function mySubmit()
{
if(document.frmaddDepartment.recchk.value!=0)
{
 alert("The Cycle Inventory Updation has not been completed yet.\n Please complete the updation then submit this page.");
 return false;
}
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
              <ul style="vertical-align:text-top"> <li> <a href="adminprofile.php">Profile </a> | </li>
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
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
<!-- actual page start--->	
  
      <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="940" height="25" class="Mainheading" >&nbsp;Transaction - Cycle Inventory </td>
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
<?php
	
	$sql_sel1="select Distinct(items_id) from tbl_ciupdation where ci_id='".$pid."' order by ciu_id asc";
	$res1=mysql_query($sql_sel1) or die (mysql_error());
	
	$total1=mysql_num_rows($res1);
	
?>
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="692" style="border-collapse:collapse">
  <tr height="25" >
    <td width="692" colspan="8" align="center" class="subheading" style="color:#303918; ">Cycle Inventory Updation</td>
  </tr>
  </table>
<table align="center" width="900" border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="tblsubtitle" height="35">
            <td width="20" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			<td width="95" rowspan="2" align="center" valign="middle" class="tblheading">Classification </td>
			<td width="266" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			<td colspan="2" align="center" valign="middle" class="tblheading">Total</td>
			<td width="45" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			<td colspan="3" height="23" align="center" valign="middle" class="tblheading">Stock as per records </td>
			<td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock as per actuals</td>
			<td colspan="2" height="23" align="center" valign="middle" class="tblheading">Difference is Stock</td>
			<td width="52" rowspan="2" align="center" valign="middle" class="tblheading">Remarks</td>
			<td width="46" rowspan="2" align="center" valign="middle" class="tblheading">status</td>
</tr>
<tr class="tblsubtitle">
  <td width="35" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="36" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="60" align="center" valign="middle" class="tblheading">SLOC</td>
			<td width="35" align="center" valign="middle" class="tblheading">UPS </td>
			<td width="36" align="center" valign="middle" class="tblheading">Qty</td>
            <td width="35" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="36" align="center" valign="middle" class="tblheading">Qty</td>
			<td width="35" align="center" valign="middle" class="tblheading">UPS</td>
			<td width="36" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1;
if($total1 >0) { 	
while($row1=mysql_fetch_array($res1))
{	
	
	$sql_sel="select * from tbl_ciupdation where ci_id='".$pid."' and items_id='".$row1['items_id']."' order by ciu_id asc";
	$res=mysql_query($sql_sel) or die (mysql_error());
	//$total=mysql_num_rows($res);
	

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=""; $slqty=""; $chk=0; $uact=""; $uqty=""; $udif=""; $udiff=""; $totups=0; $totqty=0; $remarks=""; $status="";
while($row=mysql_fetch_array($res))
{
		
		$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
		$row_class=mysql_fetch_array($sql_class);
		
		$sql_item=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
		$row_item=mysql_fetch_array($sql_item);
		
		$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row['whid']."'") or die(mysql_error());
		$row_whouse=mysql_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";

		$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row['binid']."' ") or die(mysql_error());
		$row_binn=mysql_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";

		$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row['subbinid']."'") or die(mysql_error());
		$row_subbinn=mysql_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		if($slocs!="")
		$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
		else
		$slocs=$wareh.$binn.$subbinn."<br/>";
		
		if($slups!="")
		$slups=$slups.$row['ups_record']."<br/>";
		else
		$slups=$row['ups_record']."<br/>";
		if($slqty!="")
		$slqty=$slqty.$row['qty_record']."<br/>";
		else
		$slqty=$row['qty_record']."<br/>";

$totups=$totups+$row['ups_record'];
$totqty=$totqty+$row['qty_record'];

		
		$a=""; $s="";
		if($row['status']!=0)
		{
			
			if($uact!="")
				$uact=$uact.$row['ups_act']."<br/>";
			else
				$uact=$row['ups_act']."<br/>";
			
			if($uqty!="")
				$uqty=$uqty.$row['qty_act']."<br/>";
			else
				$uqty=$row['qty_act']."<br/>";
			
			$upd=$row['ups_act']-$row['ups_record'];
			$qtd=$row['qty_act']-$row['qty_record'];
			if($udif!="")
				$udif=$udif.$upd."<br/>";
			else
				$udif=$upd."<br/>";
			
			if($udiff!="")
				$udiff=$udiff.$qtd."<br/>";
			else
				$udiff=$qtd."<br/>";
				
			$a="<a href='javascript:void(0)' onClick='opendetails($row[ciu_id])'>Details</a>";
			$s="Done";	
		}
		else
		{
			/*$uact="";
			$uqty="";
			$udif="";
			$udiff="";*/
			$a="";	
			$s="<a href='javascript:void(0)' onClick='update($row[ciu_id])'>Update</a>";
		}
		//echo $s."<br>";
		if($remarks!="")
		$remarks=$remarks.$a."<br/>";
		else
		$remarks=$a."<br/>";
		
		if($status!="")
		$status=$status.$s."<br/>";
		else
		$status=$s."<br/>";
		
}	

		$upsrec=$slups;
		$qtyrec=$slqty;
		
		$upsact=$uact;
		$qtyact=$uqty;
		$upsdif=$udif;
		$qtydif=$udiff;
		
if($srno%2!=0)
{
?>
<tr class="Light" height="25">
            <td align="center" class="smalltbltext" valign="middle"><?php echo $srno;?></td>
            <td align="center" class="smalltbltext" valign="middle"><?php echo $row_class['classification'];?></td>
            <td align="center" class="smalltbltext" valign="middle"><?php echo $row_item['stores_item'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $totups;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
            <td align="center" class="smalltbltext" valign="middle"><?php echo $row_item['uom'];?></td>
			<td align="center" class="smalltbltext" valign="TOP"><?php echo $slocs;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $upsrec;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $qtyrec;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $upsact;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $qtyact;?></td>
			<td align="center" class="smalltbltext" valign="TOP"><?php echo $upsdif;?></td>
			<td align="center" class="smalltbltext" valign="TOP"><?php echo $qtydif;?></td>
			<td align="center" valign="TOP" class="tblheading"><?php echo $remarks;?></td>
			<td align="center" valign="TOP" class="tblheading"><?php echo $status;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
            <td align="center" class="smalltbltext" valign="middle"><?php echo $srno;?></td>
            <td align="center" class="smalltbltext" valign="middle"><?php echo $row_class['classification'];?></td>
            <td align="center" class="smalltbltext" valign="middle"><?php echo $row_item['stores_item'];?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $totups;?></td>
            <td align="center" valign="middle" class="smalltbltext"><?php echo $totqty;?></td>
            <td align="center" class="smalltbltext" valign="middle"><?php echo $row_item['uom'];?></td>
			<td align="center" class="smalltbltext" valign="TOP"><?php echo $slocs;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $upsrec;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $qtyrec;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $upsact;?></td>
            <td align="center" class="smalltbltext" valign="TOP"><?php echo $qtyact;?></td>
			<td align="center" class="smalltbltext" valign="TOP"><?php echo $upsdif;?></td>
			<td align="center" class="smalltbltext" valign="TOP"><?php echo $qtydif;?></td>
			<td align="center" valign="TOP" class="tblheading"><?php echo $remarks;?></td>
			<td align="center" valign="TOP" class="tblheading"><?php echo $status;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}


	$sql_chk="select * from tbl_ciupdation where ci_id='".$pid."' and status=0";
	$res_chk=mysql_query($sql_chk) or die (mysql_error());
	
	$total_chk=mysql_num_rows($res_chk);
?>
</table>
<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="select_ci.php?p_id=<?php echo $pid;?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:hand;" onclick="return mySubmit();"><input type="hidden" name="recchk" value="<?php echo $total_chk;?>" /></td>
</tr>
</table>
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
