<?php

    class UserDB
    {
        private $conn;

        public function __construct()
        {
            $this->conn = Database::getConnection();
        }

        public function create($image, $username, $password, $email, $phone, $address, $role)
        {
            try {
                $stmt = $this->conn->prepare("INSERT INTO users (image, username, password, email, phone, address, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $image);
                $stmt->bindParam(2, $username);
                $stmt->bindParam(3, $password);
                $stmt->bindParam(4, $email);
                $stmt->bindParam(5, $phone);
                $stmt->bindParam(6, $address);
                $stmt->bindParam(7, $role);
                $stmt->execute();
                return true;
            }catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function update($id, $image, $username, $password, $email, $phone, $address, $role)
        {
            try {
                $stmt = $this->conn->prepare("UPDATE users SET image = :image, username = :username, password = :password, email = :email, phone = :phone, address = :address, role = :role WHERE user_id = :id");
                $stmt->execute(['image' => $image, 'username' => $username, 'password' => $password, 'email' => $email, 'phone' => $phone, 'address' => $address, 'role' => $role, 'id' => $id]);
                return true;
            }catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function delete($id)
        {
            try {
                $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = :id");
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
                $stmt = $this->conn->prepare("DELETE FROM users");
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
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = :id");
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
                $stmt = $this->conn->prepare("SELECT * FROM users");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    }