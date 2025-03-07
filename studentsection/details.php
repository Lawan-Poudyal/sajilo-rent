<?php
session_start();
include("../header.php");
include("../student-scroll-section/db.php");


if (isset($_SESSION['latitude']) && isset($_SESSION['longitude'])) {
    $latitude = $_SESSION['latitude'];
    $longitude = $_SESSION['longitude'];


    $tolerance = 0.000001;
    $stmt = $conn->prepare("SELECT * FROM housedetails   WHERE ABS(latitude - ?) < ? AND ABS(longitude - ?) < ?");
    $stmt->bind_param("dddd", $latitude, $tolerance, $longitude, $tolerance);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
        die("Fetching results faild: " . $stmt->error);
    }



    if ($result->num_rows > 0) {
        $rooms = $result->fetch_assoc();
    }
} else {
    die("Invalid request. No room selected.");
}

$stmt->close();
$conn->close();



$roomsHTML = '';
if (!empty($rooms)) {



    $roomsHTML  .= '  <div class="container">
    <div class="image-container">
        <div class="slider" id="slider">
            <img src="/sajilo-rent/user-panel/back_end/' . htmlspecialchars($rooms['image1']) . '" alt="Room Image 1">
            <img src="/sajilo-rent/user-panel/back_end/' . htmlspecialchars($rooms['image2']) . '" alt="Room Image 2">
            <img src="/sajilo-rent/user-panel/back_end/' . htmlspecialchars($rooms['image3']) . '" alt="Room Image 3">
        </div>
        <div class="buttons">
            <button onclick="prevSlide()">&#10094;</button>
            <button onclick="nextSlide()">&#10095;</button>
        </div>
    </div>
    <div class="details">
        <h1>' . htmlspecialchars($rooms['username']) . '</h1>
        <p class="price">Rs ' . htmlspecialchars($rooms['price']) . '/month</p>
        <p><strong>Electricity bill:</strong> ' . htmlspecialchars($rooms['electricity']) . ' </p>
        <p><strong>Wifi:</strong> ' . htmlspecialchars($rooms['wifi_price']) . '/month </p>
        <p><strong>No. of Roommates:</strong> ' . htmlspecialchars($rooms['no_of_roommates']) . '</p>
        <p><strong>Parking:</strong> ' . htmlspecialchars($rooms['parking']) . '</p>
        <p><strong>Floor Level:</strong> ' . htmlspecialchars($rooms['floor_level']) . '</p>
        <p><strong>House Direction:</strong> ' . htmlspecialchars($rooms['house_facing_direction']) . '</p>
        <p><strong>Gate Opeoning Time:</strong> ' . htmlspecialchars($rooms['gates_open']) . 'AM</p>
        <p><strong>Gate Opeoning Time:</strong> ' . htmlspecialchars($rooms['gates_close']) . 'PM</p>

        <p class="contact"><strong>Contact:</strong> +1234567890</p>
        <button >Contact Owner</button>

        <div class="reviews">
            <h2>Reviews</h2>
            <p><strong>Jane Smith:</strong> Great room, well maintained! ⭐⭐⭐⭐⭐</p>
            <p><strong>Mike Johnson:</strong> Affordable and close to university. ⭐⭐⭐⭐</p>

        </div>
    </div>
</div>';
} else {
    echo "<p>No Room Details Found.</p>";
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/details.css">
    <title>Room Rental Details</title>

</head>

<body>

    <?php echo $roomsHTML; ?>
</body>
<script src="./script/details.js"> </script>

</html>