<?php

session_start();
if(!isset($_SESSION["connecte"])){
    header("Location: login.php");
    exit();
}

$_SESSION["connecte"]=false;
header("Location: ../index.php");


?>

