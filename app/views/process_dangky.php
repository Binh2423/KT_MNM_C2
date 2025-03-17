<?php
session_start();
require_once "../../config/database.php";

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['sinhvien'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mssv = $_POST['mssv'];
    $maHocPhan = $_POST['maHocPhan'];

    $database = new Database();
    $conn = $database->connect();

    // Kiểm tra xem sinh viên đã đăng ký học phần này chưa
    $checkQuery = "SELECT * FROM dangkyhocphan WHERE MSSV = :mssv AND MaHocPhan = :maHocPhan";
    $stmt = $conn->prepare($checkQuery);
    $stmt->execute([':mssv' => $mssv, ':maHocPhan' => $maHocPhan]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Bạn đã đăng ký học phần này!";
    } else {
        // Đăng ký học phần
        $insertQuery = "INSERT INTO dangkyhocphan (MSSV, MaHocPhan) VALUES (:mssv, :maHocPhan)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->execute([':mssv' => $mssv, ':maHocPhan' => $maHocPhan]);

        $_SESSION['success'] = "Đăng ký học phần thành công!";
    }

    header("Location: dangky_hocphan.php");
    exit();
}
?>
