<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "BT - Evento";
$templateParams["nome"] = "template/evento.php";
//Home Template
$idevento = -1;
if(isset($_GET["idevento"])){
    $idevento = $_GET["idevento"];
}
$templateParams["evento"] = $dbh->getEventByID($idevento);
$templateParams["bigliettidisponibili"] = $dbh->getTicketLeft($idevento)[0]["bigliettidisponibili"];

require 'template/base.php';
?>