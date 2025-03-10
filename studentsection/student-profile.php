<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION["s_username"]) || !isset($_SESSION['s_email'])) {
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
    <link rel="stylesheet" href="/sajilo-rent/studentsection/styles/student-profile.css">
    <link rel="stylesheet" href="/sajilo-rent/studentsection/styles/leavehouse-style.css">
    <script src="/sajilo-rent/studentsection/script/student-profile-script.js" defer></script>
    <script src="/sajilo-rent/studentsection/script/leave.js" defer></script>
</head>

<body>
    <?php require_once '/xampp/htdocs/sajilo-rent/header.php'; ?>
    <div class="main-body">
        <?php
        require_once '/xampp/htdocs/sajilo-rent/aside-bar-student.php';
        ?>
        <div class="section-wrapper">
            <section class="section-profile">
                <div class="user-information">
                    <div class="avatar-wrapper">
                        <div class="avatar">
                            <div class="profile-image"></div>
                            <img src="/sajilo-rent/resources/profile-related/change-profile.svg" class="change-profile-icon" alt="">
                            <input type="file" id="imageInput" accept="image/*">
                        </div>
                    </div>
                    <div class="personal-info">
                        <p class="user-name"><?php echo $_SESSION["s_username"] ?></p>
                        <p class="user-status">Student</p>
                    </div>
                </div>
            </section>
            <section class="section-recent">
                <p class="text-student text-owner">Currently Residing in</p>
                <div class="current-residence">
                    <div class="house-card">
                        <img alt="Current residence image" class="living-house-image js-house-image">
                        <div class="house-information">
                            <div class="residence-details">
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
                                <img class="rating-image" src="/sajilo-rent/resources/ratings/rating-30.png" alt="star rating image">
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
    <dialog class="review-container">`
        <h1 class="text">Write a Review</h1>
        <form method="dialog" class="review-form">
            <div class="owner-section">
                <div class="heading-ratings">
                    <h2 class="owner-heading">Review for Owner</h2>
                    <div id="stars">
                        <span class="star js-star-owner" data-value="1">★</span>
                        <span class="star js-star-owner" data-value="2">★</span>
                        <span class="star js-star-owner" data-value="3">★</span>
                        <span class="star js-star-owner" data-value="4">★</span>
                        <span class="star js-star-owner" data-value="5">★</span>
                    </div>
                </div>
                <textarea class="writeText" name="ownerReview" placeholder="Write a review for Owner"></textarea>
            </div>
            <div class="house-section">
                <div class="heading-ratings">
                    <h2 class="house-heading">Review for House</h2>
                    <div id="stars">
                        <span class="star js-star-house" data-value="1">★</span>
                        <span class="star js-star-house" data-value="2">★</span>
                        <span class="star js-star-house" data-value="3">★</span>
                        <span class="star js-star-house" data-value="4">★</span>
                        <span class="star js-star-house" data-value="5">★</span>
                    </div>
                </div>
                <textarea class="writeText" name="houseReview" placeholder="Write a review for house"></textarea>
            </div>
            <button class="submit-button" type="submit" value="Submit">Submit</button>
        </form>
    </dialog>
</body>

</html>