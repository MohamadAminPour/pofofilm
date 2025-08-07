<?php
header('Content-Type: application/json');

// اتصال به دیتابیس
include '../server/PDO.php';

// دریافت سریال انتخاب شده
$series_id = $_POST['series_id'] ?? 0;

// دریافت فصل‌های مربوطه
$stmt = $conn->prepare("SELECT * FROM seasones WHERE series_media_id=? ORDER BY seasoneNum");
$stmt->execute([$series_id]);
$seasons = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($seasons);
?>