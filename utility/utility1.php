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
		
	$sql_main="update tbl_gtod set gdflg=1, gcode=$code  where gid = '$pid'";

	$a123456=mysql_query($sql_main) or die(mysql_error());

	/*$sql_main1="update tbl_ieindent set flg=1  where tid = '$tid'";

	$a123=mysql_query($sql_main1) or die(mysql_error());
	*/

	/*if(isset($_POST['frm_action'])=='submit')
	{*/
	if(isset($_GET['txtclass']))
	{
	$classification_id = $_GET['txtclass'];
	}
	if(isset($_GET['txtitem']))
	{
	$items_id = $_GET['txtitem'];
	}
	
	/*if(isset($_GET['wid']))
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
	}*/
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores- Utility- SLOC search</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript">
function openprintsubbin(subid, bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function openprintbin(bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('bin_sloc_details_print.php?bid='+bid+'&wid='+wid+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); bin_sloc_details_print
}

function openprintsubbind(subid, bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('subbind_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

function openprintbind(bid, wid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var tp=document.frmaddDepartment.tp.value;
winHandle=window.open('bin_sloc_details_print.php?bid='+bid+'&wid='+wid+'&tp='+tp,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); bin_sloc_details_print
}
</script>
<body>


		  
		  <!-- actual page start--->		  
		
	  <?php
	  $sql_whouse=mysql_query("select classification from tbl_classification where classification_id='".$classification_id."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);

  $sql_binn=mysql_query("select stores_item from tbl_stores where items_id='".$items_id."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);

?>
 <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
  <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
 <input name="frm_action" value="submit" type="hidden"> <br />
 <table align="center" border="0" cellspacing="0" cellpadding="0" width="650" style="border-collapse:collapse">
  <tr class="Dark" height="30">
<td width="228" align="left"  valign="middle" class="tblheading">&nbsp;Stores Item Search </td>
<td width="422" align="left"  valign="middle" class="tblheading">&nbsp;Item Details:&nbsp;&nbsp;<?php echo $row_whouse['classification'];?>/<?php echo $row_binn['stores_item'];?></td>
</tr>

  </table>
<?php

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin Status Sheet Good </td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

//$sql_tbl_sub=mysql_query("select * from tblissue_sub where issue_id='".$issue_id."'") or die(mysql_error());

?>
  <tr class="tblsubtitle" height="25">
    <td width="51" align="center" class="tblheading" valign="middle">#</td>
	  <td width="135" align="center" valign="middle" class="tblheading">G</td>
    <td width="164" align="center" class="tblheading" valign="middle">UPS</td>
	
    <td width="163" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="225" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>

<?php
$srno=1; $srno=1; $rtotalups=0; $rtotalqty=0;$cnt=0;
 $sq= "select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classification_id."'  and stlg_tritemid='".$items_id."'";
$sql_tbl=mysql_query($sq) or die(mysql_error());

$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl))
{ 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_tbl_sub['stlg_subbinid']."' and stlg_binid='".$row_tbl_sub['stlg_binid']."' and stlg_whid='".$row_tbl_sub['stlg_whid']."' and stlg_tritemid='".$items_id."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
{
/*$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stlg_trclassid']."'") or die(mysql_error());


$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stlg_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);*/
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="51" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="135" align="center" valign="middle" class="tblheading">G</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
	    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_issuetbl[stlg_binid],$row_issuetbl[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetbl[stlg_subbinid],$row_issuetbl[stlg_binid],$row_issuetbl[stlg_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['stlg_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stlg_balqty'];
?>	
	<td width="225" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="51" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="135" align="center" valign="middle" class="tblheading">G</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_issuetbl[stlg_binid],$row_issuetbl[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetbl[stlg_subbinid],$row_issuetbl[stlg_binid],$row_issuetbl[stlg_whid])'>$row_subbinn[sname]</a>";
if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['stlg_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stlg_balqty'];
?>	
	<td width="225" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
   
  <?php	
}
$srno=$srno+1;
}
}
}
//}
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" >&nbsp;</td>
<td align="center" valign="middle" class="tblheading">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?></td>
<td align="center" valign="middle" class="tblheading" >&nbsp;</td>
 </tr>
</table>
<br />
<?php
 $sq= "select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classification_id."' and stld_tritemid='".$items_id."'";
//echo $sq= " select * from tbl_stldg_damage where stld_trclassid='91' and stld_tritemid='7'";
$sql_tbl=mysql_query($sq) or die(mysql_error());

?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Bin status sheet Damage</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

//$sql_tbl_sub=mysql_query("select * from tblissue_sub where issue_id='".$issue_id."'") or die(mysql_error());

?>
  <tr class="tblsubtitle" height="25">
    <td width="30" align="center" class="tblheading" valign="middle">#</td>
	  <td width="112" align="center" valign="middle" class="tblheading">D</td>
    <td width="127" align="center" class="tblheading" valign="middle">UPS</td>
    <td width="124" align="center" class="tblheading" valign="middle">Qty</td>
	<td width="177" align="center" class="tblheading" valign="middle">SLOC</td>
    </tr>

<?php 
$srno=1; $rtotalups=0; $rtotalqty=0;$cnt=0;

$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl))
{ 

$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_tbl_sub['stld_subbinid']."' and stld_binid='".$row_tbl_sub['stld_binid']."' and stld_whid='".$row_tbl_sub['stld_whid']."' and stld_tritemid='".$items_id."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
{

/*$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['stld_trclassid']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['stld_tritemid']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);*/
if($srno%2!=0)
{
?>	
  
<tr class="Light" height="25">
    <td width="30" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tblheading">D</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbind($row_issuetbl[stlg_binid],$row_issuetbl[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbind($row_issuetbl[stld_subbinid],$row_issuetbl[stld_binid],$row_issuetbl[stld_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['stld_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stld_balqty'];


?>	
	<td width="177" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td width="30" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tblheading">D</td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn="<a href='Javascript:void(0)' onclick='openprintbin($row_issuetbl[stlg_binid],$row_issuetbl[stlg_whid])'>$row_binn[binname]</a>"."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbind($row_issuetbl[stld_subbinid],$row_issuetbl[stld_binid],$row_issuetbl[stld_whid])'>$row_subbinn[sname]</a>";

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['stld_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stld_balqty'];

?>		
	<td width="177" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
  </tr>
  
  <?php	
}
$srno=$srno+1;
}
}
}
?> 
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading">&nbsp; </td>

<td width="28" align="center" valign="middle" class="tblheading">Total</td>
<td width="17" align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?></td>
<td width="17" align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?></td>
<td align="center" valign="middle" class="tblheading" >&nbsp;</td>
 </tr>
 
</table>

<table align="center" width="314" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="utility.php?"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;&nbsp;
  <input type="hidden" name="fet1" value="" /></td>	
</tr>
</table>
</form></td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
 
	  		  <td width="15" background="../images/columnbgright1.gif" style="background-repeat:repeat; padding-top:0px"></td>
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
