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
	
	if(isset($_GET['orowid']))
	{
	$orwoid = $_GET['orowid'];	 
	}	

if(isset($_GET['txtitem1']))
	{
	$itemid1 = $_GET['txtitem1'];	 
	}	
if(isset($_GET['txtuom1']))
	{
	$txtuom1 = $_GET['txtuom1'];	 
	}
	
	
		$rowid1=0;$rowid2=0;$rowid3=0;$rowid4=0;$rowid5=0; $god1=0;$god2=0;$god3=0; $dam1=0;$dam2=0;
	if(isset($_GET['txtslwhg1']))
	{
	$whid1 = $_GET['txtslwhg1'];	 
	}
	if(isset($_GET['txtslbing1']))
	{
	$binid1 = $_GET['txtslbing1'];	 
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$subbinid1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$qty1 = $_GET['txtslqtyg1'];	 
	}
	else
	{
	$qty1=0;
	}
	if(isset($_GET['txtslupsg1']))
	{
	$ups1 = $_GET['txtslupsg1'];	 
	}
	
	
	if(isset($_GET['txtslwhg2']))
	{
	$whid2 = $_GET['txtslwhg2'];	 
	}
	if(isset($_GET['txtslbing2']))
	{
	$binid2= $_GET['txtslbing2'];	 
	}
	if(isset($_GET['txtslsubbg2']))
	{
	$subbinid2 = $_GET['txtslsubbg2'];	 
	}
	if(isset($_GET['txtslqtyg2']))
	{
	$qty2 = $_GET['txtslqtyg2'];	 
	}
	else
	{
	$qty2=0;
	}
	if(isset($_GET['txtslupsg2']))
	{
	$ups2 = $_GET['txtslupsg2'];	 
	}
	
	
	if(isset($_GET['txtslwhg3']))
	{
	$whid3 = $_GET['txtslwhg3'];	 
	}
	if(isset($_GET['txtslbing3']))
	{
	$binid3 = $_GET['txtslbing3'];	 
	}
	if(isset($_GET['txtslsubbg3']))
	{
	$subbinid3 = $_GET['txtslsubbg3'];	 
	}
	if(isset($_GET['txtslqtyg3']))
	{
	$qty3 = $_GET['txtslqtyg3'];	 
	}
	else
	{
	$qty3=0;
	}
	if(isset($_GET['txtslupsg3']))
	{
	$ups3 = $_GET['txtslupsg3'];	 
	}
	
	$good1=0;$good2=0;$good3=0;
	
	if($qty1!="" && $qty1 > 0)
	{
	$good1=1; $god1=1;
		/*if(isset($_GET['rowid_1']))
		{
			$rowid1 = $_GET['rowid_1'];	 
		}*/
		if(isset($_GET['exusp1']))
		{
			$exups1 = $_GET['exusp1'];	 
		}
		if(isset($_GET['exqty1']))
		{
			$exqty1 = $_GET['exqty1'];	 
		}
		
		$balup1=$ups1+$exups1;
		$balqt1=$qty1+$exqty1;
		
		if($balqt1 > 0 && $balup1 == 0) $balup1=1;
		if($balqt1 == 0 && $balup1 == 0) $balup1=0;
		if($balqt1 == 0 && $balup1 > 0) $balup1=0;
	}
	
	if($qty2!="" && $qty2 > 0)
	{
		$good2=1; $god2=1;
		/*if(isset($_GET['rowid_2']))
		{
			$rowid2 = $_GET['rowid_2'];	 
		}*/
		if(isset($_GET['exusp2']))
		{
			$exups2 = $_GET['exusp2'];	 
		}
		if(isset($_GET['exqty2']))
		{
			$exqty2 = $_GET['exqty2'];	 
		}
		
		$balup2=$ups2+$exups2;
		$balqt2=$qty2+$exqty2;
		
		if($balqt2 > 0 && $balup2 == 0) $balup2=1;
		if($balqt2 == 0 && $balup2 == 0) $balup2=0;
		if($balqt2 == 0 && $balup2 > 0) $balup2=0;
	}
	if($qty3!="" && $qty3 > 0)
	{
		$good3=1; $god3=1;
		
		/*if(isset($_GET['rowid_3']))
		{
			$rowid3 = $_GET['rowid_3'];	 
		}*/
		if(isset($_GET['exusp3']))
		{
			$exups3 = $_GET['exusp3'];	 
		}
		if(isset($_GET['exqty3']))
		{
			$exqty3 = $_GET['exqty3'];	 
		}
		
		$balup3=$ups3+$exups3;
		$balqt3=$qty3+$exqty3;
		
		if($balqt3 > 0 && $balup3 == 0) $balup3=1;
		if($balqt3 == 0 && $balup3 == 0) $balup3=0;
		if($balqt3 == 0 && $balup3 > 0) $balup3=0;
	}
	
	$x=$good1+$good2+$good3;
	

		
