<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    include_once('../controller/conexao.php');
    $cpfDevo=$_POST['cpf_dev'];
    $placaDevo=$_POST['placa_dev'];
    $dataIni=$_POST['dataI_dev'];
    $dataFim=date('Y-m-d', time());
    $preco=$_POST['preco'];

    $d1=date_create($dataIni);
    $d2=date_create($dataFim);
    $dataDiff=date_diff($d1,$d2);
   
    $Dias=$dataDiff->d;

    $precoF=$preco*(float)$Dias;
    ?>
        <form id="form_id" action="../controller/usuario/devolucao.php" method="post">
        <label>Preço de aluguel:</label><input type="text" name='Preco' value='<?php echo $precoF;?>' readonly>
        <label>Preço em multas:</label> <input type="number" name='Multas'>

        <input style='display:none;' type="text" name='cpf' value='<?php echo $cpfDevo;?>' readonly>
        <input style='display:none;' type="text" name='placa' value='<?php echo $placaDevo;?>' readonly>
        <input style='display:none;' type="text" name='dataInicio' value='<?php echo $dataIni;?>' readonly>
        <input style='display:none;' type="number" name='precoF' value='<?php echo $precoF;?>' readonly>


        <input type="submit" value='devolver'>

        </form>
      
</body>
</html>