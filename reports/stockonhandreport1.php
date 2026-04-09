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
   	set_time_limit(1000);
	if(isset($_POST['frm_action'])=='submit')
	{ /*
		$dept=trim($_POST['department']);
		$monthf=trim($_POST['monthf']);
		$montht=trim($_POST['montht']);
		
		echo "<script>window.location='deptcomposite1.php?dept=$dept&monthf=$monthf&montht=$montht'</script>";	*/
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores-Report  Stock On hand Report</title>
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

var sdate=document.frmaddDepartment.sdate.value; 
var cls=document.frmaddDepartment.txtclass.value;
var ite=document.frmaddDepartment.txtitem.value;
var re=document.frmaddDepartment.ret.value;
var ch=document.frmaddDepartment.chk.value;
winHandle=window.open('report_stockhand.php?sdate='+sdate+'&txtclass='+cls+'&txtitem='+ite+'&ret='+re+'&chk='+ch,'WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
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
          <td width="100%" valign="top"  align="center"  class="midbgline"><!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25">Stock on Hand Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
<?php 
 	$pid = $_GET['pid'];	
	$sdate = $_REQUEST['sdate'];
	//$edate = $_REQUEST['edate'];
	$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtitem'];
	$mtype = $_REQUEST['ret'];
	$sloc = $_REQUEST['chk'];
?>	  
	 <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="pid" value="<?php echo $pid?>" type="hidden"> 
	 <input name="sdate" value="<?php echo $sdate;?>" type="hidden"> 
	 <input name="txtclass" value="<?php echo $cid;?>" type="hidden"> 
	 <input name="txtitem" value="<?php echo $itemid;?>" type="hidden"> 
	 <input name="ret" value="<?php echo $mtype;?>" type="hidden"> 
	 <input name="chk" value="<?php echo $sloc;?>" type="hidden"> 

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

<?php	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$sdate=$tyear."-".$tmonth."-".$tday;
	
	/*$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;*/
	 $classid=''; $item__id='';
	 if($_GET['txtclass'] != 'ALL')
	 {
		$ss = "select classification from tbl_classification where classification_id='".$_GET['txtclass']."'";
	 	$rr = mysql_query($ss) or die(mysql_error());	 
		$ros = mysql_fetch_array($rr);
		$cls = $ros['classification'];
		$classid=$_GET['txtclass'];
		
		$s = "select items_id from tbl_stores where classification_id=$classid and actstatus='Active' order by stores_item";
		$r = mysql_query($s) or die(mysql_error());	 
		if($txo=mysql_num_rows($r)>0)
		{
			while($ro=mysql_fetch_array($r))
			{
				if($item__id!='')
					$item__id=$item__id.",".$ro['stores_item'];
				else
					$item__id=$ro['stores_item'];
			}
		}
	 }
	 else
	 {
	 	$cls = "ALL";
	 	$ss = "select classification_id from tbl_classification order by classification ASC ";
	 	$rr = mysql_query($ss) or die(mysql_error());	 
		while($ros = mysql_fetch_array($rr))
		{
			if($classid!='')
			$classid=$classid.",".$ros['classification_id'];
			else
			$classid=$ros['classification_id'];
		
			$s = "select items_id from tbl_stores where classification_id='".$ros['classification_id']."' and actstatus='Active' order by stores_item";
			$r = mysql_query($s) or die(mysql_error());	 
			 $txo=mysql_num_rows($r);
			if($txo>0)
			{
				while($ro=mysql_fetch_array($r))
				{ 
					if($item__id!='')
						{ $item__id=$item__id.",".$ro['items_id'];}
					else
						{ $item__id=$ro['items_id'];}
				}
			}
		}
	 }
	 //echo $item__id;
	 if($mtype=='Good') 
	 {
	 //echo "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trdate <= '$sdate' and stlg_trclassid =$cid and stlg_tritemid =$itemid";
	 $sql = "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trdate <= '$sdate'";
	
	//$sql = "select DISTINCT(stlg_trclassid),stlg_tritemid from tbl_stldg_good where stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' ";
	 if(!is_numeric($cid))
	 {
	 $sql.=" and stlg_trclassid IN ($classid)";
	 }
	 else
	 {
	 $sql.=" and stlg_trclassid ='".$classid."'";
	 }
	 
	 if(!is_numeric($itemid))
	 {
	//$sql.=" and stlg_tritemid IN ($item__id) ";
	 }
	 else
	 {
	 $sql.=" and stlg_tritemid =".$itemid;
	 }
	 	 
	 //$sql.=" order by stlg_tritemid";
	 //$sql;
	 $rs = mysql_query($sql) or die(mysql_error());	  
	
	 ?>
	  
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Stock on Hand Report: <?php echo $_GET['ret'];?></td>
  </tr>
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">As on Date: <?php echo $_GET['sdate'];?></td>
  </tr>
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?></td>
  </tr>
  </table>
  
<table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
  <td align="center" valign="middle" class="tblheading" rowspan="2">Classification</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Item</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">UoM</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading" colspan="3">SLOC</td>
			<?php
			}
			?>
			
			<td align="center" valign="middle" class="tblheading" rowspan="2">Status</td>
</tr>
<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading">Bin</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<?php
			}
			?>
</tr>

<?php 

$srno=1;
while($row = mysql_fetch_array($rs))
	{
	$itemid = $row['stlg_tritemid'];
	$cls = $row['stlg_trclassid'];
	$orstatus="";
	
			$ssc = "select classification from tbl_classification where classification_id=".$cls;
	 		$rrc = mysql_query($ssc) or die(mysql_error());	 
			$rosc = mysql_fetch_array($rrc);
			$clsc = $rosc['classification'];
			
			$s = "select * from tbl_stores where items_id=$itemid and actstatus='Active'";
	 		$r = mysql_query($s) or die(mysql_error());	 
			if($txo=mysql_num_rows($r)>0)
			{
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
	// NEw code
	$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$cls."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$sdate'") or die(mysql_error());
	
	$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty="";$sqty=0; $slocs=""; $gd="";  $qt=array(); $up=array();
	while($row_issue=mysql_fetch_array($sql_issue))
 { 
  $slups=0; $slqty=0;
	$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$sdate'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 
//echo "select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0";
$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 $orstatus=$row_issuetbl['orstatus'];
  
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

 //$row_issuetbl['stlg_balups'];
$slups=$slups+$row_issuetbl['stlg_balups'];
$up[] = $slups;
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";

 //$row_issuetbl['stlg_balqty'];
$slqty=$slqty+$row_issuetbl['stlg_balqty'];
$qt[] = $slqty;
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";
$j++;
}
}

if(array_sum($qt) > $ro['srl'])
{
 $orstatus="";
 }
	// end new code


if ($srno%2 != 0)
	{
?>

<tr class="Light" height="25">
 			<td align="center" valign="middle" class="tblheading"><?php echo $clsc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($up);?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($qt);?></td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<?php
			}
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $orstatus?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
  			<td align="center" valign="middle" class="tblheading"><?php echo $clsc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($up);?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($qt);?></td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<?php
			}
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $orstatus?></td>
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
else if($mtype == "Damage")
{
$sql = "select DISTINCT(stld_tritemid),stld_trclassid from tbl_stldg_damage where stld_trdate <= '$sdate'";
	 if(!is_numeric($cid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stld_trclassid =".$cid;
	 }
	 
	 if(!is_numeric($itemid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stld_tritemid =".$itemid;
	 }
	 	 
	 $sql.=" order by stld_trclassid";
	 //echo $sql;
	 $rs = mysql_query($sql) or die(mysql_error());	  
	
	 ?>
	  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Stock on Hand Report: <?php echo $_GET['ret'];?></td>
  </tr>
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">As on Date: <?php echo $_GET['sdate'];?></td>
  </tr>
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?></td>
  </tr>
  </table>
  
<table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
  			<td align="center" valign="middle" class="tblheading" rowspan="2">Classification</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">Item</td>
			<td align="center" valign="middle" class="tblheading" rowspan="2">UoM</td>
			<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading" colspan="3">SLOC</td>
			<?php
			}
			?>
			
			<td align="center" valign="middle" class="tblheading" rowspan="2">Status</td>
</tr>
<tr class="tblsubtitle" height="25">
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading">Bin</td>
			<td align="center" valign="middle" class="tblheading">UPS</td>
			<td align="center" valign="middle" class="tblheading">QTY</td>
			<?php
			}
			?>
</tr>

<?php 

$srno=1;
while($row = mysql_fetch_array($rs))
	{
	$itemid = $row['stld_tritemid'];
	$cls = $row['stld_trclassid'];
	
			$ssc = "select classification from tbl_classification where classification_id=".$cls;
	 		$rrc = mysql_query($ssc) or die(mysql_error());	 
			$rosc = mysql_fetch_array($rrc);
			$clsc = $rosc['classification'];
			
			/*$s = "select * from tbl_stores where items_id = $itemid";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);*/
			$s = "select * from tbl_stores where items_id=$itemid and actstatus='Active'";
	 		$r = mysql_query($s) or die(mysql_error());	 
			if($txo=mysql_num_rows($r)>0)
			{
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
	// NEw code
	$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$cls."' and stld_tritemid='".$itemid."' and stld_trdate <= '$sdate'") or die(mysql_error());
	
	$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty="";$sqty=0; $slocs=""; $gd="";  $qt=array(); $up=array();
	while($row_issue=mysql_fetch_array($sql_issue))
 { 
  $slups=0; $slqty=0;
	$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itemid."' and stld_trdate <= '$sdate'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
  $orstatus=$row_issuetbl['orstatus'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
 $slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
 $slocs=$wareh.$binn.$subbinn."<br/>";

 //$row_issuetbl['stld_balups'];
$slups=$slups+$row_issuetbl['stld_balups'];
$up[] = $slups;
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";

 //$row_issuetbl['stld_balqty'];
$slqty=$slqty+$row_issuetbl['stld_balqty'];
$qt[] = $slqty;
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";
$j++;
}
}

if(array_sum($qt) > $ro['srl'])
{
 $orstatus="";
 }
	
	// end new code
	
if(array_sum($qt)>0)
{
if ($srno%2 != 0)
{
?>


<tr class="Light" height="25">
  			<td align="center" valign="middle" class="tblheading"><?php echo $clsc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($up);?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($qt);?></td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<?php
			}
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['orstatus']?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
  			<td align="center" valign="middle" class="tblheading"><?php echo $clsc?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $stores_item?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $uom?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($up);?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo array_sum($qt);?></td>
			<?php
			if($sloc)
			{
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			<?php
			}
			?>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['orstatus']?></td>
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
?>

<table width="974" cellpadding="0" cellspacing="0" border="0" >
<tr>
<td align="center" valign="middle" class="smalltbltext">R - Reorder Level, &nbsp;&nbsp;&nbsp;OR - Reorder Level Order Placed </td>
</tr>
</table>
	
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="stockonhandreport.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" /></td>
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
