<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	$year1=$_SESSION['year'];*/
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
	/*if(isset($_POST['frm_action'])=='submit')
	{
	$totyears=trim($_POST['totyr']);	
	$yearold=trim($_POST['year']);
	$year = "expro$yearold";
	
	$conn = mysql_connect("localhost","root","");
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
{
	$return='';
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
	$sflie='../dbbackup/'.$name;
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
}
	echo "<script>window.location='yearmanagement.php'</script>";		
}*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Master-Current Year</title>
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
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript"> 
   
function Openyrclose(yrsid)
{	
	var flg=document.frmcreatedb.flg.value;
	var y2=document.frmcreatedb.y2.value;
	var flgci=document.frmcreatedb.flgci.value;
	
	if(flg!=0)
	{ alert('Can not close Year before 1st April '+y2+' of Next F.Y.');
	return false;
	}
	else if(flgci!=0)
	{ alert('Can not close Year, Cycle Inventory Transaction is under process.');
	return false;
	}
	else
	{
	if(confirm("Do you really want to close this year?"))
	{
		//var locid=document.frmcreatedb.locid.value;
		winHandle=window.open('closeyear.php?yrsid='+yrsid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
	return false;
	}
	}
}

function mySubmit()
{

return true;
}
</SCRIPT>

<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">
      <?php include '../include/navbar_loader.php'; ?>

<table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto"  align="center"  class="midbgline">

		  
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Year Management Master </td>
	    </tr></table></td>
	  </tr> 
	  </table></td></tr>
	  
  
	  
	  <td align="center" colspan="4" >
	  
	    <form name="frmcreatedb" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<?php
	/*$sql_sel="select * from tbllock";
	$res=mysql_query($sql_sel) or die (mysql_error());
	$row=mysql_fetch_array($res);
	$total=mysql_num_rows($res);
	*/
?>
<tr>
<td width="30">	 </td><td>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="550" bordercolor="#b9d647" style="border-collapse:collapse">
 <tr class="light" height="25">
<td align="center" class="tblheading" valign="middle" colspan="2">Year Management</td>
</tr>
<tr class="Light">
<td align="left" valign="top">
<?php
	/*$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");*/
	
	$sql_yr=mysql_query("select * from tblyears where years_flg =1 and years_status='a'")or die("Error:".mysql_error());
	$tot_yr=mysql_num_rows($sql_yr);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="5">Active Current Financial Year</td>
</tr>
<tr class="Dark" height="25">
<td width="20%" align="center" valign="middle" class="tblheading">Date From</td>
<td width="20%" align="center" valign="middle" class="tblheading">To </td>
<td width="20%" align="center" valign="middle" class="tblheading">Year</td>
<td width="20%" align="center" valign="middle" class="tblheading">Year Code </td>
<td width="20%" align="center" valign="middle" class="tblheading">&nbsp;Activity</td>
</tr>
<?php

$srno=1;$a=1;$flash=0; $y=0; $y2=0;
if($tot_yr > 0)
{
while($row_yr=mysql_fetch_array($sql_yr))
{


$d=date("d-m-Y");
		$tdate=$d;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		if($row_yr['year1'] == $tyear)
		{ 
		$y2=$row_yr['year2']; $y=1;
		}
		else if($row_yr['year2'] == $tyear)
		{ 
		$y2=$row_yr['year2']; $y=2;
		}
		else
		{ 
		$y=0; $flash=0; 
		}
		
		if($y!=0)
		{
			$ldate=$y2."-04-01"; 
			$s=strtotime($tdate); 
			$e=strtotime($ldate);
			if($s < $e)
			{ $flash=1;}
			else
			{ $flash=0; }
		}
		else
		{
		$flash=1; $y2=$row_yr['year2'];
		}
		
		$sql_ci=mysql_query("select * from tbl_ci where ci_upflg=0") or die(mysql_error());
		$row_ci=mysql_fetch_array($sql_ci);
		$t_ci=mysql_num_rows($sql_ci);
		if($t_ci > 0)
			{ $flg2=1;}
			else
			{ $flg2=0;}
?>
<tr class="Light" height="25">
<td align="center" class="tblheading" valign="middle">1st April</td>
<td align="center" class="tblheading" valign="middle">31st March</td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yr['year1']."-".$row_yr['year2'];?></td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yr['ycode'];?></td>
<td align="center" class="tblheading" valign="middle"><?php if($tot_yr == 1) { if($row_yr['years_flg']==1) { ?><a href="Javascript:void(0);" onclick="Openyrclose('<?php echo $row_yr['yearsid']?>');">Close</a><?php } }?></td>
</tr><input type="hidden" name="cdate" value="<?php echo $d;?>" /><input type="hidden" name="ldate" value="<?php echo $ldate;?>" />
<?php $srno++; $a=$row_yr['yearsid']; 
}$a++; 
}

?> <input type="hidden" name="totyr" value="<?php echo $tot_yr;?>" /><input type="hidden" name="flg" value="<?php echo $flash;?>" /><input type="hidden" name="y2" value="<?php echo $y2;?>" /><input type="hidden" name="flgci" value="<?php echo $flg2;?>">
</table></td>

</tr>
<tr><td>&nbsp;</td></tr>
<tr class="Light">
<td align="left" valign="top">
<?php
	/*$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");*/
	
	$sql_yrc=mysql_query("select * from tblyears where years_flg =0 and years_status='c'")or die("Error:".mysql_error());
	$tot_yrc=mysql_num_rows($sql_yrc);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="5">Closed Previous Financial Years</td>
</tr>
<tr class="Dark" height="25">
<td width="20%" align="center" valign="middle" class="tblheading">Date From</td>
<td width="20%" align="center" valign="middle" class="tblheading">To </td>
<td width="20%" align="center" valign="middle" class="tblheading">Year</td>
<td width="20%" align="center" valign="middle" class="tblheading">Year Code </td>
<td width="20%" align="center" valign="middle" class="tblheading">&nbsp;Status</td>
</tr>
<?php

$srnoc=1;
if($tot_yr > 0)
{
while($row_yrc=mysql_fetch_array($sql_yrc))
{
?>
<tr class="Light" height="25">
<td align="center" class="tblheading" valign="middle">1st April</td>
<td align="center" class="tblheading" valign="middle">31st March</td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yrc['year1']."-".$row_yrc['year2'];?></td>
<td align="center" class="tblheading" valign="middle"><?php echo $row_yrc['ycode'];?></td>
<td align="center" class="tblheading" valign="middle">Closed</td>
</tr>
<?php $srnoc++;
}
}
?>
</table></td>

</tr>
<tr><td>&nbsp;</td></tr>
<tr class="Light">
<td align="left" valign="top">

<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="2">Notes</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">1</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;Active Current Financial year is not allowed to be closed before 1st April of next<br />&nbsp;Financial Year. It can be closed only on 1st April of next year or any date after it.
</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">2</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;When Active Current Financail Year is closed, it is transferred to the list of Closed<br />&nbsp;Previous Financial Years & next New Active Current Financial Year is opened <br />
&nbsp;automatically.</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">3</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;Once Active Current Financial Year is Closed, No Transaction can be entered in that<br />&nbsp;Financial Year.</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">4</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;When Cycle Inventory Transaction Updation is pending then Active Current Financial<br />&nbsp;Year will not allowed to be closed.</td>
</tr>
</table></td>


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
