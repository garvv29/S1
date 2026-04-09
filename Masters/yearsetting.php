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
	
	/*
	if(isset($_POST['frm_action'])=='submit')
	{
	$totyears=trim($_POST['totyr']);	
	$yearold=trim($_POST['year']);
	$year = "expro$yearold";
	
	$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");

	$sql_yr=mysql_query("select * from tblyears where years='$yearold'")or die("Error:".mysql_error());
	$tot_yr=mysql_fetch_array($sql_yr);
	if($totyears > 1)
	{$yrid1=$tot_yr['yearsid']-1;}
	$yrid2=$tot_yr['yearsid'];
	
	$sql_yr2=mysql_query("update tblyears set years_flg=2, years_status='a' where yearsid='$yrid2'")or die("Error:".mysql_error());
	
	if($totyears > 1)
	{
	$sql_yr1=mysql_query("update tblyears set years_flg=1 where yearsid='$yrid1'")or die("Error:".mysql_error());
	$sql_yr3=mysql_query("select * from tblyears where yearsid='$yrid1'")or die("Error:".mysql_error());
	$tot_yr3=mysql_fetch_array($sql_yr3);
	$yrs=$tot_yr3['years']; 
	$yrs="expro$yrs";
	}
	else
	{
	$sql_yr3=mysql_query("select * from tblyears where yearsid='$yrid2'")or die("Error:".mysql_error());
	$tot_yr3=mysql_fetch_array($sql_yr3);
	$yrs=$tot_yr3['years']; 
	$yrs="expro$yrs";
	}

/* backup the db OR just a table 
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	$return='';
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.='DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$sflie='../dbbackup/'.$name;
	$handle = fopen($sflie.'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

backup_tables('localhost','root','',$yrs);

	$query=mysql_query("CREATE DATABASE $year") or die("Error: " . mysql_error());

	$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db($year);
	
	$filename = '../dbbackup/'.$yrs.'.sql';	
		// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line_num => $line) 
{
  // Only continue if it's not a comment
  if (substr($line, 0, 1) != '#' && $line != '' ) 
  {
    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') 
	{
      // Perform the query
      mysql_query($templine) or print('Error performing query \'<b>' . $templine . '</b>\': ' . mysql_error() . '<br /><br />');
      // Reset temp variable to empty
      $templine = '';
    }
  }
}
	echo "<script>window.location='yearmanagement.php'</script>";		
}*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transaction-Current Year</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_0226125625_0) return;
  window.mm_menu_0226125625_0 = new Menu("root",167,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#000000","#dce9a5","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0226125625_0.addMenuItem("Department&nbsp;Master","location='deptmaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("Location&nbsp;Master","location='locationmaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("Employee&nbsp;Master","location='employeemaster_home1.php'");
  mm_menu_0226125625_0.addMenuItem("HOD&nbsp;Master","location='nationalheadmaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("Zone&nbsp;Master","location='zonemaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("Region&nbsp;Master","location='regionmaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("Exp.&nbsp;Classification","location='expclassification_home.php'");
  mm_menu_0226125625_0.addMenuItem("Exp.&nbsp;Sub-Classification","location='expsubclassification_home1.php'");
  mm_menu_0226125625_0.addMenuItem("Exp.&nbsp;Type","location='exptype_home1.php'");
  mm_menu_0226125625_0.addMenuItem("Parameters&nbsp;Master","location='parametermaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("Comments&nbsp;Master","location='comentsmaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("Verifier&nbsp;Master","location='varifiermaster_home.php'");
  mm_menu_0226125625_0.addMenuItem("CD&nbsp;Inward&nbsp;Master","location='cdinward_home.php'");
  mm_menu_0226125625_0.addMenuItem("Payee&nbsp;Master","location='payee_home.php'");
  mm_menu_0226125625_0.addMenuItem("FAQ&nbsp;Master","location='faqhome.php'");
  mm_menu_0226125625_0.addMenuItem("Help&nbsp;Manual&nbsp;Master","location='fhome.php'");
   mm_menu_0226125625_0.fontWeight="bold";
   mm_menu_0226125625_0.hideOnMouseOut=true;
   mm_menu_0226125625_0.bgColor='#000000';
   mm_menu_0226125625_0.menuBorder=1;
   mm_menu_0226125625_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226125625_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0226125858_0 = new Menu("root",164,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#000000","#dce9a5","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0226125858_0.addMenuItem("Approval","location='aindex.php'");
  mm_menu_0226125858_0.addMenuItem("Final&nbsp;Approval","location='faindex.php'");
  mm_menu_0226125858_0.addMenuItem("Payment&nbsp;Updation","location='paymenthome.php'");
  mm_menu_0226125858_0.addMenuItem("Unlocking&nbsp;Claim","location='unlock.php'");
  mm_menu_0226125858_0.addMenuItem("Cancel&nbsp;NIL&nbsp;Claim","location='nilcancel.php'");
  mm_menu_0226125858_0.addMenuItem("Cancel&nbsp;Final&nbsp;Submission","location='finalcancel.php'");
   mm_menu_0226125858_0.fontWeight="bold";
   mm_menu_0226125858_0.hideOnMouseOut=true;
   mm_menu_0226125858_0.bgColor='#000000';
   mm_menu_0226125858_0.menuBorder=1;
   mm_menu_0226125858_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226125858_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0226130008_0 = new Menu("root",124,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#000000","#dce9a5","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0226130008_0.addMenuItem("View&nbsp;Claims","location='view_claims.php'");
   mm_menu_0226130008_0.fontWeight="bold";
   mm_menu_0226130008_0.hideOnMouseOut=true;
   mm_menu_0226130008_0.bgColor='#000000';
   mm_menu_0226130008_0.menuBorder=1;
   mm_menu_0226130008_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226130008_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0226130123_0 = new Menu("root",231,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#000000","#dce9a5","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0226130123_0.addMenuItem("Department&nbsp;wise&nbsp;Composite","location='../reports/deptcomposite.php'");
  mm_menu_0226130123_0.addMenuItem("Zone&nbsp;wise&nbsp;Composite","location='../reports/zonecomposite.php'");
  mm_menu_0226130123_0.addMenuItem("Region&nbsp;wise&nbsp;Composite","location='../reports/regioncomposite.php'");
  mm_menu_0226130123_0.addMenuItem("Employee&nbsp;wise&nbsp;Expense","location='../reports/empexprep.php'");
  mm_menu_0226130123_0.addMenuItem("Turnarround&nbsp;Time-Employeewise","location='../reports/tatr.php'");
  mm_menu_0226130123_0.addMenuItem("SMS&nbsp;Text&nbsp;Report","location='../reports/smstext.php'");
  mm_menu_0226130123_0.addMenuItem("Master&nbsp;Reports","location='../reports/reportmasters.php'");
   mm_menu_0226130123_0.fontWeight="bold";
   mm_menu_0226130123_0.hideOnMouseOut=true;
   mm_menu_0226130123_0.bgColor='#000000';
   mm_menu_0226130123_0.menuBorder=1;
   mm_menu_0226130123_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226130123_0.menuBorderBgColor='#FF6600';

window.mm_menu_0226134618_0 = new Menu("root",124,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#000000","#dce9a5","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0226134618_0.addMenuItem("Hired&nbsp;Vehicle","window.open('hired_vehicle.php','WelCome','top=10,left=50,width=670,height=700,scrollbars=yes')");
   mm_menu_0226134618_0.addMenuItem("Comments&nbsp;View","window.open('comments_view_utility.php','WelCome','top=10,left=50,width=950,height=700,scrollbars=yes')");
   mm_menu_0226134618_0.fontWeight="bold";
   mm_menu_0226134618_0.hideOnMouseOut=true;
   mm_menu_0226134618_0.bgColor='#000000';
   mm_menu_0226134618_0.menuBorder=1;
   mm_menu_0226134618_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226134618_0.menuBorderBgColor='#FF6600';

mm_menu_0226134618_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="../include/mm_menu.js"></script>
<script type="text/javascript" language="javascript" src="../includes/validation.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> 
   
function Openyrclose(yrsid)
{	
	var flg=document.frmcreatedb.flg.value;
	var y2=document.frmcreatedb.y2.value;
	
	if(flg!=0)
	{ alert('Can not close Year before 31st March '+y2+' of this F.Y.');
	return false;
	}
	else
	{
	if(confirm("Do you really want to close this year?"))
	{
		//var locid=document.frmcreatedb.locid.value;
		winHandle=window.open('closeyear.php?yrsid='+yrsid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
	return false;
	}
	}
}

function mySubmit()
{

return true;
}
</SCRIPT>
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1004">
	
	<?php require_once("../include/header_admin.php");?>
	</td>
  </tr>
  <tr>
  <td>
  <table width="1004" height="15" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" height="15"><img src="../images/topleftcorner.gif" width="15" /></td>
  <td width="974" height="15" background="../images/topbg.gif" style="background-repeat:repeat"></td>
  <td width="15" height="15"><img src="../images/toprightcorner1.gif" width="15" style="padding-bottom:0px" /></td>
  </tr>
  </table>
  <table width="1004" height="390" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" background="../images/columnbg.gif" style="background-repeat:repeat; padding-top:0px"></td>
  <td width="974" valign="top">
 
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Master - Current Year </td>
	    </tr></table></td>
	  
	  
	  </tr>
	  </table></td></tr>
	  
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmcreatedb" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<?php
	/*$sql_sel="select * from tbllock";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$row=mysql_fetch_array($res);
	$total=mysql_num_rows($res);
	*/
