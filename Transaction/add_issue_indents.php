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
	
	//$logid=22;
	
	if(isset($_REQUEST['tid']))
	{
	$tid = $_REQUEST['tid'];
	}
	
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{	
		$p_id=trim($_POST['trid']);
		$tid=trim($_POST['tid']);
		$remarks=trim($_POST['txtremarks']);
		$raisedby=trim($_POST['raisedby']);
		$remarks=str_replace("&","and",$remarks);
		echo "<script>window.location='add_issue_eindents_preview.php?p_id=$p_id&tid=$tid&remarks=$remarks&raisedby=$raisedby'</script>";	
	}
	
$a="TIE";
	$s_chk=mysql_query("SELECT * FROM tblissue where yearcode='$yearid_id' and issue_type='eindent'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(issue_code) FROM tblissue where yearcode='$yearid_id' and issue_type='eindent' ORDER BY issue_code DESC";
	else
	$sql_code="SELECT MAX(issue_code) FROM tblissue where issue_type='eindent' and yearcode='$yearid_id' ORDER BY issue_code DESC";
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
			$code1=$a.$code."/".$yearid_id."/".$lgnid;		}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Transction Issue- Indents </title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="issue.js"></script>
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
<script language="JavaScript">
function editrec(edtid)
{
//alert(edtid);
showUser(edtid,'subdiv','etdshow','','','','','');
}

function editrecord(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'subdiv','etdrec','','','','','');
}
function modetchk(classi)
{
showUser(classi,'item','indents','','','','','');

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
//document.frmaddDepartment.txtitem.
document.frmaddDepartment.txtclass.focus();
}
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57))
            return false;

         return true;
      }

// ===== QR SCANNING WORKFLOW FOR ROLL CLASSIFICATION =====
var currentEditRowData = {
	classification_id: '',
	item_id: '',
	classification_type: ''
};

var qrScanWindow = null;

// Initialize QR scanning when page loads
document.addEventListener('DOMContentLoaded', function() {
	observeEditFormLoaded();
}, false);

// Also try to initialize immediately (in case DOMContentLoaded already fired)
if(document.readyState === 'loading') {
	// Page still loading
} else {
	// Page already loaded
	observeEditFormLoaded();
}

function observeEditFormLoaded() {
	var subdiv = document.getElementById('subdiv');
	if(subdiv) {
		// Use MutationObserver to detect when form content is injected
		try {
			var observer = new MutationObserver(function(mutations) {
				setTimeout(function() {
					checkAndSetupQRScanning();
				}, 300);
			});
			
			observer.observe(subdiv, {
				childList: true,
				subtree: true,
				characterData: false
			});
		} catch(e) {
			console.log('MutationObserver error:', e);
		}
	}
}

function checkAndSetupQRScanning() {
	var classField = document.getElementsByName('classid');
	var itemField = document.getElementsByName('itemid');
	
	console.log('QR Debug: classField.length =', classField.length, ', itemField.length =', itemField.length);
	
	if(classField.length > 0 && itemField.length > 0) {
		var classId = classField[classField.length - 1].value;
		var itemId = itemField[itemField.length - 1].value;
		
		console.log('QR Debug: classId =', classId, ', itemId =', itemId);
		
		if(classId && itemId && classId !== '' && itemId !== '') {
			currentEditRowData.classification_id = classId;
			currentEditRowData.item_id = itemId;
			
			console.log('QR Debug: Checking classification type for classId', classId);
			checkClassificationTypeForQR(classId);
		}
	}
}

function checkClassificationTypeForQR(classificationId) {
	var xhr = new XMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if(xhr.readyState === 4) {
			if(xhr.status === 200) {
				var classType = xhr.responseText.trim();
				console.log('QR Debug: Classification type received:', classType);
				currentEditRowData.classification_type = classType;
				
				if(classType === 'Roll') {
					console.log('QR Debug: Classification is Roll! Setting up UI...');
					setupQRScanningUI();
				} else {
					console.log('QR Debug: Classification is NOT Roll, hiding QR UI');
					removeQRScanningUI();
				}
			} else {
				console.log('QR Debug: AJAX error status:', xhr.status);
			}
		}
	};
	
	xhr.open('GET', 'getuser_issueindent_classtype.php?classification_id=' + encodeURIComponent(classificationId), true);
	xhr.send(null);
}

