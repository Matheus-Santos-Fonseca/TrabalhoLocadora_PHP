<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Carros</title>
	<link rel="stylesheet" href="../../css/cadastrocarro.css">
</head>
<body>
    <!-- Título -->
    <div class="titulo">
        <h1>Cadastro de Carros</h1>
    </div>

    <!-- Container de formulário -->
    <div class="container">
        <form action="../../controller/registrar_carros.php" method="post" enctype="multipart/form-data">
            <div>
                <label>Modelo:</label>
                <input type="text" name="modelo">
            </div>
            <div>
                <label>Placa:</label>
                <input type="text" name="placa">
            </div>
            <div style="display:none;">
                <label>Quantidade de carros:</label>
                <input type="number" name="quantidade" max="1" min="0" value="1" readonly>
            </div>
            <div>
                <label>Preço do carro por dia:</label>
                <input type="number" name="preco" min="1">
            </div>
            <div style="display:none;">
                <label>Status:</label>
                <input type="text" name="status" value="1">
            </div>
            <div>
                <label>Data de aquisição:</label>
                <input type="date" min="<?php echo date('Y-m-d', time()); ?>" max="2030-12-31" name="data">
            </div>
            <div>
                <label>Imagem:</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                <input type="file" name="imagem"/>
            </div>
            <button>Cadastrar Carro</button>
        </form>

        <!-- Botões de navegação -->
        <div class="botoes-navegacao">
            <form action="tabela_clientes.php">
                <button>Ir para a tabela de clientes</button>
            </form>
            <form action="tabela_carros.php">
                <button>Ir para a tabela de carros</button>
            </form>
            <form action="tabela_locacao.php">
                <button>Ir para a tabela de locações</button>
            </form>
            <form action="tabela_historico.php">
                <button>Ir para o histórico de historico</button>
            </form>
          
        </div>
    </div>
</body>
</html>
