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
	
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//id=trim($_POST['txtid']);
		//$date=trim($_POST['date']);
		$p_id=trim($_POST['trid']);
		$txtremarks=$_POST['txtremarks'];
		$txtclass=trim($_POST['txtclass']);
		$txtitem=trim($_POST['txtitem']);
		$txtuom=trim($_POST['txtuom']);
        $txtremarks=str_replace("&","and",$txtremarks);
		echo "<script>window.location='add_dtog_preview.php?p_id=$p_id&txtclass=$txtclass&txtitem=$txtitem&txtuom=$txtuom&txtremarks=$txtremarks'</script>";
		
	}

/*$a="DG";
	$sql_code="SELECT MAX(code) FROM tbl_dtog ORDER BY code DESC";
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
		}*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transaction- Edit D To G</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="dgconv.js"></script>
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
					document.getElementById('itm').selectedIndex=0;
					return false;
				}
				
			}
		}
		showUser(itval,'uom','itemuom','','','','','');
		setTimeout('chktyp()',800);
	}
	else
	{
		alert("Please Select Classification")
		//document.frmaddDepartment.txtitem.
		document.getElementById('itm').selectedIndex=0;
		document.frmaddDepartment.txtclass.focus();
	}
}

function chktyp()
{ 
	if(document.frmaddDepartment.txtitem.value!="")
	{
			var opttyp="damage";
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,opttyp,'');
			
	}
	else
	{
		alert("please select Item first");
		
	}
}

function showsloc(val1, val2, val3)
{//alert(val3);

document.frmaddDepartment.oups.value=val1;
document.frmaddDepartment.oqty.value=val2;
document.frmaddDepartment.orwoid.value=val3;
var trid=document.frmaddDepartment.trid.value;
//alert(val3);
			var opttyp="good";
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			//alert(itmid);
showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'');
//document.getElementById('sloc1').style.display="block";


/*document.frmaddDepartment.oups.value=val1;
document.frmaddDepartment.oqty.value=val2;
document.frmaddDepartment.orwoid.value=val3;
document.getElementById('sloc1').style.display="block";*/
}

function editrec(v1,v2,v3)
{
//alert(v1);
//alert(v2);
//alert(v3);
//etdrecgd
showUser(v1,'subsubdiv','etdrecgd',v2,v3,'','','');
}

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



/*function bindamage(dval)
{
		if(dval==1 || dval=="1")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="none";
			document.getElementById('ups4').value=document.frmaddDepartment.txtupsg.value;
			document.getElementById('qty4').value=document.frmaddDepartment.txtqtyg.value;
			document.getElementById('ups4').readOnly=false;
			document.getElementById('ups4').style.backgroundColor="#FFFFFF";
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
			document.getElementById('ups5').readOnly=false;
			document.getElementById('ups5').style.backgroundColor="#FFFFFF";
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
	
}*/


