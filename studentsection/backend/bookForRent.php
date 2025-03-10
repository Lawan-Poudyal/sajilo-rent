<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

session_start(); // Start the session

require_once 'db.php';

// Initialize response variable
$response = ['status' => 'error', 'message' => 'An unknown error occurred'];

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
        $seen = 'no'; 
        
        $stmt = $conn->prepare("INSERT INTO rentrequest (sender, receiver, lat, lng, seen) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die(json_encode(['status' => 'error', 'message' => 'Failed to prepare insert SQL statement']));
        }

        $stmt->bind_param("ssdds", $studentName, $owner, $lat, $lng, $seen); 
        
        try {
            if ($stmt->execute()) {
                $response = [
                    'status' => 'success',
                    'success' => true,
                    'message' => 'Rent Request Sent Successfully'
                ];
            } else {
                //duplicate entry checking
                if ($stmt->errno == 1062) {
                    $response = [
                        'status' => 'error',
                        'success' => false,
                        'message' => 'Request already sent'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'success' => false,
                        'message' => "Error: " . $stmt->error
                    ];
                }
            }
        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage()
            ];
        } finally {
            // Close the statement in all cases
            $stmt->close();
        }
    } else {
        $response = [ 
            'status' => 'error',
            'success' => false,
            'message' => 'Invalid input data'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'success' => false,
        'message' => 'Already Booked'
    ];
}

$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>