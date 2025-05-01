<?php
    include_once('../conexao.php');
    date_default_timezone_set('America/Sao_Paulo');

    $placa_dev=$_POST['placa'];
    $cpf_dev=$_POST['cpf'];
    $dataInicio_dev=$_POST['dataInicio'];
    $dataFim_dev=date('Y-m-d', time());
    $preco=$_POST['precoF'];
    $multa=$_POST["Multas"];

    $preco = $preco + $multa;
    $insert = $conexao->prepare("INSERT into historico values(?,?,?,?,?);");
    $insert->bind_param('ssssd', $placa_dev,$cpf_dev,$dataInicio_dev,$dataFim_dev,$preco);
    $insert->execute();

    $update=$conexao->prepare("UPDATE Carro set status=1,quantidade=1 where placa=? ;");
    $update->bind_param('s', $placa_dev);
    $update->execute();

    $delete=$conexao->prepare('DELETE from locacao where placa_carro=? and cpf_cliente=?; ');
    $delete->bind_param("ss", $placa_dev,$cpf_dev);
    $delete->execute();

    header("Location:../../index.php");
?>