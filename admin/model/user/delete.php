<?php

    require "../../lib/Database.php";
    require "../../lib/UserDB.php";
    $userObj = new UserDB();

    $id = $_GET['id'];
    try {
        if ($userObj->delete($id)){
            header('Location: ../../index.php?p=user');
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }

?>