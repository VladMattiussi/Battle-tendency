z<?php
require_once 'bootstrap.php';
if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
    else{
        //login riuscito
        if($login_result[0]["Attivo"]==0){
            $templateParams["errorelogin"] = "Errore! L'utente e' stato bannato da un amministratore!";

        }
        else{
            registerLoggedUser($login_result[0]);

        }
        
    }
}
if(isUserLoggedIn()){
    if(isset($_GET['from'])){       //se from è settato, re-indirizza l'utente nella pagina da cui è venuto
        header('location:'.$_GET['from']);
    }
    else {
        header('location:index.php');
    }
}
else{
    $templateParams["titolo"] = "BT - Login";
    $templateParams["nome"] = "template/login.php";
}
require 'template/base.php';
?>