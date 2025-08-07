<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/index.css" />
  <title>نماشا</title>
</head>

<body>

  <div class="video-intro">
    <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0" class="video-intro__title">پوفوفیلم</p>
    <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" class="video-intro__subTitle">به نماشای پوفوفیلم
      خوش آمدید !</p>
    <ol>
      <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
        <p>برای تجربه بهتر گزینه بزرگنمایی را فعال کنید .</p>
      </li>
      <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <p>تماشای آنلاین فیلم و سریال ها با تعرفه نیم بها حساب میشود. .</p>
      </li>
      <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
        <p>
          اگر مشکلی در اجرای فیلم و سریال ها داشتید حتما از بخش تیکت ها به
          ادمین های پوفوفیلم گزارش دهید.
        </p>
      </li>
      <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
        <p>
          بعد از تماشای فیلم یا سریال خود حتما نظر خود را درباره آن در بخش
          دیدگاه ها بنویسید .
        </p>
      </li>
      <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="350">
        <p>امیدوارم از فیلم خود لذت ببرید : )</p>
      </li>
    </ol>
    <button data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="okVideoBtn"
      onclick="okPlayOnlineBtn()">باشه</button>
  </div>

  <?php include './components/menu.php' ?>

  <?php include './components/main-bottomMenu.php' ?>


  <div class="video-container">

    <video controls preload="auto" poster="./assets/images/slider-img/from1.jfif">
      <source src="./assets/trailer/1434659607842-pgv4ql-1722102308920.mp4" type="video/mp4">
      </source>
    </video>

    <div class="sec-header" style="margin-right: 1rem;">
      <div class="sec-header__left">
        <i class="bx bx-play-circle header-left__icon"></i>
      </div>
      <div class="sec-header__right">
        <p class="sec-title">لینک های پخش</p>
        <p class="sec-subtitle">با خیال راحت در خانه بنشینید و فیلمتان را ببینید !</p>
      </div>
    </div>

    

   <div
        class="accordion movie-downloadLinks__accordion"
        id="accordionExample"
        style="padding: 0 1rem 1rem;"
      >
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseOne"
              aria-expanded="false"
              aria-controls="collapseOne"
            >
              زیرنویس فارسی
            </button>
          </h2>
          <div
            id="collapseOne"
            class="accordion-collapse collapse"
            aria-labelledby="headingOne"
            data-bs-parent="#accordionExample"
          >
            <div class="accordion-body">
              <!-- <div>
                <i class='bx bx-lock-alt'></i>
                <p>برای دانلود باید اشتراک داشته باشید.</p>
              </div> -->
              <div class="accordion-movies">
                <i class="bx bx-down-arrow-alt"></i>
                <a href="">کیفیت 480</a>
              </div>
              <div class="accordion-movies">
                <i class="bx bx-down-arrow-alt"></i>
                <a href="">کیفیت 720</a>
              </div>
              <div class="accordion-movies">
                <i class="bx bx-down-arrow-alt"></i>
                <a href="">کیفیت 1080</a>
              </div>
              <div class="accordion-movies">
                <i class="bx bx-down-arrow-alt"></i>
                <a href="">کیفیت 4k</a>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading2">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse2"
              aria-expanded="false"
              aria-controls="collapse2"
            >
              دوبله فارسی
            </button>
          </h2>
          <div
            id="collapse2"
            class="accordion-collapse collapse"
            aria-labelledby="heading2"
            data-bs-parent="#accordionExample"
          >
            <div class="accordion-body">
              <div>
                <i class="bx bx-lock-alt"></i>
                <p>برای دانلود باید اشتراک داشته باشید.</p>
              </div>
              <!-- <div>
                <i class="bx bx-down-arrow-alt"></i>
                <a href="">کیفیت 480</a>
              </div>
              <div>
                <i class="bx bx-down-arrow-alt"></i>
                <a href="">کیفیت 720</a>
              </div>
              <div>
                <i class="bx bx-down-arrow-alt"></i>
                <a href="">کیفیت 1080</a>
              </div> -->
            </div>
          </div>
        </div>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="./js/index.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>