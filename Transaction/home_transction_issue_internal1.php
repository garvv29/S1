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
	
	$sql_yr=mysql_query("select * from tblyears where years_flg =1 and years_status='a'")or die("Error:".mysql_error());
	$tot_yr=mysql_num_rows($sql_yr);
	$row_yr=mysql_fetch_array($sql_yr);
	
		$y1=$row_yr['year1'];
	$y2=$row_yr['year2'];
	
		$cdate=date("Y-m-d");
		$sdate=$y1."-04-01";
		$edate=$y2."-03-31"; 
		$s=strtotime($sdate); 
		$e=strtotime($edate);
		$c=strtotime($cdate);
		
			if($c >= $s && $c <= $e)
			{ $flg=0;}
			else
			{ $flg=1;}
		
		
		$sql_good=mysql_query("select max(stlg_id) from tbl_stldg_good") or die(mysql_error());
		$row_good=mysql_fetch_array($sql_good);
				
		$sql_good1=mysql_query("select stlg_trdate from tbl_stldg_good where stlg_id='".$row_good[0]."'") or die(mysql_error());
		$row_good1=mysql_fetch_array($sql_good1);
		$rg1=mysql_num_rows($sql_good1);
		$last_tdateg=$row_good1['stlg_trdate'];
		$lstdtg=strtotime($last_tdateg);
		
		$sql_damage=mysql_query("select max(stld_id) from tbl_stldg_damage") or die(mysql_error());
		$row_damage=mysql_fetch_array($sql_damage);
				
		$sql_damage1=mysql_query("select stld_trdate from tbl_stldg_damage where stld_id='".$row_damage[0]."'") or die(mysql_error());
		$row_damage1=mysql_fetch_array($sql_damage1);
		$rd1=mysql_num_rows($sql_damage1);
		$last_tdated=$row_damage1['stld_trdate'];
		$lstdtd=strtotime($last_tdated);
		
		if($c >= $lstdtg || $c >= $lstdtd)
			{ $flg1=0;}
			else
			{ $flg1=1;}

		$sql_ci=mysql_query("select * from tbl_ci where ci_upflg=0") or die(mysql_error());
		$row_ci=mysql_fetch_array($sql_ci);
		$t_ci=mysql_num_rows($sql_ci);
		if($t_ci > 0)
			{ $flg2=1;}
			else
			{ $flg2=0;}
		
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$sdate=trim($_POST['sdate']);
		$edate=trim($_POST['edate']);
		
		
		
		if($sdate!="" && $edate!="")
		{
		echo "<script>window.location='home_transction_issue_internal1.php?sdate=$sdate&edate=$edate'</script>";
		}
		else
		 {?>
		 <script>
		  alert("Please Select Period for search");
		  </script>
		 <?php }
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores - Tranasction -Home Physical Indent</title>
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

</script>
<script language="JavaScript">

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
function openslocpopprint(itm)
{
winHandle=window.open('pindent_note_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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
				<?php
			  if($role == "admin")
			  {
			  ?>
				<li><a href="../reports/masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
				<?php
				}
				?>
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25" class="Mainheading">&nbsp;Issue Types - Internal Issue - Physical Indent</td>
	    </tr></table></td>
	  <td width="90" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="85" style="border-collapse:collapse;">

<!--<tr height="15" class="tbltitle" >

<td align="center" width="90" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_issu_physical_indent.php" style="text-decoration:none; color:#FFFFFF">Add</a></td>

</tr>
-->
<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:hand;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_issu_physical_indent.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onClick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>
</table></td>
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"   onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>


<!--- Table Place Holder --->
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20"><td colspan="10" align="center" class="subheading">Search Transactions</td></tr>
  <tr class="Light" height="25">
  <td width="76" class="tblheading" align="right">&nbsp;Start Date&nbsp;</td>
  <td width="152" align="left">&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDept.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
  
  <td width="78" class="tblheading" align="right">&nbsp;End Date&nbsp;</td>
  <td width="147" align="left">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDept.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>

  <td width="135" class="tblheading" align="center"><input type="image" src="../images/search.gif" border="0"  /></td>
  </tr>
  </table><br />

<?php
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); */
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;	
	
	
	$pdate=$edate;
	$pday=substr($pdate,0,2);
	$pmonth=substr($pdate,3,2);
	$pyear=substr($pdate,6,4);
	$pdate=$pyear."-".$pmonth."-".$pday;
	
	$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 10; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysql_query("select * from tblissue where issue_date between '$tdate' and '$pdate' and issue_type='pindent' and issuetrflag=1 order by yearcode desc, iss_code desc LIMIT $start, $limit") or die(mysql_error());
 $tot_arr_home=mysql_num_rows($sql_arr_home);

//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query = "select * from tblissue where issue_date between '$tdate' and '$pdate' and issue_type='pindent' and issuetrflag=1 order by yearcode desc, iss_code desc";
$total_pages = mysql_num_rows(mysql_query($query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:730px\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">« previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">« previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> next »</a> ";
		else
			$pagination.= " <span class=\"disabled\"> next »</span> ";
		$pagination.= "</div>\n";		
	}
	 $srno=($page-1)*$limit+1;
/*$sql_arr_home=mysql_query("select * from tblissue where issue_date between '$tdate' and '$pdate' and issue_type='pindent' and issuetrflag=1 order by yearcode desc, iss_code desc LIMIT $from, $max_results") or die(mysql_error());
$tot_arr_home=mysql_num_rows($sql_arr_home);

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tblissue where issue_type='pindent' and issuetrflag=1"),0); */
    if($tot_arr_home >0) { 
?>

<table align="center" border="0" width="700" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Internal Issue-Physical Indent </td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#4ea1e1" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="3%"align="center" valign="middle" class="tblheading">#</td>
			 <td width="12%" align="center" valign="middle" class="tblheading">Transaction Id</td>
			 <td width="13%" align="center" valign="middle" class="tblheading">P-Indents Issue Date</td>
              <td width="17%" align="center" valign="middle" class="tblheading">Indent Number</td>
			  <td width="22%" align="center" valign="middle" class="tblheading">P-Indent Raiser</td>
              <td align="center" valign="middle" class="tblheading">Output</td>
              </tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysql_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['issue_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$irole=$row_arr_home['issue_role'];
	

if($srno%2!=0)
{
?>	

		  
<tr class="Light">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><a href="add_issue_pindents_view.php?p_id=<?php echo $row_arr_home['issue_id'];?>"><?php echo "IP".$row_arr_home['iss_code']."/".$row_arr_home['yearcode']."/".$irole;?></a></td>
		 <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['dcrefno'];?></td>
         <td width="22%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['strefno']?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpopprint('<?php echo $row_arr_home['issue_id'];?>');">PIN</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Light">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="12%" align="center" valign="middle" class="tblheading"><a href="add_issue_pindents_view.php?p_id=<?php echo $row_arr_home['issue_id'];?>"><?php echo "IP".$row_arr_home['iss_code']."/".$row_arr_home['yearcode']."/".$irole;?></a></td>
		 <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['dcrefno'];?></td>
         <td width="22%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['strefno']?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpopprint('<?php echo $row_arr_home['issue_id'];?>');">PIN</a></td>
</tr>

<?php
}
$srno=$srno+1;
}
}
}
?>
          </table>

<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='600' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
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
		echo "</td></tr></table>";*/ 
//}
?>
<?php echo $pagination?>
<table align="center" width="700" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_transction_issue_internal.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a></td>
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
