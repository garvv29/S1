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
		
	$logid="opr1";
	$lgnid="OP1";	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
		if(isset($_POST['frm_action'])=='submit')
	{	exit;
		$code=trim($_POST['txtcode']);
		$date=trim($_POST['date']);
		$add=trim($_POST['txtaddress']);
		$pid=trim($_POST['txtcla']);
		$pdc=trim($_POST['txtpdc']);
		$mode=trim($_POST['txt1']);
		$tname=trim($_POST['txttname']);
		$lrn=trim($_POST['txtlrn']);
		$pmode=trim($_POST['txtp']);
		$vno=trim($_POST['txtvn']);
		$cname=trim($_POST['txtcname']);
		$dno=trim($_POST['txtdocket']);
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		//$sid=trim($_POST['txtsbin']);
		/*
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
	 	*/
echo	$sql_in="insert into tbl_materialreturn (code, date, p_id ,address,pdcno, mode, tname, lrno, vno,pmode,cname, docketno) values ($code,'$tdate','$pid', '$add','$pdc','$mode', '$tname', '$lrn', '$vno','$pmode', '$cname','$dno')";				
		if(mysql_query($sql_in)or die(mysql_error()))
		{
			echo "<script>window.location='select_vendorop.php'</script>";	
		}
		
	
}
//}
//}


$sql_code="SELECT MAX(arrival_code) FROM tbl_materialreturn where arrival_type='Vendor' ORDER BY arrival_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="AV".$code."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="AV".$code."/".$lgnid;
		}

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transaction - Issue- Material Return to Vendor</title>
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
<script language="JavaScript">
function mySubmit()
{ 
	if(document.frmaddDepartment.fet1.value == "")
{
alert("Please select Arrival");
return false;
}
	return true;	 
}
function test1(fet11)
{
if (fet11!="")
{
document.frmaddDepartment.fet1.value=fet11;
}
}	
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
             <li><a href="#">Transactions </a>
              <ul>
                <li><a href="arrival_home.php" >&nbsp;Arrival</a></li>
                <li><a href="issue_home.php" >&nbsp;Issue</a></li>
                <li><a href="c_c_home.php" >&nbsp;Captive&nbsp;Consumption</a></li>
				<li><a href="add_discard.php" >&nbsp;Material&nbsp;Discard</a></li>
				<li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
                <li><a href="add_arrival.php" >&nbsp;SLOC&nbsp;Updation</a></li>
				<li><a href="reorder.php" >&nbsp;Order&nbsp;Placement&nbsp;at&nbsp;Reorder</a></li>
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
				 <li><a href="../reports/statusreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
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
              <ul style="vertical-align:text-top"><li> <a href="adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>  <li> &nbsp;<a href="../logout.php">Logout </a> </li>
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
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Issue- Material Return to Vendor</td>
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
<td><br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Issue Material Return to Vendor </td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <tr class="Dark" height="25">
           <td width="171" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="254"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="8" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $code1?>"/></td>

<td width="76" align="right" valign="middle" class="tblheading">Material Return &nbsp;Date&nbsp;</td>
<td width="239" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
		   </tr>
		
		<?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where classification='Vendor'"); 
?>
		 <tr class="Light" height="25">
           <td width="128" height="24"  align="right"  valign="middle" class="tblheading"> Party Name &nbsp;</td>
           <td align="left"  valign="middle" colspan="5">&nbsp;<select class="tbltext" name="txtcla" style="width:150px;background-color:#CCCCCC" onchange="showUser(this.value);">
