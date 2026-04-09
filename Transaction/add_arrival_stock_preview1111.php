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
	
	//$logid="opr1";
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$code=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		$classification=trim($_POST['txtcla']);
		$porn=trim($_POST['txtporn']);
		$dcno=trim($_POST['txtdcno']);
		$txt=trim($_POST['txt1']);
		//$txt12=trim($_POST['txt12']);
		$tname=trim($_POST['txttname']);
		$lorryno=trim($_POST['txtlrn']);
		$vno=trim($_POST['txtvn']);
		$pmode=trim($_POST['txt12']);
		$cname=trim($_POST['txtcname']);
		$dc=trim($_POST['txtdc']);
			
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
			*/
		echo "Submited";	
		exit;
		/*$sql22=mysql_query("select * from tblemp where emp_code='".$code."'") or die(mysql_error());
		$num=mysql_num_rows($sql22);
		
		$sql2=mysql_query("select * from tblemp where emp_mobile='".$mobile."'") or die(mysql_error());
		$num2=mysql_num_rows($sql2);
		
		$sql_mail=mysql_query("select * from tblemp where emp_email='".$email."'") or die(mysql_error());
		$num_mail=mysql_num_rows($sql_mail);
		
		if($altemail !="")
		{
		$sql_altmail=mysql_query("select * from tblemp where emp_altemail='".$altemail."'") or die(mysql_error());
		$num_altmail=mysql_num_rows($sql_altmail);
		}
		else
		{
		$num_altmail=0;
		}
		
		if($num > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee ID.\nEmployee with this Employee ID already Present.");
			  </script>
			 <?php
		}
		else if($num2 > 0)
		{	?>
			 <script>
			  alert("Duplicate Mobile Number.\nEmployee with this Mobile Number already Present.");
			  </script>
			 <?php
		}
		else if($num_mail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee VNR Email-ID.\nEmployee with this Employee VNR Email-ID already Present.");
			  </script>
			 <?php
		}
		else if($num_altmail > 0)
		{	?>
			 <script>
			  alert("Duplicate Employee Alternate Email-ID.\nEmployee with this Employee Alternate Email-ID already Present.");
			  </script>
			 <?php
		}
		else
		{*/
			/* $sql_in="insert into tbl_transction(code, date, p_id ,dcno,porn, modeoftransit, tname, lrno, vehicleno,cname, docketno,pmode) values ($code,'$tdate','$classification', '$dcno','$porn','$txt', '$tname', '$lorryno', '$vno','$cname', '$dc','$pmode')";
						//exit;				
			if(mysql_query($sql_in)or die(mysql_error()))
			{ 
				//$id=mysql_insert_id();
				echo "<script>window.location='add_arrival From vendor.php'</script>";	
			}*/
		
		//}
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
<title>stores -Transaction - Arrival from Vendor - Preview</title>
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
	alert("Please select SLOC > Good Item > Nu of Bins");
	document.frmaddDepartment.tblslocnog.focus();
	return false;
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
	alert("Please enter S.T.N Number");
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
		}
		else if(gval==2 || gval=="2")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="none";
		}
		else if(gval==3 || gval=="3")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="block";
			document.getElementById('gsloc3').style.display="block";
		}
		else
		{
			document.getElementById('gsloc1').style.display="none";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
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
		}
		else if(dval==2 || dval=="2")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="block";
		}
		else if(dval==3 || dval=="3")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="block";
		}
		else
		{
			document.getElementById('dsloc1').style.display="none";
			document.getElementById('dsloc2').style.display="none";
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
}

function ups2(ups2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin in second Row in Good section");
		document.frmaddDepartment.txtslupsg2.value="";
		document.frmaddDepartment.txtslsubbg2.focus();
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
}

function qty2(qty2val)
{
	if(document.frmaddDepartment.txtslupsg2.value=="")
	{
		alert("Please enter UPS in second Row in Good section");
		document.frmaddDepartment.txtslqtyg2.value="";
		document.frmaddDepartment.txtslupsg2.focus();
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Arrival from Vendor - Preview</td>
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
$tid=$pid;
$sql_tbl=mysql_query("select * from tblarrival where arr_role='".$logid."' and arrival_type='Vendor' and arrival_id='".$tid."'") or die(mysql_error());
$row_tbl=mysql_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arrival_id'];

	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

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
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "AV".$row_tbl['arrival_code'];?></td>

<td width="101" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="259" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysql_query("SELECT business_name, address FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
$row3=mysql_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Stock Transfer&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row3['business_name'];?></td>
	<td align="right"  valign="middle" class="tblheading">S.T.N. No &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['Stno'];?></td>

           </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address'];?></td>
</tr>
<tr class="Light" height="25">
<!--/*<td width="205"  align="right"  valign="middle" class="tblheading">P. O. Reference Number&nbsp;</td>
<td align="left"  valign="middle" >&nbsp;<?php echo $row_tbl['porefno'];?></td>
*/-->
 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Light" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="99" align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<?php echo $row_tbl['trans_paymode'];?></td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="99" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else
{
?> 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php

$sql_tbl_sub=mysql_query("select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysql_error());

?>
			 <tr class="tblsubtitle" height="20">
              <td width="2%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="14%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Items</td>
			  <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">UOM</td>
                <td colspan="8"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="4" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
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
                    <td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
					<td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
					<td width="2%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="9%" align="center" valign="middle" class="tblheading">Bin</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
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
			 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
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
			 <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
 </tr>
<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_class['classification'];?></td>
             <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row_item['stores_item'];?></td>
			 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_per_dc'];?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_per_dc'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_good'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['ups_damage'];?></td>
             <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty_damage'];?></td>
             <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['exsh_ups'];?></td>
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
			 <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
 		     <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
 </tr> 
<?php
}
$srno++;
}
}
?>  			  
          </table>
		  <br />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" />&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  