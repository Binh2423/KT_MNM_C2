<?php
session_start();
require_once "../../app/controllers/DangKyHocPhanController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mssv = $_POST['mssv'];
    $maHocPhan = $_POST['maHocPhan'];

    $dangKyController = new DangKyHocPhanController();
    $dangKyController->deleteCourse($mssv, $maHocPhan);
    
    header("Location: dangky_hocphan.php");
    exit();
}
?>
