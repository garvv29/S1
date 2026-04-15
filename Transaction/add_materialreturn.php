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
	/*$yearid_id="09-10";
	$logid="opr1";
	$lgnid="OP1";	*/
	/*if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}*/
		if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{	
		$p_id=trim($_POST['trid']);
		$remarks=trim($_POST['txtremarks']);
		$txtcla=trim($_POST['txtcla']);
		$txtpdc=trim($_POST['txtpdc']);
		//$txtstrdate=trim($_POST['txtstrdate']);
		$txt11=trim($_POST['txt11']);
		$rettyp =trim($_POST['rettyp']);
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
		
		// Get QR IDs if present
		$qr_ids = isset($_POST['qr_ids']) ? trim($_POST['qr_ids']) : "";
		$qr_ids_param = !empty($qr_ids) ? "&qr_ids=" . urlencode($qr_ids) : "";
		
		echo "<script>window.location='add_issue_mrtv_preview.php?p_id=$p_id&txtcla=$txtcla&txtpdc=$txtpdc&remarks=$remarks&txt11=$txt11&txttname=$txttname&txtlrn=$txtlrn&txtvn=$txtvn&txt14=$txt14&txtcname=$txtcname&txtdc=$txtdc&txtpname=$txtpname&rettyp=$rettyp" . $qr_ids_param . "'</script>";
}
//}
//}


$a="TIM";
	$s_chk=mysql_query("SELECT * FROM tblissue where yearcode='$yearid_id' and issue_type='MReturnV'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(issue_code) FROM tblissue where yearcode='$yearid_id' and issue_type='MReturnV' ORDER BY issue_code DESC";
	else
	$sql_code="SELECT MAX(issue_code) FROM tblissue where issue_type='MReturnV' and yearcode='$yearid_id' ORDER BY issue_code DESC";
	
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
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>stores-Transaction -Transaction - Issue- Material Return to Vendor </title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script src="issue.js"></script>

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
<script src="issue.js"></script>
<script language="JavaScript">
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


function clk(opt)
{
	if(document.frmaddDepartment.txtcla.value!="")
	{
		if(opt!="")
		{
			if(opt=="Transport")
			{
				document.getElementById('trans').style.display="block";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="none";
				document.frmaddDepartment.txt11.value=opt;
			}
			else if(opt=="Courier")
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="block";
				document.getElementById('byhand').style.display="none";
				document.frmaddDepartment.txt11.value=opt;
			}	
			else
			{
				document.getElementById('trans').style.display="none";
				document.getElementById('courier').style.display="none";
				document.getElementById('byhand').style.display="block";
				document.frmaddDepartment.txt11.value=opt;
			}	
		}
		else
		{
			alert("Please Select Mode of Transport");
			document.frmaddDepartment.txt11.value="";
		}
	}
	else
	{
	alert("Please select Party Name");
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

function onloadfocus()
	{
	document.frmaddDepartment.txtcla.focus();
	}
var x = 0;

function imgOnClick(dt, xind, yind)
	{document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.date,dt,document.frmaddDepartment.date, "dd-mmm-yyyy", xind, yind);
	}  


function modetchk(classval)
{
	if(document.frmaddDepartment.txt11.value!="")
	{
	showUser(classval,'vitem','item','','','','','');
	}
	else
	{
	alert("Please select Mode of Transport first");
	document.frmaddDepartment.txtclass.selectedIndex=0;
	//document.frmaddDepartment.txtqty.value=="";
	//document.frmaddDepartment.txt1.focus();
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
					document.frmaddDepartment.txtitem.selectedIndex=0;
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
		//document.frmaddDepartment.txtitem.
		document.frmaddDepartment.txtitem.selectedIndex=0;
		document.frmaddDepartment.txtclass.focus();
	}
}

function piupschk()
{
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDepartment.txtitem.focus();
	}
}

function piqtychk(edtid)
{
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please enter UPS as per Indent first");
		document.frmaddDepartment.txtqty.value="";
		document.frmaddDepartment.txtups.focus();
	}
}	

