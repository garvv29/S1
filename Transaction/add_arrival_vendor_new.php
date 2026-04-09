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
	
	$logid="opr1";
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
		$p_id=trim($_POST['maintrid']);
		echo "<script>window.location='add_arrival_vendor_preview.php?p_id=$p_id'</script>";	
			
	}

//$a="c";
	//$a="c";
	$sql_code="SELECT MAX(arrival_code) FROM tblarrival ORDER BY arrival_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="AV".$code;
		}
		else
		{
			$code=1;
			$code1="AV".$code;
		}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transaction - Arrival from Vendor </title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
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
<script language="javascript" type="text/javascript">

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
	alert("Please select Classification first");
	document.frmaddDepartment.txtclass.focus();
	return false;
	}
	else if(document.frmaddDepartment.txtitem.value=="")
	{
	alert("Please select Item first");
	document.frmaddDepartment.txtitem.focus();
	return false;
	}
	else if(document.frmaddDepartment.txtupsdc.value=="")
	{
	alert("Please enter UPS as per DC first");
	document.frmaddDepartment.txtupsdc.focus();
	return false;
	}
	else if(document.frmaddDepartment.txtqtydc.value=="")
	{
	alert("Please enter Quantity as per DC first");
	document.frmaddDepartment.txtqtydc.focus();
	return false;
	}
	else if(document.frmaddDepartment.txtupsg.value=="")
	{
	alert("Please enter UPS Received Good");
	document.frmaddDepartment.txtupsg.focus();
	return false;
	}
	else if(document.frmaddDepartment.txtqtyg.value=="")
	{
	alert("Please enter Quantity Received Good");
	document.frmaddDepartment.txtqtyg.focus();
	return false;
	}
	else if(document.frmaddDepartment.tblslocnog.value=="")
	{
	alert("Please select SLOC > Good Item > No of Bins");
	document.frmaddDepartment.tblslocnog.focus();
	return false;
	}
	else if(document.frmaddDepartment.tblslocnog.value!="")
	{
		if(document.frmaddDepartment.tblslocnog.value==1 || document.frmaddDepartment.tblslocnog.value=="1")
		{
			if(document.frmaddDepartment.txtslsubbg1.value=="")
			{
				alert("Sub Bin Not selected");	
				document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
			}
		}
		else if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{
			if(document.frmaddDepartment.txtslsubbg2.value=="")
			{
				alert("Sub Bin Not selected");	
				document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			}
		}
		else
		{
			if(document.frmaddDepartment.txtslsubbg3.value=="")
			{
				alert("Sub Bin Not selected");	
				document.frmaddDepartment.txtslsubbg3.focus();
				return false;		
			}
		}
	}
	else
	{
	var a=formPost(document.getElementById('mainform'));
	showUser(a,'postingtable','mform','');
	}
}
function clk(opt)
{
	if(document.frmaddDepartment.txtdcno.value!="")
	{
	if(opt!="")
	{
		if(opt=="Transport")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
		}
		else if(opt=="Courier")
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			document.getElementById('byhand').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
		}	
		else
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="block";
			document.frmaddDepartment.txt11.value=opt;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
		document.frmaddDepartment.txt11.value="";
	}
	}
	else
	{
	alert("Please enter D.C./Inv. Number");
	}
}

