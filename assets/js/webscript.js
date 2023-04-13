const menuBar = document.querySelector(".menu-bar")
menuBar.addEventListener("click",function(){
    menuBar.classList.toggle("active")
    document.querySelector(".menu-items").classList.toggle("active")
})
const toP = document.querySelector(".top")
window.addEventListener("scroll",function(){
    const x =window.scrollTop |window.scrollY;
    console.log(x);
    if(x>500){toP.classList.add("sticky")}
    else {toP.classList.remove("sticky")}
})

var menuTitle = document.querySelectorAll(".menu-title .menu-button");
var menuShows = document.querySelectorAll('.menu-content');
console.log(menuTitle,menuShows);




const showMENU = (menu) =>{
    const menuShows1 = document.querySelector('.menu-content.active');
    if(menuShows1) 
        menuShows1.classList.remove('active');

    const menu1 = menu.getAttribute("data-title");

    menuShows.forEach((show)=>{
        if(show.id === menu1)
        show.classList.add('active')
    })
}
    menuShows[0].classList.add('active');
    menuTitle.forEach((menu)=> {
        menu.addEventListener('click',()=>{
            
            const activeClass = document.querySelector('.menu-button.active');
            if(activeClass)
                activeClass.classList.remove('active');
            menu.classList.add('active')
           showMENU(menu)
        }  
        )
    })



