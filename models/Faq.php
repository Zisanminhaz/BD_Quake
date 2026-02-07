<?php

class Faq
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll()
    {
        return $this->conn->query("SELECT * FROM faqs ORDER BY id DESC")->fetchAll();
    }

    public function create($data)
    {
        $sql = "INSERT INTO faqs (question, answer)
                VALUES (:question, :answer)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE faqs SET question = :question, answer = :answer WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM faqs WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
