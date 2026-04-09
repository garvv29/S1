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
	
	
		if(isset($_POST['frm_action'])=='submit')
	{	
		$p_id=trim($_POST['trid']);
		$txtdrno=trim($_POST['txtdrno']);
		$txtparty=trim($_POST['txtparty']);
		$txtaddress=trim($_POST['txtaddress']);
		$adress1=trim($_POST['txtaddress1']);
		$city=trim($_POST['txtcity']);
		$pin=trim($_POST['txtpin']);
		$state=trim($_POST['txtstate']);
		$txtappli=trim($_POST['txtappli']);
		$rettyp=trim($_POST['rettyp']);
		$remarks=trim($_POST['txtremarks']);
		$txt11=trim($_POST['txt11']);
		$txtphone=trim($_POST['txtphone']);
		$txtparty=str_replace("&","and",$txtparty);
		$txtaddress=str_replace("&","and",$txtaddress);
		$adress1=str_replace("&","and",$adress1);
		$city=str_replace("&","and",$city);
		$remarks=str_replace("&","and",$remarks);
		
		if($txt11=="Transport")
		{
		$txttname=trim($_POST['txttname']);
		$txtlrn=trim($_POST['txtlrn']);
		$txtvn=trim($_POST['txtvn']);
		$txt14=trim($_POST['txt14']);
		}
		else
		{
		$txttname="";
		$txtlrn="";
		$txtvn="";
		$txt14="";
		}
		
		if($txt11=="Courier")
		{
		$txtcname=trim($_POST['txtcname']);
		$txtdc=trim($_POST['txtdc']);
		}
		else
		{
		$txtcname="";
		$txtdc="";
		}
		if($txt11=="By Hand")
		{ 
		$txtpname=trim($_POST['txtpname']);
		}
		else
		{
		$txtpname="";
		}
		
		echo "<script>window.location='add_discard_str_preview.php?p_id=$p_id&txtdrno=$txtdrno&txtparty=$txtparty&txtaddress=$txtaddress&address1=$adress1&city=$city&pin=$pin&state=$state&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&txtappli=$txtappli&rettyp=$rettyp&remarks=$remarks&txtphone=$txtphone'</script>";
}
			/*echo "<script>window.location='select_dicard.php?p_id=$p_id'</script>";	*/
		
		
	

//}}
//}
$sql_code="SELECT MAX(tcode) FROM tbl_discard  where yearcode='$yearid_id'  ORDER BY tcode DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="TMD".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TMD".$code."/".$yearid_id."/".$lgnid;
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Transaction - Material Discard </title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="discrd.js"></script>
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


