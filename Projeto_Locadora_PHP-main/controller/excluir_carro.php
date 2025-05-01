<?php
include('conexao.php');
$LinhaDeletada=$_POST['deletar'];
PHPConsole($LinhaDeletada);
$deletar=$conexao->prepare("DELETE from Carro where placa=? ;");
$deletar->bind_param('s', $LinhaDeletada);
$deletar->execute();
	
header("Location:../view/admin/tabela_carros.php");
?>