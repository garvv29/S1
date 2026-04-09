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
	
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];	 
	}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$trid=trim($_POST['trid']);
		//$code=trim($_POST['code']);
		/*$date=trim($_POST['date']);
		$classification=trim($_POST['txtclass']);
		$item=trim($_POST['txtitem']);
		$uom=trim($_POST['txtuom']);
		$totups=trim($_POST['txtupsg']);
		$totqty=trim($_POST['txtqtyg']);
		$slocnog=trim($_POST['tblslocnog']);
		$slocnod=trim($_POST['tblslocnod']);
		$itmtype=trim($_POST['txtmtype']);
		
		if($itmtype=="good")$slocnod=0;
		else
		$slocnog=0;
		
		if($slocnog > 0)
		{
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$subbin1=trim($_POST['txtslsubbg1']);
		$ups1=trim($_POST['txtslupsg1']);
		$qty1=trim($_POST['txtslqtyg1']);
		$rowid1=trim($_POST['rowid_1']);
		if($ups1 <=0)$ups1=1;
		
		if($slocnog >=2)
		{
		$wh2=trim($_POST['txtslwhg2']);
		$bin2=trim($_POST['txtslbing2']);
		$subbin2=trim($_POST['txtslsubbg2']);
		$ups2=trim($_POST['txtslupsg2']);
		$qty2=trim($_POST['txtslqtyg2']);
		$rowid2=trim($_POST['rowid_2']);
		if($ups2 <=0)$ups2=1;
		}
		
		if($slocnog ==3)
		{
		$wh3=trim($_POST['txtslwhg3']);
		$bin3=trim($_POST['txtslbing3']);
		$subbin3=trim($_POST['txtslsubbg3']);
		$ups3=trim($_POST['txtslupsg3']);
		$qty3=trim($_POST['txtslqtyg3']);
		$rowid3=trim($_POST['rowid_3']);
		if($ups3 <=0)$ups3=1;
		}
		}
		
		if($slocnod > 0)
		{
		$wh4=trim($_POST['txtslwhd1']);
		$bin4=trim($_POST['txtslbind1']);
		$subbin4=trim($_POST['txtslsubbd1']);
		$ups4=trim($_POST['txtslupsd1']);
		$qty4=trim($_POST['txtslqtyd1']);
		$rowidd1=trim($_POST['rowidd_1']);
		if($ups4 <=0)$ups4=1;
		
		if($slocnod ==2)
		{
		$wh5=trim($_POST['txtslwhd2']);
		$bin5=trim($_POST['txtslbind2']);
		$subbin5=trim($_POST['txtslsubbd2']);
		$ups5=trim($_POST['txtslupsd2']);
		$qty5=trim($_POST['txtslqtyd2']);
		$rowidd2=trim($_POST['rowidd_2']);
		if($ups5 <=0)$ups5=1;
		}
		}
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
						
 	 $sql_in="update tbl_sloc set yearcode='$yearid_id', classification_id='$classification', items_id='$item', noofbinsg='$slocnog', noofbinsd='$slocnod', itmtype='$itmtype', surole='$lgnid' where slid='$pid'";
							
	if(mysql_query($sql_in)or die(mysql_error()))
	{
		$slid=$pid;
		
		$s_sub_sub="delete from tbl_sloc_sub where slocid='".$slid."'";
		mysql_query($s_sub_sub) or die(mysql_error());

		if($itmtype=="good")
		{
		$flash=0;
		for($i=0; $i<$slocnog; $i++)
		{
			if($flash==0)
			{
				$sql_in1="insert into tbl_sloc_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh1', '$bin1', '$subbin1', '$ups1', '$qty1', '$rowid1')";
			}
			else if($flash==1)
			{
				$sql_in1="insert into tbl_sloc_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh2', '$bin2', '$subbin2', '$ups2', '$qty2', '$rowid2')";
			}
			else if($flash==2)
			{
				$sql_in1="insert into tbl_sloc_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh3', '$bin3', '$subbin3', '$ups3', '$qty3', '$rowid3')";
			}
			mysql_query($sql_in1)or die(mysql_error());
			$flash++;
		}
		}
		else
		{
		$flash=0;
		for($i=0; $i<$slocnod; $i++)
		{
			if($flash==0)
			{
				$sql_in1="insert into tbl_sloc_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh4', '$bin4', '$subbin4', '$ups4', '$qty4', '$rowidd1')";
			}
			else if($flash==1)
			{
				$sql_in1="insert into tbl_sloc_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh5', '$bin5', '$subbin5', '$ups5', '$qty5', '$rowidd2')";
			}
			mysql_query($sql_in1)or die(mysql_error());
			$flash++;
		}
		} */
			echo "<script>window.location='add_sloc_preview.php?pid=$trid'</script>";	
	}
		
	
//}
//}
//}

	
	/*$a="SU";
	$sql_code="SELECT MAX(code) FROM tbl_sloc ORDER BY code DESC";
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
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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

<script src="slocup.js"></script>
<script language="javascript" type="text/javascript">
var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDept.reset();
	 popUpCalendar(document.frmaddDept.txtdate,dt,document.frmaddDept.txtdate, "dd-mmm-yyyy", xind, yind);
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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
/*function onloadfocus()
	{
	document.frmaddDept.txtdrno.focus();
	}*/
	

function clks(val)
{
//alert(val);
document.frmaddDept.txt14.value=val;
}

function mySubmit()
{ 
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	
	if(document.frmaddDept.txtclass.value=="")
	{
	alert("Please select Classification first");
	document.frmaddDept.txtclass.focus();
	return false;
	}
	
	if(document.frmaddDept.txtitem.value=="")
	{
	alert("Please select Item first");
	document.frmaddDept.txtitem.focus();
	return false;
	}
	
	if(document.frmaddDept.txtmtype.value=="")
	{
		alert("Please select Type");
		return false;
	} 
	
	if(document.frmaddDept.trid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
		}
		
	return true;	 
}

function modetchk(classval) 
{
	if(document.frmaddDept.clsschk.value!=classval)
	{
	document.frmaddDept.trid.value=0;
	}
	showUser(classval,'vitem','item','','','','','');
}

