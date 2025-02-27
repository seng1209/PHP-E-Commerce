<?php
    require "../../lib/Database.php";
    require "../../lib/ProductDB.php";
    $productObj = new Product();
    $id = $_GET['id'];
    try{
        if($productObj->delete($id) === TRUE)
            header("Location:../../index.php?p=product");
        else
            die("Cannot delete this product.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>