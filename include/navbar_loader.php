<?php
/**
 * Centralized Navbar Loader - include/navbar_loader.php
 * Automatically includes the correct navbar based on user's role
 * 
 * Usage in any page:
 * <?php include '../include/navbar_loader.php'; ?>
 * OR (from root level):
 * <?php include 'include/navbar_loader.php'; ?>
 */

// Get the directory where navbar_loader.php is located (include/)
$navbar_dir = dirname(__FILE__) . '/';
$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$slash_count = substr_count($request_uri, '/');

// If we have more than 2 slashes, we're in a subdirectory
if ($slash_count > 2) {
    // We're in a subdirectory (Transaction/, Reports/, etc.)
    $base_path = '../';
} else {
    // We're at the root level (indexopr.php, index1.php, etc.)
    $base_path = '';
}

// Get user role from session
$user_role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : 'viewer';
switch ($user_role) {
    case 'admin':
        $navbar_file = $navbar_dir . 'navbar_admin.php';
        break;
    case 'operator':
        $navbar_file = $navbar_dir . 'navbar_operator.php';
        break;
    case 'eindent':
    case 'e-indent':
        $navbar_file = $navbar_dir . 'navbar_eindent.php';
        break;
    case 'viewer':
    default:
        $navbar_file = $navbar_dir . 'navbar_viewer.php';
        break;
}

// Include the appropriate navbar from include directory
if (file_exists($navbar_file)) {
    include $navbar_file;
} else {
    // Debug: show what went wrong
    echo "<!-- Navbar file not found: $navbar_file -->";
}
?>
