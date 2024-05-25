<?php
session_start();

include "conexao.php";

$erro_email = false; 
$erro_senha = false; 
$erro_login = false; 

if (isset($_POST["email"]) && isset($_POST["senha"])) {

    if (strlen($_POST["email"]) == 0) {
        $erro_email = true; 
    }

    if (strlen($_POST["senha"]) == 0) {
        $erro_senha = true; 
    }

    if (!$erro_email && !$erro_senha) {
        $email = $mysqli->real_escape_string($_POST["email"]);
        $senha = $_POST["senha"];

        $sql_code = "SELECT * FROM users WHERE email = '$email'";
        $sql_query = $mysqli->query($sql_code) or die('Falha na conexão do código SQL: ' . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade > 0) {
            $usuario = $sql_query->fetch_assoc();

            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                $id_usuario = $usuario['id'];
                $sql_saldos = "SELECT * FROM saldos WHERE id_usuario = $id_usuario";
                $result_saldos = $mysqli->query($sql_saldos);
                $_SESSION['saldos'] = $result_saldos->fetch_assoc();

                $sql_transacoes = "SELECT * FROM historico_transacoes WHERE id_usuario = $id_usuario";
                $result_transacoes = $mysqli->query($sql_transacoes);
                $_SESSION['historico_transacoes'] = $result_transacoes->fetch_all(MYSQLI_ASSOC);

                $sql_dados_grafico = "SELECT * FROM dados_grafico WHERE id_usuario = $id_usuario";
                $result_dados_grafico = $mysqli->query($sql_dados_grafico);
                $_SESSION['dados_grafico'] = $result_dados_grafico->fetch_assoc();

                header("Location: initialpage.php?nome=" . $usuario['nome']);
                exit();
            } else {
                $erro_login = true; 
            }
        } else {
            $erro_login = true; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2n - Sistema Bancário</title>
    <link rel="stylesheet" href="styles.css"> <!-- Inclui o arquivo CSS para estilos personalizados -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login - 2N Finanças</h1>
        <?php
        // Verifica se os campos de e-mail e senha foram submetidos
        if (isset($_POST["email"]) && isset($_POST["senha"])) {
            // Exibe mensagens de erro com base nas variáveis de erro
            if ($erro_email && $erro_senha) {
                echo '<div class="alert alert-danger" role="alert">Insira seu e-mail e senha.</div>';
            } elseif ($erro_email) {
                echo '<div class="alert alert-danger" role="alert">Insira seu e-mail.</div>';
            } elseif ($erro_senha) {
                echo '<div class="alert alert-danger" role="alert">Insira sua senha.</div>';
            } elseif ($erro_login) {
                echo '<div class="alert alert-danger" role="alert">E-mail ou senha incorretos! Tente novamente ou tente registrar-se.</div>';
            }
        }
        ?>
        <!-- Formulário de login -->
        <form action="" method="POST">
            <label for="email">E-mail</label>
            <input type="text" id="email" name="email" placeholder="Digite seu e-mail.">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha.">
            <button type="submit">Entrar</button>
            <p>
                <a href="registro.php">Registrar</a> <!-- Link para a página de registro -->
            </p>
        </form>
    </div>
</body>

</html>
