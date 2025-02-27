<?php
    class Shipping {
        private $db;

        public function __construct()
        {
            $this->db = Database::getConnection();
        }

        public function create($image, $shipping_name, $price){
            try {
                $stmt = $this->db->prepare("INSERT INTO shipping(image, shipping_name, price) VALUES (:image, :shipping_name, :price)");
                $stmt->execute(
                    [
                        'image' => $image,
                        'shipping_name' => $shipping_name,
                        'price' => $price   
                    ]
                );
                return true;
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function update($shipping_id, $image, $shipping_name, $price){
            try{
                $stmt = $this->db->prepare("UPDATE shipping SET image = :image, shipping_name = :shipping_name, price = :price WHERE shipping_id = :shipping_id");
                $stmt->execute(
                    [
                        'image' => $image, 
                        'shipping_name' => $shipping_name, 
                        'price' => $price, 
                        'shipping_id' => $shipping_id
                    ]
                );
                return true;
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function delete($shipping_id){
            try{
                $stmt = $this->db->prepare("DELETE FROM shipping WHERE shipping_id = :shipping_id");
                $stmt->execute(['shipping_id' => $shipping_id]);
                return true;
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function  deleteAll() {
            try{
                $stmt = $this->db->prepare("DELETE FROM shipping");
                $stmt->execute();
                return true;
            }catch(PDOException $ex){
                echo $ex;
                return false;
            }
        }

        public function read($shipping_id){
            try{
                $stmt = $this->db->prepare("SELECT * FROM shipping WHERE shipping_id = :shipping_id");
                $stmt->execute(['shipping_id' => $shipping_id]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

        public function readAll(){
            try{
                $stmt = $this->db->prepare("SELECT * FROM shipping");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){
                echo $ex->getMessage();
                return false;
            }
        }

    }
?>