    
<aside class="aside-bar">
            <div class="main-links">
                <a href="/sajilo-rent/studentsection/displayLatLng.php"><img src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1"/><span class="link-text home">Home</span></a>
                <a href="./student-profile.php"><img src="https://img.icons8.com/fluency-systems-regular/50/user--v1.png" alt="user icon"/><span class="link-text user-profile">Profile</span></a>
                <a href="#"><img src="https://img.icons8.com/ios/50/messages-mac.png" alt="messages-icon"/><span class="link-text messages">Messages</span></a>
                <a href="#"><img src="https://img.icons8.com/ios/50/landlord.png" alt="landlord"/><span class="link-text owner-profile">Owner Profile</span></a>
                <a href="#"><img src="https://img.icons8.com/fluency-systems-regular/50/password-window.png" alt="password icon"/><span class="link-text change-password">Change Password</span></a>
            </div>
            <div class="bottom-links">
                <a href="#"><img class="log-out-pic" src="https://img.icons8.com/fluency-systems-regular/50/exit--v1.png" alt="log out icon"/><span class="link-text log-out">Log-out</span></a>
                <a href="#"><img class="about-pic" src="https://img.icons8.com/fluency-systems-regular/50/about.png" alt="about icon"/><span class="link-text about">About</span></a>
            </div>
</aside>
<!-- modal for changepassword -->

<dialog class="dialog-change-password"> 
    <form action="/sajilo-rent/user-panel/backend/chagepassword.php" method="post" class="form-change-password">
        <h1>Change Password</h1>
        <img width="24" height="24" src="https://img.icons8.com/material-outlined/24/cancel--v1.png" alt="cancel--v1" class="cancel-icon"/>
        <div class="password-wrapper">
            <div class="old-password-wrapper">
                <label for="old-password">Current-Password: </label>
                <div class="old-password-input">
                    <input type="password" name="old-password" id="old-password" placeholder="Enter current Password">
                    <img width="24" height="24" src="https://img.icons8.com/material-outlined/24/hide.png" alt="hide" class="hide-eye-icon"/>
                </div>
            </div>
            <div class="new-password-wrapper">
                <label for="new-password">New-Password</label>
                <div class="new-password-input">
                    <input type="password" name="new-password" id="new-password" placeholder="Enter new Password">
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

<!-- modal for logout  -->

<dialog class="dialog-logout">
    <form action="/sajilo-rent/user-panel/backend/logout.php" method="post" class="form-logout">
        <h1>Log Out</h1>
        <img width="24" height="24" src="https://img.icons8.com/material-outlined/24/cancel--v1.png" alt="cancel--v1" class="cancel-icon"/>
        <div class="logout-content">
            <p>Are you sure you want to log out?</p>
        </div>
        <div class="button-wrapper">
            <button type="button" class="cancel-button">Cancel</button>
            <button type="submit" class="confirm-button">Log Out</button>
        </div>
    </form>
</dialog>

<!-- script for changepassword -->

<script>
const seeEyeUrl = "https://img.icons8.com/material-outlined/24/visible--v1.png";
const hideEyeUrl = "https://img.icons8.com/material-outlined/24/hide.png";

const changePassword = document.querySelector(".main-links a:nth-of-type(5)");
const about = document.querySelector(".bottom-links a:nth-of-type(2)");
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
</script>

<script>
const logOut = document.querySelector(".bottom-links a:nth-of-type(1)");
const logoutDialog = document.querySelector(".dialog-logout");
const cancelLogoutIcon = document.querySelector(".dialog-logout .cancel-icon");
const cancelLogoutButton = document.querySelector(".dialog-logout .cancel-button");

// Show logout dialog when logout link is clicked
logOut.addEventListener('click', (event) => {
    event.preventDefault();
    logoutDialog.showModal();
});

// Close logout dialog when cancel icon is clicked
cancelLogoutIcon.addEventListener('click', () => {
    logoutDialog.close();
});

// Close logout dialog when cancel button is clicked
cancelLogoutButton.addEventListener('click', () => {
    logoutDialog.close();
});
</script>