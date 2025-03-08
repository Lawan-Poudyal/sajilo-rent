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
        <h1>' . htmlspecialchars($rooms['username']) . '</h1>
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

        <p class="contact">  <strong>Contact:</strong> +1234567890</p>
            <button class="book-button js-book-button">Book Now</button>


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
    <link rel="stylesheet" href="../universal-styling/aside-bar.css">

    <link rel="icon" type="image/x-icon" href="../resources/logo.svg">
    <title><?php echo  $_SESSION['s_username']; ?></title>

</head>

<body>
    <section class="main-body">
        <?php require_once '/xampp/htdocs/sajilo-rent/aside-bar-student.php' ?>

        <?php echo $roomsHTML; ?>

    </section>
</body>
<script src="./script/details.js"> </script>

</html>