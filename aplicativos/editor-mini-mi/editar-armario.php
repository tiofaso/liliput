<h2>Editar Roupa</h2>
<?php
if(isset($_POST['atualizar'])){ //atualiza os dados na base
	$id = $_GET['roupa'];	
	$nome = $_POST{'nome'};
	$descricao = trim($_POST{'descricao'});
	$preco = $_POST{'preco'};
	$sexo = $_POST{'sexo'};
	$tipo = $_POST{'tipo'};
	$combo = $_POST{'combo'};
	$camada = $_POST{'camada'};
	$posicao = $_POST{'topo'} . "," . $_POST{'esquerda'};
	$estado = $_POST{'estado'};

	atualizarroupa($id,$nome,$descricao,$preco,$sexo,$tipo,$combo,$camada,$posicao,$estado);
}	

exibirroupa($_GET['roupa']);

if($_SESSION['tiporoupa'] == 'manequim'){ 
	$pasta = $_SESSION['tiporoupa'] . "/" . $_SESSION['imagemprincipal'] . ".png" . " width=118 height=122";
}else{ 
	$pasta = $_SESSION['tiporoupa'] . "_cb" . "/" . $_SESSION['imagemcabide'] . ".png";
}//endif					
								
echo "<img src=../" . IMG_PATH . "/editor-mini-mi-img/" . $pasta  . " style='padding:20px;'>";

?>
<form action="?pg=<?php echo $_GET['pg'];?>&acao=<?php echo $_GET['acao'];?>&roupa=<?php echo $_GET['roupa'];?>" method="post">

Nome do acess&oacute;rio/roupa/rosto <br/>

<input type="text" size="50" maxlength="100" name="nome" value="<?php echo $_SESSION['nomeroupa'];?>">
<br/>
Descri&ccedil;&atilde;o<br/> 

	<textarea size="500" name="descricao" rows="5" cols="50" value="<?php echo trim($_SESSION['descricaoroupa']);?> "> <?php echo trim($_SESSION['descricaoroupa']);?></textarea><br/> 

Pre&ccedil;o da unidade 

	<input type="text" size="6" name="preco" value="<?php echo $_SESSION['precoroupa'];?> "><br/>
Sexo
<?php 
	if(isset($_SESSION['sexo'])){
		
		switch($_SESSION['sexo']){
		
		 case "feminino":
		 	$feminino = "CHECKED";
		 	$masculino = "";
		 	$unisex = "";
		 	break;
				
		case "masculino":
			$feminino = "";
		 	$masculino = "CHECKED";
		 	$unisex = "";
			break;
		
		case "unisex" :
			$feminino = "";
		 	$masculino = "";
		 	$unisex = "CHECKED";
			break;
		}	
	
	echo "<input type=radio name=sexo value=feminino " . $feminino ."> Feminino\n";
	echo "<input type=radio name=sexo value=masculino " . $masculino ."> Masculino\n";
	echo "<input type=radio name=sexo value=unisex " . $unisex ."> Unisex\n";
}?>
<br/> 
Tipo de roupa 
<?php if(isset($_SESSION['tiporoupa'])){
	$selecionado = $_SESSION['tiporoupa'];
	
	switch($selecionado) {
		case 'acessorio':
			$acessorio = "selected";
			$superior = "";
			$inferior = "";
			$rosto = "";
			$especial = "";
			$cabelo = "";
			$inteiro = "";
			$manequim = "";
			break;
			
		case 'superior':
			$acessorio = "";
			$superior = "selected";
			$inferior = "";
			$rosto = "";
			$especial = "";
			$cabelo = "";
			$inteiro = "";
			$manequim = "";			
			break;
			
		case 'inferior':
			$acessorio = "";
			$superior = "";
			$inferior = "selected";
			$rosto = "";
			$especial = "";
			$cabelo = "";
			$inteiro = "";
			$manequim = "";			
			break;
			
		case 'rosto':
			$acessorio = "";
			$superior = "";
			$inferior = "";
			$rosto = "selected";
			$especial = "";
			$cabelo = "";
			$inteiro = "";
			$manequim = "";			
			break;
			
		case 'especial':
			$acessorio = "";
			$superior = "";
			$inferior = "";
			$rosto = "";
			$especial = "selected";
			$cabelo = "";
			$inteiro = "";
			$manequim = "";
			break;

		case 'inteiro':
			$acessorio = "";
			$superior = "";
			$inferior = "";
			$rosto = "";
			$especial = "";
			$cabelo = "";
			$inteiro = "selected";
			$manequim = "";
			break;

		case 'manequim':
			$acessorio = "";
			$superior = "";
			$inferior = "";
			$rosto = "";
			$especial = "";
			$cabelo = "";
			$inteiro = "";
			$manequim = "selected";
			break;

		case 'cabelo':
			$acessorio = "";
			$superior = "";
			$inferior = "";
			$rosto = "";
			$especial = "";
			$cabelo = "";
			$inteiro = "";
			$manequim = "selected";
			break;
		
	}
}?>

