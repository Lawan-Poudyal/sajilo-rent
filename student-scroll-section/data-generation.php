<?php

include("db.php");



$stmt = $conn->prepare("SELECT * from housedetails ");
if (!$stmt) {
    die('Query preparation failed: ' . $conn->error);
}
// Execute the statement
$stmt->execute();
if (!$stmt->execute()) {
    die('Execution failed: ' . $stmt->error);
}

// fetch result set
$result = $stmt->get_result();
if (!$result) {
    die("Fetching results faild: " . $stmt->error);
}

// Fetch datas as an associative array 

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}


// Close statement and connection
$stmt->close();
$conn->close();


$roomsHTML = '';


if (!empty($rooms)) {
    foreach ($rooms as $room) {


        $roomsHTML .=   ' <div class="products-container">
                <div class="products-image-container">
                  <img
                    src="' . htmlspecialchars($room['image1']) . '"
                    class="product-img"
                  />
                </div>

                <div class="product-title limit-to-2-lines">' . htmlspecialchars($room['username']) . '</div>
                <div class="product-rating">
                  <img
                    src="../resources/ratings/rating-45.png"
                    class="product-rating-star"
                  />
                  <span class="product-rating-count">10</span>
                </div>
                <div class="product-price">Rs ' . htmlspecialchars($room['price']) . '</div>

                <div class="product-spacer"></div>
                <div class="added-to-cart">
                  <img src="../images/icons/checkmark.png" />
                  Added
                </div>
                <a href="#">
                <button class="add-to-cart-button button-primary " data-product-id=${room.id
          }>Location</button>
          </a>
              </div>';
    }
} else {
    echo "<p>No Rooms found.</p>";
}
