<?php
require_once __DIR__ . "/../../controllers/HocPhanController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new HocPhanController();
    $controller->addHocPhan($_POST['maHocPhan'], $_POST['tenHocPhan'], $_POST['soTinChi']);
    header("Location: index.php");
}
?>

<form method="post">
    Mã Học Phần: <input type="text" name="maHocPhan" required><br>
    Tên Học Phần: <input type="text" name="tenHocPhan" required><br>
    Số Tín Chỉ: <input type="number" name="soTinChi" required><br>
    <button type="submit">Thêm</button>
</form>
