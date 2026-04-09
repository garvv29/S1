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
			$printopt=$_POST['fet1'];
		
if($printopt == "1" )
{
	echo "<script>window.location='select_transction_issue_internal.php'</script>";	
}
else if($printopt =="2")
{
echo "<script>window.location='add_str.php'</script>";	
}
else if($printopt =="3")
{
echo "<script>window.location='add_materialreturn.php'</script>";	
}
else
{
echo "Bye";	
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction- Order Placement</title>
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
				 <li><a href="../reports/slocreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
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
              <ul style="vertical-align:text-top"> <li> <a href="operprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li> <li> &nbsp;<a href="../logout.php">Logout </a> </li>
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
          <td width="100%" valign="top"   align="center"  class="midbgline">
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25" class="Mainheading">&nbsp;Order Placement Effect In Stock Register </td>
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
	
	/*if(!isset($_GET['page'])) { 
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

	if($total >0) { */
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="680" style="border-collapse:collapse">
  <tr height="25" >
    <td width="707" colspan="8" align="center" class="subheading" style="color:#303918; ">Indents (<?php echo $total_results;?>)</td>
  </tr>
  </table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="694" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="65" align="center" class="tblheading" valign="middle">#</td>
<td width="164" align="left" class="tblheading" valign="middle">&nbsp;Items</td>
<td width="106" align="center" class="tblheading" valign="middle">UOM</td>
<td width="113" align="center" class="tblheading" valign="middle">UPS</td>
<td width="112" align="left" class="tblheading" valign="middle">&nbsp;Quantity</td>
<td width="120" align="center" class="tblheading" valign="middle">SLOC</td>
<td width="120" align="center" class="tblheading" valign="middle">Reamrks</td>
</tr>
<?php
//$srno=1;
	/*while($row=mysql_fetch_array($res))
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
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	
	if ($srno%2 != 0)
	{*/
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['perticulars'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_v['sname'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_bin.php?binid=<?php echo $row['binid'];?>"><?php echo $row['binname'];?></a></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_bin.php?binid=<?php echo $row['binid'];?>"><?php echo $row['binname'];?></a></td>

</tr>
<?php
	/*}
	else
	{ */
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['perticulars'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $num_V['sname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['binname'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_p['perticulars'];?></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_bin.php?binid=<?php echo $row['binid'];?>"><?php echo $row['binname'];?></a></td>

</tr>
<?php	//}
	 $srno=$srno+1;
	//}

?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
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
*/
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
