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
	//$logid="opr1";
	//$lgnid="OP1";
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$chkbox=trim($_POST['chkbox']);
		$p_id=trim($_POST['maintrid']);
			$remarks=trim($_POST['txtremarks']);	
		/*$whid=trim($_POST['txtwh']);
			{
		//$id=trim($_POST['txtsid']);
		
		$query=mysql_query("SELECT * FROM tbl_bin where binname='$perticulars'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {
		 ?>
		 <script>
		  alert("This bin is Already Present.");
		  </script>
		 <?php }
		 else 
		{
	 	
		
 	   $sql_in="insert into tbl_bin(binname,whid)values('$perticulars','$whid')";
					//exit;							
		if(mysql_query($sql_in)or die(mysql_error()))
		{*/
			echo "<script>window.location='add_issu_physical_indent1.php'</script>";	
		}
		
	
//}
//}
//}

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores- Transaction - Issue- Material Return to Vendor</title>
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

</script>
<script language="javascript" type="text/javascript">
var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.date,dt,document.frmaddDepartment.date, "dd-mmm-yyyy", xind, yind);
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
	document.frmaddDepartment.txt12.focus();
	}
	
function pform()
{

if(document.frmaddDept.txtclass.value=="")
	{
		alert("Select classifcation");
		document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Item.");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	
			var a=formPost(document.getElementById('mainform'));
		alert(a);
		//document.frmaddDept.tt.value=a;
		showUser(a,'discard3','discard3','','','','','');
}
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
		var z="balups_"+val[i];
		var z1="balqty_"+val[i];
		if(document.getElementById(z1).value == "")
		{
		alert('Please enter UPS & Quantity to Issue in SLOC Row Number: '+val[i]);
		return false;
		}
		}
	}

		var a=formPost(document.getElementById('mainform'));
		alert(a);
		//document.frmaddDept.tt.value=a;
		showUser(a,'maindiv','mform','','','','','');
}
}	


function checkchk(chkval)
{
		var x="issueups_"+chkval;
		var y="issueqty_"+chkval;
		var z="balups_"+chkval;
		var z1="balqty_"+chkval;
		alert(chkval);
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
var c="qtyavl_"+qval;
var d="balqty_"+qval;
document.getElementById(d).value=parseFloat(document.getElementById(c).value)-parseFloat(qid);
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
//if(document.frmaddDepartment.txt11.value!="")
showUser(classval,'item','discard','','','','','');

}


function classchk(itval)
{
if(document.frmaddDept.txtclass.value!="")
{
showUser(itval,'uom','discard1','','','','','');
}
else
{
alert("Please Select Classification first")
//document.frmaddDepartment.txtitem.
document.frmaddDept.txtclass.focus();
}
}
function editrec(edtid)
{
alert(edtid);
showUser(edtid,'subdiv','etdshow','','','','','');
}


