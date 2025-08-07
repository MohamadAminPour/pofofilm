<?php
include "../server/PDO.php";
session_start();

// $pageName = "dashboard";

$query = $conn->prepare('SELECT COUNT(id) AS total FROM view WHERE create_at=?');
$query->bindValue(1, date("Y/m/d"));
$query->execute();
$viewToday = $query->Fetch(PDO::FETCH_ASSOC);


$query = $conn->prepare('SELECT COUNT(id) AS total FROM view');
$query->execute();
$viewMonth = $query->Fetch(PDO::FETCH_ASSOC);


$query = $conn->prepare('SELECT COUNT(id) AS total FROM users');
$query->execute();
$usersCount = $query->Fetch(PDO::FETCH_ASSOC);

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
    <div class="dashboard-sidebar active" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="0">
     <a href="../index.php" class="logo">پوفوفیلم</a>
      <div class="accordion dashboard-accordion" id="accordionExample">
         <?php include './components/panel-sidbar.php' ?>
      </div>
    </div>
    <div class="dashboard-main">
    <?php include './components/panel-header.php' ?>
      <div class="dashboard-content">
        <ul class="dashboard-content__details">
          <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <i class="bx bx-show"></i>
            <div>
              <p>بازدید امروز</p>
              <p><?= number_format($viewToday['total']) ?> <span>تا</span></p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            <i class="bx bx-history"></i>
            <div>
              <p>بازدید کل</p>
              <p><?= number_format($viewMonth['total']) ?> <span>تا</span></p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            <i class="bx bx-coin"></i>
            <div>
              <p>واریزی اشتراک ها</p>
              <p>2,450,000 <span>تومان</span></p>
            </div>
          </li>
          <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            <i class="bx bx-group"></i>
            <div>
              <p>تعداد کاربران</p>
              <p> <?= $usersCount['total'] ?> <span>نفر</span></p>
            </div>
          </li>
        </ul>
        <div id="chart"></div>
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
  <script>
    var options = {
      series: [
        {
          name: "بازدید این ماه",
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 87, 91, 101],
        },
        // {
        //   name: "Revenue",
        //   data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
        // },
        // {
        //   name: "Free Cash Flow",
        //   data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
        // },
      ],
      chart: {
        type: "bar",
        height: 450,
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "55%",
          borderRadius: 5,
          borderRadiusApplication: "end",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      xaxis: {
        categories: [
          "فروردین",
          "اردیبهشت",
          "خرداد",
          "تیر",
          "مرداد",
          "شهریور",
          "مهر",
          "آبان",
          "آذر",
          "دی",
          "بهمن",
          "اسفند",
        ],
      },
      yaxis: {
        title: {
          text: "نمودار بازدید سالانه",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val;
          },
        },
      },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
  </script>
</body>

</html>