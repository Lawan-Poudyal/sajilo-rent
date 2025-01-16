let menu = document.getElementById('js-menu'); 
let menuClick = false;
let dropDown = document.getElementById('js-drop-down');
let slider = document.getElementById('wifi-price');
let slidervalue = document.getElementById('price-value');
let image1 = document.getElementById('image1');
let image2 = document.getElementById('image2');
let image3 = document.getElementById('image3');
let image_div1 = document.getElementById('image-div1');
let image_div2 = document.getElementById('image-div2');
let image_div3 = document.getElementById('image-div3');
let form = document.getElementById('js-form-div');
let cross = document.getElementById('js-cross-icon');
let form_lat = document.getElementById('js-lat');
let form_lng = document.getElementById('js-lng');
var lat , lng;
let lat1 = document.getElementById('lat1');
let lng1 = document.getElementById('lng1');
let lat2 = document.getElementById('lat2');
let lng2 = document.getElementById('lng2');
let lat3 = document.getElementById('lat3');
let lng3 = document.getElementById('lng3');
let lat4 = document.getElementById('lat4');
let lng4 = document.getElementById('lng4');
let username = document.getElementById('username').innerText;
let profileBtn = document.querySelector('.js-profile-btn');
let rentval , electricityval , image1val , image2val , image3val , wifival;
let latlngarr = [
    [parseFloat(lat1.innerText), parseFloat(lng1.innerText)],
    [parseFloat(lat2.innerText), parseFloat(lng2.innerText)],
    [parseFloat(lat3.innerText), parseFloat(lng3.innerText)],
    [parseFloat(lat4.innerText), parseFloat(lng4.innerText)]
  ];
let holderlatlngarr = [[0,0],[0,0],[0,0],[0,0]];
console.log(latlngarr);
let stopper =0;
for(let i=0; i<4; i++)
{
if(latlngarr[i][0] != 0 && latlngarr[i][1] !=0)
{
holderlatlngarr[stopper][0] = latlngarr[i][0];
holderlatlngarr[stopper][1] = latlngarr[i][1];
stopper++;
}
}
console.log(holderlatlngarr);
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
slider.addEventListener('input' , function()
{
slidervalue.innerText = slider.value;
});
image1.addEventListener('change', function(){
    const file = image1.files[0]; //// ----------------------->
    image_div1.style.display="block";
    image1.display = "block";
    if(file)
    {
        const reader = new FileReader();
        reader.onload = function(e)
        {
            image_div1.style.background=`url("${e.target.result}")`;
           image_div1.style.backgroundSize = "cover";
           image_div1.style.backgroundRepeat = "norepeat";
           image_div1.style.backgroundPosition ="center";
        };
        reader.readAsDataURL(file);
    }
    else{
        image_div1.innerHTML = `<span> Image didn't appear </span>`; //-------------->
    }
 });
image2.addEventListener('change', function(){
    const file = image2.files[0]; //// ----------------------->
    image_div2.style.display="block";
    if(file)
    {
        const reader = new FileReader();
        reader.onload = function(e)
        {
           image_div2.style.background=`url("${e.target.result}")`;
           image_div2.style.backgroundSize = "cover";
           image_div2.style.backgroundRepeat = "norepeat";
           image_div2.style.backgroundPosition ="center";
        };
        reader.readAsDataURL(file);
    }
    else{
        image_div2.innerHTML = `<span> Image didn't appear </span>`; //-------------->
    }
 });
image3.addEventListener('change', function(){
    const file = image3.files[0]; //// ----------------------->
    image_div3.style.display="block";
    image3.display = "block";
    if(file)
    {
        const reader = new FileReader();
        reader.onload = function(e)
        {
           image_div3.style.background=`url("${e.target.result}")`;
           image_div3.style.backgroundSize = "cover";
           image_div3.style.backgroundRepeat = "norepeat";
           image_div3.style.backgroundPosition ="center";
        };
        reader.readAsDataURL(file);
    }
    else{
        image_div3.innerHTML = `<span> Image didn't appear </span>`; //-------------->
    }
 });
 function showform()
 {
 if(stopper >=4)
 {
    alert("can't have more than 4 houses on rent");
 }
 else{
 form.style.display="block";
 form_lat.value = lat;
 form_lng.value = lng;
 }
 }
 cross.addEventListener('click' , ()=>{
 form.style.display = "none";
 });
 function removehouse( lat ,  lng)
 {
//   stopper--;
  console.log("lat :" +lat+ " lng:" +lng);
  var xmlrequest = new XMLHttpRequest();
  xmlrequest.open("GET" , `/sajilo-rent/user-panel/back_end/removehouses.php?lat=${lat}&lng=${lng}&username=${username}`,true);
  xmlrequest.send();
  xmlrequest.onload = function()
  {
    if(this.readyState === 4 && this.status === 200)
    {
        console.log(this.responseText);
        const key = `${lat}_${lng}`;
        if (markerMap.has(key)) {
            const marker = markerMap.get(key);
            map.removeLayer(marker); // Remove the marker from the map
            markerMap.delete(key);   // Delete the marker from the markerMap
        }

        stopper--;
    }
    else{
        console.log("we ran into this problem " + this.readyState + " and this " + this.status);
    }
  }
  
 }
 ////////// for redirection purposes ////////////////////////
