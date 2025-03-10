<?php
    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    $row = $db->read("brands", "*", "brand_id = '$id'");
    try{
        if (file_exists("../../uploads/images/brands/" . $row['image']))
            unlink("../../uploads/images/brands/" . $row['image']);
        if($db->delete("brands", "brand_id = " . $id) === TRUE)
            header("Location:../../index.php?p=brand");
        else
            die("Cannot delete this brand.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>