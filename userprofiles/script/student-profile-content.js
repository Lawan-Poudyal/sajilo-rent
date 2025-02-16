const housePrice = document.querySelector(".house-price");
const Owner = document.querySelector(".owner-name");
const picture = document.querySelector(".living-house-image");
const houseCard = document.querySelector(".house-card");
const notResiding = document.querySelector(".not-residing");
const mainComment = document.querySelector(".main-comment");
const ratingNumber = document.querySelector(".rating-number")
const reviewerCount = document.querySelector(".reviewer-count");
const ratingImage = document.querySelector(".rating-image");
const imgBlock = document.querySelector('.js-house-image');
const profileimage = document.querySelector('.profile-image')

const PATHS = {
    house: '/sajilo-rent/user-panel/back_end/',
    student: '/sajilo-rent/studentsection/backend/',
    defaultProfile: '../resources/profile-related/default-profile.png'
};
document.addEventListener('DOMContentLoaded', () => {
    notResiding.classList.add("hide");

    (async function(){
        try {
            const response = await Promise.all([fetch("./backend/load-profile.php"), fetch("./backend/load-reviews.php")]);

            const [jsonDataProfile, jsonDataReview] = await Promise.all([response[0].json(), response[1].json()]);
            console.log(jsonDataProfile,jsonDataReview);
            putHouseContent(jsonDataProfile);
            putReviewContent(jsonDataReview)
                
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    })();
});

function putHouseContent(jsonDataProfile) {
    if(!jsonDataProfile["status"]){

        housePrice.innerText = `Price : ${jsonDataProfile["price"]}`;
        Owner.innerText = `Owner : ${jsonDataProfile["username"]}`;  // Fixed here
        imgBlock.src = imagePathHouse + jsonDataProfile['image1'];
        console.log(jsonDataProfile["image"]);
        // if (jsonDataProfile["image"] && jsonDataProfile["image"] !== "null") { 
      
        //     // profileimage.src = imagePathStudent + jsonDataProfile["image"];
        // } else {
        //     profileimage.src = "../resources/profile-related/default-profile.png";
        // }
        
        
    }   
    else{
        houseCard.classList.add('hide');
        notResiding.classList.remove('hide')
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
                        <img class="reviewer-rating-image" src = "../resources/ratings/rating-${element["rating"] * 10}.png" alt="reviewer star rating image" >
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
