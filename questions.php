<?php
include "./server/PDO.php";
session_start();

$query = $conn->prepare('SELECT * FROM questions');
$query->execute();
$questions = $query->FetchAll(PDO::FETCH_ASSOC);

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
  <link rel="stylesheet" href="./styles/index.css">
  <title>سوالات متداول</title>
</head>

<body>

  <?php include './components/menu.php' ?>

   <?php include './components/main-bottomMenu.php' ?>


  <div class="questions-container">
    <div class="sec-header" style="margin-top: 5rem">
      <div class="sec-header__left">
        <i class='bx bx-question-mark header-left__icon'></i>
      </div>
      <div class="sec-header__right">
        <p class="sec-title">جواب سوالات شما</p>
        <p class="sec-subtitle">میتوانید جواب سوالات خود را بگیرید !</p>
      </div>
    </div>
    <div class="questions">
      <div class="accordion" id="accordionExample">
        <?php foreach($questions as $question): ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading<?= $question['id'] ?>">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapse<?= $question['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $question['id'] ?>">
             <?= $question['question'] ?>
            </button>
          </h2>
          <div id="collapse<?= $question['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $question['id'] ?>"
            data-bs-parent="#accordionExample">
            <div class="accordion-body"> <?= $question['anwser'] ?> </div>
          </div>
        </div>
        <?php endforeach; ?>
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



  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>

</body>

</html>