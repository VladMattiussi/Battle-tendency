<?php
session_start();
define("UPLOAD_DIR_EVENTO", "./upload/evento/");
define("UPLOAD_DIR_COMBATTENTE", "./upload/combattente/");
require_once 'db/db.php';
require_once 'utils/functions.php';
$dbh = new DatabaseHelper("localhost", "root", "", "bt");
?>