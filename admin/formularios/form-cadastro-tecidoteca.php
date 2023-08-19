<form action="editor-tecidoteca&acao=cadastro" method="post" enctype="multipart/form-data">
<input type="hidden" name="cadastrotecidoteca" value="1"/>
Nome do material <input type="text" size="50" name="nome"><br/>
Descri&ccedil;&atilde;o<br/> <textarea size="500" name="descricao" rows="5" cols="50"></textarea><br/>
Tipo <select name="tipo">
<option value="algod&atilde;o">algod&atilde;o</option>
<option value="brim">brim</option>
<option value="cetim">cetim</option>
<option value="feltro">feltro</option>
<option value="jeans">jeans</option>
<option value="malha">malha</option>
<option value="moleton">moleton</option>
<option value="bordado">bordado</option>
</select><br/>
Tags <input type="text" size="50" name="tags"><br/>
Cor hexadecimal 1 <input type="text" size="7" name="corhexa1"><br/>
Cor hexadecimal 2 <input type="text" size="7" name="corhexa2"><br/>
Cor hexadecimal 3 <input type="text" size="7" name="corhexa3"><br/>
Cor hexadecimal 4 <input type="text" size="7" name="corhexa4"><br/>
Imagem<input type="file" name="imagem"></br>
<input type="submit" value="adicionar material">
</form>