<?php
    require "../../lib/Database.php";
    require "../../lib/CategoryDB.php";
    $id = $_GET['id'];
    $categoryObj = new Category();
    try{
        if($categoryObj->delete($id) === TRUE)
            header("Location:../../index.php?p=category");
        else
            die("Cannot delete this category.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>