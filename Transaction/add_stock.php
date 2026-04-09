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
	//$logid="admin";
	//$lgnid="admin";
	/*if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}*/

	if(isset($_POST['frm_action'])=='submit')
	{	
		$code=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		$classification=$_POST['txtclass'];
		$rfs=trim($_POST['txtstage']);
		$rbd=trim($_POST['txt1']);
		$items=trim($_POST['txtitem']);
		$uom=trim($_POST['txtuom']);
		$ups=trim($_POST['txtupsd']);
		$qty=trim($_POST['txtqtyd']);
		$typ=trim($_POST['typ']);
		
		if($typ == "Good")
		{
		$noofbinsg=trim($_POST['tblslocnog']);
		}
		else
		{
		$noofbinsg=0;
		}
		
		if($typ == "Damage")
		{
		$noofbinsd=trim($_POST['tblslocnod']);
		}
		else
		{
		$noofbinsd=0;
		}
		
		if($noofbinsg == 1 || $noofbinsg == "1")
		{		
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$subbin1=trim($_POST['txtslsubbg1']);
		$ups1=trim($_POST['txtslupsg1']);
		$qty1=trim($_POST['txtslqtyg1']);
		}
		else if($noofbinsg == 2 || $noofbinsg == "2")
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
		else if($noofbinsg == 3 || $noofbinsg == "3")
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
		
		if($noofbinsd == 1 || $noofbinsd == "1")
		{		
		$wh4=trim($_POST['txtslwhd1']);
		$bin4=trim($_POST['txtslbind1']);
		$subbin4=trim($_POST['txtslsubbd1']);
		$ups4=trim($_POST['txtslupsd1']);
		$qty4=trim($_POST['txtslqtyd1']);
		}
		else if($noofbinsd == 2 || $noofbinsd == "2")
		{
		$wh4=trim($_POST['txtslwhd1']);
		$bin4=trim($_POST['txtslbind1']);
		$subbin4=trim($_POST['txtslsubbd1']);
		$ups4=trim($_POST['txtslupsd1']);
		$qty4=trim($_POST['txtslqtyd1']);
		
		$wh5=trim($_POST['txtslwhd2']);
		$bin5=trim($_POST['txtslbind2']);
		$subbin5=trim($_POST['txtslsubbd2']);
		$ups5=trim($_POST['txtslupsd2']);
		$qty5=trim($_POST['txtslqtyd2']);
		}
		
		else
		{
		$wh4="";
		$bin4="";
		$subbin4="";
		$ups4="";
		$qty4="";
		
		$wh5="";
		$bin5="";
		$subbin5="";
		$ups5="";
		$qty5="";
		}
		
				
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		//echo "Submitted";
		
		
		
	$sql_main="insert into tblarrival(yearcode, arrival_type, arrival_code,  arrival_date , arr_role, type) values('$yearid_id','OP','$code', '$tdate','$logid', '$typ')";

if(mysql_query($sql_main) or die(mysql_error()))
{
$mainid=mysql_insert_id();

if($typ=="Good")
{
  $sql_sub="insert into tblarrival_sub (type,arrival_id, classification_id, item_id,  qty_good, ups_good, noofbin_good, noofbin_damage,uom) values('$rbd','$mainid','$classification','$items','$qty','$ups','$noofbinsg','$noofbinsd','$uom')";
}
else
{
  $sql_sub="insert into tblarrival_sub (type,arrival_id, classification_id, item_id,  qty_damage, ups_damage, noofbin_good, noofbin_damage,uom) values('$rbd','$mainid','$classification','$items','$qty','$ups','$noofbinsg','$noofbinsd','$uom')";
}  
if(mysql_query($sql_sub) or die(mysql_error()))
{
$subid=mysql_insert_id();
if($typ=="Good")
{
	for($num=0; $num<$noofbinsg; $num++)
	{
	if($num==0)
	{
	  $sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('OP','$mainid', '$subid', '$classification', '$items', '$wh1', '$bin1', '$subbin1', '$qty1', '$ups1','0',' 0')";
	}
	//
	if($num==1)
	{
	  $sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('OP', '$mainid', '$subid', '$classification', '$items', '$wh2', '$bin2', '$subbin2', '$qty2', '$ups2', '0', '0')";
	}
	if($num==2)
	{
	  $sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('OP', '$mainid', '$subid', '$classification', '$items', '$wh3', '$bin3', '$subbin3', '$qty3', '$ups3', '0', '0')";
	}
	mysql_query($sql_sub_sub) or die(mysql_error());
	}
}
else
{
		for($num=0; $num<$noofbinsd; $num++)
	{
	if($num==0)
	{
	  $sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('OP','$mainid', '$subid', '$classification', '$items', '$wh4', '$bin4', '$subbin4', '0', '0','$qty4','$ups4')";
	}
	//
	if($num==1)
	{
	  $sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('OP','$mainid', '$subid', '$classification', '$items', '$wh5', '$bin5', '$subbin5', '0', '0','$qty5','$ups5')";
	}
	mysql_query($sql_sub_sub) or die(mysql_error());
	}

}
}
}		 
			echo "<script>window.location='home_openstock_preview.php?p_id=$mainid'</script>";	
}
	

	$s_chk=mysql_query("SELECT * FROM tblarrival where yearcode='$yearid_id' and arrival_type='OP'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(arrival_code) FROM tblarrival where yearcode='$yearid_id' and arrival_type='OP' ORDER BY arrival_code DESC";
	else
$sql_code="SELECT MAX(arrival_code) FROM tblarrival where arrival_type='OP' and yearcode='$yearid_id' ORDER BY arrival_code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="TOP".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TOP".$code."/".$yearid_id."/".$lgnid;
		}	
		
		
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Transaction -Opening Stock Admin </title>
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
<script type="text/javascript">
///*onloadfocus()
//	{
//	document.frmaddDepartment.txtclass.focus();
//	}
function clk22(opt)
{ 
	if(document.frmaddDepartment.txtitem.value!="")
	{
	
	if(opt!="")
	{
		if(opt=="Good")
		{
			if(parseInt(document.frmaddDepartment.itmdupchkg.value)==0)
			{
				/*document.getElementById('gsloc1').style.display="block";
				document.getElementById('dsloc1').style.display="none";*/
				document.getElementById('ds').style.display="block";
				document.getElementById('ds1').style.display="none";
				document.frmaddDepartment.typ.value=opt;
			}
			else
			{
				alert("Selected Item Has been Already stored in Good Ladger");
				document.getElementById('tpc').checked=false; 
				document.getElementById('tpc1').checked=false; 
				document.frmaddDepartment.txtitem.selectedIndex=0;
			}
		}
		else
		{
			if(parseInt(document.frmaddDepartment.itmdupchkd.value)==0)
			{
				/*document.getElementById('gsloc1').style.display="none";
				document.getElementById('dsloc1').style.display="block";*/
				document.getElementById('ds').style.display="none";
				document.getElementById('ds1').style.display="block";
				document.frmaddDepartment.typ.value=opt;
			}
			else
			{
				alert("Selected Item Has been Already stored in Damage Ladger");
				document.getElementById('tpc').checked=false; 
				document.getElementById('tpc1').checked=false; 
				document.frmaddDepartment.txtitem.selectedIndex=0;
			}
		}	
	}
	}
	else
	{
	alert("Please select Item");
	document.getElementById('tpc').checked=false; 
	document.getElementById('tpc1').checked=false; 
	//document.frmaddDepartment.txtitem.selectedIndex=0;
	}
	
}

