<?php
		if(isset($templateParams["utente"])){
			$utente=$templateParams["utente"];
		}
?>
<?php if($templateParams["azione"]==2) : ?>
		<h2>Modifica i tuoi dati</h2>
<?php else : ?>
		<h2>Registrazione</h2>
<?php endif;?>
	<p><?php
		if(isset($templateParams["erroreinsert"])){
			echo $templateParams["erroreinsert"];
		}
	?></p>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="CF"></label><input type="<?php if($templateParams["azione"]==2) : echo "hidden"; else : echo "text"; endif; ?>" placeholder="CF" id="CF" name="CF" value="<?php echo $utente["CF"];?>" required/>
			</li>
		
			<li>
				<label for="nome"></label><input type="text" placeholder="nome" id="name" name="name" value="<?php echo $utente["Nome"];?>" required/>
			</li>
			<li>
				<label for="surname"></label><input type="text" placeholder="cognome" id="surname" name="surname" value="<?php echo $utente["Cognome"];?>" required/>
			</li>
			<li>
				<label for="birthday">Data di nascita: </label><input type="date" id="DataNascita" name="birthday" max="<?php echo date('d-m-Y');?>" value="<?php echo $utente["DataDiNascita"];?>" required/>
			</li>
			<li>
				<label for="email"></label><input type="text" placeholder="Email" id="email" name="email" value="<?php echo $utente["Email"];?>" required/>
			</li>
			<li>
				<label for="username"></label><input type="text" placeholder="Username" id="username" name="username"  value="<?php echo $utente["Username"];?>" required/>
			</li>
			<?php if($templateParams["azione"]!=2) : ?>
			<li>
				<label for="password"></label><input type="password" placeholder="Password" id="password" name="password" required/>
			</li>
			<li>
				<label for="confirmPassword"></label><input type="password" placeholder="conferma password" id="confirmPassword" name="confirmPassword" required/>
			</li>
			<li>
				<label for="user">Utente</label><input type="radio" id="user" name="type" value="user" checked />
				<label for="organizer">Organizzatore</label><input type="radio" id="organizer" name="type" value="organizer" />
			</li>
			<?php else:;?>
			<li>
				<input type="hidden" name="oldusername" value="<?php echo $utente["Username"];?>">
			</li>
			<?php endif; ?>
			<li>
				<input type="submit" name="btnsubmit" value="Invia" />
			</li>
		</ul>
	</form>
<p>Hai già un account? <a href="login.php">fai il Login!</a></p>
