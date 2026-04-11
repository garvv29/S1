var xmlHttp
var currentClassificationType = "";

// Function to check and update Generate QR visibility (GLOBAL SCOPE)
function checkGenerateQRVisibility() {
	// Try to get UPS value from injected form first, then main form
	var upsInput = document.querySelector('input[name="txtupsg"]');
	var upsValue = 0;
	if(upsInput) {
		upsValue = parseInt(upsInput.value) || 0;
	}
	
	var classType = currentClassificationType.trim().toLowerCase();
	var isRoll = (classType === 'roll' || classType === 'roll plain');
	
	console.log('Check QR: Classification=' + classType + ' | UPS=' + upsValue + ' | Show=' + (isRoll && upsValue > 0));
	
	// Find generateQR link in the document
	var generateQRLink = document.getElementById('generateQR');
	if(generateQRLink) {
		if(isRoll && upsValue > 0) {
			generateQRLink.style.display = 'inline';
			console.log('Generate QR link shown');
		} else {
			generateQRLink.style.display = 'none';
			console.log('Generate QR link hidden');
		}
	} else {
		console.log('Generate QR link element not found');
	}
}

// Direct function to open Generate QR window
function openGenerateQR() {
	// Get values from injected form using querySelector
	var classSelect = document.querySelector('select[name="txtclass"]');
	var itemSelect = document.querySelector('select[name="txtitem"]');
	var upsInput = document.querySelector('input[name="txtupsg"]');
	
	// Fallback to form if querySelector doesn't find them
	if(!classSelect && document.frmaddDepartment && document.frmaddDepartment.txtclass) {
		classSelect = document.frmaddDepartment.txtclass;
	}
	if(!itemSelect && document.frmaddDepartment && document.frmaddDepartment.txtitem) {
		itemSelect = document.frmaddDepartment.txtitem;
	}
	if(!upsInput && document.frmaddDepartment && document.frmaddDepartment.txtupsg) {
		upsInput = document.frmaddDepartment.txtupsg;
	}
	
	var classificationId = classSelect ? classSelect.value : '';
	var itemId = itemSelect ? itemSelect.value : '';
	var upsGood = upsInput ? upsInput.value : '';
	
	console.log('OpenQR attempt: class=' + classificationId + ', item=' + itemId + ', ups=' + upsGood);
	
	if(!classificationId || !itemId || !upsGood || upsGood <= 0) {
		alert('Please fill all required fields first');
		return false;
	}
	
	// Get arrival/arrsub IDs
	var arrivalIdInput = document.querySelector('input[name="maintrid"]');
	var arrsubIdInput = document.querySelector('input[name="subtrid"]');
	var arrivalId = arrivalIdInput ? arrivalIdInput.value : 0;
	var arrsubId = arrsubIdInput ? arrsubIdInput.value : 0;
	
	// Fallback to main form
	if(!arrivalId && document.frmaddDepartment && document.frmaddDepartment.maintrid) {
		arrivalId = document.frmaddDepartment.maintrid.value;
	}
	if(!arrsubId && document.frmaddDepartment && document.frmaddDepartment.subtrid) {
		arrsubId = document.frmaddDepartment.subtrid.value;
	}
	
	var url = 'generate_qr_code.php?arrival_id=' + arrivalId + '&arrsub_id=' + arrsubId + 
			  '&classification_id=' + classificationId + '&item_id=' + itemId + '&ups_good=' + upsGood;
	
	console.log('Opening QR: ' + url);
	var qrWindow = window.open(url, 'generateQR', 'width=1200,height=800,scrollbars=yes,resizable=yes');
	
	// Check if QR window is closed and fetch total weight
	if(qrWindow) {
		var checkClosed = setInterval(function() {
			if(qrWindow.closed) {
				clearInterval(checkClosed);
				// Popup closed, fetch and update quantity_good
				fetchQRTotalWeight(classificationId, itemId);
			}
		}, 500);
	}
	
	return false;
}

// Fetch total weight from QRs and populate quantity_good field
function fetchQRTotalWeight(classificationId, itemId) {
	var xmlhttp = GetXmlHttpObject();
	if(xmlhttp == null) {
		console.log('Failed to create XMLHttpRequest object');
		return;
	}
	
	var url = 'get_qr_total_weight.php?classification_id=' + classificationId + '&item_id=' + itemId + '&sid=' + Math.random();
	
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4) {
			if(xmlhttp.status == 200) {
				console.log('QR total weight response:', xmlhttp.responseText);
				try {
					var data = JSON.parse(xmlhttp.responseText);
					if(data.success && data.total_weight) {
						// Find quantity_good field from injected form
						var qtyInput = document.querySelector('input[name="txtqtyg"]');
						if(!qtyInput && document.frmaddDepartment && document.frmaddDepartment.txtqtyg) {
							qtyInput = document.frmaddDepartment.txtqtyg;
						}
						
						if(qtyInput) {
							qtyInput.value = data.total_weight;
							console.log('Quantity Good updated to:', data.total_weight);
							
							// If classification type is "roll", make it read-only
							if(currentClassificationType.toLowerCase().indexOf('roll') > -1) {
								qtyInput.readOnly = true;
								qtyInput.style.backgroundColor = '#CCCCCC';
								console.log('Quantity Good set to read-only for Roll');
							}
						}
					}
				} catch(e) {
					console.log('Error parsing QR weight response:', e);
				}
			}
		}
	};
	
	xmlhttp.open('GET', url, true);
	xmlhttp.send(null);
}