<option value="" selected>--Select Vendor--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		   <?php
$quer4=mysql_query("SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
		   <tr class="Dark" height="25">
			 <td width="128"  align="right" valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
    <td colspan="5" align="left"  valign="top" class="tbltext" id="vaddress">&nbsp;&nbsp;</td>
         </tr>
		
 
           <td width="128" height="24"  align="right"  valign="middle" class="tblheading">Party DC Ref. Number&nbsp;</td>
           <td align="left"  valign="middle"  colspan="5">&nbsp;<input name="txtpdc" type="text" size="20" class="tbltext" tabindex="0" maxlength="20" /></td>
</tr>
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
 </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="21" align="center" class="tblheading" valign="middle">#</td>
    <td width="171" align="left" class="tblheading" valign="middle">&nbsp;Classification</td>
    <td width="100" align="center" class="tblheading" valign="middle">Items</td>
    <td width="56" align="center" class="tblheading" valign="middle">UOM</td>
    <td width="56" align="center" class="tblheading" valign="middle">UPS</td>
	  <td width="60" align="center" class="tblheading" valign="middle">Quantity</td>
	   <td width="79" align="center" class="tblheading" valign="middle">Good/Damage</td>
      <td width="59" align="center" class="tblheading" valign="middle">Edit </td>
    <td width="115" align="center" class="tblheading" valign="middle">Delete</td>
    </tr>
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
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center">&nbsp;</td>
    <td valign="middle" class="tbltext" align="left">&nbsp;</td>
    <td valign="middle" class="tbltext" align="center">&nbsp;</td>
    <td valign="middle" class="tbltext" align="center">&nbsp;</td>
    <td valign="middle" class="tbltext" align="center">&nbsp;</td>
	<td valign="middle" class="tbltext" align="center">&nbsp;</td>
   
    <td valign="middle" class="tbltext" align="center"><a href=""></a></td>
    <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" /></td>
	 <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand"  /></td>
  </tr>
  <?php
	/*}
	else
	{ */
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center">&nbsp;</td>
    <td valign="middle" class="tbltext" align="left">&nbsp;</td>
    <td valign="middle" class="tbltext" align="center">&nbsp;</td>
    <td valign="middle" class="tbltext" align="center">&nbsp;</td>
    <td valign="middle" class="tbltext" align="center"><a href=""></a></td>
   <td valign="middle" class="tbltext" align="center">&nbsp;</td>
   <td valign="middle" class="tbltext" align="center">&nbsp;</td>
    <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" />   </td>
	 <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand"  /></td>
  </tr>
  <?php	/*}
	 $srno=$srno+1;
	}
}
}
}*/
?>
</table>
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 		 
		 <tr class="Dark" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification &nbsp; </td>                                                
           <td width="411" colspan="3" align="left"  valign="middle">&nbsp;
             <select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select classification--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['whid'];?>" />   
		<?php echo $noticia['perticulars'];?>
		<?php } ?>
	</select>
              
              &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Light" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Items &nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtperticulars" style="width:170px;"  >
<option value="" selected>--Select Items--</option>
</select>&nbsp;<font color="#FF0000"><a href="">Details</a>*</font>&nbsp;</td>
         </tr>
		 <tr class="Light" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Select Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp; </td>
         </tr>
		  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Stock in hand>SLOC>Multiple entries</td>
</tr>
		 <tr class="Dark" height="25">
			 <td width="318"  align="right" valign="middle" class="tblheading">&nbsp;Sloc&nbsp;</td>
    <td colspan="5" align="left"  valign="top" class="tbltext" id="vaddress">&nbsp;<input type="checkbox" name="two" value="2" onClick="chk();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<tr class="Dark" height="25">
           <td width="318" align="right" valign="middle" class="tblheading">&nbsp;UPS&nbsp;</td>
<td width="411"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="5" class="tbltext" tabindex=""   maxlength="5"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td width="76" align="right" valign="middle" class="tblheading">Quantity&nbsp;</td>
<td width="239" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="7" class="tbltext" tabindex=""   maxlength="7"  style="background-color:#CCCCCC"/>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		    <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Material Return></td>
</tr>
		 <tr class="Dark" height="25">
			 <td width="318"  align="right" valign="middle" class="tblheading">&nbsp;Sloc&nbsp;</td>
    <td colspan="5" align="left"  valign="top" class="tbltext" id="vaddress">&nbsp;<input type="checkbox" name="two" value="2" onClick="chk();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<tr class="Dark" height="25">
           <td width="318" align="right" valign="middle" class="tblheading">&nbsp;UPS&nbsp;</td>
