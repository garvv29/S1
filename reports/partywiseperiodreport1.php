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
<title>Stores -Report - Party Wise Period Report</title>
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

/*function openprint()
{ 
//var dateto=document.frmaddDept.dateto.value;
//var datefrom=document.frmaddDept.datefrom.value;
winHandle=window.open('report-decomposite1.php?dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&flg=<?php echo $flg;?>&flg1=<?php echo $flg1;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}*/
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
          <td width="100%" valign="top"  align="center"  class="midbgline">

<!-- actual page start--->	
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <?php
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
	      <td width="813" height="25">Party wise Stock Report</td>
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
 	  
	   $sql = "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trpartyid = 77 order by stlg_trdate DESC";
	 $rs = mysql_query($sql) or die(mysql_error());	  
	  ?>
	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Party:<?php //=$row_dept['dept_name'];?>&nbsp;&nbsp;Period: &nbsp;<?php ?></td>
  </tr>
  </table>
 
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
		
			
			
			
?>
 
 
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification:<?php echo $cls?> &nbsp;Item:<?php echo $stores_item?> UoM:<?php echo $uom?></td>
  </tr>
  </table>
  
  <table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
			<td align="center" valign="middle" class="tblheading">Date</td>
			<td align="center" valign="middle" class="tblheading">Opening</td>
			<td align="center" valign="middle" class="tblheading">Receive</td>
			<td align="center" valign="middle" class="tblheading">Return</td>
			<td align="center" valign="middle" class="tblheading">Balance</td>
</tr>
<?php
$srno=1; 
while($row1 = mysql_fetch_array($rs1))
{

$ty = $row1['stlg_trtype'];
$tysub = $row1['stlg_trsubtype'];
if(($ty == "Arrival") && ($tysub =="Vendor"))
{
$recups = $row1['stlg_trups'];
$recqty = $row1['stlg_trqty'];
$issups = ""; 
$issqty = "";
}
elseif(($ty == "Issue") && ($tysub =="MReturnV"))  
{
$issups = $row1['stlg_trups'];
$issqty = $row1['stlg_trqty'];
$recups = ""; 
$recqty = "";
}



if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $row1['stlg_trdate'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row1['stlg_opqty'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row1['stlg_balqty'];?></td>
</tr>

<?php
}
else
{
?>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading"><?php echo $row1['stlg_trdate'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row1['stlg_opqty'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $recqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $issqty?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row1['stlg_balqty'];?></td>
</tr>
<?php
}
$srno=$srno+1; 
}
?>

</table>			
<!--br />

 <table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: &nbsp;&nbsp;Item:&nbsp;&nbsp;UOM:&nbsp;&nbsp;</td>
  </tr>
  </table>
  <table  border="1" cellspacing="0" cellpadding="0" width="974" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
			<td align="center" valign="middle" class="tblheading">Date</td>
			<td align="center" valign="middle" class="tblheading">Opening</td>
			<td align="center" valign="middle" class="tblheading">Receive</td>
			<td align="center" valign="middle" class="tblheading">Return</td>
			<td align="center" valign="middle" class="tblheading">Balance</td>
</tr>
<tr class="Light" height="25">
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
</tr>
<tr class="Dark" height="25">
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
			<td align="center" valign="middle" class="tblheading">&nbsp;</td>
</tr>

</table-->	
	
<?php } //}?>	
			
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="partywiseperiodreport.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:hand;"  /><input type="hidden" name="txtinv" /></td>
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
