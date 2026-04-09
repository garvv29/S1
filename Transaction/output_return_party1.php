<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/
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
<title>Stores-Bin</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">

  
   <!--
function mmLoadMenus() {if (window.mm_menu_0804145533_0) return;
  window.mm_menu_0804145533_0 = new Menu("root",167,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804145533_0.addMenuItem("Classification&nbsp;Master","location='../Masters/home_classification.php'");
  mm_menu_0804145533_0.addMenuItem("Stores&nbsp;Item&nbsp;Master","location='../Masters/stores_home.php'");
  mm_menu_0804145533_0.addMenuItem("Party&nbsp;Master","location='../Masters/party_Masterhome.php'");
  mm_menu_0804145533_0.addMenuItem("SLOC&nbsp;Master","location='../Masters/selectbin.php'");
  mm_menu_0804145533_0.addMenuItem("Parameters&nbsp;Master","location='../Masters/companyhome.php'");
  mm_menu_0804145533_0.addMenuItem("Year&nbsp;Management&nbsp;Master","location='../Masters/current_year.php'");
  mm_menu_0804145533_0.addMenuItem("e-Indent&nbsp;Master","location='../Masters/role_home.php'");
   mm_menu_0804145533_0.addMenuItem("Operator&nbsp;Master","location='../Masters/operator_home.php'");
     //mm_menu_0804145533_0.fontWeight="bold";
   mm_menu_0804145533_0.hideOnMouseOut=true;
   mm_menu_0804145533_0.bgColor='#000000';
   mm_menu_0804145533_0.menuBorder=1;
   mm_menu_0804145533_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804145533_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0804150040_0 = new Menu("root",164,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
   mm_menu_0804150040_0.addMenuItem("Arrival","location='arrival_home.php'");
   mm_menu_0804150040_0.addMenuItem("Issue","location='issue_home.php'");
   mm_menu_0804150040_0.addMenuItem("Captive&nbsp;Consumption","location='c_c_home.php'");
   mm_menu_0804150040_0.addMenuItem("Order&nbsp;Updation","location='reorder.php'");
   mm_menu_0804150040_0.addMenuItem("Sloc&nbsp;Updation","location='add_arrival.php'");
   mm_menu_0804150040_0.addMenuItem("G&nbsp;TO&nbsp;D","location='add_g.php'");
   mm_menu_0804150040_0.addMenuItem("D&nbsp;TO&nbsp;G","location='add_d.php'");
   mm_menu_0804150040_0.addMenuItem("Discard","location='add_discard.php'");
   mm_menu_0804150040_0.addMenuItem("Excess/Shortage","location='add_shortage.php'");
   mm_menu_0804150040_0.addMenuItem("Cycle&nbsp;Inventory","location='home_ci1.php'");
   mm_menu_0804150040_0.hideOnMouseOut=true;
   mm_menu_0804150040_0.bgColor='#000000';
   mm_menu_0804150040_0.menuBorder=1;
   mm_menu_0804150040_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804150040_0.menuBorderBgColor='#FF6600';

  window.mm_menu_0804152609_0 = new Menu("root",231,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804152609_0.addMenuItem("Stock&nbsp;on&nbsp;Hand","location='../reports/stockonhandreport.php'");
  mm_menu_0804152609_0.addMenuItem("Party&nbsp;wise&nbsp;Stock&nbsp;Report","location='../reports/partywiseperiodreport.php'");
  mm_menu_0804152609_0.addMenuItem("Item&nbsp;Ledger","location='../reports/storesitamledger.php'");
  mm_menu_0804152609_0.addMenuItem("Discard&nbsp;Between&nbsp;Dates","location='../reports/discardreport.php'");
  mm_menu_0804152609_0.addMenuItem("Stock&nbsp;Transfer&nbsp;Report","location='../reports/stocktransferreport.php'");
  mm_menu_0804152609_0.addMenuItem("Captive&nbsp;Consumption&nbsp;Report","location='../reports/captiveconsumptionreport.php'");
  mm_menu_0804152609_0.addMenuItem("Reorder&nbsp;Level&nbsp;Report","location='../reports/reorderlevelreport.php'");
  // mm_menu_0804152609_0.fontWeight="bold";
   mm_menu_0804152609_0.hideOnMouseOut=true;
   mm_menu_0804152609_0.bgColor='#000000';
   mm_menu_0804152609_0.menuBorder=1;
   mm_menu_0804152609_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804152609_0.menuBorderBgColor='#FF6600';
   
window.mm_menu_0226134618_0 = new Menu("root",124,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
 mm_menu_0226134618_0.addMenuItem("Sloc&nbsp;Search","location='../utility/selectvendor.php'");
      mm_menu_0226134618_0.fontWeight="bold";
   mm_menu_0226134618_0.hideOnMouseOut=true;
   mm_menu_0226134618_0.bgColor='#000000';
   mm_menu_0226134618_0.menuBorder=1;
   mm_menu_0226134618_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226134618_0.menuBorderBgColor='#FF6600';
   mm_menu_0804152609_0.writeMenus();
} // mmLoadMenus()
//--></script>

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
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#b9d647" >
	    <tr >
	      <td width="810" height="25" class="Mainheading">&nbsp;Material Return to Stores </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  </td>
	  
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
	
	
	$sql_sel="select * from tbl_bin order by binname LIMIT $from, $max_results";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_bin"),0); 

	if($total >0) { 
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Indents (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#b9d647" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="61" align="center" class="tblheading" valign="middle">#</td>
<td width="281" align="left" class="tblheading" valign="middle">&nbsp;Classification</td>
<td width="128" align="center" class="tblheading" valign="middle">Items</td>
<td width="171" align="center" class="tblheading" valign="middle">Uom</td>
<td width="281" align="left" class="tblheading" valign="middle">&nbsp;UPS</td>
<td width="128" align="center" class="tblheading" valign="middle">Quantity</td>
<td width="105" align="center" class="tblheading" valign="middle">Edit</td>
<td width="97" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
		
	$resettargetquery=mysql_query("select * from tbl_bin where binid='".$row['whid']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	$sql_p=mysql_query("select * from tbl_warehouse where whid='".$row['whid']."'");
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);

	$sql_v=mysql_query("select * from tbl_subbin where sid='".$row['sid']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	/*$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	*/
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['perticulars'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_v['sname'];?></td>

<td valign="middle" class="tbltext" align="center"><a href="edit_bin.php?binid=<?php echo $row['binid'];?>"><?php echo $row['binname'];?></a></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_bin.php?binid=<?php echo $row['binid'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><?php if($num_of_records_target_set > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onclick="alert('Cannot be deleted as Employees are Present under this Department')" />
<?php } else { ?><a href="../include/delete.php?print=dept&code=<?php echo $row['dept_id']?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['perticulars'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_V['sname'];?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['perticulars'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_bin.php?binid=<?php echo $row['binid'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><?php if($num_of_records_target_set > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onclick="alert('Cannot be deleted as Employees are Present under this Department')" />
<?php } else { ?><a href="../include/delete.php?print=dept&code=<?php echo $row['dept_id']?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
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
</td>
<td width="30"></td>
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
