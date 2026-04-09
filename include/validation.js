// This function accepts only alphabetic characters
// with white space as special character only 
	
	function MM_swapImgRestore() { //v3.0
	var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}
	
	function MM_preloadImages() { //v3.0
	var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
	var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
	if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}
	
	function MM_findObj(n, d) { //v4.01
	var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
	d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	if(!x && d.getElementById) x=d.getElementById(n); return x;
	}
	
	function MM_swapImage() { //v3.0
	var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
	if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}

	// allow charecter ,(,),&
	function isChar_Wand(Char) 
	{
		alert(char);
		var CharToChk = new String(Char);
		var LengthOfChar = CharToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfChar;i++)
		{
		if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122) && CharToChk.charCodeAt(i)!= 32 && CharToChk.charCodeAt(i)!= 28 && CharToChk.charCodeAt(i)!= 29 && CharToChk.charCodeAt(i)!= 26) {
		flag = false;
		break;
		}	
		}
		return flag;
	}
	function isNumeric(Str) 
	{
		var StringToChk = new String(Str);
		var LengthOfStr = StringToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfStr;i++)
		{
		if(StringToChk.charCodeAt(i)<48 || StringToChk.charCodeAt(i)>57) {
		flag = false;
		break;
		}	
		}
		return flag;
	}
	
	function deleteBlanks(entry)
	{
		var len = entry.length ;
		var foundBlank = 1;
		while(foundBlank == 1 && len > 0) 
		{
		var indx = entry.indexOf(" ");
		if(indx == -1) 
		foundBlank = 0 ;
		else
		entry = entry.substring(0,indx) + entry.substring(indx+1,len);
		len = entry.length;
		}
		return entry;
	}
	/*Function To Check Empty Textarea */	
	function isTextAreaEmpty(val,valName){
		var val1 = val.value;
		var len = val1.length;  
		v= "\r\n";
		for(i=0; i < (len/2); i++){
		v= v++;
		}	
		if (val1== v || deleteBlanks(val1)=='' || val1==' ') {
		alert(valName + " is required");
		return false;
		}
		else {
		return true;
		}
	}
	
	// function to check empty controls in the form
	function isEmpty(val,valName)
	{
		retVal = true;
		if (!deleteBlanks(val.value)) {
		alert(valName + " is required");
		val.focus();
		retVal = false;	
		}
		return retVal;
	}
	
	/*Function To Check Entered Data is number or not */
	function isNumber(val) {
		retVal = true;
		count=0;
		str = val.toString();
		for (i=0;i<str.length;i++) {
		ch = str.substr(i, 1);
		if (ch<"0" || ch>"9") {
		retVal = false;
		}
		}
		return retVal;
	}
	
	// function to check the emailid is valid or not<br>
	function isEmail(val) {
		retVal = true; 
		tmp = val.value;
		if (isEmpty(val,"Email Address")) {
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(tmp)){
		retVal = true;	
		}
		else{
		//alert("Email Address is invalid")
		val.focus();
		val.select();
		retVal = false;	
		}
		}
		else {
		retVal = false;
		}	
		return retVal;
	}
	
	
	// function to validate the length of zip code
	function isLength(zipVal){
		var str = zipVal.toString();
		var strLength = str.length;
		var retVal = false;
		while(1) {
		if (strLength>5) {
		return retVal;
		break;
		}
		retVal = true;
		break;
		}
		return retVal;
	}
	
	// function to check valid telephone number
	function isTel(val1,val2,val3,valName) {
		inv=0;
		v=val1.value+val2.value+val3.value;
		if (v!="") {
		if (v.length<10)
		inv=1;
		for (var i=0;i<v.length && inv==0;i++) {
		if ( v.charAt(i)<"0" || v.charAt(i)>"9")
		inv=1;
		}
		if (inv==1) {
		alert (valName + " is invalid")
		val1.focus();
		val1.select();
		return false;
		}
		}
		return true;
	}
	
	//alows only A-Z, 0-9 and spaces
	function isValidText(frmElement, fieldName) {
		myRegExp = new RegExp("[^a-z,0-9,\\s]", "i"); 
		if(myRegExp.test(frmElement.value)) {
		alert("Special characters not allowed in " + fieldName);
		frmElement.focus();
		frmElement.select();
		retVal = false;
		}
		else {
		retVal = true;
		}
		return retVal;
	}
	function isValidText1(frmElement, fieldName) {
		myRegExp = new RegExp("[^0-9,\\s]", "i"); 
		if(myRegExp.test(frmElement.value)) {
		alert("Special characters not allowed in " + fieldName);
		frmElement.focus();
		frmElement.select();
		retVal = false;
		}
		else {
		retVal = true;
		}
		return retVal;
	}
	
	//alows only A-Z and spaces
	function isValidCharSpace(frmElement, fieldName) {
		myRegExp = new RegExp("[^a-z,\\s]", "i"); 
		if(myRegExp.test(frmElement.value)) {
		alert("Only characters allowed in " + fieldName);
		frmElement.focus();
		frmElement.select();
		retVal = false;
		}
		else {
		retVal = true;
		}
		return retVal;
		}
	function isValidChar(frmElement) {
		myRegExp = new RegExp("[^a-z,\\s]", "i"); 
		if(myRegExp.test(frmElement.value)) {
		//alert("Only characters allowed in " + fieldName);
		frmElement.focus();
		frmElement.select();
		retVal = false;
		}
		else {
		retVal = true;
		}
		return retVal;
	}
	
	function capsDetect( e ) {
		//if the browser did not pass event information to the handler,
		//check in window.event
		if( !e ) { e = window.event; } if( !e ) { return; }
		//what (case sensitive in good browsers) key was pressed
		//this uses all three techniques for checking, just in case
		var theKey = 0;
		if( e.which ) { theKey = e.which; } //Netscape 4+, etc.
		else if( e.keyCode ) { theKey = e.keyCode; } //Internet Explorer, etc.
		else if( e.charCode ) { theKey = e.charCode } //Gecko - probably not needed
		//was the shift key was pressed
		var theShift = false;
		if( e.shiftKey ) { theShift = e.shiftKey; } //Internet Explorer, etc.
		else if( e.modifiers ) { //Netscape 4
		//check the third bit of the modifiers value (says if SHIFT is pressed)
		if( e.modifiers & 4 ) { //bitwise AND
		theShift = true;
		}
		}
		//if upper case, check if shift is not pressed
		if( theKey > 64 && theKey < 91 && !theShift ) {
		alert( 'Please off caps Lock key' );
		document.frmlogin.txtuser.value="";
		}
		//if lower case, check if shift is pressed
		else if( theKey > 96 && theKey < 123 && theShift ) {
		alert( 'Please off Caps Lock key' );
		document.frmlogin.txtuser.value="";
		}
	}
	function echeck(str) 
	{
		var at="@";
		var dot=".";
		var lat=str.indexOf(at);
		var lstr=str.length;
		var ldot=str.indexOf(dot);
		if (str.indexOf(at)==-1){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(at,(lat+1))!=-1){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(dot,(lat+2))==-1){
		alert("Invalid E-mail ID");
		return false;
		}
		if (str.indexOf(" ")!=-1){
		alert("Invalid E-mail ID");
		return false;
		}
		return true;					
		}
		
		function chkemail(s)
		{
		var f=s.split("@");
		if(f[1]=="vnrseeds.com")
		{
		return true;
		}
		else
		{
		return false;
		}
	}
	function Chkmail2()
	{
		oForm=document.forms["form1"]
		var objFrm = eval(oForm.email);
		if (objFrm.value=="")
		{
		alert("Please enter the email Address");
		objFrm.focus();
		return false;
		}
		else
		{
		if (objFrm.value.indexOf("@")==-1)
		{
		alert("Invalid email Address! No @ sign.");
		objFrm.focus();
		return false;
		}
		var arr=objFrm.value.split("@");
		if (arr[1].indexOf(".")==-1)
		{
		alert("Invalid email Address! No dot after @ sign.");
		objFrm.focus();
		return false;
		}
		}
		return true;
	}

	function isChar_W(Char) 
	{
		var CharToChk = new String(Char);
		var LengthOfChar = CharToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfChar;i++)
		{
			if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122) && CharToChk.charCodeAt(i)!= 32) {
			flag = false;
			break;
			}	
		}
		return flag;
	}
	
	// string "012545" converter to "12545"
