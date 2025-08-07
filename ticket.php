<?php
  include './server/PDO.php';
  include './jdf.php';
  session_start();
  $success=false;
  $fieldErr=false;
  $isLogin=false;

  if(isset($_POST['sendTicket'])){
    $fullName = $_POST['fullName'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $create_at = "1404";
    
    if(isset($_SESSION['email'])){
      if($fullName && $subject && $content){
        $query=$conn->prepare("INSERT INTO tickets SET user_email=?, fullName=?, subject=?, content=?, create_at=?");
        $query->bindValue(1, $_SESSION['email']);
        $query->bindValue(2,$fullName);
        $query->bindValue(3,$subject);
        $query->bindValue(4,$content);
        $query->bindValue(5, jdate("l, d F Y"));
        $query->execute();
        $success=true;
      }
      else{
        $fieldErr=true;
      }
    }
    else{
      $isLogin=true;
    }
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
  <title>تیکت به پشتیبانی</title>
</head>

<body>
  <?php include './components/menu.php' ?>
  <?php include './components/main-bottomMenu.php' ?>


  <div class="formbold-main-wrapper">
    <div class="formbold-form-wrapper">
      <h1 class="formbold-logo">پوفوفیلم</h1>
      <p class="formbold-title">تیکت زدن به پشتیبانی</p>
      <form method="POST">

        <div class="formbold-input-flex">
          <div>
            <input type="fullName" name="fullName" id="fullName" placeholder="jhon@mail.com" class="formbold-form-input" />
            <label for="fullName" class="formbold-form-label">نام و نام خانوادگی</label>
          </div>
          <div>
            <input type="text" name="subject" id="subject" placeholder="مثال : تاخیر در فعال سازی اشتراک"
              class="formbold-form-input" />
            <label for="subject" class="formbold-form-label">موضوع تیکت</label>
          </div>
        </div>

        <div class="formbold-textarea">
          <textarea rows="6" name="content" id="content" placeholder="توضیحی درباره تیکت بنویسید..."
            class="formbold-form-input"></textarea>
          <label for="content" class="formbold-form-label">متن تیکت</label>
        </div>

        <button class="formbold-btn" name="sendTicket">ارسال</button>
      </form>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if($success){ ?>
      Swal.fire({
        title: "ارسال موفقیت آمیز",
        text: "تیکت شما ارسال شد، لطفا صبوری کنید !",
        icon: "success",
        confirmButtonText: "باشه",
      });
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ارسال تیکت",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
       <?php if($isLogin){ ?>
      Swal.fire({
        title: "خطا هنگام ارسال تیکت",
        text: "ابتدا باید وارد شوید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>