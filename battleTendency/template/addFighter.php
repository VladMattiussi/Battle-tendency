<h2>Aggiungi combattente</h2>
	<p><?php
		if(isset($templateParams["erroreinsert"])){
			echo $templateParams["erroreinsert"];
		}
	?></p>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="nome"></label>
            	<input type="text" placeholder="Nome" id="nome" name="nome" required>
            	<br />
			</li>
            <li>
				<label for="nomeArte"></label>
                <input type="text" placeholder="Nickname" id="nomeArte" name="nomeArte" required>
                <br>
			</li>  
            <li>
				<label for="mossaSpeciale"></label>
				<input type="text" placeholder="Mossa speciale" id="mossaSpeciale" name="mossaSpeciale" required>
			</li>
			<li>
				<label for="descrizione">Descrizione:</label>
				<textarea name="descrizione">
				</textarea>
			</li> 
			<li>
				<label for="immagine">immagine(facoltativo):</label><input type="file" id="immagine" name="immagine"/>
			</li>
            <div>
				<input type="submit" name="submit" value="Aggiungi" />
			</div> 
		</ul>
	</form>