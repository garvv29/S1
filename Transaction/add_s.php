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
	
	//$logid="opr1";
	//$lgnid="OP1";
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$code=trim($_POST['code']);
		$date=trim($_POST['date']);
		$classification=$_POST['txtclass'];
		$rfs=trim($_POST['txtstage']);
		$rbd=trim($_POST['txtrd']);
		$items=trim($_POST['txtitem']);
		$uom=trim($_POST['txtuom']);
		$ups=trim($_POST['txtups']);
		$qty=trim($_POST['txtqty']);
		$noofbins=trim($_POST['tblslocnog']);
		
		if($rbd == "")
		{
		$rbd=trim($_POST['txtrbd']);	
		}
	
		if($noofbins == 1 || $noofbins == "1")
		{		
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$subbin1=trim($_POST['txtslsubbg1']);
		$ups1=trim($_POST['txtslupsg1']);
		$qty1=trim($_POST['txtslqtyg1']);
		}
		else if($noofbins == 2 || $noofbins == "2")
		{
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$subbin1=trim($_POST['txtslsubbg1']);
		$ups1=trim($_POST['txtslupsg1']);
		$qty1=trim($_POST['txtslqtyg1']);
		
		$wh2=trim($_POST['txtslwhg2']);
		$bin2=trim($_POST['txtslbing2']);
		$subbin2=trim($_POST['txtslsubbg2']);
		$ups2=trim($_POST['txtslupsg2']);
		$qty2=trim($_POST['txtslqtyg2']);
		}
		else if($noofbins == 3 || $noofbins == "3")
		{
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$subbin1=trim($_POST['txtslsubbg1']);
		$ups1=trim($_POST['txtslupsg1']);
		$qty1=trim($_POST['txtslqtyg1']);
		
		$wh2=trim($_POST['txtslwhg2']);
		$bin2=trim($_POST['txtslbing2']);
		$subbin2=trim($_POST['txtslsubbg2']);
		$ups2=trim($_POST['txtslupsg2']);
		$qty2=trim($_POST['txtslqtyg2']);
		
		$wh3=trim($_POST['txtslwhg3']);
		$bin3=trim($_POST['txtslbing3']);
		$subbin3=trim($_POST['txtslsubbg3']);
		$ups3=trim($_POST['txtslupsg3']);
		$qty3=trim($_POST['txtslqtyg3']);
		}
		else
		{
		$wh1="";
		$bin1="";
		$subbin1="";
		$ups1="";
		$qty1="";
		
		$wh2="";
		$bin2="";
		$subbin2="";
		$ups2="";
		$qty2="";
		
		$wh3="";
		$bin3="";
		$subbin3="";
		$ups3="";
		$qty3="";
		}
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		//echo "Submitted";
		
		
		
		$sql_main="insert into tblarrival (arrival_type, arrival_code, arrival_date, stageret, retid, arr_role) values('Internalreturn','$code','$tdate','$rfs','$rbd','$logid')";

if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=mysql_insert_id();

$sql_sub="insert into tblarrival_sub (arrival_id, classification_id, item_id,  qty_good, ups_good, noofbin_good,uom) values('$mainid','$classification','$items','$qty','$ups','$noofbins','$uom')";
if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();

for($num=0; $num<$noofbins; $num++)
{
if($num==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Internalreturn', '$mainid', '$subid', '$classification', '$items', '$wh1', '$bin1', '$subbin1', '$qty1', '$ups1','0',' 0')";
}
if($num==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Internalreturn', '$mainid', '$subid', '$classification', '$items', '$wh2', '$bin2', '$subbin2', '$qty2', '$ups2', '0', '0')";
}
if($num==2)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Internalreturn', '$mainid', '$subid', '$classification', '$items', '$wh3', '$bin3', '$subbin3', '$qty3', '$ups3', '0', '0')";
}
mysql_query($sql_sub_sub) or die(mysql_error());
}
}
}
		 
				echo "<script>window.location='add_return_preview.php?p_id=$mainid'</script>";	
		
}



