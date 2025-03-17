<?php
require_once __DIR__ . '/../models/HocPhan.php';

class HocPhanController {
    private $model;

    public function __construct() {
        $this->model = new HocPhan();
    }

    public function index() {
        $hocphans = $this->model->getAll();
    if (!$hocphans) {
        $hocphans = []; // Gán mảng rỗng nếu không có dữ liệu
    }
    include __DIR__ . '/../views/hocphan/index.php';
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->create($_POST["ma_hocphan"], $_POST["ten_hocphan"], $_POST["so_tinchi"]);
            header("Location: index.php");
        }
        include __DIR__ . '/../views/hocphan/create.php';
    }

    public function edit($id) {
        $hocphan = $this->model->getById($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model->update($id, $_POST["ma_hocphan"], $_POST["ten_hocphan"], $_POST["so_tinchi"]);
            header("Location: index.php");
        }
        include __DIR__ . '/../views/hocphan/edit.php';
    }

    public function delete($id) {
        $this->model->delete($id);
        header("Location: index.php");
    }
}
?>
