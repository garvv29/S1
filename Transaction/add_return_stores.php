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
	 //$yearid_id="09-10";	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	//$logid="OP1";
	//$lgnid="OP1";
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$p_id=trim($_POST['maintrid']);
		$code=trim($_POST['code']);
		$date=trim($_POST['date']);
		$rfs=trim($_POST['txtstage']);
		$rbd=trim($_POST['txtrd']);
		$partyid=trim($_POST['txtparty']);
		$remarks=trim($_POST['txtremarks']);
		$remarks=str_replace("&","and",$remarks);
		if($rbd == "")
		{
		$rbd=trim($_POST['txtrbd']);	
		}
	
	echo "<script>window.location='add_return_stores_preview.php?p_id=$p_id&remarks=$remarks&partyid=$partyid&txtstage=$rfs&txtrd=$rbd'</script>";	
		
}


$sql_code="SELECT MAX(arrival_code) FROM tblarrival where yearcode='$yearid_id' and arrival_type='Internalreturn' ORDER BY arrival_code DESC";
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
<title>Stores-Transaction Arrival - Internal Return-Own (Good &amp; Damage)</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="intretchk.js"></script>
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
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslsubbg3.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
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
		
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var q3=document.frmaddDepartment.txtslqtyg3.value;
		var q4=document.frmaddDepartment.txtslqtyd1.value;
		var q5=document.frmaddDepartment.txtslqtyd2.value;
		var g=document.frmaddDepartment.txtqtyg.value;
		var d=document.frmaddDepartment.txtqtyd.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;
		if(g=="")g=0;if(d=="")d=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2)+parseFloat(q3);
		var qtyd=parseInt(q4)+parseInt(q5);
		var f=0;
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in Good Item received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		if(parseFloat(d)!=parseFloat(qtyd))
		{
		alert("Please check. Quantity in Damage Item received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		if(g==0 && d==0)
		{
		alert("Please check. Quantity Received Good and Quantity Received Damage Both cannot be Zero or Blank");
		return false;
		f=1;
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
		showUser(a,'postingtable','mform','','','','','');
		}
	}
}