function bingood(gval)
{	
	if(document.frmaddDepartment.txtqtyg.value!="")
	{
		if(gval==1 || gval=="1")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value=document.frmaddDepartment.txtupsg.value;
			document.getElementById('qty1').value=document.frmaddDepartment.txtqtyg.value;
			document.getElementById('ups1').readOnly=true;
			document.getElementById('ups1').style.backgroundColor="#CCCCCC";
			document.getElementById('qty1').readOnly=true;
			document.getElementById('qty1').style.backgroundColor="#CCCCCC";
		}
		else if(gval==2 || gval=="2")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value="";
			document.getElementById('qty1').value="";
			document.getElementById('ups1').readOnly=false;
			document.getElementById('ups1').style.backgroundColor="#FFFFFF";
			document.getElementById('qty1').readOnly=false;
			document.getElementById('qty1').style.backgroundColor="#FFFFFF";
			document.getElementById('ups2').value="";
			document.getElementById('qty2').value="";
			document.getElementById('ups2').readOnly=true;
			document.getElementById('ups2').style.backgroundColor="#CCCCCC";
			document.getElementById('qty2').readOnly=true;
			document.getElementById('qty2').style.backgroundColor="#CCCCCC";
		}
		else if(gval==3 || gval=="3")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="block";
			document.getElementById('ups1').value="";
			document.getElementById('qty1').value="";
			document.getElementById('ups1').readOnly=false;
			document.getElementById('ups1').style.backgroundColor="#FFFFFF";
			document.getElementById('qty1').readOnly=false;
			document.getElementById('qty1').style.backgroundColor="#FFFFFF";
			document.getElementById('ups2').value="";
			document.getElementById('qty2').value="";
			document.getElementById('ups2').readOnly=false;
			document.getElementById('ups2').style.backgroundColor="#FFFFFF";
			document.getElementById('qty2').readOnly=false;
			document.getElementById('qty2').style.backgroundColor="#FFFFFF";
			document.getElementById('ups3').value="";
			document.getElementById('qty3').value="";
			document.getElementById('ups3').readOnly=true;
			document.getElementById('ups3').style.backgroundColor="#CCCCCC";
			document.getElementById('qty3').readOnly=true;
			document.getElementById('qty3').style.backgroundColor="#CCCCCC";
		}
		else
		{
			document.getElementById('gsloc1').style.display="none";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value="";
			document.getElementById('qty1').value="";
			document.getElementById('ups1').readOnly=false;
			document.getElementById('ups1').style.backgroundColor="#FFFFFF";
			document.getElementById('qty1').readOnly=false;
			document.getElementById('qty1').style.backgroundColor="#FFFFFF";
			document.getElementById('ups2').value="";
			document.getElementById('qty2').value="";
			document.getElementById('ups2').readOnly=false;
			document.getElementById('ups2').style.backgroundColor="#FFFFFF";
			document.getElementById('qty2').readOnly=false;
			document.getElementById('qty2').style.backgroundColor="#FFFFFF";
			document.getElementById('ups3').value="";
			document.getElementById('qty3').value="";
			document.getElementById('ups3').readOnly=false;
			document.getElementById('ups3').style.backgroundColor="#FFFFFF";
			document.getElementById('qty3').readOnly=false;
			document.getElementById('qty3').style.backgroundColor="#FFFFFF";
		}
	}
	else
	{
	alert("Please enter Actual Quantity Receive Good first");
	document.frmaddDepartment.txtqtyg.focus();
	}
}


function bindamage(dval)
{
	if(document.frmaddDepartment.tblslocnog.value!="")
	{
		if(dval==1 || dval=="1")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="none";
			document.getElementById('ups4').value=document.frmaddDepartment.txtupsd.value;
			document.getElementById('qty4').value=document.frmaddDepartment.txtqtyd.value;
			document.getElementById('ups4').readOnly=true;
			document.getElementById('ups4').style.backgroundColor="#CCCCCC";
			document.getElementById('qty4').readOnly=true;
			document.getElementById('qty4').style.backgroundColor="#CCCCCC";
		}
		else if(dval==2 || dval=="2")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="block";
			document.getElementById('ups4').value="";
			document.getElementById('qty4').value="";
			document.getElementById('ups4').readOnly=false;
			document.getElementById('ups4').style.backgroundColor="#FFFFFF";
			document.getElementById('qty4').readOnly=false;
			document.getElementById('qty4').style.backgroundColor="#FFFFFF";
			document.getElementById('ups5').value="";
			document.getElementById('qty5').value="";
			document.getElementById('ups5').readOnly=true;
			document.getElementById('ups5').style.backgroundColor="#CCCCCC";
			document.getElementById('qty5').readOnly=true;
			document.getElementById('qty5').style.backgroundColor="#CCCCCC";
		}
		else
		{
			document.getElementById('dsloc1').style.display="none";
			document.getElementById('dsloc2').style.display="none";
			document.getElementById('ups4').readOnly=false;
			document.getElementById('ups4').style.backgroundColor="#FFFFFF";
			document.getElementById('qty4').readOnly=false;
			document.getElementById('qty4').style.backgroundColor="#FFFFFF";
			document.getElementById('ups5').value="";
			document.getElementById('qty5').value="";
			document.getElementById('ups5').readOnly=false;
			document.getElementById('ups5').style.backgroundColor="#FFFFFF";
			document.getElementById('qty5').readOnly=false;
			document.getElementById('qty5').style.backgroundColor="#FFFFFF";
		}
	}
	else
	{
	alert("Please select number of Bins Good first");
	document.frmaddDepartment.tblslocnog.focus();
	}
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }


