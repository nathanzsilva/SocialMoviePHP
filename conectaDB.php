<?php
$server = "aws.connect.psdb.cloud";
$user = "dy4n92hqhaed8cbt3f02";
$password = "pscale_pw_3TRT4Zmhsh9cNBDyofzkPS8H4qIsxiLoXS9NLKdhk9R";
$database = "bancoetecantoniofurlan";

$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
$mysqli->real_connect($server, $user, $password, $database);

// $server = "127.0.0.1";
// $user = "root";
// $password = "root";
// $database = "bancoetecantoniofurlan";


// $mysqli = mysqli_init();
// $mysqli->real_connect($server, $user, $password, $database);
?>