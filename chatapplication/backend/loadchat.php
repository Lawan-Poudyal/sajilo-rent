<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

$sender = $_REQUEST['sender'];
$reciever = $_REQUEST['reciever'];
$status = $_REQUEST['status'];
$jsonarray = [];
$studentorowner = '';
$seenornot = null; // Initialize with null

$conn = new mysqli('localhost', 'root', '', 'user_database');
if($conn->connect_error) {
    die(''. $conn->connect_error);
}

// First query to get the chat messages
$query = "SELECT chat.sender, chat.reciever, chat.id, chat.message, verified_users.status, chat.seenornot FROM chat 
INNER JOIN verified_users ON verified_users.email = chat.sender 
WHERE (chat.sender = ? AND chat.reciever = ?) 
   OR (chat.reciever = ? AND chat.sender = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $sender, $reciever, $sender, $reciever);

if(!$stmt->execute()) {
    die("Query execution error");
}

$result = $stmt->get_result();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {   
        array_push($jsonarray, [
            "sender" => $row['sender'], 
            "reciever" => $row['reciever'], 
            "message" => $row['message'], 
            "seenornot" => $row['seenornot'], 
            'id' => $row['id']
        ]);
        $studentorowner = $row['status'];
        
        // Process each message's seen status individually if needed
        $currentSeenStatus = $row['seenornot'];
        
        // Determine new seen status for this message
        $newSeenStatus = $currentSeenStatus; // Default to keeping current status
        
        if ($currentSeenStatus === 'unseen') {
            if ($status === 'student') {
                $newSeenStatus = 'studentseen';
            } else if ($status === 'owner') {
                $newSeenStatus = 'ownerseen';
            }
        } else if ($currentSeenStatus === 'studentseen' && $status === 'owner') {
            $newSeenStatus = 'seen';
        } else if ($currentSeenStatus === 'ownerseen' && $status === 'student') {
            $newSeenStatus = 'seen';
        }
        
        // Update each message individually if status has changed
        if ($newSeenStatus !== $currentSeenStatus) {
            $updateQuery = "UPDATE chat SET seenornot = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("si", $newSeenStatus, $row['id']);
            if(!$updateStmt->execute()) {
                echo 'Error updating message ID: ' . $row['id'];
            }
            $updateStmt->close();
        }
    }
} else {
    // No messages found
    // Nothing to update, just return empty array
}

$stmt->close();
$conn->close();
echo json_encode($jsonarray);
?>