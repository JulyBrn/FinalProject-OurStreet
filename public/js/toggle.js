const btn = document.getElementById("btn-comment");
const formComment = document.getElementsByClassName("pushComment"); 

let isVisible = false;
console.log(isVisible);

btn.addEventListener('click',() => {
    isVisible = !isVisible;
    isVisible ? formComment[0].classList.add('is-visible') : formComment[0].classList.remove('is-visible') 
});
