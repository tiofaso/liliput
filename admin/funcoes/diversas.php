<?php
function numreg(){ //gera números de registro aleatórios compostos por letras e números
//Rand(min, max)

	$basenumerica = date('dmYGi'); //número base dara a conversão
	
	$minusculas = explode(" ","a b c d e f g h i j k l m n o p q r s t u v x y z w");
	$maiusculas = explode(" ","A B C D E F G H I J K L M N O P Q R S T U V X Y Z W");	
	
	$i = 0;
	
	$base = ""; //setando variável para evitar warning

	while($i <= 3) {
		$numero = rand(0,9999);

		$x = rand(0,23); //índice aleatório paras as arrays $minusculas e $maiusculas		
		
		if($numero % 2 == 0){ $base .= $minusculas[$x];}
		else{$base .= $maiusculas[$x];} 
		
		$i++;
	}	
	
	$numeroaleatorio = rand(0,9999) % rand(1,9999);	
	
	$base = $basenumerica . $base . $numeroaleatorio;
	
	return $base;
}

function uploadimg($diretorio,$arquivo){ //função simples para subir arquivos para o servidor



	if(isset($arquivo) && is_array($arquivo)){
		/*echo $arquivo["name"] . "<br/>";
		echo strtoupper($arquivo["type"]) . "<br/>";
		echo $arquivo["size"] . "<br/>";
		echo $arquivo["tmp_name"] . "<br/>";
		echo numreg() ."<br/>";*/
		
		$novonome = numreg();
	}
	
	//extensões permitidas para imagens no sistema
	$extensoes = array(
				"IMAGE/GIF" => ".gif",
				"IMAGE/JPG" => ".jpg",
				"IMAGE/JPEG" => ".jpg",
				"IMAGE/PJPEG" => ".jpg",
				"IMAGE/PNG" => ".png", 
				"IMAGE/X-PNG" => ".png"	
	);

	//$imgthumb = redimimg($arquivo, $novonome, 240, $diretorio . "_tb", strtoupper($arquivo["type"]) );
	

 
	if(is_uploaded_file($arquivo["tmp_name"])){ //verifica se existe arquivo
		//verifica se é mesmo uma imagem
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$arquivo["name"], $resultado);
		 
		if(count($resultado) != 0){//é uma imagem de verdade
			
			
			move_uploaded_file($arquivo["tmp_name"],$diretorio . $novonome.$extensoes[strtoupper($arquivo["type"])] );
			
			
			//echo "<span id=\"correto\">Foto enviada com sucesso! :D</span>";
			return($novonome);
		}else{return(1);}//arquivo inválido
			

	}else{return(2);}//não enviou nada

	 
	
	//Verifica se o mime-type do arquivo é de imagem
	
		
	
/*if (is_uploaded_file($arquivo)) // Verificamos se existe algum arquivo na variável "Arquivo"
{ move_uploaded_file($arquivo,$dir.$nome.$arquivo_name); // Aqui, efetuamos o upload, propriamente dito
 echo "Enviado<br>"; // Caso dê tudo certo, imprimi na tela "enviado"
}else{
 echo "erro"; // Caso ocorra algum erro, imprimi na tela "erro"
}
}
	/*if( isset( $extensoes[strtoupper($arquivo["type"])] ) ){ echo "ok";}
	else{ echo "formato invalido"; }

	
	$tamanhomax = 5*1024*1024; //tamanho máximo dos arquivos, em bytes*/

	
	
		
}

function redimimg($imagem, $nome, $largura, $diretorio , $tipoimg){ //redimensiona imagens para criar thumbnails
	
	switch($tipoimg) { //verifica qual é o tipo da imagem
		Case "IMAGE/GIF":
			$imagemoriginal = imagecreatefromgif($imagem);
			$tipoimg = ".gif";
		break;				
				
		Case "IMAGE/JPG":
			$imagemoriginal = imagecreatefromjpeg($imagem);
			$tipoimg = ".jpg";
		break;

		Case "IMAGE/JPEG":
			$imagemoriginal = imagecreatefromjpeg($imagem);
			$tipoimg = ".jpg";
		break;

		Case "IMAGE/PJPEG":
			$imagemoriginal = imagecreatefromjpeg($imagem);
			$tipoimg = ".jpg";
		break;

		Case "IMAGE/PNG":
			$imagemoriginal = imagecreatefrompng($imagem);
			$tipoimg = ".png";
		break;

		Case "IMAGE/X-PNG":
			$imagemoriginal = imagecreatefrompng($imagem);
			$tipoimg = ".png";
		break;
	}

	//descobrindo a altura e largura da imagem original	
	$larguraoriginal = imagesx($imagemoriginal);
	$alturaoriginal = imagesy($imagemoriginal);

	$altura = ($largura * $alturaoriginal)/$larguraoriginal; //definindo a nova altura da imagem	
	
	$novaimagem = imagecreatetruecolor($largura, $altura);
	
	imagecopyresampled($novaimagem, $imagemoriginal, 0, 0, 0, 0, $largura, $altura, $larguraoriginal, $alturaoriginal);
	
	//criando o thumbnail
	switch($tipoimg) {
		Case ".gif":
			imagegif($novaimagem, $diretorio . "/" . $nome . "_tb" . $tipoimg);
		break;
		
		Case ".jpg":
			imagejpeg($novaimagem, $diretorio . $nome . $tipoimg);
		break;
		
		Case ".png":
			imagepng($novaimagem,  $diretorio . $nome . $tipoimg);
		break;
	}
	
	//destruindo imagens criadas na memória
	imagedestroy($imagemoriginal);
	imagedestroy($novaimagem);
	
	return($nome . "_tb" . $tipoimg);
}