// QR Scanning Functions for Material Return
function checkQRButtonVisibility(srno, classid, itemid)
{
	var isRoll = document.getElementById('classisroll_' + srno).value;
	var issueups = document.getElementById('issueups_' + srno).value;
	var qrbtn = document.getElementById('qrbtn_' + srno);
	
	console.log('Row ' + srno + ': Checking QR button visibility. Classification is Roll: ' + isRoll);
	
	if(isRoll == '1' || isRoll == 1)
	{
		console.log('Row ' + srno + ': Classification = Roll ✓');
		console.log('Row ' + srno + ': Issue UPS value = ' + issueups);
		
		if(issueups > 0)
		{
			console.log('Row ' + srno + ': UPS > 0, showing Scan QR button ✓');
			qrbtn.style.display = 'inline';
		}
		else
		{
			console.log('Row ' + srno + ': UPS = 0, hiding Scan QR button');
			qrbtn.style.display = 'none';
		}
	}
	else
	{
		console.log('Row ' + srno + ': Classification is not Roll, hiding button');
		qrbtn.style.display = 'none';
	}
}

function openQRScanPopupFromSLOC(srno, classid, itemid)
{
	var issueups = document.getElementById('issueups_' + srno).value;
	
	if(issueups == "" || issueups == "0")
	{
		alert("Please enter Issue UPS value first");
		return false;
	}
	
	// Store row number for callback
	window.currentQRRowNum = srno;
	
	// Open QR scanning popup
	var popupUrl = 'scan_qrcode_indent.php?classification_id=' + classid + '&item_id=' + itemid + '&ups=' + issueups;
	winHandle = window.open(popupUrl, 'QRScan', 'top=200,left=200,width=1000,height=700,scrollbars=yes');
	
	if(winHandle == null)
	{
		alert("Could not open QR Scanning window.\nPlease check your Popup Blocker settings.");
	}
}

function setQRTotalWeight(totalWeight, qrIdList)
{
	var srno = window.currentQRRowNum;
	
	// If called from SLOC table row (srno exists)
	if(srno && srno > 0)
	{
		// Populate Issue Qty field for that row
		var issueqtyField = document.getElementById('issueqty_' + srno);
		if(issueqtyField)
		{
			issueqtyField.value = totalWeight;
			issueqtyField.readOnly = true;
			issueqtyField.style.backgroundColor = '#CCCCCC';
			console.log('Row ' + srno + ' Qty populated with weight: ' + totalWeight);
		}
		
		// Store QR IDs for this SLOC row
		var hiddenField = document.getElementById('scanned_qr_ids_' + srno);
		if(!hiddenField)
		{
			hiddenField = document.createElement('input');
			hiddenField.type = 'hidden';
			hiddenField.id = 'scanned_qr_ids_' + srno;
			document.frmaddDepartment.appendChild(hiddenField);
		}
		hiddenField.value = qrIdList;
		
		// Also store in main form field for final submission
		var mainQRField = document.getElementById('qr_ids');
		if(mainQRField)
		{
			var qrIdString = Array.isArray(qrIdList) ? qrIdList.join(',') : qrIdList;
			if(mainQRField.value != '')
			{
				mainQRField.value += ',' + qrIdString;
			}
			else
			{
				mainQRField.value = qrIdString;
			}
			console.log('QR IDs stored:', qrIdString);
		}
	}
	
	self.close();
}

function openQRScanPopupEdit()
{
	// This is for edit page context if needed
	var classid = document.frmaddDepartment.txtclass.value;
	var itemid = document.frmaddDepartment.txtitem.value;
	var ups = document.frmaddDepartment.txtups.value;
	
	if(classid != '' && itemid != '' && ups > 0)
	{
		var winHandle = window.open('scan_qrcode_indent.php?classification_id=' + classid + '&item_id=' + itemid + '&ups=' + ups, 'QRScanWindow', 'width=600,height=400,resizable=yes,scrollbars=yes');
		if(winHandle == null)
		{
			alert("Popup window blocked. Please enable popups and try again.");
		}
	}
	else
	{
		alert("Please select Classification, Item first and enter UPS value");
	}
}

