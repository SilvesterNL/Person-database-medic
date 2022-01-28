const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text"),
      kaas1 = body.querySelector(".kaas1");

      sidebar.classList.toggle("close");
toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark"),
    kaas1.classList.toggle("lead");
    
    if(body.classList.contains("dark")){
        modeText.innerText = "Licht";
    }else{
        modeText.innerText = "Donker";
        
    }
});