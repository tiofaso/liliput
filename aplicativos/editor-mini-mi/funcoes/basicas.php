<?php
function lista_armario(){ //função para listar os intens da tecidoteca

		?> 
		
	<div id="menu">
		<ul>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=acessorio">Acess&oacute;rio</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=superior">Roupa Superior</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=inferior">Roupa Inferior</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=inteiro">Roupa Inteira</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=rosto">Rosto</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=especial">Roupa Especial</a></li>
			<li><a href="?pg=<?php echo $_SESSION['arquivo']; ?>&tipo=manequim">Manequim</a></li>
						
		</ul>
	</div>
	
	<?php

	if(!isset($_GET['tipo'])){ $busca = "tipo='superior'";}
	else{ $busca= "tipo=" . "'" . $_GET['tipo'] . "'"; }

		//iniciando a paginação dos dados
		if(!isset($_GET['pagina'])){
			$paginaatual = 1;
		}
		else{
			$paginaatual = $_GET['pagina'];	
		} //endif

		$intensporpagina = 12;	

		$inicio = ($paginaatual*$intensporpagina) - $intensporpagina;


		$limites = " LIMIT " . $inicio . "," .$intensporpagina; //limites para exibição de itens na página

		exibirarmarioadmin($busca,$limites); //apenas para verificar a quantidade de registros para pagina

		$paginacao = ceil($_SESSION['totalregistros']/$intensporpagina);

		$maxlinks = 3; //número máximo de links para paginação


		$cont = 1;

		echo "<div id=paginacao>\n<ul>\n";
	
	
		while($cont <= $paginacao){
		
			echo "<li>" . "<a href=?pg=". $_SESSION['arquivo'] . "&" . str_replace("'","",$busca) . "&pagina=" . $cont . " >" . $cont . "</a></li>";
			 
			$cont++;
		} //endwhile

		echo "</ul>\n</div>\n";
}

function criararmario($numreg,$nome,$descricao,$preco,$tipo,$materiais,$camada,$posicao,$imagemprincipal,$imagemcabide,$sexo,$combo,$estado){
	global $conexao;
		
	$conexao = mysql_query("INSERT INTO tb_editorminimi (numreg,nome,descricao,preco,sexo,tipo,materiais,camada,posicao,imagemprincipal,imagemcabide,data,combo) VALUES ('$numreg','$nome','$descricao','$preco','$sexo','$tipo','$materiais','$camada','$posicao','$imagemprincipal','$imagemcabide',NOW(),'$combo','$estado')");

	if($conexao){echo "Material cadastrado com sucesso"; return 1;}
	else{
		echo "Material nao foi cadastrado com sucesso";
		echo "<br/>" . mysql_error();			
		return 0;
	}
	
}

function exibirarmarioadmin($condicao,$limites){
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	//verificação do número máximo de registros para paginação
	$conexao = mysql_query("SELECT ID,numreg,nome,descricao,preco,sexo,tipo,materiais,camada,posicao,imagemprincipal,imagemcabide,data,combo FROM tb_editorminimi WHERE $condicao ");	
	
	$_SESSION['totalregistros'] = mysql_num_rows($conexao);
	
	//realizando a busca real para exibição dos dados
	$condicoes = $condicao . $limites;
	
	$conexao = mysql_query("SELECT ID,numreg,nome,descricao,preco,sexo,tipo,materiais,camada,posicao,imagemprincipal,imagemcabide,data,combo FROM tb_editorminimi WHERE $condicoes ");

	if($conexao){
		$cont = 0;

		echo "<table width=100%>\n";		
		
	while($row = mysql_fetch_array($conexao)){
		
						
			if($cont == 0){ echo "<tr> \n";  }
					
				if($row['tipo'] == 'manequim'){ $pasta = $row['tipo']. "/" . $row['imagemprincipal'] . ".png" . " width=118 height=122";}
				else{ $pasta = $row['tipo'] . "_cb" . "/" . $row['imagemcabide'] . ".png";}					
								
					echo "<td>";
  					echo "<a href=?pg=". $_SESSION['arquivo'] . "&acao=editar&roupa=". $row['ID'] . ">";
  					echo "<img src=../" . IMG_PATH . "/editor-mini-mi-img/" . $pasta  . ">";
  					echo "</a>";  			
  					echo "<br/>" . $row['nome'] . "</td>\n";
					
				
			
  				if($cont == 3){
  					$cont = 0;
  					echo "</tr>\n";
 				}else{$cont++;}

  		} //endwhile
  		
  		echo "</table> \n";
	
	}
	else{
		echo "Nao foi possível exibir os itens";
		echo "<br/>" . mysql_error();			
	} //endif
}

function exibirroupa($condicao){
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	$conexao = mysql_query("SELECT ID,numreg,nome,descricao,preco,sexo,tipo,materiais,camada,posicao,imagemprincipal,imagemcabide,data,combo,estado FROM tb_editorminimi WHERE ID LIKE $condicao ");

	if($conexao){
		$cont = 0;

		while($row = mysql_fetch_array($conexao)){
				
			$_SESSION['nomeroupa'] = $row['nome'];
			$_SESSION['descricaoroupa'] = $row['descricao'];
			$_SESSION['precoroupa'] = $row['preco'];
			$_SESSION['sexo'] = $row['sexo'];
			$_SESSION['tiporoupa'] = $row['tipo'];
			$_SESSION['combo'] = $row['combo'];
			$_SESSION['camada'] = $row['camada'];
			
			$posicao = explode(",",$row['posicao']);
			$_SESSION['topo'] = $posicao[0];
			$_SESSION['esquerda'] = $posicao[1];

			$_SESSION['imagemprincipal'] = $row['imagemprincipal'];
			$_SESSION['imagemcabide'] = $row['imagemcabide'];
			
			$_SESSION['estado'] = $row['estado'];
					
		} //endwhile
  		
  		
	
	}
	else{
		echo "Nao foi possível exibir os itens";
		echo "<br/>" . mysql_error();			
	} //endif
}

