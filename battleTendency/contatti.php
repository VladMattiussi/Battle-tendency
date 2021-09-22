<?php
require_once 'bootstrap.php';
$templateParams["titolo"] = "BT - Contatti";
$templateParams["nome"] = "template/contatti.php";

$templateParams["prossimieventi"] = $dbh->getNextEvents(2);
$templateParams["contatti"]=$dbh->getContacts();
require 'template/base.php';
?>