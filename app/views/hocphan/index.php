<?php
require_once __DIR__ . "/../../controllers/HocPhanController.php";
$controller = new HocPhanController();
$hocphans = $controller->index();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center mb-4">Danh Sách Học Phần</h2>
    <a href="create.php" class="btn btn-primary mb-3">Thêm Học Phần</a>
    
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hocphans as $hp): ?>
            <tr>
                <td><?= $hp['MaHP'] ?></td>
                <td><?= $hp['TenHP'] ?></td>
                <td><?= $hp['SoTinChi'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $hp['MaHP'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete.php?id=<?= $hp['MaHP'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
