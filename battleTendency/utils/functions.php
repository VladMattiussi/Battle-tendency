<?php
function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

function getIdFromName($name){
    return preg_replace("/[^a-z]/", '', strtolower($name));
}

function isUserLoggedIn(){
    return isset($_SESSION['CF']);
}

function registerLoggedUser($user){
    $_SESSION["CF"] = $user["CF"];
    $_SESSION["username"] = $user["Username"];
    $_SESSION["nome"] = $user["Nome"];
    $_SESSION["Tipo"] = $user["Tipo"];
    if(strcmp($_SESSION["Tipo"], "admin")==0){
        $_SESSION["numerotipo"] = 0;
    }
    else if(strcmp($_SESSION['Tipo'], "organizer")==0){
        $_SESSION["numerotipo"] = 1;
    }
    else {
        $_SESSION["numerotipo"] = 2;
    }
 }

function getEmptyEvent(){
    return array(   "IdEvento" => "", "Nome" => "",
                    "Data" => "", "Luogo" => "",
                    "idcombattente1" => "", "idcombattente2" => "", 
                    "Descrizione" => "", "DescrizioneBreve" => "", "Immagine" => "");
}

function getEmptyUser(){
    return array(   "CF" => "", "Cognome" => "",
                    "Nome" => "", "DataDiNascita" => "",
                    "Email" => "", "Username" => "", 
                    "Password" => "");
}

function uploadImage($path, $image){
    $imageName = basename($image["name"]);
    $fullPath = $path.$imageName;
    
    $maxKB = 50000;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    //Controllo se immagine è veramente un'immagine
    $imageSize = getimagesize($image["tmp_name"]);
    if($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    //Controllo estensione del file
    $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
    if(!in_array($imageFileType, $acceptedExtensions)){
        $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    if (file_exists($fullPath)) {
        $i = 1;
        do{
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
        }
        while(file_exists($path.$imageName));
        $fullPath = $path.$imageName;
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    if(strlen($msg)==0){
        if(!move_uploaded_file($image["tmp_name"], $fullPath)){
            $msg.= "Errore nel caricamento dell'immagine.";
        }
        else{
            $result = 1;
            $msg = $imageName;
        }
    }
    return array($result, $msg);
}

?>