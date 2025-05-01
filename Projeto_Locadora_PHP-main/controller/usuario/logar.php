<?php
    session_start();
    include_once("../conexao.php");
    $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : '';

    //Busca a senha e os dados para variavel de sessão no banco no banco
    $resultado=$conexao->prepare("SELECT senha,cpf,nome,email,telefone FROM Cliente WHERE cpf=? and email=? ;");
    $resultado->bind_param("ss", $cpf,$email);                                                                 
    $resultado->execute();

    $resultado->bind_result($senha_hash,$cpf_bd,$nome_bd,$email_bd,$telefone_bd);  #Armazena a senha buscada em $senha_hash

    while($resultado->fetch())
    {
        // Aqui manda a pessoa para pagina do admin
        if ($senha=="admin12345" and $cpf_bd=="000.000.000-00" and $email_bd=="admin@gmail.com" ) //CPF e Email do admin, sim nao tenho criatividade
        {
            $conexao->close();
            header("Location:../../view/admin/cadastrocarro.php");
            exit();
        }

        #aqui verifica a senha das outras pessoas
        if (!password_verify($senha,$senha_hash)) #Verifica a senha
        {
            header("Location: ../../view/login.php");
            setcookie("ErroSenha",1,time()+1800);
            $conexao->close();
            echo "senha errada";
            exit();
        }

        #Se a senha tiver certa, guarda os dados em variaveis de sessão, serio que voces nao tinham feito isso ainda? skill issue
        $_SESSION['cpf']=$cpf_bd;
        $_SESSION['nome']=$nome_bd;
        $_SESSION['email']=$email_bd;
        $_SESSION['telefone']=$telefone_bd;
        $conexao->close();

        echo "foi acho";
        header("Location: ../../index.php");
        exit();
    }

    echo "Volte, tu nao existe";
    $conexao->close();
    header("Location: ../../view/login.php");
?>
