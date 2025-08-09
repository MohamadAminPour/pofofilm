<?php
  include './server/PDO.php';
  include './jdf.php';
  session_start();

  $id = $_GET['id'];
  $notLogin = false;
  $success = false;
  $commentFieldErr = false;
  $commentSended = false;

  //اطلاعات فیلم
  $query = $conn->prepare('SELECT * FROM movies WHERE media_id=?');
  $query->bindValue(1, $id);
  $query->execute();
  $movie = $query->FetchAll(PDO::FETCH_ASSOC);
  foreach($movie as $item){}
  $genres = $item['genre'];
  $genre = explode("-", $genres);


  //لیست پیشنهادی ها
  $query = $conn->prepare('SELECT * FROM movies WHERE category=?');
  $query->bindValue(1, $item['category']);
  $query->execute();
  $suggestionMovies = $query->FetchAll(PDO::FETCH_ASSOC);



/////////////////////////////////////سیو شده ها//////////////////////////////////////////
  

  //سیو کردن
  $create_at="1404";
  if(isset($_POST['saveMovie'])){
    if(isset($_SESSION['id'])){
      $query = $conn->prepare("INSERT INTO saves SET user_id=?, media_id=? ,create_at=?");
      $query->bindValue(1, $_SESSION['id']);
      $query->bindValue(2, $item['media_id']);
      $query->bindValue(3, $create_at);
      $query->execute();
      $success = true;
    }
    else{
      $notLogin = true;
    }
  }


  //ویدیو سیو شده
  $query = $conn->prepare('SELECT * FROM saves WHERE media_id=? AND user_id=?');
  $query->bindValue(1, $item['media_id']);
  $query->bindValue(2, isset($_SESSION['id'])?$_SESSION['id']:null);
  $query->execute();
  $saveMovie = $query->FetchAll(PDO::FETCH_ASSOC);




//////////////////////////////////////کامنت ها///////////////////////////////////////////////




  //کامنت ها
  $query = $conn->prepare("SELECT c.*, u.* FROM comments c JOIN users u ON u.id = c.user_id WHERE media_id=? AND c.status=?");
  $query->bindValue(1, $id);
  $query->bindValue(2, 1);
  $query->execute();
  $comments = $query->FetchAll(PDO::FETCH_ASSOC);

  //کامنت گذاشتن
  if(isset($_POST['sendComment'])){
    $textComment = $_POST['textComment'];
    $spoil = isset($_POST['spoil']) ? 1 : 0;;
    $create_at = jdate("l, d F Y");

    if(isset($_SESSION['id'])){
      if($textComment){
          $query = $conn->prepare("INSERT INTO comments SET text=?, spoil=?,  user_id=?, media_id=? ,create_at=?");
          $query->bindValue(1, $textComment);
          $query->bindValue(2, $spoil);
          $query->bindValue(3, $_SESSION['id']);
          $query->bindValue(4, $item['media_id']);
          $query->bindValue(5, $create_at);
          $query->execute();
          $commentSended = true;
      }
      else{
        $commentFieldErr = true;
      }
    }
    else{
      $notLogin = true;
    }
  }