function classchk(itval)
{
if(document.frmaddDept.txtclass.value!="")
	{	
		//document.getElementById('slgood').style.display="none";
		//document.getElementById('sldamage').style.display="none";
		document.getElementById('subdiv').style.display="none";
		document.frmaddDept.txtmtype.value="";	
		document.getElementById('smt').checked=false;
		 
		if(document.frmaddDept.txtitem.value!="")
		{
			if(document.frmaddDept.itmdchk.value!="")
			{ 
				var flg=0;
				var itmchk=document.frmaddDept.itmdchk.value;
				var itm=itmchk.split(",");
				for(var i=0; i < itm.length; i++)
				{
					if(document.frmaddDept.txtitem.value==itm[i])
					{
						flg=1;
					}
				}
				if(flg==1)
				{
					alert("Please Check, this item is already posted in this transaction");
					document.frmaddDept.txtitem.selectedIndex=0;
					return false;
				}
				
			}
		}
		showUser(itval,'uom','itemuom','','','','','');
		//setTimeout('chktyp()',200);
	}
	else
	{
		alert("Please Select Classification")
		//document.frmaddDept.txtitem.
		document.frmaddDept.txtitem.selectedIndex=0;
		document.frmaddDept.txtclass.focus();
	}
}

function chktp(val)
{
document.frmaddDept.txtmtype.value=val;
document.getElementById('subdiv').style.display="block";
setTimeout('chktyp()',200);
		/*if(val=="good")
		{
			document.getElementById('subdiv').style.display="block";
			document.getElementById('slgood').style.display="block";
			document.getElementById('sldamage').style.display="none";
			
			document.frmaddDept.txtslwhg1.selectedIndex=0;
			document.frmaddDept.txtslwhg2.selectedIndex=0;
			document.frmaddDept.txtslwhg3.selectedIndex=0;
			document.frmaddDept.txtslbing1.selectedIndex=0;
			document.frmaddDept.txtslbing2.selectedIndex=0;
			document.frmaddDept.txtslbing3.selectedIndex=0;
			document.frmaddDept.txtslsubbg1.selectedIndex=0;
			document.frmaddDept.txtslsubbg2.selectedIndex=0;
			document.frmaddDept.txtslsubbg3.selectedIndex=0;
			document.frmaddDept.txtslupsg1.value="";
			document.frmaddDept.txtslqtyg1.value="";
			document.frmaddDept.txtslupsg2.value="";
			document.frmaddDept.txtslqtyg2.value="";
			document.frmaddDept.txtslupsg3.value="";
			document.frmaddDept.txtslqtyg3.value="";
			
			document.frmaddDept.txtslwhd1.selectedIndex=0;
			document.frmaddDept.txtslwhd2.selectedIndex=0;
			document.frmaddDept.txtslbind1.selectedIndex=0;
			document.frmaddDept.txtslbind2.selectedIndex=0;
			document.frmaddDept.txtslsubbd1.selectedIndex=0;
			document.frmaddDept.txtslsubbd2.selectedIndex=0;
			document.frmaddDept.txtslupsd1.value="";
			document.frmaddDept.txtslqtyd1.value="";
			document.frmaddDept.txtslupsd2.value="";
			document.frmaddDept.txtslqtyd2.value="";
			//document.frmaddDept.txt11.value=opt;
		}
		else if(val=="damage")
		{
			document.getElementById('subdiv').style.display="block";
			document.getElementById('slgood').style.display="none";
			document.getElementById('sldamage').style.display="block";
			
			document.frmaddDept.txtslwhg1.selectedIndex=0;
			document.frmaddDept.txtslwhg2.selectedIndex=0;
			document.frmaddDept.txtslwhg3.selectedIndex=0;
			document.frmaddDept.txtslbing1.selectedIndex=0;
			document.frmaddDept.txtslbing2.selectedIndex=0;
			document.frmaddDept.txtslbing3.selectedIndex=0;
			document.frmaddDept.txtslsubbg1.selectedIndex=0;
			document.frmaddDept.txtslsubbg2.selectedIndex=0;
			document.frmaddDept.txtslsubbg3.selectedIndex=0;
			document.frmaddDept.txtslupsg1.value="";
			document.frmaddDept.txtslqtyg1.value="";
			document.frmaddDept.txtslupsg2.value="";
			document.frmaddDept.txtslqtyg2.value="";
			document.frmaddDept.txtslupsg3.value="";
			document.frmaddDept.txtslqtyg3.value="";
			
			document.frmaddDept.txtslwhd1.selectedIndex=0;
			document.frmaddDept.txtslwhd2.selectedIndex=0;
			document.frmaddDept.txtslbind1.selectedIndex=0;
			document.frmaddDept.txtslbind2.selectedIndex=0;
			document.frmaddDept.txtslsubbd1.selectedIndex=0;
			document.frmaddDept.txtslsubbd2.selectedIndex=0;
			document.frmaddDept.txtslupsd1.value="";
			document.frmaddDept.txtslqtyd1.value="";
			document.frmaddDept.txtslupsd2.value="";
			document.frmaddDept.txtslqtyd2.value="";
			//document.frmaddDept.txt11.value=opt;
		}	
		else
		{
			document.getElementById('slgood').style.display="none";
			document.getElementById('sldamage').style.display="none";
			document.getElementById('subdiv').style.display="none";
			
			document.frmaddDept.txtslwhg1.selectedIndex=0;
			document.frmaddDept.txtslwhg2.selectedIndex=0;
			document.frmaddDept.txtslwhg3.selectedIndex=0;
			document.frmaddDept.txtslbing1.selectedIndex=0;
			document.frmaddDept.txtslbing2.selectedIndex=0;
			document.frmaddDept.txtslbing3.selectedIndex=0;
			document.frmaddDept.txtslsubbg1.selectedIndex=0;
			document.frmaddDept.txtslsubbg2.selectedIndex=0;
			document.frmaddDept.txtslsubbg3.selectedIndex=0;
			document.frmaddDept.txtslupsg1.value="";
			document.frmaddDept.txtslqtyg1.value="";
			document.frmaddDept.txtslupsg2.value="";
			document.frmaddDept.txtslqtyg2.value="";
			document.frmaddDept.txtslupsg3.value="";
			document.frmaddDept.txtslqtyg3.value="";
			
			document.frmaddDept.txtslwhd1.selectedIndex=0;
			document.frmaddDept.txtslwhd2.selectedIndex=0;
			document.frmaddDept.txtslbind1.selectedIndex=0;
			document.frmaddDept.txtslbind2.selectedIndex=0;
			document.frmaddDept.txtslsubbd1.selectedIndex=0;
			document.frmaddDept.txtslsubbd2.selectedIndex=0;
			document.frmaddDept.txtslupsd1.value="";
			document.frmaddDept.txtslqtyd1.value="";
			document.frmaddDept.txtslupsd2.value="";
			document.frmaddDept.txtslqtyd2.value="";
			
		}*/	
}
function chktyp()
{ 
	if(document.frmaddDept.txtitem.value!="")
	{
			var opttyp=document.frmaddDept.txtmtype.value;
			var clasid=document.frmaddDept.txtclass.value;
			var itmid=document.frmaddDept.txtitem.value;
			var trid=document.frmaddDept.trid.value;
			if(opttyp !="")
			{
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,trid,'');
			}
			else
			{
			alert("please select Material Type");
			}
			
	}
	else
	{
		alert("please select Item first");
		
	}
}

