<?php
  include "./server/PDO.php";
  session_start();

  $success = false;
  $notFound = false;


  if(isset($_POST['subBtn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query = $conn->prepare('SELECT * FROM users WHERE email=? AND password=?');
    $query->bindValue(1, $email);
    $query->bindValue(2, $password);
    $query->execute();
    $users = $query->FetchAll(PDO::FETCH_ASSOC);

    if($query->rowCount() >= 1){
        foreach($users as $user){
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $success = true;
      }
    }
    else{
       $notFound = true;
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
  <title>ورود</title>
</head>

<body>
  <?php include './components/menu.php' ?>

  <?php include './components/main-bottomMenu.php' ?>

  <div class="login-container">
    <h1 class="logo">پوفوفیلم</h1>
    <form method="POST" class="login-form">
      <h2 class="login-title">ورود</h2>
      <h5 class="login-subtitle">
        حسابی برای ورود ندارید؟<a href="./register.php">ثبت نام</a>
      </h5>

      <div>
        <input type="email" name="email" class="emailLogin" placeholder="ایمیل" />
        <i class="bi bi-envelope"></i>
      </div>

      <div>
        <input type="password" name="password" class="passwordLogin" placeholder="رمز عبور" />
        <i class="bi bi-shield-lock"></i>
      </div>

      <div>
        <button class="login-btn" type="submit" name="subBtn">ادامه</button>
      </div>
    </form>
    <p class="login-footer">
      با عضویت در سایت، تمامی قوانین و شرایط استفاده از خدمات
      <a href="./index.html">پوفوفیلم</a> را پذیرفته اید.
    </p>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if($success){ ?>
      Swal.fire({
        title: "ورود به پوفوفیلم",
        text: "! به سایت فیلم و سریال ما خوش امدید",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        location = './panel/information-show.php';
      }, 2000);
      <?php } ?>
      <?php if($notFound){ ?>
      Swal.fire({
        title: "خطا هنگام ورود",
        text: "! کاربری با این مشخصات پیدا نشد",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>