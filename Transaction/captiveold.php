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
	
	//$id="22";
	//$name="Ram";
	
	if(isset($_POST['frm_action'])=='submit')
	{
	$p_id=trim($_POST['maintrid']);
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		echo "<script>window.location='add_indents_preview.php?p_id=$p_id'</script>";
		}

				
				 

	
//}
//}
//}
		
	
	$sql_code="SELECT MAX(code) FROM tbl_captive ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="AS".$code."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="AS".$code."/".$lgnid;
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Transction Issue- Indents </title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="captive.js"></script>
<script src="caaddresschk.js"></script>
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
<script type="text/javascript">
function clkp(opt)
{
	if(opt!="")
	{
		if(opt=="Yes")
		{
			document.getElementById('select').style.display="block";
			document.getElementById('fill').style.display="none";
		}
		else
		{
			document.getElementById('select').style.display="none";
			document.getElementById('fill').style.display="block";
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
	}
}
function clk(opt)
{
	if(opt!="")
	{
		if(opt=="Applicable")
		{
			document.getElementById('trans').style.display="block";
			//document.getElementById('courier').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
		}
		else
		{
			document.getElementById('trans').style.display="none";
			//document.getElementById('courier').style.display="block";
			document.frmaddDepartment.txt11.value=opt;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
	}
}


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
function onloadfocus()
	{
	document.frmaddDepartment.txt12.focus();
	}
	
function clks(val)
{
//alert(val);
document.frmaddDepartment.txt15.value=val;
}
function clk1(val)
{
//alert(val);
document.frmaddDepartment.txt14.value=val;
}

</script>
</script>
<script language="JavaScript">
function editrecid1(edtrecid)
{
alert(edtrecid);
showUser(edtrecid,'ind1','subformedt','','','','','');
}
function modetchk(classval)
{
//if(document.frmaddDepartment.txt11.value!="")
showUser(classval,'item','captive','','','','','');

}


function classchk(itval)
{
if(document.frmaddDepartment.txtclass.value!="")
{
showUser(itval,'uom','itemuom','','','','','');
}
else
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDepartment.txtclass.focus();
}
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

function pform(opt)
{ 
	if(opt!="")
	{
	if(document.frmaddDepartment.txtclass.value=="")
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
	
	
	else
	{	alert("hi");
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'ind1','cform','','','','','');
	}
}
}
function peditform(opt)
{ 
	if(opt!="")
	{
	if(document.frmaddDepartment.txtclass.value=="")
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
	
	
	else
	{	alert("hi");
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'ind','mformsubedt','','','','','');
	}
}
}
function mySubmit()
{ 
	
	if(document.frmaddDepartment.txt.value=="Yes")
	{
	alert("Please select Party name ");
	return false;
	}	
	if(document.frmaddDepartment.txt.value=="No")
	{
	alert("Please select Fill Party name ");
	return false;
	}	
	if(document.frmaddDepartment.txtaddress.value=="")
	{
	alert("Please select Fill Address ");
	return false;
	}	
	if(document.frmaddDepartment.txtaddress.value.charCodeAt() == 32)
	{
	alert("Address cannot start with space.");
	document.frmaddDepartment.txtaddress.focus();
	return false;
	}		
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
	}
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;*/	 
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
            <div  id="navigation">
            <ul  id="nav">
             <li><a href="#">Transactions </a>
              <ul>
                <li><a href="arrival_home.php" >&nbsp;Arrival</a></li>
                <li><a href="issue_home.php" >&nbsp;Issue</a></li>
                <li><a href="c_c_home.php" >&nbsp;Captive&nbsp;Consumption</a></li>
				<li><a href="add_discard.php" >&nbsp;Material&nbsp;Discard</a></li>
				<li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
                <li><a href="add_arrival.php" >&nbsp;SLOC&nbsp;Updation</a></li>
				<li><a href="reorder.php" >&nbsp;Order&nbsp;Placement&nbsp;at&nbsp;Reorder</a></li>
             </ul>
            </li>
             <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				<?php
			  if($role == "admin")
			  {
			  ?>
				<li><a href="../reports/masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
				<?php
				}
				?>
              </ul>
            </li><li>
            <a href="#">Utility </a>
             <ul>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_bincard.php','WelCome','top=10,left=50,width=950,height=800,scrollbars=yes')" >&nbsp;Sub-Bin&nbsp;Card</a></li>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li> <?php if($role == "admin")
			  {
			  ?>
			  <li><a href=" Javascript:void(0)" onClick="window.open('../utility/backup.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Backup</a></li>
			  <?php }?>
           </ul>   </li>
            </ul>
            </div>
            </div>
            <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top"> <li><a href="adminprofile.php">Profile </a> | </li>
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
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input type="hidden" name="txtid" value="<?php echo $code?>" />
	 <input type="hidden" name="txtid1" value="<?php echo $code1?>" />
	 <input name="txt11" value="" type="hidden"> 
   <input name="txt" value="" type="hidden"> 
   	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
	 <br />