function clk1(val)
{
document.frmaddDepartment.txt14.value=val;
}

function upschk(upsval)
{
if(document.frmaddDepartment.txtupsdc.value!="")
{
if(document.frmaddDepartment.txtupsd.value=="")
document.frmaddDepartment.txtexshups.value=parseInt(upsval)-parseInt(document.frmaddDepartment.txtupsdc.value);
else
document.frmaddDepartment.txtexshups.value=parseInt(upsval)+parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(document.frmaddDepartment.txtupsdc.value);
}
else
{
alert("Please enter UPS as per DC first");
document.frmaddDepartment.txtupsg.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtupsdc.focus();
}
}

function upschk1(upsval1)
{
if(document.frmaddDepartment.txtupsg.value!=""){
document.frmaddDepartment.txtexshups.value=parseInt(upsval1)+parseInt(document.frmaddDepartment.txtupsg.value)-parseInt(document.frmaddDepartment.txtupsdc.value);}
else
{
alert("Please enter UPS Good first");
document.frmaddDepartment.txtupsd.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtupsg.focus();
}
}


function qtychk(qtyval)
{
if(document.frmaddDepartment.txtqtydc.value!="")
{
if(document.frmaddDepartment.txtqtyd.value=="")
document.frmaddDepartment.txtexshqty.value=parseFloat(qtyval)-parseFloat(document.frmaddDepartment.txtqtydc.value);
else
document.frmaddDepartment.txtexshqty.value=parseFloat(qtyval)+parseFloat(document.frmaddDepartment.txtqtyd.value)-parseFloat(document.frmaddDepartment.txtqtydc.value);
}
else
{
alert("Please enter Quantity as per DC first");
document.frmaddDepartment.txtqtyg.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtqtydc.focus();
}
}


function qtychk1(qtyval1)
{
if(document.frmaddDepartment.txtqtyg.value!=""){
document.frmaddDepartment.txtexshqty.value=parseFloat(qtyval1)+parseFloat(document.frmaddDepartment.txtqtyg.value)-parseFloat(document.frmaddDepartment.txtqtydc.value);}
else
{
alert("Please enter UPS Good first");
document.frmaddDepartment.txtqtyd.value="";
document.frmaddDepartment.txtexshqty.value="";
document.frmaddDepartment.txtqtyg.focus();
}
}

function classchk(itval)
{
if(document.frmaddDepartment.txtclass.value!="")
{
showUser(itval,'uom','itemuom','','');
}
else
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDepartment.txtclass.focus();
}
}

function itemcheck()
{
if(document.frmaddDepartment.txtitem.value=="")
{
alert("Please select Item first");
document.frmaddDepartment.txtupsdc.value="";
}
}

function upsdcchk()
{
if(document.frmaddDepartment.txtupsdc.value=="")
{
alert("Please enter UPS as per DC first");
document.frmaddDepartment.txtqtydc.value="";
}
}


function modetchk(classval)
{
if(document.frmaddDepartment.txt11.value!="")
showUser(classval,'vitem','item','','');
else
alert("Please select Mode of Transit first");
}

