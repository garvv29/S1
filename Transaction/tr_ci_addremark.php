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
	
	if(isset($_REQUEST['cuid']))
	{
	 $cuid = $_REQUEST['cuid'];
	}

	
		if(isset($_POST['frm_action'])=='submit')
	{
	
		$cuidate=trim($_POST['ciudate']);
		$actups=trim($_POST['actualupsasperci']);
		$actqty=trim($_POST['actualqtyasperci']);
		$diffups=trim($_POST['differenceups']);
		$diffqty=trim($_POST['differenceqty']);
		$details=trim($_POST['txtremarks']);
		$pid=trim($_POST['trid']);
		$whid=trim($_POST['whid']);
		$binid=trim($_POST['bid']);
		$subbinid=trim($_POST['sbid']);
		$classid=trim($_POST['classid']);
		$itemid=trim($_POST['itemid']);
		
/*		function n_abs($num) 
		{ 
		    return (0 - $num); 
		}
*/
//$diffups=n_abs($diffups); 
//$diffqty=n_abs($diffqty); 

if($diffqty > 0 && $diffups==0) $diffups=1;
if($diffqty==0 && $diffups>0) $diffups=0;
				
				if($actqty > 0 && $actups==0) $actups=1;
				if($actqty==0 && $actups>0) $actups=0;
						
		$tdate=$cuidate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;		
		
		$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$binid."' and stlg_whid='".$whid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
				$row_issue1=mysql_fetch_array($sql_issue1); 
					
				$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 
				$row_issuetbl=mysql_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['stlg_balups'];
				$opqty=$row_issuetbl['stlg_balqty'];
				$balups=$actups;
				$balqty=$actqty;
				
		$sql_sub_sub="insert into tbl_stldg_good (stlg_trtype, stlg_trsubtype, stlg_trid,  stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('CI', 'CI', '$pid', '$tdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$diffups', '$diffqty', '$balups', '$balqty')";
		mysql_query($sql_sub_sub) or die(mysql_error());
				if($balqty == 0)
				{
				$sql_itm="update tbl_subbin set status='Empty' where sid='$subbinid'";
				mysql_query($sql_itm) or die(mysql_error());
				}
		
		$sql_itm=mysql_query("select * from tbl_stores where items_id='".$itemid."' and srl_status='Yes'") or die (mysql_error());
		$t_itm=mysql_num_rows($sql_itm);
		if($t_itm > 0)
		{
			$row_itm=mysql_fetch_array($sql_itm);
			$tqty=0;
			$sql_is=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid!='".$itemid."'") or die(mysql_error());
$cntg=0;
			while($row_is=mysql_fetch_array($sql_is))
 			{ 
			
			$sql_is1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_is['stlg_subbinid']."' and stlg_binid='".$row_is['stlg_binid']."' and stlg_whid='".$row_is['stlg_whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());		
			$row_is1=mysql_fetch_array($sql_is1); 
			
			$sql_issue1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_is1[0]."' and stlg_balqty > 0") or die(mysql_error());
			$tot_issue1=mysql_num_rows($sql_issue1);
			if($tot_issue1 > 0)
			{
				$row_issue1=mysql_fetch_array($sql_issue1); 
				$tqty=$tqty+$row_issue1['stlg_balqty'];
			}
			}	
			$actrol=$row_itm['srl'];
			$srlstatus=$row_itm['srl_status'];
			if(($tqty <= $actrol) && $srlstatus!="OR")
			{
			$sql_sub_sub="update tbl_stldg_good set orstatus='R' where stlg_tritemid='".$itemid."' and stlg_balqty > 0";
			mysql_query($sql_sub_sub) or die(mysql_error());
			}
		}
		
		
		 $sql_in="update tbl_ciupdation  set 		ups_act = '$actups',
													qty_act = '$actqty',
													ciu_udate = '$tdate',
													remarks = '$details',
													status = 1
													where ciu_id= '$cuid'";	
											
											
	/*	$sql_in="insert into tblciupdation (ci_ic, flnid, remarks) values('$id', $flnid', '$details')";	*/
											
		if(mysql_query($sql_in)or die(mysql_error()))
		{?>
			<script language='javascript' >
			window.opener.location.href=window.opener.location.href;	
			window.close();
			</script>
		<?php }
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Transaction - Cycle Inventory Updation</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>
<script language="javascript" type="text/javascript">
function calc()
{
//alert('Cacl');
var recqty=parseFloat(document.frm.qtyrec.value);
var actqty=parseFloat(document.frm.actualqtyasperci.value);

	c = actqty - recqty;
	document.frm.differenceqty.value = c;
if(c >= (recqty*.10))
{
//alert(recqty*.10);
alert('ALERT\n\nDifference between\nQuantity as per Records\nand Actual Quanty as per CI is more than 10%.\n\nPlease re-verify the Actual Quantity as per CI.');
}
else if(c <= -(recqty*.10))
{
//alert(recqty*.10);
alert('ALERT\nDifference between Quantity as per Records & Actual Quanty as per Cycle Inventory is more than 10%.\nPlease check the Quantity as per Cycle Inventory entered correctly.');
}
else
{
//alert('Less');
document.frm.differenceqty.value = c;
}

}

function calc1()
{
//alert('Cacl');
var recqty=parseFloat(document.frm.upsrec.value);
var actqty=parseFloat(document.frm.actualupsasperci.value);

	c = actqty - recqty;
	document.frm.differenceups.value = c;
if(c >= (recqty*.10))
{
//alert(recqty*.10);
alert('ALERT\n\nDifference between\nUPS as per Records\nand Actual UPS as per CI is more than 10%.\n\nPlease re-verify the Actual UPS as per CI.');
}
else if(c <= -(recqty*.10))
{
//alert(recqty*.10);
alert('ALERT\nDifference between UPS as per Records & Actual UPS as per Cycle Inventory is more than 10%.\nPlease check the UPS as per Cycle Inventory entered correctly.');
}
else
{
//alert('Less');
document.frm.differenceups.value = c;
}

}


function same2()
{
if(document.frm.same.checked)
{
document.frm.actualupsasperci.value=document.frm.upsrec.value;
document.frm.actualqtyasperci.value=document.frm.qtyrec.value;
document.getElementById("actups").readOnly = true;
document.getElementById("actups").style.backgroundColor = "#CCCCCC";
document.getElementById("actqty").readOnly = true;
document.getElementById("actqty").style.backgroundColor = "#CCCCCC";
document.frm.differenceqty.value =0;
document.frm.differenceups.value =0;
}
else
{
document.frm.actualupsasperci.value="";
document.frm.actualqtyasperci.value="";
document.getElementById("actups").readOnly = false;
document.getElementById("actups").style.backgroundColor = "#FFFFFF";
document.getElementById("actqty").readOnly = false;
document.getElementById("actqty").style.backgroundColor = "#FFFFFF";
document.frm.differenceqty.value ="";
document.frm.differenceups.value ="";
}
}

function mySubmit()
{
	//return false;		
 if(document.frm.actualupsasperci.value =="")
  {
		alert("Actual UPS As Per Cycle Inventory can not be Blank");
		//frm.actualupsasperci.focus();
		return(false);
  } 
   
   if(document.frm.actualupsasperci.value !="")
	{
   		if(document.frm.actualupsasperci.value.charCodeAt() == 32)
	  	{
		alert("Actual UPS As Per Cycle Inventory cannot start with a Space!");
		//frm.actualupsasperci.focus();
		return false;
	   	} 
	  
	    if (isNaN(document.frm.actualupsasperci.value)) 
	 	{
		alert ("Please enter only numbers in Actual UPS As Per Cycle Inventory");
		document.frm.actualupsasperci.value="";
		document.frm.differenceups.value="";
		//frm.actualupsasperci.focus();
		return false;
	  	} 	       
	 }

  
  if(document.frm.actualqtyasperci.value =="")
  {
		alert("Actual Quantity As Per Cycle Inventory can not be Blank");
		//document.frm.actualqtyasperci.focus();
		return(false);
  } 
   
   if(document.frm.actualqtyasperci.value !="")
	  {
  		 if(document.frm.actualqtyasperci.value.charCodeAt() == 32)
	  	{
		alert("Actual Quantity As Per Cycle Inventory cannot start with a Space!");
		//document.frm.actualqtyasperci.focus();
		return false;
	   	} 
	  
	    if (isNaN(document.frm.actualqtyasperci.value)) 
	 	{
		alert ("Please enter only numbers in Actual Quantity As Per Cycle Inventory");
		document.frm.actualqtyasperci.value="";
		document.frm.differenceqty.value="";
		//frm.actualqtyasperci.focus();
		return false;
	  	} 	       
	}
  
   return true;
}
</script>
</head>
<body topmargin="0" >
<table width="560" height="203" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="top">
  <?php
	$sql="SELECT * FROM tbl_ciupdation where ciu_id =".$cuid;
	$res=mysql_query($sql)or die(mysql_error());
	$row = mysql_fetch_array($res);	
	//$flnid = $row['flnid'];
	$ciid = $row['ci_id'];
	
	$sql_c=mysql_query("select * from tbl_ci where ci_id='".$ciid."'")or die(mysql_error());
  	$row_c=mysql_fetch_array($sql_c);
	 $a="CI";
	 $code1=$a.$row_c['ci_code'];
	
	$tdate=$row_c['ci_tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
		$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row['classification_id']."'") or die(mysql_error());
		$row_class=mysql_fetch_array($sql_class);
		
		$sql_item=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."' and actstatus='Active'") or die(mysql_error());
		$row_item=mysql_fetch_array($sql_item);
		
		$stores_item = $row_item['stores_item'];
		if($row_item['actstatus']=="In-Active")$stores_item=$stores_item."<font color='#FF0000'><b> - In-Active</b></font>";
			
		$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row['whid']."'") or die(mysql_error());
		$row_whouse=mysql_fetch_array($sql_whouse);
		$wareh=$row_whouse['perticulars']."/";

		$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row['binid']."' ") or die(mysql_error());
		$row_binn=mysql_fetch_array($sql_binn);
		$binn=$row_binn['binname']."/";

		$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row['subbinid']."'") or die(mysql_error());
		$row_subbinn=mysql_fetch_array($sql_subbinn);
		$subbinn=$row_subbinn['sname'];
		
		if($slocs!="")
		$slocs=$slocs.$wareh.$binn.$subbinn;
		else
		$slocs=$wareh.$binn.$subbinn;
		
		$upsrec=$row['ups_record'];
		$qtyrec=$row['qty_record'];
	 ?>
   <form name="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="trid" value="<?php echo $ciid;?>" />
	<input type="hidden" name="whid" value="<?php echo $row['whid'];?>" />
	<input type="hidden" name="bid" value="<?php echo $row['binid'];?>" />
	<input type="hidden" name="sbid" value="<?php echo $row['subbinid'];?>" />
	<input type="hidden" name="classid" value="<?php echo $row['classification_id'];?>" />
	<input type="hidden" name="itemid" value="<?php echo $row['items_id'];?>" />
	
	  <table width="670"  border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25"><td colspan="4" align="center" class="tblheading">Update Cycle Inventory</td></tr>
