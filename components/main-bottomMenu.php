<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="bottomMenu">
      <a href="./questions.php"><i class="bx bxs-book"></i>
        <p>سوالات</p>
      </a>
      <a href="./subscriptions.php"><i class="bx bxl-sketch"></i>
        <p>اشتراک</p>
      </a>
      <a href="./index.php"><i class="bx bx-grid-alt"></i>
        <p>خانه</p>
      </a>
      <a href="./ticket.php"><i class="bx bx-message-square-dots"></i>
        <p>تیکت</p>
      </a>
      <?php if(isset($_SESSION['id'])){ ?>
        <a href="./panel/information-show.php"><i class="bx bx-user"></i>
          <p>پروفایل</p>
        </a>
      <?php }else{ ?>
        <a href="./login.php"><i class="bx bx-user"></i>
          <p>ورود</p>
        </a>
      <?php } ?>
    </div>
</body>
</html>