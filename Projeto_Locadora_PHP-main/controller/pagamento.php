<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            text-align: center;
            font-family: "roboto", sans-serif;
        }
        body{
            background-color: #ced4da;
            padding-top: 20%;
        }
        input{
            height: 2rem;
            border-radius: 5px;
            background-color: #212529;
            color: #e9ecef;
            border-radius: 8px;
        }
        input:hover{
            background-color: #e9ecef;
            color: #212529;
        }
    </style>
</head>
<body>
    <?php
        $nome_carro=$_POST["carro"] ?? "";
        $nome_cliente=$_POST["nome"];
        $km_percorrido=$_POST["km"];
        $imagem = $_POST["imagem"];
        $vetor_coisa= array(
            "Corola"=>array("KM"=>16.8, "custo"=>6.0),
            "Creta"=>array("KM"=>14.8, "custo"=>5.5),
            "T-cross"=>array("KM"=>14.0, "custo"=>5.7),
            "Tiggo"=>array("KM"=>11.5, "custo"=>3.9),
            "Versa"=>array("KM"=>12.7, "custo"=>4.8),
        );
        setcookie("nome", $nome_cliente, time() + (86400), "/"); // 86400 = 1 dia
        setcookie("carro", $nome_carro, time() + (86400), "/"); // 86400 = 1 dia
        setcookie("km", $km_percorrido, time() + (86400), "/"); // 86400 = 1 dia

        if(!empty($km_percorrido) and !empty($nome_cliente) and array_key_exists($nome_carro, $vetor_coisa))
        {
            function custo_por_km($x,$y)
            {
                return $x * $y;
            }
            function quantidade_de_litros_pagos($x)
            {
                return $x*4.89;
            }
            function Total_pagar($x,$y)
            {
                return $x+$y;
            }
            function litros_consumidos($x, $y){
                return $x/$y;
            }

        $custo_por_km=custo_por_km($vetor_coisa[$nome_carro]["custo"],$km_percorrido);
        $litros_consumidos = litros_consumidos($km_percorrido, $vetor_coisa[$nome_carro]["KM"]);
        $quantidade_de_litros=quantidade_de_litros_pagos($litros_consumidos);
        $total_pagar=Total_pagar($custo_por_km,$quantidade_de_litros);
        
            setcookie("quantidadedelitros", $quantidade_de_litros, time() + (86400), "/"); // 86400 = 1 dia
            setcookie("custoporkm", $custo_por_km, time() + (86400), "/"); // 86400 = 1 dia
            setcookie("totalpagar", $total_pagar, time() + (86400), "/"); // 86400 = 1 dia
            setcookie("imagem_selecionada", $imagem, time() + 86400, "/"); // 86400 = 1 dia
            setcookie("litros_gastos", $litros_consumidos, time() + 86400, "/"); // 86400 = 1 dia
            header("Location: resumo.php"); 
            exit();
        }
        else
        {
                setcookie("nome", '', -1, "/");
                setcookie("km", '', -1, "/");
                setcookie("carro", '', -1, "/");
            ?>
            
            <form action="devolucao.php" method="get">
                <h2>Ops! Você se esqueceu de escrever em algum de nossos campos, por favor clique no botão abaixo para voltar.</h2>
                <input type="submit" value="Voltar">
            </form>
            <?php
        }
    ?>
</body>
</html>