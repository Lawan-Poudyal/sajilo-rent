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
    <link rel="stylesheet" href="./styles/student-profile.css">
    <script src="./script/student-profile-script.js" defer></script>
</head>
<body>
    <header>
        <nav>

        </nav>
    </header>

    <section class="section-profile">
        <div class="user-information">
            <div class="avatar"><img alt="Profile image" class="profile-image">
            </div>
            <div class="personal-info">
                <p class="user-name"><?php echo $_SESSION["s_username"]?></p>
                <p class="user-status">Student</p>
            </div>
        </div>
        <button class="message-user">
            Message
        </button>
    </section>
    <section class="section-recent">
    <p class="text-student text-owner">Currently Residing in</p>
    <div class="current-residence">
        <div class="house-card">
            <img alt="Current residence image" class="living-house-image js-house-image" >
            <div class="house-information">
                <div class="residence-details">
                    <p class="house-price"></p>
                    <p class="owner-name"></p>
                </div>
                <div class="residence-status">
                    <button class="leave-house">Leave House</button>
                </div>
            </div>
        </div>
        <div class="not-residing">
            <h1>You are not residing in any house</h1>
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
</body>
</html>