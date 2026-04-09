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
	
	
	/*if(isset($_POST['frm_action'])=='submit')
	{
		$class=trim($_POST['txtclassification']);
		//$cropshort=strtoupper(trim($_POST['txtcropshort']));
		
	$query=mysql_query("SELECT * FROM tblclassification where classification='$class'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Classification is Already Present.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tblclassification(classification) values(
											  '$class'
												)";
											
		if(mysql_query($sql_in)or die(mysql_error()))
		{
			echo "<script>window.location='expclassification_home.php'</script>";	
		}
		}
	}
*/

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Expro-Location Master</title>
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
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#b9d647" >
	    <tr >
	      <td width="810" height="25">&nbsp;Stores Items </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<a href="add_classification.php" style="text-decoration:none; color:#000000"><td align="center" width="130" valign="middle" class="subheading" style="cursor:hand;">Add Classification</td></a>
</tr>

</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php
	
	if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
	$sql_sel="select * from tbllocation order by location LIMIT $from, $max_results";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbllocation"),0); 

	if($total >0) { 
?>
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#b9d647" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Select Party </td>
</tr>
<tr class="Dark">
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=ALL&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">All</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=A&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">A</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=B&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">B</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=C&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">C</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=D&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">D</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=E&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">E</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=F&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">F</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=G&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">G</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=H&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">H</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=I&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">I</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=J&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">J</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=K&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">K</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=L&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">L</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=M&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">M</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=N&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">N</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=O&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">O</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=P&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">P</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=Q&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">Q</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=R&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">R</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=S&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">S</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=T&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">T</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=U&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">U</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=V&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">V</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=W&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">W</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=X&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">X</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=Y&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">Y</a></td>
<td valign="middle" align="center" height="1" class="tbltext"><a href="empexprep1.php?char=Z&dept=<?php echo $dept;?>&monthf=<?php echo $monthf;?>&montht=<?php echo $montht;?>&class=<?php echo $class;?>&subclass=<?php echo $subclass;?>&month_year1=<?php echo $month_year1;?>&month_year2=<?php echo $month_year2;?>" class="link">Z</a></td>
</tr>
		
</table>
<br />

<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
  <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;search Party&nbsp;</td>
<td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtsid" type="text" size="30" class="tbltext" tabindex="0" maxlength="25" />&nbsp;<img src="../images/search.gif" border="0" /> </td>

</tr>
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Stores List  (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#b9d647" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="61" align="center" class="tblheading" valign="middle">#</td>
<td width="281" align="left" class="tblheading" valign="middle">&nbsp;Stores Items</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification<br />
  </td>
<td width="105" align="center" class="tblheading" valign="middle">Edit</td>
<td width="97" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
	
	$resettargetquery=mysql_query("select * from tblemp where location_id=".$row['location_id']);
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	/*$sql_p=mysql_query("select * from tblparent where cropid=".$row['cropid'])or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	$sql_v=mysql_query("select * from tblvariety where cropid=".$row['cropid'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	*/
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['sid'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_of_records_target_set?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_stores.php?sid=<?php echo $row['sid_id'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><?php if($num_of_records_target_set > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onclick="alert('Cannot be deleted as Employees are Present under this Location')"  />
<?php } else { ?><a href="../include/delete.php?print=classification&code=<?php echo $row['clid_id']?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_of_records_target_set?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_stores.php?lid=<?php echo $row['clid_id'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><?php if($num_of_records_target_set > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onclick="alert('Cannot be deleted as Employees are Present under this Location')"  />
<?php } else { ?><a href="../include/delete.php?print=classification&code=<?php echo $row['clid_id']?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
?>
</table>
<?php
	$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='750' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; 
}

?>
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
