<?php
// VIEWER ROLE - Centralized Navbar
// Path: include/navbar_viewer.php

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
          <!-- Viewer has no main menu items, only profile/help/logout -->
        </div>
        <div class="toplinks" style="vertical-align:text-top">
          <ul style="vertical-align:text-top">
            <li><a href="<?php echo $base_path; ?>Transaction/viwerprofile.php">Profile</a> |</li>
            <li>&nbsp;<a href="<?php echo $base_path; ?>Transaction/help.php">Help</a> |</li>
            <li>&nbsp;<a href="<?php echo $base_path; ?>logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </td>
  </tr>
</table>
