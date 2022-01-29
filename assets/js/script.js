const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

      sidebar.classList.toggle("close");
toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

setInterval(function(){ 
    //this code runs every second 

    if (window.matchMedia("(min-width: 1635px)").matches) {
        sidebar.classList.remove("close");
    } else {
        sidebar.classList.add("close");
    }
  })
, 1000;

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark");
    
    
    
    
    if(body.classList.contains("dark")){
        modeText.innerText = "Licht";
        document.cookie = "isDark=true";
    }else{
        modeText.innerText = "Donker";
        document.cookie = "isDark=false";
        
    }
});

