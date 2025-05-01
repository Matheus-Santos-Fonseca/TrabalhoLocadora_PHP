<?php
$localhost="localhost";
$usuario="root";
$senha="Cefet123";//mudar para Cefet123, #Black7227,25022008
$banco="Banco";

$conexao=mysqli_connect($localhost,$usuario,$senha,$banco);

if(mysqli_error($conexao)==true)
{
    exit("nao houve conexao com o banco de dados".mysqli_connect_error());
}

$email = isset($_POST["email"]) ? $_POST["email"] : '';
$senha = isset($_POST["senha"]) ? $_POST["senha"] : '';


function PHPconsole($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Console: " . $output . "' );</script>";
} //Ignorem isso, mas eu gosto de usar isso para checar umas coisas
function Cooking_Erro($nome)
{
    setcookie($nome, 0, time()+1800);
}

function Cooking_Sucesso($nome)
{
    setcookie($nome, 1, time()+1800);
}

?>