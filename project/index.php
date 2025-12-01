<?php
session_start();

define('BASE_URL', 'http://localhost/lab10_php_oop/project');
define('BASE_PATH', dirname(__FILE__));
define('ASSETS_URL', BASE_URL . '/assets');
define('GAMBAR_URL', ASSETS_URL . '/gambar');
define('GAMBAR_PATH', BASE_PATH . '/assets/gambar');

// Include class files
require_once 'config/database.php';
require_once 'lib/Form.php';
require_once 'lib/Auth.php';

// Initialize classes
$db = new Database();
$auth = new Auth($db);

$page = $_GET['page'] ?? 'dashboard';
$id   = $_GET['id'] ?? null;

$path_parts = explode('/', $page);
$module = $path_parts[0] ?? 'dashboard';
$action = $path_parts[1] ?? '';

$public_routes = ['auth/login'];

if (!$auth->isLoggedIn() && !in_array($page, $public_routes)) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}

// Routing modul
$allowed_modules = ['dashboard', 'barang', 'auth'];
if (!in_array($module, $allowed_modules)) {
    $module = 'dashboard';
    $action = '';
}

// Tentukan file modul
if ($module === 'dashboard') {
    $module_file = "views/dashboard.php";

} elseif ($module === 'auth') {
    $module_file = "modules/auth/{$action}.php";

} else {
    $action = $action ?: 'list';
    $module_file = "modules/{$module}/{$action}.php";
}

// Tampilkan halaman
if (file_exists($module_file)) {

    if ($module !== 'auth') include 'views/header.php';

    // Pass database and auth instances to modules
    $GLOBALS['db'] = $db;
    $GLOBALS['auth'] = $auth;
    
    include $module_file;

    if ($module !== 'auth') include 'views/footer.php';

} else {
    http_response_code(404);
    include 'views/header.php';
    echo '<div class="empty-state"><h1>404 - Halaman Tidak Ditemukan</h1></div>';
    include 'views/footer.php';
}
?>