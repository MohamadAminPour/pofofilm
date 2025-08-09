<?php
include './server/PDO.php';
session_start();

$id = $_GET['id'];

$query = $conn->prepare('SELECT * FROM series WHERE media_id=?');
$query->bindValue(1, $id);
$query->execute();
$series = $query->FetchAll(PDO::FETCH_ASSOC);
foreach($series as $item){}


?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./styles/index.css" />
  <title>تریلر</title>
</head>

<body>
   <video controls preload="auto" poster="./assets/images/media/<?= $item['bg'] ?>">
    <source src="./assets/movies/<?= $item['trailer'] ?>" type="video/mp4">
    </source>
  </video>
</body>

</html>