?>
<tr>
<td width="30">	 </td><td>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="550" bordercolor="#b9d647" style="border-collapse:collapse">
 <tr class="light" height="25">
<td align="center" class="tblheading" valign="middle" colspan="2">Year Management</td>
</tr>
<tr class="Light">
<td align="left" valign="top">
<?php
	/*$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");*/
	
	$sql_yr=mysql_query("select * from tblyears where years_flg =1 and years_status='a'")or die("Error:".mysql_error());
	$tot_yr=mysql_num_rows($sql_yr);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="5">Active Current Financial Year</td>
</tr>
<tr class="Dark" height="25">
<td width="20%" align="center" valign="middle" class="tblheading">Date From</td>
<td width="20%" align="center" valign="middle" class="tblheading">To </td>
<td width="20%" align="center" valign="middle" class="tblheading">Year</td>
<td width="20%" align="center" valign="middle" class="tblheading">Year Code </td>
<td width="20%" align="center" valign="middle" class="tblheading">&nbsp;Activity</td>
</tr>
<?php

$srno=1;$a=1;$flash=0; $y=0; $y2=0;
if($tot_yr > 0)
{
while($row_yr=mysql_fetch_array($sql_yr))
{


$d=date("d-m-Y");
		$tdate=$d;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		if($row_yr['year1'] == $tyear)
		{ 
		$y2=$row_yr['year2']; $y=1;
		}
		else if($row_yr['year2'] == $tyear)
		{ 
		$y2=$row_yr['year2']; $y=2;
		}
		else
		{ 
		$y=0; $flash=0; 
		}
		
		if($y!=0)
		{
			$ldate=$y2."-03-31"; 
			$s=strtotime($tdate); 
			$e=strtotime($ldate);
			if($s < $e)
			{ $flash=1;}
			else
			{ $flash=0; }
		}
		else
		{
		$flash=1; $y2=$row_yr['year2'];
		}
?>
<tr class="Light" height="25">
<td align="center" class="tblheading" valign="middle">1st April</td>
<td align="center" class="tblheading" valign="middle">31st March</td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yr['year1']."-".$row_yr['year2'];?></td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yr['ycode'];?></td>
<td align="center" class="tblheading" valign="middle"><?php if($tot_yr == 1) { if($row_yr['years_flg']==1) { ?><a href="Javascript:void(0);" onclick="Openyrclose('<?php echo $row_yr['yearsid']?>');">Close</a><?php } }?></td>
</tr><input type="hidden" name="cdate" value="<?php echo $d;?>" /><input type="hidden" name="ldate" value="<?php echo $ldate;?>" />
<?php $srno++; $a=$row_yr['yearsid']; 
}$a++; 
}

