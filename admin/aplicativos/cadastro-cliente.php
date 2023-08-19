<?php
//Criação de cadasros dos clientes com os seus dados pessoais

if (!isset($_POST["cadastro"])){ //primeira visita do usuário

	//as variáveis abaixo estão sendo setadas com NULL para evitar warning de estanciamento
	$nome_completo = "";
	$apelido = "";	
	$cpf = "";
	$email = "";
	$telefone = "";
	$endereco = "";
	$complemento = "";
	$cidade = "";
	$estado = "";
	$cep = "";
	$senha = "";
	$confirmasenha = "";

	$msg = array(); //array para exibição de mensagens	

	$msg[0] = "";
	$msg[1] = "<label id=msg>Um apelido ou como os seus amigos te chamam</label>";
	$msg[2] = "<label id=msg>XXX.XXX.XXX-XX</label>";
	$msg[3] = "<label id=msg>usuario@dominio.com.br</label>";
	$msg[4] = "<label id=msg>(XX) XXXX-XXXX</label>";
	$msg[5] = "<label id=msg>Logradouro, n&#250;mero, bairro</label>";
	$msg[6] = "";
	$msg[7] ="";
	$msg[8] = "<label id=msg>XXXXX-XXX</label>";
	$msg[9] = "<label id=msg>Pelo menos 8 d&#237;gitos, compostos por letras e n&#250;meros</label>";
	$msg[10] = "";

	include("admin/formularios/form-cadastro-cliente.php"); //formulário de cadastro
}
else { //formulario enviado pelo usuário
	
	require_once("admin/funcoes/validacao.php");
	
	$nome_completo = vacinadebase($_POST["nome_completo"]);
	$apelido = vacinadebase($_POST["apelido"]);	
	$cpf = $_POST["cpf"];
	$email = vacinadebase($_POST["email"]);
	$telefone = $_POST["telefone"];
	$endereco = vacinadebase($_POST["endereco"]);
	$complemento = vacinadebase($_POST["complemento"]);
	$cidade = vacinadebase($_POST["cidade"]);
	$estado = $_POST["estado"];
	$cep = $_POST["cep"];
	$senha = vacinadebase($_POST["senha"]);
	$confirmasenha = vacinadebase($_POST["confirmasenha"]);
	
	$msg = array(); //array para exibição de mensagens
	
	$msg[0] = $nome_completo;
	$msg[1] = $apelido;
	$msg[2] = $cpf;
	$msg[3] = $email;
	$msg[4] = $telefone;
	$msg[5] = $endereco;
	$msg[6] = $cidade;
	$msg[7] = $estado;
	$msg[8] = $cep;
	$msg[9] = $senha;
	$msg[10] = $confirmasenha;
	
	//Validando dados
	
	$i = 0;
	$acheierro = FALSE;

	while($i <= 10){ //verificando se há dados em branco
	
		if($msg[$i] == NULL){
			$msg[$i] = "<label id=erro>(preenchimento obrigat&#243;rio)</label>";
			$acheierro = TRUE; 	
		}
		else{	$msg[$i] = "";}
		
		$i++;
	}

	if($cpf != null ){ //validando cpf e exibindo erro
		if(validacpf($cpf) == false){ 
			$msg[2] = "<label id=erro>(n&#250;mero de cpf inv&#225;lido)</label>" ;
			$acheierro = TRUE;
 		}
		else { $msg[2] = ""; }
	}	

	if($email != null){ //validando email e exibindo erro
		if(validaemail($email) == false){ 
			$msg[3] = "<label id=erro>(e-mail inv&#225;lido)</label>" ;
			$acheierro = TRUE;
		}
		else { $msg[3] = ""; }
	}

	if($telefone != null){ //validando telefone e exibindo erro
		if(validatelefone($telefone) == false){ 
			$msg[4] = "<label id=erro>(telefone inv&#225;lido)</label>" ;
			$acheierro = TRUE;
		}
		else { $msg[4] = ""; }
	}

	
	if($cep != null){ //validando cep e exibindo erro
		if(validacep($cep) == false){ 
			$msg[8] = "<label id=erro>(n&#250;mero de cep inv&#225;lido)</label>" ;
			$acheierro = TRUE;
		}
		else { $msg[8] = ""; }
	}
	
	if($senha != null){ //validando senha e exibindo erro
		if(validasenha($senha,$confirmasenha) == "diferente"){ 
			$msg[9] = "<label id=erro>(sua senha n&#227;o combina a confirma&#231;&#227;o abaixo)</label>" ;
			$acheierro = TRUE;
		}
		elseif(validasenha($senha,$confirmasenha) == "pequena"){
			$msg[9] = "<label id=erro>(sua senha possui menos de 8 caracteres)</label>" ;
			$acheierro = TRUE;
		}
		elseif(validasenha($senha,$confirmasenha) == "invalida"){
			$msg[9] = "<label id=erro>(sua senha precisa conter letras e n&#250;meros)</label>" ;
			$acheierro = TRUE;
		}
		else { $msg[9] = ""; $msg[10] = ""; }
	}
	
	
	//exibindo erros
	if($acheierro == TRUE){ include("admin/formularios/form-cadastro-cliente.php");} 
	else{ 

	//verificando se usuário existe
	if(checausuario($email) == TRUE){
				
		$_SESSION['email'] = "";
		echo "<span id=\"erro\"> J&aacute; existe um usu&aacute;rio cadastrado com esse e-mail</span>\n";
		$msg[3] = "<label id=erro>(e-mail j&aacute; existe)</label>" ;
		include("admin/formularios/form-cadastro-cliente.php");
	}
	else{ //novo usuário

		//include("/funcoes/diversas.php"); //gera o número de registro

		$_SESSION['nome_completo'] = $nome_completo;
		$_SESSION['apelido'] = $apelido;
		$_SESSION['cpf'] = $cpf;	
		$_SESSION['email'] = $email;
		$_SESSION['telefone'] = $telefone;
		$_SESSION['endereco'] = $endereco;
		$_SESSION['complemento'] = $complemento;
		$_SESSION['cidade'] = $cidade;
		$_SESSION['estado'] = $estado;
		$_SESSION['cep'] = $cep;
		$_SESSION['senha'] = sha1($senha);		
		$_SESSION['numreg'] = numreg() ;

		$usuario = criarusuario($_SESSION['email'],$_SESSION['senha'],$_SESSION['apelido'],'consumidor',$_SESSION['numreg']);

		$perfil = criarperfilusuario($_SESSION['numreg'],$_SESSION['nome_completo'],$_SESSION['apelido'],$_SESSION['cpf'],$_SESSION['email'],$_SESSION['telefone'],$_SESSION['endereco'],$_SESSION['complemento'],$_SESSION['cidade'],$_SESSION['estado'],$_SESSION['cep']); //criando perfil do usuário

		if($usuario == TRUE && $perfil == TRUE){
			
			$_SESSION['usuariodados'] = array();
			$_SESSION['usuariodados'][0] = $_SESSION['numreg']; //número de registro do usuário
			$_SESSION['usuariodados'][1] = $_SESSION['email']; //e-mail do usuário
			$_SESSION['usuariodados'][2] = $_SESSION['apelido']; //apelido do usuário
			$_SESSION['usuariodados'][3] = $_SESSION['senha']; //senha
			$_SESSION['usuariodados'][4] = "consumidor"; //privilegio 
			
			header("Location: " . info_loja(LOJA,'url','return') . "?pg=perfil&usr=" . base64_encode($_SESSION['usuariodados'][0]));
		}else{echo "<span id=\"erro\"> N&aring;o foi poss&iacute;vel realizar o cadastro. :(</span>\n";}
	}//endif - novo usuário - FIM
}


 
}	

?>