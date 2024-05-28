<?php
$usuario = 'root';
$senha = '';
$database = 'login-page';
$host = 'localhost';           

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->connect_error) {
    echo "Ocorreu uma falha ao conectar com o banco de dados: " . $mysqli->connect_error;
    exit;
}
