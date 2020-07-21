function main(){
    var menuIconOpen = document.getElementsByClassName("open")[0];
    var menuIconClose = document.getElementsByClassName("close")[0];
    var menuItems = document.getElementsByClassName("navBar");
    var logo = document.getElementsByClassName("logo");

    
    menuIconClose.style.display = "none";

    console.log(logo);
    
    menuIconOpen.onclick = function() {
      this.style.display = "none";
      menuIconClose.style.display = "block";
      menuDisplay("show", menuItems);
    };
    
    menuIconClose.onclick = function() {
      this.style.display = "none";
      menuIconOpen.style.display = "block";
      menuDisplay("hide", menuItems);
    };
  }
  
  function menuDisplay(state, items){
    if(state=="show"){
      for(var i=1; i<items.length; i++){
        items[i].classList.add("show");
      }
    } else {
      for(var i=1; i<items.length; i++){
        items[i].classList.remove("show");
      }
    }
  }
  
  window.onload = function(){
    main();
  }
  