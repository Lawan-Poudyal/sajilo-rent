let menu = document.getElementById('js-menu'); 
let menuClick = false;
let dropDown = document.getElementById('js-drop-down');
const photo = document.querySelector('.js-photo');
const image = document.querySelector('.js-image');
let imagePath = '/sajilo-rent/user-panel/back_end/';
let profilepic = document.querySelector('.js-profile-pic');
const uploadPhoto = document.querySelector('.js-upload-photo');
const closeBtn = document.querySelector('.js-cross-icon');
const closeBtn2 = document.querySelector('.js-cross2-icon');
const logoutBtn = document.querySelector('.js-logout');
const logoutSection = document.querySelector('.js-log-out');
const notLogoutBtn = document.querySelector('.js-notlogout');
const sureLogoutBtn = document.querySelector('.js-sure');
const email = document.querySelector('.js-email');
const rentRequestBtn = document.querySelector('.js-rent-request');
const mainItem = document.querySelectorAll('.main-item');
const requestCard = document.querySelector('.js-request-card');
const myProfile = document.querySelector('.js-my-profile');
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
        document.querySelector('main').style.filter = "blur(10px)";
    }
});
closeBtn.addEventListener('click' , ()=>{
 uploadPhoto.style.display = "none";
 document.querySelector('main').style.filter = "blur(0px)";
}
);
logoutSection.style.display = "none";
logoutBtn.addEventListener('click' , ()=>{
if(logoutSection.style.display = "none")
{
    logoutSection.style.display = "flex";
    document.querySelector('main').style.filter = "blur(10px)";

}
});
closeBtn2.addEventListener('click' , ()=>{
    logoutSection.style.display = "none";
    document.querySelector('main').style.filter = "blur(0px)";
});
notLogoutBtn.addEventListener('click' , ()=>{
    logoutSection.style.display = "none";
    document.querySelector('main').style.filter = "blur(0px)";
});
sureLogoutBtn.addEventListener('click' , ()=>{
const xmlrequest = new XMLHttpRequest();
xmlrequest.open('POST','/sajilo-rent/user-panel/back_end/logout.php');
xmlrequest.send();
xmlrequest.onload = function(){
if(this.readyState === 4 && this.status === 200)
{
    window.location = "/sajilo-rent/loginsignup_page/login.php";
}
else{
    console.log("the messagte is " + this.readyState + " and " +this.status );
}
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
 if(jsonfile["image"] !== "false")
 {
 profilepic.style.backgroundImage = `url(${imagePath})`;
 } 
}
else{
    console.log("the messagte is " + this.readyState + " and " +this.status );
}
}
////////////////////////////////////////////////////////////////////////
rentRequestBtn.addEventListener('click' , ()=>{
requestCard.classList.toggle('hidden');
mainItem.forEach((item)=>{
    item.classList.toggle('hidden');
});
});
myProfile.addEventListener('click' , ()=>{
    requestCard.classList.toggle('hidden');
    mainItem.forEach((item)=>{
        item.classList.toggle('hidden');
    });
});
//////////////////////////////////////////////////////////////////////////
showRequest();
function showRequest()
{
    const httprequest  = new XMLHttpRequest();
httprequest.open('GET',`/sajilo-rent/user-panel/back_end/loadrequest.php?email=${email.innerText}`);
httprequest.send();
httprequest.onload = function(){
    if(this.readyState === 4 && this.status === 200)
    {
        console.log(this.responseText);
        jsonObj = JSON.parse(this.responseText);
        let htmlforrequest = '';
        jsonObj.forEach((obj)=>{
            htmlforrequest += `<div class="request-card">
               <div class="profile-info">
                   <img src="https://via.placeholder.com/50" alt="Profile Picture" class="profile-pic">
                   <div>
                       <h3 class="username">${obj['email']}</h3>
                   </div>
               </div>
               <div class="actions">
                   <button class="accept-btn js-accept-btn" data-sender = "${obj['email']}" data-lat = "${obj['lat']}" data-lng = "${obj['lng']}">Accept</button>
                   <button class="decline-btn">Decline</button>
               </div>
           </div>`
        
       });
       document.querySelector('.js-request-card').innerHTML = htmlforrequest;   
       document.querySelectorAll('.js-accept-btn').forEach((btn)=>{
           btn.addEventListener('click' , ()=>{
              acceptRequest(btn.dataset.sender , btn.dataset.lat , btn.dataset.lng);
           });
       });  
    }
    else {
        console.log("the messagte is " + this.readyState + " and " +this.status );
    }
}
   
}
///////////////////////////////////////////////////////////////////////////////////
function acceptRequest(sender , lat , lng)
{
const httprequest  = new XMLHttpRequest();
httprequest.open('GET',`/sajilo-rent/user-panel/back_end/acceptrequest.php?email=${sender}&lat=${lat}&lng=${lng}&username=${email.innerText}`);
httprequest.send();
httprequest.onload = function(){
    if(this.readyState === 4 && this.status === 200)
    {   
        showRequest();
    }
    else {
        console.log("the messagte is " + this.readyState + " and " +this.status );
    }
}
}
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