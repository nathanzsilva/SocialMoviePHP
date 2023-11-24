<?php
  $mysqli = mysqli_init();
  $mysqli->ssl_set(NULL, NULL, "./cacert.pem", NULL, NULL);
  $mysqli->real_connect("aws.connect.psdb.cloud", "k9a4qgic8hfgkq8ue592", "pscale_pw_qHXkJcFuGpuVSHgQ71mLIuXbvM4nbvzOoOgJScqnG0F", "bancoetecantoniofurlan");  
?>