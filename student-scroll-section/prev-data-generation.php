<?php
session_start();
include("db.php");

// Define the tolerance level
$tolerance = 0.000001;

// Get the filter values from the URL parameters (if provided)
$filterPrice = isset($_GET['price']) ? $_GET['price'] : null;
$filterRooms = isset($_GET['rooms']) ? $_GET['rooms'] : null;

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

// Prepare SQL query with filters
$query = "
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
LEFT JOIN review_house r ON ABS(h.latitude - r.lat) < ? AND ABS(h.longitude - r.lng) < ?";

if ($filterPrice) {
  $query .= " WHERE h.price <= ?";  // Add price filter
}

if ($filterRooms) {
  $query .= $filterPrice ? " AND h.no_of_rooms = ?" : " WHERE h.no_of_rooms = ?";  // Add rooms filter
}

$query .= " GROUP BY 
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
    s.lastName";

// Prepare and execute the statement
$stmt = $conn->prepare($query);

if (!$stmt) {
  die('Query preparation failed: ' . $conn->error);
}

// Bind parameters for price and rooms
if ($filterPrice && $filterRooms) {
  $stmt->bind_param('dddi', $tolerance, $tolerance, $filterPrice, $filterRooms);
} elseif ($filterPrice) {
  $stmt->bind_param('ddd', $tolerance, $tolerance, $filterPrice);
} elseif ($filterRooms) {
  $stmt->bind_param('ddd', $tolerance, $tolerance, $filterRooms);
} else {
  $stmt->bind_param('dd', $tolerance, $tolerance);
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
  $roomsHTML = "<p>No rooms found.</p>";
}
