<?php
/**************************************************************
Aqui estão listadas as tags de template do Lilliput
Funciona como no wordpress. Basta se preocupar em colocá-las
nos lugares certos.

Última revisão: 15.02.2011
**************************************************************/
function pega_cabecalho(){ //Inclui o cabeçalho do template
	include(TEMPLATE_PATH . "cabecalho.php");
}

function pega_rodape(){ //Inclui o rodapé do template
	include(TEMPLATE_PATH . "rodape.php");
}

function listar_paginas(){ //Lista as páginas do site em forma de menu
	conexaodb();
	$conexao = mysql_query("SELECT ID,titulo,conteudo,estado,tipo,ordem,permalink FROM tb_paginas WHERE estado = 'publicado' AND tipo NOT LIKE 'usr' ORDER BY ordem ");
	
	echo "<ul>\n";
	while($row = mysql_fetch_array($conexao)){
					
		
			echo "<li>";  			
			if(isset($_GET['pg']) && $_GET['pg'] == $row['permalink'] && $row['permalink'] != 'home'){
				echo "<a id=\"atual\" href=?pg=" . $row['permalink'] . ">" . $row['titulo'] . "</a>";
  			}elseif($row['permalink'] != 'home'){
  				echo "<a href=?pg=" . $row['permalink'] . ">" . $row['titulo'] . "</a>";
  			}
  			echo "</li>\n";
  		} //endwhile
  		
  	echo "</ul>\n";
}

function mostra_conteudo(){ //Exibe o conteúdo de cada página
	conexaodb();
	
	if(isset($_GET['pg'])== TRUE){
		$sitedir = $_GET['pg']; //Armazena em qual página o usuário está
	
		if($sitedir == "login"){// página de login
			if(isset($_GET['usr']) && !isset($_POST['login'])){ formlogin('cadastro');}
			elseif(!isset($_POST['login'])){formlogin('form');}
			elseif(isset($_POST['login'])){//usuário fazendo login
				$usuario = vacinadebase($_POST['usuario']);
				$senha = sha1(vacinadebase($_POST['senha']));
				
				if(login($usuario, $senha) == TRUE){
					if(isset($_POST['url'])){//usuário vai retornar a uma página específica
						header("Location: " . base64_decode($_POST['url']) );
					}
					else{//mostra o perfil do usuário
						//header("Location: " . info_loja(LOJA,'url','return') . "?pg=perfil&usr=" . base64_encode($usuario));
						include(USR_PAGES . "perfil.php");
					}				
					 
				}
				if(login($usuario, $senha) == FALSE){formlogin('erro');}
			}
		}
		elseif($sitedir == "cadastrar"){//exibe form de cadastro
			include("admin/aplicativos/cadastro-cliente.php");
		}elseif($sitedir == "perfil"){//mostra perfil do usuário
			//montaperfil();
			include(USR_PAGES . "perfil.php");
		}elseif($sitedir == "logout"){//saindo do sistema
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
		 
			$_SESSION['usuariodados'] = NULL;
			unset($_SESSION['usuariodados']);
			
			session_destroy();
			//ob_start();
			//header("Location: " . info_loja(LOJA,'url','return'));
			//ob_flush();
			$urllogout = info_loja(LOJA,'url','return');
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=". $urllogout  ."\">";   
		}//endif
		
		else{//exibindo conteúdo das páginas normais
			$conexao = mysql_query("SELECT ID,titulo,conteudo,estado,tipo,ordem,permalink FROM tb_paginas WHERE permalink = '$sitedir'");

			while($row = mysql_fetch_array($conexao)){
				echo $row['conteudo'];
			} //endwhile
		}//endif	
	}elseif(isset($_GET['pg'])== FALSE || isse($_GET['pg']) && $_GET['pg'] == home){
		$conexao = mysql_query("SELECT ID,titulo,conteudo,estado,tipo,ordem,permalink FROM tb_paginas WHERE permalink = 'home'");

		while($row = mysql_fetch_array($conexao)){
			echo $row['conteudo'];
		} //endwhile
	}//endif
}

