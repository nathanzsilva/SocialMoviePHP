<?php
session_start();
$_SESSION['userName'] = null;
$_SESSION['userId'] = null;
header("location: /login.php");


?>