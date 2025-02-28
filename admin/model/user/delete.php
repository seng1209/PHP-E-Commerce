<?php

    require "../../lib/Database.php";
    $db = new Database();

    $id = $_GET['id'];
    try {
        if ($db->delete("users", "user_id = '$id'")) {
            header('Location: ../../index.php?p=user');
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

?>