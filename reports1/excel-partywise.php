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

	$dh="Party_wise_Stock_Report_".$p_name."_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	$datahead1 = array("Party wise Stock Report");
	$datahead2 = array("Party: ",$p_name,"  Date From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
	$datahead3 = array("Classifiction: ",$cls,"  Item: ",$stores_item,"  UoM: ",$uom);
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

	 
	$datatitle1 = array("","","","","Receive");
	$datatitle2 = array("","","","","","","","","","Damage");
	$datatitle3 = array("Date","Particulars","Opening","","DC","","Good","","Arrival Damage","","Internal Damage","","Excess","Shortage","Net","","Issue","","Balance");
	$datatitle4 = array("","","UPS","Qty","UPS","Qty","UPS","Qty","UPS","Qty","UPS","Qty","Qty","Qty","UPS","Qty","UPS","Qty","UPS","Qty");
	

$d=0;
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



$data1[$d]=array($stlg_trdate,$perticulars,$op_trdcups,$op_trdcqty,$rec_trdcups,$rec_trdcqty,$goodups,$goodqty,$damageups,$damageqty,$id_trdcups,$id_trdcqty,$pldg_trexqty,$pldg_trshqty,$slups,$slqty,$iss_trdcups,$iss_trdcqty,$pldg_trbalups,$pldg_trbalqty); 
$d++;
}



# coading ends here............
echo implode($datahead1) ;
echo "\n";

echo implode($datahead2) ;
echo "\n";

echo implode($datahead3) ;
echo "\n";

echo implode("\t", $datatitle1) ;
echo "\n";

echo implode("\t", $datatitle2) ;
echo "\n";

echo implode("\t", $datatitle3) ;
echo "\n";

echo implode("\t", $datatitle4) ;
echo "\n";

	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;