<?php
require_once 'bootstrap.php';
if(isset($_GET['id'])){
    $templateParams["idevento"]=$_GET['id'];
}
if(isset($_POST['prezzo'])){
    $maxNum = $dbh->getLastTicketNumberFromID($_POST['idevento'])[0]["numero"];
    for($i=1; $i<=$_POST["quantità"]; $i++){
        $insert_result = $dbh->insertTicket(   $_POST["idevento"], $i+$maxNum, 
                                            $_POST["tipo"], $_POST["prezzo"]);
    }
    $querySuccess=1;
}

if(isset($querySuccess)){
        $templateParams["erroreinsert"] = NULL;
            $templateParams["titolo"] = "BT - Operazione riuscita!";
            $templateParams["nome"] = "template/success.php";
            
}
else {
    $templateParams["titolo"] = "BT - Aggiungi biglietti";
    $templateParams["nome"] = "template/addTicket.php";
}
require 'template/base.php';
?>