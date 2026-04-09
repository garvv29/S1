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
	}$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$logid="OP1";
	$lgnid="OP1";
	
		
	if(isset($_REQUEST['itmid']))
	{
	$pid = $_REQUEST['itmid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
				
	}
   $filename="Transaction-Arrival-Internal Material Return-Good.doc";    
	header("Content-type:application/vnd.ms-word"); 
	header("Content-Disposition: attachment; filename=$filename"); 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Transaction -Arrival - Internal Material Return - Good</title>
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

<?php 
 $tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where  arrival_type='Internalreturn' and arrival_id='".$tid."'") or die(mysql_error());
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

	  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">  
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td align="right" width="37%" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>"></td>
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+3"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">Address-Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?> - <?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">Address-Plant:&nbsp;<?php echo $row_param['plant'];?>, <?php echo $row_param['pcity'];?> - <?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?></td>
</tr>
</table>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<HR />

<tr  height="25">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Internal Material Return Note - Party (IMRN-P)</td>
</tr> </table> <br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Dark" height="25">
      <td width="175" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
      <td width="281" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo "AI".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>
    
	  <td width="139" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
      <td width="145" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>
<?php
	$quer3=mysql_query("SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
?>

<tr class="Light" height="20">
<td align="right"  valign="top" class="tblheading">Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $row3['business_name'];?><br /><?php echo $row3['address'];?>, <?php echo $row3['city'];?> - <?php echo $row3['pin'];?>, <?php echo $row3['state'];?>,<br />Ph: <?php echo $row3['mob'];?>, <?php echo $row3['std'];?>-<?php echo $row3['phone'];?> </div></td>
</tr>


<tr class="Light" height="25">	  
		<td width="139" height="24"  align="right"  valign="middle" class="tblheading"> Return from Stage&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['stageret'];?></td>
<?php
$quer1=mysql_query("SELECT id ,login FROM tbl_roles where stage='".$row_tbl['stageret']."' and id='".$row_tbl['retid']."'")or die(mysql_error()); 
$row1=mysql_fetch_array($quer1);
$tot_1=mysql_num_rows($quer1);
?></tr>
<tr class="Dark" height="30">
      <td width="192" height="24"  align="right"  valign="middle" class="tblheading">Return By ID&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext" id="retby" colspan="3" >&nbsp;<?php echo $row_tbl['retid'];?>&nbsp;&nbsp;&nbsp;&nbsp;<font class="tblheading">OR Specify</font>&nbsp;
<?php
if($tot_1 ==0)
{
?>
&nbsp;<?php echo $row_tbl['retid'];?></td>
<?php
}
else
{
?>
</tr>
<?php 
}
?>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());
$subtid=0;
?>
			 <tr class="tblsubtitle" height="20">
              <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="20%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
                <td colspan="2"  align="center" valign="middle" class="tblheading">Quantity Damage</td>
                  <td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
              </tr>
			
			<tr class="tblsubtitle">
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
					<td width="2%" align="center" valign="middle" class="tblheading">G/D</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$srno=1; $itmdchk="";
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{
if($itmdchk!="")
{
$itmdchk=$itmdchk.$row_tbl_sub['item_id'].",";
}
else
{
$itmdchk=$row_tbl_sub['item_id'].",";
}

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="20%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>			 <td align="center" valign="middle" class="tblheading"><?php echo $gd;?></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
		  </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="20%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_item['uom'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>			 <td align="center" valign="middle" class="tblheading"><?php echo $gd;?></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
		  </tr> 
<?php
}
$srno++;
}
}
?> </table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="8%" align="center" valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="92%" align="left" valign="middle" class="tblheading" colspan="18">&nbsp;<?php echo $row_tbl['remarks'];?>&nbsp;</td>
</tr>			  
      </table>
<br />


<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
      </table>
     </td>
	  </tr>
	  </table>
<!-- actual page end--->	
		  
		 
</body>
</html>
