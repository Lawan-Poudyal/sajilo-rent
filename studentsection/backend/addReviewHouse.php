<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file
require_once 'db.php';

$stmt = $conn->prepare("SELECT lat, lng FROM booked WHERE email = ?");
$stmt->bind_param("s", $_SESSION['s_email']);

if (!$stmt->execute()) {
    die("Cannot execute");
}

$result = $stmt->get_result();
$latLngData = [];
if ($result->num_rows > 0) {
    $latLngData = $result->fetch_assoc();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reviewer = manipulateData($_POST['houseReview']);
    
    // Ensure $latLngData keys are set
    if (!empty($latLngData['lat']) && !empty($latLngData['lng'])) {
        $stmt = $conn->prepare("INSERT INTO review_house (reviewer, lat, lng,rating, comment) VALUES (?, ?, ?,?, ?)");
        $rating = 5;
        // Use correct data types (assuming lat/lng are doubles)
        $stmt->bind_param("sddis", $_SESSION['s_email'], $latLngData['lat'], $latLngData['lng'],$rating ,$reviewer);
        
        if ($stmt->execute()) {
            $response['status'] = 'success';
            echo json_encode($response);
        }
        else{
            $response['status'] = 'failure';
            echo json_encode($response);
        }
        $stmt->close();
    } else {
        die("No latitude/longitude data found for the given email");
    }
}

function manipulateData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
