<?php
session_start();
include_once("conectaDB.php");


$idFilme = $_GET["id"] ?? "";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidade de Filmes - Detalhes do Filme</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="body-comunidade">
        <header>
            <img src="./images/logo.png" alt="Logo">
            <div>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Comunidade</li>
                    <a href="./perfil.php">
                        <li>Perfil</li>
                    </a>
                </ul>
            </div>
            <div class="row aic gap5">
                <div onmouseenter='seeExit()' onmouseleave='hideExit()'>
                    <?php

                    $user = $_SESSION['userName'] ?? "";
                    if($user != "") {
                        $userName = $_SESSION['userName'];
                        if($userName != null)
                            echo "<p>$userName</p>";
                    }
                    ?>

                    <a href="./deslogar.php" style="display:none;" id="deslogar">
                        Deslogar
                    </a>
                </div>

                <?php
                if($idFilme == "") {
                    echo "<a href='./insertPost.php'><button class='btn-post'>Post</button></a>";
                } else {
                    echo "<a href='./insertPost.php?id=".$idFilme."'><button class='btn-post'>Post</button></a>";

                }
                ?>

            </div>
        </header>

        <div class="movie-details">
            <div class="movie">
                <?php
                if($idFilme != "") {
                    $query = "select * from Filmes where codigo = $idFilme;";

                    $result = mysqli_query($mysqli, $query);

                    $row = mysqli_fetch_assoc($result);
                    $img = $row["urlImagem"];
                    $descricao = $row["descricao"];
                    echo "<img src='$img'>";

                    echo "<div class='movie-info'><h2>$descricao</h2></div>";

                }

                ?>
            </div>
        </div>
        <?php
        if($idFilme != "") {
            echo "<hr class='margin20'>";
        } ?>
        <div class="container-comments">
            <h2>Comentários</h2>


            <?php
            if($idFilme != "") {

                $query = "select *, p.codigo as postCodigo, p.usuariocodigo as userId from Posts as p join Usuario as u on p.usuariocodigo = u.codigo where codigoFilme =$idFilme;";

                $result = mysqli_query($mysqli, $query);

                if(mysqli_num_rows($result) > 0) {
                    foreach($result as $row) {

                        $usuariocodigo = $row["userId"];
                        $postCodigo = $row["postCodigo"];
                        $username = $row["nome"];
                        $texto = $row["texto"];
                        $dataCad = $row["dataCad"];
                        $formattedDate = date("d/m/Y", strtotime($dataCad));

                        echo " <a href='./post.php?id=$postCodigo'> <div class='comment'><div class='user-info'>";

                        if($_SESSION['userId'] == $usuariocodigo)
                            echo "<form action='deletarPost.php'><input name='id' value='$postCodigo' type='hidden'><input class='btn-delete' type='submit' value='Apagar'></form>";
                        echo "<h3 class='username'>$username - $formattedDate</h3>";
                        echo "</div>";

                        echo "<p class='comment-text'>$texto</p></div></a>";

                    }
                } else {
                    echo "<br>";
                    echo "<h3>Sem nenhum comentário</h3>";
                }

            } else {
                $query = "select *, f.descricao as filme, p.codigo as postCodigo,  p.usuariocodigo as userId from Posts as p join Usuario as u on p.usuariocodigo = u.codigo join Filmes as f on f.codigo = p.codigofilme;";

                $result = mysqli_query($mysqli, $query);

                foreach($result as $row) {

                    $usuariocodigo = $row["userId"];
                    $postCodigo = $row["postCodigo"];
                    $username = $row["nome"];
                    $filme = $row["filme"];
                    $texto = $row["texto"];
                    $dataCad = $row["dataCad"];
                    $formattedDate = date("d/m/Y", strtotime($dataCad));


                    echo " <a href='./post.php?id=$postCodigo'> <div class='comment'><div class='user-info'>";

                    if($_SESSION['userId'] == $usuariocodigo)
                        echo "<form action='deletarPost.php'><input name='id' value='$postCodigo' type='hidden'><input class='btn-delete' type='submit' value='Apagar'></form>";
                    echo "<h3 class='username'>$username - $filme - $formattedDate</h3>";
                    echo "</div>";

                    echo "<p class='comment-text'>$texto</p>";

                    echo "</div></a>";

                }
            }

            ?>




        </div>


    </div>


    </div>

    <script src="./scripts/script.js"></script>
    <script src="./scripts/exit.js"></script>
    <script>
        // Adicione qualquer lógica adicional necessária para processar os comentários
    </script>
</body>

</html>