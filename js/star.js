const starRatingBlock = document.getElementById("star-rating");

function checkStars()
{
    for(let i = 0; i < starRatingBlock.childElementCount; i++)
    {
        if(starRatingBlock.children[i].checked == true) {
            //console.log("some checked ", i);
            for(let j = 0; j < starRatingBlock.childElementCount; j++) {
                //console.log(starRatingBlock.children[j].tagName);
                if(starRatingBlock.children[j].tagName == "LABEL" && j < i) {
                    //console.log('color');
                    starRatingBlock.children[j].style.filter = 'invert(67%) sepia(67%) saturate(631%) hue-rotate(360deg) brightness(103%) contrast(97%)';
                }
                else if(starRatingBlock.children[j].tagName == "LABEL" && j > i){
                    starRatingBlock.children[j].style.filter = '';
                }
            }
        }
        //console.log(i, starRatingBlock.children[i]);
        //console.log(i, starRatingBlock.children[i], starRatingBlock.children[i].tagName);
    }
}

starRatingBlock.addEventListener("click", checkStars);