<?php
require_once 'bootstrap.php';

//Base Template (porta alla pagina template/buyTicket.php)
$templateParams["titolo"] = "BT - Acquista biglietti";
$templateParams["nome"] = "template/buyTicket.php";
$idevento = -1;
if(isset($_GET["idevento"])){
    $idevento = $_GET["idevento"];
}
if(isUserLoggedIn()){ 
    if($_SESSION["numerotipo"]==0 || $_SESSION["numerotipo"]==1) { //se utente è organizzatore o ADMIN
        header("location:evento.php?idevento=$idevento&err=Solo gli utenti possono comprare biglietti!");
    }
    if(isset($_GET["idevento"])){
        $templateParams["idevento"]= $idevento;
        $templateParams["tipibiglietti"] = $dbh->getTicketTypes($idevento); //memorizza tutti i tipi di biglietto (esclusi quelli sold out), dato un evento
        foreach($templateParams["tipibiglietti"] as $biglietto){
            $index = $biglietto["tipo"];
            $templateParams[$index] = $dbh->getTicketLeftByType($idevento, $biglietto["tipo"])[0]; //memorizza quanti biglietti sono rimasti, per ciascun tipo
        }   
    }
    else if(isset($_GET["action"])){
        if(isset($_SESSION["shopping-cart"])){
            foreach($_SESSION["shopping-cart"] as $item){   //per ogni Tipo di biglietto nel carrello (es. prima fila, seconda fila...)
                for($i = 0; $i<$item["quantità"]; $i++){    //per ogni quantità(es. prima fila:10 biglietti, seconda fila:4 biglietti...)
                    $numero = $dbh->getFirstFreeTicketNumber($item["idevento"], $item["tipo"])[0]["numero"]; //primo biglietto "libero" nel db
                    $buy_result = $dbh->buyTicket($item["idevento"], $item["tipo"], $numero, $_SESSION["CF"]); //aggiorna il biglietto con il CF del compratore
                    $bigliettiDisponibili = $dbh->getTicketLeft($item["idevento"])[0]["bigliettidisponibili"];//se i biglietti si esauriscono DOPO che qualcuno compra, manda un messaggio all'organizzatore
                    if($bigliettiDisponibili == 0){
                        $idevento=$item["idevento"];
                        $evento = $dbh ->getEventByID($item["idevento"])[0];
                        $dbh -> insertMessage("i biglietti dell'evento <a href='evento.php?idevento=$idevento'>".$evento['Nome']."</a> sono esauriti!",$evento["CF"], "0"); //0 è il CF dell'amministratore di sistema

                    }
                }
                
                
            }
        }
        unset($_SESSION["shopping-cart"]);
        $templateParams["titolo"] = "BT - OK!";
        $templateParams["nome"] = "template/success.php";  
    }
    else {
        //404 event not found
    }
}
else {
    header("location:login.php?from=evento.php?idevento=$idevento");
}



require 'template/base.php';
?>