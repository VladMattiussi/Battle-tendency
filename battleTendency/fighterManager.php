<?php
require_once 'bootstrap.php';
if(isset($_POST['nome'])){
    if(isset($_FILES["immagine"])){
        list($result, $img) = uploadImage(UPLOAD_DIR_EVENTO, $_FILES["immagine"]);
        if($result == 0){
            $templateParams["erroreinsert"] = "Errore durante il caricamento dell'immagine!";
        }
    }
    else {
        $img = NULL;
    }
    
    $insert_result = $dbh->insertFighter(   $_POST["nome"], $_POST["nomeArte"],
                                            $_POST["mossaSpeciale"], $_POST["descrizione"], $img);
    if($insert_result){
        //Inserimento riuscito
        $addFighterSuccess = 1;
    }
    else{
        $templateParams["erroreinsert"] = "Errore! Errore durante l'esecuzione della query!";
    }
}

if(isset($addFighterSuccess)){
        $templateParams["erroreinsert"] = NULL;
            $templateParams["titolo"] = "BT - Operazione riuscita";
            $templateParams["nome"] = "template/success.php";
            
}
else {
    $templateParams["titolo"] = "BT - Aggiungi combattente";
    $templateParams["nome"] = "template/addFighter.php";
}
require 'template/base.php';
?>