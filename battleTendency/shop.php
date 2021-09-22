<?php
require_once 'bootstrap.php';

if(isUserLoggedIn()){
    $templateParams["titolo"] = "BT - Carrello";
    $templateParams["nome"] = "template/shop.php";
    if(isset($_POST["quantità"]) && $_POST["quantità"]!=0){
        $idevento = $_POST['idevento'];
        $tipo = $_POST['tipo'];
        $q = $_POST['quantità'];
        
        $max = $dbh->getTicketLeftByType($idevento, $_POST["tipo"])[0];
        if($q<= $max["bigliettidisponibili"]){
            if(!isset($_SESSION["shopping-cart"])){ //se non esiste un carrello, alloca il carrello
                $_SESSION["shopping-cart"]= [];
            }

            foreach($_SESSION["shopping-cart"] as $key => $value){       //controlla che l'oggetto non sia gia' nel carrello
                if($value["idevento"]==$idevento && $value["tipo"]==$tipo){
                    $_SESSION["shopping-cart"][$key] = array('idevento'=>$idevento, 'tipo'=>$tipo,'prezzo'=>$dbh->getPrezzo($idevento, $tipo)[0]["prezzo"], 'quantità'=>$q);
                    $present=1;
                }
            }
            $itemArray = array('idevento'=>$idevento, 'tipo'=>$tipo,'prezzo'=>$dbh->getPrezzo($idevento, $tipo)[0]["prezzo"], 'quantità'=>$q);
                if(!isset($present)){
                   array_push($_SESSION["shopping-cart"], $itemArray);
                }
        }
        else {
            header("location:buyTicket.php?idevento=$idevento&err=Quantità superiore alla disponibilità!");

        }
                

    }
    if(isset($_GET["key"]) && isset($_SESSION["shopping-cart"])){
        unset($_SESSION["shopping-cart"][$_GET["key"]]);
        if(count($_SESSION["shopping-cart"])==0){
            unset($_SESSION["shopping-cart"]);
        }
    }

}
else {
    header('location: login.php?from=shop.php');
}

require 'template/base.php';
?>