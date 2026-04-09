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
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<title>Report- Stock onhand Report</title>
<table width="800" align="center" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="800" align="right">&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_bin.php?whid=<?php echo $whid?>"></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
<table  align="center"  width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
 
<?php 
 	 $pid = $_GET['pid'];	
	$sdate = $_REQUEST['sdate'];
	//$edate = $_REQUEST['edate'];
	$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtitem'];
	$mtype = $_REQUEST['ret'];
	$sloc = $_REQUEST['chk'];
	
	
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
	 
	 if($mtype=='Good') 
	 {
	 
	 $sql = "select DISTINCT(stlg_tritemid),stlg_trclassid from tbl_stldg_good where stlg_trdate <= '$sdate'";
	
	 if(!is_numeric($cid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stlg_trclassid =".$cid;
	 }
	 
	 if(!is_numeric($itemid))
	 {
	 $sql.="";
	 }
	 else
	 {
	 $sql.=" and stlg_tritemid =".$itemid;
	 }
	 	 
	 $sql.=" order by stlg_trclassid";
	 $sql;
	 $rs = mysql_query($sql) or die(mysql_error());	  
	
	 ?>
	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Stock on Hand Report: <?php echo $_GET['ret'];?></td>
  </tr>
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">As on Date: <?php echo $_GET['sdate'];?></td>
  </tr>
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classifiction: <?php echo $cls?></td>
  </tr>
  </table>
  
  <table  align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
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
	  
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
   <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Stock on Hand Report: <?php echo $_GET['ret'];?></td>
  </tr>
  <tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">As on Date: <?php echo $_GET['sdate'];?></td>
  </tr>
  <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Classifiction: <?php echo $cls?></td>
  </tr>
  </table>
  
  <table align="center"  border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
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
<table align="center" width="800" cellpadding="0" cellspacing="0" border="0" >
<tr>
<td align="center" valign="middle" class="smalltbltext">R - Reorder Level, &nbsp;&nbsp;&nbsp;OR - Reorder Level Order Placed </td>
</tr>
</table>
	
</form> 
	  </td>
	  </tr>
	  </table><br/>
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse">
<tr >
<td width="800" align="right">&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:hand;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<a href="word_bin.php?whid=<?php echo $whid?>"></a>&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:hand;" onClick="window.close()" /></td>
</tr>
</table>
