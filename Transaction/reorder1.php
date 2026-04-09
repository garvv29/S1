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
	if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}
	if(isset($_GET['items_id']))
	{
	$id = $_GET['items_id'];
	}
	
	if(isset($_GET['frm_action'])=='submit')
	{
		$code=trim($_POST['txtcode']);
		$date=trim($_POST['date']);
		$level=$_POST['txtvname'];
		$sdate1=trim($_POST['sdate']);
		/*
		$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
		$num=mysql_num_rows($sql22);
		
		$sql2=mysql_query("select * from tblemp where emp_mobile='".$mobile."'") or die(mysql_error());
		$num2=mysql_num_rows($sql2);
		
		$sql_mail=mysql_query("select * from tblemp where emp_email='".$email."'") or die(mysql_error());
		$num_mail=mysql_num_rows($sql_mail);
		
		if($altemail !="")
		{
		$sql_altmail=mysql_query("select * from tblemp where emp_altemail='".$altemail."'") or die(mysql_error());
		$num_altmail=mysql_num_rows($sql_altmail);
		}
		else
		{
		$num_altmail=0;
		}
		
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee ID.\nEmployee with this Employee ID already Present.");
			  </script>
			 <?php
		}
		else if($num2 > 0)
		{	?>
			 <script>
			  alert("Duplicate Mobile Number.\nEmployee with this Mobile Number already Present.");
			  </script>
			 <?php
		}
		else if($num_mail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee VNR Email-ID.\nEmployee with this Employee VNR Email-ID already Present.");
			  </script>
			 <?php
		}
		else if($num_altmail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee Alternate Email-ID.\nEmployee with this Employee Alternate Email-ID already Present.");
			  </script>
			 <?php
		}
		else*/
		{
			 $sql_in="insert into tbl_transction(code, date, level) values ('$id','$date','$code')";
										
			//if(mysql_query($sql_in)or die(mysql_error()))
			//{ 
				//$id=mysql_insert_id();
				echo "<script>window.location='reorder1.php'</script>";	
			}
		
		}
	//}

/*$a="c";
	$sql_code="SELECT MAX(code) FROM tbl_materialreturn ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				
		}
		else
		{
			$code=10001;
		}
*/
?>
		  <!-- actual page start--->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores Transction - Home Vendor</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>

<script type="text/javascript">

	 function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth,cDate);	
	return (dtObject);
} 	
function mySubmit()
{	
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
return true;
}
</script>
		 		  		  
		   <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Order Placement at Reorder Level</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="717" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr c class="tblsubtitle" height="25">
    <td width="22" align="center" class="tblheading" valign="middle">#</td>
    <td width="162" align="left" class="tblheading" valign="middle">&nbsp;Classification</td>
    <td width="126" align="center" class="tblheading" valign="middle">Items</td>
    <td width="42" align="center" class="tblheading" valign="middle">UOM</td>
    <td width="52" align="center" class="tblheading" valign="middle">Reorder Level </td>
    <td width="32" align="center" class="tblheading" valign="middle">UPS</td>
	  <td width="123" align="center" class="tblheading" valign="middle">Quantity</td>
      <td width="140" align="center" class="tblheading" valign="middle">Date</td>
    </tr>
<?php
$srno=1;
/*$sql_cls=mysql_query("select * from tbl_classification") or die(mysql_error());
while($row_cls=mysql_fetch_array($sql_cls))
{*/


$sql_itm=mysql_query("select * from tbl_stores where classification_id='".$row_cls['classification_id']."'") or die (mysql_error());
while($row_itm=mysql_fetch_array($sql_itm))
{
$totups=0; $totqty=0;
/*$sql_issue=mysql_query("select * stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_cls['classification_id']."' and stlg_tritemid='".$row_itm['items_id']."'") or die(mysql_error());
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1);*/

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
	$totups=$totups+$row_issuetbl['stlg_balups'];
	$totqty=$totqty+$row_issuetbl['stlg_balqty'];
 }
 }
 // echo $total_tbl=mysql_num_rows($sql_itm);
?>  
<?php	
if($totqty<=$row_itm['srl'])
 {
 if ($srno%2 != 0)
	{	
?>
  <tr class="Light" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row_cls['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['stores_item'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['uom'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['srl'];?></td>
	<td valign="middle" class="tbltext" align="center"><?php echo $totups;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $totqty;?></td>
 <td width="147" align="left"  valign="middle" class="tblheading" colspan="3">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDept.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
	 </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row_cls['classification'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['stores_item'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['uom'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_itm['srl'];?></td>
	<td valign="middle" class="tbltext" align="center"><?php echo $totups;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $totqty;?></td>
  <td width="147" align="left"  valign="middle" class="tblheading" colspan="3">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDept.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
	 </tr>
  <?php	}
	 $srno=$srno+1;
	}
//}
//}
//}
?>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="750">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='750' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>"; 
//}*/

?>
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
<!-- actual page end--->	
		  
		  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="images/istratlogo.gif"  align="left"/><img src="images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
