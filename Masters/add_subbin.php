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
	
	
	if(isset($_POST['frm_action']) && $_POST['frm_action']=='submit')
	{
		
				
			$wh=trim($_POST['txtwh']);
			$bin=trim($_POST['txtbin']);
			$sbin=trim($_POST['txtsbin']);
	 	
		$query=mysql_query("SELECT * FROM tbl_subbin where sname='$sbin'") or die("Error: " . mysql_error());
   		$numofrecords=mysql_num_rows($query);
	 	 if( $numofrecords > 0)
		 {
		 ?>
		 <script>
		  alert("This Sub-Bin Numbe is Already Present.");
		  </script>
		 <?php }
		 else 
		{
 	   $sql_in="insert into tbl_subbin(sname,binid,whid)values(
											'$sbin','$bin','$wh'
											 )";
					//exit;							
		if(mysql_query($sql_in)or die(mysql_error()))
		{
			echo "<script>window.location='subbin_home.php'</script>";	
		}
		
	
}

	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="selectuser_hod.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">  
function onloadfocus()
	{
	document.frmaddDept.txtwh.focus();
	}
	
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
function mySubmit()
{ 
		
		if(document.frmaddDept.txtwh.value=="")
	{
	alert("Please select Warehouse Number ");
	document.frmaddDept.txtwh.focus();
	return false;
	}
	
	
	
	if(document.frmaddDept.txtbin.value=="")
	{
	alert("Please select Bin Number ");
	document.frmaddDept.txtbin.focus();
	return false;
	}
	
	if(document.frmaddDept.txtsbin.value=="")
	{
	alert(" Enter Sub-Bin Number");
	document.frmaddDept.txtsbin.focus();
	return false;
	}
	
	
	if(document.frmaddDept.txtsbin.value.charCodeAt() == 32)
	{
	alert("Sub-Bin Number cannot start with space.");
	document.frmaddDept.txtsbin.focus();
	return false;
	}
	
	
return true;
}
</SCRIPT>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores-Stores Master - Add Stores</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

