<?php

include("db.php");

// Read the CSV file to get the order of coordinates
$csvFile = '/sajilo-rent/algorithms_dataAnalysis/clusteredData_latlng.csv';
$csvData = [];
if (($handle = fopen($csvFile, 'r')) !== false) {
    fgetcsv($handle); // Skip the header row
    while (($data = fgetcsv($handle)) !== false) {
        $csvData[] = ['latitude' => trim($data[0]), 'longitude' => trim($data[1])];
    }
    fclose($handle);
}

// Retrieve room data from the database
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

// Sort the room data based on the CSV coordinate order
$sortedRooms = [];
$remainingRooms = $rooms; // Copy of all rooms to track remaining items

foreach ($csvData as $coord) {
    foreach ($rooms as $key => $room) {
        if (trim($room['latitude']) == $coord['latitude'] && trim($room['longitude']) == $coord['longitude']) {
            $sortedRooms[] = $room;
            unset($remainingRooms[$key]); // Remove matched room from remaining list
            break; // Move to the next coordinate once a match is found
        }
    }
}

// Append unmatched database entries to the end
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
