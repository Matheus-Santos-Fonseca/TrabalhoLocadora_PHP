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

$result=mysqli_query($conexao,"SELECT * from historico,Carro where placa=placa_dev;");

?>

<table>
<tr>

<th>Cpf:</th>
<th>Placa:</th>
<th>Data Inicio:</th>
<th>Data Fim:</th>
<th>Imagem</th>
<th>Preço pago:</th>

</tr>
<?php
if($result->num_rows>0)  {                                 
while($row=$result->fetch_assoc()){
?>
<tr>
<td><?php echo $row['cpf_dev'] ?></td>
<td><?php echo $row['placa'] ?></td>
<td><?php echo $row['datainicio'] ?></td>
<td><?php echo $row['datafim'] ?></td>
<td> <img src="<?php echo 'data:image/png;base64,'. base64_encode($row['foto']); ?>" style="width: 50%;height: auto;"></td>
<td><?php echo $row['preco'] ?></td>
</tr>
<?php
}
}#fim do if

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

    <form action="tabela_locacao.php">
        <button>Ir para a tabela de locações</button>
    </form>

</div>

</body>
</html>