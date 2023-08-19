<h2>Cadastro Tecidoteca</h2>
<?php 
if (!isset($_POST["cadastrotecidoteca"])){ //primeira visita do usuário
	include("formularios/form-cadastro-tecidoteca.php"); //formulário de cadastro
}else{

include("/funcoes/diversas.php"); //gera o número de registro

$numreg = numreg();
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$tipo = $_POST['tipo'];
$tags = $_POST['tags'];
$corhexa1 = $_POST['corhexa1'];
$corhexa2 = $_POST['corhexa2'];
$corhexa3 = $_POST['corhexa3'];
$corhexa4 = $_POST['corhexa4'];

if ($tipo == 'bordado'){
	$local = "bordados";
}
else{
	$local = "tecidos";
} //endif

$dirupload = "tecidoteca/" . $local; //diretório aonde serão armazenadas as imagens

$extensoes = array(
				"IMAGE/GIF" => ".gif",
				"IMAGE/JPG" => ".jpg",
				"IMAGE/JPEG" => ".jpg",
				"IMAGE/PJPEG" => ".jpg",
				"IMAGE/PNG" => ".png", 
				"IMAGE/X-PNG" => ".png"	
	);

$imagem = uploadimg($dirupload,$_FILES["imagem"]);

$imagemoriginal = $dirupload . "/" . $imagem . $extensoes[strtoupper($_FILES["imagem"]["type"])];

redimimg($imagemoriginal, $imagem . "_tb", 75, $dirupload . "_tb/" , strtoupper($_FILES["imagem"]["type"]) );
/*
echo "<br/><br/>" . $numreg . "<br/>";
echo $nome . "<br/>";
echo $descricao . "<br/>";
echo $tipo  . "<br/>";
echo $tags  . "<br/>";
echo $corhexa1  . "<br/>";
echo $corhexa2  . "<br/>";
echo $corhexa3  . "<br/>";
echo $corhexa4  . "<br/>";
echo $local  . "<br/>";
*/
$img = $imagem . $extensoes[strtoupper($_FILES["imagem"]["type"])];
$imgtb = $imagem . "_tb". $extensoes[strtoupper($_FILES["imagem"]["type"])] ;
/*
echo $img . "<br/>";
echo $imgtb . "<br/>";

echo "<img src=" . $dirupload . "/" . $imagem . $extensoes[strtoupper($_FILES["imagem"]["type"])] . ">" . "<br/>" ;
echo "<img src=" . $dirupload . "_tb/" . $imagem . "_tb". $extensoes[strtoupper($_FILES["imagem"]["type"])] . ">" . "<br/>" ;
*/
//include("/funcoes/basededados.php"); //funções para manipulação de dados

conexaodb(); //acessando a base de dados

criartecidoteca($numreg,$nome,$descricao,$img,$imgtb,$tipo,$tags,$corhexa1,$corhexa2,$corhexa3,$corhexa4,$local);

include("formularios/form-cadastro-tecidoteca.php"); //formulário de cadastro
		
} //endif
?>