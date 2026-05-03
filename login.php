<?php
// echo password_hash("admin123", PASSWORD_DEFAULT); // gera um hash com a senha escolhida
session_start();

if (isset($_GET['logout'])) {
    session_unset();   // limpa variáveis da sessão
    session_destroy(); // destrói a sessão

    header('Location: login.php');
    exit;
}

$usuario_correto = "admin";
$senha_hash = '$2y$10$MROWg2w4xHnNNBwZoH8GSuT7cEeOifaAdsgBC180Lqr1rQpAZrZzi';
if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ($usuario === $usuario_correto && password_verify($senha, $senha_hash)) {
        $_SESSION['loggedin'] = true;
        header('Location: ./index.php');
    } else {
        echo "<p style='color: red'>Usuário ou senha incorretos.</p>";
        $_SESSION['loggedin'] = false;
    }
    // caso os campos ainda estejam vazios, não atribuir nada.
}



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <main>
        <div class="cardbox" style="max-width: 400px; margin: 100px auto 0;">
            <form method="POST" action="">
                <div style="color: rgb(204, 68, 68); padding: 10px; border-radius: 8px; background-color: rgb(29, 24, 32); margin-bottom: 20px;">
                </div>
                <div>
                    <label for="usuario">Usuário:</label>
                    <br>
                    <input type="text" id="usuario" name="usuario" required>
                    <br>
                </div>
                <div>
                    <label for="senha">Senha:</label>
                    <br>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div>
                    <button type="submit" class="btnVerde">Entrar</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>