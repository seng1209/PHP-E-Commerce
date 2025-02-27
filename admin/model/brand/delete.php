<?php
    require "../../lib/Database.php";
    require "../../lib/BrandDB.php";
    $id = $_GET['id'];
    $brandObj = new Brand();
    try{
        if($brandObj->delete($id) === TRUE)
            header("Location:../../index.php?p=brand");
        else
            die("Cannot delete this brand.");
    }catch(Exception $ex){
        echo $ex;
    }
    
?>