/////////////////////////////////////////ریکشن ها////////////////////////////////////////////////



  //ریکشن های کاربر
  $query = $conn->prepare('SELECT * FROM reactions WHERE media_id=? AND user_id=?');
  $query->bindValue(1, $item['media_id']);
  $query->bindValue(2, isset($_SESSION['id'])?$_SESSION['id']:null);
  $query->execute();
  $userReactions = $query->FetchAll(PDO::FETCH_ASSOC);
  foreach($userReactions as $reaction){}
  // var_dump($userReactions);


  //تعداد ریکشن لایک
  $query = $conn->prepare('SELECT COUNT(id) as reactionCount FROM reactions WHERE media_id=? AND type=? ');
  $query->bindValue(1, $item['media_id']);
  $query->bindValue(2, "like");
  $query->execute();
  $likeReactions = $query->FetchAll(PDO::FETCH_ASSOC);
  foreach($likeReactions as $likeReaction){}
  // var_dump($likeReaction['reactionCount']);

  //تعداد ریکشن دیسلایک
  $query = $conn->prepare('SELECT COUNT(id) as reactionCount FROM reactions WHERE media_id=? AND type=? ');
  $query->bindValue(1, $item['media_id']);
  $query->bindValue(2, "dislike");
  $query->execute();
  $dislikeReactions = $query->FetchAll(PDO::FETCH_ASSOC);
  foreach($dislikeReactions as $dislikeReaction){}
  // var_dump($dislikeReaction['reactionCount']);

  $isLiked = 0;
  $isDisliked = 0;

  //مشخص شدن ریکشن
  if(isset($reaction['type']) && $reaction['type']=="like"){
    $isLiked = 1;
  };
  if(isset($reaction['type']) && $reaction['type']=="dislike"){
    $isDisliked = 1;
  };



  //افزودن ریکشن لایک
  if(isset($_POST['likeBtn'])){
    if(isset($_SESSION['id'])){
      if(!isset($reaction['type'])){
          $query = $conn->prepare('INSERT INTO reactions SET type=?, media_id=?, user_id=?, create_at=?');
          $query->bindValue(1, "like");
          $query->bindValue(2, $item['media_id']);
          $query->bindValue(3, isset($_SESSION['id'])?$_SESSION['id']:null);
          $query->bindValue(4, "1404");
          $query->execute();
      }
      elseif(isset($reaction['type'])=="like"){
          $query = $conn->prepare('DELETE FROM reactions WHERE type=? AND media_id=? AND user_id=?');
          $query->bindValue(1, "like");
          $query->bindValue(2, $item['media_id']);
          $query->bindValue(3, isset($_SESSION['id'])?$_SESSION['id']:null);
          $query->execute();
      }
      if(isset($reaction['type'])=="dislike"){
          $query = $conn->prepare('UPDATE reactions SET type=? WHERE media_id=? AND user_id=?');
          $query->bindValue(1, "like");
          $query->bindValue(2, $item['media_id']);
          $query->bindValue(3, isset($_SESSION['id'])?$_SESSION['id']:null);
          $query->execute();
          }
      header("location:./movie.php?id=$id");
    }
    else{
      $notLogin=true;
    }
  }


  //افزودن ریکشن دیسلایک
  if(isset($_POST['dislikeBtn'])){
    if(isset($_SESSION['id'])){
      if(!isset($reaction['type'])){
          $query = $conn->prepare('INSERT INTO reactions SET type=?, media_id=?, user_id=?, create_at=?');
          $query->bindValue(1, "dislike");
          $query->bindValue(2, $item['media_id']);
          $query->bindValue(3, isset($_SESSION['id'])?$_SESSION['id']:null);
          $query->bindValue(4, "1404");
          $query->execute();
      }
      elseif(isset($reaction['type'])=="dislike"){
          $query = $conn->prepare('DELETE FROM reactions WHERE type=? AND media_id=? AND user_id=?');
          $query->bindValue(1, "dislike");
          $query->bindValue(2, $item['media_id']);
          $query->bindValue(3, isset($_SESSION['id'])?$_SESSION['id']:null);
          $query->execute();
      }
      if(isset($reaction['type'])=="like"){
          $query = $conn->prepare('UPDATE reactions SET type=? WHERE media_id=? AND user_id=?');
          $query->bindValue(1, "dislike");
          $query->bindValue(2, $item['media_id']);
          $query->bindValue(3, isset($_SESSION['id'])?$_SESSION['id']:null);
          $query->execute();
          }
      header("location:./movie.php?id=$id");
    }
    else{
      $notLogin=true;
    }
  }


?>