function lista_tecidoteca($formato){ //função para listar os intens da tecidoteca

		?> 
	<div id="menu">
		<ul>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=algodao">algod&atilde;o</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=brim">brim</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=cetim">cetim</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=feltro">feltro</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=jeans">jeans</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=malha">malha</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=moleton">moleton</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=bordado">bordado</a></li>
						
		</ul>
	</div>
	
	<?php

	if(!isset($_GET['tipo'])){ $busca = "tipo='algodao'";}
	else{ $busca= "tipo=" . "'" . $_GET['tipo'] . "'"; }

		//iniciando a paginação dos dados
		if($formato == 'input'){		
			if(!isset($_POST['pagina'])){
				$paginaatual = 1;
			}
			else{
				$paginaatual = $_POST['pagina'];	
			} //endif
		}else{
				if(!isset($_GET['pagina'])){
				$paginaatual = 1;
			}
			else{
				$paginaatual = $_GET['pagina'];	
			} //endif
		}//end if
		
		$intensporpagina = 12;	

		$inicio = ($paginaatual*$intensporpagina) - $intensporpagina;


		$limites = " LIMIT " . $inicio . "," .$intensporpagina; //limites para exibição de itens na página

		exibirtecidoteca($busca,$limites,$formato); //apenas para verificar a quantidade de registros para pagina

		$paginacao = ceil($_SESSION['totalregistros']/$intensporpagina);

		$cont = 1;

		echo "<div id=paginacao>\n<ul>\n";
	
	
		while($cont <= $paginacao){
			
			if($formato == 'input'){
					if($paginaatual == $cont){
						if($_SESSION['totalregistros'] < $intensporpagina){				
							echo "<li>" . "<input type='submit' value='adicionar'>" . "</li>\n";
						}else{
							echo "<li>" . "<input type='submit' value=". $cont ." disabled>" . "</li>\n";
						}//end if
					}else{
						echo "<li>" . "<input type=submit value=". $cont ." name=pagina></li>\n";
					}//end if
			}elseif($formato == 'link'){
				echo "<li>" . "<a href=?pg=". $_SESSION['arquivo'] . "&" . str_replace("'","",$busca) . "&pagina=" . $cont . " >" . $cont . "</a></li>";
			}
			 
			$cont++;
		} //endwhile			
			
			

		echo "</ul>\n</div>\n";
}

function manipula_pastas($caminho,$nome,$modo){
	
	//mkdir("/home2/minimi/public_html/usuarios",0755);
	
	switch($modo) {
		case 'criar': //cria pasta
			if(!is_dir($caminho.$nome)){//verifica se pasta existe
				if(!mkdir($caminho.$nome,0755)){return FALSE;}//não conseguiu criar
				else{return TRUE;}
			}else{return "EXISTE";}
			break;
		case 'apagar': //apaga pasta
			if(is_dir($caminho.$nome)){//verifica se pasta existe
				if(!rmdir($caminho.$nome,0755)){return FALSE;}//não conseguiu criar
				else{return TRUE;}
			}else{return "NAO EXISTE";}
			break;
	}
		
	
	
	
}

function calculafrete($tipo,$remetente,$destinatario,$peso,$formato,$comprimento,$largura,$altura,$modo){ //Calcula frete usando a api dos Correios

	switch($tipo) {//definindo qual serviço foi solicitado
		case 'PAC':
			$servico = '41106';
			break;
		case 'SEDEX':
			$servico = '40010';
			break;
		case 'SEDEX10':
			$servico = '40215';
			break;
		case 'SEDEXHOJE':
			$servico ='40290';
			break;
		case 'ESEDEX':
			$servico = '81019';
			break;
		case 'MALOTE':
			$servico = '44105';
			break;
	}   
  
	$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?".
		 "nCdServico={$servico}&sCepOrigem={$remetente}&sCepDestino={$destinatario}".
		 "&nVlPeso={$peso}&nCdFormato={$formato}&nVlComprimento={$comprimento}".
		 "&nVlAltura={$altura}&nVlLargura={$largura}&StrRetorno=xml";
		 
	$frete = simplexml_load_file($url);
	
	if($frete->cServico->Erro == NULL){echo "<span id=\"erro\">". $frete->cServico->MsgErro . "</span>"; }
	else{
		if($frete->cServico->PrazoEntrega == '1'){ $prazotexto = "dia &uacute;til";}
		else{$prazotexto = "dias &uacute;teis";}
	
		$valorfrete = $frete->cServico->Valor;
		$prazofrete = $frete->cServico->PrazoEntrega;
	
		if($modo == 'echo'){
			echo $valorfrete  ."&nbsp;(". $tipo. "&nbsp;/&nbsp;" .$prazofrete."&nbsp;". $prazotexto .")";
		}elseif($modo == 'return'){
			return $valorfrete;
		}
	}//endif

}


