<?php
/**************************************************************
Aqui estão listadas as funções que realizam tarefas junto a base
de dados.

Última revisão: 15.02.2011
**************************************************************/
$conexao;
function conexaodb(){ //criando conexão com a base de dados

	global $conexao;
	
	$servidor = DB_SERVIDOR; 
	$usuario = DB_USUARIO;
	$senha = DB_SENHA;
	$db = DB_BASE;
	
	$conexao = @ mysql_connect($servidor, $usuario, $senha) or die(mysql_error());

	mysql_select_db($db);
}


function checausuario($email){ //função para criar usuários na base
	global $conexao;
	
	$conexao = mysql_query("SELECT usuario FROM tb_usuarios WHERE usuario LIKE '$email'");

	$row = mysql_fetch_array($conexao);	
	if($row){
		
		return TRUE;
		
	}
	else{return FALSE;}
}

function criarusuario($usuario,$senha,$apelido,$privilegio,$numreg){ //função para criar usuários na base
	global $conexao;
	
	$conexao = mysql_query("INSERT INTO tb_usuarios (numreg,usuario,senha,apelido,privilegios,ultimologin) VALUES ('$numreg','$usuario','$senha','$apelido','$privilegio',NOW())");

	if($conexao){return TRUE;}
	else{
		//echo "Seu usuario nao foi criado";
		//echo "<br/>" . mysql_error();
		return FALSE;
	}
} 
 

function criarperfilusuario($numreg,$nomecompleto,$apelido,$cpf,$email,$telefone,$endereco,$complemento,$cidade,$estado,$cep){ //função para criar perfil de usuários na base

	global $conexao;
		
	$conexao = mysql_query("INSERT INTO tb_perfilusuarios (numreg,nomecompleto,apelido,cpf,email,telefone,endereco,complemento,cidade,estado,cep,ultimaatualizacao) VALUES ('$numreg','$nomecompleto','$apelido','$cpf','$email','$telefone','$endereco','$complemento','$cidade','$estado','$cep',NOW())");

	if($conexao){return TRUE;}
	else{
		//echo "Seu perfil nao foi criado";
		//echo "<br/>" . mysql_error();
		return FALSE;
	}

} 

function dadousuario($numreg,$dado){//exibe dado específico do usuário
	global $conexao;
		
	$conexao = mysql_query("SELECT numreg,nomecompleto,apelido,cpf,email,telefone,endereco,complemento,cidade,estado,cep,ultimaatualizacao FROM tb_perfilusuarios WHERE numreg LIKE '$numreg'");

	$row = mysql_fetch_array($conexao);	

	if(isset($row[$dado])){return $row[$dado];}
	else{return FALSE;}


}

function criartecidoteca($numreg,$nome,$descricao,$img,$imgtb,$tipo,$tags,$corhexa1,$corhexa2,$corhexa3,$corhexa4,$local){
	global $conexao;
		
	$conexao = mysql_query("INSERT INTO tb_tecidoteca (numreg,nome,descricao,img,imgtb,tipo,tags,corhexa1,corhexa2,corhexa3,corhexa4,local,data) VALUES ('$numreg','$nome','$descricao','$img','$imgtb','$tipo','$tags','$corhexa1','$corhexa2','$corhexa3','$corhexa4','$local',NOW())");

	if($conexao){echo "Material cadastrado com sucesso";}
	else{
		echo "Material nao foi cadastrado com sucesso";
		echo "<br/>" . mysql_error();			
	}
	
}

