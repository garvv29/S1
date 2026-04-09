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
	/*
	if(isset($_REQUEST['t_id']))
	{
	$tid = $_REQUEST['t_id'];
	}*/
	
	if(isset($_POST['frm_action'])=='submit')
	{ 
		//id=trim($_POST['txtid']);
		//$date=trim($_POST['date']);
		$p_id=trim($_POST['trid']);
		$txtcla=trim($_POST['txtcla']);
		$txtremarks=$_POST['txtremarks'];
		$txtclass=trim($_POST['txtclass']);
		$txtitem=trim($_POST['txtitem']);
		$txtuom=trim($_POST['txtuom']);
        $txtremarks=str_replace("&","and",$txtremarks);   
		echo "<script>window.location='add_gtod_preview.php?p_id=$p_id&txtcla=$txtcla&txtclass=$txtclass&txtitem=$txtitem&txtuom=$txtuom&txtremarks=$txtremarks'</script>";
		
	}

$a="TGD";
	$s_chk=mysql_query("SELECT * FROM tbl_gtod where yearcode='$yearid_id'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(code) FROM tbl_gtod where yearcode='$yearid_id' ORDER BY code DESC";
	else
	$sql_code="SELECT MAX(code) FROM tbl_gtod where yearcode='$yearid_id' ORDER BY code DESC";
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
<title>Stores-Transaction- Add Good To Damage</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="gdconv.js"></script>
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
	if(document.frmaddDepartment.txtcla.value!="")
	{
		showUser(classval,'vitem','captive','','','','','');
	}
	else
	{
		alert("Please select Vendor");
		document.frmaddDepartment.txtclass.selectedIndex=0;
	}
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

function chktyp()
{ 
	if(document.frmaddDepartment.txtitem.value!="")
	{
			var opttyp="good";
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			var trid=document.frmaddDepartment.trid.value;
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,trid,'');
			
	}
	else
	{
		alert("please select Item first");
		
	}
}

function showsloc(val1, val2, val3)
{
document.frmaddDepartment.oups.value=val1;
document.frmaddDepartment.oqty.value=val2;
document.frmaddDepartment.orwoid.value=val3;
var trid=document.frmaddDepartment.trid.value;
//alert(val3);
			var opttyp="damage";
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			//alert(itmid);
showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'');
//document.getElementById('sloc1').style.display="block";
}

function editrec(v1,v2,v3)
{
//alert(v1);
//alert(v2);
//alert(v3);
//etdrecgd
showUser(v1,'subsubdiv','etdrecgd',v2,v3,'','','');
//showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,itmid,'','');
}


/*function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDepartment.txtqtyg.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDepartment.txtslwhg1.selectedIndex=0;
	}
}

function wh2(wh2val)
{   
	if(document.frmaddDepartment.txtqtyg.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','','','','');
	}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDepartment.txtslwhg2.selectedIndex=0;
	}
}

function wh3(wh3val)
{
	if(document.frmaddDepartment.txtqtyg.value > 0)
	{
			showUser(wh3val,'bing3','wh','bing3','','','','');
	}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDepartment.txtslwhg3.selectedIndex=0;
	}
}
*/
function wh4(wh4val)
{
		/*if(document.frmaddDepartment.txtqtyd.value > 0)
		{*/
			showUser(wh4val,'bind1','wh','bind1','','','','');
		/*}
		else
		{
			alert("Please enter Quantity Damage");
			document.frmaddDepartment.txtslwhd1.selectedIndex=0;
		}*/
	
}

function wh5(wh5val)
{
	/*if(document.frmaddDepartment.txtqtyd.value > 0)
	{*/
		showUser(wh5val,'bind2','wh','bind2','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Damage");
		document.frmaddDepartment.txtslwhd2.selectedIndex=0;
	}*/
}

/*function bin1(bin1val)
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
}*/

function bin4(bin4val)
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
}

/*function subbin1(subbin1val)
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
}*/

function subbin4(subbin4val)
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
}

/*function upsf1(ups1val)
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
		if(document.frmaddDepartment.exusp1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp1.value);
			document.frmaddDepartment.balups1.value=parseInt(document.frmaddDepartment.txtslupsg1.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balups1.value="";
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
		if(document.frmaddDepartment.exusp2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp2.value);
			document.frmaddDepartment.balups2.value=parseInt(document.frmaddDepartment.txtslupsg2.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balups2.value="";
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
		document.frmaddDepartment.balups3.value=parseInt(document.frmaddDepartment.txtslupsg3.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balups3.value="";
	}
}*/

function upsf4(ups4val)
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
		if(document.frmaddDepartment.exupsd1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exupsd1.value);
		document.frmaddDepartment.balupsd1.value=parseInt(document.frmaddDepartment.txtslupsd1.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsd1.value="";
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
		if(document.frmaddDepartment.exupsd2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exupsd2.value);
		document.frmaddDepartment.balupsd2.value=parseInt(document.frmaddDepartment.txtslupsd2.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsd2.value="";
	}

}

/*function qtyf1(qty1val)
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
		document.frmaddDepartment.balqty1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqty1.value="";
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
		document.frmaddDepartment.balqty2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqty2.value="";
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
		document.frmaddDepartment.balqty3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqty3.value="";
	}
}*/

