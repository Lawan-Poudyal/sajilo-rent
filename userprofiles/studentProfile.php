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
    <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
    <title><?php echo $_SESSION["s_username"]?></title>
    <link rel="stylesheet" href="/sajilo-rent/userprofiles/style/style.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/aside-bar.css">
    <script src="/sajilo-rent/userprofiles/script/student-profile-content.js" defer></script>
</head>

<body>
    <?php require_once '/opt/lampp/htdocs/sajilo-rent/header.php' ?>

    <div class="main-body">
        <?php
        require_once '/opt/lampp/htdocs/sajilo-rent/aside-bar-owner.php';
        ?>
        <div class="section-wrapper">
            <section class="section-profile">
                <div class="user-information">
                    <div class="avatar">
                        <div class="profile-image"></div>
                    </div>
                    <div class="personal-info">
                        <p class="user-name"></p>
                        <p class="user-status">Student</p>
                    </div>
                </div>
            </section>
            <section class="section-recent">
                <p class="text-student text-owner">Currently Residing in</p>
                <div class="current-residence js-current-residence">
                    <div class="house-card">
                        <img alt="Current residence image" class="living-house-image js-house-image">
                        <div class="house-information">
                            <div class="residence-details">
                                <p class="house-price"></p>
                                <p class="owner-name"></p>
                            </div>

                        </div>
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
                                <img class="rating-image" alt="star rating image">
                                <p class="reviewer-count"></p>
                            </div>
                            <div class="share-review">
                                <p class="text-review">Hers's some reviews</p>

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