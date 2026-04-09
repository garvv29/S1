<?php
/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
*/	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	 //$pid = $_GET['pid'];	
	 $sdate = $_REQUEST['sdate'];
	 $edate = $_REQUEST['edate'];
     $cid = $_REQUEST['txtclass'];
	$itemid = $_REQUEST['itemid'];
	 //$mtype = $_REQUEST['ret'];
 	//exit;
 	
		if($_GET['txtclass'] != 'ALL')
	 {
	 $ss = "select dest from tbldestination where did='".$_GET['txtclass']."'";
	 		$rr = mysql_query($ss) or die(mysql_error());	 
			$ros = mysql_fetch_array($rr);
			$cls = $ros['dest'];
	 }
	 else
	 {
	 $cls = "ALL";
	 }
	 
			
			$quer3=mysql_query("SELECT did, dest FROM tbldestination  where did='$cid'"); 
 while($noticia = mysql_fetch_array($quer3)) 
 { 
		 $p_name = $noticia['dest'];
		 } 

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

	$dh="Lot_Destination_Report_".$p_name."_From_".$_REQUEST['sdate']."_To_".$_REQUEST['edate'];
	$datahead = array($dh);
	$datahead1 = array("Lot Destination Report");
	$datahead2 = array("Lot Destination: ",$p_name,"  Date From: ",$_REQUEST['sdate'],"  To: ",$_REQUEST['edate']);
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

	 $datatitle1 = array("Date","TransactionType","Lotnumber","Crop","Organiser","Farmer","ProductionLocation","ProductionPersonnel","status");

$d=0;
$sql_tbl1=mysql_query("select * from tbllot order by lotno asc") or die(mysql_error());
while($row_clsss=mysql_fetch_array($sql_tbl1))
{
$dest="";
$fln=$row_clsss['dest'];
	$flnid = split(",",$fln);
	foreach($flnid as $fid)
  	{	
		if($fid<>"")
		{ 
			if($fid==$cid)
			{ //echo "HI";
			
				$lid=$row_clsss['id'];
				//echo $row_clsss['lotnumber'];
				$sql_tbl_sub=mysql_query("select * from tblarrival_sub where lotnoid='".$lid."'") or die(mysql_error());
				$row_tbl_sub=mysql_fetch_array($sql_tbl_sub);
				 $arrival_id=$row_tbl_sub['arid'];
				//echo $itemid;
				if($itemid=='ALL')
				{ 
				$sql_tbl=mysql_query("select * from tblarrival where ardate <= '$edate' and ardate >= '$sdate' and  arid='".$arrival_id."'") or die(mysql_error());
				$row_arr=mysql_fetch_array($sql_tbl);		
				$tot=mysql_num_rows($sql_tbl);	
				}
				else
				{
				$sql_tbl=mysql_query("select * from tblarrival where ardate <= '$edate' and ardate >= '$sdate' and  arid='".$arrival_id."' and trtype='$itemid'") or die(mysql_error());
				$row_arr=mysql_fetch_array($sql_tbl);	
				$tot=mysql_num_rows($sql_tbl);	
				}
				
				$sql_class1=mysql_query("select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysql_error());
				$row_class1=mysql_fetch_array($sql_class1);
				
				$sql_item1=mysql_query("select * from tblfarmer where farmerid='".$row_tbl_sub['farmerid']."'") or die(mysql_error());
				$row_item1=mysql_fetch_array($sql_item1);
				
				$sql_item=mysql_query("select * from tblorganiser where orgid='".$row_tbl_sub['orgid']."'") or die(mysql_error());
				$row_item=mysql_fetch_array($sql_item);
				
				$sql_pro=mysql_query("select * from tblproductionpersonnel where productionpersonnelid='".$row_arr['productionpersonnelid']."'") or die(mysql_error());
				$row_pro=mysql_fetch_array($sql_pro);
				
				$sql_pp=mysql_query("select * from tblproductionlocation where productionlocationid ='".$row_arr['productionlocationid']."'") or die(mysql_error());
				$row_pp=mysql_fetch_array($sql_pp);
				
				$quer0=mysql_query("SELECT varietyid, popularname FROM tblvariety  order by popularname Asc"); 
				$row0=mysql_fetch_array($quer0);
				
				
				$tp="";
				if($row_arr['trtype']=="freshpdn")
				{
					$tp="Fresh Seed with PDN";
				}
				else if($row_arr['trtype']=="Trading")
				{
					$tp="Trading";
				}
				else if($row_arr['trtype']=="UnidentifiedArrival")
				{
					$tp="Unidentified";
				}
				else if($row_arr['trtype']=="Existing")
				{
					$tp="Existing Lot Number Conversion";
				}
				else if($row_arr['trtype']=="LotMerger")
				{
					$tp="Lot Merger";
				}
				else
				{
					$tp="";
				}
				
				$tp1="";
			if($row_cls['impflg'] ==0) { $tp1="IMPN";}
			else if($row_cls['impflg'] ==1) { $tp1="IMPY";}
			else if($row_cls['impflg'] ==2) { $tp1="SUPN";}
	
	$lotstat=$tp1;
				
				$spcodef = $row_arr['spcodef'];
				$spcodem = $row_arr['spcodem'];
				$loc=$row_pp['productionlocation'];
				$per=$row_pro['productionpersonnel'];
				$crop=$row_class1['cropname'];
				$variety=$row0['popularname'];
				$lotno=$row_clsss['lotnumber'];
				$gi=$row_arr['gi'];
				$oldlot = $row_arr['oldlot'];
				$lotmerging=$row_arr['nooflots'];
				$organizer=$row_item['orgname'];
				$farmer=$row_item1['farmername'];
				$plotn=$row_tbl_sub['plotno'];
				
				
				$trdate=$row_arr['ardate'];
				$tryear=substr($trdate,0,4);
				$trmonth=substr($trdate,5,2);
				$trday=substr($trdate,8,2);
				$trdate=$trday."-".$trmonth."-".$tryear;

$data1[$d]=array($trdate,$tp,$lotno,$crop,$organizer,$farmer,$loc,$per,$lotstat); 
$d++;
}
}
}
}
/*}
}*/


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