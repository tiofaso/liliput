<div id="colesq">

<p>D&uacute;vidas? Reclama&ccedil;&otilde;es? Sugest&otilde;es? Sinta-se a vontade para buzinar! :)</p>
<p>Aten&ccedil;&atilde;o, <strong>todos os campos s&#227;o obrigat&#243;rios</strong></p>
<?php

if(isset($_POST['enviar'])){
	if($_POST['nome'] != "" && $_POST['email'] != "" && $_POST['assunto'] != "" && $_POST['mensagem'] != ""){
		if(validaemail($_POST['email']) == true){
			
			//e-mail completo do sistema
	
			$assunto = $_POST['assunto'] . " | lilliput";
			$mensagem = "Nome: " . $_POST['nome'] . "\n";
			$mensagem .= "e-mail: " . $_POST['email'] . "\n";
			$mensagem .= "Mensagem:\n" . $_POST['mensagem'] . "\n";
			
	
			mandaemail('tio .faso','faso@marcamaria.com',$assunto,$mensagem);
			
			$_POST['assunto'] = "";
			$_POST['nome'] = "";
			$_POST['email'] = "";
			$_POST['mensagem'] = "";
			
			echo "<strong><p id=\"correto\">Mensagem enviada com sucesso! Em breve seu e-mail ser&aacute; respondido.</p></strong>";
		}else{echo "<strong><p id=\"erro\">Aten&ccedil;&atilde;o: E-mail inv&aacute;lido!</p></strong>";}
	}else{echo "<strong><p id=\"erro\">Aten&ccedil;&atilde;o: &Eacute; preciso preencher todos os campos!</p></strong>";}
}
?>


<form action="<?php echo info_loja(LOJA,'url','return') . "?pg=contato&acao=enviar";?>" method="POST">
<p>Seu nome <br/><input type="text" name="nome" size="50" maxlength="255" style="width:350px;" value="<?php if(isset($_POST['nome'])){echo $_POST['nome'];}?>" /></p>
<p>Seu e-mail <br/><input type="text" name="email" size="50" maxlength="100" style="width:350px;" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>"/></p>
<p>Assunto <br/><input type="text" name="assunto" size="50" maxlength="100" style="width:350px;" value="<?php if(isset($_POST['assunto'])){echo $_POST['assunto'];}?>"/></p>
<p>Mensagem</p><p> <textarea name="mensagem" cols="50" rows="10" style="width:350px;"><?php if(isset($_POST['mensagem'])){echo $_POST['mensagem'] ;}?></textarea></p>

<p><input id="botaologin" type="submit" name="enviar" value="enviar"/></p>

</form>

</div>
<div id="coldir">
<center>
	<img src="<?php echo IMG_PATH . "site/contato.png";?>" alt="contato"/>
</center>
</div>