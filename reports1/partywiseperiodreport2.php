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
	
	/*if(isset($_GET['dept']))
	{
	 $dept = $_GET['dept'];	 
	}
	if(isset($_GET['monthf']))
	{
	 $monthf = $_GET['monthf'];	 
	}
	if(isset($_GET['montht']))
	{
	 $montht = $_GET['montht'];	 
	}
	if(isset($_REQUEST['month_year1']))
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
		
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report - Party Wise Period Report</title>
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
function openprint()
{
var pid=document.frmaddDepartment.pid.value; 
var sdate=document.frmaddDepartment.sdate.value; 
var cls=document.frmaddDepartment.txtclass.value;
var ite=document.frmaddDepartment.txtitem.value;
var edate=document.frmaddDepartment.edate.value;
//var ch=document.frmaddDepartment.chk.value;
winHandle=window.open('report_partywise.php?pid='+pid+'&sdate='+sdate+'&txtclass='+cls+'&txtitem='+ite+'&edate='+edate,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>

<body>
	<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
   
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Party wise Stock Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  <?php 
	$pid = $_GET['pid'];	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtitem'];
	$mtype = $_REQUEST['ret'];
	$pid = $_REQUEST['pid'];
	
	
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

if($_GET['txtclass'] != 'ALL')
	 {
	 $ss = "select classification from tbl_classification where classification_id='".$_GET['txtclass']."'";
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['classification'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }
	
	if($_GET['txtitem'] != 'ALL')
	 $s = "select * from tbl_stores where items_id = $itemid";
	else
	 $s = "select * from tbl_stores ";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			
			$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where p_id='$pid'"); 
 while($noticia = mysql_fetch_array($quer3)) { 
		 $p_name = $noticia['business_name'];
		 } 

//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tblempclaims  where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month between $monthf and $montht group by dept_id"),0); 
 	  
	  $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <= '$edate' and pldg_trdate >= '$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysql_query($sql) or die(mysql_error());  
	  ?>
	 <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="pid" value="<?php echo $pid?>" type="hidden"> 
	  <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	  <input name="edate" value="<?php echo $edate;?>" type="hidden"> 
	   <input name="txtclass" value="<?php echo $cid;?>" type="hidden"> 
	    <input name="txtitem" value="<?php echo $itemid;?>" type="hidden"> 
		 <input name="ret" value="<?php echo $mtype;?>" type="hidden"> 
		  <input name="chk" value="<?php echo $sloc;?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>

	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Party: <?php echo $p_name;?>&nbsp;&nbsp; Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?>&nbsp;<?php ?></td>
  </tr>
  
  </table>
 
 
 
 
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?> &nbsp;Item: <?php echo $stores_item?> UOM: <?php echo $uom?></td>
  </tr>
  </table>
  
  <table align="center" border="1" cellspacing="0" width="950" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
    <tr class="tblsubtitle" height="20">
      <td width="60" rowspan="4" align="center" valign="middle" class="tblheading">Date</td>
      <td width="226" rowspan="4" align="center" valign="middle" class="tblheading">&nbsp;Particulars</td>
	        <td align="center" rowspan="3" colspan="2" valign="middle" class="tblheading">Opening</td>
      <td colspan="12" align="center" valign="middle" class="tblheading">Receive</td>
	 <td colspan="2" rowspan="3" align="center" valign="middle" class="tblheading">Issue</td>
	   <td colspan="2" align="center" valign="middle" class="tblheading" rowspan="3" >Balance</td>
    </tr>
    <tr class="tblsubtitle">
      <td colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">DC</td>
      <td colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Good</td>
	  
      <td colspan="4" align="center" valign="middle" class="tblheading">Damage</td>
      <td width="50" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">Excess</td>
      <td width="52" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">Shortage</td>
      <td colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Net</td>
    </tr>
    <tr class="tblsubtitle">
      <td colspan="2" align="center" valign="middle" class="tblheading">Arrival Damage</td>
      <td  colspan="2" align="center" valign="middle" class="tblheading">Internal Damage </td>
    </tr>
    <tr class="tblsubtitle">
    	   <td width="30" align="center" valign="middle" class="tblheading">&nbsp;UPS</td>
	      <td width="35" align="center" valign="middle" class="tblheading">Qty</td>
      <td width="30" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="35" align="center" valign="middle" class="tblheading">Qty</td>
      <td width="30" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="35" align="center" valign="middle" class="tblheading">QTY</td>
      <td width="30" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="35" align="center" valign="middle" class="tblheading">QTY</td>
      <td width="30" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="35" align="center" valign="middle" class="tblheading">QTY</td>
      <td align="center" valign="middle" class="tblheading">Qty</td>
      <td align="center" valign="middle" class="tblheading">Qty</td>
      <td width="30" align="center" valign="middle" class="tblheading">Qty</td>
      <td width="35" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="30" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="35" align="center" valign="middle" class="tblheading">QTY</td>
	   <td width="30" align="center" valign="middle" class="tblheading">UPS</td>
      <td width="35" align="center" valign="middle" class="tblheading">QTY</td>
      </tr>
    
<?php 

$srno=1;
/*while($row = mysql_fetch_array($rs))
	{

$ty = $row['pldg_trtype'];
if($ty == "Arrival" || $ty == "Internal Party Damage" || $ty == "Gtod" || $ty == "I-MReturnV" )
{
$recups = $row['pldg_trdcups'];
$recqty = $row['pldg_trdcqty'];
$issups = ""; 
$issqty = "";
}
elseif($ty == "Arrival" || $ty == "Excess" || $ty == "DtoG" || $ty == "CIE" || $ty == "OP")

{
$issups = $row['pldg_trdcups'];
$issqty = $row['pldg_trdcqty'];
$recups = ""; 
$recqty = "";
}*/
while($row1 = mysql_fetch_array($rs))
	{
	$clsid = $row1['pldg_trclassid'];
	$itemid = $row1['pldg_tritemid'];
	
	
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
			
			$sql1 = "select * from tbl_party_ldg where pldg_tritemid = $itemid order by pldg_trdate ASC";
	 $rs1 = mysql_query($sql1) or die(mysql_error());

			
?>	
	
	
	
	
<?php



$rec_trdcups = "";
$rec_trdcqty = "";

$iss_trdcups = "";
$iss_trdcqty = "";


$op_trdcups = "";
$op_trdcqty = "";

$id_trdcups = "";
$id_trdcqty = "";

$perticulars="";
$date = $row1['pldg_trdate'];
$ty = $row1['pldg_trtype'];
$tysub = $row1['pldg_trsubtype'];

if(($ty == "Arrival") && ($tysub =="Vendor"))
{
$perticulars="Arrival from Party";
$rec_trdcups = $row1['pldg_trdcups'];
$rec_trdcqty = $row1['pldg_trdcqty'];
}
elseif(($ty == "Issue") && ($tysub =="MReturnV"))  
{
$perticulars="Material Return to Party";
$iss_trdcups = $row1['pldg_trdcups'];
$iss_trdcqty = $row1['pldg_trdcqty'];
}
elseif($ty == "OP")
{
$perticulars="Opening Stock";
$op_trdcups = $row1['pldg_trdcups'];
$op_trdcqty = $row1['pldg_trdcqty'];
}
elseif($ty == "GD")
{
$perticulars="Good to Damage - Party";
$id_trdcups = $row1['pldg_trdcups'];
$id_trdcqty = $row1['pldg_trdcqty'];
}

$goodups = $row1['pldg_trgoodups'];
$goodqty = $row1['pldg_trgoodqty'];
$damageups = $row1['pldg_trdamageups'];
$damageqty = $row1['pldg_trdamageqty'];

$pldg_trexqty = $row1['pldg_trexqty'];
$pldg_trshqty = $row1['pldg_trshqty'];
$pldg_trbalups = $row1['pldg_trbalups'];
$pldg_trbalqty = $row1['pldg_trbalqty'];


$tdate=$row1['pldg_trdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;


if($srno%2!=0)
{

?>
    <tr class="Light" height="20">
      <td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $perticulars;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $op_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $op_trdcqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $rec_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $rec_trdcqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $goodups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $goodqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $damageups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $damageqty;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $id_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $id_trdcqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trexqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trshqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $iss_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $iss_trdcqty;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trbalups;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trbalqty;?></td>
    </tr>
    <?php
}
else
{
?>
    <tr class="Dark" height="20">
      <td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $perticulars;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $op_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $op_trdcqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $rec_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $rec_trdcqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $goodups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $goodqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $damageups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $damageqty;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $id_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $id_trdcqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trexqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trshqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $iss_trdcups;?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $iss_trdcqty;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trbalups;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pldg_trbalqty;?></td>
    </tr>
    <?php
}
$srno++;
}
//}
?>
  </table>
  <table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="partywiseperiodreport.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;
  <img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /><input type="hidden" name="txtinv" /></td>
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
