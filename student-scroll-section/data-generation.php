





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

// Retrieve all room data along with owner's name and average rating
$stmt = $conn->prepare("
SELECT 
    h.username,
    h.no_of_rooms,
    h.no_of_roommates,
    h.gates_open,
    h.gates_close,
    h.wifi_price,
    h.image1,
    h.image2,
    h.image3,
    h.latitude,
    h.longitude,
    h.price,
    h.parking,
    h.electricity,
    h.floor_level,
    h.house_facing_direction,
    s.firstName, 
    s.lastName, 
    COALESCE(ROUND(AVG(r.rating) * 2) / 2, 0) AS avg_rating
FROM housedetails h
LEFT JOIN signin s ON TRIM(LOWER(h.username)) = TRIM(LOWER(s.email))
LEFT JOIN review_house r ON ABS(h.latitude - r.lat) < ? AND ABS(h.longitude - r.lng) < ?
GROUP BY 
    h.username,
    h.no_of_rooms,
    h.no_of_roommates,
    h.gates_open,
    h.gates_close,
    h.wifi_price,
    h.image1,
    h.image2,
    h.image3,
    h.latitude,
    h.longitude,
    h.price,
    h.parking,
    h.electricity,
    h.floor_level,
    h.house_facing_direction,
    s.firstName, 
    s.lastName
");


if (!$stmt) {
    die('Query preparation failed: ' . $conn->error);
}

$stmt->bind_param('dd', $tolerance, $tolerance);
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
$remainingRooms = $rooms;

foreach ($csvData as $coord) {
    $latitude = $coord['latitude'];
    $longitude = $coord['longitude'];

    foreach ($rooms as $key => $room) {
        if (
            abs($room['latitude'] - $latitude) < $tolerance &&
            abs($room['longitude'] - $longitude) < $tolerance
        ) {

            $sortedRooms[] = $room;
            unset($remainingRooms[$key]);
            break;
        }
    }
}

$sortedRooms = array_merge($sortedRooms, $remainingRooms);

$roomsHTML = '';

if (!empty($sortedRooms)) {
    foreach ($sortedRooms as $room) {
        $ratingImage = '../resources/ratings/rating-' . (round($room['avg_rating'] * 2) / 2 * 10) . '.png';

        $roomsHTML .= '<div class="room-container">
                <div class="products-image-container">
                    <img src="/sajilo-rent/user-panel/back_end/' . htmlspecialchars($room['image1']) . '" class="product-img" />
                </div>

                <div class="product-title limit-to-2-lines">' . htmlspecialchars($room['firstName']) . ' ' . htmlspecialchars($room['lastName']) . ' <span class="owner-email">' . htmlspecialchars($room['username']) . '</span></div>
                <div class="product-rating">
                    <img src="' . $ratingImage . '" class="product-rating-star" />
                    <span class="product-rating-count">' . number_format($room['avg_rating'], 1) . '</span>
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
?>
