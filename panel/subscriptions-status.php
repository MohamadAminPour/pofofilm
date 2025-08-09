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
  <title>وضعیت اشتراک</title>
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
        <div class="subscriptions-status" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
          <!-- <div class="empty-msg">
              <p
                class="empty-msg__title"
                data-aos="fade-up"
                data-aos-duration="1000"
                data-aos-delay="0"
              >
                در حال حاظر اشتراکی در پوفوفیلم ندارید .
              </p>
              <a
                href="../subscriptions.html"
                data-aos="fade-up"
                data-aos-duration="1000"
                data-aos-delay="100"
              >
                <i class="bx bx-crown"></i>
                <p>خرید اشتراک</p>
              </a>
            </div> -->
          <div>
            <p class="subscriptions-status__title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
              وضعیت اشتراک
            </p>
            <div class="progress-bar-container" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
              <div class="progress-bar" id="progress-bar">
                <p>10%</p>
              </div>
            </div>
            <div class="subscriptions-status__info" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
              <div>
                <p>نوع اشتراک :</p>
                <i class="bx bxl-sketch" style="color: #ffd700"></i>
                <p>طلایی</p>
              </div>
              <p>تاریخ خرید: 2024/03/01</p>
              <p>تاریخ انقضا: 2024/06/01</p>
              <p>
                روزهای باقی‌مانده :
                <span id="remaining-days" class="highlight">0</span> روز
              </p>
            </div>
            <p class="subscriptions-status__title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
              تاریخچه اشتراک ها
            </p>
            <ul class="subscriptions-status__history" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <li>
                <div class="history-subscriptionsType">
                  <i class="bx bxl-sketch" style="color: #ffd700"></i>
                  <p>اشتراک طلایی</p>
                </div>
                <div class="history-date">
                  <div>
                    <p>از</p>
                    <p>1403/06/12</p>
                  </div>
                  <div>
                    <p>تا</p>
                    <p>1403/12/12</p>
                  </div>
                </div>
                <div>
                  <p>فعال</p>
                  <i class="bx bx-checkbox-checked" style="color: var(--green)"></i>
                </div>
              </li>
              <li>
                <div class="history-subscriptionsType">
                  <i class="bx bxl-sketch" style="color: #00d0ff"></i>
                  <p>اشتراک الماسی</p>
                </div>
                <div class="history-date">
                  <div>
                    <p>از</p>
                    <p>1403/06/12</p>
                  </div>
                  <div>
                    <p>تا</p>
                    <p>1403/12/12</p>
                  </div>
                </div>
                <div>
                  <p>منقضی</p>
                  <i class="bx bx-checkbox-minus" style="color: var(--error)"></i>
                </div>
              </li>
            </ul>
          </div>
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