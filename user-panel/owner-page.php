<?php 
session_start();
if (!isset($_SESSION["username"] ) || !isset($_SESSION['email']))
{
header("Location:/sajilo-rent/user-panel/user-home.php");
}
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];
    $number3 = $_POST['number3'];
    $number4 = $_POST['number4'];
    $number5 = $_POST['number5'];
    $number6 = $_POST['number6'];
    $number7 = $_POST['number7'];
    $number8 = $_POST['number8'];
    $email = '';
    $conn = new mysqli('localhost','root' ,'' ,'user_database');
    if(!$conn){
        die("connection failed");
    }
    $query = 'INSERT into rent_house_location (email , lat1 ,lng1 , lat2 ,lng2 , lat3 ,lng3 , lat4 ,lng4 ) VALUES  (? , ?, ?, ?, ?, ?, ?, ?, ?)';
    $stms = $conn->prepare($query);
    $stms->bind_param('sssssssss', $_SESSION['email'],$number1 , $number2 ,$number3 ,$number4 ,$number5 ,$number6 ,$number7 ,$number8);
    if(!$stms->execute())
    {
        echo ''. $stms->error;
    }
    else{
        echo 'success';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["username"]?></title>
    <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
    <link rel="stylesheet" href="/sajilo-rent/user-panel/styles/owner-page-style.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
</head>
<body>
<header class="header">
            <nav class="header-nav">
                <div class="header-nav-element">
                <button id="logo-btn">
                    <figure>
                    <img src="/sajilo-rent/resources/logo.png" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                </figure>
            </button>
                </div>
                <div class="header-nav-element">
                <div class="header-nav-element-menu menu">
                    <figure id="js-menu">
                    <img src="/sajilo-rent/resources/menu.png" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                    </figure>
                    <div class="dropdown-menu" id="js-drop-down">
                     <div class="option"><figure><img src="/sajilo-rent/resources/profile.png" alt="" width="25" height="25"></figure></div>
                     <div class="option"><figure><img src="/sajilo-rent/resources/house.png.png" alt="" width="25" height="25"></figure></div>
                     <div class="option"><figure><img src="/sajilo-rent/resources/chat.png" alt="" width="25" height="25"></figure></div>
                     <div class="option"><figure><img src="/sajilo-rent/resources/dollar.png" alt="" width="25" height="25"></figure></div>   
                    </div>
                </div>
                </div>
            
            </nav>
        </header>

<main class="main">
<div class="main-div" id="js-map"></div>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" class="main-form" method="POST">
<input type="number" name="number1" step="any" id="number1" required="false">
<input type="number" name="number2" step="any" id="number2" required="false">
<input type="number" name="number3" step="any" id="number3" required="false">
<input type="number" name="number4" step="any" id="number4" required="false">
<input type="number" name="number5" step="any" id="number5" required="false">
<input type="number" name="number6" step="any" id="number6" required="false">
<input type="number" name="number7" step="any" id="number7" required="false">
<input type="number" name="number8" step="any" id="number8" required="false">
<input type="submit" value="Register" id="submit-btn">
</form>
</main>
<footer class="footer">
</footer>
<script src="/sajilo-rent/user-panel/script/owner-page-script.js"></script>
</body>
</html>