function wh1(wh1val)
{ //alert(wh1val);
/*if(document.frmaddDepartment.txtqtyg.value > 0)
	{*/
		showUser(wh1val,'bing1','wh','bing1','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}*/
}

function wh2(wh2val)
{   
	/*if(document.frmaddDepartment.txtqtyg.value > 0)
	{*/
		showUser(wh2val,'bing2','wh','bing2','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}*/
}

function wh3(wh3val)
{
	/*if(document.frmaddDepartment.txtqtyg.value > 0)
	{*/
			showUser(wh3val,'bing3','wh','bing3','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDepartment.txtslwhg3.selectedIndex=0;
	}*/
}

/*function wh4(wh4val)
{
		if(document.frmaddDepartment.txtqtyd.value > 0)
		{
			showUser(wh4val,'bind1','wh','bind1','','','','');
		}
		else
		{
			alert("Please enter Quantity Damage");
			document.frmaddDepartment.txtslwhd1.selectedIndex=0;
		}
	
}

function wh5(wh5val)
{
	/*if(document.frmaddDepartment.txtqtyd.value > 0)
	{
		showUser(wh5val,'bind2','wh','bind2','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Damage");
		document.frmaddDepartment.txtslwhd2.selectedIndex=0;
	}
}*/

function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	else
	{
		alert("Please select Warehouse");
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
		alert("Please select Warehouse");
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
		alert("Please select Warehouse");
	}
}

/*function bin4(bin4val)
{
	if(document.frmaddDepartment.txtslwhd1.value!="")
	{
		showUser(bin4val,'sbind1','bin','txtslsubbd1','','','','');
	}
	else
	{
		alert("Please select Warehouse");
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
		alert("Please select Warehouse");
	}
}*/

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
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
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb2').selectedIndex=0;
		document.frmaddDepartment.txtslbing2.focus();
		}
		
		if(document.frmaddDepartment.txtslsubbg1.value!="")
		
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
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing3.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		if(w1==w3 || w2==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb3').selectedIndex=0;
		document.frmaddDepartment.txtslbing3.focus();
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

/*function subbin4(subbin4val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbind1.value!="")
	{	
		var w4=document.frmaddDepartment.txtslwhd1.value+document.frmaddDepartment.txtslbind1.value+document.frmaddDepartment.txtslsubbd1.value;
		var w5=document.frmaddDepartment.txtslwhd2.value+document.frmaddDepartment.txtslbind2.value+document.frmaddDepartment.txtslsubbd2.value;
				if(w5==w4)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb4').selectedIndex=0;
				document.frmaddDepartment.txtslbind1.focus();
				}
				
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var slocnodamage="";//document.frmaddDepartment.tblslocnod.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslupsd1.value!="")
		var upsv1=document.frmaddDepartment.txtslupsd1.value;
		else
		var upsv1="";
		if(document.frmaddDepartment.txtslqtyd1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyd1.value;
		else
		var qtyv1="";
		showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbd1',slocnodamage,upsv1,qtyv1,trid);
		//showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbd1','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbind1.focus();
	}
}

function subbin5(subbin5val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbind1.value!="")
	{	
		var w4=document.frmaddDepartment.txtslwhd1.value+document.frmaddDepartment.txtslbind1.value+document.frmaddDepartment.txtslsubbd1.value;
		var w5=document.frmaddDepartment.txtslwhd2.value+document.frmaddDepartment.txtslbind2.value+document.frmaddDepartment.txtslsubbd2.value;
		if(w4==w5)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb5').selectedIndex=0;
		document.frmaddDepartment.txtslbind2.focus();
		}
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var slocnodamage="";//document.frmaddDepartment.tblslocnod.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslupsd2.value!="")
		var upsv2=document.frmaddDepartment.txtslupsd2.value;
		else
		var upsv2="";
		if(document.frmaddDepartment.txtslqtyd2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyd2.value;
		else
		var qtyv2="";
		showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbd2',slocnodamage,upsv2,qtyv2,trid);
		//showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbd2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbind1.focus();
	}
}*/

function upsf1(ups1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslupsg1.value="";
		//document.frmaddDepartment.txtslsubbg1.focus();
	}
	if(document.frmaddDepartment.txtslupsg1.value!="")
	{
		if(parseInt(document.frmaddDepartment.txtslupsg1.value)==0 || document.frmaddDepartment.txtslupsg1.value=="")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslupsg1.value="";
			//document.frmaddDepartment.txtslupsg1.focus();
			
		}
		var exu=0;
		if(document.frmaddDepartment.exupsg1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exupsg1.value);
			document.frmaddDepartment.balupsg1.value=parseInt(document.frmaddDepartment.txtslupsg1.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsg1.value="";
	}
}

function upsf2(ups2val)
{
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslupsg2.value="";
		document.frmaddDepartment.txtslsubbg2.focus();
	}
	if(document.frmaddDepartment.txtslupsg2.value!="")
	{
		if(document.frmaddDepartment.txtslupsg2.value==0 || document.frmaddDepartment.txtslupsg2.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslupsg2.value="";
			document.frmaddDepartment.txtslupsg2.focus();
		}
		var exu=0;
		if(document.frmaddDepartment.exupsg2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exupsg2.value);
			document.frmaddDepartment.balupsg2.value=parseInt(document.frmaddDepartment.txtslupsg2.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsg2.value="";
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
		if(document.frmaddDepartment.exupsg3.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exupsg3.value);
		document.frmaddDepartment.balupsg3.value=parseInt(document.frmaddDepartment.txtslupsg3.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsg3.value="";
	}
}

/*function upsf4(ups4val)
{
	if(document.frmaddDepartment.txtslsubbd1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslupsd1.value="";
		document.frmaddDepartment.txtslsubbd1.focus();
	}
	if(document.frmaddDepartment.txtslupsd1.value!="")
	{
		if(document.frmaddDepartment.txtslupsd1.value==0 || document.frmaddDepartment.txtslupsd1.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslupsd1.value="";
			document.frmaddDepartment.txtslupsd1.focus();
		}
		var exu=0;
		if(document.frmaddDepartment.exupsgd1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exupsgd1.value);
		document.frmaddDepartment.balupsgd1.value=parseInt(document.frmaddDepartment.txtslupsd1.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsgd1.value="";
	}
}

function upsf5(ups5val)
{
	if(document.frmaddDepartment.txtslsubbd2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslupsd2.value="";
		document.frmaddDepartment.txtslsubbd2.focus();
	}
	if(document.frmaddDepartment.txtslupsd2.value!="")
	{
		if(document.frmaddDepartment.txtslsubbd2.value==0 || document.frmaddDepartment.txtslupsd2.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDepartment.txtslupsd2.value="";
			document.frmaddDepartment.txtslupsd2.focus();
		}
		var exu=0;
		if(document.frmaddDepartment.exupsgd2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exupsgd2.value);
		document.frmaddDepartment.balupsgd2.value=parseInt(document.frmaddDepartment.txtslupsd2.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsgd2.value="";
	}

}*/

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
		if(document.frmaddDepartment.exqtyg1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg1.value);
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
		if(document.frmaddDepartment.exqtyg2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg2.value);
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
		if(document.frmaddDepartment.exqtyg3.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg3.value);
		document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtyg3.value="";
	}
}

