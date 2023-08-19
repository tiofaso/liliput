<?php pega_cabecalho();?>

<body class="coda-slider-no-js">

<div id="principal">
		
		<div id="menuprincipal">
				<div id="logo"> 
					<h1 id="topo">
						<a href="<?php info_loja(LOJA,'url','');?>" ><img src=<?php echo "\"" . TEMPLATE_PATH . "img/mini-mi-marca.png" . "\""; ?>  border="0" title="voltar para home" alt="mini-mi logo"?></a>
					</h1>
				</div>			
			
				<div id="sitemenu" style="float:left;">
					<?php listar_paginas();?>
				</div>
			
				<?php if(talogado() == FALSE):?>
					<div id="login">
						<?php formlogin('links'); ?>
					</div>
				<?php elseif(talogado() == TRUE):?>
					<div id="profile">
						<?php profile();?>
					</div>

				<?php endif;?>
		</div><!-- menuprincipal fim-->
			
		<div id="conteudoprincipal">
				<?php mostra_titulo();?>
				<?php mostra_conteudo();?>
				<?php tem_aplicativo();?>
		</div>
<?php pega_rodape();?>
</div><!-- principal fim-->		
		


</body>
</html>