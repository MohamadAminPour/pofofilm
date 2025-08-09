<?php
include '../server/PDO.php';
include '../jdf.php';
session_start();

$success=false;
$fieldErr=false;

$id = $_GET['id'];


$query = $conn->prepare('SELECT * FROM questions WHERE id=? ');
$query->bindValue(1, $id);
$query->execute();
$questions = $query->FetchAll(PDO::FETCH_ASSOC);
foreach($questions as $question){}


if(isset($_POST['editQuestion'])){
  $question = $_POST['question'];
  $anwser = $_POST['anwser'];
  $create_at = jdate("l, d F Y");
  
  if($question && $anwser){
    $query=$conn->prepare("UPDATE questions SET question=?, anwser=?, create_at=? WHERE id=?");
    $query->bindValue(1, $question);
    $query->bindValue(2, $anwser);
    $query->bindValue(3, $create_at);
    $query->bindValue(4, $id);
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
  <title>ویرایش سوال</title>
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
          <p>ویرایش سوال</p>
          <div>
            <div>
              <label for="number">سوال : </label>
              <input type="text" name="question" value="<?= $question['question'] ?>" placeholder="سوال متداول" />
            </div>

            <div>
              <label for="trailer">جواب : </label>
              <input type="text" name="anwser" value="<?= $question['anwser'] ?>" placeholder="جواب این سوال" />
            </div>

          </div>

          <button type="submit" name="editQuestion">
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
        title: "سوال جدید",
        text: "سوال با موفقیت ایجاد شد",
        icon: "success",
        confirmButtonText: "باشه",
      });
      setTimeout(() => {
        location = './questions-show.php';
      }, 2000);
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ایجاد سوال جدید",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>