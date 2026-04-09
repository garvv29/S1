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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['code']))
	{
	$code = $_GET['code'];	 
	}
if(isset($_GET['txtdate']))
	{
	$trdate = $_GET['txtdate'];	 
	}
if(isset($_GET['txtuom']))
	{
	$txtuom = $_GET['txtuom'];	 
	}
if(isset($_GET['trid']))
	{
	$trid = $_GET['trid'];	 
	}
if(isset($_GET['txtclass']))
	{
	$classid = $_GET['txtclass'];	 
	}
if(isset($_GET['txtitem']))
	{
	$itemid = $_GET['txtitem'];	 
	}	
if(isset($_GET['rid']))
	{
	$rid = $_GET['rid'];	 
	}

if(isset($_GET['txtremarks']))
	{
	$txtremarks = $_GET['txtremarks'];	 
	}
if(isset($_GET['txtaddress']))
	{
	$txtaddress = $_GET['txtaddress'];	 
	}	
if(isset($_GET['rettyp']))
	{
	$rettyp = $_GET['rettyp'];	 
	}	

	if(isset($_GET['oups']))
	{
	$oups = $_GET['oups'];	 
	}	
	if(isset($_GET['oqty']))
	{
	$oqty = $_GET['oqty'];	 
	}	
	
	if(isset($_GET['tblslocnog']))
	{
	$tblslocnog = $_GET['tblslocnog'];	 
	}
	
	$rowid1=0;$rowid2=0;$rowid3=0;$rowid4=0;$rowid5=0; $god1=0;$god2=0;$god3=0; $dam1=0;$dam2=0;
	if(isset($_GET['txtslwhg1']))
	{
	$y = $_GET['txtslwhg1'];	 
	}
	if(isset($_GET['txtslbing1']))
	{
	$z = $_GET['txtslbing1'];	 
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$a1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$b1 = $_GET['txtslqtyg1'];	 
	}
	else
	{
	$b1=0;
	}
	if(isset($_GET['txtslupsg1']))
	{
	$c1 = $_GET['txtslupsg1'];	 
	}
	if(isset($_GET['txtslwhg2']))
	{
	$d1 = $_GET['txtslwhg2'];	 
	}
	if(isset($_GET['txtslbing2']))
	{
	$e1= $_GET['txtslbing2'];	 
	}
	if(isset($_GET['txtslsubbg2']))
	{
	$f1 = $_GET['txtslsubbg2'];	 
	}
	if(isset($_GET['txtslqtyg2']))
	{
	$g1 = $_GET['txtslqtyg2'];	 
	}
	else
	{
	$g1=0;
	}
	if(isset($_GET['txtslupsg2']))
	{
	$h1 = $_GET['txtslupsg2'];	 
	}
	if(isset($_GET['txtslwhg3']))
	{
	$i1 = $_GET['txtslwhg3'];	 
	}
	if(isset($_GET['txtslbing3']))
	{
	$j1 = $_GET['txtslbing3'];	 
	}
	if(isset($_GET['txtslsubbg3']))
	{
	$k1 = $_GET['txtslsubbg3'];	 
	}
	if(isset($_GET['txtslqtyg3']))
	{
	$l1 = $_GET['txtslqtyg3'];	 
	}
	else
	{
	$l1=0;
	}
	if(isset($_GET['txtslupsg3']))
	{
	$m1 = $_GET['txtslupsg3'];	 
	}
	
	
	$good1=0;$good2=0;$good3=0;
	
	if($b1!="" && $b1 > 0)
	{
	$good1=1; $god1=1;
		if(isset($_GET['orowig1']))
		{
			$rowid1 = $_GET['orowig1'];	 
		}
		if(isset($_GET['exupsg1']))
		{
			$exups1 = $_GET['exupsg1'];	 
		}
		if(isset($_GET['exqtyg1']))
		{
			$exqty1 = $_GET['exqtyg1'];	 
		}
		$balup1=$c1+$exups1;
		$balqt1=$b1+$exqty1;
		if($balqt1 > 0 && $balup1 == 0) $balup1=1;
		if($balqt1 == 0 && $balup1 == 0) $balup1=0;
		if($balqt1 == 0 && $balup1 > 0) $balup1=0;
	}
	
	if($g1!="" && $g1 > 0)
	{
		$good2=1; $god2=1;
		if(isset($_GET['orowig2']))
		{
			$rowid2 = $_GET['orowig2'];	 
		}
		if(isset($_GET['exupsg2']))
		{
			$exups2 = $_GET['exupsg2'];	 
		}
		if(isset($_GET['exqtyg2']))
		{
			$exqty2 = $_GET['exqtyg2'];	 
		}
		$balup2=$h1+$exups2;
		$balqt2=$g1+$exqty2;
		if($balqt2 > 0 && $balup2 == 0) $balup2=1;
		if($balqt2 == 0 && $balup2 == 0) $balup2=0;
		if($balqt2 == 0 && $balup2 > 0) $balup2=0;
	}
	if($l1!="" && $l1 > 0)
	{
		$good3=1; $god3=1;
		
		if(isset($_GET['orowig3']))
		{
			$rowid3 = $_GET['orowig3'];	 
		}
		if(isset($_GET['exupsg3']))
		{
			$exups3 = $_GET['exupsg3'];	 
		}
		if(isset($_GET['exqtyg3']))
		{
			$exqty3 = $_GET['exqtyg3'];	 
		}
		$balup3=$m1+$exups3;
		$balqt3=$l1+$exqty3;
		if($balqt3 > 0 && $balup3 == 0) $balup3=1;
		if($balqt3 == 0 && $balup3 == 0) $balup3=0;
		if($balqt3 == 0 && $balup3 > 0) $balup3=0;
	}
	
	$x=$good1+$good2+$good3;
	
