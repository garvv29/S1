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
	
	if(isset($_GET['dept']))
	{
	 $dept = $_GET['dept'];	 
	}
	
	if(isset($_GET['monthf']))
	{
	 $monthf = $_GET['monthf'];	 
	}
	
	if(isset($_GET['montht']))
	{
	 $montht = $_GET['montht'];	 
	}
	
	if(isset($_REQUEST['month_year1']))
	{
	 $month_year1 = $_REQUEST['month_year1'];	 
	}
	if(isset($_REQUEST['month_year2']))
	{
	 $month_year2 = $_REQUEST['month_year2'];	 
	}
		
	if(isset($_GET['flg']))
	{
	 $flg = $_GET['flg'];	 
	}
	if(isset($_GET['flg1']))
	{
	 $flg1 = $_GET['flg1'];	 
	}
	
	$subclassification=0;
$quer2=mysql_query("SELECT DISTINCT dept_name,dept_id FROM tbldept where dept_id='$dept'"); 
$row_dept=mysql_fetch_array($quer2);
$deptname=$row_dept['dept_name'];


		$sql_month=mysql_query("select * from tblmonth where month_act_id='$monthf'")or die("Error:".mysql_error());
		$row_month=mysql_fetch_array($sql_month);
		$a=$row_month['month_id'];
		//$month_year1=$row_month['month_year'];	
		
		$sql_month=mysql_query("select * from tblmonth where month_act_id='$montht'")or die("Error:".mysql_error());
		$row_month=mysql_fetch_array($sql_month);
		$b=$row_month['month_id'];
		//$month_year2=$row_month['month_year'];

		if($monthf == "1") $file_month1="January";
	    if($monthf == "2") $file_month1="February";
     	if($monthf == "3") $file_month1="March";
     	if($monthf == "4") $file_month1="April";
     	if($monthf == "5") $file_month1="May"; 
     	if($monthf == "6") $file_month1="June"; 
     	if($monthf == "7") $file_month1="July"; 
     	if($monthf == "8") $file_month1="August"; 
     	if($monthf == "9") $file_month1="September"; 
     	if($monthf == "10") $file_month1="October"; 
     	if($monthf == "11") $file_month1="November"; 
     	if($monthf == "12") $file_month1="December";
		
		if($montht == "1") $file_month2="January";
	    if($montht == "2") $file_month2="February";
     	if($montht == "3") $file_month2="March";
     	if($montht == "4") $file_month2="April";
     	if($montht == "5") $file_month2="May"; 
     	if($montht == "6") $file_month2="June"; 
     	if($montht == "7") $file_month2="July"; 
     	if($montht == "8") $file_month2="August"; 
     	if($montht == "9") $file_month2="September"; 
     	if($montht == "10") $file_month2="October"; 
     	if($montht == "11") $file_month2="November"; 
     	if($montht == "12") $file_month2="December";
		
		
		
		
	$dh="Department wise Composite Report - ".$deptname." - ".$file_month1." ".$month_year1." - ".$file_month2." ".$month_year2;
	$datahead = array($dh);
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
		
	$datatitle2 = array("Month");
			$t=0; $t1=0;
	 		$p_array=explode(";",$flg);
			$i=0;
			foreach($p_array as $val)
				{
				if($val <> "")
				{
				$sq1=mysql_query("SELECT * FROM tblclassification where classification_id='$val'"); 
				$totno = mysql_num_rows($sq1);
				$t=$t+1;
				while($row1 = mysql_fetch_array($sq1))
				{
				$ts=$row1['classification'];
				array_push($datatitle2,$ts);
			 	}}}

			if($flg1 > 0)
			{
	 		$p_array=explode(";",$flg1);
			$i=0;
			foreach($p_array as $val1)
				{
				if($val1 <> "")
				{
$sq1_sub=mysql_query("SELECT * FROM tblsubclassification where subclassification_id='$val1'"); 
$totno_sub = mysql_num_rows($sq1_sub);
$t1=$t1+1;
while($row_sub = mysql_fetch_array($sq1_sub))
{	$sq12=mysql_query("SELECT * FROM tblclassification where classification_id='".$row_sub['classification_id']."'"); 
	$row12 = mysql_fetch_array($sq12);
	
	$tsub=$row12['classification']."/".$row_sub['subclassification'];
	array_push($datatitle2,$tsub);
	
}}}}

$m="Total";
array_push($datatitle2,$m);	
	
	

