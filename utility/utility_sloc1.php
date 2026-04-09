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
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	//$logid="opr1";
	//$lgnid="OP1";
	$tp="GD";
	$sql_code="SELECT MAX(gcode) FROM tbl_gtod  where yearcode='$yearid_id' ORDER BY gcode DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
		
		/*$sql_code1="SELECT MAX(ncode) FROM tbl_captive ORDER BY ncode DESC";
		$res_code1=mysql_query($sql_code1)or die(mysql_error());
		
		if(mysql_num_rows($res_code1) > 0)
			{
				$row_code1=mysql_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode=$t_code1+1;
				$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode=sprintf("%004d",0001);
		}*/
		
	//$sql_main="update tbl_gtod set gdflg=1, gcode=$code  where gid = '$pid'";

	//$a123456=mysql_query($sql_main) or die(mysql_error());

	/*$sql_main1="update tbl_ieindent set flg=1  where tid = '$tid'";

	$a123=mysql_query($sql_main1) or die(mysql_error());
	*/

	/*if(isset($_POST['frm_action'])=='submit')
	{*/
	if(isset($_GET['slid']))
	{
	$slid = $_GET['slid'];
	}
	if(isset($_GET['wid']))
	{
	$wid = $_GET['wid'];
	}
	if(isset($_GET['bid']))
	{
	$bid = $_GET['bid'];
	}
		if(isset($_GET['tp']))
	{
	$tp = $_GET['tp'];
	}
	if(isset($_GET['txtclass']))
	{
	$class = $_GET['txtclass'];
	}
		if(isset($_GET['txtitem']))
	{
	$item = $_GET['txtitem'];
	}
	if(isset($_GET['txtuom']))
	{
	$uom = $_GET['txtuom'];
	}
			/*echo "<script>window.location='utility_sloc1.php'</script>";	
		}*/
		
			//}
	//}
?>

	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Utility -Bincard Printing</title>
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


function openprintsubbin(subid, bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('iss_subbin_sloc_details_utility.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}



function openprintsubbind(subid, bid, wid)
{
/*alert(classval);
alert(item);
alert(uom);
*/
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('iss_subbind_sloc_details_utility.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
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
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Utility - Bin Card Printing </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* select * from tbl_stldg_good where stlg_trclassid='91' and stlg_tritemid='7'*/
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<br/>
		<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<?php

/*$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='$tp' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];
*/
?>

<?php
 $sq= "select * from tbl_stldg_good where stlg_trclassid='$class' and stlg_tritemid='$item'";
$sql_tbl=mysql_query($sq) or die(mysql_error());
?>


<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin Card Good</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

//$sql_tbl_sub=mysql_query("select * from tblissue_sub where issue_id='".$issue_id."'") or die(mysql_error());

?>
  <tr class="tblsubtitle" height="25">
    <td width="39" align="center" class="tblheading" valign="middle">#</td>
	  <td width="181" align="left" class="tblheading" valign="middle">&nbsp;Classification</td>
    <td width="257" align="center" class="tblheading" valign="middle">&nbsp;Items</td>
	  <td width="7%" align="center" valign="middle" class="tblheading">G</td>
    <td width="67" align="center" class="tblheading" valign="middle">UPS</td>
	
    <td width="65" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="127" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>

<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl))
{ 
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stlg_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stlg_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
	  <td width="7%" align="center" valign="middle" class="tblheading">G</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
	    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="$row_binn[binname]"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stlg_subbinid],$row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
	  <td width="7%" align="center" valign="middle" class="tblheading">G</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="$row_binn[binname]"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[stlg_subbinid],$row_tbl_sub[stlg_binid],$row_tbl_sub[stlg_whid])'>$row_subbinn[sname]</a>";
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
?>	
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php	
}
$srno=$srno+1;
}
}
//}
//}
?>
</table>
<br />
<?php
 $sq= "select * from tbl_stldg_damage where stld_trclassid='$class' and stld_tritemid='$item'";
//echo $sq= " select * from tbl_stldg_damage where stld_trclassid='91' and stld_tritemid='7'";
$sql_tbl=mysql_query($sq) or die(mysql_error());

?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin Card Damage</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

//$sql_tbl_sub=mysql_query("select * from tblissue_sub where issue_id='".$issue_id."'") or die(mysql_error());

?>
  <tr class="tblsubtitle" height="25">
    <td width="39" align="center" class="tblheading" valign="middle">#</td>
	  <td width="181" align="left" class="tblheading" valign="middle">&nbsp;Classification</td>
    <td width="257" align="center" class="tblheading" valign="middle">&nbsp;Items</td>
	   <td width="7%" align="center" valign="middle" class="tblheading">D</td>
    <td width="67" align="center" class="tblheading" valign="middle">UPS</td>
    <td width="65" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="127" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>

<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl))
{ 
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stld_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stld_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
	 <td align="center" valign="middle" class="tblheading">D</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="$row_binn[binname]"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbind($row_tbl_sub[stld_subbinid],$row_tbl_sub[stld_binid],$row_tbl_sub[stld_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>	
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="39" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="181" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
    <td width="257" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
	 <td align="center" valign="middle" class="tblheading">D</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="$row_binn[binname]"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbind($row_tbl_sub[stld_subbinid],$row_tbl_sub[stld_binid],$row_tbl_sub[stld_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


?>		
	<td width="127" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php	
}
$srno=$srno+1;
}
}

?>
</table>
<br />

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="utility_sloc.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;</td>
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
