<?php
session_cache_expire(10);
//session_start();
include("/funcoes/editor-motor.php");
if($_SESSION['editando'] == NULL){
	$_SESSION['editando'] = ""; //setando sessão para não dar warning
}

$link = explode("=",$_SESSION["dadoseditor"]);

if($link[0] == "a"){
	$dado_a = $link[1];
}
elseif($link[0] == "r"){
	$dado_r = $link[1];
}
elseif($link[0] == "s"){
	$dado_s = $link[1];
}
elseif($link[0] == "i"){
	$dado_i =  $link[1];
}
elseif($link[0] == "l"){ //limpar editor
	$dado_l =  $link[1];
}

//limpando/excluindo a sessão
if ( isset($dado_l) ) {
	if ($dado_l == 1) {
		//sessão de edição
		$_SESSION['editando'] = NULL;
  		unset($_SESSION['editando']);

		//sessão dos acessórios
		$_SESSION['acessorio'] = NULL;
  		unset($_SESSION['acessorio']);

		//sessão do rosto
		$_SESSION['rosto'] = NULL;
  		unset($_SESSION['rosto']);

		//sessão das roupas superiores
		$_SESSION['superior'] = NULL;
  		unset($_SESSION['superior']);

		//sessão das roupas inferiores
		$_SESSION['inferior'] = NULL;
  		unset($_SESSION['inferior']);
	}
}

if ( is_null (isset ($_SESSION['editando']) ) ) { $_SESSION['editando'] = 0; }

//echo $_GET["i"];
//Armazena o tipo de acessório escolhido
if( isset($dado_a) ) {
	$_SESSION['acessorio'] = "/armario/img-acessorio/acessorio" . $dado_a . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['acessorio'] = "/armario/img-acessorio/acessorio000.png"; }

//Armazena o tipo de rosto escolhido
if( isset($dado_r) ) {
	$_SESSION['rosto'] = "/armario/img-rosto/rosto" . $dado_r . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['rosto'] = "/armario/img-rosto/rosto000.png";}

//Armazena o tipo de roupa superior escolhida
if( isset($dado_s) ) {
	$_SESSION['superior'] = "/armario/img-superior/superior" . $dado_s . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['superior'] = "/armario/img-superior/superior000.png"; }

//Armazena o tipo de roupa inferior escolhida
if( isset($dado_i) ) {
	$_SESSION['inferior'] = "/armario/img-inferior/inferior" . $dado_i . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['inferior'] = "/armario/img-inferior/inferior000.png"; }


?>

<table  cellpadding="0" border="0" cellspacing="0.0" height="462,060px">
	<tr>
		<td height="105,242px"><img src="<?php echo leconteudo($_SESSION['acessorio']);?>"/></td>
		<td>
			<ul>
				<li><a href="?a=001">link1</a></li>
				<li><a href="?a=002">link2</a></li>
				<li><a href="?a=003">link3</a></li>
				<li><a href="?a=004">link4</a></li>
			</ul>
		</td>
	</tr>

	<tr> 
		<td height="96,282px"><img src="<?php echo leconteudo($_SESSION['rosto']);?>"/></td>
		<td>
			<ul>
				<li><a href="?r=001">link1</a></li>
				<li><a href="?r=002">link2</a></li>
				<li><a href="?r=003">link3</a></li>
				<li><a href="?r=004">link4</a></li>
			</ul>
		</td>
	</tr>

	<tr>
		<td height="154,714px"><img src="<?php echo leconteudo($_SESSION['superior']);?>"/></td>
		<td>
			<ul>
				<li><a href="?s=001">link1</a></li>
				<li><a href="?s=002">link2</a></li>
				<li><a href="?s=003">link3</a></li>
				<li><a href="?s=004">link4</a></li>
			</ul>
		</td>
	</tr>

	<tr>
		<td height="105,760px"><img src="<?php echo leconteudo($_SESSION['inferior']);?>"/></td>
		<td>
			<ul>
				<li><a href="?i=001">link1</a></li>
				<li><a href="?i=002">link2</a></li>
				<li><a href="?i=003">link3</a></li>
				<li><a href="?i=004">link4</a></li>
			</ul>
		</td>
	</tr>

</table>
<br/><br/><a href="?l=1">Clique aqui</a> para limpar o editor
