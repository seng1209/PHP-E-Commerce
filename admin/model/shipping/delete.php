<?php
    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    if($db->delete("shipping","shipping_id=$id")){
        header("Location:../../index.php?p=shipping");
    }else{
        echo "Shipping cannot delete";
    }

?>