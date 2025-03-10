<?php

    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    $row = $db->read("payment_methods", "*", "payment_method_id = '$id'");
    try {
        if (file_exists("../../uploads/images/payment_methods/" . $row['image'])) {}
            unlink("../../uploads/images/payment_methods/" . $row['image']);
        if ($db->delete("payment_methods", "payment_method_id = '$id'") === true) {
            header("Location: ../../index.php?p=payment-method");
        }
    }catch (Exception $e){
        echo $e->getMessage();
        return false;
    }

?>