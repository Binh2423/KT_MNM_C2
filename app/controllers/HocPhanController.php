<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/HocPhan.php";

class HocPhanController {
    private $model;

    public function __construct() {
        $this->model = new HocPhan();
    }

    // ✅ Lấy danh sách học phần
    public function index() {
        return $this->model->getAll();
    }

    // ✅ Lấy thông tin học phần theo mã
    public function getHocPhan($maHocPhan) {
        return $this->model->getById($maHocPhan);
    }

    // ✅ Thêm học phần
    public function addHocPhan($maHocPhan, $tenHocPhan, $soTinChi) {
        return $this->model->insert($maHocPhan, $tenHocPhan, $soTinChi);
    }

    // ✅ Cập nhật học phần
    public function updateHocPhan($maHocPhan, $tenHocPhan, $soTinChi) {
        return $this->model->update($maHocPhan, $tenHocPhan, $soTinChi);
    }

    // ✅ Xóa học phần
    public function deleteHocPhan($maHocPhan) {
        return $this->model->delete($maHocPhan);
    }
}

?>
