<?php
include '../server/PDO.php';
include '../jdf.php';
session_start();

$success=false;
$fieldErr=false;

if(isset($_POST['addSeries'])){
  $faName = $_POST['faName'];
  $enName = $_POST['enName'];
  $faDate = $_POST['faDate'];
  $enDate = $_POST['enDate'];
  $imdb = $_POST['imdb'];
  $ageGroup = $_POST['ageGroup'];
  $category = $_POST['category'];
  $genre = $_POST['genre'];
  $caption = $_POST['caption'];
  $cover = $_FILES['cover']['name'];
  $bg = $_FILES['bg']['name'];
  $create_at = jdate("l, d F Y");

  if($faName && $enName && $faDate && $enDate && $imdb && $ageGroup && $category && $genre && $caption && $cover && $bg){
    $query = $conn->prepare("INSERT INTO series SET media_id=?, faName=?, enName=? ,faDate=?, enDate=? ,imdb=? ,ageGroup=? ,category=? ,genre=? ,caption=? ,cover=? ,bg=? ,create_at=?");
    $query->bindValue(1, rand(1000000,9999999));
    $query->bindValue(2, $faName);
    $query->bindValue(3, $enName);
    $query->bindValue(4, $faDate);
    $query->bindValue(5, $enDate);
    $query->bindValue(6, $imdb);
    $query->bindValue(7, $ageGroup);
    $query->bindValue(8, $category);
    $query->bindValue(9, $genre);
    $query->bindValue(10, $caption);
    $query->bindValue(11, $cover);
    $query->bindValue(12, $bg);
    $query->bindValue(13, $create_at);
    $query->execute();

    move_uploaded_file($_FILES["cover"]["tmp_name"], "../assets/images/media/".$_FILES['cover']['name']);
    move_uploaded_file($_FILES["bg"]["tmp_name"], "../assets/images/media/".$_FILES['bg']['name']);

    $success=true;
  }
  else{
    $fieldErr=true;
  }
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
  <title>سریال جدید</title>
</head>

<body style="z-index: -99999999999999999999999 !important;">
  <div class="bgl"></div>

  <div class="dashboard" style="z-index: -99999999999999999999999 !important;">
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
    <?php include './components/panel-header.php' ?>
    
      <div class="dashboard-content information">
        <form method="POST" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" enctype="multipart/form-data">
          <p>سریال جدید</p>
          <div>
            <div>
              <label for="name">نام فارسی : </label>
              <input type="text" name="faName" placeholder="از جانب" />
            </div>
            <div>
              <label for="name">نام انگلیسی : </label>
              <input type="text" name="enName" placeholder="from" />
            </div>
            <div>
              <label for="name">سال تولید شمسی : </label>
              <input type="text" name="faDate" placeholder="1398" />
            </div>
            <div>
              <label for="name">سال تولید میلادی : </label>
              <input type="text" name="enDate" placeholder="2017" />
            </div>
            <div>
              <label for="name">ژانر ها : </label>
              <input type="text" name="genre" placeholder="ترسناک-معمایی-درام" />
            </div>
            <div>
              <label for="name">imdb : </label>
              <input type="text" name="imdb" placeholder="7.3" />
            </div>
            <div>
              <label for="name">سبک یا موضوع : </label>
              <input type="text" name="category" placeholder="زامبی" />
            </div>
            <div>
              <label for="name">محدودیت سنی : </label>
              <input type="text" name="ageGroup" placeholder="+12" />
            </div>
            <div>
              <label for="name">توضیحات : </label>
              <input type="text" name="caption" placeholder="متنی خلاصه درباره سریال..." />
            </div>
            <div>
              <label for="name">کاور : </label>
              <input type="file" name="cover" placeholder="mmd123" />
            </div>
            <div>
              <label for="name">پس زمینه : </label>
              <input type="file" name="bg" placeholder="mmd123" />
            </div>
          </div>
          <button type="submit" name="addSeries">
            <i class="bx bx-check"></i>
            <p>اضافه کردن</p>
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
    AOS.init();
  </script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if($success){ ?>
      Swal.fire({
        title: "سریال جدید",
        text: "سریال با موفقیت ایجاد شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        // location = './panel/profile.php';
      }, 2000);
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ایجاد سریال جدید",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>