function vendorchk()
{
if(document.frmaddDepartment.txtcla.value=="")
{
alert("Please select Vendor first");
document.frmaddDepartment.txtdcno.value="";
}
}

function dcnochk()
{
if(document.frmaddDepartment.txtdcno.value=="")
{
alert("Please enter D.C./Inv number first");
document.frmaddDepartment.txtporn.value="";
}
}


function openslocpop()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}




function wh1(wh1val)
{ alert(wh1val);
if(document.frmaddDepartment.tblslocnog.value!="")
{
	showUser(wh1val,'bing1','wh','bing1','');
}
else
{
	alert("Please select SLOC number of Bins Good");
}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtwhslg1.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		{
		showUser(wh2val,'bing2','wh','bing2','');
		}
		else
		{
		alert("Please enter Quantity in first SLOC Row in Good section");
		}
	}
	else
	{
		alert("Please select Warehouse in first Row in Good section");
	}
}

function wh3(wh3val)
{
	if(document.frmaddDepartment.txtwhslg2.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		{
		showUser(wh3val,'bing3','wh','bing3','');
		}
		else
		{
		alert("Please enter Quantity in second SLOC Row in Good section");
		}
	}
	else
	{
		alert("Please select Warehouse in second Row in Good section");
	}
}

function wh4(wh4val)
{
	if(document.frmaddDepartment.tblslocnog.value!="")
	{
		if(document.frmaddDepartment.tblslocnod.value!="")
		{
			showUser(wh4val,'bind1','wh','bind1','');
		}
		else
		{
			alert("Please select SLOC number of Bins Damage");
		}
	}
	else
	{
		alert("Please select SLOC number of Bins Good");
	}
}

function wh5(wh5val)
{
if(document.frmaddDepartment.txtwhsld1.value!="")
	{
		if(document.frmaddDepartment.txtslqtyd1.value!="")
		{
		showUser(wh5val,'bind2','wh','bind2','');
		}
		else
		{
		alert("Please enter Quantity in first SLOC Row in Damage section");
		}
	}
	else
	{
		alert("Please select Warehouse in first Row in Damage section");
	}
}

function bin1(bin1val)
{
	if(document.frmaddDepartment.txtwhslg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','','');
	}
	else
	{
		alert("Please select Warehouse in first Row in Good section");
	}
}

function bin2(bin2val)
{
	if(document.frmaddDepartment.txtwhslg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','','');
	}
	else
	{
		alert("Please select Warehouse in second Row in Good section");
	}
}

function bin3(bin3val)
{
	if(document.frmaddDepartment.txtwhslg3.value!="")
	{
		showUser(bin3val,'sbing3','bin','','');
	}
	else
	{
		alert("Please select Warehouse in Third Row in Good section");
	}
}

function bin4(bin4val)
{
	if(document.frmaddDepartment.txtwhsld1.value!="")
	{
		showUser(bin4val,'sbind1','bin','','');
	}
	else
	{
		alert("Please select Warehouse in first Row in Damage section");
	}
}

function bin5(bin5val)
{
	if(document.frmaddDepartment.txtwhsld2.value!="")
	{
		showUser(bin5val,'sbind2','bin','','');
	}
	else
	{
		alert("Please select Warehouse in second Row in Damage section");
	}
}

function subbin1(subbin1val)
{	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtbinslg1.value!="")
	{	
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1');
	}
	else
	{
		alert("Please select Bin in first Row in Good section");
		document.frmaddDepartment.txtbinslg1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtbinslg2.value!="")
	{	
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2');
	}
	else
	{
		alert("Please select Bin in second Row in Good section");
		document.frmaddDepartment.txtbinslg2.focus();
	}
}

function subbin3(subbin3val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtbinslg3.value!="")
	{	
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3');
	}
	else
	{
		alert("Please select Bin in third Row in Good section");
		document.frmaddDepartment.txtbinslg3.focus();
	}
}

