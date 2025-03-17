<?php
session_start();
require_once "../../app/controllers/DangKyHocPhanController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mssv = $_POST['mssv'];

    $dangKyController = new DangKyHocPhanController();
    $dangKyController->deleteAllCourses($mssv);
    
    header("Location: dangky_hocphan.php");
    exit();
}
?>
