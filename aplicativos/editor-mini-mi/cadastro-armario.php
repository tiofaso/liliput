<h2>Cadastro Arm&aacute;rio</h2>

<?php
 
$_SESSION['arquivo'] = $_GET['pg']; //armazenando qual página está exibindo o conteúdo
//$_SESSION['totalregistros']

if(isset($_POST['precadastrar'])){

//$_SESSION['situacao'] = NULL;
//unset($_SESSION['situacao']);


	$_SESSION['nomeroupa'] = $_POST['nome'];
	$_SESSION['descricaoroupa'] = $_POST['descricao'];
	$_SESSION['sexo'] = $_POST['sexo'];
	$_SESSION['precoroupa'] = $_POST['preco'];
	$_SESSION['tiporoupa'] = $_POST['tipo'];
	$_SESSION['combo'] = $_POST['combo'];
	$_SESSION['estado'] = $_POST['estado'];

	$sessaocookie = "ativo" . "#" . $_SESSION['nomeroupa'] . "#" . $_SESSION['descricaoroupa'] ."#" .	$_SESSION['precoroupa'] . "#" .	$_SESSION['tiporoupa'] . "#" . $_SESSION['sexo'] . "#" . $_SESSION['combo'] . "#" . $_SESSION['estado'];
	
	setcookie("situacao",$sessaocookie);

//	unset($_SESSION['situacao']);
//	setcookie("tecidos");
//else{ $_SESSION['situacao'] = "descricao";} //primeira visita do usuário
}
elseif(isset($_COOKIE['situacao'])){
	$sessaocookie = explode("#",$_COOKIE['situacao']);
	$_SESSION['nomeroupa'] = $sessaocookie[1];
	$_SESSION['descricaoroupa'] = $sessaocookie[2];
	$_SESSION['precoroupa'] = $sessaocookie[3];
	$_SESSION['tiporoupa'] = $sessaocookie[4];
	$_SESSION['sexo'] = $sessaocookie[5];
	$_SESSION['combo'] = $sessaocookie[6];
	$_SESSION['estado'] = $sessaocookie[7];
	}

include("../" . APP_PATH . "editor-mini-mi/form-cadastro-armario.php"); //formulário de cadastro	

if(isset($_POST['cadastrar'])){ //adicionando as informações na base e subindo imagens
	
	$diruploadimg =  "../" . IMG_PATH . "editor-mini-mi-img/" . $_SESSION['tiporoupa']; //diretório aonde serão armazenadas as imagens

	$diruploadcb = "../" . IMG_PATH . "editor-mini-mi-img/" . $_SESSION['tiporoupa'] . "_cb"; //diretório aonde serão armazenadas as imagens dos cabides

$extensoes = array(
				"IMAGE/GIF" => ".gif",
				"IMAGE/JPG" => ".jpg",
				"IMAGE/JPEG" => ".jpg",
				"IMAGE/PJPEG" => ".jpg",
				"IMAGE/PNG" => ".png", 
				"IMAGE/X-PNG" => ".png"	
	);

$imagem = uploadimg($diruploadimg,$_FILES["imagemprincipal"]);
if($_SESSION['tiporoupa'] != 'manequim'){$imagemcb = uploadimg($diruploadcb,$_FILES["imagemcabide"]);}
else{$imagemcb = "";}

$_SESSION['imagemprincipal'] = $imagem;
$_SESSION['imagemcabide'] = $imagemcb;

$numreg = numreg(); //número de registro único

$estado = criararmario($numreg,$_SESSION['nomeroupa'],$_SESSION['descricaoroupa'],str_replace(",",".",$_SESSION['precoroupa']),$_SESSION['tiporoupa'],$_COOKIE['tecidos'],"0","0,0",$_SESSION['imagemprincipal'],$_SESSION['imagemcabide'],$_SESSION['sexo'],$_SESSION['combo'],$_SESSION['estado']); //gravando dados na base


if($estado == 1){//gravou na base
	//eliminando cookies e sessões
	setcookie("tecidos", "", time()-3600);
	setcookie("situacao", "", time()-3600);

	$_SESSION['nomeroupa'] = NULL;
	unset($_SESSION['nomeroupa']);

	$_SESSION['descricaoroupa'] = NULL;
	unset($_SESSION['descricaoroupa']);

	$_SESSION['precoroupa'] = NULL;
	unset($_SESSION['precoroupa']);

	$_SESSION['tiporoupa'] = NULL;
	unset($_SESSION['tiporoupa']);

	$_SESSION['imagemprincipal'] = NULL;
	unset($_SESSION['imagemprincipal']);

	$_SESSION['imagemcabide'] = NULL;
	unset($_SESSION['imagemcabide']);
	
	$_SESSION['sexo'] = NULL;
	unset($_SESSION['sexo']);
	
	$_SESSION['combo'] = NULL;
	unset($_SESSION['combo']);
	
	$_SESSION['estado'] = NULL;
	unset($_SESSION['estado']);

echo "<script language=\"javascript\">\n" .
"window.location=\"?pg=admin\";\n" .
"</script>";

}//end if


}
/*echo "@" . $_SESSION['nomeroupa'] . "<br/>";
echo "@" . $_SESSION['descricaoroupa'] . "<br/>";
echo "@" . $_SESSION['precoroupa'] . "<br/>";
echo "@" . $_SESSION['tiporoupa'] . "<br/>";
echo "@img" . $_SESSION['imagemprincipal'] . "<br/>";
echo "@img_cb" . $_SESSION['imagemcabide'] . "<br/>";
echo "@" . $_COOKIE['tecidos'];*/
?>