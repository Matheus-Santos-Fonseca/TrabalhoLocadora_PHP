<?php

include('conexao.php');

$modelo = isset($_POST["modelo"]) ? $_POST["modelo"] : '';
$placa = isset($_POST["placa"]) ? $_POST["placa"] : '';
$quantidade = isset($_POST["quantidade"]) ? $_POST["quantidade"] : '';
$status = isset($_POST["status"]) ? $_POST["status"] : '';
$data = isset($_POST["data"]) ? $_POST["data"] : '';
$preco=isset($_POST["preco"]) ? $_POST["preco"] : '';


$arquivoTmp = $_FILES['imagem']['tmp_name'];

$imagem = file_get_contents($arquivoTmp); // Lê o conteúdo do arquivo

?>
<img src="<?php echo 'data:image/png;base64,'.base64_encode($imagem) ;?>" >
<br><br><br>
<?php
	$insercao=$conexao->prepare("insert into Carro values (?,?,?,?,?,?,?);");
	$insercao->bind_param('sisissd', $modelo, $quantidade, $placa,$status,$data,$imagem,$preco);
	$insercao->execute();

	#Fazer um if aqui pra checar se nao deu erro no execute, agradeço
	mysqli_close($conexao);
	setcookie("SucessoCarro", 1, time()+1800);
	header("Location:../view/admin/cadastrocarro.php");
?>