function isZeroConverter(id)
{
	var obj=document.getElementById(id);
	var ext=document.getElementById(id).value;
	var strNumber = ext;
	if(strNumber.charCodeAt() == 32)
	{
	alert("Security Answer Should Not Start With Space ....");
	obj.focus();
	return(false);
	}
	var iChars = ".";
				for (var i = 0; i < strNumber.length; i++) {
					if (iChars.indexOf(strNumber.charAt(i)) != -1) {
					alert (". is not allow in number of call field.");
					obj.value="";
					obj.focus();
					return false;
					}
				}
	if(!isNaN(strNumber)&&strNumber!="")
	{
	var intNumber = parseInt(strNumber, 10) ;
	document.getElementById(id).value =intNumber;
	return true;
	}
	else
	{
	alert("Please enter numbers only");
  	obj.value="";
    obj.focus();
    return false;
    }
	
	return true;
		
}
	

function checkForInvalid(obj) {
	if(parseInt(obj.value.charAt(0)) != 9)
	{
		alert("Mobile Number always start with 9 ")
		obj.value="";
		obj.focus();
		return false;
	}
 return true;
}
function checkforstdcode(obj) {
	if(parseInt(obj.value.charAt(0)) != 0)
	{
		alert("Std code always start with 0 ")
		obj.value="";
		obj.focus();
		return false;
	}
 return true;
}

//New Validation
function isChar(Char) // This function accepts only alphabetic characters
	{					  // with white space as special character only  and . character
		var CharToChk = new String(Char);
		var LengthOfChar = CharToChk.length;
		var flag = true;
		for(var i=0;i<LengthOfChar;i++)
		{
			if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122) && CharToChk.charCodeAt(i)!= 32 && CharToChk.charCodeAt(i) !=46 ) {
				flag = false;
				break;
			}	
		}
		return flag;
	}
