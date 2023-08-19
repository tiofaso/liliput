<?php session_start(); ?>
<html>
	<head>
		<title>lilliput - aplha</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/editor.css" type="text/css" media="screen" />
		<script src="js/mascaras-form.js"></script>
		<script type="text/javascript" src="js/ajax.js"></script>
	</head>
	
	<body>
	
<?php
//seleção de páginas do site

$sitedir = str_replace("index.php", "", $_SERVER['PHP_SELF']); //capturando sessão do permalink

if (isset($_GET['pagina'])){ //capturando sessão do permalink
	$sessao = $_GET['pagina'];
}else{
	$sessao =  str_replace($sitedir, "", $_SERVER['REQUEST_URI']); //capturando sessão do permalink
} //endif 

$siteuri = $sessao; //armazenando a uri do site, para resolver problemas de pastas e subdomínios)

//início - essa parte do código serve para usar o editor que usa a URL para se atualizar
// ao mesmo tempo mantém a estrutura de links do restante do site
// pois sem essa parte, qualquer link clicado no editor cai na home
$editor = explode("?",$sessao);

//if($editor[0] == "editor"){
	//$sessao = "editor";
	//$_SESSION["dadoseditor"] = $editor[1];
//}
//fim

$sessao = "?pagina=" . $sessao;

switch ($sessao){
	/*case 'cadastro':
		echo "<h1>Cadastro</h1>";		
		include("/menu-temp.php");
		include("/apps/cadastro-cliente.php");
		break;

	case 'cadastroproduto':
		echo "<h1>Cadastro Produto</h1>";		
		include("/menu-temp.php");
		include("/apps/cadastro-produto.php");
		break;		
		
	case 'perfil':
		echo "<h1>Perfil</h1>";		
		include("/menu-temp.php");
		include("/apps/perfil-cliente.php");
		break;	*/

	case '?pagina=editor':
		//echo "<h1>Editor</h1>";		
		//include("/menu-temp.php");
		include("apps/editor.php");
		break;	

	/*case 'loja':
		echo "<h1>Loja</h1>";		
		include("/menu-temp.php");
		include("/apps/loja.php");
		break;
		
	case 'editor-tecidoteca':
		echo "<h1>Tecidoteca</h1>";		
		include("/menu-temp.php");
		include("/apps/editor-tecidoteca.php");
		break;		

	default:
		echo "<h1>Home</h1>";		
		include("/menu-temp.php");*/
	
}
?>	

	</body>
</html>

