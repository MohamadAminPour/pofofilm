<?php
    session_start();
    include '../server/PDO.php';
    session_destroy();
    header("Location:../login.php")
?>
