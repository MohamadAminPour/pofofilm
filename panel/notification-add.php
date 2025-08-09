<?php
  include '../server/PDO.php';
  include '../jdf.php';
  session_start();

  $success=false;
  $fieldErr=false;

  if(isset($_POST['sendNotif'])){
    $subject = $_POST['subject'];
    $watcher = $_POST['watcher'];
    $content = $_POST['content'];
    $create_at = jdate("l, d F Y");
    
    if($subject && $watcher && $content){
      $query=$conn->prepare("INSERT INTO notifications SET subject=?, watcher=?, content=?, create_at=?");
      $query->bindValue(1,$subject);
      $query->bindValue(2,$watcher);
      $query->bindValue(3,$content);
      $query->bindValue(4,$create_at);
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
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="./styles/index.css" />
  <title>نوتیفیکیشن ها</title>
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
   
      <div class="dashboard-content">
        <div class="notifications">
          <form method="POST" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <p>نوتیفیکیشن جدید</p>
            <div>
              <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <label for="name">موضوع نوتیف : </label>
                <input type="text" name="subject" placeholder="تخفیف ویژه ماه رمضان" />
              </div>
              <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <label for="name">بیننده : </label>
                <select name="watcher">
                  <option value="0">انتخاب کنید</option>
                  <option value="2">کاربران و مدیران</option>
                  <option value="1">فقط مدیران</option>
                </select>
              </div>
              <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <label for="name">متن نوتیف : </label>
                <input type="text" name="content" placeholder="پیامی بنویسید..." />
              </div>
            </div>
            <button type="submit" name="sendNotif" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <i class="bx bx-send"></i>
              <p>ارسال</p>
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
        title: "ارسال موفقیت آمیز",
        text: "نوتیف شما ارسال شد !",
        icon: "success",
        confirmButtonText: "باشه",
      });
      <?php } ?>
      <?php if($fieldErr){ ?>
      Swal.fire({
        title: "خطا هنگام ارسال نوتیف",
        text: "لطفا همه فیلد ها را پر کنید !",
        icon: "error",
        confirmButtonText: "باشه",
      });
      <?php } ?>
    </script>
</body>

</html>