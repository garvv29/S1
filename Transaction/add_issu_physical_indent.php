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
	
	// Initialize p_id from GET if present
	$p_id=0;
	if(isset($_GET['p_id'])) { $p_id = $_GET['p_id']; }
	
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{ 
		$p_id=trim($_POST['trid']);
		$remarks=trim($_POST['txtremarks']);
		$remarks=str_replace("&","and",$remarks);
		
		// Get QR IDs from qr_ids field (new) or scanned_qr_ids field (old)
		$qr_ids = isset($_POST['qr_ids']) ? trim($_POST['qr_ids']) : (isset($_POST['scanned_qr_ids']) ? trim($_POST['scanned_qr_ids']) : '');
		$qr_ids_param = !empty($qr_ids) ? "&qr_ids=" . urlencode($qr_ids) : "";
		
		echo "<script>window.location='add_issue_pindents_preview.php?p_id=$p_id&remarks=$remarks" . $qr_ids_param . "'</script>";	
	}
//}
//}
$a="TIP";
	$s_chk=mysql_query("SELECT * FROM tblissue where yearcode='$yearid_id' and issue_type='pindent'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(issue_code) FROM tblissue where yearcode='$yearid_id' and issue_type='pindent' ORDER BY issue_code DESC";
	else
	$sql_code="SELECT MAX(issue_code) FROM tblissue where issue_type='pindent' and yearcode='$yearid_id' ORDER BY issue_code DESC";
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
<title>Stores- Transaction -Add isue  physical  indent</title>
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
<script src="issue.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  


function onloadfocus()
	{
	document.frmaddDept.txtindent.focus();
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


function deleterec(v1,v2,v3)
{
if(confirm('Do You wish to delete this item?')==true)
{
showUser(v1,'maindiv','pidelete',v2,v3,'','','');
}
else
{
return false;
}
}	

	
function indentnochk()
{
	if(document.frmaddDept.txtindent.value=="")
	{
		alert("Please enter Indent Number first");
		document.frmaddDept.txtindent.focus();
	}
}	
function modetchk(classval)
{
	if(document.frmaddDept.txtphysical.value!="")
	{
	showUser(classval,'vitem','item','','','','','');
	}
	else
	{
	alert("Please enter Physical Indent Raised by first");
	document.frmaddDept.txtups.value="";
	document.frmaddDept.txtqty.value=="";
	document.frmaddDept.txtclass.selectedIndex=0;
	document.frmaddDept.txtphysical.focus();
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
		setTimeout('showslocbins()',200);
	}
	else
	{
		alert("Please Select Classification")
		//document.frmaddDept.txtitem.
		document.frmaddDept.txtitem.selectedIndex=0;
		document.frmaddDept.txtclass.focus();
	}
}

function piupschk()
{
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDept.txtitem.focus();
	}
	else
	{
		// Check if classification is Roll and show Scan QR button
		var classText = document.frmaddDept.txtclass.options[document.frmaddDept.txtclass.selectedIndex].text;
		var scanBtn = document.getElementById('scanQRBtn');
		
		if(classText && classText.toLowerCase().indexOf('roll') >= 0 && document.frmaddDept.txtups.value > 0)
		{
			if(scanBtn) scanBtn.style.display = 'inline';
		}
		else
		{
			if(scanBtn) scanBtn.style.display = 'none';
		}
	}
}

// Check QR button visibility based on classification and UPS value
function checkQRButtonVisibility(srno, classid, itemid)
{
	// Check if this is a Roll classification
	var isRoll = document.getElementById('classisroll_' + srno).value;
	console.log('Row ' + srno + ': Checking QR button visibility. Classification is Roll: ' + isRoll);
	
	if(isRoll == '1')
	{
		console.log('Row ' + srno + ': Classification = Roll ✓');
		
		// Get the UPS value
		var issueups = document.getElementById('issueups_' + srno).value;
		console.log('Row ' + srno + ': Issue UPS value = ' + issueups);
		
		// Show or hide the Scan QR button
		var qrBtn = document.getElementById('qrbtn_' + srno);
		if(issueups > 0)
		{
			console.log('Row ' + srno + ': UPS > 0, showing Scan QR button');
			qrBtn.style.display = 'inline';
		}
		else
		{
			console.log('Row ' + srno + ': UPS = 0, hiding Scan QR button');
			qrBtn.style.display = 'none';
		}
	}
	else
	{
		console.log('Row ' + srno + ': Classification is NOT Roll, hiding Scan QR button');
		var qrBtn = document.getElementById('qrbtn_' + srno);
		qrBtn.style.display = 'none';
	}
}

// QR Scanning from SLOC Table (when user enters UPS value)
function openQRScanPopupFromSLOC(srno, classid, itemid)
{
	var issueUPS = document.getElementById('issueups_' + srno).value;
	
	if(issueUPS == "" || issueUPS == "0")
	{
		alert("Please enter Issue UPS value first");
		return false;
	}
	
	// Store row number for callback
	window.currentQRRowNum = srno;
	
	// Open QR scanning popup
	var popupUrl = 'scan_qrcode_indent.php?classification_id=' + classid + '&item_id=' + itemid + '&ups=' + issueUPS;
	winHandle = window.open(popupUrl, 'QRScan', 'top=200,left=200,width=1000,height=700,scrollbars=yes');
	
	if(winHandle == null)
	{
		alert("Could not open QR Scanning window.\nPlease check your Popup Blocker settings.");
	}
}

// QR Scanning for Roll Classification
function openQRScanPopup(classid, itemid, ups)
{
	if(classid == "" || itemid == "" || ups == "" || ups == "0")
	{
		alert("Please enter Classification, Item and UPS first");
		return false;
	}
	
	// Get classification name to check if it's Roll
	var classText = document.frmaddDept.txtclass.options[document.frmaddDept.txtclass.selectedIndex].text;
	
	if(classText && classText.toLowerCase().indexOf('roll') >= 0)
	{
		window.qrUpsCount = parseInt(ups);
		window.qrScanContext = {classid: classid, itemid: itemid, ups: ups};
		winHandle = window.open('scan_qrcode_indent.php?classification_id=' + classid + '&item_id=' + itemid + '&ups=' + ups, 'QRScan', 'top=200,left=200,width=1000,height=700,scrollbars=yes');
		if(winHandle == null)
		{
			alert("Could not open QR Scanning window.\nPlease check your Popup Blocker settings.");
		}
	}
	else
	{
		alert("Scan QR is only available for Roll classification");
	}
}

// Called from scan_qrcode_indent.php popup when user submits QR codes
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
		if(qrIdList && qrIdList.length > 0)
		{
			var hiddenFieldName = 'scanned_qr_ids_' + srno;
			var existingField = document.getElementById(hiddenFieldName);
			if(!existingField)
			{
				existingField = document.createElement('input');
				existingField.type = 'hidden';
				existingField.id = hiddenFieldName;
				existingField.name = hiddenFieldName;
				document.frmaddDept.appendChild(existingField);
			}
			var qrIdString = qrIdList.join(',');
			existingField.value = qrIdString;
			console.log('Row ' + srno + ' QR IDs stored:', qrIdString);
		}
	}
	else
	{
		// Called from main form (not from SLOC table)
		document.frmaddDept.txtqty.value = totalWeight;
		document.frmaddDept.txtqty.readOnly = true;
		document.frmaddDept.txtqty.style.backgroundColor = '#CCCCCC';
		
			// Store QR IDs for final submission
		if(qrIdList && qrIdList.length > 0)
		{
			var qrIdString = qrIdList.join(',');
			document.frmaddDept.qr_ids.value = qrIdString;
			document.frmaddDept.scanned_qr_ids.value = qrIdString;
			console.log('QR IDs stored in qr_ids field:', qrIdString);
		}
	}
	
	// Show confirmation
	alert('✓ QR Scan Complete\nTotal Weight: ' + totalWeight);
}

