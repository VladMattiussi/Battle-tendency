<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "BT - Home"; //pagina home
$templateParams["nome"] = "home.php";

$templateParams["eventi"] = $dbh->getEvents();
require 'template/base.php';
?>