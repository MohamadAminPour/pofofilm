<?php

include '../server/PDO.php';
session_start();

$query = $conn->prepare('SELECT m.*, m.media_id as media_id, u.username as username, m.faName as faName FROM saves sv JOIN users u ON u.id = sv.user_id JOIN movies m ON m.media_id = sv.media_id WHERE sv.user_id=? ');
$query->bindValue(1, $_SESSION['id']);
$query->execute();
$movieSaves = $query->FetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare('SELECT se.*, se.media_id as media_id, u.username as username, se.faName as faName FROM saves sv JOIN users u ON u.id = sv.user_id JOIN series se ON se.media_id = sv.media_id WHERE sv.user_id=? ');
$query->bindValue(1, $_SESSION['id']);
$query->execute();
$seriesSaves = $query->FetchAll(PDO::FETCH_ASSOC);

$saves = [...$movieSaves, ...$seriesSaves];

// var_dump($saves);


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
  <title>فیل و سریال های ذخیره شده</title>
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
        <div class="movies-list">
          <div class="movies-list_header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
            <img src="../assets/images/icons8-add-bookmark-100" alt="" />
            <p class="movies-list_header-title">ذخیره شده ها</p>
            <p class="movies-list_header-subTitle">
              فیلم هایی که میخواستی بعدا ببینی اینجا ذخیره شدن !
            </p>
          </div>
          <hr />
          <ul class="movie-infos" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <?php if($saves){foreach($saves as $save){ ?>
            <li>
              <p><?= $save['media_id'] ?></p>
              <p><?= $save['faName'] ?></p>
              <button class="movie-action">
                <p>عملیات</p>
                <i class="bx bx-wrench"></i>
                <ul class="movie-action__wrench">
                  <?php if(isset($save['duration'])){ ?>
                  <li><a href="../movie.php?id=<?= $save['media_id'] ?>">دیدن</a></li>
                  <?php } else{ ?>
                  <li><a href="../series.php?id=<?= $save['media_id'] ?>">دیدن</a></li>
                  <?php } ?>
                  <li><a href="./removeSave.php?id=<?= $save['media_id'] ?>">حذف</a></li>
                </ul>
              </button>
            </li>
            <?php }} else{ ?>
            <div class="empty-msg">
                <p
                  class="empty-msg__title"
                  data-aos="fade-up"
                  data-aos-duration="1000"
                  data-aos-delay="0"
                >
                  تا به الان شما فیلم یا سریالی ذخیره نکردید !
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