function bingood(gval)
{	
		//alert(gval);s
		if(document.frmaddDepartment.txtqtyd.value > 0)
	{
		if(gval==1 || gval=="1")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value=document.frmaddDepartment.txtupsd.value;
			document.getElementById('qty1').value=document.frmaddDepartment.txtqtyd.value;
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
	alert("Please enter Quantity");
	document.frmaddDepartment.txtqtyd.focus();
	}
}


function bindamage(dval)
{
	if(document.frmaddDepartment.txtqtyd.value > 0)
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
	alert("Please enter Quantity");
	document.frmaddDepartment.txtqtyd.focus();
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

/*function upschk(upsval)
{
	if(document.frmaddDepartment.txtqtydc.value > 0)
	{
		if(document.frmaddDepartment.txtupsd.value > 0)
		{
			if(document.frmaddDepartment.txtupsd.value=="")
			document.frmaddDepartment.txtexshups.value=parseInt(upsval)-parseInt(document.frmaddDepartment.txtupsd.value);
			else
			document.frmaddDepartment.txtexshups.value=parseInt(upsval)+parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(document.frmaddDepartment.txtupsd.value);
		}
		/*else
		{
			alert("Please enter UPS as per DC first");
			document.frmaddDepartment.txtupsd.value="";
			document.frmaddDepartment.txtexshqty.value="";
			document.frmaddDepartment.txtupsd.focus();
		}
	}*/
	/*else
	{
		alert("Please enter Quantity as per DC first");
		document.frmaddDepartment.txtqtyd.value="";
		document.frmaddDepartment.txtexshqty.value="";
		document.frmaddDepartment.txtqtydc.focus();
	}

}*/

function upschk1(upsval1)
{
	if(document.frmaddDepartment.typ.value=="")
	{
		alert("Please select type");
		document.frmaddDepartment.txtupsd.value="";
	}
}


/*function qtychk(qtyval)
{
	if(document.frmaddDepartment.txtupsd.value > 0)
	{
		if(document.frmaddDepartment.txtqtydc.value > 0)
		{
			if(document.frmaddDepartment.txtqtyd.value=="")
			document.frmaddDepartment.txtexshqty.value=parseFloat(qtyval)-parseFloat(document.frmaddDepartment.txtqtydc.value);
			else
			document.frmaddDepartment.txtexshqty.value=parseFloat(qtyval)+parseFloat(document.frmaddDepartment.txtqtyd.value)-parseFloat(document.frmaddDepartment.txtqtydc.value);
		}
		else
		{
			alert("Please enter Quantity as per DC first");
			document.frmaddDepartment.txtqtyd.value="";
			document.frmaddDepartment.txtexshqty.value="";
			document.frmaddDepartment.txtqtydc.focus();
		}
	}
	else
	{
		alert("Please enter UPS Good first");
		document.frmaddDepartment.txtqtyd.value="";
		document.frmaddDepartment.txtexshqty.value="";
		document.frmaddDepartment.txtqtyd.focus();
	}
}*/


function qtychk1(qtyval1)
{
	if(document.frmaddDepartment.txtupsd.value < 0 || document.frmaddDepartment.txtupsd.value == "")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtqtyd.value="";
		//document.frmaddDepartment.txtexshqty.value="";
		//document.frmaddDepartment.txtqtyd.focus();
	}
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
		document.frmaddDepartment.txtitem.selectedIndex=0;
		document.frmaddDepartment.txtclass.focus();
	}
}
function itemcheck()
{
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDepartment.txtupsd.value="";
	}
}