function mostrafrete(){//calcula o frete de acordo com o cep do usuário logado
	echo "Frete estimado <br/> + R$";
	if(isset($_GET['frete'])){$_SESSION['usuariodados'][7] = strtoupper($_GET['frete']);}
	elseif(isset($_SESSION['usuariodados'][7]) && $_SESSION['usuariodados'][7] == ""){$_SESSION['usuariodados'][7] = 'PAC';}
	
	switch($_SESSION['usuariodados'][7]) {
			case 'PAC':
				$frete = "PAC";
				
				break;
			case 'SEDEX':
				$frete = "SEDEX";
				break;
			default:
				$frete = "PAC";
				
				break;
		}//end	

	//calculando a altura e peso do pacote
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

	calculafrete($frete,'05419000',$_SESSION['usuariodados'][5],$peso,'1',$comprimento,$largura,$altura,'echo');	
	
	echo "<br/><span>mudar frete?:&nbsp;";	

	if($frete == "PAC"){echo "<strong>PAC</strong> | <a href=\"".$_SESSION['ultimaurlfrete']."&frete=sedex\">SEDEX</a></span>";}
	
	else{echo "<a href=\"".$_SESSION['ultimaurlfrete']."&frete=pac\">PAC</a> | <strong>sedex</strong>";}
	
	
	
}

function mandaemail($nomedestinatario,$emaildestinatario,$assunto,$mensagem){//função para envio de e-mails autenticados
	//classe PHP mailer
	require_once(CLASS_PATH . "phpmailer/class.phpmailer.php");
	require_once(CLASS_PATH . "phpmailer/class.smtp.php");

	//dados básicos do destinatário e mensagem
	$nomedestinatario = vacinadebase($nomedestinatario);
	$emaildestinatario = vacinadebase($emaildestinatario);
	$assunto = vacinadebase($assunto);
	$mensagem = vacinadebase($mensagem);
	$emailremetente = info_loja(LOJA,'emailcontato','return');
	$nomeremetente = info_loja(LOJA,'nome','return');
	
	
	
	$mail = new PHPMailer();
	$mail->SetLanguage("br");
	$mail->IsSMTP();
	$mail->Host = "smtp.mini-mi.net"; 
	$mail->SMTPAuth = true;
	$mail->Username = "smtp";
	$mail->Password = "smtp2004";
	$mail->SetFrom($emailremetente,$nomeremetente);
	$mail->AddAddress($emaildestinatario,$nomedestinatario); 
	$mail->AddReplyTo($emailremetente,$nomeremetente);
	$mail->IsHTML(false); //ATIVA MENSAGEM NO FORMATO TXT, SE true ATIVA NO FORMATO HTML
	$mail->Subject = $assunto;
	$mail->Body = $mensagem;

	if(!$mail->Send()){
		return ($mail->ErrorInfo);
		exit;
	}
	
	return 1;	
}

function mandaemailadmin($nomedestinatario,$emaildestinatario,$assunto,$mensagem){//função para envio de e-mails autenticados

	//classe PHP mailer
	require_once("classes/phpmailer/class.phpmailer.php");
	require_once("classes/phpmailer/class.smtp.php");

	//dados básicos do destinatário e mensagem
	$nomedestinatario = vacinadebase($nomedestinatario);
	$emaildestinatario = vacinadebase($emaildestinatario);
	$assunto = vacinadebase($assunto);
	$mensagem = vacinadebase($mensagem);
	$emailremetente = info_loja(LOJA,'emailcontato','return');
	$nomeremetente = info_loja(LOJA,'nome','return');
	
	
	
	$mail = new PHPMailer();
	$mail->SetLanguage("br");
	$mail->IsSMTP();
	$mail->Host = "smtp.mini-mi.net"; 
	$mail->SMTPAuth = true;
	$mail->Username = "smtp";
	$mail->Password = "smtp2004";
	$mail->SetFrom($emailremetente,$nomeremetente);
	$mail->AddAddress($emaildestinatario,$nomedestinatario); 
	$mail->AddReplyTo($emailremetente,$nomeremetente);
	$mail->IsHTML(false); //ATIVA MENSAGEM NO FORMATO TXT, SE true ATIVA NO FORMATO HTML
	$mail->Subject = $assunto;
	$mail->Body = $mensagem;

	if(!$mail->Send()){
		return ($mail->ErrorInfo);
		exit;
	}
	
	return 1;	
}
?>