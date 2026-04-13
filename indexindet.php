<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='login.php' ";
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
	
	//$logid=42;
	//$lgnid="OP1";
	$flg=0;$flg1=0;$flg2=0;$flg3=0;

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
		

// Delete incomplete indents - REMOVED to prevent data loss
// $s_sub="delete from tbl_ieindent where tflg=0 and id='$loginid'";
// mysql_query($s_sub) or die(mysql_error());	
	
if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		$sdate1=trim($_POST['sdate']);
		$edate1=trim($_POST['edate']);
		//$qcs=trim($_POST['qcsstatus']);
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_pending_indents1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		else
		{
		echo "<script>window.location='indexindet1.php'</script>";
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Transction -Home Pending Indrnts</title>
<link href="include/main.css" rel="stylesheet" type="text/css" />
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script src="Transaction/captive.js"></script>
</head>

<script type="text/javascript">
/*
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
*/
</script>
<script type="text/javascript">
function butnchk()
{
alert("You can Raise upto 3 Indents ");
}
function openslocpopprint(tid)
{
winHandle=window.open('Transaction/arr_vendor_print.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

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

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
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
          <td width="100%" valign="top"  align="center" height="500" class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="810" class="Mainheading" height="25">
	  <table width="810" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="840" height="27">&nbsp;Raise- Indents </td>
	    </tr></table></td>
	  <td width="100" height="30" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<?php

	$sql_sel="select * from tbl_ieindent where id='$loginid' and flg=0 order by code";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total=mysql_num_rows($res);
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_ieindent where id='$loginid' and flg=0"),0); 
	if($total <20)
	{
?>
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:hand;"><?php if($flg==0 && $flg1==0 && $flg2==0 && $flg3==0) { ?><a href="Transaction/add_indents.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.\n4. You can Raise upto 20 Indents'.);" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
<?php
}
?>
</tr> 
</table></td>
	  
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_ieindent where id=$logid")or die(mysql_error());
   $noticia=mysql_fetch_array($sql1);*/
	
	 ?> 
	  <?php 
/*$result=mysql_query("SELECT * FROM tbl_roles where id='".$id."'") or die(mysql_error()); 
$row = mysql_fetch_array($result);
*/
?>
	    <td align="center" colspan="4" >
		<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td><br/>
<?php
if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
$sql_arr_home=mysql_query("select * from tbl_ieindent where  flg=0 and id='".$loginid."' order by code desc LIMIT $from, $max_results") or die(mysql_error());
$tot_arr_home=mysql_num_rows($sql_arr_home);

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_ieindent where  flg=0 and id='".$loginid."'"),0); 

    if($tot_arr_home >0) { 
?>

<table align="center" border="0" cellspacing="0" cellpadding="0" width="616" style="border-collapse:collapse">
  <tr height="25" >
    <td width="616" colspan="8" align="center" class="subheading" style="color:#303918; ">Pending Indents  (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table width="616" align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="26" align="center" class="tblheading" valign="middle">#</td>
<td width="114" align="center" valign="middle" class="tblheading">Transaction Id</td>
<td width="93" align="center" class="tblheading" valign="middle">Date </td>
<td width="112" align="center" class="tblheading" valign="middle">Indent No </td>
<td width="119" align="center" class="tblheading" valign="middle">Stage </td>
<td width="138" align="center" class="tblheading" valign="middle">Raised By </td>
</tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysql_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['tdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
/*$resettargetquery=mysql_query("select * from tbl_roles where id='".$row_arr_home['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
*/	
$itemqry=mysql_query("select id, name , stage from tbl_roles where id='".$row_arr_home['id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($srno%2!=0)
{
?>
		  
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
 <td width="114" align="center" valign="middle" class="tblheading"><a href="Transaction/add_indents_view.php?p_id=<?php echo $row_arr_home['tid'];?>"><?php echo "IR".$row_arr_home['code']."/".$yearid_id."/".$logid;?></a></td>
  <td width="93" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
 <td valign="middle" class="tbltext" align="center"><?php echo $row_arr_home['code'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_item['stage'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_item['name'];?></td>
  </tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
 <td width="114" align="center" valign="middle" class="tblheading"><a href="Transaction/add_indents_view.php?p_id=<?php echo $row_arr_home['tid'];?>"><?php echo "IR".$row_arr_home['code']."/".$yearid_id."/".$logid;?></a></td>
  <td width="93" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
 <td valign="middle" class="tbltext" align="center"><?php echo $row_arr_home['code'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_item['stage'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $noticia_item['name'];?></td>
  </tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>

</table>
<?php
	$total_pages = ceil($total_results / $max_results); 
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
		echo "</td></tr></table>"; 
}
?>

<br /></td>
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
