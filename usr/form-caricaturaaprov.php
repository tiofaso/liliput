<?php $action = "?pg=perfil&usr=" . $_GET['usr'] . "&pedido=" . $_GET['pedido'] . "&show=caricatura&id=" . $_GET['id'];?>
<div style="float:left;margin-top:20px;width:100%;">
	<form action="<?php echo $action;?>" method="post">
	<p><strong>Voc&ecirc; aprova esta caricatura?</strong>
	<input type="radio" name="aprova" value="sim" id="sim"> <label for="sim">Sim</label>
	<?php if(isset($_POST['aprova']) && $_POST['aprova'] == 'nao'):?>
		<input type="radio" name="aprova" value="nao" id="nao" checked> <label for="nao">N&atilde;o</label>
	<?php else:?>
		<input type="radio" name="aprova" value="nao" id="nao" > <label for="nao">N&atilde;o</label>
	<?php endif;?>	
	</p>
	
	<p>Caso voc&ecirc; n&atilde;o aprove, escreva seus coment&aacute;rios abaixo explicando o que precisa ser arrumado:</p>
	<textarea name="descricaocliente" rows="10" cols="130" id="detalhescaricatura"></textarea>
	<input type="hidden" value="<?php echo $idcaricatura;?>" name="aprovacao">
	<input id="botao" type="submit" value="enviar">
	</form>
</div>