function pform1()
{ 
	
	if(document.frmaddDept.txtclass.value=="")
	{
		alert("Select classifcation");
		document.frmaddDept.txtclass.focus();
		return false;
	}
	if(document.frmaddDept.txtitem.value=="")
	{
		alert("Please Select Item.");
		document.frmaddDept.txtitem.focus();
		return false;
	}
	/*
	if(document.frmaddDept.txt.value=="")
	{
		alert("Please enter Type.");
		document.frmaddDept.txt.focus();
		return false;
	}
	if(document.frmaddDept.txt1.value.charCodeAt() == 32)
	{
		alert("Type cannot start with space.");
		document.frmaddDept.txt1.focus();
		return false;
	}*/
	else
		var a=formPost(document.getElementById('mainform'));
		alert(a);
		//document.frmaddDept.tt.value=a;
		showUser(a,'discard3','discard3','','','','','');
}
//}	
/*function itemcheck()
{
if(document.frmaddDepartment.txtitem.value=="")
{
alert("Please select Item first");
document.frmaddDepartment.txtupsdc.value="";
}
}
function captive(opt)
{ 
	if(opt!="")
	{
	if(document.frmaddDepartment.txtclass.value=="")
	{
		alert("Select classifcation");
		document.frmaddDepartment.txtclass.focus();
		return false;
	}
	if(document.frmaddDepartment.txtitem.value=="")
	{
		alert("Please Select Item.");
		document.frmaddDepartment.txtitem.focus();
		return false;
	}
	
	if(document.frmaddDepartment.txtups.value=="")
	{
		alert("Please enter Indent Ups.");
		document.frmaddDepartment.txtups.focus();
		return false;
	}
	}
function mySubmit()
{ 
	
if(document.frmaddDepartment.txt15.value=="")
	{
	alert("Please select Party name ");
	return false;
	}	
			
	if(document.frmaddDepartment.txtdcno.value=="")
	{
	alert("Please enter D.C. NO.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdcno.value.charCodeAt() == 32)
	{
	alert("D.C. NO. cannot start with space.");
	document.frmaddDepartment.txtdcno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtporn.value=="")
	{
	alert("Please enter Reference No.");
	document.frmaddDepartment.txtporn.focus();
	return false;
	}
	if(document.frmaddDepartment.txtporn.value.charCodeAt() == 32)
	{
	alert("Reference No cannot start with space.");
	document.frmaddDepartment.txtporn.focus();
	return false;
	}
	/*if(document.frmaddDepartment.txtporn.value=="")
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
	}
	if(document.frmaddDepartment.txt11.value!="")
	{
	if(document.frmaddDepartment.txt11.value=="Yes")
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
				
	if(document.frmaddDepartment.txtlrn.value=="")
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
	}
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
	else
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
	}
	else
	{
	alert("Please select Mode of Transit");
	return false;
	}
	
	return true;	 
}*/

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
				 <li><a href="../reports/statusreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;&nbsp;Transaction -Material Discard </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysql_query("select * from tbl_bin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);*/
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form  id="mainform"name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />
 <input name="txt11" value="" type="hidden"> 
   <input name="txt" value="" type="hidden"> 
   <?php
$tid=0; $subtid=0;
?>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>

<table id="trans" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Dark" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txttname" type="text" size="35" class="tbltext" tabindex="" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Lorry Receipt No&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext">&nbsp;<input name="txtlrn" type="text" size="20" class="tbltext" tabindex="" /><font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="76" valign="middle" class="tblheading">&nbsp;Vehicle No&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtvn" type="text" size="15" class="tbltext" tabindex="" maxlength="13"  />  </td>
</tr>

<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes"  />&nbsp;TBB&nbsp;&nbsp;&nbsp;<input name="txt2" type="radio" class="tbltext" value="No"  />&nbsp;To Pay<input name="txt2" type="radio" class="tbltext" value="No"  />
   &nbsp;Paid</td>
</tr>
</table>
<table id="courier" align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none" > 
<tr class="Light" height="30">
<td align="right" width="171" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="254" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="25" class="tbltext" tabindex=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="76" valign="middle" class="tblheading">&nbsp;Docket no&nbsp;</td>
<td align="left" width="239" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="25"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<br />
<div id="subform">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#4ea1e1" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="1%" rowspan="3" align="center" valign="middle" class="tblheading">#</td>
			 <td width="17%" align="center" rowspan="3" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="3" align="center" valign="middle" class="tblheading">Items</td>
			  <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">UOM</td> 
			    <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">G/D</td>
			                 <td colspan="4"  align="center" valign="middle" class="tblheading">Quantity</td>
                  <td colspan="3" rowspan="2" align="center" valign="middle" class="tblheading">Damage</td>
             
              <td width="3%" rowspan="3" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="4%" rowspan="3" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
			<tr class="tblsubtitle">
			  <td colspan="2" align="center" valign="middle" class="tblheading">Stock</td>
			 		  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
			
			  </tr>
			<tr class="tblsubtitle">
                    <td width="5%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">QTY</td>
                                       <td width="4%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">QTY</td>
                  										<td width="6%" align="center" valign="middle" class="tblheading">Sloc</td>
                    <td width="3%" align="center" valign="middle" class="tblheading">UPS</td>
                    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              </tr>
          </table>