$sql_code="SELECT MAX(arrival_code) FROM tblarrival where arrival_type='Internalreturn' ORDER BY arrival_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="AI".$code."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="AI".$code."/".$lgnid;
		}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction -Add Opening Stock</title>
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
function clk22(opt)
{
	if(opt!="")
	{
		if(opt=="Yes")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('dsloc1').style.display="none";
			//document.getElementById('ds').style.display="none";
			document.frmaddDepartment.txt1.value=opt;
		}
		else
		{
			document.getElementById('gsloc1').style.display="none";
			document.getElementById('dsloc1').style.display="block";
			//document.getElementById('ds').style.display="block";
			document.frmaddDepartment.txt1.value=opt;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
	}
}
function bingood(gval)
{	
		//alert(gval);
		if(document.frmaddDepartment.txtqty.value > 0)
	{
		if(gval==1 || gval=="1")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value=document.frmaddDepartment.txtups.value;
			document.getElementById('qty1').value=document.frmaddDepartment.txtqty.value;
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
			alert('3');
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
		alert("Please enter Quantity first");
		document.frmaddDepartment.txtqty.focus();
	}
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }

function upschk()
{
if(document.frmaddDepartment.txtitem.value=="")
{
alert("Please select Item first");
document.frmaddDepartment.txtitem.focus();
}
}

/*function qtychk()
{
if(document.frmaddDepartment.txtups.value==0 || document.frmaddDepartment.txtups.value=="")
{
alert("Please enter UPS first");
document.frmaddDepartment.txtqty.value="";
document.frmaddDepartment.txtups.focus();
}
}
*/
function qtychk()
{
	if(document.frmaddDepartment.txtups.value !="")
	{
		if(document.frmaddDepartment.txtqty.value > 0)
		{
			if(document.frmaddDepartment.txtqty.value > 0 )
			{
			document.frmaddDepartment.tblslocnog.disabled=false;
			if(document.frmaddDepartment.txtqty.value=="")
			document.frmaddDepartment.txtqty.value=parseFloat(qtyval)-parseFloat(document.frmaddDepartment.txtqty.value);
			else
			document.frmaddDepartment.txtqty.value=parseFloat(qtyval)+parseFloat(document.frmaddDepartment.txtqty.value)-parseFloat(document.frmaddDepartment.txtqty.value);
			}
			else
			{
			document.frmaddDepartment.tblslocnog.disabled=true;
			}
		}
		else
		{
			alert("Please enter Quantity first");
			document.frmaddDepartment.txtqty.value="";
			document.frmaddDepartment.txtqty.value="";
			//document.frmaddDepartment.txtqtydc.focus();
			document.frmaddDepartment.tblslocnog.disabled=true;
		}
	}
	else
	{
		alert("Please enter UPS first");
		document.frmaddDepartment.txtqty.value="";
		document.frmaddDepartment.txtqty.value="";
		document.frmaddDepartment.txtups.focus();
	}
}



