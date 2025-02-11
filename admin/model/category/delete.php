<?php
    
    include "../database.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM categories WHERE category_id = $id";
    try{
        if($conn->query($sql) === TRUE)
            header("Location:../../index.php?p=category");
        else
            die("Cannot delete this category.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>