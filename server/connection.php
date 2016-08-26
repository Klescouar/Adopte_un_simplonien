<?php
session_start();

require 'class/PdoManage.php';
require 'class/DBconnect.php';

$db = DBconnect::getPDO();
$dbManage = new PdoManage($db);

$connect = $dbManage->connection($_POST['pseudo'], $_POST['password']);

if ($connect['permission'] != false){
    $_SESSION['pseudo'] = $connect['pseudo'];
    $_SESSION['permission'] = $connect['permission'];
}

$redirection = htmlspecialchars($_POST['page']);
header('Location: ../'.$redirection)
?>
