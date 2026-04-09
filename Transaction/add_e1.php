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
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
	
		$code=trim($_POST['code']);
		$date=trim($_POST['date']);
		$classification=trim($_POST['txtclass']);
		$item=trim($_POST['txtitem']);
		$uom=trim($_POST['txtuom']);
		
		
		$chkbox=trim($_POST['chkbox']);
		$srno1=trim($_POST['srno1']);
		$txtremarks=trim($_POST['txtremarks']);
		$rettyp=trim($_POST['rettyp']);
		 $txtremarks=str_replace("&","and",$txtremarks);
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		$p1_array=explode(",",$chkbox);	
		$p1_array1=explode(",",$srno1);	
		$numrec=count($p1_array1);
		
		

 $sql_in1="insert into tbl_excess(yearcode, code, tdate, classification_id, items_id, uom, remarks, typ) values ('$yearid_id', '$code', '$tdate', '$classification', '$item', '$uom', '$txtremarks', '$rettyp')";

if(mysql_query($sql_in1) or die(mysql_error()))
{
 $mainid=mysql_insert_id();
 $totups=0; $totqty=0;
for($num=0; $num<$numrec; $num++)
{
	$p1_array[$num];
	$p1_array1[$num];
if($rettyp == "good")
{
$sql_itmldg=mysql_query("select stlg_balups, stlg_balqty, stlg_id, stlg_whid, stlg_binid, stlg_subbinid from tbl_stldg_good where stlg_id='".$p1_array[$num]."'") or die(mysql_error());

$row_itmldg=mysql_fetch_array($sql_itmldg);
$balu=$row_itmldg['stlg_balups'];
$balq=$row_itmldg['stlg_balqty'];
$whid=$row_itmldg['stlg_whid'];
$binid=$row_itmldg['stlg_binid'];
$subbinid=$row_itmldg['stlg_subbinid'];
}
else
{
$sql_itmldg=mysql_query("select stld_balups, stld_balqty, stld_id, stld_whid, stld_binid, stld_subbinid from tbl_stldg_damage where stld_id='".$p1_array[$num]."'") or die(mysql_error());
$row_itmldg=mysql_fetch_array($sql_itmldg);
$balu=$row_itmldg['stld_balups'];
$balq=$row_itmldg['stld_balqty'];
$whid=$row_itmldg['stld_whid'];
$binid=$row_itmldg['stld_binid'];
$subbinid=$row_itmldg['stld_subbinid'];
}

$upse="issueups_".$p1_array1[$num];
$qtye="issueqty_".$p1_array1[$num];
$upss="issueups1_".$p1_array1[$num];
$qtys="issueqty1_".$p1_array1[$num];
$balups="balups_".$p1_array1[$num];
$balqty="balqty_".$p1_array1[$num]; 

$upse1 = trim($_POST[$upse]);
$qtye1 = trim($_POST[$qtye]);
$upss1 = trim( $_POST[$upss]);	 
$qtys1 = trim($_POST[$qtys]);	 
$balups1 = trim($_POST[$balups]);	 
$balqty1 = trim($_POST[$balqty]);	 
	
if($upse > 0 && $upss1 == "")
$ups=$upse1;
else
$ups=$upss1;
if($qtye1 > 0 && $qtys1 == "")
$qty=$qtye1;
else
$qty=$qtys1;

$totups=$totups+$ups;
$totqty=$totqty+$qty;

$rowid=$p1_array[$num];

$sql_sub_sub="insert into tbl_excess_sub (esid, whid, binid, subbinid, qtyex, upsex, qtysh, upssh, balqty, balups, rowid) values('$mainid','$whid','$binid','$subbinid','$qtye1','$upse1','$qtys1','$upss1','$balqty1','$balups1', '$rowid')";

mysql_query($sql_sub_sub) or die(mysql_error());
}
$sql_sub_update="update tbl_excess set ups='$totups', qty='$totqty' where tid='$mainid'";
mysql_query($sql_sub_update) or die(mysql_error());
}
						 
			echo "<script>window.location='add_exsh_preview.php?p_id=$mainid'</script>";	
}


