<?php
require_once 'db.php';
session_start();
if (isset($_SESSION['s_email'])) {
    $stmt = $conn->prepare("SELECT CAST(ROUND(AVG(rating) * 2) / 2 AS DECIMAL(2,1)) AS avg_rating FROM review WHERE receiver = ?");
    $stmt->bind_param('s', $_SESSION['s_email']);
    $stmt->execute();
    $stmt->bind_result($avg_rating);
    $stmt->fetch();
    echo  $avg_rating;
    $stmt->close();
} else {
    echo "Session email not set.";
}
