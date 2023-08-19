<?php
//essa variável é criada no terceiro passo. Evita do usuário atualizar a base de dados (no 3º passo) ao apertar f5
if(isset($_SESSION['usuariodados'][10])){
	$_SESSION['usuariodados'][10] = NULL;
  	unset($_SESSION['usuariodados'][10]);
}

//Caso o usuário queira mudar o tipo de sexo do mini-mi
if(isset($_GET['passo']) && $_GET['passo'] == 'alterar' ){
	$_SESSION['sexo'] = NULL;
  	unset($_SESSION['sexo']);
  	
  	$_SESSION['apelido'] = NULL;
  	unset($_SESSION['apelido']);	
  	
  	$_SESSION['manequim'] = NULL;
	unset($_SESSION['manequim']);

	$_SESSION['rosto'] = NULL;
	unset($_SESSION['rosto']);

	$_SESSION['acessorio'] = NULL;
	unset($_SESSION['acessorio']);

	$_SESSION['superior'] = NULL;
	unset($_SESSION['superior']);
		
	$_SESSION['inferior'] = NULL;
	unset($_SESSION['inferior']);

	$_SESSION['inteiro'] = NULL;
	unset($_SESSION['inteiro']);
		
	$_SESSION['especial'] = NULL;	
	unset($_SESSION['especial']);
		
	$_SESSION['preco'] = NULL;	
	unset($_SESSION['preco']);	
	
	$_SESSION['precofinal'] = NULL;	
	unset($_SESSION['precofinal']);	
	
	$_SESSION['cabelo'] = NULL;	
	unset($_SESSION['cabelo']);
	
	$_SESSION['bordado'] = NULL;	
	unset($_SESSION['bordado']);
	
	$_SESSION['detalhespessoa'] = NULL;	
	unset($_SESSION['detalhespessoa']);
		 
	$_SESSION['ultimaurl'] = NULL;
	unset($_SESSION['ultimaurl']);
	
	$_SESSION['usuariodados'][8] = NULL;
	unset($_SESSION['usuariodados'][8]);
	
	$_SESSION['usuariodados'][10] = NULL;
	unset($_SESSION['usuariodados'][10]);
}
elseif(isset($_GET['passo']) && $_GET['passo'] != '1'){ //caso alguém altere o passo
	$_SESSION['sexo'] = NULL;
  	unset($_SESSION['sexo']);
  	
  	$_SESSION['apelido'] = NULL;
  	unset($_SESSION['apelido']);
  	
  	$_SESSION['manequim'] = NULL;
	unset($_SESSION['manequim']);

	$_SESSION['rosto'] = NULL;
	unset($_SESSION['rosto']);

	$_SESSION['acessorio'] = NULL;
	unset($_SESSION['acessorio']);

	$_SESSION['superior'] = NULL;
	unset($_SESSION['superior']);
		
	$_SESSION['inferior'] = NULL;
	unset($_SESSION['inferior']);

	$_SESSION['inteiro'] = NULL;
	unset($_SESSION['inteiro']);
		
	$_SESSION['especial'] = NULL;	
	unset($_SESSION['especial']);
		
	$_SESSION['preco'] = NULL;	
	unset($_SESSION['preco']);  
	
	$_SESSION['precofinal'] = NULL;	
	unset($_SESSION['precofinal']);	
	
	$_SESSION['cabelo'] = NULL;	
	unset($_SESSION['cabelo']);

	$_SESSION['bordado'] = NULL;	
	unset($_SESSION['bordado']);
	
	$_SESSION['detalhespessoa'] = NULL;	
	unset($_SESSION['detalhespessoa']);
		 
	$_SESSION['usuariodados'][8] = NULL;
	unset($_SESSION['usuariodados'][8]);

	$_SESSION['usuariodados'][10] = NULL;
	unset($_SESSION['usuariodados'][10]);
}
elseif($_GET['pg'] == 'encomendar' && !isset($_GET['passo'])){//pessoa clicou no link "encomendar "durante o processo
	$_SESSION['sexo'] = NULL;
  	unset($_SESSION['sexo']);
  	
  	$_SESSION['apelido'] = NULL;
  	unset($_SESSION['apelido']);
  	
  	$_SESSION['manequim'] = NULL;
	unset($_SESSION['manequim']);

	$_SESSION['rosto'] = NULL;
	unset($_SESSION['rosto']);

	$_SESSION['acessorio'] = NULL;
	unset($_SESSION['acessorio']);

	$_SESSION['superior'] = NULL;
	unset($_SESSION['superior']);
		
	$_SESSION['inferior'] = NULL;
	unset($_SESSION['inferior']);

	$_SESSION['inteiro'] = NULL;
	unset($_SESSION['inteiro']);
		
	$_SESSION['especial'] = NULL;	
	unset($_SESSION['especial']);
		
	$_SESSION['preco'] = NULL;	
	unset($_SESSION['preco']);  
	
	$_SESSION['precofinal'] = NULL;	
	unset($_SESSION['precofinal']);	
	
	$_SESSION['cabelo'] = NULL;	
	unset($_SESSION['cabelo']);
	
	$_SESSION['bordado'] = NULL;	
	unset($_SESSION['bordado']);
	
	$_SESSION['detalhespessoa'] = NULL;	
	unset($_SESSION['detalhespessoa']);
		 
	$_SESSION['usuariodados'][8] = NULL;
	unset($_SESSION['usuariodados'][8]);
	
	$_SESSION['usuariodados'][9] = NULL;
	unset($_SESSION['usuariodados'][9]);
	
		$_SESSION['usuariodados'][10] = NULL;
	unset($_SESSION['usuariodados'][10]);
}
?>
<div id="passo"><h3>passo 1 de 2</h3></div>

