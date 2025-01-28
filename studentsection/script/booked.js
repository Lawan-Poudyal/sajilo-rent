let leaveHouse;
let Json;
let modal;
let submitButton;
let reviewForm;

document.addEventListener("DOMContentLoaded", () => {
    leaveHouse = document.querySelector(".leaveButton");
    modal = document.querySelector(".review-container");
    submitButton = document.querySelector(".submit-button");
    reviewForm = document.querySelector(".review-form");
    
    if (leaveHouse) {
        leaveHouse.addEventListener('click', () => {
            modal.showModal();
        });
    }
    
    if (reviewForm) {
        processForm(reviewForm);
    }
    
    callBooked(); // Make sure this function is defined somewhere
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

    const request1 = new Request(url1, {
        method: 'POST',
        body: formData
    });

    const request2 = new Request(url2, {
        method: 'POST',
        body: formData
    });

    try {
        // Await both fetch requests in parallel
        const response = await Promise.all([fetch(request1), fetch(request2)]);

        // Await the JSON parsing of both responses
        const [data1, data2] = await Promise.all([response[0].json(), response[1].json()]);

        // Log the parsed JSON data
        console.log(data1, data2);

        // Check the status of both responses
        if (data1.status === 'success' && data2.status === 'success') {
            alert("Successful review submission");
            leave();
            modal.close();
        } else {
            // Handle the case where one or both requests failed
            alert("Failed to submit review");
        }
    } catch (error) {
        // Handle any errors that occurred during the fetch or JSON parsing
        console.error("Error:", error);
        alert("An error occurred while submitting the review");
    }
}