function clk(opt)
{
	if(opt!="")
	{
		if(opt=="Yes")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			document.frmaddDept.txt11.value=opt;
		}
		else
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			document.frmaddDept.txt11.value=opt;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
	}
}
/*function bingood(gval)
{	
		//alert(gval);
		
		if(gval==1 || gval=="1")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value=document.frmaddDept.txtupsg.value;
			document.getElementById('qty1').value=document.frmaddDept.txtqtyg.value;
			document.getElementById('ups1').readOnly=false;
			document.getElementById('ups1').style.backgroundColor="#FFFFFF";
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
			document.getElementById('ups2').readOnly=false;
			document.getElementById('ups2').style.backgroundColor="#FFFFFF";
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
			document.getElementById('ups3').readOnly=false;
			document.getElementById('ups3').style.backgroundColor="#FFFFFF";
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
function bindamage(dval)
{
	/*if(document.frmaddDept.tblslocnog.value > 0)
	{
		if(dval==1 || dval=="1")
		{
			document.getElementById('dsloc1').style.display="block";
			document.getElementById('dsloc2').style.display="none";
			document.getElementById('ups4').value=document.frmaddDept.txtupsg.value;
			document.getElementById('qty4').value=document.frmaddDept.txtqtyg.value;
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
	/*}
	else
	{
	alert("Please select number of Bins Good");
	document.frmaddDept.tblslocnog.focus();
	}
}*/
function wh1(wh1val)
{ //alert(wh1val);
/*if(document.frmaddDept.txtqtyg.value > 0)
	{*/
		showUser(wh1val,'bing1','wh','bing1','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDept.txtslwhg1.selectedIndex=0;
	}*/
}

function wh2(wh2val)
{   
	/*if(document.frmaddDept.txtqtyg.value > 0)
	{*/
		showUser(wh2val,'bing2','wh','bing2','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDept.txtslwhg2.selectedIndex=0;
	}*/
}

function wh3(wh3val)
{
	/*if(document.frmaddDept.txtqtyg.value > 0)
	{*/
			showUser(wh3val,'bing3','wh','bing3','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Good");
		document.frmaddDept.txtslwhg3.selectedIndex=0;
	}*/
}

function wh4(wh4val)
{
		/*if(document.frmaddDept.txtqtyd.value > 0)
		{*/
			showUser(wh4val,'bind1','wh','bind1','','','','');
		/*}
		else
		{
			alert("Please enter Quantity Damage");
			document.frmaddDept.txtslwhd1.selectedIndex=0;
		}*/
	
}

function wh5(wh5val)
{
	/*if(document.frmaddDept.txtqtyd.value > 0)
	{*/
		showUser(wh5val,'bind2','wh','bind2','','','','');
	/*}
	else
	{
		alert("Please enter Quantity Damage");
		document.frmaddDept.txtslwhd2.selectedIndex=0;
	}*/
}

function bin1(bin1val)
{
	if(document.frmaddDept.txtslwhg1.value!="")
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
	if(document.frmaddDept.txtslwhg2.value!="")
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
	if(document.frmaddDept.txtslwhg3.value!="")
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
	if(document.frmaddDept.txtslwhd1.value!="")
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
	if(document.frmaddDept.txtslwhd2.value!="")
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
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbing1.value!="")
	{	
		var w1=document.frmaddDept.txtslwhg1.value+document.frmaddDept.txtslbing1.value+document.frmaddDept.txtslsubbg1.value;
		var w2=document.frmaddDept.txtslwhg2.value+document.frmaddDept.txtslbing2.value+document.frmaddDept.txtslsubbg2.value;
		var w3=document.frmaddDept.txtslwhg3.value+document.frmaddDept.txtslbing3.value+document.frmaddDept.txtslsubbg3.value;
		if(w1==w2 || w1==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDept.txtslsubbg1.selectedIndex=0;
		document.frmaddDept.txtslbing3.focus();
		}
	
	//alert("subbin");
		var slocnogood="";//document.frmaddDept.tblslocnog.value;
		var trid=document.frmaddDept.trid.value;
		//var slocnodamage=document.frmaddDept.tblslocnod.value;
		if(document.frmaddDept.txtslupsg1.value!="")
		var upsv1=document.frmaddDept.txtslupsg1.value;
		else
		var upsv1="";
		if(document.frmaddDept.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDept.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDept.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbing2.value!="")
	{	
		var w1=document.frmaddDept.txtslwhg1.value+document.frmaddDept.txtslbing1.value+document.frmaddDept.txtslsubbg1.value;
		var w2=document.frmaddDept.txtslwhg2.value+document.frmaddDept.txtslbing2.value+document.frmaddDept.txtslsubbg2.value;
		var w3=document.frmaddDept.txtslwhg3.value+document.frmaddDept.txtslbing3.value+document.frmaddDept.txtslsubbg3.value;
		if(w2==w1 || w2==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDept.txtslsubbg2.selectedIndex=0;
		document.frmaddDept.txtslbing3.focus();
		}
		
		//if(document.frmaddDept.txtslsubbg1.value!="")
		
		var slocnogood="";//document.frmaddDept.tblslocnog.value;
		var trid=document.frmaddDept.trid.value;
		//var slocnodamage=document.frmaddDept.tblslocnod.value;
		if(document.frmaddDept.txtslupsg2.value!="")
		var upsv2=document.frmaddDept.txtslupsg2.value;
		else
		var upsv2="";
		if(document.frmaddDept.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDept.txtslqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,upsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDept.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbing3.value!="")
	{	
		var w1=document.frmaddDept.txtslwhg1.value+document.frmaddDept.txtslbing1.value+document.frmaddDept.txtslsubbg1.value;
		var w2=document.frmaddDept.txtslwhg2.value+document.frmaddDept.txtslbing2.value+document.frmaddDept.txtslsubbg2.value;
		var w3=document.frmaddDept.txtslwhg3.value+document.frmaddDept.txtslbing3.value+document.frmaddDept.txtslsubbg3.value;
		if(w1==w3 || w2==w3)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDept.txtslsubbg3.selectedIndex=0;
		document.frmaddDept.txtslbing3.focus();
		}
		
		var slocnogood="";//document.frmaddDept.tblslocnog.value;
		var trid=document.frmaddDept.trid.value;
		//var slocnodamage=document.frmaddDept.tblslocnod.value;
		if(document.frmaddDept.txtslupsg3.value!="")
		var upsv3=document.frmaddDept.txtslupsg3.value;
		else
		var upsv3="";
		if(document.frmaddDept.txtslqtyg3.value!="")
		var qtyv3=document.frmaddDept.txtslqtyg3.value;
		else
		var qtyv3="";
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,upsv3,qtyv3,trid);
		//showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDept.txtslbing3.focus();
	}
}

