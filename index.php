<?php
session_start(); 

require_once 'core/Router.php';

$base = '/ams';

$router = new Router();

// Define routes
//Rember get and post methods
$router->get('', 'views/home.php');

$router->get('login', 'views/login.php');
$router->post('api/login', 'controllers/AuthController@login');

$router->get('register', 'views/register.php');
$router->post('api/register', 'controllers/AuthController@register');
$router->get('dashboard', 'views/dashboard.php');
$router->get('logout', 'views/logout.php');


//QR code scanner ========>
$router->get('qrcode', 'views/qrcode.php');
$router->POST('api/qr_code_scanner', 'controllers/AttendanceController@attendance_log');
//QR code scanner ========>

//Attendance ========>
$router->get('start_attendance', 'views/start_attendance.php');
$router->get('api/attendance_gathering_types', 'controllers/GatheringController@gathering_list');
//Attendance ========>

//settings  ========>
$router->get('settings', 'views/settings.php');
$router->post('api/locale_insert', 'controllers/SettingController@locale_insert');
$router->get('api/locale_list', 'controllers/SettingController@locale_list');
$router->post('api/locale_edit', 'controllers/SettingController@locale_edit');
$router->post('api/locale_delete', 'controllers/SettingController@locale_delete');
$router->get('api/get_locales', 'controllers/SettingController@get_locales');

$router->post('api/gathering_insert', 'controllers/GatheringController@gathering_insert');
$router->get('api/gathering_list', 'controllers/GatheringController@gathering_list');
$router->post('api/gathering_edit', 'controllers/GatheringController@gathering_edit');
$router->post('api/gathering_delete', 'controllers/GatheringController@gathering_delete');
//end settings ========>

//profiles  ========>
$router->get('profiles', 'views/profiles.php');
$router->get('profiles_add', 'views/profiles_add.php');
$router->post('api/profiles_add', 'controllers/ProfileController@profile_insert');
$router->get('api/profiles', 'controllers/ProfileController@get_minimum_profiles');
$router->get('api/profiles_getMinimum', 'controllers/ProfileController@loadMinimumProfiles');
//end profiles ========>

$router->get('reports', 'views/reports.php');

$url = $_GET['url'] ?? '';


// 🔥 IMPORTANT: handle API separately
if (str_starts_with($url, 'api/')) {
    $router->dispatch($url);
    exit;
}

// Normal page rendering
ob_start();
$router->dispatch($url);
$content = ob_get_clean();

$title = ucfirst($url ?: 'MCGI-AMS');

$basic_layout = ["MCGI-AMS", "Login", "Register"];


if(in_array($title, $basic_layout)){
     require 'views/basic_layout.php';
    if(isset($_SESSION['userId'])){
        header("Location: dashboard");
    }
} else {
    require 'views/admin_layout.php';
}
