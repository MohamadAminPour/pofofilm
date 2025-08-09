<?php
include "../server/PDO.php";

$query = $conn->prepare('SELECT * FROM users WHERE id=?');
$query->bindValue(1, $_SESSION['id']);
$query->execute();
$userSelected = $query->FetchAll(PDO::FETCH_ASSOC);
foreach($userSelected as $user){}
// var_dump($users);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" /> -->
   <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<style>
 
</style>
<body>
        <?php if($user['role']==2){ ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse1"
                    aria-expanded="false"
                    aria-controls="collapse1"
                    >
                    <i class='bxr bx-grid'></i> 
                    <p>داشبورد</p>
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./index.php">داشبورد ادمین</a>
                </div>
            </div>
         </div>
        <?php } ?>
         


        <div class="accordion-item">
            <h2 class="accordion-header" id="heading2">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse2"
                    aria-expanded="false"
                    aria-controls="collapse2"
                    >
                    <i class="bx bx-user"></i>
                    <p>اطلاعات شخصی</p>
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./information-show.php">نمایش اطلاعات</a>
                    <a href="./subscriptions-status.php">وضعیت اشتراک</a>
                    <a href="./wallet.php">کیف پول</a>
                    <a href="information-saves.php">ذخیره شده ها</a>
                </div>
            </div>
        </div>


        <?php if($user['role']!=0){ ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading3">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse3"
                    aria-expanded="false"
                    aria-controls="collapse3"
                    >
                   <i class='bxr  bx-community'></i> 
                    <p>کاربران</p>
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./users-show.php">نمایش کاربران</a>
                    <a href="./usersBan-show.php">کاربران بن شده</a>
                </div>
            </div>
        </div>
       

        <div class="accordion-item">
            <h2 class="accordion-header" id="heading4">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse4"
                    aria-expanded="false"
                    aria-controls="collapse4"
                    >
                   <i class='bxr  bx-film-roll-alt'></i> 
                    <p>فیلم ها</p>
                </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./movies-show.php">نمایش فیلم ها</a>
                    <a href="./movies-add.php">فیلم جدید</a>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="heading5">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse5"
                    aria-expanded="false"
                    aria-controls="collapse5"
                    >
                    <i class="bx bx-movie-play"></i>
                    <p>سریال ها</p>
                </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./series-show.php">نمایش سریال ها</a>
                    <a href="./series-add.php">سریال جدید</a>
                    <a href="./seriesSesson-add.php">فصل جدید</a>
                    <a href="./seriesEpisode-add.php">قسمت جدید</a>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="heading6">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6"
                    aria-expanded="false"
                    aria-controls="collapse6"
                    >
                    <i class='bxr  bx-gallery-vertical'></i> 
                    <p>اسلایدر</p>
                </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./slider-show.php">نمایش اسلاید ها</a>
                    <a href="./slider-add.php">اسلاید جدید</a>
                </div>
            </div>
        </div>
        


        <!-- <div class="accordion-item">
            <h2 class="accordion-header" id="heading7">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse7"
                    aria-expanded="false"
                    aria-controls="collapse7"
                    >
                    <i class="bx bx-info-circle"></i>
                    <p>درباره ما</p>
                </button>
            </h2>
            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./about-show.php">نمایش درباره ما</a>
                    <a href="./about-add.php">درباره ما جدید</a>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header" id="heading8">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse8"
                    aria-expanded="false"
                    aria-controls="collapse8"
                    >
                    <i class="bx bx-message-dots"></i>
                    <p>اشتراک ها</p>
                </button>
            </h2>
            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./tickets-notRead.php">تیکت خوانده نشده</a>
                    <a href="./tickets-submit.php">تیکت خوانده شده</a>
                    <a href="./tickets-reject.php">تیکت حذف شده</a>
                </div>
            </div>
        </div> -->


        <div class="accordion-item">
            <h2 class="accordion-header" id="heading9">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse9"
                    aria-expanded="false"
                    aria-controls="collapse9"
                    >
                    <i class='bxr  bx-message-bubble-detail'></i> 
                    <p>کامنت ها</p>
                </button>
            </h2>
            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./comments-notRead.php">کامنت خوانده نشده</a>
                    <a href="./comments-submit.php">کامنت تایید شده</a>
                    <a href="./comments-reject.php">کامنت رد شده</a>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header" id="heading10">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse10"
                    aria-expanded="false"
                    aria-controls="collapse10"
                    >
                  <i class='bxr  bx-ticket'></i> 
                    <p>تیکت ها</p>
                </button>
            </h2>
            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./tickets-notRead.php">نمایش تیکت ها</a>
                </div>
            </div>
        </div>
        <?php }?>

         <?php if($user['role']==2){ ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading11">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse11"
                    aria-expanded="false"
                    aria-controls="collapse11"
                    >
                    <i class='bxr  bx-bell'></i> 
                    <p>نوتیفیکیشن ها</p>
                </button>
            </h2>
            <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./notification-show.php">نمایش نوتیفیکیشن ها</a>
                    <a href="./notification-add.php">نوتیفیکیشن جدید</a>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header" id="heading12">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse12"
                    aria-expanded="false"
                    aria-controls="collapse12"
                    >
                   <i class='bxr  bx-message-circle-question-mark'  ></i> 
                    <p>سوالات متداول</p>
                </button>
            </h2>
            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./questions-show.php">نمایش سوالات</a>
                    <a href="./questions-add.php">سوال جدید</a>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="accordion-item">
            <h2 class="accordion-header" id="heading13">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse13"
                    aria-expanded="false"
                    aria-controls="collapse13"
                    >
                   <i class='bxr  bx-arrow-out-left-square-half'></i> 
                   <p>خروج</p>
                </button>
            </h2>
            <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <a href="./logout.php">خروج از اکانت</a>
                </div>
            </div>
        </div>

</body>
</html>