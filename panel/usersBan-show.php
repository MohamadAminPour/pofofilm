<?php
  include '../server/PDO.php';
  session_start();

  $query = $conn->prepare('SELECT * FROM users WHERE isBan=?');
  $query->bindValue(1, 1);
  $query->execute();
  $users = $query->FetchAll(PDO::FETCH_ASSOC);

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
  <title>داشبورد</title>
</head>

<body>
  <div class="bgl"></div>
  <div class="dashboard">
    <div class="dashboard-sidebar active">
    <a href="../index.php" class="logo">پوفوفیلم</a>
      <div class="accordion dashboard-accordion" id="accordionExample">
         <?php include './components/panel-sidbar.php' ?>
      </div>
    </div>
    <div class="dashboard-main">
    <?php include './components/panel-header.php' ?>
    
      <div class="dashboard-content">
        <div class="users-ban">
          <div class="users-ban_header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
            <img src="../assets/images/icons8-prison-100.png" alt="" />
            <p class="users-ban_header-title">کاربران بن شده</p>
            <p class="users-ban_header-subTitle">
              کاربرانی که تخلفی مرتکب شده اند !
            </p>
          </div>
          <hr />
          <ul class="users-infos" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <?php if($users){foreach($users as $user): ?>
            <li>
              <p><?= $user['id'] ?></p>
              <img src="../assets/images/users/<?= $user['image'] ?>" alt="" />
              <p><?= $user['username'] ?></p>
              <p><?= $user['email'] ?></p>
              <button class="users-action">
                <p>عملیات</p>
                <i class="bx bx-wrench"></i>
                <ul class="user-action__wrench">
                  <li><a href="./unBanUser.php?id=<?= $user['id'] ?>">رفع بن</a></li>
                </ul>
              </button>
            </li>
            <?php endforeach; } else{ ?>
            <div class="empty-msg">
              <p class="empty-msg__title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                کاربری تا به امروز از پوفوفیلم بن نشده است .
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