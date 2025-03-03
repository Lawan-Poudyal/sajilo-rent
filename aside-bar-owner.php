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
                <a href="" class="js-tenants-request"><img src="https://img.icons8.com/fluency-systems-regular/50/request-feedback.png" alt="rent request icon"/><span class="link-text rent-request">Rent Request</span></a>
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
<!------------------ dialog for seeing tenants profile dumbo  --->
<!-- <diaglog class="main-section-div request js-request-card xyz ">
        
</dialog>
<script>
const tenantsRequest = document.querySelector('.js-tenants-request');
const requestCard  = document.querySelector('.js-request-card');
tenantsRequest.addEventListener('click' , ()=>{
requestCard.showModal();
});
</script>



For view tenants - using <dialog> element -->


<dialog class="tenant-dialog">
    <div class="tenant-dialog-header">
        <h2 class="tenant-dialog-title">Tenants Living</h2>
    </div>
    <div class="tenant-dialog-close ">
        <img src="/sajilo-rent/resources/cross.png" height="50" width="50" alt="Close">
    </div>
    <div class="tenant-dialog-content">
        <div class="tenant-card">
            <div class="tenant-info">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Tenant Picture" class="tenant-pic">
                <div class="tenant-details">
                    <p class="tenant-email">amelia.patel@example.com</p>
                    <p class="tenant-since">Tenant since: October 22, 2023</p>
                </div>
            </div>
            <div class="tenant-actions">
                <button class="view-profile-btn">View Profile</button>
                <button class="message-btn">Message</button>
                <button class="remove-btn">Remove</button>
            </div>
        </div>
        <div class="tenant-card">
            <div class="tenant-info">
                <img src="https://randomuser.me/api/portraits/women/42.jpg" alt="Tenant Picture" class="tenant-pic">
                <div class="tenant-details">
                    <p class="tenant-email">sarah.johnson@example.com</p>
                    <p class="tenant-since">Tenant since: March 15, 2023</p>
                </div>
            </div>
            <div class="tenant-actions">
                <button class="view-profile-btn">View Profile</button>
                <button class="message-btn">Message</button>
                <button class="remove-btn">Remove</button>
            </div>
        </div>
    </div>
</dialog>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select the tenants profile link from sidebar
    const tenantsProfileLink = document.querySelector('.aside-bar a:nth-child(4)');
    const tenantDialog = document.querySelector('.tenant-dialog');
    const tenantDialogClose = document.querySelector('.tenant-dialog-close');
    
    // Only open dialog when Tenants Profile link is clicked
    if(tenantsProfileLink) {
        tenantsProfileLink.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default navigation
            tenantDialog.showModal();
            loadTenants();
        });
    }
    
    // Close dialog when the close button is clicked
    if(tenantDialogClose) {
        tenantDialogClose.addEventListener('click', () => {
            tenantDialog.close();
        });
    }
    
    // Add keyboard event for ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && tenantDialog.open) {
            tenantDialog.close();
        }
    });
    
    // Rest of your code...
});
</script>

<style>
    /* Main Dialog Styling */
.tenant-dialog{
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 600px;
    max-height: 80vh;
    overflow: hidden;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

}
/* Dialog Header */
.tenant-dialog-header {
    background-color: #f8f9fa;
    color: #333;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #eaeaea;
}

.tenant-dialog-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
}

/* Close Button */
.tenant-dialog-close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.tenant-dialog-close img {
    width: 24px;
    height: 24px;
}

.tenant-dialog-close:hover {
    transform: scale(1.1);
}

/* Dialog Content */
.tenant-dialog-content {
    padding: 20px;
    overflow-y: auto;
    max-height: calc(80vh - 60px);
}

/* Tenant Card */
.tenant-card {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    gap: 16px;
    border: 1px solid #f0f0f0;
}

.tenant-info {
    display: flex;
    align-items: center;
    gap: 16px;
}

.tenant-pic {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #f0f0f0;
}

