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
	//$yearid_id="09-10";
	//$logid=22;
	//$name="Ram";
	
if(isset($_GET['code']))
	{
	$code = $_GET['code'];	 
	}
if(isset($_GET['txtcode']))
	{
	$code1 = $_GET['txtcode'];	 
	}
if(isset($_GET['txtdate']))
	{
	$trdate = $_GET['txtdate'];	 
	}
if(isset($_GET['txtuom']))
	{
	$txtuom = $_GET['txtuom'];	 
	}
if(isset($_GET['chkbox']))
	{
	$chkbox = $_GET['chkbox'];	 
	}
if(isset($_GET['srno1']))
	{
	$srno1 = $_GET['srno1'];	 
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
		

if(isset($_GET['txt12']))
	{
	$pname = $_GET['txt12'];	 
	}
 if(isset($_GET['txtdrno']))
	{
	$txtdrno = $_GET['txtdrno'];	 
	}
			
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
if(isset($_GET['txt1']))
	{
	$txt1 = $_GET['txt1'];	 
	}
if(isset($_GET['txt13']))
	{
	$txt13 = $_GET['txt13'];	 
	}
if(isset($_GET['txtdc']))
	{
	$m = $_GET['txtdc'];	 
	}
if(isset($_GET['txtpname']))
	{
	$pname = $_GET['txtpname'];	 
	}
if(isset($_GET['txtrettype']))
	{
	$txtrettype = $_GET['txtrettype'];	 
	}
 if(isset($_GET['txtparty']))
	{
	$party = $_GET['txtparty'];	 
	}
			
if(isset($_GET['txt']))
	{
	$type = $_GET['txt'];	 
	}
if(isset($_GET['txtappli']))
	{
	$txtappli = $_GET['txtappli'];	 
	}
if(isset($_GET['txt12']))
	{
	$txt12 = $_GET['txt12'];	 
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
if(isset($_GET['txtphone']))
	{
	$txtphone = $_GET['txtphone'];	 
	}
//frm_action=submit&txt11=&txt14=&txt15=&txt13=&txt=&code=72&logid=&txtappli=Not%20Applicable&rettyp=&txt1=&txtid=DC72&date=02-07-2009&txtdrno=fghjf&txtpname=jfgh&txtaddress=jfgj&txtmode=Not%20Applicable&txttname=&txtlrn=&txtvn=&txt13=--Select%20Mode--&txtcname=&txtdc=&txtpname=&txtclass=75&txtitem=116&txtuom=Number&txtrettype=damage&txtrettyp=damage&slocissue=17&upsavl_1=90&qtyavl_1=50&issueups_1=1&issueqty_1=10&balups_1=89&balqty_1=40&upsavl_2=8&qtyavl_2=84&issueups_2=&issueqty_2=&balups_2=&balqty_2=&upsavl_3=12&qtyavl_3=15&issueups_3=&issueqty_3=&balups_3=&balqty_3=&srno=4&chkbox=17&srno1=1&remarks=

		
			
		$tdate=$trdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;	
		
		$p1_array=explode(",",$chkbox);	
		$p1_array1=explode(",",$srno1);	
		$numrec=count($p1_array1);
		
if($trid == 0)
{
$sql_in1="insert into tbl_discard(tcode, tdate, drno, party_name, address, tmode, tname, lrno, vno, cname, dcno, pmode , pname, remarks, rettyp,phoneno, yearcode, ddrole) values ('$code', '$tdate', '$drno', '$party', '$txtaddress', '$txt1', '$i', '$j', '$k','$l','$m','$txt13', '$pname', '$txtremarks', '$rettyp', '$txtphone', '$yearid_id', '$logid')";

if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=mysql_insert_id();
//exit;
  $sql_sub="insert into tbl_discard_sub(did_s, calssification_id, items_id, uom, remark, type )values('$mainid','$classid','$itemid','$txtuom','$txtremarks','$rettyp')";

if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();
$totups=0; $totqty=0;
for($num=0; $num<$numrec; $num++)
{
	$p1_array[$num];
	$p1_array1[$num];
$sql_itmldg=mysql_query("select stld_balups, stld_balqty, stld_id, stld_whid, stld_binid, stld_subbinid from tbl_stldg_damage where stld_id='".$p1_array[$num]."'") or die(mysql_error());
$row_itmldg=mysql_fetch_array($sql_itmldg);
$balu=$row_itmldg['stld_balups'];
$balq=$row_itmldg['stld_balqty'];
$whid=$row_itmldg['stld_whid'];
$binid=$row_itmldg['stld_binid'];
$subbinid=$row_itmldg['stld_subbinid'];

$ups="issueups_".$p1_array1[$num];
$qty="issueqty_".$p1_array1[$num];
$balups="balups_".$p1_array1[$num];
$balqty="balqty_".$p1_array1[$num]; 

if(isset($_GET[$ups]))
	{
	$ups1 = $_GET[$ups];	 
	}	
if(isset($_GET[$qty]))
	{
	$qty1 = $_GET[$qty];	 
	}	
if(isset($_GET[$balups]))
	{
	$balups1 = $_GET[$balups];	 
	}	
if(isset($_GET[$balqty]))
	{
	$balqty1 = $_GET[$balqty];	 
	}	

$totups=$totups+$ups1;
$totqty=$totqty+$qty1;
$rowid=$p1_array[$num];
$sql_sub_sub="insert into tbl_discard_sloc(discard_type, discard_trid, discard_id, classification_id, item_id, whid, binid, subbin, qty_discard, ups_discard, qty_balance, ups_balance, discard_rowid, eid) values('MD', '$mainid', '$subid', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$qty1', '$ups1', '$balqty1', '$balups1', '$rowid', '$rid')";

mysql_query($sql_sub_sub) or die(mysql_error());
}
$sql_sub_update="update tbl_discard_sub set ups='$totups', qty='$totqty' where did='$subid'";
mysql_query($sql_sub_update) or die(mysql_error());

}
}
$trid=$mainid;
}
else
{
$mainid=$trid;

 $sql_sub="update tbl_discard set tcode='$code' , tdate='$tdate' , drno='$drno', party_name='$party', address='$txtaddress' , tmode='$txt1' , tname='$i', lrno='$j' , vno='$k' , cname='$l' , dcno='$m', pmode='$txt13', pname='$pname', remarks='$txtremarks', rettyp='$rettyp', phoneno='$txtphone', yearcode='$yearid_id', ddrole='$logid' where tid='$mainid'";
 
 if(mysql_query($sql_sub) or die(mysql_error()))
{

  $sql_sub="insert into tbl_discard_sub(did_s, calssification_id, items_id, uom, remark, type )values('$mainid','$classid','$itemid','$txtuom','$txtremarks','$rettyp')";

if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();
$totups=0; $totqty=0;
for($num=0; $num<$numrec; $num++)
{
	$p1_array[$num];
	$p1_array1[$num];
$sql_itmldg=mysql_query("select stld_balups, stld_balqty, stld_id, stld_whid, stld_binid, stld_subbinid from tbl_stldg_damage where stld_id='".$p1_array[$num]."'") or die(mysql_error());
$row_itmldg=mysql_fetch_array($sql_itmldg);
$balu=$row_itmldg['stld_balups'];
$balq=$row_itmldg['stld_balqty'];
$whid=$row_itmldg['stld_whid'];
$binid=$row_itmldg['stld_binid'];
$subbinid=$row_itmldg['stld_subbinid'];

$ups="issueups_".$p1_array1[$num];
$qty="issueqty_".$p1_array1[$num];
$balups="balups_".$p1_array1[$num];
$balqty="balqty_".$p1_array1[$num]; 

if(isset($_GET[$ups]))
	{
	$ups1 = $_GET[$ups];	 
	}	
if(isset($_GET[$qty]))
	{
	$qty1 = $_GET[$qty];	 
	}	
if(isset($_GET[$balups]))
	{
	$balups1 = $_GET[$balups];	 
	}	
if(isset($_GET[$balqty]))
	{
	$balqty1 = $_GET[$balqty];	 
	}	

$totups=$totups+$ups1;
$totqty=$totqty+$qty1;
$rowid=$p1_array[$num];
$sql_sub_sub="insert into tbl_discard_sloc(discard_type, discard_trid, discard_id, classification_id, item_id, whid, binid, subbin, qty_discard, ups_discard, qty_balance, ups_balance, discard_rowid, eid) values('MD', '$mainid', '$subid', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$qty1', '$ups1', '$balqty1', '$balups1', '$rowid', '$rid')";

mysql_query($sql_sub_sub) or die(mysql_error());
}
$sql_sub_update="update tbl_discard_sub set ups='$totups', qty='$totqty' where did='$subid'";
mysql_query($sql_sub_update) or die(mysql_error());
}
}
}
?>

