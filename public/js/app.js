var slideIndex,slides,captionText;
function initGallery() {
    slideIndex=0;
    slides=document.getElementsByClassName("imageHolder");
    slides[slideIndex].style.opacity=1;

    captionText=document.querySelector(".captionHolder .captionText");
    captionText.innerText=slides[slideIndex].querySelector(".captionText").innerText;

   link=document.querySelector('.captionLink');
}
initGallery();
function plusSlides(n) {
    moveSlide(slideIndex+n);
}

function moveSlide(n) {
    var i,current,next;
    var moveSlideAnimClass = {
        forCurrent: "",
        forNext: ""
    };
    let slideTextAnimClass; 
    if (n > slideIndex) {
        if (n>=slides.length) {n=0;}
        moveSlideAnimClass.forCurrent = "moveLeftCurrentSlide";
        moveSlideAnimClass.forNext = "moveLeftNextSlide";
        slideTextAnimClass="zoomIn";
    } else if(n<slideIndex) {
        if(n<0){n=slides.length-1;}
        moveSlideAnimClass.forCurrent = "moveRightCurrentSlide";
        moveSlideAnimClass.forNext = "moveRightNextSlide";
        slideTextAnimClass="zoomIn";

    }
    if(n!=slideIndex) {
        next=slides[n];
        current=slides[slideIndex];
        for (i=0; i<slides.length;i++){
            slides[i].className="imageHolder";
            slides[i].style.opacity=0;
        }
        current.classList.add(moveSlideAnimClass.forCurrent);
        next.classList.add(moveSlideAnimClass.forNext);
        slideIndex=n;
        captionText.style.display="none";
        captionText.className="captionText "+slideTextAnimClass;
        captionText.innerText=slides[n].querySelector(".captionText").innerText;
        captionText.style.display="block";
       link.href=slides[n].querySelector(".captionLink").href;
        
    }
}

    var timer=null;
    function setTimer() {
        timer=setInterval(function() {
            plusSlides(1);
        }, 4500)
    }
    setTimer();
    function playPauseSlides() {
        var playPauseBtn=document.getElementById("playPause");
        if(timer==null){
            setTimer();
            playPauseBtn.style.backgroundPositionY="0px"
        }else{
            clearInterval(timer);
            timer=null;
            playPauseBtn.style.backgroundPositionY="-33px"
        }
    }