function exibirtecidoteca($condicao,$limites,$tipo){
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	//verificação do número máximo de registros para paginação
	$conexao = mysql_query("SELECT numreg,nome,descricao,img,imgtb,tipo,tags,corhexa1,corhexa2,corhexa3,corhexa4,local,data FROM tb_tecidoteca WHERE $condicao ");	
	
	$_SESSION['totalregistros'] = mysql_num_rows($conexao);
	
	//realizando a busca real para exibição dos dados
	$condicoes = $condicao . $limites;
	
	$conexao = mysql_query("SELECT id,numreg,nome,descricao,img,imgtb,tipo,tags,corhexa1,corhexa2,corhexa3,corhexa4,local,data FROM tb_tecidoteca WHERE $condicoes ");

	if($conexao){
		$cont = 0;

		echo "<table width=100%>\n";		
		
		
		if(isset($_COOKIE["tecidos"])){
			$tecidomarcado =  explode(",",$_COOKIE["tecidos"]);	
		
			//o código a seguir só existe porque o índice inicial do MYSQL é diferente do índice inicial do explode() 		
			$indice = (count($tecidomarcado)) - 1;
		
			while($indice > 0 ){
				$tecidomarcado[$indice] = $tecidomarcado[($indice - 1)]; 
				$indice--;
			}	
			//fim do código
		}	

		while($row = mysql_fetch_array($conexao)){
		
						
			if($cont == 0){ echo "<tr> \n";  }
				if($tipo == 'input'){//exibir lista com input
					$checado = "";
				
					//verifica se o tecido foi selecionado, se sim, marca como checado  				
					if(isset($_COOKIE["tecidos"])){
						$escolhidos = explode(",",$_COOKIE["tecidos"]);

						$maximo = count($escolhidos) - 1;
					
						$inicio = 0;

						while($inicio <= $maximo){

							if($escolhidos[$inicio] == $row['id']){
								$checado = "checked";
							}//end if
							$inicio++;
						}//end while
					}//end if
				
					$valor = $row['id'];  				
  				
					echo "<td>";
  					echo "<input type=checkbox name=tecido". $row['id'] . " value=". $valor . " " . $checado . "> ";
  					echo "<img src=../img/tecidoteca/" . $row['local'] . "_tb/" . $row['imgtb'] . ">";  			
  					echo "<br/>" . $row['nome'] . "</td>\n";

					if(!isset($campostecido)){ $campostecido = $row['id'] . ","; }
					else{ $campostecido .= $row['id'] . ",";}
				}elseif($tipo == 'link'){ //exibir a lista como links
				
					echo "<td>";
  					echo "<a href=?pg=". $_SESSION['arquivo'] . "&acao=editar&tecido=". $row['id'] . ">";
  					echo "<img src=../img/tecidoteca/" . $row['local'] . "_tb/" . $row['imgtb'] . ">";
  					echo "</a>";  			
  					echo "<br/>" . $row['nome'] . "</td>\n";
					
				}//end if
			
  				if($cont == 3){
  					$cont = 0;
  					echo "</tr>\n";
 				}else{$cont++;}

  		} //endwhile
  		
  		echo "</table> \n";
	
		if($tipo == 'input'){ echo "<input type=hidden name=campostecido value=" . $campostecido . ">\n";}
	}
	else{
		echo "Nao foi possível exibir os itens";
		echo "<br/>" . mysql_error();			
	} //endif
}


function tecidosdisplay($tecidos,$exibe,$combo,$url){ //mostra as opções de tecidos disponíveis para o consumidor
		
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	$tecidos = explode(",",$tecidos);
	
	$max = count($tecidos) - 2; 
		
	$intensporpagina = 9;	

	
	$totalpaginas = ceil($max/$intensporpagina);


	if(!isset($_GET['pagina'])){ //primeira visita 
		$dbinicial = 0;
		$dbfinal = $intensporpagina;
	}elseif(isset($_GET['pagina']) && $_GET['op'] != $exibe){ //primeira visita 
		$dbinicial = 0;
		$dbfinal = $intensporpagina;
	}elseif(isset($_GET['pagina']) && $_GET['op'] == $exibe){
		$dbinicial = ($_GET['pagina'] - 1) * $intensporpagina;
		$dbfinal = $dbinicial + $intensporpagina;
	}
	
	 
	
	$tabela = 1;	
	
	while($dbinicial < $dbfinal){
	
		if($tabela == 1){ echo "\n<table>\n<tr>\n";}
		
		if($dbinicial <= $max){ 
			$conexao = mysql_query("SELECT id,numreg,nome,tipo,imgtb,tags FROM tb_tecidoteca WHERE id LIKE '$tecidos[$dbinicial]' ");	
		
			$row = mysql_fetch_array($conexao);
		
		
			
		
			if($row['tipo'] == "bordado"){ $tipo = "bordados_tb";}
			else{ $tipo = "tecidos_tb";}

		/*		if(isset($_GET['tecido'])){
					$url = "?pg=".$_GET['pg']."&passo=".$_GET['passo']."&exibe=".$exibe.
	"&roupa=".$_GET['roupa']."&camada=".$_GET['camada']."&posicao=".$_GET['posicao'] . "&op=".$exibe;	
				}
				else{
				$url = "?pg=".$_GET['pg']."&passo=".$_GET['passo']."&exibe=".$exibe;	
				}
			*/
			

			if($max == 0){//só existe um tecido
				echo "<td><img title=\"".$row['tags']."\" src=\"" . IMG_PATH ."tecidoteca/" . $tipo ."/". $row['imgtb'] . "\" width=\"38px\" height=\"41px\"></td>\n";
#opcoes
			}else{//existe mais de um tecido
				if($combo == 'combo'){//roupas com mais de uma cor
					echo "<td><a href=\"" . $url . "&tecido=" .$_GET['tecido']."&tecido2=" . $row['numreg'] ."&acao=editar" . "#opcoes\"><img title=\"".$row['tags']."\" src=\"" . IMG_PATH ."tecidoteca/" . $tipo ."/". $row['imgtb'] . "\" width=\"38px\" height=\"41px\" border=\"0\"></a></td>\n";
				}else{
					if(isset($_GET['tecido2'])){//usuário já começou a escolher o segundo tecido
					
						echo "<td><a href=\"" . $url . "&tecido=" . $row['numreg'] . "&tecido2=" .$_GET['tecido'] ."&acao=editar" . "#opcoes\"><img title=\"".$row['tags']."\" src=\"" . IMG_PATH ."tecidoteca/" . $tipo ."/". $row['imgtb'] . "\" width=\"38px\" height=\"41px\" border=\"0\"></a></td>\n";
					}
					else{
						echo "<td><a href=\"" . $url . "&tecido=" . $row['numreg'] ."&acao=editar" . "#opcoes\"><img title=\"".$row['tags']."\" src=\"" . IMG_PATH ."tecidoteca/" . $tipo ."/". $row['imgtb'] . "\" width=\"38px\" height=\"41px\" border=\"0\"></a></td>\n";
					}
					
				}
			}//endif
			
			if($tabela == 3 || $tabela == 6 || $tabela == 9){ echo "</tr>\n";}			

		}else{echo "<td></td>\n";}

		if($tabela == 9){	echo "</table>\n\n";}
		
		$tabela++;
		$dbinicial++;
		
	}//end while		
	
	//paginacao - INÍCIO
	if($totalpaginas != 1){//não exibe número de página se só existe uma página
		/*if(isset($_GET['tecido'])){
				$url = "?pg=".$_GET['pg']."&passo=".$_GET['passo']."&exibe=".$exibe.
	"&roupa=".$_GET['roupa']."&camada=".$_GET['camada']."&posicao=".$_GET['posicao'] .  "&tecido=".$_GET['tecido'];		
		}else{
				$url = "?pg=".$_GET['pg']."&passo=".$_GET['passo']."&exibe=".$exibe;
		}*/
	
		echo "<div id=\"paginacaoeditor\">\n<ul>\n";
	
		$contpg = 1;

		if(isset($_GET['pagina'])){$paginaatual = $_GET['pagina'];}
		else{$paginaatual = 1;}
	
		while($contpg <= $totalpaginas){
			if(isset($_GET['op']) && $_GET['op'] == $exibe){//item atual da manipulação
				if($contpg == $paginaatual){
					echo "<li>" . "<strong>" . $contpg . "</strong></li>\n";
			}
				elseif($_GET['op'] == $exibe){
					echo "<li>" . "<a href=\"". $url ."&pagina=". $contpg . "&op=".$exibe."&acao=editar#opcoes\">" . $contpg . "</a></li>\n";
			}
			}else{//outros itens da manipulação
				if($contpg == 1){
					echo "<li>" . "<strong>" . $contpg . "</strong></li>\n";
				}
				else{
					if($combo == 'combo' && isset($_GET['tecido2'])){$url = $url . "&tecido2=" . $_GET['tecido2']; }					
					echo "<li>" . "<a href=\"". $url ."&pagina=". $contpg . "&op=".$exibe."&acao=editar#opcoes\">" . $contpg . "</a></li>\n";
				}
			}//end if
		
			$contpg++;
		} //endwhile			
		echo "</ul>\n</div>\n";
	}//não exibe número de página se só existe uma página - FIM
	//paginacao - FIM

}	

