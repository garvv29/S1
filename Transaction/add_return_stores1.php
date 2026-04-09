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
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$code=trim($_POST['txtcode']);
		$date=trim($_POST['date']);
		$classification=$_POST['txtcla'];
		$rfs=trim($_POST['txtstage']);
		$rbd=trim($_POST['txtrd']);
		$items=trim($_POST['txtitem']);
		$uom=trim($_POST['txtuom']);
		$ups=trim($_POST['txtups']);
		$qty=trim($_POST['txtqty']);
		$whid=trim($_POST['txtwh1']);
		$whid=trim($_POST['txtwh']);
		$binid=trim($_POST['txtbin']);
		$sid=trim($_POST['txtsbin']);
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		/*$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
		$num=mysql_num_rows($sql22);
		
		$sql2=mysql_query("select * from tblemp where emp_mobile='".$mobile."'") or die(mysql_error());
		$num2=mysql_num_rows($sql2);
		
		$sql_mail=mysql_query("select * from tblemp where emp_email='".$email."'") or die(mysql_error());
		$num_mail=mysql_num_rows($sql_mail);
		
		if($altemail !="")
		{
		$sql_altmail=mysql_query("select * from tblemp where emp_altemail='".$altemail."'") or die(mysql_error());
		$num_altmail=mysql_num_rows($sql_altmail);
		}
		else
		{
		$num_altmail=0;
		}
		
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee ID.\nEmployee with this Employee ID already Present.");
			  </script>
			 <?php
		}
		else if($num2 > 0)
		{	?>
			 <script>
			  alert("Duplicate Mobile Number.\nEmployee with this Mobile Number already Present.");
			  </script>
			 <?php
		}
		else if($num_mail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee VNR Email-ID.\nEmployee with this Employee VNR Email-ID already Present.");
			  </script>
			 <?php
		}
		else if($num_altmail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee Alternate Email-ID.\nEmployee with this Employee Alternate Email-ID already Present.");
			  </script>
			 <?php
		}
		else
		{*/
			 $sql_in="insert into tbl_ireturn(code, date, rfs,rbd,classification_id,items_id,uom, ups,qty, whid, binid, sid) values ($code,'$tdate', '$rfs', '$rbd', '$classification', '$items', '$uom', '$ups', '$qty', '$whid','$binid', '$sid')";
						//exit;				
			if(mysql_query($sql_in)or die(mysql_error()))
			{ 
				//$id=mysql_insert_id();
				echo "<script>window.location='add_return_stores1.php'</script>";	
			}
		
		}
	//}

$a="c";
	$sql_code="SELECT MAX(code) FROM tbl_ireturn ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				
		}
		else
		{
			$code=10001;
		}

	
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
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction Arrival - Material Return Internal </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);
	*/
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Dark" >
      <td width="122" align="right"  valign="middle" class="smalltblheading">Transction ID &nbsp;</td>
      <td width="211" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
     
	  <td width="84" align="right"  valign="middle" class="smalltblheading">&nbsp;Date&nbsp;</td>
      <td width="223" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
</tr>

<tr class="Dark" >
      <td width="122" align="right"  valign="middle" class="smalltblheading"> Return from Stage&nbsp;</td>
      <td align="left"  valign="middle" class="smalltbltext">&nbsp;</td>

      <td width="84"  align="right"  valign="middle" class="smalltblheading">Return By &nbsp;</td>
      <td align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="24" align="center" class="tblheading" valign="middle">#</td>
<td width="166" align="left" class="tblheading" valign="middle">&nbsp;Classification</td>
<td width="199" align="center" class="tblheading" valign="middle">Items</td>
<td width="53" align="center" class="tblheading" valign="middle">Uom</td>
<td width="43" align="left" class="tblheading" valign="middle">&nbsp;UPS</td>
<td width="56" align="center" class="tblheading" valign="middle">Quantity</td>
<td align="center" colspan="2" class="tblheading" valign="middle">Sloc</td>
<td width="29" align="center" class="tblheading" valign="middle">Edit</td>
<td width="48" align="center" class="tblheading" valign="middle">Delete</td>
</tr>

<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="left">&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;</td>
<td valign="middle" class="tbltext" align="left">&nbsp;</td>
<td width="61" align="center" valign="middle" class="tbltext">&nbsp;</td>
<td width="49" align="left" valign="middle" class="tbltext">&nbsp;</td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand"  /></td>
</tr>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="left">&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;</td>
<td valign="middle" class="tbltext" align="left">&nbsp;</td>
<td width="61" align="center" valign="middle" class="tbltext">&nbsp;</td>
<td width="49" align="left" valign="middle" class="tbltext">&nbsp;</td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand"  /></td>
</tr>
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark" height="25">
     <td width="318"  align="right"  valign="middle" class="tblheading">Classification&nbsp;</td>
     <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  >
<option value="" selected>--Select classification--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['whid'];?>" />   
		<?php echo $noticia['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
		 <tr class="Light" height="25">	
	 <td width="318"  align="right"  valign="middle" class="tblheading"> Stores Item&nbsp;</td>
     <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  >
<option value="" selected>--Select Item--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

		 <tr class="Dark" height="25">
           <td width="318" height="24"  align="right"  valign="middle" class="tblheading">UOM &nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtperticulars" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  maxlength="5"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>

		 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="10" class="tbltext" tabindex="" maxlength="7" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="10" class="tbltext" tabindex="" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr height="30">
     <td colspan="4" align="center" class="tblheading">SLOC&nbsp;</td>
  </tr>

<?php
/*$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
$noticia = mysql_fetch_array($quer2);
*/?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>

		<tr class="Dark" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select WH--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['whid'];?>" />   
		<?php echo $noticia['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
<tr class="Light" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">BIN Number&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select BIN--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<tr class="Light" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">Sub-Bin Number&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select  Sub-Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr> 		 
		 
</table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_return_stores.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
