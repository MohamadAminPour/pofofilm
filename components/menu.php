<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  @media (max-width: 620px) {
  .searchBtn{
    font-size: 1rem !important;
    padding: .5rem !important;
    }
  }
</style>
<body>
  <menu id="menus">
    <div class="menu-right">
      <!-- <img class="menu-logo" src="" /> -->
      <a href="./index.php" class="menu-textLogo">پوفوفیلم</a>
      <ul class="menu-links">
        <li><a href="./index.php" class="menu-link">خانه</a></li>
        <li>
          <a href="./subscriptions.php" class="menu-link">خرید اشتراک</a>
        </li>
        <li>
          <a href="./questions.php" class="menu-link">سوالات متداول</a>
        </li>
        <li><a href="./ticket.php" class="menu-link">تیکت زدن</a></li>
        <li><a href="./playOnlline.php" class="menu-link">پخش آنلاین</a></li>
      </ul>
    </div>
    <div class="menu-left" style="gap: .5rem;">
      <a href="./search.php" type="submit" class="searchBtn" style="background-color: #fff;padding: .7rem;display: flex;align-items: center;color: #000;border-radius: .4rem;"><i class="bx bx-search"></i></a>
      <div class="menu-auth">
        <?php if(isset($_SESSION['id'])){ ?>
          <a href="./panel/information-show.php" class="auth-notLogin"><i class="bx bx-user"></i>
            <p>پروفایل</p>
          </a>
        <?php }else{ ?>
          <a href="./login.php"><i class="bx bx-log-in"></i>
            <p>ورود یا ثبت نام</p>
          </a>
        <?php } ?>
      </div>
    </div>
  </menu>
</body>
</html>