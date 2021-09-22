<?php
require_once 'bootstrap.php';
$templateParams["titolo"] = "BT - Suggerimenti"; //pagina dei suggerimenti
$templateParams["nome"] = "template/home.php"; //prende lo stesso 'template' della pagina home.php
$templateParams["eventi"] = $dbh->getRandomEvents(3);
require 'template/base.php';
?>