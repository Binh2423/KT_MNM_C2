<?php
require_once "../controllers/SinhVienController.php";

$controller = isset($_GET["controller"]) ? $_GET["controller"] : "sinhvien";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";

if ($controller == "sinhvien") {
    $svController = new SinhVienController();
    if ($action == "index") {
        $svController->index();
    } elseif ($action == "create") {
        $svController->create();
    } elseif ($action == "edit" && isset($_GET["id"])) {
        $svController->edit($_GET["id"]);
    } elseif ($action == "delete" && isset($_GET["id"])) {
        $svController->delete($_GET["id"]);
    }
}
?>
