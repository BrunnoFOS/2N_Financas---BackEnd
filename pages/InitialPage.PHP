<?php
include("conexao.php");
include("protecao.php");
$nome_usuario = $_SESSION['nome'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>2N Finanças</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>
</head>

<body>
    <div>
        <div class="card">

            <h1>Bem-vindo ao <span class="animacao" id="efeito_TypeWritter"></span></h1>
            <div class="card-text">Gerencie suas finanças de forma eficaz em uma plataforma intuitiva. Acompanhe transações,
                categorize gastos e analise com gráficos detalhados para tomar decisões seguras e alcançar suas metas
                financeiras com confiança
            </div>
            <a href="controle_financeiro.php?nome=<?php echo urlencode($nome_usuario); ?>" class="button button-acess">Acesse o Controle Financeiro</a>
            <a href="logout.php" style="color:white">Fazer logout</a>
        </div>
    </div>
</button>    
    <footer>
        <span>© 2N Finanças. Todos os direitos reservados. Feito por Brunno Oliveira <a href="https://www.instagram.com/oliv.brunno/" style="color: white;">@oliv.brunno</a> e Maurício Pires <a href="https://www.instagram.com/murisxco/" style="color: white;">@murisxco</a></span>
    </footer>
    <script>
        var urlParams = new URLSearchParams(window.location.search);
        var nomeUsuario = urlParams.get('nome');

        var typed = new Typed('#efeito_TypeWritter', {
            strings: ['2N Finanças, ' + nomeUsuario + '!'],
            typeSpeed: 95,
        });

        document.addEventListener("DOMContentLoaded", function() {
            var card = document.querySelector(".card");
            var button = document.querySelector(".button");

            setTimeout(function() {
                card.classList.add("show");
                button.classList.add("show");
            }, 100);
        });
    </script>
</body>

</html>