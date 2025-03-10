const changeProfileBtn = document.querySelector('.js-change-profile-icon');
const imageInput = document.querySelector('.js-image-input');
const profileForm = document.querySelector('.js-profile-form');
const fileDir = '/sajilo-rent/user-panel/back_end/';
const profileImage = document.querySelector('.profile-image');
const currentHouses = document.querySelector('.js-current-houses');
const notRentedTag = document.querySelector('.js-not-rented-tag');
const crossIcon = document.getElementById("js-cross-icon");
const formDiv = document.querySelector("#js-form-div");
const email = document.querySelector(".js-email").innerText;
const price = document.querySelector('.js-price');
const rooms = document.querySelector('.js-rooms');
const noOfRoommates = document.querySelector('.js-no-of-roommates');
const gatesOpen = document.querySelector('.js-gates-open');
const gatesClose = document.querySelector('.js-gates-close');
const parkingAvailable = document.querySelector('.js-parking-available'); //.checked = true;
const parkingUnavailable = document.querySelector('.js-parking-unavailable');
const floorLevel = document.querySelector('.js-floor-level');
const houseFacingDirection = document.querySelector('.js-house-facing-direction');
const wifi = document.querySelector('.js-wifi');
const electricityRequired = document.querySelector('.js-electricity-required');
const electricityNotrequired = document.querySelector('.js-electricity-notrequired');
const image1 = document.querySelector('.image1');
const image2 = document.querySelector('.image2');
const image3 = document.querySelector('.image3');
const latitude = document.querySelector('#js-lat');
const longitude = document.querySelector('#js-lng');
const mainComment = document.querySelector('.js-main-comment');
const ratingImage = document.querySelector('.js-rating-image');
let avgRating = 0;
var imageLocation = '';
console.log(profileImage)
document.addEventListener('DOMContentLoaded', async () => {
    try {
        let response = await Promise.all([
            fetch('/sajilo-rent/user-panel/back_end/setprofilepic.php'),
            fetch('/sajilo-rent/user-panel/back_end/showallhouses.php'),
            fetch(`/sajilo-rent/user-panel/back_end/loadcomment.php`)
        ]);
        let data = await Promise.all([response[0].json(), response[1].json(), response[2].json()]);
        // console.log(data);
        changeProfile(fileDir + data[0]['image']); //fine as hell.
        addHouseDetails(data[1]);
        loadReview(data[2]);
    } catch (err) {
        console.log(err);
    }
});

changeProfileBtn.addEventListener('click', () => {
    imageInput.click();
});

imageInput.addEventListener('change', async () => {
    const file = imageInput.files[0];
    profileForm.submit();
});

function changeProfile(filePath) {
    if (filePath === 'false') return;
    console.log(filePath)
    profileImage.style.backgroundImage = `url(${filePath})`;

}

function addHouseDetails(houses) {
    houses.forEach(house => {
        if (house['error']) return;
        notRentedTag.classList.add('hide');
        // console.log(house);
        let location = '/sajilo-rent/user-panel/back_end/' + house['image1'];
        currentHouses.innerHTML += `
            <div class="house-card">
                <img src='${location}' alt="Your house here" class="living-house-image js-house-image" >
                <div class="house-information">
                    <div class="residence-details">
                        <p class="house-price">$${house['price']}</p>
                    </div>
                    <div class="house-status">
                        <button class="update-house js-update-house" data-lat='${house['latitude']}' data-lng='${house['longitude']}'>Update Info</button>
                    </div>
                </div>
            </div>`;
    });
    updateButtonEvents();
}

function updateButtonEvents() {
    const updateHouse = document.querySelectorAll('.js-update-house');
    updateHouse.forEach(button => {
        button.addEventListener('click', () => {
            // console.log(button);
            showHouseDetail(button.dataset);
        });
    });
}

async function showHouseDetail(dataset) {
    // console.log(dataset.lat);
    // console.log(dataset.lng);
    // console.log(email);
    const response = await fetch(`/sajilo-rent/user-panel/back_end/showhousedetails.php?lat=${dataset.lat}&lng=${dataset.lng}&username=${email}`);
    const data = await response.json();
    showForm(data);
}

function showForm(data) {
    formDiv.showModal();
    if (data['electricity'] === 'required') {
        electricityRequired.checked = true;
    } else {
        electricityNotrequired.checked = true;
    }
    floorLevel.value = data['floor_level'];
    houseFacingDirection.value = data['house_facing_direction'];
    noOfRoommates.value = data['no_of_roommates'];
    rooms.value = data['no_of_rooms'];
    if (data['parking'] === 'available') {
        parkingAvailable.checked = true;
    } else {
        parkingUnavailable.checked = true;
    }
    price.value = data['price'];
    wifi.value = data['wifi_price'];
    gatesClose.value = data['gates_close'];
    gatesOpen.value = data['gates_open'];
    image1.style.backgroundImage = `url(/sajilo-rent/user-panel/back_end/${data['image1']})`;
    image2.style.backgroundImage = `url(/sajilo-rent/user-panel/back_end/${data['image2']})`;
    image3.style.backgroundImage = `url(/sajilo-rent/user-panel/back_end/${data['image3']})`;
    image1.style.backgroundSize = 'cover';
    image3.style.backgroundSize = 'cover';
    image2.style.backgroundSize = 'cover';
    latitude.value = data['latitude'];
    longitude.value = data['longitude'];
}

crossIcon.addEventListener("click", function() {
    formDiv.close();
});

function loadReview(data) {
    let count = 0;
    if (data['err']) return;
    data.forEach(element => {
        avgRating += element['rating'];
        count++;
        mainComment.innerHTML += `
            <div class='comment-card'>
                <div class="reviewer-info-wrapper">
                    <div class="reviewer-info">
                        <p class="reviewer-name">${element["username"]}</p>
                        <p class="review-date">${element["date"]}</p>
                    </div>
                    <img class="reviewer-rating-image" src="/sajilo-rent/resources/ratings/rating-${element["rating"] * 10}.png" alt="reviewer star rating image">
                </div>
                <div class="review-comment">
                    ${element["comment"]}
                </div>
            </div>`;
    });
    avgRating /= count;
    // console.log((avgRating));
    ratingImage.src = `/sajilo-rent/resources/ratings/rating-${(adjustRating(avgRating)) * 10}.png`;
}

function adjustRating(avgRating) {
    let tempRating = avgRating;
    let floatingValue = avgRating - Math.floor(avgRating);
    if(tempRating !== 0)
    {

    if (floatingValue > 0.5) {
        return (Math.floor(avgRating) + 1);
    } else {
        return (Math.floor(avgRating) + 0.5);
    }
}
else {
    return 0;
}
}