function wh1(wh1val)
{ //alert(wh1val);
	if(document.frmaddDepartment.tblslocnog.value!="")
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	else
	{
		alert("Please select SLOC number of Bins Good");
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		{
		showUser(wh2val,'bing2','wh','bing2','','','','');
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
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		{
		showUser(wh3val,'bing3','wh','bing3','','','','');
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



function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	else
	{
		alert("Please select Warehouse in first Row in Good section");
	}
}

function bin2(bin2val)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2','','','','');
	}
	else
	{
		alert("Please select Warehouse in second Row in Good section");
	}
}

function bin3(bin3val)
{
	if(document.frmaddDepartment.txtslwhg3.value!="")
	{
		showUser(bin3val,'sbing3','bin','txtslsubbg3','','','','');
	}
	else
	{
		alert("Please select Warehouse in Third Row in Good section");
	}
}






function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	alert("subbin");
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg1.value!="")
		var upsv1=document.frmaddDepartment.txtslupsg1.value;
		else
		var upsv1="";
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1);
	}
	else
	{
		alert("Please select Bin in first Row in Good section");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg2.value!="")
		var upsv2=document.frmaddDepartment.txtslupsg2.value;
		else
		var upsv2="";
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,upsv2,qtyv2);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin in second Row in Good section");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing3.value!="")
	{	
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg3.value!="")
		var upsv3=document.frmaddDepartment.txtslupsg3.value;
		else
		var upsv3="";
		if(document.frmaddDepartment.txtslqtyg3.value!="")
		var qtyv3=document.frmaddDepartment.txtslqtyg3.value;
		else
		var qtyv3="";
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,upsv3,qtyv3);
		//showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3','','','');
	}
	else
	{
		alert("Please select Bin in third Row in Good section");
		document.frmaddDepartment.txtslbing3.focus();
	}
}


function upsf1(ups1val)
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
			document.frmaddDepartment.txtslupsg2.value=parseInt(document.frmaddDepartment.txtups.value)-parseInt(ups1val);
		}
		
	}
}

function upsf2(ups2val)
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
		
		
	}
}

function upsf3(ups3val)
{
	if(document.frmaddDepartment.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin in Third Row in Good section");
		document.frmaddDepartment.txtslupsg3.value="";
		document.frmaddDepartment.txtslsubbg3.focus();
	}
}

function qtyf1(qty1val)
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
			document.frmaddDepartment.txtslqtyg2.value=parseFloat(document.frmaddDepartment.txtqty.value)-parseFloat(qty1val);
		}
	}
}

function qtyf2(qty2val)
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
		
	}
}

function qtyf3(qty3val)
{
	if(document.frmaddDepartment.txtslupsg3.value=="")
	{
		alert("Please enter UPS in third Row in Good section");
		document.frmaddDepartment.txtslqtyg3.value="";
		document.frmaddDepartment.txtslupsg3.focus();
	}
}

