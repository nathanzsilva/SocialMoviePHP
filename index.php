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
    <a href="./insertPost.php">
        <button>Publicar um Post</button>
    </a>
    <a href="./login.php">
        <button>Fazer Login</button>
    </a>
    <a href="./cadastro.php">
        <button>Fazer Cadastro</button>
    </a>
    <a href="./deslogar.php">
        <button>Deslogar</button>
    </a>
    <?php
    include_once("conectaDB.php");

    $query = "select p.codigo as codigoPost, * from Posts as p join Usuario as u on p.usuarioCodigo = u.codigo;";

    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        die("Query inválida:" . mysqli_error($mysqli));
    } else {
        mysqli_close($mysqli);
        foreach ($result as $row) {
            $codigoPost = $row["codigoPost"];
            $texto = $row["texto"];
            $datacad = $row["dataCad"];
            $nome = $row["nome"];
            $usuarioCodigo = $row["usuarioCodigo"];

            echo "<hr>";
            echo "<div>";
            if ($usuarioCodigo == $_SESSION["userId"]) {
                echo "<button onclick='deletar($codigoPost)'>Deletar</button>";
                echo "<button onclick='editar($codigoPost)'>Editar</button>";
            }

            echo "<h3>$nome - $datacad</h3>";
            echo "<p>$texto</p>";


            echo "</div>";
        }


    }
    ?>
    <script>
        function deletar(id) {
            window.location.href = `./deletarPost.php/?id=${id}`;
        }
        function editar(id) {
            window.location.href = `./editarPost.php/?postId=${id}`;
        }
    </script>
</body>

</html>