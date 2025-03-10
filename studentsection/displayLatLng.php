<?php
session_start();
include("../student-scroll-section/data-generation.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin="" />

  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin="">
  </script>

  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="../universal-styling/aside-bar.css">
  <link rel="stylesheet" href="../student-scroll-section/styles/rooms.css">

  <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
  <title><?php echo  $_SESSION['s_username']; ?></title>


  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="../universal-styling/aside-bar.css">
  <link rel="stylesheet" href="../student-scroll-section/styles/rooms.css">

  <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
  <title><?php echo  $_SESSION['s_username']; ?></title>


</head>

<body>
  <nav>
    <div class="nav">
      <div class="sajilo-rent-logo-div">
        <div class="sajilo-rent-logo"></div>
      </div>
      <div class="dropdown">
        <button class="dropbtn">
          Price
          <img src="https://img.icons8.com/ios-glyphs/30/expand-arrow--v1.png" alt="expand-arrow--v1" class="dropdown-icon" />
        </button>
        <div class="dropdown-content" id="priceDropdown">
            <div data-value="3500" class="price-option">Rs 3,500</div>
            <div data-value="4000" class="price-option">Rs 4,000</div>
            <div data-value="4500" class="price-option">Rs 4,500</div>
            <div data-value="5000" class="price-option">Rs 5,000</div>
            <div data-value="5500" class="price-option">Rs 5,500</div>
            <div data-value="6000" class="price-option">Rs 6,000</div>
            <div data-value="6500" class="price-option">Rs 6,500</div>
        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn">
          Rooms
          <img src="https://img.icons8.com/ios-glyphs/30/expand-arrow--v1.png" alt="expand-arrow--v1" class="dropdown-icon" />
        </button>
        <div class="dropdown-content" id="roomsDropdown">
            <div data-value="1" class="room-option">1 Room</div>
            <div data-value="2" class="room-option">2 Rooms</div>
            <div data-value="3" class="room-option">3 Rooms</div>
            <div data-value="4" class="room-option">4 Rooms</div>
        </div>
      </div>
      <button class="reset-filters-btn" style="display: none;">
        <i class='bx bx-reset'></i> Reset Filters
      </button>
    </div>
  </nav>
  <section class="main-body">
    <?php require_once '/opt/lampp/htdocs/sajilo-rent/aside-bar-student.php' ?>
    <div class="contents">
      <div id="map">
        <button class="closeRouting" style="display: none;">Close Routing</button>
      </div>
      <div class="details">
        <div class="main">
          <section class="room-container-grid">
            <?php echo $roomsHTML; ?>
          </section>
        </div>
      </div>
  </section>
  <div class="email" hidden><?php echo $_SESSION["s_email"] ?></div>

  <script type="module" src="./script/main.js"></script>
  <script type="module" src="../studentsection/script/location.js"></script>

</body>

</html>