function mySubmit()
{ 
	
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
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
	if(document.frmaddDept.txtparty.value=="")
	{
	alert("Please enter Party Name");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	if(document.frmaddDept.txtaddress.value=="")
	{
	alert("Please enter Address 1");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	if(document.frmaddDept.txtcity.value=="")
	{
	alert("Please enter City/Town/Village");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	if(document.frmaddDept.txtpin.value!="")
	{
		if(document.frmaddDept.txtpin.value.length < 6)
		{
		alert("Pin Code can not less than six digits");
		document.frmaddDept.txtpin.value="";
		return false;
		}
	}
	if(document.frmaddDept.txtstate.value=="")
	{
	alert("Please select State");
	//document.frmaddDept.txtparty.focus();
	return false;
	}
	
/*if(document.frmaddDept.txtparty.value=!"")
	{
		if(document.frmaddDept.txtparty.value.charCodeAt() == 32)
		{
		alert("Party Name cannot start with space.");
		document.frmaddDept.txtparty.focus();
		return false;
		}
	}
	
if(document.frmaddDept.txtaddress.value=!"")
	{
		if(document.frmaddDept.txtaddress.value.charCodeAt() == 32)
		{
		alert("Address cannot start with space.");
		document.frmaddDept.txtaddress.focus();
		return false;
		}
	}*/

if(document.frmaddDept.txtappli.value!="")
	{
	if(document.frmaddDept.txtappli.value=="Applicable")
	{
if(document.frmaddDept.txt11.value!="")
	{
		if(document.frmaddDept.txt11.value=="Transport")
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
						
			/*if(document.frmaddDept.txtlrn.value=="")
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
			}*/
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
		else if(document.frmaddDept.txt11.value=="Courier")
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
		else
		{
			if(document.frmaddDept.txtpname.value=="")
			{
			alert("Please enter Person Name");
			document.frmaddDept.txtpname.focus();
			return false;
			}	
		}
	}
	else
	{
		alert("Please select Mode of Transit");
		return false;
	}
}
}
else
{
		alert("Please select Mode of Transit Applicable or Not Applicable");
		return false;
}

	
	if(document.frmaddDept.rettyp.value=="")
			{
			alert("Please select Type");
			//document.frmaddDept.rettyp.focus();
			return false;
			}
			
			if(document.frmaddDept.trid.value==0)
			{
			alert("You have not Posted any Item. Please post & then click Preview");
			return false;
			}
			if(document.frmaddDept.remarks.value=="")
			{
			alert("Please enter Reason for Discard");
			return false;
			}
	return true;	 
}


function clkapp(optapp)
{
if(optapp!="")
	{
		if(optapp=="Applicable")
		{
			document.getElementById('transmode').style.display="block";
			//document.getElementById('courier').style.display="none";
			document.frmaddDept.txtappli.value=optapp;
		}
		else
		{
			document.getElementById('transmode').style.display="none";
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
			document.frmaddDept.txt1.checked=false;
			document.frmaddDept.txttname.value="";
			document.frmaddDept.txt11.value="";
			document.frmaddDept.txt14.value="";
			document.frmaddDept.txtlrn.value="";
			document.frmaddDept.txtvn.value="";
			document.frmaddDept.txt13.checked=false;
			document.frmaddDept.txtcname.value="";
			document.frmaddDept.txtdc.value="";
			document.frmaddDept.txtpname.value="";
			document.frmaddDept.txtappli.value=optapp;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
	}
}
function clk(opt)
{
	if(opt!="")
		{
			if(opt=="Transport")
			{
				document.getElementById('trans').style.display="block";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="none";
				document.frmaddDept.txt11.value=opt;
			}
			else if(opt=="Courier")
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="block";
				document.getElementById('byhand').style.display="none";
				document.frmaddDept.txt11.value=opt;
			}	
			else
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="block";
				document.frmaddDept.txt11.value=opt;
			}	
		}
		else
		{
			alert("Please Select Mode of Transport");
			document.frmaddDept.txt11.value="";
		}
}

var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDept.reset();
	 popUpCalendar(document.frmaddDept.date,dt,document.frmaddDept.date, "dd-mmm-yyyy", xind, yind);
	}  


function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
function onloadfocus()
	{
	document.frmaddDept.txt12.focus();
	}
	
function pform()
{
//alert("Hi posting the form");
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Select classifcation");
		//document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Item.");
		//document.frmaddDept.txtitem.focus();
		return false;
	}
	//alert(document.frmaddDept.srno.value);
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
	if(document.frmaddDept.txtups.value<=0)
	{
		alert("Please enter UPS");
		document.frmaddDept.txtups.focus();
		return false;
	}
	if(document.frmaddDept.txtqty.value<=0)
	{
		alert("Please enter Quantity");
		document.frmaddDept.txtqty.focus();
		return false;
	}
	if(document.frmaddDept.chkbox.value == "")
	{
	alert("Please select SLOC to Discard");
	return false;
	}
	//alert("HIIIIIIIIII");
	if(document.frmaddDept.chkbox.value != "")
	{	//alert(document.frmaddDept.chkbox.value);
		var str=document.frmaddDept.srno1.value;
		var val=str.split(",");
		//alert(val);
		var tqty=0;
		if(val!="")
		for(var i=0; i<val.length; i++)
		{ 
			var z2="upsavl_"+val[i];
			var z3="qtyavl_"+val[i];
			var z4="issueups_"+val[i];
			var z5="issueqty_"+val[i];
			var z="balups_"+val[i];
			var z1="balqty_"+val[i];
			tqty=tqty+parseFloat(document.getElementById(z5).value);
			
			if(document.getElementById(z1).value == "")
			{
			alert('Please enter UPS & Quantity to Discard in SLOC Row Number: '+val[i]);
			return false;
			}
			if(parseFloat(document.getElementById(z5).value) > parseFloat(document.getElementById(z3).value))
			{
			alert('Discard Quantity cannot be more than the Existing Quantity');
			document.getElementById(z1).value="";
			document.getElementById(z5).value="";
			return false;
			}
			if(parseFloat(document.getElementById(z1).value) == 0 )
			{
			document.getElementById(z).value=0;
			}
			if(parseFloat(document.getElementById(z1).value) != 0 && parseInt(document.getElementById(z).value) == 0)
			{
			document.getElementById(z).value=1;
			}
		}
		if(parseFloat(tqty) != parseFloat(document.frmaddDept.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Discard');
		return false;
		}
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.remarks.value=a;
		showUser(a,'maindiv','discard3','','','','','');

}	
}

function chktyp()
{ 
	if(document.frmaddDept.txtitem.value!="")
	{
			var opttyp=document.frmaddDept.txtrettype.value;
			var clasid=document.frmaddDept.txtclass.value;
			var itmid=document.frmaddDept.txtitem.value;
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,opttyp,'');
			
	}
	else
	{
		alert("please select Item first");
		
	}
}