function subbin4(subbin4val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtbinsld1.value!="")
	{	
		showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbd1');
	}
	else
	{
		alert("Please select Bin in first Row in Damage section");
		document.frmaddDepartment.txtbinsld1.focus();
	}
}

function subbin5(subbin5val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtbinsld1.value!="")
	{	
		showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbd2');
	}
	else
	{
		alert("Please select Bin in first Row in Damage section");
		document.frmaddDepartment.txtbinsld1.focus();
	}
}

function ups1(ups1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin in first Row in Good section");
		document.frmaddDepartment.txtslupsg1.value="";
		document.frmaddDepartment.txtslsubbg1.focus();
	}
	if(document.frmaddDepartment.txtslupsg1.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslupsg1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslupsg1.value="";
			document.frmaddDepartment.txtslupsg1.focus();
		}
		if(document.frmaddDepartment.txtslupsg1.value==0 || document.frmaddDepartment.txtslupsg1.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslupsg1.value="";
			document.frmaddDepartment.txtslupsg1.focus();
		}
		if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{
			document.getElementById('ups2').value=parseInt(document.frmaddDepartment.txtupsg.value)-parseInt(ups1val);
		}
		
	}
}

function ups2(ups2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin in second Row in Good section");
		document.frmaddDepartment.txtslupsg2.value="";
		document.frmaddDepartment.txtslsubbg2.focus();
	}
	if(document.frmaddDepartment.txtslupsg2.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslupsg2.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslupsg2.value="";
			document.frmaddDepartment.txtslupsg2.focus();
		}
		if(document.frmaddDepartment.txtslupsg2.value==0 || document.frmaddDepartment.txtslupsg2.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslupsg2.value="";
			document.frmaddDepartment.txtslupsg2.focus();
		}
		if(document.frmaddDepartment.tblslocnog.value==3 || document.frmaddDepartment.tblslocnog.value=="3")
		{
			document.getElementById('ups3').value=parseInt(document.frmaddDepartment.txtupsg.value)-parseInt(document.getElementById('ups1').value)-parseInt(ups2val);
		}
		
	}
}

function ups3(ups3val)
{
	if(document.frmaddDepartment.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin in Third Row in Good section");
		document.frmaddDepartment.txtslupsg3.value="";
		document.frmaddDepartment.txtslsubbg3.focus();
	}
}

function ups4(ups4val)
{
	if(document.frmaddDepartment.txtslsubbd1.value=="")
	{
		alert("Please select Sub Bin in first Row in Damage section");
		document.frmaddDepartment.txtslupsd1.value="";
		document.frmaddDepartment.txtslsubbd1.focus();
	}
	if(document.frmaddDepartment.txtslupsd1.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslsubbd1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslsubbd1.value="";
			document.frmaddDepartment.txtslsubbd1.focus();
		}
		if(document.frmaddDepartment.txtslsubbd1.value==0 || document.frmaddDepartment.txtslsubbd1.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslsubbd1.value="";
			document.frmaddDepartment.txtslsubbd1.focus();
		}
		if(document.frmaddDepartment.tblslocnod.value==2 || document.frmaddDepartment.tblslocnod.value=="2")
		{
			document.getElementById('ups5').value=parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(ups4val);
		}
		
	}
}

function ups5(ups5val)
{
	if(document.frmaddDepartment.txtslsubbd2.value=="")
	{
		alert("Please select Sub Bin in second Row in Damage section");
		document.frmaddDepartment.txtslupsd2.value="";
		document.frmaddDepartment.txtslsubbd2.focus();
	}
}

function qty1(qty1val)
{
	if(document.frmaddDepartment.txtslupsg1.value=="")
	{
		alert("Please enter UPS in first Row in Good section");
		document.frmaddDepartment.txtslqtyg1.value="";
		document.frmaddDepartment.txtslupsg1.focus();
	}
	if(document.frmaddDepartment.txtslqtyg1.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslqtyg1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslqtyg1.value="";
			document.frmaddDepartment.txtslqtyg1.focus();
		}
		if(document.frmaddDepartment.txtslqtyg1.value==0 || document.frmaddDepartment.txtslqtyg1.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg1.value="";
			document.frmaddDepartment.txtslqtyg1.focus();
		}
		if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{
			document.getElementById('qty2').value=parseFloat(document.frmaddDepartment.txtqtyg.value)-parseFloat(qty1val);
		}
	}
}

