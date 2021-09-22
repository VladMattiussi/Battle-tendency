<?php
    if(isset($_GET["err"])){
        echo "<p>".$_GET["err"]."</p>";
    }
    if(count($templateParams["evento"])>0) :
        $evento = $templateParams["evento"][0];
?>
<article>
    <header>
        <div>
        </div>
        <h2><?php  echo $evento["Nome"]; ?></h2>
        <p>Combattenti: <a href="fighter.php?idfighter=<?php echo $evento["idcombattente1"];?>"><?php echo $evento["combattente1"];?></a> - <a href="fighter.php?idfighter=<?php echo $evento["idcombattente1"];?>"><?php echo $evento["combattente2"]; ?></a></p>
        <p>Data: <?php echo $evento["Data"];?></p>
        <p>Luogo: <?php echo $evento["Luogo"];?></p>
    </header>
    <section>
        <img src=<?php echo UPLOAD_DIR_EVENTO.$evento["immagine"];?> alt='' />
        <p><?php echo $evento["Descrizione"]; ?></p>

        <p>Biglietti disponibili: <?php echo $templateParams["bigliettidisponibili"];?></p>

        <?php if($templateParams["bigliettidisponibili"]!=0) : ?> <!--se i non sono disponibili biglietti da comprare, disabilito la possibilità di comprare biglietti!-->
        <a href="buyTicket.php?idevento=<?php echo $evento["IdEvento"];?>">Compra biglietti</a>
        <?php endif; ?>
    </section>
</article>
<?php
else : 
    echo "<p>Evento non trovato!</p>";
endif; ?>