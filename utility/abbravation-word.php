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

$filename="Report-Master-".$role ['role'].".doc";    
	header("Content-type:application/vnd.ms-word"); 
	header("Content-Disposition: attachment; filename=$filename"); 
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Utility - Abbreviations</title>
<style type="text/css" >
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




</style>
</head>
<table width="630" border="0" bordercolor="#ffffff" align="center" cellpadding="0" cellspacing="0" >


  <tr valign="top">
  <td width="750" colspan="3" align="center" valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  		<?php

 if(($role =="admin" || "production" ||"plant"))
 {
		 ?> 
		 
   <table align="center" border="1" width="630" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="tblsubtitle">
       <td colspan="100" class="tblheading" align="center" bordercolor="#4ea1e1" >&nbsp;List of Abbreviation/Short forms </td>
     </tr>
<tr class="Light">
<td width="5%" align="center" class="tblheading">#</td>
<td width="17%" align="left" class="tblheading">&nbsp;Abbreviation </td>
<td width="78%" align="left" class="tblheading">&nbsp;Expansion</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">1</td>
<td align="left" class="tbltext">&nbsp;#.</td>
<td align="left" class="tbltext">&nbsp;Serial Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">2</td>
<td align="left" class="tbltext">&nbsp;Admin</td>
<td align="left" class="tbltext">&nbsp;Administrator</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">3</td>
<td align="left" class="tbltext">&nbsp;FSPN</td>
<td align="left" class="tbltext">&nbsp;Fresh Seed with PDN Note</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">4</td>
<td align="left" class="tbltext">&nbsp;GI</td>
<td align="left" class="tbltext">&nbsp;Geographic Index</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">5</td>
<td align="left" class="tbltext">&nbsp;Id</td>
<td align="left" class="tbltext">&nbsp;Identification</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">6</td>
<td align="left" class="tbltext">&nbsp;IMP-No</td>
<td align="left" class="tbltext">&nbsp;Imported-No</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">7</td>
<td align="left" class="tbltext">&nbsp;IMP-Yes</td>
<td align="left" class="tbltext">&nbsp;Imported-Yes</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">8</td>
<td align="left" class="tbltext">&nbsp;Loc.</td>
<td align="left" class="tbltext">&nbsp;Location</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">9</td>
<td align="left" class="tbltext">&nbsp;MLN.</td>
<td align="left" class="tbltext">&nbsp;Merged Lot Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">10</td>
<td align="left" class="tbltext">&nbsp;No.</td>
<td align="left" class="tbltext">&nbsp;Number </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">11</td>
<td align="left" class="tbltext">&nbsp;PDN</td>
<td align="left" class="tbltext">&nbsp;Production Dispatch Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">12</td>
<td align="left" class="tbltext">&nbsp;Pers.</td>
<td align="left" class="tbltext">&nbsp;Personnel</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">13</td>
<td align="left" class="tbltext">&nbsp;Prod.</td>
<td align="left" class="tbltext">&nbsp;Production</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">14</td>
<td align="left" class="tbltext">&nbsp;RLN</td>
<td align="left" class="tbltext">&nbsp;Regulated Lot Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">15</td>
<td align="left" class="tbltext">&nbsp;SPC-F</td>
<td align="left" class="tbltext">&nbsp;Seed Prodction Code-Female</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">16</td>
<td align="left" class="tbltext">&nbsp;SPC-M</td>
<td align="left" class="tbltext">&nbsp;Seed Prodction Code-Male </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">17</td>
<td align="left" class="tbltext">&nbsp;TLN</td>
<td align="left" class="tbltext">&nbsp;Trading Lot Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">18</td>
<td align="left" class="tbltext">&nbsp;ULN</td>
<td align="left" class="tbltext">&nbsp;Unidentified Lot Note</td>
</tr>

<!--<tr class="tblsubtitle">
       <td colspan="100" class="tblheading"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#0000FF">Abbreviations are defined by stores Administrator. Their expansions are available in data entry form and as part of help manual.</div></td>		
     </tr>
-->
<!---table code..--->


</table>
   <br />
<?php
}
else
{
?>
  
  <table align="center" border="1" width="630" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="tblsubtitle">
       <td colspan="100" class="tblheading" align="center" bordercolor="#4ea1e1" >&nbsp;List of Abbreviation/Short forms </td>
     </tr>
<tr class="Light">
<td width="5%" align="center" class="tblheading">#</td>
<td width="17%" align="left" class="tblheading">&nbsp;Abbreviation </td>
<td width="78%" align="left" class="tblheading">&nbsp;Expansion</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">1</td>
<td align="left" class="tbltext">&nbsp;#.</td>
<td align="left" class="tbltext">&nbsp;Serial Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">2</td>
<td align="left" class="tbltext">&nbsp;Admin</td>
<td align="left" class="tbltext">&nbsp;Administrator</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">3</td>
<td align="left" class="tbltext">&nbsp;CCN</td>
<td align="left" class="tbltext">&nbsp;Captive Consumption Note</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">4</td>
<td align="left" class="tbltext">&nbsp;CI</td>
<td align="left" class="tbltext">&nbsp;Cycle Inventory</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">5</td>
<td align="left" class="tbltext">&nbsp;CST</td>
<td align="left" class="tbltext">&nbsp;Central Sales Tax</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">6</td>
<td align="left" class="tbltext">&nbsp;CSW</td>
<td align="left" class="tbltext">&nbsp;Condition Seed Warehouse</td>
</tr>
<!---  
       table code..                 --->

<tr class="Dark">
<td align="center" class="tbltext">7</td>
<td align="left" class="tbltext">&nbsp;DtoG</td>
<td align="left" class="tbltext">&nbsp;Damage To  Good</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">8</td>
<td align="left" class="tbltext">&nbsp;DC</td>
<td align="left" class="tbltext">&nbsp;Delivery Challan</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">9</td>
<td align="left" class="tbltext">&nbsp;D.C./Inv. No.</td>
<td align="left" class="tbltext">&nbsp;Delivery challan Invoice Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">10</td>
<td align="left" class="tbltext">&nbsp;D2GN</td>
<td align="left" class="tbltext">&nbsp;Damage To  Good Note </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">11</td>
<td align="left" class="tbltext">&nbsp;DCNo.</td>
<td align="left" class="tbltext">&nbsp;Delivery Challan Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">12</td>
<td align="left" class="tbltext">&nbsp;e-Indent</td>
<td align="left" class="tbltext">&nbsp;Electronic Indent</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">13</td>
<td align="left" class="tbltext">&nbsp;EIR.</td>
<td align="left" class="tbltext">&nbsp;e-Indent Roles</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">14</td>
<td align="left" class="tbltext">&nbsp;ESN</td>
<td align="left" class="tbltext">&nbsp;Excess Shortage Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">15</td>
<td align="left" class="tbltext">&nbsp;Ex/Sh.</td>
<td align="left" class="tbltext">&nbsp;Excess Shortage </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">16</td>
<td align="left" class="tbltext">&nbsp;GtoD</td>
<td align="left" class="tbltext">&nbsp;Good To Damage</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">17</td>
<td align="left" class="tbltext">&nbsp;G2DN.</td>
<td align="left" class="tbltext">&nbsp;Good To Damage Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">18</td>
<td align="left" class="tbltext">&nbsp;GRN</td>
<td align="left" class="tbltext">&nbsp;Good Receive Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">19</td>
<td align="left" class="tbltext">&nbsp;ID</td>
<td align="left" class="tbltext">&nbsp;Identification</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">20</td>
<td align="left" class="tbltext">&nbsp;IITN</td>
<td align="left" class="tbltext">&nbsp;Inter Item Transfer Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">21</td>
<td align="left" class="tbltext">&nbsp;IMRN</td>
<td align="left" class="tbltext">&nbsp;Internal Material Return Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">22</td>
<td align="left" class="tbltext">&nbsp;IITN-O</td>
<td align="left" class="tbltext">&nbsp;Internal Material Return Note-Own</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">23</td>
<td align="left" class="tbltext">&nbsp;IITN-P</td>
<td align="left" class="tbltext">&nbsp;Internal Material Return Note-Party</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">24</td>
<td align="left" class="tbltext">&nbsp;Kg</td>
<td align="left" class="tbltext">&nbsp;Kilogram</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">25</td>
<td align="left" class="tbltext">&nbsp;MDN</td>
<td align="left" class="tbltext">&nbsp;Material Discard Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">26</td>
<td align="left" class="tbltext">&nbsp;No.</td>
<td align="left" class="tbltext">&nbsp;Number</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">27</td>
<td align="left" class="tbltext">&nbsp;nos.</td>
<td align="left" class="tbltext">&nbsp;Numbers</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">28</td>
<td align="left" class="tbltext">&nbsp;OP</td>
<td align="left" class="tbltext">&nbsp;Operator</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">29</td>
<td align="left" class="tbltext">&nbsp;PAN</td>
<td align="left" class="tbltext">&nbsp;Permanent Account Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">30</td>
<td align="left" class="tbltext">&nbsp;DC Ref.</td>
<td align="left" class="tbltext">&nbsp;Delivery Challan Reference</td>
</tr>
<!---  
       table code..                 --->

<tr class="Dark">
<td align="center" class="tbltext">31</td>
<td align="left" class="tbltext">&nbsp;PIN</td>
<td align="left" class="tbltext">&nbsp;Physical Indent Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">32</td>
<td align="left" class="tbltext">&nbsp;P-Indent</td>
<td align="left" class="tbltext">&nbsp;Physical Indent</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">33</td>
<td align="left" class="tbltext">&nbsp;PSW</td>
<td align="left" class="tbltext">&nbsp;Packed Seed Warehouse</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">34</td>
<td align="left" class="tbltext">&nbsp;Qty</td>
<td align="left" class="tbltext">&nbsp;Quantity </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">35</td>
<td align="left" class="tbltext">&nbsp;RSW</td>
<td align="left" class="tbltext">&nbsp;Raw Seed Warehouse</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">36</td>
<td align="left" class="tbltext">&nbsp;SLOC</td>
<td align="left" class="tbltext">&nbsp;Storage Location</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">37</td>
<td align="left" class="tbltext">&nbsp;SRV</td>
<td align="left" class="tbltext">&nbsp;Stores Report Viewer</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">38</td>
<td align="left" class="tbltext">&nbsp;Kms.</td>
<td align="left" class="tbltext">&nbsp;Kolometers</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">39</td>
<td align="left" class="tbltext">&nbsp;ST Date</td>
<td align="left" class="tbltext">&nbsp;Stock Transfer Date</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">40</td>
<td align="left" class="tbltext">&nbsp;STIN</td>
<td align="left" class="tbltext">&nbsp;Stock Transfer Issue Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">41</td>
<td align="left" class="tbltext">&nbsp;STN No.</td>
<td align="left" class="tbltext">&nbsp;StockTransfer Note Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">42</td>
<td align="left" class="tbltext">&nbsp;STON</td>
<td align="left" class="tbltext">&nbsp;Stock Transfer Out Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">43</td>
<td align="left" class="tbltext">&nbsp;STR Date</td>
<td align="left" class="tbltext">&nbsp;Stock Transfer Request date</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">44</td>
<td align="left" class="tbltext">&nbsp;STR Ref. No.</td>
<td align="left" class="tbltext">&nbsp;Stock Transfer Reference Number</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">45</td>
<td align="left" class="tbltext">&nbsp;STRN</td>
<td align="left" class="tbltext">&nbsp;Stock Transfer Receipt Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">46</td>
<td align="left" class="tbltext">&nbsp;TBB</td>
<td align="left" class="tbltext">&nbsp;To Be Billed</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">47</td>
<td align="left" class="tbltext">&nbsp;UoM</td>
<td align="left" class="tbltext">&nbsp;Unit of Measurement</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">48</td>
<td align="left" class="tbltext">&nbsp;UPS</td>
<td align="left" class="tbltext">&nbsp;Unit Pack Size</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">49</td>
<td align="left" class="tbltext">&nbsp;VMRN</td>
<td align="left" class="tbltext">&nbsp;Vendor Material Return Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">50</td>
<td align="left" class="tbltext">&nbsp;WH</td>
<td align="left" class="tbltext">&nbsp;Warehouse</td>
</tr>
<!--<tr class="tblsubtitle">
       <td colspan="100" class="tblheading"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#0000FF">Abbreviations are defined by stores Administrator. Their expansions are available in data entry form and as part of help manual.</div></td>		
     </tr>-->

<!---table code..--->


</table>

<?php
}
?>
   </form>
</td></tr>