function subbin4(subbin4val)
{
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbind1.value!="")
	{	
		var w4=document.frmaddDept.txtslwhd1.value+document.frmaddDept.txtslbind1.value+document.frmaddDept.txtslsubbd1.value;
		var w5=document.frmaddDept.txtslwhd2.value+document.frmaddDept.txtslbind2.value+document.frmaddDept.txtslsubbd2.value;
				if(w5==w4)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.frmaddDept.txtslsubbd1.selectedIndex=0;
				document.frmaddDept.txtslbind1.focus();
				}
				
		//var slocnogood=document.frmaddDept.tblslocnog.value;
		var slocnodamage="";//document.frmaddDept.tblslocnod.value;
		var trid=document.frmaddDept.trid.value;
		if(document.frmaddDept.txtslupsd1.value!="")
		var upsv1=document.frmaddDept.txtslupsd1.value;
		else
		var upsv1="";
		if(document.frmaddDept.txtslqtyd1.value!="")
		var qtyv1=document.frmaddDept.txtslqtyd1.value;
		else
		var qtyv1="";
		showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbd1',slocnodamage,upsv1,qtyv1,trid);
		//showUser(subbin4val,'slocrow4','subbin',itemv,'txtslsubbd1','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDept.txtslbind1.focus();
	}
}

function subbin5(subbin5val)
{
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbind1.value!="")
	{	
		var w4=document.frmaddDept.txtslwhd1.value+document.frmaddDept.txtslbind1.value+document.frmaddDept.txtslsubbd1.value;
		var w5=document.frmaddDept.txtslwhd2.value+document.frmaddDept.txtslbind2.value+document.frmaddDept.txtslsubbd2.value;
		if(w4==w5)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDept.txtslsubbd2.selectedIndex=0;
		document.frmaddDept.txtslbind2.focus();
		}
		//var slocnogood=document.frmaddDept.tblslocnog.value;
		var slocnodamage="";//document.frmaddDept.tblslocnod.value;
		var trid=document.frmaddDept.trid.value;
		if(document.frmaddDept.txtslupsd2.value!="")
		var upsv2=document.frmaddDept.txtslupsd2.value;
		else
		var upsv2="";
		if(document.frmaddDept.txtslqtyd2.value!="")
		var qtyv2=document.frmaddDept.txtslqtyd2.value;
		else
		var qtyv2="";
		showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbd2',slocnodamage,upsv2,qtyv2,trid);
		//showUser(subbin5val,'slocrow5','subbin',itemv,'txtslsubbd2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDept.txtslbind1.focus();
	}
}



function upsf1(ups1val)
{
	if(document.frmaddDept.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDept.txtslupsg1.value="";
		//document.frmaddDept.txtslsubbg1.focus();
	}
	if(document.frmaddDept.txtslupsg1.value!="")
	{
		/*if(parseInt(document.frmaddDept.txtslupsg1.value)==0 || document.frmaddDept.txtslupsg1.value=="")
		{
			alert("UPS can not be ZERO");
			document.frmaddDept.txtslupsg1.value="";
			//document.frmaddDept.txtslupsg1.focus();
			
		}*/
		var exu=0;
		if(document.frmaddDept.exupsg1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDept.exupsg1.value);
			document.frmaddDept.balupsg1.value=parseInt(document.frmaddDept.txtslupsg1.value);
	}
	else
	{
	document.frmaddDept.balupsg1.value="";
	}
}

function upsf2(ups2val)
{
	if(document.frmaddDept.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDept.txtslupsg2.value="";
		document.frmaddDept.txtslsubbg2.focus();
	}
	if(document.frmaddDept.txtslupsg2.value!="")
	{
		/*if(document.frmaddDept.txtslupsg2.value==0 || document.frmaddDept.txtslupsg2.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDept.txtslupsg2.value="";
			document.frmaddDept.txtslupsg2.focus();
		}*/
		var exu=0;
		if(document.frmaddDept.exupsg2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDept.exupsg2.value);
			document.frmaddDept.balupsg2.value=parseInt(document.frmaddDept.txtslupsg2.value);
	}
	else
	{
	document.frmaddDept.balupsg2.value="";
	}
}

