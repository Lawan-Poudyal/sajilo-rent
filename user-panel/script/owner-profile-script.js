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
const tenantsOption = document.querySelector('.js-tenants-option');
const tenantsProfile = document.querySelector('.js-tenants-profile');
const options = document.querySelectorAll('.js-option');
const commentBox = document.querySelector('.js-main-section-div');
var star = document.querySelectorAll('.js-star');
const ratingIcon = document.querySelector('.js-rating-icon')
let rating =0;
let comment = '';
let reviewer = '';
const sendBtn = document.querySelector('.js-submit-review-btn');
options.forEach(option =>{
option.addEventListener('click' , (event)=>{
    event.currentTarget.querySelector('span').click();
})
});
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
tenantsProfile.classList.add('hidden');
tenantsProfile.classList.remove('flex');
containerForInfo.style.display = 'none';
mainSection.style.display = 'none';
});
myProfile.addEventListener('click' , ()=>{
    requestCard.classList.add('hidden');
    tenantsProfile.classList.add('hidden');
    tenantsProfile.classList.remove('flex');
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
            htmlforrequest += `<div class="request-card" data-email=''>
               <div class="profile-info">
                   <img src="/sajilo-rent/user-panel/back_end/${obj["img"]}" alt="Profile Picture" class="profile-pic">
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
tenantsOption.addEventListener('click' , ()=>{
    console.log('clicked');
    requestCard.classList.add('hidden');
    tenantsProfile.classList.add('flex');
    tenantsProfile.classList.remove('hidden');
    containerForInfo.style.display = 'none';
    mainSection.style.display = 'none';
});
///////////////loading tenants profiles .com lol ////////////////////////////
function loadTenantCard()
{
const tenantsxml  = new XMLHttpRequest();
tenantsxml.open('GET' , `/sajilo-rent/user-panel/back_end/loadtenants.php?email=${email.innerText}` , true);
tenantsxml.send();
tenantsxml.onload = function (){
    if(this.status === 200 && this.readyState === 4)
    {
       const arr = JSON.parse(this.responseText);
       let HTML = ``;
       arr.forEach((person)=>{
        HTML += `
        <div class="tenants-card js-tenants-card">
        <img src="/sajilo-rent/user-panel/back_end/${person["image"]}" alt="something-in-the-way">
        <div class="tenants-credential"><span class="tenants-username">${person["username"]}</span> <span class="tenants-email">${person["email"]}</span></div>
        <div class="interactive-btn">
            <button class="kick-out" data-tenant = '${person['email']}'>Kick Out</button>
            <button class="view-profile">View Profile</button>
        </div>
        </div>
        `;
        
    });
    
    document.querySelector('.js-tenants-profile').innerHTML = HTML;
    const modal = document.querySelector('.js-review');
    const kickOut = document.querySelectorAll('.kick-out');
    kickOut.forEach(button =>{
        button.addEventListener('click',(event)=>{
            reciever = event.currentTarget.dataset.tenant;
             modal.showModal();
         })
    })
    
}
else{
    console.log(this.status + this.readyState);
}
}
let starSymb = "⭐";
let lock = false;
star.forEach((rate,index)=>{
rate.addEventListener('click' , (event)=>{
    sendBtn.innerText = 'Submit';
    var rated = rate;
    rate.innerText = starSymb;
    rating = rate.dataset.value;
    while(rated.previousElementSibling)
        {
            rated = rated.previousElementSibling;
            rated.innerHTML = starSymb;
        }
        rated = rate;
    while(rated.nextElementSibling)
        {
            rated = rated.nextElementSibling;
            rated.innerHTML = '★';
        } 
        console.log(rating); 
});


});
}
loadTenantCard();
//////// i told you 1 2 3 4  4 5 6 7  ta aaa times , /////////////////////////////
sendBtn.addEventListener('click' , ()=>{
    comment = document.querySelector('.js-text-area').value;
    const xmlevent = new XMLHttpRequest();
    xmlevent.open('GET' ,`/sajilo-rent/user-panel/back_end/setreview.php?rating=${rating}&comment=${comment}&reviewer=${email.innerText}&reciever=${reciever}` , true);
    xmlevent.send();
    xmlevent.onload = function()
{
    if(this.status === 200 && this.readyState === 4)
    {
        console.log(this.responseText);
        loadTenantCard();
    }
    else{
        console.log(this.status + ' ' + this.readyState);
    }

}
});

///////////////shakalaka boom boom //////////////////////////////////

///////////////////// Loading Comments from the reviewer //////
let commentObj;
const loadCommentXml = new XMLHttpRequest();
loadCommentXml.open('GET'  , `/sajilo-rent/user-panel/back_end/loadcomment.php?email=${email.innerText}` ,true);
loadCommentXml.send();
loadCommentXml.onload = function(){
    if(this.status===200 && this.readyState === 4)
    {
       commentObj =  JSON.parse(this.responseText);
       console.log(commentObj);
       loadRating(commentObj); // reciever  reviewer rating comment
       let HTML = ``;
       commentObj.forEach(comment =>{
        HTML += `
         <div class="comment">
            <div class="main-section-div-div commentinfo"><span class="commenter">${comment['username']} </span>  posted on <span class="commentdate">2074/03/15</span></div>
            <div class="main-section-div-div commentdata">${comment['comment']}</div>
            </div>
        `;
       });
       commentBox.innerHTML = HTML;
    }else{
        console.log('the vlaue of status is ' + this.status + "the value of readystate " + this.readyState);
    }
}


//// Choota Bheem /////////////////////////////
/////////////// For loading the average review rounded up to five/////////
function loadRating(jsonObj)
{
    let totalRating =0;
    let averageRating = 0;
    let nearestToFive = 0;
    jsonObj.forEach(rate=>{
        totalRating += rate["rating"];
    });
    averageRating = Math.round((totalRating/jsonObj.length)*10)/10;
    nearestToFive = loadDecimal(averageRating);
    ratingIcon.innerHTML =`<img src="/sajilo-rent/resources/ratings/rating-${nearestToFive}.png" alt="">`;
}
function loadDecimal(averageRating){
    let floatingPoint = averageRating*10 - Math.floor(averageRating)*10;
    if(floatingPoint <5 && floatingPoint !==0)
    {
        return (averageRating*10 - floatingPoint);
    }
    else if (floatingPoint ===0){
        return averageRating*10;
    }
    else {
        return (averageRating*10 - floatingPoint*10 +5);
    }
}

/////////////////////////////////// test of fetch and promise  /////////////////////////////////
function doSomething(){
    fetch(`/sajilo-rent/user-panel/back_end/loadcomment.php?email=${email.innerText}`).
    then((response)=>{
    return response.json();
    })
    .then(data=>{
    console.log(data);
    });
    }
    doSomething();
    // we can do it in a better way

async function doBetter()
{
 let response = await fetch(`/sajilo-rent/user-panel/back_end/loadcomment.php?email=${email.innerText}`);
 let data = await response.json();
 console.log(data);
}
doBetter();
////////////////////////////////////////////////////////////