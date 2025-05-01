 <section class="catologo" id="catalogo">
        <div class="conteudo">
            <!-- Texto do Catalogo -->
            <div class="titulo-catalogo">
                <p>Encontre o que <strong>você deseja</strong> em nosso</p>
                <h2>Catálogo</h2>
            </div>
            <?php
    $buscar = $conexao->prepare("SELECT count(*) from Carro where status=1;");
    $buscar->execute();
    $buscar->bind_result($limite);
    while($buscar->fetch()){
    ?>
            <!-- Pesquisa do Catálogo -->
            <div class="card-filtro">

                <input type="text" class="pesquisa" id="buscaInput" placeholder="Escolha o seu carro" >
                <button class="botao-pesquisa" onclick="Pesquisar(<?php echo $limite;?>)">Pesquisar</button>
            </div>

            <!-- Container dos carros -->
            <div class="card-container">
                <!-- Carro -->
               
<?php #Aqui começa a parte de puxar as coisas do banco, favor não tirar o fetch_assoc caso mudar para procedural
}
$x=0;
$result=$conexao->query("SELECT * from Carro where status=1;");

if($result->num_rows>0){

while($row=$result->fetch_assoc())
{
$x+=1;
    ?>

    <div class="card-item" style="display: flex;" id="Card<?php echo$x;?>">
    <img class="card_image" src="<?php echo'data:image/png;base64,'. base64_encode($row['foto']); ?>" >
        <div class="card-conteudo">
        <h3 id="modelo<?php echo$x;?>" ><?php echo $row['modelo']?></h3>
        <p id="placa<?php echo$x;?>">placa:<?php echo $row['placa']?></p>
        <p id="placa<?php echo$x;?>">R$<?php echo $row['preco']?></p>
        <p>ano:<?php echo $row['data_aquisicao']?></p>
        
        <button onclick="modalclick_locacao('<?php echo $row['placa']; ?>')" >  Alugar!</button>
        
        </div>
    </div>
<?php
   
}}

?>
            



            </div>
        </div>
    </section>