<?php 
 $tid=$mainid
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">

			<tr class="tblsubtitle">
			  <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
			  <td width="24%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Stock</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
                    <td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
                  	<td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysql_query("select * from tbl_discard_sub where did_s=$tid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['items_id'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['items_id'].",";
	}
	
	
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['calssification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select * from tbl_stores where items_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tbl_discard_sloc where discard_trid='".$trid."' and classification_id='".$row_eindent_sub['calssification_id']."' and item_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tblissue);
$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; 

while($row_tblissue=mysql_fetch_array($sql_tblissue))
{


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

$slups=$slups+$row_tblissue['ups_discard'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_tblissue['qty_discard'];
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

$sql_stldg1=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_tblissue['discard_rowid']."'") or die(mysql_error());
$row_stldg1=mysql_fetch_array($sql_stldg1); 

$opups=$opups+$row_stldg1['stld_balups'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$opqty+$row_stldg1['stld_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['discard_id'];
}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $$opqty1=""; $erid=0;
}
if($sr%2!=0)
{
?>		  
 <tr class="Light" height="20">
             <td width="4%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="17%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['classification'];?></td>
             <td width="24%" align="center" valign="middle" class="tbltext"><?php echo $noticia_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $noticia_item['uom'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $opqty;?></td>
		     <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $slups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $slqty;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balups;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty;?></td>
             <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['did_s'];?>,<?php echo $row_eindent_sub['did'];?>,'DD');" /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />

<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="4%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="17%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['classification'];?></td>
             <td width="24%" align="center" valign="middle" class="tbltext"><?php echo $noticia_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $noticia_item['uom'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $opqty;?></td>
			 <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $slups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $slqty;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balups;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty;?></td>
             <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['did_s'];?>,<?php echo $row_eindent_sub['did'];?>,'DD');" /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<div id="subsubdiv" style="display:block">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>		
		
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
<tr class="Dark" height="25">
   <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select><font color="#FF0000">*</font>
	</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="169"  align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />	
 <tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="0" maxlength="5" onchange="piupschk();" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="169"  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex="0" maxlength="7" onchange="piqtychk(this.value);" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    </tr>
		 
</table><input name="txtrettype" value="good" type="hidden"><input name="txtrettyp" value="good" type="hidden"> 
<div id="subdiv" style="display:block">	
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
 </table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div></div>