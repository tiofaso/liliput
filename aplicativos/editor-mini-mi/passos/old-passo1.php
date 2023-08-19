

<h3>passo 1</h3>
Antes de come&ccedil;ar a pr&eacute; montar o seu mini-mi, por favor escolha o sexo da pessoa a ser mini-mizada e um apelido para o boneco:
<form action="?pg=encomendar&passo=2" method="post">
<br/>
<label for="apelido">Apelido para o mini-mi:</label> <input type="text" maxlength="50" name="apelido"/>
<?php
//validação de erros,
if(isset($_SESSION['erro'])){
	
	echo "<p id=\"erro\">Voc&ecirc; n&atilde;o escolheu um apelido para o seu mini-mi! :(</p>";
}	
?>
<br/>
<label for="sexo">Sexo</label> 
<input type="radio" name="sexo" value="masculino" CHECKED id="masculino">
<label for="masculino">Masculino</label> 

<input type="radio" name="sexo" value="feminino" id="feminino"> 
<label for="feminino">Feminino</label> 
<br/>
<input type="submit" value="pr&oacute;ximo passo">
</form>