
<?php 
if (!isset($_POST["cadastroproduto"])){ //primeira visita do usuário
	include("formularios/form-cadastro-produtoestatico.php"); //formulário de cadastro
}else{

include("/funcoes/diversas.php"); //gera o número de registro

$dirupload = "produtos-img/estaticos"; //diretório aonde serão armazenadas as imagens
	
$numreg = numreg();
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$prontaentrega = $_POST['prontaentrega'];
$loja = $_POST['loja'];

$imagem01 = uploadimg($dirupload,$_FILES["imagem01"]);

redimimg($dirupload . "/"  . $imagem01, "teste", 240, "produtos-img/estaticos_tb/" , strtoupper($_FILES["imagem01"]["type"]) );
$imagem02 = uploadimg($dirupload,$_FILES["imagem02"]);
$imagem03 = uploadimg($dirupload,$_FILES["imagem03"]);
$imagem04 = uploadimg($dirupload,$_FILES["imagem04"]);
$imagem05 = uploadimg($dirupload,$_FILES["imagem05"]);


//$imgthumb = redimimg($arquivo, $novonome, 240, $diretorio . "_tb", strtoupper($arquivo["type"]) );
/*$imagem01 = explode("#",$imagem01);
$imagem02 = explode("#",$imagem02);
$imagem03 = explode("#",$imagem03);
$imagem04 = explode("#",$imagem04);
$imagem05 = explode("#",$imagem05);*/

echo "<br/><br/>" . $numreg . "<br/>";
echo $nome . "<br/>";
echo $descricao . "<br/>";
echo $preco . "<br/>";
echo $prontaentrega . "<br/>";
echo $loja . "<br/>";

/*echo $imagem01[0] . "<br/>";
echo $imagem01[1] . "<br/>";

echo $imagem02[0] . "<br/>";
echo $imagem02[1] . "<br/>";

echo $imagem03[0] . "<br/>";
echo $imagem03[1] . "<br/>";

echo $imagem04[0] . "<br/>";
echo $imagem04[1] . "<br/>";

echo $imagem05[0] . "<br/>";
echo $imagem05[1] . "<br/>";*/
		
} //endif
?>