<?php
require "./lib/Database.php";
$db = new Database();
require "./lib/Auth.php";
$auth = new Auth();
if ($auth->logout())
    header('Location: ./login.php');
?>

