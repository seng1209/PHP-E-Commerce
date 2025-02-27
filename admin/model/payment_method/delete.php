<?php

    require "../../lib/Database.php";
    require "../../lib/PaymentMethodDB.php";
    $paymentMethodObj = new PaymentMethodDB();
    $id = $_GET['id'];

    try {
        if ($paymentMethodObj->delete($id) === true) {
            header("Location: ../../index.php?p=payment-method");
        }
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }

?>