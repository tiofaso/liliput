<?php 
if(isset($_GET['tipo'])){
	$tipo = $_GET['tipo'];
	
}else{$tipo = "algodao";}
echo "<form name=tecidoteca action=?pg=" . $_GET['pg'] . "&tipo=" . $tipo  . " method=post enctype=multipart/form-data>";?>

Nome do acess&oacute;rio/roupa/rosto <br/>

<?php if(isset($_SESSION['nomeroupa'])){
	echo "<input type=text size=50 maxlength=100 name=nome value=" . $_SESSION['nomeroupa'] . " >";
}else{ 
	echo "<input type=text size=50 maxlength=100 name=nome>";
}?>
<br/>
Descri&ccedil;&atilde;o<br/> 
<?php if(isset($_SESSION['descricaoroupa'])){
	echo "<textarea size=500 name=descricao rows=5 cols=50 value=" . $_SESSION['descricaoroupa'] . ">" . $_SESSION['descricaoroupa'] . "</textarea><br/>"; 
}else{ 
	echo "<textarea size=500 name=descricao rows=5 cols=50></textarea><br/>";
}?>

Pre&ccedil;o da unidade 
<?php if(isset($_SESSION['nomeroupa'])){
	echo " <input type=text size=6 name=preco value=" . $_SESSION['precoroupa'] . "><br/>";
}else{ 
	echo " <input type=text size=6 name=preco><br/>";
}?>
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
}else{ 
	echo "<input type=radio name=sexo value=feminino> Feminino\n";
	echo "<input type=radio name=sexo value=masculino> Masculino\n";
	echo "<input type=radio name=sexo value=unisex> Unisex\n";
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
}else{ 
	$acessorio = "";
	$superior = "";
	$inferior = "";
	$rosto = "";
	$especial = "";
	$cabelo = "";
	$inteiro = "";
	$manequim = "";

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
	if(isset($_SESSION['combo'])){
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
	}else{ 
		echo "<input type=radio name=combo value=1> Sim\n";
		echo "<input type=radio name=combo value=0 CHECKED> N&atilde;o\n";
	}?>

<br/> 


<?php if(isset($_COOKIE['situacao']) || isset($_POST['precadastrar'])){ //escolher tipos de tecidos ?>
Materiais em que pode ser feito:<br/>

<?php lista_tecidoteca("input");?>
<?php
	if(isset($_POST['campostecido'])){
		$tecidosescolhidos = explode(",",$_POST['campostecido']);
	
		$fim = count($tecidosescolhidos);
	
		$cont = 0;
	
		$tecidos = "";
		
		while($cont < $fim){
			if(isset($_POST['tecido' . $tecidosescolhidos[$cont]])){		
				//echo "###" . $_POST['tecido' . $tecidosescolhidos[$cont]] . "<br/>";
				
				if($_POST['tecido' . $tecidosescolhidos[$cont]] != ""){ //evita de gravar dados já escolhidos no cookie
				$tecidos .= $_POST['tecido' . $tecidosescolhidos[$cont]] . ",";
				}
				
			}//end if
		
			$cont++;
		
		}//end while
		
		if(!isset($_COOKIE["tecidos"])){
				setcookie("tecidos",$tecidos);
		}else{
			$dadoscookie = $_COOKIE["tecidos"];
			$dadoscookie .= $tecidos;

			setcookie("tecidos",$dadoscookie);
		}//endif	
	}//end if

				


?>
<?php }//end if escolher tipos de tecidos?>

<?php

if(!isset($_COOKIE['situacao']) && !isset($_POST['precadastrar']) ){
	echo "<input type=submit value='pr&eacute; adicionar' name=precadastrar>\n";
}
elseif(isset($_COOKIE['situacao']) ){//usuário passou da fase de descrição da roupa
	echo "Imagem principal <input type=file name=imagemprincipal><br/>\n";
	if($_SESSION['tiporoupa'] != 'manequim'){echo "Imagem do cabide <input type=file name=imagemcabide><br/>\n";}
	echo "<input type=submit value='adicionar ao arm&aacute;rio' name=cadastrar>\n";
	
}
elseif(isset($_POST['cadastrar'])){//só por causa do navegador que não enxerga o cookie que acaba de ser criado
	echo "Imagem principal <input type=file name=imagemprincipal><br/>\n";
	if($_SESSION['tiporoupa'] != 'manequim'){echo "Imagem do cabide <input type=file name=imagemcabide><br/>\n";}
	echo "<input type=submit value='adicionar ao arm&aacute;rio' name=cadastrar>\n";
	
}

?>


</form>