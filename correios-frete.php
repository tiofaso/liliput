<?php
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

if(isset($_GET['destinatario'])){
	
		switch($_GET['produto']) {
			case 'froid':
				$altura = 6;
				$largura = 11;
				$comprimento = 16;
				$peso = 0.120;
				break;
	 		case 'mini-mi':
				$altura = 4;
				$largura = 11;
				$comprimento = 17;
				$peso = 0.090;
				break;
		}//end switch	
	
	$tipo = $_GET['tipofrete'];
	$remetente = "05419000";
	$destinatario = $_GET['destinatario'];

	if($_GET['quantidade'] == ''){ $altura = $altura * 1; $peso = $peso * 1;}
	else{$altura = $altura * $_GET['quantidade']; $peso = $peso * $_GET['quantidade'];}


	if($altura > $comprimento){$temp = $altura; $altura = $comprimento; $comprimento = $temp;}

	calculafrete($tipo,$remetente,$destinatario,$peso,'1',$comprimento,$largura,$altura,"echo");
}//endif
?>

<form action="correios-frete.php" method="get" />
CEP <input type="text" name="destinatario">
<br/>
<input type="radio" name="tipofrete" value="PAC"> PAC
<input type="radio" name="tipofrete" value="SEDEX"> Sedex
<br/>
<input type="radio" name="produto" value="mini-mi" selected> mini-mi
<input type="radio" name="produto" value="froid"> froid
<br/>
Quantidade <input type="text" name="quantidade">
<input type="submit" value="enviar"/>

</form>