function upsf3(ups3val)
{
	if(document.frmaddDept.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDept.txtslupsg3.value="";
		document.frmaddDept.txtslsubbg3.focus();
	}
	if(document.frmaddDept.txtslupsg3.value!="")
	{
		/*if(document.frmaddDept.txtslupsg3.value==0 || document.frmaddDept.txtslupsg3.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDept.txtslupsg3.value="";
			document.frmaddDept.txtslupsg3.focus();
		}*/
		var exu=0;
		if(document.frmaddDept.exupsg3.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDept.exupsg3.value);
		document.frmaddDept.balupsg3.value=parseInt(document.frmaddDept.txtslupsg3.value);
	}
	else
	{
	document.frmaddDept.balupsg3.value="";
	}
}

function upsf4(ups4val)
{
	if(document.frmaddDept.txtslsubbd1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDept.txtslupsd1.value="";
		document.frmaddDept.txtslsubbd1.focus();
	}
	if(document.frmaddDept.txtslupsd1.value!="")
	{
		/*if(document.frmaddDept.txtslupsd1.value==0 || document.frmaddDept.txtslupsd1.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDept.txtslupsd1.value="";
			document.frmaddDept.txtslupsd1.focus();
		}*/
		var exu=0;
		if(document.frmaddDept.exupsd1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDept.exupsd1.value);
		document.frmaddDept.balupsd1.value=parseInt(document.frmaddDept.txtslupsd1.value);
	}
	else
	{
	document.frmaddDept.balupsd1.value="";
	}
}

function upsf5(ups5val)
{
	if(document.frmaddDept.txtslsubbd2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDept.txtslupsd2.value="";
		document.frmaddDept.txtslsubbd2.focus();
	}
	if(document.frmaddDept.txtslupsd2.value!="")
	{
		/*if(document.frmaddDept.txtslsubbd2.value==0 || document.frmaddDept.txtslupsd2.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDept.txtslupsd2.value="";
			document.frmaddDept.txtslupsd2.focus();
		}*/
		var exu=0;
		if(document.frmaddDept.exupsd2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDept.exupsd2.value);
		document.frmaddDept.balupsd2.value=parseInt(document.frmaddDept.txtslupsd2.value);
	}
	else
	{
	document.frmaddDept.balupsd2.value="";
	}

}

function qtyf1(qty1val)
{	
	if(document.frmaddDept.txtslupsg1.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDept.txtslqtyg1.value="";
	}
	if(document.frmaddDept.txtslqtyg1.value!="")
	{
			/*if(document.frmaddDept.txtslqtyg1.value==0 || document.frmaddDept.txtslqtyg1.value=="0")
			{
				alert("Quantity can not be ZERO");
				document.frmaddDept.txtslqtyg1.value="";
				document.frmaddDept.txtslqtyg1.focus();
			}*/
			
		var exq=0;
		if(document.frmaddDept.exqtyg1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDept.exqtyg1.value);
		document.frmaddDept.balqtyg1.value=parseFloat(document.frmaddDept.txtslqtyg1.value);
	}
	else
	{
	document.frmaddDept.balqtyg1.value="";
	}

}

function qtyf2(qty2val)
{
	if(document.frmaddDept.txtslupsg2.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDept.txtslqtyg2.value="";
		document.frmaddDept.txtslupsg2.focus();
	}
	if(document.frmaddDept.txtslqtyg2.value!="")
	{
		/*if(document.frmaddDept.txtslqtyg2.value==0 || document.frmaddDept.txtslqtyg2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDept.txtslqtyg2.value="";
			document.frmaddDept.txtslqtyg2.focus();
		}*/
		var exq=0;
		if(document.frmaddDept.exqtyg2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDept.exqtyg2.value);
		document.frmaddDept.balqtyg2.value=parseFloat(document.frmaddDept.txtslqtyg2.value);
	}
	else
	{
	document.frmaddDept.balqtyg2.value="";
	}
}

function qtyf3(qty3val)
{
	if(document.frmaddDept.txtslupsg3.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDept.txtslqtyg3.value="";
		document.frmaddDept.txtslupsg3.focus();
	}
	if(document.frmaddDept.txtslqtyg3.value!="")
	{
		/*if(document.frmaddDept.txtslqtyg3.value==0 || document.frmaddDept.txtslqtyg3.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDept.txtslqtyg3.value="";
			document.frmaddDept.txtslqtyg3.focus();
		}*/
		var exq=0;
		if(document.frmaddDept.exqtyg3.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDept.exqtyg3.value);
		document.frmaddDept.balqtyg3.value=parseFloat(document.frmaddDept.txtslqtyg3.value);
	}
	else
	{
	document.frmaddDept.balqtyg3.value="";
	}
}

function qtyf4(qty4val)
{
	if(document.frmaddDept.txtslupsd1.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDept.txtslqtyd1.value="";
		document.frmaddDept.txtslupsd1.focus();
	}
	if(document.frmaddDept.txtslqtyd1.value!="")
	{
		/*if(document.frmaddDept.txtslqtyd1.value==0 || document.frmaddDept.txtslqtyd1.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDept.txtslqtyd1.value="";
			document.frmaddDept.txtslqtyd1.focus();
		}*/
		var exq=0;
		if(document.frmaddDept.exqtyd1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDept.exqtyd1.value);
		document.frmaddDept.balqtyd1.value=parseFloat(document.frmaddDept.txtslqtyd1.value);
	}
	else
	{
	document.frmaddDept.balqtyd1.value="";
	}
}

