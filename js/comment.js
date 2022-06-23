const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const currentUserIdComment = localStorage.getItem("user_id");
const base_urlComment = document.body.dataset.baseurl;
const author_id = document.body.dataset.authorid;
const commentsDiv = document.getElementById("comments");
const textarea = document.getElementById("comment-text");
const addComment = document.getElementById("add-comment");
const starRating = document.getElementById("star-rating");

function getComments() {
    axios.get(base_urlComment + "/api/comment/list?id=" + id).then(res => {
        showComments(res.data);
    })
}

function showComments(comments) {
    let commentsHTML = `<h2>Отзывов: ${comments.length}</h2>`;


    for (let i = 0; i < comments.length; i++) {
        let deleteButton = '';
        if (currentUserIdComment == comments[i].user_id) {
            deleteButton = `<span onclick='removeComment(${comments[i].id})' class="deleteButton"> Удалить </span>`;
        }
        let stars = '<span class="rating">';
        for(let j = 0; j < 5; j++) {
            if(j < comments[i].stars) {
                stars += '<img src="img/good-info/star.png" style="filter:invert(67%) sepia(67%) saturate(631%) hue-rotate(360deg) brightness(103%) contrast(97%);">';
            }
            else {
                stars += '<img src="img/good-info/star.png">';
            }
        }
        stars += '</span>';

        commentsHTML += `
        <div class="commentary" id="comment-${comments[i].id}">
            <div class="user-avatar">
                <img src="img/header/user-in.jpg" alt="">              
            </div>
            <div>
                <h4>
                    ${comments[i].name}
                </h4>
                <div>
                    ${stars}
                    <span class="date">
                        ${comments[i].date}
                    </span>
                    ${deleteButton}
                </div>
                <p>
                    ${comments[i].text}
                </p>
            </div>
        </div>`;
    }

    commentsDiv.innerHTML = commentsHTML;

}

getComments();




addComment.onclick = function() {
    let rating = 1;

    for(let i = 0; i < starRating.childElementCount; i++)
    {
        if(starRating.children[i].checked == true) {
            rating = starRating.children[i].value;
            console.log(rating);
        }
    }

    axios.post(base_urlComment + "/api/comment/add", {
        rating: rating,
        text: textarea.value,
        good_id: id
    }).then(res => {
        getComments();
        //console.log("ok");
        textarea.value = "";
    })
}


function removeComment(commentId) {
    axios.delete(base_urlComment + "/api/comment/delete?id=" + commentId).then(res => {
        // document.getElementById("comment-" + commentId).remove();
        getComments();
        console.log("ok2");
    })
}