?> <input type="hidden" name="totyr" value="<?php echo $tot_yr;?>" /><input type="hidden" name="flg" value="<?php echo $flash;?>" /><input type="hidden" name="y2" value="<?php echo $y2;?>" />
</table></td>

</tr>
<tr><td>&nbsp;</td></tr>
<tr class="Light">
<td align="left" valign="top">
<?php
	/*$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");*/
	
	$sql_yrc=mysql_query("select * from tblyears where years_flg =0 and years_status='c'")or die("Error:".mysql_error());
	$tot_yrc=mysql_num_rows($sql_yrc);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="5">Closed Previous Financial Years</td>
</tr>
<tr class="Dark" height="25">
<td width="20%" align="center" valign="middle" class="tblheading">Date From</td>
<td width="20%" align="center" valign="middle" class="tblheading">To </td>
<td width="20%" align="center" valign="middle" class="tblheading">Years</td>
<td width="20%" align="center" valign="middle" class="tblheading">Year Codes </td>
<td width="20%" align="center" valign="middle" class="tblheading">&nbsp;Status</td>
</tr>
<?php

$srnoc=1;
if($tot_yr > 0)
{
while($row_yrc=mysql_fetch_array($sql_yrc))
{
?>
<tr class="Light" height="25">
<td align="center" class="tblheading" valign="middle">1st April</td>
<td align="center" class="tblheading" valign="middle">31st March</td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yrc['year1']."-".$row_yrc['year2'];?></td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yrc['ycode'];?></td>
<td align="center" class="tblheading" valign="middle">Closed</td>
</tr>
<?php $srnoc++;
}
}
?>
</table></td>

</tr>
<tr><td>&nbsp;</td></tr>
<tr class="Light">
<td align="left" valign="top">

<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="2">Note</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">1</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;Active Current Financial year is not allowed to be closed before 31st March of that<br />&nbsp;Financial Year. It can be closed only on 31st March of that year or any date after it.
</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">2</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;When Active Current Financail Year is closed, it is transferred to the list of Closed<br />&nbsp;Previous Financial Years & next New Active Current Financial Year is opened <br />
&nbsp;automatically.</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">3</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;Once Active Current Financial Year is Closed, No Transaction can be entered in that<br />&nbsp;Financial Year.</td>
</tr>
</table></td>


</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="parametermaster_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
</td>
  <td width="15" background="../images/columnbgright1.gif" style="background-repeat:repeat; padding-top:0px"></td>
  </tr>
  </table>
  <table width="1004" height="15" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" height="15"><img src="../images/bottomleft.gif" width="15" /></td>
  <td width="974" height="15" background="../images/bottombg.gif" style="background-repeat:repeat"></td>
  <td width="15" height="15"><img src="../images/bottomright.gif" width="15" style="padding-bottom:0px" /></td>
  </tr>
  </table>
  
 <?php require_once("../include/footer.php");?>
  </td>
  </tr>
</table>

</body>
</html>
