<?php 
$email = $_SESSION['email'];
?>

<aside class="aside-bar">
            <div class="main-links">
                <a href="/sajilo-rent/user-panel/owner-page.php"><img src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1"/><span class="link-text home">Home</span></a>
                <a href="/sajilo-rent/user-panel/owner-profile.php"><img src="https://img.icons8.com/fluency-systems-regular/50/user--v1.png" alt="user icon"/><span class="link-text user-profile">Profile</span></a>
                <a href="/sajilo-rent/chatapplication/messenger.php?email=<?php echo $email?>"><img src="https://img.icons8.com/ios/50/messages-mac.png" alt="messages-icon"/><span class="link-text messages">Messages</span></a>
                <a href="#"><img src="https://img.icons8.com/ios/50/conference-call.png" alt="tenants profile icon"/><span class="link-text tenants-proile">Tenants Profile</span></a>
<!----create the tenants request section by yourselves ----->
                <a href=""><img src="https://img.icons8.com/fluency-systems-regular/50/request-feedback.png" alt="rent request icon"/><span class="link-text rent-request">Rent Request</span></a>
                <a href="#"><img src="https://img.icons8.com/fluency-systems-regular/50/password-window.png" alt="password icon"/><span class="link-text change-password">Change Password</span></a>
            </div>
            <div class="bottom-links">
                <a href="#"><img class="log-out-pic" src="https://img.icons8.com/fluency-systems-regular/50/exit--v1.png" alt="log out icon"/><span class="link-text log-out">Log-out</span></a>
                <a href="#"><img class="about-pic" src="https://img.icons8.com/fluency-systems-regular/50/about.png" alt="about icon"/><span class="link-text about">About</span></a>
            </div>
</aside>
<!-------------------------- modal for changing password  --->
<dialog class="dialog-change-password"> 
    <form action="/sajilo-rent/user-panel/back_end/changepassword.php" method="post" class="form-change-password">
        <h1>Change Password</h1>
        <img width="24" height="24" src="https://img.icons8.com/material-outlined/24/cancel--v1.png" alt="cancel--v1" class="cancel-icon"/>
        <div class="password-wrapper">
            <div class="old-password-wrapper">
                <label for="old-password">Current-Password: </label>
                <div class="old-password-input">
                    <input type="password" name="oldPassword" id="old-password" placeholder="Enter current Password">
                    <img width="24" height="24" src="https://img.icons8.com/material-outlined/24/hide.png" alt="hide" class="hide-eye-icon"/>
                </div>
            </div>
            <div class="new-password-wrapper">
                <label for="new-password">New-Password</label>
                <div class="new-password-input">
                    <input type="password" name="newPassword" id="new-password" placeholder="Enter new Password">
                    <img width="24" height="24" src="https://img.icons8.com/material-outlined/24/hide.png" alt="hide" class="hide-eye-icon"/>
                </div>
            </div>
        </div>
        <div class="button-wrapper">
            <button type="button" class="cancel-button">Cancel</button>
            <button type="submit" class="confirm-button">Confirm</button>
        </div>
    </form>
</dialog>
<script>
const seeEyeUrl = "https://img.icons8.com/material-outlined/24/visible--v1.png";
const hideEyeUrl = "https://img.icons8.com/material-outlined/24/hide.png";

const changePassword = document.querySelector(".main-links a:nth-of-type(6)");
const changePasswordDialog = document.querySelector(".dialog-change-password");
const cancelModalIcon = document.querySelector(".cancel-icon");
const cancelButton = document.querySelector(".cancel-button");

// Get references to both password inputs and their corresponding eye icons
const oldPasswordInput = document.querySelector("#old-password");
const newPasswordInput = document.querySelector("#new-password");
const oldPasswordEye = document.querySelector(".old-password-input .hide-eye-icon");
const newPasswordEye = document.querySelector(".new-password-input .hide-eye-icon");

// Cancel button functionality
cancelModalIcon.addEventListener("click", () => {
    changePasswordDialog.close();
});

