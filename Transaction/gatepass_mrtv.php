
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
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
		/*$stores=trim($_POST['stores']);
		$sitem=trim($_POST['txtsid']);
		$empid=trim($_POST['empi']);
			$uom=trim($_POST['uom']);
			$sro=trim($_POST['txtsroid']);
		if($empid == 0)
		{
		?>
		 <script>
		  alert("Can not add HoD.\nReason: HoD already Present for this Department.");
		  </script>
		 <?php
		}
		else
		{
		$zonehead=trim($_POST['txtzonehead']);
		 $sql_in="insert into tblnationalhead(Identification, emp_id, dept_id) values(
											  '$zoneidentification',
											  $empid,
											  $dept
												)";
										
		if(mysql_query($sql_in)or die(mysql_error()))
		{	$id=mysql_insert_id();
			 $sql_in1="update tblemp set	 emp_role='National Head'
											 where emp_id='$empid'";
			 mysql_query($sql_in1)or die(mysql_error());
			 $sql_in2="update tblzone set	 nationalhead_id='$id'
											 where dept_id='$dept'";
			 mysql_query($sql_in2)or die(mysql_error());
			 $sql_in3="update tbluser set	 role='National Head'
			 								 where empid='$empid'";
			 mysql_query($sql_in3)or die(mysql_error());	*/								 
			echo "<script>window.location='gtod_op.php'</script>";	
		}
		//}
	//}


	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transction-Gate Pass</title>
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
                <li><a href="add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
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
                <li> <a href="#">Profile </a> | </li>
                <li>&nbsp; <a href="#">Help </a>| </li>
                <li> &nbsp;<a href="#">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
<!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	       <td width="813" height="25" class="Mainheading">&nbsp;Gate Pass </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);*/
	
	 ?> 
	  <?php 
$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Stocktransfer' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td align="right" width="50%" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>"  >&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+1"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">&nbsp;<?php echo $row_param['address'];?></td>
</tr>
</table>
<br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	
<tr class="Dark" >
<td width="36"  align="left" valign="middle" class="smalltbltext"><span class="smalltblheading">TO</span></td>
<td width="429"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="194"  align="left" valign="middle" class="smalltbltext">Passout</td>
<td width="152"  align="left" valign="middle" class="smalltbltext"></td>
</tr>	
		 <!--/*  </table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >*/-->
		  <tr class="Dark" >
<td width="36" align="right" valign="middle" class="smalltblheading" ></td>
<td width="429"  align="left" valign="middle" class="smalltbltext"> </td>
<td width="194"  align="left" valign="middle" class="smalltbltext">NO</td>
<td width="152"  align="left" valign="middle" class="smalltbltext"></td>

</tr>
	 <tr class="Dark" >
<td width="36" height="20"  align="left" valign="middle" class="smalltbltext"></td>
<td width="429"  align="left" valign="middle" class="smalltbltext"></td>
<td width="194"  align="left" valign="middle" class="smalltbltext">DATE</td>
<td width="152"  align="left" valign="middle" class="smalltbltext"></td>
</tr>	
<tr class="Dark" >
<td width="36"  align="left" valign="middle" class="smalltbltext"></td>
<td width="429"  align="left" valign="middle" class="smalltbltext"></td>
<td width="194"  align="left" valign="middle" class="smalltbltext">GATE INWARD NO</td>
<td width="152"  align="left" valign="middle" class="smalltbltext"></td>
</tr>	
		   </table>


<table align="center" border="1" cellspacing="0" cellpadding="0" width="29" bordercolor="#4ea1e1" style="border-collapse:collapse">
  
  <?php

	/*while($row=mysql_fetch_array($res))
	{
	$resettargetquery=mysql_query("select * from tbl_warehouse where whid='".$row['whid']."'")or die(mysql_error());
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	 $sql_p=mysql_query("select * from tbl_bin where whid='".$row['whid']."'")or die(mysql_error());
  	 $row_p=mysql_fetch_array($sql_p);
	 $num_p=mysql_num_rows($sql_p);

	$sql_v=mysql_query("select * from tbl_subbin where whid='".$row['whid']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	 $num_v=mysql_num_rows($sql_v);
	
	if ($srno%2 != 0)
	{*/
	
?>
  
  <?php
	/*}
	else
	{ */
	 
?>
  
  <?php	/*}
	 $srno=$srno+1;

	}
}
}
}*/
?>
</table>
<br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 		 
		
		<br />
</table>
<table width="850" height="112" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-collapse:collapse"> 
<tr class="tblsubtitle" height="35">
              <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="11%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="12%" rowspan="2" align="center" valign="middle" class="tblheading">Items</td>
			   <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">UOM</td>
			    <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">UPS</td>
			    <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Qty</td>
			    <td colspan="2" height="23" align="center" valign="middle" class="tblheading">PURPOSE</td>
				
			     </tr>
			<tr class="tblsubtitle">
                   <td width="14%" height="40" align="center" valign="middle" class="tblheading">RETURNABLE</td>
				   <td width="17%" align="center" valign="middle" class="tblheading">NOT RETURNABLE</td>
					 </tr>
			<tr class="<?php echo $trcls;?>" height="25">
              <td align="center" class="smalltbltext" valign="middle"><a href="faclaimdetails_view.php?month=<?php echo $month;?>&empid=<?php echo $row['emp_id'];?>&dept=<?php if(isset($_REQUEST['dept'])){ echo $dept;} else { echo "0";} ?>&vid=<?php echo $row['claim_id'];?>"></a>&nbsp;</td>
			  <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
			  <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
              <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" width="11%" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" width="14%" class="smalltbltext" valign="middle" rowspan="2">&nbsp;</td>
				 <td align="center" width="17%" class="smalltbltext" valign="middle">&nbsp;</td>
				 </tr>
				 
</table>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="193" align="right"  valign="middle" class="tblheading">&nbsp;Dispatch Through&nbsp;</td>
<td width="763" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtaddress" cols="50" rows="5" tabindex="" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Dark" >
<td width="143" align="right" valign="middle" class="smalltblheading" rowspan="3">ISSUE NAME  & &nbsp;SIGNATURE</td>
<td width="129"  align="left" valign="middle" class="smalltbltext">____________________</td>

<td width="144" align="right" valign="middle" class="smalltblheading">RECEIVE NAME &&nbsp;SIGNATURE</td>
<td colspan="3" align="left" valign="middle" class="smalltbltext">_____________________</td>
<td width="138" align="right" valign="middle" class="smalltblheading">APPROVED NAME& &nbsp;SIGNATURE</td>
<td width="150" colspan="3" align="left" valign="middle" class="smalltbltext">_______________________</td>
</tr>
		   </table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="select_issue_mrtvop.php?p_id=<?php echo $pid;?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
