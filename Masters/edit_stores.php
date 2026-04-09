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
	
if(isset($_REQUEST['items_id']))
	{
	$id = $_REQUEST['items_id'];
	}
	if(isset($_REQUEST['char']))
	{
		$char = $_REQUEST['char'];	 
	}
	else
	{
		$char = "ALL";
	}
	
	if(isset($_REQUEST['achar']))
	{
		$achar = $_REQUEST['achar'];	 
	}
	else
	{
		$achar = "";
	}
	if(isset($_REQUEST['page']))
	{
		$page = $_REQUEST['page'];	 
	}
	$homeurl="stores_home.php?page=$page&amp;achar=$achar&amp;char=$char";
	
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		$sitem=trim($_POST['txtsid']);
		$classification=trim($_POST['txtcla']);
		$uom=trim($_POST['txtuom']);
		$srl=trim($_POST['txt1']);
		$sro=trim($_POST['txtsroid']);
		$actstatus=trim($_POST['actstatus']);
			
		$resettargetquery=mysql_query("select * from tbl_classification where classification_id='".$classification."'");
  		$resetresult=mysql_fetch_array($resettargetquery);	
		$clname=$resetresult['classification'];	
									
	  $query=mysql_query("SELECT * FROM tbl_stores where stores_item='$sitem' and items_id!='$id'") or die("Error: " . mysql_error());
		// exit;
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		<script>
		  alert("Duplicate not allowed.");
		  </script>
		 <?php }
		 else 
		 {
				
	 $sql_in="UPDATE tbl_stores SET 
	                                     classification_id='$classification',
										 stores_item='$sitem',
										 uom='$uom',
										 srl_status='$srl',
										 srl='$sro',
										 actstatus='$actstatus'						 
										where items_id = '$id'";
				//exit;					
			if(mysql_query($sql_in)or die(mysql_error()))
			{ 
				//echo $homeurl;
				echo "<script>window.location='$homeurl'</script>";	
			}
		
	//exit;

}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Item Master -Edit Stores</title>
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

function clk(opt)
{
	if(opt!="")
	{
		if(opt=="Yes")
		{
			document.getElementById('pro').style.display="block";
			document.frmaddDept.txt.value=opt;
		}
		else
		{
			document.getElementById('pro').style.display="none";
			document.frmaddDept.txt.value=opt;
		}	
	}
	else
	{
		alert("Please entet Re-order level at");
	}
}

function onloadfocus()

	{
	document.frmaddDept.txtcla.focus();
	}
	
	
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
       return true;
      }
function f1(val)
{
	if(document.frmaddDept.txtcla.value=="")
	{
	 alert("Select Classsification");
	 document.frmaddDept.txtsid.value="";
	 document.frmaddDept.txtcla.focus();
	 return false;
	}
	}
	function f2(val)
{
	if(document.frmaddDept.txtsid.value=="")
	{
	 alert("Please enter Store item");
	 document.frmaddDept.txtuom.value="";
	 document.frmaddDept.txtcla.focus();
	 return false;
	}
	}
	function f3(val)
{
	if(document.frmaddDept.txtuom.value=="")
	{
	 alert("Please Select UOM");
	 document.frmaddDept.txt.value="";
	 document.frmaddDept.txtuom.focus();
	 return false;
	}
	}
	function f4(val)
{
	if(document.frmaddDept.txt.value=="")
	{
	 alert("Please Select UOM");
	 document.frmaddDept.txtsroid.value="";
	 document.frmaddDept.txt.focus();
	 return false;
	}
	}
function onloadfocus()

	{
	document.frmaddDept.txtcla.focus();
	}
	
	
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return (false);
       return (true);
      }
	  
function mySubmit()
{ 
//alert(document.frmaddDept.txt.value);

	if(document.frmaddDept.txtcla.value=="")
	{
	alert("Select classification ");
	document.frmaddDept.txtcla.focus();
	return false;
	}
	
		if(document.frmaddDept.txtsid.value=="")
	{
	alert("Please enter Store item ");
	document.frmaddDept.txtsid.focus();
	return false;
	}
	if(document.frmaddDept.txtsid.value.charCodeAt() == 32)
	{
	alert("stores  Items cannot start with space.");
	document.frmaddDept.txtsid.focus();
	return false;
	}
	
	if(document.frmaddDept.txtuom.value=="")
	{
	alert("Select UoM ");
	document.frmaddDept.txtuom.focus();
	return false;
	}
	if(document.frmaddDept.txtuom.value.charCodeAt() == 32)
	{
	alert("UoM cannot start with space.");
	document.frmaddDept.txtuom.focus();
	return false;
	}
if(document.frmaddDept.txt.value=="")
{
alert("Define Re-order Level");
return false;
}
	
	if(document.frmaddDept.txt.value!="")
	{
	if(document.frmaddDept.txt.value=="Yes")
	{
		if(document.frmaddDept.txtsroid.value=="")
		{
			alert("Enter RE-order level ");
			document.frmaddDept.txtsroid.focus();
			return false;
		}
	if(document.frmaddDept.txtsroid.value.charCodeAt() == 32)
	{
	alert(" RE-order level  cannot start with space.");
	document.frmaddDept.txtsroid.focus();
	return false;
	}
		}
		}
return true;
}

