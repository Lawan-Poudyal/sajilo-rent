<?php
session_start();

// Check if the location is set in the session
if (isset($_SESSION['location'])) {
    echo json_encode([
        "status" => "success",
        "lat" => $_SESSION['location']['lat'],
        "lng" => $_SESSION['location']['lng']
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "No location found."]);
}
