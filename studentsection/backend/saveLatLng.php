<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $_SESSION['latitude'] = $_POST['latitude'];
        $_SESSION['longitude'] = $_POST['longitude'];
        echo "Session stored successfully!" .  $_SESSION['latitude'];
    } else {
        echo "Missing parameters.";
    }
} else {
    echo "Invalid request.";
}
