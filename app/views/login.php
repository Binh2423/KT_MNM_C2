<?php
session_start();
require_once __DIR__ . "/../../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];

    $database = new Database();
    $conn = $database->connect();

    // Truy vấn thông tin sinh viên từ MaSV
    $query = "SELECT * FROM sinhvien WHERE MaSV = :MaSV";
    $stmt = $conn->prepare($query);
    $stmt->execute([':MaSV' => $MaSV]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($student) {
        $_SESSION['sinhvien'] = $student; // Lưu thông tin sinh viên vào session
        header("Location: dangky_hocphan.php");
        exit();
    } else {
        $error = "MaSV không hợp lệ!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center">ĐĂNG NHẬP</h2>
    <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
    <form action="" method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label class="form-label fw-bold">MaSV</label>
            <input type="text" name="MaSV" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
    </form>
</body>
</html>
