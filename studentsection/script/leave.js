let leaveHouse;
let Json;
let modal;
let submitButton;
let reviewForm;
let starOwner,starHouse;
let starSymb = "⭐";
let ratingHouse,ratingOwner;

document.addEventListener("DOMContentLoaded", () => {
    leaveHouse = document.querySelector(".leaveButton");
    modal = document.querySelector(".review-container");
    submitButton = document.querySelector(".submit-button");
    reviewForm = document.querySelector(".review-form");
    starOwner = document.querySelectorAll('.js-star-owner');
    starHouse = document.querySelectorAll('.js-star-house');

    if (leaveHouse) {
        leaveHouse.addEventListener('click', () => {
            modal.showModal();
            addRatingOwner();
            addRatingHouse();
        });
    }
    
    if (reviewForm) {
        processForm(reviewForm);
    }
    
    callBooked();
});

function processForm(form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        addReview(formData);

    });
}
function callBooked() {
        fetch('./backend/booked.php')
        .then(response => {
            if (!response.ok) {
                throw new Erroror('Invalid');
            }
            return response.json();
        })
        .then(json => {
                if(json.status != 'error'){
                    Json = json;
                    leaveHouse.classList.add('show');
                }    
        })
        .catch(console.warn);
}
const leave = ()=>{
    leaveHouse.classList.remove('show');
        fetch("./backend/leave.php", {
            method: 'POST',
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify({
                latitude: Json.latitude,
                longitude: Json.longitude
            })
        })
        .then(response => response.text())
        .then(data => {
            if (data.status == 'success') {
                console.log('Successfully left the house');
            } 
        })
        .catch(error => console.error('Error:', error));
};
async function addReview(formData) {
    const url1 = 'backend/addReviewHouse.php';
    const url2 = 'backend/addReview.php';

    formData.append("houserating", ratingHouse);
    formData.append("ownerrating", ratingOwner);
    console.log(formData)
    const request1 = new Request(url1, {
        method: 'POST',
        body: formData
    });

    const request2 = new Request(url2, {
        method: 'POST',
        body: formData
    });

    try {
        const response = await Promise.all([fetch(request1), fetch(request2)]);

        const [data1, data2] = await Promise.all([response[0].json(), response[1].json()]);

        console.log(data1, data2);

        if (data1.status === 'success' && data2.status === 'success') {
            alert("Successful review submission");
            // leave();
            modal.close();
        } else {
            alert("Failed to submit review");
        }
    } catch (error) {
        console.error("Error:", error);
        alert("An error occurred while submitting the review");
    }
}
function addRatingOwner(){
if(starOwner){
    starOwner.forEach((rate,index)=>{
        rate.addEventListener('click' , (event)=>{
          
            var rated = rate;
            rate.innerText = starSymb;
            ratingOwner = rate.dataset.value;
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
            console.log(ratingOwner); 
    })
    })
};}
function addRatingHouse(){
    if(starHouse){
        starHouse.forEach((rate,index)=>{
            rate.addEventListener('click' , (event)=>{
              
                var rated = rate;
                rate.innerText = starSymb;
                ratingHouse = rate.dataset.value;
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
                console.log(ratingHouse); 
        })
        })
    };
}