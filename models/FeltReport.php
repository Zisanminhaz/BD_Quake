<?php

class FeltReport
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO felt_reports
                (user_id, district, location_description, intensity, building_type, comments)
                VALUES (:user_id, :district, :location_description, :intensity, :building_type, :comments)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getRecent(int $limit = 20): array
    {
        $sql = "SELECT fr.*, u.name AS reporter_name
                FROM felt_reports fr
                LEFT JOIN users u ON fr.user_id = u.id
                ORDER BY fr.created_at DESC
                LIMIT :limit_num";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit_num', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAll(): array
    {
        $sql = "SELECT fr.*, u.name AS reporter_name
                FROM felt_reports fr
                LEFT JOIN users u ON fr.user_id = u.id
                ORDER BY fr.created_at DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM felt_reports WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