/*	if(isset($_GET['txtslwhg1']))
	{
	$whid1 = $_GET['txtslwhg1'];	 
	}	
	if(isset($_GET['txtslbing1']))
	{
	$binid1 = $_GET['txtslbing1'];	 
	}	
	if(isset($_GET['txtslsubbg1']))
	{
	$subbinid1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslupsg1']))
	{
	$ups1 = $_GET['txtslupsg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$qty1 = $_GET['txtslqtyg1'];	 
	}	
	if(isset($_GET['txtslwhg2']))
	{
	$whid2 = $_GET['txtslwhg2'];	 
	}	
	if(isset($_GET['txtslbing2']))
	{
	$binid2 = $_GET['txtslbing2'];	 
	}	
	if(isset($_GET['txtslsubbg2']))
	{
	$subbinid2 = $_GET['txtslsubbg2'];	 
	}
	if(isset($_GET['txtslupsg2']))
	{
	$ups2 = $_GET['txtslupsg2'];	 
	}
	if(isset($_GET['txtslqtyg2']))
	{
	$qty2 = $_GET['txtslqtyg2'];	 
	}
	if(isset($_GET['txtslwhg3']))
	{
	$whid3 = $_GET['txtslwhg3'];	 
	}	
	if(isset($_GET['txtslbing3']))
	{
	$binid3 = $_GET['txtslbing3'];	 
	}	
	if(isset($_GET['txtslsubbg3']))
	{
	$subbinid3 = $_GET['txtslsubbg3'];	 
	}
	if(isset($_GET['txtslupsg3']))
	{
	$ups3 = $_GET['txtslupsg3'];	 
	}
	if(isset($_GET['txtslqtyg3']))
	{
	$qty3 = $_GET['txtslqtyg3'];	 
	}
*/
if($qty1!="")$tblslocnog=1;elseif($qty2!="")$tblslocnog=2;elseif($qty3!="")$tblslocnog=3;

//frm_action=submit&rettyp=good&code=22&oups=1&oqty=5&txtid=IT22%2F09-10&txtdate=21-07-2009&txtclass=64&txtitem=132&txtuom=Number&txt1=good&sloc_select=509&txtupsg=2&txtqtyg=10&srno=3&chkbox=&srno1=&edtrowid=good&orowid=509&trid=&txtitem1=133&txtuom1=Number&txtslwhg1=40&txtslbing1=82&txtslsubbg1=631&exusp1=&exqty1=&txtslupsg1=1&txtslqtyg1=5&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&exusp2=&exqty2=&txtslupsg2=&txtslqtyg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&exusp3=&exqty3=&txtslupsg3=&txtslqtyg3=&maintrid=&subtrid=&txtremarks=

	
		$tdate=$trdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		
		