function qtyf5(qty5val)
{
	if(document.frmaddDept.txtslupsd2.value=="")
	{
		alert("Please enter UPS");
		document.frmaddDept.txtslqtyd2.value="";
		document.frmaddDept.txtslupsd2.focus();
	}
	if(document.frmaddDept.txtslqtyd2.value!="")
	{
		/*if(document.frmaddDept.txtslqtyd2.value==0 || document.frmaddDept.txtslqtyd2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDept.txtslqtyd2.value="";
			document.frmaddDept.txtslqtyd2.focus();
		}*/
		var exq=0;
		if(document.frmaddDept.exqtyd2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDept.exqtyd2.value);
		document.frmaddDept.balqtyd2.value=parseFloat(document.frmaddDept.txtslqtyd2.value);
	}
	else
	{
	document.frmaddDept.balqtyd2.value="";
	}
}



	function pform()
{ 
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	else if(document.frmaddDept.txtclass.value=="")
	{
		alert("Please select Classification first");
		document.frmaddDept.txtclass.focus();
		return false;
	}
	else if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	else if(document.frmaddDept.txtmtype.value=="")
	{
		alert("Please select Type");
		return false;
	} 
	
	else if(document.frmaddDept.txtmtype.value=="good")
	{
			if((document.frmaddDept.txtslqtyg1.value > 0) && (document.frmaddDept.txtslsubbg1.value==""))
			{
				
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg1.focus();
					return false;		
				
			}
			if((document.frmaddDept.txtslqtyg2.value > 0) && (document.frmaddDept.txtslsubbg2.value==""))
			{
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg2.focus();
					return false;		
				
			}
			if((document.frmaddDept.txtslqtyg3.value > 0) && (document.frmaddDept.txtslsubbg3.value==""))
			{
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg3.focus();
					return false;		
			}
		
	}
	else if(document.frmaddDept.txtmtype.value=="damage")
	{
			if((document.frmaddDept.txtslqtyd1.value>0) && (document.frmaddDept.txtslsubbd1.value==""))
			{
			alert("Sub Bin Not selected");	
			//document.frmaddDept.tblslocnog.focus();
			return false;
			} 
			if((document.frmaddDept.txtslqtyd2.value>0) && (document.frmaddDept.txtslsubbd2.value==""))
			{
			alert("Sub Bin Not selected");	
			//document.frmaddDept.tblslocnog.focus();
			return false;
			}
		
	} 	
	/*else
	{*/	//alert("hi");
			if(document.frmaddDept.txtmtype.value=="good")
			{
				var u1=document.frmaddDept.txtslupsg1.value;
				var u2=document.frmaddDept.txtslupsg2.value;
				var u3=document.frmaddDept.txtslupsg3.value;
				var q1=document.frmaddDept.txtslqtyg1.value;
				var q2=document.frmaddDept.txtslqtyg2.value;
				var q3=document.frmaddDept.txtslqtyg3.value;
				var d=document.frmaddDept.otqty.value;
				var u=document.frmaddDept.otups.value;
				
				if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;
				if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;
				if(d=="")d=0;
				if(u=="")u=0;
				var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3);
				var upsd=parseInt(u1)+parseInt(u2)+parseInt(u3);
				var f=0;
				
				/*if(parseFloat(d) != parseFloat(qtyd))
				{
				alert("Please check. Quantity distributed in Bins not matching with Quantity to be Update");
				return false;
				f=1;
				}*/
				if(parseFloat(document.frmaddDept.txtqtyg.value) != parseFloat(qtyd))
				{
				alert("Please check. Balance Quantity distributed in Bins not matching with  Total Quantity");
				return false;
				f=1;
				}
				/*if(qtyd==0)
				{
				alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
				return false;
				f=1;
				}*/
				if(parseFloat(d) == parseFloat(qtyd))
				{
				document.frmaddDept.otups.value=0;
				}
				if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
				{
				document.frmaddDept.otups.value=1;
				}
				if(f==1)
				{
				return false;
				}
				else
				{
				var a=formPost(document.getElementById('mainform'));
				//alert(a);
				//document.frmaddDept.tttt.value=a;
				showUser(a,'maindiv','mformcc','','','','','');
				}
			}
			else
			{
				var u4=document.frmaddDept.txtslupsd1.value;
				var u5=document.frmaddDept.txtslupsd2.value;
				var q4=document.frmaddDept.txtslqtyd1.value;
				var q5=document.frmaddDept.txtslqtyd2.value;
				var d=document.frmaddDept.otqty.value;
				var u=document.frmaddDept.otups.value;
				
				if(q4=="")q4=0;if(q5=="")q5=0;
				if(u4=="")u4=0;if(u5=="")u5=0;
				if(d=="")d=0;
				if(u=="")u=0;
				var qtyd=parseFloat(q4)+parseFloat(q5);
				var upsd=parseInt(u4)+parseInt(u5);
				var f=0;
				
				/*if(parseFloat(d) != parseFloat(qtyd))
				{
				alert("Please check. Quantity distributed in Bins not matching with Quantity to be Update");
				return false;
				f=1;
				}*/
				if(parseFloat(document.frmaddDept.txtqtyg.value) != parseFloat(qtyd))
				{
				alert("Please check. Balance Quantity distributed in Bins not matching with  Total Quantity");
				return false;
				f=1;
				}
				/*if(qtyd==0)
				{
				alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
				return false;
				f=1;
				}*/
				if(parseFloat(d) == parseFloat(qtyd))
				{
				document.frmaddDept.otups.value=0;
				}
				if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
				{
				document.frmaddDept.otups.value=1;
				}
				if(f==1)
				{
				return false;
				}
				else
				{	var a=formPost(document.getElementById('mainform'));
				//alert(a);
				//document.frmaddDept.tttt.value=a;
				showUser(a,'maindiv','mformcc','','','','','');
				}
			}
	//}
}	

