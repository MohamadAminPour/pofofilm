let dashboardSidebar = document.querySelector(".dashboard-sidebar");
let toggleSidebar = document.querySelector(".bx-menu");
let accordionItem = document.querySelector(".accordion-item");
let accordionBtns = document.querySelectorAll(".accordion-button");
let bgl = document.querySelector(".bgl");

if (window.innerWidth < 800) {
  dashboardSidebar.classList.remove("active");
}

toggleSidebar.addEventListener("click", () => {
  dashboardSidebar.classList.toggle("active");
  if (dashboardSidebar.className != "active") {
    bgl.classList.add("active");
  }
  if(window.innerWidth > 800){
    bgl.classList.remove("active");
  }
});

bgl.addEventListener("click", () => {
  dashboardSidebar.classList.remove("active");
  bgl.classList.remove("active");
});



//notif
let notifsIcon =document.querySelector('.notifs-icon')
let notifList =document.querySelector('.notifList')

notifsIcon.addEventListener('click',()=>{
  notifList.classList.toggle('active')
})



