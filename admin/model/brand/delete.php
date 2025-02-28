<?php
    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    try{
        if($db->delete("brands", "brand_id = " . $id) === TRUE)
            header("Location:../../index.php?p=brand");
        else
            die("Cannot delete this brand.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>