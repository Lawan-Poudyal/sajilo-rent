let menu = document.getElementById('js-menu'); 
let menuClick = false;
let dropDown = document.getElementById('js-drop-down');
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

//////////////////////////////////////////////// MAP //////////////////////////////
var map = L.map('js-map').setView([27.6194, 85.5388], 50); 

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var permanentMarker =[
L.marker([27.6194, 85.5388]).addTo(map)
  .bindPopup("Kathmandu University")
  .openPopup()];
var dynamicMarkers= [];
map.on('click' , function(e){
var lat = e.latlng.lat;
var lng = e.latlng.lng;
var newMarker =L.marker([lat,lng]).addTo(map).
bindPopup('Rent Your House Here <button id="pointer-btn" onclick="saveMarker()">Rent</button>')
.openPopup();
dynamicMarkers.forEach(function(marker) {
    marker.remove();
});
dynamicMarkers.push(newMarker);
});
var markersLayer = L.layerGroup().addTo(map);
var length =0;
function saveMarker()
{
    if(permanentMarker.length >=5)
    {
        console.log('marker overflow');
        return;
    }
    length++;
permanentMarker.push( dynamicMarkers.pop().addTo(map).
bindPopup('Rented House Here <button id="pointer-btn" onclick="removeMarker('+length+')">Remove</button>')
.addTo(markersLayer).openPopup());
setValue();
showsomething();
}
function removeMarker(index)
{
    if(permanentMarker.length<=1)
    {
        console.log('marker underflow');
        return;
    }
    permanentMarker[index].remove();
    permanentMarker.splice(index ,1);
    length--;
    displayMarker();
}
function displayMarker(length){
    var len = permanentMarker.length;
    for(let i=1; i<len; i++)
    {
        permanentMarker[i].remove();
    }
    for(let i=1; i<permanentMarker.length; i++)
    {
        permanentMarker[i].addTo(map).
        bindPopup('Rented House Here <button id="pointer-btn" onclick="removeMarker('+i+')">Remove</button>').openPopup();
    }
    setValue();
    showsomething();
}
let val = [];
function setValue()
{
    if (permanentMarker[1]) {
        document.getElementById('number1').value = permanentMarker[1].getLatLng().lat ? permanentMarker[1].getLatLng().lat : 0;
        document.getElementById('number2').value = permanentMarker[1].getLatLng().lng ? permanentMarker[1].getLatLng().lng : 0;
    } else {
        document.getElementById('number1').value = 0;
        document.getElementById('number2').value = 0;
    }

    if (permanentMarker[2]) {
        document.getElementById('number3').value = permanentMarker[2].getLatLng().lat ? permanentMarker[2].getLatLng().lat : 0;
        document.getElementById('number4').value = permanentMarker[2].getLatLng().lng ? permanentMarker[2].getLatLng().lng : 0;
    } else {
        document.getElementById('number3').value = 0;
        document.getElementById('number4').value = 0;
    }

    if (permanentMarker[3]) {
        document.getElementById('number5').value = permanentMarker[3].getLatLng().lat ? permanentMarker[3].getLatLng().lat : 0;
        document.getElementById('number6').value = permanentMarker[3].getLatLng().lng ? permanentMarker[3].getLatLng().lng : 0;
    } else {
        document.getElementById('number5').value = 0;
        document.getElementById('number6').value = 0;
    }

    if (permanentMarker[4]) {
        document.getElementById('number7').value = permanentMarker[4].getLatLng().lat ? permanentMarker[4].getLatLng().lat : 0;
        document.getElementById('number8').value = permanentMarker[4].getLatLng().lng ? permanentMarker[4].getLatLng().lng : 0;
    } else {
        document.getElementById('number7').value = 0;
        document.getElementById('number8').value = 0;
    }
     val = [document.getElementById('number1').value, document.getElementById('number2').value,document.getElementById('number3').value,document.getElementById('number4').value,document.getElementById('number5').value,document.getElementById('number6').value,document.getElementById('number7').value,document.getElementById('number8').value]
}
function showsomething()
{
    for(let i=0; i<7; i++)
    {
        console.log('lat' + i +': ' + val[i++] + ' long' + i + ': ' + val[i]);
    }
}
////////////////////////////////////////////////////////////////////////////