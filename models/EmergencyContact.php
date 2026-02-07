<?php

class EmergencyContact
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll()
    {
        return $this->conn->query("SELECT * FROM emergency_contacts ORDER BY id")->fetchAll();
    }

    public function create($data)
    {
        $sql = "INSERT INTO emergency_contacts (name, phone, type, district)
                VALUES (:name, :phone, :type, :district)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE emergency_contacts
                SET name = :name, phone = :phone, type = :type, district = :district
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM emergency_contacts WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
