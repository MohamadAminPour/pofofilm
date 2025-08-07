let prevScrollpos = window.pageYOffset;

window.onscroll = function () {
  const currentScrollPos = window.pageYOffset;
  let menu = document.querySelector("menu");

  // تغییر پس‌زمینه به سیاه هنگام اسکرول به پایین
  if (currentScrollPos > 50) {
    // 50 پیکسل اسکرول شده
    menu.classList.add("scrolled");
  } else {
    menu.classList.remove("scrolled");
  }

  // نمایش یا پنهان کردن منو هنگام اسکرول
  if (prevScrollpos > currentScrollPos) {
    // اسکرول به بالا
    menu.classList.remove("hide");
  } else {
    // اسکرول به پایین
    menu.classList.add("hide");
  }

  prevScrollpos = currentScrollPos;
};

var swiper = new Swiper(".headSwiper", {
  autoplay: true,
  effect: "fade",
});

var swiper = new Swiper(".recommendSwiper", {
  autoplay: true,
  loop: true,
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    350: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    450: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    600: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    800: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 10,
    },
  },
});

let goToUp = document.querySelector(".goToUp");

goToUp.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

function okPlayOnlineBtn() {
  let VideoCIntro = document.querySelector(".video-intro");
  VideoCIntro.style.display = "none";
}

let spoil = document.querySelectorAll(".spoil");
let spoilBtns = document.querySelectorAll(".spoilBtn");

spoilBtns.forEach((btn) => {
  btn.addEventListener("click",() => {
    spoil.forEach((item) => {
      item.classList.add("show");
    });
  });
});
