<?php

class ShipmentMethodDB
{
    private $conn;

    public function __construct(){
        $this->conn = Database::getConnection();
    }

    public function create($image, $name, $price, $description)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO shipment_methods (image, name, price, description) VALUES (:image, :name, :price, :description)");
            $stmt->execute(['image' => $image, 'name' => $name, 'price' => $price, 'description' => $description]);
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $image, $name, $price, $description)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE shipment_methods SET image = :image, name = :name, price = :price, description = :description WHERE shipment_method_id = :id");
            $stmt->execute(['image' => $image, 'name' => $name, 'price' => $price, 'description' => $description, 'id' => $id]);
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM shipment_methods WHERE shipment_method_id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteAll()
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM shipment_methods");
            $stmt->execute();
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function read($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM shipment_methods WHERE shipment_method_id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function readAll()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM shipment_methods");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

}

?>