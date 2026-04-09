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
	require_once("include/config.php");
	require_once("include/connection.php");
	
	if(isset($_POST['frm_action'])=='submit')
	{
			$printopt=$_POST['fet1'];
		
if($printopt == "1" )
{
	echo "<script>window.location='reports1/stockonhandreport.php'</script>";	
}
if($printopt<="2"){
echo "<script>window.location='reports1/partywiseperiodreport.php'</script>";	
}
if($printopt<="3"){
echo "<script>window.location='reports1/storesitamledger.php'</script>";	
}
if($printopt<="4")
{
echo "<script>window.location='reports1/stocktransferreport.php'</script>";	
}
if($printopt<="5"){
echo "<script>window.location='reports1/captiveconsumptionreport.php'</script>";
}
if($printopt<="6"){
echo "<script>window.location='reports1/discardreport.php'</script>";
}
if($printopt<="7"){
echo "<script>window.location='reports1/reorderlevelreport.php'</script>";
}
if($printopt<="8"){
echo "<script>window.location='reports1/slocreport.php'</script>";
}
if($printopt<="9"){
echo "<script>window.location='reports1/masterreports.php'</script>";
}
}
?>

	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Wel come Viewer</title>
<link href="include/main.css" rel="stylesheet" type="text/css" />
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

function test1(v)
{
	document.frmaddDepartment.fet1.value="";
	document.frmaddDepartment.fet1.value=v;
}
function mySubmit()
{
	if(document.frmaddDepartment.fet1.value=="")
	{
	alert("Please Select Report type");
	return false;
	}
	return true;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include 'include/navbar_loader.php'; ?>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp; Wel-Come Viewer </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
              <td align="center" colspan="4" >
			    <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
 <input name="frm_action" value="submit" type="hidden"> 
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="2" align="center" class="tblheading">&nbsp;Select - Reports</td>
</tr>

<?php 
	$sql_sel="select * from tbl_report where id=1 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="left" class="tbltext">&nbsp;<input type="radio" name="fet" value="1" onClick="test1(this.value);" /></td>
    <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report </td>
</tr>
<?php
}
}
?>
<?php 
	$sql_sel="select * from tbl_report where id=2 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="2" onClick="test1(this.value);" /></td>
 <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</td >
 </tr>
 <?php
}
}
?>
 <?php 
	$sql_sel="select * from tbl_report where id=3 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="3" onClick="test1(this.value);" /></td>
 <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</td>  
</tr>
<?php
}
}
?>
<?php 
	$sql_sel="select * from tbl_report where id=4 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="4" onClick="test1(this.value);" /></td>
    <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Stock&nbsp;Transfer&nbsp;Report</td>  
</tr>
<?php
}
}
?>
<?php 
	$sql_sel="select * from tbl_report where id=5 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="5" onClick="test1(this.value);" /></td>
 <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Captive&nbsp;Consumption&nbsp;Report</td>  
</tr>
<?php
}
}
?>
<?php 
	$sql_sel="select * from tbl_report where id=6 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="6" onClick="test1(this.value);" /></td>
  <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Discard&nbsp;Report</td> 
</tr>
<?php
}
}
?>
<?php 
	$sql_sel="select * from tbl_report where id=7 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="7" onClick="test1(this.value);" /></td>
    <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Reorder&nbsp;Level&nbsp;Report</td>  
</tr>
<?php
}
}
?>
<?php 
	$sql_sel="select * from tbl_report where id=8 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="8" onClick="test1(this.value);" /></td>
    <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;SLOC&nbsp;Status&nbsp;Report</td>
</tr>
<?php
}
}
?>
<?php 
	$sql_sel="select * from tbl_report where id=9 order by id";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$total=mysql_num_rows($res);
	while($row=mysql_fetch_array($res))
	{	$p1_array=explode(",",   $row['good']);
		$i=0;
		$p1=array();
		foreach($p1_array as $val1)
		{
			if($val1<>"")
		{
			if($val1 == $lgnid) { $i++;}
		}
		}
		if($i!=0) 
		{ 
?>
<tr class="Light" height="25">
<td width="284" align="right"  valign="middle" class="tbltext">&nbsp;<input type="radio" name="fet" value="9" onClick="test1(this.value);" /></td>
    <td width="284" colspan="-1" align="left"  valign="middle" class="tblheading">&nbsp;Master &nbsp;Report</td>  
</tr>
<?php
}
}
?>
</table>

<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><input name="Submit" type="image" src="images/next.gif" alt="next" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;">&nbsp;<input type="hidden" name="fet1" value="" /></td>	
</tr>
</table>

</form>
</td><td width="30"></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>

</table>
		  
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
