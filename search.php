<?php
include "./server/PDO.php";
session_start();

$query = $conn->prepare('SELECT * FROM movies ORDER BY create_at DESC');
$query->execute();
$movies = $query->FetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare('SELECT * FROM series ORDER BY create_at DESC');
$query->execute();
$series = $query->FetchAll(PDO::FETCH_ASSOC);


$movieSearch=$movies;
$seriesSearch=$series;

if(isset($_POST['searchBtn'])){
  $title = $_POST['title'];
  $result=$conn->prepare("SELECT * FROM movies WHERE faName LIKE '%$title%' OR enName LIKE '%$title%' OR enDate LIKE '%$title%' OR faDate LIKE '%$title%' OR category LIKE '%$title%' OR imdb LIKE '%$title%'  ");
  $result->execute();
  $movieSearch = $result->fetchAll(PDO::FETCH_ASSOC);
}

if(isset($_POST['searchBtn'])){
  $title = $_POST['title'];
  $result=$conn->prepare("SELECT * FROM series WHERE faName LIKE '%$title%' OR enName LIKE '%$title%' OR enDate LIKE '%$title%' OR faDate LIKE '%$title%' OR category LIKE '%$title%' OR imdb LIKE '%$title%' ");
  $result->execute();
  $seriesSearch = $result->fetchAll(PDO::FETCH_ASSOC);
}

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
  <title>جستجو</title>
</head>
<style>
  .infos-ENGname,.infos-FAname,.infos-genre,.infos-rate {
    font-size: 0.9rem !important;
    direction: rtl;
    display: -webkit-box !important;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .notFoundError{
    background-color: red;
    padding: 1rem;
    color: white;
    border-radius: .5rem;
    width: 100%;
  }
</style>

<body>
  <?php include './components/menu.php' ?>
  <?php include './components/main-bottomMenu.php' ?>


  <div class="search-container">
    <div class="sec-header" style="margin-top: 5rem">
      <div class="sec-header__left">
        <i class="bx bx-search header-left__icon"></i>
      </div>
      <div class="sec-header__right">
        <p class="sec-title">علایق شما عزیزان</p>
        <p class="sec-subtitle">محتوای خود را از اینجا پیدا کنید !</p>
      </div>
    </div>

    <form method="POST" class="inputSearch">
      <input type="text" name="title" value="" placeholder="جستجو بر اساس نام فیلم یا سریال، ژانر، امتیاز imdb و سال ساخت..." />
      <button type="submit" name="searchBtn">
        <i class="bx bx-search"></i>
      </button>
    </form>
  </div>

  <div class="searchResult">
    <div class="searchResult__container">
      <?php if($movieSearch){foreach($movieSearch as $movie):  ?>
      <div class="swiper-slide mainSlide1">
        <i class="bx bx-captions slide-captionIcon"></i>
        <div class="slide-image">
          <img src="./assets/images/<?= $movie['cover'] ?>" alt="" />
          <div class="slideBtns">
            <a href="./movieTrailer.php?id=<?= $movie['media_id'] ?>" class="trailerBtn">
              <i class="bx bx-tv"></i>
              <p>تریلر</p>
            </a>
            <a href="./movie.php?id=<?= $movie['media_id'] ?>" class="downloadBtn">
              <i class="bx bx-download"></i>
              <p>دانلود</p>
            </a>
          </div>
        </div>
        <div class="slide-infos">
          <p class="infos-ENGname"><?= $movie['enName'] ?></p>
          <p class="infos-FAname"><?= $movie['faName'] ?></p>
          <p class="infos-rate"><?= $movie['imdb'] ?> <span> / 10</span></p>
          <p class="infos-time"><?= $movie['duration'] ?></p>
        </div>
      </div>
      <?php endforeach;} else if($seriesSearch){foreach($seriesSearch as $series):  ?>
          <div class="swiper-slide mainSlide1">
            <i class="bx bx-captions slide-captionIcon"></i>
            <div class="slide-image">
              <img src="./assets/images/<?= $series['cover'] ?>" alt="" />
              <div class="slideBtns">
                <a href="./seriesTrailer.php?id=<?= $series['media_id'] ?>" class="trailerBtn">
                  <i class="bx bx-tv"></i>
                  <p>تریلر</p>
                </a>
                <a href="./series.php?id=<?= $series['media_id'] ?>" class="downloadBtn">
                  <i class="bx bx-download"></i>
                  <p>دانلود</p>
                </a>
              </div>
            </div>
            <div class="slide-infos">
              <p class="infos-ENGname"><?= $series['enName'] ?></p>
              <p class="infos-FAname"><?= $series['faName'] ?></p>
              <p class="infos-rate"><?= $series['imdb'] ?> <span> / 10</span></p>
              <p class="infos-genre"><?= $series['genre'] ?></p>
            </div>
          </div>
       <?php endforeach;} else{ ?>
        <p class="notFoundError">موردی یافت نشد</p>
        <?php } ?>
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
          <li><a href="./subscriptions.html">خرید اشتراک</a></li>
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
  <script src="./js/index.js"></script>
</body>

</html>