<?php
$tid=0; $subtid=0;
?>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Internal Captive Consumption  </td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="313" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID &nbsp;</td>
           <td width="218" align="left"  valign="middle">&nbsp;<input name="txtcode" type="text" size="5" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $code?>" onchange="showUser(this.value);"/></td>
		   
		   <td width="109" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="200" colspan="3" align="left"  valign="middle">&nbsp;<input name="date" type="text" size="6" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>"  /></td>
		   </tr>
		<tr class="Dark" height="25">
<td width="109" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
   <td width="200" colspan="3" align="left"  valign="middle">&nbsp;<input name="txt12" type="radio" class="tbltext" value="Yes" onClick="clkp(this.value);" />&nbsp;Select&nbsp;&nbsp;<input name="txt12" type="radio" class="tbltext" value="No" onClick="clkp(this.value);" />&nbsp;Fill&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div  id="fill" style="display:none" >
<table  align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" > 
<tr class="Light" height="25">
           <td width="256"  align="right"  valign="middle" class="tblheading">Party Name&nbsp; </td>
           <td align="left"  valign="middle" colspan="5">&nbsp;<input name="txtparty" type="text" size="10" class="tbltext" tabindex="" maxlength="25"   /></td>&nbsp;<font color="#FF0000"  >*</font>&nbsp;
         </tr>
		  <tr class="Dark" height="30">
<td width="256" align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td width="488" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtaddress" cols="50" rows="5" tabindex="" ></textarea>&nbsp;</td>
</tr>
</table>
</div>
<div id="select"  style="display:none">
<table  align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" > 
<?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock & Transfer'"); 
?>
<tr class="Light" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<select class="tbltext" name="txtcla" style="width:150px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');">
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;
</tr>
<tr class="Dark" height="30">
<td width="351" align="right"  valign="middle" class="tblheading">&nbsp;Address</td>
<td width="393" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress">&nbsp;</td>
</tr>
</table>
</div>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

		<tr class="Light" height="25">
             <td width="313"  align="right"  valign="middle" class="tblheading"> Contact&nbsp;Number </td>
           <td align="left"  valign="middle" colspan="5">&nbsp;<input name="txtcontact" type="text" size="15" class="tbltext" tabindex="0" maxlength="25"  onkeypress="return isNumberKey(event)" />&nbsp;</td>
		   </tr>
		   <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Applicable" onClick="clk(this.value);" />&nbsp;Applicable&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="Not Applicable" onClick="clk(this.value);" />&nbsp;Not Applicable&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
</br>
<div id="ind" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification </td>
<td width="114" align="center" class="tblheading" valign="middle">Item </td>
<td width="147" align="center" class="tblheading" valign="middle">Uom </td>
<td width="147" align="center" class="tblheading" valign="middle">G/D </td>
<td width="114" align="center" class="tblheading" valign="middle">UPS</td>
<td width="147" align="center" class="tblheading" valign="middle">Quantity</td>
<td width="147" align="center" class="tblheading" valign="middle">Edit</td>
<td width="171" align="center" class="tblheading" valign="middle">Delete</td>
</tr></table>
<?php
//$srno=1;
	/*while($row=mysql_fetch_array($res))
	{
	
	 $resettargetquery=mysql_query("select * from tbl_roles where id='".$row['id']."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
	
	$sql_p=mysql_query("select * from tblzone where dept_id=".$row['dept_id'])or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	$sql_v=mysql_query("select * from tblregion where dept_id=".$row['dept_id'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	
	if ($srno%2 != 0)
	{
	*/
?>
<!--<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center">1</td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_indents.php?classification_id=<?php echo $row['classification_id'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand" /></td>
</tr>
<?php
/*	}
	else
	{ 
	 */
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center">2</td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"></td>
<td valign="middle" class="tbltext" align="center"><a href="edit_indents.php?classification_id=<?php echo $row['classification_id'];?>"><img src="../images/edit.png" border="0" /></a></td>
<td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="cursor:hand" /></td>
</tr>
--><?php	/*}
	 $srno=$srno+1;
	}
}*/
?>

 <br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
	<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
	<?php 
$qry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
		 <tr class="Dark" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;"   onchange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($qry)) { ?>
		<option <?php if($noticia_class['classification_id']==$row_tbl_sub['classification_id']){ echo "Selected"; } ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?> 
		<tr class="Light" height="25">
           <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Items &nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="item">&nbsp;<select class="tbltext" name="txtitem" style="width:170px;" onchange="classchk(this.value);" >
<option value="" >--Select Item--</option>
</select>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">UOM&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row_tt['uom'];?>" /></td>
         </tr>
		 <tr class="Light" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Type &nbsp;</td>
            <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes"  />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No"  />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp; </td>
         </tr>
		 <input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

</table>
<table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Light" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="99" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:100px;" onchange="clk1(this.value);" >
<option value="" selected="selected">--Select Mode--</option>
<option value="TBB">TBB</option>
<option value="ToPay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<!--/*</table>

<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
*/--><tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="99" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>

<br/>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_pending _indents.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDepartment.reset()"></a>&nbsp;
  <input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
