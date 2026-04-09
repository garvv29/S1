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
	$tp="cc";
	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	}
		$filename="Transaction-Excess Shortage Note".$pid ['itmid'].".doc";    
	header("Content-type:application/vnd.ms-word"); 
	header("Content-Disposition: attachment; filename=$filename"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Transaction -ESN</title>
<style type="text/css">/* CSS Document */

body{ 
	margin-top:0px; 
	margin-left:0px; 
	margin-right:0px; 
	margin-bottom:0px;  
	
/*	background-color:#506030 
	background-color:#FEFEFE*/
	}
	
#wrapperleftmenu{ 
	float:left;
	background-image:url(images/leftmenu_bg.jpg); background-repeat:repeat-y; 
	position:absolute; 
	width:184px;
	border:1px solid red;
	height:450px;}
	
#leftmenu_top{ 
	float:left; 
	position:absolute; 
	width:184px; 
	height:auto;
	text-decoration:none; }
	
#leftmenu{ 	
		text-decoration:none;
		float:left;
		position:relative;
		margin-left:0px;
		width:184px;}
		
.menufont{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:15px;
		font-weight:bold;
		padding-left:15px;
		color:#000000;}
		
.submenufont{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;		
		color:#000000;}
/*		
.submenufont a{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:normal;
		text-decoration:none;
		margin-left:35px;
		line-height:18px;
		color:#000000;}
		
.submenufont a:hover{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;
		text-decoration:none;
		margin-left:35px;
		line-height:18px;
		color:#000000;}
		
*/
.tblheading{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:bold;
		color:#303030;}
		
.tbltext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:13px;
		font-weight:normal;
		color:#000000;}

.smalltblheading{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:11px;
		font-weight:bold;
		color:#303030;}
		
.smalltbltext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:11px;
		font-weight:normal;
		color:#000000;}
		
		
.tbldtext{ font-family:"Arial", Arial, Trebuchet MS;
		font-size:12px;
		font-weight:normal;
		color:#000000;}

		
#master{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
		
.test{width:176px;float:left; position:absolute; text-decoration:mone;
border-bottom: 1px solid #FFFFFF;
}

.butn
{
}
#transaction{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}

#search{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
	
#utility{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
		
#reports{ 	
		background-color:#c8d597;
		position:relative;
		margin-left:1px;
		border-left:1px solid #ebf4d4;
		border-right:1px solid #ebf4d4;
		border-top:1px solid #ebf4d4;
		border-bottom:1px solid #ebf4d4;
		width:171px;}
								
#wrapperpendtask{
	float:left;
	margin-top:20px;
	border:1px solid #FF0000;
	position:relative;
	width:184px; 
	height:50px;}
.pendtask{
	float:left;
	background-image:url(images/sub_bg.jpg); background-repeat:no-repeat;
	height:17px;
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color: #303918;
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
	}
	
.Mainheading
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 16px;
	color: #404d21;
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.subheading
{

	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color:#704f00;
	/*color: #303918;*/
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.tblbutn
{
	font-family:"Arial", Arial, Trebuchet MS;
	font-size: 14px;
	color:#FFFFFF;
	/*color: #303918;*/
	/*color: #404d21;*/
	font-weight: Bold;
	/*letter-spacing:1px;*/
}
.Light{
	background-color:#FFFFFF
	/*background-color:#f6ffe0;
	background-color: #ebf4d4;*/
}
.backcolor{
	background-color:#F1F1F1;
	/*background-color: #ebf4d4;*/
}
.Dark{ 
	background-color:#F5F5F5
	/*background-color: #dce9a5;
	background-color:#b4d554;E2E2E2*/
}
.tbltitle{ 
	background-color:#4ea1e1
	/*background-color: #dce9a5;
	background-color:#b4d554;*/
}
.tblsubtitle{ 
	background-color:#D2E9FF
	/*background-color: #dce9a5;
	background-color:#b4d554;*/
}	



body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:landscape;}
</style>
  
<table width="800" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
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
</table><HR/>
<?php
	$sql1=mysql_query("select * from tbl_excess where tid=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=$pid; $erid=0;
	
	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
	
	$code1="ES".$row['escode'];
	 ?> 
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr  height="20">
  <td colspan="6" align="center" class="tblheading">Excess/Shortage Note</td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="20">
<td width="181" align="right" valign="middle" class="tblheading">Ex/Sh Date&nbsp;</td>
<td width="327"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>

<td width="63" align="right" valign="middle" class="tblheading">&nbsp;ESN No.&nbsp;</td>
<td width="169" align="left" valign="middle" class="tbltext">&nbsp;<?php echo "ES".$row['escode']."/".$yearid_id."/".$row['ncode'];?></td>
</tr>

<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($quer3);
$trid=0;$rid=0;
?>
		 <tr class="Dark" height="25">
           <td width="181"  align="right"  valign="middle" class="tblheading">&nbsp;Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $noticia_class['classification'];?></td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
?> 
		<tr class="Light" height="25">
           <td width="181" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle" class="tbltext" id="item">&nbsp;<?php echo $noticia_item['stores_item'];?></td>
         
		 <?php 
$itemqry1=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$row_itm=mysql_fetch_array($itemqry1);
?> 
		
            <td width="63" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
           <td align="left"  valign="middle" class="tbltext" id="uom">&nbsp;<?php echo $row_itm['uom'];?></td>
         </tr>
		 
<tr class="Dark" height="25">
 <td width="181" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
 <td align="left"  valign="middle" colspan="5" class="tbltext">&nbsp;<?php echo $row['typ'];?></td>
         </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" valign="middle" class="tblheading">Pre Excess/Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Excess</td>
  <td align="center" colspan="2" valign="middle" class="tblheading">Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Post Ex/Sh Balance</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="66" align="center" valign="middle" class="tblheading">#</td>
<td width="112" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="50" align="center" valign="middle" class="tblheading">UPS</td>
<td width="88" align="center" valign="middle" class="tblheading">Qty</td>
<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
<td width="73" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="63" align="center" valign="middle" class="tblheading">Qty</td>
<td width="76" align="center" valign="middle" class="tblheading">UPS</td>
<td width="65" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php

$sql_issue=mysql_query("select * from tbl_excess_sub where esid='".$pid."'") or die(mysql_error());

$srno=1;

 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$wareh=""; $binn=""; $subbinn=""; $sups=0;$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issue['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issue['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issue['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

if($row_issue['upsex'] == 0 && $row_issue['qtyex']==0)
{
$sups=$row_issue['balups'] + $row_issue['upssh'];
$sqty=$row_issue['balqty'] + $row_issue['qtysh'];
}
else 
{
$sups=$row_issue['balups'] - $row_issue['upsex'];
$sqty=$row_issue['balqty'] - $row_issue['qtyex'];
}
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upsex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtyex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upssh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtysh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upsex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtyex'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['upssh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['qtysh'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issue['balqty'];?></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 ?>
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="65" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="679" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>
<!--<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="20">
<td width="53" align="right"  valign="middle" class="tblheading">&nbsp;TIN:&nbsp;</td>
<td width="206" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['tin'];?></td>

<td width="50" align="right"  valign="middle" class="tblheading">CST:&nbsp;</td>
<td width="201" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['cst_no'];?></td>

<td width="112" align="right"  valign="middle" class="tblheading">Seed Licese No.:&nbsp;</td>
<td width="178" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_param['licence_no'];?></td>
</tr>
</table>-->
<br />

<!--<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table>--><br />
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

</form>
</td></tr>
</table>

</body>
</html>