function mostra_titulo(){ //Exibe o título de cada página
	conexaodb();
	
	if(isset($_GET['pg'])== TRUE && $_GET['pg'] != 'home'){
	
		$sitedir = $_GET['pg']; //Armazena em qual página o usuário está

		if($sitedir == "login"){// página de login
			echo "<h2>entrar</h2>\n";
		}
		if($sitedir == "perfil"){// página do perfil do usuário
			echo "<h2>Perfil</h2>\n\n";
		}
		elseif($sitedir == "cadastrar"){//exibe form de cadastro
			echo "<h2>cadastro no mini-mi.net</h2>\n";
		}else{
			$conexao = mysql_query("SELECT ID,titulo,conteudo,estado,tipo,ordem,permalink FROM tb_paginas WHERE permalink = '$sitedir'");

			while($row = mysql_fetch_array($conexao)){
				echo "<h2>" .$row['titulo'] . "</h2>\n";
			} //endwhile
		}//endif	
	}//endif	
}

function info_loja($loja,$tipo,$modo){ //Mostra as informações básicas de cada loja
	conexaodb();
	
	$conexao = mysql_query("SELECT ID,nome,sobre,emailcontato,metadescription,metakeywords,url FROM tb_configuracaoloja WHERE nome = '$loja'");

	while($row = mysql_fetch_array($conexao)){
		if($modo == "return"){return ($row[$tipo]);}
		else{echo $row[$tipo];}
	} //endwhile
}	

function tem_aplicativo(){ //Se a página possuir um aplicativo, incluir ele no site
	conexaodb();
	
	if(isset($_GET['pg'])== TRUE){
	
		$sitedir = $_GET['pg']; //Armazena em qual página o usuário está
	
		$conexao = mysql_query("SELECT ID,tipo,permalink,aplicativo FROM tb_paginas WHERE permalink = '$sitedir' AND tipo = 'app'");

		while($row = mysql_fetch_array($conexao)){
			if($row['aplicativo'] != NULL){ include("aplicativos/" . $row['aplicativo']); }
		} //endwhile	
	}else{//exibe aplicativo da home
		$conexao = mysql_query("SELECT ID,tipo,permalink,aplicativo FROM tb_paginas WHERE permalink = 'home' AND tipo = 'app'");

		while($row = mysql_fetch_array($conexao)){
			if($row['aplicativo'] != NULL){ include("aplicativos/" . $row['aplicativo']); }
		} //endwhile	
	}//endif
}

function config_aplicativo($tipo){ //Exibe configurações particulares para o funcionamento de um aplicativo
	conexaodb();
	
	if(isset($_GET['pg'])== TRUE){
		
		$sitedir = $_GET['pg']; //Armazena em qual página o usuário está

		$conexao = mysql_query("SELECT * FROM tb_aplicativos INNER JOIN tb_paginas ON tb_aplicativos.IDpagina = tb_paginas.ID WHERE tb_paginas.permalink = '$sitedir'");

		while($row = mysql_fetch_array($conexao)){
			echo  $row[$tipo]; 
		} //endwhile	
	}//endif
}

function login($usuario,$senha){//função geral para login
	conexaodb();
	
	$conexao = mysql_query("SELECT numreg,usuario,senha,apelido,privilegios FROM tb_usuarios WHERE usuario LIKE '$usuario' AND senha LIKE '$senha'");
	
	$row = mysql_fetch_array($conexao);
	
	if($row == TRUE){
		//dados de login
		$_SESSION['usuariodados'] = array();
		$_SESSION['usuariodados'][0] = $row['numreg']; //número de registro do usuário
		$_SESSION['usuariodados'][1] = base64_encode($row['usuario']); //e-mail do usuário
		$_SESSION['usuariodados'][2] = base64_encode($row['apelido']); //apelido do usuário
		$_SESSION['usuariodados'][3] = base64_encode($row['senha']); //senha
		$_SESSION['usuariodados'][4] = base64_encode($row['privilegios']); //privilegio
		$_SESSION['usuariodados'][5] = dadousuario($row['numreg'],'cep'); //cep 
		$_SESSION['usuariodados'][6] = 0; //tamanho do carrinho
		$_SESSION['usuariodados'][7] = ""; //tipo frete
		$_SESSION['usuariodados'][8] = ""; //fotos
		$_SESSION['usuariodados'][9] = ""; //numero do pedido
		$_SESSION['usuariodados'][10] = ""; //bloqueador do pedido
		//setcookie("minimi",$row['numreg'] . "#" . base64_encode($row['usuario']) . "#" . base64_encode($row['apelido']), time()+14400);
		return TRUE;
	}else{return FALSE;}
	
	
}

