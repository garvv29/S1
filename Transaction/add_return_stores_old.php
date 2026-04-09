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
	 $yearid_id="09-10";	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	$logid="OP1";
	$lgnid="OP1";
	
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
		$partyid=trim($_POST['txtparty']);
		
		
		if($rbd == "")
		{
		$rbd=trim($_POST['txtrbd']);	
		}
	
	$rowid1=0;$rowid2=0;$rowid3=0;$rowid4=0;$rowid5=0; $god1=0;$god2=0;$god3=0; $dam1=0;$dam2=0;
	if(isset($_POST['twh1']))
	{
	$y = $_POST['twh1'];	 
	}
	if(isset($_POST['tb1']))
	{
	$z = $_POST['tb1'];	 
	}
	if(isset($_POST['tsb1']))
	{
	$a1 = $_POST['tsb1'];	 
	}
	if(isset($_POST['tqty1']))
	{
	$b1 = $_POST['tqty1'];	 
	}
	if(isset($_POST['tups1']))
	{
	$c1 = $_POST['tups1'];	 
	}
	if(isset($_POST['twh2']))
	{
	$d1 = $_POST['twh2'];	 
	}
	if(isset($_POST['tb2']))
	{
	$e1= $_POST['tb2'];	 
	}
	if(isset($_POST['tsb2']))
	{
	$f1 = $_POST['tsb2'];	 
	}
	if(isset($_POST['tqty2']))
	{
	$g1 = $_POST['tqty2'];	 
	}
	if(isset($_POST['tups2']))
	{
	$h1 = $_POST['tups2'];	 
	}
	if(isset($_POST['twh3']))
	{
	$i1 = $_POST['twh3'];	 
	}
	if(isset($_POST['tb3']))
	{
	$j1 = $_POST['tb3'];	 
	}
	if(isset($_POST['tsb3']))
	{
	$k1 = $_POST['tsb3'];	 
	}
	if(isset($_POST['tqty3']))
	{
	$l1 = $_POST['tqty3'];	 
	}
	if(isset($_POST['tups3']))
	{
	$m1 = $_POST['tups3'];	 
	}
	$good1=0;$good2=0;$good3=0;
	
	if($b1 > 0)
	{
		$good1=1; $god1=1;
		if(isset($_POST['orowid1']))
		{
		$rowid1 = $_POST['orowid1'];	 
		}
	}
	if($g1 > 0)
	{
		$good2=1; $god2=1;
		if(isset($_POST['orowid2']))
		{
		$rowid2 = $_POST['orowid2'];	 
		}
	}
	if($l1 > 0)
	{
		$good3=1; $god3=1;
		
		if(isset($_POST['orowid3']))
		{
		$rowid3 = $_POST['orowid3'];	 
		}
	}
	
	$x=$good1+$good2+$good3;
	
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		//echo "Submitted";
		
		
		
	$sql_main="insert into tblarrival (yearcode,arrival_type, arrival_code, arrival_date, party_id, stageret, retid, arr_role) values('$yearid_id','Internalreturn','$code','$tdate','$partyid','$rfs','$rbd','$logid')";

if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=mysql_insert_id();

$sql_sub="insert into tblarrival_sub (arrival_id, classification_id, item_id,  qty_good, ups_good, noofbin_good,uom) values('$mainid','$classification','$items','$qty','$ups','$x','$uom')";

if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();

if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage, rowid) values('Internalreturn', '$mainid', '$subid', '$classification', '$items', '$y', '$z', '$a1', '$b1', '$c1','0',' 0', '$rowid1')";
mysql_query($sql_sub_sub) or die(mysql_error());
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage, rowid) values('Internalreturn', '$mainid', '$subid', '$classification', '$items', '$d1', '$e1', '$f1', '$g1', '$h1', '0', '0', '$rowid2')";
mysql_query($sql_sub_sub) or die(mysql_error());
}
if($god3==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage, rowid) values('Internalreturn', '$mainid', '$subid', '$classification', '$items', '$i1', '$j1', '$k1', '$l1', '$m1', '0', '0', '$rowid3')";
mysql_query($sql_sub_sub) or die(mysql_error());
}
}
}
 
				echo "<script>window.location='add_return_stores_preview.php?p_id=$mainid'</script>";	
		
}


