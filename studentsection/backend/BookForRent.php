<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

session_start(); // Start the session

require_once 'db.php';

if (!isset($_SESSION['s_email'])) {
    die(json_encode(['status' => 'error', 'message' => 'Session email not found']));
}

$alreadyBooked = false;

$stmt = $conn->prepare("SELECT email from booked where email = ?");
if ($stmt === false) {
    error_log("Prepare failed: " . $conn->error);
    die(json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement']));
}
$stmt->bind_param('s', $_SESSION['s_email']);
$stmt->execute(); // Execute the query before fetching results
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $alreadyBooked = true;
}

// Close the first statement before continuing
$stmt->close();

if (!$alreadyBooked) {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['student'], $data['owner'], $data['lat'], $data['lng'])) {
        $studentName = $data['student'];
        $owner = $data['owner'];
        $lat = $data['lat'];
        $lng = $data['lng'];
        $seen = 'no'; // Assuming a default value for the 'seen' column

        // Prepare the insert statement
        $stmt = $conn->prepare("INSERT INTO rentrequest (sender, receiver, lat, lng, seen) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            error_log("Prepare failed: " . $conn->error);
            die(json_encode(['status' => 'error', 'message' => 'Failed to prepare insert SQL statement']));
        }

        $stmt->bind_param("ssdds", $studentName, $owner, $lat, $lng, $seen); // Corrected bind_param types
        $response = [];

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . $stmt->error;
        }

        // Close the second statement after executing
        $stmt->close();
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid input data'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Already Booked'];
}

$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