cancelButton.addEventListener('click',()=>{
    changePasswordDialog.close();
})
// Toggle old password visibility
oldPasswordEye.addEventListener("click", () => {
    if (oldPasswordEye.classList.contains("hide-eye-icon")) {
        oldPasswordEye.src = seeEyeUrl;
        oldPasswordEye.classList.remove("hide-eye-icon");
        oldPasswordEye.classList.add("see-eye-icon");
        oldPasswordInput.type = "text";
    } else {
        oldPasswordEye.src = hideEyeUrl;
        oldPasswordEye.classList.remove("see-eye-icon");
        oldPasswordEye.classList.add("hide-eye-icon");
        oldPasswordInput.type = "password";
    }
});

// Toggle new password visibility
newPasswordEye.addEventListener("click", () => {
    if (newPasswordEye.classList.contains("hide-eye-icon")) {
        newPasswordEye.src = seeEyeUrl;
        newPasswordEye.classList.remove("hide-eye-icon");
        newPasswordEye.classList.add("see-eye-icon");
        newPasswordInput.type = "text";
    } else {
        newPasswordEye.src = hideEyeUrl;
        newPasswordEye.classList.remove("see-eye-icon");
        newPasswordEye.classList.add("hide-eye-icon");
        newPasswordInput.type = "password";
    }
});

// Open the modal dialog
changePassword.addEventListener('click', (event) => {
    event.preventDefault();
    changePasswordDialog.showModal();
});

//backend calls

const formChangePassword = document.querySelector(".form-change-password");
const confirmChangePassword = document.querySelector(".confirm-button")
formChangePassword.addEventListener('submit',(event)=>{
    event.preventDefault();
    const changePasswordData = new FormData(formChangePassword);
    callChangePassword(changePasswordData);
    
})
async function callChangePassword(changePasswordData){
    try{
        const reponse = await fetch("/sajilo-rent/user-panel/back_end/changepassword.php",{
        method : 'POST',
        body: changePasswordData
    })
    const reponseJson = await reponse.json();
    if(reponseJson.status  == "success"){
        changePasswordDialog.close();
        formChangePassword.reset();
        alert("Password Change Successfully");
    }   
    else{
        oldPasswordInput.style.outline = "1px solid red";
        newPasswordInput.style.outline = "1px solid red";
        oldPasswordInput.value = "";
        newPasswordInput.value = "";
        oldPasswordInput.placeholder = "Current password mismatch";
        newPasswordInput.placeholder = "Current password mismatch";

    }
    console.log(reponseJson);
}
    catch(error){
        console.log('Error:', error);
        alert('An error occurred while changing the password.');
    }
}

</script>
<!-------------------------- modal for loggin out  --->
<dialog class="dialog-logout">
    <form action="" method="post" class="form-logout">
        <h1>Log Out</h1>
        <img width="24" height="24" src="https://img.icons8.com/material-outlined/24/cancel--v1.png" alt="cancel--v1" class="cancel-icon"/>
        <div class="logout-content">
            <p>Are you sure you want to log out?</p>
        </div>
        <div class="button-wrapper">
            <button type="button" class="cancel-button">Cancel</button>
            <button type="button" class="confirm-button-logout confirm-button">Log Out</button> <!--Sijan you have to make this change in your file as well --->
        </div>
    </form>
</dialog>
<!-- script for logout -->

<script>
const logOut = document.querySelector(".bottom-links a:nth-of-type(1)");
const logoutDialog = document.querySelector(".dialog-logout");
const cancelLogoutIcon = document.querySelector(".dialog-logout .cancel-icon");
const cancelLogoutButton = document.querySelector(".dialog-logout .cancel-button");
const confirmLogoutButton = document.querySelector('.confirm-button-logout');
// Show logout dialog when logout link is clicked
logOut.addEventListener('click', (event) => {
    logoutDialog.showModal();
});
confirmLogoutButton.addEventListener('click',  async ()=>{
console.log('hi');
await fetch('/sajilo-rent/user-panel/back_end/logout.php');
window.location.href = '/sajilo-rent/loginsignup_page/login.php';
});
// Close logout dialog when cancel icon is clicked
cancelLogoutIcon.addEventListener('click', () => {
   cancelLogoutButton.click();
});

// Close logout dialog when cancel button is clicked
cancelLogoutButton.addEventListener('click', () => {

    logoutDialog.close();
});
</script>