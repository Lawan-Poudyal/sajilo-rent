let jsondata;
const email = document.querySelector(".email");

const displayTheDatas = (json) => {
    jsondata = json;
    const owner = document.querySelector(".owner");
    const monthlyRent = document.querySelector(".monthlyRent");
    const availableRoom = document.querySelector(".availableRoom");
    const electricity = document.querySelector(".electricity");
    const sunlight = document.querySelector(".sunlight");
    const balcony = document.querySelector(".balcony");
    const wifiPrice = document.querySelector(".wifiPrice");
    const roommates = document.querySelector(".roommates");
    const floorLevel = document.querySelector(".floorLevel");
    const houseFacingDirection = document.querySelector(".houseFacingDirection");
    const mainImage = document.querySelector(".mainimage");
    const topImage = document.querySelector(".topimage");
    const bottomImage = document.querySelector(".bottomimage");
    const gatesOpenAt = document.querySelector(".gatesOpenAt");
    const gatesCloseAt = document.querySelector(".gatesCloseAt");
    const parking = document.querySelector(".parking");

    if (owner) owner.textContent = json.username || "Unknown Owner";
    if (monthlyRent) monthlyRent.textContent = json.price || "N/A";
    if (availableRoom) availableRoom.textContent = json.no_of_rooms || "N/A";
    if(electricity) electricity.textContent = json.electricity || "N/A";
    if(sunlight) sunlight.textContent = json.sunlight || "N/A";
    if(balcony) balcony.textContent = json.balcony || "N/A";
    if(wifiPrice) wifiPrice.textContent = json.wifi_price || "N/A";
    if(roommates) roommates.textContent = json.no_of_roommates || "N/A";
    if(floorLevel) floorLevel.textContent = json.floor_level || "N/A";
    if(houseFacingDirection) houseFacingDirection.textContent = json.house_facing_direction || "N/A";
    // if(mainImage) mainImage.src = json.image1 || "N/A";
    if(topImage) topImage.src = json.image2 || "N/A";
    if(bottomImage) bottomImage.src = json.image3 || "N/A";
    if(gatesOpenAt) gatesOpenAt.textContent = json.gates_open|| "N/A";
    if(gatesCloseAt) gatesCloseAt.textContent = json.gates_close || "N/A";
    if(parking) parking.textContent = json.parking || "N/A";
};
const rent = document.querySelector('.rent');

rent.addEventListener('click',()=>{
    fetch('/sajilo-rent/studentsection/backend/bookForRent.php',{
        method: 'POST',
        headers: {
            "Content-Type" : "appplication/json",
        },
        body: JSON.stringify({
            lat: jsondata.latitude,
            lng: jsondata.longitude,
            student: email.textContent,
            owner: jsondata.username
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => {
        alert('Error: ', error);
    })
})

document.addEventListener('DOMContentLoaded', (event) => {
    const profile = document.querySelector('.profile');
    const userInformation = document.querySelector(".userInformation");

    profile.addEventListener('click', () => {
        userInformation.classList.toggle('show');
        console.log("hi")
    });

    window.addEventListener('click', (e) => {
        if (!e.target.closest('.userInformation')) {
            userInformation.classList.remove('show');
        }
    });
});