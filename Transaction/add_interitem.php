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
	//$lgnid="Adm1";
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
	if(isset($_POST['frm_action'])=='submit')
	{ 
		$p_id=trim($_POST['trid']);
		$txtremarks=$_POST['txtremarks'];
		$txtclass=trim($_POST['txtclass']);
		$txtitem=trim($_POST['txtitem']);
		$txtuom=trim($_POST['txtuom']);
		$rettyp=trim($_POST['rettyp']);
		 $txtremarks=str_replace("&","and",$txtremarks);
		echo "<script>window.location='add_iitr_preview.php?p_id=$p_id&txtclass=$txtclass&txtitem=$txtitem&txtuom=$txtuom&txtremarks=$txtremarks&rettyp=$rettyp'</script>";
		}

$a="TIT";
	$s=mysql_query("select * from tbl_iitr") or die(mysql_error());
	$r=mysql_num_rows($s);
	if($r > 0)
	{
	$sql_code="SELECT MAX(tcode) FROM tbl_iitr where yearcode='$yearid_id'  ORDER BY tcode DESC";
	}
	else
	{
	$sql_code="SELECT MAX(tcode) FROM tbl_iitr where yearcode='$yearid_id' ORDER BY tcode DESC";
	}
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1=$a.$code."/".$yearid_id."/".$lgnid;
		}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transction-Add Interitem Transfer</title>
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
<script type="text/javascript" src="iitr.js"></script>
<script type="text/javascript">
function modetchk(classval) 
{
//if(document.frmaddDepartment.txt1.value!="")
showUser(classval,'vitem','item','','','','','');
//else
//	alert("Please select Mode of Transit first");
}
/*else
	{
		alert("Please Select Classification first")
		//document.frmaddDepartment.txtups.value="";
		//document.frmaddDepartment.txtqty.value=="";
		document.frmaddDepartment.txtclass.focus();
	}
*/
function openslocpop()
{
	if(document.frmaddDepartment.txtitem.value!="")
	{
		var itm=document.frmaddDepartment.txtitem.value;
		winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
	}
	else
	{
		alert("Please Select Item");
		document.frmaddDepartment.txtitem.focus();
	}
}
function classchk(itval)
{
if(document.frmaddDepartment.txtclass.value!="")
{
	showUser(itval,'uom','itemuom','','','','','');
	setTimeout('chktyp()',200);
}
else
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDepartment.txtclass.focus();
}
}
function classchk1(itval1)
{
if(document.frmaddDepartment.txtclass.value!="")
{
	showUser(itval1,'uom1','itemuom1','','','','','');
	setTimeout('chktyp1()',200);
}
else
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDepartment.txtclass.focus();
}
}
function chktyp()
{ 
	if(document.frmaddDepartment.txtitem.value!="")
	{
			var opttyp="good";
			document.frmaddDepartment.rettyp.value=opttyp;
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			showUser(opttyp,'maindiv','slocshowmrv',opttyp,clasid,itmid,opttyp,'');
			
	}
	else
	{
		alert("please select Item first");
		
	}
}

function chktyp1()
{ 
document.getElementById('subsubdiv').style.display="block";	
if(document.frmaddDepartment.txtitem1.value!="")
	{
			var opttyp="good";
			document.frmaddDepartment.rettyp.value=opttyp;
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem1.value;
			showUser(opttyp,'subsubdiv','slocshowsub',opttyp,clasid,itmid,opttyp,'');
			
	}
	else
	{
		alert("please select Transfer to Item  first");
		
	}
}	

function showsloc(val1, val2, val3)
{//alert(val3);
document.frmaddDepartment.oups.value=val1;
document.frmaddDepartment.oqty.value=val2;
document.frmaddDepartment.orowid.value=val3;
document.getElementById('sloc1').style.display="block";
}

function editrec(v1,v2,v3,u,q)
{
//alert(v1);
//alert(v2);
//alert(v3);
//etdrecgd
document.frmaddDepartment.oups.value=u;
document.frmaddDepartment.oqty.value=q;
showUser(v1,'subdiv','etdrecgd',v2,v3,'','','');
}


function wh1(wh1val)
{ //alert(wh1val);
	/*if(document.frmaddDepartment.tblslocnog.value!="")
	{*/
		showUser(wh1val,'bing1','wh','bing1','','','','');
	/*}
	else
	{
		alert("Please select SLOC number of Bins Good");
	}*/
}

