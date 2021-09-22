<form action="messageManager.php" method="POST">
    <label for="message">Messaggio</label><textarea name="testo" class="md-textarea form-control" rows="3"></textarea>
    <input type="hidden" name="cfd" value="<?php echo $_GET["cfd"]; ?>" />
    <input type="hidden" name="cfm" value="<?php echo $_GET["cfm"]; ?>" />
    <input type="submit" name="submit" value="Invia" />
</form>
