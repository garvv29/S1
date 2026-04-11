var xmlHttp;
var currentClassificationType = "";

// Function to check and update Generate QR visibility (GLOBAL SCOPE)
function checkGenerateQRVisibility() {
	var upsValue = parseInt(jQuery('input[name="txtupsg"]').val()) || 0;
	var classType = currentClassificationType.trim().toLowerCase();
	var isRoll = (classType === 'roll' || classType === 'roll plain');
	
	console.log('Check QR: Classification=' + classType + ' | UPS=' + upsValue + ' | Show=' + (isRoll && upsValue > 0));
	
	if(isRoll && upsValue > 0) {
		jQuery('#generateQR').show();
	} else {
		jQuery('#generateQR').hide();
	}
}

// Direct function to open Generate QR window
function openGenerateQR() {
	var classificationId = jQuery('select[name="txtclass"]').val();
	var itemId = jQuery('select[name="txtitem"]').val();
	var upsGood = jQuery('input[name="txtupsg"]').val();
	
	if(!classificationId || !itemId || !upsGood || upsGood <= 0) {
		alert('Please fill all required fields first');
		return false;
	}
	
	var arrivalId = jQuery('input[name="maintrid"]').val() || 0;
	var arrsubId = jQuery('input[name="subtrid"]').val() || 0;
	
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
	jQuery.ajax({
		url: 'get_qr_total_weight.php',
		type: 'GET',
		data: { 
			classification_id: classificationId,
			item_id: itemId
		},
		success: function(response) {
			console.log('QR total weight response:', response);
			try {
				var data = JSON.parse(response);
				if(data.success && data.total_weight) {
					// Set quantity_good field
					jQuery('input[name="txtqtyg"]').val(data.total_weight);
					console.log('Quantity Good updated to:', data.total_weight);
					
					// If classification type is "roll", make it read-only
					if(currentClassificationType.trim().toLowerCase() === 'roll' || 
					   currentClassificationType.trim().toLowerCase() === 'roll plain') {
						jQuery('input[name="txtqtyg"]').attr('readonly', true).css('background-color', '#CCCCCC');
						console.log('Quantity Good set to read-only for Roll');
					}
				}
			} catch(e) {
				console.log('Error parsing QR weight response:', e);
			}
		},
		error: function(xhr, status, error) {
			console.log('Error fetching QR total weight:', error);
		}
	});
}

// Direct function to get classification type from AJAX
function getClassificationType(classificationId) {
	console.log('Getting classification type for:', classificationId);
	
	if(classificationId !== '') {
		jQuery.ajax({
			url: 'getuser_classificationtype.php',
			type: 'GET',
			data: { a: classificationId },
			success: function(response) {
				currentClassificationType = response.trim();
				console.log('Classification type fetched:', currentClassificationType);
				checkGenerateQRVisibility();
			},
			error: function(xhr, status, error) {
				console.log('Failed to fetch classification:', error);
				currentClassificationType = "";
				jQuery('#generateQR').hide();
			}
		});
	} else {
		currentClassificationType = "";
		jQuery('#generateQR').hide();
	}
}

// Debug: Check jQuery availability
console.log('jQuery available?', typeof jQuery, typeof $);

// jQuery logic for Generate QR link
jQuery(document).ready(function($) {
	console.log('vaddresschk.js initialized');
	
	
	// Handle classification dropdown change
	$(document).on('change', 'select[name="txtclass"]', function() {
		var classificationId = $(this).val();
		console.log('Classification changed:', classificationId);
		
		if(classificationId !== '') {
			$.ajax({
				url: 'getuser_classificationtype.php',
				type: 'GET',
				data: { a: classificationId },
				success: function(response) {
					currentClassificationType = response.trim();
					console.log('Classification type:', currentClassificationType);
					checkGenerateQRVisibility();
				},
				error: function(xhr, status, error) {
					console.log('AJAX error:', error);
					currentClassificationType = "";
					$('#generateQR').hide();
				}
			});
		} else {
			currentClassificationType = "";
			$('#generateQR').hide();
		}
	});
	
	// Handle UPS Good input change
	$(document).on('input change', 'input[name="txtupsg"]', function() {
		console.log('UPS Good:', $(this).val());
		checkGenerateQRVisibility();
	});
	
	// Handle Generate QR click
	$(document).on('click', '#generateQR', function(e) {
		e.preventDefault();
		
		var classificationId = $('select[name="txtclass"]').val();
		var itemId = $('select[name="txtitem"]').val();
		var upsGood = $('input[name="txtupsg"]').val();
		
		if(!classificationId || !itemId || !upsGood || upsGood <= 0) {
			alert('Please fill all required fields first');
			return false;
		}
		
		var arrivalId = $('input[name="maintrid"]').val() || 0;
		var arrsubId = $('input[name="subtrid"]').val() || 0;
		
		var url = 'generate_qr_code.php?arrival_id=' + arrivalId + '&arrsub_id=' + arrsubId + 
				  '&classification_id=' + classificationId + '&item_id=' + itemId + '&ups_good=' + upsGood;
		
		console.log('Opening QR generator:', url);
		window.open(url, 'generateQR', 'width=1200,height=800,scrollbars=yes,resizable=yes');
	});
});

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
var url="getuser_vaddresschk.php";
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
var url="getuser_vedtsubform.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mform")
{ 
var url="getuser_vupdateform.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformsubedt")
{ 
var url="getuser_veditsubupdate.php";
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
var url="getuser_vdelete.php";
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
 
 // Extract and update arrival_id and arrsub_id in main form
 var arrivalIdElem = document.getElementById('response_arrival_id');
 var arrsubIdElem = document.getElementById('response_arrsub_id');
 if(arrivalIdElem && arrivalIdElem.value) {
   var arr_id = arrivalIdElem.value;
   if(document.frmaddDepartment.maintrid) {
     document.frmaddDepartment.maintrid.value = arr_id;
     console.log('Updated maintrid to: ' + arr_id);
   }
 }
 if(arrsubIdElem && arrsubIdElem.value && arrsubIdElem.value != '0') {
   var arrsub_id = arrsubIdElem.value;
   if(document.frmaddDepartment.subtrid) {
     document.frmaddDepartment.subtrid.value = arrsub_id;
     console.log('Updated subtrid to: ' + arrsub_id);
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