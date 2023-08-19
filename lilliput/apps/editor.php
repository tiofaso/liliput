<?php
//session_start();
include("funcoes/editor-motor.php");

if ( isset($_GET['acao']) ) {
	if ($_GET['acao'] == 'limpar') {
		//sessão de edição
		$_SESSION['editando'] = NULL;
  		unset($_SESSION['editando']);

		
		$_SESSION['roupa'] = NULL;
  		unset($_SESSION['roupa']);

		
		$_SESSION['zindex'] = NULL;
  		unset($_SESSION['zindex']);

		
		$_SESSION['tipo'] = NULL;
  		unset($_SESSION['tipo']);

		
		$_SESSION['topo'] = NULL;
  		unset($_SESSION['topo']);
  		
		$_SESSION['esquerda'] = NULL;
  		unset($_SESSION['esquerda']);
  		
		$_SESSION['roupainferior'] = NULL;
		unset($_SESSION['roupainferior']);

		$_SESSION['roupasuperior'] = NULL;
		unset($_SESSION['roupasuperior']);

	}
}

if(!isset($_SESSION['editando'])){
	$_SESSION['editando'] = ""; //setando sessão para não dar warning
}


if(isset($_GET['roupa'])){
	$_SESSION['roupa'] = $_GET['roupa'];
	$_SESSION['zindex'] = $_GET['camada'];
	$_SESSION['tipo']  = $_GET['tipo'];
	
	$posicao = $_GET['posicao'];
	
	$posicao = explode(",",$posicao);
	
	$_SESSION['topo'] = $posicao[0];
	$_SESSION['esquerda'] = $posicao[1];
}


function montamanequim(){
	
	if (isset($_GET['acao']) && $_GET['acao'] == 'limpar'){
		$img1 = "<img src=armario/manequins/generico.png style=position:absolute;z-index:1;>";	
		
		return $img1;	
		}	
	
	if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == "inteiro"){
		$img1 = "<img src=armario/manequins/generico.png style=position:absolute;z-index:1;>";
		$img2 = "<img src=armario/" . $_SESSION['tipo'] . "/" . leconteudo($_SESSION['roupa']) . ".png style=position:absolute;top:" . $_SESSION['topo'] . ";left:" . $_SESSION['esquerda'] . ";z-index:" . $_SESSION['zindex'] .";>";
		
		$_SESSION['roupainferior'] = NULL;
		unset($_SESSION['roupainferior']);
		$_SESSION['roupasuperior'] = NULL;
		unset($_SESSION['roupasuperior']);
		
		return $img1 . $img2;
	}
	
	else{

		$img1 = "<img src=armario/manequins/generico.png style=position:absolute;z-index:1;>";

		if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == "inferior"){ 		
			$img2 = "<img src=armario/" . $_SESSION['tipo'] . "/" . leconteudo($_SESSION['roupa']) . ".png style=position:absolute;top:" . $_SESSION['topo'] . ";left:" . $_SESSION['esquerda'] . ";z-index:" . $_SESSION['zindex'] .";>";
			$_SESSION['roupainferior'] = $img2;
		}
		
		if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == "superior"){
			$img3 = "<img src=armario/" . $_SESSION['tipo'] . "/" . leconteudo($_SESSION['roupa']) . ".png style=position:absolute;top:" . $_SESSION['topo'] . ";left:" . $_SESSION['esquerda'] . ";z-index:" . $_SESSION['zindex'] .";>";
			$_SESSION['roupasuperior'] = $img3;
		}
		
		if(isset($_SESSION['roupainferior']) && !isset($_SESSION['roupasuperior'])){return $img1 . $_SESSION['roupainferior'];}
		elseif(!isset($_SESSION['roupainferior']) && isset($_SESSION['roupasuperior'])){return $img1 . $_SESSION['roupasuperior'];}
		elseif(isset($_SESSION['roupainferior']) && isset($_SESSION['roupasuperior'])){return $img1 . $_SESSION['roupainferior'] . $_SESSION['roupasuperior'];}
		else{return $img1;}	
	}
	
	

}


?>
	

<div id="editor">
	<div id="conteudo">
		
			  
			<?php echo montamanequim(); ?>
			
		
	</div>
</div>
<div id="armario">
	<table cellpadding="10" cellspacing="10">
		<tr>
			<td><a href="<?php echo $sessao; ?>&roupa=camiseta&camada=3&tipo=superior&posicao=90,31"><img src="armario/cabides/camiseta.png" border="0"border="0"/></a></td>
			<td><a href="<?php echo $sessao; ?>&roupa=camisa&camada=3&tipo=superior&posicao=85,15"><img src="armario/cabides/camisa.png" border="0"/></a></td>
			<td><a href="<?php echo $sessao; ?>&roupa=bermuda&camada=2&tipo=inferior&posicao=145,53"><img src="armario/cabides/bermuda.png" border="0"/></a></td>
			<td><a href="<?php echo $sessao; ?>&roupa=calca&camada=2&tipo=inferior&posicao=145,53"><img src="armario/cabides/calca.png" border="0"/></a></td>
		</tr>
		<tr>
			<td><a href="<?php echo $sessao; ?>&roupa=saia-a&camada=2&tipo=inferior&posicao=145,43"><img src="armario/cabides/saia-a.png" border="0"/></a></td>
			<td><a href="<?php echo $sessao; ?>&roupa=saia-balone&camada=2&tipo=inferior&posicao=145,43"><img src="armario/cabides/saia-balone.png" border="0"/></a></td>
			<td><a href="<?php echo $sessao; ?>&roupa=vestido&camada=4&tipo=inteiro&posicao=90,33"><img src="armario/cabides/vestido.png" border="0"/></a></td>
			<td><a href="<?php echo $sessao; ?>&roupa=jardineira&camada=4&tipo=inteiro&posicao=87,48"><img src="armario/cabides/jardineira.png" border="0"/></a></td>
		</tr>
	</table>

<a href="<?php echo $sessao; ?>&acao=limpar">Clique aqui</a> para limpar o editor
</div>