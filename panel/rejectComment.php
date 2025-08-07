<?php
include '../server/PDO.php';

$id = $_GET['id'];
$query=$conn->prepare("UPDATE comments SET status=? WHERE id=?");
$query->bindValue(1, 0);
$query->bindValue(2, $id);
$query->execute();
header('location: ./comments-notRead.php');


?>

