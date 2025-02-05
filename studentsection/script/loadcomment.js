const commentContainer = document.querySelector('.comments');
const rating = document.querySelector('.rating');
(async function (){
    const response = await fetch('/sajilo-rent/studentsection/backend/loadComment.php');
    const json = await response.json();
    const reponseRating = await fetch('/sajilo-rent/studentsection/backend/loadratings.php');
    const jsonRating = await reponseRating.json();
    if(json.status != "error"){
            loadComments(json,jsonRating);
    }
}());

function loadComments(json,jsonRating){
    commentContainer.innerHTML =
        `<div class="comment">
            <div class="main-section-div-div commentinfo"><span class="commenter">${json['firstName']} ${json['lastName']} </span>  posted on <span class="commentdate">${json['date']}</span></div>
            <div class="main-section-div-div commentdata">${json['comment']}</div>
            </div>`
            
          rating.innerHTML = `<img src="/sajilo-rent/resources/ratings/rating-${jsonRating * 10}.png" alt="">`;; 
}