<div id="formcadastro" style="padding:10px;">
<p style="margin-bottom:30px;"><strong>Aten&ccedil;&atilde;o:</strong> o cadastro &eacute; totalmente gratuito e <strong>os seus dados n&atilde;o ser&atilde;o compartilhados com terceiros</strong>. Palavra de escoteiro! :)</p>
<form action="<?php info_loja(LOJA,'url','');?>?pg=cadastrar" method="post">
<input type="hidden" name="cadastro" value="1"/>
<span>Nome Completo <input type="text" name="nome_completo" value="<?php echo $nome_completo;?>" size="100" maxlength="255" /><?php if(isset($msg)){ echo $msg[0];} ?></span>
<span>Como voc&#234; gostaria de ser chamado&#63; <input type="text" name="apelido"  value="<?php echo $apelido;?>" size="50" maxlength="50" /><?php if(isset($msg)){ echo $msg[1];}?></span>
<span>CPF <input type="text" name="cpf" value="<?php echo $cpf;?>" size="50" maxlength="14"  id="cpf" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);"/><?php if(isset($msg)){ echo $msg[2];}?></span>
<span>E-mail <input type="text" name="email" size="50" value="<?php echo $email;?>" maxlength="100"/><?php if(isset($msg)){ echo $msg[3];}?></span>
<span>Celular/Telefone <input type="text" name="telefone" size="50" value="<?php echo $telefone;?>" maxlength="14" id="tel" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"/><?php if(isset($msg)){ echo $msg[4];} ?></span>
<span>Endere&#231;o Completo <input type="text" name="endereco" value="<?php echo $endereco;?>" size="100" maxlength="250"/><?php if(isset($msg)){ echo $msg[5];} ?></span>
<span>Complemento <input type="text" name="complemento" value="<?php echo $complemento;?>" size="70" maxlength="50"/></span>
<span>Cidade <input type="text" name="cidade" value="<?php echo $cidade;?>" size="50" maxlength="70"/><?php if(isset($msg)){ echo $msg[6];} ?></span>
<span>Estado <select name="estado">
<option value="<?php echo $estado;?>" selected><?php echo $estado;?></option>
<option value="AC">AC</option>
<option value="AL">AL</option>
<option value="AM">AM</option>
<option value="AP">AP</option>
<option value="BA">BA</option>
<option value="CE">CE</option>
<option value="DF">DF</option>
<option value="ES">ES</option>
<option value="GO">GO</option>
<option value="MA">MA</option>
<option value="MG">MG</option>
<option value="MS">MS</option>
<option value="MT">MT</option>
<option value="PA">PA</option>
<option value="PB">PB</option>
<option value="PE">PE</option>
<option value="PI">PI</option>
<option value="PR">PR</option>
<option value="RJ">RJ</option>
<option value="RN">RN</option>
<option value="RO">RO</option>
<option value="RR">RR</option>
<option value="RS">RS</option>
<option value="SC">SC</option>
<option value="SE">SE</option>
<option value="SP">SP</option>
<option value="TO">TO</option>
</select><?php if(isset($msg)){ echo $msg[7];}?></span>
<span>CEP <input type="text" name="cep" size="5" maxlength="9" value="<?php echo $cep;?>" id="cep" onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);"/><?php if(isset($msg)){ echo $msg[8];} ?></span>
<span>Digite uma senha <input type="password" name="senha" size="10" maxlength="12"/><?php if(isset($msg)){ echo $msg[9];} ?></span>
<span>Digite a senha novamente <input type="password" name="confirmasenha" size="10" maxlength="12"/><?php if(isset($msg)){ echo $msg[10];}?></span>
<span><label id="aviso">Exceto pelo campo COMPLEMENTO, <strong>todos os demais s&#227;o obrigat&#243;rios</strong></label></span>
<span><input id="botaologin" type="submit" name="cadastrar" value="cadastrar"/></span>
</form>
</div>