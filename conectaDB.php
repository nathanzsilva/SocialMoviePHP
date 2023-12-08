<?php
// $server = "aws.connect.psdb.cloud";
// $user = "n3ohvvk5d4lki8f7uose";
// $password = "pscale_pw_yb3JYUeRKJyg6RbgH0KxIQ4et6XGaaEIwxypEmK7fll";
// $database = "bancoetecantoniofurlan";

// $mysqli = mysqli_init();
// $mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
// $mysqli->real_connect($server, $user, $password, $database);

$server = "127.0.0.1";
$user = "root";
$password = "root";
$database = "bancoetecantoniofurlan";


$mysqli = mysqli_init();
$mysqli->real_connect($server, $user, $password, $database);
?>