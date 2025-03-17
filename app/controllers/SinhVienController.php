<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/SinhVien.php";

class SinhVienController {
    private $model;

    public function __construct() {
        $this->model = new SinhVien();
    }

    // ✅ Lấy danh sách sinh viên
    public function index() {
        return $this->model->getAll();
    }

    // ✅ Lấy thông tin sinh viên theo mã SV
    public function getSinhVien($maSV) {
        return $this->model->getById($maSV);
    }

    // ✅ Thêm sinh viên mới
    public function addSinhVien($hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        return $this->model->insert($hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
    }

    // ✅ Cập nhật sinh viên
    public function updateSinhVien($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        return $this->model->update($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
    }

    // ✅ Xóa sinh viên
    public function deleteSinhVien($maSV) {
        return $this->model->delete($maSV);
    }
}
?>