<select name="tipo">
<option value="acessorio" <?php echo $acessorio ;?> >acess&oacute;rio</option>
<option value="superior" <?php echo $superior ;?> >roupa superior</option>
<option value="inferior" <?php echo $inferior ;?> >roupa inferior</option>
<option value="inteiro" <?php echo $inteiro ;?> >roupa inteira</option>
<option value="rosto" <?php echo $rosto ;?> >rosto</option>
<option value="cabelo" <?php echo $cabelo ;?> >cabelo</option>
<option value="especial" <?php echo $especial ;?> >roupa especial</option>
<option value="manequim" <?php echo $manequim ;?> >manequim</option>
</select><br/>
Roupa combo
<?php 
		switch($_SESSION['combo']){
		
		 case "1":
		 	$combosim = "CHECKED";
		 	$combonao = "";
		 	
		 	break;
				
		case "0":
		 	$combosim = "";
		 	$combonao = "CHECKED";
			break;
		}	
	
		echo "<input type=radio name=combo value=1 " . $combosim ."> Sim\n";
		echo "<input type=radio name=combo value=0 " . $combonao ."> N&atilde;o\n";
?>

<br/> 

Camada <input type="text" size="5" maxlength="2" name="camada" value="<?php echo $_SESSION['camada'];?>">
<br/>
<table border="1"> 
<tr>
<td>Parte</td>
<td>Camada</td>
</tr>
<tr>
<td>Manequim</td>
<td>1</td>
</tr>
<tr>
<td>Roupa Superior</td>
<td>3</td>
</tr>
<tr>
<td>Roupa Inferior</td>
<td>2</td>
</tr>
<tr>
<td>Roupa Inteira</td>
<td>4</td>
</tr>
<tr>
<td>Rosto</td>
<td>2</td>
</tr>
<tr>
<td>Cabelos</td>
<td>5</td>
</tr>
<tr>
<td>Acess&oacute;rios</td>
<td>6</td>
</tr>

</table>
Posi&ccedil;&atilde;o&nbsp;

Topo <input type="text" size="4" maxlength="4" name="topo" value="<?php echo $_SESSION['topo'];?>">&nbsp;
Esquerda <input type="text" size="4" maxlength="4" name="esquerda" value="<?php echo $_SESSION['esquerda'];?>">
<br/>
Estado 
<?php 
		switch($_SESSION['estado']){
		
		 case "visivel":
		 	$estado1 = "CHECKED";
		 	$estado2 = "";
		 	
		 	break;
				
		case "oculto":
		 	$estado1 = "";
		 	$estado2 = "CHECKED";
			break;
		}	
	
		echo "<input type=radio name=estado value=visivel " . $estado1 ."> Vis&iacute;vel\n";
		echo "<input type=radio name=estado value=oculto " . $estado2 ."> Oculto\n";
?>
<br/>
<input type="submit" value="atualizar" name="atualizar">&nbsp;
<input type="button" value="sair" name="sair" onClick="javascript:window.location='?pg=admin';">
	


</form>