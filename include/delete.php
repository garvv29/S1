<?php
	session_start();
	require_once("config.php");
	require_once("connection.php");
	
	if(isset($_GET['print']))
	{
	$print = $_GET['print'];
	$code = $_GET['code'];
	}
	
	if(isset($_GET['id']))
	{
	$id = $_GET['id'];
	}
		
if($print == 'classification'){
		$sql_query="delete from tbl_classification where classification_id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/home_classification.php'</script>";	
		exit;
			}
	}
	
if($print == 'country'){
		$sql_query="delete from tbl_country where country_id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/home_country.php'</script>";	
		exit;
			}
	}
	
if($print == 'stores'){
		$sql_query="delete from tbl_stores where items_id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/stores_home.php'</script>";	
		exit;
			}
	}

	

	
	
if($print == 'party'){
		$sql_query="delete from tbl_partymaser where p_id=".$code;
		if(mysql_query($sql_query) or die(mysql_error()))
			{ 
			echo "<script>window.location='../Masters/party_Masterhome.php'</script>";	
		exit;
			}
	}
	
	
if($print == 'warehouse'){
		$sql_query="delete from tbl_warehouse where whid=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/selectbin.php'</script>";	
		exit;
			}
	}

	
if($print == 'bin'){
		 $sql_query="delete from tbl_bin where binid=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
			 $sql_query1="delete from tbl_subbin where binid=".$code;
			mysql_query($sql_query1) or die(mysql_error());
		echo "<script>window.location='../Masters/bin_home.php?whid=$id'</script>";	
		exit;
			}
	}

	
/*if($print == 'subbin'){
		 $sql_query="delete from tbl_subbin where sid=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/subbin_home.php'</script>";	
		exit;
			}
	}*/

	

	
if($print == 'comp'){
		$sql_query="delete from tbl_parameters where id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/companyhome.php'</script>";	
		exit;
			}
	}	
	
	if($print == 'role'){
		$sql_query="delete from tbl_roles where id=".$code;
		$sql_query1="delete from tbl_user where uid='".$code."' and role='eindent'";
			if(mysql_query($sql_query) or die(mysql_error()))
			{mysql_query($sql_query1) or die(mysql_error());
		echo "<script>window.location='../Masters/role_home.php'</script>";	
		exit;
			}
	}	
	
	if($print == 'opr'){
		$sql_query="delete from tbl_opr where id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/operator_home.php'</script>";	
		exit;
			}
	}	
	if($print == 'report'){
		$sql_query="delete from tbl_report where id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Masters/home_report.php'</script>";	
		exit;
			}
	}		
	/*
	if($print == 'arrival'){
		$sql_query="delete from  tblarrival_sub where arrsub_id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Transaction/add_arrival_vendor.php'</script>";	
		exit;
			}
	}	*/
	
	
	if($print == 'pindent'){
		$sql_query="delete from  tblissue_sub where issuesub_id=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
		echo "<script>window.location='../Transaction/add_issu_physical_indent.php'</script>";	
		exit;
			}
	}					
