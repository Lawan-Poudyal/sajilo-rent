<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_database');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select latitude and longitude
$query = 'SELECT latitude, longitude FROM housedetails';

// Prepare the statement
$stms = $conn->prepare($query);
if ($stms === false) {
    die("Error preparing the statement: " . $conn->error);
}

// Execute the statement
$stms->execute();

// Get the result
$result = $stms->get_result();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Fetch and display each row
    $myfile = fopen("lat.txt", "w") or die("Unable to open file!");
    $myfile2 = fopen("lng.txt", "w") or die("Unable to open file!");
    while ($row = $result->fetch_assoc()) {
      fwrite($myfile,$row['latitude']."\n");
      fwrite($myfile2,$row['longitude']."\n");
    }
    fclose($myfile);
    fclose($myfile2);
} else {
    echo "No records found.";
}

// Close the statement and connection
$stms->close();
$conn->close();
?>