if($trid == 0)
{
 $sql_in1="insert into tbl_iitr (tcode , tdate , classification_id , items_id_from , uom_from, typ, slocno, yearcode, remarks) values ('$code','$tdate','$classid', '$itemid','$txtuom','$rettyp', '$tblslocnog', '$yearid_id', '$txtremarks')";
 
if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=mysql_insert_id();
 if($god1==1)
{
 $sql_in="insert into tbl_iitr_sub(iitr_id , classification_id , items_id ,uom,  whid ,binid ,subbinid, ups_from, qty_from, ups_to, qty_to, balups, balqty, rowid) values('$mainid', '$classid', '$itemid1', '$txtuom1', '$whid1', '$binid1', '$subbinid1', '$oups', '$oqty', '$ups1', '$qty1', '$balup1', '$balqt1', '$orwoid')";
 mysql_query($sql_in) or die(mysql_error());
}
 if($god2==1)
{
 $sql_in="insert into tbl_iitr_sub(iitr_id , classification_id , items_id ,uom,  whid ,binid ,subbinid, ups_from, qty_from, ups_to, qty_to, balups, balqty, rowid) values('$mainid', '$classid', '$itemid1', '$txtuom1', '$whid2', '$binid2', '$subbinid2', '$oups', '$oqty', '$ups2', '$qty2', '$balup2', '$balqt2', '$orwoid')";
 mysql_query($sql_in) or die(mysql_error());
}
 if($god3==1)
{
 $sql_in="insert into tbl_iitr_sub(iitr_id , classification_id , items_id ,uom,  whid ,binid ,subbinid, ups_from, qty_from, ups_to, qty_to, balups, balqty, rowid) values('$mainid', '$classid', '$itemid1', '$txtuom1', '$whid3', '$binid3', '$subbinid3', '$oups', '$oqty', '$ups3', '$qty3', '$balup3', '$balqt3', '$orwoid')";
 mysql_query($sql_in) or die(mysql_error());
}

}
$trid=$mainid;
}
else
{

$sql_in1="update tbl_iitr set classification_id='$classid' , items_id_from='$itemid' , uom_from='$txtuom', typ='$rettyp', slocno='$tblslocnog', yearcode='$yearid_id', remarks='$txtremarks' where iitr_id='".$trid."'";
 
if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=$trid;
 
$s_sub_sub="delete from tbl_iitr_sub where rowid='".$orwoid."' and iitr_id='".$trid."'";
mysql_query($s_sub_sub) or die(mysql_error());

 if($god1==1)
{
 $sql_in="insert into tbl_iitr_sub(iitr_id , classification_id , items_id ,uom,  whid ,binid ,subbinid, ups_from, qty_from, ups_to, qty_to, balups, balqty, rowid) values('$mainid', '$classid', '$itemid1', '$txtuom1', '$whid1', '$binid1', '$subbinid1', '$oups', '$oqty', '$ups1', '$qty1', '$balup1', '$balqt1', '$orwoid')";
 mysql_query($sql_in) or die(mysql_error());
}
 if($god2==1)
{
 $sql_in="insert into tbl_iitr_sub(iitr_id , classification_id , items_id ,uom,  whid ,binid ,subbinid, ups_from, qty_from, ups_to, qty_to, balups, balqty, rowid) values('$mainid', '$classid', '$itemid1', '$txtuom1', '$whid2', '$binid2', '$subbinid2', '$oups', '$oqty', '$ups2', '$qty2', '$balup2', '$balqt2', '$orwoid')";
 mysql_query($sql_in) or die(mysql_error());
}
 if($god3==1)
{
 $sql_in="insert into tbl_iitr_sub(iitr_id , classification_id , items_id ,uom,  whid ,binid ,subbinid, ups_from, qty_from, ups_to, qty_to, balups, balqty, rowid) values('$mainid', '$classid', '$itemid1', '$txtuom1', '$whid3', '$binid3', '$subbinid3', '$oups', '$oqty', '$ups3', '$qty3', '$balup3', '$balqt3', '$orwoid')";
 mysql_query($sql_in) or die(mysql_error());
}

}
}
?>

<?php 
$trid=$mainid;
//exit;
?>


<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Stock in Hand</td>
  <td colspan="4" align="center" valign="middle" class="tblheading">Transfered to</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  <td width="20" colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="14" align="center" valign="middle" class="tblheading">#</td>
