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
<title>Report - Consumption Report</title>
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
winHandle=window.open('consumption_report2.php?pid=<?php echo $pid;?>&sdate=<?php echo $sdate;?>&edate=<?php echo $edate;?>&txtclass=<?php echo $cid;?>&txtitem=<?php echo $itemid;?>&ret=<?php echo $mtype;?>','WelCome','top=20,left=80,width=1000,height=900,scrollbars=yes');
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
{	
	$s = "select * from tbl_stores where items_id ='".$itemid."'";
	$r = mysql_query($s) or die(mysql_error());	 
	$ro = mysql_fetch_array($r);
	$storesitem = $ro['stores_item'];
}	
else
{
	$storesitem = "ALL";
}
?>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25">&nbsp;Consumption Report</td>
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
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
<tr height="25" >
	<td align="center" class="subheading" style="color:#303918; ">&nbsp;&nbsp; Date: From <?php echo $_GET['sdate'];?> to <?php echo $_GET['edate'];?>&nbsp;</td>
</tr>
</table>


  <table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?> &nbsp;Item: <?php echo $storesitem?></td>
  </tr>
  </table>
  <table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
	<td align="center" valign="middle" class="tblheading" rowspan="2">Classification</td>
	<td align="center" valign="middle" class="tblheading" rowspan="2">Item</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Issue</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Internal Return</td>
	<td align="center" valign="middle" class="tblheading" colspan="2">Used Qty</td>
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
if($mtype == 'Good')
{ 
	if($_GET['txtclass']!="ALL")
	{ $sqlmain = "select DISTINCT(stlg_trclassid) from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_trclassid='".$cid."' group by stlg_trdate order by stlg_trdate asc";}
	else
	{ $sqlmain = "select DISTINCT(stlg_trclassid) from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate'  group by stlg_trdate order by stlg_trdate asc";}
	$rsmain23 = mysql_query($sqlmain) or die(mysql_error()); 
	
	while($rowmain = mysql_fetch_array($rsmain23))
	{
	$cid=$rowmain['stlg_trclassid'];
	
	if($_GET['txtitem']!="ALL")
	{$sql = "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_trclassid='".$cid."' and stlg_tritemid='".$itemid."' group by stlg_trdate order by stlg_trdate asc";}
	else
	{$sql = "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_trclassid='".$cid."' group by stlg_trdate order by stlg_trdate asc";}
	$rs23 = mysql_query($sql) or die(mysql_error());	 
	
	while($row23 = mysql_fetch_array($rs23))
	{
		$itemid = $row23['stlg_tritemid'];
		
	
	 	$ss = "select classification from tbl_classification where classification_id='".$cid."'";
		$rr = mysql_query($ss) or die(mysql_error());	 
		$ros = mysql_fetch_array($rr);
		$classification = $ros['classification'];
	
		$s = "select * from tbl_stores where items_id ='".$itemid."'";
		$r = mysql_query($s) or die(mysql_error());	 
		$ro = mysql_fetch_array($r);
		$stores_item = $ro['stores_item'];
		if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
		$uom = $ro['uom'];
$totups=0; $totqty=0; $totoups=0; $totoqty=0;
$cnt=0;  $rtotalups=0; $rtotalqty=0; $rups=0; $rqty=0; $orups=0; $orqty=0;	
$recups=0; $recqty = 0; $issups = 0; $issqty = 0;
$sql = "select * from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_trclassid='".$cid."' and stlg_tritemid='".$itemid."' group by stlg_trdate order by stlg_trdate asc";
$rs = mysql_query($sql) or die(mysql_error());	  		
while($row = mysql_fetch_array($rs))
{
	$dt=$row['stlg_trdate'];
	
	$sql_new=mysql_query("select stlg_trdate, stlg_trtype, stlg_trsubtype, sum(stlg_trups), sum(stlg_trqty), sum(stlg_balups), sum(stlg_balqty), sum(stlg_opups), sum(stlg_opqty), stlg_trid, yearcode, stlg_id from tbl_stldg_good where stlg_trdate='$dt' and stlg_tritemid ='".$row['stlg_tritemid']."' and stlg_trsubtype!='SUO'  group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid, stlg_subbinid order by stlg_id asc") or die(mysql_error());
	while($row_new=mysql_fetch_array($sql_new))
	{
		//echo $row_new['stlg_id']."  ";
		$cn=0;
		$ty = $row_new['stlg_trtype'];
		$tysub = $row_new['stlg_trsubtype'];
		//echo $row_new[6]."<br>";
		
		//echo $totqty."<br>";
		if(($ty == "Arrival") && ($tysub =="Internalreturn"))
		{
			$recups = $recups+$row_new[3];
			$recqty = $recqty+$row_new[4];
			$issups = $issups+0; 
			$issqty = $issqty+0;
			$perticulars="Arrival from Internal Return";
			$cn=0;
		}
		elseif(($ty == "Issue") && ($tysub =="pindent"))  
		{
			$issups = $issups+$row_new[3];
			$issqty = $issqty+$row_new[4];
			$recups = $recups+0; 
			$recqty = $recqty+0;
			$perticulars="Issue on Physical Indent";
			$cn=0;
		}
		elseif(($ty == "Issue") && ($tysub =="eindent"))  
		{
		
			$sql2=mysql_query("select * from tblissue where issue_id='".$row_new[9]."'")or die(mysql_error());
			$row2=mysql_fetch_array($sql2);
			
			$sql1=mysql_query("select * from tbl_ieindent where code='".$row2['dcrefno']."' and yearcode='".$row_new[10]."'")or die(mysql_error());
			$row=mysql_fetch_array($sql1);
			
			$resettargetquery=mysql_query("select * from tbl_roles where id='".$row['id']."'");
			$resetresult=mysql_fetch_array($resettargetquery);
			$nm=$resetresult['name'];
			
			$indent=$row2['dcrefno'];
			$issups = $issups+$row_new[3];
			$issqty = $issqty+$row_new[4];
			$recups = $recups+0; 
			$recqty = $recqty+0;
			$perticulars="Issue on e-Indent - $indent - raised by - $nm";
			$cn=0;
		}
		
	}
	$totups=$issups-$recups;
	$totqty=$issqty-$recqty;
		$tdate=$row_new['stlg_trdate'];
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$stlg_trdate=$tday."-".$tmonth."-".$tyear;
}
//}
if($cn==0)
{
if($srno%2 != 0)
{
?>
<tr class="Light" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $classification;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading"><?php echo $classification;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $stores_item;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
</tr>
<?php
}
$srno=$srno+1; 
}
}
}

}
//}

//}
?>			
</table>	
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="consumption_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" OnClick="openprint()" border="0" style="display:inline;cursor:hand;"><input type="hidden" name="txtinv" /></td>
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