function atualizarroupa($id,$nome,$descricao,$preco,$sexo,$tipo,$combo,$camada,$posicao,$estado){
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	$conexao = mysql_query("UPDATE tb_editorminimi
	SET nome = '$nome',
	descricao = '$descricao',
	preco = '$preco',
	sexo = '$sexo',
	tipo = '$tipo',
	camada = '$camada',
	posicao = '$posicao',
	data = NOW(),
	combo = '$combo',
	estado = '$estado'  WHERE ID = '$id' ");

	if($conexao){ echo "Dados atualizados";}
	else{
		echo "Nao foi possivel atualizar os dados";
		echo "<br/>" . mysql_error();			
	} //endif
}



//*********** Funções do editor, lado do site

function exibirarmario($condicao,$codanumber){//monta o guarda-roupa do editor
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	$conexao = mysql_query("SELECT ID,numreg,nome,descricao,preco,sexo,tipo,materiais,camada,posicao,imagemprincipal,imagemcabide,data,combo,estado FROM tb_editorminimi WHERE $condicao AND estado LIKE 'visivel'ORDER BY preco");

	if($conexao){
		$cont = 0;

		echo "<div class=\"coda-slider-wrapper\">\n" .
							"<div class=\"coda-slider preload\" id=\"coda-slider-" . $codanumber . "\">\n\n" ;
							
		//echo "<div id=\"menu\">"; //abre menu				
				
		
		while($row = mysql_fetch_array($conexao)){

			if($cont == 0){//criando a parte superior do slider
				echo "\n\n<div class=\"panel\">\n" . "<div class=\"panel-wrapper\">\n" .
						"<!------>\n<table id=\"menu\" cellpadding=\"0\" cellspacing=\"0\" width=\"430px\">\n";
				echo "<tr> \n";  
			}//endif
			
			
			
			if($row['tipo'] == 'manequim'){ $pasta = $row['tipo']. "/" . $row['imagemprincipal'] . ".png" . " width=118 height=122";}
			else{ $pasta = $row['tipo'] . "_cb" . "/" . $row['imagemcabide'] . ".png";}//endif					
								
			echo "<td width=\"25%\" height=\"122\" align=\"center\">";
  			echo "<a href=\"?pg=".   $_GET["pg"] . "&passo=" . $_GET['passo'] . "&exibe=". $row['tipo'] . "&roupa=". $row['numreg'] . "&camada=". $row['camada'] . "&posicao=" . $row['posicao'] . "&acao=editar#editor\" id=\"menu\">";
  			echo "<img src=" . IMG_PATH . "/editor-mini-mi-img/" . $pasta  . " title=\"" . $row["nome"] . "\" border=\"0\">";
  			echo "</a>" ;  			
  			//echo "<br/>" . $row['nome'] ; 
  			echo "</td>\n";
		
			if($cont == 3){//fechando a parte inferior do slider
				echo "</tr> \n";
				echo 				"</table>\n<!------>\n" .			
								"</div>\n" .
							"</div>\n" ;
							
				
				$cont = -1;
				$codanumber++;
			}//endif
			
  			$cont++;
  			

  		} //endwhile
  		
  		//quando a tabela não tem as 4 células preenchidas
		if($cont <= 3 && $cont != 0){
			while($cont <= 3){
				echo "<td>&nbsp;</td>\n" ;
				$cont++;
				}//endwhile
				
			echo "</tr> \n";
			echo "</table>\n" . 		
			"</div>\n" . "</div>\n\n" ;
		}  		
  		//echo "</div>"; //fecha menu
		/*echo	"<h2 class=\"title\"></h2>" . */echo "\n\n</div><!-- .coda-slider -->\n" . "</div><!-- .coda-slider-wrapper -->\n\n\n"; 
		  		
  		
  	}else{
		echo "Nao foi possível exibir os itens";
		echo "<br/>" . mysql_error();			
	} //endif
}//exibirarmario - FIM

function caixaregistradora($numreg,$acao){//manipula os valores dos preços dos produtos
	global $conexao;
	
	
	conexaodb(); //acessando a base de dados
	
	$conexao = mysql_query("SELECT numreg,preco,tipo FROM tb_editorminimi WHERE numreg LIKE '$numreg' ");	

	$row = mysql_fetch_array($conexao);
	
	if($acao == 'remove'){ $preco = $row['preco'] - $row['preco'];}
	else{$preco = $row['preco'];}
	
	
	switch($row['tipo']) {
		case 'rosto':
			$_SESSION['preco'][1] = $preco; //preço rosto
			break;
		case 'acessorio':
			$_SESSION['preco'][2] = $preco; //preço acessório
			break;
		case 'superior':
			$_SESSION['preco'][3] = $preco; //preço roupa superior
			break;
		case 'inferior':
			$_SESSION['preco'][4] = $preco; //preço roupa inferior
			break;
		case 'inteiro':
			$_SESSION['preco'][5] = $preco; //preço roupa inteira
			break;
		case 'especial':
			$_SESSION['preco'][6] = $preco; //preço roupa especial
			break;
		case 'manequim':
			$_SESSION['preco'][7] = $preco; //preço manequim
			break;
		case 'bordado':
			$_SESSION['preco'][8] = $preco; //preço bordado
			break;
		}//end switch
		
		$_SESSION['precofinal'] =	$_SESSION['preco'][0] + $_SESSION['preco'][1] + $_SESSION['preco'][2] + $_SESSION['preco'][3] + $_SESSION['preco'][4] +	$_SESSION['preco'][5] + $_SESSION['preco'][6] + $_SESSION['preco'][7] + $_SESSION['preco'][8];

		 

}//manipula os valores dos preços dos produtos - FIM

function pegaarmario($condicoes,$objeto){//localiza roupas específicas para o editor
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	$conexao = mysql_query("SELECT  numreg,nome,descricao,preco,sexo,tipo,materiais,camada,posicao,imagemprincipal,imagemcabide,combo,estado FROM tb_editorminimi WHERE $condicoes ");	
	
	
	while($row = mysql_fetch_array($conexao)){
		return $row[$objeto];
			
			
	}//end while
}

function mostraopcoes($numreg,$exibe){//Mostra detalhes das opções escolhidas pelo usuário
	global $conexao;
	
	conexaodb(); //acessando a base de dados
	
	$conexao = mysql_query("SELECT numreg,nome,descricao,preco,sexo,tipo,materiais,camada,posicao,imagemprincipal,imagemcabide,combo,estado FROM tb_editorminimi WHERE numreg LIKE '$numreg' ");	
	
	
	while($row = mysql_fetch_array($conexao)){
		if($row['preco'] == "0"){ $preco = "inclu&iacute;do" ;}
		else{$preco = "R$" . $row['preco']; /*$_SESSION['preco'] = $_SESSION['preco'] + $row['preco'];*/}
				
		//if(isset($_GET['roupa'])){//usuário escolhendo roupas
			$url = "?pg=". $_GET['pg'] ."&passo=". $_GET['passo'] ."&exibe=". $exibe . "&roupa=". $row['numreg'] ."&camada=". $row['camada'] ."&posicao=". $row['posicao'];		
		
		if(isset($_SESSION[$exibe][2]) && $_SESSION[$exibe][2] != "" && $row['tipo'] == $exibe){$url = $url . "&tecido=" . $_SESSION[$exibe][2]; }//já foi escolhido tecido
		elseif(isset($_GET['tecido']) && $row['tipo'] == $exibe){$url = $url . "&tecido=" . $_GET['tecido']; }
		
		//}//usuário escolhendo roupas - FIM
		/*elseif(!isset($_GET['roupa'])){//usuário navegando entre seções
			$urlatual = "?pg=". $_GET['pg'] ."&passo=". $_GET['passo'] ."&exibe=". $exibe . "&roupa=" . $_SESSION[$exibe][0];
		}//usuário navegando entre seções - FIM
			*/	
		
		//link para remover a opção escolhida
		if($exibe != 'manequim'){//manequim não pode ser removido
			echo "<div id=\"remover\">\n" . 
		"<a href=\"" . $url . "&acao=remover&remover=" . $row['tipo'] ."#editor\">" . "remover" . "</a>" .
		 "\n</div>\n\n";
		 }//manequim não pode ser removido - FIM
		 
		if($row['tipo'] == 'manequim'){//selecionando manequim diferente 
				//$pasta = $row['tipo']. "/" . $row['imagemprincipal'] . ".png" . " width=118 height=122";
				echo "<center><img src=\"". IMG_PATH . "/editor-mini-mi-img/". $row['tipo'] . "/" . $row['imagemprincipal'] . ".png\" title=\"". $row['nome'] ."\" width=118 height=122></center>";
		}else {
				echo "<center><img src=\"". IMG_PATH . "/editor-mini-mi-img/". $row['tipo'] . "_cb/" . $row['imagemcabide'] . ".png\" title=\"". $row['nome'] ."\"></center>";
		}//selecionando manequim diferente - FIM

		echo "\n\n";
				
		
		echo "<table>\n";

		echo "<tr>\n";
		echo "<td><strong>Nome</strong></td>\n";
		echo "<td>" . $row['nome'] . "</td>\n";
		echo "</tr>\n";		
		
		echo "<tr>\n";
		echo "<td><strong>Descri&ccedil;&atilde;o</strong></td>\n";
		echo "<td>" . $row['descricao'] . "</td>\n";
		echo "</tr>\n";		

		echo "<tr>\n";
		echo "<td><strong>Pre&ccedil;o</strong></td>\n";
		if($exibe == 'especial' ){echo "<td>a partir de&nbsp;" . $preco . "</td>\n";}
		else{	echo "<td>" . $preco . "</td>\n";}
		echo "</tr>\n";		

		echo "</table>\n\n";
		echo "<a name=\"opcoes\"></a>\n";
		if($row['combo'] == 1){$_SESSION['liberado'][7] = 1;}
		elseif($row['combo'] == 0){$_SESSION['liberado'][7] = 0;}
		//tecidos escolhidos
		if(isset($_GET['exibe']) && $_GET['exibe'] == $exibe && $exibe != 'especial'){
			if(count(explode(",",$row['materiais'])) == 2){//só existe um tipo de tecido
				echo "<p>Tecido escolhido</p>\n";
				$tecidoescolhido = explode(",",$row['materiais']);		
				$_SESSION[$exibe][2] = monotecido($tecidoescolhido[0],'id','return');
				echo "<br/>";
			}
			elseif(isset($_GET['tecido']) && $_GET['exibe'] == $exibe && $row['combo'] == 0){//usuário escolhendo os tecidos
				echo "<p>Tecido escolhido</p>\n";		
				$_SESSION[$exibe][2] = $_GET['tecido'];
				monotecido($_SESSION[$exibe][2],'numreg','');
			}
			elseif(isset($_SESSION[$exibe][2]) && $_SESSION[$exibe][2] != "" && !isset($_GET['tecido']) && $row['combo'] == 0 && !isset($_GET['pagina'])){//usuário já escolheu os tecidos
				echo "<p>Tecido escolhido</p>\n";
				monotecido($_SESSION[$exibe][2],'numreg','');
			}
			elseif($row['combo'] == 1 && $_GET['exibe'] == $exibe){//roupas com mais de um tecido
				if(isset($_GET['tecido']) && !isset($_GET['tecido2'])){//selecionando o primeiro tecido			
					$tecidoscombo = explode("#",$_SESSION[$exibe][2]);				
								
					if(!isset($tecidoscombo[1])){$_SESSION[$exibe][2] = $_GET['tecido'];}
					else{$_SESSION[$exibe][2] = $_GET['tecido'] . "#" . $tecidoscombo[1];}
				
				}//selecionando o primeiro tecido - FIM
				elseif(isset($_GET['tecido']) && isset($_GET['tecido2'])){//selecionando o segundo tecido
				$_SESSION[$exibe][2] = $_GET['tecido'] . "#" . $_GET['tecido2'];
				}//selecionando o segundo tecido - FIM
				
				$tecidoscombo = explode("#",$_SESSION[$exibe][2]);
			
				if($_SESSION[$exibe][2] != ""){
					
					echo "<p>Tecidos escolhidos</p>\n";					
					echo "<table>\n<tr>\n";
					if(isset($tecidoscombo[0]) && $tecidoscombo[0] != ''){echo "<td>" . monotecido($tecidoscombo[0],'numreg','') ."</td>\n";} 
					if(isset($tecidoscombo[1])){echo "<td>" . monotecido($tecidoscombo[1],'numreg','') ."</td>\n";}
					echo "</tr>\n</table>\n";
				}
			}
			
			
		}elseif(isset($_GET['exibe']) && $_GET['exibe'] != $exibe){
						
			if(isset($_SESSION[$exibe][2]) && $_SESSION[$exibe][2] != "" && $row['combo'] == 1){
				$tecidoscombo = explode("#",$_SESSION[$exibe][2]);
				echo "<p style=\"margintop:20px;\">Tecidos escolhidos</p>\n";					
				echo "<table>\n<tr>\n";
				if(isset($tecidoscombo[0]) && $tecidoscombo[0] != ''){echo "<td>" . monotecido($tecidoscombo[0],'numreg','') ."</td>\n";} 
				if(isset($tecidoscombo[1])){echo "<td>" . monotecido($tecidoscombo[1],'numreg','') ."</td>\n";}
				echo "</tr>\n</table>\n";
			}
			elseif($exibe != 'especial' && $_SESSION[$exibe][2]!= ""){
				echo "<p style=\"margintop:20px;\">Tecido escolhido</p>\n";
				monotecido($_SESSION[$exibe][2],'numreg','');
			}
		}
		
			
		
			
		//endif
		//tecidos escolhidos - FIM
		
		if($exibe == 'especial' ){//apenas para fantasias
			if(isset($_POST['botaoespecial'])){$_SESSION['especial'][2] = vacinadebase($_POST['especial']); }
			elseif(!isset($_SESSION['especial'][2])){$_SESSION['especial'][2] = ""; }			
			
			echo "<form action=\"".$url . "&acao=editar#opcoes\" method=\"post\">\n";
			echo "<textarea rows=\"300\" cols=\"20\" name=\"especial\">".$_SESSION['especial'][2]."</textarea>\n";
			
			if($_SESSION['especial'][2] == ""){//botão gravar/atualizar			
			echo "<input id=\"botao\" type=\"submit\" value=\"gravar descri&ccedil;&atilde;o\" name=\"botaoespecial\">\n";
			}
			else{
				echo "<input id=\"botao\" type=\"submit\" value=\"atualizar descri&ccedil;&atilde;o\" name=\"botaoespecial\">\n";
			}//botão gravar/atualizar - FIM
			echo "</form>\n";
			
		}
		
		else{//todos os demais
		
			echo "<p style=\"margin-top:20px;\">Tecidos dispon&iacute;veis</p>\n";
						
			tecidosdisplay($row['materiais'],$exibe,'',$url) ;
			
			if($row['combo'] == 1 && $_GET['exibe'] == $exibe && isset($_GET['tecido'])){//tecidos com mais de umar cor
				echo "<p style=\"margin-top:20px;\">Tecidos dispon&iacute;veis para segunda cor</p>\n";
					
				tecidosdisplay($row['materiais'],$exibe,'combo',$url) ;
				
			}//tecidos com mais de uma cor - FIM
		}//todos os demais - FIM

		
		
		//echo "\n</div>\n"; //fechando div
			
	}//end while
	
} //mostraopcoes - FIM


function montamanequim(){ //função para montagem do mini-mi

	if(!isset($_GET['acao'])){//primeira visita
		
		//escolhendo o manequim padrão de acordo com o sexo
		switch($_SESSION['sexo']) {
			case "masculino":
				$busca = "tipo LIKE 'manequim' AND sexo LIKE 'masculino' AND preco LIKE '0'";
				break;
			case "feminino":
				$busca = "tipo LIKE 'manequim' AND sexo LIKE 'feminino' AND preco LIKE '0'";
				break;
		}


			$_SESSION['manequim'] = array();

			$_SESSION['manequim'][0] = pegaarmario($busca,'numreg');
			$_SESSION['manequim'][2] = "";
			 
			$_SESSION['manequim'][1] = "<img id=\"manequim\" src=" . IMG_PATH ."editor-mini-mi-img/manequim/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png >";

		//$_SESSION['manequim'] = "<img src=" . IMG_PATH ."editor-mini-mi-img/manequim/" . pegaarmario($busca) . ".png style=position:absolute;z-index:1;>";

		
		
		//Setando sessões para roupas e acessórios (para evitar warning)
		$_SESSION['rosto'] = array();
		$_SESSION['acessorio'] = array();
		$_SESSION['superior'] = array();
		$_SESSION['inferior'] = array();
		$_SESSION['inteiro'] = array();
		$_SESSION['especial'] = array();
		$_SESSION['preco'] = array();		

		//Criando os IDs
		$_SESSION['rosto'][0] = "";
		$_SESSION['acessorio'][0] = "";
		$_SESSION['superior'][0] = "";
		$_SESSION['inferior'][0] = "";
		$_SESSION['inteiro'][0] = "";
		$_SESSION['especial'][0] = "";
		
		//Criando as Imagens
		$_SESSION['rosto'][1] = "";
		$_SESSION['acessorio'][1] = "";
		$_SESSION['superior'][1] = "";
		$_SESSION['inferior'][1] = "";
		$_SESSION['inteiro'][1] = "";
		$_SESSION['especial'][1] = "";	

		//Criando os Tecidos
		$_SESSION['rosto'][2] = "";
		$_SESSION['acessorio'][2] = "";
		$_SESSION['superior'][2] = "";
		$_SESSION['inferior'][2] = "";
		$_SESSION['inteiro'][2] = "";
		$_SESSION['especial'][2] = "";
		
		$_SESSION['preco'][0] = 103; //preço base
		$_SESSION['preco'][1] = 0; //preço rosto
		$_SESSION['preco'][2] = 0; //preço acessório
		$_SESSION['preco'][3] = 0; //preço roupa superior
		$_SESSION['preco'][4] = 0; //preço roupa inferior
		$_SESSION['preco'][5] = 0; //preço roupa inteira
		$_SESSION['preco'][6] = 0; //preço roupa especial
		$_SESSION['preco'][7] = 0; //preço do manequim
		$_SESSION['preco'][8] = 0; //preço bordado
		
		$_SESSION['precofinal'] =	$_SESSION['preco'][0] + $_SESSION['preco'][1] + $_SESSION['preco'][2] + $_SESSION['preco'][3] + $_SESSION['preco'][4] +	$_SESSION['preco'][5] + $_SESSION['preco'][6] + $_SESSION['preco'][7]; 
		
		return $_SESSION['manequim'][1];	
		
	}//primeira visita - FIM
	
	//###################	
	
	elseif($_GET['acao'] == 'limpar'){//limpando todo editor 
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
		
		//escolhendo o manequim padrão de acordo com o sexo
		switch($_SESSION['sexo']) {
			case "masculino":
				$busca = "tipo LIKE 'manequim' AND sexo LIKE 'masculino' AND preco LIKE '0'";
				break;
			case "feminino":
				$busca = "tipo LIKE 'manequim' AND sexo LIKE 'feminino' AND preco LIKE '0'";
				break;
		}//endswitch

		$_SESSION['manequim'] = array();
			
			$_SESSION['manequim'][0] = pegaarmario($busca,'numreg');
			$_SESSION['manequim'][2] = "";
			$_SESSION['manequim'][1] = "<img id=\"manequim\" src=" . IMG_PATH ."editor-mini-mi-img/manequim/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png >";

			
		
		//Setando sessões para roupas e acessórios (para evitar warning)
		//Setando sessões para roupas e acessórios (para evitar warning)
		$_SESSION['rosto'] = array();
		$_SESSION['acessorio'] = array();
		$_SESSION['superior'] = array();
		$_SESSION['inferior'] = array();
		$_SESSION['inteiro'] = array();
		$_SESSION['especial'] = array();	
		$_SESSION['preco'] = array();	

			//Criando os IDs
		$_SESSION['rosto'][0] = "";
		$_SESSION['acessorio'][0] = "";
		$_SESSION['superior'][0] = "";
		$_SESSION['inferior'][0] = "";
		$_SESSION['inteiro'][0] = "";
		$_SESSION['especial'][0] = "";
		
		//Criando as Imagens
		$_SESSION['rosto'][1] = "";
		$_SESSION['acessorio'][1] = "";
		$_SESSION['superior'][1] = "";
		$_SESSION['inferior'][1] = "";
		$_SESSION['inteiro'][1] = "";
		$_SESSION['especial'][1] = "";	

		//Criando os Tecidos
		$_SESSION['rosto'][2] = "";
		$_SESSION['acessorio'][2] = "";
		$_SESSION['superior'][2] = "";
		$_SESSION['inferior'][2] = "";
		$_SESSION['inteiro'][2] = "";
		$_SESSION['especial'][2] = "";
		
		$_SESSION['preco'][0] = 103; //preço base
		$_SESSION['preco'][1] = 0; //preço rosto
		$_SESSION['preco'][2] = 0; //preço acessório
		$_SESSION['preco'][3] = 0; //preço roupa superior
		$_SESSION['preco'][4] = 0; //preço roupa inferior
		$_SESSION['preco'][5] = 0; //preço roupa inteira
		$_SESSION['preco'][6] = 0; //preço roupa especial
		$_SESSION['preco'][7] = 0; //preço do manequim
		$_SESSION['preco'][8] = 0; //preço bordado
		
		$_SESSION['precofinal'] =	$_SESSION['preco'][0] + $_SESSION['preco'][1] + $_SESSION['preco'][2] + $_SESSION['preco'][3] + $_SESSION['preco'][4] +	$_SESSION['preco'][5] + $_SESSION['preco'][6] + $_SESSION['preco'][7];
				
		return $_SESSION['manequim'][1];
	
		
	}//limpar todo editor - FIM	
	
	//###################

	elseif($_GET['acao'] == 'remover'){//remover opção específica
	
		$sessoaremovida = $_GET['remover'];	
	
		//caixaregistradora($_SESSION[$sessoaremovida][0],'remove'); //removendo o valor da opção	
	
				
		$_SESSION[$sessoaremovida] = NULL;	
		unset($_SESSION[$sessoaremovida]);
		
		$_SESSION[$sessoaremovida] = array();
		$_SESSION[$sessoaremovida][0] = "";
		$_SESSION[$sessoaremovida][1] = "";	
		$_SESSION[$sessoaremovida][2] = "";
		
		if($_GET['remover'] == 'manequim'){//removendo manequim e colocando o padrão no lugar		
			//escolhendo o manequim padrão de acordo com o sexo
			switch($_SESSION['sexo']) {
				case "masculino":
					$busca = "tipo LIKE 'manequim' AND sexo LIKE 'masculino' AND preco LIKE '0'";
					break;
				case "feminino":
					$busca = "tipo LIKE 'manequim' AND sexo LIKE 'feminino' AND preco LIKE '0'";
					break;
			}//endswitch

			$_SESSION['manequim'] = array();
			
				$_SESSION['manequim'][0] = "";
			 
				$_SESSION['manequim'][1] = "<img id=\"manequim\" src=" . IMG_PATH ."editor-mini-mi-img/manequim/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png >";		
		}//removendo manequim e colocando o padrão no lugar - FIM
		
		return $_SESSION['manequim'][1] . "\n" . $_SESSION['rosto'][1] . "\n" . $_SESSION['acessorio'][1] . "\n" . $_SESSION['superior'][1] . "\n" . $_SESSION['inferior'][1] . "\n" . $_SESSION['inteiro'][1] . "\n" . $_SESSION['especial'][1] 
. "\n" ;
	
	}//remover opção específica - FIM
	
	//###################
	
	elseif($_GET['acao'] == 'editar'){//escolhendo roupas
			
		//escolha de corpo
		if($_GET['exibe'] == 'manequim' && isset($_GET['roupa'])){
			$busca = "numreg LIKE '". $_GET['roupa'] ."'";
			
			$_SESSION['manequim'] = array();
			
			$_SESSION['manequim'][0] = $_GET['roupa'];
			 
			$_SESSION['manequim'][1] = "<img id=\"manequim\" src=" . IMG_PATH ."editor-mini-mi-img/manequim/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png >";
			
			//return $_SESSION['manequim'][1];	
			
		}
		//escolha de corpo - FIM
				
		//escolha de rosto
		if($_GET['exibe'] == 'rosto' && isset($_GET['roupa'])){
			$busca = "numreg LIKE '". $_GET['roupa'] ."'";
			
			$posicao = $_GET['posicao'];
	
			$posicao = explode(",",$posicao);
	
			$topo = $posicao[0];
			$esquerda = $posicao[1];	
			
			$_SESSION['rosto'] = array();	
			
			$_SESSION['rosto'][0] = $_GET['roupa'];	
								
			$_SESSION['rosto'][1] = "<img src=" . IMG_PATH ."editor-mini-mi-img/". $_GET['exibe'] . "/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png style=position:absolute;top:". $topo .";left:" . $esquerda . ";z-index:". $_GET['camada'] .";>";	
		
			//return $_SESSION['rosto'][1];
		}		
		//escolha de rosto - FIM
		
		//escolha de acessorio
		if($_GET['exibe'] == 'acessorio' && isset($_GET['roupa'])){
			$busca = "numreg LIKE '". $_GET['roupa'] ."'";
			
			$posicao = $_GET['posicao'];
	
			$posicao = explode(",",$posicao);
	
			$topo = $posicao[0];
			$esquerda = $posicao[1];			

			$_SESSION['acessorio'] = array();
			
			$_SESSION['acessorio'][0] = $_GET['roupa'];
								
			$_SESSION['acessorio'][1] = "<img src=" . IMG_PATH ."editor-mini-mi-img/". $_GET['exibe'] . "/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png style=position:absolute;top:". $topo .";left:" . $esquerda . ";z-index:". $_GET['camada'] .";>";	
		
			$_SESSION['acessorio'][2] = "";
			//return $_SESSION['acessorio'][1];
		}
		//escolha de acessorio - FIM

		//escolha de superior
		if($_GET['exibe'] == 'superior' && isset($_GET['roupa'])){
			$busca = "numreg LIKE '". $_GET['roupa'] ."'";
			
			$posicao = $_GET['posicao'];
	
			$posicao = explode(",",$posicao);
	
			$topo = $posicao[0];
			$esquerda = $posicao[1];			

			$_SESSION['superior'] = array();
			
			$_SESSION['superior'][0] = $_GET['roupa'];
								
			$_SESSION['superior'][1] = "<img src=" . IMG_PATH ."editor-mini-mi-img/". $_GET['exibe'] . "/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png style=position:absolute;top:". $topo .";left:" . $esquerda . ";z-index:". $_GET['camada'] .";>";	
			
			$_SESSION['superior'][2] = "";
			//return $_SESSION['superior'][1];
		}		
		//escolha de superior - FIM

		//escolha de inferior
		if($_GET['exibe'] == 'inferior' && isset($_GET['roupa'])){
			$busca = "numreg LIKE '". $_GET['roupa'] ."'";
			
			$posicao = $_GET['posicao'];
	
			$posicao = explode(",",$posicao);
	
			$topo = $posicao[0];
			$esquerda = $posicao[1];			

			$_SESSION['inferior'] = array();
			
			$_SESSION['inferior'][0] = $_GET['roupa'];
								
			$_SESSION['inferior'][1] = "<img src=" . IMG_PATH ."editor-mini-mi-img/". $_GET['exibe'] . "/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png style=position:absolute;top:". $topo .";left:" . $esquerda . ";z-index:". $_GET['camada'] .";>";	
		
			$_SESSION['inferior'][2] = "";
			//return $_SESSION['inferior'][1];
		}		
		//escolha de inferior - FIM
		
		//escolha de inteiro
		if($_GET['exibe'] == 'inteiro' && isset($_GET['roupa'])){
			$busca = "numreg LIKE '". $_GET['roupa'] ."'";
			
			$posicao = $_GET['posicao'];
	
			$posicao = explode(",",$posicao);
	
			$topo = $posicao[0];
			$esquerda = $posicao[1];			

			$_SESSION['inteiro'] = array();
			
			$_SESSION['inteiro'][0] = $_GET['roupa'];
								
			$_SESSION['inteiro'][1] = "<img src=" . IMG_PATH ."editor-mini-mi-img/". $_GET['exibe'] . "/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png style=position:absolute;top:". $topo .";left:" . $esquerda . ";z-index:". $_GET['camada'] .";>";	
		
			$_SESSION['inteiro'][2] = "";
			//return $_SESSION['inteiro'][1];
		}		
		//escolha de inteiro - FIM
		
		//escolha de especial
		if($_GET['exibe'] == 'especial' && isset($_GET['roupa'])){
			$busca = "numreg LIKE '". $_GET['roupa'] ."'";
			
			$posicao = $_GET['posicao'];
	
			$posicao = explode(",",$posicao);
	
			$topo = $posicao[0];
			$esquerda = $posicao[1];			

			$_SESSION['especial'] = array();
			
			$_SESSION['especial'][0] = $_GET['roupa'];
			
			$_SESSION['especial'][1] = "<img src=" . IMG_PATH ."editor-mini-mi-img/". $_GET['exibe'] . "/" . leconteudo(pegaarmario($busca,'imagemprincipal')) . ".png style=position:absolute;top:". $topo .";left:" . $esquerda . ";z-index:". $_GET['camada'] .";>";	
			
			//if(!isset($_SESSION['especial'][2])){$_SESSION['especial'][2] = "";}
		
			//return $_SESSION['especial'][1];
		}		
		//escolha de especial - FIM
		
		if($_SESSION['inteiro'][1] != ""){//ropa inteira foi escolhida
		
		//remoção das roupas separadas - INÍCIO	
		$_SESSION['superior'] = NULL;	
		unset($_SESSION['superior']);

		$_SESSION['inferior'] = NULL;	
		unset($_SESSION['inferior']);
		
		$_SESSION['preco'][3] = 0; //preço roupa superior
		$_SESSION['preco'][4] = 0; //preço roupa inferior
		
		$_SESSION['superior'] = array();
		$_SESSION['superior'][0] = "";
		$_SESSION['superior'][1] = "";	
		$_SESSION['superior'][2] = "";

		$_SESSION['inferior'] = array();
		$_SESSION['inferior'][0] = "";
		$_SESSION['inferior'][1] = "";	
		$_SESSION['inferior'][2] = "";
		//remoção das roupas separadas - FIM	
		
		
			return $_SESSION['manequim'][1] . "\n" . $_SESSION['rosto'][1] . "\n" . $_SESSION['acessorio'][1] . "\n" . $_SESSION['inteiro'][1] . "\n";		
		}
		else{
			return $_SESSION['manequim'][1] . "\n" . $_SESSION['rosto'][1] . "\n" . $_SESSION['acessorio'][1] . "\n" . $_SESSION['superior'][1] . "\n" . $_SESSION['inferior'][1] . "\n";
		}//end if
			
		
		 	
	}//escolhendo roupas - FIM

	//###################
	

}//montamanequim -FIM
//apelido,sexo,numpedido,manequim,tecidomanequim,rosto,bordadorosto,acessorio,tecidoacessorio,superior,tecidosuperior1,tecidosuperior2
//inferior,tecidoinferior,inteiro,tecidointeiro1,tecidointeiro2,cabelo,tecidocabelo,especial,dadoespecial
//descricaobordado,detalhespessoa,foto1,foto2,foto3,estado,data
function criaminimi(){//cria pedido de mini-mi
	global $conexao;
	
	//transferindo variáveis (para aumenta a leiturabilidade do código)
	
	$apelido = $_SESSION['apelido'];
	$sexo = $_SESSION['sexo'];
	
	$numpedido =  $_SESSION['usuariodados'][9];

	$manequim = $_SESSION['manequim'][0];
	$tecidomanequim = $_SESSION['manequim'][2];

	$rosto = $_SESSION['rosto'][0];
	$bordadorosto = $_SESSION['rosto'][2];

	$acessorio = $_SESSION['acessorio'][0];
	$tecidoacessorio = $_SESSION['acessorio'][2];

	$superior = $_SESSION['superior'][0];
	$tecidossuperior = explode("#",$_SESSION['superior'][2]);
	if(isset($tecidossuperior[0])){$tecidosuperior1 = $tecidossuperior[0];}else{$tecidosuperior1 = "";}
	if(isset($tecidossuperior[1])){$tecidosuperior2 = $tecidossuperior[1];}else{$tecidosuperior2 = "";}

	$inferior = $_SESSION['inferior'][0];
	$tecidoinferior = $_SESSION['inferior'][2];

	$inteiro = $_SESSION['inteiro'][0] ;
	$tecidointeiro = explode("#",$_SESSION['inteiro'][2]);
	if(isset($tecidointeiro[0])){$tecidointeiro1 = $tecidointeiro[0];}else{$tecidointeiro1 = "";}
	if(isset($tecidointeiro[1])){$tecidointeiro2 = $tecidointeiro[1];}else{$tecidointeiro2 = "";}

	$cabelo = $_SESSION['cabelo'][0];
	$tecidocabelo = $_SESSION['cabelo'][2];

	$especial =  $_SESSION['especial'][0];
	$dadoespecial = $_SESSION['especial'][2];

	if(isset($_SESSION['bordado'])){$descricaobordado = $_SESSION['bordado'];}else{$descricaobordado = "";}
	if(isset($_SESSION['detalhespessoa'])){$detalhespessoa = $_SESSION['detalhespessoa'];}else{$detalhespessoa = "";}

	$imagens = explode(" ",ltrim(str_replace("#"," ",$_SESSION['usuariodados'][8])));
	if(isset($imagens[0])){$foto1 = $imagens[0];}else{$foto1 = "";}
	if(isset($imagens[1])){$foto2 = $imagens[1];}else{$foto2 = "";}
	if(isset($imagens[2])){$foto3 = $imagens[2];}else{$foto3 = "";}

	$preco = $_SESSION['precofinal'];
	
	$estado = "criado";
	

	//gravando dados
	$conexao = mysql_query("INSERT INTO tb_pedidosminimi
	 (apelido,sexo,numpedido,manequim,tecidomanequim,rosto,bordadorosto,acessorio,tecidoacessorio,superior,tecidosuperior1,tecidosuperior2,inferior,tecidoinferior,inteiro,tecidointeiro1,tecidointeiro2,cabelo,tecidocabelo,especial,dadoespecial,descricaobordado,detalhespessoa,foto1,foto2,foto3,preco,estado,data)
	 VALUES ('$apelido','$sexo','$numpedido','$manequim','$tecidomanequim','$rosto','$bordadorosto','$acessorio','$tecidoacessorio','$superior','$tecidosuperior1','$tecidosuperior2','$inferior','$tecidoinferior','$inteiro','$tecidointeiro1','$tecidointeiro2','$cabelo','$tecidocabelo','$especial','$dadoespecial','$descricaobordado','$detalhespessoa','$foto1','$foto2','$foto3','$preco','$estado',NOW())");

	if($conexao){return 1;}
	else{
		echo "Material nao foi cadastrado com sucesso";
		echo "<br/>" . mysql_error();			
		return 0;
	}

}

function mostrapedidos($numpedido,$modo){//mostra os bonecos selecionados pelo usuário
	global $conexao;

	$conexao = mysql_query("SELECT * FROM tb_pedidosminimi WHERE numpedido LIKE '$numpedido'");

	while($row = mysql_fetch_array($conexao)){
		
	echo "<div id=\"pedido\"  > \n";
	
	
	echo "<div style=\"width:240;float:left;\">";
	buscaimg($row['manequim'],'armario');
	echo "</div>";
		
	buscaimg($row['rosto'],'armario');
	buscaimg($row['acessorio'],'armario');
	buscaimg($row['superior'],'armario');
	buscaimg($row['inferior'],'armario');
	buscaimg($row['inteiro'],'armario');
	
	if($modo == 'resumo'){ //exibe o conteúdo de forma resumida
		echo "\n\n<div id=\"detalhespedido\">\n";
			if($_SESSION['usuariodados'][6] > 1){
				echo "<span style=\"float:right;\"><a href=\"?pg=" . $_GET['pg'] . "&passo=" . $_GET['passo'] . "&acao=remover&item=". $row['id']."\">remover</a></span>";
			}
		
			echo "<p><strong>Apelido:</strong>&nbsp;" . $row['apelido'] . "</p>";
			echo "<p><strong>Sexo:</strong>&nbsp;" . $row['sexo'] . "</p>";	
		
			if($row['dadoespecial'] != ""){//descrição da fantasia
				echo "<p><strong>Descri&ccedil;&atilde;o da roupa especial:</strong>&nbsp;" . $row['dadoespecial'] . "</p>";
			}//descrição da fantasia - FIM
		
			if($row['descricaobordado'] != ""){//descrição da fantasia
				echo "<p><strong>Descri&ccedil;&atilde;o ou texto para o bordado:</strong>&nbsp;" . $row['descricaobordado'] . "</p>";
			}//descricao bordado -fim
		
			if($row['detalhespessoa'] != ""){//detalhes da pessoa
				echo "<p><strong>Detalhes do big-mi:</strong>&nbsp;" . $row['detalhespessoa'] . "</p>";	
			}//detalhes da pessoa - fim
	
			echo "<p><strong>Ado&ccedil;&atilde;o do mini-mi:</strong>&nbsp;R$" . $row['preco'] . "</p>";	
			echo "<p><strong>Tecidos escolhidos</strong></p>\n";
			echo "<table id=\"premontagem\" width=\"250\" style=\"text-align:center;\" >\n";

				echo "<tr>\n";
					echo "<td>\n";
						echo "<p><strong>item</strong></p>";
					echo "</td>\n";
					echo "<td>\n";
						echo "<p><strong>tecido/bordado</strong></p>";
					echo "</td>\n";
				echo "</tr>\n";

	
				echo "<tr>\n";
					echo "<td>\n";
						echo "<p >" .buscainfo($row['manequim'],'armario')."</p>";
					echo "</td>\n";
					echo "<td>\n";
						buscaimg($row['tecidomanequim'],'tecido');
					echo "</td>\n";
				echo "</tr>\n";
			
				echo "<tr>\n";
					echo "<td>\n";
						echo "<p>" .buscainfo($row['rosto'],'armario')."</p>";
					echo "</td>\n";
					echo "<td>\n";
						buscaimg($row['bordadorosto'],'tecido');
					echo "</td>\n";
				echo "</tr>\n";
			
				echo "<tr>\n";
					echo "<td>\n";
						echo "<p>" .buscainfo($row['cabelo'],'armario')."</p>";
					echo "</td>\n";
					echo "<td>\n";
						buscaimg($row['tecidocabelo'],'tecido');
					echo "</td>\n";
				echo "</tr>\n";
			
				if(buscainfo($row['acessorio'],'armario') != ""){//acessorio
					echo "<tr>\n";
						echo "<td>\n";
							echo "<p>" .buscainfo($row['acessorio'],'armario')."</p>";
						echo "</td>\n";
						echo "<td>\n";
							buscaimg($row['tecidoacessorio'],'tecido');
						echo "</td>\n";
					echo "</tr>\n";
				}//acessorio -fim
			
				if(buscainfo($row['superior'],'armario') != ""){//superior
					echo "<tr>\n";	
						echo "<td>\n";
							echo "<p>" .buscainfo($row['superior'],'armario')."</p>";
						echo "</td>\n";
						echo "<td>\n";
							buscaimg($row['tecidosuperior1'],'tecido');
							buscaimg($row['tecidosuperior2'],'tecido');
						echo "</td>\n";
					echo "</tr>\n";
				}//superior -fim
			
				if(buscainfo($row['inferior'],'armario') != ""){//inferior
					echo "<tr>\n";
						echo "<td>\n";
							echo "<p>" .buscainfo($row['inferior'],'armario')."</p>";
						echo "</td>\n";
						echo "<td>\n";
							buscaimg($row['tecidoinferior'],'tecido');
						echo "</td>\n";
					echo "</tr>\n";	
				}//inferior -fim
			
				if(buscainfo($row['inteiro'],'armario') != ""){//inteiro
					echo "<tr>\n";
						echo "<td>\n";
							echo "<p>" .buscainfo($row['inteiro'],'armario')."</p>";
						echo "</td>\n";
						echo "<td>\n";
							buscaimg($row['tecidointeiro1'],'tecido');
							buscaimg($row['tecidointeiro2'],'tecido');
						echo "</td>\n";
					echo "</tr>\n";
				}//inteiro -fim
		
		
			
			echo "</table>\n";	
	
		echo "</div>\n\n";
	
		echo "</div>\n\n";
	}elseif($modo =='completo'){//exibe o conteúdo completo, com roupas separadas e tudo mais
		
		echo "<div style=\"width:100%;\">\n";

			//echo "Detalhes do pedido\n";
			echo "<table border=\"0\">\n";
				echo "<tr>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>manequim</strong></td>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>rosto</strong></td>\n";
					echo "<td style=\"padding:10px;text-align:center;\"><strong>cabelos</strong></td>\n";

					if($row['superior'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\"><strong>roupa superior</strong></td>\n";
					}

					if($row['inferior'] != ""){					
						echo "<td style=\"padding:10px;text-align:center;\"><strong>roupa inferior</strong></td>\n";
					}
					
					if($row['acessorio'] != ""){					
						echo "<td style=\"padding:10px;text-align:center;\"><strong>acess&oacute;rio</strong></td>\n";
					}//endif

					if($row['inteiro'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\"><strong>conjunto</strong></td>\n";
					}//endif
				echo "</tr>\n";
			
				echo "<tr>\n";
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimg($row['manequim'],'cabide');
					echo "</td>\n";
				
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimg($row['rosto'],'cabide');
					echo "</td>\n";

					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimg($row['cabelo'],'cabide');
					echo "</td>\n";

					if($row['superior'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['superior'],'cabide');
						echo "</td>\n";
					}

					if($row['inferior'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['inferior'],'cabide');
						echo "</td>\n";
					}
					
					if($row['acessorio'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['acessorio'],'cabide');
						echo "</td>\n";
					}//endif
					
					if($row['inteiro'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['inteiro'],'cabide');
						echo "</td>\n";
					}//endif*/
				echo "</tr>\n";
			
				echo "<tr>\n";
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimg($row['tecidomanequim'],'tecido');
					echo "</td>\n";
				
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						buscaimg($row['bordadorosto'],'tecido');
					echo "</td>\n";
					
					echo "<td style=\"padding:10px;text-align:center;\">\n";
						if($row['tecidocabelo'] == 'careca'){echo $row['tecidocabelo'];}
						else{buscaimg($row['tecidocabelo'],'tecido');}
					echo "</td>\n";

					if($row['superior'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['tecidosuperior1'],'tecido');
						
							if($row['tecidosuperior2'] != ""){	
								echo "\n<br>\n";
								buscaimg($row['tecidosuperior2'],'tecido');
							}//endif
						echo "</td>\n";
					}

					if($row['inferior'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['tecidoinferior'],'tecido');
						echo "</td>\n";
					}

					if($row['acessorio'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['tecidoacessorio'],'tecido');
						echo "</td>\n";
					}//endif

					if($row['inteiro'] != ""){
						echo "<td style=\"padding:10px;text-align:center;\">\n";
							buscaimg($row['tecidointeiro1'],'tecido');
							
							if(buscacortecido($row['tecidointeiro2']) != ""){	
								echo "\n<br>\n";
								buscaimg($row['tecidointeiro2'],'tecido');
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
			
			if($row['foto1'] != ""){echo "<a href=\"usuarios/".$_SESSION['usuariodados'][0]."/".$row['foto1'].".jpg\" target=\"_blank\">foto 1</a>";}
			if($row['foto2'] != ""){echo "&nbsp;|&nbsp;<a href=\"usuarios/".$_SESSION['usuariodados'][0]."/".$row['foto2'].".jpg\" target=\"_blank\">foto 2</a>";}
			if($row['foto3'] != ""){echo "&nbsp;|&nbsp;<a href=\"usuarios/".$_SESSION['usuariodados'][0]."/".$row['foto3'].".jpg\" target=\"_blank\">foto 3</a>";}	
			
		echo "</div>";
	}

	}//endwhile


}
function buscaimg($numreg,$tipo){//busca imagens de dados dos pedidos de mini-mi - INÍCIO
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
	
	if($row == TRUE){//INÍCIO
	 
		if($tipo == 'tecido'){//tecido - INÍCIO
			echo "<img src=\"" . IMG_PATH . "tecidoteca/" . $row['local'] ."_tb/". $row['imgtb'] . "\" title=\"".$row['tags']."\" alt=\"".$row['tags']."\"  width=\"38px\" height=\"41px\"/>";
		}//tecido - FIM

		elseif($tipo == 'cabide'){//cabide - INÍCIO
					
			echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . $row['tipo'] . "_cb/" . $row['imagemcabide'] . ".png\" title=\"".$row['nome']."\" alt=\"".$row['nome']."\" />" . "\n";
		}//cabide - FIM

		elseif($tipo == "armario"){//armário - INÍCIO
			$posicao = explode(",",$row['posicao']);
			
			if($row['tipo'] == 'manequim') {
					echo "<img id=\"manequim\" src=\"" . IMG_PATH . "editor-mini-mi-img/" . $row['tipo'] . "/" . $row['imagemprincipal'] . ".png\" title=\"".$row['nome']."\" alt=\"".$row['nome']."\" />" . "\n";
			}else{
				echo "<img src=\"" . IMG_PATH . "editor-mini-mi-img/" . $row['tipo'] . "/" . $row['imagemprincipal'] . ".png\" title=\"".$row['nome']."\" alt=\"".$row['nome']."\"  style=\"position:absolute;top:" . $posicao[0] . ";left:". $posicao[1] .";z-index:". $row['camada'].";\" />" . "\n";
			}			
		}//armário - FIM
		

		
					
	
}
	
}//busca imagens de dados dos pedidos de mini-mi - FIM

function buscainfo($numreg,$tipo){//busca infos de dados dos pedidos de mini-mi
	global $conexao;

	switch($tipo){
		case 'armario':
			$info = mysql_query("SELECT * FROM tb_editorminimi WHERE numreg LIKE '$numreg'");
			break;
		case 'tecido':
			$info = mysql_query("SELECT * FROM tb_tecidoteca WHERE numreg LIKE '$numreg'");
			break;
	}
	
	while($row = mysql_fetch_array($info)){
		if($row == TRUE){
			if($tipo == "tecido"){
				return ($row['tags']);				
			}elseif($tipo == "armario"){
				return  ($row['nome']);		
			}
		}
	}//endwhile
	
	//mysql_close(
}


	


?>

