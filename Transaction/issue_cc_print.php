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

	//$logid="opr1";
	//$lgnid="OP1";
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
$a="IE";
	$sql_code="SELECT MAX(issue_code) FROM tblissue where yearcode='$year_id' and issue_type='pindent' ORDER BY issue_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code."/".$yearid_id;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction-Captive Consumption Note</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
</head>
<body topmargin="0" >
<?php
	$sql1=mysql_query("select * from tbl_captive where tid=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=$pid; $erid=0;
	 ?>   
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Captive Consumption</td>
</tr>
    <?php
   $tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
   /* $resettargetquery=mysql_query("select * from tbl_roles where id='".$row['strefno']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);*/
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="20">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TCC".$row['code']."/".$yearid_id."/".$lgnid;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="20">
<?php
	if($row['party_id'] != "")
	{
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
	$business_name=$row3['business_name'];
	$address=$row3['address'].", ".$row3['city'].", ".$row3['state'];
	$phone="0".$row3['std']." ".$row3['phone'];
	}
	else
	{
	$business_name=$row['party_name'];
	$address=$row['address']." ".$row['address1']." ".$row['city']." ".$row['pin']." ".$row['state'];
	$phone=$row['contactno'];
	}
?>

<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $business_name;?></td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $address;?><br />Ph: <?php echo $phone;?></div></td>
</tr>

<?php
if($row['tmode'] == "") 
{
?>
<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo "Not Applicable"; ?></td>
</tr>
<?php
}
if($row['tmode'] != "") 
{
?>
<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['tmode'];?></td>
</tr>
<?php
if($row['tmode'] == "Transport")
{
?>
<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['tname'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row['lrno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['vno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php if($row['pmode'] == "ToPay")
$pmode="To Pay";
else
$pmode=$row['pmode'];
echo $pmode;?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row['tmode'] == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['cname'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['docketno'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['pname'];?></td>
</tr>
<?php
}
}
?>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse"><tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="22%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			    <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock</td>
                  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Issue</td>
               <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Balance</td>
              </tr>
			<tr class="tblsubtitle">
                   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
					 <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
                   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
				   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$srno=1;
$sql_eindent_sub=mysql_query("select * from tbl_captivesub where id_in=$pid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tbl_captive_sloc where issue_trid='".$trid."' and classification_id='".$row_eindent_sub['classification_id']."' and item_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tblissue);
$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; 
while($row_tblissue=mysql_fetch_array($sql_tblissue))
{


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
$erid=$row_tblissue['isue_id'];
}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $$opqty1=""; $erid=0;
}
if($srno%2!=0)
{
?>


<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $opups;?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php echo $opqty;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balups;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
</tr>
<?php
	}
	else
	{ 
	
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $opups;?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php echo $opqty;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balups;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
</tr>
<?php	}
	 $srno=$srno+1;
	
}
?>
</table>
<input type="hidden" name="trid" value="<?php echo $pid?>" />

		  <br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="84" align="right"  valign="middle" class="tblheading">&nbsp;Return status&nbsp;</td>
<td width="660" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['rettyp'];?></td>
</tr>
<tr class="Dark" height="30">
<td width="84" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="660" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>

</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
