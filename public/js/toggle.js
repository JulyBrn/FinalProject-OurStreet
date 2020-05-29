const btn = document.getElementById("btn-comment");
const formComment = document.getElementsByClassName("pushComment"); 

let isVisible = false;

btn.addEventListener('click',() => {
    isVisible = !isVisible;
    if (isVisible){
        formComment[0].classList.remove('slideUp');
        formComment[0].classList.add('is-visible');
        formComment[0].classList.add('slideDown');
        setTimeout(()=>{
            formComment[0].classList.remove('slideDown');
        }, 1000);
        btn.textContent = "Cacher";
    } else{
        formComment[0].classList.add('slideUp');
        setTimeout(()=>{
            formComment[0].classList.remove('is-visible');
        }, 1000);
        btn.textContent = "Commenter";
    }
});
