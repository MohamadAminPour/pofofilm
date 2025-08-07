<?php

include '../server/PDO.php';

$id = $_GET['id'];
session_start();

$query = $conn->prepare('SELECT * FROM series WHERE media_id=?');
$query->bindValue(1, $id);
$query->execute();
$series = $query->FetchAll(PDO::FETCH_ASSOC);
// var_dump($series);

$success=false;
$fieldErr=false;

if(isset($_POST['editSeries'])){
  $faName = $_POST['faName'];
  $enName = $_POST['enName'];
  $faDate = $_POST['faDate'];
  $enDate = $_POST['enDate'];
  $genre = $_POST['genre'];
  $imdb = $_POST['imdb'];
  $ageGroup = $_POST['ageGroup'];
  $category = $_POST['category'];
  $caption = $_POST['caption'];
  $cover = $_FILES['cover']['name'];
  $bg = $_FILES['bg']['name'];

  if($faName && $enName && $faDate && $enDate && $imdb && $ageGroup && $category && $genre && $caption && $cover && $bg){
    $query = $conn->prepare("UPDATE series SET faName=?, enName=? ,faDate=?, enDate=?, genre=? ,imdb=? ,ageGroup=? ,category=? ,caption=? ,cover=? ,bg=? WHERE media_id=?");
    $query->bindValue(1, $faName);
    $query->bindValue(2, $enName);
    $query->bindValue(3, $faDate);
    $query->bindValue(4, $enDate);
    $query->bindValue(5, $genre);
    $query->bindValue(6, $imdb);
    $query->bindValue(7, $ageGroup);
    $query->bindValue(8, $category);
    $query->bindValue(9, $caption);
    $query->bindValue(10, $cover);
    $query->bindValue(11, $bg);
    $query->bindValue(12, $id);
    $query->execute();

    move_uploaded_file($_FILES["cover"]["tmp_name"], "../assets/images/".$_FILES['cover']['name']);
    move_uploaded_file($_FILES["bg"]["tmp_name"], "../assets/images/".$_FILES['bg']['name']);

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
     <a href="../index.php" class="logo">پوفوفیلم</a>
      <div class="accordion dashboard-accordion" id="accordionExample">
         <?php include './components/panel-sidbar.php' ?>
      </div>
    </div>
    <div class="dashboard-main">
     <?php include './components/panel-header.php' ?>
     
      <div class="dashboard-content">
        <div class="movies">
          <form method="POST" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" enctype="multipart/form-data">
            <p>ویرایش فیلم</p>
            <div>
              <?php foreach($series as $item): ?>
              <div>
                <label for="name">نام فیلم (فارسی) : </label>
                <input type="text" value="<?= $item['faName'] ?>" name="faName" />
              </div>
              <div>
                <label for="name">نام فیلم (انگلیسی) : </label>
                <input type="text" value="<?= $item['enName'] ?>" name="enName"  />
              </div>
              <div>
                <label for="name">سال ساخت (میلادی) : </label>
                <input type="text" value="<?= $item['faDate'] ?>" name="faDate"/>
              </div>
              <div>
                <label for="name">سال ساخت (شمسی) : </label>
                <input type="text" value="<?= $item['enDate'] ?>" name="enDate" />
              </div>
              <div>
                <label for="name">زمان : </label>
                <input type="text" value="<?= $item['genre'] ?>" name="genre" />
              </div>
              <div>
                <label for="name">imdb : </label>
                <input type="text" value="<?= $item['imdb'] ?>" name="imdb" />
              </div>
              <div>
                <label for="name">رده سنی : </label>
                <input type="text" value="<?= $item['ageGroup'] ?>" name="ageGroup" />
              </div>
              <div>
                <label for="name">موضوع یا سبک : </label>
                <input type="text" value="<?= $item['category'] ?>" name="category"  />
              </div>
              <div>
                <label for="name">توضیحات : </label>
                <input type="text" value="<?= $item['caption'] ?>" name="caption" />
              </div>
              <div>
                <label for="name">کاور : </label>
                <input type="file" value="<?= $item['cover'] ?>" name="cover" />
              </div>
              <div>
                <label for="name">پس زمینه : </label>
                <input type="file" value="<?= $item['bg'] ?>" name="bg" />
              </div>
            </div>
            <?php endforeach; ?>

            <button type="submit" name="editSeries">
              <i class="bx bx-check"></i>
              <p>ویرایش کردن</p>
            </button>
          </form>
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
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      <?php if($success){ ?>
      Swal.fire({
        title: "ویرایش سریال",
        text: "سریال با موفقیت ویرایش شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        location = './series-show.php';
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