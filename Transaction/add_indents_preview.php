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
	//$role="eindent";
	//$id="42";
	//$name="Ram";
	if(isset($_REQUEST['p_id']))
	{
  $pid = $_REQUEST['p_id'];
	}
	 if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}	
 	
	
	if(isset($_POST['frm_action'])=='submit')
	{
	
	$s_chk=mysql_query("SELECT * FROM tbl_ieindent where yearcode='$yearid_id'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(code) FROM tbl_ieindent where yearcode='$yearid_id'  ORDER BY code DESC";
	else
	$sql_code="SELECT MAX(code) FROM tbl_ieindent  ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				//$code1="IR".$code."/".$yearid_id;
		}
		
		else
		{
			$code=1;
			//$code1="IR".$code;
		}
		
		$sql_main1="update tbl_ieindent set code='$code', tflg=1  where tid = '$pid'";

	$a123=mysql_query($sql_main1) or die(mysql_error());
		
	echo "<script>window.location='../indexindet.php'</script>";	
	}
	
/*$sql_code="SELECT MAX(code) FROM tbl_ieindent where yearcode='$yearid_id'  ORDER BY code DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="IR".$code."/".$yearid_id;
		}
		
		else
		{
			$code=1;
			$code1="IR".$code;
		}

	$s_chk=mysql_query("SELECT * FROM tbl_ieindent where yearcode='$yearid_id'") or die (mysql_error());
	$r_chk=mysql_num_rows($s_chk);
	if($r_chk > 0)
	$sql_code="SELECT MAX(code1) FROM tbl_ieindent where yearcode='$yearid_id'  ORDER BY code1 DESC";
	else
	$sql_code="SELECT MAX(code1) FROM tbl_ieindent  ORDER BY code1 DESC";
	$res_code=mysql_query($sql_code)or die(mysql_error());
		
		if(mysql_num_rows($res_code) > 0)
			{
				$row_code=mysql_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="IR".$code."/".$yearid_id;
		}
		
		else
		{
			$code=1;
			$code1="IR".$code;
		}*/		
		?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>stores -Transction -add indents</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script src="indent.js"></script>
<script type="text/javascript">
/*
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
*/
</script>
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
function openprint()
{
if(document.frmaddDepartment.txtitem.value!="")
{
var itm=document.frmaddDepartment.txtitem.value;
winHandle=window.open('indents_print.php?itmid='+itm,'WelCome','top=170,left=180,width=770,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.frmaddDepartment.txtitem.focus();
}
}



function mySubmit()
{ 
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	return true;	 
	}
	else
	{
	return false;
	}
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
            
            </div>
            <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
               <li> <a href="adminprofile.php">Profile </a> | </li>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="stores_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;"></a>Transction Issue-Indents-Preview </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 
 <?php
$tid=$pid;
//$tid=0; $subtid=0;
?>

<?php
$sql_tbl=mysql_query("select * from tbl_ieindent where  tid='".$tid."'") or die(mysql_error());

$row_tbl=mysql_fetch_array($sql_tbl);			
//$id_in=$row_tbl['id_in'];

$sql_tbl_sub=mysql_query("select * from tbl_ieindent_sub where id_in='".$tid."'") or die(mysql_error());
$subtid=0;
$tdate=$row_tbl['tdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

?>
	  
	    <td align="center" colspan="4" >
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input type="hidden" name="code" value="<?php echo $row_tbl['code1']?>" />
	 <input type="hidden" name="txtitem" value="<?php echo $pid?>" />

	 <br />
	 


<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Raise E Indent </td>
</tr>
  <tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>

	
	 <tr class="Dark" height="30">
<td width="151" align="right" valign="middle" class="tblheading">&nbsp;Transction Id&nbsp;</td>
<td width="219"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TIR".$row_tbl['code1']."/".$yearid_id."/".$logid;?></td>

<td width="128" align="right" valign="middle" class="tblheading">Indent Date&nbsp;</td>
<td width="242" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?></td>
	 </tr>

<tr class="Light" height="30">
<td width="151" align="right" valign="middle" class="tblheading">Indent Number  </td>
<td width="219"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "T".$row_tbl['code1'];?></td>
<?php 
$result=mysql_query("SELECT * FROM tbl_roles where id='".$loginid."'")or die(mysql_error()); 
$row = mysql_fetch_array($result);

?>
<td width="128" align="right" valign="middle" class="tblheading">Raised by&nbsp;</td>
<td width="242" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row['name'];?>
</tr>
</table>
<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#4ea1e1" style="border-collapse:collapse"> <tr class="tblsubtitle" height="25">
<td width="53" align="center" class="tblheading" valign="middle">#</td>
<td width="141" align="center" class="tblheading" valign="middle">Classification </td>
<td width="114" align="center" class="tblheading" valign="middle">Item </td>
<td width="147" align="center" class="tblheading" valign="middle">UoM </td>
<td width="147" align="center" class="tblheading" valign="middle">Quantity</td>
</tr>
<?php
$srno=1;
$total_tbl=mysql_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysql_fetch_array($sql_tbl_sub))
{

$sql_class=mysql_query("select * from tbl_classification where classification_id='".$row_tbl_sub['classification_id']."'") or die(mysql_error());
$row_class=mysql_fetch_array($sql_class);

$sql_item=mysql_query("select * from tbl_stores where items_id='".$row_tbl_sub['items_id']."'") or die(mysql_error());
$row_item=mysql_fetch_array($sql_item);

$sql_item1=mysql_query("select * from tbl_ieindent_sub where eid='".$row_tbl_sub['eid']."'") or die(mysql_error());
$row_item1=mysql_fetch_array($sql_item1);
if($srno%2!=0)
{

?>			


<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
</tr>
<?php
	}
	else
	{ 
	
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_class['classification'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['uom'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row_item1['qty'];?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
}
?>
</table>


 <br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="60" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="784" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['remarks']?></td>
</tr>
</table>
<table align="center" width="788" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td width="794" align="right" valign="top"><a href="edit_edit_indents.php?p_id=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
