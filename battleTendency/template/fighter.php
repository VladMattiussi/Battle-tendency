<?php
    if(isset($_GET["err"])){
        echo "<p>".$_GET["err"]."</p>";
    }
    if(count($templateParams["combattente"])>0) :
        $combattente = $templateParams["combattente"][0];
?>
<article>
    <header>
        <div>
        </div>
        <h2><?php  echo $combattente["Nome"]; ?></h2>
        <p>Nome Arte: <?php echo $combattente["NomeArte"];?></p>
        <p>Mossa speciale: <?php echo $combattente["MossaSpeciale"];?></p>
    </header>
    <section>
        <img src=<?php echo UPLOAD_DIR_COMBATTENTE.$combattente["Immagine"];?> alt='' />
        <p><?php echo $combattente["Descrizione"]; ?></p>
        
    </section>
</article>
<a href="fighter.php">Torna ai combattenti</a>
<?php
else : 
    echo "<p>Combattente non trovato!</p>";
endif; ?>