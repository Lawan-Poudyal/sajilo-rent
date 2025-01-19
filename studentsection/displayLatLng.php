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
</head>
<body>
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


<nav>
        <div class="nav">
            <!-- <div class="logo">
                <button class="saajiloRentLogo" ></button> -->
            <!-- </div> -->
            <button class="menu">Menu</button>

            <div class="selectWrapper">
                <select name = "price" class = "price">
                    <option value="10000" selected>Price</option>
                    <option value="3000">3000</option>
                    <option value="3500">3500</option>
                    <option value="4000">4000</option>
                    <option value="4500">4500</option>
                    <option value="5000">5000</option>
                    <option value="5500">5500</option>
                    <option value ="6000">6000</option>
                </select>
                
                <select name = "houseType" class="housetype">
                    <option value="" selected>Type</option>
                    <option value="1">Single Room</option>
                    <option value="2">Double Room</option>
                    <option value="3">Triple Room</option>
                    <option value="4">Appartment</option>
                </select>
            </div>
            <button class="closeRouting" style="display: none;">
                Close Routing
            </button>
            <div class="userInformation">
                <button class="userButton"><i class='bx bx-user'></i></button>
                <div class="displayUserName">
                    <div class="email"><?php echo $_SESSION['s_email']; ?></div>
                    <div class="userName"><?php echo $_SESSION['s_username']?></div>
                 </div>
            </div>
        </div>
    </nav>
    <div id="map"></div>
    <script type="module" src="./script/main.js"></script>
    </body>
</html>