<?php
require_once "../../controllers/SinhVienController.php";

$controller = new SinhVienController();
$sinhviens = $controller->index();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Danh sách sinh viên</h2>
        <a href="tao.php" class="btn btn-primary mb-3">Thêm Sinh Viên</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Mã Ngành</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sinhviens as $sv) : ?>
                    <tr>
                        <td><?= htmlspecialchars($sv["MaSV"]) ?></td>
                        <td><?= htmlspecialchars($sv["HoTen"]) ?></td>
                        <td><?= htmlspecialchars($sv["GioiTinh"]) ?></td>
                        <td><?= htmlspecialchars($sv["NgaySinh"]) ?></td>
                        <td>
                            <?php if (!empty($sv["Hinh"])): ?>
                                <img src="../../uploads/<?= htmlspecialchars($sv["Hinh"]) ?>" width="50">
                            <?php else: ?>
                                <span>Không có ảnh</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($sv["MaNganh"]) ?></td>
                        <td>
                            <a href="edit.php?MaSV=<?= htmlspecialchars($sv["MaSV"]) ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="detail.php?MaSV=<?= htmlspecialchars($sv["MaSV"]) ?>" class="btn btn-danger btn-sm">Thông tin</a>
                            <a href="delete.php?MaSV=<?= htmlspecialchars($sv["MaSV"]) ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
