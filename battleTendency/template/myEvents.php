
    <?php
    switch($_SESSION['numerotipo']){
        case 0://caso amministratore
        case 1://caso organizzatore
            echo "<a href='./eventManager.php?action=1'><button>aggiungi evento</button></a>";
            echo "<a href='./fighterManager.php?action=1'><button>aggiungi Combattente</button></a>";
            if(count($templateParams["eventi"])==0){
                echo "<p>Non hai ancora nessun evento!</p>";
            }
            foreach($templateParams["eventi"] as $evento):?>
                <article>
                    <header>
                        <div>
                        </div>
                        <h2><?php  echo $evento["Nome"]; ?></a></h2>
                        <p>ID evento: <?php echo $evento["IdEvento"]; ?></p>
                        <p>Combattenti: <?php echo $evento["combattente1"]." - ".$evento["combattente2"]; ?></p>
                        <p>Data: <?php echo $evento["Data"]; ?></p>
                        <p>Luogo: <?php echo $evento["Luogo"]; ?></p>
                    </header>
                    <section>
                    <?php   if($evento["immagine"]==NULL) :
                                echo "Nessuna immagine disponibile";
                            else :?>
                            <img src=<?php echo UPLOAD_DIR_EVENTO.$evento["immagine"];?> alt='' />
                            <?php endif;?>
                        <?php echo $evento["Descrizione"]; ?>
                    </section>
                </article>
                <div>
                    <span><a href='./eventManager.php?action=2&id=<?php echo $evento['IdEvento'];?>'>Modifica</a></span>
                    <span><a href='./ticketManager.php?action=1&id=<?php echo $evento['IdEvento'];?>'>Aggiungi biglietti</a></span>
                    <span><a href='./eventManager.php?action=3&id=<?php echo $evento['IdEvento'];?>'>Cancella</a></span>
                    
                </div>
            <?php endforeach;

        break;

        case 2://caso utente //toDo: stampa di tutti gli eventi di cui l'utente ha il biglietto (db-php)
            if(count($templateParams["biglietti"])!=0) :?>
            <table>
			<tr>
                <th>Evento</th>
                <th>Numero biglietto</th>
				<th>Tipo biglietto</th>
                <th>Prezzo</th>
			</tr>
    <?php foreach($templateParams["biglietti"] as $biglietto) : ?>
			<tr>
                <td><a href="evento.php?idevento=<?php echo $biglietto["idevento"];?>"><?php echo $dbh->getEventByID($biglietto["idevento"])[0]["Nome"]; ?> </a></td>
                <td><?php echo $biglietto["numero"];?></td>
				<td><?php echo $biglietto["tipo"];?></td>
                <td><?php echo $biglietto["prezzo"];?>€</td>
			</tr>
			<?php endforeach; ?>
		</table>
    <?php else: 
        echo "<p>Non hai ancora nessun biglietto!</p>";
        endif; ?>
        <?php    
        break;

        default://caso utente non loggato (non dovrebbe mai entrare qui)

        break;
    }
    ?>
     