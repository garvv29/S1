<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");*/
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$perticulars=trim($_POST['txtperticulars']);
		$id=trim($_POST['txtwh']);
		$whid=trim($_POST['txtwh']);
			{
		//$id=trim($_POST['txtsid']);
		
		$query=mysql_query("SELECT * FROM tbl_bin where binname='$perticulars'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {
		 ?>
		 <script>
		  alert("This bin is Already Present.");
		  </script>
		 <?php }
		 else 
		{
	 	
		
 	   $sql_in="insert into tbl_bin(binname,whid)values('$perticulars','$whid')";
					//exit;							
		if(mysql_query($sql_in)or die(mysql_error()))
		{*/
			echo "<script>window.location='add_indents1.php'</script>";	
		}
		
	
//}
//}
//}

	
?>



  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
            <ul  id="nav">
            <li><a href="#"> Masters </a>
              <ul>
                <li><a href="../Masters/home_classification.php" >&nbsp;Classification&nbsp;Master</a></li>
                <li><a href="../Masters/stores_home.php" >&nbsp;Item&nbsp;Master</a></li>
                <li><a href="../Masters/party_Masterhome.php" >&nbsp;Party&nbsp;Master</a></li>
                <li><a href="../Masters/selectbin.php" >&nbsp;SLOC&nbsp;Master</a></li>
                <li><a href="../Masters/role_home.php" >&nbsp;e-indent&nbsp;Master</a></li>
                <li><a href="../Masters/operator_home.php" >&nbsp;Operator&nbsp;Master</a></li>
				<li><a href="../Masters/viewers_home.php" >&nbsp;Viewers&nbsp;Master</a></li>
				<li><a href="../Masters/home_report.php" >&nbsp;Reports&nbsp;Master</a></li>
                <li><a href="../Masters/companyhome.php" >&nbsp;Parameters&nbsp;Master</a></li>
                <li><a href="../Masters/current_year.php" >&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
              </ul>
            </li>
            <li><a href="#">Transactions </a>
              <ul>
                <li><a href="Transaction/add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="Transaction/add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="Transaction/add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="Transaction/home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="Transaction/home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="Transaction/home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
              </ul>
            </li>
            <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				 <?php
			  if($role == "admin")
			  {
			  ?>
				<li><a href="../reports/masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
				<?php
				}
				?>
              </ul>
            </li><li>
            <a href="#">Utility </a>
             <ul>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_bincard.php','WelCome','top=10,left=50,width=950,height=800,scrollbars=yes')" >&nbsp;Sub-Bin&nbsp;Card</a></li>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li> <?php if($role == "admin")
			  {
			  ?>
			  <li><a href=" Javascript:void(0)" onClick="window.open('../utility/backup.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Backup</a></li>
			  <?php }?>
           </ul>   </li>
            </ul>
            </div>
            </div>
            <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
               <li> <a href="adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>  <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="stores_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;">Transction</a> Issue- Indents </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);*/
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
      <td width="174" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
      <td width="133" align="left"  valign="middle">&nbsp;</td>
        
      <td width="118" height="24"  align="right"  valign="middle" class="tblheading">Issue&nbsp;Date&nbsp;</td>
      <td width="215" align="left"  valign="middle">&nbsp;</td>
</tr>
<tr class="Dark" height="25">
      <td width="174" height="24"  align="right"  valign="middle" class="tblheading">Indent No&nbsp;</td>
      <td align="left"  valign="middle" colspan="3">&nbsp;</td>
</tr>

</table>
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Pending Indents  (<?php //=$total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="25" align="center" class="tblheading" valign="middle">#</td>
<td width="100" align="center" class="tblheading" valign="middle">Date </td>
<td width="72" align="center" class="tblheading" valign="middle">Indent No </td>
<td width="90" align="center" class="tblheading" valign="middle">Stage </td>
<td width="92" align="center" class="tblheading" valign="middle">Raised By </td>
<td width="67" align="center" class="tblheading" valign="middle">Edit</td>
<td width="104" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
//$srno=1;
	/*while($row=mysql_fetch_array($res))
	{
	
	 $resettargetquery=mysql_query("select * from tbl_roles where id='".$row['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	$sql_p=mysql_query("select * from tblzone where dept_id=".$row['dept_id'])or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	$sql_v=mysql_query("select * from tblregion where dept_id=".$row['dept_id'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	
	if ($srno%2 != 0)
	{
	*/
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center">1</td>
<td valign="middle" class="tbltext" align="center">01/04/2009</td>
<td valign="middle" class="tbltext" align="center"><a href="add_indents.php">12345</a></td>
<td valign="middle" class="tbltext" align="center">ABC</td>
<td valign="middle" class="tbltext" align="center">ABC</td>
  <td width="67" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand" /></td>
</tr>
<?php
/*	}
	else
	{ 
	 */
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center">2</td>
<td valign="middle" class="tbltext" align="center">02/04/2009</td>
<td valign="middle" class="tbltext" align="center"><a href="add_indents.php">12346</a></td>
<td valign="middle" class="tbltext" align="center">XYZ</td>
<td valign="middle" class="tbltext" align="center">ABC</td>
<td width="67" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand" /></td>
</tr>
<?php	/*}
	 $srno=$srno+1;
	}
}*/
?>
</table><br />



<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_indents.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
</body>
</html>


