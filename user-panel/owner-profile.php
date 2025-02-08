<?php 
session_start();
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
    <title><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{echo 'Profile';}?></title>
    <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
    <link rel="stylesheet" href="/sajilo-rent/user-panel/styles/owner-profile-style.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">
    <script src="/sajilo-rent/user-panel/script/owner-profile-script.js" defer></script>

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
                    <div class="option js-my-profile js-option"><span class="nowrap">Your Profile</span></div>  
                    <div class="option  js-option"><span class="nowarp  js-tenants-option">Tenants Profile</span></div>  
                    <div class="option js-rent-request js-option"><span class="nowarp">Rent Request</span></div>  
                    <div class="option js-option"><span class="nowarp js-password">Change Password</span></div>  
                    <div class="option js-logout js-option"><span class="nowarp">logout</span></div>  
                    </div>
                </div>
            </nav>
        </header>
        <main class="main">
        <div class="container-for-info ">
            <div class="main-div profilepic js-profile-pic"></div>
            <div class="contacts">
            <div class="name "><?php echo $_SESSION['username']?></div>    
            <div class="email js-email "><?php echo $_SESSION['email']?></div>
            </div>
            <div class="main-div profilestatus">
                <span class="main-div-span info nowrap  ">Rating</span>
                <span class="main-div-span info nowrap js-rating-icon"><img src="/sajilo-rent/resources/ratings/rating-50.png" alt=""></span>
                <span class="main-div-span info nowrap ">Tenants Living</span>
                <span class="main-div-span info js-tenants nowrap ">5</span>
                <span class="main-div-span info nowrap ">Rooms Rented</span>
                <span class="main-div-span info nowrap js-rooms ">5</span>
                
            </div>
            </div>
            <section class="main-section">
            <h2>Comments</h2>
            <hr>
        <div class="main-section-div comments js-main-section-div">
            <div class="comment">
            <div class="main-section-div-div commentinfo"><span class="commenter">Abhiyan Regmi </span>  posted on <span class="commentdate">2074/03/15</span></div>
            <div class="main-section-div-div commentdata">i don't like this place</div>
            </div>
            </div>
            </section>
        <div class="main-section-div request js-request-card hidden">
        
        </div>
        <div class="main-section-div tenants js-tenants-profile hidden">
        <div class="tenants-card js-tenants-card">
        <img src="/sajilo-rent/resources/add.png" alt="something-in-the-way">
        <div class="tenants-credential"><span class="tenants-username"><?php echo $_SESSION['username']?></span> <span class="tenants-email"><?php echo $_SESSION['email']?></span></div>
        <div class="interactive-btn">
            <button class="kick-out">Kick Out</button>
            <button class="view-profile">View Profile</button>
        </div>
        </div>
        <div class="tenants-card js-tenants-card">
        <img src="/sajilo-rent/resources/add.png" alt="something-in-the-way">
        <div class="tenants-credential"><span class="tenants-username"><?php echo $_SESSION['username']?></span> <span class="tenants-email"><?php echo $_SESSION['email']?></span></div>
        <div class="interactive-btn">
            <button class="kick-out">Kick Out</button>
            <button class="view-profile">View Profile</button>
        </div>
        </div>
        <div class="tenants-card js-tenants-card">
        <img src="/sajilo-rent/resources/add.png" alt="photo-no-uploaded">
        <div class="tenants-credential"><span class="tenants-username"><?php echo $_SESSION['username']?></span> <span class="tenants-email"><?php echo $_SESSION['email']?></span></div>
        <div class="interactive-btn">
            <button class="kick-out">Kick Out</button>
            <button class="view-profile">View Profile</button>
        </div>
        </div>
        </div>
        </main>
        <div class="uploadphoto js-upload-photo">
            <div class="photo js-photo">
            </div>
            <form action="/sajilo-rent/user-panel/back_end/addprofilepic.php" method="post" enctype="multipart/form-data">
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
        <dialog class="review js-review">
            <h2>Review</h2>
            <div id="stars" >
                <span class="star js-star" data-value="1">★</span>
                <span class="star js-star" data-value="2">★</span>
                <span class="star js-star" data-value="3">★</span>
                <span class="star js-star" data-value="4">★</span>
                <span class="star js-star" data-value="5">★</span>
            </div>
            <section class="comment-section">
                <textarea name="" id="" class="comment-section-area js-text-area" placeholder="Your comment here..."></textarea>
            </section>
            <button class="submit-review-btn js-submit-review-btn">Kick without response</button>
        </dialog>
</body>
</html>