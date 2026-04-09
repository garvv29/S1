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
	
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
	if(isset($_GET['txtslbing1']))
	{
	 $bid = $_GET['txtslbing1'];
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$sid = $_GET['txtslsubbg1'];
	}
	if(isset($_GET['txtslwhg1']))
	{
	 $whid = $_GET['txtslwhg1'];
	}
	if(isset($_GET['classification_id']))
	{
	$classification_id = $_GET['classification_id'];
	}	
	/*if(isset($_GET['whid']))
	{
	$whid = $_GET['whid'];
	}*/	/*echo "<script>window.location='utility_wh1.php'</script>";	
		}*/
//}
//}
//}

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores -Utility -Sloc Utility</title>
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
winHandle=window.open('utility_wh2.php?whid=<?php echo $whid?>&binid=<?php echo $bid?>&sid=<?php echo $sid?>','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
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
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">		  


<!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Utility - SLOC Search </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
	  
	    <td align="center" colspan="4" >
		<br/>
		
<?php
		
	
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$whid."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);

if($sid=='ALL')
{ 
$subbinn="ALL";
}
else
{
$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$sid."' and binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
}		
	/*$sql_sel="select * from tbl_subbin where sid='".$sid."' order by sname ";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_subbin where sid='".$sid."'"),0); 
	
	$sql_p=mysql_query("select * from tbl_subbin where sid='".$sid."'");
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	
	if($total >0) { */
	
	?>
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden">
	 <?php 
/*$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$wid."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$bid."' and whid='".$wid."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);*/

?>
	 <table align="center" border="0" cellspacing="0" cellpadding="0" width="800" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td width="601" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Search</td>
<td width="199" align="left"  valign="middle" class="tblheading">&nbsp;SLOC Details:&nbsp;&nbsp;<?php echo $row_whouse['perticulars'];?>/<?php echo $row_binn['binname'];?>/<?php echo $subbinn;?></td>
</tr>

  </table>
      <table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#4ea1e1" style="border-collapse:collapse">
			 <tr class="tblsubtitle" height="20">
              <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="8%" align="center" rowspan="2" valign="middle" class="tblheading">Sub Bin</td>
			  <td width="26%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="30%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
                <td colspan="4" align="center" valign="middle" class="tblheading">SLOC</td>
              </tr>
			<tr class="tblsubtitle">
                    <td width="7%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="8%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="11%" align="center" valign="middle" class="tblheading">Qty</td>
          </tr>
<?php
$srno=1;

if($sid=='ALL')
{ 
$sql_tb="select * from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid";  
}
else
{
$sql_tb="select * from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' and stlg_subbinid='".$sid."' group by stlg_subbinid, stlg_tritemid order by stlg_subbinid";  
}
$sql_qry=mysql_query($sql_tb) or die(mysql_error());  
while($row_tbl=mysql_fetch_array($sql_qry))
{

$sql_tbl1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_whid='".$whid."' and stlg_binid='".$bid."' and stlg_subbinid='".$row_tbl['stlg_subbinid']."' and stlg_tritemid='".$row_tbl['stlg_tritemid']."'") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
//echo $t1=mysql_num_rows($sql_tbl1);

$sql1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tbl1[0]."' and stlg_balqty > 0")or die(mysql_error());

$total_tbl=mysql_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql1))
{
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stlg_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stlg_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);

if($srno%2!=0)
{

?>			  
 <tr class="Light" height="20">
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stlg_balups'];
$slqty=$slqty+$row_tbl_sub['stlg_balqty'];


?>			 
			  <td align="center" valign="middle" class="tblheading">G</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
              <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stlg_balups'];
$slqty=$slqty+$row_tbl_sub['stlg_balqty'];

?>			 
			  <td align="center" valign="middle" class="tblheading">G</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr> 
<?php
}
$srno++;
}
}
}

if($sid=='ALL')
{ 
$sql_tbl=mysql_query("select * from tbl_stldg_damage where stld_whid='".$whid."' and stld_binid='".$bid."' group by stld_subbinid, stld_tritemid order by stld_subbinid") or die(mysql_error());  
}
else
{
$sql_tbl=mysql_query("select * from tbl_stldg_damage where stld_whid='".$whid."' and stld_binid='".$bid."' and stld_subbinid='".$sid."' group by stld_subbinid, stld_tritemid order by stld_subbinid") or die(mysql_error());  
}

while($row_tbl=mysql_fetch_array($sql_tbl))
{

$sql_tbl1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_whid='".$whid."' and stld_binid='".$bid."' and stld_subbinid='".$row_tbl['stld_subbinid']."' and stld_tritemid='".$row_tbl['stld_tritemid']."'") or die(mysql_error());  
$row_tbl1=mysql_fetch_array($sql_tbl1);
//echo $t1=mysql_num_rows($sql_tbl1);

$sql1=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_tbl1[0]."' and stld_balqty > 0")or die(mysql_error());
$total_tbl=mysql_num_rows($sql1);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql1))
{
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stld_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stld_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);

 $sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$bid."' and whid='".$whid."'") or die(mysql_error());
 $row_subbinn=mysql_fetch_array($sql_subbinn);

if($srno%2!=0)
{
?>  
 <tr class="Light" height="20">
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stld_balups'];
$slqty=$slqty+$row_tbl_sub['stld_balqty'];

?>			 
			  <td align="center" valign="middle" class="tblheading">D</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
              <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_subbinn['sname'];?></td>
			 <td width="26%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="30%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
<?php
$slups=0; $slqty=0;
$slups=$slups+$row_tbl_sub['stld_balups'];
$slqty=$slqty+$row_tbl_sub['stld_balqty'];

?>			 
			  <td align="center" valign="middle" class="tblheading">D</td>
 		     <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $slups;?></td>
 		     <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slqty;?></td>
 </tr> 
<?php
}
$srno++;
}
}
}
?>  			  
          </table>
</form>

		  
<table align="center" width="538" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td width="546" align="center" valign="top"><a href="utility_wh.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:hand;" onclick="openprint('whid=<?php echo $whid?>&binid=<?php echo $bid?>&sid=<?php echo $sid?>');"></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>

	  
	  
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
