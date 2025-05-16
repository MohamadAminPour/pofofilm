//sidebar
const sidebarData = [
  {
    id: 1,
    title: "داشبورد",
    icon: "bx bx-grid-alt",
    children: [{ id: 1, title: "داشبورد ادمین", src: "./index.html" }],
  },
  {
    id: 2,
    title: "اطلاعات شخصی",
    icon: "bx bx-user",
    children: [
      { id: 1, title: "نمایش اطلاعات", src: "./information-show.html" },
      { id: 2, title: "وضعیت اشتراک", src: "./subscriptions-status.html" },
      { id: 3, title: "کیف پول", src: "./wallet.html" },
    ],
  },
  {
    id: 3,
    title: "کاربران",
    icon: "bx bx-group",
    children: [
      { id: 1, title: "نمایش کاربران", src: "./users-show.html" },
      { id: 2, title: "کاربران بن شده", src: "./users-ban.html" },
      // { id: 3, title: "حذف کاربر", src: "./index.html" },
    ],
  },
  {
    id: 4,
    title: "فیلم ها",
    icon: "bx bx-movie-play",
    children: [
      { id: 1, title: "نمایش فیلم ها", src: "./movies-show.html" },
      { id: 2, title: "فیلم جدید", src: "./movies-add.html" },
      // { id: 3, title: "ویرایش فیلم", src: "./index.html" },
      // { id: 4, title: "حذف فیلم", src: "./index.html" },
    ],
  },
  {
    id: 5,
    title: "سریال ها",
    icon: "bx bx-film",
    children: [
      { id: 1, title: "نمایش سریال ها", src: "./series-show.html" },
      { id: 2, title: "سریال جدید", src: "./series-add.html" },
      { id: 3, title: "فصل جدید", src: "./seriesSesson-add.html" },
      { id: 4, title: "اپیزود جدید", src: "./seriesEpisode-add.html" },
      // { id: 3, title: "ویرایش سریال", src: "./index.html" },
      // { id: 4, title: "حذف سریال", src: "./index.html" },
    ],
  },
  {
    id: 6,
    title: "اسلایدر",
    icon: "bx bx-slideshow",
    children: [
      { id: 1, title: "نمایش اسلاید ها", src: "./slider-show.html" },
      { id: 2, title: "اسلاید جدید", src: "./slider-add.html" },
      // { id: 3, title: "حذف اسلاید", src: "./index.html" },
    ],
  },
  {
    id: 7,
    title: "درباره ما",
    icon: "bx bx-info-circle",
    children: [
      { id: 1, title: "نمایش درباره ما", src: "./about-show.html" },
      { id: 2, title: "درباره ما جدید", src: "./about-add.html" },
      // { id: 3, title: "ویرایش درباره ما", src: "./index.html" },
      // { id: 4, title: "حذف درباره ما", src: "./index.html" },
    ],
  },
  {
    id: 8,
    title: "اشتراک ها",
    icon: "bx bx-crown",
    children: [
      { id: 1, title: "نمایش اشتراک ها", src: "./subscriptions-show.html" },
      // { id: 2, title: "واریزی اشتراک ها", src: "./subscriptions-deposit.html" },
      // { id: 3, title: "ویرایش اشتراک", src: "./index.html" },
      // { id: 4, title: "حذف اشتراک", src: "./index.html" },
    ],
  },
  {
    id: 9,
    title: "تیکت ها",
    icon: "bx bx-message-dots",
    children: [
      { id: 1, title: "تیکت خوانده نشده", src: "./tickets-notRead.html" },
      { id: 2, title: "تیکت خوانده شده", src: "./tickets-submit.html" },
      { id: 3, title: "تیکت حذف شده", src: "./tickets-reject.html" },
    ],
  },
  {
    id: 10,
    title: "کامنت ها",
    icon: "bx bx-chat",
    children: [
      { id: 1, title: "کامنت خوانده نشده", src: "./comments-notRead.html" },
      { id: 2, title: "کامنت تایید شده", src: "./comments-submit.html" },
      { id: 3, title: "کامنت رد شده", src: "./comments-reject.html" },
    ],
  },
  {
    id: 11,
    title: "نوتیفیکیشن ها",
    icon: "bx bx-bell",
    children: [
      { id: 1, title: "نمایش نوتیفیکیشن ها", src: "./notification-show.html" },
      { id: 2, title: "نوتیفیکیشن جدید", src: "./notification-add.html" },
      // { id: 3, title: "ویرایش نوتیفیکیشن", src: "./index.html" },
      // { id: 4, title: "حذف نوتیفیکیشن", src: "./index.html" },
    ],
  },
  {
    id: 12,
    title: "خروج",
    icon: "bx bx-log-out",
    children: [{ id: 1, title: "خارج شدن از پنل", src: "./index.html" }],
  },
];

let dashboardAccordion = document.querySelector(".dashboard-accordion");
let htmlContent = "";

sidebarData.forEach((item) => {
  htmlContent += `<div class="accordion-item">
              <h2 class="accordion-header" id="heading${item.id}">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapse${item.id}"
                  aria-expanded="false"
                  aria-controls="collapse${item.id}"
                >
                  <i class="${item.icon}"></i>
                  <p>${item.title}</p>
                </button>
              </h2>
              <div
                id="collapse${item.id}"
                class="accordion-collapse collapse"
                aria-labelledby="heading${item.id}"
                data-bs-parent="#accordionExample"
              >
                <div class="accordion-body">`;

  item.children.forEach((child) => {
    htmlContent += `<a href="${child.src}">${child.id} - ${child.title}</a>`;
  });

  htmlContent += `</div></div></div>`;
});
dashboardAccordion.innerHTML = htmlContent;

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


// let usersAction=document.querySelectorAll('.users-action')
// let userAction__wrench=document.querySelectorAll('.user-action__wrench')

// usersAction.forEach((action=>{
//   action.addEventListener('click',()=>{
//     userAction__wrench.forEach((wranch)=>{
//       wranch.classList.toggle('active')
//     })
//   })
// }))


//notif
let notifsIcon =document.querySelector('.notifs-icon')
let notifList =document.querySelector('.notifList')

notifsIcon.addEventListener('click',()=>{
  notifList.classList.toggle('active')
})