<td width="95" align="center" valign="middle" class="tblheading">Classification</td>
<td width="211" align="center" valign="middle" class="tblheading">Item</td>
<td width="69" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="210" align="center" valign="middle" class="tblheading">Item</td>
<td width="69" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$classid."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);
$classid1=$row_class['classification'];
$c=$row_class['classification_id'];
$sql_item=mysql_query("select * from tbl_stores where items_id='".$itemid."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
$itemid1=$row_item['stores_item'];
$f=$row_item['items_id'];

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
 
 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";


$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $classid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh1=""; $binn1=""; $subbinn1=""; $sups1="";$sqty1=""; $slocs1=""; $gd1=""; $balu=0; $balq=0; $subrid=""; $itemid2=""; $slups1=""; $slqty1="";
$sql_sloc=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$row_issuetbl['stlg_id']."'") or die(mysql_error());
$zzz=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{ 

$slups1=0; $slqty1=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['iitrsub_id']; else $subrid=$row_sloc['iitrsub_id'];

$sql_item2=mysql_query("select * from tbl_stores where items_id='".$row_sloc['items_id']."'") or die(mysql_error());
$row_item2=mysql_fetch_array($sql_item2);
$itemid2=$row_item2['stores_item'];

//echo $row_sloc['whid']; echo $row_sloc['binid']; echo $row_sloc['subbinid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

if($slocs1!="")
$slocs1=$slocs1.$wareh1.$binn1.$subbinn1."<br/>";
else
$slocs1=$wareh1.$binn1.$subbinn1."<br/>";

$slups1=$slups1+$row_sloc['ups_to'];
if($sups1!="")
$sups1=$sups1.$slups1."<br/>";
else
$sups1=$slups1."<br/>";

$slqty1=$slqty1+$row_sloc['qty_to'];
if($sqty1!="")
$sqty1=$sqty1.$slqty1."<br/>";
else
$sqty1=$slqty1."<br/>";

$balu=$balu+$slups1;
$balq=$balq+$slqty1;
}
$balu=$row_issuetbl['stlg_balups']-$balu; 
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu <= 0){ if($balq <=0 ){$balu=0;} else{ $balu=1;}}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $itemid2;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($zzz>0 && $subrid!="") { ?><img src="../images/edit.png" border="0" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $row_issue1[0]?>','<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>')" /><?php } else {?><input type="radio" name="sloc_select" value="<?php echo $row_issue1[0]?>" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $classid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $itemid1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?></td>
<?php
$wareh1=""; $binn1=""; $subbinn1=""; $sups1="";$sqty1=0; $slocs1=""; $gd1=""; $balu=0; $balq=0; $subrid="";$itemid2="";$slups1="";$slqty1="";
$sql_sloc=mysql_query("select * from tbl_iitr_sub where iitr_id='".$trid."' and rowid='".$row_issuetbl['stlg_id']."'") or die(mysql_error());
$zzz=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{
$slups1=0; $slqty1=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['iitrsub_id']; else $subrid=$row_sloc['iitrsub_id'];

$sql_item2=mysql_query("select * from tbl_stores where items_id='".$row_sloc['items_id']."'") or die(mysql_error());
$row_item2=mysql_fetch_array($sql_item2);
$itemid2=$row_item2['stores_item'];


$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";


$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

if($slocs1!="")
$slocs1=$slocs1.$wareh1.$binn1.$subbinn1."<br/>";
else
$slocs1=$wareh1.$binn1.$subbinn1."<br/>";

$slups1=$slups1+$row_sloc['ups_to'];
if($sups1!="")
$sups1=$sups1.$slups1."<br/>";
else
$sups1=$slups1."<br/>";

$slqty1=$slqty1+$row_sloc['qty_to'];
if($sqty1!="")
$sqty1=$sqty1.$slqty1."<br/>";
else
$sqty1=$slqty1."<br/>";

$balu=$balu+$slups1;
$balq=$balq+$slqty1;
}
$balu=$row_issuetbl['stlg_balups']-$balu; 
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0){ if($balq <=0 ){$balu=0;} else{ $balu=1;}}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $itemid2;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($zzz>0 && $subrid!="") { ?><img src="../images/edit.png" border="0" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $row_issue1[0]?>','<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>')" /><?php } else {?><input type="radio" name="sloc_select" value="<?php echo $row_issue1[0]?>" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } ?></td>
 </tr>
 <?php
 }
 $srno++;
 }
 } 
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orowid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" />
<br />
<div id="subdiv">
<div id="sloc1" style="display:none">
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="7" align="center" class="tblheading">Transfer to&nbsp;</td>
  </tr>
<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where classification_id='".$c."' and items_id!='".$f."'") or die(mysql_error());
?>            
<tr class="Light" height="30" id="vitem">
<td width="215" align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td width="397" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem1" style="width:230px;" onchange="classchk1(this.value);" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;</td>
		
<td width="54" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="224" colspan="3" align="left" valign="middle" class="tbltext" id="uom1">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>
<div id="subsubdiv" style="display:block">
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td width="38" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
  <td colspan="5" align="center" valign="middle" class="tblheading">SLOC</td>
  <td width="310" colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">Transfer Quantity</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="92" align="center" valign="middle" class="tblheading">WH</td>
<td width="90" align="center" valign="middle" class="tblheading">Bin</td>
<td width="109" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="90" align="center" valign="middle" class="tblheading">UPS</td>
<td width="105" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div></div>