function wh2(wh2val)
{   
	/*if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		{*/
		showUser(wh2val,'bing2','wh','bing2','','','','');
		/*}
		else
		{
		alert("Please enter Quantity in first SLOC Row in Good section");
		}
	}
	else
	{
		alert("Please select Warehouse in first Row in Good section");
	}*/
}

function wh3(wh3val)
{
	/*if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		{*/
			showUser(wh3val,'bing3','wh','bing3','','','','');
		/*}
		else
		{
			alert("Please enter Quantity in second SLOC Row in Good section");
		}
	}
	else
	{
		alert("Please select Warehouse in second Row in Good section");
	}*/
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

function subbinvchk(v1,v2,v3,v4,v5,v6,v7,v8,v9)
{
//alert(v1);alert(v2);alert(v3);alert(v4);alert(v5);alert(v6);alert(v7);alert(v8);
var s1='slcrow'+v9;
var s2='subbinv';
var s3='txtslsubbg'+v9;
//alert(s1); alert(s2); alert(s3);
showUser(v1,s1,s2,v4,s3,v6,v7,v8);
}


function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		if(w1==w2 || w1==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		document.frmaddDepartment.txtslsubbg1.focus();
		}
		
		var slocnogood="";//document.frmaddDepartment.tblslocnog.value;
		var trid=document.frmaddDepartment.trid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg1.value!="")
		var upsv1=document.frmaddDepartment.txtslupsg1.value;
		else
		var upsv1="";
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		if(w1==w2 || w2==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		document.frmaddDepartment.txtslsubbg2.focus();
		}
		
		//if(document.frmaddDepartment.txtslsubbg1.value!="")
		
		var slocnogood="";//document.frmaddDepartment.tblslocnog.value;
		var trid=document.frmaddDepartment.trid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg2.value!="")
		var upsv2=document.frmaddDepartment.txtslupsg2.value;
		else
		var upsv2="";
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,upsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbing3.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		if(w1==w3 || w2==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg3.selectedIndex=0;
		document.frmaddDepartment.txtslsubbg3.focus();
		}
		
		var slocnogood="";//document.frmaddDepartment.tblslocnog.value;
		var trid=document.frmaddDepartment.trid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg3.value!="")
		var upsv3=document.frmaddDepartment.txtslupsg3.value;
		else
		var upsv3="";
		if(document.frmaddDepartment.txtslqtyg3.value!="")
		var qtyv3=document.frmaddDepartment.txtslqtyg3.value;
		else
		var qtyv3="";
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,upsv3,qtyv3,trid);
		//showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing3.focus();
	}
}


/*function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood="";
		//document.frmaddDepartment.tblslocnog.value;
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
		var fn='slocrow1';
		var sn='subbin';
		var tn='txtslsubbg1';
		//var sh=function(){subbinvchk(subbin1val,fn,sn,itemv,tn,slocnogood,upsv1,qtyv1,'1');}
		//setTimeout(sh,200); 
	}
	else
	{
		alert("Please select Bin in first Row in Good section");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var slocnogood="";
		//document.frmaddDepartment.tblslocnog.value;
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
		var fn='slocrow2';
		var sn='subbin';
		var tn='txtslsubbg2';
		//var sh=function(){subbinvchk(subbin2val,fn,sn,itemv,tn,slocnogood,upsv2,qtyv2,'2');}
		//setTimeout(sh,200); 
	}
	else
	{
		alert("Please select Bin in second Row in Good section");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbing3.value!="")
	{	
		var slocnogood="";
		//document.frmaddDepartment.tblslocnog.value;
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
		var fn='slocrow3';
		var sn='subbin';
		var tn='txtslsubbg3';
		//var sh=function(){subbinvchk(subbin3val,fn,sn,itemv,tn,slocnogood,upsv3,qtyv3,'3');}
		//setTimeout(sh,200); 
	}
	else
	{
		alert("Please select Bin in third Row in Good section");
		document.frmaddDepartment.txtslbing3.focus();
	}
}
*/

function upsf1(ups1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
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
		/*if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{*/
		var exu=0;
		if(document.frmaddDepartment.exusp1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp1.value);
			document.frmaddDepartment.balupsg1.value=parseInt(document.frmaddDepartment.txtslupsg1.value)+parseInt(exu);
			
			
			/*document.getElementById('ups2').value=parseInt(document.frmaddDepartment.oups.value)-parseInt(ups1val);
			if(document.getElementById('ups2').value<=0)document.getElementById('ups2').value=1;*/
		//}
		
	}
	else
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslupsg1.value=1;
	}
}

