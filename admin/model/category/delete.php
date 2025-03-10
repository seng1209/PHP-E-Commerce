<?php
    require "../../lib/Database.php";
    $id = $_GET['id'];
    $db = new Database();
    $row = $db->read("categories", "*", "category_id = '$id'");
    try{
        if (file_exists("../../uploads/images/categories/" . $row['image']))
            unlink("../../uploads/images/categories/" . $row['image']);
        if($db->delete("categories", "category_id = '$id'") === TRUE)
            header("Location:../../index.php?p=category");
        else
            die("Cannot delete this category.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>