function pformedtup()
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
	else if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslsubbg1.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	
	else if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslsubbg2.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	else if((document.frmaddDepartment.txtslqtyg3.value>0) && (document.frmaddDepartment.txtslsubbg3.value==""))
	{
		alert("Sub Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
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
		
		var q1=document.frmaddDepartment.txtslqtyg1.value;
		var q2=document.frmaddDepartment.txtslqtyg2.value;
		var q3=document.frmaddDepartment.txtslqtyg3.value;
		var q4=document.frmaddDepartment.txtslqtyd1.value;
		var q5=document.frmaddDepartment.txtslqtyd2.value;
		var g=document.frmaddDepartment.txtqtyg.value;
		var d=document.frmaddDepartment.txtqtyd.value;
		
		if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;
		if(g=="")g=0;if(d=="")d=0;
		
		var qtyg=parseFloat(q1)+parseFloat(q2)+parseFloat(q3);
		var qtyd=parseInt(q4)+parseInt(q5);
		var f=0;
		
		if(parseFloat(g)!=parseFloat(qtyg))
		{
		alert("Please check. Quantity in Good Item received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		if(parseFloat(d)!=parseFloat(qtyd))
		{
		alert("Please check. Quantity in Damage Item received is not matching with Quantity distributed in Bins");
		return false;
		f=1;
		}
		if(g==0 && d==0)
		{
		alert("Please check. Quantity Received Good and Quantity Received Damage Both cannot be Zero or Blank");
		return false;
		f=1;
		}
		
		if(f==1)
		{
		return false;
		}
		else
		{	//alert("hi");
			var a=formPost(document.getElementById('mainform'));
			//alert(a);
			showUser(a,'postingtable','mformsubedt','','','','','');
		}
	}
}
//edtrecid,'postingsubtable','subformedt

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
		if(document.frmaddDepartment.txtitem.value == "")
		{
			alert("Please select Item");
			document.frmaddDepartment.txtupsg.value="";
		}
}

function upschk1(upsval1)
{
	if(document.frmaddDepartment.txtitem.value == "")
		{
			alert("Please select Item");
			document.frmaddDepartment.txtupsd.value="";
		}
}


function qtychk(qtyval)
{
	if(document.frmaddDepartment.txtupsg.value=="")
	{
		alert("Please enter UPS Good");
		document.frmaddDepartment.txtqtyg.value="";
	}
}


function qtychk1(qtyval1)
{
	if(document.frmaddDepartment.txtupsd.value=="")
	{
		alert("Please enter UPS Damage");
		document.frmaddDepartment.txtqtyd.value="";
	}
}
	
function showslocbins()
{
			//var opttyp="good";
			//document.frmaddDepartment.rettyp.value=opttyp;
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			showUser(clasid,'subsubdivgood','slocshowsubgood',itmid,clasid,itmid,'','');
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
		setTimeout('showslocbins()',200);
	}
	else
	{
		alert("Please Select Classification")
		//document.frmaddDepartment.txtitem.
		document.getElementById('itm').selectedIndex=0;
		document.frmaddDepartment.txtclass.focus();
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



function wh1(wh1val)
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

function wh4(wh4val)
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
	if(document.frmaddDepartment.txtqtyd.value > 0)
	{
		showUser(wh5val,'bind2','wh','bind2','','','','');
	}
	else
	{
		alert("Please enter Quantity Damage");
		document.frmaddDepartment.txtslwhd2.selectedIndex=0;
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
		var slocnogood="";//document.frmaddDepartment.tblslocnog.value;
		var trid=document.frmaddDepartment.maintrid.value;
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
		var trid=document.frmaddDepartment.maintrid.value;
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
		var trid=document.frmaddDepartment.maintrid.value;
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
		/*if(document.frmaddDepartment.tblslocnog.value!="")
		{
			if(document.frmaddDepartment.tblslocnog.value==1)
			{*/
				var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
				if(w1==w4)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb4').selectedIndex=0;
				document.frmaddDepartment.txtslbind1.focus();
				}
			/*}
			else if(document.frmaddDepartment.tblslocnog.value==2)
			{*/
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
			var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
				if(w1==w4 || w2==w4)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb4').selectedIndex=0;
				document.frmaddDepartment.txtslbind1.focus();
				}
			/*}
			else if(document.frmaddDepartment.tblslocnog.value==2)
			{*/
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
			var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
			var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
				if(w1==w4 || w2==w4 || w3==w4)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb4').selectedIndex=0;
				document.frmaddDepartment.txtslbind1.focus();
				}
			//}
		//}
				
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var slocnodamage="";//document.frmaddDepartment.tblslocnod.value;
		var trid=document.frmaddDepartment.maintrid.value;
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
		
		/*if(document.frmaddDepartment.tblslocnog.value!="")
		{
			if(document.frmaddDepartment.tblslocnog.value==1)
			{*/
				var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
				if(w1==w5)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb5').selectedIndex=0;
				document.frmaddDepartment.txtslbind2.focus();
				}
			/*}
			else if(document.frmaddDepartment.tblslocnog.value==2)
			{*/
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
			var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
				if(w1==w5 || w2==w5)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb5').selectedIndex=0;
				document.frmaddDepartment.txtslbind2.focus();
				}
			/*}
			else if(document.frmaddDepartment.tblslocnog.value==2)
			{*/
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
			var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
			var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
				if(w1==w5 || w2==w5 || w3==w5)
				{
				alert("Please check, No two Bin information can be similar in a given transaction");
				document.getElementById('sb5').selectedIndex=0;
				document.frmaddDepartment.txtslbind2.focus();
				}
			//}
		//}
		
		if(w4==w5)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.getElementById('sb5').selectedIndex=0;
		document.frmaddDepartment.txtslbind2.focus();
		}
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		var slocnodamage="";//document.frmaddDepartment.tblslocnod.value;
		var trid=document.frmaddDepartment.maintrid.value;
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
}

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
		if(document.frmaddDepartment.exuspd1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exuspd1.value);
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
		if(document.frmaddDepartment.exuspd2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exuspd2.value);
		document.frmaddDepartment.balupsd2.value=parseInt(document.frmaddDepartment.txtslupsd2.value)+parseInt(exu);
	}
	else
	{
	document.frmaddDepartment.balupsd2.value="";
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
}

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

