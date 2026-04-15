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
}
require_once("../include/config.php");
require_once("../include/connection.php");

// Get filter parameters
$search_date = isset($_GET['search_date']) ? trim($_GET['search_date']) : '';
$search_user = isset($_GET['search_user']) ? trim($_GET['search_user']) : '';
$search_item = isset($_GET['search_item']) ? trim($_GET['search_item']) : '';
$search_status = isset($_GET['search_status']) ? trim($_GET['search_status']) : '';

// Admin can see all logs, Operator sees only their own
$admin_role_list = array('admin', 'administrator', 'Admin', 'super_admin');
$is_admin = in_array($role, $admin_role_list);

// Build WHERE clause
$where_conditions = array();
$where_conditions[] = "q.used = 1";

if(!$is_admin) {
    $where_conditions[] = "q.created_by = '" . mysql_real_escape_string($username) . "'";
} elseif(!empty($search_user)) {
    $where_conditions[] = "q.created_by LIKE '%" . mysql_real_escape_string($search_user) . "%'";
}

if(!empty($search_date)) {
    $where_conditions[] = "DATE(q.scandate) = '" . mysql_real_escape_string($search_date) . "'";
}

if(!empty($search_item)) {
    $where_conditions[] = "s.stores_item LIKE '%" . mysql_real_escape_string($search_item) . "%'";
}

if(!empty($search_status)) {
    $where_conditions[] = "q.finalsubmit = '" . mysql_real_escape_string($search_status) . "'";
}

$where_clause = "WHERE " . implode(" AND ", $where_conditions);

// Count total scans
$sql_count = "SELECT COUNT(*) as total FROM tbl_qr_codes q LEFT JOIN tbl_stores s ON q.item_id = s.items_id LEFT JOIN tbl_classification c ON q.classification_id = c.classification_id $where_clause";
$res_count = mysql_query($sql_count);
$row_count = mysql_fetch_array($res_count);
$total_records = $row_count['total'];

// Pagination
$records_per_page = 25;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if($page < 1) $page = 1;
$offset = ($page - 1) * $records_per_page;
$total_pages = ceil($total_records / $records_per_page);
if($page > $total_pages && $total_pages > 0) $page = $total_pages;

// Fetch QR scan logs
$sql = "SELECT q.qr_id, q.qr_code_text, q.weight, q.scandate, q.created_by, q.finalsubmit, q.used, s.stores_item, s.uom, c.classification, c.classification_type FROM tbl_qr_codes q LEFT JOIN tbl_stores s ON q.item_id = s.items_id LEFT JOIN tbl_classification c ON q.classification_id = c.classification_id $where_clause ORDER BY q.scandate DESC LIMIT $offset, $records_per_page";
$result = mysql_query($sql);
$num_rows = mysql_num_rows($result);

// Calculate stats
$sql_stats = "SELECT COUNT(*) as total_scans, COUNT(DISTINCT DATE(q.scandate)) as days_with_scans, COUNT(DISTINCT q.created_by) as unique_users, SUM(q.weight) as total_weight FROM tbl_qr_codes q LEFT JOIN tbl_stores s ON q.item_id = s.items_id LEFT JOIN tbl_classification c ON q.classification_id = c.classification_id $where_clause";
$res_stats = mysql_query($sql_stats);
$stats = mysql_fetch_array($res_stats);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stores - Utility - QR Scan Logs</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
</head>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><?php include '../include/navbar_loader.php'; ?>
      <table width="100%" style="z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center" class="midbgline">
