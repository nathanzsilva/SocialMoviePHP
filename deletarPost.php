<?php
session_start();
include_once("conectaDB.php");

$idPost = $_GET["id"];

$query = "delete from Posts where codigo = $idPost";

$result = mysqli_query($mysqli, $query);

if (!$result) {
    die("Query inválida:" . mysqli_error($mysqli));
} else {
    header("location: /index.php");
}
?>