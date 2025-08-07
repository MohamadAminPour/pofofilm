<?php
include '../server/PDO.php';

$id = $_GET['id'];
$query=$conn->prepare("DELETE FROM episodes WHERE id=?");
$query->bindValue(1, $id);
$query->execute();
header('location: ./episodes-show.php');


?>
