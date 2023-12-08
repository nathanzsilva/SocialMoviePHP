<?php
session_start();

$idFilme = $_GET["id"] ?? "";
include_once("conectaDB.php");


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Post - SocialMovie</title>
    <link rel="stylesheet" href="./styles/style.css">

</head>

<body>

    <div class="body-home">
        <header>
            <img src="./images/logo.png" alt="">
            <div>
                <ul>
                    <a href="./index.php">
                        <li>Home</li>
                    </a>
                    <a href="./comunidade.php">
                        <li>Comunidade</li>
                    </a>
                    <a href="./perfil.php">
                        <li>Perfil</li>
                    </a>
                </ul>
            </div>
            <div class="row aic gap5">
                <div onmouseenter='seeExit()' onmouseleave='hideExit()'>
                    <?php
                    if($_SESSION['userName'] != null) {
                        $userName = $_SESSION['userName'];
                        if($userName != null)
                            echo "<p>$userName</p>";
                    }
                    ?>

                    <a href="./deslogar.php" style="display:none;" id="deslogar">
                        Deslogar
                    </a>
                </div>

            </div>

        </header>
        <div class="container-insertPost">
            <form method="POST">
                <h1>Inserir Post</h1>
                <?php
                if($idFilme == "") {
                    $query = "select * from Filmes;";

                    $result = mysqli_query($mysqli, $query);
                    echo "<select name='idFilme' class='form-input'>";
                    foreach($result as $row) {

                        $descricao = $row["descricao"];
                        $codigo = $row["codigo"];

                        echo "<option value='$codigo'>$descricao</option>";
                    }
                    echo "</select>";

                }
                ?>
                <textarea type="text" name="texto" placeholder="Texto" style="color:black;" required></textarea><br>
                <input type="submit" name="enviar" value="Enviar">
            </form>


            <?php
            if(!isset($_SESSION['userId'])) {
                echo "<script>alert('Você precisa fazer login para publicar um Post');window.location.href = './index.php'</script>";

            }
            if(isset($_POST["enviar"])) {
                if(!isset($_SESSION['userId'])) {
                    echo "<script>window.location.href = './index.php'</script>";
                }
                $texto = $_POST["texto"];
                $idFilme = $_POST["idFilme"] ?? $idFilme;
                $userId = $_SESSION['userId'][0];

                $query = "insert Posts (codigoFilme, texto, usuariocodigo, datacad) values ($idFilme, '$texto',$userId,CURRENT_TIMESTAMP());";

                $result = mysqli_query($mysqli, $query);

                if(!$result) {
                    die("Query inválida:".mysqli_error($mysqli));
                } else {
                    mysqli_close($mysqli);
                    echo "Post Cadastrado com sucesso";
                }
            }
            ?>
        </div>
    </div>
    <script src="./scripts/exit.js"></script>

</body>

</html>