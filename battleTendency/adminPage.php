<?php
require_once 'bootstrap.php';
if(isset($_GET["cf"]) && isset($_GET["action"])){
    $dbh->banUnbanUser($_GET["action"], $_GET["cf"]);
}
$templateParams["titolo"] = "BT - Admin"; //pagina home
$templateParams["nome"] = "adminPage.php";

$templateParams["utenti"] = $dbh->getUsers();
require 'template/base.php';
?>