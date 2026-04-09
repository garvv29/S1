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

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields

if(isset($_GET['txt11']))
	{
	$a = $_GET['txt11'];	 
	}
	if(isset($_GET['txt14']))
	{
	$b = $_GET['txt14'];	 
	}
	if(isset($_GET['txtid']))
	{
	$c = $_GET['txtid'];	 
	}
	if(isset($_GET['txtid1']))
	{
	$d = $_GET['txtid1'];	 
	}
	if(isset($_GET['date']))
	{
	$e = $_GET['date'];	 
	}
	if(isset($_GET['txtcla']))
	{
	$f = $_GET['txtcla'];	 
	}
	if(isset($_GET['txtdcno']))
	{
	$g = $_GET['txtdcno'];	 
	}
	if(isset($_GET['txtporn']))
	{
	$h = $_GET['txtporn'];	 
	}
	if(isset($_GET['txttname']))
	{
	$i = $_GET['txttname'];	 
	}
	if(isset($_GET['txtlrn']))
	{
	$j = $_GET['txtlrn'];	 
	}
	if(isset($_GET['txtvn']))
	{
	$k = $_GET['txtvn'];	 
	}
	if(isset($_GET['txtcname']))
	{
	$l= $_GET['txtcname'];	 
	}
	if(isset($_GET['txtdc']))
	{
	$m = $_GET['txtdc'];	 
	}
	
//			End of Main table fields	
	
	
//			2nd table fields start

	
	if(isset($_GET['txtclass']))
	{
	$n = $_GET['txtclass'];	 
	}
	if(isset($_GET['txtitem']))
	{
	$o = $_GET['txtitem'];	 
	}
	if(isset($_GET['txtqtydc']))
	{
	$p = $_GET['txtqtydc'];	 
	}
	if(isset($_GET['txtupsdc']))
	{
	$q = $_GET['txtupsdc'];	 
	}
	if(isset($_GET['txtupsg']))
	{
	$r = $_GET['txtupsg'];	 
	}
	if(isset($_GET['txtqtyg']))
	{
	$s = $_GET['txtqtyg'];	 
	}
	if(isset($_GET['txtqtyd']))
	{
	$t = $_GET['txtqtyd'];	 
	}
	if(isset($_GET['txtupsd']))
	{
	$u = $_GET['txtupsd'];	 
	}
	if(isset($_GET['txtexshqty']))
	{
	$v = $_GET['txtexshqty'];	 
	}
	if(isset($_GET['txtexshups']))
	{
	$w = $_GET['txtexshups'];	 
	}
	if(isset($_GET['tblslocnog']))
	{
	$x = $_GET['tblslocnog'];	 
	}

//		end 2nd table fields


// start of 3rd table fields
	
	if(isset($_GET['txtwhslg1']))
	{
	$y = $_GET['txtwhslg1'];	 
	}
	if(isset($_GET['txtbinslg1']))
	{
	$z = $_GET['txtbinslg1'];	 
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$a1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$b1 = $_GET['txtslqtyg1'];	 
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
	if(isset($_GET['txtslupsg3']))
	{
	$m1 = $_GET['txtslupsg3'];	 
	}
	
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
	
//		end of 3rd table fields

//		start of 2nd table fields	
	if(isset($_GET['txtremarks']))
	{
	$y1 = $_GET['txtremarks'];	 
	}
	
// 		end of 2nd table fields


//		main field for the query i.e. if its is 0 then insert query should run & insblock should be replaced else the query should be update query & updblock should be replaced.
	
	if(isset($_GET['maintrid']))
	{
	$z1 = $_GET['maintrid'];	 
	}

	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}
	
	if(isset($_GET['txtpname']))
	{
	$pname = $_GET['txtpname'];	 
	}

//frm_action=submit&txt11=&txt14=&txtid=19&txtid1=AV19&date=15-05-2009&txtcla=--Select%20Vendor--&txtdcno=&txtporn=&txttname=&txtlrn=&txtvn=&txtcname=&txtdc=&txtclass=--Select%20Classification--&txtitem=--Select%20Item--&txtqtydc=&txtupsdc=&txtupsg=&txtqtyg=&txtqtyd=&txtupsd=&txtexshqty=&txtexshups=&tblslocnog=--Bin--&txtwhslg1=-WH--&txtbinslg1=--Bin--&txtslsubbg1=--Sub%20Bin--&txtslqtyg1=&txtslupsg1=&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20in--&txtslqtyg2=&txtslupsg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslqtyg3=&txtslupsg3=&tblslocnod=--Bin-&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin-&txtslqtyd1=&txtslupsd1=&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubd2=--Sub%20Bin--&txtslqtyd2=&txtslupsd2=&txtremarks=&maintrid=0
//echo $a; echo $b; exit;
	
	
		$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
