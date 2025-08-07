<?php
  include '../server/PDO.php';
  session_start();

  $query = $conn->prepare('SELECT * FROM users WHERE isBan=? ORDER BY role DESC');
  $query->bindValue(1, 0);
  $query->execute();
  $users = $query->FetchAll(PDO::FETCH_ASSOC);


  $query = $conn->prepare('SELECT COUNT(id) as ownersCount  FROM users WHERE role=?');
  $query->bindValue(1, 2);
  $query->execute();
  $ownersCount = $query->Fetch(PDO::FETCH_ASSOC);

  $query = $conn->prepare('SELECT COUNT(id) as adminsCount  FROM users WHERE role=?');
  $query->bindValue(1, 1);
  $query->execute();
  $adminsCount = $query->Fetch(PDO::FETCH_ASSOC);
  
  $query = $conn->prepare('SELECT COUNT(id) as usersCount FROM users WHERE role=?');
  $query->bindValue(1, 0);
  $query->execute();
  $usersCount = $query->Fetch(PDO::FETCH_ASSOC);


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
        <div class="users">
          <ul class="users-details">
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
              <i class="bx bx-crown"></i>
              <div>
                <p>مالک</p>
                <p><?= $ownersCount['ownersCount'] ?> نفر</p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
              <i class="bx bx-check-shield"></i>
              <div>
                <p>ادمین</p>
                <p><?= $adminsCount['adminsCount'] ?> نفر</p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
              <i class="bx bx-user"></i>
              <div>
                <p>کاربر</p>
                <p><?= $usersCount['usersCount'] ?> نفر</p>
              </div>
            </li>
          </ul>
          <p class="users-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            همه کاربران
          </p>
          <ul class="users-infos" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <?php foreach($users as $user): ?>
            <li>
              <p><?= $user['id'] ?></p>
              <img src="../assets/images/users/<?= $user['image'] ?>" alt="" />
              <p><?= $user['username'] ?></p>
              <p><?= $user['email'] ?></p>
              <p><?= $user['password'] ?></p>
              <?php if($user['role']==2){ ?>
              <i class="bx bx-crown" style="color: #0080ff"></i>
              <?php } elseif($user['role']==1) { ?>
              <i class="bx bx-check-shield" style="color: #00d612"></i>
              <?php } elseif($user['role']==0) { ?>
              <i class="bx bx-user" style="color: #ff0015"></i>
              <?php }  ?>
               <button class="users-action">
                <p>عملیات</p>
                <i class="bx bx-wrench"></i>
                <ul class="user-action__wrench">
                  <?php if($user['role']==0){ ?>
                    <li><a href="./banUser.php?id=<?= $user['id'] ?>">بن کردن</a></li>
                    <li><a href="./upgradeToAdmin.php?id=<?= $user['id'] ?>">ارتقا به ادمین</a></li>
                    <li><a href="./upgradeToOwner.php?id=<?= $user['id'] ?>">ارتقا به مالک</a></li>
                  <?php } elseif($user['role']==2) { ?>
                    <li><a href="./removeFromOwner.php?id=<?= $user['id'] ?>">حذف مالکیت</a></li>
                  <?php }  elseif($user['role']==1) { ?>
                    <li><a href="./upgradeToOwner.php?id=<?= $user['id'] ?>">ارتقا به مالک</a></li>
                    <li><a href="./removeFromAdmin.php?id=<?= $user['id'] ?>">حذف ادمینی</a></li>
                    <li><a href="./banUser.php?id=<?= $user['id'] ?>">بن کردن</a></li>
                  <?php } ?>
                </ul>
              </button>
            </li>
            <hr />
            <?php endforeach; ?>
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