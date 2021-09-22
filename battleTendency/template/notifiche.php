<h2>Notifiche</h2>
<?php if(count($templateParams["notifiche"])!=0) : ?>
    <table>
        <caption>Notifiche</caption>
        <tr>
            
            <th id="mittente">Mittente</th>
            <th id="dataInvio">Data</th>
            <th id="contenuto">Messaggio</th>
            <th id="azioni">Azioni</th>
        </tr>
        <?php foreach($templateParams["notifiche"] as $notifica) :?>

        <tr>
            <td headers="username <?php echo $notifica["username"]; ?>"><?php echo $notifica["username"]; ?></td>
            <td headers="data <?php echo $notifica["DataInvio"]; ?>"><?php echo $notifica["DataInvio"]; ?></td>
            <td headers="messaggio <?php echo $notifica["Contenuto"]; ?>"><?php echo $notifica["Contenuto"]; ?></td>
            <td headers="azioni">
                <a href="notifiche.php?idmessaggio=<?php echo $notifica["IdMessaggio"]?>">Cancella</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else : ?>
    <p>Nessuna notifica presente!</p>
    <?php endif; ?>
        

            