function upsf2(ups2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin ");
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
		var exu=0;
		if(document.frmaddDepartment.exusp2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp2.value);
			document.frmaddDepartment.balupsg2.value=parseInt(document.frmaddDepartment.txtslupsg2.value)+parseInt(exu);
		/*if(document.frmaddDepartment.tblslocnog.value==3 || document.frmaddDepartment.tblslocnog.value=="3")
		{
			document.getElementById('ups3').value=parseInt(document.frmaddDepartment.oups.value)-parseInt(document.getElementById('ups1').value)-parseInt(ups2val);
			if(document.getElementById('ups3').value<=0)document.getElementById('ups3').value=1;
		}*/
		
	}
	else
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslupsg2.value=1;
	}
}

function upsf3(ups3val)
{
	if(document.frmaddDepartment.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslupsg3.value="";
		document.frmaddDepartment.txtslsubbg3.focus();
	}
	if(document.frmaddDepartment.txtslupsg3.value!="")
	{
		if(document.frmaddDepartment.txtslupsg3.value==0 || document.frmaddDepartment.txtslupsg3.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslupsg3.value="";
			document.frmaddDepartment.txtslupsg3.focus();
		}
		var exu=0;
		if(document.frmaddDepartment.exusp3.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp3.value);
		document.frmaddDepartment.balupsg3.value=parseInt(document.frmaddDepartment.txtslupsg3.value)+parseInt(exu);
	}
	else
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslupsg3.value=1;
	}
}


function qtyf1(qty1val)
{
	if(document.frmaddDepartment.txtslupsg1.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslqtyg1.value="";
	}
	if(document.frmaddDepartment.txtslqtyg1.value!="")
	{
			if(document.frmaddDepartment.txtslqtyg1.value==0 || document.frmaddDepartment.txtslqtyg1.value=="0")
			{
				alert("Quantity can not be ZERO");
				document.frmaddDepartment.txtslqtyg1.value="";
				document.frmaddDepartment.txtslqtyg1.focus();
			}
			
		var exq=0;
		if(document.frmaddDepartment.exqty1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty1.value);
		document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtyg1.value="";
	}
}

function qtyf2(qty2val)
{
	if(document.frmaddDepartment.txtslupsg2.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslqtyg2.value="";
		document.frmaddDepartment.txtslupsg2.focus();
	}
	if(document.frmaddDepartment.txtslqtyg2.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg2.value==0 || document.frmaddDepartment.txtslqtyg2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg2.value="";
			document.frmaddDepartment.txtslqtyg2.focus();
		}
		var exq=0;
		if(document.frmaddDepartment.exqty2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty2.value);
		document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtyg2.value="";
	}
}

function qtyf3(qty3val)
{
	if(document.frmaddDepartment.txtslupsg3.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslqtyg3.value="";
		document.frmaddDepartment.txtslupsg3.focus();
	}
	if(document.frmaddDepartment.txtslqtyg3.value!="")
	{
		if(document.frmaddDepartment.txtslqtyg3.value==0 || document.frmaddDepartment.txtslqtyg3.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg3.value="";
			document.frmaddDepartment.txtslqtyg3.focus();
		}
		var exq=0;
		if(document.frmaddDepartment.exqty3.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty3.value);
		document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtyg3.value="";
	}
}


function wh4(wh4val)
{
		if(document.frmaddDepartment.tblslocnod.value!="")
		{
			showUser(wh4val,'bind1','wh','bind1','','','','');
		}
		else
		{
			alert("Please select SLOC number of Bins Damage");
		}
	
}

