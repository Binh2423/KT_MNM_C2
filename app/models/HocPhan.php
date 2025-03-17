<?php
require_once __DIR__ . "/../../config/database.php";

class HocPhan {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // ✅ Lấy danh sách học phần
    public function getAll() {
        $query = "SELECT * FROM hocphan";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Lấy học phần theo mã
    public function getById($maHocPhan) {
        $query = "SELECT * FROM hocphan WHERE MaHocPhan = :maHocPhan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maHocPhan", $maHocPhan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Thêm học phần
    public function insert($maHocPhan, $tenHocPhan, $soTinChi) {
        $query = "INSERT INTO hocphan (MaHocPhan, TenHocPhan, SoTinChi) VALUES (:maHocPhan, :tenHocPhan, :soTinChi)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maHocPhan", $maHocPhan);
        $stmt->bindParam(":tenHocPhan", $tenHocPhan);
        $stmt->bindParam(":soTinChi", $soTinChi);
        return $stmt->execute();
    }

    // ✅ Cập nhật học phần
    public function update($maHocPhan, $tenHocPhan, $soTinChi) {
        $query = "UPDATE hocphan SET TenHocPhan = :tenHocPhan, SoTinChi = :soTinChi WHERE MaHocPhan = :maHocPhan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maHocPhan", $maHocPhan);
        $stmt->bindParam(":tenHocPhan", $tenHocPhan);
        $stmt->bindParam(":soTinChi", $soTinChi);
        return $stmt->execute();
    }

    // ✅ Xóa học phần
    public function delete($maHocPhan) {
        $query = "DELETE FROM hocphan WHERE MaHocPhan = :maHocPhan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":maHocPhan", $maHocPhan);
        return $stmt->execute();
    }
}
?>
