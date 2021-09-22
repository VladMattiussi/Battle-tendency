<div id="login">
	<form action="#" method="POST">

            <?php if(isset($templateParams["errorelogin"])){
                echo "<p>".$templateParams["errorelogin"]."</p>";
                }?>
            <?php if(isset($_GET["msg"])){
                echo "<p>".$_GET["msg"]."</p>";
                }?>
            <ul>
                <li>
                    <label for="username"></label><input type="text" placeholder="Username" id="username" name="username" />
                </li>
                <li>
                    <label for="password"></label><input type="password" placeholder="Password" id="password" name="password" />
                </li>
                <li>
                    <input type="submit" name="submit" value="Login" />
                </li>
            </ul>
        </form>
	<a href="signUp.php?action=1">Non hai un account? Registrati!</a>
</div>
