  <?php
  include("conexao.php");
  include("protecao.php");
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/BootStrap/bootstrap.min.css" />
  <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <title>2N Finanças</title>
  <link rel="stylesheet" href="styles-CF.css">
</head>


<body>
  <header>
    <nav>
      <div class="divHeader1">
        <a style="font-weight: 800; font-size: 1.2em;" href="InitialPage.PHP">
            <img src="assets/images/arrow.png" alt="Página Inicial" width="30" height="25" />
            Página inicial</a>
    </div>
      <div class="div2Header">
        <a  style="font-weight: 800; font-size: 1.2em;" href="simulador.php">Simulador
          <img src="assets/images/arrow.png" style="transform: rotate(180deg);" alt="Simulador" width="30" height="25"
            class="arrowRight" />
        </a>
      </div>
    </nav>
  </header>

  <div class="container-content">
    <div class="addTransacao division">
      <h2>Adicione uma transação</h2>
      <div>
        <label for="Tipo de Transção">Tipo de transação:</label>
        <select id="tipo" class="inputs" onchange="alterarTipoTransacao()">
          <option value="receita">Receita</option>
          <option value="despesa">Despesa</option>
          <option value="retirarPoupanca">Retirar da poupança</option>
          <option value="adicionarPoupanca">Adicionar a poupança</option>
        </select>
      </div>
      <div>
        <label for="valor">Valor:</label>
        <input type="text" name="Valor_transacao" id="valor" class="inputs"
          placeholder="Adicione o valor de sua transação." oninput="checarNumero(this)">
        <small id="valorHelp" class="form-text text-danger"></small>
        <small id="poupancaHelp" class="form-text text-danger"></small>
      </div>
      <div class="descricaoDiv">
        <label for="descricao">Descrição:</label> <br>
        <input type="text" name="Descricao_valor" id="descricao" class="inputs"
          placeholder="Qual a origem dessa transação?">
        <small id="descricaoHelp" class="form-text text-danger"></small>
      </div>
      <small id="confirmacaoHelp" style="text-align: center;" = "form-text"></small>
      <button onclick="adicionarTransacao()" class="button">Adicionar</button>
    </div>

    <div class="container-saldos division">
      <button onclick="esconderDinheiroTotal()" class="btnBlind">
        <img src="assets/Icones BootStrap/eye.svg" id="imgBlind" class="imgBlind" alt="" srcset="">
      </button>
      <div class="div-saldos">
        <h2>
          <img src="assets/Icones BootStrap/bank.svg" alt="Banco" width="30" height="25" />
          Saldo total:
        </h2>
        <h2 id="saldoTotal">0,00</h2>
      </div>
      <div class="div-saldos">
        <h2>
          <img src="assets/Icones BootStrap/wallet2.svg" alt="carteira" width="30" height="25" />
          Saldo na conta:
        </h2>
        <h2 id="saldoCaixa">0,00</h2>
      </div>
      <div class="div-saldos d-flex flex-column align-items-center">
        <h2>
          <img src="assets/Icones BootStrap/piggy-bank.svg" alt="porquinho" width="30" height="35" />
          Poupança:
        </h2>
        <h2 id="poupanca">  0,00</h2>
      </div>
    </div>
  </div>

  <div class="container-content">
    <div class="division">
      <div class="media2">
        <div class="historico-transações">
          <h2>
            <img src="assets/Icones BootStrap/clock-history.svg" alt="relogio" width="30" height="26" />
            Histórico de transações
          </h2>
          <ul class='media2-content' id="historico" width="10" height="10"></ul>
        </div>
      </div>
    </div>
    <div class="division">
      <div class="media2">
        <div class="graficoGastos">
          <h2>
            <img src="assets/Icones BootStrap/graph-up-arrow.svg" alt="grafico" width="30" height="26" />
            Gráfico das transações
          </h2>
          <div class="grafico">
            <canvas class='media2-content' id="graficoGastos"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
  <script src="script.js"></script>
</body>

</html>