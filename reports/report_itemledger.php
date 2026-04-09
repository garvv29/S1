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
	 
			
			/*$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where p_id='$pid'"); 
 while($noticia = mysql_fetch_array($quer3)) { 
		 $p_name = $noticia['business_name'];
		 } */

//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tblempclaims  where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month between $monthf and $montht group by dept_id"),0); 
 	  
	 /* $sql = "select * from tbl_party_ldg where pldg_trpartyid = '".$pid."' and pldg_trdate <= '$edate' and pldg_trdate >= '$sdate' and pldg_trclassid ='".$cid."' and pldg_tritemid ='".$itemid."' order by pldg_trdate ASC";
	 $rs = mysql_query($sql) or die(mysql_error());  */
	  ?>	  
	 	 <link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<title>Report- Item Ledger Report</title>
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
<table align="center" width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;<a href="excel-itemledger.php?pid=<?php echo $_GET['pid'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&txtclass=<?php echo $_REQUEST['txtclass'];?>&txtitem=<?php echo $_REQUEST['txtitem'];?>&ret=<?php echo $_REQUEST['ret'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onClick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">&nbsp;Stores Item Ledger Report</td>
  </tr>
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">&nbsp;&nbsp; Date: From <?php echo $_GET['sdate'];?> to <?php echo $_GET['edate'];?>&nbsp;<?php ?></td>
  </tr>
  
  </table>

<?php 
//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tblempclaims  where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month between $monthf and $montht group by dept_id"),0); 
 	  /* $sql = "select * from tbl_stldg_good where stlg_trpartyid = $pid and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' order by stlg_trdate DESC";
	 $rs = mysql_query($sql) or die(mysql_error());	 */ 
	  
	  
if($mtype == 'Good')
	{
	
if($_GET['txtitem']!="ALL")
	$sql = "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_trclassid=".$cid." and stlg_tritemid=".$itemid." group by stlg_trdate order by stlg_trdate asc";
	else
	$sql = "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_trclassid=".$cid." group by stlg_trdate order by stlg_trdate asc";
	$rs23 = mysql_query($sql) or die(mysql_error());	 
	
	while($row23 = mysql_fetch_array($rs23))
	{
		$itemid = $row23['stlg_tritemid'];
	$sql = "select * from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_trclassid=".$cid." and stlg_tritemid=".$itemid." group by stlg_trdate order by stlg_trdate asc";
	$rs = mysql_query($sql) or die(mysql_error());	  
	
	 		$s = "select * from tbl_stores where items_id ='".$itemid."'";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
?>
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?> &nbsp;Item: <?php echo $stores_item?> UoM: <?php echo $uom?></td>
  </tr>
  </table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
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
$totups=0; $totqty=0; $totoups=0; $totoqty=0;
$cnt=0;  $rtotalups=0; $rtotalqty=0; $rups=0; $rqty=0; $orups=0; $orqty=0;
$snn=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row['stlg_trclassid']."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' ") or die(mysql_error());
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

$ff=split(",",$sbid);
foreach($ff as $fid)
{	
	if($fid!="")
	{ 
		$sql_new123=mysql_query("select stlg_trdate, stlg_trtype, stlg_trsubtype, sum(stlg_trups), sum(stlg_trqty), sum(stlg_balups), sum(stlg_balqty), sum(stlg_opups), sum(stlg_opqty), stlg_trid from tbl_stldg_good where stlg_trdate='$dt' and stlg_tritemid ='".$row['stlg_tritemid']."' and stlg_subbinid ='$fid' and stlg_balqty >= 0 group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid order by stlg_id asc") or die(mysql_error());
		$ttt=mysql_num_rows($sql_new123);
		if($ttt == 0)
		{
			$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$fid."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate<='$dt'") or die(mysql_error());
			$row_issue1=mysql_fetch_array($sql_issue1); 
			$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty >=0") or die(mysql_error()); 
			$row_n=mysql_fetch_array($sql_issuetbl);
			
			$sql_new1=mysql_query("select stlg_trdate, stlg_trtype, stlg_trsubtype, sum(stlg_trups), sum(stlg_trqty), sum(stlg_balups), sum(stlg_balqty), sum(stlg_opups), sum(stlg_opqty), stlg_trid, stlg_id from tbl_stldg_good where stlg_tritemid='".$row['stlg_tritemid']."' and stlg_id ='".$row_issue1[0]."' and stlg_balqty>=0 group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid order by stlg_id asc") or die(mysql_error());
			$ttt1=mysql_num_rows($sql_new1);
			while($row_new1=mysql_fetch_array($sql_new1))
			{
				$rups=$rups+$row_new1[5];
				$rqty=$rqty+$row_new1[6];
				$orups=$orups+$row_new1[7];
				$orqty=$orqty+$row_new1[8];
			}
		}
	}
}

