<?php
session_start();

include "./server/PDO.php";
$pageName = "register";

$success = false;
$emptyErr = false;
$usernameErr = false;
$emailErr = false;
$passwordErr = false;
$passwordMatch = false;
$userColor = null;

if(isset($_POST['sub'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(!empty($username) && !empty($email) && !empty($password)){
    $query=$conn->prepare("SELECT * FROM users WHERE email=?");
    $query->bindValue(1, $email);
    $query->execute();
    $userEmail=$query->fetchAll();  

    if(!$userEmail){
      $query2=$conn->prepare("SELECT * FROM users WHERE username=?");
      $query2->bindValue(1, $username);
      $query2->execute();
      $user_name=$query2->fetchAll();

      if(!$user_name){
        if(strlen($password) >= 6){
          $query=$conn->prepare("INSERT INTO users SET username=?, email=? ,password=?");
          $query->bindValue(1,$username);
          $query->bindValue(2,$email);
          $query->bindValue(3,$password);
          $query->execute();

          $success = true;
        }
        else{
          $passwordErr = true;
        }
      }
      else{
        $usernameErr = true;
      }
    }
    else{
      $emailErr = true;
    }
  }
  else{
    $emptyErr = true;
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
  <link rel="stylesheet" href="./styles/index.css">
  <title>ثبت نام</title>
</head>

<body>

 <?php include './components/menu.php' ?>

   <?php include './components/main-bottomMenu.php' ?>


  <div class="register-container">
    <h1 class="logo">پوفوفیلم</h1>
    <form method="post" action="register.php" class="register-form">
      <h2 class="register-title">ثبت نام</h2>
      <h5 class="register-subtitle">
        قبلا ثبت نام کرده اید؟<a href="./login.php">ورود</a>
      </h5>

      <input type="hidden" name="userColor" id="userColor" value="">

      <div>
        <input type="text" name="username" class="emailregister" placeholder="نام کاربری" />
        <i class="bi bi-envelope"></i>
      </div>
      <div>
        <input type="email" name="email" class="emailregister" placeholder="ایمیل" />
        <i class="bi bi-envelope"></i>
      </div>

      <div>
        <input type="password" name="password" class="passwordregister" placeholder="رمز عبور" />
        <i class="bi bi-shield-lock"></i>
      </div>

      <div>
        <button class="register-btn" type="submit" name="sub">ادامه</button>
      </div>
    </form>
    <p class="register-footer">
      با عضویت در سایت، تمامی قوانین و شرایط استفاده از خدمات
      <a href="./index.php">پوفوفیلم</a> را پذیرفته اید.
    </p>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if($success){ ?>
        <script>
           Swal.fire({
                    title: "ثبت نام موفقیت آمیز",
                    text: "اطلاعات شما در پایگاه داده ثبت شد !",
                    icon: "success"
                });
                
            setTimeout(() => {
              location = "./login.php"
            }, 2000);
        </script>
    <?php } ?>
    <?php if($emptyErr){ ?>
        <script>
           Swal.fire({
                    title: "خطا هنگام ثبت نام",
                    text: "فیلد ها را به طور کامل پر کنید !",
                    icon: "error"
                });
        </script>
    <?php } ?>
    <?php if($usernameErr){ ?>
        <script>
           Swal.fire({
                    title: "خطا هنگام ثبت نام",
                    text: "نام کاربری وارد شده قبلا استفاده شده است !",
                    icon: "error"
                });
        </script>
    <?php } ?>
    <?php if($emailErr){ ?>
        <script>
           Swal.fire({
                    title: "خطا هنگام ثبت نام",
                    text: "ایمیل وارد شده قبلا استفاده شده است !",
                    icon: "error"
                });
        </script>
    <?php } ?>
    <?php if($passwordErr){ ?>
        <script>
           Swal.fire({
                    title: "خطا هنگام ثبت نام",
                    text: "رمز عبور باید حدقل 6 کاراکتر باشد !",
                    icon: "error"
                });
        </script>
    <?php } ?>

</body>

</html>