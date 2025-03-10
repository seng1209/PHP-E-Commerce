<?php
    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    $row = $db->read("products", "*", "product_id = '$id'");
    try{
        if (file_exists("../../uploads/images/products/" . $row['image']))
            unlink("../../uploads/images/products/" . $row['image']);
        if($db->delete("products", "product_id = '$id'") === TRUE)
            header("Location:../../index.php?p=product");
        else
            die("Cannot delete this product.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>