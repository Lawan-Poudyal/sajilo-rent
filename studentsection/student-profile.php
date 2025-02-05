<?php 
session_start();
if (!isset($_SESSION["s_username"] ) || !isset($_SESSION['s_email']))
{
    header("Location:/sajilo-rent/user-panel/user-home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($_SESSION['s_username'])){echo $_SESSION['s_username'];}else{echo 'Profile';}?></title>
    <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
    <link rel="stylesheet" href="/sajilo-rent/studentsection/styles/student-profile.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">
    <link rel="stylesheet" href="/sajilo-rent/studentsection/styles/leavehouse-style.css">
    <script src="/sajilo-rent/studentsection/script/student-profile-script.js" defer></script>
    <script src="/sajilo-rent/studentsection/script/leave.js" defer></script>
    <script src="/sajilo-rent/studentsection/script/loadcomment.js" defer></script>

</head>
<body>
<header class="header">


            <nav class="header-nav">
                <div class="header-nav-element">
                <button id="logo-btn">
                    <figure>
                    <img src="/sajilo-rent/resources/logo.svg" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                </figure>
            </button>
                </div>
                <div class="header-nav-element">  
                <div class="header-nav-element-menu menu">
                    <figure id="js-menu">
                    <img src="/sajilo-rent/resources/menu.png" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                    </figure>
                    <div class="dropdown-menu" id="js-drop-down">
                    <div class="option js-my-profile"><span class="nowrap">Your Profile</span></div>  
                    <div class="option js-owner-profile"><span class="nowarp">Owner Profile</span></div>  
                    <div class="option"><span class="nowarp js-password">Change Password</span></div>  
                    <div class="option js-logout"><span class="nowarp">logout</span></div>  
                    </div>
                </div>
            </nav>
</header>
        <main class="main">
        <div class="container-for-info ">
            <div class="main-div profilepic js-profile-pic"></div>
            <div class="contacts">
            <div class="name "><?php echo $_SESSION['s_username']?></div>    
            <div class="email js-email "><?php echo $_SESSION['s_email']?></div>
            </div>
            <div class="main-div profilestatus">
                <span class="main-div-span info nowrap ">Rating</span>
                <span class="main-div-span info nowrap "><img src="/sajilo-rent/resources/ratings/rating-50.png" alt=""></span>
            </div>
            <div class="leaveButton"><button>Leave House</button></div>
            </div>
            <dialog class="review-container">
                <h1 class="text">Write a Review</h1>
                <form action = "/sajilo-rent/studentsection/backend/addReviewHouse.php" method = "POST" class="review-form"> 
                    <div class="owner-section">
                        <div class="heading-ratings">
                            <h2 class="owner-heading">Review for Owner</h2>
                            <div id="stars" >
                                <span class="star js-star-owner" data-value="1">★</span>
                                <span class="star js-star-owner" data-value="2">★</span>
                                <span class="star js-star-owner" data-value="3">★</span>
                                <span class="star js-star-owner" data-value="4">★</span>
                                <span class="star js-star-owner" data-value="5">★</span>
                            </div>
                        </div>
                        <textarea class="writeText" name = "ownerReview" placeholder="Write a review for Owner"></textarea>
                    </div>
                    <div class="house-section">
                        <div class="heading-ratings">
                            <h2 class="house-heading">Review for House</h2>
                            <div id="stars" >
                                <span class="star js-star-house" data-value="1">★</span>
                                <span class="star js-star-house" data-value="2">★</span>
                                <span class="star js-star-house" data-value="3">★</span>
                                <span class="star js-star-house" data-value="4">★</span>
                                <span class="star js-star-house" data-value="5">★</span>
                            </div>
                        </div>
                        <textarea class="writeText" name = "houseReview" placeholder="Write a review for house"></textarea>
                    </div>
                    <button class="submit-button" type="submit" value="Submit">Submit</button>
                </form>
            </dialog>
            <section class="main-section">
            <h2>Comments</h2>
            <hr>
        <!-- popup for review before leaving -->
        <div class="main-section-div comments">
            
        </div>
            </section>
        </main>
        <div class="uploadphoto js-upload-photo">
            <div class="photo js-photo">
            </div>
            <form action="/sajilo-rent/studentsection/backend/addprofilepic.php" method="post" enctype="multipart/form-data">
            <input type="submit" class="send" value="Save Profile Pic"></input>
            <input type="file" class="js-image hidden" name="image">
            </form>
            <div class="cross-icon js-cross-icon" ><img src="/sajilo-rent/resources/cross.png" height="50" width="50" alt=""></div>
        </div>
        <div class="logout js-log-out ">
             <span class="logout-msg">Are you sure you want to log out ?</span>
             <div class="logout-option">
                <button class="sure js-sure">Log out</button>
                <button class="notlogout js-notlogout">No</button>
             </div>
            <div class="cross2-icon js-cross2-icon" ><img src="/sajilo-rent/resources/cross.png" height="50" width="50" alt=""></div>
        </div>
        <div class="change-password js-change-password">
        <span class="change-password-msg">Change Password</span>
        <input type="text" placeholder="old password" class="js-old-password">
        <input type="text" placeholder="new password" class="js-new-password">
        <div class="change-password-option">
                <button class="confirm js-confirm">Confirm</button>
                <button class="notlogout js-notlogout">Don't Change</button>
             </div>
             <div class="cross3-icon js-cross3-icon" ><img src="/sajilo-rent/resources/cross.png" height="50" width="50" alt=""></div>
        </div>
 
</body>
</html>