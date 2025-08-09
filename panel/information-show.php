<?php
session_start();

require_once "../server/PDO.php";
$pageName = "information-show";

$success = false;

$result = $conn->prepare('SELECT * FROM users WHERE id=?');
$result->bindValue(1, $_SESSION['id']);
$result->execute();
$users = $result->FetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['changeProfile'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];
    
  $result = $conn->prepare('UPDATE users SET username=?, email=?, password=?, image=? WHERE id=?');
  $result->bindValue(1, $username);
  $result->bindValue(2, $email);
  $result->bindValue(3, $password);
  $result->bindValue(4, $image);
  $result->bindValue(5, $_SESSION['id']);
  $result->execute();

  $success = true;
  move_uploaded_file($_FILES["image"]["tmp_name"], "../assets/images/users/".$_FILES['image']['name']);
}
?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="./styles/index.css" />
  <title>نمایش اطلاعات</title>
</head>
<body >
  <div class="bgl"></div>

  <div class="dashboard">
    <div class="dashboard-sidebar active">
     <div style="display: flex; align-items: center;justify-content: space-between;">
         <a href="../index.php" class="logo">پوفوفیلم</a>
         <p style="font-size: 1.5rem; cursor: pointer;margin-left: .5rem;" onclick="dashboardSidebar.classList.remove('active');bgl.classList.remove('active')">×</p>
      </div>
      <div class="accordion dashboard-accordion" id="accordionExample">
         <?php include './components/panel-sidbar.php' ?>
      </div>
    </div>
    <div class="dashboard-main">
      <?php include "./components/panel-header.php"; ?>
      <div class="dashboard-content information">
        <form method="POST" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" enctype="multipart/form-data">
          <p>اطلاعات شخصی شما</p>
          <div>
            <?php foreach($users as $user){ ?>
            <div >
              <label for="name">آیدی عددی : </label>
              <input type="text" placeholder="1032625681" disabled value="<?=$user['id']?>" />
            </div>
            <div >
              <label for="name">نام کاربری : </label>
              <input type="text" placeholder="mohammad"  name="username" value="<?=$user['username']?>"/>
            </div>
            <div >
              <label for="name">ایمیل : </label>
              <input type="text" placeholder="mohammad@gmail.com"  name="email" value="<?=$user['email']?>" />
            </div>
            <div >
              <label for="name">رمز عبور : </label>
              <input type="text" placeholder="mmd123"  name="password" value="<?=$user['password']?>" />
            </div>
            <div>
              <label for="name">پروفایل : </label>
              <input type="file" name="image" value="<?=$user['image']?>" />
            </div>
            <?php } ?>
          </div>
          <button name="changeProfile" type="submit" >
            <i class="bx bx-edit"></i>
            <p>ویرایش کردن</p>
          </button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="./js/script.js"></script>
  <script>
    AOS.init({
      once:true
    });
  </script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if($success){ ?>
      Swal.fire({
        title: "ویرایش پروفایل",
        text: "پروفایل با موفقیت ویرایش شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>