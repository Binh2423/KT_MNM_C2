require_once "../controllers/DangKyHocPhanController.php";
$controller = new DangKyHocPhanController();

if (isset($_GET['MaSV'])) {
    $controller->deleteAllCourses($_GET['MaSV']);
}

header("Location: dangky_hocphan.php");
exit();
