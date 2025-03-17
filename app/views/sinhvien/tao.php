<?php
require_once "../../controllers/SinhVienController.php";

$controller = new SinhVienController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST["HoTen"];
    $gioiTinh = $_POST["GioiTinh"];
    $ngaySinh = $_POST["NgaySinh"];
    $maNganh = $_POST["MaNganh"];
    $hinh = "";

    // Kiểm tra nếu có ảnh được tải lên
    if (!empty($_FILES["Hinh"]["name"])) {
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Chỉ cho phép định dạng ảnh
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                $hinh = $_FILES["Hinh"]["name"]; // Lưu tên file ảnh
            }
        }
    }

    $controller->addSinhVien($hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Thêm Sinh Viên</h2>
        <form action="create.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Họ Tên</label>
                <input type="text" name="HoTen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giới Tính</label>
                <select name="GioiTinh" class="form-control">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày Sinh</label>
                <input type="date" name="NgaySinh" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Chọn Hình Ảnh</label>
                <input type="file" name="Hinh" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Mã Ngành</label>
                <input type="text" name="MaNganh" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="index.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>
</html>
