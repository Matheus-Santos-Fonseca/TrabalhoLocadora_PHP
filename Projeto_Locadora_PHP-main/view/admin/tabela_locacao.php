<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
        <link rel="stylesheet" href="../../css/tabelas.css">

</head>
<body>

<?php
    include('../../controller/conexao.php');

    $result=$conexao->prepare("SELECT cpf_cliente,placa_carro,modelo,datainicio,foto,preco from Carro,locacao where placa_carro=placa ;");
    $result->execute();
    $result->bind_result($cpf,$placa,$modelo,$data,$imagem,$preco)
?>

<table>
    <tr>

        <th>Cpf:</th>
        <th>Placa:</th>
        <th>Modelo:</th>
        <th>Preço:</th>
        <th>Imagem</th>
        <th>Data:</th>

    </tr>
<?php                              
    while($result->fetch())
    {
?>
        <tr>
            <td><?php echo $cpf; ?></td>
            <td><?php echo $placa; ?></td>
            <td><?php echo $modelo; ?></td>
            <td><?php echo $preco; ?></td>
            <td> <img src="<?php echo'data:image/png;base64,'. base64_encode($imagem); ?>" style="width: 50%;height: auto;"></td>
            <td><?php echo $data; ?></td>
        </tr>
<?php
    }
?>
</table>


<div class="botoes-navegacao">
    <form action="cadastrocarro.php">
        <button>Voltar</button>
    </form>
    <form action="tabela_clientes.php">
        <button>Ir para a tabela de clientes</button>
    </form>
    <form action="tabela_carros.php">
        <button>Ir para a tabela de carros</button>
    </form>
    <form action="tabela_historico.php">
        <button>Ir para o histórico de locações</button>
    </form>
</div>

</body>
</html>