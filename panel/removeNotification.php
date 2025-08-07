<?php
include '../server/PDO.php';

$id = $_GET['id'];
$query=$conn->prepare("DELETE FROM notifications WHERE id=?");
$query->bindValue(1, $id);
$query->execute();
header('location: ./notification-show.php');


?>