function monotecido($numero,$campo,$funcao){//exibe apenas um tecido
	global $conexao;
	
	$conexao = mysql_query("SELECT id,numreg,nome,tipo,imgtb FROM tb_tecidoteca WHERE $campo LIKE '$numero' ");
	
	$row = mysql_fetch_array($conexao);	
	
	if($row['tipo'] == "bordado"){ $tipo = "bordados_tb";}
	else{ $tipo = "tecidos_tb";}
	
	echo "<img src=\"" . IMG_PATH ."tecidoteca/" . $tipo ."/". $row['imgtb'] . "\" width=\"38px\" height=\"41px\">";	

	if($funcao == 'return'){return $row['numreg'];}
	
	if($conexao){}
	else{echo "Nao produtos disponíveis";}
}
//numreg,numpedido,frete,fretevalor,estado,datapedido,ultimaatualizacao
function criapedido($numreg,$numpedido,$frete,$fretevalor){//cria pedido de boneco

	global $conexao;
		
	$valorpedido = $_SESSION['precofinal'];
	
	//atualizando dados
	$conexao = mysql_query("INSERT INTO tb_pedidos (numreg,numpedido,valorpedido,frete,fretevalor,estado,datapedido,ultimaatualizacao) VALUES ('$numreg','$numpedido','$valorpedido','$frete','$fretevalor','criado',NOW(),NOW())");

	if($conexao){return 1;}
	else{
		//echo "Material nao foi cadastrado com sucesso";
		//echo "<br/>" . mysql_error();			
		return 0;
	}
}

