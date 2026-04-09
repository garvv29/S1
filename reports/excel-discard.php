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
	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	$cid = $_REQUEST['txtclss'];
	$itemid = $_REQUEST['txtitem'];
	 
	
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
	 	 
	 if($_GET['txtclss'] != 'ALL')
	 {
	$ss = "select classification from tbl_classification where classification_id='".$_GET['txtclss']."'";
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['classification'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }
 	
	 $sql = "select * from tbl_stldg_damage where stld_trdate <= '$edate' and stld_trdate >= '$sdate' and stld_trtype ='Discard' and stld_trsubtype ='MD' ";

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
		 
	$dh="Discard_Report_From_".$stdate."_To_".$etdate;
	$datahead = array($dh);
	$datahead1 = array("Discard Report");
	$datahead2 = array("Classification: ",$cls,"  Date From: ",stdate,"  To: ",etdate);
	
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


	$datatitle1 = array("Date","Perticulars","Classification","Item","UPS","Quantity");
 

$d=0;
while($row=mysql_fetch_array($rs))
	{
	$id=$row['stld_trid'];
	$itemid=$row['stld_tritemid'];
	$cls=$row['stld_trclassid'];
	$stlg_trdate=$row['stld_trdate'];
	$stlg_trups=$row['stld_trups'];
	$stlg_trqty=$row['stld_trqty'];
	$stld_trpartyid=$row['stld_trpartyid'];
	
	
			$s = "select * from tbl_stores where items_id='".$itemid."'";
	 		$r = mysql_query($s) or die(mysql_error());	 
			$ro = mysql_fetch_array($r);
			$stores_item = $ro['stores_item'];
			if($ro['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			$uom = $ro['uom'];
			
			$ss1 = "select classification from tbl_classification where classification_id=".$cls;
	 		$rr1 = mysql_query($ss1) or die(mysql_error());	 
			$ros1 = mysql_fetch_array($rr1);
			$classification=$ros1['classification'];
			
	$tdate=$stlg_trdate;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$stlg_trdate=$tday."-".$tmonth."-".$tyear;
		
		
		$quer3=mysql_query("SELECT * FROM tbl_discard where tid='".$id."'"); 
 		$noticia = mysql_fetch_array($quer3);
 		$p_name=$noticia['party_name'];
 		

	
$data1[$d]=array($stlg_trdate,$p_name,$stores_item,$classification,$stlg_trups,$stlg_trqty); 
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