<?php
// Kết nối cơ sở dữ liệu
require __DIR__ . '/../../../src/db/db_connect.php';
require __DIR__ . '/../../../src/functions.php';
session_start();

$query = "INSERT INTO DANH_DAU(MA_SACH, USERNAME_DG) VALUES (?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([
    $_GET['id'],
    $_SESSION['username_dg']
]);

redirect('/user/trangchu');