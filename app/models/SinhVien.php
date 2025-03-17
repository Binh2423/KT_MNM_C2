<?php
require_once __DIR__ . "/../../config/database.php";

class SinhVien {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // ✅ Lấy danh sách sinh viên
    public function getAll() {
        $query = "SELECT * FROM sinhvien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Lấy sinh viên theo ID
    public function getById($maSV) {
        $query = "SELECT * FROM sinhvien WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maSV", $maSV);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Thêm sinh viên
    public function insert($hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        // Lấy số sinh viên hiện có để tạo MaSV mới
        $queryCount = "SELECT COUNT(*) as total FROM sinhvien";
        $stmtCount = $this->conn->query($queryCount);
        $row = $stmtCount->fetch(PDO::FETCH_ASSOC);
        $soThuTu = $row['total'] + 1;
    
        // Tạo MaSV dựa trên năm hiện tại + số thứ tự (VD: 20240001)
        $namHienTai = date("Y");
        $maSV = $namHienTai . str_pad($soThuTu, 4, "0", STR_PAD_LEFT);
    
        // Câu lệnh INSERT
        $query = "INSERT INTO sinhvien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                  VALUES (:maSV, :hoTen, :gioiTinh, :ngaySinh, :hinh, :maNganh)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maSV", $maSV);
        $stmt->bindParam(":hoTen", $hoTen);
        $stmt->bindParam(":gioiTinh", $gioiTinh);
        $stmt->bindParam(":ngaySinh", $ngaySinh);
        $stmt->bindParam(":hinh", $hinh);
        $stmt->bindParam(":maNganh", $maNganh);
    
        return $stmt->execute();
    }
    

    // ✅ Cập nhật sinh viên
    public function update($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $query = "UPDATE sinhvien SET HoTen = :hoTen, GioiTinh = :gioiTinh, NgaySinh = :ngaySinh, Hinh = :hinh, MaNganh = :maNganh WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maSV", $maSV);
        $stmt->bindParam(":hoTen", $hoTen);
        $stmt->bindParam(":gioiTinh", $gioiTinh);
        $stmt->bindParam(":ngaySinh", $ngaySinh);
        $stmt->bindParam(":hinh", $hinh);
        $stmt->bindParam(":maNganh", $maNganh);
        return $stmt->execute();
    }

    // ✅ Xóa sinh viên
    public function delete($maSV) {
        $query = "DELETE FROM sinhvien WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maSV", $maSV);
        return $stmt->execute();
    }
}
?>
