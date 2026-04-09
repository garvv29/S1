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
	 $edate = $_REQUEST['edate'];
	 
 		$tdate=$sdate;
		$tday=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tyear=substr($tdate,8,2);
		$stdate=$tyear."-".$tmonth."-".$tday;
	
		$tdate=$edate;
		$tday=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tyear=substr($tdate,8,2);
		$etdate=$tyear."-".$tmonth."-".$tday;
	 	 
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where p_id=$pid"); 
 while($noticia = mysql_fetch_array($quer3)) { 
		 $p_name = $noticia['business_name'];
		 } 
		 
	$dh="Captive_Consumption_Report_".$p_name."_From_".$stdate."_To_".$etdate;
	$datahead = array($dh);
	$datahead1 = array("Captive Consumption Report");
	$datahead2 = array("Party: ",$p_name,"  Date From: ",stdate,"  To: ",etdate);
	
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


 $sql = "select * from tbl_stldg_good where stlg_trpartyid = '$pid' and stlg_trdate <= '$edate' and stlg_trdate >= '$sdate' and stlg_trtype = 'CC' and stlg_trsubtype='CC' order by stlg_trdate DESC";
	 $rs = mysql_query($sql) or die(mysql_error());	  	 

	$datatitle1 = array("Date","Classification","Item","UOM","UPS","Quantity");
 

$d=0;
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
			
	$stlg_trdate = $row['stlg_trdate'];
	
	
	$ty = $row['stlg_trtype'];
$tysub = $row['stlg_trsubtype'];
if(($ty == "CC") && ($tysub =="CC"))
{
$issups = $row['stlg_trups'];
$issqty = $row['stlg_trqty'];
}
elseif(($ty == "CC") && ($tysub =="CC"))  
{
$issups = $row['stlg_trups'];
$issqty = $row['stlg_trqty'];
}	
	
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
	
	
$data1[$d]=array($stlg_trdate,$cls,$stores_item,$uom,$issups,$issqty); 
$d++;
}

# coading ends here............
echo implode($datahead1) ;
echo "\n";

echo implode($datahead2) ;
echo "\n";

echo implode("\t", $datatitle1) ;
echo "\n";

	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;