function qtyf4(qty4val)
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
		if(document.frmaddDepartment.exqtyd1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyd1.value);
		document.frmaddDepartment.balqtyd1.value=parseFloat(document.frmaddDepartment.txtslqtyd1.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtyd1.value="";
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
		if(document.frmaddDepartment.exqtyd2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyd2.value);
		document.frmaddDepartment.balqtyd2.value=parseFloat(document.frmaddDepartment.txtslqtyd2.value)+parseFloat(exq);
	}
	else
	{
	document.frmaddDepartment.balqtyd2.value="";
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
		alert("Please select Classification");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	/*else if(document.frmaddDepartment.txtupsd.value=="")
	{
		alert("Please enter UPS Received Damage");
		document.frmaddDepartment.txtupsd.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtqtyd.value=="")
	{
		alert("Please enter Quantity Received Damage");
		document.frmaddDepartment.txtqtyd.focus();
		return false;
	}*/
	else if((document.frmaddDepartment.txtslqtyd1.value>0) && (document.frmaddDepartment.txtslsubbd1.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyd2.value>0) && (document.frmaddDepartment.txtslsubbd2.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else
	{	//alert("hi");
		
		var u4=document.frmaddDepartment.txtslupsd1.value;
		var u5=document.frmaddDepartment.txtslupsd2.value;
		var q4=document.frmaddDepartment.txtslqtyd1.value;
		var q5=document.frmaddDepartment.txtslqtyd2.value;
		var d=document.frmaddDepartment.otqty.value;
		var u=document.frmaddDepartment.otups.value;
		
		if(q4=="")q4=0;if(q5=="")q5=0;
		if(u4=="")u4=0;if(u5=="")u5=0;
		if(d=="")d=0;
		if(u=="")u=0;
		var qtyd=parseFloat(q4)+parseFloat(q5);
		var upsd=parseInt(u4)+parseInt(u5);
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
		{	var a=formPost(document.getElementById('mainform'));
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
		alert("Please select Classification");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	/*else if(document.frmaddDepartment.txtupsd.value=="")
	{
		alert("Please enter UPS Received Damage");
		document.frmaddDepartment.txtupsd.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtqtyd.value=="")
	{
		alert("Please enter Quantity Received Damage");
		document.frmaddDepartment.txtqtyd.focus();
		return false;
	}*/
if(parseInt(document.frmaddDepartment.cntchk.value) == 1)
	{
		if((document.frmaddDepartment.txtslqtyd1.value>0) && (document.frmaddDepartment.txtslsubbd1.value==""))
		{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
		}
	} 
	
if(parseInt(document.frmaddDepartment.cntchk.value) == 2)
	{
		if((document.frmaddDepartment.txtslqtyd2.value>0) && (document.frmaddDepartment.txtslsubbd2.value==""))
		{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
		}
	} 
	/*else
	{*/	//alert("hi");
		
		
			if(parseInt(document.frmaddDepartment.cntchk.value) == 1)
			{
			var u4=document.frmaddDepartment.txtslupsd1.value;
			var u5=0;
			var q4=document.frmaddDepartment.txtslqtyd1.value;
			var q5=0;
			}
			if(parseInt(document.frmaddDepartment.cntchk.value) == 2)
			{
			var u4=document.frmaddDepartment.txtslupsd1.value;
			var u5=document.frmaddDepartment.txtslupsd2.value;
			var q4=document.frmaddDepartment.txtslqtyd1.value;
			var q5=document.frmaddDepartment.txtslqtyd2.value;
			}
		
		var d=document.frmaddDepartment.otqty.value;
		var u=document.frmaddDepartment.otups.value;
		
		if(q4=="")q4=0;if(q5=="")q5=0;
		if(u4=="")u4=0;if(u5=="")u5=0;
		if(d=="")d=0;
		if(u=="")u=0;
		var qtyd=parseFloat(q4)+parseFloat(q5);
		var upsd=parseInt(u4)+parseInt(u5);
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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }


function mySubmit()
{
	if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	if(document.frmaddDepartment.txtcla.value=="")
	{
		alert("Select Vendor");
		document.frmaddDepartment.txtcla.focus();
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Good To Damage</td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
  	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="code" value="<?php echo $code;?>" />
	  <input type="hidden" name="rettyp" value="good" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Add Good To Damage</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
 <td width="224"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="359"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="88" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="169" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>"  /></td>
</tr>
<tr class="Light" height="30">
 <?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where classification='Vendor' or classification='Internal Return' order by business_name "); 
?>

<td align="right"  valign="middle" class="tblheading">Select Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txtcla" style="width:230px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');">
<option value="" selected="selected">--Select Party--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
<?php
//$quer4=mysql_query("SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;</td>
</tr>
<?php 
//$quer3=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
$trid=0;$rid=0;
?>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="224"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>	</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores order by stores_item") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void();" onclick="openslocpop();">SLOC Lookup</a></td>
		
<td width="88" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex=""  readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
<input type="hidden" name="itmdchk" value="" />
</table>
<div id="maindiv">
<div id="subdiv">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
    <td colspan="4" align="center" valign="middle" class="tblheading">Good Pre Transfer </td>
    <td colspan="3" align="center" valign="middle" class="tblheading">Damage Transfer</td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Good Post Transfer</td>
    <td colspan="2"  align="center" valign="middle" class="tblheading">Damage Post Transfer</td>
    <td width="52" rowspan="2"  align="center" valign="middle" class="tblheading">Edit</td>
  </tr>
  <tr class="tblsubtitle" height="25">
    <td width="32" align="center" valign="middle" class="tblheading">#</td>
    <td width="99" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="63" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="68" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="89" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="64" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="71" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="74" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="79" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="64" align="center" valign="middle" class="tblheading">UPS</td>
    <td width="69" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" />
</div>
<div id="subsubdiv">
</div></div><br />

 <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_g.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;</td>
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