$sql_new=mysql_query("select stlg_trdate, stlg_trtype, stlg_trsubtype, sum(stlg_trups), sum(stlg_trqty), sum(stlg_balups), sum(stlg_balqty), sum(stlg_opups), sum(stlg_opqty), stlg_trid, yearcode, stlg_id from tbl_stldg_good where stlg_trdate='$dt' and stlg_tritemid ='".$row['stlg_tritemid']."' and stlg_trsubtype!='SUO'  group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid, stlg_subbinid order by stlg_id asc") or die(mysql_error());
while($row_new=mysql_fetch_array($sql_new))
{
//echo $row_new['stlg_id']."  ";
$cn=0;
$ty = $row_new['stlg_trtype'];
$tysub = $row_new['stlg_trsubtype'];
//echo $row_new[6]."<br>";
$totups=$rups+$row_new[5];
$totqty=$rqty+$row_new[6];

$totoups=$orups+$row_new[7];
$totoqty=$orqty+$row_new[8];
//echo $totqty."<br>";
if(($ty == "Arrival") && ($tysub =="Vendor"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Party";
//echo $row_new[9];
$sql_arr=mysql_query("select party_id from tblarrival where arrival_id='".$row_new[9]."'") or die(mysql_error());
if($tot_arr=mysql_num_rows($sql_arr)>0)
{
$row_arr=mysql_fetch_array($sql_arr);
//echo $row_arr['party_id'];
$sql_part=mysql_query("select * from tbl_partymaser where p_id='".$row_arr['party_id']."'") or die(mysql_error());
$tot_part=mysql_num_rows($sql_part);
$row_part=mysql_fetch_array($sql_part);
$perticulars.=" - ".$row_part['business_name'];
}
$cn=0;
}
elseif(($ty == "Arrival") && ($tysub =="Internalreturn"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Internal Return";
$cn=0;
}
elseif(($ty == "Arrival") && ($tysub =="Stocktransfer"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Arrival from Stock Transfer";
$cn=0;
}
elseif(($ty == "Issue") && ($tysub =="pindent"))  
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
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
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Issue on e-Indent - $indent - raised by - $nm";
	$cn=0;
}
elseif(($ty == "Issue") && ($tysub =="stocktr"))  
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Issue Stock Transfer";
	$cn=0;
}
elseif(($ty == "Issue") && ($tysub =="MReturnV"))  
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Issue Material Return to Party";
	$cn=0;
}
elseif(($ty == "IT") && ($tysub =="ITI"))  
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Inter Item Transfer";
	$cn=0;
}
elseif(($ty == "IT") && ($tysub =="ITA"))  
{
	$issups = "";
	$issqty = "";
	$recups = $row_new[3]; 
	$recqty = $row_new[4];
	$perticulars="Inter Item Transfer";
	$cn=0;
}
elseif(($ty == "Arrival") && ($tysub =="OP"))
{
$recups = $row_new[3];
$recqty = $row_new[4];
$issups = ""; 
$issqty = "";
$perticulars="Opening Stock";
$cn=0;
}
elseif($ty == "GD")
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Good to Damage";
	$cn=0;
}
elseif($ty == "DG")
{
	$recups = $row_new[3];
	$recqty = $row_new[4];
	$issups = ""; 
	$issqty = "";
	$perticulars="Damage to Good";
	$cn=0;
}
elseif($ty == "CC")
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Captive Consumption";
	$cn=0;
}
elseif($ty == "CI")
{
$cnn=0;
$s_ci=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row['stlg_trclassid']."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate'") or die(mysql_error());
$t_ci=mysql_num_rows($s_ci);
while($row_ci=mysql_fetch_array($s_ci))
{
	$sql_is1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_ci['stlg_subbinid']."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate<='$edate'") or die(mysql_error());
	$to_is1=mysql_fetch_array($sql_is1); 
	
	$to_n=0;
	$sql_istbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$to_is1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
	$to_n=mysql_num_rows($sql_istbl);
	if($to_n > 0)$cnn++;
}
$sq_ci=mysql_query("select * from tbl_stldg_good where stlg_trtype='CI' and stlg_trclassid='".$row['stlg_trclassid']."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' and stlg_balqty > 0") or die (mysql_error());
$tot_ci=mysql_num_rows($sq_ci);