<br />

<div id="discard3" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 		
 <?php 
$quer3=mysql_query("select classification_id, classification from tbl_classification") or die(mysql_error());
?>
		 <tr class="Dark" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">&nbsp;Select Classification  &nbsp; </td>                                   
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;"   onchange="modetchk(this.value)">
<option value="" >--Select Classification--</option>
	<?php while($noticia_class = mysql_fetch_array($quer3)) { ?>
		<option <?php if($noticia_class['classification_id']==$row_tbl_sub['classification_id']){ echo "Selected"; } ?> value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysql_query("select items_id, stores_item from tbl_stores") or die(mysql_error());
?> 
		<tr class="Light" height="25">
           <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Items &nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="item">&nbsp;<select class="tbltext" name="txtitem" style="width:170px;" onchange="classchk(this.value);" >
<option value="" >--Select Item--</option>
</select>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">UOM&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" id="uom">&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row_tt['uom'];?>" /></td>
         </tr>
		 <tr class="Light" height="25">
            <td width="318" height="24"  align="right"  valign="middle" class="tblheading">Type &nbsp;</td>
            <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes"  />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No"  />&nbsp;Damage&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp; </td>
         </tr>
			</table>
			</div>
			
		
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > <tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Stock In Hand</td>
</tr>
<?php
$sql_issue=mysql_query("select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where stlg_trclassid='".$row_tbl_sub['classification_id']."' and stlg_tritemid='".$row_tbl_sub['items_id']."'") or die(mysql_error());

?>
 <tr class="tblsubtitle" height="25">
<td width="67" align="center" valign="middle" class="tblheading">Select</td>
<td width="233" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="72" align="center" valign="middle" class="tblheading">UPS</td>
<td width="75" align="center" valign="middle" class="tblheading">Quantity</td>
<td width="96" align="center" valign="middle" class="tblheading">Discard UPS</td>
<td width="100" align="center" valign="middle" class="tblheading">Discard Quantity</td>
<td width="90" align="center" valign="middle" class="tblheading">Balance UPS</td>
<td width="99" align="center" valign="middle" class="tblheading">Balance Quantity</td>
 </tr>
 <?php
$srno=1;
 while($row_issue=mysql_fetch_array($sql_issue))
 { 
$sql_issue1=mysql_query("select max(stlg_id) from tbl_stldg_good where stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."'") or die(mysql_error());
$row_issue1=mysql_fetch_array($sql_issue1); 

$sql_issuetbl=mysql_query("select * from tbl_stldg_good where stlg_id='".$row_issue1[0]."'") or die(mysql_error()); 

 while($row_issuetbl=mysql_fetch_array($sql_issuetbl))
 { 
 if($srno%2!=0)
{
  $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysql_query("select perticulars from tbl_warehouse where whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_whouse=mysql_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysql_query("select binname from tbl_bin where binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_binn=mysql_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysql_query("select sname from tbl_subbin where sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysql_error());
$row_subbinn=mysql_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onClick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="" onChange="upschk(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="" onChange="qtychk(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onClick="checkchk('<?php echo $srno;?>')" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="" onChange="upschk(this.value,'<?php echo $srno;?>')" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="" onChange="qtychk(this.value,'<?php echo $srno?>')" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 } 
 $srno++;
 } 
 ?>
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/>
</table>
	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Type&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt11" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Returnable&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt11" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />&nbsp;Not Returnable&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="220" align="right"  valign="middle" class="tblheading">&nbsp;Reason For discard&nbsp;</td>
<td width="624" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtremarks" cols="50" rows="5" tabindex="" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0"style="display:inline;cursor:hand;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_internalcc.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;
  <input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onclick="return mySubmit();"  border="0" style="display:inline;cursor:hand;" /></td>
</tr>
</table></td>
<td width="30"><span class="footer"><img src="images/vnrlogo.gif"  align="right"/></span></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
</table><br />
</br>
<br /></td>
    <td width="30"></td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="images/istratlogo.gif"  align="left"/><img src="images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
