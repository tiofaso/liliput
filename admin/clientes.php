<h2>Cadastro de Clientes</h2>
<?php

if(!isset($_GET['usr'])){ 
	echo "<div id=\"colesq\"  style=\"width:33%;margin-right:20px;\">\n";
		echo "<p>Escolha na lista ao lado os clientes que voc&ecirc; quer visualizar</p>";
	echo "</div>";
 	
	echo "<div id=\"coldir\" style=\"float:left;width:auto;\">\n";
		listacliente();
	echo "</div>";
}
else{ 
	echo "<div id=\"colesq\"  style=\"width:33%;margin-right:20px;\">\n"; 
 		mostraperfilcliente($_GET['usr']);
 	echo "</div>";
 	
	echo "<div id=\"coldir\" style=\"float:left;width:auto;\">\n"; 
 		listacliente();
 	echo "</div>";
}
 ?>