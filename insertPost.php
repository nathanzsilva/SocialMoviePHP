<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    if ($_SESSION['userName'] != null) {
        $userName = $_SESSION['userName'];
        if ($userName != null)
            echo "<h1>User: $userName</h1>";
    }
    ?>
    <a href="./index.php">
        <button>Ver Posts</button>
    </a>
    <form method="POST">
        <label for="">Texto:</label><br>
        <textarea type="text" name="texto" required></textarea><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>


    <?php
    if (!isset($_SESSION['userId'])) {
        echo "<script>alert('Você precisa fazer login para publicar um Post');window.location.href = './index.php'</script>";

    }
    if (isset($_POST["enviar"])) {
        if (!isset($_SESSION['userId'])) {
            echo "<script>window.location.href = './index.php'</script>";
        }
        include_once("conectaDB.php");
        $texto = $_POST["texto"];
        $userId = $_SESSION['userId'][0];

        $query = "insert Posts (texto, usuariocodigo, datacad) values ('$texto',$userId,CURRENT_TIMESTAMP())";

        $result = mysqli_query($mysqli, $query);

        if (!$result) {
            die("Query inválida:" . mysqli_error($mysqli));
        } else {
            mysqli_close($mysqli);
            echo "Post Cadastrado com sucesso";
        }
    }
    ?>
</body>

</html>