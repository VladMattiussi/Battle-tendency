<?php
require_once 'bootstrap.php';
if(isset($_GET["idfighter"])){
    $templateParams["titolo"] = "BT - Combattente"; //pagina combattenti
    $templateParams["nome"] = "template/fighter.php";

    $templateParams["combattente"] = $dbh ->getFighterByID($_GET["idfighter"]);

}
else {
    $templateParams["titolo"] = "BT - Combattenti"; //pagina combattenti
    $templateParams["nome"] = "template/fighters.php";
    $templateParams["combattenti"] = $dbh->getFighters();

}

require 'template/base.php';
?>