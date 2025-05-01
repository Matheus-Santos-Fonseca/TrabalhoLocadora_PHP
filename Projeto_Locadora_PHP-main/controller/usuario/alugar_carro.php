<?php
    session_start();

    #adicionar isset aki pfvr
    include_once("../conexao.php");

    $placa_alug=$_POST["placaAlugar"];
    $cpf_alug=$_SESSION['cpf'];
    $dataInicio=$_POST["inicio"];

    $inserir=$conexao->prepare("INSERT into locacao values (?,?,?);"); 
    $inserir->bind_param("sss",$cpf_alug,$placa_alug, $dataInicio);
    $inserir->execute();

    #pega a quantidade de carros do modelo disponivel
    $updateSearch=$conexao->prepare("select quantidade from Carro where placa=?;");
    $updateSearch->bind_param("s", $placa_alug);
    $updateSearch->execute();

    $updateSearch->bind_result($QuantCarroDisponivel);

    while($updateSearch->fetch())
    {
    #agradeceria se nao mudassem a parte de baixo
    #Reduz a variavel usada no update da quantidade
        $QuantCarroDisponivel=$QuantCarroDisponivel- 1;
    }

    #reduz quantidade
    $updateReduceQuant=$conexao->prepare("update Carro set quantidade=? where placa=? ;");
    $updateReduceQuant->bind_param("is", $QuantCarroDisponivel,$placa_alug);
    $updateReduceQuant->execute();

    header("Location:../../index.php");
?>