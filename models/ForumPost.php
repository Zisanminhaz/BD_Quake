<?php

class ForumPost
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT fp.*, u.name AS author_name
                FROM forum_posts fp
                LEFT JOIN users u ON fp.user_id = u.id
                ORDER BY fp.created_at DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function getByUser(int $userId)
    {
        $sql = "SELECT fp.*, u.name AS author_name
                FROM forum_posts fp
                LEFT JOIN users u ON fp.user_id = u.id
                WHERE fp.user_id = :uid
                ORDER BY fp.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }

    public function getById(int $id)
    {
        $sql = "SELECT fp.*, u.name AS author_name
                FROM forum_posts fp
                LEFT JOIN users u ON fp.user_id = u.id
                WHERE fp.id = :id
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO forum_posts (user_id, title, body, category)
                VALUES (:user_id, :title, :body, :category)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE forum_posts
                SET title = :title,
                    body = :body,
                    category = :category
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM forum_posts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