.tenant-details {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.tenant-email {
    margin: 0;
    font-weight: 600;
    font-size: 1rem;
    color: #333;
}

.tenant-since {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

/* Action Buttons */
.tenant-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tenant-actions button {
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
}

.view-profile-btn {
    background-color: #f8f9fa;
    color: #212529;
    border: 1px solid #e9ecef;
}
.view-profile-btn:hover {
    background-color: #e9ecef;
}

.message-btn {
    background-color: #4a8cff;
    color: white;
}

.message-btn:hover {
    background-color: #3a7de6;
}

.remove-btn {
    background-color: #f8f9fa;
    color: #dc3545;
    border: 1px solid #e9ecef;

}

.remove-btn:hover {
    background-color: #fee2e5;
}

/* Responsive Design */
@media (max-width: 576px) {
    .tenant-dialog {
        width: 95%;
        max-height: 90vh;
    }
    
    .tenant-info {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .tenant-actions {
        justify-content: center;
    }
    
    .tenant-dialog-title {
        font-size: 1.2rem;
    }
}

</style>

<!-- for removal     -->


<dialog class="review-dialog js-tenant-removal-review">
    <div class="review-dialog-header">
        <h2 class="review-dialog-title">Tenant Removal</h2>
        <div class="review-dialog-close">
            <img src="/sajilo-rent/resources/cross.png" height="20" width="20" alt="Close">
        </div>
    </div>
    
    <div class="review-dialog-content">
        <div class="tenant-review-info">
            <img id="review-tenant-pic" src="" alt="Tenant Picture" class="tenant-pic">
            <div class="tenant-details">
                <p id="review-tenant-email" class="tenant-email"></p>
                <p id="review-tenant-since" class="tenant-since"></p>
            </div>
        </div>
        
        <div class="rating-section">
            <p>Rate your experience with this tenant:</p>
            <div id="stars" class="stars-container">
                <span class="star js-star" data-value="1">★</span>
                <span class="star js-star" data-value="2">★</span>
                <span class="star js-star" data-value="3">★</span>
                <span class="star js-star" data-value="4">★</span>
                <span class="star js-star" data-value="5">★</span>
            </div>
        </div>
        
        <section class="comment-section">
            <textarea name="tenant-review" id="tenant-review" class="comment-section-area js-text-area" placeholder="Reason for removal (optional)..."></textarea>
        </section>
        
        <div class="review-actions">
            <button class="cancel-btn js-cancel-review">Cancel</button>
            <button class="submit-review-btn js-submit-review-btn">Remove Tenant</button>
        </div>
    </div>
</dialog>

<script>
// Initialize variables
let currentTenantElement = null;

// Get DOM elements
const reviewDialog = document.querySelector('.js-tenant-removal-review');
const stars = document.querySelectorAll('.js-star');
const submitBtn = document.querySelector('.js-submit-review-btn');
const cancelBtn = document.querySelector('.js-cancel-review');

// Add event listeners to all remove buttons
document.querySelectorAll('.remove-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Get the parent tenant card
        const tenantCard = this.closest('.tenant-card');
        currentTenantElement = tenantCard;
        
        // Store tenant data in the review dialog using dataset
        const tenantEmail = tenantCard.querySelector('.tenant-email').textContent;
        const tenantSince = tenantCard.querySelector('.tenant-since').textContent;
        const tenantPic = tenantCard.querySelector('.tenant-pic').src;
        
        // Set tenant info in the review dialog
        const tenantPicElement = document.getElementById('review-tenant-pic');
        tenantPicElement.src = tenantPic;
        tenantPicElement.dataset.tenant = tenantEmail;
        
        document.getElementById('review-tenant-email').textContent = tenantEmail;
        document.getElementById('review-tenant-since').textContent = tenantSince;
        
        // Reset the review form
        resetReviewForm();
        
        // Show the review dialog
        reviewDialog.showModal();
    });
});

// Star rating functionality using dataset
stars.forEach(star => {
    star.addEventListener('click', function() {
        const ratingValue = this.dataset.value;
        
        // Set dataset attribute on stars container to store selected rating
        this.parentElement.dataset.rating = ratingValue;
        
        // Update star appearance
        updateStars(ratingValue);
        
        submitBtn.textContent = 'Remove Tenant';
    });
});

// Cancel button functionality
cancelBtn.addEventListener('click', () => {
    reviewDialog.close();
});

// Submit button functionality
submitBtn.addEventListener('click', () => {
    const starsContainer = document.getElementById('stars');
    const rating = starsContainer.dataset.rating || 0;
    const comment = document.getElementById('tenant-review').value.trim();
    const tenant = document.getElementById('review-tenant-pic').dataset.tenant;
    
    // Create removal data object
    const removalData = {
        tenant: tenant,
        rating: parseInt(rating),
        comment: comment,
        removedBy: 'SijanBhandari17',
        removedDate: '2025-03-03',
        removedTime: '18:44:12'
    };
    
    // Log the removal data (in a real app, you'd send this to the server)
    console.log('Tenant removal data:', removalData);
    
    // Remove the tenant card from the DOM
    if (currentTenantElement) {
        currentTenantElement.remove();
    }
    
    // Close the review dialog
    reviewDialog.close();
    
    // Check if there are any tenants left
    const tenantCards = document.querySelectorAll('.tenant-card');
    if (tenantCards.length === 0) {
        document.querySelector('.tenant-dialog-content').innerHTML = 
            '<p class="no-tenants">No tenants currently living in this property.</p>';
    }
});

