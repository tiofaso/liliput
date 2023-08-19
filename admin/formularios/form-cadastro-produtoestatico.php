<form action="cadastroproduto" method="post" enctype="multipart/form-data">
<input type="hidden" name="cadastroproduto" value="1"/>
Nome do produto <input type="text" size="50" name="nome"><br/>
Descri&ccedil;&atilde;o<br/> <textarea size="500" name="descricao" rows="10" cols="50"></textarea><br/>
Pre&ccedil;o <input type="text" size="5" name="preco"><br/>
Pronta entrega <input type="radio" name="prontaentrega" value="sim"> sim
<input type="radio" name="prontaentrega" value="nao"> n&atilde;o<br/>
Loja <select name="loja">
<option value="marcamaria">.marcamaria</option>
<option value="mini-mi">mini-mi</option>
</select><br/>
Imagens<br/>
Imagem 01 <input type="file" name="imagem01"></br>
Imagem 02 <input type="file" name="imagem02"></br>
Imagem 03 <input type="file" name="imagem03"></br>
Imagem 04 <input type="file" name="imagem04"></br>
Imagem 05 <input type="file" name="imagem05"></br>
<input type="submit" value="adicionar produto">
</form>