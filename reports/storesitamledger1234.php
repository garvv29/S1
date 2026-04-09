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
	
		if(isset($_POST['frm_action'])=='submit')
		{
		
		}
	
	$pid = $_GET['pid'];	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtitem'];
	$mtype = $_REQUEST['ret'];
		
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report - Stores Item Ledger Report</title>
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
winHandle=window.open('report_itemledger.php?pid=<?php echo $pid;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>&txtclass=<?php echo $cid;?>&txtitem=<?php echo $itemid;?>&ret=<?php echo $mtype;?>','WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
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
          <td width="100%" valign="top"  align="center"  class="midbgline">
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

if($_GET['txtclass'] != 'ALL')
	 {
	 $ss = "select classification from tbl_classification where classification_id=".$_GET['txtclass'];
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['classification'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }
	 
	 $s = "select * from tbl_stores where items_id = $itemid";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			
			
/*$quer2=mysql_query("SELECT DISTINCT dept_name,dept_id FROM tbldept where dept_id='$dept'"); 
$row_dept=mysql_fetch_array($quer2);
	
		$sql_month=mysql_query("select * from tblmonth where month_act_id='$monthf'")or die("Error:".mysql_error());
		$row_month=mysql_fetch_array($sql_month);
		$a=$row_month['month_id'];
		//$month_year1=$row_month['month_year'];	
		
		
		$sql_month=mysql_query("select * from tblmonth where month_act_id='$montht'")or die("Error:".mysql_error());
		$row_month=mysql_fetch_array($sql_month);
		$b=$row_month['month_id'];
		//$month_year2=$row_month['month_year'];	*/
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Stores Item Ledger Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php 
//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tblempclaims  where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month between $monthf and $montht group by dept_id"),0); 
 	 /*$sql = "select * from tbl_stldg_damage where stlg_trdate <= '2009-06-23' and stlg_trdate >= '2009-06-16' order by stlg_trdate DESC";*/
	
	if($mtype == 'Good')
	{
	$snn=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$cid."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' ") or die(mysql_error());
$tot_m=mysql_num_rows($snn);
$cnt1=0; $sbid="";
while($sn=mysql_fetch_array($snn))
{
$cnt1++;
if($sbid!="")
$sbid=$sbid.",".$sn['stlg_subbinid'];
else
$sbid=$sn['stlg_subbinid'];
}
	$sql = "select * from tbl_stldg_good where  stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' and stlg_trclassid =".$cid."  and stlg_tritemid =".$itemid." group by stlg_trdate order by stlg_trdate asc";
	 $rs = mysql_query($sql) or die(mysql_error());	  
	 ?>
	  	<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">&nbsp;&nbsp; Date: From <?php echo $_GET['sdate'];?> to <?php echo $_GET['edate'];?>&nbsp;<?php ?></td>
  </tr>
  </table>
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?> &nbsp;Item: <?php echo $stores_item?> UoM: <?php echo $uom?></td>
  </tr>
  </table>
  <table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading" rowspan="2">Date</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Particulars</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Receive</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Issue</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Balance</td>
</tr>
<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
</tr>
<?php 
$srno=1;
while($row = mysql_fetch_array($rs))
	{
$dt=$row['stlg_trdate'];

//echo $sbid;
$ff=split(",",$sbid);
$sql_new=mysql_query("select * from tbl_stldg_good where stlg_trdate='".$dt."' and stlg_tritemid ='".$itemid."' and stlg_balqty >= 0 group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid order by stlg_id asc") or die(mysql_error());
while($row_new=mysql_fetch_array($sql_new))
{
$totups=0; $totqty=0; $totoups=0; $totoqty=0;
$cnt=0;  $rtotalups=0; $rtotalqty=0; $rcups=0;$rcqty=0;

$rups=0; $rqty=0; $orups=0; $orqty=0;
foreach($ff as $fid)
{	//echo $fid."<br>";
	if($fid!="")
	{ 
	
$sql_new123=mysql_query("select * from tbl_stldg_good where stlg_trdate='$dt' and stlg_tritemid ='$itemid' and stlg_subbinid ='$fid' and stlg_balqty >= 0 and stlg_trid='".$row_new['stlg_trid']."' order by stlg_id asc") or die(mysql_error());
$ttt=mysql_num_rows($sql_new123);//echo $fid."  -  ".$ttt."  -  ";
if($ttt > 0)
{
	while($row_new123=mysql_fetch_array($sql_new123))
	{
		$rups=$rups+$row_new123['stlg_balups'];
		$rqty=$rqty+$row_new123['stlg_balqty'];
		$orups=$orups+$row_new123['stlg_opups'];
		$orqty=$orqty+$row_new123['stlg_opqty'];
		$rcups =$rcups+$row_new123['stlg_trups'];
		$rcqty =$rcqty+$row_new123['stlg_trqty'];
	}
}
else
{
	$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$fid."' and stlg_tritemid='".$itemid."' and stlg_trdate<='$dt'") or die(mysql_error());
	$row_issue1=mysql_fetch_array($sql_issue1); 
	
	$sql_new1=mysql_query("select * from tbl_stldg_good where stlg_tritemid ='$itemid' and stlg_id ='".$row_issue1[0]."' and stlg_balqty >= 0 order by stlg_id asc") or die(mysql_error());
	$ttt1=mysql_num_rows($sql_new1);
	while($row_new1=mysql_fetch_array($sql_new1))
	{
		$rups=$rups+$row_new1['stlg_balups'];
		$rqty=$rqty+$row_new1['stlg_balqty'];
		$orups=$orups+$row_new1['stlg_opups'];
		$orqty=$orqty+$row_new1['stlg_opqty'];
		/*$rcups =$rcups+$row_new1['stlg_trups'];
		$rcqty =$rcqty+$row_new1['stlg_trqty'];*/
	}
}
//echo $rqty."<BR";
}
}

/*$sql_new=mysql_query("select stlg_trdate, stlg_trtype, stlg_trsubtype, sum(stlg_trups),sum(stlg_trqty),sum(stlg_balups),sum(stlg_balqty),sum(stlg_opups),sum(stlg_opqty), stlg_trid from tbl_stldg_good where stlg_trdate='$dt' and stlg_tritemid ='$itemid' and stlg_balqty >= 0 group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid order by stlg_id asc") or die(mysql_error());
while($row_new=mysql_fetch_array($sql_new))
{*/

$cn=0;
$ty = $row_new['stlg_trtype'];
$tysub = $row_new['stlg_trsubtype'];
//echo $row_new[6]."<br>";
$totups=$rups;
$totqty=$rqty;

$totoups=$orups;
$totoqty=$orqty;
//echo $ty."  -  ".$tysub."  -  ".$row_new['stlg_trdate']."<br>";
if(($ty == "Arrival") && ($tysub =="Vendor"))
{
$recups = $row_new['stlg_trups'];
$recqty = $rcqty;
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Party";
$cn=0;
}
elseif(($ty == "Arrival") && ($tysub =="Internalreturn"))
{
$recups = $row_new['stlg_trups'];
$recqty = $rcqty;
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Internal Return";
$cn=0;
}
elseif(($ty == "Arrival") && ($tysub =="Stocktransfer"))
{
$recups = $row_new['stlg_trups'];
$recqty = $rcqty;
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Stock Transfer";
$cn=0;
}
elseif(($ty == "Issue") && ($tysub =="pindent"))  
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Issue on Physical Indent";
$cn=0;
}
elseif(($ty == "Issue") && ($tysub =="eindent"))  
{

	$sql2=mysql_query("select * from tblissue where issue_id='".$row_new['stlg_trid']."'")or die(mysql_error());
    $row2=mysql_fetch_array($sql2);
	
	$sql1=mysql_query("select * from tbl_ieindent where code='".$row2['dcrefno']."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$resettargetquery=mysql_query("select * from tbl_roles where id='".$row['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
	$nm=$resetresult['name'];
	
$indent=$row2['dcrefno'];
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Issue on e-Indent - $indent - raised by - $nm";
$cn=0;
}
elseif(($ty == "Issue") && ($tysub =="stocktr"))  
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Issue Stock Transfer";
$cn=0;
}
elseif(($ty == "Issue") && ($tysub =="MReturnV"))  
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Issue Material Return to Party";
$cn=0;
}
elseif(($ty == "IT") && ($tysub =="ITI"))  
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Inter Item Transfer";
$cn=0;
}
elseif(($ty == "IT") && ($tysub =="ITA"))  
{
$issups = "";
$issqty = "";
$recups = $row_new['stlg_trups']; 
$recqty = $rcqty;
$perticulars="Inter Item Transfer";
$cn=0;
}
elseif(($ty == "Arrival") && ($tysub =="OP"))
{
$recups = $row_new['stlg_trups'];
$recqty = $rcqty;
$issups = ""; 
$issqty = "";
$perticulars="Opening Stock";
$cn=0;
}
elseif($ty == "GD")
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Good to Damage";
$cn=0;
}
elseif($ty == "DG")
{
$recups = $row_new['stlg_trups'];
$recqty = $rcqty;
$issups = ""; 
$issqty = "";
$perticulars="Damage to Good";
$cn=0;
}
elseif($ty == "CC")
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Captive Consumption";
$cn=0;
}
elseif($ty == "CI")
{
$cnn=0;
$s_ci=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$cid."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate'") or die(mysql_error());
$t_ci=mysql_num_rows($s_ci);
while($row_ci=mysql_fetch_array($s_ci))
{
$sql_is1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_ci['stlg_subbinid']."' and stlg_tritemid='".$itemid."' and stlg_trdate<='$edate'") or die(mysql_error());
$to_is1=mysql_fetch_array($sql_is1); 