function setupQRScanningUI() {
	// We need to find the TABLE that CONTAINS issueups fields
	// There are multiple tables - first one has header info (txtdate, indentno, etc)
	// Second one has issueups_1, issueups_2, etc. - THAT'S the one we need!
	
	console.log('QR Debug: Looking for table with issueups fields...');
	
	var allTables = document.querySelectorAll('table[border="1"]');
	console.log('QR Debug: Found', allTables.length, 'tables with border=1');
	
	var formTable = null;
	
	// Find the table that actually has issueups fields
	for(var t = 0; t < allTables.length; t++) {
		var issueUpsFieldsInTable = allTables[t].querySelectorAll('input[name^="issueups_"]');
		console.log('QR Debug: Table', t, 'has', issueUpsFieldsInTable.length, 'issueups fields');
		
		if(issueUpsFieldsInTable.length > 0) {
			formTable = allTables[t];
			console.log('QR Debug: FOUND THE RIGHT TABLE - Table index:', t);
			break;
		}
	}
	
	if(formTable) {
		console.log('QR Debug: Form table found, attaching event listeners...');
		
		// List all fields in this table for debugging
		var allInputsInTable = formTable.querySelectorAll('input[type="text"]');
		console.log('QR Debug: Total text input fields in DATA table:', allInputsInTable.length);
		for(var i = 0; i < allInputsInTable.length && i < 15; i++) {
			console.log('QR Debug: Field', i, ':', allInputsInTable[i].name, '=', allInputsInTable[i].value);
		}
		
		// Listen for ALL input changes within the table
		formTable.addEventListener('change', function(e) {
			console.log('QR Debug: CHANGE EVENT on:', e.target.name, 'value:', e.target.value);
			if(e.target && e.target.name && e.target.name.match(/^issueups_/)) {
				console.log('QR Debug: MATCHED issueups field:', e.target.name);
				handleQRUpsFieldChange(e.target);
			}
		}, false);
		
		formTable.addEventListener('keyup', function(e) {
			if(e.target && e.target.name && e.target.name.match(/^issueups_/)) {
				console.log('QR Debug: KEYUP on issueups field:', e.target.name, 'value:', e.target.value);
				handleQRUpsFieldChange(e.target);
			}
		}, false);
		
		console.log('QR Debug: Event delegation setup complete - listening to correct table');
	} else {
		console.log('QR Debug: ERROR - NO table found with issueups fields!');
	}
}

function handleQRUpsFieldChange(upsField) {
	console.log('QR Debug: *** handleQRUpsFieldChange CALLED ***');
	
	var upsValue = parseInt(upsField.value) || 0;
	var fieldName = upsField.name;
	
	console.log('QR Debug: handleQRUpsFieldChange() for', fieldName, 'value:', upsValue);
	console.log('QR Debug: currentEditRowData.classification_type =', currentEditRowData.classification_type);
	
	// Get existing button or create new one
	var buttonId = 'qr-scan-button-' + fieldName;
	var existingButton = document.getElementById(buttonId);
	
	if(upsValue > 0 && currentEditRowData.classification_type === 'Roll') {
		console.log('QR Debug: Creating button - UPS > 0 AND classification is Roll');
		if(!existingButton) {
			// Create button for this field
			var buttonContainer = document.createElement('div');
			buttonContainer.id = 'qr-button-container-' + fieldName;
			buttonContainer.style.marginTop = '5px';
			buttonContainer.style.padding = '3px';
			buttonContainer.style.backgroundColor = '#ffffcc';
			buttonContainer.style.border = '1px solid #cccc00';
			buttonContainer.style.borderRadius = '3px';
			buttonContainer.innerHTML = '<a id="' + buttonId + '" href="javascript:openQRScanInterface();" style="color: #0066cc; text-decoration: underline; cursor: pointer; font-weight: bold; font-size: 11px;">→ Scan QR</a>';
			
			upsField.parentNode.appendChild(buttonContainer);
			console.log('QR Debug: Button created for', fieldName);
		}
	} else {
		console.log('QR Debug: NOT creating button - UPS=' + upsValue + ', classification=' + currentEditRowData.classification_type);
		if(existingButton) {
			existingButton.parentNode.parentNode.style.display = 'none';
			console.log('QR Debug: Button hidden for', fieldName);
		}
	}
}

