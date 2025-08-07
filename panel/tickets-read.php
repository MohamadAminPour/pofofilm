<?php
include '../server/PDO.php';

$id = $_GET['id'];
$query=$conn->prepare("UPDATE tickets SET status=? WHERE id=?");
$query->bindValue(1, 1);
$query->bindValue(2, $id);
$query->execute();
header('location: ./tickets-notRead.php');


?>
