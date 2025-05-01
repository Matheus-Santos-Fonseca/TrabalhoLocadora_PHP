<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="../css/recuperar.css">
</head>
<body>
    <div class="container">
        <h2>Recuperar Senha</h2><br>
        <form action="<?= $_SERVER['PHP_SELF']?>" method="post">
            <h2>Insira o Token:</h2>

            <!-- Código de 6 dígitos -->
            <div class="token">
                <input type="text" name="token1" maxlength="1" oninput="moveNext(this, 'token2', null)" id="token1" required>
                <input type="text" name="token2" maxlength="1" oninput="moveNext(this, 'token3', 'token1')" id="token2" required>
                <input type="text" name="token3" maxlength="1" oninput="moveNext(this, 'token4', 'token2')" id="token3" required>
                <input type="text" name="token4" maxlength="1" oninput="moveNext(this, 'token5', 'token3')" id="token4" required>
                <input type="text" name="token5" maxlength="1" oninput="moveNext(this, 'token6', 'token4')" id="token5" required>
                <input type="text" name="token6" maxlength="1" oninput="moveNext(this, null, 'token5')" id="token6" required>
            </div>

            <br>
            <h2>Insira sua senha:</h2>
            <input type="password" name="senha" pattern=".{8,}" required>
            <br>
            <h2>Confirme a senha:</h2>
            <input type="password" name="confirmasenha" pattern=".{8,}" required>

            

            <button>Mudar Senha</button>
        </form>
    </div>
    <?php
        if(count($_POST) > 0){
            include('../controller/conexao.php');
            $token = $_POST['token1'].$_POST['token2'].$_POST['token3'].$_POST['token4'].$_POST['token5'].$_POST['token6'];
            $senha = $_POST['senha'];
            $confirmasenha = $_POST['confirmasenha'];

            if($senha!=$confirmasenha)
            {
                echo "Senha errada";
                //header("Location:recuperar.php");
            }
            
            $update="update Cliente SET senha= '".password_hash($senha,PASSWORD_DEFAULT)."' where email=? ;";

            if($_COOKIE['token']==$token){
                $updatepassword=mysqli_prepare($conexao, $update);
                mysqli_stmt_bind_param($updatepassword, 's', $_COOKIE['email_recuperacao']);
                mysqli_stmt_execute($updatepassword);
                setcookie("SenhaAtualizada",1,time()+1800);
                header("Location:login.php");
               
            }

            mysqli_close($conexao);
        }
    ?>
    <script src="../js/recuperarsenha.js"></script>

</body>
</html>
