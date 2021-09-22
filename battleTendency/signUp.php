<?php
require_once 'bootstrap.php';
if(isset($_GET["action"])){
    $templateParams["azione"]= $_GET["action"];
    switch($_GET["action"]){
        case 1:
            if(isset($_POST['CF']) && isset($_POST['username'])){

                $CFpresent = count($dbh->isRegistered($_POST["CF"]));
                $usernamePresent = count($dbh->isUsernamePresent(($_POST['username'])));
                if(($CFpresent == 0) && ($usernamePresent==0)){
                    if(strcmp($_POST["confirmPassword"], $_POST["password"])==0){
                        $insert_result = $dbh->insertUser(   $_POST["CF"], $_POST["surname"], $_POST["name"], $_POST["birthday"], 
                                                                $_POST["username"], $_POST["password"], $_POST["email"], $_POST["type"]);
                        if($insert_result){
                            //Inserimento riuscito
                            $signUpSuccess = 1;
                        }
                        else{
                            $templateParams["erroreinsert"] = "Errore! Errore durante l'esecuzione della query!";
                        }
                    }
                    else {
                        $templateParams["erroreinsert"] = "La password e la conferma password non coincidono!";
                    }
                }
                else {
                    $templateParams["erroreinsert"] = "Errore! Utente (cf/username) gia' registrato!";
                }
            }

            if(isset($signUpSuccess)){
                var_dump($_POST);
                $dbh->insertMessage("Benvenuto nel nostro sito!",$_POST['CF'], "0");
                header("location:login.php?msg=Hai effettuato la registrazione con successo!");
            }
            else {
                $templateParams["titolo"] = "BT - Registrazione";
                $templateParams["nome"] = "template/signUp.php";
                $templateParams["utente"] = getEmptyUser();
            }
            
        break;
        case 2:
            if(isset($_POST['username'])){
                if(strcmp($_POST['username'], $_POST['oldusername'])==0){
                    $usernamePresent=0;
                }
                else {
                    $usernamePresent = count($dbh->isUsernamePresent($_POST['username']));
                    $change="username";
                }
                
                if($usernamePresent==0){
                        $insert_result = $dbh->updateUser($_POST["surname"], $_POST["name"], $_POST["birthday"], 
                                                                $_POST["username"], $_POST["email"], $_POST["CF"]);
                        if($insert_result){
                            //Inserimento riuscito
                            $updateSuccess = 1;
                        }
                        else{
                            $templateParams["erroreinsert"] = "Errore! Errore durante l'esecuzione della query!";
                        }
                }
                else {
                    $templateParams["erroreinsert"] = "Errore! username gia' registrato!";
                }
            }

            if(isset($updateSuccess)){
                $templateParams["titolo"] = "BT -OK!";
                $templateParams["nome"] = "template/success.php";
                if(isset($change)){
                    $dbh->insertMessage("Dati: Hai modificato ".$change,$_POST["CF"], "0");
                }
                
            }
            else {
                $templateParams["titolo"] = "BT - Modifica dati";
                $templateParams["nome"] = "template/signUp.php";
                $templateParams["utente"] = $dbh ->getUserByCF($_SESSION["CF"])[0];
            }
        break;

    }
}



require 'template/base.php';
?>