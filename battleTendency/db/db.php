<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }
    public function checkLogin($username, $password){
        $query = "  SELECT CF, Username, Nome, Tipo, Attivo
                    FROM UTENTE 
                    WHERE username = ? 
                    AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function isRegistered($CF){
        $query = "  SELECT CF 
                    FROM UTENTE 
                    WHERE CF = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$CF);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isUsernamePresent($username){
        $query = "  SELECT username 
                    FROM UTENTE 
                    WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function insertUser($CF, $cognome, $nome, $datadinascita, $username, $password, $email,$tipo){
        $query = "  INSERT INTO UTENTE (CF, Cognome, Nome, DataDiNascita, Email, Username, password, dataRegistrazione, Tipo, Attivo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, CURRENT_DATE(), ?, true)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssssss',$CF, $cognome, $nome, $datadinascita, $username, $password, $email,$tipo);
        //var_dump($query);
        $stmt->execute();
       // var_dump($stmt);
        return $stmt;
    } 
    
    public function insertFighter($nome, $nomeArte, $mossaSpeciale, $descrizione, $immagine){
        $query = "  INSERT INTO COMBATTENTE (Nome, NomeArte, MossaSpeciale, Descrizione, immagine) 
                    VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $nome, $nomeArte, $mossaSpeciale, $descrizione, $immagine);
        //var_dump($query);
        $stmt->execute();
       // var_dump($stmt);
        return $stmt;
    } 

    public function insertEvent($nome, $dataEvento, $luogo, $descrizioneBreve, $descrizione, $idcombattente1,$idcombattente2, $immagine, $CF){
        $query = "  INSERT INTO EVENTO (Nome, Data, Luogo, DescrizioneBreve, Descrizione, IdCombattente, PAR_IdCombattente, immagine, CF, UltimaModifica) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_DATE())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssiiss',$nome, $dataEvento, $luogo, $descrizioneBreve, $descrizione, $idcombattente1,$idcombattente2, $immagine, $CF);
        //var_dump($query);
        $stmt->execute();
       // var_dump($stmt);
        return $stmt;
    } 

    public function insertTicket($idevento, $numero, $tipo, $prezzo){
        $query = "  INSERT INTO BIGLIETTO (IdEvento, Numero, Tipo, Prezzo) 
                    VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iiss', $idevento, $numero, $tipo, $prezzo);
        //var_dump($query);
        $stmt->execute();
       // var_dump($stmt);
        return $stmt;
    } 

    public function insertMessage($contenuto, $Dest, $mitt){
        $query = "  INSERT INTO MESSAGGIO (Contenuto, DataInvio, Dest_CF, Mit_CF) 
                    VALUES (?, CURRENT_DATE(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $contenuto, $Dest, $mitt);
        //var_dump($query);
        $stmt->execute();
       // var_dump($stmt);
        return $stmt;
    }

    
    public function getFirstFreeTicketNumber($idevento, $type){
        $stmt = $this->db->prepare("SELECT MIN(Numero) as numero
                                    FROM BIGLIETTO
                                    WHERE IdEvento = ?
                                    AND Tipo = ?
                                    AND CF IS NULL");
        $stmt->bind_param('is', $idevento, $type);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLastTicketNumberFromID($idevento){
        $stmt = $this->db->prepare("SELECT MAX(Numero) as numero 
                                    FROM BIGLIETTO
                                    WHERE IdEvento = ?");
        $stmt->bind_param('i', $idevento);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTicketLeft($idevento){
        $stmt = $this->db->prepare("SELECT COUNT(*) as bigliettidisponibili
                                    FROM BIGLIETTO
                                    WHERE IdEvento = ?
                                    AND CF is NULL");
        $stmt->bind_param('i', $idevento);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getTicketLeftByType($idevento, $type){
        $stmt = $this->db->prepare("SELECT COUNT(*) as bigliettidisponibili
                                    FROM BIGLIETTO
                                    WHERE IdEvento = ?
                                    AND Tipo = ?
                                    AND CF is NULL");
        $stmt->bind_param('is', $idevento, $type);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEvents(){
        $stmt = $this->db->prepare("SELECT E.IdEvento, E.Nome, E.Luogo, E.Data, U.Nome as nomeorganizzatore, E.DescrizioneBreve, E.immagine, C1.NomeArte as combattente1, C2.NomeArte as combattente2
                                    FROM EVENTO as E, UTENTE as U, COMBATTENTE as C1, COMBATTENTE as C2
                                    WHERE E.CF = U.CF
                                    AND E.IdCombattente = C1.IdCombattente
                                    AND E.PAR_IdCombattente = C2.IdCombattente
                                    ORDER BY E.UltimaModifica DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNextEvents($n){
        $stmt = $this->db->prepare("SELECT IdEvento, Nome, Data, DescrizioneBreve 
                                    FROM EVENTO
                                    WHERE Data>=CURRENT_DATE()
                                    ORDER BY Data ASC LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomEvents($n){
        $stmt = $this->db->prepare("SELECT E.IdEvento, E.Nome, E.Luogo, E.Data, U.Nome as nomeorganizzatore, E.DescrizioneBreve, E.immagine, C1.NomeArte as combattente1, C2.NomeArte as combattente2
                                    FROM EVENTO as E, UTENTE as U, COMBATTENTE as C1, COMBATTENTE as C2
                                    WHERE E.CF = U.CF
                                    AND E.IdCombattente = C1.IdCombattente
                                    AND E.PAR_IdCombattente = C2.IdCombattente
                                    ORDER BY RAND()
                                    LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getEventsByCF($cf){
        $query = "  SELECT IdEvento, E.Nome, Data, Luogo, c1.NomeArte as combattente1, c2.NomeArte as combattente2, E.Descrizione, E.immagine   
                    FROM EVENTO as E, COMBATTENTE as c1, COMBATTENTE as c2
                    WHERE E.IdCombattente = c1.IdCombattente
                    AND E.PAR_IdCombattente = c2.IdCombattente
                    AND E.CF = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$cf);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }



    public function getContacts(){
        $query = "  SELECT CF, Nome, Username, Email, Tipo 
                    FROM UTENTE 
                    WHERE Tipo='admin' 
                    OR Tipo='organizer'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFighters(){
        $query = "  SELECT IdCombattente, Nome, NomeArte
                    FROM COMBATTENTE
                    ORDER BY Nome ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getFighterByID($id){
        $query = "  SELECT IdCombattente, Nome, NomeArte, MossaSpeciale, Descrizione, Immagine
                    FROM COMBATTENTE
                    WHERE IdCombattente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getTicketTypes($idevento){
        $query = "  SELECT distinct tipo, Prezzo 
                    FROM BIGLIETTO
                    WHERE IdEvento = ?";
        $stmt = $this->db->prepare($query);
        $stmt ->bind_param('i', $idevento);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPrezzo($idevento, $type){
        $stmt = $this->db->prepare("SELECT prezzo
                                    FROM BIGLIETTO
                                    WHERE IdEvento = ?
                                    AND Tipo = ?
                                    AND CF is NULL
                                    LIMIT 1");
        $stmt->bind_param('is', $idevento, $type);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getTicketsByCF($CF){
        $stmt = $this->db->prepare("SELECT idevento, numero, tipo, prezzo
                                    FROM BIGLIETTO
                                    WHERE CF = ?");
        $stmt->bind_param('s', $CF);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTicketsByID($id){
        $stmt = $this->db->prepare("SELECT idevento, numero, tipo, prezzo, CF
                                    FROM BIGLIETTO
                                    WHERE IdEvento = ?
                                    AND CF is not NULL
                                    GROUP BY CF");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    



    public function getEventByID($id){
        $query = "  SELECT IdEvento, E.Nome, Data, Luogo, c1.NomeArte as combattente1, c2.NomeArte as combattente2, c1.IdCombattente as idcombattente1, c2.IdCombattente as idcombattente2, E.Descrizione, E.DescrizioneBreve, E.immagine, CF   
                    FROM EVENTO as E, COMBATTENTE as c1, COMBATTENTE as c2
                    WHERE E.IdCombattente = c1.IdCombattente
                    AND E.PAR_IdCombattente = c2.IdCombattente
                    AND IdEvento = ?
                    LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMessaggiByCF($cf){
        $query = "  SELECT IdMessaggio, Contenuto, DataInvio, Letto, username
                    FROM MESSAGGIO as M, UTENTE as U
                    WHERE M.Mit_Cf = U.CF
                    AND Dest_CF = ?
                    ORDER BY DataInvio DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$cf);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserByCF($cf){
        $query = "  SELECT CF, Cognome, Nome, DataDiNascita, Email, Username, Password
                    FROM UTENTE 
                    WHERE CF = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$cf);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUsers(){
        $query = "  SELECT CF, Cognome, Nome, DataDiNascita, Email, Username, DataRegistrazione, Tipo, Attivo
                    FROM UTENTE";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deleteEvent($id){
        $query = "  DELETE FROM EVENTO 
                    WHERE IdEvento = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }
    
    public function deleteMessaggioByID($id){
        $query = "  DELETE FROM MESSAGGIO 
                    WHERE IdMessaggio = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        var_dump($stmt->error);
        return true;
    }

    public function updateEvent($nome, $dataEvento, $luogo, $descrizioneBreve, $descrizione, $idcombattente1, $idcombattente2, $immagine, $idevento){
        $query = "  UPDATE EVENTO 
                    SET Nome = ?, Data = ?, Luogo = ?, DescrizioneBreve = ?, Descrizione = ?, 
                        IdCombattente = ?, PAR_IdCombattente = ?, immagine = ?, UltimaModifica = CURRENT_DATE() 
                        WHERE IdEvento = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssiisi', $nome, $dataEvento, $luogo, $descrizioneBreve, $descrizione, $idcombattente1, $idcombattente2, $immagine, $idevento);
        
        return $stmt->execute();
    }

    public function buyTicket($idevento, $tipo, $numero, $cf){
        $query = "  UPDATE BIGLIETTO 
                    SET CF = ?
                    WHERE IdEvento = ? 
                    AND Tipo = ?
                    AND Numero = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sisi', $cf, $idevento, $tipo, $numero);
        
        return $stmt->execute();
    }

    
    public function updateMessaggio($idmessaggio){
        $query = "  UPDATE MESSAGGIO 
                    SET Letto = true
                    WHERE IdMessaggio = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idmessaggio);
        
        return $stmt->execute();
    }

    public function updateUser($surname, $name, $birthday, $username, $email, $cf){
        $query = "  UPDATE UTENTE 
                    SET Cognome = ?, Nome = ?, DataDiNascita = ?, Username = ?, Email = ?
                    WHERE CF = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $surname, $name, $birthday, $username, $email, $cf);
        
        return $stmt->execute();
    }

    public function banUnbanUser($attivo, $cf){
        $query = "  UPDATE UTENTE 
                    SET Attivo = ?
                    WHERE CF = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $attivo, $cf);
        
        return $stmt->execute();
    }
}
?>