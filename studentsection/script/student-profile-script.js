// Selecting DOM elements
const menu = document.getElementById('js-menu');
const dropDown = document.getElementById('js-drop-down');
const photo = document.querySelector('.js-photo');
const image = document.querySelector('.js-image');
const profilePic = document.querySelector('.js-profile-pic');
const uploadPhoto = document.querySelector('.js-upload-photo');
const closeBtn = document.querySelector('.js-cross-icon');
const closeBtn2 = document.querySelector('.js-cross2-icon');
const logoutBtn = document.querySelector('.js-logout');
const logoutSection = document.querySelector('.js-log-out');
const notLogoutBtn = document.querySelector('.js-notlogout');
const sureLogoutBtn = document.querySelector('.js-sure');
const email = document.querySelector('.js-email');
const rentRequestBtn = document.querySelector('.js-rent-request');
const mainItems = document.querySelectorAll('.main-item');
const requestCard = document.querySelector('.js-request-card');
const myProfile = document.querySelector('.js-my-profile');

let menuClick = false;
let imagePath = '/sajilo-rent/user-panel/back_end/';

// Toggle menu dropdown
menu.addEventListener('click', () => {
    if (!menuClick) {
        menu.classList.remove('reverserotate');
        void menu.offsetWidth;
        menu.classList.add('rotate');
        dropDown.style.display = 'flex';
        dropDown.classList.remove('reverseexpand');
        void dropDown.offsetWidth;
        dropDown.classList.add('expand');
        menuClick = true;
    } else {
        menu.classList.remove('rotate');
        void menu.offsetWidth;
        menu.classList.add('reverserotate');
        dropDown.classList.remove('expand');
        void dropDown.offsetWidth;
        dropDown.classList.add('reverseexpand');
        setTimeout(() => { dropDown.style.display = 'none'; }, 1000);
        menuClick = false;
    }
});

// Upload photo functionality
uploadPhoto.style.display = 'none';
profilePic.addEventListener('click', () => {
    if (uploadPhoto.style.display === 'none') {
        uploadPhoto.style.display = 'flex';
        document.querySelector('main').style.filter = 'blur(10px)';
    }
});

closeBtn.addEventListener('click', () => {
    uploadPhoto.style.display = 'none';
    document.querySelector('main').style.filter = 'blur(0px)';
});

// Logout functionality
logoutSection.style.display = 'none';
logoutBtn.addEventListener('click', () => {
    if (logoutSection.style.display === 'none') {
        logoutSection.style.display = 'flex';
        document.querySelector('main').style.filter = 'blur(10px)';
    }
});

closeBtn2.addEventListener('click', () => {
    logoutSection.style.display = 'none';
    document.querySelector('main').style.filter = 'blur(0px)';
});

notLogoutBtn.addEventListener('click', () => {
    logoutSection.style.display = 'none';
    document.querySelector('main').style.filter = 'blur(0px)';
});

sureLogoutBtn.addEventListener('click', async () => {
    try {
        const response = await fetch('/sajilo-rent/studentsection/backend/logout.php', {
            method: 'POST'
        });
        if (response.ok) {
            window.location = '/sajilo-rent/loginsignup_page/login.php';
        } else {
            console.error('Logout failed:', response.status);
        }
    } catch (error) {
        console.error('Logout error:', error);
    }
});

// Load profile picture
(async () => {
    try {
        const response = await fetch('/sajilo-rent/studentsection/backend/setprofilepic.php', {
            method: 'POST'
        });
        if (response.ok) {
            const jsonfile = await response.json();
            if (jsonfile.image !== 'false') {
                profilePic.style.backgroundImage = `url(${imagePath + jsonfile.image})`;
            }
        } else {
            console.error('Profile picture load failed:', response.status);
        }
    } catch (error) {
        console.error('Error loading profile picture:', error);
    }
})();

// Rent request functionality
rentRequestBtn.addEventListener('click', () => {
    requestCard.classList.toggle('hidden');
    mainItems.forEach(item => item.classList.toggle('hidden'));
});

myProfile.addEventListener('click', () => {
    requestCard.classList.toggle('hidden');
    mainItems.forEach(item => item.classList.toggle('hidden'));
});

// Set profile picture
photo.addEventListener('click', () => {
    image.click();
});

image.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            photo.innerHTML = ''; // Clear previous content
            photo.style.backgroundImage = `url(${reader.result})`;
        };
        reader.readAsDataURL(file);
    } else {
        photo.textContent = 'No image selected';
    }
});


