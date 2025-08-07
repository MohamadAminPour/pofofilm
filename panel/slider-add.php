<?php

include '../server/PDO.php';
include '../jdf.php';
session_start();

$success=false;
$fieldErr=false;

$query = $conn->prepare('SELECT * FROM movies');
$query->execute();
$movies = $query->FetchAll(PDO::FETCH_ASSOC);

$query = $conn->prepare('SELECT * FROM series');
$query->execute();
$series = $query->FetchAll(PDO::FETCH_ASSOC);

$medias = [...$series,...$movies];


if(isset($_POST['addSlider'])){
  $media_id = $_POST['media_id'];
  $create_at = jdate("l, d F Y");

  if($media_id){
    $query = $conn->prepare("INSERT INTO slider SET media_id=? ,create_at=?");
    $query->bindValue(1, $media_id);
    $query->bindValue(2, $create_at);
    $query->execute();

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
    <title>اسلایدر جدید</title>
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
          
            <div class="dashboard-content information">
                <form method="POST" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <p>اسلاید جدید</p>
                    <div>
                        <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                            <label for="name">فیلم یا سریال مورد نظر: </label>
                            <select name="media_id">
                                <option value="0">
                                    یک گزینه را انتخاب کنید
                                </option>
                                <?php foreach($medias as $media): ?>
                                <option value="<?= $media['media_id'] ?>">
                                    <?= $media['faName'].' - '.$media['enName'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="addSlider" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
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
        title: "اسلایدر جدید",
        text: "اسلایدر با موفقیت ایجاد شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        // location = './panel/profile.php';
      }, 2000);
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ایجاد اسلایدر جدید",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>