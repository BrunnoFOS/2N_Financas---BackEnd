<?php
include "conexao.php";
include("protecao.php");

$response = array();

if (isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];

    $result_saldos = $mysqli->query("SELECT * FROM saldos WHERE id_usuario = $id_usuario");
    if ($result_saldos && $result_saldos->num_rows > 0) {
        $response['saldos'] = $result_saldos->fetch_assoc();
    } else {
        $response['saldos'] = array("error" => "Nenhum saldo encontrado");
    }

    $result_historico = $mysqli->query("SELECT * FROM historico_transacoes WHERE id_usuario = $id_usuario ORDER BY data DESC");
    if ($result_historico && $result_historico->num_rows > 0) {
        $historico = array();
        while ($row = $result_historico->fetch_assoc()) {
            $historico[] = $row;
        }
        $response['historico'] = $historico;
    } else {
        $response['historico'] = array("error" => "Nenhum histórico encontrado");
    }

    $result_grafico = $mysqli->query("SELECT * FROM dados_grafico WHERE id_usuario = $id_usuario ORDER BY data ASC");
    if ($result_grafico && $result_grafico->num_rows > 0) {
        $grafico = array();
        while ($row = $result_grafico->fetch_assoc()) {
            $grafico[] = $row;
        }
        $response['grafico'] = $grafico;
    } else {
        $response['grafico'] = array("error" => "Nenhum dado encontrado para o gráfico");
    }

    echo json_encode($response);
} else {
    echo json_encode(array("error" => "Sessão não iniciada"));
}
?>
