<?php
//Validando os dados que estão sendo criados
// afim de liberar para o próximo passo

//Itens obrigatórios --------
//manequim

echo "<p>Os seguintes itens est&atilde;o pendentes:</p>";
echo "<ul style=\"list-style-type:none;margin-left:10px;\">\n";
if($_SESSION['manequim'][0]  != "" && isset($_SESSION['manequim'][2]) && $_SESSION['manequim'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido do corpo</li>\n";
	$_SESSION['liberado'][0] = 0;//manequim
}else{ $_SESSION['liberado'][0] = 1;}

//rosto	
if($_SESSION['rosto'][0]  == ""){//não escolheu rosto
	echo "<li><span id=\"erro\">X</span>&nbsp;sem rosto</li>\n";
	$_SESSION['liberado'][1] = 0;//rosto
}else{$_SESSION['liberado'][1] = 1;}
//verifica se o usuário escolheu um corpo (e seu tecido0 e um rosto
if($_SESSION['liberado'][0] == 1 && $_SESSION['liberado'][1] == 1){$libera = "";}
else{$libera = "disabled";}



//Itens opcionais ------------
//acessórios
if($_SESSION['acessorio'][0]  != "" && $_SESSION['acessorio'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido do acess&oacute;rio</li>\n";
	$_SESSION['liberado'][2] = 0;//acessório
	$libera = "disabled";
}else{$_SESSION['liberado'][2] = 1;}

//roupa superior
if($_SESSION['superior'][0]  != ""  && isset($_SESSION['superior'][2]) && $_SESSION['superior'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido da camisa/blusa</li>\n";
	$_SESSION['liberado'][3] = 0;//superior
	$libera = "disabled";
}else{$_SESSION['liberado'][3] = 1;}

//roupa inferior
if($_SESSION['inferior'][0]  != "" && isset($_SESSION['inferior'][2]) && $_SESSION['inferior'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido da cal&ccedil;/saia</li>\n";
	$_SESSION['liberado'][4] = 0;//inferior
	$libera = "disabled";
}else{$_SESSION['liberado'][4] = 1;}

if($_SESSION['inteiro'][0]  != "" && isset($_SESSION['inteiro'][2]) && $_SESSION['inteiro'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;tecido do conjunto</li>\n";
	$_SESSION['liberado'][5] = 0;//inteiro
	$libera = "disabled";
}else{$_SESSION['liberado'][5] = 1;}

if($_SESSION['especial'][0]  != "" && isset($_SESSION['especial'][2]) && $_SESSION['especial'][2] == ""){
	echo "<li><span id=\"erro\">X</span>&nbsp;coment&aacute;rio da roupa especial</li>\n";
	$_SESSION['liberado'][6] = 0;//especial
	$libera = "disabled";
}else{$_SESSION['liberado'][6] = 1;}

echo "</ul>\n";

//fazendo as verificações ------



//$_SESSION['liberado'][7] = 0;//combo 
//echo "<br>@".$_SESSION['liberado'] . " " . $libera;

echo "<input type=\"button\" value=\"pr&oacute;ximo passo\"". $libera . "/>";
?>