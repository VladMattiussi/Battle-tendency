<?php
require_once 'bootstrap.php';
if( !isUserLoggedIn()){
    header("location:login.php");
}
if( isset($_GET['action'])){
    $templateParams['azione']=$_GET['action'];
    $templateParams['evento']=getEmptyEvent();
    switch($_GET['action']){
        case 1 :        //caso aggiunta di evento
            if(isset($_POST['nome'])){
                if(isset($_FILES["immagine"]) && strlen($_FILES["immagine"]["name"])>0) {
                    list($result, $img) = uploadImage(UPLOAD_DIR_EVENTO, $_FILES["immagine"]);
                    if($result == 0){
                        $templateParams["erroreinsert"] = "Errore durante il caricamento dell'immagine!";
                    }
                }
                else {
                    $img="noimage.jpg";
                }
                if($_POST["idcombattente1"]==$_POST["idcombattente2"]){
                    $templateParams["erroreinsert"] = "Non puoi mettere un combattente contro se stesso!";
                    break;
                }
                
            
                $insert_result = $dbh->insertEvent(   $_POST["nome"], $_POST["data"],
                                                        $_POST["luogo"], $_POST["descrizionebreve"],
                                                         $_POST["descrizione"], $_POST["idcombattente1"],
                                                         $_POST["idcombattente2"], $img, $_SESSION["CF"]);
                if($insert_result){
                    //Inserimento riuscito
                    $querySuccess = 1;
                }
                else{
                    $templateParams["erroreinsert"] = "Errore durante l'esecuzione della query!";
                }
            }
        break;
        case 2:     //caso update (modifica evento)
            if(isset($_GET['id'])){
                $templateParams["evento"] = $dbh->getEventByID($_GET['id']);
                $templateParams["evento"] = $templateParams["evento"][0];
            }
            else {
                if(isset($_FILES["immagine"]) && strlen($_FILES["immagine"]["name"])>0) {
                    list($result, $img) = uploadImage(UPLOAD_DIR_EVENTO, $_FILES["immagine"]);
                    if($result == 0){
                        $templateParams["erroreupdate"] = "Errore durante il caricamento dell'immagine!";
                    }
                }
                else {
                    $img=$_POST['oldimg'];
                }
                if($_POST["idcombattente1"]==$_POST["idcombattente2"]){
                    $templateParams["erroreupdate"] = "Non puoi mettere un combattente contro se stesso!";
                    break;
                }
                $update_result =$dbh -> updateEvent(    $_POST["nome"], $_POST["data"],
                                                        $_POST["luogo"], $_POST["descrizionebreve"],
                                                        $_POST["descrizione"], $_POST["idcombattente1"],
                                                        $_POST["idcombattente2"], $img, $_POST['idevento']);
                if($update_result){
                    //Aggiornamento riuscito
                    $querySuccess = 1;
                }
                else{
                    $templateParams["erroreupdate"] = "Errore durante l'esecuzione della query!";
                }

                $idevento=$_POST['idevento'];
                if($_POST["olddata"]!=$_POST["data"]){
                    //cambiamento di data
                    $change="data";
                }
                else if ($_POST["oldluogo"]!=$_POST["luogo"]) {
                    //cambiamento di luogo
                    $change="luogo";
                }
                else {
                    unset($change);
                }

                if(isset($change)){
                    $evento = $dbh ->getEventByID($_POST['idevento'])[0];
                    $utenti = $dbh ->getTicketsByID($_POST['idevento']); //utenti che hanno acquistato un biglietto di questo evento
                    foreach($utenti as $utente){
                        $dbh -> insertMessage("Info:  ".$change." dell'evento <a href='evento.php?idevento=$idevento'>".$evento["Nome"]."</a> modificato",$utente["CF"], $_SESSION["CF"]); //0 è il CF dell'amministratore di sistema
                    }
                    
                }
                
            }
        break;
        case 3:
            if(isset($_GET['id'])){
                $delete_result = $dbh->deleteEvent($_GET['id']);
                if($delete_result){
                    //Eliminazione riuscita
                    $querySuccess = 1;
                }
                else{
                    $templateParams["erroredelete"] = "Errore durante l'esecuzione della query!";
                }
            }
        break;
        default:
    }
}
if(isset($querySuccess)){
    $templateParams["erroreinsert"] = NULL;
    $templateParams["titolo"] = "BT - OK!";
    $templateParams["nome"] = "template/success.php";
            
}
else {
    $templateParams["titolo"] = "BT - Gestisci evento";
    $templateParams["nome"] = "template/manageEvent.php";
}

require 'template/base.php';
?>