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
	
	if(isset($_REQUEST['char']))
	{
		$char = $_REQUEST['char'];	 
	}
	else
	{
		$char = "ALL";
	}
	
	if(isset($_REQUEST['achar']))
	{
		$achar = $_REQUEST['achar'];	 
	}
	else
	{
		$achar = "";
	}
	if(isset($_REQUEST['page']))
	{
		$page = $_REQUEST['page'];	 
	}
	
	//$homeurl="'$homeurl'";
	if(isset($_POST['frm_action'])=='submit')
	{
		$achar=trim($_POST['txtsid']);
		$homeurl="stores_home.php?page=$page&amp;&achar=$achar&amp;&char=$char";
		//header('Location: '.$homeurl);
		echo "<script>window.location='$homeurl'</script>";	
	}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores - Item Master -Item Home</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
<script language="javascript">
function mySubmit()
{
if(document.frmaddDepartment.txtsid.value=="")
{
alert("Please enter text to search then click on search button.");
document.frmaddDepartment.txtsid.focus();
return false;
}
return true;
}
</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">
      <?php include '../include/navbar_loader.php'; ?>

<table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  
<!-- actual page start--->	
	   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="801" class="Mainheading" height="25">
	  <table width="809" border="0" cellpadding="0" cellspacing="0" bordercolor="#0000000" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Item Master </td>
	    </tr></table></td>
	  <td width="139" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#5b7e1b" cellspacing="0" cellpadding="0" width="130" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="130" valign="middle" class="tblbutn" style="cursor:hand;"><a href="add_stores.php" style="text-decoration:none; color:#FFFFFF">Add </a></td>
</tr>
</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  <form name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<input name="frm_action" value="submit" type="hidden" />
	    <table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td bgcolor="#FFFFFF">
<?php
$targetpage = "stores_home.php"; 
	$adjacents = 2;
	$limit = 10; 								
	$page = (int)$_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
	//echo $achar;	
  /*$sql_arr_home=mysql_query("select * from tbl_classification order by classification desc LIMIT $start, $limit") or die(mysql_error());
 $tot_arr_home=mysql_num_rows($sql_arr_home);*/

//$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 
if($achar!="")
	{
	$sql_sel="select a.stores_item, a.items_id,a.uom,a.srl,a.actstatus  , b.classification from tbl_stores a,tbl_classification b where a.classification_id = b.classification_id and a.stores_item like '%".$achar."%' order by b.classification,a.stores_item desc LIMIT $start, $limit";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_stores where stores_item like '%".$achar."%'"),0); 
	}
	else if( 'ALL'!= $char)
	{
	$sql_sel="select a.stores_item, a.items_id,a.uom,a.srl,a.actstatus  , b.classification from tbl_stores a,tbl_classification b where a.classification_id = b.classification_id and a.stores_item like '".$char."%' order by b.classification,a.stores_item desc LIMIT $start, $limit";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_stores where stores_item like '".$char."%'"),0); 
	}
	else 
	{	
	$sql_sel="select a.stores_item, a.items_id,a.uom,a.srl,a.actstatus  , b.classification from tbl_stores a,tbl_classification b where a.classification_id = b.classification_id order by b.classification,a.stores_item desc LIMIT $start, $limit";
	$res=mysql_query($sql_sel) or die (mysql_error());
	
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM tbl_stores"),0); 
	}
