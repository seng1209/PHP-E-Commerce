<?php
    require "../../lib/Database.php";
    $id = $_GET['id'];
    $db = new Database();
    try{
        if($db->delete("categories", "category_id = '$id'") === TRUE)
            header("Location:../../index.php?p=category");
        else
            die("Cannot delete this category.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>