<td width="411"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td width="76" align="right" valign="middle" class="tblheading">Quantity&nbsp;</td>
<td width="239" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="7" class="tbltext" tabindex="0"    maxlength="7"/>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		   <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Balance</td>
</tr>
		<tr class="Dark" height="25">
			 <td width="318"  align="right" valign="middle" class="tblheading">&nbsp;Sloc&nbsp;</td>
    <td colspan="5" align="left"  valign="top" class="tbltext" id="vaddress">&nbsp;<input type="checkbox" name="two" value="2" onClick="chk();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where classification='Vendor'"); 
?>
		 <tr class="Dark" height="25">
           <td width="318" align="right" valign="middle" class="tblheading">&nbsp;UPS&nbsp;</td>
<td width="411"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="5" class="tbltext" tabindex=""   maxlength="5"  style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td width="76" align="right" valign="middle" class="tblheading">Quantity&nbsp;</td>
<td width="239" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="7" class="tbltext" tabindex="0"    maxlength="7" style="background-color:#CCCCCC"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		   <?php
$quer4=mysql_query("SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
 </table>

<!--<table align="center" border="1" cellspacing="0" cellpadding="0" width="738" bordercolor="#4ea1e1" style="border-collapse:collapse"> 
<tr class="tblsubtitle" height="35">
              <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="11%" align="center" rowspan="2" valign="middle" class="tblheading">Sloc</td>
              <td width="12%" rowspan="2" align="center" valign="middle" class="tblheading">UPS</td>
			   <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Qty</td>
			    <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Material Return </td>
			     <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Balance</td>
				   <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Print</td>
               </tr>
			<tr class="tblsubtitle">
                   <td width="14%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="17%" align="center" valign="middle" class="tblheading">Qty</td>
					 <td width="14%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="14%" align="center" valign="middle" class="tblheading">Qty</td>
				   </tr>
			<tr class="<?php echo $trcls;?>" height="25">
              <td align="center" class="smalltbltext" valign="middle"><a href="faclaimdetails_view.php?month=<?php echo $month;?>&empid=<?php echo $row['emp_id'];?>&dept=<?php if(isset($_REQUEST['dept'])){ echo $dept;} else { echo "0";} ?>&vid=<?php echo $row['claim_id'];?>"></a><input type="checkbox" name="two" value="2" onClick="chk();"  />&nbsp;</td>
              <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" width="11%" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" width="14%" class="smalltbltext" valign="middle" rowspan="2"><input name="date" type="text" size="5" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  maxlength="5"/></td>
              <td align="center" width="17%" class="smalltbltext" valign="middle"><input name="date" type="text" size="7" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC" maxlength="7" /></td>
              <td width="14%" align="center" valign="middle" class="smalltbltext"><input name="date" type="text" size="5" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  maxlength="5"/></td>
              <td width="14%" align="center" valign="middle" class="smalltbltext"><input name="date" type="text" size="7" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  maxlength="7"/></td>
			  <td align="center" width="11%" class="smalltbltext" valign="middle"><a href="">Print</a></td>
           </tr>
</table>-->
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="25">
            <td width="166" height="24"  align="right"  valign="middle" class="tblheading">Select Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Returnable&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />&nbsp;Non-Returnable&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp; </td>
         </tr>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
<tr class="Light" height="30">
<td width="166" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="554" align="left"  valign="middle" class="tbltext">&nbsp;
  <textarea name="txtaddress" cols="50" rows="5" tabindex="" ></textarea>&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_materialreturn.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:hand;"/></a></a>&nbsp; <input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="images/istratlogo.gif"  align="left"/><img src="images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
