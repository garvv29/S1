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
	//$role="admin";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['business_name']))
	{
	$business_name = $_REQUEST['business_name'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	
	if($business_name=="Stock Transfer")
			{
			$rt="StockTransfer";
			}
	if($business_name=="Internal Return")
			{
			 $rt="InternalReturn";
			}
	if($business_name=="Vendor")
			{
			$rt="Vendor";
			}
	if($business_name=="Dealer")
			{
			 $rt="Dealer";
			}
	if($business_name=="CF")
			{
			$rt="CF";
			}
		
		$print=$_POST['rtyp'];
if($print == "detail" )
{ ?><script language="javascript">   
winHandle=window.open('party_detail_report.php?business_name=<?php echo $rt?>','WelCome','top=10,left=50,width=950,height=700,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
 </SCRIPT>
<?php 
}
else
{
?><script language="javascript">  
winHandle=window.open('report_party1.php?business_name=<?php echo $rt?>','WelCome','top=10,left=50,width=520,height=700,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
 </SCRIPT>
<?php 
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Master Report - Report Party</title>
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
<SCRIPT language="JavaScript" type="text/javascript">
function openreportemp(business_name)
{
//var rt=document.frmaddDepartment.rt.value;
//alert(business_name);
winHandle=window.open('party_detail_report1.php?business_name='+business_name,'WelCome','top=10,left=50,width=950,height=700,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
function openprint()
{
winHandle=window.open('report_party1.php','WelCome','top=20,left=80,width=520,height=600,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}
</script>
<script language="javascript">
function chk(val)
{
document.frmaddDepartment.rtyp.value=val;
}
function mySubmit()
{
	if(document.frmaddDepartment.rtyp.value=="")
	{
	alert("Please Select Report Type");
	return false;
	}
return true;
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Reports- Party  Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">


</table></td>
	  
	  </tr>
	  </table></td></tr>
	
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="rt" value="<?php echo $rt;?>" type="hidden"> 
	   <input name="rtyp" value="" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php
	 $srno=1; 
    // $sql_sel="select * from tbl_partymaser where classification='$pid' order by business_name ";
	//$res=mysql_query($sql_sel) or die (mysql_error());
if($business_name=="CF")
		{
		$business_name="C&F";
		}
		
	$sql = mysql_query("SELECT * FROM tbl_partymaser where classification='$business_name' order by business_name"); 
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_partymaser where classification='$business_name'"),0); 
	//}
	$total=mysql_num_rows($sql);
    if($total >0) { 
			?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Partry List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="491" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
    <td width="61" align="center" class="tblheading" valign="middle">#</td>
    <td width="281" align="left" class="tblheading"valign="middle">&nbsp;Party Name </td>
    <td width="141" align="center" class="tblheading" valign="middle">Categories<br /></td>
    </tr>
  <?php
    $srno=1;
	while($row=mysql_fetch_array($sql))
	{
	/*$resettargetquery=mysql_query("select * from tbl_partymaser where classification=".$row['p_id']);
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	*/
	if ($srno%2 != 0)
	{
	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<a href="Javascript:void(0)" onClick="openreportemp('<?php echo $row['p_id'];?>');"><?php echo $row['business_name'];?></a></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<a href="Javascript:void(0)" onClick="openreportemp('<?php echo $row['p_id'];?>');"><?php echo $row['business_name'];?> </a></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row['classification'];?></td>
    </tr>
  <?php	}
	 $srno=$srno+1;
	}
	}
	
?>
</table>
<br/>
<table align="center" border="0" width="491" cellspacing="0" cellpadding="0" bordercolor="#b9d647" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Report Type</td>
</tr>
<tr class="Light" height="25">
    <td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="detail" onClick="chk(this.value)" />&nbsp;Detailed Report&nbsp;</td>
    <td width="284" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="summary" onClick="chk(this.value)" />
    &nbsp;List Report&nbsp;</td>
</tr>

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
else
{*/
?>


<?php
//}
?>
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<TABLE class="tbltext" width="402" align="center">
                          <TBODY>
                          <tr>
<td width="512" align="center"><a href="report_party_home1.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"></a></a>&nbsp;&nbsp;
  <input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:hand;" onClick="return mySubmit();"></td>
</tr></TBODY></TABLE>
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