/*function qtyf4(qty4val)
{
	if(document.frmaddDepartment.txtslupsd1.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslqtyd1.value="";
		document.frmaddDepartment.txtslupsd1.focus();
	}
	if(document.frmaddDepartment.txtslqtyd1.value!="")
	{
		if(document.frmaddDepartment.txtslqtyd1.value==0 || document.frmaddDepartment.txtslqtyd1.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyd1.value="";
			document.frmaddDepartment.txtslqtyd1.focus();
		}
		var exq=0;
		if(document.frmaddDepartment.exqtygd1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtygd1.value);
		document.frmaddDepartment.balqtygd1.value=parseFloat(document.frmaddDepartment.txtslqtyd1.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtygd1.value="";
	}
}

function qtyf5(qty5val)
{
	if(document.frmaddDepartment.txtslupsd2.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslqtyd2.value="";
		document.frmaddDepartment.txtslupsd2.focus();
	}
	if(document.frmaddDepartment.txtslqtyd2.value!="")
	{
		if(document.frmaddDepartment.txtslqtyd2.value==0 || document.frmaddDepartment.txtslqtyd2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyd2.value="";
			document.frmaddDepartment.txtslqtyd2.focus();
		}
		var exq=0;
		if(document.frmaddDepartment.exqtygd2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtygd2.value);
		document.frmaddDepartment.balqtygd2.value=parseFloat(document.frmaddDepartment.txtslqtyd2.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtygd2.value="";
	}
}*/




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
	}*/
	else if((document.frmaddDepartment.txtslqtyg1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
		{
			
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
			
		}
	else if((document.frmaddDepartment.txtslqtyg2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
		}
	else if((document.frmaddDepartment.txtslqtyg3.value > 0) && (document.frmaddDepartment.txtslsubbg3.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg3.focus();
				return false;		
			
		}
		
		else
		{	//alert("hi");
		
		var u1=document.frmaddDepartment.txtslupsg1.value;
		var u2=document.frmaddDepartment.txtslupsg2.value;
		var u3=document.frmaddDepartment.txtslupsg3.value;
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var q3=document.frmaddDepartment.txtslqtyg3.value;
		var d=document.frmaddDepartment.otqty.value;
		var u=document.frmaddDepartment.otups.value;
		
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
		document.frmaddDepartment.otups.value=0;
		}
		if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
		{
		document.frmaddDepartment.otups.value=1;
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
if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDepartment.txtitem.focus();
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
	}*/
if(parseInt(document.frmaddDepartment.cntchk.value) == 1)
		{
			if((document.frmaddDepartment.txtslqtyg1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
			{
				
					alert("Sub Bin Not selected");	
					//document.frmaddDepartment.txtslsubbg1.focus();
					return false;		
				
			}
		}
if(parseInt(document.frmaddDepartment.cntchk.value) == 2)
		{
			if((document.frmaddDepartment.txtslqtyg2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;	
			}	
		}
if(parseInt(document.frmaddDepartment.cntchk.value) == 3)
		{
			if((document.frmaddDepartment.txtslqtyg3.value > 0) && (document.frmaddDepartment.txtslsubbg3.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg3.focus();
				return false;		
			}
		}
		
		/*else
		{*/	//alert("hi");
		
			if(parseInt(document.frmaddDepartment.cntchk.value) == 1)
			{
			var u1=document.frmaddDepartment.txtslupsg1.value;
			var u2=0;
			var u3=0;
			var q1=document.frmaddDepartment.txtslqtyg1.value;
			var q2=0;
			var q3=0;
			}
			if(parseInt(document.frmaddDepartment.cntchk.value) == 2)
			{
			var u1=document.frmaddDepartment.txtslupsg1.value;
			var u2=document.frmaddDepartment.txtslupsg2.value;
			var u3=0;
			var q1=document.frmaddDepartment.txtslqtyg1.value;
			var q2=document.frmaddDepartment.txtslqtyg2.value;
			var q3=0;
			}
			if(parseInt(document.frmaddDepartment.cntchk.value) == 3)
			{
			var u1=document.frmaddDepartment.txtslupsg1.value;
			var u2=document.frmaddDepartment.txtslupsg2.value;
			var u3=document.frmaddDepartment.txtslupsg3.value;
			var q1=document.frmaddDepartment.txtslqtyg1.value;
			var q2=document.frmaddDepartment.txtslqtyg2.value;
			var q3=document.frmaddDepartment.txtslqtyg3.value;
			}
		
		var d=document.frmaddDepartment.otqty.value;
		var u=document.frmaddDepartment.otups.value;
		
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
		document.frmaddDepartment.otups.value=0;
		}
		if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
		{
		document.frmaddDepartment.otups.value=1;
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
	//}
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Damage To Good</td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
  	  <td align="center" colspan="4" >
	  <?php
	$sql1=mysql_query("select * from tbl_dtog where did=$pid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$trid=$pid; $erid=0;
	
	
	$classid=$row['classification_id'];
	$itemid=$row['items_id'];
	
	$tdate=$row['date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	?>  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="code" value="<?php echo $row['code'];?>" />
	  <input type="hidden" name="rettyp" value="good" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Edit Damage To Good</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
 <td width="224"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="359"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TDG".$row['code']."/".$yearid_id."/".$lgnid;?></td>

<td width="88" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="169" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>"  /></td>
</tr>
<?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());

?>
		 <tr class="Light" height="25">
           <td width="224"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;"   onchange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($quer3)) { ?>
		<option <?php if($row['classification_id']==$noticia_class['classification_id']){ echo "Selected";} ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores classification_id='".$row['classification_id']."' and actstatus='Active'") or die(mysql_error());
?> 
		<tr class="Dark" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" style="width:230px;" onchange="classchk(this.value);" >
<option value="" >--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
		<option <?php if($row['items_id']==$noticia_item['items_id']){ echo "Selected";} ?> value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void();" onclick="openslocpop();">SLOC Lookup</a></td>
		
        <td width="88" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row['uom'];?>" /></td>
         </tr>
</table><br />

<div id="maindiv">
<div id="subdiv">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
    <td colspan="4" align="center" valign="middle" class="tblheading">Damage Pre Transfer </td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Good Transfer</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Damage Post Transfer</td>
    <td colspan="2"  align="center" valign="middle" class="tblheading">Good Post Transfer</td>
    <td width="80" rowspan="2"  align="center" valign="middle" class="tblheading">Edit</td>
</tr>
<tr class="tblsubtitle" height="25">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
    <td width="95" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="60" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="65" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="86" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="68" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="71" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="75" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="61" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="71" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
  $sloc1="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

$sloc1=$wareh1.$binn1.$subbinn1;


$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
$t=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['dgsubid']; else $subrid=$row_sloc['dgsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."<br/>";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."<br/>";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname']."<br/>";
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stld_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stld_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:hand" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $row_issue1[0]?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_dtog_sub where did='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
$t=mysql_num_rows($sql_sloc);
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['dgsubid']; else $subrid=$row_sloc['dgsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."<br/>";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."<br/>";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname']."<br/>";
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slups;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balups'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['stld_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stld_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blu;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $blq;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:hand" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $row_issue1[0]?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" />
</div>
<div id="subsubdiv">
<div  id="sloc1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
 <tr class="Dark" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">SLOC > Damage Item > No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="tblslocnod"  onchange="bindamage(this.value);" >
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
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd1" style="width:80px;" onchange="wh4(this.value);" >
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
<table align="center" height="27" border="1" cellspacing="0" width="100%" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >	<tr>
				
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd1" id="ups4" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  onchange="upsf4(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd1" id="qty4" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf4(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsd2" id="ups5" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)"  onchange="upsf5(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="35" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyd2" id="qty5" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf5(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div></div></div>
 <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" value="<?php echo $row['remarks'];?>" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_d.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;</td>
</tr>
</table></td><td width="30"></td>
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
