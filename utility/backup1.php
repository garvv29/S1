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
	ini_set("memory_limit","80M");
	
$yrs="stores";
$db_host = "localhost";
$db_name = $yrs;
$db_user = "root";
$db_pass = "";
mysql_connect($db_host,$db_user,$db_pass);
@mysql_select_db($db_name) or die("Unable to select database.");
function datadump ($table) 
{
//$result="";  
   $result .= "# Dump of $table \n";
    $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";
    $query = mysql_query("select * from $table");
    $num_fields = @mysql_num_fields($query);
    $numrow = mysql_num_rows($query);
	
	
    for ($i =0; $i<$numrow; $i++)
	{
	while($row = mysql_fetch_row($query))
	{
      $result .= "INSERT INTO ".$table." VALUES(";
          for($j=0; $j<$num_fields; $j++)
		  {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) $result .= "\"$row[$j]\"" ; else $result .= "\"\"";
          if ($j<($num_fields-1)) $result .= ",";
         }   
      $result .= ");\n";
     }}
     return $result . "\n\n\n";
  }
$table1 = datadump ("tbl_bin");$table2 = datadump ("tbl_captive");$table3 = datadump ("tbl_captive_sloc");$table4 = datadump ("tbl_captivesub");$table5 = datadump ("tbl_ci");$table6 = datadump ("tbl_ciupdation");$table7 = datadump ("tbl_classification");$table8 = datadump ("tbl_discard");$table9 = datadump ("tbl_discard_sloc");$table10 = datadump ("tbl_discard_sub");$table11 = datadump ("tbl_dtog");$table12 = datadump ("tbl_dtog_sub");$table13 = datadump ("tbl_ecaptive");$table14 = datadump ("tbl_eindents");$table15 = datadump ("tbl_excess");$table16 = datadump ("tbl_excess_sub");$table17 = datadump ("tbl_gate");$table18 = datadump ("tbl_gtod");$table19 = datadump ("tbl_gtod_sub");$table20 = datadump ("tbl_icaptive");$table21 = datadump ("tbl_ieindent");$table22 = datadump ("tbl_ieindent_sub");$table23 = datadump ("tbl_iitr");$table24 = datadump ("tbl_iitr_sub");$table25 = datadump ("tbl_ireturn");$table26 = datadump ("tbl_issuestock");$table27 = datadump ("tbl_opr");$table28 = datadump ("tbl_order");$table29 = datadump ("tbl_parameters");$table30 = datadump ("tbl_party_ldg");$table31 = datadump ("tbl_partymaser");$table32 = datadump ("tbl_pindents");$table33 = datadump ("tbl_report");$table34 = datadump ("tbl_roles");$table35 = datadump ("tbl_sloc");$table36 = datadump ("tbl_sloc_sub");$table37 = datadump ("tbl_stldg_damage");$table38 = datadump ("tbl_stldg_good");$table39 = datadump ("tbl_stock");$table40 = datadump ("tbl_stores");$table41 = datadump ("tbl_subbin");$table42 = datadump ("tbl_user");$table43 = datadump ("tbl_viewer");$table44 = datadump ("tbl_warehouse");$table45 = datadump ("tblarr_sloc");$table46 = datadump ("tblarrival");$table47 = datadump ("tblarrival_sub");$table48 = datadump ("tblissue");$table49 = datadump ("tblissue_sloc");$table50 = datadump ("tblissue_sub");$table51 = datadump ("tblyears"); 
$content = $table1.$table2.$table3.$table4.$table5.$table6.$table7.$table8.$table9.$table10.$table11.$table12.$table13.$table14.$table15.$table16.$table17.$table18.$table19.$table20.$table21.$table22.$table23.$table24.$table25.$table26.$table27.$table28.$table29.$table30.$table31.$table32.$table33.$table34.$table35.$table36.$table37.$table38.$table39.$table40.$table41.$table42.$table43.$table44.$table45.$table46.$table47.$table48.$table49.$table50.$table51;
$file_name="Backup_".$yrs."_".date("d-m-Y").'.sql';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$file_name");
echo $content;exit;?>