<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION["username"] ) || !isset($_SESSION['email']))
{
header("Location:/sajilo-rent/user-panel/user-home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/aside-bar.css">
    <link rel="stylesheet" href="/sajilo-rent/user-panel/styles/owner-profile-style.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">
    <script src="/sajilo-rent/user-panel/script/owner-profile-script.js" defer></script>
    </head>
<body>
    <?php require_once '/opt/lampp/htdocs/sajilo-rent/header.php'; ?>
    <div class="main-body">
    <?php
        require_once '/opt/lampp/htdocs/sajilo-rent/aside-bar-owner.php';
    ?>
    <div class="section-wrapper">
        <section class="section-profile">
            <div class="user-information">
                <div class="avatar-wrapper">
                    <div class="avatar">
                        <img src="/sajilo-rent/resources/profile-related/default-profile.png" alt="Profile image" class="profile-image js-profile-image">
                        <img src="../resources/profile-related/change-profile.svg" class="change-profile-icon js-change-profile-icon" alt="">
                        <form action="/sajilo-rent/user-panel/back_end/addprofilepic.php" method="POST" enctype="multipart/form-data" class="js-profile-form">
                        <input type="file" name="image" id="imageInput" class="js-image-input" accept="image/*">
                        </form>
                    </div>
                </div>
                <div class="personal-info">
                    <p class="user-name"><?php echo $_SESSION["username"]?></p>
                    <p class="user-status">Owner</p>
                    <p class="email js-email" style="display:none"><?php echo $_SESSION['email']?></p>
                </div>
            </div>

        </section>
        <section class="section-recent">
        <p class="text-student text-owner">Houses Rented</p>
        <div class="current-houses js-current-houses">
            <div class="not-rented js-not-rented">
                <h1 class="js-not-rented-tag">House not rented yet</h1>
            </div>  
        </div>
        </section>
        <section class="section-review">
            <p class="text-comment js-text-comment">Review</p>
            <div class="rating-comment">
                <div class="main-rating">
                    <div class="rating-box">
                    <div class="rating-image-counter">
                            <img  class="rating-image js-rating-image" src = "../resources/ratings/rating-30.png" alt="star rating image">
                            <p class="reviewer-count"></p>
                        </div>
                        <div class="rating-text">Out of 5</div>
                    </div>
                    <div class="write-review">
                        <div class="share-review">
                            <p class="text-review">Here's what people say about you</p>
                        </div>
                    </div>
                </div>
                <div class="main-comment js-main-comment">
<!----------------------INSERT YOUR REVIEWS  HERE--------------->
                </div>
            </div>
            </section>
        </div>
    </div>
<dialog class="form-div" id="js-form-div">
<form  class="house-info" method="POST" action="/sajilo-rent/user-panel/back_end/updatehousedetails.php" enctype="multipart/form-data">
<h2 class="form-div-h2">Answer These FAQs</h2>
<div class="price wrapper-div">     
<label for="price"> 
Price:
</label>
<input class="js-price" type="number" value ="500" min="500" name="price" step="100" required>
</div>
<div class="no-of-rooms wrapper-div">
<label for="no-of-rooms">
No of Rooms:
</label>
<input class="js-rooms" type="number" value ="1"  max="10" min="1" name="no-of-rooms" required>
</div>  
<div  class="no-of-roommates wrapper-div">
<label for="no-of-roommates">
No of Roommates:
</label>
<input class="js-no-of-roommates" type="number" value ="1"  max="4" min="1" name="no-of-roommates" required>
</div>
<div class="gates-open wrapper-div">
<label for="gates-open">
Gates Open:
</label>
<input class='js-gates-open' type="time" name="gates-open" required>
</div>
<div class="gates-close wrapper-div">
<label for="gates-close">
Gates Close:
</label>
<input class="js-gates-close" type="time" name="gates-close" required>
</div>
<div class="parking wrapper-div">
<label for="parking">
Parking:
</label>
available: <input class="js-parking-available" type="radio" name="parking" value="available" required>
unavailable: <input class="js-parking-unavailable" type="radio" name="parking" value="unavailable" required> 
</div>
<div class="floor-level wrapper-div">
<label for="floor-level">
Floor Level:
</label>
<select class="js-floor-level" name="floor-level" id="floor-level" required>
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
<select class="js-house-facing-direction" name="house-facing-direction" id="house-facing-direction" required>
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
<input class="js-wifi" type="range" min="0" step="500" max="3000" value="0" name="wifi" id="wifi-price" required>
<span id="price-value"></span>
</div>
<div class="electricity wrapper-div">
<label for="electricity">
Electricity:
</label>
Required:<input class='js-electricity-required' type="radio" name="electricity" value="required" required>
Not Required: <input class='js-electricity-notrequired' type="radio" name="electricity" value="notrequired" required>
</div>
<div class="image wrapper-div">
<label for="image">
Upload Three Images of the room :
</label>
<input type="file" name="image" id="image1" accept="image/*"required>
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
<input class="form-update js-form-update" type="submit" class="form-submit-btn"value="Update">
</form>
<div class="cross-icon" id="js-cross-icon"><img src="/sajilo-rent/resources/cross.png" alt="" height="50" width="50"></div>
</dialog>
</body>
</html>