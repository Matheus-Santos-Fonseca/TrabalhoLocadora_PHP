<?php

    include_once("../conexao.php");

    $cpf=isset($_POST["cpf"]) ? $_POST["cpf"] : '' ;
    $nome=isset($_POST["nome"]) ? $_POST["nome"] : '' ;
    $telefone=isset($_POST["telefone"]) ? $_POST["telefone"] : '' ;

    $ConferirEmail=mysqli_prepare($conexao,"select cpf from Cliente where email=?");
    mysqli_stmt_bind_param($ConferirEmail,"s",$email);
    mysqli_stmt_execute($ConferirEmail);
    mysqli_stmt_store_result($ConferirEmail);

 if (mysqli_stmt_num_rows($ConferirEmail)>=1)
    {
       setcookie("ConfirmarRegistro", 0, time()+3, "/");
       header("location:../view/login.php");#Se ter um email igual, manda de volta, pois o email deve ser unico
       exit();
    }  

    $insercao_dos_dados=mysqli_prepare($conexao,"insert into Cliente(cpf,nome,senha,email,telefone) values (?,?,?,?,?);");
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $dados=mysqli_stmt_bind_param($insercao_dos_dados,"sssss",$cpf,$nome,$senha_hash,$email,$telefone);
    #insere os dados de registro no banco

    if(!mysqli_stmt_execute($insercao_dos_dados))#erro na inserção
    {
        print "nao houve insercao de dados na tabela".mysqli_errno($conexao);
    }

    setcookie("ConfirmarRegistro", 1, time()+1800, "/");#confirma inserção, favor, fazer uma coisa para checar este cookie no login e dar um aviso de registro bem sucessido
    PHPconsole("inserção de dados bem sucessido");

    mysqli_close($conexao); #fechem a conexao antes do header, se nao, nao fecha
    echo "TESTE";
    header("location:../../view/login.php");
    //C:\xampp\htdocs\Locadora-CEFET\view\login.php
?>