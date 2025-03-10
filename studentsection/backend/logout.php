<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

unset($_SESSION['s_username']);
unset($_SESSION['s_email']);

// Redirect to login page
exit;
?>