$to_n=0;
$sql_istbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$to_is1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
$to_n=mysql_num_rows($sql_istbl);
if($to_n > 0)$cnn++;
}
$sq_ci=mysql_query("select * from tbl_stldg_good where stlg_trtype='CI' and stlg_trclassid='".$cid."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' and stlg_balqty > 0") or die (mysql_error());
$tot_ci=mysql_num_rows($sq_ci);

$s_ci111=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$cid."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' ") or die(mysql_error());
$t_ci111=mysql_num_rows($s_ci111);
while($row_ci111=mysql_fetch_array($s_ci111))
{
$sql_is1111=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_ci111['stlg_subbinid']."' and stlg_tritemid='".$itemid."' and stlg_trdate<='$edate' and stlg_trtype='CI'") or die(mysql_error());
$to_is1111=mysql_fetch_array($sql_is1111); 
$to_n111=0;
$sql_istbl111=mysql_query("select * from tbl_stldg_good where stlg_id='".$to_is1111[0]."' and stlg_balqty > 0 and stlg_trdate > '$dt'") or die(mysql_error()); 
$to_n111=mysql_num_rows($sql_istbl111);
if($to_n111 > 0)$cnn--;
}
//echo $cnn;
if($tot_ci==$cnn)
{
$cn=0;
}
else
{
$cn=1;
}
if($totqty >= $totoqty)
{
$recups = $totups-$totoups;
$recqty = $totqty-$totoqty;
$issups = ""; 
$issqty = "";
}
else
{
$recups = "";
$recqty = "";
$issups = $totups-$totoups;
$issqty = $totqty-$totoqty;
}

