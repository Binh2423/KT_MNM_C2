<?php
require_once __DIR__ . "/../../config/Database.php";

class HocPhan {
    private $conn;
    private $table = "hocphan";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll() {
        try {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage()); // Debug lỗi SQL
        }
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($ma_hocphan, $ten_hocphan, $so_tinchi) {
        $query = "INSERT INTO " . $this->table . " (ma_hocphan, ten_hocphan, so_tinchi) VALUES (:ma_hocphan, :ten_hocphan, :so_tinchi)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ma_hocphan", $ma_hocphan);
        $stmt->bindParam(":ten_hocphan", $ten_hocphan);
        $stmt->bindParam(":so_tinchi", $so_tinchi);
        return $stmt->execute();
    }

    public function update($id, $ma_hocphan, $ten_hocphan, $so_tinchi) {
        $query = "UPDATE " . $this->table . " SET ma_hocphan = :ma_hocphan, ten_hocphan = :ten_hocphan, so_tinchi = :so_tinchi WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ma_hocphan", $ma_hocphan);
        $stmt->bindParam(":ten_hocphan", $ten_hocphan);
        $stmt->bindParam(":so_tinchi", $so_tinchi);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