/*function upsdcchk()
{
	if(document.frmaddDepartment.txtupsd.value=="" || document.frmaddDepartment.txtupsd.value==0)
	{
		alert("Please enter UPS as per DC first");
		document.frmaddDepartment.txtupsd.value="";
		document.frmaddDepartment.txtqtydc.value="";
		document.frmaddDepartment.txtupsd.focus();
	}
}*/


function modetchk(classval)
{
showUser(classval,'vitem','item','','','','','');

}
/*function vendorchk()
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
}*/


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
		alert("Please Select Item first.");
		document.frmaddDepartment.txtitem.focus();
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
		alert("Please select SLOC > Good Item> No. of Bins");
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
		alert("Please enter Quantity in Previous Row");
		}
	}
	else
	{
		alert("Please select Warehouse in previous Row");
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
			alert("Please enter Quantity in Previous Row");
		}
	}
	else
	{
		alert("Please select Warehouse in previous Row");
	}

}
function wh4(wh4val)
{
	/*if(document.frmaddDepartment.tblslocnog.value!="")
	{*/
		if(document.frmaddDepartment.tblslocnod.value!="")
		{
			showUser(wh4val,'bind1','wh','bind1','','','','');
		}
		else
		{
			alert("Please select SLOC > Damage Item> No. of Bins");
		}
	/*}
	else
	{
		//alert("Please select SLOC number of Bins Good");
	}*/
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
			alert("Please enter Quantity in Previous Row");
		}
	}
	else
	{
		alert("Please select Warehouse in previous Row");
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

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var trid=0;
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
		
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var trid=0;
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
		
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var trid=0;
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

function subbin4(subbin4val)
{
	var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbind1.value!="")
	{	
		var w4=document.frmaddDepartment.txtslwhd1.value+document.frmaddDepartment.txtslbind1.value+document.frmaddDepartment.txtslsubbd1.value;
			
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		var trid=0;
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
		var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		var trid=0;
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
			document.getElementById('ups2').value=parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(ups1val);
		}
		
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
			document.getElementById('ups3').value=parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(document.getElementById('ups1').value)-parseInt(ups2val);
		}
		
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
		alert("Please select Sub Bin in Third Row in Good section");
		document.frmaddDepartment.txtslupsg3.value="";
		document.frmaddDepartment.txtslsubbg3.focus();
	}
	if(document.frmaddDepartment.txtslupsg3.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslupsg3.value=1;
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
			document.getElementById('ups5').value=parseInt(document.frmaddDepartment.txtupsd.value)-parseInt(ups4val);
		}
		
	}
	else
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslupsd1.value=1;
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
	if(document.frmaddDepartment.txtslupsd2.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslupsd2.value=1;
	}
}