function qty2(qty2val)
{
	if(document.frmaddDepartment.txtslupsg2.value=="")
	{
		alert("Please enter UPS in second Row in Good section");
		document.frmaddDepartment.txtslqtyg2.value="";
		document.frmaddDepartment.txtslupsg2.focus();
	}
	if(document.frmaddDepartment.txtslqtyg2.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslqtyg2.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslqtyg2.value="";
			document.frmaddDepartment.txtslqtyg2.focus();
		}
		if(document.frmaddDepartment.txtslqtyg2.value==0 || document.frmaddDepartment.txtslqtyg2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg2.value="";
			document.frmaddDepartment.txtslqtyg2.focus();
		}
		if(document.frmaddDepartment.tblslocnog.value==3 || document.frmaddDepartment.tblslocnog.value=="3")
		{
			document.getElementById('qty3').value=parseFloat(document.frmaddDepartment.txtqtyg.value) - parseFloat(document.getElementById('qty1').value) - parseFloat(qty2val);
		}
	}
}

function qty3(qty3val)
{
	if(document.frmaddDepartment.txtslupsg3.value=="")
	{
		alert("Please enter UPS in third Row in Good section");
		document.frmaddDepartment.txtslqtyg3.value="";
		document.frmaddDepartment.txtslupsg3.focus();
	}
}

