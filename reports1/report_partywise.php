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
?>
<?php 
	 $pid = $_GET['pid'];	
	 $sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
	 $cid = $_REQUEST['txtclass'];
	 $itemid = $_REQUEST['txtitem'];
	 $mtype = $_REQUEST['ret'];
 	 
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
	 
	 $s = "select * from tbl_stores where items_id = $itemid";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			
			$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where p_id='$pid'"); 
 while($noticia = mysql_fetch_array($quer3)) { 
		 $p_name = $noticia['business_name'];
		 } 

 	  
	   $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <= '$edate' and pldg_trdate >= '$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysql_query($sql) or die(mysql_error());  
	 
	 $tdate=$sdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$sdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate=$edate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$edate=$tday."-".$tmonth."-".$tyear;
	  ?>	  
	 	 <link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<title>-Report- Party Wise Report</title>
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>

<table align="center" width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Party wise Stock Report</td>
  </tr>
  </table>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Party: <?php echo $p_name;?>&nbsp;&nbsp; Date From: <?php echo $sdate;?> To <?php echo $edate;?>&nbsp;<?php ?></td>
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
while($row1=mysql_fetch_array($rs))
	{
	$clsid=$row1['pldg_trclassid'];
	$itemid=$row1['pldg_tritemid'];
	
	
			$ss = "select classification from tbl_classification where classification_id='".$clsid."'";
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['classification'];		 
			 
			 
			 $s = "select * from tbl_stores where items_id='".$itemid."'";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			
			$sql1 = "select * from tbl_party_ldg where pldg_tritemid='".$itemid."' order by pldg_trdate ASC";
	 $rs1 = mysql_query($sql1) or die(mysql_error());


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
$id_trdcups = $row1['pldg_trdamageups'];
$id_trdcqty = $row1['pldg_trdamageqty'];
$damageups = "";
$damageqty = "";
}
else
{
$damageups = $row1['pldg_trdamageups'];
$damageqty = $row1['pldg_trdamageqty'];
}
$goodups = $row1['pldg_trgoodups'];
$goodqty = $row1['pldg_trgoodqty'];


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
</br>
<table align="center" width="950" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
