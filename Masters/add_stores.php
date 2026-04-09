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
	 $query=mysql_query("SELECT * FROM tbl_stores where stores_item='$sitem'") or die("Error: " . mysql_error());
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
	 	
 	   $sql_in="insert into tbl_stores(classification_id, stores_item, uom, srl_status, srl, actstatus) values ('$classification', '$sitem', '$uom', '$srl', '$sro', '$actstatus')";
		//exit;							
		if(mysql_query($sql_in)or die(mysql_error()))
		{
			echo "<script>window.location='stores_home.php'</script>";	
		}
		
	
}
}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores -  Master -Add Stores</title>
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
/*else
if(document.frmaddDept.txtuom.value=="")
	{
	 alert("Please Select UOM");
	 document.frmaddDept.txt.value="";
	 document.frmaddDept.txtuom.focus();
	 return false;
	}
	}*/
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
			{document.frmaddDept.actstatus.value=actval; return true;}
			else{
			document.frmaddDept.actsts[0].checked=true;
			document.frmaddDept.actstatus.value="Active";
			return false;}
		}
	}
	else
	{
		document.frmaddDept.actstatus.value=actval;
	}
}
</SCRIPT>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" >
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
	  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Stores Item - Add Stores Item</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	 $sql1=mysql_query("select * from tbl_classification")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt12" value="" type="hidden"> 
	  <input name="txt" value="" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Stores Item</td>
</tr>
 <tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Light" height="25">
<?php
$quer3=mysql_query("SELECT DISTINCT classification,classification_id FROM tbl_classification order by classification Asc"); 
?>
           <td align="right" valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tblbutn">&nbsp;<select class="tbltext" name="txtcla" style="width:170px;">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['classification_id'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>
              &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
 <td align="right" valign="middle" class="tblheading">&nbsp;Stores Item&nbsp;</td>
<td align="left"  valign="middle" colspan="3"  class="tblbutn">&nbsp;<input name="txtsid" type="text" size="45" class="tbltext" tabindex="0" maxlength="45" onChange="f1(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="25">
          <td align="right" valign="middle" class="tblheading">&nbsp;Unit of Measurement&nbsp;</td>
           <td align="left"  valign="middle" colspan="3"  class="tblbutn">&nbsp;<select name="txtuom" class="tbltext"  style="width:170px;" tabindex="" onChange="f2(this.value);">
		<option value="">---Select UoM---</option>
		<option value="Number">Numbers</option>
		<option value="Kg">Kg</option>
		<option value="Meters">Meters</option>
		<option value="Litres">Litres</option>
		<option value="Mililitres">Mililitres</option></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		  <tr class="Dark" height="25" >
<td align="right" valign="middle" class="tblheading">&nbsp;Select Re-Order Level&nbsp;</td>
 <td width="314" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);"   onChange="f3(this.value);"/>Yes&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk(this.value);"  onChange="f3(this.value);" />&nbsp;No&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="pro" style="display:none">
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="25" >
<td width="334" align="right"  valign="middle" class="tblheading">&nbsp;Set Re-Order Level at&nbsp;</td>
<td width="310" colspan="3" align="left"  valign="middle">&nbsp;<input name="txtsroid" type="text" size="5" class="tbltext" tabindex="0" maxlength="5"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="25" >
<td width="334" align="right"  valign="middle" class="tblheading">&nbsp;Status&nbsp;</td>
<td width="310" colspan="3" align="left" class="tbltext" valign="middle">&nbsp;<input type="radio" name="actsts" value="Active" class="tbltext" checked="checked" onClick="actck(this.value);"  />&nbsp;Active&nbsp;&nbsp;<input type="radio" name="actsts" value="In-Active" class="tbltext" onClick="actck(this.value);" disabled="disabled"  />&nbsp;In-Active&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="actstatus" value="Active" /><input type="hidden" name="itmbalqty" value="0" /></td>

</tr>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="stores_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