$sql_code="SELECT MAX(arrival_code) FROM tblarrival where yearcode='$year_id'and arrival_type='Internalreturn' ORDER BY arrival_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="TAI".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAI".$code."/".$yearid_id."/".$lgnid;
		}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transction Arrival - Material Return Internal - Good</title>
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
		document.frmaddDepartment.txtups.value="";
		//document.frmaddDepartment.txtitem.focus();
	}
}

function qtychk()
{
	if(document.frmaddDepartment.txtups.value !="")
	{
		if(parseFloat(document.frmaddDepartment.txtqty.value) <= 0 ||  document.frmaddDepartment.txtqty.value == "")
		{
			alert("Please enter Quantity");
			document.frmaddDepartment.txtqty.value="";
		}
	}
	else
	{
		alert("Please enter UPS first");
		document.frmaddDepartment.txtqty.value="";
		//document.frmaddDepartment.txtups.focus();
	}
}



function wh1(wh1val)
{ //alert(wh1val);
if(document.frmaddDepartment.txtqty.value > 0)
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	else
	{
		alert("Please enter Quantity");
		document.getElementById('whg1').selectedIndex=0;
	}
}

function wh2(wh2val)
{  
	if(document.frmaddDepartment.txtqty.value > 0)
	{
		showUser(wh2val,'bing2','wh','bing2','','','','');
	}
	else
	{
		alert("Please enter Quantity");
		document.getElementById('whg2').selectedIndex=0;
	}
}

function wh3(wh3val)
{
	if(document.frmaddDepartment.txtqty.value > 0)
	{
			showUser(wh3val,'bing3','wh','bing3','','','','');
	}
	else
	{
		alert("Please enter Quantity");
		document.getElementById('whg3').selectedIndex=0;
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
		alert("Please select Warehouse");
		document.getElementById('b1').selectedIndex=0;
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
		document.getElementById('b2').selectedIndex=0;
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
		document.getElementById('b3').selectedIndex=0;
	}
}






function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.getElementById('b1').value!="")
	{	//alert("subbin");
		
		var w1=document.getElementById('whg1').value+document.getElementById('b1').value+document.getElementById('sb1').value;
		var w2=document.getElementById('whg2').value+document.getElementById('b2').value+document.getElementById('sb2').value;
		var w3=document.getElementById('whg3').value+document.getElementById('b3').value+document.getElementById('sb3').value;
		
		if(w1==w3 || w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb1').selectedIndex=0;
		//document.frmaddDepartment.txtslsubbg1.focus();
		}
		
		
		var slocnogood="";//document.frmaddDepartment.tblslocnog.value;
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.getElementById('ups1').value!="")
		var upsv1=document.getElementById('ups1').value;
		else
		var upsv1="";
		if(document.getElementById('qty1').value!="")
		var qtyv1=document.getElementById('qty1').value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		//document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.getElementById('b2').value!="")
	{	
		var w1=document.getElementById('whg1').value+document.getElementById('b1').value+document.getElementById('sb1').value;
		var w2=document.getElementById('whg2').value+document.getElementById('b2').value+document.getElementById('sb2').value;
		var w3=document.getElementById('whg3').value+document.getElementById('b3').value+document.getElementById('sb3').value;
		
		if(w2==w1 || w2==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb2').selectedIndex=0;
		//document.frmaddDepartment.txtslsubbg2.focus();
		}
		
		//if(document.frmaddDepartment.txtslsubbg1.value!="")
		
		var slocnogood="";//document.frmaddDepartment.tblslocnog.value;
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.getElementById('ups2').value!="")
		var upsv2=document.getElementById('ups2').value;
		else
		var upsv2="";
		if(document.getElementById('qty2').value!="")
		var qtyv2=document.getElementById('qty2').value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,upsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		//document.frmaddDepartment.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.getElementById('b3').value!="")
	{	
		var w1=document.getElementById('whg1').value+document.getElementById('b1').value+document.getElementById('sb1').value;
		var w2=document.getElementById('whg2').value+document.getElementById('b2').value+document.getElementById('sb2').value;
		var w3=document.getElementById('whg3').value+document.getElementById('b3').value+document.getElementById('sb3').value;
		
		if(w1==w3 || w2==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb3').selectedIndex=0;
		//document.frmaddDepartment.txtslbing3.focus();
		}
		
		var slocnogood="";//document.frmaddDepartment.tblslocnog.value;
		var trid=document.frmaddDepartment.maintrid.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.getElementById('ups3').value!="")
		var upsv3=document.getElementById('ups3').value;
		else
		var upsv3="";
		if(document.getElementById('ups3').value!="")
		var qtyv3=document.getElementById('ups3').value;
		else
		var qtyv3="";
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,upsv3,qtyv3,trid);
		//showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3','','','');
	}
	else
	{
		alert("Please select Bin");
		//document.frmaddDepartment.txtslbing3.focus();
	}
}


