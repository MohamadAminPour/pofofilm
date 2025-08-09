<?php
  include '../server/PDO.php';
  session_start();

  //کامنت ها
  $counter=1;
  $query = $conn->prepare("SELECT c.id as id, c.*, u.username as username FROM comments c JOIN users u ON u.id = c.user_id WHERE c.status=?");
  $query->bindValue(1, 0);
  $query->execute();
  $comments = $query->FetchAll(PDO::FETCH_ASSOC);

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
  <title>کامنت های خوانده نشده</title>
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
        <div class="comments">
          <div class="comments-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
            <img src="../assets/images/icons8-delete-message-100.png" alt="" />
            <p class="comments-header-title">کامنت ها</p>
            <p class="comments-header-subTitle">
              کامنت های رد شده توسط ادمین ها !
            </p>
          </div>
          <hr />
          <ul class="comments-infos" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <?php if($comments){foreach($comments as $comment): ?>
            <li>
              <span><?= $counter++ ?></span>
              <p><?= $comment['username'] ?></p>
              <p><?= $comment['create_at'] ?></p>
              <button class="comments-action">
                <p>عملیات</p>
                <i class="bx bx-wrench"></i>
                <ul class="comments-action__wrench">
                  <li><a href="#" onclick="alert('<?= $comment['text'] ?>')">نمایش</a></li>
                </ul>
              </button>
            </li>
            <?php endforeach;} else{ ?>
            <div class="empty-msg">
                <p
                  class="empty-msg__title"
                  data-aos="fade-up"
                  data-aos-duration="1000"
                  data-aos-delay="0"
                >
                  تا به امروز کامنتی برای محتوا ها گذاشته نشده است .
                </p>
              </div>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="./js/script.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>