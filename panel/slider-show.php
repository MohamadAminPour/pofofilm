<?php
  include '../server/PDO.php';
  session_start();

  $query = $conn->prepare('SELECT *, sl.id as id FROM slider sl JOIN movies m ON m.media_id = sl.media_id ');
  $query->execute();
  $MovieSliders = $query->FetchAll(PDO::FETCH_ASSOC);
  
  $query = $conn->prepare('SELECT *, sl.id as id FROM slider sl JOIN series se ON se.media_id = sl.media_id ');
  $query->execute();
  $seriesSliders = $query->FetchAll(PDO::FETCH_ASSOC);
  
  $medias = [...$MovieSliders, ...$seriesSliders];
//   var_dump($medias);

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
                <div class="slider">
                    <div class="slider-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                        <img src="../assets/images/icons8-image-100.png" alt="" />
                        <p class="slider-header-title">اسلایدر ها</p>
                        <p class="slider-header-subTitle">
                            اسلایدر های سایت پوفوفیلم را مدیریت کنید !
                        </p>
                    </div>
                    <hr />
                    <ul class="slider-infos" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <?php if($medias){ foreach($medias as $slide){  ?>
                            <li>
                                <span><?= $slide['id'] ?></span>
                                <img src="../assets/images/<?= $slide['cover'] ?>" alt="" style="border-radius: .2rem; width: 6rem;object-fit: cover;">
                                <p><?= $slide['faName'] ?></p>
                                <p><?= $slide['enName'] ?></p>
                                <button class="slider-action">
                                    <p>عملیات</p>
                                    <i class="bx bx-wrench"></i>
                                    <ul class="slider-action__wrench">
                                        <li><a href="./slider-remove.php?id=<?= $slide['id'] ?>">حذف</a></li>
                                    </ul>
                                </button>
                            </li>
                        <?php }} else{ ?>
                        <div class="empty-msg">
                            <p class="empty-msg__title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                             تا به امروز هیچ اسلایدری درست نشده است !
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