<script language="JavaScript"><!--


  function mmLoadMenus() {if (window.mm_menu_0804145533_0) return;
  window.mm_menu_0804145533_0 = new Menu("root",167,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804145533_0.addMenuItem("Classification&nbsp;Master","location='home_classification.php'");
  mm_menu_0804145533_0.addMenuItem("Stores&nbsp;Item&nbsp;Master","location='stores_home.php'");
  mm_menu_0804145533_0.addMenuItem("Party&nbsp;Master","location='party_Masterhome.php'");
  mm_menu_0804145533_0.addMenuItem("SLOC&nbsp;Master","location='selectbin.php'");
  mm_menu_0804145533_0.addMenuItem("Parameters&nbsp;Master","location='companyhome.php'");
  mm_menu_0804145533_0.addMenuItem("Year&nbsp;Management&nbsp;Master","location='current_year.php'");
  mm_menu_0804145533_0.addMenuItem("e-Indent&nbsp;Master","location='role_home.php'");
   mm_menu_0804145533_0.addMenuItem("Operator&nbsp;Master","location='operator_home.php'");
  //mm_menu_0804145533_0.fontWeight="bold";
   mm_menu_0804145533_0.hideOnMouseOut=true;
   mm_menu_0804145533_0.bgColor='#000000';
   mm_menu_0804145533_0.menuBorder=1;
   mm_menu_0804145533_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804145533_0.menuLiteBgColor='#FFFFFF';window.mm_menu_0804150040_0 = new Menu("root",164,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804150040_0.addMenuItem("Arrival","location='../Transaction/arrival_home.php'");
   mm_menu_0804150040_0.addMenuItem("Issue","location='../Transaction/issue_home.php'");
   mm_menu_0804150040_0.addMenuItem("Captive&nbsp;Consumption","location='../Transaction/c_c_home.php'");
   mm_menu_0804150040_0.addMenuItem("Order&nbsp;Updation","location='../Transaction/reorder.php'");
   mm_menu_0804150040_0.addMenuItem("Sloc&nbsp;Updation","location='../Transaction/add_arrival.php'");
   mm_menu_0804150040_0.addMenuItem("G&nbsp;TO&nbsp;D","location='../Transaction/add_g.php'");
   mm_menu_0804150040_0.addMenuItem("D&nbsp;TO&nbsp;G","location='../Transaction/add_d.php'");
   mm_menu_0804150040_0.addMenuItem("Discard","location='../Transaction/add_discard.php'");
   mm_menu_0804150040_0.addMenuItem("Excess/Shortage","location='../Transaction/add_shortage.php'");
   mm_menu_0804150040_0.addMenuItem("Cycle&nbsp;Inventory","location='../Transaction/home_ci1.php'");
   mm_menu_0804150040_0.hideOnMouseOut=true;
   mm_menu_0804150040_0.bgColor='#000000';
   mm_menu_0804150040_0.menuBorder=1;
   mm_menu_0804150040_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804150040_0.menuBorderBgColor='#FF6600';


   window.mm_menu_0804152609_0 = new Menu("root",231,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#4ea1e1","left","middle",3,0,1000,-5,7,true,false,true,0,true,true);
  mm_menu_0804152609_0.addMenuItem("Stock&nbsp;on&nbsp;Hand","location='../reports/stockonhandreport.php'");
  mm_menu_0804152609_0.addMenuItem("Party&nbsp;wise&nbsp;Stock&nbsp;Report","location='../reports/partywiseperiodreport.php'");
  mm_menu_0804152609_0.addMenuItem("Item&nbsp;Ledger","location='../reports/storesitamledger.php'");
  mm_menu_0804152609_0.addMenuItem("Discard&nbsp;Between&nbsp;Dates","location='../reports/discardreport.php'");
  mm_menu_0804152609_0.addMenuItem("Stock&nbsp;Transfer&nbsp;Report","location='../reports/stocktransferreport.php'");
  mm_menu_0804152609_0.addMenuItem("Captive&nbsp;Consumption&nbsp;Report","location='../reports/captiveconsumptionreport.php'");
  mm_menu_0804152609_0.addMenuItem("Reorder&nbsp;Level&nbsp;Report","location='../reports/reorderlevelreport.php'");
  // mm_menu_0804152609_0.fontWeight="bold";
   mm_menu_0804152609_0.hideOnMouseOut=true;
   mm_menu_0804152609_0.bgColor='#000000';
   mm_menu_0804152609_0.menuBorder=1;
   mm_menu_0804152609_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0804152609_0.menuBorderBgColor='#FF6600';

window.mm_menu_0226134618_0 = new Menu("root",124,18,"Arial, Verdana, Helvetica, sans-serif",12,"#000000","#FFFFFF","#D2E9FF","#F5F5F5","left","middle",3,0,1000,-5,7,true,false,true,0,true,true); mm_menu_0226134618_0.addMenuItem("Sloc&nbsp;Search","location='../utility/selectvendor.php'");
      mm_menu_0226134618_0.fontWeight="bold";
   mm_menu_0226134618_0.hideOnMouseOut=true;
   mm_menu_0226134618_0.bgColor='#000000';
   mm_menu_0226134618_0.menuBorder=1;
   mm_menu_0226134618_0.menuLiteBgColor='#FFFFFF';
   mm_menu_0226134618_0.menuBorderBgColor='#FF6600';

mm_menu_0226134618_0.writeMenus();
} // mmLoadMenus()
//--></script>
<script language="JavaScript" src="../include/mm_menu.js"></script>
<script language="JavaScript">
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

</script>
</head>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" onLoad="return onloadfocus()" >
<script language="JavaScript1.2">mmLoadMenus();</script>
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1004">
	
	<?php require_once("../include/header_admin.php");?>
	</td>
  </tr>
  <tr>
  <td>
  <table width="1004" height="15" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" height="15"><img src="../images/topleftcorner.gif" width="15" /></td>
  <td width="974" height="15" background="../images/topbg.gif" style="background-repeat:repeat"></td>
  <td width="15" height="15"><img src="../images/toprightcorner1.gif" width="15" style="padding-bottom:0px" /></td>
  </tr>
  </table>
  <table width="1004" height="390" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" background="../images/columnbg.gif" style="background-repeat:repeat; padding-top:0px"></td>
  <td width="974" valign="top">
 
  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Sub-Bin Master - Add Sub-Bin </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	 $sql1=mysql_query("select * from tbl_subbin")or die(mysql_error());
    	$noticia=mysql_fetch_array($sql1);
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
</tr>
<tr>
<td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Sub-Bin </td>
</tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
 
 <?php
$quer3=mysql_query("SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Light" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">&nbsp;Select Warehouse Number&nbsp;&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select warehouse--</option>
	<?php while($noticia = mysql_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['whid'];?>" />   
		<?php echo $noticia['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<tr class="Light" height="25">
		<?php
$quer4=mysql_query("SELECT DISTINCT binname,binid FROM tbl_bin order by binname Asc"); 
?>
           <td width="318"  align="right"  valign="middle" class="tblheading">&nbsp;Select Bin Number&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtbin" style="width:170px;" tabindex="" >
		<option value="">--Select Bin--</option>
	<?php while($noticia = mysql_fetch_array($quer4)) { ?>
		<option <?php if($noticia['binid']==$row['binid']) { echo "Selected"; }?> value="<?php echo $noticia['binid'];?>" />  
		<?php echo $noticia['binname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</option>
         </tr>
<tr class="Light" height="25">
           <td width="318"  align="right"  valign="middle" class="tblheading">Sub-Bin Number&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select name="txtsbin" class="tbltext"  style="width:170px;" tabindex="">
          <option value="">--Select Sub-bin no--</option>
         <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
          <option value="32">32</option>
          <option value="33">33</option>
          <option value="34">34</option>
          <option value="35">35</option>
		   <option value="36">36</option>
          <option value="37">37</option>
          <option value="38">38</option>
          <option value="39">39</option>
          <option value="40">40</option>
          <option value="41">41</option>
          <option value="42">42</option>
          <option value="43">43</option>
          <option value="44">44</option>
          <option value="45">45</option>
          <option value="46">46</option>
          <option value="47">47</option>
          <option value="48">48</option>
          <option value="49">49</option>
          <option value="50">50</option>
          <option value="51">51</option>
          <option value="52">52</option>
          <option value="53">53</option>
          <option value="54">54</option>
          <option value="55">55</option>
          <option value="56">56</option>
          <option value="57">57</option>
          <option value="58">58</option>
          <option value="59">59</option>
          <option value="60">60</option>
          <option value="61">61</option>
          <option value="62">62</option>
          <option value="63">63</option>
          <option value="64">64</option>
          <option value="65">65</option>
          <option value="66">66</option>
          <option value="67">67</option>
          <option value="68">68</option>
          <option value="69">69</option>
          <option value="70">70</option>
		   <option value="71">71</option>
          <option value="72">72</option>
          <option value="73">73</option>
          <option value="41">74</option>
          <option value="75">75</option>
          <option value="76">76</option>
          <option value="77">77</option>
          <option value="78">78</option>
          <option value="79">79</option>
          <option value="80">80</option>
          <option value="81">81</option>
          <option value="82">82</option>
          <option value="83">83</option>
          <option value="84">84</option>
          <option value="85">85</option>
          <option value="86">86</option>
          <option value="87">87</option>
          <option value="88">88</option>
          <option value="89">89</option>
          <option value="90">90</option>
          <option value="91">91</option>
		   <option value="92">92</option>
          <option value="93">93</option>
          <option value="94">94</option>
          <option value="95">95</option>
          <option value="96">96</option>
          <option value="97">97</option>
          <option value="98">98</option>
          <option value="99">99</option>
          
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
</table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="subbin_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:hand;"></td>
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
</td>
  <td width="15" background="../images/columnbgright1.gif" style="background-repeat:repeat; padding-top:0px"></td>
  </tr>
  </table>
  <table width="1004" height="15" border="0" cellspacing="0" cellpadding="0">
	<tr>
  <td width="15" height="15"><img src="../images/bottomleft.gif" width="15" /></td>
  <td width="974" height="15" background="../images/bottombg.gif" style="background-repeat:repeat"></td>
  <td width="15" height="15"><img src="../images/bottomright.gif" width="15" style="padding-bottom:0px" /></td>
  </tr>
  </table>
  
  <?php require_once("../include/footer.php");?>
  </td>
  </tr>
</table>

</body>
</html>
