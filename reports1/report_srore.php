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
	
	if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}
	if(isset($_REQUEST['items_id']))
	{
	$id = $_REQUEST['items_id'];
	}
	
		
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Master -Report -Store Report</title>
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

function openprint()
{
//var dateto=document.frmaddDept.dateto.value;
//var datefrom=document.frmaddDept.datefrom.value;
winHandle=window.open('report_store1.php','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
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
          <td width="100%" valign="top" height="Auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="940" height="25">&nbsp;Stores Items - Stores Items home</td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">


</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<input name="frm_action" value="submit" type="hidden" />
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<?php

		$srno=1;
	
	$sql_sel="select a.stores_item, a.items_id,a.uom,a.srl , b.classification from tbl_stores a,tbl_classification b where a.classification_id = b.classification_id order by b.classification,a.stores_item ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_stores"),0); 

	if($total >0) { 
?>



<table align="center" border="0" cellspacing="0" cellpadding="0" width="647" style="border-collapse:collapse">
  <tr height="25" >
    <td width="647" colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" />
    Report Stores List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="617" bordercolor="#4ea1e1" style="border-collapse:collapse">
    <tr class="tblsubtitle" height="25">
<td width="36" height="22" align="center" valign="middle" class="tblheading">#</td>
<td width="158" align="left" class="tblheading" valign="middle">&nbsp;Stores Items</td>
<td width="170" align="center" class="tblheading" valign="middle">Classification<br /></td>
<td width="103" align="center" class="tblheading" valign="middle">&nbsp;UoM</td>
<td width="138" align="center" class="tblheading" valign="middle">&nbsp;Set Re-Order Level<br /></td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
	/*$resettargetquery=mysql_query("select * from tbl_classification where classification_id='".$row['classification_id']."' order by classification ASC");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);*/
	
	/*$sql_p=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."'")or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
$num_of_records_target_set1=mysql_num_rows($sql_p);*/
	
	$sql_v=mysql_query("select * from tbl_stldg_good where stlg_tritemid='".$row['items_id']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_of_records_target_set2 =mysql_num_rows($sql_v);
	
	$sql_v=mysql_query("select * from tbl_stldg_damage where stld_tritemid='".$row['items_id']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_of_records_target_set3 =mysql_num_rows($sql_v);
	/*$sql_v=mysql_query("select * from tblvariety where cropid=".$row['cropid'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	*/

$stores_item=$row['stores_item'];
if($row['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";

	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $stores_item;?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['classification'];?>&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['srl'];?> </td>
<!--<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>-->
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $stores_item;?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['classification'];?>&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['srl'];?></td>
<!--<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>-->
</tr>
<?php	}
	 $srno=$srno+1;
	}
	}
?>
</table>

</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
<TABLE class="tbltext" width="402" align="center">
                          <TBODY>
                          <tr>
<td width="512" align="center"><a href="masterreports.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"></a></a>&nbsp;&nbsp;
  <input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:hand;" onclick="openprint();"></td>
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
