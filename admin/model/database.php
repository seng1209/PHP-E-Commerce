<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "e_commerce_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";

    // class Database{
    //     private $servername = "localhost";
    //     private $username = "root";
    //     private $password = "";
    //     private $db_name = "crud";
    //     private $conn;

    //     public function __construct()
    //     {
    //         try {
    //             $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db_name", $this->username, $this->password);
    //             // set the PDO error mode to exception
    //             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             // echo "Connected successfully";
    //             } catch(PDOException $e) {
    //             echo "Connection failed: " . $e->getMessage();
    //         }
    //     }

    //     public function query($sql){
    //         $this->conn->query($sql);
    //     }

    //     public function prepare($sql) {
    //         return $this->conn->prepare($sql);
    //     }

    //     public function getConnection() {
    //         return $this->conn;
    //     }
    // }
?>