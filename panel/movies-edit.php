<?php
include '../server/PDO.php';
session_start();

$id = $_GET['id'];

$query = $conn->prepare('SELECT * FROM movies WHERE media_id=?');
$query->bindValue(1, $id);
$query->execute();
$movies = $query->FetchAll(PDO::FETCH_ASSOC);

$success=false;
$fieldErr=false;

if(isset($_POST['editMovie'])){
  $faName = $_POST['faName'];
  $enName = $_POST['enName'];
  $faDate = $_POST['faDate'];
  $enDate = $_POST['enDate'];
  $duration = $_POST['duration'];
  $imdb = $_POST['imdb'];
  $ageGroup = $_POST['ageGroup'];
  $category = $_POST['category'];
  $genre = $_POST['genre'];
  $caption = $_POST['caption'];
  $cover = $_FILES['cover']['name'];
  $bg = $_FILES['bg']['name'];
  $trailer = $_FILES['trailer']['name'];
  $d480 = $_FILES['d480']['name'];
  $d720 = $_FILES['d720']['name'];
  $d1080 = $_FILES['d1080']['name'];
  $d4k = $_FILES['d4k']['name'];  
  $c480 = $_FILES['c480']['name'];
  $c720 = $_FILES['c720']['name'];
  $c1080 = $_FILES['c1080']['name'];
  $c4k = $_FILES['c4k']['name'];
  $subscription = isset($_POST['subscription']) ? 1 : 0;

  if($faName && $enName && $faDate && $enDate && $duration && $imdb && $ageGroup && $category && $genre && $caption && $cover && $bg){
    $query = $conn->prepare("UPDATE movies SET media_id=?, faName=?, enName=? ,faDate=?, enDate=? ,duration=? ,imdb=? ,ageGroup=? ,category=? ,genre=? ,caption=? ,cover=? ,bg=? ,trailer=? ,d480=? ,d720=?, d1080=?, d4k=? ,c480=? ,c720=? ,c1080=? ,c4k=?, subscription=? WHERE media_id=?");
    $query->bindValue(1, $id);
    $query->bindValue(2, $faName);
    $query->bindValue(3, $enName);
    $query->bindValue(4, $faDate);
    $query->bindValue(5, $enDate);
    $query->bindValue(6, $duration);
    $query->bindValue(7, $imdb);
    $query->bindValue(8, $ageGroup);
    $query->bindValue(9, $category);
    $query->bindValue(10, $genre);
    $query->bindValue(11, $caption);
    $query->bindValue(12, $cover);
    $query->bindValue(13, $bg);
    $query->bindValue(14, $trailer);
    $query->bindValue(15, $d480);
    $query->bindValue(16, $d720);
    $query->bindValue(17, $d1080);
    $query->bindValue(18, $d4k);
    $query->bindValue(19, $c480);
    $query->bindValue(20, $c720);
    $query->bindValue(21, $c1080);
    $query->bindValue(22, $c4k);
    $query->bindValue(23, $subscription);
    $query->bindValue(24, $id);
    $query->execute();

    move_uploaded_file($_FILES["cover"]["tmp_name"], "../assets/images/media/".$_FILES['cover']['name']);

    move_uploaded_file($_FILES["bg"]["tmp_name"], "../assets/images/media/".$_FILES['bg']['name']);

    move_uploaded_file($_FILES["trailer"]["tmp_name"], "../assets/movies/".$_FILES['trailer']['name']);

    move_uploaded_file($_FILES["d480"]["tmp_name"], "../assets/movies/".$_FILES['d480']['name']);
    move_uploaded_file($_FILES["d720"]["tmp_name"], "../assets/movies/".$_FILES['d720']['name']);
    move_uploaded_file($_FILES["d1080"]["tmp_name"], "../assets/movies/".$_FILES['d1080']['name']);
    move_uploaded_file($_FILES["d4k"]["tmp_name"], "../assets/movies/".$_FILES['d4k']['name']);

    move_uploaded_file($_FILES["c480"]["tmp_name"], "../assets/movies/".$_FILES['c480']['name']);
    move_uploaded_file($_FILES["c720"]["tmp_name"], "../assets/movies/".$_FILES['c720']['name']);
    move_uploaded_file($_FILES["c1080"]["tmp_name"], "../assets/movies/".$_FILES['c1080']['name']);
    move_uploaded_file($_FILES["c4k"]["tmp_name"], "../assets/movies/".$_FILES['c4k']['name']);

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
  <title>فیلم جدید</title>
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
              <?php foreach($movies as $movie): ?>
              <div>
                <label for="name">نام فیلم (فارسی) : </label>
                <input type="text" value="<?= $movie['faName'] ?>" name="faName" placeholder="از جانب" />
              </div>
              <div>
                <label for="name">نام فیلم (انگلیسی) : </label>
                <input type="text" value="<?= $movie['enName'] ?>" name="enName" placeholder="from" />
              </div>
              <div>
                <label for="name">سال ساخت (میلادی) : </label>
                <input type="text" value="<?= $movie['faDate'] ?>" name="faDate" placeholder="2024" />
              </div>
              <div>
                <label for="name">سال ساخت (شمسی) : </label>
                <input type="text" value="<?= $movie['enDate'] ?>" name="enDate" placeholder="1403" />
              </div>
              <div>
                <label for="name">زمان : </label>
                <input type="text" value="<?= $movie['duration'] ?>" name="duration" placeholder="106 دقیقه" />
              </div>
              <div>
                <label for="name">imdb : </label>
                <input type="text" value="<?= $movie['imdb'] ?>" name="imdb" placeholder="7.5" />
              </div>
              <div>
                <label for="name">رده سنی : </label>
                <input type="text" value="<?= $movie['ageGroup'] ?>" name="ageGroup" placeholder="15 سال" />
              </div>
              <div>
                <label for="name">موضوع یا سبک : </label>
                <input type="text" value="<?= $movie['category'] ?>" name="category" placeholder="زامبی (پیشنهاد شده ها)" />
              </div>
              <div>
                <label for="name">ژانر ها : </label>
                <input type="text" value="<?= $movie['genre'] ?>" name="genre" placeholder="اکشن-معمایی-درام" />
              </div>
              <div>
                <label for="name">توضیحات : </label>
                <input type="text" value="<?= $movie['caption'] ?>" name="caption" placeholder="متنی خلاصه درباره فیلم..." />
              </div>
              <div>
                <label for="name">کاور : </label>
                <input type="file" value="<?= $movie['cover'] ?>" name="cover" />
              </div>
              <div>
                <label for="name">پس زمینه : </label>
                <input type="file" value="<?= $movie['bg'] ?>" name="bg" />
              </div>
              <div>
                <label for="name">تریلر : </label>
                <input type="file" value="<?= $movie['trailer'] ?>" name="trailer" />
              </div>
              <div>
                <label for="name">دوبله 480 : </label>
                <input type="file" value="<?= $movie['d480'] ?>" name="d480" />
              </div>
              <div>
                <label for="name">دوبله 720 : </label>
                <input type="file" value="<?= $movie['d720'] ?>" name="d720" />
              </div>
              <div>
                <label for="name">دوبله 1080 : </label>
                <input type="file" value="<?= $movie['d1080'] ?>" name="d1080" />
              </div>
              <div>
                <label for="name">دوبله 4k : </label>
                <input type="file" value="<?= $movie['d4k'] ?>" name="d4k" />
              </div>
              <div>
                <label for="name">زیرنویس 480 : </label>
                <input type="file" value="<?= $movie['c480'] ?>" name="c480" />
              </div>
              <div>
                <label for="name">زیرنویس 720 : </label>
                <input type="file" value="<?= $movie['c720'] ?>" name="c720" />
              </div>
              <div>
                <label for="name">زیرنویس 1080 : </label>
                <input type="file" value="<?= $movie['c1080'] ?>" name="c1080" />
              </div>
              <div>
                <label for="name">زیرنویس 4k : </label>
                <input type="file" value="<?= $movie['c4k'] ?>" name="c4k" />
              </div>
            </div>
            <div style="display: flex; flex-direction: row; gap: 0.5rem;margin-top: 1rem;">
              <label for="name">اشتراکی : </label>
              <input type="checkbox" name="subscription"<?= $movie['subscription'] ? 'checked' : '' ?>  style="width: 1rem" />
            </div>
            <?php endforeach; ?>

            <button type="submit" name="editMovie">
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
        title: "ویرایش فیلم",
        text: "فیلم با موفقیت ویرایش شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        location = './movies-show.php';
      }, 2000);
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ایجاد فیلم جدید",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>