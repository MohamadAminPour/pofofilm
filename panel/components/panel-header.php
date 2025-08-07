<?php
require_once "../server/PDO.php";

$result = $conn->prepare('SELECT * FROM users WHERE id=?');
$result->bindValue(1, $_SESSION['id']);
$result->execute();
$allUsers = $result->FetchAll(PDO::FETCH_ASSOC);


$result = $conn->prepare('SELECT * FROM notifications');
$result->execute();
$notifications = $result->FetchAll(PDO::FETCH_ASSOC);

?>

<div class="dashboard-header">
        <div class="dashboard-header__right" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="0">
          <i class="bx bx-menu"></i>
          <div class="notifs">
            <div class="notifs-icon">
              <i class="bx bx-bell"></i>
            </div>
            <div class="notifList">
              <p>نوتیفیکیشن ها</p>
              <ul class="notifItems">
                <?php foreach($notifications as $notif){ if($notif['watcher']==1 && $_SESSION['role']==1 || $_SESSION['role']==2){ ?>
                 <li>
                  <p><?= $notif['subject'] ?></p>
                  <p><?= $notif['content'] ?></p>
                  <p><?= $notif['create_at'] ?></p>
                </li>
                <hr>
                <?php } elseif($notif['watcher']==2){if(isset($_SESSION['role'])){ ?>
                <li>
                  <p><?= $notif['subject'] ?></p>
                  <p><?= $notif['content'] ?></p>
                  <p><?= $notif['create_at'] ?></p>
                </li>
                <hr>
                <?php }}} ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="dashboard-header__left" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
          <div class="profile">
          <?php foreach($allUsers as $user){ ?>
            <?php if($user['image']){ ?>
              <img src="../assets/images/users/<?php echo $user['image'] ?>" alt="" />
            <?php } else { ?>
              <p style="width:2.7rem;height:2.7rem;font-size:1.3rem;border-radius:50rem;color:white;background-color:#000;display:grid;place-content:center;margin-right:.7rem;">
                <?= $_SESSION['username'][0] ?>
              </p>
            <?php } ?>
          <?php } ?>
            <div class="profileStatus">
              <span class="online"></span>
              <!-- <span class="offline"></span> -->
            </div>
          </div>
          <div>
          <p style="margin-top:.5rem"><?= $_SESSION['username'] ?></p>
          <p><?= $_SESSION['email'] ?></p>
          </div>
        </div>
      </div>



      