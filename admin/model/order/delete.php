<?php

require "../../lib/Database.php";
$db = new Database();
$id = $_GET["id"];

try {
    if ($db->delete("orders", "order_id = '$id'"))
        header("location: ../../index.php?p=order");
}catch (Exception $e){
    echo $e->getMessage();
}

?>