function pformupdate()
{

if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
else if(document.frmaddDept.txtclass.value=="")
	{
		alert("Please select Classification first");
		document.frmaddDept.txtclass.focus();
		return false;
	}
	else if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	else if(document.frmaddDept.txtmtype.value=="")
	{
		alert("Please select Type");
		return false;
	} 
	
	else if(document.frmaddDept.txtmtype.value=="good")
	{
		if(parseInt(document.frmaddDept.cntchk.value) == 1)
		{
			if((document.frmaddDept.txtslqtyg1.value > 0) && (document.frmaddDept.txtslsubbg1.value==""))
			{
				
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg1.focus();
					return false;		
				
			}
		}
		if(parseInt(document.frmaddDept.cntchk.value) == 2)
		{
			if((document.frmaddDept.txtslqtyg1.value > 0) && (document.frmaddDept.txtslsubbg1.value==""))
			{
				
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg1.focus();
					return false;		
				
			}
			if((document.frmaddDept.txtslqtyg2.value > 0) && (document.frmaddDept.txtslsubbg2.value==""))
			{
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg2.focus();
					return false;		
				
			}
		}
		if(parseInt(document.frmaddDept.cntchk.value) == 3)
		{
			if((document.frmaddDept.txtslqtyg1.value > 0) && (document.frmaddDept.txtslsubbg1.value==""))
			{
				
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg1.focus();
					return false;		
				
			}
			if((document.frmaddDept.txtslqtyg2.value > 0) && (document.frmaddDept.txtslsubbg2.value==""))
			{
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg2.focus();
					return false;		
				
			}
			if((document.frmaddDept.txtslqtyg3.value > 0) && (document.frmaddDept.txtslsubbg3.value==""))
			{
					alert("Sub Bin Not selected");	
					//document.frmaddDept.txtslsubbg3.focus();
					return false;		
				
			}
		}
	}
	else if(document.frmaddDept.txtmtype.value=="damage")
	{
		if(parseInt(document.frmaddDept.cntchk.value) == 1)
		{
			if((document.frmaddDept.txtslqtyd1.value>0) && (document.frmaddDept.txtslsubbd1.value==""))
			{
			alert("Sub Bin Not selected");	
			//document.frmaddDept.tblslocnog.focus();
			return false;
			} 
		}
		if(parseInt(document.frmaddDept.cntchk.value) == 2)
		{
			if((document.frmaddDept.txtslqtyd1.value>0) && (document.frmaddDept.txtslsubbd1.value==""))
			{
			alert("Sub Bin Not selected");	
			//document.frmaddDept.tblslocnog.focus();
			return false;
			} 
			if((document.frmaddDept.txtslqtyd2.value>0) && (document.frmaddDept.txtslsubbd2.value==""))
			{
			alert("Sub Bin Not selected");	
			//document.frmaddDept.tblslocnog.focus();
			return false;
			}
		}
	} 	
	/*else
	{	*///alert("hi");
		if(document.frmaddDept.txtmtype.value=="good")
		{
			if(parseInt(document.frmaddDept.cntchk.value) == 1)
			{
			var u1=document.frmaddDept.txtslupsg1.value;
			var u2=0;
			var u3=0;
			var q1=document.frmaddDept.txtslqtyg1.value;
			var q2=0;
			var q3=0;
			}
			if(parseInt(document.frmaddDept.cntchk.value) == 2)
			{
			var u1=document.frmaddDept.txtslupsg1.value;
			var u2=document.frmaddDept.txtslupsg2.value;
			var u3=0;
			var q1=document.frmaddDept.txtslqtyg1.value;
			var q2=document.frmaddDept.txtslqtyg2.value;
			var q3=0;
			}
			if(parseInt(document.frmaddDept.cntchk.value) == 3)
			{
			var u1=document.frmaddDept.txtslupsg1.value;
			var u2=document.frmaddDept.txtslupsg2.value;
			var u3=document.frmaddDept.txtslupsg3.value;
			var q1=document.frmaddDept.txtslqtyg1.value;
			var q2=document.frmaddDept.txtslqtyg2.value;
			var q3=document.frmaddDept.txtslqtyg3.value;
			}
			
			var d=document.frmaddDept.otqty.value;
			var u=document.frmaddDept.otups.value;
			
			if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;
			if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;
			if(d=="")d=0;
			if(u=="")u=0;
			var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3);
			var upsd=parseInt(u1)+parseInt(u2)+parseInt(u3);
			var f=0;
			
			/*if(parseFloat(d) != parseFloat(qtyd))
			{
			alert("Please check. Quantity distributed in Bins not matching with Quantity to be Update");
			return false;
			f=1;
			}*/
			
			if(parseFloat(document.frmaddDept.txtqtyg.value) != parseFloat(qtyd))
				{
				alert("Please check. Balance Quantity distributed in Bins not matching with  Total Quantity");
				return false;
				f=1;
				}
			/*if(qtyd==0)
			{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			return false;
			f=1;
			}*/
			if(parseFloat(d) == parseFloat(qtyd))
			{
			document.frmaddDept.otups.value=0;
			}
			if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
			{
			document.frmaddDept.otups.value=1;
			}
			if(f==1)
			{
			return false;
			}
			else
			{
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			//document.frmaddDept.txtremarks.value=a;
			showUser(a,'maindiv','mformccupdate','','','','','');
			}
		}
		else
		{
			if(parseInt(document.frmaddDept.cntchk.value) == 1)
			{
			var u4=document.frmaddDept.txtslupsd1.value;
			var u5=0;
			var q4=document.frmaddDept.txtslqtyd1.value;
			var q5=0;
			}
			if(parseInt(document.frmaddDept.cntchk.value) == 2)
			{
			var u4=document.frmaddDept.txtslupsd1.value;
			var u5=document.frmaddDept.txtslupsd2.value;
			var q4=document.frmaddDept.txtslqtyd1.value;
			var q5=document.frmaddDept.txtslqtyd2.value;
			}
			var d=document.frmaddDept.otqty.value;
			var u=document.frmaddDept.otups.value;
			
			if(q4=="")q4=0;if(q5=="")q5=0;
			if(u4=="")u4=0;if(u5=="")u5=0;
			if(d=="")d=0;
			if(u=="")u=0;
			var qtyd=parseFloat(q4)+parseFloat(q5);
			var upsd=parseInt(u4)+parseInt(u5);
			var f=0;
			
			/*if(parseFloat(d) != parseFloat(qtyd))
			{
			alert("Please check. Quantity distributed in Bins not matching with Quantity to be Update");
			return false;
			f=1;
			}*/
			if(parseFloat(document.frmaddDept.txtqtyg.value) != parseFloat(qtyd))
				{
				alert("Please check. Balance Quantity distributed in Bins not matching with  Total Quantity");
				return false;
				f=1;
				}
			/*if(qtyd==0)
			{
			alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
			return false;
			f=1;
			}*/
			if(parseFloat(d) == parseFloat(qtyd))
			{
			document.frmaddDept.otups.value=0;
			}
			if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(upsd) >= parseInt(u)))
			{
			document.frmaddDept.otups.value=1;
			}
			if(f==1)
			{
			return false;
			}
			else
			{	var a=formPost(document.getElementById('mainform'));
			//alert(a);
			//document.frmaddDept.txtremarks.value=a;
			showUser(a,'maindiv','mformccupdate','','','','','');
			}
		}
	//}
}


