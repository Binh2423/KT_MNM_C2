<?php
require_once __DIR__ . "/../models/DangKyHocPhan.php";

class DangKyHocPhanController {
    private $model;

    public function __construct() {
        $this->model = new DangKyHocPhan();
    }

    public function addCourse($MaSV, $MaHP) {
        return $this->model->addCourse($MaSV, $MaHP);
    }
    
    public function getRegisteredCourses($MaSV) {
        return $this->model->getRegisteredCourses($MaSV);
    }
    
    public function deleteCourse($MaSV, $MaHP) {
        return $this->model->deleteCourse($MaSV, $MaHP);
    }
    
    public function deleteAllCourses($MaSV) {
        return $this->model->deleteAllCourses($MaSV);
    }
    
}
?>
