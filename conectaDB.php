<?php
  $mysqli = mysqli_init();
  $mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
  $mysqli->real_connect("aws.connect.psdb.cloud", "as5zonq8yruds8pa3h9y", "pscale_pw_vaKXJi90IFcAJZM5doWLE7d7PNGoRpcumzxI6aoejYu", "bancoetecantoniofurlan");  
?>