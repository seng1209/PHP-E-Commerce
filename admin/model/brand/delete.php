<?php
    
    include "../database.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM brands WHERE brand_id = $id";
    try{
        if($conn->query($sql) === TRUE)
            header("Location:../../index.php?p=brand");
        else
            die("Cannot delete this brand.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>