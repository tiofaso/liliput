<?php
function validacpf($cpf){ //função para validação de cpf

	if( strlen($cpf) != 14 ){//verifica se falta dígito
		$status = false;
	}
	else { $status = true;}
	
	//verifica se não foi digitada uma seqüência com dígitos iguais
	if( ($cpf == '111.111.111-11') || ($cpf == '222.222.222-22') ||
	   ($cpf == '333.333.333-33') || ($cpf == '444.444.444-44') ||
	   ($cpf == '555.555.555-55') || ($cpf == '666.666.666-66') ||
	   ($cpf == '777.777.777-77') || ($cpf == '888.888.888-88') ||
	   ($cpf == '999.999.999-99') || ($cpf == '000.000.000-00') ) {
	   $status = false;
	 }	
	 else { $status = true;}

	if($status == true){
		$cpf = str_replace("-","",str_replace(".","",$cpf)); //deixando apenas os dígitos do n° do cpf 
	
		//esse trecho de código foi retirado de: http://imasters.uol.com.br/artigo/1403?cn=1403&cc=44		
	  	//PEGA O DIGITO VERIFIACADOR
	   $dv_informado = substr($cpf, 9,2);

	   for($i=0; $i<=8; $i++) {
	    $digito[$i] = substr($cpf, $i,1);
	   }

	   //CALCULA O VALOR DO 10º DIGITO DE VERIFICAÇÂO
	   $posicao = 10;
	   $soma = 0;

	   for($i=0; $i<=8; $i++) {
	    $soma = $soma + $digito[$i] * $posicao;
	    $posicao = $posicao - 1;
	   }

	   $digito[9] = $soma % 11;

	   if($digito[9] < 2) {
	    $digito[9] = 0;
	   }
	   else {
	    $digito[9] = 11 - $digito[9];
	   }

	   //CALCULA O VALOR DO 11º DIGITO DE VERIFICAÇÃO
	   $posicao = 11;
	   $soma = 0;

	   for ($i=0; $i<=9; $i++) {
	    $soma = $soma + $digito[$i] * $posicao;
	    $posicao = $posicao - 1;
	   }

	   $digito[10] = $soma % 11;

	   if ($digito[10] < 2) {
	    $digito[10] = 0; 
	   }
	   else {
	    $digito[10] = 11 - $digito[10];
	   }

		 //VERIFICA SE O DV CALCULADO É IGUAL AO INFORMADO
		 $dv = $digito[9] * 10 + $digito[10];
		 if ($dv != $dv_informado) {
		  $status = false;
		 }
		 else{
			  $status = true;
			 }//FECHA ELSE
	}	

	return $status;
}	


function validacep($cep){ //função para validação de cep

	if( strlen($cep) != 9 ){//verifica se falta dígito
		$status = false;
	}
	else { $status = true;}
	
	//verifica se não foi digitada uma seqüência com dígitos iguais
	if( ($cep == '11111-111') || ($cep == '22222-222') ||
	   ($cep == '33333-333') || ($cep == '44444-444') ||
	   ($cep == '55555-555') || ($cep == '66666-666') ||
	   ($cep == '77777-777') || ($cep == '88888-888') ||
	   ($cep == '99999-999') || ($cep == '00000-000') ) {
	   $status = false;
	 }	
	 else { $status = true;}

	if($status == true){
		$cep = trim($cep);
		$avaliaCep = preg_match("/^([0-9]{2})\.?([0-9]{3})-?([0-9]{3})$/", $cep);

		if($avaliaCep != true) {
			$status = false;
		}
		else { $status = true;}
	}
	
	return $status;
}

function validaemail($email) { //função para validação de e-mail
	//esse trecho de código foi retirado de: http://www.criarweb.com/artigos/185.php
 	$mail_correcto = 0;  

   //verifico umas coisas 
   if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 

      if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
         //vejo se tem caracter . 

         if (substr_count($email,".")>= 1){ 
            //obtenho a terminação do dominio 
            $term_dom = substr(strrchr ($email, '.'),1); 
            //verifico que a terminação do dominio seja correcta 

	         if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
	            //verifico que o de antes do dominio seja correcto 
	            $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
  		         $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 

	            if ($caracter_ult != "@" && $caracter_ult != "."){ 
	               $mail_correcto = 1; 
   	         } 
      	   } 
	      } 
	   } 
	} 

	if ($mail_correcto){ $status = true;}
	else {$status = false;} 
	
	return $status;
}

function validatelefone($telefone){
	if( strlen($telefone) != 14 ){//verifica se falta dígito
		$status = false;
	}
	else { $status = true;}
	
	//verifica se não foi digitada uma seqüência com dígitos iguais
	if( ($telefone == '(11) 1111-1111') || ($telefone == '(22) 2222-2222') ||
	   ($telefone == '(33) 3333-3333') || ($telefone == '(44) 4444-4444') ||
	   ($telefone == '(55) 5555-5555') || ($telefone == '(66) 6666-6666') ||
	   ($telefone == '(77) 7777-7777') || ($telefone == '(88) 8888-8888') ||
	   ($telefone == '(99) 9999-9999') || ($telefone == '(00) 0000-0000') ) {
	   $status = false;
	 }	
	 else { $status = true;}	
	 
	 if($status == true){
		$telefone = trim($telefone);
		$avaliatelefone = preg_match("/^\(\d{2}\) \d{4}-\d{4}$/", $telefone);

		if($avaliatelefone != true) {
			$status = false;
		}
		else { $status = true;}
	}
	

	return $status;
}

function validasenha($senha,$confirmasenha){
	if($senha != $confirmasenha){ //senhas diferentes
		$status = "diferente";
	}
	else {$status = "valida";}	
	
	if(strlen($senha) < 8){ //senhas muito pequenas
		$status = "pequena";
	}
	else {$status = "valida";}

	if($status == "valida"){	
		$senha = trim($senha);
		
		$avaliasenha = preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[A-Za-z]).*$/",$senha);

		if($avaliasenha != true){ //verificando a complexidade da senha
			$status = "invalida";
		}
		else {$status = "valida";}
	}

	return $status;
}

function vacinadebase($dado){//evita inserções estranha para acessar a base de dados
	$dado = addslashes($dado);
   $dado = htmlspecialchars($dado);
   $dado = str_replace("SELECT","",$dado);
   $dado = str_replace("FROM","",$dado);
   $dado = str_replace("WHERE","",$dado);
   $dado = str_replace("INSERT","",$dado);
   $dado = str_replace("UPDATE","",$dado);
   $dado = str_replace("DELETE","",$dado);
   $dado = str_replace("DROP","",$dado);
   $dado = str_replace("DATABASE","",$dado);
   
   return $dado;
}

?>