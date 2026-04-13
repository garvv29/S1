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

if(isset($_GET['code']))
	{
	$code = $_GET['code'];	 
	}
if(isset($_GET['txtid']))
	{
	$code1 = $_GET['txtid'];	 
	}
if(isset($_GET['txtdate']))
	{
	$trdate = $_GET['txtdate'];	 
	}
if(isset($_GET['indentno']))
	{
	$indentno = $_GET['indentno'];	 
	}
if(isset($_GET['raisedby']))
	{
	$raisedby = $_GET['raisedby'];	 
	}
if(isset($_GET['indentdate']))
	{
	$indentdate = $_GET['indentdate'];	 
	}
if(isset($_GET['txtups']))
	{
	$txtups = $_GET['txtups'];	 
	}
if(isset($_GET['txtqty']))
	{
	$txtqty = $_GET['txtqty'];	 
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
if(isset($_GET['tid']))
	{
	$tid = $_GET['tid'];	 
	}
if(isset($_GET['classid']))
	{
	$classid = $_GET['classid'];	 
	}
if(isset($_GET['itemid']))
	{
	$itemid = $_GET['itemid'];	 
	}	
if(isset($_GET['rid']))
	{
	$rid = $_GET['rid'];	 
	}
if(isset($_GET['txtremarks']))
	{
	$remarks = $_GET['txtremarks'];	 
	}

if(isset($_GET['edtrowid']))
	{
	$edtrowid = $_GET['edtrowid'];	 
	}
	
		$tdate=$trdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		$sdate=$indentdate;
		$sday=substr($sdate,0,2);
		$smonth=substr($sdate,3,2);
		$syear=substr($sdate,6,4);
		$sdate=$syear."-".$smonth."-".$sday;
	
		$p1_array=explode(",",$chkbox);	
		$p1_array1=explode(",",$srno1);	
		$numrec=count($p1_array);
		

if($trid == 0)
{
$sql_main="insert into tblissue (issue_type, issue_code, issue_date, dcrefno, yearcode, remarks, issue_role) values('eindent','$code','$tdate','$indentno','$yearid_id','$remarks','$logid')";

if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=mysql_insert_id();

$sql_sub="insert into tblissue_sub (issue_id, classification_id, item_id, ups_indent, qty_indent, uom) values('$mainid','$classid','$itemid','$txtups','$txtqty','$txtuom')";
if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();
for($num=0; $num<$numrec; $num++)
{
	$p1_array[$num];
	$p1_array1[$num];
$sql_itmldg=mysql_query("select stlg_balups, stlg_balqty, stlg_id, stlg_whid, stlg_binid, stlg_subbinid from tbl_stldg_good where stlg_id='".$p1_array[$num]."'") or die(mysql_error());
$row_itmldg=mysql_fetch_array($sql_itmldg);
$balu=$row_itmldg['stlg_balups'];
$balq=$row_itmldg['stlg_balqty'];
$whid=$row_itmldg['stlg_whid'];
$binid=$row_itmldg['stlg_binid'];
$subbinid=$row_itmldg['stlg_subbinid'];

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

$rowid=$p1_array[$num];
$sql_sub_sub="insert into tblissue_sloc (issue_type, issue_tr_id, issue_id, classification_id, item_id, whid, binid, subbin, qty_issue, ups_issue, qty_balance, ups_balance, issue_rowid, eid) values('eindent','$mainid','$subid','$classid','$itemid','$whid','$binid','$subbinid','$qty1','$ups1','$balqty1','$balups1','$rowid','$rid')";

mysql_query($sql_sub_sub) or die(mysql_error());
}
}
}
$trid=$mainid;
}
else
{
$mainid=$trid;

$subid=$edtrowid;

$s_sub_sub="delete from tblissue_sloc where issue_id='".$subid."'";
mysql_query($s_sub_sub) or die(mysql_error());

for($num=0; $num<$numrec; $num++)
{
	$p1_array[$num];
	$p1_array1[$num];
$sql_itmldg=mysql_query("select stlg_balups, stlg_balqty, stlg_id, stlg_whid, stlg_binid, stlg_subbinid from tbl_stldg_good where stlg_id='".$p1_array[$num]."'") or die(mysql_error());
$row_itmldg=mysql_fetch_array($sql_itmldg);
$balu=$row_itmldg['stlg_balups'];
$balq=$row_itmldg['stlg_balqty'];
$whid=$row_itmldg['stlg_whid'];
$binid=$row_itmldg['stlg_binid'];
$subbinid=$row_itmldg['stlg_subbinid'];

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

$rowid=$p1_array[$num];
$sql_sub_sub="insert into tblissue_sloc (issue_type, issue_tr_id, issue_id, classification_id, item_id, whid, binid, subbin, qty_issue, ups_issue, qty_balance, ups_balance, issue_rowid, eid) values('eindent','$mainid','$subid','$classid','$itemid','$whid','$binid','$subbinid','$qty1','$ups1','$balqty1','$balups1','$rowid','$rid')";

mysql_query($sql_sub_sub) or die(mysql_error());

}
}

