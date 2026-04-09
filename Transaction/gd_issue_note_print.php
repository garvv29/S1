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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="opr1";
	//$lgnid="OP1";
	$tp="GD";
	
	$rettyp="good";
	
	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Transaction- good To damage Note</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>


</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	   <input name="tp" value="<?php echo $tp;?>" type="hidden"> 
	  
 <?php 
$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	
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

<?php
	$sql1=mysql_query("select * from tbl_gtod where gid=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$trid=$pid; $erid=0;
	
	
	$classid=$row['classification_id'];
	$itemid=$row['items_id'];
	
	$tdate=$row['date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	 ?> 
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR width="770" align="center" />


<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Good to Damage Note (G2DN)</font></td>
</tr>
</table><br class="smalltbltext" />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="20">
<td width="174" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="168" align="right" valign="middle" class="tblheading">&nbsp;G2DN No.&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "GD".$row['gcode']."/".$yearid_id."/".$row['ncode'];?></td>
</tr>
<tr class="Light" height="30">
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>

<td align="right"  valign="Top" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" ><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $row3['business_name'];?><br /><?php echo $row3['address'];?>, <?php echo $row3['city'];?>, <?php echo $row3['state'];?><br />Ph: <?php echo "0".$row3['std']." ".$row3['phone'];?></div></td>
</tr>
<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($quer3);
?>
		 <tr class="Dark" height="25">
           <td width="171"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?>&nbsp;</td>
         </tr>
		 
<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
?> 
		<tr class="Light" height="25">
           <td width="171" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle" id="item" class="tbltext">&nbsp;<?php echo $noticia_item['stores_item'];?>&nbsp;</td>
    
            <td width="39" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
           <td align="left"  valign="middle" id="uom" class="tbltext">&nbsp;<?php echo $row['uom'];?></td>
         </tr>
<?php

	$sql_issue=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' group by rowid") or die(mysql_error());
	$srno=1;
	$totups=0; $totqty=0;$slups=0; $slqty=0;
 	while($row_issue=mysql_fetch_array($sql_issue))
	{ 
		$sql_sloc=mysql_query("select * from tbl_gtod_sub where gid='".$trid."' and rowid='".$row_issue['rowid']."'") or die(mysql_error());
		while($row_sloc=mysql_fetch_array($sql_sloc))
		{ 
			$slups=$slups+$row_sloc['ups'];
			$slqty=$slqty+$row_sloc['qty'];
		}
	}
?>
		<tr class="Dark" height="25">
           <td width="171" height="24"  align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
           <td align="left"  valign="middle" id="item" class="tbltext">&nbsp;<?php echo $slups;?>&nbsp;</td>
    
            <td width="39" height="24"  align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
           <td align="left"  valign="middle" id="uom" class="tbltext">&nbsp;<?php echo $slqty;?></td>
         </tr> 
</table>
<input type="hidden" name="trid" value="<?php echo $trid;?>" /><br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark">
<td width="64" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="680" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="40" align="right"  valign="middle" class="tblheading">&nbsp;TIN:&nbsp;</td>
<td width="164" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="35" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="176" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="119" align="right"  valign="middle" class="tblheading">Seed License No.:&nbsp;</td>
<td width="216" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr></table>
<br />

<br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="84" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="152"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="84" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="171" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="87" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="172" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table><br />
<table cellpadding="5" align="center" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><a href="gd_issue_note_print_word.php?itmid=<?php echo $pid?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer" /></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer" />&nbsp;&nbsp;</td>
</tr>
</table></form>
</td></tr>
</table>

</body>
</html>