$grandtot=array(); $grandtotal1=0; $grandtotal2=0; $grandtotal3=0;  $d=0; $data1 = array();	$gt=0; $grand=array();	$grandtotal1=0;		$grand1=array();					
$sql_test=mysql_query("select month from tblempclaims where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and monthid between $a and $b group by month ")or die(mysql_error());															
$test_tot=mysql_num_rows($sql_test);
if($test_tot > 0)
{
while($test=mysql_fetch_array($sql_test))
{ 
		$sql_month=mysql_query("select * from tblmonth where month_act_id='".$test['month']."'")or die("Error:".mysql_error());
		$row_month=mysql_fetch_array($sql_month);
		$m1=$row_month['month_act_id'];

$subtot=array(); $grandtotal=0;

if($m1 == "1") $data1[$d]=array("January"); 
if($m1 == "2") $data1[$d]=array("February"); 
if($m1 == "3") $data1[$d]=array("March"); 
if($m1 == "4") $data1[$d]=array("April"); 
if($m1 == "5") $data1[$d]=array("May"); 
if($m1 == "6") $data1[$d]=array("June"); 
if($m1 == "7") $data1[$d]=array("July"); 
if($m1 == "8") $data1[$d]=array("August"); 
if($m1 == "9") $data1[$d]=array("September"); 
if($m1 == "10") $data1[$d]=array("October"); 
if($m1 == "11") $data1[$d]=array("November"); 
if($m1 == "12") $data1[$d]=array("December"); 


 $grandtotalfa=0; $cltotarr=array(); $subcltotarr=array();  $co=0;

 			$p_array=explode(";",$flg);
			$i=0;
			foreach($p_array as $val)
				{
				if($val <> "")
				{ 
				$totalclass=0;
	 $sql_eclaims=mysql_query("SELECT claim_id from tblempclaims where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month='".$m1."'") or die("Error:".mysql_error());
	//echo  $t=mysql_num_rows($sql_eclaims);echo "<br>";
 while($row_eclaims=mysql_fetch_array($sql_eclaims))
 { 
 $empclaimid=$row_eclaims['claim_id'];
 			
$sql_claim=mysql_query("SELECT * FROM tblclaim where empclaim_id='$empclaimid' and classification_id='$val' and subclassification_id='0' order by datefrom")or die(mysql_error());
$totcl=mysql_num_rows($sql_claim);
while($row_claim = mysql_fetch_array($sql_claim))
	{ 
			$rid=$row_claim['id'];
			$sq1_r=mysql_query("SELECT * FROM tblclaim_total where claim_id='".$rid."'"); 
			while($row_r=mysql_fetch_array($sq1_r))
			{
			$totalclass=$totalclass+$row_r['daytotal_fa'];
			}
	}} 
			$grandtotalfa=$grandtotalfa+$totalclass;
			$cltotarr[$co][]=$totalclass;
			$co++;
			array_push($data1[$d],$totalclass);
}}

$co1=0;
			if($flg1 > 0)
			{
	 		$p_array=explode(";",$flg1);
			$i=0;
			foreach($p_array as $val1)
				{
				if($val1 <> "")
				{
				$totalsubclass=0;
$sql_eclaims=mysql_query("SELECT claim_id from tblempclaims where payment_details!=0 and (payment_date!='--' or payment_date!='0000-00-00') and final_approval_date!='0000-00-00' and dept_id='$dept' and month='".$m1."'") or die("Error:".mysql_error());
 while($row_eclaims=mysql_fetch_array($sql_eclaims))
 {
 $empclaimid=$row_eclaims['claim_id'];
 
$sql_subclass=mysql_query("select * from tblsubclassification where subclassification_id='$val1'")or die(mysql_error());
while($row_subclass=mysql_fetch_array($sql_subclass))
{ 	
$subclassid=$row_subclass['subclassification_id'];
$classid=$row_subclass['classification_id'];

 	$sq12=mysql_query("SELECT * FROM tblclassification where classification_id='".$classid."'"); 
	$row12 = mysql_fetch_array($sq12);

$sql_subclaim=mysql_query("SELECT * FROM tblclaim where empclaim_id=$empclaimid  and classification_id='$classid' and subclassification_id='$subclassid' order by datefrom")or die(mysql_error());
$totscl=mysql_num_rows($sql_subclaim);
while($row_subclaim = mysql_fetch_array($sql_subclaim))
	{ 
			$subrid=$row_subclaim['id'];
			$sq1_subr=mysql_query("SELECT * FROM tblclaim_total where claim_id='".$subrid."'"); 
			while($row_subr=mysql_fetch_array($sq1_subr))
			{
			$totalsubclass=$totalsubclass+$row_subr['daytotal_fa'];
			}
	} 
	}
	}
			$grandtotalfa=$grandtotalfa+$totalsubclass;
			$subcltotarr[$co1][]=$totalsubclass;
			$co1++;
			array_push($data1[$d],$totalsubclass);

}}}
array_push($data1[$d],$grandtotalfa);
$d++;

for($i=0; $i < $t; $i++)
{
$tt = array_sum($cltotarr[$i]); $grand[$i][]=$tt; //echo $tt1; 
}
for($i=0; $i < $t1; $i++)
{
$tt1 = array_sum($subcltotarr[$i]);  $grand1[$i][]=$tt1;  //echo $tt1; 
}
$gt++;
} 
}
$gd=0;

$datatitle3 = array("Grand Total");
for($i=0; $i < $t; $i++)
{
$tt1=array_sum($grand[$i]); 
array_push($datatitle3,$tt1);
$gd=$gd+$tt1; 
}
for($i=0; $i < $t1; $i++)
{
$tt1=array_sum($grand1[$i]); 
array_push($datatitle3,$tt1);
$gd=$gd+$tt1; 
}
array_push($datatitle3,$gd);	



// coading ends here............
echo implode($datahead) ;
echo "\n";

echo implode("\t", $datatitle2) ;
echo "\n";
	
	foreach($data1 as $row1)
		 { 
		 	//array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
echo implode("\t", $datatitle3) ;