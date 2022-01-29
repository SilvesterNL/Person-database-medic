const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

window.addEventListener("resize", function() {
    if (window.matchMedia("(min-width: 1635px)").matches) {
        sidebar.classList.remove("close");
    } else {
        sidebar.classList.add("close");
    }
  })

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

