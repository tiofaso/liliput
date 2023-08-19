<div id="colesq">
<?php
$_SESSION['arquivo'] = $_GET['pg']; //armazenando qual página está exibindo o conteúdo

lista_tecidoteca('link'); 
?>
</div>
<div id="coldir">
<?php include("aplicativos/cadastro-tecidoteca.php");?>
</div>