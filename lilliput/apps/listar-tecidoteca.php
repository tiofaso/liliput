<h2></h2>
<div id="menu">
<ul>
<li><a href="<?php echo $sessao; ?>&tipo=algodao">algod&atilde;o</a></li>
<li><a href="<?php echo $sessao; ?>&tipo=brim">brim</a></li>
<li><a href="<?php echo $sessao; ?>&tipo=feltro">feltro</a></li>
<li><a href="<?php echo $sessao; ?>&tipo=jeans">jeans</a></li>
<li><a href="<?php echo $sessao; ?>&tipo=malha">malha</a></li>
<li><a href="<?php echo $sessao; ?>&tipo=moleton">moleton</a></li>
<li><a href="<?php echo $sessao; ?>&tipo=bordado">bordado</a></li>
</ul>
</div>

	
<?php

if(!isset($_GET['tipo'])){ $busca = "tipo='algodao'";}
else{ $busca= "tipo=" . "'" . $_GET['tipo'] . "'"; }

//iniciando a paginação dos dados
if(!isset($_GET['pg'])){
	$paginaatual = 1;
}
else{
	$paginaatual = $_GET['pg'];	
} //endif


$intensporpagina = 12;	

$inicio = ($paginaatual*$intensporpagina) - $intensporpagina;


$limites = " LIMIT " . $inicio . "," .$intensporpagina; //limites para exibição de itens na página

//include("/funcoes/basededados.php"); //funções para manipulação de dados

conexaodb(); //acessando a base de dados

exibirtecidoteca($busca,$limites); //apenas para verificar a quantidade de registros para pagina

$paginacao = ceil($_SESSION['totalregistros']/$intensporpagina);

$maxlinks = 3; //número máximo de links para paginação


$cont = 1;

echo "<div id=paginacao><ul>";

while($cont <= $paginacao){
	echo "<li>" . "<a href=" . $sessao . "&" . str_replace("'","",$busca) . "&pg=" . $cont . ">" . $cont . "</a></li>";	
	$cont++;
} //endwhile

echo "</ul></div>";

?>