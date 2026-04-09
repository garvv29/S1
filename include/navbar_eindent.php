<?php
// E-INDENT ROLE - Centralized Navbar
// Path: include/navbar_eindent.php

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
              <li><a href="<?php echo $base_path; ?>indexindet.php">E-Indent</a>
                <ul>
                  <li><a href="<?php echo $base_path; ?>Transaction/home_pending_indents.php">&nbsp;Pending&nbsp;Indents</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/approved_indents.php">&nbsp;Approved&nbsp;Indents</a></li>
                  <li><a href="<?php echo $base_path; ?>Transaction/indent_history.php">&nbsp;Indent&nbsp;History</a></li>
                </ul>
              </li>
              <li><a href="#">Reports</a>
                <ul>
                  <li><a href="<?php echo $base_path; ?>reports/stockonhandreport.php">&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/partywiseperiodreport.php">&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                  <li><a href="<?php echo $base_path; ?>reports/storesitamledger.php">&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="toplinks" style="vertical-align:text-top">
          <ul style="vertical-align:text-top">
            <li><a href="<?php echo $base_path; ?>Transaction/indentProfile.php">Profile</a> |</li>
            <li>&nbsp;<a href="<?php echo $base_path; ?>Transaction/help.php">Help</a> |</li>
            <li>&nbsp;<a href="<?php echo $base_path; ?>logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </td>
  </tr>
</table>