function chktyp(opttyp)
{ opttyp="good";
	if(document.frmaddDepartment.txtitem.value!="")
	{
		if(opttyp!="")
		{
			document.frmaddDepartment.txtrettype.value=opttyp;
			var clasid=document.frmaddDepartment.txtclass.value;
			var itmid=document.frmaddDepartment.txtitem.value;
			if(document.frmaddDepartment.edtrowid.value != 0)
			var rd=document.frmaddDepartment.edtrowid.value;
			else
			var rd=0;
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,rd,'');
		}
		else
		{
			alert("Please select Material Type first");
		}
	}
	else
	{
		alert("please select Item first");
		
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
			/*else
			{*/
			var c="qtyavl_"+qval;
			var d="balqty_"+qval;
			document.getElementById(d).value=parseFloat(document.getElementById(c).value)-parseFloat(qid);
			//}
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



function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }
	  
	  
/*function upschkd(fid,fval)
{
var a="upsavld_"+fval;
var b="balupsd_"+fval;
document.getElementById(b).value=parseInt(document.getElementById(a).value)-parseInt(fid);
}

function qtychkd(qid,qval)
{
			var z2="upsavld_"+qval;
			var z3="qtyavld_"+qval;
			var z4="issueupsd_"+qval;
			var z5="issueqtyd_"+qval;
			var z="balupsd_"+qval;
			var z1="balqtyd_"+qval;
			
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
			else
			{
			var c="qtyavld_"+qval;
			var d="balqtyd_"+qval;
			document.getElementById(d).value=parseFloat(document.getElementById(c).value)-parseFloat(qid);
			}
}


function checkchkd(chkval)
{
		var x="issueupsd_"+chkval;
		var y="issueqtyd_"+chkval;
		var z="balupsd_"+chkval;
		var z1="balqtyd_"+chkval;
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
*/
function pform()
{
	document.frmaddDepartment.chkbox.value="";
	//document.frmaddDepartment.chkboxd.value="";
	document.frmaddDepartment.srno1.value="";
	//document.frmaddDepartment.srnod1.value="";
	//alert(document.frmaddDepartment.txtrettype.value);
	
if(document.frmaddDepartment.srno.value > 0)
{
		if(document.frmaddDepartment.srno.value <= 2)
		{
			if(document.frmaddDepartment.slocissue.checked == true)
			{  
				if(document.frmaddDepartment.chkbox.value =="")
				{
					document.frmaddDepartment.chkbox.value=document.frmaddDepartment.slocissue.value;
				}
				else
				{
					document.frmaddDepartment.chkbox.value = document.frmaddDepartment.chkbox.value +','+document.frmaddDepartment.slocissue.value;
				}
				if(document.frmaddDepartment.srno1.value =="")
				{
					document.frmaddDepartment.srno1.value=parseInt(document.frmaddDepartment.srno.value)-1;
				}
				else
				{
					document.frmaddDepartment.srno1.value = document.frmaddDepartment.srno1.value +','+parseInt(document.frmaddDepartment.srno.value)-1;
				}
			}
		}
		else
		{ var j=1;
			for (var i = 0; i < document.frmaddDepartment.slocissue.length; i++) 
			{    
				if(document.frmaddDepartment.slocissue[i].checked == true)
				{	
					if(document.frmaddDepartment.chkbox.value =="")
					{ 
					document.frmaddDepartment.chkbox.value=document.frmaddDepartment.slocissue[i].value;
					}
					else
					{
					document.frmaddDepartment.chkbox.value = document.frmaddDepartment.chkbox.value +','+document.frmaddDepartment.slocissue[i].value;
					}
					if(document.frmaddDepartment.srno1.value =="")
					{
					document.frmaddDepartment.srno1.value=j;
					}
					else
					{
					document.frmaddDepartment.srno1.value = document.frmaddDepartment.srno1.value +','+j;
					}
				} j++;
			}
		}
		
/*}
//alert(document.frmaddDepartment.chkbox.value);
if(document.frmaddDepartment.srno.value > 0)
{
	if(document.frmaddDepartment.txtindent.value=="")
	{
		alert("Please enter Indent Number first");
		document.frmaddDepartment.txtindent.focus();
		return false;
	}
	if(document.frmaddDepartment.txtphysical.value=="")
	{
		alert("Please enter Physical Indent Raised by first");
		document.frmaddDepartment.txtphysical.focus();
		return false;
	}*/
	if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
	if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Please Select Classification first")
		//document.frmaddDepartment.txtitem.
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	/*if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please enter UPS as per Indent first");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	if(document.frmaddDepartment.txtqty.value=="")
	{
		alert("Please enter Quantity as per Indent first");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
*/	
if(document.frmaddDepartment.txtups.value<=0)
	{
		alert("Please enter UPS to be Return");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	if(document.frmaddDepartment.txtqty.value<=0)
	{
		alert("Please enter Quantity to be Return");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	if(document.frmaddDepartment.chkbox.value == "")
	{
	alert("Please select SLOC to Issue");
	return false;
	}
	//alert("HIIIIIIIIII");
	if(document.frmaddDepartment.chkbox.value != "")
	{	//alert(document.frmaddDepartment.chkbox.value);
		var str=document.frmaddDepartment.srno1.value;
		var val=str.split(",");
		//alert(val[0]);
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
			alert('Please enter UPS & Quantity to Issue in SLOC Row Number: '+val[i]);
			return false;
			}
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
			
		}
		if(parseFloat(tqty) != parseFloat(document.frmaddDepartment.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Issued');
		return false;
		}
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDepartment.txtremarks.value=a;
		showUser(a,'maindiv','mformmrtv','','','','','');
}
}
function pupdateform()
{
	document.frmaddDepartment.chkbox.value="";
	document.frmaddDepartment.srno1.value="";
	if(document.frmaddDepartment.srno.value > 0)
	{
		if(document.frmaddDepartment.srno.value <= 2)
		{
			if(document.frmaddDepartment.slocissue.checked == true)
			{  
				if(document.frmaddDepartment.chkbox.value =="")
				{
					document.frmaddDepartment.chkbox.value=document.frmaddDepartment.slocissue.value;
				}
				else
				{
					document.frmaddDepartment.chkbox.value = document.frmaddDepartment.chkbox.value +','+document.frmaddDepartment.slocissue.value;
				}
				if(document.frmaddDepartment.srno1.value =="")
				{
					document.frmaddDepartment.srno1.value=parseInt(document.frmaddDepartment.srno.value)-1;
				}
				else
				{
					document.frmaddDepartment.srno1.value = document.frmaddDepartment.srno1.value +','+parseInt(document.frmaddDepartment.srno.value)-1;
				}
			}
		}
		else
		{ var j=1;
			for (var i = 0; i < document.frmaddDepartment.slocissue.length; i++) 
			{          
				if(document.frmaddDepartment.slocissue[i].checked == true)
				{
					if(document.frmaddDepartment.chkbox.value =="")
					{
					document.frmaddDepartment.chkbox.value=document.frmaddDepartment.slocissue[i].value;
					}
					else
					{
					document.frmaddDepartment.chkbox.value = document.frmaddDepartment.chkbox.value +','+document.frmaddDepartment.slocissue[i].value;
					}
					if(document.frmaddDepartment.srno1.value =="")
					{
					document.frmaddDepartment.srno1.value=j;
					}
					else
					{
					document.frmaddDepartment.srno1.value = document.frmaddDepartment.srno1.value +','+j;
					}
				} j++;
			}
		}
/*}
//alert(document.frmaddDepartment.chkbox.value);
if(document.frmaddDepartment.srno.value > 0)
{*/
if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}
if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Please Select Classification first")
		//document.frmaddDepartment.txtitem.
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	if(document.frmaddDepartment.txtups.value<=0)
	{
		alert("Please enter UPS to be Return");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	if(document.frmaddDepartment.txtqty.value<=0)
	{
		alert("Please enter Quantity to be Return");
		document.frmaddDepartment.txtqty.focus();
		return false;
	}
	if(document.frmaddDepartment.chkbox.value == "")
	{
	alert("Please select SLOC to Issue");
	return false;
	}
	//alert("HIIIIIIIIII");
	if(document.frmaddDepartment.chkbox.value != "")
	{	//alert(document.frmaddDepartment.chkbox.value);
		var str=document.frmaddDepartment.srno1.value;
		var val=str.split(",");
		//alert(val);
		if(val!="")
		var tqty=0;
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
			alert('Please enter UPS & Quantity to Issue in SLOC Row Number: '+val[i]);
			return false;
			}
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
		}
		if(parseFloat(tqty) != parseFloat(document.frmaddDepartment.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Issued');
		return false;
		}
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDepartment.txtremarks.value=a;
		showUser(a,'maindiv','mformmrtvupdate','','','','','');
}
}

function editrec(edtid)
{
//alert(edtid);
showUser(edtid,'subsubdiv','edtrecmrtv','','','','','');
}

function deleterec(v1,v2,v3)
{
if(confirm('Do You wish to delete this item?')==true)
{
showUser(v1,'maindiv','mrtvdelete',v2,v3,'','','');
}
else
{
return false;
}
}

function clk1(val)
{
//alert(val);
document.frmaddDepartment.txt14.value=val;
}
function clkret(retopt)
{
	document.frmaddDepartment.rettyp.value=retopt;
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
	
			
	/*if(document.frmaddDepartment.txtstrno.value=="")
	{
	alert("Please enter STR Ref.No.");
	document.frmaddDepartment.txtstrno.focus();
	return false;
	}*/
	
	if(document.frmaddDepartment.txtstrno.value.charCodeAt() == 32)
	{
	alert("STR Ref.No.cannot start with space.");
	document.frmaddDepartment.txtstrno.focus();
	return false;
	}
	
	/*if(document.frmaddDepartment.txtstrdate.value=="")
	{
	alert("Please select STR Date.");
	document.frmaddDepartment.txtstrdate.focus();
	return false;
	}
	if(document.frmaddDepartment.txtporn.value.charCodeAt() == 32)
	{
	alert("Reference No cannot start with space.");
	document.frmaddDepartment.txtporn.focus();
	return false;
	}
	if(document.frmaddDepartment.txtporn.value=="")
	{
	alert("Please Select Mode Of Transit");
	document.frmaddDepartment.txt1.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txt1.value.charCodeAt() == 32)
	{
	alert("Mode Of Transit cannot start with space.");
	document.frmaddDepartment.txt1.focus();
	return false;
	}*/
if(document.frmaddDepartment.txt11.value!="")
	{
		if(document.frmaddDepartment.txt11.value=="Transport")
		{
			if(document.frmaddDepartment.txttname.value=="")
			{
			alert("Please enter Transport Name");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
			{
			alert("Transport Name cannot start with space.");
			document.frmaddDepartment.txttname.focus();
			return false;
			}
						
			/*if(document.frmaddDepartment.txtlrn.value=="")
			{
			alert("Please enter Lorry Receipt No");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
			{
			alert("Lorry Receipt No cannot start with space.");
			document.frmaddDepartment.txtlrn.focus();
			return false;
			}*/
			if(document.frmaddDepartment.txtvn.value=="")
			{
			alert("Please enter Vehicle No");
			document.frmaddDepartment.txtvn.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
			{
			alert("Vehicle No cannot start with space.");
			document.frmaddDepartment.txtvn.focus();
			return false;
			}
			if(document.frmaddDepartment.txt14.value=="")
			{
			alert("Please select Payment Mode");
			return false;
			}
		}
		else if(document.frmaddDepartment.txt11.value=="Courier")
		{
			if(document.frmaddDepartment.txtcname.value=="")
			{
			alert("Please enter Courier Name");
			document.frmaddDepartment.txtcname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
			{
			alert("Courier Name cannot start with space.");
			document.frmaddDepartment.txtcname.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value=="")
			{
			alert("Please enter Docket No.");
			document.frmaddDepartment.txtdc.focus();
			return false;
			}
			
			if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
			{
			alert("Docket No. cannot start with space.");
			document.frmaddDepartment.txtdc.focus();
			return false;
			}
		}
		else
		{
			if(document.frmaddDepartment.txtpname.value=="")
			{
			alert("Please enter Person Name");
			document.frmaddDepartment.txtpname.focus();
			return false;
			}	
		}
	}
	else
	{
		alert("Please select Mode of Transit");
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Issue - Material Return to Vendor </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);*/
	
	 ?> 
	  
	    <td align="center" colspan="4" >
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	 <input name="txt14" value="" type="hidden"> 
	 <input type="hidden" name="txtid" value="<?php echo $code?>" />
	 <input type="hidden" name="logid" value="<?php echo $logid?>" />
	 <input type="hidden" name="qr_ids" id="qr_ids" value="" />
	  <input name="rettyp" value="Not Returnable" type="hidden"> 
		</br>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Issue Material Return to Vendor </td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <tr class="Dark" height="25">
           <td width="174" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="139" align="right" valign="middle" class="tblheading">Material Return&nbsp;Date&nbsp;</td>
<td width="176" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="0"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
		   </tr>
		
		<?php
$quer3=mysql_query("SELECT p_id, business_name FROM tbl_partymaser  where classification='Vendor' order by business_name"); 
?>
		 <tr class="Light" height="25">
           <td width="174" height="24"  align="right"  valign="middle" class="tblheading"> Party Name &nbsp;</td>
           <td align="left"  valign="middle" colspan="5">&nbsp;<select class="tbltext" name="txtcla" style="width:230px;"  onchange="showUser(this.value,'vaddress','vendor','','','','','');">
<option value="" selected>--Select--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		   </tr>
		   <?php
$quer4=mysql_query("SELECT DISTINCT address,p_id FROM tbl_partymaser order by classification Asc"); 
?>
		   <tr class="Dark" height="25">
			 <td width="174"  align="right" valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
    <td colspan="5" align="left"  valign="top" class="tbltext" id="vaddress"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"></div></td>
         </tr>
		
 
             <td width="174" height="24"  align="right"  valign="middle" class="tblheading">Party DC Ref. No.&nbsp;</td>
               <td align="left"  valign="middle"  colspan="5">&nbsp;<input name="txtpdc" type="text" size="20" class="tbltext" tabindex="0" maxlength="20" /></td>
</tr>
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
 </table>
 <table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Light" height="30">
<td align="right" width="171" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="124" align="right"  valign="middle" class="tblheading" style="border-color:#4ea1e1">Lorry Receipt No&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext" colspan="3" style="border-color:#4ea1e1">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="171" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#4ea1e1">&nbsp;<select class="tbltext" name="txt13" style="width:70px;" onchange="clk1(this.value);" >
<option value="" selected="selected">Select</option>
<option value="TBB">TBB</option>
<option value="ToPay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>

</tr>
</table>

<table id="courier" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="171" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="124" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="191" valign="middle" class="tbltext" colspan="3" style="border-color:#4ea1e1">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="171" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Name of Person&nbsp;</td>
<td width="573" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txtpname" type="text" size="30" class="tbltext" tabindex=""  maxlength="30" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<br />
<div id="maindiv">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="22%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			    <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock</td>
                  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Issue</td>
               <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			<tr class="tblsubtitle">
                   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
					 <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
                   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
				   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
  
</table>
<br />
<div id="subsubdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>		
<?php 
$classqry=mysql_query("select classification_id, classification from tbl_classification order by classification") or die(mysql_error());
?>
<tr class="Dark" height="25">
   <td width="148"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>
	</td></tr>
 <?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?>            
         <tr class="Light" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">Stores Item&nbsp;</td>
<td width="401" align="left" valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:230px;" onchange="classchk(this.value);" >
<option value="" selected>---Select Item---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="45" align="right"  valign="middle" class="tblheading" >UoM&nbsp;</td>
<td width="146" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="<?php echo $itmdchk;?>" />	
<tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="0" maxlength="5" onchange="piupschk();" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="169"  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex="0" maxlength="7" onchange="piqtychk(this.value);" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr> <input name="txtrettyp" type="hidden" class="tbltext" value="good"  />
     
</table><input name="txtrettype" value="good" type="hidden"> 
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
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
 
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="chkboxd" value=""/><input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="0" />
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pform();" /></td>
</tr>
</table>
</div>
</div>
</div>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Return Status&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="ret" type="radio" class="tbltext" value="Returnable" onClick="clkret(this.value);" />&nbsp;Returnable&nbsp;&nbsp;&nbsp;&nbsp;<input name="ret" type="radio" checked="checked" class="tbltext" value="Not Returnable" onClick="clkret(this.value);" />&nbsp;Not Returnable&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_materialreturn.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp; <input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;">&nbsp;&nbsp;</td>
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