function qty4(qty4val)
{
	if(document.frmaddDepartment.txtslupsd1.value=="")
	{
		alert("Please enter UPS in first Row in Damage section");
		document.frmaddDepartment.txtslqtyd1.value="";
		document.frmaddDepartment.txtslupsd1.focus();
	}
	if(document.frmaddDepartment.txtslqtyd1.value!="")
	{
		if(isNaN(document.frmaddDepartment.txtslqtyd1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDepartment.txtslqtyd1.value="";
			document.frmaddDepartment.txtslqtyd1.focus();
		}
		if(document.frmaddDepartment.txtslqtyd1.value==0 || document.frmaddDepartment.txtslqtyd1.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyd1.value="";
			document.frmaddDepartment.txtslqtyd1.focus();
		}
		if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{
			document.getElementById('qty5').value=parseFloat(document.frmaddDepartment.txtqtyd.value)-parseFloat(qty4val);
		}
	}
}

function qty5(qty5val)
{
	if(document.frmaddDepartment.txtslupsd2.value=="")
	{
		alert("Please enter UPS in second Row in Damage section");
		document.frmaddDepartment.txtslqtyd2.value="";
		document.frmaddDepartment.txtslupsd2.focus();
	}
}

function mySubmit()
{ 
	
if(document.frmaddDepartment.txtcla.value=="")
	{
	alert("Select Vendor");
	document.frmaddDepartment.txtcla.focus();
	return false;
	}
	
			
	if(document.frmaddDepartment.txtdcno.value=="")
	{
	alert("Please enter D.C. NO.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdcno.value.charCodeAt() == 32)
	{
	alert("D.C. NO. cannot start with space.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtporn.value=="")
	{
	alert("Please enter Reference No.");
	document.frmaddDepartment.txtporn.focus();
	return false;
	}
	if(document.frmaddDepartment.txtporn.value.charCodeAt() == 32)
	{
	alert("Reference No cannot start with space.");
	document.frmaddDepartment.txtporn.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txt11.value!="")
	{
	if(document.frmaddDepartment.txt11.value=="Transport")
	{
		if(document.frmaddDepartment.txttname.value=="")
		{
		alert("Please enter Transport Name");
		document.frmaddDepartment.txttname.focus();
		return false;
		}
		
		if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
		{
		alert("Transport Name cannot start with space.");
		document.frmaddDepartment.txttname.focus();
		return false;
		}
					
		if(document.frmaddDepartment.txtlrn.value=="")
		{
		alert("Please enter Lorry Receipt No");
		document.frmaddDepartment.txtlrn.focus();
		return false;
		}
		
		if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
		{
		alert("Lorry Receipt No cannot start with space.");
		document.frmaddDepartment.txtlrn.focus();
		return false;
		}
		if(document.frmaddDepartment.txtvn.value=="")
		{
		alert("Please enter Vehicle No");
		document.frmaddDepartment.txtvn.focus();
		return false;
		}
		
		if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
		{
		alert("Vehicle No cannot start with space.");
		document.frmaddDepartment.txtvn.focus();
		return false;
		}
		if(document.frmaddDepartment.txt14.value=="")
		{
		alert("Please select Payment Mode");
		return false;
		}
	}
	else if(document.frmaddDepartment.txt11.value=="Courier")
	{
		if(document.frmaddDepartment.txtcname.value=="")
		{
		alert("Please enter Courier Name");
		document.frmaddDepartment.txtcname.focus();
		return false;
		}
		
		if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
		{
		alert("Courier Name cannot start with space.");
		document.frmaddDepartment.txtcname.focus();
		return false;
		}
		
		if(document.frmaddDepartment.txtdc.value=="")
		{
		alert("Please enter Docket No.");
		document.frmaddDepartment.txtdc.focus();
		return false;
		}
		
		if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
		{
		alert("Docket No. cannot start with space.");
		document.frmaddDepartment.txtdc.focus();
		return false;
		}
	}
	else
	{
		if(document.frmaddDepartment.txtpname.value=="")
		{
		alert("Please enter Person Name");
		document.frmaddDepartment.txtpname.focus();
		return false;
		}	
	}
	}
	else
	{
	alert("Please select Mode of Transit");
	return false;
	}
	
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
				 <li><a href="../reports/slocreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
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
              <ul style="vertical-align:text-top"> <li> <a href="operprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>  <li> &nbsp;<a href="../logout.php">Logout </a> </li>
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
          <td width="100%" valign="top" align="center"  class="midbgline">


<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Arrival from Vendor </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>
<?php
$tid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Arrival From Vendor </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid1" type="text" size="8" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"   value="<?php echo $code1?>"/></td>

<td width="101" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="259" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where classification='Vendor'"); 
?>

<td align="right"  valign="middle" class="tblheading">Vendor&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcla" style="width:150px;" onchange="showUser(this.value,'vaddress','vendor','','');">
<option value="" selected="selected">--Select Vendor--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td align="right"  valign="middle" class="tblheading">D.C./Inv. No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20" onchange="vendorchk();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

           </tr>

 <?php
$quer4=mysql_query("SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Vendor&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="205"  align="right"  valign="middle" class="tblheading">P. O. Reference Number&nbsp;</td>
<td align="left"  valign="middle" >&nbsp;<input name="txtporn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15" onchange="dcnochk();"/>

 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" ><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By_Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
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
</table>

<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="99" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<br />
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="1%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Items</td>
			  <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">UOM</td>
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
			  
          </table>
		  <br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="226"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onchange="modetchk(this.value)">
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
<td align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" style="width:170px;" onchange="classchk(this.value);" >
<option value="" selected>--Select Item--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void();" onclick="openslocpop();">SLOC Lookup</a></td>
		
<td width="174" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="133" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS as per D.C&nbsp;</td>
<td width="307" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsdc" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="307" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onchange="upschk1(this.value);"/>&nbsp;</td>
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
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="ups1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qty1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="ups2(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qty2(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="ups3(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qty3(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd1" id="ups4" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  onchange="ups4(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qty4" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qty4(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" id="ups5" type="text" size="4" class="tbltext" tabindex="" maxlength="7"  onchange="ups5(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qty5" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qty5(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<?php echo $tid; ?>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
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
<td width="220" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="624" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtremarks" cols="50" rows="5" tabindex="" ></textarea>&nbsp;</td>
</tr>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  