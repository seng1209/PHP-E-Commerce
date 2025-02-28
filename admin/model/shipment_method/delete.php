<?php
    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];

    try {
        if ($db->delete("shipment_methods", "shipment_method_id = '$id'") === true) {
            header('location: ../../index.php?p=shipment-method');
        }
    }catch (Exception $e){
        echo $e->getMessage();
        return;
    }


?>