$query = "select a.stores_item, a.items_id,a.uom,a.srl,a.actstatus  , b.classification from tbl_stores a,tbl_classification b where a.classification_id = b.classification_id order by b.classification,a.stores_item desc";
$total_pages = mysql_num_rows(mysql_query($query));
//echo	$total_pages = $total_pages[num];
//echo $total_results;	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_results/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:805px\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev&achar=$achar&char=$char\">� previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">� previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter&achar=$achar&char=$char\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&achar=$achar&char=$char\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1&achar=$achar&char=$char\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage&achar=$achar&char=$char\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1&achar=$achar&char=$char\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2&achar=$achar&char=$char\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&achar=$achar&char=$char\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1&achar=$achar&char=$char\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage&achar=$achar&char=$char\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1&achar=$achar&char=$char\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2&achar=$achar&char=$char\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter&achar=$achar&char=$char\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next&achar=$achar&char=$char\"> next �</a> ";
		else
			$pagination.= " <span class=\"disabled\"> next �</span> ";
		$pagination.= "</div>\n";		
	}
	 $srno=($page-1)*$limit+1;
	
	$total=mysql_num_rows($res);

?>

<table align="center" border="1" width="581" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by Alphabet </td>
</tr>
<tr class="Dark">
<td width="31" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=ALL" class="link">All</a></td>
<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=A" class="link">A</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=B" class="link">B</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=C" class="link">C</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=D" class="link">D</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=E" class="link">E</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=F" class="link">F</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=G" class="link">G</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=H" class="link">H</a></td>

<td width="13" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=I" class="link">I</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=J" class="link">J</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=K" class="link">K</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=L" class="link">L</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=M" class="link">M</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=N" class="link">N</a></td>

<td width="15" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=O" class="link">O</a></td>

<td width="22" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=P" class="link">P</a></td>

<td width="18" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=Q" class="link">Q</a></td>

<td width="16" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=R" class="link">R</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=S" class="link">S</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=T" class="link">T</a></td>

<td width="21" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=U" class="link">U</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=V" class="link">V</a></td>

<td width="24" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=W" class="link">W</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=X" class="link">X</a></td>

<td width="19" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=Y" class="link">Y</a></td>

<td width="17" height="1" align="center" valign="middle" class="tbltext"><a href="stores_home.php?page=<?php echo $page?>&achar=<?php echo "";?>&char=Z" class="link">Z</a></td>
</tr>
</table>

<br />
<table align="center" border="1" width="581" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >  <tr class="tblsubtitle" height="25">
  <td colspan="30" align="center" class="tblheading">Search by Item Name </td>