function checkchk(chkval)
{
		var x="issueups_"+chkval;
		var y="issueqty_"+chkval;
		var z="balups_"+chkval;
		var z1="balqty_"+chkval;
		//alert(chkval);
		if(document.getElementById(chkval).checked==true)
		{
			document.getElementById(x).readOnly=false;
			document.getElementById(y).readOnly=false;
			document.getElementById(z).readOnly=false;
			document.getElementById(x).style.backgroundColor="#FFFFFF";
			document.getElementById(y).style.backgroundColor="#FFFFFF";
			document.getElementById(z).style.backgroundColor="#FFFFFF";
		}
		else
		{
			document.getElementById(x).value="";
			document.getElementById(y).value="";
			document.getElementById(z).value="";
			document.getElementById(z1).value="";
			document.getElementById(x).readOnly=true;
			document.getElementById(y).readOnly=true;
			document.getElementById(z).readOnly=true;
			document.getElementById(x).style.backgroundColor="#CCCCCC";
			document.getElementById(y).style.backgroundColor="#CCCCCC";
			document.getElementById(z).style.backgroundColor="#CCCCCC";
		}
}
function upschk(fid,fval)
{
var a="upsavl_"+fval;
var b="balups_"+fval;
document.getElementById(b).value=parseInt(document.getElementById(a).value)-parseInt(fid);
}

function qtychk(qid,qval)
{
			var z2="upsavl_"+qval;
			var z3="qtyavl_"+qval;
			var z4="issueups_"+qval;
			var z5="issueqty_"+qval;
			var z="balups_"+qval;
			var z1="balqty_"+qval;
			
			if(parseFloat(document.getElementById(z5).value) > parseFloat(document.getElementById(z3).value))
			{
			alert('Issue Quantity cannot be more than the Existing Quantity');
			document.getElementById(z1).value="";
			document.getElementById(z5).value="";
			return false;
			}
			if(parseFloat(document.getElementById(z1).value) == 0 )
			{
			document.getElementById(z).value=0;
			}
			if(parseFloat(document.getElementById(z1).value) != 0 && parseInt(document.getElementById(z).value) == 0)
			{
			document.getElementById(z).value=1;
			}
			if(parseFloat(document.getElementById(z5).value) == "")
			{
			alert('Issue Quantity cannot be blank');
			document.getElementById(z1).value=parseFloat(document.getElementById(z3).value);
			document.getElementById(z5).value=0;
			return false;
			}
			else
			{
			/*var c="qtyavl_"+qval;
			var d="balqty_"+qval;*/
			document.getElementById(z1).value=parseFloat(document.getElementById(z3).value)-parseFloat(document.getElementById(z5).value);
			}
}
function clks(val)
{
//alert(val);
document.frmaddDept.txt15.value=val;
}
function clk1(val)
{
//alert(val);
document.frmaddDept.txt14.value=val;
}

function modetchk(classval)
{
if(document.frmaddDept.txt1.value!="")
showUser(classval,'vitem','item','','','','','');
else
alert("Please select Mode of Transit first");

}

function piupschk()
{
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDept.txtitem.focus();
	}
}
function piqtychk(edtid)
{
	if(document.frmaddDept.txtups.value=="")
	{
		alert("Please enter UPS as per Indent first");
		document.frmaddDept.txtups.focus();
	}
	
}	

function classchk(itval)
{
if(document.frmaddDept.txtclass.value!="")
	{	
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
		setTimeout('chktyp()',200);
	}
	else
	{
		alert("Please Select Classification")
		//document.frmaddDept.txtitem.
		document.frmaddDept.txtitem.selectedIndex=0;
		document.frmaddDept.txtclass.focus();
	}
}
function editrecord(edtid)
{
//alert(edtid);
showUser(edtid,'subsubdiv','subformedt','','','','','');
}

