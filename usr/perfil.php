<div id="perfildados">
	<ul>
		<li>Ol&aacute; <?php echo base64_decode($_SESSION['usuariodados'][2]); ?>!</li>
		<li><a href="?pg=perfil&usr=<?php echo base64_encode($_SESSION['usuariodados'][0]);?>" >meus pedidos</a></li>
		<!--<li><a href="?pg=perfil&usr=<?php //echo base64_encode($_SESSION['usuariodados'][0]);?>&acao=caricaturas">minhas caricaturas</a>-->
		<li><a href="?pg=perfil&usr=<?php echo base64_encode($_SESSION['usuariodados'][0]);?>&acao=dados">meus dados</a></li>
		
	</ul>

</div>
<?php if(!isset($_GET['pedido']) && !isset($_GET['acao'])):?>
<!-- área de dados dos pedidos/home - INÍCIO-->
<div id="perfilpedidos">
	<div id="colesq" style="background:#FCEDB0;width:46.5%;">
	<h3>Meus pedidos</h3>
		<?php meuspedidos();?>
	</div>


	<div id="coldir" style="background:#FCEDB0;width:46.5%;">
	<h3>Minhas caricaturas</h3>
		<?php minhascaricaturas();?>
	</div>
	
</div>
<!-- área de dados dos pedidos/home - FIM-->

<?php elseif(isset($_GET['acao']) && $_GET['acao'] == 'dados'):?>
<!-- área de dados pessoais do cliente - INÍCIO-->
<div style="padding:10px;">
<?php montaperfil();?>
</div>

<!-- área de dados pessoais do cliente - FIM-->

<?php elseif(isset($_GET['acao']) && $_GET['acao'] == 'caricaturas'):?>
<!-- lista de caricaturas dos pedidos cliente - INÍCIO-->
<!--<div style="padding:10px;">-->
<?php // mostracaricaturashome();?>
<!--</div>-->
<!-- lista de caricaturas dos pedidos cliente - FIM-->

<?php elseif(isset($_GET['pedido'])): ?>
	<?php if(!isset($_GET['show'])):?>
		<div id="perfilpedidos">
			<span style="margin-bottom:10px;float:right;text-align:right;width:50px;">
				<a href="?pg=perfil&usr=<?php echo $_SESSION['usuariodados'][1];?>">voltar</a>
			</span>
	
			<h3 style="margin-bottom:0px;" >Pedido n&ordm; <?php echo $_GET['pedido'];?></h3>
	
			<?php mostrapedidos($_GET['pedido'],'resumo');?>
		</div>

		<div id="perfilpedidos">
	
			<h3 style="margin-bottom:0px;" >Caricaturas</h3>
			
			<?php  mostracaricaturas($_GET['pedido'],'lista','');?>
		</div>
	<?php elseif(isset($_GET['show']) && $_GET['show'] == 'caricatura' ):?>
		<div id="perfilpedidos">
			<span style="margin-bottom:10px;float:right;text-align:right;width:50px;">
				<a href="?pg=perfil&usr=<?php echo $_SESSION['usuariodados'][1] . "&pedido=" . $_GET['pedido'];?>">voltar</a>
			</span>
	
			<h3 style="margin-bottom:0px;" >Caricatura do pedido n&ordm; <?php echo $_GET['pedido'];?></h3>
			<?php
			if(isset($_POST['aprovacao'])){//usuário enviou comentário sobre a caricatura
				if($_POST['aprova'] == 'sim'){ 
					$aviso = "<span id=\"correto\">Avalia&ccedil;&atilde;o enviada com sucesso. Agora o seu mini-mi entrar&aacute; no processo de gesta&ccedil;&atilde;o! :)</span>";
					atualizacaricatura($_POST['aprovacao'],$_POST['aprova'],vacinadebase($_POST['descricaocliente']));
					
					//e-mail completo do sistema
					$assunto = "lilliput - caricatura aprovada! :)| ". $_GET['pedido'];
					$mensagem = "Olá! Uma caricatura acaba de ser aprovada pelo usuário " . base64_decode($_SESSION['usuariodados'][2]) . "\n";
					$mensagem .= "E-mail do usário: " . base64_decode($_SESSION['usuariodados'][1]) . "\n";
					$mensagem .= "Número do pedido: " . $_GET['pedido'] . "\n";
					$mensagem .= "\n\n - Lilliput";
					
					mandaemail('mini-mi','contato@mini-mi.net',$assunto,utf8_decode($mensagem));
				}
				elseif($_POST['aprova'] == 'nao' && $_POST['descricaocliente'] == NULL){
					$aviso = "<span id=\"erro\">Voc&ecirc; precisa explicar os motivos para n&atilde;o aprovar essa caricatura.</span>";
				}
				elseif($_POST['aprova'] == 'nao' && $_POST['descricaocliente'] != NULL){
					atualizacaricatura($_POST['aprovacao'],$_POST['aprova'],vacinadebase($_POST['descricaocliente']));
					$aviso = "<span id=\"correto\">Avalia&ccedil;&atilde;o enviada com sucesso. O bonequeiro foi notificado e em breve ele enviar&aacute; uma nova caricatura. :)</span>";
					
					//e-mail completo do sistema
					$assunto = "lilliput - caricatura não foi aprovada :( | ". $_GET['pedido'];
					$mensagem = "Olá! Uma caricatura acaba de ser reprovada pelo usuário " . base64_decode($_SESSION['usuariodados'][2]) . "\n";
					$mensagem .= "E-mail do usário: " . base64_decode($_SESSION['usuariodados'][1]) . "\n";
					$mensagem .= "Número do pedido: " . $_GET['pedido'] . "\n";
					$mensagem .= "\n\n - Lilliput";
					
					mandaemail('mini-mi','contato@mini-mi.net',$assunto,utf8_decode($mensagem));

				}
			}
			?>
			<?php  mostracaricaturas($_GET['pedido'],'caricatura',$_GET['id']);?>
			<?php if(isset($aviso)){echo "<div style=\"width:100%;\">" . $aviso . "</div>";}?>
		</div>

	<?php endif; ?>
<?php endif; ?>

