<?php
session_start();
require_once "../../app/controllers/DangKyHocPhanController.php";
require_once "../../app/controllers/HocPhanController.php";

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['sinhvien'])) {
    header("Location: login.php");
    exit();
}

$sinhvien = $_SESSION['sinhvien'];
$MaSV = $sinhvien['MaSV'];

$dangKyController = new DangKyHocPhanController();
$hocPhansDaDangKy = $dangKyController->getRegisteredCourses($MaSV);
$hocPhanController = new HocPhanController();
$allHocPhans = $hocPhanController->index();

// Tính tổng số tín chỉ
$totalTinChi = array_sum(array_column($hocPhansDaDangKy, 'SoTinChi'));
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">ĐĂNG KÝ HỌC PHẦN</h2>
        <p><strong>MaSV:</strong> <?= $sinhvien['MaSV'] ?></p>
        <p><strong>Họ Tên:</strong> <?= $sinhvien['HoTen'] ?></p>

        <h4>Danh sách học phần đã đăng ký:</h4>
        <?php if (!empty($hocPhansDaDangKy)) : ?>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hocPhansDaDangKy as $hocPhan): ?>
                        <tr>
                            <td><?= $hocPhan['MaHP'] ?></td>
                            <td><?= $hocPhan['TenHP'] ?></td>
                            <td><?= $hocPhan['SoTinChi'] ?></td>
                            <td>
                                <form action="xoa_hocphan.php" method="POST">
                                    <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
                                    <input type="hidden" name="MaHP" value="<?= $hocPhan['MaHP'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Số học phần:</strong> <?= count($hocPhansDaDangKy) ?></p>
            <p><strong>Tổng số tín chỉ:</strong> <?= $totalTinChi ?></p>
            <form action="xoa_tatca.php" method="POST">
                <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
                <button type="submit" class="btn btn-warning">Xóa Tất Cả</button>
            </form>
        <?php else : ?>
            <p class="text-danger">Bạn chưa đăng ký học phần nào.</p>
        <?php endif; ?>

        <h4>Danh sách học phần có thể đăng ký:</h4>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Mã HP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Đăng Ký</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allHocPhans as $hocPhan): ?>
                    <tr>
                        <td><?= $hocPhan['MaHP'] ?></td>
                        <td><?= $hocPhan['TenHP'] ?></td>
                        <td><?= $hocPhan['SoTinChi'] ?></td>
                        <td>
                            <form action="dangky_hocphan.php" method="POST">
                                <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
                                <input type="hidden" name="MaHP" value="<?= $hocPhan['MaHP'] ?>">
                                <button class="btn btn-success btn-sm btn-dangky" data-mhp="<?= $hocPhan['MaHP'] ?>">Đăng Ký</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <a href="logout.php" class="btn btn-danger mt-3">Đăng Xuất</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".btn-dangky").click(function() {
        let MaSV = "<?= $MaSV ?>"; // Lấy mã sinh viên từ PHP
        let MaHP = $(this).data("mhp"); // Lấy mã học phần từ thuộc tính data-mhp
        let button = $(this); // Lưu lại nút được bấm

        $.ajax({
            url: "dangky_hocphan.php",
            type: "POST",
            data: { MaDK: MaDK, MaHP: MaHP },
            success: function(response) {
                if (response == "success") {
                    alert("Đăng ký thành công!");
                    button.prop("disabled", true).text("Đã Đăng Ký").removeClass("btn-success").addClass("btn-secondary");
                } else {
                    alert("Lỗi khi đăng ký!");
                }
            },
            error: function() {
                alert("Lỗi kết nối server!");
            }
        });
    });
});
</script>

</body>
</html>