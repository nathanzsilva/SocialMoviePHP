<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="body-login">
        <header>
            <img src="./images/logo.png" alt="">
        </header>
        <!-- <a href="./login.php">
        <button>Fazer Login</button>
    </a>
    <a href="./index.php">
        <button>Ver Posts</button>
    </a> -->
        <div class="container-login">
            <h1>Cadastro</h1>
            <form method="POST">
                <input class="form-input" type="text" name="nome" placeholder="Nome" required><br>
                <input class="form-input" type="text" name="email" placeholder="E-mail" required><br>
                <input class="form-input" type="password" name="senha" placeholder="Senha" required><br>
                <input class="form-input" type="password" name="confsenha" placeholder="Confirme a senha" required><br>
                <div class="form-date">
                    <label for="">Data de nascimento:</label>
                    <input class="form-input" type="date" name="datanascimento" required><br>
                </div>
                <input class="btn-login" type="submit" name="enviar" value="Enviar">
            </form>
            <h3 class="cadastrese">Já possue acesso? <a href="./login.php">Entrar!</a></h3>


            <?php
            if(isset($_POST["enviar"])) {
                include_once("conectaDB.php");
                $nome = $_POST["nome"];
                $email = $_POST["email"];
                $senha = $_POST["senha"];
                $confsenha = $_POST["confsenha"];
                $datanascimento = $_POST["datanascimento"];

                if($senha != $confsenha) {
                    echo "<script>alert('As senhas não coincidem!!')</script>";
                    return;
                }

                $query = "select * from Usuario where email = '$email'";

                $result = mysqli_query($mysqli, $query);

                if($row = mysqli_fetch_assoc($result)) {
                    echo "<script>alert('Já tem um usuário com este email!')</script>";
                    return;
                }


                $query = "insert Usuario (nome, email, senha, dataNascimento) values ('$nome', '$email','$senha','$datanascimento')";

                $result = mysqli_query($mysqli, $query);

                if(!$result) {
                    die("Query inválida:".mysqli_error($mysqli));
                } else {
                    echo "Usuario Cadastrado com sucesso";
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

            }
            ?>
        </div>
    </div>
</body>

</html>