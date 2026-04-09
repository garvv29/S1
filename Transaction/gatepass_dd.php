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

	$sql_code="SELECT MAX(gpcode) FROM tbl_gate ORDER BY gpcode DESC";
	$rescode=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($rescode) > 0)
			{
				$row_code=mysql_fetch_row($rescode);
				$t_code=$row_code['0'];
				$gpcode=$t_code+1;
			}	
		else
		{
			$gpcode=1;
			
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
	$sql1=mysql_query("SELECT * FROM tbl_discard  where tid=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=$pid; $erid=0;

	 $tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$sdate=$row['strdate'];
	$syear=substr($sdate,0,4);
	$smonth=substr($sdate,5,2);
	$sday=substr($sdate,8,2);
	$sdate=$sday."-".$smonth."-".$syear;

$cod="MD".$row['dd_code'];

$sql_gate=mysql_query("select * from tbl_gate where trid='".$cod."'") or die (mysql_error());
$row_gate=mysql_fetch_array($sql_gate);
$gpcode=$row_gate['gpcode'];

$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	  
	   <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
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
<HR align="center" width="750" />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">GATE PASS OUT</font></td>
</tr>
</table><br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
	$quer3=mysql_query("SELECT * FROM tbl_discard "); 
	$row3=mysql_fetch_array($quer3);
?>
	
<tr class="Dark" >
<td width="444" rowspan="3"  align="left" valign="top" class="smalltbltext"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $row['party_name'];?><br /><?php echo $row['address']." ".$row['address1']." ".$row['city']." ".$row['pin']." ".$row['state'];?></div></td>
<td width="181"  align="right" valign="middle" class="smalltblheading">Gate Pass No.&nbsp;</td>
<td width="178"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo "MD".$row['dd_code']."/".$yearid_id."/".$gpcode;?></td>
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
              <td width="10%" align="center" valign="middle" class="tblheading">#</td>
			 <td width="29%" align="center" valign="middle" class="tblheading">Classification</td>
              <td width="40%" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="6%" align="center" valign="middle" class="tblheading">UoM</td>
			    <td width="7%" align="center" valign="middle" class="tblheading">UPS</td>
			    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
    </tr>
<?php
$sr=1;
$sql_eindent_sub=mysql_query("select * from tbl_discard_sub where did_s=$pid") or die(mysql_error());
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
if($sr%2!=0)
{
?>		  
			<tr class="Dark" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
				 <td align="center" class="smalltbltext" valign="middle"><?php echo $slups;?></td>
				 <td align="center" width="8%" class="smalltbltext" valign="middle"><?php echo $slqty;?></td>
		    </tr>
<?php
}
else
{
?>			
<tr class="Light" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
				 <td align="center" class="smalltbltext" valign="middle"><?php echo $slups;?></td>
				 <td align="center" width="8%" class="smalltbltext" valign="middle"><?php echo $slqty;?></td>
		    </tr>
<?php
}
$sr=$sr+1;
}

?>				 
</table>
<br />

<table width="750" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-collapse:collapse"> 
<tr class="light" height="25">
              <td width="19%" align="right" valign="middle" class="tblheading">Return Status&nbsp;</td>
  					<td width="81%" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['rettyp'];?></td>
</tr>

<tr class="Light" height="30">
<td width="147" align="right"  valign="middle" class="tblheading">&nbsp;Dispatch Through&nbsp;</td>
<td width="703" align="left"  valign="middle" class="tbltext"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php
if($row['tmode'] != "")
{
if($row['tmode'] == "Transport")
{
echo "Transport Name: ".$row['tname'].",  ";
echo "Lorry Receipt No.: ".$row['lrno'].",  ";
echo "Vehicle No.: ".$row['vno'].",  ";
if($row['pmode'] == "ToPay")
$pmode="To Pay";
else
$pmode=$row['pmode'];
echo "Payment Mode: ".$pmode;
}
else if($row['tmode'] == "Courier")
{
echo "Courier Name: ".$row['cname'].",  ";
echo "Docket no: ".$row['dcno'];
}
else 
{
echo "Name of Person: ".$row['pname'];
}
}
else
{
echo "Not Applicable";
}
?></div></td>
</tr>
</table><br /><br />
<br />


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
<td align="right" colspan="3"><img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"/>&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