/*	if($print == 'receive'){
		 				
		 	$sql_rec = "select * from tblreceive where receiveid=".$code;
			$result_rec = mysql_query($sql_rec) or die(mysql_error());
			$row_rec = mysql_fetch_array($result_rec);
			$id=$row_rec['arrivalid'];
			$storagelocationid=$row_rec['storagelocationid'];
			$flnid=$row_rec['flnid'];
			$stockid=$row_rec['stockid'];
			
			$sql_ar = "select * from tblarrival where arrivalid=".$id;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			$spf=$row_ar['spcodef'];
			$qcr=$row_ar['qcrid'];
			
			$sql_in1="update tblarrival set 	receiveid=0,
												qcflag=0 
												where arrivalid = $id";	
			$sql_in2="update tblstoragelocation set 	cropid='',
														focno='',
														fln='',
														qty='' 
														where storagelocationid = $storagelocationid";
			$sql_in3="update tblspcodes set 			foc=''
														where spcode = '$spf'";											


			$sql_in4="update tblqcr set 			flnid=''
													where qcrid = '$qcr'";

			$sql_query_fln="delete from tblfln where flnid=".$flnid;
			$sql_query_stock="delete from tblstockldg where stockid=".$stockid;
			$sql_query="delete from tblreceive where receiveid=".$code;
			
			if(mysql_query($sql_in1) or die(mysql_error()))
			{
			if(mysql_query($sql_in2) or die(mysql_error()))
			if(mysql_query($sql_in3) or die(mysql_error()))
			if(mysql_query($sql_in4) or die(mysql_error()))
			if(mysql_query($sql_query_fln) or die(mysql_error()))
			if(mysql_query($sql_query_stock) or die(mysql_error()))
			if(mysql_query($sql_query) or die(mysql_error()))
		echo "<script>window.location='../transaction/trreceivehome.php?print=delete'</script>";	
		exit;
			}
	}
	
	if($print == 'issue'){
		 				
		 	$sql_rec = "select * from tblissue where issueid=".$code;
			$result_rec = mysql_query($sql_rec) or die(mysql_error());
			$row_rec = mysql_fetch_array($result_rec);
			
			$sptype=$row_rec['sptype'];
			$flnid=$row_rec['flnid'];
			$spcodeid=$row_rec['spcodesid'];
			$issueqty=$row_rec['issueqty'];
			
			$flnid2=$row_rec['flnid2'];
			$spcodeid2=$row_rec['spcodesid2'];
			$issueqty2=$row_rec['issueqty2'];
			
			
			$sql_ar = "select * from tblstock where flnid=".$flnid;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			$bal=$balqty+$issueqty;
			$sql_in1="update tblstock set 		balanceqty=$bal
												where flnid = $flnid";	
			$st=mysql_query($sql_in1) or die(mysql_error());									
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid;
			$s=mysql_query($sql_query_fln) or die(mysql_error());
			
			if($sptype=="Crossing")	
			{	
			$sql_ar = "select * from tblstock where flnid=".$flnid2;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			$bal=$balqty+$issueqty2;
			
			$sql_in12="update tblstock set 		balanceqty=$bal
												where flnid = $flnid2";	
			$st2=mysql_query($sql_in12) or die(mysql_error());										
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid2;
			$s2=mysql_query($sql_query_fln) or die(mysql_error());
			}
			
			$sql_query="delete from tblissue where issueid=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
			echo "<script>window.location='../transaction/trissuehome.php?print=delete'</script>";	
			exit;
			}
	}
	
	if($print == 'issue2'){
		 				
		 	$sql_rec = "select * from tblissue where issueid=".$code;
			$result_rec = mysql_query($sql_rec) or die(mysql_error());
			$row_rec = mysql_fetch_array($result_rec);
			
			$sptype=$row_rec['sptype'];
			$flnid=$row_rec['flnid'];
			$spcodeid=$row_rec['spcodesid'];
			$issueqty=$row_rec['issueqty'];
			
			$flnid2=$row_rec['flnid2'];
			$spcodeid2=$row_rec['spcodesid2'];
			$issueqty2=$row_rec['issueqty2'];
			
			
			$sql_ar = "select * from tblstock where flnid=".$flnid;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			
			$sql_in1="update tblstock set 		balanceqty=$balqty+$issueqty
												where flnid = $flnid";	
			$st=mysql_query($sql_in1) or die(mysql_error());										
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid;
			$s=mysql_query($sql_query_fln) or die(mysql_error());
			
			if($sptype=="Crossing")	
			{	
			$sql_ar = "select * from tblstock where flnid=".$flnid2;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			
			$sql_in12="update tblstock set 		balanceqty=$balqty+$issueqty2
												where flnid = $flnid2";	
			$st2=mysql_query($sql_in12) or die(mysql_error());										
			$sql_query_fln="delete from tblspcodes where spcodesid=".$spcodeid2;
			$s2=mysql_query($sql_query_fln) or die(mysql_error());
			}
			
			$sql_query="delete from tblissue where issueid=".$code;
			$sql_query1="delete from tblfdndetails where issueid=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{if(mysql_query($sql_query1) or die(mysql_error()))
			echo "<script>window.location='../transaction/trissuehome.php?print=delete'</script>";	
			exit;
			}
	}
	
	if($print == 'qcsqnr'){
		 				
		 	/*$sql_rec = "select * from tblqcsqnr where qcsqnrid=".$code;
			$result_rec = mysql_query($sql_rec) or die(mysql_error());
			$row_rec = mysql_fetch_array($result_rec);
			
			$flnid=$row_rec['flnid'];
			$qcrid=$row_rec['qcrid'];
			$issueqty=$row_rec['qcqty'];
			
			
			$sql_ar = "select * from tblstock where flnid=".$flnid;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			$balqty=$row_ar['balanceqty'];
			
			$sql_in1="update tblstock set 		balanceqty=$balqty+$issueqty
												where flnid = $flnid";	
			$st=mysql_query($sql_in1) or die(mysql_error());
													
			 $sql_ar = "select * from tblqcr where qcrid=".$qcrid;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			
			
			$sql_in12="update tblstock set 		qcrqty=0
												where qcrid = $qcrid";	
			$st2=mysql_query($sql_in12) or die(mysql_error());	//									
			
			$sql_query="delete from tblqcsqnr where qcsqnrid=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
			echo "<script>window.location='../transaction/trqcsqnrhome.php?print=delete'</script>";	
			exit;
			}
	}
	
	if($print == 'ci'){
		 	
			$sql_ar = "select * from tblciupdation where ciupdationid=".$code;
			$result_ar = mysql_query($sql_ar) or die(mysql_error());
			$row_ar = mysql_fetch_array($result_ar);
			$id=$row_ar['ci_id'];
			
			$sql_query="delete from tblciupdation where ciupdationid=".$code;
			if(mysql_query($sql_query) or die(mysql_error()))
			{
			echo "<script>window.location='../transaction/tr_ci_output_updation.php?print=delete&id=$id'</script>";	
			exit;
			}
	}*/
	


?>