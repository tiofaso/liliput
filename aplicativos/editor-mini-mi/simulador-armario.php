<div id="conteudo">
<div id="editorsimulador">
	
		
<?php			  
echo "<img id=\"manequim\" src=\"../" . IMG_PATH . "editor-mini-mi-img/manequim/generico.png\" >";


echo "<img src=\"../" . 
IMG_PATH . 
"editor-mini-mi-img/" . 
$_SESSION['tiporoupa'] . 
"/" . 
$_SESSION['imagemprincipal'] . 
".png\" style=\"position:absolute;z-index:". $_SESSION['camada'] . ";" .
"top:" . $_SESSION['topo'] . ";" .
"left:". $_SESSION['esquerda'] . ";\">";			
?>		
	</div>
</div>