function deleterec(v1,v2,v3)
{
if(confirm('Do You wish to delete this item?')==true)
{
showUser(v1,'maindiv','dddelete',v2,v3,'','','');
}
else
{
return false;
}
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
{*/
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Select classifcation");
		//document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Item.");
		//document.frmaddDept.txtitem.focus();
		return false;
	}
	if(document.frmaddDept.txtups.value<=0)
	{
		alert("Please enter UPS");
		document.frmaddDept.txtups.focus();
		return false;
	}
	if(document.frmaddDept.txtqty.value<=0)
	{
		alert("Please enter Quantity");
		document.frmaddDept.txtqty.focus();
		return false;
	}
	if(document.frmaddDept.chkbox.value == "")
	{
	alert("Please select SLOC to Discard");
	return false;
	}
	//alert("HIIIIIIIIII");
	if(document.frmaddDept.chkbox.value != "")
	{	//alert(document.frmaddDept.chkbox.value);
		var str=document.frmaddDept.srno1.value;
		var val=str.split(",");
		//alert(val);
		var tqty=0;
		if(val!="")
		for(var i=0; i<val.length; i++)
		{ 
			var z2="upsavl_"+val[i];
			var z3="qtyavl_"+val[i];
			var z4="issueups_"+val[i];
			var z5="issueqty_"+val[i];
			var z="balups_"+val[i];
			var z1="balqty_"+val[i];
			tqty=tqty+parseFloat(document.getElementById(z5).value);
			
			if(document.getElementById(z1).value == "")
			{
			alert('Please enter UPS & Quantity to Discard in SLOC Row Number: '+val[i]);
			return false;
			}
			if(parseFloat(document.getElementById(z5).value) > parseFloat(document.getElementById(z3).value))
			{
			alert('Discard Quantity cannot be more than the Existing Quantity');
			document.getElementById(z1).value="";
			document.getElementById(z5).value="";
			return false;
			}
			if(parseFloat(document.getElementById(z1).value) == 0 )
			{
			document.getElementById(z).value=0;
			}
			if(parseFloat(document.getElementById(z1).value) != 0 && parseInt(document.getElementById(z).value) == 0)
			{
			document.getElementById(z).value=1;
			}
		}
		if(parseFloat(tqty) != parseFloat(document.frmaddDept.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Discard');
		return false;
		}
	}
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.txtremarks.value=a;
		showUser(a,'maindiv','mformddupdate','','','','','');
}
}	

function clkret(retopt)
{
	document.frmaddDept.rettyp.value=retopt;
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Material Discard </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);*/
	$trid=0;
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform"  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input name="txt15" value="" type="hidden"> 
		<input name="txt13" value="" type="hidden"> 
		<input name="txt" value="" type="hidden"> 
		<input type="hidden" name="code" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
 		<input name="txtappli" value="" type="hidden"> 
  		 <input name="rettyp" value="Not Returnable" type="hidden"> 
		 <input name="txt1" value="" type="hidden"> 
   <?php
$tid=0; $subtid=0;
?>
		</br>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">

<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Material Discard </td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="215" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID &nbsp;</td>
           <td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
		   
		   <td width="84" height="24"  align="right"  valign="middle" class="tblheading">Discard&nbsp;Date&nbsp;</td>
           <td width="207" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" /></td>
