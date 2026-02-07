<?php

class Guideline
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM guidelines ORDER BY category, id";
        return $this->conn->query($sql)->fetchAll();
    }

    public function create($data)
    {
        $sql = "INSERT INTO guidelines (title, content, category)
                VALUES (:title, :content, :category)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE guidelines
                SET title = :title, content = :content, category = :category
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM guidelines WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
