<?php
    class Category {
        private $db;

        public function __construct()
        {
            $this->db = Database::getConnection();
        }

        public function create($image, $category, $description){
            try{
                $stmt = $this->db->prepare("INSERT INTO categories (image, category, description) VALUES (:image, :category, :description)");
                $stmt->execute(['image' => $image, 'category' => $category, 'description' => $description]);
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function update($category_id, $image, $category, $description){
            try{
                $stmt = $this->db->prepare("UPDATE categories SET image = :image, category = :category, description = :description WHERE category_id = :category_id");
                $stmt->execute(['image' => $image, 'category' => $category, 'description' => $description, 'category_id' => $category_id]);
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function delete($category_id){
            try{
                $stmt = $this->db->prepare("DELETE FROM categories WHERE category_id = :category_id");
                $stmt->execute(['category_id' => $category_id]);
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function deleteAll(){
            try{
                $stmt = $this->db->prepare("DELETE FROM categories");
                $stmt->execute();
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function read($category_id){
            try{
                $stmt = $this->db->prepare("SELECT * FROM categories WHERE category_id = :category_id");
                $stmt->execute(['category_id' => $category_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function readAll(){
            try{
                $stmt = $this->db->prepare("SELECT * FROM categories");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }
    }
?>