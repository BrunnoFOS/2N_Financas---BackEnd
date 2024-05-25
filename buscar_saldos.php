<?php
include "conexao.php";
include("protecao.php");

if (isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
    $result = $mysqli->query("SELECT * FROM saldos WHERE id_usuario = $id_usuario");
    if ($result && $result->num_rows > 0) {
        $saldos = $result->fetch_assoc();
        echo json_encode($saldos);
    } else {
        echo json_encode(array("error" => "Nenhum saldo encontrado"));
    }
} else {
    echo json_encode(array("error" => "Sessão não iniciada"));
}
?>
