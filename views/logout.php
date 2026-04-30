<?php
session_start();

// 🔥 Unset all session variables
$_SESSION = [];

// 🔥 Destroy session
session_destroy();

// 🔒 Optional: delete session cookie
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Redirect to login page
header("Location: /ams");
exit;