<?php
require "../../lib/Database.php";
$db = new Database();
$id = $_GET['id'];
$row = $db->read("slideshow", "*", "ss_id = '$id'");
try {
    if (file_exists("../../uploads/images/slider/" . $row['image']))
        unlink("../../uploads/images/slider/" . $row['image']);
    if ($db->delete("slideshow", "ss_id = '$id'"))
        header("Location: ../../index.php?p=slideshow");
    else
        throw new Exception();
}catch (Exception $e){
    echo $e->getMessage();
}
?>