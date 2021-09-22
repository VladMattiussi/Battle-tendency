      
	
	<p><?php
		$i = 0;
		if(isset($_GET["err"])){
			echo $_GET["err"];
		}

	?></p>
		<table>
			<tr>
				<th>Tipo biglietto</th>
				<th>Prezzo</th>
				<th>Disponibilità</th>
			</tr>
			<?php foreach($templateParams["tipibiglietti"] as $biglietto) :   
				$index = $biglietto["tipo"]; ?>
			<tr>
				<td><?php echo $biglietto["tipo"];?></td>
				<?php if($templateParams[$index]["bigliettidisponibili"]==0) : ?>
				<td colspan="2">ESAURITO</td>
				<?php else: ?>
				<td><?php echo $biglietto["Prezzo"];?></td>
				<td><?php echo $templateParams[$index]["bigliettidisponibili"];?></td>
				<?php endif;?>
			</tr>
			<?php 
				endforeach; ?>
		</table>
	<form action="shop.php" method="POST">

		<label for="tipo">Tipo biglietto :</label>
		<select name="tipo">
				<?php foreach($templateParams["tipibiglietti"] as $biglietto) :  ?> 
				<?php echo "<option value ='".$biglietto["tipo"]."'>".$biglietto["tipo"]."</option>";?>
				<?php endforeach; ?>
    	</select>
		<label for="quantita">Quantità :</label>
		<input type="number" name="quantità" value="1" min="0" required/>
		<input type="hidden" name="idevento" value="<?php echo $templateParams["idevento"]; ?>" />
		
		<input type="submit" name="submit" value="Aggiungi al carrello" />
	</form>