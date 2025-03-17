<?php require_once "../../controllers/SinhVienController.php"; ?>

<?php
$controller = new SinhVienController();
$sinhvien = $controller->getSinhVien($_GET['MaSV']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->deleteSinhVien($_POST['MaSV']);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xóa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4">XÓA THÔNG TIN</h2>
    <p>Are you sure you want to delete this?</p>

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

    <form method="POST">
        <input type="hidden" name="MaSV" value="<?= $sinhvien['MaSV'] ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="index.php" class="btn btn-secondary">Back to List</a>
    </form>
</div>
</body>
</html>