function showslocbins()
{
		var upsid=document.frmaddDept.txtups.value;
		var clasid=document.frmaddDept.txtclass.value;
		var itmid=document.frmaddDept.txtitem.value;
		showUser(upsid,'subdiv','slocshow',upsid,clasid,itmid,'','');
}
function piqtychk(edtid)
{
	if(document.frmaddDept.txtups.value=="")
	{
		alert("Please enter UPS as per Indent first");
		document.frmaddDept.txtups.focus();
	}
	
}	

function upschk(fid,fval)
{
var a="upsavl_"+fval;
var b="balups_"+fval;
document.getElementById(b).value=parseInt(document.getElementById(a).value,10)-parseInt(fid,10);
}

/*function qtychk(qid,qval)
{
var c="qtyavl_"+qval;
var d="balqty_"+qval;
document.getElementById(d).value=parseFloat(document.getElementById(c).value)-parseFloat(qid);
}
*/

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
function qtychk(val,sr)
{


			var z2="upsavl_"+sr;
			var z3="qtyavl_"+sr;
			var z4="issueups_"+sr;
			var z5="issueqty_"+sr;
			var z="balups_"+sr;
			var z1="balqty_"+sr;
			
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
			if(parseFloat(document.getElementById(z1).value) > 0 && parseInt(document.getElementById(z).value) <= 0)
			{
			document.getElementById(z).value=1;
			}
			else
			{
			var c="qtyavl_"+sr;
			var d="balqty_"+sr;
			document.getElementById(d).value=parseFloat(document.getElementById(c).value)-parseFloat(val);
			}
			
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

function pform()
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
		//document.frmaddDept.txtdate.focus();
		return false;
	}
	if(document.frmaddDept.txtindent.value=="")
	{
		alert("Please enter Indent Number first");
		document.frmaddDept.txtindent.focus();
		return false;
	}
	if(document.frmaddDept.txtphysical.value=="")
	{
		alert("Please enter Physical Indent Raised by first");
		document.frmaddDept.txtphysical.focus();
		return false;
	}
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Please Select Classification first")
		//document.frmaddDept.txtitem.
		document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	if(document.frmaddDept.txtups.value<=0)
	{
		alert("Please enter UPS as per Indent first");
		document.frmaddDept.txtups.focus();
		return false;
	}
	if(document.frmaddDept.txtqty.value<=0)
	{
		alert("Please enter Quantity as per Indent first");
		document.frmaddDept.txtqty.focus();
		return false;
	}
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
		if(parseFloat(tqty) != parseFloat(document.frmaddDept.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Issued');
		return false;
		}
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.tt.value=a;
		showUser(a,'maindiv','mformpi','','','','','');
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
		//document.frmaddDept.txtdate.focus();
		return false;
	}
	if(document.frmaddDept.txtindent.value=="")
	{
		alert("Please enter Indent Number first");
		document.frmaddDept.txtindent.focus();
		return false;
	}
	if(document.frmaddDept.txtphysical.value=="")
	{
		alert("Please enter Physical Indent Raised by first");
		document.frmaddDept.txtphysical.focus();
		return false;
	}
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Please Select Classification first")
		//document.frmaddDept.txtitem.
		document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please select Item first");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	if(document.frmaddDept.txtups.value<=0)
	{
		alert("Please enter UPS as per Indent first");
		document.frmaddDept.txtups.focus();
		return false;
	}
	if(document.frmaddDept.txtqty.value<=0)
	{
		alert("Please enter Quantity as per Indent first");
		document.frmaddDept.txtqty.focus();
		return false;
	}
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
		if(parseFloat(tqty) != parseFloat(document.frmaddDept.txtqty.value))
		{
		alert('Total Distributed Quantity not matching with the Total Quantity to be Issued');
		return false;
		}
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.tt.value=a;
		showUser(a,'maindiv','mformpiupdate','','','','','');
}
}

