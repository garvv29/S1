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

if(tp=="item")
{
var url="getuser_ipiitemdrop.php";
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

if(tp=="mformsubedt")
{
var url="getuser_edit.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subformedt")
{ 
var url="edit_indents.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="mform")
{ 
var url="getuser_indentupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="eirdelete")
{
var url="getuser_eirdelete.php";
url=url+"?a="+str;
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
	 //alert(showUser.el);
 document.getElementById(showUser.el).innerHTML=xmlHttp.responseText ;
 
 // Extract Transaction ID from AJAX response for indent update (mform)
 if(showUser.el == 'ind' && xmlHttp.responseText.indexOf('TRANSACTION_ID:') > -1) {
 	var responseText = xmlHttp.responseText;
 	var startIdx = responseText.indexOf('TRANSACTION_ID:') + 'TRANSACTION_ID:'.length;
 	var endIdx = responseText.indexOf(':END_TRANSACTION_ID', startIdx);
 	if(startIdx > -1 && endIdx > startIdx) {
 		var transactionId = responseText.substring(startIdx, endIdx).trim();
 		if(transactionId && transactionId > 0) {
 			// Update the hidden maintrid field in the form
 			if(document.getElementsByName('maintrid')[0]) {
 				document.getElementsByName('maintrid')[0].value = transactionId;
 				console.log('Indent Transaction ID updated to:', transactionId);
 			}
 		}
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