function formlogin($exibe){//cria formulários de login e apresenta estado quando usuário estiver logado

	if($exibe == 'links'){//exibe no formato de links
	echo "<div id=\"entrarlogin\" style=\"float:left;margin-top:0px;\"><a href=\"?pg=login\">entrar</a></div>";
	echo "<div id=\"cadastrarlogin\" style=\"float:right;margin-top:0px;\"><a href=\"?pg=cadastrar\">cadastrar?</a></div>";
		
	}elseif($exibe == 'form'){//formulário de login
		include("admin/formularios/form-login.php");
	}elseif($exibe == 'cadastro'){ //formulário de login com e-mail preenchido
		include("admin/formularios/form-login.php");
	}elseif($exibe == 'erro'){ //erro no login
		include("admin/formularios/form-login-erro.php");
	}elseif($exibe == 'formadmin'){//formulário de login
		include("formularios/form-loginadmin.php");
	}//endif
	
}

function profile(){//exibe atalhos do perfil do usuário
		
	?>	
	<span id="sairperfil"  style="float:right;margin-top:0px;">
		<a href="<?php info_loja(LOJA,'url','');?>?pg=logout">sair</a>
	</span> 	
<span id="carro"  style="float:right;margin-top:0px;">
		<a href="<?php echo info_loja(LOJA,'url','') . "?pg=perfil&usr=" . $_GET['usr'];?>">(<?php if(isset($_SESSION['usuariodados'][6])){echo $_SESSION['usuariodados'][6];}else{echo "0";}?>)</a>
	</span>	
	<span id="coracao"  style="float:right;margin-top:0px;">
		<?php if(isset($_SESSION['usuariodados'][6]) && $_SESSION['usuariodados'][6] == 0):?>		
		<a href="<?php info_loja(LOJA,'url','');?>?pg=login"><img src="<?php echo IMG_PATH; ?>/icones/coracao-partido.png" border="0"></a>
		<?php else:?>
	<a href="<?php info_loja(LOJA,'url','');?>?pg=login"><img src="<?php echo IMG_PATH; ?>/icones/coracao.png" border="0"></a>		
		<?php endif;?>
	</span>
	
 	<span id="dadoperfil" style="float:right;margin-top:0px;">
 		<a href="<?php info_loja(LOJA,'url','');?>?pg=perfil&usr=<?php echo base64_encode($_SESSION['usuariodados'][0]); ?>">perfil</a>
 	</span>
	<?php
}

function montaperfil(){//monta quadro de perfil do usuário

	
	
	//echo "<div style=\"width:980;float:left;margin-left:10px;background:pink;\">\n <!-- comeco -->\n";
		echo "<div id=\"perfilpedidos\"  >\n";
		if(isset($_GET['pedido']) && $_GET['pedido'] != ""){
			echo "<h3>Pedido N&ordm; ".$_GET['pedido']."</h3>\n\n";
			echo "<div style=\"position:relative;margin-bottom:10px;float:right;width:100%\">"."<a href=\"?pg=perfil&usr=".$_SESSION['usuariodados'][1]."\">voltar</a>"."</div>\n";
			
			
			 mostrapedidos($_GET['pedido']);
			
		
			echo "<div style=\"position:relative;margin-bottom:10px;float:right;width:100%\">"."<a href=\"?pg=perfil&usr=".$_SESSION['usuariodados'][1]."\">voltar</a>"."</div>\n";	
		
		}elseif(isset($_GET['acao']) && $_GET['acao'] == "dados"){
			echo "<div id=\"perfilpedidosform\"  >\n";
			include("admin/formularios/form-dados-perfil.php");
			echo "</div>";
		}else{	
		//echo "<h3>Meus pedidos</h3>\n";	
			//meuspedidos();
		}//endif
		echo "</div>\n"; 
	
	
	
	
	//echo "</div>\n";

	
		
}

function talogado(){//verifica se o usuário está logado no sistema
		
	if(isset($_SESSION['usuariodados']) && $_SESSION['usuariodados']!= NULL){return TRUE;}
	else{return FALSE;}
}