function editrec(edtid)
{
//alert(edtid);
showUser(edtid,'subsubdiv','edtrecpi','','','','','');
}
var x = 0;
function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth,cDate);	
	return (dtObject);
} 	

function mySubmit()
{ 
	dt1=getDateObject(document.frmaddDept.txtdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDept.txtdate.focus();
		return false;
	}
	if(dt1 < dt2)
	{
	alert("P-Indent Date needs to be less or equal than P-Indent Issue date");
	return false;
	}
		
		
	if(document.frmaddDept.txtindent.value=="")
	{
	alert("Please Enter Indent No ");
	document.frmaddDept.txtindent.focus();
	return false;
	}
	if(document.frmaddDept.txtindent.value.charCodeAt() == 32)
	{
	alert("Indent No cannot start with space.");
	document.frmaddDept.txtindent.focus();
	return false;
	}
	
	if(document.frmaddDept.txtphysical.value=="")
	{
	alert("Please enter Physical Indent");
	document.frmaddDept.txtphysical.focus();
	return false;
	}
	if(document.frmaddDept.txtphysical.value.charCodeAt() == 32)
	{
	alert(" Physical Indent  cannot start with space.");
	document.frmaddDeptt.txtphysical.focus();
	return false;
	}
if(document.frmaddDept.trid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
return true;
}
</SCRIPT>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction Issue - Internal Issue - Issue on Physical Indent</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);*/
	$trid=0; 
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="code" type="hidden" value="<?php echo $code;?>" />
	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
	<input name="p_id" type="hidden" value="<?php echo $p_id;?>" />
	 <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Issue on Physical Indent</td>
</tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
 
<tr class="Dark" height="25">
           <td width="134" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID &nbsp;</td>
         <td width="275"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
        
           <td width="185" height="24"  align="right"  valign="middle" class="tblheading">P-Indent Issue&nbsp;Date&nbsp;</td>
           <td width="252" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="6" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" />&nbsp;</td>
         </tr>
		 <tr class="Light" height="25">
           <td width="134" height="24"  align="right"  valign="middle" class="tblheading">Indent Number&nbsp;</td>
           <td align="left"  valign="middle">&nbsp;<input name="txtindent" type="text" size="15" class="tbltext" tabindex="0" maxlength="15" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
       
           <td width="185" height="24"  align="right"  valign="middle" class="tblheading">Physical Indent Raised by&nbsp;</td>
           <td align="left"  valign="middle">&nbsp;<input name="txtphysical" type="text" size="15" class="tbltext" tabindex="0" maxlength="25" onchange="indentnochk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
           <td width="134" height="24"  align="right"  valign="middle" class="tblheading">P-Indent Date &nbsp;</td>
          <td width="147" align="left"  valign="middle" class="tblheading" colspan="3">&nbsp;<input name="edate" id="edate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="imgOnClick1(document.frmaddDept.edate,-100,-100)" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script></td>
         </tr>
</table>
<br />
<div id="maindiv">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse"> 
<tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="13%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			    <td colspan="2" height="23" align="center" valign="middle" class="tblheading">As Per Indent </td>
			     <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock</td>
                  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Issue</td>
               <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			<tr class="tblsubtitle">
                   <td width="6%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
					 <td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
                   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
			
</table>
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
           <td align="left"  valign="middle" colspan="6" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:230px;" onchange="modetchk(this.value)">
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
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" id="vitem">
<td align="right" valign="middle" class="tblheading">UPS&nbsp;</td>
<td width="349" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtups" type="text" size="10" class="tbltext" tabindex="0" maxlength="5" onchange="piupschk();" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="68" align="right"  valign="middle" class="tblheading" >Quantity&nbsp;</td>
<td width="169" colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="10" class="tbltext" tabindex="0" maxlength="7" onchange="piqtychk(this.value);" onkeypress="return isNumberKey(event)" />&nbsp;<font color="#FF0000">*</font></td>
         </tr>
</table><input type="hidden" name="trid" value="<?php echo $trid?>" />
<input type="hidden" name="qr_ids" id="qr_ids" value="" />
<input type="hidden" name="scanned_qr_ids" value="" />
<br />
<div id="subdiv">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
 <td colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
 <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
 <td colspan="2" align="center" valign="middle" class="tblheading">Action</td>
</tr>
<tr class="tblsubtitle" height="20">
<td width="120" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
<td width="80" align="center" valign="middle" class="tblheading">Qty</td>
<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
<td width="80" align="center" valign="middle" class="tblheading">Qty</td>
<td width="70" align="center" valign="middle" class="tblheading">UPS</td>
<td width="80" align="center" valign="middle" class="tblheading">Qty</td>
<td width="50" align="center" valign="middle" class="tblheading">Edit</td>
<td width="50" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
<input type="hidden" name="srno" value="" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;"  onclick="pform();" /></td>
</tr>
</table>
</div>
</div>
</div>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="select_transction_issue_internal.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;">&nbsp;&nbsp;</td>
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
