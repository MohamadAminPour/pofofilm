<?php

include '../server/PDO.php';

$success=false;
$fieldErr=false;
session_start();


$result = $conn->prepare('SELECT * FROM series');
$result->execute();
$series = $result->FetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['addSeason'])){
  $seriesId = $_POST['seriesId'];
  $number = $_POST['number'];
  $trailer = $_FILES['trailer']['name'];
  $language = $_POST['language'];
  $subscription = isset($_POST['subscription']) ? 1 : 0;
  $create_at = "1404/09/12";

  if($seriesId && $number && $trailer && $language){
    $query = $conn->prepare("INSERT INTO seasones SET series_media_id=?, seasoneNum=?, trailer=? ,subscription=?, language=?, create_at=?");
    $query->bindValue(1, $seriesId);
    $query->bindValue(2, $number);
    $query->bindValue(3, $trailer);
    $query->bindValue(4, $subscription);
    $query->bindValue(5, $language);
    $query->bindValue(6, $create_at);
    $query->execute();

    move_uploaded_file($_FILES["trailer"]["tmp_name"], "../assets/movies/".$_FILES['trailer']['name']);

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
  <title>فصل جدید</title>
</head>

<body>
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
  <?php include './components/panel-header.php' ?>
  
      <div class="dashboard-content information">
        <form method="POST" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" enctype="multipart/form-data">
          <p>فصل جدید</p>
          <div>
            <div>
              <label for="name">سریال مرتبط : </label>
              <select name="seriesId">
                <option value="0">انتخاب کنید</option>
                <?php foreach($series as $item): ?>
                   <option value="<?= $item['media_id'] ?>"><?= $item['faName'] ?> - <?= $item['enName'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div>
              <label for="number">فصل چند : </label>
              <input type="text" name="number" placeholder="مثال : 1" />
            </div>

            <div>
              <label for="trailer">تریلر : </label>
              <input type="file" name="trailer" />
            </div>

            <div>
             <label for="language">زبان : </label>
             <select name="language" id="language">
               <option value="sub">زیرنویس فارسی</option>
               <option value="dub">دوبله فارسی</option>
             </select>
            </div>

          </div>


          <div style="display: flex; flex-direction: row; gap: 0.5rem; margin-top: 1rem;">
            <label for="subscription">اشتراکی : </label>
            <input type="checkbox" name="subscription" value="1" style="width: 1rem" />
          </div>


          <button type="submit" name="addSeason">
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
        title: "فصل جدید سریال",
        text: "فصل با موفقیت ایجاد شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        // location = './panel/profile.php';
      }, 2000);
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ایجاد فصل جدید",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>