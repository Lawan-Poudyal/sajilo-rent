<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION["username"]) || !isset($_SESSION['email'])) {
    header("Location:/sajilo-rent/user-panel/user-home.php");
}
$username = $_SESSION['email'];
$latlngarr = [[0, 0], [0, 0], [0, 0], [0, 0]];
$i = 0;
$j = 0;
$conn = new mysqli("localhost", "root", "", "user_database");
if ($conn->connect_error) {
    die("" . $conn->connect_error);
}
$query = "SELECT latitude , longitude FROM housedetails WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $latlngarr[$i][0] = $row["latitude"];
        $latlngarr[$i][1] = $row["longitude"];
        $i++;
    }
}
$conn->close();
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["username"] ?></title>
    <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
    <link rel="stylesheet" href="/sajilo-rent/user-panel/styles/owner-page-style.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/aside-bar.css">
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
</head>

<body>
    <!-- <header class="header">
            <nav class="header-nav">
                <div class="header-nav-element">
                <button id="logo-btn">
                    <figure>
                     <img src="/sajilo-rent/resources/logo.svg" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                    </figure>
                 </button>
                </div>
                <div class="header-nav-element">
                <div class="header-nav-element-side-menu">
                     <div class="side-option js-profile-btn"><figure><img src="/sajilo-rent/resources/profile.png" alt="" width="25" height="25"></figure></div>
                     <div class="side-option"><figure><img src="/sajilo-rent/resources/house.png.png" alt="" width="25" height="25"></figure></div>
                     <div class="side-option js-chat-btn"><figure><img src="/sajilo-rent/resources/chat.png" alt="" width="25" height="25"></figure></div>
                     <div class="side-option"><figure><img src="/sajilo-rent/resources/dollar.png" alt="" width="25" height="25"></figure></div>   
                    </div>
                </div>  
                <div class="header-nav-element-menu menu">
                    <figure id="js-menu">
                    <img src="/sajilo-rent/resources/menu.png" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                    </figure>
                    <div class="dropdown-menu" id="js-drop-down">
                     <div class="option js-profile-btn"><figure><img src="/sajilo-rent/resources/profile.png" alt="" width="25" height="25"></figure></div>
                     <div class="option"><figure><img src="/sajilo-rent/resources/house.png.png" alt="" width="25" height="25"></figure></div>
                     <div class="option js-chat-btn"><figure><img src="/sajilo-rent/resources/chat.png" alt="" width="25" height="25"></figure></div>
                     <div class="option"><figure><img src="/sajilo-rent/resources/dollar.png" alt="" width="25" height="25"></figure></div>   
                    </div>
                </div>
            </nav>
        </header> -->
    <?php require_once '/xampp/htdocs/sajilo-rent/header.php' ?>
    <div class="main-body">
        <?php require_once '/xampp/htdocs/sajilo-rent/aside-bar-owner.php' ?>
        <main class="main">
            <div class="main-div" id="js-map"></div>
            <div class="form-div" id="js-form-div">
                <form class="house-info" method="POST" action="/sajilo-rent/user-panel/back_end/addhousedetails.php" enctype="multipart/form-data">
                    <h2 class="form-div-h2">Answer These FAQs</h2>
                    <div class="price wrapper-div">
                        <label for="price">
                            Price:
                        </label>
                        <input type="number" value="500" min="500" name="price" step="100" required>
                    </div>
                    <div class="no-of-rooms wrapper-div">
                        <label for="no-of-rooms">
                            No of Rooms:
                        </label>
                        <input type="number" value="1" max="10" min="1" name="no-of-rooms" required>
                    </div>
                    <div class="no-of-roommates wrapper-div">
                        <label for="no-of-roommates">
                            No of Roommates:
                        </label>
                        <input type="number" value="1" max="4" min="1" name="no-of-roommates" required>
                    </div>
                    <div class="gates-open wrapper-div">
                        <label for="gates-open">
                            Gates Open:
                        </label>
                        <input type="time" name="gates-open" required>
                    </div>
                    <div class="gates-close wrapper-div">
                        <label for="gates-close">
                            Gates Close:
                        </label>
                        <input type="time" name="gates-close" required>
                    </div>
                    <div class="parking wrapper-div">
                        <label for="parking">
                            Parking:
                        </label>
                        available: <input type="radio" name="parking" value="available" required>
                        unavailable: <input type="radio" name="parking" value="unavailable" required>
                    </div>
                    <div class="floor-level wrapper-div">
                        <label for="floor-level">
                            Floor Level:
                        </label>
                        <select name="floor-level" id="floor-level" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="house-facing-direction wrapper-div">
                        <label for="house-facing-direction">
                            House Direction:
                        </label>
                        <select name="house-facing-direction" id="house-facing-direction" required>
                            <option value="east">east</option>
                            <option value="west">west</option>
                            <option value="north">north</option>
                            <option value="south">south</option>
                        </select>
                    </div>
                    <div class="wifi wrapper-div">
                        <label for="wifi">
                            Wifi (in NPR/month):
                        </label>
                        <input type="range" min="0" step="500" max="3000" value="0" name="wifi" id="wifi-price" required>
                        <span id="price-value"></span>
                    </div>
                    <div class="electricity wrapper-div">
                        <label for="electricity">
                            Electricity:
                        </label>
                        Required:<input type="radio" name="electricity" value="required" required>
                        Not Required: <input type="radio" name="electricity" value="notrequired" required>
                    </div>
                    <div class="image wrapper-div">
                        <label for="image">
                            Upload Three Images of the room :
                        </label>
                        <input type="file" name="image" id="image1" accept="image/*" required>
                        <input type="file" name="image-2" id="image2" accept="image/*" required>
                        <input type="file" name="image-3" id="image3" accept="image/*" required>

                    </div>
                    <div class="image-wrapper wrapper-div">
                        <div class="image-display image1" id="image-div1"></div>
                        <div class="image-display image2" id="image-div2"></div>
                        <div class="image-display image3" id="image-div3"></div>
                    </div>
                    <div class="hidden-latlng wrapper-div ">
                        <input type="number" name="lat" id="js-lat" step="0.00000000000000001" required>
                        <input type="number" name="lng" id="js-lng" step="0.00000000000000001" required>
                    </div>
                    <input type="submit" class="form-submit-btn" value="Rent">
                </form>
                <div class="cross-icon" id="js-cross-icon"><img src="/sajilo-rent/resources/cross.png" alt="" height="50" width="50"></div>
            </div>
        </main>
    </div>
    <footer class="footer">
    </footer>
    <div class="hidden"><?php echo $username ?></div>
    <div class="latitudeandlongitude hidden">
        <div id="username"><?php echo $username ?></div>
        <div id="lat1"><?php echo number_format($latlngarr[0][0], 17) ?></div>
        <div id="lng1"><?php echo number_format($latlngarr[0][1], 17) ?></div>
        <div id="lat2"><?php echo number_format($latlngarr[1][0], 17) ?></div>
        <div id="lng2"><?php echo number_format($latlngarr[1][1], 17) ?></div>
        <div id="lat3"><?php echo number_format($latlngarr[2][0], 17) ?></div>
        <div id="lng3"><?php echo number_format($latlngarr[2][1], 17) ?></div>
        <div id="lat4"><?php echo number_format($latlngarr[3][0], 17) ?></div>
        <div id="lng4"><?php echo number_format($latlngarr[3][1], 17) ?></div>
    </div>
    <script src="/sajilo-rent/user-panel/script/owner-page-script.js"></script>
</body>

</html>