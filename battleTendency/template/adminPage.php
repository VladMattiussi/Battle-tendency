
<h2>Amministrazione</h2>
    <table>
        <caption style="float:left;color:white">Lista degli organizzatori</caption>
        <tr>
            <th id="cf">CF</th>
            <th id="cognome">Cognome</th>
            <th id="nome">Nome</th>
            <th id="dataNascita">Data nascita</th>
            <th id="email">Email</th>
            <th id="username">Username</th>
            <th id="dataRegistrazione">Data registrazione</th>
            <th id="tipo">Tipo</th>
            <th id="attivo">Attivo</th>
            <th id="azione">Azione</th>
        </tr>
        <?php foreach($templateParams["utenti"] as $utente) :?>
            <?php if(strcmp($utente["Tipo"], "admin")!=0) : ?>
        <tr>
            <td headers="cf <?php echo $utente["Username"]; ?>"><?php echo $utente["CF"]; ?></td>
            <td headers="cognome <?php echo $utente["Cognome"]; ?>"><?php echo $utente["Cognome"]; ?></td>
            <td headers="nome <?php echo $utente["Nome"]; ?>"><?php echo $utente["Nome"]; ?></td>
            <td headers="dataNascita <?php echo $utente["DataDiNascita"]; ?>"><?php echo $utente["DataDiNascita"]; ?></td>
            <td headers="email <?php echo $utente["Email"]; ?>"><?php echo $utente["Email"]; ?></td>
            <td headers="username <?php echo $utente["Username"]; ?>"><?php echo $utente["Username"]; ?></td>
            <td headers="dataRegistrazione <?php echo $utente["DataRegistrazione"]; ?>"><?php echo $utente["DataRegistrazione"]; ?></td>
            <td headers="tipo <?php echo $utente["Tipo"]; ?>"><?php echo $utente["Tipo"]; ?></td>
            <td headers="attivo <?php echo $utente["Attivo"]; ?>"><?php echo $utente["Attivo"]; ?></td>
            <td headers="ban <?php echo $utente["CF"]; ?>"><a href="adminPage.php?cf=<?php echo $utente["CF"]; ?>&action=<?php echo $utente['Attivo']==1 ? 0 : 1;?>">
            <?php if($utente["Attivo"]==1) :?>
                Disattiva utente
                <?php else : ?>
                Attiva utente
                <?php endif; ?>
                </a></td>
                
        </tr>
                <?php endif;?>
                <?php endforeach; ?>
    </table>