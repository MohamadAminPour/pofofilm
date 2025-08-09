<?php
  include '../server/PDO.php';
  session_start();

  $query = $conn->prepare('SELECT * FROM questions');
  $query->execute();
  $questions = $query->FetchAll(PDO::FETCH_ASSOC);

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
    <title>لیست سوال ها</title>
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
                <div class="series">
                    <div class="series-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                        <img src="../assets/images/icons8-question-100.png" alt="" />
                        <p class="series-header-title">سوالات ها</p>
                        <p class="series-header-subTitle">
                            سوالات متداول سایت پوفوفیلم را مدیریت کنید !
                        </p>
                    </div>
                    <hr />
                    <ul class="series-infos" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                     <?php if($questions){foreach($questions as $item): ?>
                        <li>
                            <p><?= $item['id'] ?></p>
                            <p><?= $item['question'] ?></p>
                            <p><?= $item['anwser'] ?></p>
                            <p><?= $item['create_at'] ?></p>
                            <button class="series-action">
                                <p>عملیات</p>
                                <i class="bx bx-wrench"></i>
                                <ul class="series-action__wrench">
                                    <li><a href="./questions-edit.php?id=<?= $item['id'] ?>">ویرایش</a></li>
                                    <li><a href="./questions-remove.php?id=<?= $item['id'] ?>">حذف</a></li>
                                </ul>
                            </button>
                        </li>
                     <?php endforeach;}else{ ?>
                        <div class="empty-msg">
                                <p
                                  class="empty-msg__title"
                                  data-aos="fade-up"
                                  data-aos-duration="1000"
                                  data-aos-delay="0"
                                >
                                تا به امروز هیچ سوالی ایجاد نشده است !
                                </p>
                        </div>
                    <?php } ?>
                    </ul>
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
</body>

</html>