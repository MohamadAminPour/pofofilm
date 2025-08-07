<?php
include '../server/PDO.php';

$id = $_GET['id'];
$query=$conn->prepare("DELETE FROM series WHERE media_id=?");
$query->bindValue(1, $id);
$query->execute();
header('location: ./series-show.php');


?>
