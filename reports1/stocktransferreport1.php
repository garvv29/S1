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
	
	
	$y=split("-",$yearid_id);
	$y1="20".$y[0];
	$y2="20".$y[1];
	
	if(isset($_GET['monthf']))
	{
	 $monthf = $_GET['monthf'];	 
	}
	
	if($monthf <=12 && $monthf >=4)
	{
	$monthf=sprintf("%02d",$monthf);
	$sdate=$y1."-".$monthf."-"."01";
	}
	else
	{
	$monthf=sprintf("%02d",$monthf);
	$sdate=$y2."-".$monthf."-"."01";
	}
	
	if(isset($_GET['montht']))
	{
	 $montht = $_GET['montht'];	 
	}
	if($montht <=12 && $montht >=4)
	{
	$montht=sprintf("%02d",$montht);
	$edate=$y1."-".$montht."-"."01";
	}
	else
	{
	$montht=sprintf("%02d",$montht);
	$edate=$y2."-".$montht."-"."01";
	}
	
	$pid = $_GET['pid'];	
	/*if(isset($_REQUEST['month_year1']))
	{
	 $month_year1 = $_REQUEST['month_year1'];	 
	}
	if(isset($_REQUEST['month_year2']))
	{
	 $month_year2 = $_REQUEST['month_year2'];	 
	}
	if(isset($_GET['flg']))
	{
	 $flg = $_GET['flg'];	 
	}
	if(isset($_GET['flg1']))	
	{
	 $flg1 = $_GET['flg1'];	 
	}
	*/
		if(isset($_POST['frm_action'])=='submit')
		{ /*
		$dept=trim($_POST['department']);
		$monthf=trim($_POST['monthf']);
		$montht=trim($_POST['montht']);
		
		echo "<script>window.location='deptcomposite1.php?dept=$dept&monthf=$monthf&montht=$montht'</script>";	*/
		}
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where p_id=$pid"); 
 while($noticia = mysql_fetch_array($quer3)) { 
		 $p_name = $noticia['business_name'];
		 } 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report -Stocktransfer</title>
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
<SCRIPT language="JavaScript">

function openprint()
{
//var dateto=document.frmaddDept.dateto.value;
//var datefrom=document.frmaddDept.datefrom.value;
winHandle=window.open('report_stocktr.php?pid=<?php echo $pid;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>','WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>

<body><table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  
<!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <?php
	
	
	$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;
		
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25">Stock Transfer Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>

<?php 
//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tblempclaims  where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month between $monthf and $montht group by dept_id"),0); 
 	   $sql = "select * from tbl_stldg_good where stlg_trpartyid = $pid and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' order by stlg_trdate ASC";
	 $rs = mysql_query($sql) or die(mysql_error());	  
	  
	  
	  ?>
	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Plant:<?php echo $p_name;?>&nbsp;&nbsp;Date From: <?php echo $_REQUEST['sdate'];?> To <?php echo $_REQUEST['edate'];?>&nbsp;<?php ?></td>
  </tr>
  </table>
  <table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="35">
			<td align="center" valign="middle" class="tblheading" rowspan="2">Date</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Classification</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Item</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">UoM</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Transfer</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Receive</td>
</tr>
<tr class="tblsubtitle" height="35">
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
</tr>
<?php
$srno=1;
while($row = mysql_fetch_array($rs))
	{
	$clsid = $row['stlg_trclassid'];
	$itemid = $row['stlg_tritemid'];
	
	
			 $ss = "select classification from tbl_classification where classification_id = $clsid";
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['classification'];
			 
			 
			 
			 $s = "select * from tbl_stores where items_id = $itemid";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			
			$sql1 = "select * from tbl_stldg_good where stlg_tritemid = $itemid order by stlg_trdate DESC";
	 $rs1 = mysql_query($sql1) or die(mysql_error());
	$stlg_trdate = $row['stlg_trdate'];
	
	
	$ty = $row['stlg_trtype'];
$tysub = $row['stlg_trsubtype'];
if(($ty == "Arrival") && ($tysub =="Stocktransfer"))
{
$recups = $row['stlg_trups'];
$recqty = $row['stlg_trqty'];
$issups = ""; 
$issqty = "";
}
elseif(($ty == "Issue") && ($tysub =="stocktr"))  
{
$issups = $row['stlg_trups'];
$issqty = $row['stlg_trqty'];
$recups = ""; 
$recqty = "";
}	
	
	$tdate=$row['stlg_trdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;	
	
	if($row['stlg_trqty'] > 0)
	{
	if ($srno%2 != 0)
	{
?>		
			
			



<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $cls?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty?></td>
</tr>
<?php
}
else
{
?>

<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $cls?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty?></td>
</tr>
<?php
}
$srno=$srno+1; 
}
}
?>
</table>			

	
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="stocktransferreport.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/printpreview.gif" alt="Submit Value" OnClick="openprint()" border="0" style="display:inline;cursor:hand;" tabindex="19"><input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td ></td>
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
