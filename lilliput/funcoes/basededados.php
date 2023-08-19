<?php
$conexao;
function conexaodb(){ //criando conexão com a base de dados
	
	global $conexao;
	
	$servidor = "localhost"; 
	$usuario = "minimi_manichi";
	$senha = "1248mani";
	$db = "minimi_lilliput";
	
	$conexao = @ mysql_connect($servidor, $usuario, $senha) or die(mysql_error());

	mysql_select_db($db);
}


function criarusuario($usuario,$senha,$apelido,$privilegio,$numreg){ //função para criar usuários na base
	global $conexao;
	
	$conexao = mysql_query("INSERT INTO tb_usuarios (numreg,usuario,senha,apelido,privilegios,ultimologin) VALUES ('$numreg','$usuario','$senha','$apelido','$privilegio',NOW())");

	if($conexao){echo "Seu cadastro foi efetuado";}
	else{
		echo "Seu cadastro nao foi efetuado";
		echo "<br/>" . mysql_error();
	}
} 

function criarperfilusuario($numreg,$nomecompleto,$apelido,$cpf,$email,$telefone,$endereco,$complemento,$cidade,$estado,$cep){ //função para criar perfil de usuários na base

	global $conexao;
		
	$conexao = mysql_query("INSERT INTO tb_perfilusuarios (numreg,nomecompleto,apelido,cpf,email,telefone,endereco,complemento,cidade,estado,cep,ultimaatualizacao) VALUES ('$numreg','$nomecompleto','$apelido','$cpf','$email','$telefone','$endereco','$complemento','$cidade','$estado','$cep',NOW())");

	if($conexao){echo "Seu cadastro foi efetuado";}
	else{
		echo "Seu cadastro nao foi efetuado";
		echo "<br/>" . mysql_error();
	}

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

function exibirtecidoteca($condicao,$limites){
	global $conexao;
	
	//verificação do número máximo de registros para paginação
	$conexao = mysql_query("SELECT numreg,nome,descricao,img,imgtb,tipo,tags,corhexa1,corhexa2,corhexa3,corhexa4,local,data FROM tb_tecidoteca WHERE $condicao ");	
	
	$_SESSION['totalregistros'] = mysql_num_rows($conexao);
	
	//realizando a busca real para exibição dos dados
	$condicoes = $condicao . $limites;
	
	$conexao = mysql_query("SELECT numreg,nome,descricao,img,imgtb,tipo,tags,corhexa1,corhexa2,corhexa3,corhexa4,local,data FROM tb_tecidoteca WHERE $condicoes ");

	if($conexao){
		$cont = 0;		

		echo "<table width='100%'>";		
		
		while($row = mysql_fetch_array($conexao)){
		
			if($cont == 0){ echo "<tr>"; }
  			
  			echo "<td>";
			echo "<img src=tecidoteca/" . $row['local'] . "_tb/" . $row['imgtb'] . ">";  			
  			echo "<br/>" . $row['nome'] . "</td>";
			
  			if($cont == 3){
  				$cont = 0;
  				echo "</tr>";
 			}else{$cont++;}

  		} //endwhile
  		
  		echo "</table>";		
	}
	else{
		echo "Nao foi possível exibir os itens";
		echo "<br/>" . mysql_error();			
	} //endif
}

function exibirprodutos(){ //exibi os produtos estáticos na loja
	
	global $conexao;
	
	$conexao = mysql_query("SELECT ");	
	
	if($conexao){}
	else{echo "Nao produtos disponíveis";}
}

function desconetardb(){ //desconectando da base de dados
	
	global $conexao;
	mysql_close($conexao);
}
?>