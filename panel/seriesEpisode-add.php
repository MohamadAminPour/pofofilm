<?php

include '../server/PDO.php';
include '../jdf.php';
session_start();


$success=false;
$fieldErr=false;

$query = $conn->prepare("SELECT * FROM series");
$query->execute();
$series = $query->FetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['addEpisode'])){
  $series_id = $_POST['series_id'];
  $seasons_id = $_POST['seasons'];
  $episodeNum = $_POST['episodeNum'];
  $duration = $_POST['duration'];
  $px480 = $_FILES['px480']['name'];
  $px720 = $_FILES['px720']['name'];
  $px1080 = $_FILES['px1080']['name'];
  $px4k = $_FILES['px4k']['name'];  
  $create_at = jdate("l, d F Y");


  if($series_id && $seasons_id && $episodeNum && $duration){
    $query = $conn->prepare("INSERT INTO episodes SET series_media_id=?, season_id=?, episodeNum=?, px480=?, px720=?, px1080=?, px4k=?, duration=?, create_at=?");
    $query->bindValue(1, $series_id);
    $query->bindValue(2, $seasons_id);
    $query->bindValue(3, $episodeNum);
    $query->bindValue(4, $px480);
    $query->bindValue(5, $px720);
    $query->bindValue(6, $px1080);
    $query->bindValue(7, $px4k);
    $query->bindValue(8, $duration);
    $query->bindValue(9, $create_at);
    $query->execute();

    move_uploaded_file($_FILES["px480"]["tmp_name"], "../assets/movies/".$_FILES['px480']['name']);
    move_uploaded_file($_FILES["px720"]["tmp_name"], "../assets/movies/".$_FILES['px720']['name']);
    move_uploaded_file($_FILES["px1080"]["tmp_name"], "../assets/movies/".$_FILES['px1080']['name']);
    move_uploaded_file($_FILES["px4k"]["tmp_name"], "../assets/movies/".$_FILES['px4k']['name']);

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
  <title>قسمت جدید</title>
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
        <form method="POST" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" enctype="multipart/form-data">
          <p>قسمت جدید</p>
          <div>
            <div>
              <label for="series">سریال مرتبط : </label>
              <select name="series_id" id="series">
                <option value="0">انتخاب کنید</option>
                <?php foreach($series as $item): ?>
                   <option value="<?= $item['media_id'] ?>"><?= $item['faName'].' '.$item['enName']?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label for="seasons">فصل مرتبط : </label>
              <select id="seasons" name="seasons">
                  <option value="">ابتدا سریال را انتخاب کنید</option>
              </select>
            </div>
            <div>
              <label for="name">قسمت چند : </label>
              <input type="text" name="episodeNum" placeholder="1" />
            </div>
            <div>
              <label for="name">زمان : </label>
              <input type="text" name="duration" placeholder="مثال : 58:32" />
            </div>


              <div>
                <label for="name">480px : </label>
                <input type="file" name="px480" />
              </div>
              <div>
                <label for="name">720px : </label>
                <input type="file" name="px720" />
              </div>
              <div>
                <label for="name">1080px : </label>
                <input type="file" name="px1080" />
              </div>
              <div>
                <label for="name">4k : </label>
                <input type="file" name="px4k" />
              </div>
            
          </div>
          <button type="submit" name="addEpisode">
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
        title: "قسمت جدید",
        text: "قسمت با موفقیت ایجاد شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        // location = './panel/profile.php';
      }, 2000);
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ایجاد قسمت جدید",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#series').change(function() {
            const seriesId = $(this).val();
            const seasonsSelect = $('#seasons');

            if (seriesId) {
                // نمایش loading
                seasonsSelect.html('<option value="">در حال دریافت فصل‌ها...</option>');

                // درخواست AJAX
                $.ajax({
                    url: 'get_seasons.php',
                    type: 'POST',
                    data: { series_id: seriesId },
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            let options = '<option value="">-- فصل مورد نظر را انتخاب کنید --</option>';
                            $.each(data, function(key, season) {
                                options += `<option value="${season.id}">فصل ${season.seasoneNum} - ${season.language=="sub"?"دوبله فارسی":"زیرنویس فارسی"}</option>`;
                            });
                            seasonsSelect.html(options).prop('disabled', false);
                        } else {
                            seasonsSelect.html('<option value="">فصلی برای این سریال وجود ندارد</option>');
                        }
                    },
                    error: function() {
                        seasonsSelect.html('<option value="">خطا در دریافت فصل‌ها</option>');
                    }
                });
            } else {
                seasonsSelect.html('<option value="">-- ابتدا سریال را انتخاب کنید --</option>').prop('disabled', true);
            }
        });
      });
    </script>



</body>

</html>