<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$pid = $_GET['pid'];	
	$sdate = $_REQUEST['sdate'];
	$cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['txtitem'];
	$mtype = $_REQUEST['ret'];
	$sloc = $_REQUEST['chk'];
 	
	
		$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
		$tdate=$tyear."-".$tmonth."-".$tday;
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


	$dh="Stock_on_Hand_Report_as_on_".$_REQUEST['sdate'];
	$datahead = array($dh);
	$datahead1 = array("Stock on Hand Report: ",$mtype);
	$datahead2 = array("As on Date: ",$_REQUEST['sdate']);
	$datahead3 = array("Classifiction: ",$cls);
	$data1 = array();
	
function cleanData(&$str)
	  {
	  	 $str = preg_replace("/\t/", "\\t", $str); 
		 $str = preg_replace("/\n/", "\\n", $str);
	  } 
	   
	    # file name for download $filename = "Order Details.xls";
	    $filename=$dh.".xls";  
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel"); 

	 
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
	 	 
	 $sql.=" order by stlg_trdate DESC";
	 $sql;
	 $rs = mysql_query($sql) or die(mysql_error());	  
	
	$datatitle2 = array("Classification","Item","UoM","Total","");
	if($sloc)
			{
			$ts="SLOC";
			$ts11="";
			array_push($datatitle2,$ts,$ts11,$ts11);
			}
			$ts1="Status";
			
	$datatitle1 = array("","","UPS","QTY");	
		if($sloc)
			{
			$ts="Bin";
			$ts11="UPS";
			$ts12="QTY";
			array_push($datatitle1,$ts,$ts11,$ts12);
			}
			$ts1="";
		
			array_push($datatitle1,$ts1);


$d=0;
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
			
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			
			$uom = $ro['uom'];
	$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$cls."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$sdate'") or die(mysql_error());
	
	$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty="";$sqty=0; $slocs=""; $gd="";  $qt=array(); $up=array();
	while($row_issue=mysql_fetch_array($sql_issue))
 { 
  $slups=0; $slqty=0;
	$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."' and stlg_trdate <= '$sdate'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty >
 0") or die(mysql_error()); 
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
 $slocs=$slocs.$wareh.$binn.$subbinn.", ";
else
 $slocs=$wareh.$binn.$subbinn.", ";

$slups=$slups+$row_issuetbl['stlg_balups'];
$up[] = $slups;
if($sups!="")
$sups=$sups.$slups.", ";
else
$sups=$slups.", ";

$slqty=$slqty+$row_issuetbl['stlg_balqty'];
$qt[] = $slqty;
if($sqty!="")
$sqty=$sqty.$slqty.", ";
else
$sqty=$slqty.", ";
$j++;
}
}
if(array_sum($qt) > $ro['srl'])
{
 $orstatus="";
 }
if($txo=mysql_num_rows($r)>0)
{ 
$data1[$d]=array($clsc,$stores_item,$uom,array_sum($up),array_sum($qt)); 
	
if($sloc)
{
array_push($data1[$d],$slocs);
array_push($data1[$d],$sups);
array_push($data1[$d],$sqty);
}
array_push($data1[$d],$orstatus);
$d++;
}
}
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
	 	 
	 $sql.=" order by stld_trdate DESC";
	 $rs = mysql_query($sql) or die(mysql_error());	  
	
	
	$datatitle2 = array("Classification","Item","UoM","Total","");
	if($sloc)
			{
			$ts="SLOC";
			$ts11="";
			array_push($datatitle2,$ts,$ts11,$ts11);
			}
			$ts1="Status";
			
	$datatitle1 = array("","","UPS","QTY");	
		if($sloc)
			{
			$ts="Bin";
			$ts11="UPS";
			$ts12="QTY";
			array_push($datatitle1,$ts,$ts11,$ts12);
			}
			$ts1="";
		
			array_push($datatitle1,$ts1);


$d=0;
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
			
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
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
 $slocs=$slocs.$wareh.$binn.$subbinn.", ";
else
 $slocs=$wareh.$binn.$subbinn.", ";

$slups=$slups+$row_issuetbl['stld_balups'];
$up[] = $slups;
if($sups!="")
$sups=$sups.$slups.", ";
else
$sups=$slups.", ";

$slqty=$slqty+$row_issuetbl['stld_balqty'];
$qt[] = $slqty;
if($sqty!="")
$sqty=$sqty.$slqty.", ";
else
$sqty=$slqty.", ";
$j++;
}
}
if(array_sum($qt) > $ro['srl'])
{
 $orstatus="";
 }
if(array_sum($qt)>0)
{
if($txo=mysql_num_rows($r)>0)
{
$data1[$d]=array($clsc,$stores_item,$uom,array_sum($up),array_sum($qt)); 
	
if($sloc)
{
array_push($data1[$d],$slocs);
array_push($data1[$d],$sups);
array_push($data1[$d],$sqty);
}
array_push($data1,$orstatus);
$d++;
}
}
}
}


# coading ends here............
echo implode($datahead1) ;
echo "\n";

echo implode($datahead2) ;
echo "\n";

echo implode($datahead3) ;
echo "\n";

echo implode("\t", $datatitle2) ;
echo "\n";

echo implode("\t", $datatitle1) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;