$sql1=mysql_query("select * from tbl_ieindent where tid=$tid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
?>
<!-- OUTPUT TRANSACTION ID FOR JAVASCRIPT TO UPDATE HIDDEN FIELD -->
<div style="display:none;" id="transaction_id_output">
TRANSACTION_ID:<?php echo $mainid; ?>:END_TRANSACTION_ID
</div>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="13%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			    <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">As Per Indent Qty</td>
			     <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock</td>
                  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Issue</td>
               <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              </tr>
			<tr class="tblsubtitle">
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
					 <td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
                   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$sr=1;
$sql_eindent_sub=mysql_query("select * from tbl_ieindent_sub where id_in=$tid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);
$t_stldg1=0;
if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tblissue_sloc where issue_tr_id='".$trid."' and classification_id='".$row_eindent_sub['classification_id']."' and item_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tblissue);
$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; $t_stldg1=0;

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

$slups=$slups+$row_tblissue['ups_issue'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_tblissue['qty_issue'];
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

$sql_stldg1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tblissue['issue_rowid']."'") or die(mysql_error());
$row_stldg1=mysql_fetch_array($sql_stldg1); 
$t_stldg1=mysql_num_rows($sql_stldg1);

$opups=$opups+$row_stldg1['stlg_balups'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$opqty+$row_stldg1['stlg_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['issue_id'];


}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $$opqty1=""; $erid=0;
}


if($sr%2!=0)
{
?>
<tr class="Dark" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="5%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty']?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $opups;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php if($t_stldg1!=0){ ?><?php echo $opqty;?><?php }else{ ?> <?php } ?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slqty;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balqty;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="tbltext" align="center"><?php if($t_stldg1==0){ ?><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['eid'];?>);" /><?php } else { ?><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /><?php } ?></td>
  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
<?php
}
else
{
?>			  
<tr class="Light" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="5%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty']?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $opups;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php if($t_stldg1!=0){ ?><?php echo $opqty;?><?php }else{ ?> <?php } ?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slqty;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balqty;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="tbltext" align="center"><?php if($t_stldg1==0){ ?><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['eid'];?>);" /><?php } else { ?><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /><?php } ?></td>
  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="25">
<td width="102" align="right"  valign="middle" class="tblheading">&nbsp;Indent Remarks&nbsp;</td>
<td width="742" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks']?></td>
</tr>
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<div id="subdiv">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >

<tr class="Light" height="30">
<td width="132" align="right" valign="middle" class="tblheading">Classification&nbsp;</td>
      <td width="341"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid" type="text" size="35" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" /><input type="hidden" name="classid" value="" /></td>

<td width="92" align="right" valign="middle" class="tblheading">Items&nbsp;</td>
      <td width="275" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid" type="text" size="35" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" />&nbsp;<input type="hidden" name="itemid" value="" /> </td>

</tr>

<tr class="Light" height="30">

<td width="132" align="right" valign="middle" class="tblheading">&nbsp;UoM&nbsp;</td>
      <td width="341"  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtid" type="text" size="10" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" /></td>
<td align="right" valign="middle" class="tblheading">Quantity&nbsp;</td>
      <td  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtid" type="text" size="5" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" /></td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">

 <td colspan="4" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading">Select</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
 
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/next.gif" border="0"style="display:inline;cursor:hand;"  onclick="pform();" /></td>
</tr>
</table>
</div>