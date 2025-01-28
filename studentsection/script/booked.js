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
        
        fetch('./backend/addReviewHouse.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Changed from response.text
        .then(data => {
            // Handle the response
            if (data.status === 'success') {
                alert('Review submitted successfully!');
                modal.close(); // Close the modal after successful submission
                form.reset(); // Reset the form
                leave(); // leave the house
            } else {
                alert('Failed to submit review: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the review');
        });
    });
}
function callBooked() {
        fetch('./backend/booked.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Invalid');
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