$sql_code="SELECT MAX(code) FROM tbl_excess where yearcode='$yearid_id' ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="TES".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TES".$code."/".$yearid_id."/".$lgnid;
		}	
		

	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores - Transction- Add Excess Shortage</title>
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

<script src="exsh.js"></script>
<script type="text/javascript">
function modetchk(classval) 
{
//if(document.frmaddDept.txt1.value!="")
showUser(classval,'vitem','item','','','','','');
//else
//	alert("Please select Mode of Transit first");
}
/*else
	{
		alert("Please Select Classification first")
		//document.frmaddDept.txtups.value="";
		//document.frmaddDept.txtqty.value=="";
		document.frmaddDept.txtclass.focus();
	}
*/
function classchk(itval)
{
if(document.frmaddDept.txtclass.value!="")
{
	showUser(itval,'uom','itemuom','','','','','');
	//setTimeout('chktyp()',200);
}
else
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDept.txtclass.focus();
}
}

function chktyp(opttyp)
{ 
	if(document.frmaddDept.txtitem.value!="")
	{
			//var opttyp="good";
			document.frmaddDept.rettyp.value=opttyp;
			var clasid=document.frmaddDept.txtclass.value;
			var itmid=document.frmaddDept.txtitem.value;
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,opttyp,'');
			
	}
	else
	{
		alert("please select Item first");
		
	}
}
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
	  
function checkchk(chkval)
{
		var x="issueups_"+chkval;
		var y="issueqty_"+chkval;
		var x1="issueups1_"+chkval;
		var y1="issueqty1_"+chkval;
		var z="balups_"+chkval;
		var z1="balqty_"+chkval;
		//alert(chkval);
		if(document.getElementById(chkval).checked==true)
		{
			document.getElementById(x).readOnly=false;
			document.getElementById(y).readOnly=false;
			document.getElementById(x1).readOnly=false;
			document.getElementById(y1).readOnly=false;
			document.getElementById(z).readOnly=false;
			document.getElementById(x).style.backgroundColor="#FFFFFF";
			document.getElementById(y).style.backgroundColor="#FFFFFF";
			document.getElementById(x1).style.backgroundColor="#FFFFFF";
			document.getElementById(y1).style.backgroundColor="#FFFFFF";
			document.getElementById(z).style.backgroundColor="#FFFFFF";
		}
		else
		{
			document.getElementById(x).value="";
			document.getElementById(y).value="";
			document.getElementById(x1).value="";
			document.getElementById(y1).value="";
			document.getElementById(z).value="";
			document.getElementById(z1).value="";
			document.getElementById(x).readOnly=true;
			document.getElementById(y).readOnly=true;
			document.getElementById(x1).readOnly=true;
			document.getElementById(y1).readOnly=true;
			document.getElementById(z).readOnly=true;
			document.getElementById(x).style.backgroundColor="#CCCCCC";
			document.getElementById(y).style.backgroundColor="#CCCCCC";
			document.getElementById(x1).style.backgroundColor="#CCCCCC";
			document.getElementById(y1).style.backgroundColor="#CCCCCC";
			document.getElementById(z).style.backgroundColor="#CCCCCC";
		}
}
function upschk(fid,fval)
{
if(fid >0 || fid != "")
{
var u="issueups1_"+fval;
var q="issueqty1_"+fval;
			document.getElementById(u).value="";
			document.getElementById(q).value="";
			document.getElementById(u).readOnly=true;
			document.getElementById(q).readOnly=true;
			document.getElementById(u).style.backgroundColor="#CCCCCC";
			document.getElementById(q).style.backgroundColor="#CCCCCC";
var a="upsavl_"+fval;
var b="balups_"+fval;
document.getElementById(b).value=parseInt(document.getElementById(a).value)+parseInt(fid);
}
else
{
var u="issueups1_"+fval;
var q="issueqty1_"+fval;
			document.getElementById(u).value="";
			document.getElementById(q).value="";
			document.getElementById(u).readOnly=false;
			document.getElementById(q).readOnly=false;
			document.getElementById(u).style.backgroundColor="#FFFFFF";
			document.getElementById(q).style.backgroundColor="#FFFFFF";
var a="issueups_"+fval;
var b="issueqty_"+fval;
			document.getElementById(a).value="";
			document.getElementById(b).value=""
			document.getElementById(a).readOnly=true;
			document.getElementById(b).readOnly=true;
			document.getElementById(a).style.backgroundColor="#CCCCCC";
			document.getElementById(b).style.backgroundColor="#CCCCCC";
document.getElementById(b).value="";
}
}