if(isset($_GET['orwoid']))
	{
	$orwoid = $_GET['orwoid'];	 
	}

//&txtclass=64&txtitem=119&txtuom=Number&txtupsg=0&txtqtyg=270&srno=2&chkbox=&srno1=&edtrowid=good&txtslwhg1=54&txtslbing1=69&txtslsubbg1=380&txtslupsg1=1&txtslqtyg1=100&txtremarks=

	
		$tdate=$trdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		
		
if($trid == 0)
{
$sql_in1="insert into tbl_dtog (code , date , classification_id , items_id , uom, remarks, yearcode) values ('$code','$tdate','$classid', '$itemid','$txtuom','$txtremarks', '$yearid_id')";
 
if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=mysql_insert_id();
 if($god1==1)
{
$sql_in="insert into tbl_dtog_sub(did , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$y', '$z', '$a1', '$exups1', '$exqty1', '$balup1', '$balqt1', '$c1', '$b1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
if($god2==1)
{
$sql_in="insert into tbl_dtog_sub(did , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$d1', '$e1', '$f1', '$exups2', '$exqty2', '$balup2', '$balqt2', '$h1', '$g1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
 
if($god3==1)
{
$sql_in="insert into tbl_dtog_sub(did , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$i1', '$j1', '$k1', '$exups3', '$exqty3', '$balup3', '$balqt3', '$m1', '$l1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
}
$trid=$mainid;
}
else
{
$sql_in1="update tbl_dtog set classification_id='$classid' , items_id='$itemid' , uom='$txtuom', remarks='$txtremarks', yearcode='$yearid_id' where did='".$trid."'";
 
if(mysql_query($sql_in1) or die(mysql_error()))
{

$s_sub_sub="delete from tbl_dtog_sub where rowid='".$orwoid."' and did='".$trid."'";
mysql_query($s_sub_sub) or die(mysql_error());

$mainid=$trid;
if($god1==1)
{
$sql_in="insert into tbl_dtog_sub(did , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$y', '$z', '$a1', '$exups1', '$exqty1', '$balup1', '$balqt1', '$c1', '$b1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
if($god2==1)
{
$sql_in="insert into tbl_dtog_sub(did , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$d1', '$e1', '$f1', '$exups2', '$exqty2', '$balup2', '$balqt2', '$h1', '$g1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
 
if($god3==1)
{
$sql_in="insert into tbl_dtog_sub(did , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$i1', '$j1', '$k1', '$exups3', '$exqty3', '$balup3', '$balqt3', '$m1', '$l1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}

}
}
?>

<?php 
$trid=$mainid;
//exit;
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
    <td colspan="4" align="center" valign="middle" class="tblheading">Damage Pre Transfer </td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Good Transfer</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Damage Post Transfer</td>
    <td colspan="2"  align="center" valign="middle" class="tblheading">Good Post Transfer</td>
    <td width="80" rowspan="2"  align="center" valign="middle" class="tblheading">Edit</td>
  </tr>
  <tr class="tblsubtitle" height="25">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
    <td width="95" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="60" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="65" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="86" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="68" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="71" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="75" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="71" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
  $sloc1="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

$sloc1=$wareh1.$binn1.$subbinn1;


$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
$t=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['dgsubid']; else $subrid=$row_sloc['dgsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."<br/>";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."<br/>";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname']."<br/>";
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stld_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stld_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:hand" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $row_issue1[0]?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
$t=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['dgsubid']; else $subrid=$row_sloc['dgsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."<br/>";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."<br/>";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname']."<br/>";
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stld_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stld_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:hand" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $row_issue1[0]?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" />
</div>
<div id="subsubdiv">
 <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="86" align="center" valign="middle" class="tblheading">Bin</td>
<td width="100" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">UPS</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>