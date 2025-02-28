<?php
    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    try{
        if($db->delete("products", "product_id = '$id'") === TRUE)
            header("Location:../../index.php?p=product");
        else
            die("Cannot delete this product.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>