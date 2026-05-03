<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    session_destroy();
    header('Location: ./login.php');
    exit;
}


if (isset($_POST['desc']) && isset($_POST['valor']) && isset($_POST['tipo'])) {

    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];

    $_SESSION['transacoes'][] = [
        "desc" => $_POST['desc'],
        "valor" => $_POST['valor'],
        "tipo" => $_POST["tipo"] == 1 ? '<p style="color: rgb(74, 187, 74);">Receita' : '<p style="color: rgb(204, 68, 68);">Despesa'
    ];


    if ($tipo == 1) {
        $_SESSION['receita'] += $valor;
        $_SESSION['total'] += $valor;
    } else {
        $_SESSION['despesa'] += $valor;
        $_SESSION['total'] -= $valor;
    }
    $_SESSION['movimentacao'] += $valor;

    header("Location: " . $_SERVER['PHP_SELF']); //evita o formulário ser reenviado quando a página é recarregada
    exit;
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
    <?php include 'navbar.php'; ?>

    <main>
        <div class="cardbox">
            <h2 style="color: rgb(74, 187, 74);">Total Receitas:</h2>
            <br>
            <input type="text" class="inputDisabled" disabled value="<?php echo isset($_SESSION['receita']) ? number_format( $_SESSION['receita'], 2 , ",", "."). " R$ " : '0 R$ ' ?>">
        </div>
        <div class="cardbox">
            <h2 style="color: rgb(204, 68, 68);">Total Despesas:</h2>
            <br>
            <input type="text" class="inputDisabled" disabled value="<?php echo isset($_SESSION['despesa']) ? number_format( $_SESSION['despesa'], 2 , ",", "."). " R$ " : '0 R$ ' ?>">
        </div>
        <div class="cardbox">
            <h2 style="color: rgb(95, 95, 206);">Saldo Disponível:</h2>
            <br>
            <input type="text" class="inputDisabled" disabled value="<?php echo isset($_SESSION['total']) ? number_format( $_SESSION['total'], 2 , ",", "."). " R$ " : '0 R$ ' ?>">
        </div>
        <div class="cardboxForm">
            <h2>Cadastrar Transação:</h2>
            <br>
            <form method="POST">
                <div>
                    <label for="desc">Descrição:</label>
                    <input type="text" name="desc">
                </div>
                <div>
                    <label for="valor">Valor:</label>
                    <input type="number" name="valor">
                </div>
                <div>
                    <label for="tipo">Tipo:</label>
                    <select id="selectTipo" class="selectTipo" name="tipo">
                        <option style="color: rgb(96, 108, 146);" selected disabled>Selecionar</option>
                        <option value="1" style="color: rgb(74, 187, 74);">Receita</option>
                        <option value="2" style="color: rgb(204, 68, 68);">Despesa</option>
                    </select>
                </div>
                <div>
                    <button class="btnVerde" type="submit">Adicionar</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>