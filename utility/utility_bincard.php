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
	/*if(isset($_REQUEST['char']))
	{
	 $char = $_REQUEST['char'];	 
	}
	else
	{
	$char = "ALL";
	}*/
	
	if(isset($_POST['frm_action'])=='Submit')
	{
		
		 $whid=trim($_POST['txtslwhg1']);
		 $sid=trim($_POST['txtslsubbg1']);
		 $bid=trim($_POST['txtslbing1']);
		
			echo "<script>window.location='bincard.php?txtslwhg1=$whid&txtslsubbg1=$sid&txtslbing1=$bid'</script>";	
		}
		
	
//}
//}
//}

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Utility - Sub-Bin Card</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk_bin.js"></script>

 <SCRIPT language=JavaScript>

function openprint()
{
//var dateto=document.frmaddDept.dateto.value;
//var datefrom=document.frmaddDept.datefrom.value;
winHandle=window.open('report_operator1.php','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function wh1(wh1val)
{ //alert(wh1val);
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	
}

function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	}

function subbin1(subbin1val)
{	
	//var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg1.value!="")
		var upsv1=document.frmaddDepartment.txtslupsg1.value;
		else
		var upsv1="";
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1);
	}
	
}

/*function bingood(gval)
{	
		//alert(gval);
		if(document.frmaddDepartment.txtqtyg.value > 0)
	{
		if(gval==1 || gval=="1")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value=document.frmaddDepartment.txtupsg.value;
			document.getElementById('qty1').value=document.frmaddDepartment.txtqtyg.value;
			document.getElementById('ups1').readOnly=true;
			document.getElementById('ups1').style.backgroundColor="#CCCCCC";
			document.getElementById('qty1').readOnly=true;
			document.getElementById('qty1').style.backgroundColor="#CCCCCC";
		}
		else if(gval==2 || gval=="2")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value="";
			document.getElementById('qty1').value="";
			document.getElementById('ups1').readOnly=false;
			document.getElementById('ups1').style.backgroundColor="#FFFFFF";
			document.getElementById('qty1').readOnly=false;
			document.getElementById('qty1').style.backgroundColor="#FFFFFF";
			document.getElementById('ups2').value="";
			document.getElementById('qty2').value="";
			document.getElementById('ups2').readOnly=true;
			document.getElementById('ups2').style.backgroundColor="#CCCCCC";
			document.getElementById('qty2').readOnly=true;
			document.getElementById('qty2').style.backgroundColor="#CCCCCC";
		}
		else if(gval==3 || gval=="3")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="block";
			document.getElementById('ups1').value="";
			document.getElementById('qty1').value="";
			document.getElementById('ups1').readOnly=false;
			document.getElementById('ups1').style.backgroundColor="#FFFFFF";
			document.getElementById('qty1').readOnly=false;
			document.getElementById('qty1').style.backgroundColor="#FFFFFF";
			document.getElementById('ups2').value="";
			document.getElementById('qty2').value="";
			document.getElementById('ups2').readOnly=false;
			document.getElementById('ups2').style.backgroundColor="#FFFFFF";
			document.getElementById('qty2').readOnly=false;
			document.getElementById('qty2').style.backgroundColor="#FFFFFF";
			document.getElementById('ups3').value="";
			document.getElementById('qty3').value="";
			document.getElementById('ups3').readOnly=true;
			document.getElementById('ups3').style.backgroundColor="#CCCCCC";
			document.getElementById('qty3').readOnly=true;
			document.getElementById('qty3').style.backgroundColor="#CCCCCC";
		}
		else
		{
			document.getElementById('gsloc1').style.display="none";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value="";
			document.getElementById('qty1').value="";
			document.getElementById('ups1').readOnly=false;
			document.getElementById('ups1').style.backgroundColor="#FFFFFF";
			document.getElementById('qty1').readOnly=false;
			document.getElementById('qty1').style.backgroundColor="#FFFFFF";
			document.getElementById('ups2').value="";
			document.getElementById('qty2').value="";
			document.getElementById('ups2').readOnly=false;
			document.getElementById('ups2').style.backgroundColor="#FFFFFF";
			document.getElementById('qty2').readOnly=false;
			document.getElementById('qty2').style.backgroundColor="#FFFFFF";
			document.getElementById('ups3').value="";
			document.getElementById('qty3').value="";
			document.getElementById('ups3').readOnly=false;
			document.getElementById('ups3').style.backgroundColor="#FFFFFF";
			document.getElementById('qty3').readOnly=false;
			document.getElementById('qty3').style.backgroundColor="#FFFFFF";
		}
	}
	else
	{
	alert("Please enter Actual Quantity Receive Good first");
	document.frmaddDepartment.txtqtyg.focus();
	}
}
*/
function mySubmit()
{ 
	if(document.frmaddDepartment.txtslwhg1.value=="")
	{
	alert("Please Select Warehouse ");
	document.frmaddDepartment.txtslwhg1.focus();
	return false;
	}
	if(document.frmaddDepartment.txtslbing1.value=="")
	{
	alert("Please Select Bin ");
	document.frmaddDepartment.txtslbing1.focus();
	return false;
	}
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
	alert("Please Select  SubBin");
	document.frmaddDepartment.txtslsubbg1.focus();
	return false;
	}
return true;
}
</script>


<body>

<!-- actual page start--->	
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25">&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">&nbsp;</td>
	  </tr>
	  </table></td></tr>
 <?php
	/*if( 'ALL'!= $char)
	{
		$sql = mysql_query("SELECT * FROM tbl_subbin where sname like '".$char."%' order by sname");
		$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_bin where binname like '".$char."%'"),0);  
	}
	else{
	$sql = mysql_query("SELECT * FROM tbl_subbin where sname like '".$char."%' order by sname");
		$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_subbin where sname like '".$char."%'"),0);  
	}*/
	 ?> 
	  
	    <td align="center" colspan="4" >
		<br/>
		<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="489" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SUB-BIN CARD</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
 <?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse order by perticulars") or die(mysql_error());
?>

           <td width="223"  align="right"  valign="middle" class="tblheading">&nbsp;Select Warehouse&nbsp; </td>                                   
           <td width="295" colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
<option value="" selected>-----WH---</option>
	<?php while($noticia_whg1 = mysql_fetch_array($whg1_query)) { ?>
		<option value="<?php echo $noticia_whg1['whid'];?>" />   
		<?php echo $noticia_whg1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
		<tr class="Dark" height="25">
           <td width="223" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
          <td width="295" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
<option value="" selected>------Bin-------</option></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>  </tr>


       
		 <?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>
		 <tr class="Light" height="25">
           <td width="223" height="24"  align="right"  valign="middle" class="tblheading"> Select Sub Bin &nbsp;</td>
           <td width="295" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
<option value="" selected>-Sub-Bin-</option></select>&nbsp;&nbsp;</td></tr>
	 

</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  