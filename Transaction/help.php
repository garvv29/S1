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
	
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores -Help Manuals</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
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
			 <?php
			 if($role != "viewer" && $role != "eindent")
			  {
			  if($role == "admin")
			  {
			  ?>
             <li><a href="#"> Masters </a>
              <ul>
                <li><a href="../Masters/home_classification.php" >&nbsp;Classification&nbsp;Master</a></li>
                <li><a href="../Masters/stores_home.php" >&nbsp;Item&nbsp;Master</a></li>
                <li><a href="../Masters/party_Masterhome.php" >&nbsp;Party&nbsp;Master</a></li>
                <li><a href="../Masters/selectbin.php" >&nbsp;SLOC&nbsp;Master</a></li>
                <li><a href="../Masters/role_home.php" >&nbsp;e-indent&nbsp;Master</a></li>
                <li><a href="../Masters/operator_home.php" >&nbsp;Operator&nbsp;Master</a></li>
				<li><a href="../Masters/viewers_home.php" >&nbsp;Viewers&nbsp;Master</a></li>
				<li><a href="../Masters/home_report.php" >&nbsp;Reports&nbsp;Master</a></li>
                <li><a href="../Masters/companyhome.php" >&nbsp;Parameters&nbsp;Master</a></li>
                <li><a href="../Masters/current_year.php" >&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
              </ul>
            </li>
            <li><a href="#">Transactions </a>
             <ul>
                <li><a href="add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
              </ul>
            </li>
			<?php
			}
			else
			{
			?>
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
			<?php
			}
			?>
            <li><a href="#"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
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
            </li>
            <li>
            <a href="#">Utility </a>
             <ul>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_bincard.php','WelCome','top=10,left=50,width=950,height=800,scrollbars=yes')" >&nbsp;Sub-Bin&nbsp;Card</a></li>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li>
			<?php if($role == "admin")
			  {
			  ?>
			   <li><a href=" Javascript:void(0)" onclick="window.open('../utility/backup.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Backup</a></li>          	   <?php
			   }
			   ?>
              </ul></li>
           
		   <?php
		   } 
		   ?> 
		   </ul>
            </div>
            </div>
            <div class="toplinks" style="vertical-align:text-top">
			<?php
			 
			  if($role == "admin")
			  {
			  ?>
              <ul style="vertical-align:text-top"> <li><a href="adminprofile.php">Profile </a> | </li>
			   <?php
			   } 
			   if($role == "operator")
			   {
			   ?>
			   <ul style="vertical-align:text-top"> <li><a href="operprofile.php">Profile </a> | </li>
			   <?php
			   } 
			   if($role == "viewer")
			   {
			   ?>
			   <ul style="vertical-align:text-top"> <li><a href="viwerprofile.php">Profile </a> | </li>
			   <?php
			   } 
			    if($role == "eindent")
			   {
			   ?>
			   <ul style="vertical-align:text-top"> <li><a href="indentProfile.php">Profile </a> | </li>
			   <?php
			   } 
			   ?> 
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
          <td width="100%" valign="top" align="center"  class="midbgline" height="500">		  
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Help Manuals</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
 <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  	<?php
 if(($role !="viewer"))
 {
 if(($role =="admin"))
 {
		 ?> 
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td><table id="trans" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none; border-color:#4ea1e1" > 
<tr class="Light" height="30">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txttname" type="text" size="20" class="tbltext" tabindex="" maxlength="20" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td width="99" align="right"  valign="middle" class="tblheading" style="border-color:#4ea1e1">Lorry Rec. No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3" style="border-color:#4ea1e1">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex=""  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" style="border-color:#4ea1e1" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>

<td align="right"  valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3" style="border-color:#4ea1e1">&nbsp;<select class="tbltext" name="txt13" style="width:70px;" onchange="clk1(this.value);" >
<option value="" selected="selected">Select</option>
<option value="TBB">TBB</option>
<option value="ToPay" >To Pay</option>
<option value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>

<table id="courier" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none; border-color:#4ea1e1" > 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="275" valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right" width="99" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3" style="border-color:#4ea1e1">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
<table id="byhand" align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="display:none; border-color:#4ea1e1" > 
<tr class="Dark" height="30">
<td align="right" width="202" valign="middle" class="tblheading" style="border-color:#4ea1e1">&nbsp;Name of Person&nbsp;</td>
<td width="642" colspan="8" align="left" valign="middle" class="tbltext" style="border-color:#4ea1e1">&nbsp;<input name="txtpname" type="text" size="30" class="tbltext" tabindex=""  maxlength="30" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>


<table align="center" border="1" width="450" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
      <tr class="tblsubtitle" height="25">
	  <td width="5%" align="center" class="tblheading">#</td>
        <td colspan="100" class="tblheading" align="center" bordercolor="#4ea1e1" >&nbsp;List of Admin Help Manuals
 </td>
      </tr>
      <tr class="Dark" height="25">
        <td align="center" class="tbltext">1</td>
        <td width="78%" align="left" class="tbltext" t>&nbsp;<a  href="../help/Help Manual-Masters.pdf" target="_blank">Help-Manual - Masters  </a></td>
      </tr>
      <tr class="Light" height="25">
        <td align="center" class="tbltext">2</td>
        <td align="left" class="tbltext">&nbsp;<a  href="../help/Help Manual-Admin Transactions.pdf" target="_blank">Help Manual - AdminTransactions</a> </td>
     </tr>
	 <tr class="Light" height="25">
        <td align="center" class="tbltext">3</td>
        <td align="left" class="tbltext">&nbsp;<a  href="../help/Help Manual-Operator Transactions.pdf" target="_blank">Help Manual - Operator Transactions</a></td>
       
      </tr>
      <tr class="Dark" height="25">
        <td align="center" class="tbltext">4</td>
        <td align="left" class="tbltext">&nbsp;<a  href="../help/Help Manual-Utility.pdf" target="_blank">Help Manual - Utility</a></td>
      </tr>
	  
      <!---  
       table code..                 --->
      <!---  
       table code..                 --->
      <!--<tr class="tblsubtitle">
       <td colspan="100" class="tblheading"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#0000FF">Abbreviations are defined by stores Administrator. Their expansions are available in data entry form and as part of help manual.</div></td>		
     </tr>
-->
      <!---table code..--->
    </table>
  	<br />
   <?php
}
else
{
?>
  
  <table align="center" border="1" width="450" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
      <tr class="tblsubtitle" height="25">
	  <td width="12%" align="center" class="tblheading">#</td>
        <td width="88%" colspan="100" align="center" bordercolor="#4ea1e1" class="tblheading" >&nbsp;List of Operator Help Manuals </td>
      </tr>
	   <tr class="Light" height="25">
        <td align="center" class="tbltext">1</td>
        <td align="left" class="tbltext">&nbsp;<a  href="../help/Help Manual-Operator Transactions.pdf">Help Manual - Operator Transactions</a></td>
       
      </tr>
      <tr class="Dark">
        <td align="center" class="tbltext">2</td>
        <td align="left" class="tbltext">&nbsp;<a  href="../help/Help Manual-Utility.pdf">Help Manual - Utility</a></td>
      </tr>
     
   
    </table>
<?php
}
}
?>
</td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  