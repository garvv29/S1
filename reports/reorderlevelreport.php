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
	$sdate=trim($_POST['sadte']);
		$edate=trim($_POST['edate']);
		
		if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_GET['classification_id']))
	{
	$classification_id = $_GET['classification_id'];
	}
	if(isset($_GET['items_id']))
	{
	$id = $_GET['items_id'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	$sdate=trim($_POST['sdate']);
		$edate=trim($_POST['edate']);		
		
		if($sdate!="" && $edate!="")
		{
		$code=trim($_POST['txtcode']);
		$date=trim($_POST['date']);
		$level=$_POST['txtvname'];
		
		$tdate=$date2;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		/*$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
		$num=mysql_num_rows($sql22);
		
		$sql2=mysql_query("select * from tblemp where emp_mobile='".$mobile."'") or die(mysql_error());
		$num2=mysql_num_rows($sql2);
		
		$sql_mail=mysql_query("select * from tblemp where emp_email='".$email."'") or die(mysql_error());
		$num_mail=mysql_num_rows($sql_mail);
		
		if($altemail !="")
		{
		$sql_altmail=mysql_query("select * from tblemp where emp_altemail='".$altemail."'") or die(mysql_error());
		$num_altmail=mysql_num_rows($sql_altmail);
		}
		else
		{
		$num_altmail=0;
		}
		
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee ID.\nEmployee with this Employee ID already Present.");
			  </script>
			 <?php
		}
		else if($num2 > 0)
		{	?>
			 <script>
			  alert("Duplicate Mobile Number.\nEmployee with this Mobile Number already Present.");
			  </script>
			 <?php
		}
		else if($num_mail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee VNR Email-ID.\nEmployee with this Employee VNR Email-ID already Present.");
			  </script>
			 <?php
		}
		else if($num_altmail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee Alternate Email-ID.\nEmployee with this Employee Alternate Email-ID already Present.");
			  </script>
			 <?php
		}
		else*/
		{
			 $sql_in="insert into tbl_transction( date, order ,date2,order) values ('$date','$code','$date2','$order')";
										
			//if(mysql_query($sql_in)or die(mysql_error()))
			//{ 
				//$id=mysql_insert_id();
				
			}
		
		}
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Report-Reorder Level Report</title>
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
winHandle=window.open('report_reorder.php','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
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
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
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
	      <td width="813" height="25">Reorder Level as on Date Report</td>
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
 	  ?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Reorder Level Report As on Date : <?php echo date("d-m-Y", time());?></td>
  </tr>
   </table>
   <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="28" align="center" class="tblheading" valign="middle">#</td>
    <td width="168" align="center" class="tblheading" valign="middle">Classification</td>
    <td width="262" align="center" class="tblheading" valign="middle">Item</td>
    <td width="57" align="center" class="tblheading" valign="middle">UoM</td>
    <td width="67" align="center" class="tblheading" valign="middle">Reorder Level </td>
    <td width="44" align="center" class="tblheading" valign="middle">UPS</td>
	  <td width="58" align="center" class="tblheading" valign="middle">Quantity</td>
      <td width="78" align="center" class="tblheading" valign="middle">Remarks</td>
    </tr>
<?php
$srno=1; $ordate="";$orstatus="";
$sql_cls=mysql_query("select * from tbl_classification") or die(mysql_error());
while($row_cls=mysql_fetch_array($sql_cls))
{

$sql_itm=mysql_query("select * from tbl_stores where classification_id='".$row_cls['classification_id']."' and srl_status='Yes'") or die (mysql_error());
while($row_itm=mysql_fetch_array($sql_itm))
{
$totups=0; $totqty=0;  $cnt=0;
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_cls['classification_id']."' and stlg_tritemid='".$row_itm['items_id']."'") or die(mysql_error());

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$row_itm['items_id']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
	$totups=$totups+$row_issuetbl['stlg_balups'];
	$totqty=$totqty+$row_issuetbl['stlg_balqty'];
	$ordate=$row_issuetbl['ordate'];
	$cnt++;
	$orstatus=$row_issuetbl['orstatus'];
 }
 }
 
 if($totqty > 0 && $totups==0)$totups=1;
 if($totqty == 0 && $totups > 0)$totups=0;
 
 if($ordate=="" || $ordate=="0000-00-00")
 {
 	$tdate=date("d-m-Y");
 }
 else
 {
 	$tdate=$ordate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
 }
?>  
<?php	
if($totqty <=0)
$totqty=0;

if($totups<=0 && $totqty>0)
$totups=1;
if($totups>0 && $totqty==0)
$totups=0;

$stores_item=$row_itm['stores_item'];
if($row_itm['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";

if($totqty <= $row_itm['srl'])
 {
 if ($srno%2 != 0)
	{	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $stores_item;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['uom'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['srl'];?></td>
	<td valign="middle" class="tbltext" align="center"><?php echo $totups;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $totqty;?></td>
   <td width="78" align="center" valign="middle" class="tblheading"><?php if($orstatus=="OR") { echo "OR - ".$ordate;}else{ echo "R";}?></td>
	 </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $stores_item;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['uom'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['srl'];?></td>
	<td valign="middle" class="tbltext" align="center"><?php echo $totups;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $totqty;?></td>
    <td width="78" align="center" valign="middle" class="tblheading"><?php if($orstatus=="OR") { echo "OR - ".$ordate;}else{ echo "R";}?></td>
	 </tr>
  <?php	}
	 $srno=$srno+1;
	}
}
}
//}
?>
</table>
<table width="974" cellpadding="0" cellspacing="0" border="0" >
<tr>
<td align="center" valign="middle" class="smalltbltext">R - Reorder Level, &nbsp;&nbsp;&nbsp;OR - Reorder Level Order Placed </td>
</tr>
</table>	
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="../images/printpreview.gif" alt="Submit Value" OnClick="openprint()" border="0" style="display:inline;cursor:hand;" tabindex="19"><input type="hidden" name="txtinv" /></td>
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
