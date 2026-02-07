<?php

class UnsafeBuilding
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($data)
    {
        $sql = "INSERT INTO unsafe_buildings
                (user_id, building_name, address, district, description, severity, status, photo_path)
                VALUES (:user_id, :building_name, :address, :district, :description, :severity, 'pending', :photo_path)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll()
    {
        $sql = "SELECT ub.*, u.name AS reporter
                FROM unsafe_buildings ub
                LEFT JOIN users u ON ub.user_id = u.id
                ORDER BY ub.created_at DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE unsafe_buildings SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM unsafe_buildings WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
