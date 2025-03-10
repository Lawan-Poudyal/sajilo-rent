<?php

include("db.php");

// Define the tolerance level
$tolerance = 0.000001;

// Read the CSV file to get the order of coordinates
$csvFile = '/opt/lampp/htdocs/sajilo-rent/algorithms_dataAnalysis/clusteredData_latlng.csv';
$csvData = [];
if (!file_exists($csvFile)) {
    die("File not found: " . $csvFile);
}

if (($handle = fopen($csvFile, 'r')) !== false) {
    fgetcsv($handle); // Skip the header row
    while (($data = fgetcsv($handle)) !== false) {
        $csvData[] = ['latitude' => trim($data[0]), 'longitude' => trim($data[1])];
    }
    fclose($handle);
}

// Retrieve all room data from the database
$stmt = $conn->prepare("SELECT * FROM housedetails");
if (!$stmt) {
    die('Query preparation failed: ' . $conn->error);
}
$stmt->execute();
$result = $stmt->get_result();

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

$stmt->close();
$conn->close();

// Sort the room data based on the CSV coordinate order with tolerance
$sortedRooms = [];
$remainingRooms = $rooms; // Copy all rooms to track remaining unmatched entries

foreach ($csvData as $coord) {
    $latitude = $coord['latitude'];
    $longitude = $coord['longitude'];

    foreach ($rooms as $key => $room) {
        // Check if latitude and longitude are within the tolerance range
        if (
            abs($room['latitude'] - $latitude) < $tolerance &&
            abs($room['longitude'] - $longitude) < $tolerance
        ) {

            $sortedRooms[] = $room; // Add the matched room to the sorted list
            unset($remainingRooms[$key]); // Remove matched room from remaining list
            break; // Stop checking further for this coordinate
        }
    }
}

// Append unmatched database entries to the end of the sorted list
$sortedRooms = array_merge($sortedRooms, $remainingRooms);

// Generate the HTML for the sorted room data
$roomsHTML = '';

if (!empty($sortedRooms)) {
    foreach ($sortedRooms as $room) {
        $roomsHTML .= '<div class="room-container">
                <div class="products-image-container">
                    <img src="/sajilo-rent/user-panel/back_end/' . htmlspecialchars($room['image1']) . '" class="product-img" />
                </div>

                <div class="product-title limit-to-2-lines">' . htmlspecialchars($room['username']) . '</div>
                <div class="product-rating">
                    <img src="../resources/ratings/rating-45.png" class="product-rating-star" />
                    <span class="product-rating-count">10</span>
                </div>
                <div class="product-price">Rs ' . htmlspecialchars($room['price']) . '</div>

                <div class="button-container">
                    <button class="location-button button-primary js-location-button" data-room-lat="' . htmlspecialchars($room['latitude']) . '" data-room-lng="' . htmlspecialchars($room['longitude']) . '">Location</button>
                    <button class="details-button js-details-button button-primary" data-room-lat="' . htmlspecialchars($room['latitude']) . '" data-room-lng="' . htmlspecialchars($room['longitude']) . '">Details</button>
                </div>
            </div>';
    }
} else {
    echo "<p>No Rooms found.</p>";
}
