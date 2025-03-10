<?php
session_start();

include("../header.php");
include("../student-scroll-section/db.php");


if (isset($_SESSION['latitude']) && isset($_SESSION['longitude'])) {
    $latitude = $_SESSION['latitude'];
    $longitude = $_SESSION['longitude'];


    $tolerance = 0.000001;
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
            s.number,
            COALESCE(ROUND(AVG(r.rating) * 2) / 2, 0) AS avg_rating
        FROM housedetails h
        LEFT JOIN signin s ON TRIM(LOWER(h.username)) = TRIM(LOWER(s.email))
        LEFT JOIN review_house r ON ABS(h.latitude - r.lat) < ? AND ABS(h.longitude - r.lng) < ?
        WHERE ABS(h.latitude - ?) < ? AND ABS(h.longitude - ?) < ?
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
            s.lastName, 
            s.number
    ");
    $stmt->bind_param("dddddd", $tolerance, $tolerance, $latitude, $tolerance, $longitude, $tolerance);
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
    $ratingImage = '../resources/ratings/rating-' . (round($rooms['avg_rating'] * 2) / 2 * 10) . '.png';



    $roomsHTML  .= '  <div class="container">
                    <button class="back-button" onclick="goBack()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </button>
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
    <h1>' . htmlspecialchars($rooms['firstName']) . ' ' . htmlspecialchars($rooms['lastName']) . '<span class="owner-email">' . htmlspecialchars($rooms['username']) . '</span> </h1>
    <p class="price">Rs ' . htmlspecialchars($rooms['price']) . '/month</p>

            <div class="property-grid">

        <p><strong>Electricity bill:</strong> ' . htmlspecialchars($rooms['electricity']) . ' </p>
        <p><strong>Wifi:</strong> ' . htmlspecialchars($rooms['wifi_price']) . '/month </p>
        <p><strong>Allowed No. of Roommates:</strong> ' . htmlspecialchars($rooms['no_of_roommates']) . '</p>
        <p><strong>Parking:</strong> ' . htmlspecialchars($rooms['parking']) . '</p>
        <p><strong>Floor Level:</strong> ' . htmlspecialchars($rooms['floor_level']) . '</p>
        <p><strong>House Direction:</strong> ' . htmlspecialchars($rooms['house_facing_direction']) . '</p>
        <p><strong>Gate Opening:</strong> ' . htmlspecialchars($rooms['gates_open']) . 'AM</p>
        <p><strong>Gate Closing:</strong> ' . htmlspecialchars($rooms['gates_close']) . 'PM</p>
    </div>

        <p class="contact">  <strong>Contact:</strong> ' . htmlspecialchars($rooms['number']) . '</p>
            <button class="book-button js-book-button" data-room-lat="' . htmlspecialchars($rooms['latitude']) . '" data-room-lng="' . htmlspecialchars($rooms['longitude']) . '"  data-room-owner="' . htmlspecialchars($rooms['username']) . '"data-student-name="' . $_SESSION["s_email"] . '">Book Now</button>


        <div class="reviews">
            <h2>Ratings</h2>
            <img src="' . $ratingImage . '" class="product-rating-star" />
            <span class="product-rating-count">' . number_format($rooms['avg_rating'], 1) . '</span>

            

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
    <link rel="stylesheet" href="../universal-styling/aside-bar.css">

    <link rel="icon" type="image/x-icon" href="../resources/logo.svg">
    <title><?php echo  $_SESSION['s_username']; ?></title>

</head>

<body>
    <section class="main-body">
        <?php require_once '/opt/lampp/htdocs/sajilo-rent/aside-bar-student.php' ?>

        <?php echo $roomsHTML; ?>

    </section>
</body>
<script src="./script/details.js"> </script>

</html>

<!-- 
<p><strong>Jane Smith:</strong> Great room, well maintained! ⭐⭐⭐⭐⭐</p>
            <p><strong>Mike Johnson:</strong> Affordable and close to university. ⭐⭐⭐⭐</p> -->