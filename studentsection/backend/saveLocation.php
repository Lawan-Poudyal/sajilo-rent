<?php
session_start();

// Retrieve the JSON data sent from the frontend
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Save the lat and lng in the session
if (isset($data['lat']) && isset($data['lng'])) {
    $_SESSION['location'] = [
        'lat' => $data['lat'],
        'lng' => $data['lng']
    ];

    echo json_encode(["status" => "success", "message" => "Location saved successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}
