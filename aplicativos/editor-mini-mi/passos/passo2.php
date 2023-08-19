<?php if(isset($_SESSION['manequim'][0]) && isset($_SESSION['rosto'][0]) && $_SESSION['manequim'][0] != "" && $_SESSION['rosto'][0] != ""){ //garante que só vai exibir infos se a pessoa já editou o boneco?>
<?php 

//criando array para os cabelos
if(!isset($_SESSION['cabelo'][0])){
$_SESSION['cabelo'] = array();
$_SESSION['cabelo'][0] = pegaarmario("tipo LIKE 'cabelo'",'numreg');
$_SESSION['cabelo'][1] = "";
$_SESSION['cabelo'][2] = "";
}

$url = "?pg=encomendar&passo=2";
?>
<div id="passo"><h3>passo 2 de 2</h3></div>

<div id="info">
<?php
echo "<span style=\"float:left;\"><strong>Apelido do mini-mi:</strong> " . $_SESSION['apelido'] . "&nbsp;&nbsp;&nbsp;"; 
echo "<strong>Sexo:</strong> " . $_SESSION['sexo'] . "</span>";
?>

</div>

<div id="infoopcoes">
<span style="float:right;"><a href="?pg=encomendar&acao=limpar">Refazer o mini-mi</a> ou <a href="<?php echo $_SESSION['ultimaurl'];?>" >Alterar algo</a>?</span>

</div>

<div id="conteudo" >
<?php
//echo "<strong>Imagens</strong><br/><br/>";
echo $_SESSION['manequim'][1]. "<br/>";	
echo $_SESSION['rosto'][1]. "<br/>";
echo $_SESSION['acessorio'][1]. "<br/>";
echo $_SESSION['superior'][1]. "<br/>";
echo $_SESSION['inferior'][1]. "<br/>";
echo $_SESSION['inteiro'][1]. "<br/>";
//echo $_SESSION['especial'][1]. "<br/>";



?>


</div>
<div id="menu" style="width:50%;background:#fff;float:left;height: 330px;">
<a name="opcoes"></a>
<?php
if(isset($_GET['exibe']) && $_GET['exibe'] != ""): //destaca link atual
	$linkatual = array();
	switch($_GET['exibe']) {
		Case 'cabelo':
			$linkatual[0] = "class=\"linkatual\"";
			$linkatual[1] = "";
			$linkatual[2] = "";
			$linkatual[3] = "";
			break;
			
		Case 'bordado':
			$linkatual[0] = "";
			$linkatual[1] = "class=\"linkatual\"";
			$linkatual[2] = "";
			$linkatual[3] = "";
			break;
		Case 'detalhes':
			$linkatual[0] = "";
			$linkatual[1] = "";
			$linkatual[2] = "class=\"linkatual\"";
			$linkatual[3] = "";
			break;

		Case 'fotos':
			$linkatual[0] = "";
			$linkatual[1] = "";
			$linkatual[2] = "";
			$linkatual[3] = "class=\"linkatual\"";
			break;
			
	}//endswitch
?>
			<ul   style="height:30px;margin-top:10px;">
				<li><a href="<?php echo $url;?>&exibe=cabelo&acao=editar#opcoes" <?php echo $linkatual[0];?>>cabelos</a></li>
				<li><a href="<?php echo $url;?>&exibe=bordado&acao=editar#opcoes" <?php echo $linkatual[1];?>>bordado</a></li>
				<li><a href="<?php echo $url;?>&exibe=detalhes&acao=editar#opcoes" <?php echo $linkatual[2];?>>+ detalhes</a></li>				
				<li><a href="<?php echo $url;?>&exibe=fotos&acao=editar#opcoes" <?php echo $linkatual[3];?>>fotos</a></li>
				
			</ul>
<?php else: ?>
			<ul   style="height:50px;">
				<li><a href="<?php echo $url;?>&exibe=cabelo&acao=editar#opcoes" class="linkatual">cabelos</a></li>
				<li><a href="<?php echo $url;?>&exibe=bordado&acao=editar#opcoes">bordado</a></li>
				<li><a href="<?php echo $url;?>&exibe=detalhes&acao=editar#opcoes">+ detalhes</a></li>				
				<li><a href="<?php echo $url;?>&exibe=fotos&acao=editar#opcoes">fotos</a></li>
				
			</ul>
<?php endif; //destaca link atual -FIM ?>

<?php 
if(isset($_GET['exibe']) && $_GET['exibe'] == 'cabelo' || !isset($_GET['exibe']) || $_GET['exibe'] == '' ){ //cabelos/bordado - INÍCIO
?>

<div id="miniconteudo">
<h4>Cabelos</h4>
<?php
$busca = "tipo LIKE 'cabelo'";
//echo "<span style=\"padding:10px;margin-bottom:20px;\"><center><img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/" . pegaarmario($busca,'imagemcabide') . ".png\"></center></span>";

$url = $url . "&exibe=cabelo";
?>
<p>Os cabelos definem o nosso rosto e apresentam a nossa personalidade ao mundo. As madeixas do seu mini-mi ser&atilde;o feitas de acordo com as fotos que voc&ecirc; enviar&aacute; no pr&oacute;ximo passo. Por enquanto, escolha a cor de cabelo que mais se adequar&aacute; ao seu big-mi:</p>

<div style="width:50%;float:left;height:auto;">
<?php 
$materiais = pegaarmario($busca,'materiais');
echo "<p>Cabelos dispon&iacute;veis:</p>\n";
tecidosdisplay($materiais,'cabelo','',$url) ;
echo "<span style=\"float:left;top:-15px;left:75px;position:relative;margin-right:20px;\"><a href=\"". $url . "&tecido=careca&acao=editar#opcoes" . "\">careca?</a></span>\n";
?>
</div>
<div  style="width:50%;float:left;">
<?php


if(isset($_GET['tecido']) ){
	$_SESSION['cabelo'][2] = $_GET['tecido'];
	echo "<p>Cabelo escolhido:</p>\n";
	echo "<div style=\"margin-bottom:10px;\">";
	
	if($_SESSION['cabelo'][2] != "careca"){ 
		monotecido($_SESSION['cabelo'][2],'numreg','');
	}else{echo "- nenhum -";}
	echo "</div>";
}elseif($_SESSION['cabelo'][2] != ""){
	echo "<p>Cabelos escolhido:</p>\n";
	echo "<div style=\"margin-bottom:10px;\">";
	
	if($_SESSION['cabelo'][2] != "careca"){ 
		monotecido($_SESSION['cabelo'][2],'numreg','');
	}else{echo "- nenhum -";}
	echo "</div>";
	
}
?>
</div>
</div>

<?php }elseif(isset($_GET['exibe']) && $_GET['exibe'] == 'bordado') {
	if(isset($_POST['bordado']) && isset($_GET['acao']) && $_GET['acao'] != 'remover'){
		$_SESSION['bordado'] = vacinadebase($_POST['textobordado']);
	}elseif(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
		$_SESSION['bordado'] = NULL;
		unset($_SESSION['bordado']);
	}

	?>

<div id="miniconteudo">
<h4>Bordado</h4>
<p><?php echo nl2br(pegaarmario("numreg LIKE '091120102326uNRp5690'",'descricao'));?></p>

<form action="<?php echo $url;?>&exibe=bordado&acao=editar#opcoes" method="post">

<?php if(isset($_SESSION['bordado'])  && $_GET['acao'] != 'remover'){?>
<textarea rows="5" cols="55" name="textobordado"><?php echo $_SESSION['bordado'];?></textarea><br/>
<input id="botao" type="submit" name="bordado" value="atualizar mensagem">
<?php if(isset($_SESSION['bordado']) && $_SESSION['bordado'] != ""):?>
<span id="correto" style="float:left;margin-right:10px;">- gravado -</span>
<?php else:?>
<span id="atencao" style="float:left;margin-right:10px;">- n&atilde;o foi enviado nada -</span>
<?php endif;?>
<?php }else{?>
<textarea rows="5" cols="55" name="textobordado"></textarea><br/>
 <input id="botao" type="submit" name="bordado" value="gravar mensagem">
 <?php }//endif?>
 <span style="float:left;margin-right:10px;"><a href="<?php echo $url;?>&exibe=bordado&acao=remover#opcoes">remover</a></span>
</form>
</div>
<?php }elseif(isset($_GET['exibe']) && $_GET['exibe'] == 'fotos') {?>

<div id="miniconteudo">
<h4>Fotos</h4>
<p>Para deixar o seu mini-mi com a cara do big-mi, voc&ecirc; precisa anexar <strong>at&eacute; 3 fotos</strong> em que <strong>d&ecirc; para ver bem o rosto e cabelo da pessoa a ser mini-mizada</strong>.</p>
<?php if(talogado() == TRUE):?>
<?php 

 if(isset($_POST['imagens'])){//usuário clicou no botão de enviar fotos
 	//criando pasta
 	$pasta = manipula_pastas(USR_PATH,$_SESSION['usuariodados'][0],'criar');
 	if($pasta == TRUE || $pasta == 'EXISTE'){
 		$pasta = USR_PATH . $_SESSION['usuariodados'][0] . "/" ;
		
 		
 		if($_FILES['foto1']['error'] != 4 ){
 			$_SESSION['usuariodados'][8] = "";
 			$maximo = 0;
 			
 			$fotos = array();
 			$fotos[0] = uploadimg($pasta,$_FILES['foto1']); //foto 1 - obrigatória
 			
 			if($_FILES['foto2']['error'] != 4){$fotos[1] = uploadimg($pasta,$_FILES['foto2']); $maximo++;}//foto 2 - opcional
 			if($_FILES['foto3']['error'] != 4){$fotos[2] = uploadimg($pasta,$_FILES['foto3']); $maximo++;}//foto 3 - opcional
 			
 			$cont = 0;
 			
 			$erros = array(); //armazena os erros
 			$erro[0] = "";
 			$erro[1] = "";
 			$erro[2] = "";
 			 			
 			while($cont <= $maximo){//verificando erros de upload
				 				
 				
 				switch($fotos[$cont]) {
 					case 1:
 						$qualfoto = $cont + 1;
 						$erro[$cont] = "<span id=\"erro\">Tipo de arquivo inv&aacute;lido (foto ". $qualfoto .")! :(</span>";
 						break;
 					case 2:
 						$qualfoto = $cont + 1;
 						$erro[$cont] = "<span id=\"erro\">Voc&ecirc; n&atilde;o enviou nada (foto ". $qualfoto .")! :(</span>";
 						break;
 					default:
 						$_SESSION['usuariodados'][8] = $_SESSION['usuariodados'][8] . "#" . $fotos[$cont];
 						break;
 				}//endswitch
 				
 				$cont ++;
 			}//endwhile
 		
 			if($erro[0] == "" && $erro[1] == "" && $erro[2] == ""){//não há nenhum erro
 				echo "<span id=\"correto\">Foto(s) enviada(s) com sucesso! :D</span>";
 				$fotobloqueio = "disabled" . " " ."class=\"disabled\"";
 			}else{$fotobloqueio = "";}
 			
 			
 		}
 	else{echo "<span id=\"erro\">Voc&ecirc; precisa adicionar pelo menos uma imagem (foto1)</span>";$fotobloqueio = "";}
 		
 	}
 }
 
 if(isset($_SESSION['usuariodados'][8]) && $_SESSION['usuariodados'][8] != ""){$fotobloqueio = "disabled"  . " " ."class=\"disabled\"";}
?>
<form action="<?php echo $url;?>&exibe=fotos&acao=editar#opcoes" method="post" enctype="multipart/form-data">
<?php if(isset($erro[0]) && $erro[0] != ""){echo $erro[0];} ?>
<?php if(isset($erro[1]) && $erro[1] != ""){echo $erro[1];} ?>
<?php if(isset($erro[2]) && $erro[2] != ""){echo $erro[2];} ?>
<table border="0" id="opcoespasso2" width="100%">
<tr>
	<td>Foto 1 </td>
	<td><input id="botao" type="file" name="foto1"/ <?php if(isset($fotobloqueio)){echo $fotobloqueio;}?>></td>
	
</tr>

<tr>
	<td>Foto 2</td>
	<td><input id="botao" type="file" name="foto2"/ <?php if(isset($fotobloqueio)){echo $fotobloqueio;}?>></td>
</tr>

<tr>
	<td>Foto 3</td>
	<td><input id="botao" type="file" name="foto3"/ <?php if(isset($fotobloqueio)){echo $fotobloqueio;}?>></td>
</tr>
<tr>
	<td></td>
	<td><input id="botao" type="submit" value="anexar imagens"/ name="imagens" <?php if(isset($fotobloqueio)){echo $fotobloqueio;}?>></td>
</tr>

</table>

</form>


<?php elseif(talogado() == FALSE):
	$sitedir = str_replace("index.php", "", $_SERVER['PHP_SELF']); //capturando sessão do permalink

	$_SESSION['ultimaurl'] = str_replace($sitedir, "", $_SERVER['REQUEST_URI']); //capturando sessão do permalink
	$urltemp = base64_encode($_SESSION['ultimaurl']);
?>
	<p><span id="atencao">( ! )</span>&nbsp;&Eacute; preciso <a href="<?php info_loja(LOJA,'url','');?>?pg=login&url=<?php echo $urltemp;?>">fazer login</a> para enviar fotos.</p>
<?php endif;?>

</div>


<?php }elseif(isset($_GET['exibe']) && $_GET['exibe'] == 'detalhes') {
	if(isset($_POST['detalhespessoa']) && isset($_GET['acao']) && $_GET['acao'] != 'remover'){
		$_SESSION['detalhespessoa'] = vacinadebase($_POST['detalhespessoa']);
	}elseif(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
		$_SESSION['detalhespessoa'] = NULL;
		unset($_SESSION['detalhespessoa']);
	}

	?>

<div id="miniconteudo">
<h4>+ Detalhes</h4>
<p>Para deixar o seu mini-mi ainda mais exclusivo e com a cara do seu futuro dono, escreva abaixo detalhes que s&oacute; voc&ecirc; conhece, como:</p>
<div style="margin-bottom:10px;display:block;margin-left: 15px;">
- Sinais de nascen&ccedil;a<br/>
- Estilo &uacute;nico de combinar roupas<br/>
- Algo que a pessoa adore ou idolatre<br/>
- etc. ...<br/>
</div>
<form action="<?php echo $url;?>&exibe=detalhes&acao=editar#opcoes" method="post">
<?php if(isset($_SESSION['detalhespessoa'])  && $_GET['acao'] != 'remover'){?>
<textarea id="maisdetalhes" rows="4" cols="50" name="detalhespessoa"><?php echo $_SESSION['detalhespessoa'];?></textarea><br/>
<input id="botao" type="submit" name="detalhes" value="atualizar atualizar">
<?php if(isset($_SESSION['detalhespessoa']) && $_SESSION['detalhespessoa'] != ""):?>
<span id="correto" style="float:left;margin-right:10px;">- gravado -</span>
<?php else:?>
<span id="atencao" style="float:left;margin-right:10px;">- n&atilde;o foi enviado nada -</span>
<?php endif;?>

<?php }else{?>
<textarea id="maisdetalhes" rows="4" cols="50" name="detalhespessoa"></textarea>	<br>
 <input id="botao" type="submit" name="detalhes" value="gravar detalhes">
 <?php }//endif?>
<span style="float:left;margin-right:10px;"><a href="<?php echo $url;?>&exibe=detalhes&acao=remover#opcoes">remover</a></span>
</form>
</div>
<?php }//cabelos/bordado - FIM?>

</div>
<div  id="preco" >
<?php 
//registrando adição ou remoção de opções 
	
	if(isset($_GET['exibe']) && $_GET['exibe'] = 'bordado' && isset($_GET['acao']) && $_GET['acao'] == 'remover'){ caixaregistradora('091120102326uNRp5690','remove');}
	elseif(isset($_POST['bordado']) || isset($_SESSION['bordado'])){caixaregistradora('091120102326uNRp5690','');}	
	
	echo "<span id=\"precovalor\"><span id=\"precoreal\">R$</span>". $_SESSION['precofinal'] . "</span>";	
	
?>
<div id="frete" style="margin-top:10px;">
	
<?php if(talogado() == TRUE):?>
	<?php
		$sitedir = str_replace("index.php", "", $_SERVER['PHP_SELF']); //capturando sessão do permalink

		$_SESSION['ultimaurlfrete'] = str_replace($sitedir, "", $_SERVER['REQUEST_URI']); //capturando sessão do permalink
		$urltemp = base64_encode($_SESSION['ultimaurlfrete']);
 
		mostrafrete();
	?>
<?php elseif(talogado() == FALSE):
$sitedir = str_replace("index.php", "", $_SERVER['PHP_SELF']); //capturando sessão do permalink

$_SESSION['ultimaurlfrete'] = str_replace($sitedir, "", $_SERVER['REQUEST_URI']); //capturando sessão do permalink
$urltemp = base64_encode($_SESSION['ultimaurlfrete']);
?>
	Para calcular o frete <br/>&eacute; preciso <a href="<?php info_loja(LOJA,'url','');?>?pg=login&url=<?php echo $urltemp;?>">fazer login</a>.
<?php endif;?>

</div>
<div id="estado2">
<?php


echo "<p>Os seguintes itens est&atilde;o pendentes:</p>";
echo "<ul style=\"list-style-type:none;margin-left:10px;\">\n";
if($_SESSION['cabelo'][0]  != "" && isset($_SESSION['cabelo'][2]) && $_SESSION['cabelo'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;voc&ecirc; n&atilde;o escolheu um cabelo</li>\n";
	$libera = "disabled";
	$liberacabelo = 0;
}else{ $libera = ""; $liberacabelo = 1;}

if(!isset($_SESSION['usuariodados'][8])){
	echo "<li><span id=\"erro\">X</span>&nbsp;Foto(s) da pessoa a ser mini-mizada</li>\n";
	$libera = "disabled";
	$liberafotos = 0;
}elseif(isset($_SESSION['usuariodados'][8])){ $libera = ""; $liberafotos = 1;}


if(isset($_POST['bordado']) && isset($_SESSION['bordado']) && $_SESSION['bordado'] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;texto/explica&ccedil;&atilde;o para o bordado</li>\n";
	$libera = "disabled";
	$liberabordado = 0;
}elseif(isset($_SESSION['cabelo'][2]) && $_SESSION['cabelo'][2] != ""){ $libera = ""; $liberabordado = 1;}

if($liberacabelo == 1 && $liberafotos == 1 && $liberabordado ==1){$libera = "";}
else{$libera = "disabled";}


if($libera != "disabled"){ 
	echo "<p><span id=\"correto\">&#8730</span>&nbsp;Mais nada! Weeee!!! :D</p>";
	echo "<p><span id=\"atencao\">!</span>&nbsp;Se desejar adicionar informa&ccedil;&otilde;es sobre a pessoa, clique em \"+ detalhes\"</p>";
}
else{$libera = $libera . " " ."class=\"disabled\"";}
//$_SESSION['liberado'][7] = 0;//combo 
//echo "<br>@".$_SESSION['liberado'] . " " . $libera;



echo "<input id=\"botao\" type=\"button\" onClick=\"parent.location='?pg=encomendar&passo=3'\" value=\"finalizar mini-mi\"". $libera . "/>";



?>
</div>
</div>

<div id="caixaitens" style="float:left; ">
<h4>Itens escolhidos</h4>
<table id="opcoespasso2" stye="font-size: small;">
<tr>
<td></td>
<td>tecido/bordado</td>
<td>descri&ccedil;&atilde;o</td>
</tr>

<?php
if(isset($_SESSION['rosto'][0]) && $_SESSION['rosto'][0] != ""){ //rosto
	$busca = "numreg LIKE '" . $_SESSION['rosto'][0] . "'";
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/" . pegaarmario($busca,'imagemcabide') . ".png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			monotecido($_SESSION['rosto'][2],'numreg','');
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo pegaarmario($busca,'descricao');
		echo "</td>\n";
	echo "</tr>\n";

}

if(isset($_SESSION['acessorio'][0]) && $_SESSION['acessorio'][0] != ""){ //acessório
	$busca = "numreg LIKE '" . $_SESSION['acessorio'][0] . "'";	
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/" . pegaarmario($busca,'imagemcabide') . ".png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			monotecido($_SESSION['acessorio'][2],'numreg','');
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo pegaarmario($busca,'descricao');
		echo "</td>\n";
	echo "</tr>\n";
}

if(isset($_SESSION['superior'][0]) && $_SESSION['superior'][0] != ""){ //roupa superior
	$busca = "numreg LIKE '" . $_SESSION['superior'][0] . "'";	
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/" . pegaarmario($busca,'imagemcabide') . ".png\">";
		echo "</td>\n";
	
		echo "<td>\n";
		
		$cont = explode("#",$_SESSION['superior'][2]);
		if(count($cont) == 2){
			monotecido($cont[0],'numreg','');
			echo "&nbsp;";
			monotecido($cont[1],'numreg','');
		}else{monotecido($_SESSION['superior'][2],'numreg','');}
			
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo pegaarmario($busca,'descricao');
		echo "</td>\n";
	echo "</tr>\n";
}

if(isset($_SESSION['inferior'][0]) && $_SESSION['inferior'][0] != ""){//roupa inferior
	$busca = "numreg LIKE '" . $_SESSION['inferior'][0] . "'";
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/" . pegaarmario($busca,'imagemcabide') . ".png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			monotecido($_SESSION['inferior'][2],'numreg','');
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo pegaarmario($busca,'descricao');
		echo "</td>\n";
	echo "</tr>\n";
}





?>
</table>
</div>

<div id="caixaitens" style="float:right;">
<?php if($_SESSION['inteiro'][0] != "" || $_SESSION['especial'][0] != "" || $_SESSION['manequim'][0] != "" || $_SESSION['cabelo'][0] != "" || isset($_SESSION['bordado']) && $_SESSION['bordado'] != ""){ //mostra itens a parte?>
<h4>Itens escolhidos</h4>
<table id="opcoespasso2" stye="font-size: small;">
<tr>
<td></td>
<td>tecido/bordado</td>
<td>descri&ccedil;&atilde;o</td>
</tr>
<?php
if(isset($_SESSION['manequim'][0]) && $_SESSION['manequim'][0] != "" ){//manequim
	$busca = "numreg LIKE '" . $_SESSION['manequim'][0] . "'";	
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "/" . pegaarmario($busca,'imagemprincipal') . ".png\" width=\"118\" height=\"122\">";
		echo "</td>\n";
	
		echo "<td>\n";
			monotecido($_SESSION['manequim'][2],'numreg','');
		echo "</td>\n";
	
		echo "<td style=\"text-align:left; \">\n";
			echo pegaarmario($busca,'descricao');
		echo "</td>\n";
	echo "</tr>\n";
}

if(isset($_SESSION['cabelo'][0]) && $_SESSION['cabelo'][2] != "" ){//manequim
	$busca = "numreg LIKE '" . $_SESSION['cabelo'][0] . "'";	
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/mini-cabelo.png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			if($_SESSION['cabelo'][2] != 'careca'){			
				monotecido($_SESSION['cabelo'][2],'numreg','');
			}else{echo "- careca - ";}
		echo "</td>\n";
	
		echo "<td style=\"text-align:left; \">\n";
			echo pegaarmario($busca,'descricao');
		echo "</td>\n";
	echo "</tr>\n";
}

if(isset($_SESSION['inteiro'][0]) && $_SESSION['inteiro'][0] != ""){//roupa tipo conjunto
	$busca = "numreg LIKE '" . $_SESSION['inteiro'][0] . "'";
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/" . pegaarmario($busca,'imagemcabide') . ".png\">";
		echo "</td>\n";
	
		$cont = explode("#",$_SESSION['inteiro'][2]);
		echo "<td>\n";
			if(count($cont) == 2){
				monotecido($cont[0],'numreg','');
				echo "&nbsp;";
				monotecido($cont[1],'numreg','');
			}else{monotecido($_SESSION['inteiro'][2],'numreg','');}
			
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo pegaarmario($busca,'descricao');
		echo "</td>\n";
	echo "</tr>\n";
}

if(isset($_SESSION['especial'][0]) && $_SESSION['especial'][0] != ""){//roupa especial
	$busca = "numreg LIKE '" . $_SESSION['especial'][0] . "'";
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . pegaarmario($busca,'tipo') . "_cb/" . pegaarmario($busca,'imagemcabide') . ".png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			echo "--";
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo $_SESSION['especial'][2];
		echo "</td>\n";
	echo "</tr>\n";
}

if(isset($_SESSION['bordado']) && $_SESSION['bordado'] != ""){//bordado
	
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/bordado_cb/bordado_cb.png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			echo "--";
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo $_SESSION['bordado'];
		echo "</td>\n";
	echo "</tr>\n";
}	
if(isset($_SESSION['detalhespessoa']) && $_SESSION['detalhespessoa'] != ""){//bordado
	
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/misc/detalhes.png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			echo "--";
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo $_SESSION['detalhespessoa'];
		echo "</td>\n";
	echo "</tr>\n";

}
if(isset($_SESSION['usuariodados'][8]) && $_SESSION['usuariodados'][8] != ""){//fotos
	
	echo "<tr>\n";
		echo "<td>\n";
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/misc/foto.png\">";
		echo "</td>\n";
	
		echo "<td>\n";
			echo "--";
		echo "</td>\n";
	
		echo "<td style=\"text-align:left;\">\n";
			echo "Foto(s) enviada(s)";
		echo "</td>\n";
	echo "</tr>\n";

}

?>
</table>
<?php } //mostra itens a parte - FIM?>
</div>

<?php } //garante que só vai exibir infos se a pessoa já editou o boneco - FIM
else{echo "<script language=\"javascript\">\n" .
"window.location=\"?pg=encomendar\";\n" .
"</script>";}?>
