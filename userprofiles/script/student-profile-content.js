const housePrice = document.querySelector(".house-price");
const Owner = document.querySelector(".owner-name");
const picture = document.querySelector(".living-house-image");
const houseCard = document.querySelector(".house-card");
const mainComment = document.querySelector(".main-comment");
const ratingNumber = document.querySelector(".rating-number")
const reviewerCount = document.querySelector(".reviewer-count");
const ratingImage = document.querySelector(".rating-image");
const imgBlock = document.querySelector('.js-house-image');
const profileImage = document.querySelector('.profile-image')
const userName = document.querySelector('.user-name');

const url = new URL(window.location);
const email =url.searchParams.get("email");
const PATHS = {
    house: '/sajilo-rent/user-panel/back_end/',
    student: '/sajilo-rent/studentsection/backend/',
};
document.addEventListener('DOMContentLoaded', () => {

    (async function(){
        try {
            const requestProfile = new Request("/sajilo-rent/userprofiles/backend/load-profile-student.php",{
                method: 'POST',
                body: JSON.stringify({ email: email})
            });
            const requestReview = new Request("/sajilo-rent/userprofiles/backend/load-reviews-student.php",{
                method: "POST",
                body: JSON.stringify({email: email})
            })
            const response = await Promise.all([fetch(requestProfile), fetch(requestReview)]);
            const [jsonDataProfile, jsonDataReview] = await Promise.all([response[0].json(), response[1].json()]);
            console.log(jsonDataProfile,jsonDataReview);
            putHouseContent(jsonDataProfile);
            putProfileContents(jsonDataProfile);
            putReviewContent(jsonDataReview);
            
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    })();
});
function putProfileContents(jsonDataProfile){
    profileImage.style.backgroundImage = `url("/sajilo-rent/studentsection/backend/${jsonDataProfile.profile_image}")`;
    userName.textContent = jsonDataProfile.firstName + " " +  jsonDataProfile.lastName;
}
const currentResidence = document.querySelector('.js-current-residence');
function putHouseContent(jsonDataProfile) {
    if(!jsonDataProfile["status"]){
        if(!jsonDataProfile['owner'])
        {
            currentResidence.style.display = 'grid';
            currentResidence.style.placeContent = 'center';
            currentResidence.innerHTML = '<h1 style="color:gray">Not living anywhere</h1>'
            return;
        }
        housePrice.innerText = `Price : ${jsonDataProfile["price"]}`;
        Owner.innerText = `Owner : ${jsonDataProfile["owner"]}`;  // Fixed here
        imgBlock.src = PATHS.house + jsonDataProfile['house_image'];
        console.log(imgBlock.src);
      
        
    }   
}   
function putReviewContent(jsonDataReview) {
    if(!jsonDataReview["status"]) {
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
                        <img class="reviewer-rating-image" src="/sajilo-rent/resources/ratings/rating-${element["rating"] * 10}.png" alt="reviewer star rating image">
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
        ratingImage.innerHTML = `<img src="/sajilo-rent/resources/ratings/rating-${Rating * 10}.png" alt="">`;
    }else{
        const ratingComment = document.querySelector('.rating-comment');
        ratingComment.textContent = "";
        ratingComment.textContent = "No any reviews for the user";
        ratingComment.classList.add('empty-reviews');        
        return;
    }
}

function adjustAverage(totalRating, count) {
    if (count === 0) return 0;
    
    let average = totalRating / count;
    // Round to nearest 0.5
    return Math.round(average * 2) / 2;
}