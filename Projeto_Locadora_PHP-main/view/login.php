<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>
    <!-- icons -->
    <script src="https://kit.fontawesome.com/87c9b871bb.js" crossorigin="anonymous"></script>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="../css/login.css">
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        setcookie("ConfirmarRegistro", 0, time()+1800, "/");
    ?>
    <br><br><br><br><h1>Locadora de Carros</h1><br><br>

    <!-- container -->
    <div class="container" id="container">

        <!-- container para registro -->
        <div class="form-container sign-up-container">
            <form action="../controller/usuario/registrar.php"  method="post">
                <h1>Registrar-se</h1>
                <br>

                <input type="text" name="nome" placeholder="Nome Completo" />
                <input type="text" name="cpf" placeholder="CPF: 123.456.789-00" pattern="(\d{3}\.?\d{3}\.?\d{3}-?\d{2})">
                <input type="email" name="email" placeholder="E-mail" />
                <input type="text" name="telefone" placeholder="Telefone" />
                <input type="password" name="senha" placeholder="Senha" pattern=".{8,}"/>
                <br>
                <?php 
                        if(isset($_COOKIE["ConfirmarRegistro"]) && $_COOKIE["ConfirmarRegistro"] == 0)
                        {
                            ?> <span id="id">Email já Registrado!</span> <?php
                        }

                    ?>
                <button onclick="fecharMensagem()">Registrar</button>
            </form>
        </div>

        <!-- container para login -->
        <div class="form-container sign-in-container">
            <form action="../controller/usuario/logar.php" method="post">
                <h1>Logar</h1><br>

                <input type="email" name="email" placeholder="E-mail" />
                <input type="text" name="cpf" placeholder="CPF: 123.456.789-00" pattern="(\d{3}\.?\d{3}\.?\d{3}-?\d{2})" />
                <input type="password" name="senha" placeholder="Senha" required="required" pattern=".{8,}" title="Eight or more characters" />
                
                <a class="password-forgot" onclick="modalclick_senha()">Esqueceu sua senha?</a>
                <button>Logar</button>
               
            </form>
        </div>

        <!-- container de overlay -->
        <div class="overlay-container">
            <div class="overlay">
                
                <!-- Esquerda -->
                <div class="overlay-panel overlay-left">
                    <h1 style="color: #343a40;">Bem vindo de volta!</h1>
                    <p style="color: #343a40;">Para se manter conectado coloque suas informações</p>
                    <button class="black" id="signIn">Logar</button>
                </div>

                <!-- Direita -->
                <div class="overlay-panel overlay-right">
                    <h1>Olá, amigo!</h1>
                    <p>Entre com suas informações e se junte a nós</p>
                    <button class="white" id="signUp">Registrar</button>
                </div>
            </div>
        </div>

        <!-- modal de senha -->
        <form action="../controller/email/email.php" method="post">
            <div class="modal-senha">
                <div class="modal-senha-conteudo">
                    <form action="../controller/email.php" method="post">
                    <span class="close" onclick="spanclick_senha()">&times;</span>
                    <h1>Insira seu Email:</h1>

                    <input type="text" name="cpf" placeholder="CPF: 123.456.789-00" pattern="(\d{3}\.?\d{3}\.?\d{3}-?\d{2})">
                    <input type="email" name="email" placeholder="E-mail">
                    <br>
                    <input type="submit" value="enviar">
                    </form>
                </div>
            </div>
        </form>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>