</tr>
		
		 <tr class="Light" height="25">
          <td width="215" height="24"  align="right"  valign="middle" class="tblheading"> Discard &nbsp;Instruction Ref. No.&nbsp;</td>
          <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtdrno" type="text" size="20" class="tbltext" tabindex="0" maxlength="15"  onchange="showUser(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		   <tr class="Light" height="25">
           <td width="215" height="24"  align="right"  valign="middle" class="tblheading">Party Name &nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtparty" type="text" size="35" class="tbltext" tabindex="0" maxlength="35" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
 <tr class="Dark" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#4ea1e1">&nbsp;Address 1&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#4ea1e1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtaddress" size="70" maxlength="70" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#4ea1e1">&nbsp;Address 2&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#4ea1e1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtaddress1" size="70" maxlength="70" >&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#4ea1e1">&nbsp;City/Town/Village&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#4ea1e1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtcity" size="50" maxlength="50" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#4ea1e1">&nbsp;Pin&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#4ea1e1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtpin" size="6" maxlength="6" onkeypress="return isNumberKey(event)" >&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#4ea1e1">&nbsp;State&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#4ea1e1" colspan="3">&nbsp;<select name="txtstate" class="tbltext"  style="width:170px;" tabindex="">
          <option value="">--Select State--</option>
          <option value="Andhra Pradesh">Andhra Pradesh</option>
          <option value="Andaman &amp; Nicobar">Andaman &amp; Nicobar</option>
          <option value="Arunchal Pradesh">Arunchal Pradesh</option>
          <option value="Assam">Assam</option>
          <option value="Bihar">Bihar</option>
          <option value="Chandigarh">Chandigarh</option>
          <option value="Chattisgarh">Chattisgarh</option>
          <option value="Dadra &amp; Nagar Haveli">Dadra &amp; Nagar Haveli</option>
          <option value="Daman&amp;Due">Daman&amp;Due</option>
          <option value="Delhi">Delhi</option>
          <option value="Goa">Goa</option>
          <option value="Gujarat">Gujarat</option>
          <option value="Haryana">Haryana</option>
          <option value="Himachal Pradesh">Himachal Pradesh</option>
          <option value="Jammu&amp;Kashmir">Jammu&amp;Kashmir</option>
          <option value="Jharkhand">Jharkhand</option>
          <option value="Karnataka">Karnataka</option>
          <option value="Kerala">Kerala</option>
          <option value="Lakshdweep">Lakshdweep</option>
          <option value="Madhya Pradesh">Madhya Pradesh</option>
          <option value="Maharashtra">Maharashtra</option>
          <option value="Manipur">Manipur</option>
          <option value="Meghalaya">Meghalaya</option>
          <option value="Mizoram">Mizoram</option>
          <option value="Nagaland">Nagaland</option>
          <option value="Orissa">Orissa</option>
          <option value="Punjab">Punjab</option>
          <option value="Pondicherry">Pondicherry</option>
          <option value="Rajasthan">Rajasthan</option>
          <option value="Sikkim">Sikkim</option>
          <option value="Tamilnadu">Tamilnadu</option>
		  <option value="Telangana">Telangana</option>
          <option value="Tripura">Tripura</option>
          <option value="Uttar Pradesh">Uttar Pradesh</option>
          <option value="Uttaranchal">Uttaranchal</option>
          <option value="West Bengal">West Bengal</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="180" align="right"  valign="middle" class="tblheading" style=" border-color:#4ea1e1">&nbsp;Phone No.&nbsp;</td>
<td width="564" align="left"  valign="middle" class="tbltext" style=" border-color:#4ea1e1" colspan="3">&nbsp;<input type="text" class="tbltext" name="txtphone" size="15" maxlength="15" onkeypress="return isNumberKey(event)" >&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5"><input name="txtmode" type="radio" class="tbltext" value="Applicable" onClick="clkapp(this.value);" />&nbsp;Applicable&nbsp;&nbsp;&nbsp;&nbsp;<input name="txtmode" type="radio" class="tbltext" value="Not Applicable" onClick="clkapp(this.value);" />&nbsp;Not Applicable&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table id="transmode" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none; border-color:#4ea1e1" > 
<tr class="Light" height="25">
<td width="189" align="right"  valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Select Mode of Transit&nbsp;</td>
 <td width="555" colspan="5" align="left"  valign="middle" class="tbltext" style="border-color:#4ea1e1"><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
 </table>
<table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none;border-color:#4ea1e1" > 
<tr class="Light" height="30">
<td align="right" width="189" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="124" align="right"  valign="middle" class="tblheading" style="border-color:#4ea1e1">Lorry Receipt No.&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext" colspan="3" style="border-color:#4ea1e1">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="189" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="236" valign="middle" class="tbltext" style="border-color:#4ea1e1" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#4ea1e1">&nbsp;<select class="tbltext" name="txt13" style="width:70px;" onchange="clk1(this.value);" >
<option value="" selected="selected">Select</option>
<option value="TBB">TBB</option>
<option value="ToPay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none; border-color:#4ea1e1" > 
<tr class="Dark" height="30">
<td align="right" width="189" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="236" valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="124" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext" colspan="3" style="border-color:#4ea1e1">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none; border-color:#4ea1e1" > 
<tr class="Dark" height="30">
<td align="right" width="189" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Name of Person&nbsp;</td>
<td width="555" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txtpname" type="text" size="30" class="tbltext" tabindex=""  maxlength="30" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table><br />

<div id="maindiv" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle">
			  <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
			  <td width="24%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Stock</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
                    <td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
                  	<td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
</table><input type="hidden" name="trid" value="<?php echo $trid?>" />
<br />
<div id="subsubdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>		
		
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
<tr class="Dark" height="25">
   <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
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
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="169"  align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="0" maxlength="5" onchange="piupschk();" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="169"  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex="0" maxlength="7" onchange="piqtychk(this.value);" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
</table><input name="txtrettype" value="damage" type="hidden"><input name="txtrettyp" value="damage" type="hidden"> 
<div id="subdiv">		
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
   <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/>
</table> 
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>	
</div>	
</div>	
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Return Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="ret" type="radio" class="tbltext" value="Returnable" onClick="clkret(this.value);" />&nbsp;Returnable&nbsp;&nbsp;&nbsp;&nbsp;<input name="ret" type="radio" class="tbltext" value="Not Returnable" checked="checked" onClick="clkret(this.value);" />&nbsp;Not Returnable&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr></table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_discard.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
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
