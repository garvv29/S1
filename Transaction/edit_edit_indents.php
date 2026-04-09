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
	
	//$id="42";
	//$name="Ram";
	if(isset($_REQUEST['p_id']))
	{
     $pid = $_REQUEST['p_id'];
	}
	 if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}	

	if(isset($_POST['frm_action'])=='submit')
	{
	
	 	if(isset($_GET['p_id']))
	 	{
	 		$p_id = $_GET['p_id'];	 
		}
		$txtremarks=trim($_POST['txtremarks']);
		$txtremarks=str_replace("&","and",$txtremarks);
		
		$sql_in1="update tbl_ieindent set remarks='$txtremarks' where tid='$p_id'";
		mysql_query($sql_in1) or die(mysql_error());
		
		echo "<script>window.location='add_indents_preview.php?p_id=$p_id'</script>";
	}

//}
//}
//}
$a="c";
	$sql_code="SELECT MAX(code) FROM tbl_ieindent ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}
		
	
		$sql_code1="SELECT MAX(code1) FROM tbl_ieindent ORDER BY code1 DESC";
	$res_code1=mysql_query($sql_code1)or die(mysql_error());
		
		if(mysql_num_rows($res_code1) > 0)
			{
				$row_code1=mysql_fetch_row($res_code1);
				$t_code=$row_code1['0'];
				$code=$t_code+1;
				$code1="IR".$code;
		}
		else
		{
			$code=1;
			$code1="".$code;
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Transction Issue- Indents  -Edit indents</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="indent.js"></script>
<script type="text/javascript">
/*
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
*/
</script>
<script language="JavaScript">
function editrecid1(edtrecid)
{
showUser(edtrecid,'ind1','subformedt','','','','','');
}
function modetchk(classval)
{
showUser(classval,'vitem','item','','','','','');

}
function classchk(itval)
{
if(document.frmaddDepartment.txtclass.value!="")
	{	
		if(document.frmaddDepartment.txtitem.value!="")
		{
			if(document.frmaddDepartment.itmdchk.value!="")
			{ 
				var flg=0;
				var itmchk=document.frmaddDepartment.itmdchk.value;
				var itm=itmchk.split(",");
				for(var i=0; i < itm.length; i++)
				{
					if(document.frmaddDepartment.txtitem.value==itm[i])
					{
						flg=1;
					}
				}
				if(flg==1)
				{
					alert("Please Check, this item is already posted in this transaction");
					document.frmaddDepartment.txtitem.selectedIndex=0;
					return false;
				}
				
			}
		}
		showUser(itval,'uom','itemuom','','','','','');
		//setTimeout('showslocbins()',200);
	}
	else
	{
		alert("Please Select Classification")
		//document.frmaddDepartment.txtitem.
		document.frmaddDepartment.txtitem.selectedIndex=0;
		//document.frmaddDepartment.txtclass.focus();
	}
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function pform()
{ 
	
	if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Select classifcation");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	if(document.getElementById("itm").value=="")
	{
		alert("Please Select Item.");
		//document.frmaddDepartment.txtitem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtqty.value=="")
	{
		alert("Please enter Indent Quantity.");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	if(document.frmaddDepartment.txtqty.value.charCodeAt() == 32)
	{
		alert("Quantity cannot start with space.");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	else
	{	//alert("hi");
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'ind','mform','','','','','');
	}

}
function peditform()
{ 
	
	if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Select classifcation");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	if(document.getElementById("itm").value=="")
	{
		alert("Please Select Item.");
		//document.frmaddDepartment.txtitem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtqty.value=="")
	{
		alert("Please enter Indent Quantity.");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	if(document.frmaddDepartment.txtqty.value.charCodeAt() == 32)
	{
		alert("Quantity cannot start with space.");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	else
	{	//alert("hi");
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'ind','mformsubedt','','','','','');
	}

}
function openprint()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('indents_print.php?itmid='+itm,'WelCome','top=170,left=150,width=620,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}

function deleterec(v1,v2,v3)
{
if(confirm('Do you wish to delete the item?')==true)
{
showUser(v1,'ind','eirdelete',v2,v3,'','','');
}
else
{
return false;
}
}

function mySubmit()
{ 
	
	/*if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Select classifcation");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please Select Item.");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please enter Indent Ups.");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	if(document.frmaddDepartment.txtups.value.charCodeAt() == 32)
	{
		alert("UPS cannot start with space.");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	if(document.frmaddDepartment.txtqty.value=="")
	{
		alert("Please enter Indent Quantity.");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	if(document.frmaddDepartment.txtqty.value.charCodeAt() == 32)
	{
		alert("Quantity cannot start with space.");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}*/
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;	 
}
	
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            
            </div>
            <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top"><li><li> <a href="adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>
                <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="stores_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;"></a>Transction Issue- Indents </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 
	  
	    <td align="center" colspan="4" >
		 <?php

$tid=$pid;

$sql_tbl=mysql_query("select * from tbl_ieindent where  tid='".$tid."'") or die(mysql_error());

$row_tbl=mysql_fetch_array($sql_tbl);		

$sql_tbl_sub=mysql_query("select * from tbl_ieindent_sub where id_in='".$tid."'") or die(mysql_error());

$tdate=$row_tbl['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input type="hidden" name="txtid" value="<?php echo $row_tbl['code1']?>" />
	
	 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />
	
	 <br />
	
<?php
 $subtid=0;
?>
<?php 
//$i1=$mainid;
 //echo $tid=$i1;
//exit;
?>


<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Raise E Indent </td>
</tr>
  <tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>

	
	 <tr class="Dark" height="30">
<td width="180" align="right" valign="middle" class="tblheading">&nbsp;Transction Id&nbsp;</td>
<td width="178"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TIR".$row_tbl['code1']."/".$yearid_id."/".$logid;?></td>

<td width="193" align="right" valign="middle" class="tblheading">Indent Date&nbsp;</td>
<td width="189" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="idate" type="text" size="10" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" />&nbsp; </td>
</tr>

<tr class="Light" height="30">
<td width="180" align="right" valign="middle" class="tblheading">Indent Number  </td>
<td width="178"  align="left" valign="middle" class="tbltext">&nbsp;<input name="ino" type="text" size="10" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"  value="<?php echo "T".$row_tbl['code1']?>"/></td>
<?php 
$result=mysql_query("SELECT * FROM tbl_roles where id='".$loginid."'")or die(mysql_error()); 
$row = mysql_fetch_array($result);

?>
<td width="193" align="right" valign="middle" class="tblheading">Raised by&nbsp;</td>
<td width="189" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="iraised" type="text" size="25" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $row['name'];?>"/></td>
</tr>

</table>
<br/>
<div id="ind">
<?php
$sql_tbl_sub=mysql_query("select * from tbl_ieindent_sub where id_in='".$tid."'") or die(mysql_error());
$subtid=0;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification </td>
<td width="114" align="center" class="tblheading" valign="middle">Item </td>
<td width="147" align="center" class="tblheading" valign="middle">UoM</td>
<td width="147" align="center" class="tblheading" valign="middle">Quantity</td>
<td width="147" align="center" class="tblheading" valign="middle">Edit</td>
<td width="171" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
$srno=1; $itmdchk="";
$total_tbl=mysql_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_tbl_sub['items_id'].",";
	}
	else
	{
	$itmdchk=$row_tbl_sub['items_id'].",";
	}
	
$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['items_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);

$sql_item1=mysql_query("select * from tbl_ieindent_sub where eid='".$row_tbl_sub['eid']."'") or die(mysql_error());
$row_item1=mysql_fetch_array($sql_item1);
if($srno%2!=0)
{

?>			


<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0"  onclick="editrecid1(<?php echo $row_tbl_sub['eid'];?>);" style="cursor:pointer" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_item1['eid'];?>,<?php echo $row_item1['id_in'];?>,'');" /></td>
</tr>
<?php
	}
	else
	{ 
	
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
<td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0"  onclick="editrecid1(<?php echo $row_tbl_sub['eid'];?>);" style="cursor:pointer" /></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_item1['eid'];?>,<?php echo $row_item1['id_in'];?>,'');" /></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
else
{$tid=0;}
?>
</table>

 <br />
<div id="ind1" style="display:block">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
	<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
	<?php 
$qry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
		 <tr class="Dark" height="25">
           <td width="192"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;"   onchange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($qry)) { ?>
		<option  value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?> 
		<tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="350" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;&nbsp;</td>
		
<td width="72" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="126" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="" />&nbsp;</td>
		 <tr class="Light" height="30" >
	
<td align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex=""   maxlength="7"  onkeypress="return isNumberKey(event)" />&nbsp;</td>
		 
</table><input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />
		 <input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

		
<br/>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;" onclick="peditform();" />&nbsp;&nbsp;</td>
</tr>
</table></div></div>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="60" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="784" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="90" maxlength="90" value="<?php echo $row_tbl['remarks']?>" ></td>
</tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="../indexindet.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<a href="javascript:document.frmaddDepartment.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/printpreview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;">&nbsp;&nbsp;</td>

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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="images/istratlogo.gif"  align="left"/><img src="images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