function qtyf1(qty1val)
{	
	//document.frmaddDepartment.txtslupsg2.value="";
	//document.frmaddDepartment.txtslupsg3.value="";
	document.frmaddDepartment.txtslqtyg2.value="";
	document.frmaddDepartment.txtslqtyg3.value="";
	if(parseInt(document.frmaddDepartment.txtslupsg1.value) <= 0)
	{
		alert("Please enter UPS");
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
		if(document.frmaddDepartment.txtslqtyg1.value==0 || document.frmaddDepartment.txtslqtyg1.value=="")
		{
			alert("Please check the Quantity allocation in Bin");
			document.frmaddDepartment.txtslqtyg1.value="";
			document.frmaddDepartment.txtslqtyg1.focus();
		}
		if(parseFloat(document.frmaddDepartment.txtslqtyg1.value) > parseFloat(document.frmaddDepartment.txtqtyd.value))
		{
			alert("Please check the Quantity allocation in Bin");
			document.frmaddDepartment.txtslqtyg1.value="";
			document.frmaddDepartment.txtslqtyg1.focus();
		}
		if(document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2")
		{
			document.getElementById('qty2').value=parseFloat(document.frmaddDepartment.txtqtyd.value)-parseFloat(qty1val);
			if(parseFloat(document.getElementById('qty2').value)<=0)
			{
			alert("Please check the Quantity allocation in Bin");
			document.frmaddDepartment.txtslqtyg1.value="";
			document.frmaddDepartment.txtslqtyg1.focus();
			document.getElementById('qty2').value="";
			document.getElementById('ups2').value="";
			}
			else
			{
				if(parseInt(document.getElementById('ups2').value)<=0)
				{
				document.getElementById('ups2').value=1;
				}
			}
		}
	}
}

function qtyf2(qty2val)
{
	//document.frmaddDepartment.txtslqtyg2.value="";
	document.frmaddDepartment.txtslqtyg3.value="";
	
	if(parseInt(document.frmaddDepartment.txtslupsg2.value) <= 0)
	{
		alert("Please enter UPS");
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
		
		if((parseFloat(document.frmaddDepartment.txtslqtyg2.value)+parseFloat(document.frmaddDepartment.txtslqtyg1.value)) > parseFloat(document.frmaddDepartment.txtqtyd.value))
		{
			alert("Please check the Quantity allocation in Bin");
			document.frmaddDepartment.txtslqtyg2.value="";
			document.frmaddDepartment.txtslqtyg2.focus();
		}
		
		if(document.frmaddDepartment.tblslocnog.value==3 || document.frmaddDepartment.tblslocnog.value=="3")
		{
			document.getElementById('qty3').value=parseFloat(document.frmaddDepartment.txtqtyd.value) - parseFloat(document.getElementById('qty1').value) - parseFloat(qty2val);
			if(parseFloat(document.getElementById('qty3').value)<=0)
			{
			alert("Please check the Quantity allocation in Bin");
			document.frmaddDepartment.txtslqtyg2.value="";
			document.frmaddDepartment.txtslqtyg2.focus();
			document.getElementById('qty3').value="";
			document.getElementById('ups3').value="";
			}
			else
			{
			if(parseInt(document.getElementById('ups3').value)<=0)
			{
			document.getElementById('ups3').value=1;
			}
			}
		}
	}
}

function qtyf3(qty3val)
{
	if(parseFloat(document.frmaddDepartment.txtslupsg3.value) <= 0)
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslqtyg3.value="";
		document.frmaddDepartment.txtslupsg3.focus();
	}
}

