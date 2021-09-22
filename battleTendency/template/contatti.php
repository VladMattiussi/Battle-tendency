<h2>Contatti</h2>
    <table>
        <caption style="float:left;color:white">Lista degli amministratori</caption>
        <tr>
            <th id="usernameAdmin">Username</th>
            <th id="nomeAdmin">Nome</th>
            <th id="emailAdmin">Email</th>
            <th id="azioneAdmin">Azione</th>
        </tr>
        <?php foreach($templateParams["contatti"] as $utente) :
                if(strcmp($utente["Tipo"],"admin")==0) : ?>
        <tr>
            <td headers="username <?php echo $utente["Username"]; ?>"><?php echo $utente["Username"]; ?></td>
            <td headers="nome <?php echo $utente["Nome"]; ?>"><?php echo $utente["Nome"]; ?></td>
            <td headers="email <?php echo $utente["Email"]; ?>"><?php echo $utente["Email"]; ?></td>
            <td headers="inviaMSG <?php echo $utente["CF"]; ?>"><a href="messageManager.php?cfd=<?php echo $utente["CF"]; ?>&cfm=<?php 
            if(isUserLoggedIn()) : echo $_SESSION["CF"]; endif; ?>">Invia un messaggio</a></td>
        </tr>
                <?php endif; endforeach; ?>
    </table>

    <table>
        <caption style="float:left;color:white">Lista degli organizzatori</caption>
        <tr>
            <th id="usernameOrganizzatore">Username</th>
            <th id="nomeOrganizzatore">Nome</th>
            <th id="emailOrganizzatore">Email</th>
            <th id="azioneOrganizzatore">Azione</th>
        </tr>
        <?php foreach($templateParams["contatti"] as $utente) :
                if(strcmp($utente["Tipo"],"organizer")==0) : ?>
        <tr>
            <td headers="username <?php echo $utente["Username"]; ?>"><?php echo $utente["Username"]; ?></td>
            <td headers="nome <?php echo $utente["Nome"]; ?>"><?php echo $utente["Nome"]; ?></td>
            <td headers="email <?php echo $utente["Email"]; ?>"><?php echo $utente["Email"]; ?></td>
            <td headers="inviaMSG <?php echo $utente["CF"]; ?>"><a href="messageManager.php?cfd=<?php echo $utente["CF"]; ?>&cfm=<?php echo $_SESSION["CF"]; ?>">Invia un messaggio</a></td>
        </tr>
                <?php endif; endforeach; ?>
    </table>
        

            