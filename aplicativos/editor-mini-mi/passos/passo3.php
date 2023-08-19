<?php
//Numreg
//gerando número de pedido
//$_SESSION['usuariodados'][9] = NUll;
//unset($_SESSION['usuariodados'][9]);

if(!isset($_SESSION['usuariodados'][9])){$_SESSION['usuariodados'][9] = numreg();}

//calculando a altura e peso do pacote - Início
	if($_SESSION['usuariodados'][6] == 0 || $_SESSION['usuariodados'][6] == 1){
		$altura = 4;
		$largura = 11;
		$comprimento = 17;
		$peso = 0.090;}
	else{
		if($_SESSION['usuariodados'][6] > 4){
			$altura = 11;
			$largura = 17;
			$comprimento = 4 * $_SESSION['usuariodados'][6];
		}else{
			$altura = 4 * $_SESSION['usuariodados'][6];
			$largura = 11;
			$comprimento = 17;
		}//endif
	
		
		 
	$peso = 0.090 * $_SESSION['usuariodados'][6]; }

	$frete = calculafrete($_SESSION['usuariodados'][7],'05419000',$_SESSION['usuariodados'][5],$peso,'1',$comprimento,$largura,$altura,'return');

	$frete = str_replace(",",".",$frete);
	
//calculando a altura e peso do pacote - FIM


if(isset($_GET['acao']) && $_GET['acao'] == "remover" && isset($_GET['item']) && $_GET['item'] != "" && $_SESSION['usuariodados'][6] > 1){
	//removendo itens da lista de pedidos
	apagaregistro("tb_pedidosminimi","numpedido LIKE'" . $_SESSION['usuariodados'][9] . "' AND id LIKE '".$_GET['item']."'");
	$_SESSION['usuariodados'][6] = $_SESSION['usuariodados'][6] - 1;
}elseif(isset($_GET['acao']) && $_GET['acao'] == "enviar" && $_SESSION['usuariodados'][10] != "enviado"){
	$_SESSION['usuariodados'][10] = "enviado"; 
	
	//e-mail básico para o cliente	
	$assunto = "novo pedido de mini-mi | ". $_SESSION['usuariodados'][9];
	$mensagem= "Olá " . base64_decode($_SESSION['usuariodados'][2])."!,\n\n";
	$mensagem .= "Você acaba de encomendar o nascimento de um mini-mi cujo o número de pedido é o seguinte: " . $_SESSION['usuariodados'][9]."\n\n";
	$mensagem .= "Em breve entrarei em contato contigo!\n\n";
	$mensagem .= "Um super abraço,\n";
	$mensagem .= "tio .faso";
	
	mandaemail(base64_decode($_SESSION['usuariodados'][2]),base64_decode($_SESSION['usuariodados'][1]),$assunto,utf8_decode($mensagem));
	
	//e-mail completo do sistema
	
	$assunto = "lilliput - novo pedido no site | ". $_SESSION['usuariodados'][9];
	$mensagem = "Número de registro: " . $_SESSION['usuariodados'][0] . "\n";
	$mensagem .= "E-mail do usário: " . base64_decode($_SESSION['usuariodados'][1]) . "\n";
	$mensagem .= "Apelido do usuário: " . base64_decode($_SESSION['usuariodados'][2]) . "\n";
	$mensagem .= "Número do pedido: " . $_SESSION['usuariodados'][9] . "\n";
	$mensagem .= "Valor do pedido: R$" . valorpedido($_SESSION['usuariodados'][9]) . "\n";
	$mensagem .= "Frete: R$" . $frete . " (".$_SESSION['usuariodados'][7].")\n";
	
	mandaemail('mini-mi','contato@mini-mi.net',$assunto,utf8_decode($mensagem));
	
	$_SESSION['usuariodados'][6] = 0; //tamanho do carrinho
	
	//$_SESSION['usuariodados'][9]  = NULL;
	//unset($_SESSION['usuariodados'][9]);
}


/*
echo "numero de pedido > " . $_SESSION['usuariodados'][9]  . "<br/><br/>";

echo "numreg" ."<br/>";
echo "manequim > " .  $_SESSION['manequim'][0] ."<br/>";
echo "rosto > " . $_SESSION['rosto'][0] ."<br/>";
echo "acessorio > " . $_SESSION['acessorio'][0] ."<br/>";
echo "superior > " . $_SESSION['superior'][0] ."<br/>";
echo "inferior > " . $_SESSION['inferior'][0] ."<br/>";
echo "inteiro > " . $_SESSION['inteiro'][0] ."<br/>";
echo "especial > " .  $_SESSION['especial'][0] ."<br/>";
echo "cabelo > " . $_SESSION['cabelo'][0] ."<br/>";		
*/
/*//Imagens
echo "<br/><br/>imagens" ."<br/>";
echo "manequim > " . $_SESSION['manequim'][1] ."<br/>";
echo "rosto > " . $_SESSION['rosto'][1] ."<br/>";
echo "acessorio > " . $_SESSION['acessorio'][1] ."<br/>";
echo "superior > " . $_SESSION['superior'][1] ."<br/>";
echo "inferior > " . $_SESSION['inferior'][1] ."<br/>";
echo "inteiro > " . $_SESSION['inteiro'][1] ."<br/>";
echo "especial > " . $_SESSION['especial'][1] ."<br/>";	
echo "cabelo > " . $_SESSION['cabelo'][1] ."<br/>";*/

