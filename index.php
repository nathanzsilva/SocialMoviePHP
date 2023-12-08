<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Social Movie</title>
    <link rel="stylesheet" href="./styles/carrosel.css">
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
                        echo "<a href='./deslogar.php' style='display:none;' id='deslogar'>Deslogar</a>";
                    } else {
                        echo " <a href='./login.php' id='login'>Login</a>";
                    }
                    ?>


                </div>

                <a href="./insertPost.php">
                    <button class="btn-post">
                        Post
                    </button>
                </a>
            </div>

        </header>

        <div class="carrosel-container">
            <div class="slider">
                <div class="slides">
                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">

                    <div class="slide first">
                        <img src="./images/slide1.png" alt="">
                    </div>
                    <div class="slide">
                        <img src="./images/fundologin.png" alt="">
                    </div>
                    <div class="slide">
                        <img src="./images/slide1.png" alt="">
                    </div>
                    <div class="slide">
                        <img src="./images/fundologin.png" alt="">
                    </div>

                    <div class="navigation-auto">
                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                        <div class="auto-btn3"></div>
                        <div class="auto-btn4"></div>
                    </div>
                </div>
                <div class="manual-navigation">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                </div>

            </div>
        </div>



        <h2 class="title">Os melhores do Ano</h2>

        <div class="container-movies">


            <?php
            include_once("conectaDB.php");

            $query = "select * from Filmes;";

            $result = mysqli_query($mysqli, $query);

            if(!$result) {
                die("Query inválida:".mysqli_error($mysqli));
            } else {
                mysqli_close($mysqli);
                foreach($result as $row) {
                    $idFilme = $row["codigo"];
                    $texto = $row["descricao"];
                    $imagemUrl = $row["urlImagem"];
                    echo "<a href='./comunidade.php?id=$idFilme'>";
                    echo "<div>";
                    echo "<img src='$imagemUrl'/>";
                    echo "<h2>$texto</h2>";
                    echo "</div>";
                    echo "</a>";
                }


            }
            ?>
        </div>

    </div>

    <script src="./scripts/script.js"></script>
    <script src="./scripts/exit.js"></script>
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