<tr class="Light" height="25">
  <td align="right"  valign="middle" class="tblheading">&nbsp;Transaction&nbsp;<br />ID&nbsp;</td>
  <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>	
  <td  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
  </tr>
<tr class="Light" height="25">
<td width="107" align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_class['classification'];?></td>
<td width="90" align="right"  valign="middle" class="tblheading">&nbsp;Item&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $stores_item;?></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;SLOC&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $slocs;?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;UPS As Per&nbsp;<br />Records&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="upsrec" type="text" size="12" class="tbltext" tabindex="0"  value="<?php echo $upsrec;?>" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Quantity As&nbsp;<br />Per Records&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="qtyrec" type="text" size="12" class="tbltext" tabindex="0"  value="<?php echo $qtyrec;?>" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Same&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" ><input type="checkbox" name="same" value="same1" onClick="same2();" />Same</td>
<td width="90" align="right"  valign="middle" class="tblheading">&nbsp;Date of CI&nbsp;</td>
<td width="252" align="left"  valign="middle" class="tbltext">&nbsp;<input name="ciudate" type="text" size="12" class="tbltext" tabindex="0"  value="<?php echo date("d-m-Y", time());?>" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>

</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;UPS As Per&nbsp;<br />CI&nbsp;</td>
<td width="211" align="left"  valign="middle" class="tbltext">&nbsp;<?php if ($row['status']!=0) { ?><input name="actualupsasperci" id="actups" type="text" size="12" class="tbltext" tabindex="0"  value="<?php echo $row['ups_act'];?>" onChange="calc1();"  /><?php } else { ?><input name="actualupsasperci" id="actups" type="text" size="12" class="tbltext" tabindex="0"  value="" onChange="calc1();"  /><?php } ?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Quantity As&nbsp;<br />Per CI&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php if ($row['status']!=0) { ?><input name="actualqtyasperci" id="actqty" type="text" size="12" class="tbltext" tabindex="0"  value="<?php echo $row['qty_act'];?>" onChange="calc();"  /><?php } else { ?><input name="actualqtyasperci" id="actqty" type="text" size="12" class="tbltext" tabindex="0"  value="" onChange="calc();"  /><?php } ?> </td>
</tr>
<tr class="Light" height="25">
<td width="107" align="right"  valign="middle" class="tblheading">&nbsp;Difference&nbsp;<br />UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if ($row['status']!=0) { ?><input name="differenceups" type="text" size="12" class="tbltext" tabindex="0"  value="<?php echo $upsrec-$row['ups_act'];?>" readonly="true" style="background-color:#CCCCCC"  /><?php } else { ?><input name="differenceups" type="text" size="12" class="tbltext" tabindex="0"  value="" readonly="true" style="background-color:#CCCCCC"  /><?php } ?></td>
<td width="107" align="right"  valign="middle" class="tblheading">&nbsp;Difference&nbsp;<br />Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php if ($row['status']!=0) { ?><input name="differenceqty" type="text" size="12" class="tbltext" tabindex="0"  value="<?php echo $upsrec-$row['qty_act'];?>" readonly="true" style="background-color:#CCCCCC"  /><?php } else { ?><input name="differenceqty" type="text" size="12" class="tbltext" tabindex="0"  value="" readonly="true" style="background-color:#CCCCCC"  /><?php } ?></td>
</tr>


<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3"><input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90"></td>
</tr>
</table>
<table cellpadding="5" align="center" cellspacing="5" border="0" width="666">
<tr >
<td width="646" colspan="3" align="center"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;
  <input type="image" src="../images/submit.gif" alt="Submit Value" border="0" style="display:inline;cursor:hand;" onClick="return mySubmit();"/></td>
</tr>
</table>


</form>
</td></tr>
</table>

</body>
</html>
