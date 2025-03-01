<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sajilo-rent/userprofiles/style/style.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/aside-bar.css">
    <script src="/sajilo-rent/userprofiles/script/owner-profile-content.js"></script>
</head>
<body>
    <?php require_once '/opt/lampp/htdocs/sajilo-rent/header.php'?>

    <div class="main-body">
    <?php
        require_once '/opt/lampp/htdocs/sajilo-rent/aside-bar-student.php';
    ?>
    <div class="section-wrapper">
            <section class="section-profile">
                <div class="user-information">
                    <div class="avatar"><img src="/sajilo-rent/resources/profile-related/default-profile.png" alt="Profile image"></div>
                    <div class="personal-info">
                        <p class="user-name">Sijan Bhandari</p>
                        <p class="user-status">Owner</p>
                    </div>
                </div>
                <button class="message-user">
                    Message
                </button>
            </section>
            <section class="section-recent">
                <p class="text-owner">Recent House Posts</p>
                <div class="house-posted">
                    <div class="house-card">
                        <img src="./resources/room1.jpg" alt="Profile image" >
                        <div class="house-information">
                            <p class="house-price">Rs. 5000</p>
                            <button class="book-for-rent">Book For Rent</button>
                        </div>
                    </div>
                    
                </div>
            </section>
            <section class="section-review">
                <p class="text-comment">Review</p>
                <div class="rating-comment">
                    <div class="main-rating">
                        <div class="rating-box">
                            <div class="rating-number">4.9</div>
                            <div class="rating-text">Out of 5</div>
                        </div>
                        <div class="write-review">
                            <div class="rating-image-counter">
                                <img class="rating-image" src = "/sajilo-rent/resources/ratings/rating-30.png" alt="star rating image">
                                <p class="reviewer-count">12 reviwers</p>
                            </div>
                            <div class="share-review">
                                <p class="text-review">Share your experience about the owner</p>
                                <button class="button-write-review">Write a Review</button>
                            </div>
                        </div>
                    </div>
                    <div class="main-comment">

                        <div class="reviews-wrapper">
                            <div class="reviewer-info-wrapper">
                                <div class="reviewer-info">
                                    <p class="reviewer-name">Sijan Bhandari</p>
                                    <p class="review-date">2024-2-25</p>
                                </div>
                                <img class="reviewer-rating-image" src = "./resources/ratings/rating-15.png" alt="reviewer star rating image" >
                            </div>
                            <div class="review-comment">
                                Hello this guy is gay
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>