//Tecidos
/*echo "<br/><br/>tecidos" ."<br/>";
echo "manequim > " . $_SESSION['manequim'][2] ."<br/>";
echo "rosto > " . $_SESSION['rosto'][2] ."<br/>";
echo "acessorio > " . $_SESSION['acessorio'][2] ."<br/>";
echo "superior > " . $_SESSION['superior'][2] ."<br/>";
echo "inferior > " . $_SESSION['inferior'][2] ."<br/>";
echo "inteiro > " . $_SESSION['inteiro'][2] ."<br/>";
echo "especial > " . $_SESSION['especial'][2] ."<br/>";
echo "cabelo > " . $_SESSION['cabelo'][2] ."<br/>";*/


//$tecidossuperior = explode("#",$_SESSION['superior'][2]);
/*echo "<pre>";
print_r($tecidossuperior);
echo "</pre>";
*/
//$tecidosinteiro = explode("#",$_SESSION['inteiro'][2]);
/*echo "<pre>";
print_r($tecidosinteiro);
echo "</pre>";
*/

/*//outros
echo "<br/><br/>outros" ."<br/>";
echo "bordado > " .$_SESSION['bordado'] ."<br/>";
echo "detalhes pessoa > " .$_SESSION['detalhespessoa'] ."<br/>";
echo "numreg > " .$_SESSION['usuariodados'][0] ."<br/>";
echo "e-mail > " .$_SESSION['usuariodados'][1] ."<br/>";
echo "apelido > " .$_SESSION['usuariodados'][2] ."<br/>";
echo "senha > " .$_SESSION['usuariodados'][3] ."<br/>";
echo "privilegios > " .$_SESSION['usuariodados'][4] ."<br/>"; 
echo "cep > " .$_SESSION['usuariodados'][5] ."<br/>"; 
echo "carrinho > " . $_SESSION['usuariodados'][6] ."<br/>";
echo "tipo frete > " .$_SESSION['usuariodados'][7] ."<br/>";
echo "imagens > " .$_SESSION['usuariodados'][8] ."<br/>";
echo "preco final > ". $_SESSION['precofinal'] . "<br/>";
*/
//$imagens = explode(" ",ltrim(str_replace("#"," ",$_SESSION['usuariodados'][8])));
/*echo "<pre>";
print_r($imagens);
echo "</pre>";
*/



