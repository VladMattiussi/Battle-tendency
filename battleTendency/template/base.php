<!DOCTYPE html>
<html lang="it">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <title><?php if(isset($templateParams["titolo"])) echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <!--<script src="./js/jquery.js"></script>-->

</head> 

<body>
     <header>

<a href="./index.php"><img src="./res/logo.png" class="img-fluid" alt="Responsive image"></a>
<?php $templateParams["prossimieventi"] = $dbh->getNextEvents(5);?> <!--parte aside, messo qua per non scriverlo in OGNI file che chiama base-->



<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark red lighten-1 mb-4">


    <!-- Collapse button -->
    <button class="navbar-toggler second-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent23"
            aria-controls="navbarSupportedContent23" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent23">

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="contatti.php">Contatti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shop.php">Carrello</a>
            </li>
            <li class="nav-item">
                <?php if(!isUserLoggedIn()): ?>
                <a class="nav-link" href="login.php">Login</a>
                <?php else:?>
                <a class="nav-link" href="logout.php">Logout</a>
                <?php endif; ?>
            </li>
            <?php if(isUserLoggedIn()): 
                $templateParams["msgnonletti"]=0;
                $templateParams["notifiche"] = $dbh->getMessaggiByCF($_SESSION["CF"]);
                foreach($templateParams["notifiche"] as $notifica){
                    if($notifica["Letto"]==0){ //controlla se ci sono messaggi non letti (0 = NON letto)
                        $templateParams["msgnonletti"]=1;
                        break;
                    }
                }?>
            <li class="nav-item">
                <a class="nav-link" href="notifiche.php" <?php if($templateParams["msgnonletti"]==1) {echo "style='color:red'";} ?> >Notifiche</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signUp.php?action=2">Modifica dati</a>
            </li>
            <?php endif; ?> 
        </ul>
        <!-- Links -->

    </div>
    <!-- Collapsible content -->
</nav>
<!--/.Navbar-->
<!--<nav>
</nav>-->

</header>
         <nav id="top-nav">
            <a  href="fighter.php">Combattenti</a>
            <a  href="index.php">Eventi</a>
            <a  href="suggestions.php">Suggerimenti</a>
            <a  href="myEvents.php">I miei eventi</a>
            <?php if(isUserLoggedIn() && $_SESSION["numerotipo"]==0) : ?>
                <a href="adminPage.php">Amministrazione</a>
            <?php endif;?>

         </nav>	


        <main>
         <?php if (isset($templateParams["nome"])) require($templateParams["nome"]); ?>   
        </main>
        <aside>
            <section>
                <h2>Prossimi eventi</h2>
                <ul>
                <?php foreach($templateParams["prossimieventi"] as $evento): ?>
                    <li>
                        <a href="evento.php?idevento=<?php echo $evento['IdEvento']; ?>"><?php echo $evento['Nome']; ?></a>
                        <?php echo $evento["Data"];?>
                    </li>
                <?php endforeach; ?>
                </ul>
            </section>
        </aside>
         <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

     </body>
</html>