<?php
require_once 'bootstrap.php';
if(isUserLoggedIn()){
    $templateParams["titolo"] = "BT - Notifiche";
    $templateParams["nome"] = "template/notifiche.php";
    $templateParams["notifiche"] = $dbh->getMessaggiByCF($_SESSION["CF"]); //raccoglie tutti i messaggi dell'utente loggato
    foreach($templateParams["notifiche"] as $notifica){
        $update_result = $dbh->updateMessaggio($notifica["IdMessaggio"]); //segna i messaggi come messaggi letti
    }
    if(isset($_GET["idmessaggio"])){
        $idmessaggio = $_GET["idmessaggio"];
        $delete_result = $dbh -> deleteMessaggioByID($idmessaggio); //cancella il messaggio scelto
    }
}
else{
    header('location: login.php?from=Notifiche.php');
}

require 'template/base.php';
?>