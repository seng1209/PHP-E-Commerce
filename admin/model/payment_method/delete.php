<?php

    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];

    try {
        if ($db->delete("payment_methods", "payment_method_id = '$id'") === true) {
            header("Location: ../../index.php?p=payment-method");
        }
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }

?>