
const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      darkmode = body.querySelector(".darkmode"),
      lightmode = body.querySelector(".lightmode"),
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





if (sessionStorage['dark']) {
    body.classList.add("dark");
} else {
    sessionStorage.removeItem("dark");
    body.classList.remove("dark");
}


darkmode.addEventListener("click" , () =>{
    body.classList.add("dark");
    sessionStorage.setItem("dark","true");
}) 


lightmode.addEventListener("click" , () =>{
    body.classList.remove("dark");
    sessionStorage.removeItem("dark");

}) 



