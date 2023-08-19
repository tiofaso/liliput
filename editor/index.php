<?php
session_cache_expire(10);
session_start();
include("funcoes.php");

//limpando/excluindo a sessão
if ( isset( $_GET['l']) ) {
	if ($_GET['l'] == 1) {
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
if( isset($_GET["a"]) ) {
	$_SESSION['acessorio'] = "img-acessorio/acessorio" . $_GET["a"] . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['acessorio'] = "img-acessorio/acessorio000.png"; }

//Armazena o tipo de rosto escolhido
if( isset($_GET["r"]) ) {
	$_SESSION['rosto'] = "img-rosto/rosto" . $_GET["r"] . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['rosto'] = "img-rosto/rosto000.png";}

//Armazena o tipo de roupa superior escolhida
if( isset($_GET["s"]) ) {
	$_SESSION['superior'] = "img-superior/superior" . $_GET["s"] . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['superior'] = "img-superior/superior000.png"; }

//Armazena o tipo de roupa inferior escolhida
if( isset($_GET["i"]) ) {
	$_SESSION['inferior'] = "img-inferior/inferior" . $_GET["i"] . ".png" ;
	$_SESSION['editando'] = 1;
}
elseif ( $_SESSION['editando'] == 0 ) { $_SESSION['inferior'] = "img-inferior/inferior000.png"; }


?>
<html>
<head>
	<title>mini-mi editor - pre-alpha</title>
	<style type="text/css">
		*{
			background-color:#fff;
		}
	</style>
 	<script type="text/javascript" src="ajax.js"></script>
</head>
<body>
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
</body>
</html>