<?php
$idPost = $_GET["id"] ?? "";
if($idPost == "") {
    header("location:comunidade.php");
}


session_start();
include_once("conectaDB.php");


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
                    <a href="index.php">
                        <li>Home</li>
                    </a>
                    <a href="index.php">
                        <li class="active">Comunidade</li>
                    </a>
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
                echo "<a href='./respondsPost.php?id=".$idPost."'><button class='btn-post'>Responder Post</button></a>";
                ?>

            </div>
        </header>

        <div class="movie-details">
            <div class="movie">
                <?php
                $query = "select *, f.descricao as filme from Posts as p join Usuario as u on p.usuariocodigo = u.codigo join Filmes as f on f.codigo = p.codigofilme where p.codigo = $idPost;";

                $result = mysqli_query($mysqli, $query);
                $row = mysqli_fetch_assoc($result);
                $username = $row["nome"];
                $filme = $row["filme"];
                $texto = $row["texto"];
                $dataCad = $row["dataCad"];
                $formattedDate = date("d/m/Y", strtotime($dataCad));


                echo "  <div class='comment'><div class='user-info'>";
                echo "<h3 class='username'>$username - $filme - $formattedDate</h3>";
                echo "</div>";

                echo "<p class='comment-text'>$texto</p>";
                echo "</div>";


                ?>
            </div>
        </div>
        <hr class='margin20'>;
        <div class="container-comments">
            <h2>Comentários</h2>


            <?php

            $query = "select *, c.codigo as commentCodigo,c.usuariocodigo as userId from Comentarios as c join Usuario as u on c.usuariocodigo = u.codigo where c.postCodigo =$idPost;";

            $result = mysqli_query($mysqli, $query);

            if(mysqli_num_rows($result) > 0) {
                foreach($result as $row) {

                    $usuariocodigo = $row["userId"];


                    $commentCodigo = $row["commentCodigo"];
                    $username = $row["nome"];
                    $texto = $row["texto"];
                    $dataCad = $row["dataCad"];
                    $formattedDate = date("d/m/Y", strtotime($dataCad));

                    //
            

                    echo "  <div class='comment'><div class='user-info'>";

                    if($_SESSION['userId'] == $usuariocodigo)
                        echo "<form action='deletarComment.php'><input name='id' value='$commentCodigo' type='hidden'><input class='btn-delete' type='submit' value='Apagar'></form>";
                    echo "<h3 class='username'>$username - $formattedDate</h3>";
                    echo "</div>";

                    echo "<p class='comment-text'>$texto</p>";

                }
            } else {

                echo "<br>";
                echo "<h3>Sem nenhum comentário</h3>";



            }
            ?>
        </div>
    </div>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/exit.js"></script>
    <script>
        // Adicione qualquer lógica adicional necessária para processar os comentários
    </script>
</body>

</html>