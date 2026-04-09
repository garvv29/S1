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
	
	if(isset($_REQUEST['classid']))
	{
	 $classid = $_REQUEST['classid'];
	}
	if(isset($_REQUEST['itemid']))
	{
	 $itemid = $_REQUEST['itemid'];
	}
	if(isset($_REQUEST['trdate']))
	{
	 $trdate = $_REQUEST['trdate'];
	}
	
		if(isset($_POST['frm_action'])=='submit')
	{
	
		$cuidate=trim($_POST['edate']);
		$classid=trim($_POST['classid']);
		$itemid=trim($_POST['itemid']);
		
		$tdate=$cuidate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;		
		
		$cnt=0;
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());

while($row_issue=mysql_fetch_array($sql_issue))
{ 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
{ 	
	$sql_sub_sub="update tbl_stldg_good set orstatus='OR' , ordate='$tdate' where stlg_id='".$row_issuetbl['stlg_id']."'";
	mysql_query($sql_sub_sub) or die(mysql_error());	$cnt++;
}
}	
if($cnt > 0)
{	
?>
			<script language='javascript' >
			window.opener.location.href=window.opener.location.href;	
			window.close();
			</script>
<?php
}
else
{
?>
			<script language='javascript' > alert('For new item, order booking date cannot be captured');
			window.opener.location.href=window.opener.location.href;	
			window.close();
			</script>
<?php
}
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seedtrac-FSW - Transaction - Order Placement at Reorder Level Updation</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>
<script language="javascript" type="text/javascript">

function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frm.sdate,dt,document.frm.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frm.edate,dt,document.frm.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth,cDate);	
	return (dtObject);
} 	

function mySubmit()
{ 
	dt1=getDateObject(document.frm.txtdate.value,"-");
	dt2=getDateObject(document.frm.edate.value,"-");
		
	if(dt1 < dt2)
	{
	alert("Order Placement Date needs to be less or equal to Todays date");
	return false;
	}
	
	return true
}
</script>
</head>
<body topmargin="0" >
<table width="560"  border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="top">
  <?php
$sql_cls=mysql_query("select * from tbl_classification where classification_id='".$classid."'") or die(mysql_error());
$row_cls=mysql_fetch_array($sql_cls);


$sql_itm=mysql_query("select * from tbl_stores where items_id='".$itemid."'") or die (mysql_error());
$row_itm=mysql_fetch_array($sql_itm);

	$totups=0; $totqty=0;
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
	$totups=$totups+$row_issuetbl['stlg_balups'];
	$totqty=$totqty+$row_issuetbl['stlg_balqty'];
 }
 
 }
 if($totqty <=0)
$totqty=0;

if($totups<=0 && $totqty>0)
$totups=1;
if($totups>0 && $totqty==0)
$totups=0;
 
	 ?>
   <form name="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="classid" value="<?php echo $classid;?>" />
	<input type="hidden" name="itemid" value="<?php echo $itemid;?>" />
	<input type="hidden" name="txtdate" value="<?php echo date("d-m-Y");?>" />
		
	  <table width="670"  border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25"><td colspan="4" align="center" class="tblheading">Order Placement at Reorder Level</td></tr>
<tr class="Light" height="25">
<td width="141" align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
<td width="214" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_cls['classification'];?></td>
<td width="57" align="right"  valign="middle" class="tblheading">&nbsp;Item&nbsp;</td>
<td width="248" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_itm['stores_item'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;UoM&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_itm['uom'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Reorder Level&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_itm['srl'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $totups;?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $totqty;?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Order Placement Date&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo $trdate;?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frm.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></td>
</tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="666">
<tr >
<td width="646" colspan="3" align="center"><img src="../images/close_1.gif" border="0" onClick="window.close()" style="cursor:pointer" />&nbsp;
  <input type="image" src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"/></td>
</tr>
</table>


</form>
</td></tr>
</table>

</body>
</html>