function atualizapedido($numreg,$numpedido,$frete,$fretevalor,$valorpedido){//cria pedido de boneco

	global $conexao;
			
	$conexao = mysql_query("UPDATE tb_pedidos
	SET valorpedido = '$valorpedido', 
	frete = '$frete',
	fretevalor = '$fretevalor',
	ultimaatualizacao = NOW()
	WHERE numpedido = '$numpedido' AND numreg = '$numreg' ");

	if($conexao){return 1;}
	else{
		//echo "Material nao foi cadastrado com sucesso";
		echo "<br/>" . mysql_error();			
		return 0;
	}
}

function valorpedido($numpedido){//retorna o valor total dos pedidos
	global $conexao;
	//buscando valores dos pedidos e somando o total
	$conexao = mysql_query("SELECT numpedido,preco FROM tb_pedidosminimi WHERE numpedido LIKE '$numpedido'");
	
	$valorpedido = 0;

	while($row = mysql_fetch_array($conexao)){
		$valorpedido = $valorpedido + $row['preco']; 
	}
	
	return $valorpedido;
}

function pedidoexiste($numpedido){//verifica se existe pedido
	global $conexao;
	
	$conexao = mysql_query("SELECT numpedido FROM tb_pedidos WHERE numpedido LIKE '$numpedido' ");
	
	$row = mysql_fetch_array($conexao);
	
	if($row == FALSE){return FALSE;}
	elseif($row == TRUE){return TRUE;}
}

function exibirprodutos(){ //exibe os produtos estáticos na loja
	
	global $conexao;
	
	$conexao = mysql_query("SELECT ");	
	
	if($conexao){}
	else{echo "Nao produtos disponíveis";}
}

function desconetardb(){ //desconectando da base de dados
	
	global $conexao;
	mysql_close($conexao);
}

function apagaregistro($tabela,$condicoes){//apaga registros do mysql
	global $conexao;
	
	$conexao = mysql_query("DELETE FROM $tabela WHERE $condicoes");

	mysql_query($conexao);
}

function atualizacaricatura($id,$estado,$descricao){//Atualiza os dados sobre aprovação/reprovação da caricatura

	global $conexao;

	//if($estado == 'nao'){$estado = "n&atilde;o";}//deixando com til na base	

	$conexao = mysql_query("UPDATE tb_pedidoscaricatura
		SET descricaocliente = '$descricao',
		estado = '$estado',
		ultimaatualizacao = NOW() 
		WHERE id = '$id'");

	if($conexao){/*echo "<p id=\"correto\">Dados atualizados com sucesso</p>";*/}
	else{
		echo "<p id=\"erro\">Nao foi possivel atualizar os dados</p>";
		echo "<br/>" . mysql_error();			
	}	
	

}

///////////////////////////////////////////////////////////////////
// Funções específicas para o funcionamento do template do admin
//////////////////////////////////////////////////////////////////
function listacliente(){//exibe clientes do sistema
	global $conexao;
	//buscando valores dos pedidos e somando o total
	$conexao = mysql_query("SELECT id,numreg,usuario,apelido,privilegios,ultimologin FROM tb_usuarios ORDER BY ultimologin");
	
	echo "<table id=\"clientes\">\n";
	
	echo "<tr>\n";
	echo "<td><strong>id</strong></td>\n";
	echo "<td><strong>numero de registro</strong></td>\n";
	echo "<td><strong>usuario</strong></td>\n";
	echo "<td><strong>apelido</strong></td>\n";
	echo "<td><strong>privilegios</strong></td>\n";
	echo "</tr>\n"; 
	
	$mudacor = 0;
	
	while($row = mysql_fetch_array($conexao)){
		if($mudacor == 0){ echo "<tr style=\"background:#BFE4ED\">"; $mudacor = 1;}
		elseif($mudacor == 1){ echo "<tr>\n"; $mudacor = 0;}
		echo "<td><strong>" . $row['id'] . "</strong>&nbsp;</td>\n";
		echo "<td><a href=\"?pg=clientes&usr=". $row['numreg'] ."\">" . $row['numreg'] . "</a></td>\n";
		echo "<td>" . $row['usuario'] . "</td>\n";
		echo "<td>" . $row['apelido'] . "</td>\n";
		echo "<td>" . $row['privilegios'] . "</td>\n";
		echo "</tr>\n"; 
	}
	echo "</table>\n";
	
}

function mostraperfilcliente($usr){//mostra o perfil individual de cada cliente
	global $conexao;
	//buscando valores dos pedidos e somando o total
	$conexao = mysql_query("SELECT * FROM tb_usuarios INNER JOIN tb_perfilusuarios ON tb_usuarios.numreg = tb_perfilusuarios.numreg WHERE tb_usuarios.numreg LIKE '$usr' ");
	
	
	while($row = mysql_fetch_array($conexao)){
		echo "<h3>".$row['numreg']." - ".$row['apelido']."</h3>";
		echo "<table>\n";
		echo "<tr>\n";
			echo "<td><strong>Numero de registro:</strong> " . $row['numreg'] . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
			echo "<td><strong>Usuario:</strong> " . $row['usuario'] . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
			echo "<td><strong>Apelido:</strong> " . $row['apelido'] . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
			echo "<td><strong>Nome Completo:</strong> " . $row['nomecompleto'] . "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
			echo "<td><strong>CPF:</strong> " . $row['cpf'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Email:</strong> " . $row['email'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Telefone:</strong> " . $row['telefone'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Endereco:</strong> " . $row['endereco'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Complemento:</strong> " . $row['complemento'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Cidade:</strong> " . $row['cidade'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Estado:</strong> " . $row['estado'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>CEP:</strong> " . $row['cep'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Privilegio:</strong> " . $row['privilegios'] . "</td>\n";
		echo "</tr>\n"; 
		echo "<tr>\n";
			echo "<td><strong>Criado em:</strong> " . $row['ultimaatualizacao'] . "</td>\n";
		echo "</tr>\n"; 
		
		echo "</table>\n";

	}
	
	
}

function listapedidos($estado){ //lista os pedidos realizados no site
	global $conexao;

	switch($estado) {
		case 'criado':
			$estado = "(tb_pedidos.estado LIKE 'criado')";
		break;
		
		case 'analise':
			$estado = "(tb_pedidos.estado LIKE 'e-mail enviado')";		
		break;

		case 'pagamento':
			$estado = "(tb_pedidos.estado LIKE 'boleto enviado') OR (tb_pedidos.estado LIKE 'pagseguro enviado') OR (tb_pedidos.estado LIKE 'pago')";
		break;

		case 'producao':
			$estado = "(tb_pedidos.estado LIKE 'caricatura enviada') OR (tb_pedidos.estado LIKE 'caricatura aprovada')";		
		break;

		case 'correios':
			$estado = "(tb_pedidos.estado LIKE 'pedido enviado') OR (tb_pedidos.estado LIKE 'pedido entregue')";		
		break;

		case 'outros':
			$estado = "(tb_pedidos.estado LIKE 'cancelado') OR (tb_pedidos.estado LIKE 'em aguardo')  OR (tb_pedidos.estado LIKE 'teste')  OR (tb_pedidos.estado LIKE 'valor devolvido')" ;		
		break;
	

	}
	//buscando valores dos pedidos e somando o total
	$conexao = mysql_query("SELECT * FROM tb_usuarios INNER JOIN  tb_pedidos ON tb_usuarios.numreg =  tb_pedidos.numreg WHERE $estado ORDER BY datapedido");

	echo "<table id=\"pedidos\">\n";

	echo "<tr>\n";
	echo "<td></td>\n";
	echo "<td><strong>pedido</strong></td>\n";
	echo "<td><strong>usuario</strong></td>\n";
	echo "<td><strong>email</strong></td>\n";
	echo "<td><strong>valor</strong></td>\n";
	echo "<td><strong>tipo frete</strong></td>\n";
	echo "<td><strong>valor frete</strong></td>\n";
	echo "<td><strong>estado</strong></td>\n";
	echo "<td><strong>data</strong></td>\n";
	echo "</tr>\n"; 

	$mudacor = 0;
	while($row = mysql_fetch_array($conexao)){
		if($mudacor == 0){ echo "<tr style=\"background:#BFE4ED\">"; $mudacor = 1;}
		elseif($mudacor == 1){ echo "<tr>\n"; $mudacor = 0;}

		echo "<td><a href=\"?pg=pedidos&acao=editar&id=" . $row['id'] . "\" title=\"editar pedido\"><img src=\"../" . IMG_PATH . "admin-img/lapis-editar.png\" border=\"0\"/></a></td>\n";
		echo "<td><a href=\"?pg=pedidos&ped=". $row['numpedido'] ."&usr=".$row['numreg']. "&email=" . $row['usuario'] . "\">" . $row['numpedido'] . "</a></td>\n";
		echo "<td><a href=\"?pg=clientes&usr=" . $row['numreg'] . "\">" . $row['apelido'] . "</a></td>\n";
		echo "<td>" . $row['usuario'] . "</td>\n";
		echo "<td>" . $row['valorpedido'] . "</td>\n";
		echo "<td>" . $row['frete'] . "</td>\n";
		echo "<td>" . $row['fretevalor'] . "</td>\n";
		echo "<td>" . $row['estado'] . "</td>\n";
		echo "<td>" . $row['datapedido'] . "</td>\n";
		echo "</tr>\n"; 
	}
	echo "</table>\n";
	

}

function editapedido($id) {//edita pedidos do usuário
	
	global $conexao;	
	
	if(isset($_POST['atualizarpedido'])){ //atualiza dados dos pedidos

		$numreg = $_POST['numreg'];
		$numpedido = $_POST['numpedido'];
		$valorpedido = $_POST['valorpedido'];
		$frete = $_POST['frete'];
		$fretevalor = $_POST['fretevalor'];
		$estado = $_POST['estado'];
		$numboleto = $_POST['numboleto'];
		$numpagseguro = $_POST['numpagseguro'];
		$codrastreio = $_POST['codrastreio'];	
	
	
		$conexao = mysql_query("UPDATE tb_pedidos
			SET numreg = '$numreg',
			numpedido = '$numpedido',
			valorpedido = '$valorpedido',
			frete = '$frete',
			fretevalor = '$fretevalor',
			estado = '$estado',
			numboleto = '$numboleto',
			numpagseguro = '$numpagseguro',
			codrastreio = '$codrastreio',
			ultimaatualizacao = NOW() 
			WHERE id = '$id'");

	if($conexao){echo "<p id=\"correto\">Dados atualizados com sucesso</p>";}
	else{
		echo "<p id=\"erro\">Nao foi possivel atualizar os dados</p>";
		echo "<br/>" . mysql_error();			
	}	
	
	}


	$conexao = mysql_query("SELECT * FROM tb_pedidos WHERE id LIKE '$id'");

	echo "<div id=\"coldir\">\n";
	while($row = mysql_fetch_array($conexao)){
		echo "<form action=\"?pg=pedidos&acao=editar&id=" .$id . "\" method=\"post\">\n";
		echo "N&uacute;mero de registro: <input type=\"text\"  name=\"numreg\"  value=\"" . $row['numreg'] . "\"/><br/>";
		echo "N&uacute;mero do pedido: <input type=\"text\"  name=\"numpedido\"  value=\"" . $row['numpedido'] . "\"/>";
		echo "&nbsp;(<a href=\"?pg=pedidos&ped=" . $row['numpedido'] . "&usr=" . $row['numreg'] . "\">ver pedido</a>)<br/>";
		echo "Valor do pedido: R$ <input type=\"text\" name=\"valorpedido\" value=\"" . $row['valorpedido'] . "\"/>";
		$totalpedido = $row['valorpedido'] + $row['fretevalor'];
		echo "&nbsp;(<strong>total</strong>: R$" .$totalpedido. ")<br/> ";
		echo "Tipo de frete: ";
		
		echo "<input type=\"radio\" name=\"frete\" value=\"PAC\"/ " ;
			if($row['frete'] == 'PAC'){echo "CHECKED";} 
		echo "> PAC\n" ;

		echo 	"<input type=\"radio\" name=\"frete\" value=\"SEDEX\"/ ";
			if($row['frete'] == 'SEDEX'){echo "CHECKED";}
		echo "> SEDEX\n" ;
			
		echo "<input type=\"radio\" name=\"frete\" value=\"EXPORT\"/ ";
			if($row['frete'] == 'EXPORT'){echo "CHECKED";}
		echo "> EXPORT\n" . "<br/>";
		
		echo "Valor do frete: R$ <input type=\"text\" name=\"fretevalor\" value=\"" . $row['fretevalor'] . "\"/><br/>";
		
		echo "Estado do pedido: ";
		echo "<select name=\"estado\">\n";
					echo "<option value=\"criado\" ";
					if($row['estado'] == 'criado'){echo "SELECTED";}
					echo " >criado</option>\n";
					
					echo "<option value=\"e-mail enviado\" ";
					if($row['estado'] == 'e-mail enviado'){echo "SELECTED";}
					echo ">e-mail enviado</option>\n";
					
					echo "<option value=\"boleto enviado\" ";
					if($row['estado'] == 'boleto enviado'){echo "SELECTED";}
					echo ">boleto enviado</option>\n";

					echo "<option value=\"pagseguro enviado\" ";
					if($row['estado'] == 'pagseguro enviado'){echo "SELECTED";}
					echo ">pagseguro enviado</option>\n";

					echo "<option value=\"pago\" ";
					if($row['estado'] == 'pago'){echo "SELECTED";}
					echo ">pago</option>\n";

					echo "<option value=\"caricatura enviada\" ";
					if($row['estado'] == 'caricatura enviada'){echo "SELECTED";}
					echo ">caricatura enviada</option>\n";

					echo "<option value=\"caricatura aprovada\" ";
					if($row['estado'] == 'caricatura aprovada'){echo "SELECTED";}
					echo ">caricatura aprovada</option>\n";

					echo "<option value=\"pedido enviado\" ";
					if($row['estado'] == 'pedido enviado'){echo "SELECTED";}
					echo ">enviado</option>\n";

					echo "<option value=\"pedido entregue\" ";
					if($row['estado'] == 'pedido entregue'){echo "SELECTED";}
					echo ">pedido entregue</option>\n";

					echo "<option value=\"cancelado\" ";
					if($row['estado'] == 'cancelado'){echo "SELECTED";}
					echo ">cancelado</option>\n";

					echo "<option value=\"em aguardo\" ";
					if($row['estado'] == 'em aguardo'){echo "SELECTED";}
					echo ">em aguardo</option>\n";
					
					echo "<option value=\"valor devolvido\" ";
					if($row['estado'] == 'valor devolvido'){echo "SELECTED";}
					echo ">valor devolvido</option>\n";

					echo "<option value=\"teste\" ";
					if($row['estado'] == 'teste'){echo "SELECTED";}
					echo ">teste</option>\n";
		echo "</select>\n<br/>";


		echo "N&uacute;mero do boleto: <input type=\"text\" name=\"numboleto\" value=\"" . $row['numboleto'] . "\"/><br/>";
		echo "N&uacute;mero do pagseguro: <input type=\"text\" name=\"numpagseguro\" value=\"" .  $row['numpagseguro'] . "\"/><br/>";
		echo "Data do pedido: " . $row['datapedido'] . "<br/>";
		echo "&Uacute;ltima atualiza&ccedil;&atilde;o: " . $row['ultimaatualizacao'] . "<br/>";
		echo "C&oacute;digo de rastreio: <input type=\"text\" name=\"codrastreio\" value=\"" .  $row['codrastreio'] . "\"/><br/>";
		echo "<input type=\"hidden\" name=\"atualizarpedido\" value=\"atualizar\">";
		echo "<br/><br/>" . "<input type=\"submit\" value=\"atualizar dados\"/>\n";
		echo "</form>\n";
		
		$numreg = $row['numreg'];
		
		}//endwhile
	echo "</div>\n";
	
	echo "<div id=\"colesq\">\n";	
		mostraperfilcliente($numreg);
	echo "</div>\n";
}

function mostrapedidosadmin($numpedido){//mostra os bonecos selecionados pelo usuário
	global $conexao;

	$conexao = mysql_query("SELECT * FROM tb_pedidosminimi WHERE numpedido LIKE '$numpedido'");

	while($row = mysql_fetch_array($conexao)){
	
	
	
	
	//echo "<div style=\"width:240;float:left;\">";
	

	
	
		echo "<div style=\"width:100%;\">\n";

			echo "Detalhes do pedido\n";
			echo "<table border=\"0\">\n";
				echo "<tr>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>manequim</strong></td>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>rosto</strong></td>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>cabelos</strong></td>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>roupa superior</strong></td>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>roupa inferior</strong></td>\n";
					
					if($row['acessorio'] != ""){					
						echo "<td style=\"padding:10px;text-align:center;\"><strong>acess&oacute;rio</strong></td>\n";
					}//endif

					if($row['inteiro'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\"><strong>conjunto</strong></td>\n";
					}//endif
				echo "</tr>\n";
			
				echo "<tr>\n";
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['manequim'],'cabide');
					echo "</td>\n";
				
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['rosto'],'cabide');
					echo "</td>\n";

					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['cabelo'],'cabide');
					echo "</td>\n";

					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['superior'],'cabide');
					echo "</td>\n";

					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['inferior'],'cabide');
					echo "</td>\n";
					
					if($row['acessorio'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimgadmin($row['acessorio'],'cabide');
						echo "</td>\n";
					}//endif
					
					if($row['inteiro'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimgadmin($row['inteiro'],'cabide');
						echo "</td>\n";
					}//endif*/
				echo "</tr>\n";
			
				echo "<tr>\n";
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['tecidomanequim'],'tecido');
						echo "\n<br>\n";
						buscacortecido($row['tecidomanequim']);
					echo "</td>\n";
				
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['bordadorosto'],'tecido');
						echo "\n<br>\n";
						buscacortecido($row['bordadorosto']);
					echo "</td>\n";
					
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						if($row['tecidocabelo'] == 'careca'){echo $row['tecidocabelo'];}
						else{
							buscaimgadmin($row['tecidocabelo'],'tecido');
							echo "\n<br>\n";
							buscacortecido($row['tecidocabelo']);
						}
					echo "</td>\n";

					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['tecidosuperior1'],'tecido');
						echo "\n<br>\n";
						buscacortecido($row['tecidosuperior1']);
						
						if($row['tecidosuperior2'] != ""){	
							echo "\n<br>\n";
							buscaimgadmin($row['tecidosuperior2'],'tecido');
							echo "\n<br>\n";
							buscacortecido($row['tecidosuperior2']);
						}//endif
					echo "</td>\n";

					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimgadmin($row['tecidoinferior'],'tecido');
						echo "\n<br>\n";
						buscacortecido($row['tecidoinferior']);
					echo "</td>\n";

					if($row['acessorio'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimgadmin($row['tecidoacessorio'],'tecido');
							echo "\n<br>\n";
							buscacortecido($row['tecidoacessorio']);
						echo "</td>\n";
					}//endif

					if($row['inteiro'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimgadmin($row['tecidointeiro1'],'tecido');
							echo "\n<br>\n";
							buscacortecido($row['tecidointeiro1']);
							
							if(buscacortecido($row['tecidointeiro2']) != ""){	
								echo "\n<br>\n";
								buscaimgadmin($row['tecidointeiro2'],'tecido');
								echo "\n<br>\n";
								buscacortecido($row['tecidointeiro2']);
							}//endif
						echo "</td>\n";
					}//endif*/
				echo "</tr>\n";

			echo "</table>\n";
	

		
		echo "</div>";				
		
		echo "<div style=\"width:100%;margin-top:20px;\">";
			echo "<p><strong>Apelido:</strong>&nbsp;" . $row['apelido'] . "&nbsp;&nbsp;&nbsp;" . "<strong>Sexo:</strong>&nbsp;" . $row['sexo'] .  "</p>";
			
			if($row['dadoespecial'] != ""){//descrição da fantasia
			echo "<p><strong>Descri&ccedil;&atilde;o da roupa especial:</strong>&nbsp;" . $row['dadoespecial'] . "</p>";
			}//descrição da fantasia - FIM
			
			if($row['descricaobordado'] != ""){//descrição do bordado
			echo "<p><strong>Descri&ccedil;&atilde;o ou texto para o bordado:</strong>&nbsp;" . $row['descricaobordado'] . "</p>";
			}//descricao bordado -fim
			
			if($row['detalhespessoa'] != ""){//detalhes da pessoa
			echo "<p><strong>Detalhes do big-mi:</strong>&nbsp;" . $row['detalhespessoa'] . "</p>";	
			}//detalhes da pessoa - fim
			
			echo "<p><strong>Ado&ccedil;&atilde;o do mini-mi:</strong>&nbsp;R$" . $row['preco'] . "</p>";	
		
			echo "<strong>Fotos:</strong> ";
			if($row['foto1'] != ""){echo "<a href=\"../usuarios/".$_GET['usr']."/".$row['foto1'].".jpg\" target=\"_blank\">foto 1</a>";}
			if($row['foto2'] != ""){echo "&nbsp;|&nbsp;<a href=\"../usuarios/".$_GET['usr']."/".$row['foto2'].".jpg\" target=\"_blank\">foto 2</a>";}
			if($row['foto3'] != ""){echo "&nbsp;|&nbsp;<a href=\"../usuarios/".$_GET['usr']."/".$row['foto3'].".jpg\" target=\"_blank\">foto 3</a>";}	
			
		echo "</div>";

	

	}//endwhile

}

function buscaimgadmin($numreg,$tipo){//busca imagens de dados dos pedidos de mini-mi
	global $conexao;

	switch($tipo){
		case 'armario':
			$img = mysql_query("SELECT * FROM tb_editorminimi WHERE numreg LIKE '$numreg'");
			break;
		case 'tecido':
			$img = mysql_query("SELECT * FROM tb_tecidoteca WHERE numreg LIKE '$numreg'");
			break;
		case 'cabide':
			$img = mysql_query("SELECT * FROM tb_editorminimi WHERE numreg LIKE '$numreg'");
			break;

	}

	
	
	$row = mysql_fetch_array($img);
	
	if($row == TRUE){
		if($tipo == "tecido"){
				echo "<img src=\"../" . IMG_PATH . "tecidoteca/" . $row['local'] ."_tb/". $row['imgtb'] . "\" title=\"".$row['tags']."\" alt=\"".$row['tags']."\"  width=\"38px\" height=\"41px\"/>";
		}elseif($tipo == "armario"){
			$posicao = explode(",",$row['posicao']);
			
			if($row['tipo'] == 'manequim') {
					echo "<img id=\"manequim\" src=\"../" . IMG_PATH . "editor-mini-mi-img/" . $row['tipo'] . "/" . $row['imagemprincipal'] . ".png\" title=\"".$row['nome']."\" alt=\"".$row['nome']."\" />" . "\n";
			}else{
				echo "<img src=\"../" . IMG_PATH . "editor-mini-mi-img/" . $row['tipo'] . "/" . $row['imagemprincipal'] . ".png\" title=\"".$row['nome']."\" alt=\"".$row['nome']."\"  style=\"position:absolute;top:" . $posicao[0] . ";left:". $posicao[1] .";z-index:". $row['camada'].";\" />" . "\n";
			}			
		}elseif($tipo == "cabide"){
				echo "<img src=\"../" . IMG_PATH . "editor-mini-mi-img/" . $row['tipo'] . "_cb/" . $row['imagemcabide'] . ".png\" title=\"".$row['nome']."\" alt=\"".$row['nome']."\" />" . "\n";

			}
	}
	
}

function buscacortecido($numreg){
	$corhexa = mysql_query("SELECT * FROM tb_tecidoteca WHERE numreg LIKE '$numreg'");
	
	$row = mysql_fetch_array($corhexa);
	if($row == TRUE){echo $row['corhexa1']; }
		
}

function criacaricaturaadmin($numreg,$numpedido,$apelido,$caricatura,$descricaobonequeiro,$versao){//cria caricatura dos pedidos realizados


	global $conexao;
		
	//atualizando dados
	$conexao = mysql_query("INSERT INTO tb_pedidoscaricatura (numreg,numpedido,apelido,caricatura,descricaobonequeiro,versao,data,ultimaatualizacao) VALUES ('$numreg','$numpedido','$apelido','$caricatura','$descricaobonequeiro','$versao',NOW(),NOW())");

	if($conexao){return 1;}
	else{
		//echo "A caricatura nao foi cadastrado com sucesso";
		//echo "<br/>" . mysql_error();			
		return 0;
	}
}

function listacaricaturaadmin($numpedido,$urlsite){//lista as caricaturas enviadas

	global $conexao;
		
	//atualizando dados
	$conexao = mysql_query("SELECT * FROM tb_pedidoscaricatura WHERE numpedido LIKE '$numpedido' ORDER BY data");	
	
	echo "<table cellspacing=\"10\">\n";
		echo "<tr>\n";
			echo "<td><strong></strong></td>";
			echo "<td><strong>apelido</strong></td>";
			echo "<td><strong>versao</strong></td>";
			//echo "<td><strong>data</strong></td>";
			echo "<td><strong>aprovado?</strong></td>";
		echo "</tr>\n";
		
		$cor = "nao";

		while($row = mysql_fetch_array($conexao)){
			if($cor == "sim"){
				echo "<tr style=\"background:#fff;\">\n";
				$cor = "nao";
			}else{
				echo "<tr>\n";
				$cor = "sim";
			}
				echo "<td> <a href=\"#" . $row['id'] . "\" title=\"". $row['descricaocliente'] ."\"><img src=\"../" . IMG_PATH . "admin-img/olho-visualizar.png\" border=\"0\"/></a></td>\n";
				echo "<td><a href=\"" . $urlsite .  "/usuarios/" . $row['numreg'] . "/" . $row['caricatura'] .  ".png\">" . $row['apelido'] . "</a></td>\n";
				echo "<td>" . $row['versao'] . "</td>\n";
				//echo "<td>" . $row['data'] . "</td>\n";
				echo "<td>" . $row['estado'] . "</td>\n";
			echo "</tr>\n";
		}//endwhile
	
	echo "</table>";
	
	
}
?>