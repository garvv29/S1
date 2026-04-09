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
	$tp="DD";
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];
	}
	
/*$a="IE";
	$sql_code="SELECT MAX(issue_code) FROM tblissue where issue_type='pindent' ORDER BY issue_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction- Material Discard Note</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>

</head>
<body topmargin="0" >
<?php 
$tid=$itmid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Vendor' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
	?>
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  

   <?php
	$sql1=mysql_query("select * from tbl_discard where tid='".$pid."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=$pid; $erid=0;
	$t=mysql_num_rows($sql1);
	
	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
	
	$code1="DD".$row['dd_code'];
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Material Discard </td>
</tr>

<tr class="Dark" height="30">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TMD".$row['tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="168" align="right" valign="middle" class="tblheading">Discard&nbsp;Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<tr class="Light" height="25">
<td width="174"  align="right"  valign="middle" class="tblheading">Discard &nbsp;Instruction Ref. No.&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3" >&nbsp;<?php echo $row['drno'];?></td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['party_name'];?></td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<?php echo $row['address']." ".$row['address1']." ".$row['city']." ".$row['pin']." ".$row['state'];?><br />&nbsp;Ph: <?php echo $row['phoneno'];?></td>
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
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['lrno'];?></td>
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
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['dcno'];?></td>
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
</br>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">

			 <tr class="tblsubtitle" height="20">
              <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="28%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="39%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td> 
			  
                  <td colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
          </tr>
			<tr class="tblsubtitle">
			  <td width="9%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$srno=1;
$sql_eindent_sub=mysql_query("select * from tbl_discard_sub where did_s='".$pid."'") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['calssification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select * from tbl_stores where items_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tbl_discard_sloc where discard_trid='".$trid."' and classification_id='".$row_eindent_sub['calssification_id']."' and item_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
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

$slups=$slups+$row_tblissue['ups_discard'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_tblissue['qty_discard'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$balups+$row_tblissue['ups_discard'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";
$balqty=$balqty+$row_tblissue['qty_discard'];

if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_tblissue['discard_rowid']."'") or die(mysql_error());
$row_stldg1=mysql_fetch_array($sql_stldg1); 

$opups=$opups+$row_stldg1['stld_balups'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$opqty+$row_stldg1['stld_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['discard_id'];
}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $$opqty1=""; $erid=0;
}
if($srno%2!=0)
{
?>		  
 <tr class="Light" height="20">
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
			 <td width="28%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['classification'];?></td>
             <td width="39%" align="center" valign="middle" class="tbltext"><?php echo $noticia_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $noticia_item['uom'];?></td>
             <td width="9%" align="center" valign="middle" class="tbltext"><?php echo $slups;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $slqty;?></td>
		  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />

<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
			 <td width="28%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['classification'];?></td>
             <td width="39%" align="center" valign="middle" class="tbltext"><?php echo $noticia_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $noticia_item['uom'];?></td>
             <td width="9%" align="center" valign="middle" class="tbltext"><?php echo $slups;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $slqty;?></td>
		  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
<?php 
}
$srno=$srno+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="127" align="right"  valign="middle" class="tblheading">&nbsp;Return Status&nbsp;</td>
<td width="617" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['rettyp'];?></td>
</tr>

<tr class="Dark" height="20">
<td width="127" align="right"  valign="middle" class="tblheading">&nbsp;Reason for Discard&nbsp;</td>
<td colspan="11" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()" target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
