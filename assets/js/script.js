
const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector('.toggle'),
      searchBtn = body.querySelector(".search-box"),
      darkmode = body.querySelector(".darkmode"),
      lightmode = body.querySelector(".lightmode"),
      modeText = body.querySelector(".mode-text");







window.addEventListener('load', (event) => {
    if (window.matchMedia("(min-width: 1635px)").matches) {
        sidebar.classList.remove("close");
    } else {
        sidebar.classList.add("close");
    }
  });


  window.addEventListener('resize', function(event) {
    if (window.matchMedia("(min-width: 1635px)").matches) {
        sidebar.classList.remove("close");
    } else {
        sidebar.classList.add("close");
    }
}, true);


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

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



