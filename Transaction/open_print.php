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
	//$logid="admin";
	//$lgnid="admin";
	
	//$yearid_id="09-10";	
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	/*$sql_arr=mysql_query("select * from tblarrival where arrival_id='".$pid."'") or die(mysql_error());
	while($row_arr=mysql_fetch_array($sql_arr))
	{
	$partyid=$row_arr['party_id'];
	$trdate=$row_arr['arrival_date'];
	
	$sql_arrsub=mysql_query("select * from tblarrival_sub where arrival_id='".$pid."'") or die(mysql_error());
	while($row_arrsub=mysql_fetch_array($sql_arrsub))
	{
		$classid=$row_arrsub['classification_id'];
		$itemid=$row_arrsub['item_id'];
		
		$sql_arrsub_sub=mysql_query("select * from tblarr_sloc where arr_tr_id='".$pid."' and arr_id='".$row_arrsub['arrsub_id']."'") or die(mysql_error());
		while($row_arrsub_sub=mysql_fetch_array($sql_arrsub_sub))
		{   // $whid=$row_arrsub_sub['type'];
			$whid=$row_arrsub_sub['whid'];
			$binid=$row_arrsub_sub['binid'];
			$subbinid=$row_arrsub_sub['subbin'];
			$ups=$row_arrsub_sub['ups_good'];
			$qty=$row_arrsub_sub['qty_good'];
			$ups1=$row_arrsub_sub['ups_damage'];
			$qty1=$row_arrsub_sub['qty_damage'];
			
			if($row_arrsub_sub['qty_damage']==0 && $row_arrsub_sub['ups_damage']==0 )
			{
			
				$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$binid."' and stlg_whid='".$whid."'") or die(mysql_error());
				$row_issue1=mysql_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 
				$row_issuetbl=mysql_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['stlg_balups'];
				$opqty=$row_issuetbl['stlg_balqty'];
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
				
				$sql_sub_sub="insert into tbl_stldg_good (stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trpartyid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('Arrival', 'op', '$pid', '$partyid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
			}
			else
			{
			
				$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$subbinid."' and stld_binid='".$binid."' and stld_whid='".$whid."'") or die(mysql_error());
				$row_issue1=mysql_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."'") or die(mysql_error()); 
				$row_issuetbl=mysql_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['stld_balups'];
				$opqty=$row_issuetbl['stld_balqty'];
				$balups=$opups+$ups1;
				$balqty=$opqty+$qty1;
				
				$sql_sub_sub="insert into tbl_stldg_damage (stld_trtype, stld_trsubtype, stld_trid, stld_trpartyid, stld_trdate, stld_trclassid, stld_tritemid, stld_whid, stld_binid, stld_subbinid, stld_opups, stld_opqty, stld_trups, stld_trqty, stld_balups, stld_balqty) values('Arrival', 'op', '$pid', '$partyid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups1', '$qty1', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
			}	
		}
	}
}
		//}*/
			
		}
		//}
	//}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transction-Preview Stock Admin</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
<script type="text/javascript">
function stock()
{
//if(document.frmaddDepartment.txtitem.value!="")
//{
//var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('open_print.php','WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
//}
}
/*else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}*/
}

</script>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  >
	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<?php 
$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='op' and arrival_id='".$pid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="750"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add  Opening Stock</td>
</tr>
<tr class="Dark" height="25">
      <td width="225" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
      <td width="619" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "TOP".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid?></td>
     
	  <td width="141" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
      <td width="191" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo date("d-m-Y");?></td>
</tr>
<?php 
//}
$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());
$row_tbl_sub=mysql_fetch_array($sql_tbl_sub);

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);


//$classqry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
<tr class="Light" height="25">
			<td width="225"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td width="619"  align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_class['classification'];?></td>
</tr>

<tr class="Dark" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td align="left" valign="left" class="tbltext" >&nbsp;<?php echo $row_item['stores_item'];?></td>
		
<td width="141" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="191" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<?php echo $row_item['uom'];?></td>
</tr>

<tr class="Light" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl_sub['type'];?></td>
</tr>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl_sub['ups_good'];?></td>
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl_sub['qty_good'];?></td>
</tr>

<tr class="Light" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl_sub['noofbin_good'];?></td>
</tr>
</table>
<br/>
<?php
$sql_sub_sloc=mysql_query("select * from tblarr_sloc where arr_id='".$row_tbl_sub['arrsub_id']."' and arr_tr_id='".$arrival_id."' and qty_damage=0 and ups_damage=0") or die(mysql_error());
$tot_sub_sloc=mysql_num_rows($sql_sub_sloc);
$flash=0;
while($row_sub_sloc=mysql_fetch_array($sql_sub_sloc))
{
if($flash==0)
{
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."'") or die(mysql_error());
$noticia_whg1 = mysql_fetch_array($whg1_query);
?>
<tr class="Light" height="30" >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg1['perticulars'];?></td>
<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin where binid='".$row_sub_sloc['binid']."'") or die(mysql_error());
$noticia_bing1 = mysql_fetch_array($bing1_query);
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No.&nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<?php echo $noticia_bing1['binname'];?></td>

<?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."'") or die(mysql_error());
$noticia_subbing1 = mysql_fetch_array($subbing1_query)
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No.&nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<?php echo $noticia_subbing1['sname'];?></td>
<td width="300"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" ><tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['ups_good'];?></td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['qty_good'];?></td>
</tr></table></div></td>
</tr>
</table>

<?php
}
else if($flash==1)
{

$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."'") or die(mysql_error());
$noticia_whg2 = mysql_fetch_array($whg2_query);
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg2['perticulars'];?></td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin where binid='".$row_sub_sloc['binid']."'") or die(mysql_error());
$noticia_bing2 = mysql_fetch_array($bing2_query);
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No.&nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing2">&nbsp;<?php echo $noticia_bing2['binname'];?></td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."'") or die(mysql_error());
$noticia_subbing2 = mysql_fetch_array($subbing2_query);
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No.&nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing2">&nbsp;<?php echo $noticia_subbing2['sname'];?></td>
<td width="300"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="48" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['ups_good'];?></td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['qty_good'];?></td>
</tr></table></div></td>
</tr>
</table>
<?php
}
else if($flash==2)
{

$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse where whid='".$row_sub_sloc['whid']."'") or die(mysql_error());
$noticia_whg3 = mysql_fetch_array($whg3_query);
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_whg3['perticulars'];?></td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin where binid='".$row_sub_sloc['binid']."'") or die(mysql_error());
$noticia_bing3 = mysql_fetch_array($bing3_query);
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No.&nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bing3">&nbsp;<?php echo $noticia_bing3['binname'];?></td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin where sid='".$row_sub_sloc['subbin']."'") or die(mysql_error());
$noticia_subbing3 = mysql_fetch_array($subbing3_query);
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No.&nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbing3">&nbsp;<?php echo $noticia_subbing3['sname'];?></td>
		
<td width="305"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['ups_good'];?></td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_sub_sloc['qty_good'];?></td>
</tr></table></div></td>
</tr>
</table>
<?php
}
$flash++;
}
?>


</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form> 
	  
	 