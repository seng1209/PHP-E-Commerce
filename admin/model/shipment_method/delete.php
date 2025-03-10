<?php
    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    $row = $db->read("shipment_methods", "*", "shipment_method_id = '$id'");
    try {
        if (file_exists("../../uploads/images/shipment_methods/" . $row['image'])) {}
            unlink("../../uploads/images/shipment_methods/" . $row['image']);
        if ($db->delete("shipment_methods", "shipment_method_id = '$id'") === true) {
            header('location: ../../index.php?p=shipment-method');
        }
    }catch (Exception $e){
        echo $e->getMessage();
        return;
    }


?>