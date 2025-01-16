let menu = document.getElementById('js-menu'); 
let menuClick = false;
let dropDown = document.getElementById('js-drop-down');
const photo = document.querySelector('.js-photo');
const image = document.querySelector('.js-image');
let imagePath = '/sajilo-rent/user-panel/back_end';
let profilepic = document.querySelector('.js-profile-pic');
const uploadPhoto = document.querySelector('.js-upload-photo');
menu.addEventListener('click' , function()
{
if(menuClick === false)
{
menu.classList.remove('reverserotate');
void menu.offsetWidth;
menu.classList.add('rotate');
dropDown.style.display = 'flex';
dropDown.classList.remove('reverseexpand');
void dropDown.offsetWidth;
dropDown.classList.add('expand');
menuClick = true;
}
else if(menuClick === true)
{
    menu.classList.remove('rotate');
    void menu.offsetWidth;
    menu.classList.add('reverserotate');
dropDown.classList.remove('expand');
void dropDown.offsetWidth;
dropDown.classList.add('reverseexpand');
setTimeout(function()
{dropDown.style.display="none";},1000);
    menuClick = false;
    
}
});
uploadPhoto.style.display = "none";
profilepic.addEventListener('click' , ()=>{
    if(uploadPhoto.style.display === "none")
    {
        uploadPhoto.style.display = "flex"; 
    }
    else{
        uploadPhoto.style.display = "none"; 
    }
});
///////////////////////////// loading photo //////////////////////////////////
const xmlrequest = new XMLHttpRequest();
let jsonfile;
xmlrequest.open('POST','/sajilo-rent/user-panel/back_end/setprofilepic.php');
xmlrequest.send();
xmlrequest.onload = function(){
if(this.readyState === 4 && this.status === 200)
{
 jsonfile = JSON.parse(this.responseText);
 imagePath = imagePath + jsonfile["image"];
 profilepic.style.backgroundImage = `url(${imagePath})`;
//  profilepic.style.backgroundImage = `url(../user-panel/back_end/images/aesthetic-room-ideas-5195645-hero-7d51313f2c8f4ed6b338513ae284b113.jpg)`;
 console.log(`the path is ${imagePath}`
 );
}
else{
    console.log("the messagte is " + this.readyState + " and " +this.status );
}
}
///////////////////////////////////////////////////////////////////////////////
////////////////// this is for profile picture setting //////////////////////////
photo.addEventListener('click' , ()=>{
image.click();
});
image.addEventListener('change', (event) => {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
        const reader = new FileReader();

        reader.onload = () => {
            // Clear the div and add the image
            photo.innerHTML = ''; // Clear previous content
            photo.style.backgroundImage =`url(${reader.result})`;
        };

        reader.readAsDataURL(file); // Read the image as a data URL
    } else {
        photo.textContent = 'No image selected';
    }
});

//////////////////////////////////////////////////////////////////////////////