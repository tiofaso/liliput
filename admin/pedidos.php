<h2>Lista de Pedidos</h2>
<?php

if(!isset($_GET['usr']) && !isset($_GET['acao']) ){  	
	echo "<div id=\"colesq\"  style=\"width:20%;margin-right:20px;\">\n";
		echo "<p>Escolha na lista abaixo os pedidos que voc&ecirc; quer visualizar</p>\n";
		echo "<form action=\"?pg=pedidos\" method=\"post\">\n";
			echo "<select name=\"estado\">\n";
				echo "<option value=\"criado\">novos</option>\n";
				echo "<option value=\"analise\">an&aacute;lise</option>\n";
				echo "<option value=\"pagamento\">pagamento</option>\n";
				echo "<option value=\"producao\">produ&ccedil;&atilde;o</option>\n";
				echo "<option value=\"correios\">envio correios</option>\n";
				echo "<option value=\"outros\">outros</option>\n";
			echo "</select>\n";
			echo "<input style=\"margin-top:10px;\" type=\"submit\" value=\"ok\" />\n";
		echo "</form>\n";

	echo "</div>";

 	
	echo "<div id=\"coldir\" style=\"float:left;width:auto;\">\n";		
		
		if(isset($_POST['estado'])){$estado = $_POST['estado'];}
		else{$estado = "criado";}
		
		listapedidos($estado);
	echo "</div>";
}
elseif(isset($_GET['acao']) && $_GET['acao'] == 'editar' ) {
	echo "<h3>Editor de Pedidos</h3>";
	editapedido($_GET['id']);
}

else{ 

	echo "<div id=\"colesq\" style=\"width:640px;\">";
		echo "<span style=\"float:left;\"><h3>Pedido N&ordm; ".$_GET['ped']."</h3></span>";
	echo "</div>";
	
	echo "<div id=\"coldir\" style=\"width:290px;\">";
		echo "<span style=\"float:right;\"> <a href=\"?pg=clientes&usr=".$_GET['usr']."\">perfil cliente</a></span>\n\n";
	echo "</div>";
	

	echo "<div id=\"colesq\" style=\"width:640px;\">";
		mostrapedidosadmin($_GET['ped']);
	echo "</div>";
	
	echo "<div style=\"float:right;width:310px;\">";
		echo "<div id=\"coldir\" style=\"background:#BFE4ED;width:290px;\">";
			echo "<h3>Caricatura do mini-mi</h3>";
		
			if(isset($_POST['caricaturasend'])){
				include("aplicativos/cadastro-caricatura.php");
				
					//e-mail completo do sistema
					$assunto = "mini-mi - Alguém quer te dar um olá! :) | ". $_GET['ped'];
					$mensagem = "Olá!\n\n O bonequeiro acaba de publicar a caricatura do seu mini-mi!\n\n";
					$mensagem .= "Faça login no http://mini-mi.net e avalie a danadinha!\n\n";
					$mensagem .= "Espero que você goste!\n\n";
					$mensagem .= "\n - Lilliput";
					
					mandaemailadmin('mini-mi',$_GET['email'],$assunto,utf8_decode($mensagem));
			}
		
			include("formularios/form-caricatura.php");
		
		echo "</div>";
	
		echo "<div id=\"coldir\" style=\"background:#FFFCD2;width:290px;margin-top:20px;\">";
			echo "<h3>Caricaturas enviadas</h3>";
			$urlsite = info_loja(LOJA,'url','return');
			listacaricaturaadmin($_GET['ped'],$urlsite);		
		echo "</div>";
	echo "</div>";
	
 	
	
}
 ?>