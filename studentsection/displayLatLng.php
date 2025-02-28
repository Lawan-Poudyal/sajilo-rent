<?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        session_start();

        // Check if the user is logged in
        
        if (isset($_SESSION['s_username']) && isset($_SESSION['s_email'])) {
        // User is logged in, you can use the session variables
        $username = $_SESSION['s_username'];
        $email = $_SESSION['s_email'];
        }
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "user_database";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM housedetails";
        $result = $conn->query($sql);

        $latitudesandLongitudes = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $latitudesandLongitudes[] = $row;
            }
        } else {
            die("Query failed: " . $conn->error);
        }
        $jsonData = json_encode($latitudesandLongitudes, JSON_PRETTY_PRINT);
        file_put_contents('./data/latlng.json', $jsonData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
      integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
      crossorigin="">
    </script>

    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./styles/style.css"> 
    <title>Document</title>
    <script type = "module" src="./script/main.js"></script>

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
              <img src="https://img.icons8.com/ios-glyphs/30/expand-arrow--v1.png" alt="expand-arrow--v1" class="dropdown-icon"/>
            </button>
            <div class="dropdown-content" id="priceDropdown">
              <div class="price-option">$3,500</div>
              <div class="price-option">$4,000</div>
              <div class="price-option">$4,500</div>
              <div class="price-option">$5,000</div>
              <div class="price-option">$5,500</div>
              <div class="price-option">$6,000</div>
              <div class="price-option">$6,500</div>
            </div>
          </div>
          <div class="dropdown">
            <button class="dropbtn">
              Rooms
              <img src="https://img.icons8.com/ios-glyphs/30/expand-arrow--v1.png" alt="expand-arrow--v1" class="dropdown-icon"/>
            </button>
            <div class="dropdown-content" id="roomsDropdown">
              <div class="room-option">1 Room</div>
              <div class="room-option">2 Rooms</div>
              <div class="room-option">3 Rooms</div>
              <div class="room-option">4 Rooms</div>
            </div>
          </div>
        
        </div>
      </nav>
    <section class="main-body">
        <aside class="aside-bar">
            <div class="main-links">
                <a href="./student-profile.php"><img class="user-proile-pic" src="https://img.icons8.com/fluency-systems-regular/50/user--v1.png" alt="user icon"/><span class="link-text user-profile">Profile</span></a>
                <a href="#"><img src="https://img.icons8.com/ios/50/messages-mac.png" alt="messages-icon"/><span class="link-text messages">Messages</span></a>
                <a href="#"><img class="tenants-proile-pic" src="https://img.icons8.com/ios/50/conference-call.png" alt="tenants profile icon"/><span class="link-text tenants-proile">Tenants Profile</span></a>
                <a href=""><img class="rent-request-pic" src="https://img.icons8.com/fluency-systems-regular/50/request-feedback.png" alt="rent request icon"/><span class="link-text rent-request">Rent Request</span></a>
                <a href="#"><img class="change-password-pic" src="https://img.icons8.com/fluency-systems-regular/50/password-window.png" alt="password icon"/><span class="link-text change-password">Change Password</span></a>
            </div>
            <div class="bottom-links">
                <a href="#"><img class="log-out-pic" src="https://img.icons8.com/fluency-systems-regular/50/exit--v1.png" alt="log out icon"/><span class="link-text log-out">Log-out</span></a>
                <a href="#"><img class="about-pic" src="https://img.icons8.com/fluency-systems-regular/50/about.png" alt="about icon"/><span class="link-text about">About</span></a>
            </div>
        </aside>
        <div id="map">
        <button class="closeRouting" style="display: none;">Close Routing</button>
        </div>
    </section>
</html>