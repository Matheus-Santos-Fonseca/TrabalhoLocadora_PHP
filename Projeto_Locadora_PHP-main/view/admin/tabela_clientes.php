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

	$busca=mysqli_query($conexao,"SELECT * from Cliente;");
?>
<table style="border-collapse: collapse;text-align: center;">
	<tr class="row">
		<th class="title">Cpf:</th>
		<th class="titlecell">Nome:</th>
		<th class="titlecell">Email:</th>
		<th class="titlecell">Telefone:</th>
	</tr>
<?php
	if($busca->num_rows>0)
	{
		while($row=$busca->fetch_assoc())
		{
?>
			<tr>
				<td><?php echo $row['cpf'];?></td>
				<td><?php echo $row['nome'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['telefone'];?></td>
			</tr>

<?php
}

}
?>
	<div class="botoes-navegacao">
		<form action="cadastrocarro.php">
			<button>Voltar</button>
		</form>
		<form action="tabela_historico.php">
			<button>Ir para o histórico de locações</button>
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