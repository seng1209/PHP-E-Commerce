<?php
    require "../../lib/Database.php";
    require "../../lib/ShipmentMethodDB.php";
    $shipmentMethodDB = new ShipmentMethodDB();
    $id = $_GET['id'];

    try {
        if ($shipmentMethodDB->delete($id) === true) {
            header('location: ../../index.php?p=shipment-method');
        }
    }catch (Exception $e){
        echo $e->getMessage();
        return;
    }


?>