</tr>
  </table>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="581" bordercolor="#4ea1e1" style="border-collapse:collapse">
   <tr class="Dark" height="25">
  
   <td width="109" align="right"  valign="middle" class="tblheading">&nbsp;Store Item Name&nbsp;</td>
    <td width="356" align="left"  valign="middle" >&nbsp;<input name="txtsid" type="text" size="42" class="tbltext" tabindex="0" maxlength="35" value="<?php echo $achar;?>"  /></td>
	<td width="108" align="center"  valign="middle" ><input name="Submit" type="image" src="../images/search.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;" align="middle"></td>
   </table>
 <?php
 if($total >0) { 
 ?>  
<table align="center" border="0" cellspacing="0" cellpadding="0" width="700" style="border-collapse:collapse">
  <tr height="25" >
    <td width="647" colspan="8" align="center" class="subheading" style="color:#303918; "><input name="frm_action" value="submit" type="hidden" />Stores Item List (<?php echo $total_results;?>)</td>
  </tr>
  </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#4ea1e1" style="border-collapse:collapse">
    <tr class="tblsubtitle" height="25">
<td width="36" height="22" align="center" valign="middle" class="tblheading">#</td>
<td width="239" align="left" class="tblheading" valign="middle">&nbsp;&nbsp;Stores Item</td>
<td width="137" align="center" class="tblheading" valign="middle">Classification<br /></td>
<td width="89" align="center" class="tblheading" valign="middle">&nbsp;UoM</td>
<td width="104" align="center" class="tblheading" valign="middle">&nbsp;Re-Order Level<br /></td>
<td width="38" align="center" class="tblheading" valign="middle">Status</td>
<td width="38" align="center" class="tblheading" valign="middle">Edit</td>
<td width="41" align="center" class="tblheading" valign="middle">Delete</td>
</tr>
<?php
//$srno=1;
	while($row=mysql_fetch_array($res))
	{
	/*$resettargetquery=mysql_query("select * from tbl_classification where classification_id='".$row['classification_id']."' order by classification ASC");
  	$resetresult=mysql_fetch_array($resettargetquery);
  	$num_of_records_target_set=mysql_num_rows($resettargetquery);*/
	
	/*$sql_p=mysql_query("select * from tbl_stores where items_id='".$row['items_id']."'")or die(mysql_error());
  	$row_p=mysql_fetch_array($sql_p);
$num_of_records_target_set1=mysql_num_rows($sql_p);*/
	
	$sql_v=mysql_query("select * from tbl_stldg_good where stlg_tritemid='".$row['items_id']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_of_records_target_set2 =mysql_num_rows($sql_v);
	
	$sql_v=mysql_query("select * from tbl_stldg_damage where stld_tritemid='".$row['items_id']."'")or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_of_records_target_set3 =mysql_num_rows($sql_v);
	/*$sql_v=mysql_query("select * from tblvariety where cropid=".$row['cropid'])or die(mysql_error());
  	$row_v=mysql_fetch_array($sql_v);
	$num_v=mysql_num_rows($sql_v);
	$sql_tra=mysql_query("select * from tblarrival where cropid=".$row['cropid'])or die(mysql_error());
  	$row_tra=mysql_fetch_array($sql_tra);
	$num_tra=mysql_num_rows($sql_tra);
	*/

	if ($srno%2 != 0)
	{
	
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['classification'];?>&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['srl'];?> </td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['actstatus'];?> </td>
<td valign="middle" class="tbltext" align="center"><?php if( $num_of_records_target_set2 > 0 || $num_of_records_target_set3 > 0) { ?><img border="0" src="../images/edit.png" style="cursor:hand" onclick="alert('Cannot be edited. This item has been used in transaction')" /> <?php } else { ?><a href="edit_stores.php?items_id=<?php echo $row['items_id'];?>&page=<?php echo $page?>&char=<?php echo $char?>&achar=<?php echo $achar?>"><img src="../images/edit.png" border="0" /></a><?php } ?></td>
<!--<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>-->

<td valign="middle" class="tbltext" align="center"><?php if( $num_of_records_target_set2 > 0|| $num_of_records_target_set3 > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onclick="alert('Cannot be deleted this item has been used in transaction')"  />
<?php } else { ?><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Dark" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row['stores_item'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['classification'];?>&nbsp;</td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['srl'];?></td>
<td valign="middle" class="tbltext" align="center">&nbsp;<?php echo $row['actstatus'];?> </td>
<td valign="middle" class="tbltext" align="center"><?php if( $num_of_records_target_set2 > 0 || $num_of_records_target_set3 > 0) { ?><img border="0" src="../images/edit.png" style="cursor:hand" onclick="alert('Cannot be edited. This item has been used in transaction')" /> <?php } else { ?><a href="edit_stores.php?items_id=<?php echo $row['items_id'];?>&page=<?php echo $page?>&char=<?php echo $char?>&achar=<?php echo $achar?>"><img src="../images/edit.png" border="0" /></a><?php } ?></td>
<!--<td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a></td>
</tr>-->

<td valign="middle" class="tbltext" align="center"><?php if( $num_of_records_target_set2 > 0|| $num_of_records_target_set3 > 0)
{
?>
<img border="0" src="../images/delete.png" style="cursor:hand" onclick="alert('Cannot be deleted this item has been used in transaction')"  />
<?php } else { ?><a href="../include/delete.php?print=stores&code=<?php echo $row['items_id'];?>" onclick="return confirm('Do you really want to delete this Record?')"><img border="0" src="../images/delete.png"  /></a> <?php } ?></td>
</tr>
<?php	}
	 $srno=$srno+1;
	}
?>
</table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='700' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
		echo "</td></tr></table>";*/ 
}

?>
<?php echo $pagination;?>
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
