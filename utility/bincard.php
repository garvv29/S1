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
	if(isset($_GET['txtslbing1']))
	{
	 $bid = $_GET['txtslbing1'];
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$sid = $_GET['txtslsubbg1'];
	}
	if(isset($_GET['txtslwhg1']))
	{
	 $whid = $_GET['txtslwhg1'];
	} 
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
?>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
</style>
<title>Utility- Bin Card</title><table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&nbsp;--><img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table><table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" align="center" >
  <tr><td><tr><td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden">
	<?php
$sdate=date("Y-m-d");	
$edate=date("Y-m-d");		
$trows=35;	
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$whid."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);

if($sid=='ALL')
{ 
$subbinn="ALL";
}
else
{
$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$sid."' and binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
}		


if($sid=='ALL')
{ 
$sql_tb="select * from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid";  
}
else
{
$sql_tb="select * from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' and stlg_subbinid='".$sid."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid";  
}
$sql_qry=mysql_query($sql_tb) or die(mysql_error());  
while($row_tbl=mysql_fetch_array($sql_qry))
{

$sql_tbl1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' and stlg_subbinid='".$row_tbl['stlg_subbinid']."' and stlg_tritemid='".$row_tbl['stlg_tritemid']."'") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
//echo $t1=mysql_num_rows($sql_tbl1);

$sql1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tbl1[0]."' and stlg_balqty > 0")or die(mysql_error());

