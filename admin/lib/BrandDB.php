<?php
    class Brand {
        private $db;

        public function __construct()
        {
            $this->db = Database::getConnection();
        }

        public function create($image, $brand, $description){
            try{
                $stmt = $this->db->prepare("INSERT INTO brands(image, brand, description) VALUES (:image, :brand, :description)");
                $stmt->execute(['image' => $image, 'brand' => $brand, 'description' => $description]);
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function update($brand_id, $image, $brand, $description){
            try{
                $stmt = $this->db->prepare("UPDATE brands SET image = :image, brand = :brand, description = :description WHERE brand_id = :brand_id");
                $stmt->execute(['image' => $image, 'brand' => $brand, 'description' => $description, 'brand_id' => $brand_id]);
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function delete($brand_id){
            try{
                $stmt = $this->db->prepare("DELETE FROM brands WHERE brand_id = :brand_id");
                $stmt->execute(['brand_id' => $brand_id]);
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function deleteAll(){
            try{
                $stmt = $this->db->prepare("DELETE FROM brands");
                $stmt->execute();
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function read($brand_id){
            try{
                $stmt = $this->db->prepare("SELECT * FROM brands WHERE brand_id = :brand_id");
                $stmt->execute(['brand_id' => $brand_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function readAll(){
            try{
                $stmt = $this->db->query("SELECT * FROM brands"); 
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

    }
?>