function qtychk(qid,qval)
{
var c="qtyavl_"+qval;
var d="balqty_"+qval;
document.getElementById(d).value=parseFloat(document.getElementById(c).value)+parseFloat(qid);
}	  
function upschk1(fid1,fval1)
{
if(fid1 >0 || fid1 != "")
{
var u="issueups_"+fval1;
var q="issueqty_"+fval1;
			document.getElementById(u).value="";
			document.getElementById(q).value="";
			document.getElementById(u).readOnly=true;
			document.getElementById(q).readOnly=true;
			document.getElementById(u).style.backgroundColor="#CCCCCC";
			document.getElementById(q).style.backgroundColor="#CCCCCC";

var a1="upsavl_"+fval1;
var b1="balups_"+fval1;
document.getElementById(b1).value=parseInt(document.getElementById(a1).value)-parseInt(fid1);
}
else
{
var u="issueups_"+fval1;
var q="issueqty_"+fval1;
			document.getElementById(u).value="";
			document.getElementById(q).value="";
			document.getElementById(u).readOnly=false;
			document.getElementById(q).readOnly=false;
			document.getElementById(u).style.backgroundColor="#FFFFFF";
			document.getElementById(q).style.backgroundColor="#FFFFFF";
var a="issueups1_"+fval1;
var b="issueqty1_"+fval1;
			document.getElementById(a).value="";
			document.getElementById(b).value=""
			document.getElementById(a).readOnly=true;
			document.getElementById(b).readOnly=true;
			document.getElementById(a).style.backgroundColor="#CCCCCC";
			document.getElementById(b).style.backgroundColor="#CCCCCC";
document.getElementById(b).value="";
}
}