// Direct function to get classification type from AJAX
function getClassificationType(classificationId) {
	console.log('Getting classification type for:', classificationId);
	
	if(classificationId !== '') {
		var xmlhttp = GetXmlHttpObject();
		if(xmlhttp == null) {
			console.log('Failed to create XMLHttpRequest object');
			return;
		}
		
		var url = 'getuser_classificationtype.php?a=' + classificationId + '&sid=' + Math.random();
		
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4) {
				if(xmlhttp.status == 200) {
					currentClassificationType = xmlhttp.responseText.trim();
					console.log('Classification type fetched:', currentClassificationType);
					// Call checkGenerateQRVisibility to show/hide link
					checkGenerateQRVisibility();
				}
			}
		};
		
		xmlhttp.open('GET', url, true);
		xmlhttp.send(null);
	} else {
		currentClassificationType = "";
		var generateQRLink = document.getElementById('generateQR');
		if(generateQRLink) {
			generateQRLink.style.display = 'none';
		}
	}
}

function showUser(str,el,tp,d,e,i,j,k,trid)
{ showUser.el=el; //alert(d);
//alert(showUser.el);
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
 //alert(tp); 
if(tp=="vendor")
{
var url="getuser_imroaddresschk.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="item")
{
var url="getuser_vitemdrop.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="itemuom")
{
var url="getuser_vitemuom.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="wh")
{ 
var url="getuser_vbindrop.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="bin")
{ 
var url="getuser_vsbindrop.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subbin")
{ 
var url="getuser_vsbinck.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&g="+j;
url=url+"&h="+k; 
url=url+"&trid="+trid; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subbinv")
{ 
var url="getuser_arrv_sbinckv.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&g="+j;
url=url+"&h="+k; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subformedt")
{ 
var url="getuser_imroedtsubform.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="mform")
{ 
var url="getuser_imroupdateform.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="mformsubedt")
{ 
var url="getuser_imroeditsubupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


if(tp=="retnby")
{
var url="getuser_iretby.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="delete")
{
var url="getuser_imrodelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="slocshowsubgood")
{ 
var url="getuser_arrv_slocshowg.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&g="+j;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="slocshowsubdamage")
{
var url="getuser_arrv_slocshowd.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&g="+j;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

}




function stateChanged() 
{ 
if (xmlHttp.readyState==4 )
 { 
 if(xmlHttp.status == 200) {
	// alert(showUser.el);
 document.getElementById(showUser.el).innerHTML=xmlHttp.responseText ;
 
 // Extract response IDs from hidden fields if they exist
 var arrivalIdElem = document.getElementById('response_arrival_id');
 var arrsubIdElem = document.getElementById('response_arrsub_id');
 
 if(arrivalIdElem && arrsubIdElem) {
    var arr_id = arrivalIdElem.value || 0;
    var arsub_id = arrsubIdElem.value || 0;
    
    console.log('Extracted IDs: arrival_id=' + arr_id + ', arrsub_id=' + arsub_id);
    
    // Update main form's hidden arrival fields
    if(document.frmaddDepartment) {
        document.frmaddDepartment.maintrid.value = arr_id;
        document.frmaddDepartment.subtrid.value = arsub_id;
        document.frmaddDepartment.p_id.value = arr_id;
        console.log('Updated main form fields: maintrid=' + arr_id + ', subtrid=' + arsub_id);
    }
 }
 }
 } 
}

function GetXmlHttpObject()
{
var xmlHttp=null;

if (xmlHttp != null && xmlHttp.readyState != 0 && xmlHttp.readyState != 4)
 {
   xmlHttp.abort();
 } 
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

// jQuery event delegation for dynamically injected form elements
// This ensures Generate QR link visibility is checked even after form reload
$(document).ready(function() {
	// Monitor classification dropdown changes
	$(document).on('change', 'select[name="txtclass"]', function() {
		console.log('Classification changed:', $(this).val());
		getClassificationType($(this).val());
	});
	
	// Monitor UPS Good input changes - call checkGenerateQRVisibility
	$(document).on('input change', 'input[name="txtupsg"]', function() {
		console.log('UPS Good changed:', $(this).val());
		checkGenerateQRVisibility();
	});
	
	// Handle Generate QR click on dynamically injected link
	$(document).on('click', 'a#generateQR', function(e) {
		e.preventDefault();
		openGenerateQR();
		return false;
	});
});