if($z1 == 0)
{
$sql_main="insert into tblarrival (arrival_type, arrival_code, arrival_date, stno, party_id,  tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, courier_name, docket_no, remarks, arr_role) values('Stock & Transfer','$c','$tdate','$g','$f','$h','$a','$i','$j','$k','$l','$m','$n','$y1','$logid')";

if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=mysql_insert_id();

$sql_sub="insert into tblarrival_sub (arrival_id, classification_id, item_id, qty_per_dc, ups_per_dc, qty_good, ups_good, qty_damage, ups_damage, exsh_qty, exsh_ups, noofbin_good, noofbin_damage) values('$mainid','$n','$o','$p','$q','$s','$r','$t','$u','$v','$w','$x','$n1')";
if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();
for($num=0; $num<$x; $num++)
{
if($num==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$y','$z','$a1','$b1','$c1','0','0')";
}
if($num==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$d1','$e1','$f1','$g1','$h1','0','0')";
}
if($num==2)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$i1','$j1','$k1','$l1','$m1','0','0')";
}
mysql_query($sql_sub_sub) or die(mysql_error());
}

for($num1=0; $num1<$n1; $num1++)
{
if($num1==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$o1','$p1','$q1','0','0','$r1','$s1')";
}
if($num1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$t1','$u1','$v1','0','0','$w1','$x1')";
}
mysql_query($sql_sub_sub) or die(mysql_error());
}
}
}
$z1=$mainid;
}
else
{
$sql_main="update tblarrival set arrival_type='Stock & Transfer', arrival_code='$c', arrival_date='$tdate', stno='$g', party_id='$f', tmode='$a', trans_name='$i', trans_lorryrepno='$j', trans_vehno='$k', trans_paymode='$l', courier_name='$m', docket_no='$n', remarks='$y1', arr_role='$logid' where arrival_id = '$z1'";

if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=$z1;

$sql_sub="insert into tblarrival_sub (arrival_id, classification_id, item_id, qty_per_dc, ups_per_dc, qty_good, ups_good, qty_damage, ups_damage, exsh_qty, exsh_ups, noofbin_good, noofbin_damage) values('$mainid','$n','$o','$p','$q','$s','$r','$t','$u','$v','$w','$x','$n1')";
if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();
for($num=0; $num<$x; $num++)
{
if($num==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$y','$z','$a1','$b1','$c1','0','0')";
}
if($num==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$d1','$e1','$f1','$g1','$h1','0','0')";
}
if($num==2)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$i1','$j1','$k1','$l1','$m1','0','0')";
}
mysql_query($sql_sub_sub) or die(mysql_error());
}

for($num1=0; $num1<$n1; $num1++)
{
if($num1==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$o1','$p1','$q1','0','0','$r1','$s1')";
}
if($num1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$t1','$u1','$v1','0','0','$w1','$x1')";
}
mysql_query($sql_sub_sub) or die(mysql_error());
}

}
}
}
	
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php
$tid=$z1;
?>
<?php
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Stock & Transfer' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());

?>
			 <tr class="tblsubtitle" height="20">
              <td width="1%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">UoM</td>
                <td colspan="8"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="4" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
             
              <td width="3%" rowspan="3" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			<tr class="tblsubtitle">
			  <td colspan="2" align="center" valign="middle" class="tblheading">DC</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Good</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Excess/<br />
Shortage</td>
			  </tr>
			<tr class="tblsubtitle">
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
					<td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
					<td width="2%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="6%" align="center" valign="middle" class="tblheading">Bin</td>
                    <td width="3%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['item_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);
?>			  
 <tr class="Light" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="20%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_qty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";
}
?>			 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			 
			 <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:hand;" /></td>
 		     <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  /></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="20%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_qty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysql_query("select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty_good']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";
}
?>			 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
			 
			 <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:hand;" /></td>
 		     <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  /></td>
 </tr> 
<?php
}
$srno++;
}
}
?>  			  
          </table>
		  <br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification  order by classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="181"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select><font color="#FF0000">*</font>
	</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores ") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>--Select Item--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void();" onclick="openslocpop();">SLOC Lookup</a></td>
		
<td width="165" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="133" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS as per D.C&nbsp;</td>
<td width="361" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Quantitiy as per D.C&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex=""   maxlength="7" onchange="upsdcchk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS Good&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsg" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onchange="upschk(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Quantity Good&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyg" type="text" size="10" class="tbltext" tabindex=""  / maxlength="7" onchange="qtychk(this.value);">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS Damage&nbsp;</td>
<td width="361" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onchange="upschk1(this.value);"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Quantity Damage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onchange="qtychk1(this.value);"  />&nbsp;</td>
</tr>

 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Excess/Shortage UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtexshups" type="text" size="10" class="tbltext" tabindex="" maxlength="5" readonly="true" style="background-color:#CCCCCC"  /></td>
