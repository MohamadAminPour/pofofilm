<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/index.css" />
  <title onclick="getSubsciption()">خرید اشتراک</title>
</head>

<body>
 <?php include './components/menu.php' ?>
 <?php include './components/main-bottomMenu.php' ?>


  <div class="subscriptions-container">
    <div class="sec-header" style="margin-top: 5rem">
      <div class="sec-header__left">
        <i class="bx bxl-sketch header-left__icon"></i>
      </div>
      <div class="sec-header__right">
        <p class="sec-title">متمایز از دیگران</p>
        <p class="sec-subtitle">دسترسی به همه ی محتواهای سایت !</p>
      </div>
    </div>
    <div class="subscriptions">
      <div class="subscriptions-item">
        <form method="post">
          <input type="hidden" name="subscriptionsID" />
          <!-- <p class="subscriptions-item__suggestion">پیشنهادی</p> -->
          <i class="bx bxl-sketch subscriptions-item__icon" style="color: #cd7f32"></i>
          <p class="subscriptions-item__time">30 روزه</p>
          <s class="subscriptions-item__off">59,000</s>
          <div class="subscriptions-item__price">
            <p>71,000</p>
            <span>تومان</span>
          </div>
          <button class="subscriptions-item__btn" onclick="getSubsciption()">
            خرید
          </button>
        </form>
      </div>
      <div class="subscriptions-item">
        <form method="post">
          <input type="text" hidden />
          <!-- <p class="subscriptions-item__suggestion">پیشنهادی</p> -->
          <i class="bx bxl-sketch subscriptions-item__icon" style="color: #c0c0c0"></i>
          <p class="subscriptions-item__time">3 ماهه</p>
          <s class="subscriptions-item__off">177,000</s>
          <div class="subscriptions-item__price">
            <p>166,000</p>
            <span>تومان</span>
          </div>
          <button class="subscriptions-item__btn" onclick="getSubsciption()">
            خرید
          </button>
        </form>
      </div>
      <div class="subscriptions-item">
        <form method="post">
          <input type="text" hidden />
          <p class="subscriptions-item__suggestion">پیشنهادی</p>
          <i class="bx bxl-sketch subscriptions-item__icon" style="color: #ffd700"></i>
          <p class="subscriptions-item__time">6 ماهه</p>
          <s class="subscriptions-item__off">354,000</s>
          <div class="subscriptions-item__price">
            <p>304,000</p>
            <span>تومان</span>
          </div>
          <button class="subscriptions-item__btn" onclick="getSubsciption()">
            خرید
          </button>
        </form>
      </div>
      <div class="subscriptions-item">
        <form method="post">
          <input type="text" hidden />
          <!-- <p class="subscriptions-item__suggestion">پیشنهادی</p> -->
          <i class="bx bxl-sketch subscriptions-item__icon" style="color: #b9f2ff"></i>
          <p class="subscriptions-item__time">1 ساله</p>
          <s class="subscriptions-item__off">708,000</s>
          <div class="subscriptions-item__price">
            <p>566,000</p>
            <span>تومان</span>
          </div>
          <button class="subscriptions-item__btn" onclick="getSubsciption()">
            خرید
          </button>
        </form>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="footer-right">
        <button class="goToUp">
          <i class="bx bx-chevron-up"></i>
        </button>
        <ul>
          <li><a href="./index.html">خانه</a></li>
          <li><a href="./search.html">جستجو</a></li>
          <li>
            <a href="./subscriptions.html" onclick="getSubsciption()">خرید اشتراک</a>
          </li>
          <li><a href="./login.html">ورود یا ثبت نام</a></li>
        </ul>
      </div>

      <div class="footer-left">
        <a href=""><i class="bx bxl-telegram"></i></a>
        <a href=""><i class="bx bxl-instagram-alt"></i></a>
        <a href=""><i class="bx bxl-youtube"></i></a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/index.js"></script>

  <script>
    function getSubsciption() {
      Swal.fire({
        title: "خرید اشتراک",
        text: "آیا از خرید این اشتراک مطمئن هستید؟",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#ff9900",
        cancelButtonColor: "#d33",
        confirmButtonText: "بله",
        cancelButtonText: "الان نه",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "خرید موفقیت آمیز",
            text: "تا دقایقی دیگر اشتراک شما توسط ادمین های ما تایید میشود.",
            icon: "success",
          });
        }
      });
    }
  </script>
</body>

</html>