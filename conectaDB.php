<?php
  $mysqli = mysqli_init();
  $mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
  $mysqli->real_connect("aws.connect.psdb.cloud", "tdk4ipxnir31jwyokddp", "pscale_pw_2Lcdd40kbBPhDNjwWCuIsEtyNLy0z8ajNcO8Uizq8NS", "bancoetecantoniofurlan");  
?>