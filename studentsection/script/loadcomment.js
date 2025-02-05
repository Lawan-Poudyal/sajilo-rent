const commentContainer = document.querySelector('.comments');
(async function (){
    const response = await fetch('/sajilo-rent/studentsection/backend/loadComment.php');
    const json = await response.json();
    loadComments(json);
}());

function loadComments(json){
    commentContainer.innerHTML =
        `<div class="comment">
            <div class="main-section-div-div commentinfo"><span class="commenter">${json['firstName']} ${json['lastName']} </span>  posted on <span class="commentdate">${json['date']}</span></div>
            <div class="main-section-div-div commentdata">${json['comment']}</div>
        </div>`
}   
