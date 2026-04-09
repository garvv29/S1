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
	
	if(isset($_REQUEST['classification_id']))
	{
	$classification_id = $_REQUEST['classification_id'];
	}
	if(isset($_REQUEST['items_id']))
	{
	$id = $_REQUEST['items_id'];
	}
	if(isset($_REQUEST['p_id']))
	{
	$pid = $_REQUEST['p_id'];
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores  - Report-Party MasterParty Home</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<link href="/include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#0000000" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	     <td width="810" height="25">&nbsp; Report - Partry Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">
</table></td>
	  </tr>
	  </table></td></tr>
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
        <tr height="7">
          <td height="7"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td bgcolor="#FFFFFF">
		  <?php
			$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_partymaser"),0); 

?>
              <table align="center" border="0" cellspacing="0" cellpadding="0" width="450" style="border-collapse:collapse">
                <tr height="25" >
                  <td colspan="8" align="center" class="subheading" style="color:#303918; ">Report Party wise List 
                    (<?php echo $total_results;?>)</td>  
                                    
                </tr>
              </table>
            <table align="center" border="1" cellspacing="0" cellpadding="0" width="491" bordercolor="#4ea1e1" style="border-collapse:collapse">
                <tr class="tblsubtitle" height="25">
                  <td width="49" align="center" class="tblheading" valign="middle">#</td>
                  <td width="281" align="left" class="tblheading"valign="middle">&nbsp;Party Name </td>
                  <td width="188" align="center" class="tblheading" valign="middle">Party (Nos.)</td>
                </tr>
                <?php
	/*$result=mysql_query("SELECT * FROM tbl_partymaser where business_name='".Vendor."'") or die(mysql_error()); 
   $row = mysql_fetch_array($result);*/

	$resettargetquery=mysql_query("select * from tbl_partymaser where classification='Vendor'");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);
		
	$sql_p=mysql_query("select * from tbl_partymaser where classification='C&F'")or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
	$num_p=mysql_num_rows($sql_p);
	
	$sql_v=mysql_query("select * from tbl_partymaser where classification='Dealer'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v); 
	$num_v=mysql_num_rows($sql_v);
	
	$sql_tra1=mysql_query("select * from tbl_partymaser where classification='Stock Transfer'")or die(mysql_error());
  	$row_tra1=mysql_fetch_array($sql_tra1);
	$num_tra1=mysql_num_rows($sql_tra1);

	
	$sql_tra=mysql_query("select * from tbl_partymaser where classification='Internal Return'")or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	if($total_results>0){
?>
                <tr class="Light" height="25">
                  <td  valign="middle" class="tbltext" align="center">1</td>
                  <td valign="middle" class="tbltext" align="left">&nbsp;Vendor</td>
                  <td valign="middle" class="tbltext" align="center"><?php if($num_of_records_target_set>0){?>
                      <a href="report_party.php?business_name=Vendor">
                        <?php echo $num_of_records_target_set;?></a>
						<?php } else {?>                 <?php echo $num_of_records_target_set;?>
                        
                                           <?php } ?>
					
					</td>
                </tr>
                <tr class="Dark" height="25">
                  <td  valign="middle" class="tbltext" align="center">2</td>
                  <td valign="middle" class="tbltext" align="left">&nbsp;C & F</td>
                  <td valign="middle" class="tbltext" align="center"><?php if($num_p > 0){?>
			                      <a href="report_party.php?business_name=CF"> 
                        <?php echo $num_p;?></a>
                      
                      <?php } else {?>
                     
                        <?php echo $num_p;?>
                       
                    <?php } ?></td>
                </tr>
                <tr class="Light" height="25">
                  <td  valign="middle" class="tbltext" align="center">3</td>
                  <td valign="middle" class="tbltext" align="left">&nbsp;Dealer</td>
                  <td valign="middle" class="tbltext" align="center"><?php if($num_v>0){?>
                      <a href="report_party.php?business_name='Dealer'">
                        <?php echo $num_v;?> </a><?php } else {?>
                       <?php echo $num_v;?>
                    <?php } ?></td></tr>
                    
                <tr class="Dark" height="25">
                  <td  valign="middle" class="tbltext" align="center">4</td>
                  <td valign="middle" class="tbltext" align="left">&nbsp;Stock Transfer</td>
                  <td valign="middle" class="tbltext" align="center"><?php if($num_tra1>0){?>
                      <a href="report_party.php?business_name=Stock Transfer">
                        <?php echo $num_tra1;?>
                        </a>
                      <?php } else {?>
                      
                        <?php echo $num_tra1;?> <?php } ?>
					
						</td></tr>
                     
                <tr class="Light" height="25">
                  <td  valign="middle" class="tbltext" align="center">5</td>
                  <td valign="middle" class="tbltext" align="left">&nbsp;Internal Return</td>
                  <td valign="middle" class="tbltext" align="center"><?php if($num_tra>0){?>
                      <a href="report_party.php?business_name=Internal Return">
                        <?php echo $num_tra;?>
                        </a>
                      <?php } else {?>
                     
                        <?php echo $num_tra;?>  <?php } ?></td></tr>
						<?php } ?>
						</table>
           <table class="tbltext" width="402" align="center">
                <tbody>
                  <tr>
                    <td width="512" align="center"><a href="masterreports.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp;</td>
                  </tr>
                </tbody>
            </table></td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
	  </form>	  </td>
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
