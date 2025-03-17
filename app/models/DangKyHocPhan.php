<?php
require_once __DIR__ . "/../../config/database.php";

class DangKyHocPhan {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function addCourse($MaSV, $MaHP) {
        $this->conn->beginTransaction();
        try {
            // Kiểm tra xem đã có MaDK chưa
            $query = "SELECT MaDK FROM DangKy WHERE MaSV = :MaSV";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':MaSV' => $MaSV]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                $MaDK = $result['MaDK'];
            } else {
                // Tạo MaDK mới
                $query = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), :MaSV)";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([':MaSV' => $MaSV]);
                $MaDK = $this->conn->lastInsertId();
            }
    
            // Thêm học phần vào ChiTietDangKy
            $query = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (:MaDK, :MaHP)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':MaDK' => $MaDK, ':MaHP' => $MaHP]);
    
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
    public function getRegisteredCourses($MaSV) {
        $query = "SELECT hp.MaHP, hp.TenHP, hp.SoTinChi 
                  FROM ChiTietDangKy ctdk
                  JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                  JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
                  WHERE dk.MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':MaSV' => $MaSV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteCourse($MaSV, $MaHP) {
        $query = "DELETE ctdk FROM ChiTietDangKy ctdk
                  JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                  WHERE dk.MaSV = :MaSV AND ctdk.MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':MaSV' => $MaSV, ':MaHP' => $MaHP]);
    }
    public function deleteAllCourses($MaSV) {
        $this->conn->beginTransaction();
        try {
            // Xóa trong bảng ChiTietDangKy
            $query = "DELETE ctdk FROM ChiTietDangKy ctdk
                      JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                      WHERE dk.MaSV = :MaSV";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':MaSV' => $MaSV]);
    
            // Xóa trong bảng DangKy
            $query = "DELETE FROM DangKy WHERE MaSV = :MaSV";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':MaSV' => $MaSV]);
    
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
?>
