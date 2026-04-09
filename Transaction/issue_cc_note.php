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
	//$logid="opr1";
	//$lgnid="OP1";
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$id=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		//$code=$_POST['txtvname'];
		$classification=trim($_POST['txtcla']);
		$items=trim($_POST['txtitem']);
		$uom=trim($_POST['txtuom']);
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;		
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
		else
		{
			
			 $sql_in="insert into tbl_dtog(code, tdate , classification_id, items_id,uom) values ('$id', '$tdate' , '$classification' , '$items', '$uom')";
						//exit;				
			if(mysql_query($sql_in)or die(mysql_error()))
			{ 
				//$id=mysql_insert_id();
				echo "<script>window.location='gooddamage_stock_sloc.php'</script>";	
			}
		*/
		}
	//}

//$a="c";
	/*$sql_code="SELECT MAX(code) FROM tbl_dtog ORDER BY code DESC";
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
		}*/
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transction-Captive Consumption Note</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
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

function openslocpopprint()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('cc_issue_note_print.php?p_id='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}

</script>



<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
            <ul  id="nav">
             <li><a href="#">Transactions </a>
              <ul>
                <li><a href="arrival_home.php" >&nbsp;Arrival</a></li>
                <li><a href="issue_home.php" >&nbsp;Issue</a></li>
                <li><a href="c_c_home.php" >&nbsp;Captive&nbsp;Consumption</a></li>
				<li><a href="add_discard.php" >&nbsp;Material&nbsp;Discard</a></li>
				<li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
                <li><a href="add_arrival.php" >&nbsp;SLOC&nbsp;Updation</a></li>
				<li><a href="reorder.php" >&nbsp;Order&nbsp;Placement&nbsp;at&nbsp;Reorder</a></li>
             </ul>
            </li>
             <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				 <li><a href="../reports/slocreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
				<li><a href="../masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
              </ul>
            </li><li>
            <a href="#">Utility </a>
             <ul>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_bincard.php','WelCome','top=10,left=50,width=950,height=800,scrollbars=yes')" >&nbsp;Sub-Bin&nbsp;Card</a></li>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li> <?php if($role == "admin")
			  {
			  ?>
			  <li><a href=" Javascript:void(0)" onClick="window.open('../utility/backup.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Backup</a></li>
			  <?php }?>
           </ul>   </li>
            </ul>
            </div>
            </div>
            <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top"> <li> <a href="operprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li> <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">Captive Consumption Note</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
<?php 

$sql_param=mysql_query("select * from tbl_parameters") or die(mysql_error());
$row_param=mysql_fetch_array($sql_param);
?>	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit()"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="0" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td align="right" width="50%" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>"  >&nbsp;</td>
<td align="left" valign="middle" class="tblheading">&nbsp;<font size="+1"><?php echo $row_param['company_name'];?></font></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">&nbsp;<?php echo $row_param['address'];?></td>
</tr>
<tr class="Light">
<td align="center"  valign="middle" class="smalltblheading" colspan="2">&nbsp;TIN:&nbsp;<?php echo $row_param['tin'];?></td>
</tr>
</table><br />
 <?php
	$sql1=mysql_query("select * from tbl_captive where tid=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=$pid; $erid=0;
	
	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	
	
	$code1="CC".$row['cc_code'];
	 ?> 
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Captive Consumption Note</td>
</tr>

<tr class="Dark" height="20">
<td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="204"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "CC".$row['code'];?></td>

<td width="168" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="194" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="20">
<?php
	if($row['party_id'] != "")
	{
	$quer3=mysql_query("SELECT business_name, address FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysql_fetch_array($quer3);
	$business_name=$row3['business_name'];
	$address=$row3['address'];
	}
	else
	{
	$business_name=$row['party_name'];
	$address=$row['address'];
	}
?>

<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $business_name;?></td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $address;?></td>
</tr>
<tr class="Light" height="20">
<td width="174"  align="right"  valign="middle" class="tblheading">Contact Number&nbsp;</td>
<td align="left"  valign="middle"  class="tbltext" colspan="3">&nbsp;<?php echo $row['contactno'];?></td>
</tr>

<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit Applicable&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php if($row['tmode'] != "") { echo "Applicable"; } else { echo "Not Applicable"; }?></td>
</tr>
<?php
if($row['tmode'] != "") 
{
?>
<tr class="Dark" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row['tmode'];?></td>
</tr>
<?php
if($row['tmode'] == "Transport")
{
?>
<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['tname'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row['lrno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['vno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['pmode'];?></td>
</tr>
<?php
}
else if($row['tmode'] == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['cname'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['docketno'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['pname'];?></td>
</tr>
<?php
}
}
?>
</table>
<?php
$srno=1;
$sql_eindent_sub=mysql_query("select * from tbl_captivesub where id_in=$pid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tbl_captive_sloc where issue_trid='".$trid."' and classification_id='".$row_eindent_sub['classification_id']."' and item_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tblissue);
$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty="";
while($row_tblissue=mysql_fetch_array($sql_tblissue))
{

 $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tblissue['subbin']."' and binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_tblissue['ups_issue'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_tblissue['qty_issue'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$balups+$row_tblissue['ups_balance'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";
$balqty=$balqty+$row_tblissue['qty_balance'];
if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tblissue['issue_rowid']."'") or die(mysql_error());
$row_stldg1=mysql_fetch_array($sql_stldg1); 

$opups=$opups+$row_stldg1['stlg_balups'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$opqty+$row_stldg1['stlg_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['isue_id'];
}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $$opqty1=""; $erid=0;
}
if($srno%2!=0)
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse"> <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification </td>
<td width="114" align="center" class="tblheading" valign="middle">Item </td>
<td width="147" align="center" class="tblheading" valign="middle">Uom </td>
<td width="147" align="center" class="tblheading" valign="middle">G/D </td>
<td width="114" align="center" class="tblheading" valign="middle">UPS</td>
<td width="147" align="center" class="tblheading" valign="middle">Quantity</td>
</tr>

<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['type'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['ups'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['qty'];?></td>
<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
</tr>
<?php
	}
	else
	{ 
	
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['type'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['ups'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_eindent_sub['qty'];?></td>
<input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
</tr>
<?php	}
	 $srno=$srno+1;
	
}
?>
</table>
<input type="hidden" name="trid" value="<?php echo $pid?>" />

		  <br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="64" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="680" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks'];?></td>
</tr>
</table>

<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light">
<td align="left" valign="middle" class="tblheading" colspan="6">&nbsp;<font color="#FF0000">Note: </font></td>
</tr>
</table><br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="84" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="152"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="69" align="right" valign="middle" class="smalltblheading">&nbsp;Check By &nbsp;</td>
<td width="186" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="87" align="right" valign="middle" class="smalltblheading">&nbsp;Plant&nbsp; Manager</td>
<td width="172" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
		   </table><br />

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="select_cc_op.php?p_id=<?php echo $pid;?>" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:hand;" /></a></td>
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
		  </td>
        </tr>
		
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