function qtyf4(qty4val)
{
	//document.frmaddDepartment.txtslupsd1.value="";
	//document.frmaddDepartment.txtslupsd2.value="";
	
	if(parseInt(document.frmaddDepartment.txtslupsd1.value) <= 0)
	{
		alert("Please enter UPS");
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
		
		if(parseFloat(document.frmaddDepartment.txtslqtyd1.value) > parseFloat(document.frmaddDepartment.txtqtyd.value))
		{
			alert("Please check the Quantity allocation in Bin");
			document.frmaddDepartment.txtslqtyd1.value="";
			document.frmaddDepartment.txtslqtyd1.focus();
		}
		
		if(document.frmaddDepartment.tblslocnod.value==2 || document.frmaddDepartment.tblslocnod.value=="2")
		{
			document.getElementById('qty5').value=parseFloat(document.frmaddDepartment.txtqtyd.value)-parseFloat(qty4val);
			if(parseFloat(document.getElementById('qty5').value)<=0)
			{
			alert("Please check the Quantity allocation in Bin");
			document.frmaddDepartment.txtslqtyd1.value="";
			document.frmaddDepartment.txtslqtyd1.focus();
			document.getElementById('qty5').value="";
			document.getElementById('ups5').value="";
			}
			else
			{
				if(parseInt(document.getElementById('ups5').value)<=0)
				{
				document.getElementById('ups5').value=1;
				}
			}
		}
	}
}

function qtyf5(qty5val)
{
	if(parseInt(document.frmaddDepartment.txtslupsd2.value) <= 0)
	{
		alert("Please enter UPS");
		document.frmaddDepartment.txtslqtyd2.value="";
		document.frmaddDepartment.txtslupsd2.focus();
	}
}

