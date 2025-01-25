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
const mainSection = document.querySelector('.main-section');
const containerForInfo = document.querySelector('.container-for-info');
const requestCard = document.querySelector('.js-request-card');
const myProfile = document.querySelector('.js-my-profile');
const tenants = document.querySelector('.js-tenants');
const rooms = document.querySelector('.js-rooms');
const oldPassword = document.querySelector('.js-old-password');
const newPassword = document.querySelector('.js-new-password');
const confirmBtn =  document.querySelector('.js-confirm');
const closeBtn3 =document.querySelector('.js-cross3-icon');
const changePassword = document.querySelector('.js-change-password');
const setPassword = document.querySelector('.js-password');
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
 profilepic.style.backgroundSize = 'fill';
 profilepic.style.backgroundPosition = 'center';
 } 
}
else{
    console.log("the messagte is " + this.readyState + " and " +this.status );
}
}
//////////////////////////////for owner info like tenants living rooms rating etc//////////////////////////////////////
const xml = new XMLHttpRequest();
xml.open('GET' , `/sajilo-rent/user-panel/back_end/ownerinfo.php?email=${email.innerText}`);
xml.send();
xml.onload = function(){
    let jsonObj;
    if(this.readyState === 4 && this.status === 200)
        {
        jsonObj = JSON.parse(this.responseText);
        tenants.innerText = jsonObj['tenants'];
        rooms.innerText = jsonObj['rooms'];
        }
        else{
            console.log("the messagte is " + this.readyState + " and " +this.status );
        }
}
/////////////////////////////////////////////////////////////////////////
rentRequestBtn.addEventListener('click' , ()=>{
requestCard.classList.remove('hidden');
containerForInfo.style.display = 'none';
mainSection.style.display = 'none';
});
myProfile.addEventListener('click' , ()=>{
    requestCard.classList.add('hidden');
    containerForInfo.style.display = 'flex';
    mainSection.style.display = 'flex';
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
confirmBtn.addEventListener('click' , ()=>{
const xml = new XMLHttpRequest();
xml.open('GET' , `/sajilo-rent/user-panel/back_end/changepassword.php?oldPassword=${oldPassword.value}&newPassword=${newPassword.value}&email=${email.innerText}`);
xml.send();
xml.onload = function()
{
    if(this.readyState === 4 && this.status === 200)
        {   
            console.log(this.responseText);
            if(this.responseText === 'error')
            {
                oldPassword.placeholder = "password mismatch";
                newPassword.placeholder = "password mismatch";
                oldPassword.style.border = "1px solid red";
                newPassword.style.border = "1px solid red";
                
            }
            else if(this.responseText === 'success'){
                oldPassword.placeholder = "password changed";
                newPassword.placeholder = "password changed";
                oldPassword.style.border = "none";
                newPassword.style.border = "none";
            }
            oldPassword.value ='';
            newPassword.value ='';
        }
        else {
            console.log("the messagte is " + this.readyState + " and " +this.status );
        }
}

});
setPassword.addEventListener('click' ,()=>{
    changePassword.style.display = "flex";
    document.querySelector('main').style.filter = "blur(10px)";
});
closeBtn3.addEventListener('click' , ()=>{
    changePassword.style.display = "none";
    document.querySelector('main').style.filter = "blur(0px)";
});
//////////////////////////////////////////////////////////////////////////////