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

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
/*if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}*/


	//if($a==1)
	//{
	//$a=13;
	//}
$flag=0; 
//echo $a;
$sql_tt=mysql_query("select uom from tbl_stores where items_id='$a'")or die("Error:".mysql_error());
$row_tt=mysql_fetch_array($sql_tt);

$sql_itmlg=mysql_query("select * from tbl_stldg_good where stlg_tritemid='".$a."'") or die(mysql_error());
$row_itmlg=mysql_num_rows($sql_itmlg);

$sql_itmld=mysql_query("select * from tbl_stldg_damage where stld_tritemid='".$a."'") or die(mysql_error());
$row_itmld=mysql_num_rows($sql_itmld);
if($row_itmlg > 0 || $row_itmld > 0)
{
?>
<tr class="Light" height="20"><td align="center" valign="middle" class="tblheading"><font color="#FF0000">The Item has been already entered. Please selct another Item to continue</font></td></tr>
<?php
}
else
{
?>
<tr> 
<td> 
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Dark" height="20">		
<td width="214" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tt['uom'];?>"  />&nbsp;</td>
</tr>

 <tr class="Light" height="25">
            <td width="214" height="24"  align="right"  valign="middle" class="tblheading">Type &nbsp;</td>
            <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="radio" class="tbltext" value="good" onClick="clk22(this.value);" />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="damage" onClick="clk22(this.value);" />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp; </td>
         </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS &nbsp;</td>
<td width="345" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschk1(this.value);"/>&nbsp;</td>
<td width="123" align="right"  valign="middle" class="tblheading">Quantity &nbsp;</td>
<td width="158" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value);"  />&nbsp;</td></tr>
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse; display:none" id="slocselectg" >
<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">SLOC > Good Item > No of Bins&nbsp;</td>
<td width="638" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="tblslocnog" style="width:60px;" onchange="bingood(this.value);" >
<option value="">--Bin--</option>
<option value="1" >1</option>
<option value="2" >2</option>
<option value="3" >3</option>   
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div  id="gsloc1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<tr class="Light" height="30" >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:60px;" onchange="wh1(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg1 = mysql_fetch_array($whg1_query)) { ?>
		<option value="<?php echo $noticia_whg1['whid'];?>" />   
		<?php echo $noticia_whg1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="300"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div id="gsloc2" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:60px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg2 = mysql_fetch_array($whg2_query)) { ?>
		<option value="<?php echo $noticia_whg2['whid'];?>" />   
		<?php echo $noticia_whg2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="300"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="48" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div  id="gsloc3" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:60px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="305"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse; display:none" id="slocselectd" >
 <tr class="Dark" height="30">
<td width="205" align="right"  valign="middle" class="tblheading">SLOC > Damage Item > No of Bins&nbsp;</td>
<td width="639" align="left"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="tblslocnod" style="width:60px;" onchange="bindamage(this.value);" >
<option value="">--Bin--</option>
<option value="1" >1</option>
<option value="2" >2</option>
</select>&nbsp;</td>
</tr>
</table>
<?php
$whd1_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div  id="dsloc1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd1" style="width:60px;" onchange="wh4(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysql_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bind1">&nbsp;<select class="tbltext" name="txtslbind1" style="width:60px;" onchange="bin4(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbind1">&nbsp;<select class="tbltext" name="txtslsubbd1" style="width:60px;" onchange="subbin4(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="305"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	<tr>
				
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd1" id="ups4" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  onchange="upsf4(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qty4" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf4(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
$whd2_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div id="dsloc2" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30" >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd2" style="width:60px;" onchange="wh5(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysql_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bind2">&nbsp;<select class="tbltext" name="txtslbind2" style="width:60px;" onchange="bin5(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbind2">&nbsp;<select class="tbltext" name="txtslsubbd2" style="width:60px;" onchange="subbin5(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="305"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
						
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" id="ups5" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  onchange="upsf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qty5" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
</td></tr>
<?php
}
?>