$s_ci111=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row['stlg_trclassid']."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' ") or die(mysql_error());
$t_ci111=mysql_num_rows($s_ci111);
while($row_ci111=mysql_fetch_array($s_ci111))
{
	$sql_is1111=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_ci111['stlg_subbinid']."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate<='$edate' and stlg_trtype='CI'") or die(mysql_error());
	$to_is1111=mysql_fetch_array($sql_is1111); 
	$to_n111=0;
	$sql_istbl111=mysql_query("select * from tbl_stldg_good where stlg_id='".$to_is1111[0]."' and stlg_balqty > 0 and stlg_trdate > '$dt'") or die(mysql_error()); 
	$to_n111=mysql_num_rows($sql_istbl111);
	if($to_n111 > 0)$cnn--;
}
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
	if($issups<0)$issups=0;
	if($issqty<0)$issqty=0;
	if($recups<0)$recups=0;
	if($recqty<0)$recqty=0;
$perticulars="Cycle Inventory";
}
elseif(($ty == "ES") && ($tysub =="ES"))
{
	$recups = $row_new[3];
	$recqty = $row_new[4];
	$issups = ""; 
	$issqty = "";
	$perticulars="Excess/Shortage - Excess";
	$cn=0;
}
elseif(($ty == "ES") && ($tysub =="SH"))
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Excess/Shortage - Shortage";
	$cn=0;
}
elseif(($ty == "SLOC") && ($tysub =="SUC"))
{
	$recups = "";
	$recqty = "";
	$issups = ""; 
	$issqty = "";
	$perticulars="SLOC Updation ";
	$cn=0;
}
/*elseif(($ty == "SLOC") && ($tysub =="SUO"))
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="Excess/Shortage - Shortage";
	$cn=0;
}*/

	$tdate=$row_new['stlg_trdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

if($cn==0)
{
if($srno%2 != 0)
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
}
else if($mtype == 'Damage')
	{
	if($_GET['txtitem']!="ALL")
	$sql = "select DISTINCT(stld_tritemid),stld_trclassid from tbl_stldg_damage where  stld_trdate <= '$edate' and stld_trdate >= '$sdate' and stld_trclassid =".$cid."  and stld_tritemid =".$itemid." group by stld_trdate order by stld_trdate ASC";
	else
	$sql = "select DISTINCT(stld_tritemid),stld_trclassid from tbl_stldg_damage where  stld_trdate <= '$edate' and stld_trdate >= '$sdate' and stld_trclassid =".$cid."   group by stld_trdate order by stld_trdate ASC";
	$rs23 = mysql_query($sql) or die(mysql_error());
	
	while($row23 = mysql_fetch_array($rs23))
	{
		$itemid = $row23['stlg_tritemid'];
	$sql = "select * from tbl_stldg_damage where  stld_trdate <= '$edate' and stld_trdate >= '$sdate' and stld_trclassid =".$cid."  and stld_tritemid =".$itemid." group by stld_trdate order by stld_trdate ASC";
	$rs = mysql_query($sql) or die(mysql_error());	  
	
	 		$s = "select * from tbl_stores where items_id ='".$itemid."'";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];  
	 ?>
 
  <table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classification: <?php echo $cls?> &nbsp;Item: <?php echo $stores_item?> UoM: <?php echo $uom?></td>
  </tr>
  </table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
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
$sql_new1=mysql_query("select stld_trdate, stld_trtype, stld_trsubtype, sum(stld_trups),sum(stld_trqty),sum(stld_balups),sum(stld_balqty), stld_trid from tbl_stldg_damage where stld_trdate='$dt' and stld_tritemid ='".$row['stlg_tritemid']."' and stld_subbinid ='$fid' group by stld_trtype, stld_trsubtype, stld_trdate, stld_trid order by stld_id asc") or die(mysql_error());
$ttt=mysql_num_rows($sql_new1);
if($ttt == 0)
{
	$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$fid."' and stld_tritemid='".$row['stlg_tritemid']."' and stld_trdate<='$dt'") or die(mysql_error());
	$row_issue1=mysql_fetch_array($sql_issue1); 
	$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
	$row_n=mysql_fetch_array($sql_issuetbl);

	$sql_new1=mysql_query("select stld_trdate, stld_trtype, stld_trsubtype, sum(stld_trups),sum(stld_trqty),sum(stld_balups),sum(stld_balqty), stld_trid, stld_id from tbl_stldg_damage where stld_tritemid ='".$row['stlg_tritemid']."' and stld_id ='".$row_issue1[0]."' group by stld_trtype, stld_trsubtype, stld_trdate, stld_trid order by stld_id asc") or die(mysql_error());
	$ttt=mysql_num_rows($sql_new1);
	while($row_new1=mysql_fetch_array($sql_new1))
	{
		$rups=$rups+$row_new1[5];
		$rqty=$rqty+$row_new1[6];
	}
}
}
}
$sql_new=mysql_query("select stld_trdate, stld_trtype, stld_trsubtype, sum(stld_trups),sum(stld_trqty),sum(stld_balups),sum(stld_balqty), stld_trid, yearcode from tbl_stldg_damage where stld_trdate='$dt' and stld_tritemid ='".$row['stlg_tritemid']."' and stld_trsubtype!='SUO' group by stld_trdate, stld_trid, stld_trtype, stld_trsubtype order by stld_id asc") or die(mysql_error());
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
$sql_arr=mysql_query("select party_id from tblarrival where arrival_id='".$row_new[7]."'") or die(mysql_error());
if($tot_arr=mysql_num_rows($sql_arr)>0)
{
$row_arr=mysql_fetch_array($sql_arr);
//echo $row_arr['party_id'];
$sql_part=mysql_query("select * from tbl_partymaser where p_id='".$row_arr['party_id']."'") or die(mysql_error());
$tot_part=mysql_num_rows($sql_part);
$row_part=mysql_fetch_array($sql_part);
$perticulars.=" - ".$row_part['business_name'];
}
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
	
	$sql1=mysql_query("select * from tbl_ieindent where code='".$row2['dcrefno']."' and yearcode='".$row_new[8]."'")or die(mysql_error());
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
$recups = "";
$recqty = "";
$issups = ""; 
$issqty = "";
$perticulars="SLOC Updation ";
}
/*elseif(($ty == "SLOC") && ($tysub =="SUO"))
{
$issups = $row_new[3];
$issqty = $row_new[4];
$recups = ""; 
$recqty = "";
$perticulars="Excess/Shortage - Shortage";
}*/

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
}

?>			
				
</br>
<table align="center" width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;<a href="excel-itemledger.php?pid=<?php echo $_GET['pid'];?>&sdate=<?php echo $_REQUEST['sdate'];?>&txtclass=<?php echo $_REQUEST['txtclass'];?>&txtitem=<?php echo $_REQUEST['txtitem'];?>&ret=<?php echo $_REQUEST['ret'];?>&edate=<?php echo $_REQUEST['edate'];?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onClick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<!--<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