function qtychk1(qid1,qval1)
{
var c1="qtyavl_"+qval1;
var d1="balqty_"+qval1;
document.getElementById(d1).value=parseFloat(document.getElementById(c1).value)-parseFloat(qid1);
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

	/*function pform()
{
	document.frmaddDept.chkbox.value="";
	document.frmaddDept.srno1.value="";
	if(document.frmaddDept.srno.value > 0)
	{
		if(document.frmaddDept.srno.value <= 2)
		{
			if(document.frmaddDept.slocissue.checked == true)
			{  
				if(document.frmaddDept.chkbox.value =="")
				{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue.value;
				}
				else
				{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue.value;
				}
				if(document.frmaddDept.srno1.value =="")
				{
					document.frmaddDept.srno1.value=parseInt(document.frmaddDept.srno.value)-1;
				}
				else
				{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+parseInt(document.frmaddDept.srno.value)-1;
				}
			}
		}
		else
		{ var j=1;
			for (var i = 0; i < document.frmaddDept.slocissue.length; i++) 
			{          
				if(document.frmaddDept.slocissue[i].checked == true)
				{
					if(document.frmaddDept.chkbox.value =="")
					{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue[i].value;
					}
					else
					{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue[i].value;
					}
					if(document.frmaddDept.srno1.value =="")
					{
					document.frmaddDept.srno1.value=j;
					}
					else
					{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+j;
					}
				} j++;
			}
		}
/*}
//alert(document.frmaddDept.chkbox.value);
if(document.frmaddDept.srno.value > 0)
{
	if(document.frmaddDept.chkbox.value == "")
	{
	alert("Please select SLOC to Issue");
	return false;
	}
	
	//alert("HIIIIIIIIII");
	if(document.frmaddDept.chkbox.value != "")
	{	//alert(document.frmaddDept.chkbox.value);
		var str=document.frmaddDept.srno1.value;
		var val=str.split(",");
		//alert(val);
		if(val!="")
		for(var i=0; i<val.length; i++)
		{ 
			var z="balups_"+val[i];
			var z1="balqty_"+val[i];
			if(document.getElementById(z1).value == "")
			{
			alert('Please enter UPS & Quantity to Issue in SLOC Row Number: '+val[i]);
			return false;
			}
		}
	}
		var a=formPost(document.getElementById('mainform'));
		alert(a);
		//document.frmaddDept.txtremarks.value=a;
		showUser(a,'maindiv','mformcc','','','','','');
}
}	

function editrec(edtid)
{
alert(edtid);
showUser(edtid,'subsubdiv','etdreccc','','','','','');
}


	function pupdateform()
{
	document.frmaddDept.chkbox.value="";
	document.frmaddDept.srno1.value="";
	if(document.frmaddDept.srno.value > 0)
	{
		if(document.frmaddDept.srno.value <= 2)
		{
			if(document.frmaddDept.slocissue.checked == true)
			{  
				if(document.frmaddDept.chkbox.value =="")
				{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue.value;
				}
				else
				{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue.value;
				}
				if(document.frmaddDept.srno1.value =="")
				{
					document.frmaddDept.srno1.value=parseInt(document.frmaddDept.srno.value)-1;
				}
				else
				{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+parseInt(document.frmaddDept.srno.value)-1;
				}
			}
		}
		else
		{ var j=1;
			for (var i = 0; i < document.frmaddDept.slocissue.length; i++) 
			{          
				if(document.frmaddDept.slocissue[i].checked == true)
				{
					if(document.frmaddDept.chkbox.value =="")
					{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue[i].value;
					}
					else
					{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue[i].value;
					}
					if(document.frmaddDept.srno1.value =="")
					{
					document.frmaddDept.srno1.value=j;
					}
					else
					{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+j;
					}
				} j++;
			}
		}
/*}
//alert(document.frmaddDept.chkbox.value);
if(document.frmaddDept.srno.value > 0)
{
	if(document.frmaddDept.chkbox.value == "")
	{
	alert("Please select SLOC to Issue");
	return false;
	}
	
	//alert("HIIIIIIIIII");
	if(document.frmaddDept.chkbox.value != "")
	{	//alert(document.frmaddDept.chkbox.value);
		var str=document.frmaddDept.srno1.value;
		var val=str.split(",");
		//alert(val);
		if(val!="")
		for(var i=0; i<val.length; i++)
		{ 
			var z="balups_"+val[i];
			var z1="balqty_"+val[i];
			if(document.getElementById(z1).value == "")
			{
			alert('Please enter UPS & Quantity to Issue in SLOC Row Number: '+val[i]);
			return false;
			}
		}
	}
		var a=formPost(document.getElementById('mainform'));
		alert(a);
		//document.frmaddDept.txtremarks.value=a;
		showUser(a,'maindiv','mformccupdate','','','','','');
}
}*/	

function mySubmit()
{
if(document.frmaddDept.date.value=="00-00-0000" || document.frmaddDept.date.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
if(document.frmaddDept.txtclass.value=="")
	{
		alert("Please select Classification");
		document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Item");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	
if(document.frmaddDept.rettyp.value=="")
	{
		alert("Please select Type");
		document.frmaddDept.rettyp.focus();
		return false;
	}
	document.frmaddDept.chkbox.value="";
	document.frmaddDept.srno1.value="";
	
	if(document.frmaddDept.srno.value > 0)
	{
		if(document.frmaddDept.srno.value <= 2)
		{
			if(document.frmaddDept.slocissue.checked == true)
			{  
				if(document.frmaddDept.chkbox.value =="")
				{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue.value;
				}
				else
				{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue.value;
				}
				if(document.frmaddDept.srno1.value =="")
				{
					document.frmaddDept.srno1.value=parseInt(document.frmaddDept.srno.value)-1;
				}
				else
				{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+parseInt(document.frmaddDept.srno.value)-1;
				}
			}
		}
		else
		{ var j=1;
			for (var i = 0; i < document.frmaddDept.slocissue.length; i++) 
			{          
				if(document.frmaddDept.slocissue[i].checked == true)
				{
					if(document.frmaddDept.chkbox.value =="")
					{
					document.frmaddDept.chkbox.value=document.frmaddDept.slocissue[i].value;
					}
					else
					{
					document.frmaddDept.chkbox.value = document.frmaddDept.chkbox.value +','+document.frmaddDept.slocissue[i].value;
					}
					if(document.frmaddDept.srno1.value =="")
					{
					document.frmaddDept.srno1.value=j;
					}
					else
					{
					document.frmaddDept.srno1.value = document.frmaddDept.srno1.value +','+j;
					}
				} j++;
			}
		}
/*}
//alert(document.frmaddDept.chkbox.value);
if(document.frmaddDept.srno.value > 0)
{*/
	if(document.frmaddDept.chkbox.value == "")
	{
	alert("Please select SLOC to Excess/Shortage");
	return false;
	}
	
	//alert("HIIIIIIIIII");
	if(document.frmaddDept.chkbox.value != "")
	{	//alert(document.frmaddDept.chkbox.value);
		var str=document.frmaddDept.srno1.value;
		var val=str.split(",");
		//alert(val);
		if(val!="")
		for(var i=0; i<val.length; i++)
		{ 
			var z="balups_"+val[i];
			var z1="balqty_"+val[i];
			if(document.getElementById(z1).value == "")
			{
			alert('Please enter UPS & Quantity to Excess/Shortage in SLOC Row Number: '+val[i]);
			return false;
			}
		}
	}
}
if(document.frmaddDept.txtremarks.value=="")
	{
		alert("Please enter Remarks first");
		document.frmaddDept.txtremarks.focus();
		return false;
	}

return true;
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Excess/Shortage </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
		<form  id="mainform"name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	 	<input name="frm_action" value="submit" type="hidden"> <br />
	  	<input type="hidden" name="code" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
 		<input name="rettyp" value="" type="hidden"> 
		
   <?php
$tid=0; $subtid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Excess/Shortage </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="25">
 <td width="133" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="401"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1;?></td>

 <td width="75" height="24"  align="right"  valign="middle" class="tblheading">Ex/Sh&nbsp;Date&nbsp;</td>
<td width="131" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>"/>&nbsp; </td>
</tr>

<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
 <tr class="Dark" height="25">
           <td width="133"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font></td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores order by stores_item") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void();" onclick="openslocpop();">SLOC Lookup</a></td>
		
<td width="75" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="131" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex=""  readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>
<tr class="Dark" height="25">
 <td width="133" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
 <td align="left"  valign="middle" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="good" onClick="chktyp(this.value);" />&nbsp;Good&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="damage" onClick="chktyp(this.value);" />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
         </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" valign="middle" class="tblheading">Pre Excess/Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Excess</td>
  <td align="center" colspan="2" valign="middle" class="tblheading">Shortage</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Post Ex/Sh Balance</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="66" align="center" valign="middle" class="tblheading">Select</td>
<td width="112" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="50" align="center" valign="middle" class="tblheading">UPS</td>
<td width="88" align="center" valign="middle" class="tblheading">Qty</td>
<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
<td width="73" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="63" align="center" valign="middle" class="tblheading">Qty</td>
<td width="76" align="center" valign="middle" class="tblheading">UPS</td>
<td width="65" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="68" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="676" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>

</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_shortage.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;">&nbsp;&nbsp;</td>
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
