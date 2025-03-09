const Owner = document.querySelector(".owner-name");
const picture = document.querySelector(".living-house-image");
const houseCard = document.querySelector(".house-card");
const notResiding = document.querySelector(".not-residing");
const mainComment = document.querySelector(".main-comment");
const ratingNumber = document.querySelector(".rating-number")
const reviewerCount = document.querySelector(".reviewer-count");
const ratingImage = document.querySelector(".rating-image");
const imgBlock = document.querySelector('.js-house-image');
const profileImage = document.querySelector('.profile-image')
const changeProfile = document.querySelector('.change-profile-icon');
const imageInput = document.querySelector('#imageInput'); 
const PATHS = {
    house: '/sajilo-rent/user-panel/back_end/',
    student: '/sajilo-rent/studentsection/backend/',
    defaultProfile: '/sajilo-rent/resources/profile-related/default-profile.png'
};
document.addEventListener('DOMContentLoaded', () => {
    notResiding.classList.add("hide");

    (async function(){
        try {
            const response = await Promise.all([fetch("/sajilo-rent/studentsection/backend/load-profile.php"), fetch("/sajilo-rent/studentsection/backend/load-reviews.php")]);

            const [jsonDataProfile, jsonDataReview] = await Promise.all([response[0].json(), response[1].json()]);
            putHouseContent(jsonDataProfile[0]);
            putReviewContent(jsonDataReview)
                
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    })();
});

function putHouseContent(jsonDataProfile) {
    console.log(jsonDataProfile)
    if(!jsonDataProfile["status"]){
        profileImage.style.backgroundImage = `url('${PATHS.student}${jsonDataProfile["profile_image"]}')`;
        if(!jsonDataProfile['owner']) {
                houseCard.classList.add('hide');
                notResiding.classList.remove('hide')
                return;
        }
        Owner.innerText = `Owner : ${jsonDataProfile["owner"]}`;  
        imgBlock.src = PATHS.house + jsonDataProfile['image1'];

    }   
 
}   
function putReviewContent(jsonDataReview){
    if(!jsonDataReview["status"]){
        let totalRating = 0;
       
        reviewerCount.innerText = `${jsonDataReview.length} Reviewers`;
        jsonDataReview.forEach(element => {
            const reviewWrapper = document.createElement('div');
            reviewWrapper.classList.add("reviews-wrapper");
            reviewWrapper.innerHTML = `
                    <div class="reviewer-info-wrapper">
                        <div class="reviewer-info">
                            <p class="reviewer-name">${element["reviewer"]}</p>
                            <p class="review-date">${element["date"]}</p>
                        </div>
                        <img class="reviewer-rating-image" src = "/sajilo-rent/resources/ratings/rating-${element["rating"] * 10}.png" alt="reviewer star rating image" >
                    </div>
                    <div class="review-comment">
                        ${element["comment"]}
                    </div>
                `
            totalRating += `${element["rating"]}`
            mainComment.appendChild(reviewWrapper);    
        }
    );
    const Rating = adjustAverage(totalRating,jsonDataReview.length)
    ratingNumber.innerText = Rating;  
    ratingImage.innerHTML =`<img src="/sajilo-rent/resources/ratings/rating-${Rating * 10}.png" alt="">`;

    }
}
function adjustAverage(ratings, total) {
    let count = ratings.length;
    let average = total / count;

    if (Number.isInteger(average) || Number.isInteger((total * 2) / count)) {
        return total;  // Already valid
    }

    // Adjust total to the nearest integer or .5
    let remainder = total % count;
    if (remainder >= count / 2) {
        total += (count - remainder);
    } else {
        total -= remainder;
    }

    return total;
}


//change or add profile pictures

changeProfile.addEventListener('click', (event) => {
    imageInput.click();
});

imageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        setProfilePic(file);
    }
});

async function setProfilePic(file) {
    try {
        const formData = new FormData();
        formData.append('image', file); // Changed from 'profile_image' to 'image' to match PHP

        const response = await fetch('/sajilo-rent/studentsection/backend/addprofilepic.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Preview the image
        const reader = new FileReader();
        reader.onload = () => {
            const imageUrl = reader.result;
            profileImage.style.backgroundImage = `url(${imageUrl})`;
        };
        reader.readAsDataURL(file);

    } catch (error) {
        console.error('Error uploading profile picture:', error);
    }
}
