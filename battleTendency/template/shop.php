<?php   if($_SESSION["numerotipo"]==1 || $_SESSION["numerotipo"]==0) :  //--Se è un organizzatore ?>
    <p>L'account organizzatore/amministratore non può accedere alle funzionalità del carrello! <a href="index.php">Torna alla home</a></p>
<?php   else: ?>
    <?php       if(isset($_SESSION["shopping-cart"])) : 
                    $totale = 0;?>
                    <table>
                            <tr>
                                <th>Evento</th>
                                <th>Tipo biglietto</th>
                                <th>Prezzo</th>
                                <th>Quantità</th>
                                <th>Totale</th>
                                <th>Azioni</th>
                            </tr>
                    <?php foreach($_SESSION["shopping-cart"] as $key =>$item) : 
                        $parziale = $item["prezzo"]*$item["quantità"];?>
                            <tr>
                                <td><?php echo $dbh->getEventByID($item["idevento"])[0]["Nome"]; ?> </td>
                                <td><?php echo $item["tipo"];?></td>
                                <td><?php echo $item["prezzo"];?>€</td>
                                <td><?php echo $item["quantità"];?></td>
                                <td><?php echo $parziale;?>€</td>
                                <td><a href="shop.php?key=<?php echo $key;?>">Rimuovi</a></td>
                            </tr>
                            <?php $totale+=$parziale;
                                endforeach; ?>
                                <tr>
                                    <th>Totale da pagare</th>
                                    <td colspan="5"><?php echo $totale;?>€</td>
                                </tr>
                        </table>
                        <a href="buyTicket.php?action=1"><button>Acquista!</button></a>
        <?php   else :?>
                        <p>Nessun biglietto nel carrello! <a href="index.php"> vai agli eventi!</a></p>
        <?php   endif;?>
<?php   endif;?>