function upsf1(ups1val)
{
	if(document.getElementById('sb1').value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById('ups1').value="";
		//document.frmaddDepartment.txtslsubbg1.focus();
	}
	if(document.getElementById('ups1').value!="")
	{
				
		var exu=0;
		if(document.frmaddDepartment.exusp1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp1.value);
		document.frmaddDepartment.balups1.value=parseInt(document.getElementById('ups1').value)+parseInt(exu);
		
		
	}
}

function upsf2(ups2val)
{
	if(document.getElementById('sb2').value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById('ups2').value="";
		//document.frmaddDepartment.txtslsubbg2.focus();
	}
	if(document.getElementById('ups2').value!="")
	{
		var exu=0;
		if(document.frmaddDepartment.exusp2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp2.value);
		document.frmaddDepartment.balups2.value=parseInt(document.getElementById('ups2').value)+parseInt(exu);
	}
}

function upsf3(ups3val)
{
	if(document.getElementById('sb3').value=="")
	{
		alert("Please select Sub Bin");
		document.getElementById('ups3').value="";
		//document.frmaddDepartment.txtslsubbg3.focus();
	}
	else
	{
		var exu=0;
		if(document.frmaddDepartment.exusp3.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exusp3.value);
		document.frmaddDepartment.balups3.value=parseInt(document.getElementById('ups3').value)+parseInt(exu);
	}
}

function qtyf1(qty1val)
{	
	if(document.getElementById('ups1').value=="")
	{
		alert("Please enter UPS");
		document.getElementById('qty1').value="";
		//document.frmaddDepartment.txtslupsg1.focus();
	}
	if(document.getElementById('qty1').value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exqty1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty1.value);
		document.frmaddDepartment.balqty1.value=parseFloat(document.getElementById('qty1').value)+parseFloat(exq);
	}
}

function qtyf2(qty2val)
{
	if(document.getElementById('ups2').value=="")
	{
		alert("Please enter UPS");
		document.getElementById('qty2').value="";
		//document.frmaddDepartment.txtslupsg2.focus();
	}
	if(document.getElementById('qty2').value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exqty2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty2.value);
		document.frmaddDepartment.balqty2.value=parseFloat(document.getElementById('qty2').value)+parseFloat(exq);
	}
}

function qtyf3(qty3val)
{
	if(document.getElementById('ups3').value=="")
	{
		alert("Please enter UPS");
		document.getElementById('qty3').value="";
		//document.frmaddDepartment.txtslupsg3.focus();
	}
	if(document.getElementById('qty3').value!="")
	{
		var exq=0;
		if(document.frmaddDepartment.exqty3.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqty3.value);
		document.frmaddDepartment.balqty3.value=parseFloat(document.getElementById('qty3').value)+parseFloat(exq);
	}
}

function modetchk(classval)
{
if(document.frmaddDepartment.txtstage.value!="")
{
showUser(classval,'vitem','item','','','','','');
}
else
{
alert("Please select Return from Stage");
document.frmaddDepartment.txtclass.selectedIndex=0;
//document.frmaddDepartment.txtstage.focus();
}
}

