<?php
require_once "../../controllers/SinhVienController.php";

$controller = new SinhVienController();
$maSV = $_GET['MaSV'] ?? null;
$sinhvien = $maSV ? $controller->getSinhVien($maSV) : null;

if (!$sinhvien) {
    echo "Sinh viên không tồn tại!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Chỉnh sửa Sinh Viên</h2>
        <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MaSV" value="<?= htmlspecialchars($sinhvien['MaSV']) ?>">

            <div class="mb-3">
                <label class="form-label">Họ Tên</label>
                <input type="text" name="HoTen" class="form-control" value="<?= htmlspecialchars($sinhvien['HoTen']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giới Tính</label>
                <select name="GioiTinh" class="form-control">
                    <option value="Nam" <?= ($sinhvien['GioiTinh'] == "Nam") ? "selected" : "" ?>>Nam</option>
                    <option value="Nữ" <?= ($sinhvien['GioiTinh'] == "Nữ") ? "selected" : "" ?>>Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày Sinh</label>
                <input type="date" name="NgaySinh" class="form-control" value="<?= htmlspecialchars($sinhvien['NgaySinh']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Hình ảnh hiện tại</label><br>
                <img src="../../uploads/<?= htmlspecialchars($sinhvien['Hinh']) ?>" width="100">
            </div>

            <div class="mb-3">
                <label class="form-label">Chọn hình ảnh mới</label>
                <input type="file" name="Hinh" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Mã Ngành</label>
                <input type="text" name="MaNganh" class="form-control" value="<?= htmlspecialchars($sinhvien['MaNganh']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
