<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <a href="./login.php">
        <button>Fazer Login</button>
    </a>
    <a href="./index.php">
        <button>Ver Posts</button>
    </a>
    <form method="POST">
        <label for="">Nome:</label>
        <input type="text" name="nome" required><br>
        <label for="">Email:</label>
        <input type="text" name="email" required><br>
        <label for="">Senha:</label>
        <input type="text" name="senha" required><br>
        <label for="">Data de nascimento:</label>
        <input type="date" name="datanascimento" required><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>

    <?php
    if (isset($_POST["enviar"])) {
        include_once("conectaDB.php");
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $datanascimento = $_POST["datanascimento"];

        $query = "select * from Usuario where email = '$email'";

        $result = mysqli_query($mysqli, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            echo "<script>alert('Já tem um usuário com este email!')</script>";        
            return;
        } 
        

        $query = "insert Usuario (nome, email, senha, dataNascimento) values ('$nome', '$email','$senha','$datanascimento')";

        $result = mysqli_query($mysqli, $query);

        if (!$result) {
            die("Query inválida:" . mysqli_error($mysqli));
        } else {            
            echo "Usuario Cadastrado com sucesso";
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
        
    }
    ?>
</body>

</html>