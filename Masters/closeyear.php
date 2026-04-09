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
	
if(isset($_REQUEST['yrsid']))
	{
	$yrsid = $_REQUEST['yrsid'];
	}
	/*if(isset($_REQUEST['month']))
	{
	$month = $_REQUEST['month'];
	}*/
	
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		/*$locdate=$_POST['locdate'];
		//$empid=trim($_POST['empi']);
		if($typ!="a")
		{
		$sql_in="update tbllock set lockdate='$locdate' where lockid='$locid'";
		}
		else
		{
		$sql_in="insert into tbllock (lockdate) values('$locdate')";
		}								
		if(mysql_query($sql_in)or die(mysql_error()))
		{*/
			echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";		
		//}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction- Year cosing</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
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
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.locdate.value=="Select")
{
alert("You must select Date of Locking");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
<table width="370" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle" height="25">Year Closing</td>
</tr>
   
  <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	<input name="frm_action" value="submit" type="hidden"> 
	 <table  border="1" cellspacing="0" cellpadding="0" width="370" align="center" bordercolor="#ffffff" style="border-collapse:collapse">

 <?php
	/*$conn = mysql_connect("localhost","vnrseeds","ZWDAHcMBBb") or die("Error:".mysql_error());
	$db = mysql_select_db("vnrseeds_years") or die("Error:".mysql_error());
	*/
 	$quer3=mysql_query("select * from tblyears where yearsid='$yrsid'"); 
	$noticia3 = mysql_fetch_array($quer3);
	$yr=$noticia3['year_name'];
	$yrid=$yrsid+1;
	
	$sql_yr2=mysql_query("update tblyears set years_flg=0, years_status='c' where yearsid='$yrsid'")or die("Error:".mysql_error());
	
	$sql_yr3=mysql_query("update tblyears set years_flg=1, years_status='a' where yearsid='$yrid'")or die("Error:".mysql_error());
	
	//$yrs="vnrseeds_expro$yr";
	
	
/* backup the db OR just a table */
/*function backup_tables($host,$user,$pass,$name,$tables = '*')
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
		
		//$return.='DROP TABLE '.$table.';';
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

backup_tables('localhost','vnrseeds','ZWDAHcMBBb',$yrs);


	$query=mysql_query("DROP DATABASE $yrs") or die("Error: " . mysql_error());*/
	
 	/*$sql_f=mysql_query("select * from tblclaim where empid='$empid' and month='$month'")or die(mysql_error());
	$tot=mysql_num_rows($sql_f);	
	$row=mysql_fetch_array($sql_f);
	
	$sql_emp=mysql_query("select * from tblemp where emp_id='".$row['empid']."'")or die(mysql_error());
	$row_emp=mysql_fetch_array($sql_emp);
	$empname=$row_emp['emp_fname']." ".$row_emp['emp_lname'];
	
	$sql_in1="update tblclaim set loc=0 where empid='$empid' and month='$month'";
	mysql_query($sql_in1)or die(mysql_error());*/
?>
<tr class="Dark" height="25">
<td align="center"  valign="middle" class="tblheading">You have successfully closed year: <?php echo $yr;?></td>
</tr>

</table>
<table cellpadding="5" cellspacing="5" border="0" width="370">
<tr >
<td align="center" colspan="3"><input type="image" src="../images/close_1.gif" alt="Close" border="0" style="display:inline;cursor:hand;"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
