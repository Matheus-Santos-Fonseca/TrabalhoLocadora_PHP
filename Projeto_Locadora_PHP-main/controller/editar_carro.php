<?php
include('conexao.php');

$modeloNew=$_POST['ChangeModelo'];
$statusNew=$_POST['ChangeStatus'];
$precoNew=$_POST['ChangePreco'];

$placa=$_POST['Change_id'];


$FotoNewTmp = $_FILES['ChangeFoto']['tmp_name'];

$FotoNew = file_get_contents($FotoNewTmp);

if($statusNew==1)
{
	$quantidadeNew=1;
}
else{$quantidadeNew=0;}


$updatar=$conexao->prepare("UPDATE Carro set modelo=?,status=?,quantidade=?,foto=?,preco=? where placa=?;");
$updatar->bind_param("siisds",$modeloNew,$statusNew,$quantidadeNew,$FotoNew,$precoNew,$placa);
$updatar->execute();

header("Location:../view/admin/tabela_carros.php");
?>