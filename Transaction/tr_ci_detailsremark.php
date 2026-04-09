<?php
	session_start();
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['cuid']))
	{
	 $cuid = $_REQUEST['cuid'];
	}

	
		if(isset($_POST['frm_action'])=='submit')
	{
		
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seedtrac-FSW - Transaction - Cycle Inventory - Updation</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function mySubmit()
{
  if(frmeditcropdesc.remarks.value =="")
	  {
		alert("Remarks can not be Blank");
		frmeditcropdesc.remarks.focus();
		return(false);
   } 	   
  
   return true;
}
</script>
</head>
<body topmargin="0" >
<table width="460" height="150" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="top">
  
   <form name="frmeditcropdesc" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	<input name="frm_action" value="submit" type="hidden"> 
	   <?php
	$sql="SELECT * FROM tbl_ciupdation where ciu_id =".$cuid;
	$res=mysql_query($sql)or die(mysql_error());
	$row = mysql_fetch_array($res);	
	
	/*$ciid = $row['ci_id'];
	
	$sql_c=mysql_query("select * from tbl_ci where ci_id='".$ciid."'")or die(mysql_error());
  	$row_c=mysql_fetch_array($sql_c);
	 $a="CI";
	 $code1=$a.$row_c['ci_code'];
	
	$tdate=$row_c['ci_tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$sdate=$row['ciu_udate'];
	$syear=substr($sdate,0,4);
	$smonth=substr($sdate,5,2);
	$sday=substr($sdate,8,2);
	$sdate=$sday."-".$smonth."-".$syear;*/
	 ?>
      <table  border="1" width="100%" cellspacing="0" cellpadding="0" align="center" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25"><td colspan="2" align="center" class="tblheading">Remarks</td></tr>
<tr class="Dark" height="25">
<td width="13%" align="left"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="87%" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="460">
<tr >
<td align="center" colspan="3"><img src="../images/close_1.gif" border="0" onClick="window.close()" /></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