<td align="right"  valign="middle" class="tblheading">Excess/Shortage Quantity&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
</table>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">SLOC > Good Item > No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="tblslocnog" style="width:60px;" onchange="bingood(this.value);" >
<option value="">--Bin--</option>
<option value="1" >1</option>
<option value="2" >2</option>
<option value="3" >3</option>   
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div  id="gsloc1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<?php
$whg1_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<tr class="Light" height="30" >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtwhslg1" style="width:60px;" onchange="wh1(this.value);"  >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg1 = mysql_fetch_array($whg1_query)) { ?>
		<option value="<?php echo $noticia_whg1['whid'];?>" />   
		<?php echo $noticia_whg1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtbinslg1" style="width:60px;" onchange="bin1(this.value);" >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$subbing1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:60px;" onchange="subbin1(this.value);"  >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="300"  valign="middle">
<div id="slocrow1">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="upsf1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
$whg2_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div id="gsloc2" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="61" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:60px;" onchange="wh2(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg2 = mysql_fetch_array($whg2_query)) { ?>
		<option value="<?php echo $noticia_whg2['whid'];?>" />   
		<?php echo $noticia_whg2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="55" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="105" align="left"  valign="middle" class="tbltext" id="bing2">&nbsp;<select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="97" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="97" align="left"  valign="middle" class="tbltext" id="sbing2">&nbsp;<select class="tbltext" name="txtslsubbg2" style="width:60px;" onchange="subbin2(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="300"  valign="middle">
<div id="slocrow2">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		
<td width="48" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="upsf2(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf2(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
$whg3_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div  id="gsloc3" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:60px;" onchange="wh3(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whg3 = mysql_fetch_array($whg3_query)) { ?>
		<option value="<?php echo $noticia_whg3['whid'];?>" />   
		<?php echo $noticia_whg3['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bing3_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bing3">&nbsp;<select class="tbltext" name="txtslbing3" style="width:60px;" onchange="bin3(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbing3_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbing3">&nbsp;<select class="tbltext" name="txtslsubbg3" style="width:60px;" onchange="subbin3(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="305"  valign="middle">
<div id="slocrow3">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
		

<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="upsf3(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf3(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>

<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
 <tr class="Dark" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">SLOC > Damage Item > No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="tblslocnod" style="width:60px;" onchange="bindamage(this.value);" >
<option value="">--Bin--</option>
<option value="1" >1</option>
<option value="2" >2</option>
</select>&nbsp;</td>
</tr>
</table>
<?php
$whd1_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div  id="dsloc1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30"  >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd1" style="width:60px;" onchange="wh4(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd1 = mysql_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind1_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bind1">&nbsp;<select class="tbltext" name="txtslbind1" style="width:60px;" onchange="bin4(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind1_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbind1">&nbsp;<select class="tbltext" name="txtslsubbd1" style="width:60px;" onchange="subbin4(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="305"  valign="middle">
<div id="slocrow4">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
				
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd1" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  onchange="upsf4(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf4(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<?php
$whd2_query=mysql_query("select whid, perticulars from tbl_warehouse") or die(mysql_error());
?>
<div id="dsloc2" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30" >
<td width="62" align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd2" style="width:60px;" onchange="wh5(this.value);" >
<option value="" selected>--WH--</option>
	<?php while($noticia_whd2 = mysql_fetch_array($whd2_query)) { ?>
		<option value="<?php echo $noticia_whd2['whid'];?>" />   
		<?php echo $noticia_whd2['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$bind2_query=mysql_query("select binid, binname from tbl_bin") or die(mysql_error());
?>
<td width="56" align="right"  valign="middle" class="tblheading">&nbsp;Bin No &nbsp;</td>
<td width="107" align="left"  valign="middle" class="tbltext" id="bind2">&nbsp;<select class="tbltext" name="txtslbind2" style="width:60px;" onchange="bin5(this.value);"  >
<option value="" selected>--Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
$subbind2_query=mysql_query("select sid, sname from tbl_subbin") or die(mysql_error());
?>	
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Sub Bin No &nbsp;</td>
<td width="99" align="left"  valign="middle" class="tbltext" id="sbind2">&nbsp;<select class="tbltext" name="txtslsubbd2" style="width:60px;" onchange="subbin5(this.value);" >
<option value="" selected>--Sub Bin--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="305"  valign="middle">
<div id="slocrow5">
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		<tr>
						
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  onchange="upsf5(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf5(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<?php echo $tid; ?>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>