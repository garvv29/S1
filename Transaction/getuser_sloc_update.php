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

/*if(isset($_GET['txtremarks']))
	{
	$txtremarks = $_GET['txtremarks'];	 
	}*/
/*if(isset($_GET['txtaddress']))
	{
	$txtaddress = $_GET['txtaddress'];	 
	}	*/
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
	
	if(isset($_GET['otups']))
	{
	$otups = $_GET['otups'];	 
	}	
	if(isset($_GET['otqty']))
	{
	$otqty = $_GET['otqty'];	 
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
	
	if(isset($_GET['orwoid']))
	{
	$orwoid = $_GET['orwoid'];	 
	}	
if(isset($_GET['txtmtype']))
	{
	$txtmtype = $_GET['txtmtype'];	 
	}	
	
	
	$good1=0;$good2=0;$good3=0;
	
	if($b1!="" && $b1 > 0)
	{
	$good1=1; $god1=1;
		if(isset($_GET['rowid_1']))
		{
			$rowid1 = $_GET['rowid_1'];	 
		}
		if(isset($_GET['exupsg1']))
		{
			$exups1 = $_GET['exupsg1'];	 
		}
		if(isset($_GET['exqtyg1']))
		{
			$exqty1 = $_GET['exqtyg1'];	 
		}
		
		$balup1=$c1;
		$balqt1=$b1;
		
		if($balqt1 > 0 && $balup1 == 0) $balup1=1;
		if($balqt1 == 0 && $balup1 == 0) $balup1=0;
		if($balqt1 == 0 && $balup1 > 0) $balup1=0;
	}
	
	if($g1!="" && $g1 > 0)
	{
		$good2=1; $god2=1;
		if(isset($_GET['rowid_2']))
		{
			$rowid2 = $_GET['rowid_2'];	 
		}
		if(isset($_GET['exupsg2']))
		{
			$exups2 = $_GET['exupsg2'];	 
		}
		if(isset($_GET['exqtyg2']))
		{
			$exqty2 = $_GET['exqtyg2'];	 
		}
		
		
		$balup2=$h1;
		$balqt2=$g1;
		
		if($balqt2 > 0 && $balup2 == 0) $balup2=1;
		if($balqt2 == 0 && $balup2 == 0) $balup2=0;
		if($balqt2 == 0 && $balup2 > 0) $balup2=0;
	}
	if($l1!="" && $l1 > 0)
	{
		$good3=1; $god3=1;
		
		if(isset($_GET['rowid_3']))
		{
			$rowid3 = $_GET['rowid_3'];	 
		}
		if(isset($_GET['exupsg3']))
		{
			$exups3 = $_GET['exupsg3'];	 
		}
		if(isset($_GET['exqtyg3']))
		{
			$exqty3 = $_GET['exqtyg3'];	 
		}
		
		$balup3=$m1;
		$balqt3=$l1;
		
		if($balqt3 > 0 && $balup3 == 0) $balup3=1;
		if($balqt3 == 0 && $balup3 == 0) $balup3=0;
		if($balqt3 == 0 && $balup3 > 0) $balup3=0;
	}
	
	$x=$good1+$good2+$good3;
	
	
	
	
//		end of 3rd table fields

//		start of 2nd table fields
	
	if(isset($_GET['tblslocnod']))
	{
	$n1 = $_GET['tblslocnod'];	 
	}

// 		end of 2nd table fields

//		start of 3rd table fields
	
	if(isset($_GET['txtslwhd1']))
	{
	$o1 = $_GET['txtslwhd1'];	 
	}
	if(isset($_GET['txtslbind1']))
	{
	$p1 = $_GET['txtslbind1'];	 
	}
	if(isset($_GET['txtslsubbd1']))
	{
	$q1 = $_GET['txtslsubbd1'];	 
	}
	if(isset($_GET['txtslqtyd1']))
	{
	$r1 = $_GET['txtslqtyd1'];	 
	}
	if(isset($_GET['txtslupsd1']))
	{
	$s1 = $_GET['txtslupsd1'];	 
	}
	if(isset($_GET['txtslwhd2']))
	{
	$t1 = $_GET['txtslwhd2'];	 
	}
	if(isset($_GET['txtslbind2']))
	{
	$u1 = $_GET['txtslbind2'];	 
	}
	if(isset($_GET['txtslsubbd2']))
	{
	$v1 = $_GET['txtslsubbd2'];	 
	}
	if(isset($_GET['txtslqtyd2']))
	{
	$w1 = $_GET['txtslqtyd2'];	 
	}
	if(isset($_GET['txtslupsd2']))
	{
	$x1 = $_GET['txtslupsd2'];	 
	}
	
	
	
	
	$damage1=0;$damage2=0;
	$balup4=0; $balqt4=0; $balup5=0; $balqt5=0; $exups4=0; $exups4=0; $exqty5=0; $exqty5=0;
	if($r1!="" && $r1 > 0)
	{
	$damage1=1; $dam1=1;
	if(isset($_GET['rowid_4']))
	{
	$rowid4 = $_GET['rowid_4'];	 
	}
	if(isset($_GET['exupsd1']))
	{
	$exups4 = $_GET['exupsd1'];	 
	}
	if(isset($_GET['exqtyd1']))
	{
	$exqty4 = $_GET['exqtyd1'];	 
	}
	
	$balup4=$s1;
	$balqt4=$r1;
	
	if($balqt4 > 0 && $balup4 == 0) $balup4=1;
	if($balqt4 == 0 && $balup4 == 0) $balup4=0;
	if($balqt4 == 0 && $balup4 > 0) $balup4=0;
	}
	
	if($w1!="" && $w1 > 0)
	{
	$damage2=1; $dam2=1;
	if(isset($_GET['rowid_5']))
	{
	$rowid5 = $_GET['rowid_5'];	 
	}
	if(isset($_GET['exupsd2']))
	{
	$exups5 = $_GET['exupsd2'];	 
	}
	if(isset($_GET['exqtyd2']))
	{
	$exqty5 = $_GET['exqtyd2'];	 
	}
	
	$balup5=$x1;
	$balqt5=$w1;
	
	if($balqt5 > 0 && $balup5 == 0) $balup5=1;
	if($balqt5 == 0 && $balup5 == 0) $balup5=0;
	if($balqt5 == 0 && $balup5 > 0) $balup5=0;
	}
	
	

	
//frm_action=submit &code=37 &txtmtype=good &rettyp= &oups=1 &oqty=37 &date=31-08-2009 &txtclass=91 &txtitem=8 &txtuom=Number &itmdupchkg=1 &itmdupchkd=1 &itmdchk= &txtrettyp=good &rowid_1=204 &rowid_2=205 &rowid_3=200 &txtupsg=25 &txtqtyg=136 &srno=4 &chkbox= &srno1= &edtrowid= &orwoid=205 &trid= &otups=0 &otqty=37 &txtslwhg1=57 &txtslbing1=85 &txtslsubbg1=693 &exupsg1=13 &exqtyg1=36 &txtslupsg1=1 &txtslqtyg1=10 &balupsg1=14 &balqtyg1=46 &dorowig1=204 &txtslwhg2=57 &txtslbing2=74 &txtslsubbg2=475 &exupsg2=1 &exqtyg2=37 &txtslupsg2=1 &txtslqtyg2=10 &balupsg2=2 &balqtyg2=47 &dorowig1=0 &txtslwhg3=57 &txtslbing3=74 &txtslsubbg3=471 &exupsg3=11 &exqtyg3=63 &txtslupsg3=1 &txtslqtyg3=17 &balupsg3=12 &balqtyg3=80 &dorowig3=200 &tblslocnod=0 &tttt=

	
		$tdate=$trdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		
		
if($trid == 0)
{
 $sql_in1="insert into tbl_sloc (code , issuedate , classification_id , items_id , uom, noofbinsg, noofbinsd, itmtype, yearcode, surole) values ('$code', '$tdate', '$classid', '$itemid', '$txtuom', '$tblslocnog', '$n1', '$txtmtype',  '$yearid_id', '$lgnid')";
 
if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=mysql_insert_id();
if($txtmtype == "good")
{
 if($god1==1)
{
$sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$y', '$z', '$a1', '$exups1', '$exqty1', '$balup1', '$balqt1', '$c1', '$b1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
if($god2==1)
{
$sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$d1', '$e1', '$f1', '$exups2', '$exqty2', '$balup2', '$balqt2', '$h1', '$g1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
 
if($god3==1)
{
$sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$i1', '$j1', '$k1', '$exups3', '$exqty3', '$balup3', '$balqt3', '$m1', '$l1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}

}
else
{
if($dam1==1)
{
 $sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$o1', '$p1', '$q1', '$exups4', '$exqty4', '$balup4', '$balqt4', '$s1', '$r1', '$orwoid')";
  mysql_query($sql_in) or die(mysql_error());
}
if($dam2==1)
{
 $sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$t1', '$u1', '$v1', '$exups5', '$exqty5', '$balup5', '$balqt5', '$x1', '$w1', '$orwoid')";
  mysql_query($sql_in) or die(mysql_error());
}
}
}
$trid=$mainid;
}
else
{
$sql_in1="update tbl_sloc set classification_id='$classid' , items_id='$itemid' , uom='$txtuom', noofbinsg='$tblslocnog', noofbinsd='$n1', itmtype='$txtmtype', yearcode='$yearid_id', surole='$lgnid' where slid='".$trid."'";
 
if(mysql_query($sql_in1) or die(mysql_error()))
{

$mainid=$trid;
if($txtmtype == "good")
{
 if($god1==1)
{
$sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$y', '$z', '$a1', '$exups1', '$exqty1', '$balup1', '$balqt1', '$c1', '$b1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
if($god2==1)
{
$sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$d1', '$e1', '$f1', '$exups2', '$exqty2', '$balup2', '$balqt2', '$h1', '$g1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}
 
if($god3==1)
{
$sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$i1', '$j1', '$k1', '$exups3', '$exqty3', '$balup3', '$balqt3', '$m1', '$l1', '$orwoid')";
mysql_query($sql_in) or die(mysql_error());
}

}
else
{
if($dam1==1)
{
 $sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$o1', '$p1', '$q1', '$exups4', '$exqty4', '$balup4', '$balqt4', '$s1', '$r1', '$orwoid')";
  mysql_query($sql_in) or die(mysql_error());
}
if($dam2==1)
{
 $sql_in="insert into tbl_sloc_sub(slocid , classification_id , items_id , whid ,binid ,subbinid, opups, opqty, balups, balqty, ups, qty, rowid) values('$mainid', '$classid', '$itemid', '$t1', '$u1', '$v1', '$exups5', '$exqty5', '$balup5', '$balqt5', '$x1', '$w1', '$orwoid')";
  mysql_query($sql_in) or die(mysql_error());
}
}
}
}
?>

<?php 
$trid=$mainid;
//exit;
?>
<div id="subdiv" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
  <tr class="tblsubtitle" height="25">
   <td colspan="4" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <td colspan="3" align="center" valign="middle" class="tblheading">Updated Sloc </td>
   <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
 </tr>
 <tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">UPS</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<td width="129" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="93" align="center" valign="middle" class="tblheading">UPS</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>
<?php
$cnt=0;
if($txtmtype=="good")
{
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 $sloc1=""; $cnt++;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];
$sloc1=$wareh1.$binn1.$subbinn1;
$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];

 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stlg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
$balu=$row_issuetbl['stlg_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stlg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
$balu=$row_issuetbl['stlg_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>		
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 }
 else
 {
 

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0; $sloc1="";
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 $cnt++;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];
$sloc1=$wareh1.binn1.$subbinn1;

$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stld_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."'and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
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
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stld_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."'and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 <td colspan="4" align="center" valign="middle" class="tblheading">&nbsp;</td>
 </tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="10">Item not in Stock</td>
 </tr>
 <?php
 }
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" /></div>
<div id="subsubdiv">
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div><br />