<?php if(!isset($_POST['primeiro']) && !isset($_SESSION['apelido'])){?>
<div id="intro" >
Antes de come&ccedil;ar a pr&eacute; montar o seu mini-mi, por favor escolha o sexo da pessoa a ser mini-mizada e um apelido para o boneco:
<form action="?pg=encomendar&passo=1" method="post">
<br/>
<label for="apelido">Apelido para o mini-mi:</label> <input id="apelido" type="text" maxlength="50" name="apelido"/>
<?php
//validação de erros,
if(isset($_SESSION['erro'])){
	
	echo "<p id=\"erro\">Voc&ecirc; n&atilde;o escolheu um apelido para o seu mini-mi! :(</p>";
}	
?>
<br/>
<label for="sexo">Sexo</label> 
<input type="radio" name="sexo" value="masculino" CHECKED id="masculino">
<label for="masculino">Masculino</label> 

<input type="radio" name="sexo" value="feminino" id="feminino"> 
<label for="feminino">Feminino</label> 

<input id="botao" type="submit" value="pr&oacute;ximo passo" name="primeiro">
</form>

</div>
<div id="introimg"  style="margin-bottom:20px;">
<center>
<img src="img/site/encomendar.png" alt="mini-mi" >
</center>
</div>

<?php
}elseif(isset($_POST['primeiro']) && isset($_POST['primeiro']) ){ //primeira visita do usuário
	$_SESSION['apelido'] = vacinadebase($_POST['apelido']);
	$_SESSION['sexo'] = $_POST['sexo'];
	$_SESSION['liberado'] = array();
	
	$_SESSION['liberado'][0] = 0;//manequim
	$_SESSION['liberado'][1] = 0;//rosto
	$_SESSION['liberado'][2] = 0;//acessório
	$_SESSION['liberado'][3] = 0;//superior
	$_SESSION['liberado'][4] = 0;//inferior
	$_SESSION['liberado'][5] = 0;//inteiro
	$_SESSION['liberado'][6] = 0;//especial
	$_SESSION['liberado'][7] = 0;//combo
	
	if($_SESSION['apelido'] == ""){$_SESSION['erro'] = "apelido";}
	else{
		$_SESSION['erro'] = NULL;
  		unset($_SESSION['erro']);	
	}
	
	
}
?>
<?php if(isset($_SESSION['erro']) && $_SESSION['erro'] == "apelido"){?><!-- não digitou o apelido - INÍCIO-->
<div id="intro" >
Antes de come&ccedil;ar a pr&eacute; montar o seu mini-mi, por favor escolha o sexo da pessoa a ser mini-mizada e um apelido para o boneco:
<form action="?pg=encomendar&passo=1" method="post">
<br/>
<label for="apelido">Apelido para o mini-mi:</label> <input id="apelido" type="text" maxlength="50" name="apelido"/>
<?php
//validação de erros,
if(isset($_SESSION['erro'])){
	
	echo "<p id=\"erro\">Voc&ecirc; n&atilde;o escolheu um apelido para o seu mini-mi! :(</p>";
}	
?>
<br/>
<label for="sexo">Sexo</label> 
<input type="radio" name="sexo" value="masculino" CHECKED id="masculino">
<label for="masculino">Masculino</label> 

<input type="radio" name="sexo" value="feminino" id="feminino"> 
<label for="feminino">Feminino</label> 

<input id="botao" type="submit" value="pr&oacute;ximo passo" name="primeiro">
</form>

</div>
<div  id="introimg" style="margin-bottom:20px;">
<center>
<img src="img/site/encomendar.png" alt="mini-mi" >
</center>
</div>
<?php }?><!-- não digitou o apelido - FIM-->
<!-------------------------------------------------->
<?php if(isset($_GET['passo']) && isset($_SESSION['apelido']) && $_SESSION['apelido'] != "" && $_GET['passo'] != 'alterar' && $_GET['passo'] == 1){?><!-- editor de mini-mi - INÍCIO-->
<!--<a name="editor"></a>-->
<div id="info">
<?php
include(APP_PATH . "editor-mini-mi/editor-motor.php");


if(isset($_SESSION['apelido'])){ //tudo ok
	
	echo "<span style=\"float:left;\"><strong>Apelido do mini-mi:</strong> " . $_SESSION['apelido']; 
	echo "&nbsp;&nbsp;&nbsp;<strong>Sexo:</strong> " . $_SESSION['sexo'] . "</span>";
	//montaeditor("manequim","sexo LIKE '". $_SESSION['sexo'] . "' ");

	if(isset($_GET['exibe']) && $_GET['exibe'] != 'inferior'){
		$roupas = $_GET['exibe'];} //roupas padrão para primeira visita do usuário
	else{$roupas = "superior";}
	
	if($_SESSION['sexo'] == "masculino"){$outrosexo = "feminino";}
	elseif($_SESSION['sexo'] == "feminino"){$outrosexo = "masculino";}


?>

<span style="float:right;"><a href="?pg=encomendar&passo=alterar">Mudar sexo ou apelido?</a></span>
</div>

<div id="infoopcoes">

<?php 
if(isset($_GET['acao'])){
	$urlatual = "?pg=". $_GET['pg'] ."&passo=". $_GET['passo'] ."&exibe=". $_GET['exibe'];

	echo "<a href=\"" . $urlatual ."&acao=limpar#editor\">Clique aqui</a> para limpar o editor";
}else{echo "&nbsp;";}
?>
</div>
<div style="width:100%;float:left;"><!-- grande div -->
<div id="conteudo">
<!--<img src="<?php echo IMG_PATH.'icones/ajax-loader.gif';?>" id="carregando" />-->
<?php echo montamanequim(); ?>

</div>

<div id="armario">
<div id="menu">
<?php $url = "?pg=". $_GET['pg'] ."&passo=". $_GET['passo'];	
if(isset($_GET['exibe']) && $_GET['exibe'] != ""): //destaca link atual
	$linkatual = array();
	switch($_GET['exibe']) {
		Case 'superior':
			$linkatual[0] = "class=\"linkatual\"";
			$linkatual[1] = "";
			$linkatual[2] = "";
			$linkatual[3] = "";
			$linkatual[4] = "";
			$linkatual[5] = "";
			break;
			
		Case 'inferior':
			$linkatual[0] = "class=\"linkatual\"";
			$linkatual[1] = "";
			$linkatual[2] = "";
			$linkatual[3] = "";
			$linkatual[4] = "";
			$linkatual[5] = "";
			break;
			
		Case 'rosto':
			$linkatual[0] = "";
			$linkatual[1] = "class=\"linkatual\"";
			$linkatual[2] = "";
			$linkatual[3] = "";
			$linkatual[4] = "";
			$linkatual[5] = "";
			break;
		Case 'manequim':
			$linkatual[0] = "";
			$linkatual[1] = "";
			$linkatual[2] = "class=\"linkatual\"";
			$linkatual[3] = "";
			$linkatual[4] = "";
			$linkatual[5] = "";
			break;

		Case 'acessorio':
			$linkatual[0] = "";
			$linkatual[1] = "";
			$linkatual[2] = "";
			$linkatual[3] = "class=\"linkatual\"";
			$linkatual[4] = "";
			$linkatual[5] = "";
			break;

		Case 'inteiro':
			$linkatual[0] = "";
			$linkatual[1] = "";
			$linkatual[2] = "";
			$linkatual[3] = "";
			$linkatual[4] = "class=\"linkatual\"";
			$linkatual[5] = "";
			break;

		Case 'especial':
			$linkatual[0] = "";
			$linkatual[1] = "";
			$linkatual[2] = "";
			$linkatual[3] = "";
			$linkatual[4] = "";
			$linkatual[5] = "class=\"linkatual\"";
			break;

	}//endswitch
	
?>
<ul  style="height:50px;">

				<li><a href="<?php echo $url;?>&exibe=superior&acao=editar#editor" <?php echo $linkatual[0];?>>camisas e cal&ccedil;as e cia.</a></li>
				<li><a href="<?php echo $url;?>&exibe=rosto&acao=editar#editor" <?php echo $linkatual[1];?>>rosto</a></li>				
				<li><a href="<?php echo $url;?>&exibe=manequim&acao=editar#editor" <?php echo $linkatual[2];?>>corpo</a></li>
				<li><a href="<?php echo $url;?>&exibe=acessorio&acao=editar#editor" <?php echo $linkatual[3];?>>acess&oacute;rios e outros</a></li>
				<li><a href="<?php echo $url;?>&exibe=inteiro&acao=editar#editor" <?php echo $linkatual[4];?>>conjuntos</a></li>
				<li><a href="<?php echo $url;?>&exibe=especial&acao=editar#editor" <?php echo $linkatual[5];?>>especiais</a></li>
			</ul>
<?php else: ?>
			<ul  style="height:30px;">
				<li><a href="<?php echo $url;?>&exibe=superior&acao=editar#editor" class="linkatual">camisas e cal&ccedil;as e cia.</a></li>
				<li><a href="<?php echo $url;?>&exibe=rosto&acao=editar#editor">rosto</a></li>				
				<li><a href="<?php echo $url;?>&exibe=manequim&acao=editar#editor">corpo</a></li>
				<li><a href="<?php echo $url;?>&exibe=acessorio&acao=editar#editor">acess&oacute;rios e outros</a></li>
				<li><a href="<?php echo $url;?>&exibe=inteiro&acao=editar#editor">conjuntos</a></li>
				<li><a href="<?php echo $url;?>&exibe=especial&acao=editar#editor">especiais</a></li>
			</ul>
<?php endif; //destaca link atual -FIM ?>


<?php exibirarmario("tipo LIKE '" . $roupas . "' AND sexo NOT LIKE '" . $outrosexo . "'",1);?>
<?php if(!isset($_GET['exibe']) || $_GET['exibe'] == 'padrao' || $_GET['exibe'] == 'superior' || $_GET['exibe'] == 'inferior'){exibirarmario("tipo LIKE 'inferior' AND sexo NOT LIKE '" . $outrosexo . "'",2);}?>


</div>
</div>

<div id="preco">
<?php
	//registrando adição ou remoção de opções
	
	if(isset($_GET['acao']) && $_GET['acao'] == 'remover' && isset($_GET['roupa'])){ caixaregistradora($_GET['roupa'],'remove');}
	elseif(isset($_GET['roupa'])){caixaregistradora($_GET['roupa'],'');}	
	
	if(isset($_SESSION['precofinal'])){echo "<span id=\"precovalor\"><span id=\"precoreal\">R$</span>". $_SESSION['precofinal'] . "</span>";}
	else{echo "<span id=\"precovalor\"><span id=\"precoreal\">R$</span>". 103 . "</span>";}
	

	?>
<br/><br/>
<div id="frete">
	
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
</div>
</div><!-- grande div -->
<!-- opções - INÍCIO -->


<?php //opções do rosto
		//if($_SESSION['manequim'][0] != ""){
			echo "<div id=\"opcoes\">\n";
						mostraopcoes($_SESSION['manequim'][0],'manequim');			
			echo "\n</div>\n";
		//}
					
?>		

<?php //opções do rosto
		if($_SESSION['rosto'][1] != ""){
			echo "<div id=\"opcoes\">\n";
						mostraopcoes($_SESSION['rosto'][0],'rosto');			
			echo "\n</div>\n";
		}
					
?>		

<?php //opções da roupa superior
		if($_SESSION['superior'][1] != ""){
			echo "<div id=\"opcoes\">\n";
				mostraopcoes($_SESSION['superior'][0],'superior');
			echo "\n</div>\n";
		}
					
?>	

<?php //opções da roupa inferior
		if($_SESSION['inferior'][1] != ""){
			echo "<div id=\"opcoes\">\n";
				mostraopcoes($_SESSION['inferior'][0],'inferior');
			echo "\n</div>\n";
		}
					
?>	

<?php //opções do acesório
		if($_SESSION['acessorio'][1] != ""){
			echo "<div id=\"opcoes\">\n";
				mostraopcoes($_SESSION['acessorio'][0],'acessorio');
			echo "\n</div>\n";
		}
					
?>	

<?php //opções da roupa inteira
		if($_SESSION['inteiro'][1] != ""){
			echo "<div id=\"opcoes\">\n";
				mostraopcoes($_SESSION['inteiro'][0],'inteiro');
			echo "\n</div>\n";
		}
					
?>	

<?php //opções da roupa especial
		if($_SESSION['especial'][1] != ""){
			echo "<div id=\"opcoesespecial\">\n";
				mostraopcoes($_SESSION['especial'][0],'especial');
			echo "\n</div>\n";
		}
					
?>	

<div id="estado">
<?php
//Validando os dados que estão sendo criados
// afim de liberar para o próximo passo

//Itens obrigatórios --------
//manequim

	
echo "<p>Os seguintes itens est&atilde;o pendentes:</p>";
echo "<ul>\n";
if($_SESSION['manequim'][0]  != "" && isset($_SESSION['manequim'][2]) && $_SESSION['manequim'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido do corpo</li>\n";
	$_SESSION['liberado'][0] = 0;//manequim
}else{ $_SESSION['liberado'][0] = 1;}

//rosto	
if($_SESSION['rosto'][0]  == ""){//não escolheu rosto
	echo "<li><span id=\"erro\">X</span>&nbsp;sem rosto</li>\n";
	$_SESSION['liberado'][1] = 0;//rosto
}else{$_SESSION['liberado'][1] = 1;}
//verifica se o usuário escolheu um corpo (e seu tecido0 e um rosto
if($_SESSION['liberado'][0] == 1 && $_SESSION['liberado'][1] == 1){$libera = "";}
else{$libera = "disabled";}



//Itens opcionais ------------
//acessórios
if($_SESSION['acessorio'][0]  != "" && $_SESSION['acessorio'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido do acess&oacute;rio</li>\n";
	$_SESSION['liberado'][2] = 0;//acessório
	$libera = "disabled";
}else{$_SESSION['liberado'][2] = 1;}

//roupa superior
if($_SESSION['superior'][0]  != ""  && isset($_SESSION['superior'][2]) && $_SESSION['superior'][2] == ""){
	if($_SESSION['liberado'][7] == 1){
		
		$cont = explode("#",$_SESSION['superior'][2]);
		if(count($cont) != 2){
			echo "<li><span id=\"erro\">X</span>&nbsp;Essa camisa/blusa t&ecirc;m dois tecidos</li>\n";
			$libera = "disabled";
		}else{$libera = "";}
	}	
	else{
		echo "<li><span id=\"erro\">X</span>&nbsp;tecido da camisa/blusa</li>\n";
		$_SESSION['liberado'][3] = 0;//superior
		$libera = "disabled";
	}
}else{$_SESSION['liberado'][3] = 1;}


//roupa inferior
if($_SESSION['inferior'][0]  != "" && isset($_SESSION['inferior'][2]) && $_SESSION['inferior'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido da cal&ccedil;a/saia</li>\n";
	$_SESSION['liberado'][4] = 0;//inferior
	$libera = "disabled";
}else{$_SESSION['liberado'][4] = 1;}

if($_SESSION['inteiro'][0]  != "" && isset($_SESSION['inteiro'][2]) && $_SESSION['inteiro'][2] == ""){
	if($_SESSION['liberado'][7] == 1){
		
		$cont = explode("#",$_SESSION['inteiro'][2]);
		if(count($cont) != 2){
			echo "<li><span id=\"erro\">X</span>&nbsp;Esse conjunto t&ecirc;m dois tecidos</li>\n";
			$libera = "disabled";
		}else{$libera = "";}
	}	
	else{
		echo "<li><span id=\"erro\">X</span>&nbsp;tecido do conjunto</li>\n";
		$_SESSION['liberado'][3] = 0;//superior
		$libera = "disabled";
	}
}else{$_SESSION['liberado'][3] = 1;}	
	
if($_SESSION['especial'][0]  != "" && isset($_SESSION['especial'][2]) && $_SESSION['especial'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;coment&aacute;rio da roupa especial</li>\n";
	$_SESSION['liberado'][6] = 0;//especial
	$libera = "disabled";
}else{$_SESSION['liberado'][6] = 1;}

//combo
echo "</ul>\n";

//fazendo as verificações ------

if($libera != "disabled"){ echo "<p><span id=\"correto\">&#8730</span>&nbsp;Mais nada! Weeee!!! :D</p>";}
else{$libera = $libera . " " ."class=\"disabled\"";}
//$_SESSION['liberado'][7] = 0;//combo 
//echo "<br>@".$_SESSION['liberado'] . " " . $libera;

echo "<input id=\"botao\" type=\"button\" onClick=\"parent.location='?pg=encomendar&passo=2'\" value=\"pr&oacute;ximo passo\"". $libera . "/>";
?>
</div>
<?php 
//essa url servirá no próximo passo
$sitedir = str_replace("index.php", "", $_SERVER['PHP_SELF']); //capturando sessão do permalink

$_SESSION['ultimaurl'] = str_replace($sitedir, "", $_SERVER['REQUEST_URI']); //capturando sessão do permalink

?>

<?php }//endif  -tudo ok FIM?>

<?php }?><!-- editor de mini-mi - FIM-->

