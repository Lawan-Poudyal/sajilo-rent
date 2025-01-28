let menu = document.getElementById('js-menu'); 
let menuClick = false;
let dropDown = document.getElementById('js-drop-down');
const photo = document.querySelector('.js-photo');
const image = document.querySelector('.js-image');
let imagePath = '/sajilo-rent/studentsection/backend/';
let profilepic = document.querySelector('.js-profile-pic');
const uploadPhoto = document.querySelector('.js-upload-photo');
const closeBtn = document.querySelector('.js-cross-icon');
const closeBtn2 = document.querySelector('.js-cross2-icon');
const logoutBtn = document.querySelector('.js-logout');
const logoutSection = document.querySelector('.js-log-out');
const notLogoutBtn = document.querySelector('.js-notlogout');
const sureLogoutBtn = document.querySelector('.js-sure');
const email = document.querySelector('.js-email');
const mainSection = document.querySelector('.main-section');
const containerForInfo = document.querySelector('.container-for-info');
const requestCard = document.querySelector('.js-request-card');
const myProfile = document.querySelector('.js-my-profile');
const oldPassword = document.querySelector('.js-old-password');
const newPassword = document.querySelector('.js-new-password');
const confirmBtn = document.querySelector('.js-confirm');
const closeBtn3 = document.querySelector('.js-cross3-icon');
const changePassword = document.querySelector('.js-change-password');
const setPassword = document.querySelector('.js-password');

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
        setTimeout(() => { dropDown.style.display = "none"; }, 1000);
        menuClick = false;
    }
});

uploadPhoto.style.display = "none";
profilepic.addEventListener('click', () => {
    if (uploadPhoto.style.display === "none") {
        uploadPhoto.style.display = "flex";
        document.querySelector('main').style.filter = "blur(10px)";
    }
});
closeBtn.addEventListener('click', () => {
    uploadPhoto.style.display = "none";
    document.querySelector('main').style.filter = "blur(0px)";
});

logoutSection.style.display = "none";
logoutBtn.addEventListener('click', () => {
    if (logoutSection.style.display === "none") {
        logoutSection.style.display = "flex";
        document.querySelector('main').style.filter = "blur(10px)";
    }
});
closeBtn2.addEventListener('click', () => {
    logoutSection.style.display = "none";
    document.querySelector('main').style.filter = "blur(0px)";
});
notLogoutBtn.addEventListener('click', () => {
    logoutSection.style.display = "none";
    document.querySelector('main').style.filter = "blur(0px)";
});
sureLogoutBtn.addEventListener('click', () => {
    fetch('/sajilo-rent/studentsection/backend/logout.php', { method: 'POST' })
        .then(response => {
            if (response.ok) {
                window.location = "/sajilo-rent/loginsignup_page/login.php";
            } else {
                console.log(`The message is ${response.status}`);
            }
        });
});

async function loadProfilePic() {
    try {
        const response = await fetch('/sajilo-rent/studentsection/backend/setprofilepic.php', { method: 'POST' });
        if (response.ok) {
            const jsonfile = await response.json();
            imagePath += jsonfile["image"];
            if (jsonfile["image"] !== "false") {
                profilepic.style.backgroundImage = `url(${imagePath})`;
                profilepic.style.backgroundSize = 'fill';
                profilepic.style.backgroundPosition = 'center';
            }
        } else {
            console.log(`The message is ${response.status}`);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}
loadProfilePic();


myProfile.addEventListener('click', () => {
    requestCard.classList.add('hidden');
    containerForInfo.style.display = 'flex';
    mainSection.style.display = 'flex';
});

photo.addEventListener('click', () => {
    image.click();
});
image.addEventListener('change', (event) => {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            // Clear the div and add the image
            photo.innerHTML = ''; // Clear previous content
            photo.style.backgroundImage = `url(${reader.result})`;
        };
        reader.readAsDataURL(file); // Read the image as a data URL
    } else {
        photo.textContent = 'No image selected';
    }
});

confirmBtn.addEventListener('click', async () => {
    try {
        const response = await fetch(`/sajilo-rent/user-panel/back_end/changepassword.php?oldPassword=${oldPassword.value}&newPassword=${newPassword.value}&email=${email.innerText}`);
        if (response.ok) {
            const result = await response.text();
            if (result === 'error') {
                oldPassword.placeholder = "password mismatch";
                newPassword.placeholder = "password mismatch";
                oldPassword.style.border = "1px solid red";
                newPassword.style.border = "1px solid red";
            } else if (result === 'success') {
                oldPassword.placeholder = "password changed";
                newPassword.placeholder = "password changed";
                oldPassword.style.border = "none";
                newPassword.style.border = "none";
            }
            oldPassword.value = '';
            newPassword.value = '';
        } else {
            console.log(`The message is ${response.status}`);
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

setPassword.addEventListener('click', () => {
    changePassword.style.display = "flex";
    document.querySelector('main').style.filter = "blur(10px)";
});
closeBtn3.addEventListener('click', () => {
    changePassword.style.display = "none";
    document.querySelector('main').style.filter = "blur(0px)";
});