function wh5(wh5val)
{
	if(document.frmaddDepartment.txtslwhd1.value!="")
	{
		if(document.frmaddDepartment.txtslqtyd1.value!="")
		{
		showUser(wh5val,'bind2','wh','bind2','','','','');
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


function bin4(bin4val)
{
	if(document.frmaddDepartment.txtslwhd1.value!="")
	{
		showUser(bin4val,'sbind1','bin','txtslsubbd1','','','','');
	}
	else
	{
		alert("Please select Warehouse in first Row in Damage section");
	}
}

function bin5(bin5val)
{
	if(document.frmaddDepartment.txtslwhd2.value!="")
	{
		showUser(bin5val,'sbind2','bin','txtslsubbd2','','','','');
	}
	else
	{
		alert("Please select Warehouse in second Row in Damage section");
	}
}

function subbin4(subbin4val)
{
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbind1.value!="")
	{	
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsd1.value!="")
		var upsv1=document.frmaddDepartment.txtslupsd1.value;
		else
		var upsv1="";
		if(document.frmaddDepartment.txtslqtyd1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyd1.value;
		else
		var qtyv1="";
		showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbd1',slocnodamage,upsv1,qtyv1);
		//showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbd1','','','');
	}
	else
	{
		alert("Please select Bin in first Row in Damage section");
		document.frmaddDepartment.txtslbind1.focus();
	}
}

function subbin5(subbin5val)
{
	var itemv=document.frmaddDepartment.txtitem1.value;
	if(document.frmaddDepartment.txtslbind1.value!="")
	{	
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsd2.value!="")
		var upsv2=document.frmaddDepartment.txtslupsd2.value;
		else
		var upsv2="";
		if(document.frmaddDepartment.txtslqtyd2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyd2.value;
		else
		var qtyv2="";
		showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbd2',slocnodamage,upsv2,qtyv2);
		//showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbd2','','','');
	}
	else
	{
		alert("Please select Bin in first Row in Damage section");
		document.frmaddDepartment.txtslbind1.focus();
	}
}

function upsf4(ups4val)
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
			document.getElementById('ups5').value=parseInt(document.frmaddDepartment.oups.value)-parseInt(ups4val);
		}
		
	}
}

function upsf5(ups5val)
{
	if(document.frmaddDepartment.txtslsubbd2.value=="")
	{
		alert("Please select Sub Bin in second Row in Damage section");
		document.frmaddDepartment.txtslupsd2.value="";
		document.frmaddDepartment.txtslsubbd2.focus();
	}
}

function qtyf4(qty4val)
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
		if(document.frmaddDepartment.tblslocnod.value==2 || document.frmaddDepartment.tblslocnod.value=="2")
		{
			document.getElementById('qty5').value=parseFloat(document.frmaddDepartment.oqty.value)-parseFloat(qty4val);
		}
	}
}

function qtyf5(qty5val)
{
	if(document.frmaddDepartment.txtslupsd2.value=="")
	{
		alert("Please enter UPS in second Row in Damage section");
		document.frmaddDepartment.txtslqtyd2.value="";
		document.frmaddDepartment.txtslupsd2.focus();
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

	function pform()
{
	if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtclass.value=="")
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
	else if(document.frmaddDepartment.txtitem1.value=="")
	{
		alert("Please select Item for transfer first");
		document.frmaddDepartment.txtitem1.focus();
		return false;
	}
	/*else if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please enter UPS as per DC first");
		document.frmaddDepartment.txtupsdc.focus();
		return false;
	}*/
	/*else if(document.frmaddDepartment.txtqtydc.value=="")
	{
		alert("Please enter Quantity as per DC first");
		document.frmaddDepartment.txtqtydc.focus();
		return false;
	}*/
	/*else if(document.frmaddDepartment.txtupsg.value=="")
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
	else if(document.frmaddDepartment.tblslocnog.value=="" && document.frmaddDepartment.tblslocnod.value=="")
	{
		alert("Please select SLOC > Good Item / Damage Item > No of Bins");
		document.frmaddDepartment.tblslocnog.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtslsubbd1.value=="")
		{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
		}*/
		else
		{	//alert("hi");
		
		var u1=document.frmaddDepartment.txtslupsg1.value;
		var u2=document.frmaddDepartment.txtslupsg2.value;
		var u3=document.frmaddDepartment.txtslupsg3.value;
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var q3=document.frmaddDepartment.txtslqtyg3.value;
		var d=document.frmaddDepartment.oqty.value;
		var u=document.frmaddDepartment.oups.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;
		if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;
		if(d=="")d=0;
		if(u=="")u=0;
		var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3);
		var upsd=parseInt(u1)+parseInt(u2)+parseInt(u3);
		var f=0;
		
		if(parseFloat(d) < parseFloat(qtyd))
		{
		alert("Please check. Quantity distributed in Bins can not be more than Quantity to be Transfer ");
		return false;
		f=1;
		}
		if(qtyd==0)
		{
		alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
		return false;
		f=1;
		}
		if(parseFloat(d) == parseFloat(qtyd))
		{
		document.frmaddDepartment.oups.value=0;
		}
		if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
		{
		document.frmaddDepartment.oups.value=1;
		}
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDepartment.txtremarks.value=a;
		showUser(a,'maindiv','mformcc','','','','','');
		}
	}
}	

