const userName = document.querySelector(".user-name");
const userStatus = document.querySelector(".user-status");
const ratingNumber = document.querySelector(".rating-number");
const reviewerCount = document.querySelector(".reviewer-count");
const housePosted = document.querySelector(".house-posted");
const profileImage = document.querySelector(".profile-image");
const mainComment = document.querySelector(".main-comment");
const ratingImage = document.querySelector(".rating-image");
(async () => {
    try {
        const responseProfile = await fetch("/sajilo-rent/userprofiles/backend/load-profile-owner.php");
        if (!responseProfile.ok) {
            throw new Error('Network response was not ok');
        }
        const jsonDataProfile = await responseProfile.json();
        console.log(jsonDataProfile)
        if(jsonDataProfile.status){
            document.querySelector(".section-wrapper").textContent = ""; 
            document.querySelector(".dialog-no-owner").showModal();
            document.querySelector('.close-button').addEventListener('click',()=>{
                document.querySelector(".dialog-no-owner").close();
                window.location = "/sajilo-rent/studentsection/displayLatLng.php";
            })
        }   
        else{   
            const responseReview = await fetch("/sajilo-rent/userprofiles/backend/load-reviews-owner.php", {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ username: jsonDataProfile.ownerHouseDetails[0].username })
        });

        if (!responseReview.ok) {
            throw new Error('Network response was not ok for reviews');
        }
        const jsonDataReview = await responseReview.json();

        console.log(jsonDataProfile);
        console.log(jsonDataReview);
        putProfileContent(jsonDataProfile);
        putHousePosts(jsonDataProfile);
        putReviewContent(jsonDataReview);}

    } catch (error) {
        console.error('Fetch error: ', error);
    }
})();

const putProfileContent = (json) => {
    userName.textContent = `${json.ownerName.firstName} ${json.ownerName.lastName}`;
    if (json.ownerProfile) {
        profileImage.src = "/sajilo-rent/user-panel/back_end/" + json.ownerProfile.image;
    }
}

const putHousePosts = (json) => {
    if(json.ownerHouseDetails.length == 0){
        document.querySelector('.section-recent').textContent = "";
        document.querySelector('.section-recent').textContent = "Owner Has Not Uploaded any houses";
        return;
    }
    json.ownerHouseDetails.forEach(element => {
        const houseCard = document.createElement('div');
        houseCard.classList.add('house-card');
        houseCard.innerHTML = `
            <img src="${"/sajilo-rent/user-panel/back_end/" + element.image1}" alt="House image" >
            <div class="house-information">
                <p class="house-price">Price: Rs. ${element.price}</p>
            </div>
        `;
        housePosted.appendChild(houseCard);
    });
}

const putReviewContent = (jsonDataReview) => {
    let totalRating = 0;
    if(jsonDataReview.status == "error"){
        const ratingComment = document.querySelector('.rating-comment');
        ratingComment.textContent = "";
        ratingComment.textContent = "No reviews";
        ratingComment.classList.add('empty-reviews');        
        return;

    }
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
                    <img class="reviewer-rating-image" src="../resources/ratings/rating-${element["rating"] * 10}.png" alt="reviewer star rating image">
                </div>
                <div class="review-comment">
                    ${element["comment"]}
                </div>
            `;
        totalRating += Number(element["rating"]);
        mainComment.appendChild(reviewWrapper);    
    });
    
    const Rating = adjustAverage(totalRating, jsonDataReview.length);
    ratingNumber.innerText = Rating;  
    ratingImage.src = `/sajilo-rent/resources/ratings/rating-${Rating * 10}.png` ;
}
function adjustAverage(totalRating, count) {
    if (count === 0) return 0;
    
    let average = totalRating / count;
    // Round to nearest 0.5
    return Math.round(average * 2) / 2;
}