function modetchk(classval)
{
//if(document.frmaddDepartment.txt11.value!="")
showUser(classval,'vitem','item','','','','','');
//else
//alert("Please select Mode of Transit first");
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

function retchk(retval)
{
showUser(retval,'retby','retnby','','','','','');
}

function rtnbychk(rtnbyval)
{
	if(rtnbyval!="")
	{
		if(document.frmaddDepartment.txtstage.value!="")
		{
			document.getElementById("rbd").value="";
			document.getElementById("rbd").readOnly=true;
			document.getElementById("rbd").style.backgroundColor="#CCCCCC";
		}
		else
		{
			alert("Please select Return from Stage first");
			document.frmaddDepartment.txtstage.focus();
			return false;
		}
	}
	else
	{
		document.getElementById("rbd").value="";
		document.getElementById("rbd").readOnly=false;
		document.getElementById("rbd").style.backgroundColor="#FFFFFF";
	}
}

function mySubmit()
{
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please select Return from Stage");
		document.frmaddDepartment.txtstage.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtrd.value=="" && document.frmaddDepartment.txtrbd.value=="")
	{
		alert("Please select Return by ID or Specify the Name");
		//document.frmaddDepartment.txtstage.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Please select Classification");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Stores Item");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtqty.value=="")
	{
		alert("Please enter Quantity");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	
	if(document.frmaddDepartment.tblslocnog.value=="")
	{
		alert("Please select number of Bins");
		document.frmaddDepartment.tblslocnog.focus();
		return false;
	}
	
	if(document.frmaddDepartment.tblslocnog.value!="")
	{
		if(document.frmaddDepartment.tblslocnog.value==1 || document.frmaddDepartment.tblslocnog.value=="1")
		{
			if(document.frmaddDepartment.txtslsubbg1.value=="")
			{
				alert("Please select Subbin");
				document.frmaddDepartment.txtslsubbg1.focus();
				return false;
			}
		}
		if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{
			if(document.frmaddDepartment.txtslsubbg2.value=="")
			{
				alert("Please select Subbin in 2nd SLOC");
				//document.frmaddDepartment.txtslqtyg1.focus();
				return false;
			}
		}
		if(document.frmaddDepartment.tblslocnog.value==3 || document.frmaddDepartment.tblslocnog.value=="3")
		{
			if(document.frmaddDepartment.txtslsubbg3.value=="")
			{
				alert("Please select Subbin in 3rd SLOC");
				//document.frmaddDepartment.txtslqtyg1.focus();
				return false;
			}
		}
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
			 <?php
			  if($role == "admin")
			  {
			  ?>
             <li><a href="#"> Masters </a>
              <ul>
                <li><a href="../Masters/home_classification.php" >&nbsp;Classification&nbsp;Master</a></li>
                <li><a href="../Masters/stores_home.php" >&nbsp;Item&nbsp;Master</a></li>
                <li><a href="../Masters/party_Masterhome.php" >&nbsp;Party&nbsp;Master</a></li>
                <li><a href="../Masters/selectbin.php" >&nbsp;SLOC&nbsp;Master</a></li>
                <li><a href="../Masters/role_home.php" >&nbsp;e-indent&nbsp;Master</a></li>
                <li><a href="../Masters/operator_home.php" >&nbsp;Operator&nbsp;Master</a></li>
				<li><a href="../Masters/viewers_home.php" >&nbsp;Viewers&nbsp;Master</a></li>
				<li><a href="../Masters/home_report.php" >&nbsp;Reports&nbsp;Master</a></li>
                <li><a href="../Masters/companyhome.php" >&nbsp;Parameters&nbsp;Master</a></li>
                <li><a href="../Masters/current_year.php" >&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
              </ul>
            </li>
            <li><a href="#">Transactions </a>
             <ul>
                <li><a href="add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
              </ul>
            </li>
			<?php
			}
			else
			{
			?>
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
			<?php
			}
			?>
            <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
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
              <ul style="vertical-align:text-top"> <li><a href="adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="help.php">Help </a>| </li>    <li> &nbsp;<a href="../logout.php">Logout </a> </li>
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
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction Arrival - Opening Stock admin </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);
	*/
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	 <input name="txt14" value="" type="hidden"> 
	 <input name="code" value="<?php echo $code;?>" type="hidden"> 
	 <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Opening Stock  </td>
</tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<td width="226" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="280"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid" type="text" size="5" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $code1?>"/></td>

<td width="108" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="226" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="6" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" maxlength="10"//>&nbsp; </td>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
<tr class="Dark" height="25">
           <td width="210"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
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
		
<td width="141" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="191" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
<tr class="Light" height="25">
            <td width="226" height="24"  align="right"  valign="middle" class="tblheading">Type &nbsp;</td>
            <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk22(this.value);" />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk22(this.value);" />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
         </tr>

		 <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="" onchange="upschk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onkeypress="return isNumberKey(event)" value="" onchange="qtychk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
//$quer7=mysql_query("SELECT DISTINCT binname,binid FROM tbl_bin order by binid Asc"); 
?>

<tr class="Light" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="tblslocnog" style="width:60px;" onchange="bingood(this.value);"  disabled="disabled">
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
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:60px;" onchange="wh1(this.value);"  >
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
<td width="105" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
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
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="upsf1(this.value);" onkeypress="return isNumberKey(event)" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf1(this.value);"  onkeypress="return isNumberKey(event)" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="upsf2(this.value);"  onkeypress="return isNumberKey(event)" value="" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf2(this.value);" onkeypress="return isNumberKey(event)" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="upsf3(this.value);" onkeypress="return isNumberKey(event)" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onchange="qtyf3(this.value);" onkeypress="return isNumberKey(event)" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_return_stores_st.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
