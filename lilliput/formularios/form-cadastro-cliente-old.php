<form action="/cadastro" method="post">
<input type="hidden" name="cadastro" value="1"/>
Nome Completo <input type="text" name="nome_completo" size="100" maxlength="255" /><?php echo $erro[0]; ?><br/>
Como voc&#234; gostaria de ser chamado&#63; <input type="text" name="apelido" size="50" maxlength="50" /><br/>
CPF <input type="text" name="cpf" size="50" maxlength="14" id="cpf" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);"/><br/>
E-mail <input type="text" name="email" size="50" maxlength="100"/><br/>
Telefone <input type="text" name="telefone" size="50" maxlength="14" id="tel" onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"/><br/>
Endere&#231;o Completo <input type="text" name="endereco" size="100" maxlength="250"/><br/>
Complemento <input type="text" name="complemento" size="70" maxlength="50"/><br/>
Cidade <input type="text" name="cidade" size="50" maxlength="70"/><br/>
Estado <select name="estado">
<option value="" selected></option>
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
</select><br/>
CEP <input type="text" name="cep" size="5" maxlength="9" id="cep" onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);"/><br/>
Digite uma senha <input type="password" name="senha" size="10" maxlength="12"/><br/>
Digite a senha novamente <input type="password" name="confirmasenha" size="10" maxlength="12"/><br/>
<label id="aviso">Exceto pelo campo COMPLEMENTO, todos os demais s&#227;o obrigat&#243;rios</label><br/>
<input type="submit" name="cadastrar" value="cadastrar"/>
</form>