function openslocpop()
{
	if(document.frmaddDept.txtitem.value!="")
	{
		var itm=document.frmaddDept.txtitem.value;
		winHandle=window.open('item_sloc_details.php?itmid='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null)
		{
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
		}
	}
	else
	{
		alert("Please Select Item");
		document.frmaddDept.txtitem.focus();
	}
}
function showsloc(val1, val2, val3)
{
document.frmaddDept.oups.value=val1;
document.frmaddDept.oqty.value=val2;
document.frmaddDept.orwoid.value=val3;
var trid=document.frmaddDept.trid.value;
//alert(val3);
			var opttyp=document.frmaddDept.txtmtype.value;
			var clasid=document.frmaddDept.txtclass.value;
			var itmid=document.frmaddDept.txtitem.value;
			//alert(opttyp);
showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'');
//document.getElementById('sloc1').style.display="block";
}

function editrec(v1,v2,v3)
{
//alert(v1);
//alert(v2);
//alert(v3);
//etdrecgd
showUser(v1,'subsubdiv','etdrecsl',v2,v3,'','','');
//showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,itmid,'','');
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
				<li><a href="../masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
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
              <ul style="vertical-align:text-top"> <li> <a href="operatorprofile.php">Profile </a> | </li>
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
          <td width="100%" valign="top"   align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#4ea1e1" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysql_query("select * from tbl_sloc where slid='".$pid."'")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	
	$tdate=$row['issuedate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
$trid=$pid;
$c=$row['classification_id'];
$f=$row['items_id'];
$a=$row['itmtype'];
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="code" value="<?php echo $row['code'];?>" type="hidden">
	  <input name="txtmtype" value="<?php echo $row['itmtype'];?>" type="hidden">
	   <input type="hidden" name="rettyp" value="" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
	  <input type="hidden" name="clsschk" value="<?php echo $row['classification_id'];?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation </td>
</tr>
  <tr height="30">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="200" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
            <td width="415"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TSU".$row['code']."/".$yearid_id."/".$lgnid;?></td>
		   
		   <td width="64" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="161" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>" /></td>
		   </tr>
 <?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
		 <tr class="Dark" height="25">
           <td width="200"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;"   onchange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($quer3)) { ?>
		<option <?php if($row['classification_id']==$noticia_class['classification_id']) { echo "Selected";} ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores where classification_id='".$row['classification_id']."' and actstatus='Active'") or die(mysql_error());
?> 
		 <tr class="Dark" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="415" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" style="width:230px;" onChange="classchk(this.value);" >
<option value="" >--Select Item--</option>
	<?php while($noticia_item = mysql_fetch_array($itemqry)) { ?>
	<option <?php if($row['items_id']==$noticia_item['items_id']){ echo "Selected";} ?> value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">SLOC Lookup</a></td>
         
<?php 
$itemqry1=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."'") or die(mysql_error());
$row_itm=mysql_fetch_array($itemqry1);
?> 
		 
		 <td width="64" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="161"  align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row_itm['uom'];?>" /></td>
         </tr>	 <input type="hidden" name="itmdchk" value="" />
 <tr class="Light" height="25">
            <td width="276" height="24"  align="right"  valign="middle" class="tblheading">Select Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtrettyp" id="smt" type="radio" class="tbltext" value="good" onClick="chktp(this.value);" <?php if($row['itmtype'] == "good") echo "Checked"; ?> />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txtrettyp" id="smt" type="radio" class="tbltext" value="damage" onClick="chktp(this.value);" <?php if($row['itmtype'] == "damage") echo "Checked"; ?> />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp; </td>
         </tr>	
</table>
<br />
<?php
$txtmtype=$row['itmtype'];
$classid=$row['classification_id'];
$itemid=$row['items_id'];
?>
<div id="maindiv">
<div id="subdiv" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
  <tr class="tblsubtitle" height="25">
   <td colspan="4" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <td colspan="3" align="center" valign="middle" class="tblheading">Updated Sloc </td>
   <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
 </tr>
 <tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">UPS</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<td width="129" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="93" align="center" valign="middle" class="tblheading">UPS</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>
<?php

if($txtmtype=="good")
{
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 $sloc1="";
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];
$sloc1=$wareh1.$binn1.$subbinn1;
$totups=$totups+$row_issuetbl['stlg_balups'];
$totqty=$totqty+$row_issuetbl['stlg_balqty'];

 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stlg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
$balu=$row_issuetbl['stlg_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stlg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stlg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
$balu=$row_issuetbl['stlg_balups']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['stlg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>		
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stlg_balups'];?>','<?php echo $row_issuetbl['stlg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 }
 else
 {
 

$sql_issue=mysql_query("select distinct stld_whid, stld_subbinid, stld_binid from tbl_stldg_damage where stld_trclassid='".$classid."' and stld_tritemid='".$itemid."'") or die(mysql_error());

$srno=1;
$totups=0; $totqty=0; $sloc1="";
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysql_query("select max(stld_id) from tbl_stldg_damage where stld_subbinid='".$row_issue['stld_subbinid']."' and stld_binid='".$row_issue['stld_binid']."' and stld_whid='".$row_issue['stld_whid']."' and stld_tritemid='".$itemid."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_damage where stld_id='".$row_issue1[0]."' and stld_balqty > 0") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stld_subbinid']."' and binid='".$row_issuetbl['stld_binid']."' and whid='".$row_issuetbl['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];
$sloc1=$wareh1.binn1.$subbinn1;

$totups=$totups+$row_issuetbl['stld_balups'];
$totqty=$totqty+$row_issuetbl['stld_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stld_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."'and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
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
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['stld_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['stld_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysql_query("select * from tbl_sloc_sub where slocid='".$trid."'and rowid='".$row_issue1[0]."'") or die(mysql_error());
while($row_sloc=mysql_fetch_array($sql_sloc))
{$slups=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
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
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['stld_balups'];?>','<?php echo $row_issuetbl['stld_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 <td colspan="4" align="center" valign="middle" class="tblheading">&nbsp;</td>
 </tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="10">Item not in Stock</td>
 </tr>
 <?php
 }
 ?>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" /></div>
<div id="subsubdiv">
</div><br />
</div>


<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><a href="add_arrival.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
