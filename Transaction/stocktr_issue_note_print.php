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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transaction- STIN</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
<style type="text/css" media="print">
body { font-family:Arial;
/*size:11in 8.5in landscape;
margin:0.25in;*/
}
img.butn { display:none; visibility:hidden; }
@page {
size:landscape;
}

</style>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
  
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td align="right" width="50%" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>"></td>
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+2"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">Address Office:&nbsp;<?php echo $row_param['address'];?><?php echo $row_param['ccity'];?>, <?php echo $row_param['pin'];?> <?php echo $row_param['cstate'];?>,<?php echo $row_param['cphone'];?></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">Address Plant:&nbsp;<?php echo $row_param['Plant'];?><?php echo $row_param['pcity'];?>, <?php echo $row_param['ppin'];?> <?php echo $row_param['pstate'];?>,<?php echo $row_param['pphone'];?></td>
</tr>
</table><br />
<?php
	$sql1=mysql_query("select * from tblissue where issue_id=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=$pid; $erid=0;
	
	$tdate=$row['issue_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$sdate=$row['strdate'];
	$syear=substr($sdate,0,4);
	$smonth=substr($sdate,5,2);
	$sday=substr($sdate,8,2);
	$sdate=$sday."-".$smonth."-".$syear;
	
	$code1="IS".$row['iss_code'];
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Stock Transfer Issue Note</td>
</tr>

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "IS".$row['issue_code'];?></td>

<td width="168" align="right" valign="middle" class="tblheading">ST&nbsp;Date&nbsp;</td>
<td width="194" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>


<?php
	$quer3=mysql_query("SELECT business_name, address FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>

<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<?php echo $row3['business_name'];?></td>
</tr>
<tr class="Light" height="20">
<td align="right"  valign="middle" class="tblheading">Address Of Party &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<?php echo $row3['address'];?></td>
</tr>

<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">STR Ref.No.&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $row['strefno'];?></td>
<td width="168"  align="right"  valign="middle" class="tblheading">STR&nbsp;Date&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" >&nbsp;<?php echo $sdate;?></td>
</tr>

<tr class="Dark" height="30"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['tmode'];?></td>
</tr>
<?php
if($row['tmode'] == "Transport")
{
?>
<tr class="Light" height="30">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_name'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<?php echo $row['trans_paymode'];?></td>
</tr>
<?php
}
else if($row['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['courier_name'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
</br>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="left"  valign="left" class="tblheading">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We acknowladge the receipt of the following goods:</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="13%" rowspan="2" align="center" valign="middle" class="tblheading">Items</td>
			   <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			    <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Issued </td>
		      </tr>
			<tr class="tblsubtitle">
                   <td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
			  </tr>
<?php
$sr=1;
$sql_eindent_sub=mysql_query("select * from tblissue_sub where issue_id=$trid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row_eindent_sub['item_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tblissue_sloc where issue_tr_id='".$trid."' and classification_id='".$row_eindent_sub['classification_id']."' and item_id='".$row_eindent_sub['item_id']."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tblissue);
$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty="";
while($row_tblissue=mysql_fetch_array($sql_tblissue))
{

 $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tblissue['subbin']."' and binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_tblissue['ups_issue'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_tblissue['qty_issue'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$balups+$row_tblissue['ups_balance'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";
$balqty=$balqty+$row_tblissue['qty_balance'];
if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tblissue['issue_rowid']."'") or die(mysql_error());
$row_stldg1=mysql_fetch_array($sql_stldg1); 

$opups=$opups+$row_stldg1['stlg_balups'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$opqty+$row_stldg1['stlg_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['issue_id'];
}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $$opqty1=""; $erid=0;
}
if($sr%2!=0)
{
?>
<tr class="Dark" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="5%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['ups_indent']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty_indent']?></td>
              </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['issuesub_id'];?>" />
<?php
}
else
{
?>			  
<tr class="Light" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="5%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['ups_indent']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty_indent']?></td>
              </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['issuesub_id'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table><br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="84" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="152"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="85" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="170" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="87" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="172" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table><br />
<table cellpadding="5" cellspacing="5" border="0" width="800">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" width="22" border="0" onClick="window.close()" target="_blank" class="butn"/>&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
