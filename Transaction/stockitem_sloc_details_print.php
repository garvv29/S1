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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['remarks']))
	{
	$remarks = $_REQUEST['remarks'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction- Arrival From Stock Transafer</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
<?php  
$sql_item=mysql_query("select * from tbl_stores where items_id='".$itmid."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$sql1=mysql_query("select * from tblarr_sloc where item_id='".$itmid."' order by whid")or die(mysql_error());
?>
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <?php 
$tid=$itmid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Stocktransfer' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading"> Arrival from Stock Transfer </td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "AS".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="101" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="259" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
$row3=mysql_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Stock Transfer from&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row3['business_name'];?></td>
	<td align="right"  valign="middle" class="tblheading">STN No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['stnno'];?></td>

           </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<?php echo $row3['address'];?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Light" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="99" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="99" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());

?>
			 <tr class="tblsubtitle" height="20">
              <td width="2%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="14%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">UoM</td>
                <td colspan="8"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="4" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
              </tr>
			<tr class="tblsubtitle">
			  <td colspan="2" align="center" valign="middle" class="tblheading">DC</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Good</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Excess/<br />
Shortage</td>
			  </tr>
			<tr class="tblsubtitle">
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
					<td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
					<td width="2%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="9%" align="center" valign="middle" class="tblheading">Bin</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_qty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $g=""; $d=""; $gd="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>			 <td align="center" valign="middle" class="tblheading"><?php echo $gd;?></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			 <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_qty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $g=""; $d=""; $gd="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>			 <td align="center" valign="middle" class="tblheading"><?php echo $gd;?></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			 <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
 </tr> 
<?php
}
$srno++;
}
}
?>  			  
          </table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="117" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="627" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $remarks;?></td>
</tr>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
