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

$classid = isset($_GET['classid']) ? $_GET['classid'] : 0;
$itemid = isset($_GET['itemid']) ? $_GET['itemid'] : 0;
$ups = isset($_GET['ups']) ? $_GET['ups'] : 0;

// Handle form submission - user selects QR codes
if(isset($_POST['frm_action']) && $_POST['frm_action'] == 'submit')
{
    // Get selected QR codes
    $selected_qrs = isset($_POST['selected_qrs']) ? $_POST['selected_qrs'] : '';
    
    if($selected_qrs != '')
    {
        $qr_ids = explode(',', $selected_qrs);
        
        // Update tbl_qr_codes - set used = 1 for selected QR codes
        foreach($qr_ids as $qr_id)
        {
            $qr_id = trim($qr_id);
            if($qr_id != '')
            {
                $sql_update = "UPDATE tbl_qr_codes SET used = 1 WHERE qr_id = '$qr_id'";
                mysql_query($sql_update) or die(mysql_error());
            }
        }
        
        // Return to parent window with count
        $qr_count = count(array_filter($qr_ids));
        echo '<script>';
        echo "if(window.opener && !window.opener.closed) {";
        echo "  window.opener.setScannedQRs($qr_count);";
        echo "  window.opener.document.getElementsByName('scanned_qr_ids')[0].value = '$selected_qrs';";
        echo "}";
        echo "window.close();";
        echo '</script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QR Code Selection - Physical Indent</title>
<link href="../include/main.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<style>
.qr_list {
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #ccc;
    padding: 10px;
}
.qr_item {
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    border-radius: 4px;
}
.qr_item input[type="checkbox"] {
    margin-right: 10px;
}
.qr_item label {
    cursor: pointer;
    font-weight: bold;
}
.btn {
    padding: 8px 15px;
    margin: 5px;
    font-weight: bold;
    border: 1px solid #999;
    background-color: #e0e0e0;
    cursor: pointer;
    border-radius: 4px;
}
.btn:hover {
    background-color: #d0d0d0;
}
.btn_submit {
    background-color: #90EE90;
}
.btn_cancel {
    background-color: #FFB6C1;
}
</style>
</head>
<body style="margin:5px; font-family:Arial;">

<div style="background-color:#4ea1e1; color:white; padding:10px; text-align:center; font-weight:bold; border-radius:4px;">
    QR Code Selection for Roll Items
</div>

<br/>

<!-- Get available QR codes -->
<?php
// Get QR codes that are NOT used and NOT finalsubmitted
$sql_qr = "SELECT qr_id, qr_code, qr_weight FROM tbl_qr_codes 
           WHERE used != 1 AND finalsubmit != 2 
           ORDER BY qr_code ASC";
$res_qr = mysql_query($sql_qr) or die(mysql_error());
$total_qr = mysql_num_rows($res_qr);
?>

<form name="frmQR" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="frm_action" value="submit">
<input type="hidden" name="classid" value="<?php echo $classid; ?>">
<input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
<input type="hidden" name="ups" value="<?php echo $ups; ?>">
<input type="hidden" name="selected_qrs" value="">

<p style="text-align:center; font-weight:bold;">
    Available QR Codes: <?php echo $total_qr; ?>
    <br/>
    <span style="font-size:12px; color:#666;">Select QR codes to scan</span>
</p>

<div class="qr_list">
    <?php
    if($total_qr > 0)
    {
        $qr_count = 0;
        while($row_qr = mysql_fetch_array($res_qr))
        {
            $qr_count++;
            $qr_id = $row_qr['qr_id'];
            $qr_code = $row_qr['qr_code'];
            $qr_weight = $row_qr['qr_weight'];
            ?>
            <div class="qr_item">
                <input type="checkbox" name="qr_check_<?php echo $qr_id; ?>" value="<?php echo $qr_id; ?>" id="qr_<?php echo $qr_id; ?>">
                <label for="qr_<?php echo $qr_id; ?>">
                    QR Code: <?php echo $qr_code; ?> | Weight: <?php echo $qr_weight; ?> kg
                </label>
            </div>
            <?php
        }
    }
    else
    {
        echo '<p style="text-align:center; color:#ff0000; font-weight:bold;">No available QR codes found!</p>';
    }
    ?>
</div>

<br/>

<div style="text-align:center;">
    <button type="button" class="btn btn_submit" onclick="submitSelection();">Submit Selection</button>
    <button type="button" class="btn btn_cancel" onclick="window.close();">Cancel</button>
</div>

</form>

<script>
function submitSelection()
{
    // Get all checked QR codes
    var selected_qrs = [];
    var checkboxes = document.frmQR.getElementsByTagName('input');
    
    for(var i = 0; i < checkboxes.length; i++)
    {
        if(checkboxes[i].type == 'checkbox' && checkboxes[i].checked)
        {
            selected_qrs.push(checkboxes[i].value);
        }
    }
    
    if(selected_qrs.length == 0)
    {
        alert('Please select at least one QR code');
        return false;
    }
    
    // Set the hidden field and submit
    document.frmQR.selected_qrs.value = selected_qrs.join(',');
    document.frmQR.submit();
}
</script>

</body>
</html>
