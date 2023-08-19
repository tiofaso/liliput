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

	move_uploaded_file($arquivo["tmp_name"],$diretorio . "/" .$novonome.$extensoes[strtoupper($arquivo["type"])] );
	
	return($novonome);
	
/* Verifica se o mime-type do arquivo é de imagem
if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
{
$erro[] = "Arquivo em formato inválido! 
	A imagem deve ser jpg, jpeg, bmp, gif ou png. Envie outro arquivo";
}	
	
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
?>