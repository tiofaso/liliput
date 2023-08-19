<div id="colesq">
<?php 
$_SESSION['arquivo'] = $_GET['pg']; //armazenando qual página está exibindo o conteúdo

if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
	include("../" . APP_PATH . "/editor-mini-mi/editar-armario.php");
}else{
	include("../" . APP_PATH . "/editor-mini-mi/listar-armario.php");
}//endif
?>
</div>
<div id="coldir">
<?php
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
	include("../" . APP_PATH . "/editor-mini-mi/simulador-armario.php");
}else{
	include("../" . APP_PATH . "/editor-mini-mi/cadastro-armario.php");
}//endif
?>
</div>