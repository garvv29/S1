<?php
// OPERATOR ROLE - Centralized Navbar
// Path: include/navbar_operator.php

// Auto-detect $base_path if not already set (for direct includes)
if (!isset($base_path)) {
    $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $slash_count = substr_count($request_uri, '/');
    $base_path = ($slash_count > 2) ? '../' : '';
}
?>
<table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top">
      <div class="headerwrapper">
        <div class="logo"><a href="#"><img src="<?php echo $base_path; ?>images/logotrac.gif" border="0" /></a></div>
        <div class="menuswrapper">
          <div id="navigation">
            <ul id="nav">
              <li><a href="#">Transactions</a>
                <ul>
                  <li><a href="<?php echo $base_path; ?>Transaction/arrival_home.php">&nbsp;Arrival</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/issue_home.php">&nbsp;Issue</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/c_c_home.php">&nbsp;Captive&nbsp;Consumption</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/add_discard.php">&nbsp;Material&nbsp;Discard</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/home_ci1.php">&nbsp;Cycle&nbsp;Inventory</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/add_arrival.php">&nbsp;SLOC&nbsp;Updation</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/reorder.php">&nbsp;Order&nbsp;Placement&nbsp;at&nbsp;Reorder</a></li>
                </ul>
              </li>
              <li><a href="#">Reports</a>
                <ul>
                  <li><a href="<?php echo $base_path; ?>reports/stockonhandreport.php">&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/partywiseperiodreport.php">&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/storesitamledger.php">&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/stocktransferreport.php">&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/captiveconsumptionreport.php">&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/discardreport.php">&nbsp;Discard&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/reorderlevelreport.php">&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/slocreport.php">&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
                </ul>
              </li>
              <li>
                <a href="#">Utility</a>
                <ul>
                  <li><a href="Javascript:void(0)" onClick="window.open('<?php echo $base_path; ?>utility/utility_bincard.php','WelCome','top=10,left=50,width=950,height=800,scrollbars=yes')">&nbsp;Sub-Bin&nbsp;Card</a></li>
                  <li><a href="Javascript:void(0)" onClick="window.open('<?php echo $base_path; ?>utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')">&nbsp;SLOC&nbsp;Search</a></li>
                  <li><a href="Javascript:void(0)" onClick="window.open('<?php echo $base_path; ?>utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')">&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
                  <li><a href="Javascript:void(0)" onClick="window.open('<?php echo $base_path; ?>utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')">&nbsp;Abbreviations</a></li>
                  <li><a href="<?php echo $base_path; ?>utility/qr_scan_logs.php">&nbsp;QR&nbsp;Scan&nbsp;Logs</a></li>
                  <!-- <li><a href="<?php echo $base_path; ?>Transaction/verify_qr_linking.php">&nbsp;Verify QR Linking</a></li> -->
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="toplinks" style="vertical-align:text-top">
          <ul style="vertical-align:text-top">
            <li><a href="<?php echo $base_path; ?>Transaction/operprofile.php">Profile</a> |</li>
            <li>&nbsp;<a href="<?php echo $base_path; ?>Transaction/help.php">Help</a> |</li>
            <li>&nbsp;<a href="<?php echo $base_path; ?>logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </td>
  </tr>
</table>
