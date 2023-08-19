<div id="formlogin">

	<form action="<?php info_loja(LOJA,'url','');?>/?pg=login" method="post">
		<ul>
			<li>e-mail <input id="logininput" value="<?php if(isset($_GET['usr'])){ echo base64_decode($_GET['usr']);}?>" type="text" maxlength="100" name="usuario"/></li>
			<li>senha <input id="logininput" type="password" maxlength="64" name="senha"/></li>
			<li><input id="botaologin" type="submit" name="login" value="ok"/></li>
		</ul>
	</form>
<span id="erro">Usu&aacute;rio ou senha desconhecido</span>	
</div>