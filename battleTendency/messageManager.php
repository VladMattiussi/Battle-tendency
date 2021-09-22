<?php
require_once 'bootstrap.php';

if(isUserLoggedIn()){
    if(isset($_POST['testo'])){
        $dbh->insertMessage($_POST['testo'], $_POST["cfd"], $_POST["cfm"] );
        $templateParams["titolo"]="BT - Messaggio inviato!";
        $templateParams["nome"]="template/success.php";
    }
    elseif (isset($_GET['cfm']) && isset($_GET['cfd'])){
        $templateParams["titolo"]="BT - Invia un messaggio";
        $templateParams["nome"]="template/message-form.php";
    }
    else {
        header("location:login.php?from=contatti.php");
    }

}
else {
    header("location:login.php?from=contatti.php");
}


require 'template/base.php';
?>