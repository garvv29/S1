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
	//$year1=$_SESSION['year'];*/
	 //$role='operator';
	// $role='admin';
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
		if(isset($_POST['frm_action'])=='submit')
		{
		
		if(!empty($_POST['txtrd']))
		{
		 $dept=trim($_POST['txtrd']);
		}
		else
		{
		echo $dept=trim($_POST['txtrbd']);
		}
		//$dept=trim($_POST['txtrd']);
		$sdate=trim($_POST['sadte']);
		$edate=trim($_POST['edate']);
		
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
		echo "<script>window.location='captiveconsumptionreport1.php?pid=$dept&sdate=$sdate&edate=$edate'</script>";	
		}
		}
		else
		 {?>
		 <script>
		  alert("Please Select Period for search");
		  </script>
		 <?php }
		
	}
	/*$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");

	$sql_yr=mysql_query("select * from tblyears where years='$yearold'")or die("Error:".mysql_error());
	$tot_yr=mysql_fetch_array($sql_yr);
	if($totyears > 1)
	{$yrid1=$tot_yr['yearsid']-1;}
	$yrid2=$tot_yr['yearsid'];
	
	$sql_yr2=mysql_query("update tblyears set years_flg=2, years_status='a' where yearsid='$yrid2'")or die("Error:".mysql_error());
	
	if($totyears > 1)
	{
	$sql_yr1=mysql_query("update tblyears set years_flg=1 where yearsid='$yrid1'")or die("Error:".mysql_error());
	$sql_yr3=mysql_query("select * from tblyears where yearsid='$yrid1'")or die("Error:".mysql_error());
	$tot_yr3=mysql_fetch_array($sql_yr3);
	$yrs=$tot_yr3['years']; 
	$yrs="expro$yrs";
	}
	else
	{
	$sql_yr3=mysql_query("select * from tblyears where yearsid='$yrid2'")or die("Error:".mysql_error());
	$tot_yr3=mysql_fetch_array($sql_yr3);
	$yrs=$tot_yr3['years']; 
	$yrs="expro$yrs";
	}

/* backup the db OR just a table 
function backup_tables($host,$user,$pass,$name,$tables = '*')
{*/
	/*$return='';
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.='DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	/*$sflie='../dbbackup/'.$name;
	$handle = fopen($sflie.'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

backup_tables('localhost','root','',$yrs);

	$query=mysql_query("CREATE DATABASE $year") or die("Error: " . mysql_error());

	$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db($year);
	
	$filename = '../dbbackup/'.$yrs.'.sql';	
		// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line_num => $line) 
{
  // Only continue if it's not a comment
  if (substr($line, 0, 1) != '#' && $line != '' ) 
  {
    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';') 
	{
      // Perform the query
      mysql_query($templine) or print('Error performing query \'<b>' . $templine . '</b>\': ' . mysql_error() . '<br /><br />');
      // Reset temp variable to empty
      $templine = '';
    }
  }
}*/	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Report -Captive Consumption Report</title>
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
<script language="javascript" type="text/javascript">
function rtnbychk(rtnbyval)
{
	if(rtnbyval!="")
	{
		if(document.frmaddDepartment.sdate.value!="")
		{
			document.getElementById("rbd").value="";
			document.getElementById("rbd").readOnly=true;
			document.getElementById("rbd").style.backgroundColor="#CCCCCC";
		}
		else
		{
			alert("Please select Return from Stage first");
			document.frmaddDepartment.txtrd.selectedIndex=0;
			//document.frmaddDepartment.txtstage.focus();
			return false;
		}
	}
	else
	{
		document.getElementById("rbd").value="";
		document.getElementById("rbd").readOnly=false;
		document.getElementById("rbd").style.backgroundColor="#FFFFFF";
	}
}

 


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
/*function onloadfocus()
	{
	document.frmaddDepartment.txtdrno.focus();
	}*/
	

function openslocpopprint(tid)
{
winHandle=window.open('arr_vendor_print.php?itmid='+tid,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
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
	dt1=getDateObject(document.frmaddDepartment.sdate.value,"-");
	dt2=getDateObject(document.frmaddDepartment.edate.value,"-");
	dt3=getDateObject(document.frmaddDepartment.cdate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
	
	if(dt2 > dt3)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
	
	if(dt1 > dt3)
	{
	alert("Please select Valid Date Range.");
	return false;
	}

	 if(document.frmaddDepartment.txtrd.value=="" && document.frmaddDepartment.txtrbd.value=="")
	{
		alert("Please select Return by ID or Specify the Name");
		//document.frmaddDepartment.txtstage.focus();
		return false;
	}
return true;
}
</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25"class="Mainheading"  >&nbsp;Captive Consumption Report</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="604" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25"><td colspan="4" align="center" class="tblheading">Captive Consumption Report</td></tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 <?php
 /*$code="";
$quer2=mysql_query("SELECT DISTINCT dept_name,dept_id FROM tbldept order by dept_name Asc"); */
?>
		 <tr class="Light" height="25">
           <td align="right" height="30" valign="middle" class="tblheading">&nbsp;Period&nbsp;&raquo;&nbsp;&nbsp;&nbsp;From&nbsp;</td>
           <td width="169" align="left"  valign="middle" >&nbsp;<input name="sdate" id="sdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick(document.frmaddDepartment.sdate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> &nbsp;<font color="#FF0000" >*</font></td>
   
            <td width="80" align="right"  valign="middle" class="tblheading">&nbsp;To&nbsp;</td>
           <td width="191" align="left"  valign="middle" >&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDepartment.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script>&nbsp;<font color="#FF0000" >*</font></td>         
         </tr>
				 
		<?php $quer1=mysql_query("SELECT p_id,business_name FROM tbl_partymaser order by business_name")or die(mysql_error()); ?>
		 <tr class="Dark" height="25">
           <td width="140" align="right"  valign="middle" class="tblheading">&nbsp;Select Party&nbsp;</td>
           <td align="left"  height="30" valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtrd" style="width:180px;" onChange="rtnbychk(this.value)"  >
<option value="" selected>-----------Select--</option>
	<?php while($noticia = mysql_fetch_array($quer1)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td>
         </tr>
		  <tr class="Light" height="25">
           <td width="140" align="right"  valign="middle" class="tblheading">&nbsp;OR Specify&nbsp;</td>
           <td align="left"  height="30" valign="middle" colspan="3">&nbsp;<font class="tblheading"></font><input name="txtrbd" id="rbd" type="text" size="35" class="tbltext" tabindex="" maxlength="35" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr><td colspan="4"><div id="txtHint"><input type="hidden" name="butn" value="" /></div></td></tr>
</table>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="../indexview.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" onClick="return mySubmit();" ><input type="hidden" name="txtinv" /><input type="hidden" name="flagcode" value=""/><input type="hidden" name="flagcode1" value=""/></td>
</tr>
</table>
</td><td ></td>
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
