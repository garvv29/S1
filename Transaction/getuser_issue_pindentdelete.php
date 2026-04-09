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

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
	
$s_sub="delete from tblissue_sub where issuesub_id='".$b."'";
mysql_query($s_sub) or die(mysql_error());
$s_sub_sub="delete from tblissue_sloc where issue_id='".$b."'";
mysql_query($s_sub_sub) or die(mysql_error());

$sql_t_sub=mysql_query("select * from tblissue_sub where issue_id='".$a."'") or die(mysql_error());
$tot_sub=mysql_num_rows($sql_t_sub);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="13%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			    <td colspan="2" height="23" align="center" valign="middle" class="tblheading">As Per Indent </td>
			     <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock</td>
                  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Issue</td>
               <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			<tr class="tblsubtitle">
                   <td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
					 <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
                     <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
			  <?php
if($tot_sub > 0)
$trid=$a;
else
$trid=0;
?>
<?php
$sr=1;  $itmdchk="";
$sql_eindent_sub=mysql_query("select * from tblissue_sub where issue_id=$trid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['item_id'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['item_id'].",";
	}


$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row_eindent_sub['item_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tblissue_sloc where issue_tr_id='".$trid."' and classification_id='".$row_eindent_sub['classification_id']."' and item_id='".$row_eindent_sub['item_id']."'") or die(mysql_error());
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
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['ups_indent']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty_indent']?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $opups;?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php echo $opqty;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $balups;?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
              <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:hand;" onclick="editrec(<?php echo $row_eindent_sub['issuesub_id'];?>)" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['issue_id'];?>,<?php echo $row_eindent_sub['issuesub_id'];?>,'pindent');" /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['issuesub_id'];?>" />
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
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['ups_indent']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty_indent']?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $opups;?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php echo $opqty;?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $slups;?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $slqty;?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $balups;?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $balqty;?></td>
              <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:hand;" onclick="editrec(<?php echo $row_eindent_sub['issuesub_id'];?>)" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['issue_id'];?>,<?php echo $row_eindent_sub['issuesub_id'];?>,'pindent');"  /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['issuesub_id'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>
</table>

<br />
<div id="subsubdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 		
		
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
<tr class="Dark" height="25">
   <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="6" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
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
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>		<input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
 <tr class="Dark" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="0" maxlength="5" onchange="piupschk();" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex="0" maxlength="7" onchange="piqtychk(this.value);" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font></td>
         </tr>
</table><input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
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
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;"  onclick="pform();" /></td>
</tr>
</table>
</div>
</div>