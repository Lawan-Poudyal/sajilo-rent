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
                    <div class="option"><span class="nowarp">Tenants Profile</span></div>  
                    <div class="option js-rent-request"><span class="nowarp">Rent Request</span></div>  
                    <div class="option"><span class="nowarp">Change Password</span></div>  
                    <div class="option js-logout"><span class="nowarp">logout</span></div>  
                    </div>
                </div>
            </nav>
        </header>
        <main class="main">
            <div class="main-div profilepic js-profile-pic main-item"></div>
            <div class="name main-item"><?php echo $_SESSION['username']?></div>
            <div class="email js-email main-item" style="display:none"><?php echo $_SESSION['email']?></div>
            <div class="main-div profilestatus main-item">
                <span class="main-div-span info nowrap ">Rating</span>
                <span class="main-div-span info nowrap "><img src="/sajilo-rent/resources/ratings/rating-50.png" alt=""></span>
                <span class="main-div-span info nowrap ">Tenants Living</span>
                <span class="main-div-span info nowrap ">5</span>
                <span class="main-div-span info nowrap ">Rooms Rented</span>
                <span class="main-div-span info nowrap ">5</span>
            </div>
            <section class="main-section main-item">
            <div class="main-section-div commentsection">
            <textarea name="" id="" class="main-section-div-textarea comment" placeholder="add your comment....."></textarea>
            <button class="main-section-div-button addcomment" >Add Comment</button>    
        </div>
        <div class="main-section-div comments">
            <div class="main-section-div-div commentinfo"><span class="commenter">Abhiyan Regmi </span>  posted on <span class="commentdate">2074/03/15</span></div></div>
            <div class="main-section-div-div comment">This guys is just disgusting , i really don't like him at all this guy is the worst of all time , like i hate him who does he think he is </div>
            </section>
        <div class="main-section-div request js-request-card hidden">
        
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
        <script src="/sajilo-rent/user-panel/script/owner-profile-script.js"></script>
</body>
</html>