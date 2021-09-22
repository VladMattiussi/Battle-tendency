<?php
require_once 'bootstrap.php';
if(isUserLoggedIn()){
    $templateParams["titolo"] = "BT - I miei eventi";
    $templateParams["nome"] = "template/myEvents.php";
    $templateParams["biglietti"] = $dbh->getTicketsByCF($_SESSION["CF"]);
    $templateParams["eventi"] = $dbh->getEventsByCF($_SESSION["CF"]);
}
else{
    header('location: login.php?from=myEvents.php');
}

require 'template/base.php';
?>