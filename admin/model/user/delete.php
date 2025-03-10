<?php

    require "../../lib/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    $row = $db->read("users", "*", "user_id = '$id'");
    try {
        if (file_exists("../../uploads/images/users/" . $row['image']))
            unlink("../../uploads/images/users/" . $row['image']);
        if ($db->delete("users", "user_id = '$id'")) {
            header('Location: ../../index.php?p=user');
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

?>