function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}

function deleterec(v1,v2,v3)
{
if(confirm('Do u wish to delete this item?')==true)
{
showUser(v1,'postingtable','delete',v2,v3,'','','');
}
else
{
return false;
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
	if(document.frmaddDepartment.date.value=="00-00-0000" || document.frmaddDepartment.date.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtparty.value=="")
	{
		alert("Please select Party Name");
		return false;
	}
	else if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please select Return from Stage");
		//document.frmaddDepartment.txtstage.focus();
		return false;
	}
	
	else if(document.frmaddDepartment.txtrd.value=="" && document.frmaddDepartment.txtrbd.value=="")
	{
		alert("Please select Return by ID or Specify the Name");
		//document.frmaddDepartment.txtstage.focus();
		return false;
	}
	else if(parseInt(document.frmaddDepartment.maintrid.value)==0 || parseInt(document.frmaddDepartment.maintrid.value)=="0")
	{
		alert("You have not Posted data. Please post & then click Preview");
		return false;
	}
	else
	{
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction Arrival - Internal Return-Own (Good & Damage)
</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);
	*/
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="code" value="<?php echo $code;?>" type="hidden"> 
	<!-- <input name="twh1" value="0" type="hidden"> 
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
	 <input name="tqty3" value="0" type="hidden"> -->
<?php
$tid=0; $subtid=0;
?>	 
	 <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Internal Material Return - Own (Good & Damage)
</td>
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
$quer1=mysql_query("SELECT p_id, business_name FROM tbl_partymaser where classification='Internal Return' order by business_name")or die(mysql_error()); 
?>

      <td width="152" height="24"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtparty" style="width:230px;" onchange="showUser(this.value,'vaddress','vendor','','','','','');"  >
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
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Party&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;</td>
</tr>
<tr class="Light" height="30">
<?php
$quer1=mysql_query("SELECT id ,login FROM tbl_roles ")or die(mysql_error()); 
?>

      <td width="152" height="24"  align="right"  valign="middle" class="tblheading">Return By ID&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext" id="retby" colspan="3" >&nbsp;<select class="tbltext" name="txtrd" style="width:100px;" onchange="rtnbychk(this.value)"  >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysql_fetch_array($quer1)) { ?>
		<option value="<?php echo $noticia['login'];?>" />   
		<?php echo $noticia['login'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="tblheading">OR Specify</font>&nbsp;&nbsp;<input name="txtrbd" id="rbd" type="text" size="15" class="tbltext" tabindex="" maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

</table>
<div id="postingtable" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="1%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">UoM</td>
                <td colspan="4"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="4" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
             
              <td width="3%" rowspan="3" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			<tr class="tblsubtitle">
			  <td colspan="2" align="center" valign="middle" class="tblheading">Good</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
			  </tr>
			<tr class="tblsubtitle">
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
                   
					<td width="2%" align="center" valign="middle" class="tblheading">G/D</td>
					<td width="6%" align="center" valign="middle" class="tblheading">Bin</td>
                    <td width="3%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
			  
          </table>
		  <br />
		  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="226"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
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
		
<td width="127" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="126" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
<input type="hidden" name="itmdchk" value="" />
 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS Good&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsg" type="text" size="10" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="upschk(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Quantity Good&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyg" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtychk(this.value);">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">UPS Damage&nbsp;</td>
<td width="361" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtupsd" type="text" size="10" class="tbltext" tabindex=""   maxlength="6" onkeypress="return isNumberKey(event)" onchange="upschk1(this.value);"/>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Quantity Damage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="text" size="10" class="tbltext" tabindex=""  maxlength="7" onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value);"  />&nbsp;</td>
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
<br />

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC Damage</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="86" align="center" valign="middle" class="tblheading">Bin</td>
<td width="100" align="center" valign="middle" class="tblheading">Subbin</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">UPS</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>

</table>
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
</div>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_return_stores_st.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;">&nbsp;&nbsp;</td>
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
