<?php

class Shelter
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll(?string $district = null)
    {
        if ($district) {
            $sql = "SELECT * FROM shelters
                    WHERE district LIKE :district
                    ORDER BY district, name";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':district', '%' . $district . '%', PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT * FROM shelters ORDER BY district, name";
            return $this->conn->query($sql)->fetchAll();
        }
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO shelters (name, type, address, district, latitude, longitude)
                VALUES (:name, :type, :address, :district, :latitude, :longitude)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE shelters
                SET name = :name,
                    type = :type,
                    address = :address,
                    district = :district,
                    latitude = :latitude,
                    longitude = :longitude
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM shelters WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