function removeQRScanningUI() {
	console.log('QR Debug: removeQRScanningUI() called');
}

function openQRScanInterface() {
	if(!currentEditRowData.classification_id || !currentEditRowData.item_id) {
		alert('Classification and Item information not found. Please refresh and try again.');
		return false;
	}
	
	// Find the last issueups field that has focus or value
	var upsFields = document.querySelectorAll('input[name^="issueups_"]');
	var ups = 0;
	
	if(upsFields.length > 0) {
		// Get the last one (most recent row)
		ups = parseInt(upsFields[upsFields.length - 1].value) || 0;
	}
	
	if(ups <= 0) {
		alert('Please enter UPS (Units) value first.');
		return false;
	}
	
	console.log('QR Debug: Opening QR scan with classification_id:', currentEditRowData.classification_id, ', item_id:', currentEditRowData.item_id, ', ups:', ups);
	
	var url = 'scan_qrcode_indent.php?classification_id=' + currentEditRowData.classification_id 
		      + '&item_id=' + currentEditRowData.item_id 
		      + '&ups=' + ups 
		      + '&timestamp=' + Date.now();
	
	qrScanWindow = window.open(url, 'QRScan_' + Date.now(), 'width=950,height=750,scrollbars=yes,resizable=yes');
	
	if(window.focus) {
		qrScanWindow.focus();
	}
	
	// Monitor window close and check for sessionStorage data
	var closeCheckInterval = setInterval(function() {
		if(qrScanWindow.closed) {
			clearInterval(closeCheckInterval);
			
			// Check for stored weight in sessionStorage
			try {
				var storedWeight = sessionStorage.getItem('qr_total_weight_indent');
				var timestamp = sessionStorage.getItem('qr_total_weight_timestamp');
				
				if(storedWeight && timestamp) {
					// Verify timestamp is recent (within 5 seconds)
					if((Date.now() - parseInt(timestamp)) < 5000) {
						setQRTotalWeight(parseFloat(storedWeight));
						sessionStorage.removeItem('qr_total_weight_indent');
						sessionStorage.removeItem('qr_total_weight_timestamp');
					}
				}
			} catch(e) {
				console.log('SessionStorage error:', e);
			}
		}
	}, 500);
	
	return false;
}

function setQRTotalWeight(totalWeight) {
	// Find the issueqty field for the current row and set it
	// Need to find which row was being edited (the last one with focus)
	
	var qtyFields = document.querySelectorAll('input[name^="issueqty_"]');
	
	if(qtyFields.length > 0) {
		// Get the last issueqty field (most recent row)
		var lastQtyField = qtyFields[qtyFields.length - 1];
		lastQtyField.value = totalWeight;
		lastQtyField.readOnly = true;
		lastQtyField.style.backgroundColor = '#CCCCCC';
		
		console.log('QR Debug: Quantity field populated:', lastQtyField.name, '=', totalWeight);
		
		// Show success feedback
		alert('QR codes scanned successfully!\n\nTotal Weight: ' + totalWeight + '\n\nQuantity field has been populated and locked.');
	} else {
		console.log('QR Debug: No issueqty fields found');
		alert('Could not populate quantity field. Total Weight: ' + totalWeight);
	}
}

// ===== END QR SCANNING WORKFLOW =====


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
document.getElementById(b).value=parseInt(document.getElementById(a).value,10)-parseInt(fid,10);
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
			else
			{
			var c="qtyavl_"+qval;
			var d="balqty_"+qval;
			document.getElementById(d).value=parseFloat(document.getElementById(c).value)-parseFloat(qid);
			}
}

