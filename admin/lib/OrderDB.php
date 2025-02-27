<?php

    class OrderDB
    {
        private $conn;
        public function __construct()
        {
            $this->conn = Database::getConnection();
        }



    }

?>