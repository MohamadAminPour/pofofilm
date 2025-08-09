<?php
include "./server/PDO.php";
$pageName = "index";
session_start();

$query = $conn->prepare('SELECT * FROM movies');
$query->execute();
$movies = $query->FetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare('SELECT * FROM series');
$query->execute();
$serieses = $query->FetchAll(PDO::FETCH_ASSOC);


$query = $conn->prepare('SELECT * FROM slider sl JOIN movies m ON m.media_id = sl.media_id ');
$query->execute();
$MovieSliders = $query->FetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare('SELECT * FROM slider sl JOIN series se ON se.media_id = sl.media_id ');
$query->execute();
$seriesSliders = $query->FetchAll(PDO::FETCH_ASSOC);

$medias = [...$MovieSliders, ...$seriesSliders];
foreach($medias as $media){}  



$query = $conn->prepare("INSERT INTO view SET view=?, create_at=?");
$query->bindValue(1, 1);
$query->bindValue(2, date("Y/m/d"));
$query->execute();


// var_dump($medias);
// $genres = $media['genre'];
// $genre = explode("-", $genres);

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
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <title>خانه | پوفوفیلم</title>
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
</style>

<body>

  <?php include './components/menu.php' ?>
  <?php include './components/main-bottomMenu.php' ?>


  <div class="swiper headSwiper">
    <div class="swiper-wrapper">
      <?php foreach($medias as $media): ?>
      <div class="swiper-slide headSlide" style="background-image: url(./assets/images/media/<?= $media['bg'] ?>)">
        <div class="headSlide-content">
          <p class="item-name" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
            <?= $media['faName'] ?>
          </p>

          <p class="item-caption" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"><?= $media['caption'] ?></p>
          <div class="item-rate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <div class="item-imdb">
              <p class="imdb-num"><span><?= $media['imdb'] ?></span> / 10</p>
              <a class="imdb-link" href="https://www.imdb.com/title/tt6566576/?ref_=fn_al_tt_1">IMDB</a>
            </div>
            <div class="item-stars">
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i>
              <i class="bx bx-star"></i>
              <i class="bx bx-star"></i>
            </div>
          </div>
          <div class="item-genre" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">

         <?php
          $genres = explode("-", $media['genre']);
          foreach($genres as $gn){
          echo "<p>$gn</p>";
          } 
         ?>

          </div>
          <div class="item-links" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <?php if(isset($media['duration'])){ ?>
              <a class="item-trailer" href="./movieTrailer.php?id=<?= $media['media_id'] ?>">مشاهده تریلر</a>
            <?php } else{ ?>
              <a class="item-trailer" href="./seriesTrailer.php?id=<?= $media['media_id'] ?>">مشاهده تریلر</a>
            <?php } ?>

            
            <?php if(isset($media['duration'])){ ?>
              <a class="item-download" href="./movie.php?id=<?= $media['media_id'] ?>">دانلود</a>
            <?php } else{ ?>
              <a class="item-download" href="./series.php?id=<?= $media['media_id'] ?>">دانلود</a>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="container mainContainer">
    <div class="recommendContainer">
      <div class="swiper recommendSwiper">
        <div class="sec-header">
          <div class="sec-header__left">
            <i class="bx bx-coffee header-left__icon"></i>
          </div>
          <div class="sec-header__right">
            <p class="sec-title">جدید ترین سریال ها</p>
            <p class="sec-subtitle">سریال های ایرانی و خارجی جدید رسیدند !</p>
          </div>
        </div>
        <div class="swiper-wrapper recommendWraper">
          <?php foreach($serieses as $series): ?>
          <div class="swiper-slide mainSlide1">
            <i class="bx bx-captions slide-captionIcon"></i>
            <div class="slide-image">
              <img src="./assets/images/media/<?= $series['cover'] ?>" alt="" />
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
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="recommendContainer">
      <div class="swiper recommendSwiper">
        <div class="sec-header">
          <div class="sec-header__left">
            <i class="bx bx-coffee header-left__icon"></i>
          </div>
          <div class="sec-header__right">
            <p class="sec-title">جدید ترین فیلم ها</p>
            <p class="sec-subtitle">
              فیلم های سینمایی در همه نوع ژانر را تماشا کنید !
            </p>
          </div>
        </div>
        <div class="swiper-wrapper recommendWraper">
          <?php foreach($movies as $movie): ?>
          <div class="swiper-slide mainSlide1">
            <i class="bx bx-captions slide-captionIcon"></i>
            <div class="slide-image">
              <img src="./assets/images/media/<?= $movie['cover'] ?>" alt="" />
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
              <p class="infos-genre"><?= $movie['duration'] ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="aboutUs">
      <div class="sec-header center">
        <div class="sec-header__right" style="text-align: center">
          <p class="sec-title">راحتی رو با پوفوفیلم به دست بیار</p>
          <p class="sec-subtitle">دانلود فیلم و سریال رایگان</p>
        </div>
      </div>
      <div class="aboutUs-container">
        <div class="aboutUsBox aboutUsBox1">
          <div class="aboutUsBox-left">
            <i class="bx bxs-cloud"></i>
          </div>
          <div class="aboutUsBox-right">
            <p class="aboutUsBox-title">نیم بها</p>
            <p class="aboutUsBox-subtitle">
              صرفه جویی در اینترنت با دارکنس مووی
            </p>
          </div>
        </div>

        <div class="aboutUsBox aboutUsBox2">
          <div class="aboutUsBox-left">
            <i class="bx bx-captions"></i>
          </div>
          <div class="aboutUsBox-right">
            <p class="aboutUsBox-title">زیرنویس</p>
            <p class="aboutUsBox-subtitle">
              دانلود فیلم و سریال با زیرنویس فارسی
            </p>
          </div>
        </div>

        <div class="aboutUsBox aboutUsBox3">
          <div class="aboutUsBox-left">
            <i class="bx bxs-bolt"></i>
          </div>
          <div class="aboutUsBox-right">
            <p class="aboutUsBox-title">کیفیت بالا</p>
            <p class="aboutUsBox-subtitle">دانلود با کیفیت 720 و 1080</p>
          </div>
        </div>

        <div class="aboutUsBox aboutUsBox4">
          <div class="aboutUsBox-left">
            <i class="bx bx-dollar"></i>
          </div>
          <div class="aboutUsBox-right">
            <p class="aboutUsBox-title">دانلود رایگان</p>
            <p class="aboutUsBox-subtitle">فیلم هاتو بدون اشتراک دانلود کن</p>
          </div>
        </div>

        <div class="aboutUsBox aboutUsBox5">
          <div class="aboutUsBox-left">
            <i class="bx bx-library"></i>
          </div>
          <div class="aboutUsBox-right">
            <p class="aboutUsBox-title">تنوع در دسته بندی</p>
            <p class="aboutUsBox-subtitle">
              بیش از 1000 فیلم ترسناک و دلهره آور
            </p>
          </div>
        </div>
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

  <!-- <div class="main-container"></div> -->

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>