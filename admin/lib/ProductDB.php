<?php
    class Product {
        private $db;

        public function __construct()
        {
            $this->db = Database::getConnection();
        }

        public function create($image, $product_name, $price, $category_id, $brand_id, $description, $in_stock){
            try{
                $stmt = $this->db->prepare("INSERT INTO 
                products (image, product_name, price, category_id, brand_id, description, in_stock) 
                VALUE (:image, :product_name, :price, :category_id, :brand_id, :description, :in_stock)");
                $stmt->execute(
                    [
                        'image' => $image,
                        'product_name' => $product_name, 
                        'price' => $price, 
                        'category_id' => $category_id, 
                        'brand_id' => $brand_id, 
                        'description' => $description, 
                        'in_stock' => $in_stock
                    ]
                );
                return true;
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function update($product_id, $image, $product_name, $price, $category_id, $brand_id, $description, $in_stock){
            try{
                $stmt = $this->db->prepare("UPDATE products 
                SET image = :image, 
                product_name = :product_name, 
                price = :price, 
                category_id = :category_id, 
                brand_id = :brand_id, 
                description = :description, 
                in_stock = :in_stock 
                WHERE product_id = :product_id");
                $stmt->execute(
                    [
                        'image' => $image, 
                        'product_name' => $product_name, 
                        'price' => $price, 
                        'category_id' => $category_id, 
                        'brand_id' => $brand_id, 
                        'description' => $description, 
                        'in_stock' => $in_stock, 
                        'product_id' => $product_id
                    ]
                );
                return true;
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function delete($product_id){
            try{
                $stmt = $this->db->prepare("DELETE FROM products WHERE product_id = :product_id");
                $stmt->execute(['product_id' => $product_id]);
                return true;
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function deleteAll(){
            try{
                $this->db->query("DELETE FROM products");
                return true;
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function read($product_id){
            try{
                $stmt = $this->db->prepare("SELECT p.product_id, p.image, p.product_name, p.price, p.category_id, p.brand_id, p.description, p.in_stock, c.category, b.brand FROM categories AS c INNER JOIN products p ON c.category_id = p.category_id INNER JOIN brands b ON p.category_id = b.brand_id WHERE p.product_id = :product_id");
                $stmt->execute(['product_id' => $product_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function readAll(){
            try{
                $stmt = $this->db->prepare("SELECT * FROM products");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function readByCategory($category_id){
            try{
                $stmt = $this->db->prepare("SELECT * FROM products AS p WHERE p.category_id = :category_id");
                $stmt->execute(
                    [
                        'category_id' => $category_id
                    ]
                );
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }
    }
?>