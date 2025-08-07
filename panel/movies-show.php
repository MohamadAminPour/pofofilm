<?php
  include '../server/PDO.php';
  session_start();

  $query = $conn->prepare('SELECT * FROM movies');
  $query->execute();
  $movies = $query->FetchAll(PDO::FETCH_ASSOC);

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
      <a href="" class="logo">پوفوفیلم</a>
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
            <img src="../assets/images/icons8-movies-100.png" alt="" />
            <p class="movies-list_header-title">فیلم ها</p>
            <p class="movies-list_header-subTitle">
              فیلم های سایت پوفوفیلم را مدیریت کنید !
            </p>
          </div>
          <hr />
          <ul class="movie-infos" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <?php if($movies){foreach($movies as $movie): ?>
            <li>
              <p><?= $movie['faName'] ?></p>
              <p><?= $movie['enName'] ?></p>
              <p><?= $movie['faDate'] ?></p>
              <p><?= $movie['enDate'] ?></p>
              <p><?= $movie['duration'] ?></p>
              <p><?= $movie['imdb'] ?></p>
              <p><?= $movie['ageGroup'] ?></p>
              <p><?= $movie['category'] ?></p>
              <p><?= $movie['genre'] ?></p>
              <p><?= substr($movie['caption'] ,0,100)?>...</p>
              <button class="movie-action">
                <p>عملیات</p>
                <i class="bx bx-wrench"></i>
                <ul class="movie-action__wrench">
                  <li><a href="../movie.php?id=<?= $movie['media_id'] ?>">جزئیات</a></li>
                  <li><a href="./movies-edit.php?id=<?= $movie['media_id'] ?>">ویرایش</a></li>
                  <li><a href="./movies-remove.php?id=<?= $movie['media_id'] ?>">حذف</a></li>
                </ul>
              </button>
            </li>
            <?php endforeach;}else{ ?>
            <div class="empty-msg">
                <p
                  class="empty-msg__title"
                  data-aos="fade-up"
                  data-aos-duration="1000"
                  data-aos-delay="0"
                >
                تا به امروز در پوفوفیلم فیلمی بارگذاری نشده است !
                </p>
              </div>
          </ul>
          <?php } ?>
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