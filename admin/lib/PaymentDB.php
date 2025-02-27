<?php

class PaymentDB
{
    private $conn;

    public function __construct(){
        $this->conn = Database::getConnection();
    }

    public  function create()
    {

    }
}

?>