<?php
session_start();
include_once("conectaDB.php");

if(!isset($_SESSION['userId'])) {
    header("Location: ./index.php");
    exit;
}

$userId = $_SESSION['userId'][0];

$query = "SELECT * FROM Usuario WHERE codigo = $userId";
$result = mysqli_query($mysqli, $query);

if($result) {
    $userData = mysqli_fetch_assoc($result);
} else {
    die("Query inválida: ".mysqli_error($mysqli));
}

if(isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaAntiga = $_POST['senha_antiga'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];
    $datanascimento = $_POST['datanascimento'];

    if(!password_verify($senhaAntiga, $userData['senha'])) {
        echo "<script>alert('Senha antiga incorreta. A senha não foi alterada.'</script>";
    } else {
        $updateQuery = "UPDATE Usuario SET nome = '$nome', email = '$email', dataNascimento = '$datanascimento'";

        if(!empty($senha) && $senha == $confsenha) {
            $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);
            $updateQuery .= ", senha = '$hashedPassword'";
        }

        $updateQuery .= " WHERE codigo = $userId";

        $updateResult = mysqli_query($mysqli, $updateQuery);

        if($updateResult) {
            $_SESSION['userName'] = $nome;
        } else {
            echo "Erro ao atualizar o perfil: ".mysqli_error($mysqli);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - SocialMovie</title>
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
        <div class="container-perfil">

            <form method="POST">
                <h1>Seu perfil</h1>
                <div>
                    <div>
                        <input class="form-input" type="text" name="nome" placeholder="Nome" required
                            value="<?php echo $userData['nome']; ?>"><br>
                        <input class="form-input" type="text" name="email" placeholder="E-mail" required
                            value="<?php echo $userData['email']; ?>"><br>
                    </div>
                    <input class="form-input" type="password" name="senha_antiga" placeholder="Senha antiga" required><br>
                    <div>
                        <input class="form-input" type="password" name="senha" placeholder="Senha" required><br>
                        <input class="form-input" type="password" name="confsenha" placeholder="Confirme a senha"
                            required>
                    </div>
                    <br>
                    <div class="form-date">
                        <label for="">Data de nascimento:</label>
                        <input class="form-input" type="date" name="datanascimento" required
                            value="<?php echo $userData['dataNascimento']; ?>"><br>
                    </div>
                </div>
                <input class="btn-login margin20" type="submit" name="atualizar" value="Atualizar">
            </form>
        </div>
    </div>
    <script src="./scripts/exit.js"></script>

</body>

</html>