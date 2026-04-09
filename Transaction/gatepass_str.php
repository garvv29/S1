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
	$tp="stocktr";	
	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
	
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transction-Gate Pass</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
</head>



<body>

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


$cod="IS".$row['iss_code'];

$sql_gate=mysql_query("select * from tbl_gate where trid='".$cod."'") or die (mysql_error());
$row_gate=mysql_fetch_array($sql_gate);
$gpcode=$row_gate['gpcode'];

$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	  
	   <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#4ea1e1">
<tr class="Light">
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>, <?php echo $row_param['pcity'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table>

 <table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">GATE PASS OUT</font></td>
</tr>
</table><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>
	
<tr class="Dark" >

<td width="444" rowspan="3"  align="left" valign="top" class="smalltbltext"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $row3['business_name'];?><br />
<?php echo $row3['address'];?>, <?php echo $row3['city'];?>, <?php echo $row3['pin'];?>, <?php echo $row3['state'];?>,<br />
Ph: <?php echo $row3['mob'];?>, <?php echo $row3['std'];?>-<?php echo $row3['phone'];?></div> </td>
<td width="181"  align="right" valign="middle" class="smalltblheading">Gate Pass No.&nbsp;</td>
<td width="178"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "IS".$row['iss_code']."/".$yearid_id."/".$gpcode;?></td>
</tr>	
		  <tr class="Dark" >
<td width="181"  align="right" valign="middle" class="smalltblheading">Date&nbsp;&nbsp;</td>
<td width="178"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
	 <tr class="Dark" >
<td width="181" height="20"  align="right" valign="middle" class="smalltblheading">Gate Outward No.&nbsp;</td>
<td width="178"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>	
 </table>
<br />


<table width="750" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-collapse:collapse"> 
<tr class="tblsubtitle" height="25">
              <td width="7%" align="center" valign="middle" class="tblheading">#</td>
			 <td width="11%" align="center" valign="middle" class="tblheading">Classification</td>
              <td width="12%" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="11%" align="center" valign="middle" class="tblheading">UoM</td>
			    <td width="11%" align="center" valign="middle" class="tblheading">UPS</td>
			    <td width="11%" align="center" valign="middle" class="tblheading">Qty</td>
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
$trcls="Dark";
}
else
{
$trcls="Light";
}
?>
			<tr class="<?php echo $trcls;?>" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
				 <td align="center" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['ups_indent']?></td>
				 <td align="center" width="11%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty_indent']?></td>
		    </tr>
<?php
$sr=$sr+1;
}
?>				 
</table>
<br/>
<table width="750" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-collapse:collapse"> <tr class="Light" height="30">
<td width="117" align="right"  valign="middle" class="tblheading">&nbsp;Dispatch Details:&nbsp;</td>
<td width="627" align="left"  valign="middle" class="tbltext"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php
if($row['tmode'] == "Transport")
{
echo "Transport Name: ".$row['trans_name'].",  ";
echo "Lorry Receipt No.: ".$row['trans_lorryrepno'].",  ";
echo "Vehicle No.: ".$row['trans_vehno'].",  ";
if($row['trans_paymode'] == "ToPay")
$pmode="To Pay";
else
$pmode=$row['trans_paymode'];
echo "Payment Mode: ".$pmode;
}
else if($row['tmode'] == "Courier")
{
echo "Courier Name: ".$row['courier_name'].",  ";
echo "Docket no: ".$row['docket_no'];
}
else 
{
echo "Name of Person: ".$row['pname_byhand'];
}
?></div></td>
</tr>

<tr class="light" height="25">
              <td width="117" align="right" valign="middle" class="tblheading">Return Status&nbsp;</td>
  					<td width="627" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['rettyp'];?></td>
</tr>
</table>
<br/>
<br/>
<br/>

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="100" align="right" valign="middle" class="smalltblheading">Issued by&nbsp;</td>
<td width="177"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="79" align="right" valign="middle" class="smalltblheading">Checked by&nbsp;</td>
<td width="154" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="87" align="right" valign="middle" class="smalltblheading">Plant Manager&nbsp;</td>
<td width="153" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	      </table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"/>&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" style="cursor:pointer" class="butn" />&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
