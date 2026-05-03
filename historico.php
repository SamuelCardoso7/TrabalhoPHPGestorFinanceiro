<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    session_destroy();
    header('Location: login.php');
    exit;
}
if (isset($_POST['limpar'])) {
    $_SESSION['transacoes'] = [];
    $_SESSION['receita'] = 0;
    $_SESSION['total'] = 0;
    $_SESSION['despesa'] = 0;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
    <title>Transações</title>
</head>

<body>

    <?php include "navbar.php"; ?>

    </div>

    <main class="historico">

        <h2>Lista de Transações</h2>
        <br>
        <table>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Tipo</th>
                <th>Impacto (%)</th>
            </tr>
            <tbody>

                <?php
                if (isset($_SESSION['transacoes']) && count($_SESSION['transacoes']) > 0) {
                    foreach ($_SESSION['transacoes'] as $t) {
                        echo "<tr>";
                        echo "<td>" . $t["desc"] . "</td>";
                        echo "<td>" . number_format($t["valor"], 2 , ",", ".") . " R$ </td>";
                        echo "<td>" . $t["tipo"] . "</td>";
                        echo "<td>" . number_format($t["valor"]*100/$_SESSION['movimentacao'], 2) . "%</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<u>Nenhuma transação cadastrada.</u>";
                }
                ?>

            </tbody>
        </table>
        <form method="POST">
            <button class="btnVermelho" type="submit" name="limpar">Limpar Histórico de Transação</button>
        </form>

    </main>

</body>

</html>