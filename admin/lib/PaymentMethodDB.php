<?php

    class PaymentMethodDB
    {
        private $conn;
        public function __construct()
        {
            $this->conn = Database::getConnection();
        }

        public function create($image, $name, $price, $description)
        {
            try {
                $stmt = $this->conn->prepare("INSERT INTO payment_methods (image, name, price, description) VALUES (:image, :name, :price, :description)");
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
                $stmt = $this->conn->prepare("UPDATE payment_methods SET image = :image, name = :name, price = :price, description = :description WHERE payment_method_id = :id");
                $stmt->execute(['image' => $image, 'name' => $name, 'price' => $price, 'description' => $description,  'id' => $id]);
                return true;
            }catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function delete($id)
        {
            try {
                $stmt = $this->conn->prepare("DELETE FROM payment_methods WHERE payment_method_id = :id");
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
                $stmt = $this->conn->prepare("DELETE FROM payment_methods");
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
                $stmt = $this->conn->prepare("SELECT * FROM payment_methods WHERE payment_method_id = :id");
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
                $stmt = $this->conn->prepare("SELECT * FROM payment_methods");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }    catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    }

?>