function actck(actval)
{
	if(actval=="In-Active")
	{
		if(document.frmaddDept.itmbalqty.value>0)
		{
			alert("Cannot set status of this item as 'In-Active'.\n\nReason: For setting In-Active status, Item needs to have zero quantity.");
			document.frmaddDept.actsts[0].checked=true;
			document.frmaddDept.actstatus.value="Active";
			return false;
		}
		else
		{
			if(confirm("Setting status of this item as 'In-Active', will stop all transactions including utility with this item.\n\nDo you want to continue?")==true)
			{
				document.frmaddDept.actstatus.value=actval;
				return true;
			}
			else
			{
				document.frmaddDept.actsts[0].checked=true;
				document.frmaddDept.actstatus.value="Active";
				return false;
			}
		}
	}
	else
	{
		document.frmaddDept.actstatus.value=actval;
	}
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
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
	   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="stores_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;"></a>&nbsp; Stores Item - Edit Stores Item</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="items_id" type="hidden" value="<?php echo $id; ?>">
	  <input name="txt12" value="<?php echo $row['srl_status']?>" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td height="30" colspan="4" align="center" class="tblheading">Edit Stores Item</td>
</tr>
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
 <?php
		$sql=mysql_query("SELECT * FROM tbl_stores where items_id='".$id."'"); 
        $row=mysql_fetch_array($sql); 
?>
  	 <?php
$quer3=mysql_query("SELECT DISTINCT classification,classification_id FROM tbl_classification order by classification Asc"); 
?>
	<tr class="Light" height="25">
          <td align="right" valign="middle" class="tblheading">Classification&nbsp;</td>
          <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtcla" style="width:170px;" tabindex="" >
		<option value="">--select Classification--</option>
	<?php while($noticia3 = mysql_fetch_array($quer3)) { ?>
		<option <?php if($noticia3['classification_id']==$row['classification_id']) { echo "Selected"; }?> value="<?php echo $noticia3['classification_id'];?>" />  
		<?php echo $noticia3['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <?php
$quer3=mysql_query("SELECT DISTINCT items_id,items_id FROM tbl_stores order by items_id Asc"); 
?>
		 <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Stores Item&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input  name="txtsid"  size="45" class="tbltext" tabindex="0" maxlength="45" value="<?php echo $row['stores_item'];?>"  onChange="f1(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
          <td align="right" valign="middle" class="tblheading">&nbsp;Unit of Measurement&nbsp;</td>
          <td align="left"  valign="middle" colspan="3">&nbsp;<select name="txtuom" class="tbltext"  style="width:150px;" tabindex="" onChange="f2(this.value);"><option value="<?php echo $row['uom'];?>" selected><?php echo $row['uom'];?></option>
		<option value="Number">Numbers</option>
		<option value="Kg">Kg</option>
		<option value="Meters">Meters</option>
		<option value="Litres">Litres</option>
		<option value="Mililitres">Mililitres</option></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		
		 <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading"  >&nbsp;Select Re-Order Level&nbsp;</td>
<td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" <?php if($row['srl_status'] == "Yes") echo "checked"; ?> onClick="clk(this.value);" onChange="f3(this.value);"/>Yes<input name="txt1" type="radio" class="tbltext" value="No"<?php if($row['srl_status'] =="No") echo "checked"; ?> onClick="clk(this.value);"  onChange="f3(this.value);"/>No&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="pro" <?php if($row['srl_status']!="Yes") { echo "style='display:none'";} else { echo "style='display:block'"; }?>>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<?php
$quer3=mysql_query("SELECT DISTINCT srl FROM tbl_stores order by items_id Asc");
?>
<tr class="Light" height="25" >
<td width="334" align="right"  valign="middle" class="tblheading">&nbsp;Set Re-Order Level at&nbsp;</td>
<td width="310" colspan="3" align="left"  valign="middle">&nbsp;<input name="txtsroid" type="text" size="5" class="tbltext" tabindex="0" maxlength="5" value="<?php echo $row['srl'];?>" onKeyPress="return isNumberKey(event)"  onChange="f4(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
</table>
</div>
<?php
$sdate=date("Y-m-d");
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row['classification_id']."' and stlg_tritemid='".$id."' and stlg_trdate <= '$sdate'") or die(mysql_error());
$sqty=0;
while($row_issue=mysql_fetch_array($sql_issue))
{ 
	$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$id."' and stlg_trdate <= '$sdate'") or die(mysql_error());
	$row_issue1=mysql_fetch_array($sql_issue1); 

	$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 
	 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
	 { 
		 $sqty=$sqty+$row_issuetbl['stlg_balqty'];
	 }
 }
$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$row['classification_id']."' and stld_tritemid='".$id."' and stld_trdate <= '$sdate'") or die(mysql_error());
while($row_issue=mysql_fetch_array($sql_issue))
{ 
	$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$id."' and stld_trdate <= '$sdate'") or die(mysql_error());
	$row_issue1=mysql_fetch_array($sql_issue1); 
	
	$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 
	while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
	{ 
 		 $sqty=$sqty+$row_issuetbl['stld_balqty'];
	}
} 
//echo $homeurl;
?>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="25" >
<td width="334" align="right"  valign="middle" class="tblheading">&nbsp;Status&nbsp;</td>
<td width="310" colspan="3" align="left" class="tbltext" valign="middle">&nbsp;<input type="radio" name="actsts" value="Active" class="tbltext"  <?php if($row['actstatus'] == "Active") echo "checked"; ?> onClick="actck(this.value);" />&nbsp;Active&nbsp;&nbsp;<input type="radio" name="actsts" value="In-Active" class="tbltext" <?php if($row['actstatus'] == "In-Active") echo "checked"; ?> onClick="actck(this.value);" />&nbsp;In-Active&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="actstatus" value="<?php echo $row['actstatus'];?>" /><input type="hidden" name="itmbalqty" value="<?php echo $sqty;?>" /></td>

</tr>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="<?php echo $homeurl;?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
</tr>
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
