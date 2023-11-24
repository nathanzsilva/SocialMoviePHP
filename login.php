<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    if ($_SESSION['userName'] != null) {
        $userName = $_SESSION['userName'];
        if ($userName != null)
            echo "<h1>User: $userName</h1>";
    }
    ?>
    <a href="./cadastro.php">
        <button>Fazer Cadastro</button>
    </a>
    <a href="./index.php">
        <button>Ver Posts</button>
    </a>
    <form method="POST">
        <label for="">Email</label><br>
        <input type="text" name="email"><br>
        <label for="">Senha</label><br>
        <input type="text" name="senha"><br>
        <input type="submit" name="enviar" value="Enviar">

    </form>

    <?php
    if (isset($_POST["enviar"])) {
        include_once("conectaDB.php");
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $query = "select * from Usuario where email = '$email' and senha = '$senha'";

        $result = mysqli_query($mysqli, $query);

        if (!$result) {
            die("Query inválida:" . mysqli_error($mysqli));
        } else {
            mysqli_close($mysqli);

            if ($row = mysqli_fetch_assoc($result)) {
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
</body>

</html>