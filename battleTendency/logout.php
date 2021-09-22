<?php
require_once 'bootstrap.php';
session_destroy();
header("location: index.php");
?>