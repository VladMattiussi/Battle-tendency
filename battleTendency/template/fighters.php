<?php if(isset($templateParams["combattenti"])): ?>
    <ol>
<?php foreach($templateParams["combattenti"] as $combattente):?>
        <li><a href="fighter.php?idfighter=<?php echo $combattente['IdCombattente'];?>"><?php echo $combattente["Nome"]." - ".$combattente["NomeArte"]; ?></a></li>
<?php endforeach; ?>
    </ol>
<?php endif; ?>