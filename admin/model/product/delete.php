<?php
    
    include "../database.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE product_id = $id";
    try{
        if($conn->query($sql) === TRUE)
            header("Location:../../index.php?p=product");
        else
            die("Cannot delete this product.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>