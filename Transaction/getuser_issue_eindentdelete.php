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
	$logid="OP1";
	require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
	
	$sql_main1="update tbl_ieindent set flg=1  where tid = '$a'";
	$a123=mysql_query($sql_main1) or die(mysql_error());
?>
<?php
	 $sql1=mysql_query("select * from tbl_ieindent  where flg=0")or die(mysql_error());
	 $total_results=mysql_num_rows($sql1);
?> 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; ">Pending Indents(<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table width="698" align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="33" align="center" class="tblheading" valign="middle">#</td>
<td width="97" align="center" class="tblheading" valign="middle">Date </td>
<td width="106" align="center" class="tblheading" valign="middle">Indent No </td>
<td width="97" align="center" class="tblheading" valign="middle">Stage </td>
<td width="271" align="center" class="tblheading" valign="middle">Raised By </td>
<td width="80" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php

$srno=1;
	while($row=mysql_fetch_array($sql1))
	{
	
	 $resettargetquery=mysql_query("select * from tbl_roles where id='".$row['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	$tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $tdate;?></td>
<td valign="middle" class="tbltext" align="center"><a href="add_issue_indents.php?tid=<?php echo $row['tid']?>"><?php echo $row['code'];?></a></td>
<td valign="middle" class="tbltext" align="center"><?php echo $resetresult['stage'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $resetresult['name'];?></td>
 <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:pointer" onclick="deleterec(<?php echo $row['tid']?>);" /></td>
 </tr>
<?php
	}
	else
	{ 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $tdate;?></td>
<td valign="middle" class="tbltext" align="center"><a href="add_issue_indents.php?tid=<?php echo $row['tid']?>"><?php echo $row['code'];?></a></td>
<td valign="middle" class="tbltext" align="center"><?php echo $resetresult['stage'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $resetresult['name'];?></td>
 <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:pointer" onclick="deleterec(<?php echo $row['tid']?>);" /></td>
 </tr>
<?php	
	}
	 $srno=$srno+1;
	}
?>
</table>

<br />
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="select_transction_issue_internal.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;</td>
</tr>
</table>