function meuspedidos(){//mostra os pedidos feitos pelo usuário
	global $conexao;

	$numreg = $_SESSION['usuariodados'][0];
	$conexao = mysql_query("SELECT * FROM tb_pedidos WHERE numreg LIKE '$numreg' ORDER BY datapedido DESC");

	echo "<table>\n";
	echo "<tr>\n";
		echo "<td id=\"indicetabela\">pedido</td>";
		echo "<td id=\"indicetabela\">valor</td>";
		echo "<td id=\"indicetabela\">tipo frete</td>";
		echo "<td id=\"indicetabela\">valor frete</td>";
		echo "<td id=\"indicetabela\">estado</td>";
		//echo "<td><strong>data</strong></td>";
		
	echo "</tr>\n";
	
	$corlinha = "#FBDE6D;";

	while($row = mysql_fetch_array($conexao)){
		
		echo "<tr>\n";
			echo "<td style=\"background:" . $corlinha ."\"><a href=\"?pg=perfil&usr=".$_SESSION['usuariodados'][1]."&pedido=".$row['numpedido']."\">". $row['numpedido'] . "</a></td>";
			echo "<td style=\"background:" . $corlinha ."\">R$". $row['valorpedido'] . "</td>";
			echo "<td style=\"background:" . $corlinha ."\">". $row['frete'] . "</td>";
			echo "<td style=\"background:" . $corlinha ."\">R$". $row['fretevalor'] . "</td>";
			echo "<td style=\"background:" . $corlinha ."\">". $row['estado'] . "</td>";
			//echo "<td><p>". $row['datapedido'] . "</p></td>";
		echo "</tr>\n";
		
		
		if($corlinha == "#FBDE6D;"){$corlinha = "";}
		else{$corlinha = "#FBDE6D;";}

	}//endwhile
	
	
	echo "</table>\n";
	
}


function minhascaricaturas(){//mostra as caricaturas enviadas pelo bonequeiro
	global $conexao;

	$numreg = $_SESSION['usuariodados'][0];
	$conexao = mysql_query("SELECT * FROM tb_pedidoscaricatura WHERE numreg LIKE '$numreg' ORDER BY data DESC");

	echo "<table>\n";
	echo "<tr>\n";
		echo "<td id=\"indicetabela\">pedido</td>";
		echo "<td id=\"indicetabela\">apelido</td>";
		echo "<td id=\"indicetabela\">vers&atilde;o</td>";
		echo "<td id=\"indicetabela\">aprovada?</td>";
		
	echo "</tr>\n";
	
	$corlinha = "#FBDE6D;";
	
	while($row = mysql_fetch_array($conexao)){
		
		echo "<tr>\n";
			echo "<td style=\"background:" . $corlinha ."\"><a href=\"?pg=perfil&usr=".$_SESSION['usuariodados'][1]."&pedido=".$row['numpedido']."&show=caricatura"."&id=".$row['caricatura']."\">". $row['numpedido'] . "</a></td>";
			echo "<td style=\"background:" . $corlinha ."\">". $row['apelido'] . "</td>";
			echo "<td style=\"background:" . $corlinha ."\">". $row['versao'] . "</td>";
			echo "<td style=\"background:" . $corlinha ."\">". $row['estado'] . "</td>";
		echo "</tr>\n";
		
		
		if($corlinha == "#FBDE6D;"){$corlinha = "";}
		else{$corlinha = "#FBDE6D;";}
		

	}//endwhile
	
	
	echo "</table>\n";
	
}

/*function mostracaricaturashome(){//mostra as caricatruras dos mini-mis do cliente, independente do pedido
}*/

