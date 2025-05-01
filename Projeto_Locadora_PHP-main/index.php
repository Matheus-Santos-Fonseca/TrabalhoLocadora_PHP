<?php 
    session_start(); 
    include('controller/conexao.php');

    $busca = $conexao->prepare("SELECT count(*) from Carro where status=1;");
    $busca->execute();
    $busca->bind_result($quantidade);

    #Cada pagina do catalogo com 6 carros
    while($busca->fetch())
    {
        $NumPaginas=$quantidade/6;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora</title>
    <!-- icons -->
    <script src="https://kit.fontawesome.com/87c9b871bb.js" crossorigin="anonymous"></script>
    <!-- css -->
    <link rel="stylesheet" href="css/index.css">
</head>

<body onload="ShowHideCards(1,<?php echo $quantidade ;?>,<?php echo $NumPaginas ;?> )" >

    <!-- Cabeçalho -->
    <header>
        <div class="conteudo">
            <nav>
                <!-- Título -->
                <p class="empresa">
                    Locadora <strong>CEFET</strong>
                    <img src="images/cefet.png" alt="CEFET">
                </p>

                <ul>  
                    <!-- Modal Usuário -->
                    <li>
                        <a onclick="modalclick_usuario()">Usuário</a>
                        <i class="fa-solid fa-user"></i>
                    </li>

                      <div class="modal-usuario">
                        <div class="modal-usuario-conteudo">
                            <span class="close" onclick="spanclick_usuario()">&times;</span>
                            <?php
                                if(!isset($_SESSION['cpf']))
                                {
                                    echo "usuario nao logado, sem dados";
                                }
                                else
                                {
                            ?>
                                    <h1>Informações do usuario</h1><br>

                                    <fieldset>
                                    <p> CPF: <?php echo $_SESSION["cpf"];?></p> <br>
                                    <p> Nome: <?php echo $_SESSION['nome'];?></p> <br>
                                    <p> Email: <?php echo $_SESSION['email'];?></p><br>
                                    <p> Telefone/Celular: <?php echo $_SESSION['telefone'];?></p>
                                    </fieldset><br>

                                    <form action="controller/usuario/sair.php" method='get'>
                                        <button>Sair</button>
                                    </form>
                            <?php
                                }
                            ?>
                        </div>
                      </div>

                    <!-- Modal Feedback -->
                    <li>
                        <a onclick="modalclick_feedback()" class="feedback">Feedback</a>
                        <i class="fa-solid fa-comment"></i>
                    </li>

                    <div class="modal-feedback">
                        <div class="modal-feedback-conteudo">

                            <form method="post" action="controller/email/feedback.php">
                                <span class="close" onclick="spanclick_feedback()">&times;</span>
                                <h1>Feedback: </h1>
                                <textarea name="feedText" rows="3" cols="40"></textarea>
                                <br>
                                <input type="submit"  value =" enviar">
                            </form>
                        </div>
                    </div>

                    <!-- Devolver Carros -->
                    <li>
                        <a onclick="modalclick_devolucao()" class="feedback">Carros Alugados</a>
                        <i class="fa-solid fa-car"></i>
                    </li>

                    <div class="modal-devolucao">
                        <div class="modal-devolucao-conteudo">
                            <span class="close" onclick="spanclick_devolucao()">&times;</span>
                            <h1>Carros Alugados:</h1>
                            <?php
                                if(!isset($_SESSION['cpf']) )
                                {
                                    echo "Usuário nao logado, sem possibilidade de devolução";
                                }
                                else
                                {
                                    $result=$conexao->prepare("SELECT cpf_cliente,placa_carro,modelo,datainicio,foto,preco from Carro,locacao where cpf_cliente = ? and placa_carro=placa ;");
                                    $result->bind_param('s', $_SESSION['cpf']);
                                    $result->execute();

                                    $result->bind_result($cpf_locacao,$placa_locacao,$modelo_locacao,$data_locacao,$imagemAlugada,$preco)
                            ?>    
                                <?php
                                    while($result->fetch())
                                        {
                                ?>
                                            <form action="view/devolucaoview.php" method="post" style="border: solid black 2px;">

                                                <img src="<?php echo'data:image/png;base64,'. base64_encode($imagemAlugada); ?>" style="width: 50%;height: auto;">
                                                <br>

                                                <label class="labelDevo">modelo:<?php echo $modelo_locacao; ?></label>
                                                <input style="display:none;" type="text"  value='<?php echo $modelo_locacao; ?>' name='modeloDevo' readonly>

                                                <br>
                                                <label class="labelDevo">placa:<?php echo $placa_locacao; ?></label>
                                                <input  type="text"  style="display:none;" value='<?php echo $placa_locacao; ?>' name='placa_dev' readonly>

                                                <br>
                                                <label class="labelDevo">cpf:<?php echo $cpf_locacao; ?></label>
                                                <input  type="text" style="display:none;" value ='<?php echo $cpf_locacao; ?>' name='cpf_dev' readonly>

                                                <br>
                                                <label class="labelDevo"> data:<?php echo $data_locacao; ?></label>
                                                <input type="text" style="display:none;" value ='<?php echo $data_locacao; ?>' name='dataI_dev'readonly>
                                                <br>
                                                <input  type="text"  style="display:none;" value ='<?php echo $preco; ?>' name='preco'readonly>
                                                <br>
                                                <button>Devolver</button><br><br>

                                            </form>
                                        <?php
                                            }
                                }
                                        ?>
                        </div>
                    </div>

                    <form action="view/login.php">
                        <button>Logar</button>
                    </form>
                </ul>
            </nav>

            <div class="header-bloco">
                <div class="text">
                    <h2>A melhor locadora de <br>Nova Iguaçu</h2>
                    <p>A mais <strong>procurada</strong> locadora de <strong>Nova Iguaçu</strong> está agora disponível para todo o <strong>Brasil</strong> e agora para <strong>VOCÊ</strong> também<strong>!</strong></p>
                </div>
                
                <img src="images/carro-header.png" alt="carro-header">
            </div>
        </div>
    </header>

    <!-- Catálogo -->
    <?php 
        include('view/catalogo.php');
    ?>

    <nav class="indice_catalogo" id="catalogo1">
        <ul style="text-align: center;">
    <?php
        for($i=0;$i<$NumPaginas;$i++)
        {
    ?>
            <li class="paginasIndice" id="pag<?php echo $i+1 ;?>" onclick="ShowHideCards(<?php echo $i+1 ;?>,<?php echo $quantidade ;?>, <?php echo $NumPaginas?>)"><?php echo $i+1 ;?></li>
    <?php
        }
    ?>   
        <li class="paginasIndice" style="border:none;">...</li>
        </ul>
    </nav>

    <nav class="indice_catalogo" id="catalogo2" style="display:none;"><ul id="cat2_box"></ul></nav>

<div class="modal-locacao">
    <div class="modal-locacao-conteudo">

     <form method="post" action="controller/usuario/alugar_carro.php">
        <span class="close" onclick="spanclick_locacao()">&times;</span>
        <h1>Deseja alugar? </h1><br>
        <label>Placa:</label><input id="AlugarVeiculo" type="text" value="" name="placaAlugar" readonly><br>
        <label>Inicio:</label><input type="date" name="inicio" min="<?php echo date('Y-m-d', time())?>">
        <br>
        <button>Confirmar</button>  
     </form>
    </div>
</div>

    <footer>
        <div class="main">
            <div class="conteudo-footer-links">
                <div class="footer-empresa">
                    <h4>Locadora CEFET</h4>
                    <h6>Sobre nós</h6>
                    <h6>Contato</h6>
                </div>
                <div class="footer-alugar">
                    <h4>Aluguel</h4>
                    <h6>Self-Drive</h6>
                    <h6>Ajuda</h6>
                </div>
                <div class="footer-social">
                    <h4>Continue conectado</h4>
                    <div class="icons-social">
                        <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-contato">
                    <h4>Nos contate</h4>
                    <h6>+55 </h6>
                    <h6></h6>
                    <h6></h6>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/index.js"></script>
</body>
</html>