function classchk(itval)
{
	if(document.frmaddDepartment.txtclass.value!="")
	{
		showUser(itval,'uom','itemuom','','','','','');
		setTimeout('showslocbins()',200);
	}
	else
	{
		alert("Please Select Classification first")
		document.frmaddDepartment.txtitem.selectedIndex=0;
		//document.frmaddDepartment.txtclass.focus();
	}
}

function showslocbins()
{
			var opttyp="good";
			//document.frmaddDepartment.rettyp.value=opttyp;
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			showUser(opttyp,'subsubdivgood','slocshowsubdamage',itmid,clasid,itmid,'','');
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
//document.frmaddDepartment.txtitem.focus();
}
}

function retchk(retval)
{
	if(document.frmaddDepartment.txtparty.value!="")
	{
		showUser(retval,'retby','retnby','','','','','');
	}
	else
	{
		alert("Please select Party Name");
		document.frmaddDepartment.txtstage.selectedIndex=0;
	}
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
			document.frmaddDepartment.txtrd.selectedIndex=0;
			//document.frmaddDepartment.txtstage.focus();
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
	if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please select Party Name");
		return false;
	}
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please select Return from Stage");
		//document.frmaddDepartment.txtstage.focus();
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
		//document.frmaddDepartment.txtclass.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Stores Item");
		//document.frmaddDepartment.txtitem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please enter UPS");
		//document.frmaddDepartment.txtups.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtqty.value=="")
	{
		alert("Please enter Quantity");
		//document.frmaddDepartment.txtqty.focus();
		return false;
	}
	
	if((document.getElementById('qty1').value>0) && (document.getElementById('sb1').value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	if((document.getElementById('qty2').value>0) && (document.getElementById('sb2').value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	if((document.getElementById('qty3').value>0) && (document.getElementById('sb3').value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
		var q1=document.getElementById('qty1').value;
		var q2=document.getElementById('qty2').value;
		var q3=document.getElementById('qty3').value;
		var g=document.frmaddDepartment.txtqty.value;
			
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;
		if(g=="")g=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2)+parseFloat(q3);
		
		var f=0;
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		if(g==0)
		{
		alert("Please check. Quantity Received cannot be Zero or Blank");
		return false;
		f=1;
		}
		
		if(f==1)
		{
		return false;
		}
		else
		{	
		if(document.getElementById('whg1').value!="")
		{
		document.frmaddDepartment.twh1.value=document.getElementById('whg1').value;
		}
		if(document.getElementById('whg2').value!="")
		{
		document.frmaddDepartment.twh2.value=document.getElementById('whg2').value;
		}
		if(document.getElementById('whg3').value!="")
		{
		document.frmaddDepartment.twh3.value=document.getElementById('whg3').value;
		}
		if(document.getElementById('b1').value!="")
		{
		document.frmaddDepartment.tb1.value=document.getElementById('b1').value;
		}
		if(document.getElementById('b2').value!="")
		{
		document.frmaddDepartment.tb2.value=document.getElementById('b2').value;
		}
		if(document.getElementById('b3').value!="")
		{
		document.frmaddDepartment.tb3.value=document.getElementById('b3').value;
		}
		if(document.getElementById('sb1').value!="")
		{
		document.frmaddDepartment.tsb1.value=document.getElementById('sb1').value;
		}
		if(document.getElementById('sb2').value!="")
		{
		document.frmaddDepartment.tsb2.value=document.getElementById('sb2').value;
		}
		if(document.getElementById('sb3').value!="")
		{
		document.frmaddDepartment.tsb3.value=document.getElementById('sb3').value;
		}
		if(document.getElementById('ups1').value!="")
		{
		document.frmaddDepartment.tups1.value=document.getElementById('ups1').value;
		}
		if(document.getElementById('ups2').value!="")
		{
		document.frmaddDepartment.tups2.value=document.getElementById('ups2').value;
		}
		if(document.getElementById('ups3').value!="")
		{
		document.frmaddDepartment.tups3.value=document.getElementById('ups3').value;
		}
		if(parseFloat(document.getElementById('qty1').value) > 0)
		{
		document.frmaddDepartment.tqty1.value=parseFloat(document.getElementById('qty1').value);
		}
		if(parseFloat(document.getElementById('qty2').value) > 0)
		{
		document.frmaddDepartment.tqty2.value=parseFloat(document.getElementById('qty2').value);
		}
		if(parseFloat(document.getElementById('qty3').value) > 0)
		{
		document.frmaddDepartment.tqty3.value=parseFloat(document.getElementById('qty3').value);
		}
		return true;
		}
	
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transction Arrival - Material Return Internal - Good</td>
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
	 <input name="maintrid" value="0" type="hidden">
	 <input name="code" value="<?php echo $code;?>" type="hidden"> 
	 <input name="twh1" value="0" type="hidden"> 
	 <input name="twh2" value="0" type="hidden"> 
	 <input name="twh3" value="0" type="hidden"> 
	 <input name="tb1" value="0" type="hidden"> 
	 <input name="tb2" value="0" type="hidden"> 
	 <input name="tb3" value="0" type="hidden"> 
	 <input name="tsb1" value="0" type="hidden"> 
	 <input name="tsb2" value="0" type="hidden"> 
	 <input name="tsb3" value="0" type="hidden"> 
	 <input name="tups1" value="0" type="hidden"> 
	 <input name="tups2" value="0" type="hidden"> 
	 <input name="tups3" value="0" type="hidden"> 
	 <input name="tqty1" value="0" type="hidden"> 
	 <input name="tqty2" value="0" type="hidden"> 
	 <input name="tqty3" value="0" type="hidden"> 
	 
	 <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add  Material Return Internal - Good</td>
</tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
      <td width="152" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
      <td width="363" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtcode" type="text" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="<?php echo $code1?>" />&nbsp;</td>
     
	  <td width="143" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
      <td width="182" align="left"  valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" maxlength="10"/></td>
</tr>

<tr class="Light" height="25">
<?php
$quer1=mysql_query("SELECT p_id, business_name FROM tbl_partymaser where classification='Internal Return'")or die(mysql_error()); 
?>

      <td width="152" height="24"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtparty" style="width:120px;"  >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysql_fetch_array($quer1)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

      <td width="143" height="24"  align="right"  valign="middle" class="tblheading"> Return from Stage&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<select name="txtstage" class="tbltext"  style="width:100px;" tabindex="" value="text" onchange="retchk(this.value)">
           <option value="">--Select--</option>
          <option value="RSW">RSW</option>
		   <option value="Processing">Processing</option>
		   <option value="CSW">CSW</option>
         <option value="Packing">Packing</option>
		   <option value="PSW">PSW</option>
		   <option value="Dispatch">Dispatch</option>
		    <option value="Sales Return">Sales Return</option>
         <option value="Quality">Quality</option>
		    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<?php
$quer1=mysql_query("SELECT id ,login FROM tbl_roles ")or die(mysql_error()); 
?>

      <td width="152" height="24"  align="right"  valign="middle" class="tblheading">Return By ID&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext" id="retby" >&nbsp;<select class="tbltext" name="txtrd" style="width:100px;" onchange="rtnbychk(this.value)"  >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysql_fetch_array($quer1)) { ?>
		<option value="<?php echo $noticia['login'];?>" />   
		<?php echo $noticia['login'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Return By ID or Specify&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtrbd" id="rbd" type="text" size="10" class="tbltext" tabindex="" maxlength="7" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="152"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select><font color="#FF0000">*</font>	</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores order by stores_item") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void();" onclick="openslocpop();">SLOC Lookup</a></td>
		
<td width="143" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="182" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
<input type="hidden" name="itmdchk" value="" />

		 <tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="" onchange="upschk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onkeypress="return isNumberKey(event)" value="" onchange="qtychk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
 <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Good</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="84" align="center" valign="middle" class="tblheading">Bin</td>
<td width="103" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">UPS</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
</div>
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
<td valign="top" align="right"><a href="add_return_stores_st.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;">&nbsp;&nbsp;</td>
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
