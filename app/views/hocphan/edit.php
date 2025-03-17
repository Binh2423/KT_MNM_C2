<?php
require_once __DIR__ . "/../../controllers/HocPhanController.php";
$controller = new HocPhanController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->updateHocPhan($_POST['maHocPhan'], $_POST['tenHocPhan'], $_POST['soTinChi']);
    header("Location: index.php");
}

$hocPhan = $controller->getHocPhan($_GET['id']);
?>

<form method="post">
    <input type="hidden" name="maHocPhan" value="<?= $hocPhan['MaHocPhan'] ?>">
    Tên Học Phần: <input type="text" name="tenHocPhan" value="<?= $hocPhan['TenHocPhan'] ?>" required><br>
    Số Tín Chỉ: <input type="number" name="soTinChi" value="<?= $hocPhan['SoTinChi'] ?>" required><br>
    <button type="submit">Cập nhật</button>
</form>