function pformupdate()
{

if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
else if(document.frmaddDepartment.txtclass.value=="")
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
	else if(document.frmaddDepartment.txtitem1.value=="")
	{
		alert("Please select Item for transfer first");
		document.frmaddDepartment.txtitem1.focus();
		return false;
	}
	/*else if(document.frmaddDepartment.txtupsdc.value=="")
	{
		alert("Please enter UPS as per DC first");
		document.frmaddDepartment.txtupsdc.focus();
		return false;
	}*/
	/*else if(document.frmaddDepartment.txtqtydc.value=="")
	{
		alert("Please enter Quantity as per DC first");
		document.frmaddDepartment.txtqtydc.focus();
		return false;
	}*/
	/*else if(document.frmaddDepartment.txtupsg.value=="")
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
	else if(document.frmaddDepartment.tblslocnog.value=="" && document.frmaddDepartment.tblslocnod.value=="")
	{
		alert("Please select SLOC > Good Item / Damage Item > No of Bins");
		document.frmaddDepartment.tblslocnog.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtslsubbd1.value=="")
		{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
		}*/
		else
		{	//alert("hi");
		
		var u1=document.frmaddDepartment.txtslupsg1.value;
		var u2=document.frmaddDepartment.txtslupsg2.value;
		var u3=document.frmaddDepartment.txtslupsg3.value;
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var q3=document.frmaddDepartment.txtslqtyg3.value;
		var d=document.frmaddDepartment.oqty.value;
		var u=document.frmaddDepartment.oups.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;
		if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;
		if(d=="")d=0;
		if(u=="")u=0;
		var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3);
		var upsd=parseInt(u1)+parseInt(u2)+parseInt(u3);
		var f=0;
		
		if(parseFloat(d) < parseFloat(qtyd))
		{
		alert("Please check. Quantity distributed in Bins can not be more than Quantity to be Transfer ");
		return false;
		f=1;
		}
		if(qtyd==0)
		{
		alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
		return false;
		f=1;
		}
		if(parseFloat(d) == parseFloat(qtyd))
		{
		document.frmaddDepartment.oups.value=0;
		}
		if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
		{
		document.frmaddDepartment.oups.value=1;
		}
		if(f==1)
		{
		return false;
		}
		else
		{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDepartment.txtremarks.value=a;
		showUser(a,'maindiv','mformccupdate','','','','','');
		}
	}
}

function mySubmit()
{
	if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Please select Classification first");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	if(document.frmaddDepartment.txtremarks.value=="")
	{
		alert("Please enter Remarks first");
		document.frmaddDepartment.txtremarks.focus();
		return false;
	}

if(document.frmaddDepartment.trid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
		}

return true;

}


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

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
              <ul style="vertical-align:text-top"><li> <a href="adminprofile.php">Profile </a> | </li>
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
	      <td width="813" height="25" class="Mainheading" align="left">&nbsp;Transaction - Inter Item Transfer</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="rettyp" value="good" />
	  <input type="hidden" name="code" value="<?php echo $code;?>" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
	 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Inter Item Transfer </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="202" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="405"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

 <td width="99" height="24"  align="right"  valign="middle" class="tblheading">Transfer &nbsp;Date&nbsp;</td>
 <td width="184"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdate" type="text" size="6" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>"/>&nbsp;</td>
</tr>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
<tr class="Dark" height="25">
   <td width="202"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
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
<td width="405" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="99" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="184"  align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />
<tr class="Light" height="25">
            <td width="202" height="24"  align="right"  valign="middle" class="tblheading">Type &nbsp; </td>
            <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="hidden" class="tbltext" value="good" onClick="chktyp(this.value);" />Good</td>
         </tr>
</table>
<div id="maindiv">
<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Stock in Hand</td>
  <td colspan="4" align="center" valign="middle" class="tblheading">Transfered to</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  <td width="20" colspan="2" rowspan="2" align="center" valign="middle" class="tblheading">&nbsp;</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="14" align="center" valign="middle" class="tblheading">#</td>
<td width="95" align="center" valign="middle" class="tblheading">Classification</td>
<td width="211" align="center" valign="middle" class="tblheading">Item</td>
<td width="69" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="210" align="center" valign="middle" class="tblheading">Item</td>
<td width="69" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
<td width="33" align="center" valign="middle" class="tblheading">UPS</td>
<td width="33" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
<input type="hidden" name="trid" value="<?php echo $trid;?>" /> <input type="hidden" name="orowid" value="" />
<br />
<div id="subdiv">
</div>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table>
<table align="center" width="914" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_interitem.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;</td>
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