<table width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647">
  <tr>
    <td><table width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647">
      <tr style="padding:0px 0px 0px 0px">
        <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
        <td width="940" class="Mainheading" height="25"><table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1">
          <tr>
            <td width="813" height="25" class="Mainheading">QR Code Scan Logs</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" colspan="4">
      <form name="frmFilter" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table border="0" cellspacing="0" cellpadding="0" align="center" width="974" style="border-collapse:collapse">
          <tr height="7"><td height="7"></td></tr>
          <tr>
            <td width="30"></td>
            <td><table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
              <tr class="tblsubtitle" height="25">
                <td colspan="6" align="center" class="tblheading">Filter QR Scan Logs</td>
              </tr>
              <tr class="Light" height="25">
                <td align="right" valign="middle" class="tblheading" width="120">Scan Date&nbsp;</td>
                <td align="left" valign="middle" width="150">&nbsp;<input name="search_date" type="date" class="tbltext" value="<?php echo htmlspecialchars($search_date); ?>" style="width:120px;" /></td>
                <td align="right" valign="middle" class="tblheading" width="120">Item Name&nbsp;</td>
                <td align="left" valign="middle" width="200">&nbsp;<input name="search_item" type="text" class="tbltext" placeholder="Item name..." value="<?php echo htmlspecialchars($search_item); ?>" style="width:160px;" /></td>
                <td align="right" valign="middle" class="tblheading" width="100">Status&nbsp;</td>
                <td align="left" valign="middle" width="180">&nbsp;<select name="search_status" class="tbltext" style="width:120px;"><option value="">---------ALL-------</option><option value="0" <?php if($search_status == '0') echo 'selected'; ?>>Draft</option><option value="2" <?php if($search_status == '2') echo 'selected'; ?>>Finalized</option></select></td>
              </tr>
              <tr class="Dark" height="25">
                <td align="center" valign="middle" colspan="6">&nbsp;<input name="submit" type="submit" class="tbltext" value="Search" style="width:80px;" />&nbsp;&nbsp;<input name="reset" type="reset" class="tbltext" value="Clear" style="width:60px;" /></td>
              </tr>
              <?php if($is_admin) { ?>
              <tr class="Light" height="25">
                <td align="right" valign="middle" class="tblheading">Scanned By&nbsp;</td>
                <td align="left" valign="middle" colspan="5">&nbsp;<input name="search_user" type="text" class="tbltext" placeholder="Username..." value="<?php echo htmlspecialchars($search_user); ?>" style="width:200px;" /></td>
              </tr>
              <?php } ?>
            </table></td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
  <tr height="15"><td colspan="4"></td></tr>
  <tr>
    <td align="center">
      <table border="0" cellspacing="5" cellpadding="0" align="center" width="914">
        <tr>
          <td align="center" width="22%"><table border="1" cellspacing="0" cellpadding="5" bordercolor="#4ea1e1" style="border-collapse:collapse" bgcolor="#E8F4FD">
            <tr><td align="center" class="tblheading">Total Scans</td></tr>
            <tr><td align="center" style="font-size:16px; font-weight:bold; color:#2196F3;"><?php echo number_format($stats['total_scans']); ?></td></tr>
          </table></td>
          <td align="center" width="22%"><table border="1" cellspacing="0" cellpadding="5" bordercolor="#4ea1e1" style="border-collapse:collapse" bgcolor="#E8F4FD">
            <tr><td align="center" class="tblheading">Days Active</td></tr>
            <tr><td align="center" style="font-size:16px; font-weight:bold; color:#2196F3;"><?php echo number_format($stats['days_with_scans']); ?></td></tr>
          </table></td>
          <td align="center" width="22%"><table border="1" cellspacing="0" cellpadding="5" bordercolor="#4ea1e1" style="border-collapse:collapse" bgcolor="#E8F4FD">
            <tr><td align="center" class="tblheading">Unique Users</td></tr>
            <tr><td align="center" style="font-size:16px; font-weight:bold; color:#2196F3;"><?php echo number_format($stats['unique_users']); ?></td></tr>
          </table></td>
          <td align="center" width="22%"><table border="1" cellspacing="0" cellpadding="5" bordercolor="#4ea1e1" style="border-collapse:collapse" bgcolor="#E8F4FD">
            <tr><td align="center" class="tblheading">Total Weight</td></tr>
            <tr><td align="center" style="font-size:16px; font-weight:bold; color:#2196F3;"><?php echo number_format(round($stats['total_weight'], 2)); ?> kg</td></tr>
          </table></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr height="15"><td colspan="4"></td></tr>
  <tr>
    <td align="center">
      <?php if($num_rows > 0) { ?>
      <table border="0" cellspacing="0" cellpadding="0" align="center" width="974" style="border-collapse:collapse">
        <tr height="7"><td height="7"></td></tr>
        <tr>
          <td width="30"></td>
          <td><table align="center" border="1" width="914" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="25">
              <td colspan="7" align="center" class="tblheading">QR Scan Records - <?php echo ($offset + 1) . ' to ' . min($offset + $records_per_page, $total_records) . ' of ' . number_format($total_records); ?></td>
            </tr>
            <tr class="Dark" height="25">
              <td width="80" align="center" class="tblheading">QR Code</td>
              <td width="200" align="center" class="tblheading">Item Name</td>
              <td width="120" align="center" class="tblheading">Classification</td>
              <td width="80" align="center" class="tblheading">Weight</td>
              <td width="100" align="center" class="tblheading">Scanned By</td>
              <td width="160" align="center" class="tblheading">Scan Date & Time</td>
              <td width="80" align="center" class="tblheading">Status</td>
            </tr>
            <?php
            $row_class = "Light";
            while($row = mysql_fetch_array($result)) {
                $scan_datetime = $row['scandate'] ? date('d-M-Y H:i:s', strtotime($row['scandate'])) : 'N/A';
                $item_name = $row['stores_item'] ? htmlspecialchars($row['stores_item']) : 'Unknown';
                $classification = $row['classification'] ? htmlspecialchars($row['classification']) : 'N/A';
                $weight = $row['weight'] ? number_format($row['weight'], 2) : '0.00';
                $created_by = htmlspecialchars($row['created_by']);
                $qr_short = htmlspecialchars(substr($row['qr_code_text'], 0, 12));
                $status_text = ($row['finalsubmit'] == 2) ? 'Finalized' : 'Draft';
                $status_color = ($row['finalsubmit'] == 2) ? '#4CAF50' : '#FF9800';
            ?>
            <tr class="<?php echo $row_class; ?>" height="22">
              <td align="center" valign="middle"><font size="1"><b><?php echo $qr_short; ?></b></font></td>
              <td align="left" valign="middle">&nbsp;<?php echo $item_name; ?></td>
              <td align="center" valign="middle"><font size="1"><?php echo $classification; ?></font></td>
              <td align="right" valign="middle"><font size="1"><?php echo $weight; ?>&nbsp;</font></td>
              <td align="center" valign="middle"><font size="1"><?php echo $created_by; ?></font></td>
              <td align="center" valign="middle"><font size="1"><?php echo $scan_datetime; ?></font></td>
              <td align="center" valign="middle"><font size="1" color="white" style="background-color:<?php echo $status_color; ?>; padding:2px 4px; border-radius:2px; display:inline-block;"><?php echo $status_text; ?></font></td>
            </tr>
            <?php
                $row_class = ($row_class == "Light") ? "Dark" : "Light";
            }
            ?>
          </table></td>
        </tr>
      </table>
      <?php if($total_pages > 1) { ?>
      <table border="0" cellspacing="0" cellpadding="0" align="center" width="914" style="border-collapse:collapse">
        <tr height="10"><td></td></tr>
        <tr>
          <td align="center">
            <?php
            for($i = 1; $i <= $total_pages; $i++) {
                $page_url = "qr_scan_logs.php?page=$i";
                if($search_date) $page_url .= "&search_date=" . urlencode($search_date);
                if($search_user) $page_url .= "&search_user=" . urlencode($search_user);
                if($search_item) $page_url .= "&search_item=" . urlencode($search_item);
                if($search_status) $page_url .= "&search_status=" . urlencode($search_status);
                
                if($i == $page) {
                    echo "<font color='#2196F3' size='2'><b>$i</b>&nbsp;</font>";
                } else {
                    echo "<a href='$page_url' style='color:#000000; text-decoration:none;'><font size='2'>$i</font></a>&nbsp;";
                }
            }
            ?>
          </td>
        </tr>
      </table>
      <?php } ?>
      <?php } else { ?>
      <table border="0" cellspacing="0" cellpadding="0" align="center" width="914" style="border-collapse:collapse">
        <tr height="10"><td></td></tr>
        <tr>
          <td align="center" class="tblheading"><br /><font size="2" color="#666666">No scan logs found for the selected filters.</font><br /><br /></td>
        </tr>
      </table>
      <?php } ?>
    </td>
  </tr>
</table>
          </td>
        </tr>
        <tr>
          <td width="100%" valign="bottom" align="center"><img src="../images/blue_bottomline.gif" /></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
