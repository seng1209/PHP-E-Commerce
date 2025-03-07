<?php
require "../../lib/Database.php";
$db = new Database();
$id = $_GET["id"];
try {
    if ($db->delete("order_products", "order_product_id='$id'"))
        header("location: ../../index.php?p=order-product");
}catch (Exception $e){
    echo $e->getMessage();
}
?>