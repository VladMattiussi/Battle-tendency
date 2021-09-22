<h2>Aggiungi biglietti</h2>
	<p><?php
		if(isset($templateParams["erroreinsert"])){
			echo $templateParams["erroreinsert"];
		}
	?></p>
	<form action="ticketManager.php" method="POST">
		<ul>
			<li>
				<label for="tipo">Tipo:</label>
				<input type="text" id="tipo" name="tipo" required>
			</li>
            <li>
				<label for="quantità">Quantità:</label>
                <input type="number" id="quantità" name="quantità" value="10" required/>
			</li>  
            <li>
				<label for="prezzo">Prezzo:</label>
                <input type="number" id="prezzo" name="prezzo" step="0.01" min="0" required/>€
			</li> 
			<li>
            	<input type="hidden" id="idevento" name="idevento" value="<?php echo $templateParams["idevento"];?>"/>
			</li>
            <div>
				<input type="submit" name="submit" value="Aggiungi" />
			</div>  
		</ul>
	</form>
