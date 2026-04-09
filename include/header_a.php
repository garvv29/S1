<title>Expro</title>
<?php
/*$loginid=$_SESSION['loginid'];*/
?>
<table width="1004" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="185" height="90"><a href="index.php"  style="border:none" ><img src="../images/exprologo1.gif" width="183" height="89" border="0" /></a> </td>
        <td width="819" height="90">
		<table border="0" cellpadding="0" cellspacing="0">
          <tr>
           <td height="60" width="805" valign="bottom" align="right">
			<table align="right" class="submenufont" height="40" cellpadding="0" cellspacing="0">
			<tr>
			<td align="right"><a href="empprofile.php" >Profile</a></td>
			</tr>
			<tr>
			<td  align="right"><a href="help_manual.php" >Help</a></td>
			</tr>
			<tr>
            <td  align="right"><a href="faq_manual.php" >FAQ</a></td>
          </tr>
		  <tr>
		  <td  align="right"><a href="../logout.php" >Logout</a></td>
		  </tr>
		  </table>
		  </td>
          </tr>
          <tr>
            <td height="30" width="819">
			<table width="819" cellspacing="2" cellpadding="0" height="30">
          <td bgcolor="#b9d647" width="5"></td>
                  <td width="665" bgcolor="#b9d647" class="menufont" ><a href="#" name="link1" id="link1" onmouseover="MM_showMenu(window.mm_menu_0203121722_0,0,19,null,'link1')" onmouseout="MM_startTimeout();">Transaction</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" name="link2" id="link2" onmouseover="MM_showMenu(window.mm_menu_0203122252_0,0,19,null,'link2')" onmouseout="MM_startTimeout();">View</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" name="link3" id="link3" onmouseover="MM_showMenu(window.mm_menu_0203122320_0,0,19,null,'link3')" onmouseout="MM_startTimeout();">Utility</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WelCome <?php echo $loginid;?></td>
            <td width="132" align="right" bgcolor="#b9d647" class="tbldtext"><?php echo date("d M Y H:i:s", time());?>&nbsp;&nbsp;</td>
                <td width="5" bgcolor="#b9d647"></td>
          </table>
			</td>
          </tr>
        </table>
		</td>
      </tr>
    </table>