<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./styles/index.css" />
    <title>نام فیلم</title>
  </head>
  <style>
    .movie-info__caption{
      direction: rtl;
      display: -webkit-box !important;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .saved{
        background-color: var(--primary);
        cursor: default !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        gap: 0.5rem;
        border-radius: 10rem;
        padding: 0.3rem 1rem;
        transition: 0.4s;
    }
    .movie-bg {
      background-image: linear-gradient(
          to bottom,
          rgba(0, 0, 0, 0.1),
          var(--dark1)
        ),
        url("./assets/images/media/<?= $item['bg'] ?>");
        background-attachment: fixed;
    }

    @media (max-width: 550px) {
      .movie-bg {
        background-image: linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0),
            var(--dark1)
          ),
          url("./assets/images/media/<?= $item['cover'] ?>");
      }
    }
  </style>

  <body>
   <?php include './components/menu.php' ?>
   <?php include './components/main-bottomMenu.php' ?>


    <div class="movie-continer" id="movie">
      <div class="movie">
        <div class="movie-bg">
          <div class="movie-content" >
            <div class="movie-cover">
              <img src="./assets/images/media/<?= $item['cover'] ?>" alt="" />
            </div>
            <div class="movie-info">
              <p class="movie-info__name"><?= $item['faName'] ?></p>
              <p class="movie-info__caption"><?= $item['caption'] ?>...</p>
              <div class="movie-info__genre">
                <?php foreach($genre as $gn): ?>
                  <p><?= $gn ?></p>
                <?php endforeach; ?>
              </div>
              <div class="movie-info__moreDetail">
                <p><?= $item['ageGroup'] ?>+</p>
                <span>|</span>
                <p><?= $item['duration'] ?><span>دقیقه</span></p>
                <span>|</span>
                <p><?= $item['enDate'] ?></p>
                <span>|</span>
                <?php if($item['c480']||$item['c720']||$item['c1080']||$item['c4k']){?>
                  <p><?php {echo "زیرنویس";} ?></p>
                  <span>|</span>
                <?php } ?>
                <p><?php if($item['d480']||$item['d720']||$item['d1080']||$item['d4k']){echo "دوبله";} ?></p>
              </div>
              <div class="movie-info__btns">
                <a href="./movieTrailer.php?id=<?= $item['media_id'] ?>" class="movie-info__trailer">
                  <p>تریلر</p>
                  <i class="bx bxs-film"></i>
                </a>
                <a href="./playOnllineMovie.php?id=<?= $item['id'] ?>" class="movie-info__playOnline">
                  <p>پخش آنلاین</p>
                  <i class="bx bx-play"></i>
                </a>
              </div>
            </div>
            <div class="movie-detail">
              <?php if($saveMovie){ ?>
                <button class="saved">
                  <p>ذخیره شده</p>
                  <i class="bx bx-bookmark"></i>
                </button>
                <?php } else{ ?>
                  <form action="" method="POST">
                    <button class="seeLater" type="submit" name="saveMovie">
                      <p>بعدا میبینم</p>
                      <i class="bx bx-bookmark"></i>
                    </button>
                  </form>
                <?php } ?>

                
              <div class="movie-detail__actions">

                  <form method="POST">
                    <button type="submit" name="likeBtn" class="movie-detail__actions-like" <?= $isLiked ? 'style="background-color: var(--primary)""' : '' ?> >
                      <p><?= $likeReaction['reactionCount'] ?></p>
                      <i class="bx bx-like"></i>
                    </button>
                  </form>

                  <form method="POST">
                   <button type="submit" name="dislikeBtn" class="movie-detail__actions-dislike" <?= $isDisliked ? 'style="background-color: var(--primary)""' : '' ?> >
                     <p><?= $dislikeReaction['reactionCount'] ?></p>
                     <i class="bx bx-dislike"></i>
                   </button>
                </form>


              </div>
              <div class="movie-detail__imdb">
                <p><?= $item['imdb'] ?><span> / 10</span></p>
                <i class="bx bxl-imdb"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="container" style="padding-bottom: 5rem">
          <div class="movie-downloadLinks">
            <div class="sec-header">
              <div class="sec-header__left">
                <i class="bx bx-download header-left__icon"></i>
              </div>
              <div class="sec-header__right">
                <p class="sec-title">لینک دانلود محتواها</p>
                <p class="sec-subtitle">دانلود کن و از دیدن فیلمت لذت ببر !</p>
              </div>
            </div>
            <div
              class="accordion movie-downloadLinks__accordion"
              id="accordionExample"
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
                    <?php if($item['subscription']){ ?>
                      <div>
                        <i class='bx bx-lock-alt'></i>
                        <p>برای دانلود باید اشتراک داشته باشید.</p>
                      </div>
                    <?php } else { if($item['c480']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['c480'] ?>" download>کیفیت 480</a>
                      </div>
                      <?php } if($item['c720']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['c720'] ?>" download>کیفیت 720</a>
                      </div>
                      <?php } if($item['c1080']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['c1080'] ?>" download>کیفیت 1080</a>
                      </div>
                      <?php } if($item['c4k']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['c4k'] ?>" download>کیفیت 4k</a>
                      </div>
                    <?php } if(!$item['c480'] && !$item['c720'] && !$item['c1080'] && !$item['c4k']) { ?>
                      <div>
                        <p>برای این فیلم لینک دانلودی قرار نگرفته است.</p>
                      </div>
                    <?php }} ?>
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
                    <?php if($item['subscription']){ ?>
                      <div>
                        <i class='bx bx-lock-alt'></i>
                        <p>برای دانلود باید اشتراک داشته باشید.</p>
                      </div>
                    <?php } else { if($item['d480']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['d480'] ?>" download>کیفیت 480</a>
                      </div>
                      <?php } if($item['d720']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['d720'] ?>" download>کیفیت 720</a>
                      </div>
                      <?php } if($item['d1080']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['d1080'] ?>" download>کیفیت 1080</a>
                      </div>
                      <?php } if($item['d4k']){ ?>
                      <div class="accordion-movies">
                        <i class="bx bx-down-arrow-alt"></i>
                        <a href="./assets/movies/<?= $item['d4k'] ?>" download>کیفیت 4k</a>
                      </div>
                    <?php } if(!$item['d480'] && !$item['d720'] && !$item['d1080'] && !$item['d4k']) { ?>
                      <div>
                        <p>برای این فیلم لینک دانلودی قرار نگرفته است.</p>
                      </div>
                    <?php }} ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="movie-suggestion">
            <div class="sec-header">
              <div class="sec-header__left">
                <i class="bx bx-collection header-left__icon"></i>
              </div>
              <div class="sec-header__right">
                <p class="sec-title">فیلم های پیشنهای</p>
                <p class="sec-subtitle">از دیدن این فیلم ها هم لذت میبری !</p>
              </div>
            </div>

            <div class="swiper recommendSwiper">
              <div class="swiper-wrapper suggestionWraper">
                <?php foreach($suggestionMovies as $suggestionItem): ?>
                  <div class="swiper-slide mainSlide1">
                    <i class="bx bx-captions slide-captionIcon"></i>
                    <div class="slide-image">
                      <img src="./assets/images/media/<?= $suggestionItem['cover'] ?>" alt="" />
                      <div class="slideBtns">
                        <a href="./movieTrailer.php?id=<?= $suggestionItem['media_id'] ?>" class="trailerBtn">
                          <i class="bx bx-tv"></i>
                          <p>تریلر</p>
                        </a>
                        <a href="./movie.php?id=<?= $suggestionItem['media_id'] ?>" class="downloadBtn">
                          <i class="bx bx-download"></i>
                          <p>دانلود</p>
                        </a>
                      </div>
                    </div>
                    <div class="slide-infos">
                      <p class="infos-ENGname"><?= $suggestionItem['enName'] ?></p>
                      <p class="infos-FAname"><?= $suggestionItem['enName'] ?></p>
                      <p class="infos-rate"><?= $suggestionItem['imdb'] ?> <span> / 10</span></p>
                      <p class="infos-time"><?= $suggestionItem['duration'] ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="movie-comments">
            <div class="sec-header">
              <div class="sec-header__left">
                <i class="bx bx-chat header-left__icon"></i>
              </div>
              <div class="sec-header__right">
                <p class="sec-title">دیدگاه های شما</p>
                <p class="sec-subtitle">
                  نظرات کاربران را درباره این فیلم دست کم نگیرید !
                </p>
              </div>
            </div>

            <div class="comments">
              <form method="POST">
                <label for="">متن دیدگاه :</label>
                <textarea
                  placeholder="دیدگاه خود را درباره این فیلم بنویسید..."
                  name="textComment"
                  require
                ></textarea>
                <div>
                  <input type="checkbox" value="1" name="spoil"/>
                  <p>حاوی اسپویل</p>
                </div>
                <button type="submit" name="sendComment">ارسال دیدگاه</button>
              </form>

              <div class="comments-content">
                <ul>
                  <?php if($comments){foreach($comments as $comment): ?>
                  <li>
                    <div class="comments-content__userInfo">
                      <div class="comments-content__userInfo-img">
                        <img src="./assets/images/<?= $comment['image'] ?>" alt="<?= $comment['username'] ?>" />
                        <?php if(!$comment['role']==0){ ?>
                        <i class="bx bx-check-shield"></i>
                        <?php } ?>
                      </div>
                      <div>
                        <p><?= $comment['username'] ?></p>
                        <p><?php if($comment['role']==0){echo 'کاربر عادی';}elseif($comment['role']==1){echo 'ادمین پوفوفیلم';}elseif($comment['role']==2){echo 'مالک پوفوفیلم';} ?></p>
                      </div>
                    </div>
                    <div class="comments-content__text"><?= $comment['text'] ?></div>
                    <div class="comments-content__date">
                      <p><?= $comment['create_at'] ?></p>
                    </div>
                    <?php if($comment['spoil']){ ?>
                    <div class="spoil">
                      <p>این دیدگاه حاوی اسپویل فیلم است !</p>
                      <button class="spoilBtn">نمایش</button>
                    </div>
                    <?php } ?>
                  </li>
                  <?php endforeach;} else{ ?>
                    <p>هنوز دیدگاهی برای این فیلم گذاشته نشده است</p>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <br />
        <!-- <a href="https://t.me/share/url?url=https://rasam.agency/persona" target="_blank">اشتراک گذاری</a> -->
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="./js/index.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if($success){ ?>
      Swal.fire({
        title: "فیلم ذخیره شد",
        text: "میتونی از پنل کاربریت به بخش ذخیره شده ها دسترسی داشته باشی !",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        // location = './panel/profile.php';
      }, 2000);
      <?php } ?>
      <?php if($notLogin){ ?>
      Swal.fire({
        title: "خطا هنگام ذخیره فیلم",
        text: "باید ابتدا وارد سایت بشی یا ثبت نام کنی !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
      <?php if($commentFieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ارسال دیدگاه",
        text: "لطفا برای دیدگاه خود متنی اضافه کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
      <?php if($commentSended){ ?>
      Swal.fire({
        title: "کامنت ارسال شد",
        text: "دیدگاه شما بعد از تایید ادمین ها نمایش داده میشود !",
        icon: "success",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
  </body>
</html>
