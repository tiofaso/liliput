<?php
/*
//Parâmetros a serem enviados para o Webservice
$servico = '41106';
$remetente = '71939360';
$destinatario = '72151613';
$peso = '0.300';
$formato = '1';
$comprimento = '17';
$altura = '8';
$largura = '11';
$retorno = 'xml';

$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?".
		 "nCdServico={$servico}&sCepOrigem={$remetente}&sCepDestino={$destinatario}".
		 "&nVlPeso={$peso}&nCdFormato={$formato}&nVlComprimento={$comprimento}".
		 "&nVlAltura={$altura}&nVlLargura={$largura}&StrRetorno={$retorno}";
		 
echo "<pre>";
print_r(simplexml_load_file($url));
echo "</pre>";

function calculafrete($tipo,$remetente,$destinatario,$peso,$formato,$comprimento,$largura,$altura){ //Calcula frete usando a api dos Correios

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
	}   */
  
	$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?".
		 "nCdServico={$servico}&sCepOrigem={$remetente}&sCepDestino={$destinatario}".
		 "&nVlPeso={$peso}&nCdFormato={$formato}&nVlComprimento={$comprimento}".
		 "&nVlAltura={$altura}&nVlLargura={$largura}&StrRetorno=xml";
		 
	$frete = simplexml_load_file($url);

	echo "<pre>";
print_r(simplexml_load_file($url));
echo "</pre>";
	
	
	if($frete->cServico->PrazoEntrega == '1'){ $prazotexto = "dia &uacute;til";}
	else{$prazotexto = "dias &uacute;teis";}
	
	$valorfrete = $frete->cServico->Valor;
	$prazofrete = $frete->cServico->PrazoEntrega;
	
	echo $valorfrete  ."&nbsp;(".$prazofrete."&nbsp;". $prazotexto .")";

}

$resultado = calculafrete('PAC','05419000','05417001','0.300','1','17','4','11');

?>