// Close dialog when clicking on the X button
document.querySelector('.review-dialog-close').addEventListener('click', () => {
    reviewDialog.close();
});

// Helper function to update stars based on rating
function updateStars(value) {
    stars.forEach(star => {
        const starValue = parseInt(star.dataset.value);
        
        if (starValue <= value) {
            star.innerHTML = '⭐';
            star.dataset.filled = 'true';
        } else {
            star.innerHTML = '★';
            star.dataset.filled = 'false';
        }
    });
}

// Helper function to reset the review form
function resetReviewForm() {
    // Reset stars container dataset
    document.getElementById('stars').dataset.rating = '0';
    
    // Reset stars appearance
    stars.forEach(star => {
        star.innerHTML = '★';
        star.dataset.filled = 'false';
    });
    
    // Reset comment
    document.getElementById('tenant-review').value = '';
    
    // Reset button text
    submitBtn.textContent = 'Kick without response';
}

// Add hover effects to stars using dataset
stars.forEach(star => {
    star.addEventListener('mouseenter', function() {
        const hoverValue = parseInt(this.dataset.value);
        
        stars.forEach(s => {
            const starValue = parseInt(s.dataset.value);
            
            if (starValue <= hoverValue) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });
    });
});

// Reset star hover effects on mouse leave
document.getElementById('stars').addEventListener('mouseleave', function() {
    const rating = parseInt(this.dataset.rating || 0);
    
    stars.forEach(star => {
        const starValue = parseInt(star.dataset.value);
        star.classList.remove('active');
        
        if (starValue <= rating) {
            star.innerHTML = '⭐';
        } else {
            star.innerHTML = '★';
        }
    });
});
</script>

<style>
    /* Tenant Removal Review Dialog */
.review-dialog {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
    width: 85%;
    max-width: 500px;
    padding: 0;
    border: none;
    z-index: 1100; /* Higher than tenant-dialog to ensure it overlaps */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Dialog Header */
.review-dialog-header {
    background-color: #dc3545;
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: 8px 8px 0 0;
}

.review-dialog-title {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
}

/* Close Button */
.review-dialog-close {
    cursor: pointer;
    transition: transform 0.2s ease;
}

.review-dialog-close img {
    filter: brightness(0) invert(1);
}

.review-dialog-close:hover {
    transform: scale(1.1);
}

/* Dialog Content */
.review-dialog-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Tenant Review Info */
.tenant-review-info {
    display: flex;
    align-items: center;
    gap: 16px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

/* Star Rating */
.rating-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.rating-section p {
    margin: 0;
    font-weight: 500;
    color: #333;
}

.stars-container {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.star {
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s ease, transform 0.2s ease;
    user-select: none;
}

.star:hover {
    transform: scale(1.1);
}

.star.active {
    color: #ffc107;
}

/* Comment Section */
.comment-section {
    width: 100%;
}

.comment-section-area {
    width: 100%;
    min-height: 100px;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ced4da;
    font-family: inherit;
    resize: vertical;
    box-sizing: border-box;
}

.comment-section-area:focus {
    outline: none;
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.2rem rgba(58, 134, 255, 0.25);
}

/* Action Buttons */
.review-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
}

.cancel-btn {
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid #dee2e6;
    background-color: #f8f9fa;
    color: #212529;
}

.cancel-btn:hover {
    background-color: #e2e6ea;
}

.submit-review-btn {
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    background-color: #dc3545;
    color: white;
}

.submit-review-btn:hover {
    background-color: #c82333;
}

/* Dialog Animation */
@keyframes slideDown {
    from { 
        opacity: 0; 
        transform: translate(-50%, -60%);
    }
    to { 
        opacity: 1; 
        transform: translate(-50%, -50%);
    }
}

.review-dialog[open] {
    animation: slideDown 0.3s ease-out forwards;
}

/* Responsive Adjustments */
@media (max-width: 576px) {
    .review-dialog {
        width: 95%;
    }
    
    .tenant-review-info {
        flex-direction: column;
        text-align: center;
    }
    
    .stars-container {
        gap: 5px;
    }
    
    .star {
        font-size: 1.8rem;
    }
    
    .review-actions {
        flex-direction: column;
    }
    
    .cancel-btn, .submit-review-btn {
        width: 100%;
    }
}

/* Enhancement for active stars */
.star.filled {
    color: #ffc107;
}
</style>