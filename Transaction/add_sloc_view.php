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
		/*$sql_arr=mysql_query("select * from tbl_sloc where slid='".$pid."'") or die(mysql_error());
		$row_arr=mysql_fetch_array($sql_arr);
		$classid=$row_arr['classification_id'];
		$itemid=$row_arr['items_id'];
		$trdate=$row_arr['issuedate'];
		$balanceups=0;$balanceqty=0;
		$sql_issue=mysql_query("select distinct stlg_subbinid, stlg_binid, stlg_whid  from tbl_stldg_good where stlg_trclassid='".$classid."' and stlg_tritemid='".$itemid."'") or die(mysql_error());
		while ($row_issue=mysql_fetch_array($sql_issue))
		{
		
		$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' ") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 
		//echo $row_issue1[0];echo "<BR>";
		//echo $t=mysql_num_rows($sql_issue1); echo "<BR>";
	$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'and stlg_balqty>0") or die(mysql_error()); 
	$row_issuetbl=mysql_fetch_array($sql_issuetbl);
				$whid=$row_issuetbl['stlg_whid'];
				$binid=$row_issuetbl['stlg_binid'];
				$subbinid=$row_issuetbl['stlg_subbinid'];
				$opups=$row_issuetbl['stlg_balups'];
				$opqty=$row_issuetbl['stlg_balqty'];
				$balups=0;
				$balqty=0;
				$balanceups=$balanceups+$opups;
				$balanceqty=$balanceqty+$opqty;		
				$sql_sub_sub="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('$yearid_id','SLOC', 'SUO', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$opups', '$opqty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
		}
		$balups=$balanceups;
		$balqty=$balanceqty;
		
		$sql_sloc_sub=mysql_query("select * from tbl_sloc_sub where slocid='".$pid."'") or die(mysql_error());
		while($row_sloc_sub($sql_sloc_sub))
		{
				$whid=$row_sloc_sub['whid'];
				$binid=$row_sloc_sub['binid'];
				$subbinid=$row_sloc_sub['subbinid'];
				$ups=$row_sloc_sub['ups'];
				$qty=$row_sloc_sub['qty'];
				
				$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$subbinid."' and stlg_binid='".$binid."' and stlg_whid='".$whid."' ") or die(mysql_error());
		$row_issue1=mysql_fetch_array($sql_issue1); 

	$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'and stlg_balqty>0") or die(mysql_error()); 
	$row_issuetbl=mysql_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['stlg_balups'];
				$opqty=$row_issuetbl['stlg_balqty'];
				$opups=$balups+$opups;
				$opqty=$balqty+$opqty;
				$balups=$opups-$ups;
				$balqty=$opqty-$qty;
				
				$sql_sub_sub="insert into tbl_stldg_good (yearcode,stlg_trtype, stlg_trsubtype, stlg_trid, stlg_trdate, stlg_trclassid, stlg_tritemid, stlg_whid, stlg_binid, stlg_subbinid, stlg_opups, stlg_opqty, stlg_trups, stlg_trqty, stlg_balups, stlg_balqty) values('yearid_id','SLOC', 'SUC', '$pid', '$trdate', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty')";
				mysql_query($sql_sub_sub) or die(mysql_error());
		}
 	
			echo "<script>window.location='add_arrival.php'</script>";	*/
}
		

	
	/*$a="c";
	$sql_code="SELECT MAX(code) FROM tbl_sloc where  yearcode='$yearid_id' ORDER BY code DESC";
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
<title>Stores -Transaction -Sloc Preview</title>
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
	 popUpCalendar(document.frmaddDept.date,dt,document.frmaddDept.date, "dd-mmm-yyyy", xind, yind);
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
alert(val);
document.frmaddDept.txt14.value=val;
}

function mySubmit()
{ 
	
	var a=formPost(document.getElementById('mainform'));
	alert(a);
	document.frmaddDept.abc.value=a;
	return false;
	if(document.frmaddDept.txtdrno.value=="")
	{
	alert("Please enter Discard Instruction Ref. No.");
	document.frmaddDept.txtdrno.focus();
	return false;
	}
	
	if(document.frmaddDept.txtdrno.value.charCodeAt() == 32)
	{
	alert("Discard Instruction Ref. No cannot start with space.");
	document.frmaddDept.txtdrno.focus();
	return false;
	}
		

	if(document.frmaddDept.txt11.value!="")
	{
	if(document.frmaddDept.txt11.value=="Yes")
	{
	if(document.frmaddDept.txttname.value=="")
	{
	alert("Please enter Transport Name");
	document.frmaddDept.txttname.focus();
	return false;
	}
	
	if(document.frmaddDept.txttname.value.charCodeAt() == 32)
	{
	alert("Transport Name cannot start with space.");
	document.frmaddDept.txttname.focus();
	return false;
	}
				
	if(document.frmaddDept.txtlrn.value=="")
	{
	alert("Please enter Lorry Receipt No");
	document.frmaddDept.txtlrn.focus();
	return false;
	}
	
	if(document.frmaddDept.txtlrn.value.charCodeAt() == 32)
	{
	alert("Lorry Receipt No cannot start with space.");
	document.frmaddDept.txtlrn.focus();
	return false;
	}
	if(document.frmaddDept.txtvn.value=="")
	{
	alert("Please enter Vehicle No");
	document.frmaddDept.txtvn.focus();
	return false;
	}
	
	if(document.frmaddDept.txtvn.value.charCodeAt() == 32)
	{
	alert("Vehicle No cannot start with space.");
	document.frmaddDept.txtvn.focus();
	return false;
	}
	if(document.frmaddDept.txt14.value=="")
	{
	alert("Please select Payment Mode");
	return false;
	}
	}
	else
	{
	if(document.frmaddDept.txtcname.value=="")
	{
	alert("Please enter Courier Name");
	document.frmaddDept.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDept.txtcname.value.charCodeAt() == 32)
	{
	alert("Courier Name cannot start with space.");
	document.frmaddDept.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDept.txtdc.value=="")
	{
	alert("Please enter Docket No.");
	document.frmaddDept.txtdc.focus();
	return false;
	}
	
	if(document.frmaddDept.txtdc.value.charCodeAt() == 32)
	{
	alert("Docket No. cannot start with space.");
	document.frmaddDept.txtdc.focus();
	return false;
	}
	}
	}
	else
	{
	alert("Please select Mode of Transit");
	return false;
	}
	
	return false;	 
}

function modetchk(classval) 
{
//if(document.frmaddDept.txt1.value!="")
showUser(classval,'item','captive','','','','','');
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
	setTimeout('chktyp()',200);
}
else
{
alert("Please Select Classification first")
//document.frmaddDept.txtitem.
document.frmaddDept.txtclass.focus();
}
}

function chktyp()
{ 
	if(document.frmaddDept.txtitem.value!="")
	{
			var opttyp="good";
			var clasid=document.frmaddDept.txtclass.value;
			var itmid=document.frmaddDept.txtitem.value;
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,opttyp,'');
			
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
function bingood(gval)
{	
		//alert(gval);
		
		if(gval==1 || gval=="1")
		{
			document.getElementById('gsloc1').style.display="block";
			document.getElementById('gsloc2').style.display="none";
			document.getElementById('gsloc3').style.display="none";
			document.getElementById('ups1').value=document.frmaddDept.txtupsg.value;
			document.getElementById('qty1').value=document.frmaddDept.txtqtyg.value;
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

function wh1(wh1val)
{ //alert(wh1val);
	if(document.frmaddDept.tblslocnog.value!="")
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
	if(document.frmaddDept.txtslwhg1.value!="")
	{
		if(document.frmaddDept.txtslqtyg1.value!="")
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
	if(document.frmaddDept.txtslwhg2.value!="")
	{
		if(document.frmaddDept.txtslqtyg2.value!="")
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
	if(document.frmaddDept.txtslwhg1.value!="")
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
	if(document.frmaddDept.txtslwhg2.value!="")
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
	if(document.frmaddDept.txtslwhg3.value!="")
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
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood=document.frmaddDept.tblslocnog.value;
		//var slocnodamage=document.frmaddDept.tblslocnod.value;
		if(document.frmaddDept.txtslupsg1.value!="")
		var upsv1=document.frmaddDept.txtslupsg1.value;
		else
		var upsv1="";
		if(document.frmaddDept.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDept.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1);
	}
	else
	{
		alert("Please select Bin in first Row in Good section");
		document.frmaddDept.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbing2.value!="")
	{	
		var slocnogood=document.frmaddDept.tblslocnog.value;
		//var slocnodamage=document.frmaddDept.tblslocnod.value;
		if(document.frmaddDept.txtslupsg2.value!="")
		var upsv2=document.frmaddDept.txtslupsg2.value;
		else
		var upsv2="";
		if(document.frmaddDept.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDept.txtslqtyg2.value;
		else
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,upsv2,qtyv2);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin in second Row in Good section");
		document.frmaddDept.txtslbing2.focus();
	}
}

function subbin3(subbin3val)
{
	var itemv=document.frmaddDept.txtitem.value;
	if(document.frmaddDept.txtslbing3.value!="")
	{	
		var slocnogood=document.frmaddDept.tblslocnog.value;
		//var slocnodamage=document.frmaddDept.tblslocnod.value;
		if(document.frmaddDept.txtslupsg3.value!="")
		var upsv3=document.frmaddDept.txtslupsg3.value;
		else
		var upsv3="";
		if(document.frmaddDept.txtslqtyg3.value!="")
		var qtyv3=document.frmaddDept.txtslqtyg3.value;
		else
		var qtyv3="";
		showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,upsv3,qtyv3);
		//showUser(subbin3val,'slocrow3','subbin',itemv,'txtslsubbg3','','','');
	}
	else
	{
		alert("Please select Bin in third Row in Good section");
		document.frmaddDept.txtslbing3.focus();
	}
}


function upsf1(ups1val)
{
	if(document.frmaddDept.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin in first Row in Good section");
		document.frmaddDept.txtslupsg1.value="";
		document.frmaddDept.txtslsubbg1.focus();
	}
	if(document.frmaddDept.txtslupsg1.value!="")
	{
		if(isNaN(document.frmaddDept.txtslupsg1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDept.txtslupsg1.value="";
			document.frmaddDept.txtslupsg1.focus();
		}
		if(document.frmaddDept.txtslupsg1.value==0 || document.frmaddDept.txtslupsg1.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDept.txtslupsg1.value="";
			document.frmaddDept.txtslupsg1.focus();
		}
		if(document.frmaddDept.tblslocnog.value==2 || document.frmaddDept.tblslocnog.value=="2")
		{
			document.getElementById('ups2').value=parseInt(document.frmaddDept.txtupsg.value)-parseInt(ups1val);
		}
		
	}
}

function upsf2(ups2val)
{
	if(document.frmaddDept.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin in second Row in Good section");
		document.frmaddDept.txtslupsg2.value="";
		document.frmaddDept.txtslsubbg2.focus();
	}
	if(document.frmaddDept.txtslupsg2.value!="")
	{
		if(isNaN(document.frmaddDept.txtslupsg2.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDept.txtslupsg2.value="";
			document.frmaddDept.txtslupsg2.focus();
		}
		if(document.frmaddDept.txtslupsg2.value==0 || document.frmaddDept.txtslupsg2.value=="0")
		{
			alert("UPS can not be ZERO");
			document.frmaddDept.txtslupsg2.value="";
			document.frmaddDept.txtslupsg2.focus();
		}
		if(document.frmaddDept.tblslocnog.value==3 || document.frmaddDept.tblslocnog.value=="3")
		{
			document.getElementById('ups3').value=parseInt(document.frmaddDept.txtupsg.value)-parseInt(document.getElementById('ups1').value)-parseInt(ups2val);
		}
		
	}
}

function upsf3(ups3val)
{
	if(document.frmaddDept.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin in Third Row in Good section");
		document.frmaddDept.txtslupsg3.value="";
		document.frmaddDept.txtslsubbg3.focus();
	}
}


function qtyf1(qty1val)
{
	if(document.frmaddDept.txtslupsg1.value=="")
	{
		alert("Please enter UPS in first Row in Good section");
		document.frmaddDept.txtslqtyg1.value="";
		document.frmaddDept.txtslupsg1.focus();
	}
	if(document.frmaddDept.txtslqtyg1.value!="")
	{
		if(isNaN(document.frmaddDept.txtslqtyg1.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDept.txtslqtyg1.value="";
			document.frmaddDept.txtslqtyg1.focus();
		}
		if(document.frmaddDept.txtslqtyg1.value==0 || document.frmaddDept.txtslqtyg1.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDept.txtslqtyg1.value="";
			document.frmaddDept.txtslqtyg1.focus();
		}
		if(document.frmaddDept.tblslocnog.value==2 || document.frmaddDept.tblslocnog.value=="2")
		{
			document.getElementById('qty2').value=parseFloat(document.frmaddDept.txtqtyg.value)-parseFloat(qty1val);
		}
	}
}

function qtyf2(qty2val)
{
	if(document.frmaddDept.txtslupsg2.value=="")
	{
		alert("Please enter UPS in second Row in Good section");
		document.frmaddDept.txtslqtyg2.value="";
		document.frmaddDept.txtslupsg2.focus();
	}
	if(document.frmaddDept.txtslqtyg2.value!="")
	{
		if(isNaN(document.frmaddDept.txtslqtyg2.value))
		{
			alert("Only numbers are allowed");
			document.frmaddDept.txtslqtyg2.value="";
			document.frmaddDept.txtslqtyg2.focus();
		}
		if(document.frmaddDept.txtslqtyg2.value==0 || document.frmaddDept.txtslqtyg2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDept.txtslqtyg2.value="";
			document.frmaddDept.txtslqtyg2.focus();
		}
		if(document.frmaddDept.tblslocnog.value==3 || document.frmaddDept.tblslocnog.value=="3")
		{
			document.getElementById('qty3').value=parseFloat(document.frmaddDept.txtqtyg.value) - parseFloat(document.getElementById('qty1').value) - parseFloat(qty2val);
		}
	}
}

function qtyf3(qty3val)
{
	if(document.frmaddDept.txtslupsg3.value=="")
	{
		alert("Please enter UPS in third Row in Good section");
		document.frmaddDept.txtslqtyg3.value="";
		document.frmaddDept.txtslupsg3.focus();
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
            <div class="toplinks" style="vertical-align:text-top"><ul style="vertical-align:text-top"> <li> <a href="operprofile.php">Profile </a> | </li>
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
          <td width="100%" valign="top"  align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#b9d647"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation - View</td>
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

$c=$row['classification_id'];
$f=$row['items_id'];
$a=$row['itmtype'];
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="pid" value="<?php echo $pid;?>" type="hidden">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation</td>
</tr>

<tr class="Dark" height="25">
           <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Transction ID&nbsp;</td>
           <td width="350" align="left"  valign="middle">&nbsp;<?php echo "SU".$row['code']."/".$yearid_id."/".$lgnid;?></td>
		   
		   <td width="129" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="103" align="left"  valign="middle">&nbsp;<?php echo $tdate;?></td>
		   </tr>
 <?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$c."'") or die(mysql_error());
$noticia_class=mysql_fetch_array($quer3);
?>
		 <tr class="Dark" height="25">
           <td width="158"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3">&nbsp;<?php echo $noticia_class['classification'];?></td>
         </tr>
<?php 
$itemqry1=mysql_query("select * from tbl_stores where items_id='".$f."'") or die(mysql_error());
$row_itm=mysql_fetch_array($itemqry1);
?> 
		<tr class="Light" height="25">
           <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Stores Item&nbsp;</td>
           <td align="left"  valign="middle"  id="item">&nbsp;<?php echo $row_itm['stores_item'];?></td>
                <td width="129" height="24"  align="right"  valign="middle" class="tblheading">UoM&nbsp;</td>
           <td align="left"  valign="middle"  id="uom">&nbsp;<?php echo $row_itm['uom'];?></td>
         </tr>
		  <tr class="Dark" height="25">
		  <td width="158" height="24"  align="right"  valign="middle" class="tblheading">Type&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<?php if($row['itmtype'] == "good")  { echo "Good";} else{ echo "Damage";}?></td>
	      </tr>
</table>
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Original Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">UPS</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php

if($a=="good")
{
$sql_tbl=mysql_query("select * from tbl_stldg_good where stlg_trtype='SLOC' and stlg_trsubtype='SUO' and stlg_trid='".$pid."'") or die(mysql_error());

$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl))
{ 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stlg_subbinid']."' and binid='".$row_tbl_sub['stlg_binid']."' and whid='".$row_tbl_sub['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_tbl_sub['stlg_opups'];
$totqty=$totqty+$row_tbl_sub['stlg_opqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_opups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_opqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_opups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stlg_opqty'];?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 }
 else
 {
 

$sql_tbl=mysql_query("select * from tbl_stldg_damage where stld_trtype='SLOC' and stld_trsubtype='SUO' and stld_trid='".$pid."'") or die(mysql_error());

$srno=1;
$total_tbl=mysql_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl))
{ 
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tbl_sub['stld_subbinid']."' and binid='".$row_tbl_sub['stld_binid']."' and whid='".$row_tbl_sub['stld_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];
$totups=$totups+$row_tbl_sub['stld_opups'];
$totqty=$totqty+$row_tbl_sub['stld_opqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_opups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_opqty'];?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_opups'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stld_opqty'];?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
 <input type="hidden" name="txtupsg" value="<?php echo $totups;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>
</div>
<br />

<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
<td align="center" valign="middle" class="tblheading" colspan="6">Changed Locations</td>
</tr>
<tr class="tblsubtitle" height="25">
<td width="87" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="center" valign="middle" class="tblheading">WH</td>
<td width="117" align="center" valign="middle" class="tblheading">Bin</td>
<td width="131" align="center" valign="middle" class="tblheading">Sub Bin</td>
<td width="122" align="center" valign="middle" class="tblheading">UPS</td>
<td width="140" align="center" valign="middle" class="tblheading">Quantity</td>
</tr>
<?php
$sr=1;
$totups=0; $totqty=0;
$sql_sloc_sub=mysql_query("select * from tbl_sloc_sub where slocid='".$pid."' order by slocsubid") or die (mysql_error());

while($row_sloc_sub=mysql_fetch_array($sql_sloc_sub))
{

$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_sloc_sub['subbinid']."' and binid='".$row_sloc_sub['binid']."' and whid='".$row_sloc_sub['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totups=$totups+$row_sloc_sub['ups'];
$totqty=$totqty+$row_sloc_sub['qty'];


if($sr%2!=0)
{
?>
<tr class="Light" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['ups'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
<td width="87" align="center" valign="middle" class="tblheading"><?php echo $sr;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?></td>
<td width="122" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['ups'];?></td>
<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_sloc_sub['qty'];?></td>
</tr>
<?php
}
$sr++;
}
?>
<tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="4">Total&nbsp;</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 </tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><a href="add_arrival.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;</td>
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
