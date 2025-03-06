<?php

require "../../lib/Database.php";
$db = new Database();
$id = $_GET['id'];

try {
    if ($db->delete("payments", "payment_id='$id'"))
        header('location: ../../index.php?p=payment');
}catch (Exception $e){
    echo $e->getMessage();
}

?>