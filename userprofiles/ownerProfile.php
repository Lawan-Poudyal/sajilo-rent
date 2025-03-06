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
    <script src="/sajilo-rent/userprofiles/script/owner-profile-content.js" defer></script>
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
                    <div class="avatar"><img src="/sajilo-rent/resources/profile-related/default-profile.png" alt="Profile image" class="profile-image"></div>
                    <div class="personal-info">
                        <p class="user-name"></p>
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
                                <img class="rating-image" src = "" alt="star rating image">
                                <p class="reviewer-count"></p>
                            </div>
                            <div class="share-review">
                                <p class="text-review">Share your experience about the owner</p>
                               
                            </div>
                        </div>
                    </div>
                    <div class="main-comment">

                    </div>
                </div>
            </section>
        </div>
    </div>

    <dialog class = "dialog-no-owner">
    <div class="dialog-content">
        <h3>No Owner Found</h3>
        <p>You aren't currently residing in any house</p>
        <div class="dialog-actions">
            <button class="close-button">Close</button>
        </div>
    </div>
    </dialog>
</body>
</html>