profileBtn.addEventListener('click' , ()=>{
window.location = "/sajilo-rent/user-panel/owner-profile.php";
});
//////////////////////////////////////////////// MAP //////////////////////////////
var map = L.map('js-map').setView([27.6194, 85.5388], 50); 

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
// L.marker(holderlatlngarr[0][0] , holderlatlngarr[0][1]).addTo(map).bindPopup('Rent Your House Here <button id="pointer-btn">Rented</button>').openPopup();
// console.log("the vlaue of stopper is " + stopper);
var tempmarker = [];
let markerMap = new Map();
for(let i=0; i<stopper; i++)
{
  
    tempmarker[i] = L.marker([holderlatlngarr[i][0], holderlatlngarr[i][1]]).addTo(map)
    .bindPopup(`
        <div class = 'popup-window'>
        <div class='info-wrapper image-wrapper'>
        <img src="/sajilo-rent/user-panel/back_end/images/WIN_20241004_16_04_06_Pro.jpg" height ="100" width ="100">
        <img src="/sajilo-rent/user-panel/back_end/images/WIN_20241004_16_04_06_Pro.jpg" height ="100" width ="100">
        <img src="/sajilo-rent/user-panel/back_end/images/WIN_20241004_16_04_06_Pro.jpg" height ="100" width ="100">
        </div>
        <div class= 'info-wrapper faq-wrapper'>
        <span>Rent:</span>
        <span>2500</span>
        <span>Wifi:</span>
        <span>500</span>
        <span>Electricity</span>
        <span>Available</span>
        </div>
        <div class='info-wrapper info-btn'>
        <button id="pointer-btn" onclick="removehouse(${holderlatlngarr[i][0]} , ${holderlatlngarr[i][1]})">Remove</button>
        <button id="pointer-btn">Update</button></div></div>`)
    .openPopup();
    markerMap.set(`${holderlatlngarr[i][0]}_${holderlatlngarr[i][1]}`, tempmarker[i]);


}
var routeControl = null;

function showDirections(destinationLat, destinationLng) {
    if (routeControl) {
        map.removeControl(routeControl); 
    }
    routeControl = L.Routing.control({
        waypoints: [
            L.latLng(27.6194, 85.5388), 
            L.latLng(destinationLat, destinationLng) 
        ]
    }).addTo(map);
}

tempmarker.forEach((marker) => {
    marker.addEventListener('click' ,function()
    {
        const position = marker.getLatLng(); // Get the position of the marker
        const lat = position.lat;
        const lng = position.lng;
        showDirections(lat, lng);
        var xmlrequest = new XMLHttpRequest();
        xmlrequest.open("GET" , `/sajilo-rent/user-panel/back_end/showhousedetails.php?lat=${lat}&lng=${lng}&username=${username}`,true);
        xmlrequest.send();
        xmlrequest.onload = function(){
            if(this.readyState === 4 && this.status === 200)
            {
                var jsonobj = JSON.parse(this.responseText);
                marker.bindPopup(`
                    <div class = 'popup-window'>
                    <div class='info-wrapper image-wrapper'>
                    <img src="/sajilo-rent/user-panel/back_end/${jsonobj["image1"]}" height ="100" width ="100">
                    <img src="/sajilo-rent/user-panel/back_end/${jsonobj["image2"]}" height ="100" width ="100">
                    <img src="/sajilo-rent/user-panel/back_end/${jsonobj["image3"]}" height ="100" width ="100">
                    </div>
                    <div class= 'info-wrapper faq-wrapper'>
                    <span>Rent:</span>
                    <span>${jsonobj["pricem"]}</span>
                    <span>Wifi:</span>
                    <span>${jsonobj["wifi_price"]}</span>
                    <span>Electricity</span>
                    <span>${jsonobj["electricity"]}</span>
                    </div>
                    <div class='info-wrapper info-btn'>
                    <button id="pointer-btn" onclick="removehouse(${lat} , ${lng})">Remove</button>
                    <button id="pointer-btn">Update</button></div></div>`);
            }
            else{
                console.log(this.readyState + " " + this.status);
            }
        }
    })
});
var permanentMarker =[
L.marker([27.6194, 85.5388]).addTo(map)
  .bindPopup("Kathmandu University")
  .openPopup()];
var dynamicMarkers= [];
map.on('click' , function(e){
lat = e.latlng.lat;
lng = e.latlng.lng;
var newMarker =L.marker([lat,lng]).addTo(map).
bindPopup('Rent Your House Here <button id="pointer-btn" onclick="showform()">Rent</button>')
.openPopup();
dynamicMarkers.forEach(function(marker) {
    marker.remove();
});
dynamicMarkers.push(newMarker);

});

////////////////////////////////////////////////////////////////////////////