function mostracaricaturas($numped,$acao,$id){//mostra as caricatruras dos mini-mis do cliente
	global $conexao;

	$numreg = $_SESSION['usuariodados'][0];	
	
	if($acao == 'lista'){//exibe lista de caricaturas em forma de miniaturas - INÍCIO
		$conexao = mysql_query("SELECT * FROM tb_pedidoscaricatura WHERE numpedido LIKE '$numped' ORDER BY data DESC");
	
		echo "<table>\n";
			echo "<tr>\n";
				while($row = mysql_fetch_array($conexao)){
					echo "<td>";
						echo "<a href=\"?pg=perfil&usr=" . $_GET['usr'] . "&pedido=" . $_GET['pedido'] . "&show=caricatura". "&id=". $row['caricatura'] ."\"><img src=\"usuarios/" . $numreg . "/" . $row['caricatura'] . ".png\" height=\"134\" width=\"190\" alt=\"Clique para ampliar\" title=\"Clique para ampliar\" border=\"0\"></a>";
					echo "</td>";
				}//endwhile
			echo "</tr>\n";
		echo "</table>\n";
	}//exibe lista de caricaturas em forma de miniaturas - FIM
	elseif($acao == 'caricatura'){//exibe dados da caricatura individualmente - INÍCIO
		$conexao = mysql_query("SELECT * FROM tb_pedidoscaricatura WHERE numpedido LIKE '$numped' AND caricatura LIKE '$id'");
		
		while($row = mysql_fetch_array($conexao)){
			echo "<img src=\"usuarios/" . $numreg . "/" . $row['caricatura'] . ".png\" height=\"693\" width=\"980\" \>\n";
			echo "<div style=\"padding:10px;\">\n";
				echo "<div style=\"float:left;width:100%\">\n";
					echo "<p style=\"float:left;\"><strong>Coment&aacute;rios do bonequeiro:</strong></p>\n";
					echo "<p style=\"float:right;\"><strong>Vers&atilde;o da caricatura:&nbsp;</strong>" . $row['versao']; 
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Aprovada?&nbsp;</strong>"; 
							if($row['estado'] == ""){echo "--";}
							else{echo $row['estado'];} 
					echo "</p>\n";
				echo "</div>\n";
				echo "<div style=\"float:left;width:100%\"><p><em>" . $row['descricaobonequeiro'] . "</em></p></div>\n";
				
				echo "<div style=\"float:left;width:100%\">\n";
					if($row['estado'] == ""){//usuário ainda não aprovou/ou não a caricatura
						$idcaricatura = $row['id'];
						include(USR_PAGES . "form-caricaturaaprov.php");
					}else{
						if($row['estado'] == 'nao'){
							echo "<div style=\"float:left;width:100%;\"><p><strong>Voc&ecirc; disse:</strong></p></div>";
							echo "<div style=\"float:left;width:100%\"><p><em>" . $row['descricaocliente'] . "</em></p></div>\n";
						}
					}
				echo "</div>\n";
			echo "</div>\n";
		}//endwhile
	}//exibe dados da caricatura individualmente - FIM
}

///////////////////////////////////////////////////////////////////
// Funções específicas para o funcionamento do template do admin
//////////////////////////////////////////////////////////////////

function listar_paginasadmin(){ //Lista as páginas do site do admin em forma de menu
	conexaodb();
	
	$conexao = mysql_query("SELECT ID,titulo,arquivo,permalink FROM tb_admin");
	
	echo "<ul>\n";
	
	while($row = mysql_fetch_array($conexao)){
			echo "<li>";  			
  			echo "<a href=?pg=" . $row['arquivo'] . ">" . $row['titulo'] . "</a>";
  			echo "</li>\n";
  		} //endwhile
   echo "<li><a href=\"?pg=logout\" >sair</a></li>";
  	echo "</ul>\n\n";
	
}

function mostra_conteudoadmin(){ //Exibe o conteúdo de cada página
	conexaodb();

	if(isset($_GET['pg'])== TRUE){
		
		$sitedir = $_GET['pg']; //Armazena em qual página o usuário está		

		$conexao = mysql_query("SELECT ID,titulo,arquivo,permalink,caminho FROM tb_admin WHERE arquivo ='$sitedir'");
	
		while($row = mysql_fetch_array($conexao)){
			
			if($row['caminho'] == ''){			
				$arquivo = $row['arquivo'];
			}
			elseif($row['caminho'] != ''){
				$arquivo = $row['caminho'] . $row['arquivo'];
			}//endif
			
			include($arquivo . ".php");
  		} //endwhile
	}//endif  		
  		
}
function pega_cabecalhoadmin(){ //Inclui o cabeçalho do template
	include(ADMINTEMPLATE_PATH . "cabecalho.php");
}

function pega_rodapeadmin(){ //Inclui o rodapé do template
	include(ADMINTEMPLATE_PATH . "rodape.php");
}


function config_aplicativoadmin($tipo){ //Exibe configurações particulares para o funcionamento de um aplicativo
	conexaodb();
	
	if(isset($_GET['pg'])== TRUE){
	
		$sitedir = $_GET['pg']; //Armazena em qual página o usuário está
		
		$conexao = mysql_query("SELECT * FROM tb_aplicativos INNER JOIN tb_admin ON tb_aplicativos.IDpagina = tb_admin.ID WHERE tb_admin.arquivo = '$sitedir' AND tb_admin.caminho = tb_aplicativos.caminho");
		
			while($row = mysql_fetch_array($conexao)){
				echo  $row[$tipo]; 
			} //endwhile
			
	}//endif
}

?>
