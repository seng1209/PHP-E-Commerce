<?php
    require "../../lib/Database.php";
    require "../../lib/ShippingDB.php";
    $db = new Database();
    $shippingObj = new Shipping($db);
    $id = $_GET['id'];
    if($shippingObj->delete($id)){
        header("Location:../../index.php?p=shipping");
    }else{
        echo "Shipping cannot delete";
    }

?>