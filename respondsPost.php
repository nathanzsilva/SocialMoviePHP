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
    <title>Responder Post - SocialMovie</title>
    <link rel="stylesheet" href="./styles/style.css">

</head>

<body>

    <div class="body-home">
        <header>
            <img src="./images/logo.png" alt="">
            <div>
                <ul>
                    <li class="active">Home</li>
                    <a href="./comunidade.php">
                        <li>Comunidade</li>
                    </a>
                    <li>Perfil</li>
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
                <h1>Responder Post</h1>
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
                $userId = $_SESSION['userId'][0];

                $query = "insert Comentarios (postCodigo, texto, usuariocodigo, datacad) values ($idPost, '$texto',$userId,CURRENT_TIMESTAMP());";

                $result = mysqli_query($mysqli, $query);

                if(!$result) {
                    die("Query inválida:".mysqli_error($mysqli));
                } else {
                    mysqli_close($mysqli);
                    echo "Resposta Cadastrada com sucesso";
                }
            }
            ?>
        </div>
    </div>
    <script src="./scripts/exit.js"></script>

</body>

</html>