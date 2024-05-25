<?php
include "conexao.php";
include "protecao.php";

if (isset($_SESSION['id']) && isset($_POST['descricao']) && isset($_POST['valor']) && isset($_POST['tipo'])) {
    $id_usuario = $_SESSION['id'];
    $descricao = $_POST['descricao'];
    $valor = (float)$_POST['valor'];
    $tipo = $_POST['tipo'];

    $stmt = $mysqli->prepare("INSERT INTO historico_transacoes (id_usuario, descricao, valor, tipo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $id_usuario, $descricao, $valor, $tipo);
    $stmt->execute();

    $saldo_caixa_diferenca = 0;
    $poupanca_diferenca = 0;

    if ($tipo === 'receita') {
        $saldo_caixa_diferenca = $valor;
    } elseif ($tipo === 'despesa') {
        $saldo_caixa_diferenca = -$valor;
    } elseif ($tipo === 'adicionarPoupanca') {
        $poupanca_diferenca = $valor;
    } elseif ($tipo === 'retirarPoupanca') {
        $poupanca_diferenca = -$valor;
    }

    $stmt = $mysqli->prepare("UPDATE saldos SET saldo_total = saldoTotal + ?, saldo_caixa = saldoCaixa + ?, poupanca = poupanca + ? WHERE id_usuario = ?");
    $stmt->bind_param("dddi", $saldo_caixa_diferenca, $saldo_caixa_diferenca, $poupanca_diferenca, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows <= 0) {
        error_log("Erro ao atualizar os saldos no banco de dados para o usuário: {$id_usuario}", 0);
        echo json_encode(array("error" => "Erro ao atualizar os saldos no banco de dados"));
    } else {
        $result = $mysqli->query("SELECT * FROM saldos WHERE id_usuario = $id_usuario");
        $saldos = $result->fetch_assoc();
        echo json_encode($saldos);
    }
} else {
    error_log("Parâmetros ausentes na requisição", 0);
    echo json_encode(array("error" => "Parâmetros ausentes"));
}
?>
