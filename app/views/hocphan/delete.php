<?php
require_once __DIR__ . "/../../controllers/HocPhanController.php";
$controller = new HocPhanController();
$controller->deleteHocPhan($_GET['id']);
header("Location: index.php");
?>
