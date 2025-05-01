<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Carros</title>
	<link rel="stylesheet" href="../../css/tabelas.css">
</head>
<body>

<?php
    include('../../controller/conexao.php');

    $busca = mysqli_query($conexao, "SELECT * FROM Carro;");
?>

<div class="botoes-navegacao">
    <form action="cadastrocarro.php">
        <button>Voltar</button>
    </form>
    <form action="tabela_clientes.php">
        <button>Ir para a tabela de clientes</button>
    </form>
    <form action="tabela_locacao.php">
        <button>Ir para a tabela de carros</button>
    </form>
    <form action="tabela_historico.php">
        <button>Ir para o histórico de locações</button>
    </form>
</div>

<table>
    <tr>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Status</th>
        <th>Foto</th>
        <th>Preço/dia</th>
        <th>Editar</th>
        <th>Excluir</th>
    </tr>
    <?php
        if ($busca->num_rows > 0) {
            while ($row = $busca->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $row['placa']; ?></td>
        <td><?php echo $row['modelo']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
                <img src="<?php echo 'data:image/png;base64,' . base64_encode($row['foto']); ?>" alt="Foto do carro">
        </td>
        <td><?php echo $row['preco']; ?></td>
        <td>
            <button class="editar" onclick="showmodalUp('<?php echo $row['placa']; ?>')">Editar</button>
        </td>
        <td>
            <form action="../../controller/excluir_carro.php" method="post">
                <input type="hidden" name="deletar" value="<?php echo $row['placa']; ?>">
                <button class="apagar">Apagar</button>
            </form>
        </td>
    </tr>
    <?php
            }
        }
    ?>
</table>

<div id="modalUpdateCarro">

    <div class="modalcontent">
    	<span id="close" style="float:right;cursor:pointer;" onclick="Close()">x</span>

    	<form action="../../controller/editar_carro.php" method="post" enctype="multipart/form-data">

		<input type="text" id="Change_id"  name="Change_id" class="input"  placeholder="placa" readonly><br>

        <input type="text" name="ChangeModelo" class="input"   placeholder="modelo"><br>

        <input type="number" name="ChangeStatus" class="input"   placeholder="status"><br>

        <input type="number" name="ChangePreco" class="input"   placeholder="preço"><br>

        <label>imagem:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
		<input type="file" name="ChangeFoto"/>

        <br><br>

        <input type="submit"  value="" style="display: none;">
        <button>Mudar dados</button>
        </form>
	</div>
</div>

<script src="../../js/tabela_carros.js"></script>

</body>
</html>