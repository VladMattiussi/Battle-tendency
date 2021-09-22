      
	<?php $fighters = $dbh->getFighters(); ?>
	<?php if($_GET['action']==2) :?>
		<h2>Modifica evento</h2>
	<?php else:?>
		<h2>Nuovo evento</h2>
	<?php endif;?>
	<p><?php
		$evento = $templateParams["evento"];
		if(isset($templateParams["erroreinsert"])){
			echo $templateParams["erroreinsert"];
		}
		if(isset($templateParams["erroreupdate"])){
			echo $templateParams["erroreupdate"];
		}
		if(isset($templateParams["erroredelete"])){
			echo $templateParams["erroredelete"];
		}
	?></p>
	<form action="eventManager.php?action=<?php echo $templateParams['azione'];?>" method="POST" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nome">Nome:</label><input type="text" id="nome" name="nome" value="<?php echo $evento['Nome'];?>" required/>
			</li>
		
			<li>
				<label for="data">Data:</label><input type="date" id="data" name="data" value="<?php echo $evento['Data'];?>" min="<?php echo date('d-m-Y');?>" required/>
			</li>
			<li>
				<label for="luogo">luogo:</label><input type="text" id="luogo" name="luogo" value="<?php echo $evento['Luogo'];?>" required/>
			</li>
			<li>
				<label for="immagine">immagine(facoltativo):</label><input type="file" id="immagine" name="immagine" />
			</li>
			<li>
				<label for="descrizionebreve">descrizione breve:</label>
				<textarea id="descrizionebreve" cols="50"  name="descrizionebreve" required><?php echo $evento['DescrizioneBreve'];?></textarea>
			</li>
			<li>
				<label for="descrizione">descrizione:</label>
				<textarea id="descrizione" cols="55" rows="4" name="descrizione" required><?php echo $evento['Descrizione'];?></textarea>
			</li>
			<li>
				<label for="Combattente1">combattente 1:</label>
				<select name="idcombattente1">
				<?php
					foreach($fighters as $fighter) : ?>                                             
						<option value="<?php echo $fighter['IdCombattente'];?>"  
								<?php
									
									if($fighter['IdCombattente']==$evento['idcombattente1']){
									echo " selected";
								}?>>
								<?php echo $fighter['Nome']."</option>";
					endforeach;
				?>          
    			</select>
			</li>
			<li>
			<label for="Combattente2">combattente 2:</label>
			<select name="idcombattente2">
				<?php
					foreach($fighters as $fighter) : ?>                                             
						<option value="<?php echo $fighter['IdCombattente'];?>"  
								<?php
									if($fighter['IdCombattente']==$evento['idcombattente2']){
									echo "selected";
								}?>>
								<?php echo $fighter['Nome']."</option>";
					endforeach;
				?>          
    			</select>
			</li>
			<li>
				<a href="fighterManager.php">Aggiungi combattente</a>
			</li>
			<?php if($_GET['action']==2) :?>
			<input type="hidden" name="idevento" id="idevento" value="<?php echo $evento['IdEvento'];?>">
			<input type="hidden" name="oldimg" id="oldimg" value="<?php echo $evento['immagine'];?>">
			<input type="hidden" name="oldluogo" id="oldluogo" value="<?php echo $evento['Luogo'];?>">
			<input type="hidden" name="olddata" id="olddata" value="<?php echo $evento['Data'];?>">
			<?php endif;?>
			<li>
				<input type="submit" name="submit" value="Invia" />
			</li>
		</ul>
	</form>