$total_tbl=mysql_num_rows($sql1);

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl['stlg_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl['stlg_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($total_tbl > 0)
{

?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
<tr height="30" >
    <td align="center" class="subheading" style="color:#000000;" colspan="2"><font size="+2">SUB-BIN CARD</font></td>
  </tr>
<tr class="Dark" height="30">
<!--<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Search</td>-->
<td width="199" align="left"  valign="baseline" class="subheading" style="color:#000000;">&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $subbinn;?></td>
<td width="199" align="right"  valign="baseline" class="subheading" style="color:#000000;"><font size="+4"><?php echo $row_binn['binname'];?>/<?php echo $subbinn;?></font>&nbsp;&nbsp;</td>
</tr>
<tr height="25" >
    <td align="left" class="subheading" style="color:#000000;"  colspan="2">&nbsp;Classification: <?php echo $row_class['classification']?> &nbsp;Item: <?php echo $row_item['stores_item']?> &nbsp;UoM: <?php echo $row_item['uom']?></td>
  </tr>
  </table>
      <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#999999" style="border-collapse:collapse">
        <tr  height="20">
          <td width="9%" align="center" rowspan="2" valign="middle" class="tblheading">Date</td>
          <td width="27%" align="left" rowspan="2" valign="middle" class="tblheading">&nbsp;Internal/ST/Vendor</td>
          <td colspan="2" align="center" valign="middle" class="tblheading">Received</td>
          <td colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
          <td colspan="2" align="center" valign="middle" class="tblheading">Closing Balance</td>
          <td width="10%" align="center" rowspan="2" valign="middle" class="tblheading">Signature</td>
        </tr>
        <tr >
          <td width="9%" align="center" valign="middle" class="tblheading">UPS</td>
          <td width="9%" align="center" valign="middle" class="tblheading">Qty</td>
          <td width="9%" align="center" valign="middle" class="tblheading">UPS</td>
          <td width="9%" align="center" valign="middle" class="tblheading">Qty</td>
          <td width="9%" align="center" valign="middle" class="tblheading">UPS</td>
          <td width="9%" align="center" valign="middle" class="tblheading">Qty</td>
        </tr>
        <?php
$srno=1;


while($row_tbl_sub=mysql_fetch_array($sql1))
{

$sql = "select * from tbl_stldg_good where stlg_trdate<='$edate' and stlg_trdate>='$sdate' and stlg_tritemid=".$row_tbl_sub['stlg_tritemid']." group by stlg_trdate order by stlg_trdate asc";
$rs = mysql_query($sql) or die(mysql_error());	  
$t=mysql_num_rows($rs);	
if($t==0)
{
$sql = "select * from tbl_stldg_good where stlg_trdate<='$edate' and stlg_tritemid=".$row_tbl_sub['stlg_tritemid']." group by stlg_trdate order by stlg_trdate desc LIMIT 0,1";
$rs = mysql_query($sql) or die(mysql_error());	  
$t=mysql_num_rows($rs);	
}
while($row = mysql_fetch_array($rs))
{
$dt=$row['stlg_trdate'];


$sql_new123=mysql_query("select stlg_trdate, stlg_trtype, stlg_trsubtype, sum(stlg_trups), sum(stlg_trqty), sum(stlg_balups), sum(stlg_balqty), sum(stlg_opups), sum(stlg_opqty), stlg_trid from tbl_stldg_good where stlg_trdate='$dt' and stlg_tritemid ='".$row_tbl_sub['stlg_tritemid']."' and stlg_subbinid ='$sid' and stlg_balqty >= 0 group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid order by stlg_id asc") or die(mysql_error());
		$ttt=mysql_num_rows($sql_new123);
		if($ttt == 0)
		{
			$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$sid."' and stlg_tritemid='".$row['stlg_tritemid']."' and stlg_trdate<='$dt'") or die(mysql_error());
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



$sql_new=mysql_query("select stlg_trdate, stlg_trtype, stlg_trsubtype, sum(stlg_trups), sum(stlg_trqty), sum(stlg_balups), sum(stlg_balqty), sum(stlg_opups), sum(stlg_opqty), stlg_trid, yearcode, stlg_id from tbl_stldg_good where stlg_trdate='$dt' and stlg_tritemid ='".$row['stlg_tritemid']."' and stlg_subbinid ='$sid' group by stlg_trtype, stlg_trsubtype, stlg_trdate, stlg_trid, stlg_subbinid order by stlg_id asc") or die(mysql_error());
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
elseif(($ty == "SLOC") && ($tysub =="SUO"))
{
	$issups = $row_new[3];
	$issqty = $row_new[4];
	$recups = ""; 
	$recqty = "";
	$perticulars="SLOC Updation";
	$cn=0;
}

	$tdate=$row_new['stlg_trdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;

if($cn==0)
{

if($srno%2!=0)
{

?>
        <tr class="Light" height="30">
    <td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $perticulars;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
    <td width="10%" align="center" valign="middle" class="tblheading"></td>
</tr>
        <?php
}
else
{
?>
        <tr class="Dark" height="30">
    <td align="center" valign="middle" class="tblheading"><?php echo $stlg_trdate;?></td>
	<td align="left" valign="middle" class="tblheading">&nbsp;<?php echo $perticulars;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $recqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $issqty;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
    <td width="10%" align="center" valign="middle" class="tblheading"></td>
        </tr>
        <?php
}
$srno++;
}
}
}
}
}
}
//echo $srno;
for ($x=$srno; $x<=$trows; $x++)
{
?>
<tr class="Dark" height="35">
    <td align="center" valign="middle" class="tblheading"></td>
	<td align="center" valign="middle" class="tblheading"></td>
	<td align="center" valign="middle" class="tblheading"></td>
	<td align="center" valign="middle" class="tblheading"></td>
	<td align="center" valign="middle" class="tblheading"></td>
	<td align="center" valign="middle" class="tblheading"></td>
	<td align="center" valign="middle" class="tblheading"></td>
	<td align="center" valign="middle" class="tblheading"></td>
    <td width="10%" align="center" valign="middle" class="tblheading"></td>
</tr>
<?php
$srno++;
}
?>		
      </table>
</form>

		  
  </td>
  <td width="30"></td>
</tr>
</table>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" /><!--&nbsp;&nbsp;&nbsp;<a href="word_bin.php?whid=<?php echo $whid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;-->&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
