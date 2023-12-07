<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="body-login">
        <header>
            <img src="./images/logo.png" alt="">
        </header>
        <!-- <?php
        // if($_SESSION['userName'] != null) {
        //     $userName = $_SESSION['userName'];
        //     if($userName != null)
        //         echo "<h1>User: $userName</h1>";
        // }
        ?>
        <a href="./cadastro.php">
            <button>Fazer Cadastro</button>
        </a>
        <a href="./index.php">
            <button>Ver Posts</button>
        </a> -->
        <div class="container-login">
            <h1>Login</h1>
            <form method="POST">
                <input class="form-input" type="text" name="email" placeholder="E-mail"><br>
                <input class="form-input" type="text" name="senha" placeholder="Senha"><br>
                <input class="btn-login" type="submit" name="enviar" value="Enviar">

            </form>

            <h3 class="cadastrese">Novo por aqui? <a href="./cadastro.php">Cadastre-se!</a></h3>

            <?php
            if(isset($_POST["enviar"])) {
                include_once("conectaDB.php");
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                $query = "select * from Usuario where email = '$email' and senha = '$senha'";

                $result = mysqli_query($mysqli, $query);

                if(!$result) {
                    die("Query inválida:".mysqli_error($mysqli));
                } else {
                    mysqli_close($mysqli);

                    if($row = mysqli_fetch_assoc($result)) {
                        $_SESSION['userId'] = $row["codigo"];
                        $_SESSION['userName'] = $row["nome"];
                        echo "<script>window.location.href = './index.php'</script>";
                        echo "Logado";
                    } else {
                        echo "email ou usuario Invalido";
                    }
                }
            }
            ?>
        </div>
    </div>
</body>

</html>