$perticulars="Cycle Inventory";
}
elseif(($ty == "ES") && ($tysub =="ES"))
{
$recups = $row_new['stlg_trups'];
$recqty = $rcqty;
$issups = ""; 
$issqty = "";
$perticulars="Excess/Shortage - Excess";
$cn=0;
}
elseif(($ty == "ES") && ($tysub =="SH"))
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Excess/Shortage - Shortage";
$cn=0;
}
elseif(($ty == "SLOC") && ($tysub =="SUC"))
{
$recups = $row_new['stlg_trups'];
$recqty = $rcqty;
$issups = ""; 
$issqty = "";
$perticulars="Excess/Shortage - Excess";
$cn=0;
}
elseif(($ty == "SLOC") && ($tysub =="SUO"))
{
$issups = $row_new['stlg_trups'];
$issqty = $rcqty;
$recups = ""; 
$recqty = "";
$perticulars="Excess/Shortage - Shortage";
$cn=0;
}

	$tdate=$row_new['stlg_trdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

if($cn==0)
{
if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $perticulars;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $perticulars;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
</tr>
<?php
}
$srno=$srno+1; 
}
}
}
?>

</table>

<?php
}
else if($mtype == 'Damage')
	{
	$sql = "select * from tbl_stldg_damage where  stld_trdate <= '$edate' and stld_trdate >= '$sdate' and stld_trclassid =".$cid."  and stld_tritemid =".$itemid." group by stld_trdate order by stld_trdate ASC";
	 $rs = mysql_query($sql) or die(mysql_error());	  
	 ?>
	  	<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">&nbsp;&nbsp; Date: From <?php echo $_GET['sdate'];?> to <?php echo $_GET['edate'];?>&nbsp;<?php ?></td>
  </tr>
  
  </table>
 
 
 
 
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?> &nbsp;Item: <?php echo $stores_item?> UoM: <?php echo $uom?></td>
  </tr>
  </table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading" rowspan="2">Date</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Particulars</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Receive</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Issue</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Balance</td>
</tr>
<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
</tr>
<?php 

$srno=1;
while($row = mysql_fetch_array($rs))
	{

$dt=$row['stld_trdate'];

$totups=0; $totqty=0;
$cnt=0;  $rtotalups=0; $rtotalqty=0; $rups=0; $rqty=0;
$snn=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$row['stld_trclassid']."' and stld_tritemid='".$row['stld_tritemid']."' and stld_trdate <= '$edate' and stld_trdate >= '$sdate' ") or die(mysql_error());
$cnt1=0; $sbid="";
while($sn=mysql_fetch_array($snn))
{
$cnt1++;
if($sbid!="")
$sbid=$sbid.",".$sn['stld_subbinid'];
else
$sbid=$sn['stld_subbinid'];
}

$ff=split(",",$sbid);
foreach($ff as $fid)
{	
	if($fid!="")
	{ 
$sql_new1=mysql_query("select stld_trdate, stld_trtype, stld_trsubtype, sum(stld_trups),sum(stld_trqty),sum(stld_balups),sum(stld_balqty), stld_trid from tbl_stldg_damage where stld_trdate='$dt' and stld_tritemid ='$itemid' and stld_subbinid ='$fid' group by stld_trtype, stld_trsubtype, stld_trdate, stld_trid order by stld_id asc") or die(mysql_error());
$ttt=mysql_num_rows($sql_new1);
if($ttt == 0)
{
	$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$fid."' and stld_tritemid='".$itemid."' and stld_trdate<='$dt'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 
$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
$row_n=mysql_fetch_array($sql_issuetbl);

$sql_new1=mysql_query("select stld_trdate, stld_trtype, stld_trsubtype, sum(stld_trups),sum(stld_trqty),sum(stld_balups),sum(stld_balqty), stld_trid, stld_id from tbl_stldg_damage where stld_tritemid ='$itemid' and stld_id ='".$row_issue1[0]."' group by stld_trtype, stld_trsubtype, stld_trdate, stld_trid order by stld_id asc") or die(mysql_error());
$ttt=mysql_num_rows($sql_new1);
while($row_new1=mysql_fetch_array($sql_new1))
{
$rups=$rups+$row_new1[5];
$rqty=$rqty+$row_new1[6];
}
}
}
}
$sql_new=mysql_query("select stld_trdate, stld_trtype, stld_trsubtype, sum(stld_trups),sum(stld_trqty),sum(stld_balups),sum(stld_balqty), stld_trid from tbl_stldg_damage where stld_trdate='$dt' and stld_tritemid ='$itemid' group by stld_trdate, stld_trid, stld_trtype, stld_trsubtype order by stld_id asc") or die(mysql_error());
while($row_new=mysql_fetch_array($sql_new))
{


$ty = $row_new['stld_trtype'];
$tysub = $row_new['stld_trsubtype'];
/*if($ty == "Arrival" || ($ty == "ES") && ($tysub =="ES") || $ty == "DG" || $ty == "CI" || $ty == "OP" || ($ty == "SLOC") && ($tysub =="SUC"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
}
elseif($ty == "Issue" || $ty == "CC" || $ty == "GD" || $ty == "CI" || ($ty == "ES") && ($tysub =="SH") || ($ty == "SLOC") && ($tysub =="SUO"))
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
}*/

if(($ty == "Arrival") && ($tysub =="Vendor"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Party";
}
elseif(($ty == "Arrival") && ($tysub =="Internalreturn"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Internal Return";
}
elseif(($ty == "Arrival") && ($tysub =="Stocktransfer"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Stock Transfer";
}
elseif(($ty == "Issue") && ($tysub =="pindent"))  
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Issue on Physical Indent";
}
elseif(($ty == "Issue") && ($tysub =="eindent"))  
{
	$sql2=mysql_query("select * from tblissue where issue_id='".$row_new[7]."'")or die(mysql_error());
    $row2=mysql_fetch_array($sql2);
	
	$sql1=mysql_query("select * from tbl_ieindent where code='".$row2['dcrefno']."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$resettargetquery=mysql_query("select * from tbl_roles where id='".$row['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
	$nm=$resetresult['name'];
$indent=$row2['dcrefno'];
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Issue on e-Indent - $indent - raised by - $nm";

}
elseif(($ty == "Issue") && ($tysub =="stocktr"))  
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Issue Stock Transfer";
}
elseif(($ty == "Issue") && ($tysub =="MReturnV"))  
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Issue Material Return to Party";
}
elseif(($ty == "IT") && ($tysub =="ITI"))  
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Inter Item Transfer";
}
elseif(($ty == "IT") && ($tysub =="ITA"))  
{
$issups = "";
$issqty = "";
$recups = $row_new[3]; 
$recqty = $row_new[4];
$perticulars="Inter Item Transfer";
}
elseif(($ty == "Arrival") && ($tysub =="OP"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Opening Stock";
}
elseif($ty == "GD")
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Good to Damage";
}
elseif($ty == "DG")
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Damage to Good";
}
elseif($ty == "CC")
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Captive Consumption";
}
elseif($ty == "CI")
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Cycle Inventory";
}
elseif(($ty == "ES") && ($tysub =="ES"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Excess/Shortage - Excess";
}
elseif(($ty == "ES") && ($tysub =="SH"))
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Excess/Shortage - Shortage";
}
elseif(($ty == "SLOC") && ($tysub =="SUC"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Excess/Shortage - Excess";
}
elseif(($ty == "SLOC") && ($tysub =="SUO"))
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Excess/Shortage - Shortage";
}

$tdate=$row_new['stld_trdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

$totups=$rups+$row_new[5];
$totqty=$rqty+$row_new[6];

if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $perticulars;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $perticulars;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
</tr>
<?php
}
$srno=$srno+1; 
}
}
?>

</table>
	
<?php
}
?>			
	
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="storesitamledger.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" OnClick="openprint()" border="0" style="display:inline;cursor:hand;"><input type="hidden" name="txtinv" /></td>
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
