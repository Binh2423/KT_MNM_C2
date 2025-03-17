<?php
require_once "../../controllers/SinhVienController.php";

$controller = new SinhVienController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maSV = $_POST["MaSV"];
    $hoTen = $_POST["HoTen"];
    $gioiTinh = $_POST["GioiTinh"];
    $ngaySinh = $_POST["NgaySinh"];
    $maNganh = $_POST["MaNganh"];
    $hinh = $_POST["OldHinh"]; // Ảnh cũ mặc định

    // Kiểm tra nếu người dùng chọn file ảnh mới
    if (!empty($_FILES["Hinh"]["name"])) {
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra định dạng ảnh
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_types)) {
            // Di chuyển file ảnh vào thư mục uploads
            if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file)) {
                $hinh = $_FILES["Hinh"]["name"]; // Lưu tên file ảnh mới
            }
        }
    }

    // Cập nhật thông tin sinh viên
    $controller->updateSinhVien($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);

    // Quay lại trang danh sách
    header("Location: index.php");
    exit();
}
?>
