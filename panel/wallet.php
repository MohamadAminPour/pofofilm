<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="./styles/index.css" />
  <title>کیف پول</title>
</head>

<body>
  <div class="bgl"></div>

  <div class="dashboard">
    <div class="dashboard-sidebar active">
    <div style="display: flex; align-items: center;justify-content: space-between;">
         <a href="../index.php" class="logo">پوفوفیلم</a>
         <p style="font-size: 1.5rem; cursor: pointer;margin-left: .5rem;" onclick="dashboardSidebar.classList.remove('active');bgl.classList.remove('active')">×</p>
      </div>
      <div class="accordion dashboard-accordion" id="accordionExample">
         <?php include './components/panel-sidbar.php' ?>
      </div>
    </div>
    <div class="dashboard-main">
     <?php include './components/panel-header.php' ?>
      <div class="dashboard-content">
        <div class="wallet">
          <p class="wallet-history__title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            کیف پول
          </p>

          <ul class="wallet-info">
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
              <i class="bx bxs-upvote"></i>
              <div>
                <p>1,450,000</p>
                <p>واریزی (تومان)</p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
              <i class="bx bx-wallet"></i>
              <div>
                <p>1,320,000</p>
                <p>کیف پول (تومان)</p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
              <i class="bx bxs-downvote"></i>
              <div>
                <p>130,000</p>
                <p>برداشت (تومان)</p>
              </div>
            </li>
          </ul>
          <a href="" class="wallet-sharging" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            <i class="bx bxs-credit-card"></i>
            <p>شارژ حساب</p>
          </a>
          <p class="wallet-history__title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
            تاریخچه تراکنش
          </p>
          <ul class="wallet-history">
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
              <div>
                <i class="bx bxl-sketch" style="color: #ffd700"></i>
                <p>خرید اشتراک</p>
              </div>
              <p>30,000 تومان</p>
              <p>1403/08/18</p>
            </li>
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
              <div>
                <i class="bx bx-ghost" style="color: #353a49"></i>
                <p>اتاق فرار</p>
              </div>
              <p>100,000 تومان</p>
              <p>1403/12/05</p>
            </li>
            <!-- <div class="empty-msg">
              <p class="empty-msg__title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1000">تاکنون تراکنشی
                توسط شما انجام نشده است .</p>
            </div> -->
          </ul>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="./js/script.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>