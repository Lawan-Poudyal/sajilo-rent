<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
exit;
?>