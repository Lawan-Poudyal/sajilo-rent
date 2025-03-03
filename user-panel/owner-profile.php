<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/aside-bar.css">
    <link rel="stylesheet" href="/sajilo-rent/user-panel/styles/owner-profile-style.css">
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
                        <img src="/sajilo-rent/resources/profile-related/default-profile.png" alt="Profile image" class="profile-image">
                        <img src="../resources/profile-related/change-profile.svg" class="change-profile-icon js-change-profile-icon" alt="">
                        <input type="file" id="imageInput" class="js-image-input" accept="image/*">

                    </div>
                </div>
                <div class="personal-info">
                    <p class="user-name"><?php echo $_SESSION["username"]?></p>
                    <p class="user-status">Owner</p>
                </div>
            </div>

        </section>
        <section class="section-recent">
        <p class="text-student text-owner">Houses Rented</p>
        <div class="current-residence">
            <div class="house-card">
                <img alt="Your house here" class="living-house-image js-house-image" >
                <div class="house-information">
                    <div class="residence-details">
                        <p class="house-price"></p>
                        <p class="owner-name"></p>
                    </div>
                    <div class="house-status">
                        <button class="update-house">Update Info</button>
                    </div>
                </div>
            </div>
            <div class="not-rented">
                <h1>House not rented yet</h1>
            </div>
        </div>
        </section>
        <section class="section-review">
            <p class="text-comment">Review</p>
            <div class="rating-comment">
                <div class="main-rating">
                    <div class="rating-box">
                        <div class="rating-number"></div>
                        <div class="rating-text">Out of 5</div>
                    </div>
                    <div class="write-review">
                        <div class="rating-image-counter">
                            <img class="rating-image" src = "../resources/ratings/rating-30.png" alt="star rating image">
                            <p class="reviewer-count"></p>
                        </div>
                        <div class="share-review">
                            <p class="text-review">Here's some review About you</p>
                        </div>
                    </div>
                </div>
                <div class="main-comment">
                </div>
            </div>
            </section>
        </div>
    </div>
  
</body>
</html>