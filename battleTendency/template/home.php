<?php foreach($templateParams["eventi"] as $evento):?>
    <article>
        <header>
            <div>
            </div>
            <h2><a href="evento.php?idevento=<?php echo $evento["IdEvento"];?>"><?php  echo $evento["Nome"]; ?></a></h2>
            <p>Data: <?php echo $evento["Data"]; ?></p>
            <p>Organizzato da: <?php echo $evento["nomeorganizzatore"]; ?></p>
            <p>Luogo: <?php echo $evento["Luogo"]; ?></p>
            <p>Combattenti: <?php echo $evento["combattente1"];?> contro <?php echo $evento["combattente2"];?></p>
        </header>
        <section>
                <img src=<?php echo UPLOAD_DIR_EVENTO.$evento["immagine"];?> alt='' />
            <?php echo $evento["DescrizioneBreve"]; ?>
        </section>
        <footer>
            <a href="evento.php?idevento=<?php echo $evento["IdEvento"];?>">Vai all'evento</a>
        </footer>
    </article>
<?php endforeach; ?>