function pform()
{
	document.frmaddDept.chkbox.value="";
	document.frmaddDept.srno1.value="";
	//alert(document.frmaddDept.srno.value);
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
			var z2="upsavl_"+val[i];
			var z3="qtyavl_"+val[i];
			var z4="issueups_"+val[i];
			var z5="issueqty_"+val[i];
			var z="balups_"+val[i];
			var z1="balqty_"+val[i];
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
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.tt.value=a;
		showUser(a,'maindiv','mform','','','','','');
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
			var z2="upsavl_"+val[i];
			var z3="qtyavl_"+val[i];
			var z4="issueups_"+val[i];
			var z5="issueqty_"+val[i];
			var z="balups_"+val[i];
			var z1="balqty_"+val[i];
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
	}

		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.frmaddDept.tt.value=a;
		showUser(a,'maindiv','mformupdate','','','','','');
}
}
function mySubmit()
{ 	
if(document.frmaddDept.txtdate.value=="00-00-0000" || document.frmaddDept.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDept.txtdate.focus();
		return false;
	}
if(document.frmaddDept.trid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
document.frmaddDept.submit();
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
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="stores_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;"></a>Transction Issue - Internal Issue - e-Indents </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysql_query("select * from tbl_ieindent where tid=$tid")or die(mysql_error());
    $row=mysql_fetch_array($sql1);
	$trid=0; $erid=0;
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input name="code" type="hidden" value="<?php echo $code;?>" />
	<input name="tid" type="hidden" value="<?php echo $tid;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Internal Issue - e-Indents </td>
</tr>
  <tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
    $tdate=$row['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
    // Get the raised by name from the indent creator's ID
    $raisedby_id = isset($row['id']) ? $row['id'] : $loginid;
    $resettargetquery=mysql_query("select * from tbl_roles where id='".$raisedby_id."'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>

	
	 <tr class="Dark" height="30">
	 <td width="205" align="right" valign="middle" class="tblheading">Transaction ID ��</td>
<td width="215"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="193" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="227"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" maxlength="10"/></td>
</tr>

<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Indent Number&nbsp;</td>
<td width="215"  align="left" valign="middle" class="tbltext">&nbsp;<input name="indentno" type="text" size="5" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC" value="<?php echo $row['code'];?>"  />&nbsp; </td>

<td width="193" align="right" valign="middle" class="tblheading">Raised by&nbsp;</td>
<td width="227" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="raisedby" type="text" size="15" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="<?php echo $resetresult['name'];?>" />&nbsp; </td>
</tr>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Indent�Date�&nbsp;</td>
<td width="215"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="indentdate" type="text" size="10" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="<?php echo $tdate;?>"/></td>
<input name="issuedate" type="hidden" size="10" class="tbltext" tabindex="0"  readonly="true" style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>"/>
</tr>
</table>
</br>
<div id="maindiv">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="13%" rowspan="2" align="center" valign="middle" class="tblheading">Item</td>
			   <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">UoM</td>
			    <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">As Per Indent Qty</td>
			     <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Stock</td>
                  <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Issue</td>
               <td colspan="2" height="23" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              </tr>

			<tr class="tblsubtitle">
                    <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
					 <td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
                   <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
				   <td width="5%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
<?php
$sr=1; $opups=0;  $opqty=0; $opups1="";  $opqty1=""; $t_stldg1=0;
$sql_eindent_sub=mysql_query("select * from tbl_ieindent_sub where id_in=$tid") or die(mysql_error());
while($row_eindent_sub=mysql_fetch_array($sql_eindent_sub))
{
$classqry=mysql_query("select classification_id, classification from tbl_classification where classification_id='".$row_eindent_sub['classification_id']."'") or die(mysql_error());
$noticia_class = mysql_fetch_array($classqry);

$itemqry=mysql_query("select items_id, stores_item from tbl_stores where items_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$noticia_item = mysql_fetch_array($itemqry);

if($trid > 0)
{
$sql_tblissue=mysql_query("select * from tblissue_sloc where issue_tr_id='".$trid."' and classification_id='".$row_eindent_sub['classification_id']."' and item_id='".$row_eindent_sub['items_id']."'") or die(mysql_error());
$tot_tblissue=mysql_num_rows($sql_tblissue);
$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; $t_stldg1=0;

while($row_tblissue=mysql_fetch_array($sql_tblissue))
{


$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_tblissue['subbin']."' and binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_tblissue['ups_issue'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_tblissue['qty_issue'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$balups+$row_tblissue['ups_balance'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";
$balqty=$balqty+$row_tblissue['qty_balance'];
if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_tblissue['issue_rowid']."'") or die(mysql_error());
$row_stldg1=mysql_fetch_array($sql_stldg1); 
$t_stldg1=mysql_num_rows($sql_stldg1);

$opups=$opups+$row_stldg1['stlg_balups'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$opqty+$row_stldg1['stlg_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['issue_id'];
}
}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $$opqty1=""; $erid=0;
}
if($sr%2!=0)
{
?>
<tr class="Dark" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="5%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty']?></td>
               <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $opups;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php if($t_stldg1!=0){ ?><?php echo $opqty;?><?php }else{ ?> <?php } ?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slqty;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balqty;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="tbltext" align="center"><?php if($t_stldg1==0){ ?><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['eid'];?>);" /><?php } else { ?><img src="../images/edit.png" border="0" style="display:inline;cursor:pointers;" onclick="editrecord(<?php echo $erid;?>);" /><?php } ?></td>
  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
<?php
}
else
{
?>			  
<tr class="Light" height="25">
              <td align="center" class="smalltbltext" valign="middle"><?php echo $sr;?></td>
              <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_class['classification'];?></td>
			  <td align="center" class="smalltbltext" valign="middle"><?php echo $noticia_item['stores_item'];?></td>
			  <td align="center" width="5%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['uom']?></td>
              <td align="center" width="6%" class="smalltbltext" valign="middle"><?php echo $row_eindent_sub['qty']?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $opups;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="smalltbltext" align="center"><?php if($t_stldg1!=0){ ?><?php echo $opqty;?><?php }else{ ?> <?php } ?></td>
              <td width="4%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $slqty;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balups;?><?php }else{ ?> <?php } ?></td>
              <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($t_stldg1!=0){ ?><?php echo $balqty;?><?php }else{ ?> <?php } ?></td>
              <td valign="middle" class="tbltext" align="center"><?php if($t_stldg1==0){ ?><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['eid'];?>);" /><?php } else { ?><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /><?php } ?></td>
  </tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['eid'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>

</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="25">
<td width="102" align="right"  valign="middle" class="tblheading">&nbsp;Indent Remarks&nbsp;</td>
<td width="742" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['remarks']?></td>
</tr>
</table>
<input type="hidden" name="trid" value="<?php echo $trid?>" />
<input type="hidden" name="raisedby" value="<?php echo $resetresult['name'];?>" />
<br />
<div id="subdiv">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >

<tr class="Light" height="30">
<td width="132" align="right" valign="middle" class="tblheading">Classification&nbsp;</td>
      <td width="341"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid" type="text" size="35" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" /><input type="hidden" name="classid" value="" /></td>

<td width="92" align="right" valign="middle" class="tblheading">Items&nbsp;</td>
      <td width="275" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtid" type="text" size="35" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" />&nbsp;<input type="hidden" name="itemid" value="" /> </td>

</tr>

<tr class="Light" height="30">

<td width="132" align="right" valign="middle" class="tblheading">&nbsp;UoM&nbsp;</td>
      <td width="341"  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtid" type="text" size="10" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" /></td>
<td align="right" valign="middle" class="tblheading">Quantity&nbsp;</td>
      <td  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtid" type="text" size="5" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="" /></td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="20">

 <td colspan="4" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading">Select</td>
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
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:hand;"  onclick="pform();" /></td>
</tr>
</table>
</div>
</div>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="99" align="right"  valign="middle" class="tblheading">&nbsp;Issuer Remarks&nbsp;</td>
<td width="745" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="100" value="" ></td>
</tr>
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<td valign="top" align="right"><a href="add_issue_indents1.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="mySubmit();return false;"  border="0" style="display:inline;cursor:hand;">&nbsp;&nbsp;</td>
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