function mySubmit()
{

if(document.frmaddDepartment.date.value=="00-00-0000" || document.frmaddDepartment.date.value=="")
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
	if(document.frmaddDepartment.typ.value=="")
	{
	alert("Please Select Type ");
	return false;
	}
	
	if(document.frmaddDepartment.txtupsd.value=="")
	{
	alert("Please Enter UPS ");
	document.frmaddDepartment.txtupsd.focus();
	return false;
	}
	
	
	if(document.frmaddDepartment.txtqtyd.value=="")
	{
		alert("Please Enter Quantity");
		document.frmaddDepartment.txtqtyd.focus();
		return false;
	}
	
	if(document.frmaddDepartment.typ.value=="Good")
	{
	
	if(document.frmaddDepartment.tblslocnog.value=="")
	{
		alert("Please select SLOC > Good Item > No of Bins");
		document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	if(document.frmaddDepartment.tblslocnog.value!="")
	{
	
	if((document.frmaddDepartment.tblslocnog.value==1 || document.frmaddDepartment.tblslocnog.value=="1")&& (document.frmaddDepartment.txtslsubbg1.value==""))
		{
			
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
			
		}
	if((document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2") && (document.frmaddDepartment.txtslsubbg2.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
		}
	if((document.frmaddDepartment.tblslocnog.value==3 || document.frmaddDepartment.tblslocnog.value=="3") && (document.frmaddDepartment.txtslsubbg3.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg3.focus();
				return false;		
			
		}
		if((document.frmaddDepartment.tblslocnog.value==1 || document.frmaddDepartment.tblslocnog.value=="1")&& (document.frmaddDepartment.txtslqtyg1.value=="" || document.frmaddDepartment.txtslqtyg1.value==0))
		{
			
				alert("Please check the Quantity allocation in Bin");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
			
		}
	if((document.frmaddDepartment.tblslocnog.value==2 || document.frmaddDepartment.tblslocnog.value=="2") && (document.frmaddDepartment.txtslqtyg2.value=="" || document.frmaddDepartment.txtslqtyg2.value==0))
			{
				alert("Please check the Quantity allocation in Bin");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
		}
	 if((document.frmaddDepartment.tblslocnog.value==3 || document.frmaddDepartment.tblslocnog.value=="3") && (document.frmaddDepartment.txtslqtyg3.value=="" || document.frmaddDepartment.txtslqtyg3.value==0))
			{
				alert("Please check the Quantity allocation in Bin");	
				//document.frmaddDepartment.txtslsubbg3.focus();
				return false;		
			
		}
		
		}
		}
		
		if(document.frmaddDepartment.typ.value=="Damage")
		{
	
		if(document.frmaddDepartment.tblslocnod.value=="")
		{ 
		alert("Please select SLOC > Damage Item > No of Bins");
		//document.frmaddDepartment.tblslocnod.focus();
		return false;
		}
		
		if(document.frmaddDepartment.tblslocnod.value!="")
		{ 
		if((document.frmaddDepartment.tblslocnod.value==1 || document.frmaddDepartment.tblslocnod.value=="1")&& (document.frmaddDepartment.txtslsubbd1.value==""))
		{
			
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
			
		}
	if((document.frmaddDepartment.tblslocnod.value==2 || document.frmaddDepartment.tblslocnod.value=="2") && (document.frmaddDepartment.txtslsubbd2.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
		}
	if((document.frmaddDepartment.tblslocnod.value==1 || document.frmaddDepartment.tblslocnod.value=="1")&& (document.frmaddDepartment.txtslqtyd1.value=="" || document.frmaddDepartment.txtslqtyd1.value==0))
		{
			
				alert("Please check the Quantity allocation in Bin");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
			
		}
	if((document.frmaddDepartment.tblslocnod.value==2 || document.frmaddDepartment.tblslocnod.value=="2") && (document.frmaddDepartment.txtslqtyd2.value=="" || document.frmaddDepartment.txtslqtyd2.value==0))
			{
				alert("Please check the Quantity allocation in Bin");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
		}
		
		}
		}
return true;
}


</script>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Opening Stock</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input name="typ" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Opening Stock</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="226" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="376"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="64" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="174" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" maxlength="10"//>&nbsp; </td>
</tr>
<?php 
$qry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
<tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading">&nbsp;Select Classification&nbsp;</td>                                   
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;"   onchange="modetchk(this.value)"><option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($qry)) { ?>
		<option  value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?>           
        
<tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="376" align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" ><option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="64" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="174" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="" />&nbsp;</td>
		 
</tr>

 <tr class="Light" height="25">
            <td width="226" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
            <td align="left"  valign="middle" colspan="3"><input name="txt1" id="tpc" type="radio" class="tbltext" value="Good" onClick="clk22(this.value);" />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" id="tpc1" type="radio" class="tbltext" value="Damage" onClick="clk22(this.value);" />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
         </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="376" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschk1(this.value);"/>&nbsp;<font color="#FF0000">*</font></td>
<td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value);"/>&nbsp;<font color="#FF0000">*</font></td></tr>
</table>
<div id="ds" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">SLOC > Good Item > No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="tblslocnog" style="width:60px;" onchange="bingood(this.value);" >
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
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
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
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >		
<tr>
<td align="right" width="49"  valign="middle" class="tblheading">&nbsp;UPS &nbsp;</td>
<td  align="left" width="83"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg1" id="ups1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="45"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="135" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="101" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg2" style="width:80px;" onchange="wh2(this.value);" >
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg2" id="ups2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="46" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="130"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
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
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg3" style="width:80px;" onchange="wh3(this.value);" >
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
<td width="80" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslupsg3" id="ups3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td width="43" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="132"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg3" id="qty3" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtyf3(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
</tr>
</table>
</div></div>
<?php
//$quer2=mysql_query("SELECT * FROM tbldept where dept_id='$dept_id'"); 
//$noticia = mysql_fetch_array($quer2);
?>
<?php
//$quer3=mysql_query("SELECT DISTINCT location,location_id FROM tbllocation order by location Asc"); 
?>
<div id="ds1" style="display:none">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
 <tr class="Light" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">SLOC > Damage Item > No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext">&nbsp;
  <select class="tbltext" name="tblslocnod" style="width:60px;" onchange="bindamage(this.value);" >
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
<td width="103" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhd2" style="width:80px;" onchange="wh5(this.value);" >
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
</div></div></div>
<!--<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
-->
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_openstock.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();" >&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table><!-- actual page end--->			  
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
