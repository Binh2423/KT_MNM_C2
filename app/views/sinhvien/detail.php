<?php require_once "../../controllers/SinhVienController.php"; ?>

<?php
$controller = new SinhVienController();
$sinhvien = $controller->getSinhVien($_GET['MaSV']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Chi Tiết</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Thông tin chi tiết</h2>
    
    <table class="table">
        <tr>
            <th>Họ Tên:</th>
            <td><?= $sinhvien['HoTen'] ?></td>
        </tr>
        <tr>
            <th>Giới Tính:</th>
            <td><?= $sinhvien['GioiTinh'] ?></td>
        </tr>
        <tr>
            <th>Ngày Sinh:</th>
            <td><?= $sinhvien['NgaySinh'] ?></td>
        </tr>
        <tr>
            <th>Hình:</th>
            <td><img src="../../uploads/<?= $sinhvien['Hinh'] ?>" width="100"></td>
        </tr>
        <tr>
            <th>Mã Ngành:</th>
            <td><?= $sinhvien['MaNganh'] ?></td>
        </tr>
    </table>

    <a href="edit.php?MaSV=<?= $sinhvien['MaSV'] ?>" class="btn btn-primary">Chỉnh sửa</a>
    <a href="index.php" class="btn btn-secondary">Back to List</a>
</div>
</body>
</html>