//verificando se pedido já foi armazenado na base
if(pedidoexiste($_SESSION['usuariodados'][9]) == FALSE && !isset($_SESSION['usuariodados'][10])){//não existe pedido - primeira compra
	 
	//criando pedido
	$pedido = criapedido($_SESSION['usuariodados'][0],$_SESSION['usuariodados'][9],$_SESSION['usuariodados'][7],$frete);
		
	if($pedido != 1){echo "<span id=\"erro\">N&atilde;o foi poss&iacute;vel criar seu pedido. Entre em contato com a loja. :(</span>\n";}
	else{
		$minimi = criaminimi();
		$_SESSION['usuariodados'][6] = 1; //colocando o primeiro item no carrinho
	}//cria mini-mi
	
	$_SESSION['usuariodados'][10] = "criado"; //previne que usuário atualize a base apertando F5	
	
}//endif
elseif(pedidoexiste($_SESSION['usuariodados'][9]) == TRUE && !isset($_SESSION['usuariodados'][10])){//existe pedido
	$_SESSION['usuariodados'][6] = $_SESSION['usuariodados'][6] + 1; //colocando mais intens no carrinho

	//criando pedido
	$minimi = criaminimi();
	
	$valorpedido = valorpedido($_SESSION['usuariodados'][9]);	
	
	$pedido = atualizapedido($_SESSION['usuariodados'][0],$_SESSION['usuariodados'][9],$_SESSION['usuariodados'][7],$frete,$valorpedido);

	//if($pedido != 1){echo "<span id=\"erro\">N&atilde;o foi poss&iacute;vel criar seu pedido. Entre em contato com a loja. :(</span>\n";}
	//else{
		
		
	//}//cria mini-mi
	
	
	
	$_SESSION['usuariodados'][10] = "criado"; //previne que usuário atualize a base apertando F5
}
?>
<?php if(isset($_SESSION['manequim'][0]) && isset($_SESSION['rosto'][0]) && $_SESSION['manequim'][0] != "" && $_SESSION['rosto'][0] != ""){ //garante que só vai exibir infos se a pessoa já editou o boneco?>

<div id="passo"><h3>finaliza&ccedil;&atilde;o</h3></div>

<!--<div id="conteudo" style="border: 1px dashed;border-color:#000;padding:10px;height:270px;width:350px;">-->
<!--<h4><?php //echo $_SESSION['apelido'];?></h4>-->
<?php if($_SESSION['usuariodados'][10] == "enviado"):?>
<div id="intro" style="width:100%">

</div>
 
	<div style="padding:10px;margin-top:50px;width:700px;height:300px;float:left;">
		<?php echo "<p><span id=\"correto\">&#8730</span>&nbsp;Seu pedido foi enviado com sucesso! :D</p>\n";?>		
		<p>N&ordm; do pedido: <strong><?php echo $_SESSION['usuariodados'][9];?></strong></p>
		
		<?php echo "<p>Em alguns instantes voc&ecirc; receber&aacute; uma mensagem com a confirma&ccedil;&atilde;o do seu pedido</p>\n";?>
		<?php echo "<p>Agora o bonequeiro analisar&aacute; o seu pedido para confirmar todos os itens escolhidos ou mesmo entrar em contado com voc&ecirc; para sanar alguma d&uacute;vida.</p>\n";?>
		<?php echo "<p>Depois da an&aacute;lise voc&ecirc; receber&aacute; um e-mail com o meio de ado&ccedil;&atilde;o (forma de pagamento) e somente ap&oacute;s a confirma&ccedil;&atilde;o do mesmo o processo de manufatura do seu pedido ir&aacute; se iniciar.</p>\n";?>
</div>
<?php else:?>
<div id="intro" style="width:100%">
<p>N&ordm; do pedido: <strong><?php echo $_SESSION['usuariodados'][9];?></strong></p>
<p>Abaixo est&atilde;o listados os mini-mis que voc&ecirc; pr&eacute;-montou</p>

</div>

	<?php mostrapedidos($_SESSION['usuariodados'][9],'resumo');?>
<?php endif;?>


<!--</div>-->


<div  id="precofinal">
<?php 
$valorpedido = valorpedido($_SESSION['usuariodados'][9]);

$valorpedido = $valorpedido + $frete;
echo "<span id=\"precoreal\" style=\"font-weight:bold;float:right;top:20px;\">TOTAL</span>";
echo "<span id=\"precovalor\" style=\"top:30px;left:55px;\"><span id=\"precoreal\">R$</span>". $valorpedido . "</span>";

?>
<div id="frete" style="margin-top:10px;left:95px;">
	
<?php if(talogado() == TRUE):?>
	<?php
		$sitedir = str_replace("index.php", "", $_SERVER['PHP_SELF']); //capturando sessão do permalink

		$_SESSION['ultimaurlfrete'] = str_replace($sitedir, "", $_SERVER['REQUEST_URI']); //capturando sessão do permalink
		$urltemp = base64_encode($_SESSION['ultimaurlfrete']);
 		
 		$valorpedido = $valorpedido - $frete;
 		echo "R$".$valorpedido." + ". "R$".$frete. "(". $_SESSION['usuariodados'][7] . ")";  

		
	?>
	

<?php elseif(talogado() == FALSE):
$sitedir = str_replace("index.php", "", $_SERVER['PHP_SELF']); //capturando sessão do permalink

$_SESSION['ultimaurlfrete'] = str_replace($sitedir, "", $_SERVER['REQUEST_URI']); //capturando sessão do permalink
$urltemp = base64_encode($_SESSION['ultimaurlfrete']);
?>
	Para calcular o frete <br/>&eacute; preciso <a href="<?php info_loja(LOJA,'url','');?>?pg=login&url=<?php echo $urltemp;?>">fazer login</a>.
<?php endif;?>

</div>
<div style="margin-top:10px;left:20px;">
<?php if($_SESSION['usuariodados'][10] == "enviado"):?> 
<input id="botao" class="disabled" disabled type="button" onClick="parent.location='?pg=encomendar&passo=3&acao=enviar'" value="enviar pedido"/>
<input id="botao" class="disabled" disabled type="button" onClick="parent.location='?pg=encomendar&passo=alterar'" value="criar um novo mini-mi"/>
<?php else:?>
<input id="botao" type="button" onClick="parent.location='?pg=encomendar&passo=3&acao=enviar'" value="enviar pedido"/>
<input id="botao" type="button" onClick="parent.location='?pg=encomendar&passo=alterar'" value="criar um novo mini-mi"/>
<?php endif;?>
</div>


</div>



<?php } //garante que só vai exibir infos se a pessoa já editou o boneco - FIM
else{echo "<script language=\"javascript\">\n" .
"window.location=\"?pg=encomendar\";\n" .
"</script>";}?>
