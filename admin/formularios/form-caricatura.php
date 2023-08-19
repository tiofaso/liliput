<?php $url = "?pg=pedidos&ped=" . $_GET['ped'] . "&usr=" . $_GET['usr'] . "&email=" . $_GET['email'];?>
<div style="width:300px">
	<form action="<?php echo $url;?>" method="post" enctype="multipart/form-data">
		<p style="margin-bottom:10px;">Apelido(os)</p> <input type="text" size="40" maxlength="150" name="apelido">
		<p style="margin-bottom:0;margin-top:10px;">Descri&ccedil;&atilde;o da caricatura</p><br>
		<textarea rows="15" cols="38" name="descricaoadmin"></textarea><br\>
		<p style="margin-bottom:10px;margin-top:10px;">Vers&atilde;o:
		<select name="versao">
			<option value="vers&atilde;o 1">vers&atilde;o 1</option>
			<option value="vers&atilde;o 2">vers&atilde;o 2</option>
			<option value="vers&atilde;o 3">vers&atilde;o 3</option>
			<option value="vers&atilde;o 4">vers&atilde;o 4</option>
			<option value="vers&atilde;o 5">vers&atilde;o 5</option>
		</select>		
		</p>
		<p style="margin-top:10px;">Arquivo da caricatura:</p> <input type="file" name="caricatura"\><br\>
		<input type="submit" value="enviar caricatura"\ style="padding:5px;margin-top:10px;float:right;margin-right:10px;"><br\>
		<input type="hidden" name="caricaturasend" value="ok"/>
	</form>
</div>