var xmlHttp

function showUser(str,el,tp,d,e,i,j,k)
{ showUser.el=el; //alert(d);
//alert(showUser.el);
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }

if(tp=="vendor")
{
var url="getuser_vaddresschk.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="etdshow")
{ 

//alert(str);
var url="getuser_issue_eindent_etd.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="etdrec")
{
var url="getuser_issue_eindent_etdrec.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="edtrecpi")
{
var url="getuser_issue_pindent_etdrec.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="edtrecstr")
{
var url="getuser_issue_str_etdrec.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="edtrecmrtv")
{
var url="getuser_issue_mrtv_etdrec.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


if(tp=="mformupdate")
{ 
//alert(str);
var url="getuser_issue_eindentedtupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformpiupdate")
{ 
//alert(str);
var url="getuser_issue_pindentedtupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformstrupdate")
{ 
//alert(str);
var url="getuser_issue_stredtupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformmrtvupdate")
{ 
//alert(str);
var url="getuser_issue_mrtvedtupdate.php";
url=url+"?"+str; 
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

if(tp=="slocshow")
{ 
//alert(str);
var url="getuser_issue_pindent_slocshow.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="slocshowmrv")
{
	//alert(str);
var url="getuser_issue_mretv_slocshow.php";
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
if(tp=="mform")
{ //alert(str);
var url="getuser_issue_eindentupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="mformpi")
{ //alert(str);
var url="getuser_issue_pindentupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformstr")
{ //alert(str);
var url="getuser_issue_strupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformmrtv")
{ //alert(str);
var url="getuser_issue_mrtvupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="pidelete")
{
var url="getuser_issue_pindentdelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="eidelete")
{
var url="getuser_issue_eindentdelete.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="strdelete")
{
var url="getuser_issue_strdelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mrtvdelete")
{
var url="getuser_issue_mrtvdelete.php";
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
 
 // Extract Transaction ID from response for mformupdate (eindent update)
 if(showUser.el == 'maindiv' && xmlHttp.responseText.indexOf('TRANSACTION_ID:') > -1) {
 	var responseText = xmlHttp.responseText;
 	var startIdx = responseText.indexOf('TRANSACTION_ID:') + 'TRANSACTION_ID:'.length;
 	var endIdx = responseText.indexOf(':END_TRANSACTION_ID', startIdx);
 	if(startIdx > -1 && endIdx > startIdx) {
 		var transactionId = responseText.substring(startIdx, endIdx).trim();
 		if(transactionId && transactionId > 0) {
 			// Update the hidden trid field in the form
 			if(document.getElementsByName('trid')[0]) {
 				document.getElementsByName('trid')[0].value = transactionId;
 				console.log('Transaction ID updated to:', transactionId);
 			}
 		}
 	}
 }
 }
 } 
}

// QR Scanning from SLOC Edit Page (Physical Indent)
function openQRScanPopupEdit(srno, classid, itemid)
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

// Handle QR popup return with total weight (from SLOC edit page)
function setQRTotalWeightEdit(totalWeight, qrIdList)
{
	var srno = window.currentQRRowNum;
	if(srno)
	{
		// Auto-populate Qty field with total weight
		document.getElementById('issueqty_' + srno).value = totalWeight;
		// Make it read-only
		document.getElementById('issueqty_' + srno).readOnly = true;
		document.getElementById('issueqty_' + srno).style.backgroundColor = '#CCCCCC';
		
		// Store QR IDs in a hidden field for this row
		var hiddenFieldName = 'scanned_qr_ids_' + srno;
		var existingField = document.getElementById(hiddenFieldName);
		if(!existingField)
		{
			//Create hidden field if it doesn't exist
			existingField = document.createElement('input');
			existingField.type = 'hidden';
			existingField.id = hiddenFieldName;
			existingField.name = hiddenFieldName;
			document.body.appendChild(existingField);
		}
		
		if(qrIdList && qrIdList.length > 0)
		{
			var qrIdString = qrIdList.join(',');
			existingField.value = qrIdString;
			console.log('QR IDs stored for row ' + srno + ':', qrIdString);
		}
		
		// Show confirmation
		alert('✓ QR Scan Complete\nTotal Weight: ' + totalWeight);
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